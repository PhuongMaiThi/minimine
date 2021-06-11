@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List Customer')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'Customer Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List Customer')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/admin/css/categories/category-list.css">
@endpush

@section('content')

    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    <h4>Lịch sử giao dịch của khách hàng</h4>

    {{-- display list User table --}}
    <table id="customer-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Order_ID</th>
                <th>Total Money</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- @if(!empty($customer))
                @foreach ($customer as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td><a href="{{ route('admin.user.show', $user->id) }}"><button class="btn btn-primary">Detail</button></a></td>
                        <td>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif --}}
        </tbody>
    </table>
    <a href="{{route('admin.customer.index')}}"><button type="button" class="btn btn-danger">Back</button></a>

@endsection