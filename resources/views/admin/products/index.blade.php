@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Product')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Product Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Product')

{{-- import file css (private) --}}
@push('css')
    {{-- <link rel="stylesheet" href="/admin/css/categories/category-list.css"> --}}
@endpush

@section('content')
    {{-- form search --}}

    {{-- create category link --}}
    <button> <p><a href="{{ route('admin.product.create') }}">Create</a></p></button>
    
    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    {{-- display list product table --}}
    <table id="product-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Thumbnail</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Is Feature</th>
                <th>Category Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($products))
                @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td style width="60px" height="60px">{{ $product->thumbnail }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->is_feature }}</td>
                        <td>{{ $product->category->name }}</td>
                        {{-- action--}}
                        <td><a href="{{ route('admin.product.show', $product->id) }}">Detail</a></td>
                        <td><a href="{{ route('admin.product.edit', $product->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $products->appends(request()->input())->links() }}
@endsection