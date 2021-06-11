@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Create User')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'User Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Create User')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/admin/css/categories/category-list.css">
@endpush

@section('content')

<form action="{{ route('admin.user.store') }}" method="post">
  @csrf
    <div class="form-group">
        <label for="exampleInputName">Name</label>
        <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter name">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-check">
        <label for="exampleInputRole">Role</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" value="role_id" checked>
            <label class="form-check-label" for="exampleRadios1">
              Administrator
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" value="role_id">
            <label class="form-check-label" for="exampleRadios2">
              Editor
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" value="role_id" >
            <label class="form-check-label" for="exampleRadios3">
              Shipper
            </label>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection