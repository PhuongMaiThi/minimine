@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Product')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Product Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Product')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/backend/css/products/product-list.css">
@endpush

{{-- import file js (private) --}}
@push('js')
    <script src="/backend/js/products/product-list.js"></script>
@endpush

@section('content')
    {{-- form search --}}
    @include('admin.products._search')  

    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    {{-- display list product table --}}
    @include('admin.products._table')
@endsection