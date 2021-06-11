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
    {{-- form search --}}

    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    {{-- display list User table --}}
    <table id="customer-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>User Name</th>
                <th>Email</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($customer))
                @foreach ($customer as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('admin.customer.show', $user->id) }}"><button class="btn btn-primary">Detail</button></a></td>
                        <td>
                            <form action="{{ route('admin.customer.destroy', $user->id) }}" method="post">
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
@endsection