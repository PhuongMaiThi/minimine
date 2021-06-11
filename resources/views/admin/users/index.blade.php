@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'List User')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'User Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'List User')

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
    <table id="user-list" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Role</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($users))
                @foreach ($users as $key => $ad)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $ad->name }}</td>
                        <td>{{ $ad->email }}</td>
                        <td>{{ $ad->role_id}}</td>
                        <td><a href="{{ route('admin.user.edit', $ad->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('admin.user.destroy', $ad->id) }}" method="post">
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