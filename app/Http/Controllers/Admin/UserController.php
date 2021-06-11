<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\user\StoreUserRequest;
use App\Http\Requests\Admin\user\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request){
        $data = [];
        $users = Admin::paginate(8);
        
        if (!empty($request->date)) {
            $users = Admin::where('created_at', 'like', '%' . $request->date . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(8);
            // dd($users);
        }
        $data['users'] = $users;

        return view('admin.users.index', $data);
    }
    public function create()
    {
        // Method: GET
        $data = [];
        return view('admin.users.create', $data);
    }
    public function store(StoreUserRequest $request){
        $userInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id, 
        ];
        DB::beginTransaction();

        try {
            Admin::create($userInsert);
            //  dd($userInsert);
            
            // insert into data to table category (successful)
            DB::commit();

            return redirect()->route('admin.user.index')->with('sucess', 'Insert into data to User Sucessful.');
        } catch (\Exception $ex) {
            // insert into data to table category (fail)
            // dd(123);
            DB::rollBack();
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
    public function edit($id)
    {
        // Method: GET
        $data = [];
        $user = Admin::findOrFail($id);
        $data['user'] = $user;

        return view('admin.users.edit', $data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // Method: PUT
        // dd($request->all());

        DB::beginTransaction();

        try {
            // create $category
            $user = Admin::find($id);
            // set value for field name
            $user->password = $request->password;
            $user->role_id = $request->role_id;
            $user->save();

            DB::commit();

            return redirect()->route('admin.user.index')
                ->with('success', 'Update User successful!');
        } catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
    public function destroy($id)
    {
        // Method: DELETE
        DB::beginTransaction();

        try {
            $user = Admin::find($id);
            $user->delete();

            DB::commit();

            return redirect()->route('admin.user.index')
                ->with('success', 'Delete User successful!');
        }  catch (\Exception $ex) {
            DB::rollBack();
            // have error so will show error message
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
