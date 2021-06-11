@extends('layouts.master')

{{-- import external file css --}}
@push('css')
    
@endpush

@section('content')

@include('layouts.search')

 <!-- Categories Section Begin -->
@include('layouts.welcome.categories')
<!-- Categories Section End -->

<!-- Featured Section Begin -->
@include('layouts.welcome.feature')
<!-- Featured Section End -->

<!-- Banner Begin -->
@include('layouts.welcome.banner')
<!-- Banner End -->

<!-- Latest Product Section Begin -->
@include('layouts.welcome.lastest_product')
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
@include('layouts.welcome.blog')
<!-- Blog Section End -->  

@endsection