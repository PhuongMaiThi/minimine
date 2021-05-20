<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostDetail;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo 'vao post index function ????';


        $data = [];
        // get list data of table posts
        $posts = Post::with('category');

        // add new param to search
        // search post name
        if (!empty($request->name)) {
            $posts = $posts->where('name', 'like', '%' . $request->name . '%');
        }

        // search category_id
        if (!empty($request->category_id)) {
            $posts = $posts->where('category_id', $request->category_id);
        }

        // order ID desc
        $posts = $posts->orderBy('id', 'desc');
        
        // pagination
        $posts = $posts->paginate(2);

        // dd($posts->count());

        // get list data of table categories
        $categories = Category::pluck('name', 'id')
            ->toArray();
        $data['categories'] = $categories;
        // dd($posts);
        $data['posts'] = $posts;
        // return view('posts.index', $data);
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $categories = Category::pluck('name', 'id')
            ->toArray();
        // dd($categories);
        $data['categories'] = $categories;
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // dd($request);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail') 
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/thumbnail
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $fileName = 'thumbnail_' . time() . '.' . $extension;
            $thumbnailPath = $image->move('thumbnail', $fileName);
        }

        $dataInsert = [
            'name' => $request->name,
            'thumbnail' => $thumbnailPath,
            'category_id' => $request->category_id,
        ];

        DB::beginTransaction();
        //dd(123);
        try {
            // insert into table posts
            $post = Post::create($dataInsert);

            DB::commit();

            // success
            return redirect()->route('admin.post.index')->with('success', 'Insert successful!');
        } catch (\Exception $ex) {
            echo $ex->getMessage();

            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $categories = Category::pluck('name', 'id')
            ->toArray();
        // $post = Post::find($id); // case 1
        $post = Post::findOrFail($id); // case 2
        $data['post'] = $post;
        $data['categories'] = $categories;
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $postDetailId = $post->post_detail ? $post->post_detail->id : null;
        $thumbnailOld = $post->thumbnail;

        // update data for table posts
        $post->name = $request->name;
        $post->category_id = $request->category_id;

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail') 
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/thumbnail
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $fileName = 'thumbnail_' . time() . '.' . $extension;
            $thumbnailPath = $image->move('thumbnail', $fileName);
            $post->thumbnail = $thumbnailPath;
            Log::info('thumbnailPath: ' . $thumbnailPath);
        }
        DB::beginTransaction();

        try {
            // update data for table posts
            $post->save();

            $dataDetailPost = [
                'content' => $request->content,
                'post_id' => $id,
            ];

            // create or update data for table post_details
            if (!$postDetailId) { // create
                $postDetail = new PostDetail($dataDetailPost);
                $postDetail->save();
            } else { // update
                PostDetail::find($postDetailId)
                    ->update($dataDetailPost);
            }
            
            DB::commit();

            // SAVE OK then delete OLD file
            if (File::exists(public_path($thumbnailOld))
                && $request->hasFile('thumbnail') 
                && $request->file('thumbnail')->isValid()) {
                File::delete(public_path($thumbnailOld));
            }

            // success
            return redirect()->route('admin.post.index')->with('success', 'Update successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $post = Post::findOrFail($id);
            $thumbnailOld = $post->thumbnail;
            $post->post_detail->delete();
            $post->delete();

            DB::commit();

            // DELETE OK then delete thumbnail file
            if (File::exists(public_path($thumbnailOld))) {
                File::delete(public_path($thumbnailOld));
            }

            // success
            return redirect()->route('post.index')->with('success', 'Delete successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
