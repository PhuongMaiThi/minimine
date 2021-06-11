@extends('layouts.master')

{{-- import external file css --}}
@push('css')
    
@endpush

@section('content')
    <section class="checkout">
        <div class="row">
            <div class="col-3">
                {{-- thong tin don hang --}}
                @include('carts.parts.cart_info')
            </div>
            <div class="col-5">
                {{-- thong tin ca nhan --}}
                @include('carts.parts.personal_info')
            </div>
            <div class="col-4">
                {{-- thong tin thanh toan --}}
                @include('carts.parts.payment_info')
            </div>
        </div>
    </section>
@endsection 