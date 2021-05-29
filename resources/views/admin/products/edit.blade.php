@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Edit Product')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Product Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Edit Product')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/products/product-edit.css">
@endpush

@section('content')
    <h4>Update Product</h4>
    
    @include('errors.error')
    
    <form action="{{ route('admin.product.update', request()->route('id')) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group mb-5">
            <label for="">Product Name</label>
            <input type="text" name="name" placeholder="product name" value="{{ old('name', $product->name) }}" class="form-control">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Thumbnail</label>
            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid">
            <input type="file" name="thumbnail" placeholder="product thumbnail" class="form-control">
            @error('thumbnail')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Description</label>
            <textarea name="description" rows="2" class="form-control">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Quantity</label>
            <input type="text" name="quantity" placeholder="Product Quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control">
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Content</label>
            <textarea name="content" rows="10" class="form-control">{{ old('content', $product->product_detail ? $product->product_detail->content : null) }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Category</label>
            <select name="category_id" class="form-control">
                <option value=""></option>
                @if(!empty($categories))
                    @foreach ($categories as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}" {{ old('category_id', $product->category_id) == $categoryId ? 'selected' : ''  }}>{{ $categoryName }}</option>
                    @endforeach
                @endif
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Image</label>
            <input type="file" name="new_url[]" multiple class="form-control">

            {{-- show all image of table product_images --}}
            @if (!empty($product->product_images))
                <ul class="row list-product-image">
                    @foreach ($product->product_images as $url)
                        <li class="col-4">
                            <div class="product-image-group">
                                <img src="{{ asset($url->url) }}" alt="image" class="img-fluid">
                                <input type="hidden" name="url[]" value="{{ $url->url }}">
                                <button type="button" class="btn btn-danger form-control mt-1" onclick="$(this).closest('li').remove()">Remove Image</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            @error('url')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="">Product Price</label>
            <div class="border p-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Status</label>
                            <div>
                                <input type="radio" name="price_status" value="0" checked id="price-status-0">
                                <label for="price-status-0">Private</label>
                                <input type="radio" name="price_status" value="1" id="price-status-1">
                                <label for="price-status-1">Public</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-2">
                            <label for="">Begin Date</label>
                            <input type="text" name="begin_date" placeholder="YYYY-mm-dd" class="datepicker form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">End Date</label>
                            <input type="text" name="end_date" placeholder="YYYY-mm-dd" class="datepicker form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">List Product</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection