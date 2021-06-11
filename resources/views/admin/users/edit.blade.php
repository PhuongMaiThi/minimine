@extends('admin.layouts.master')

{{-- set page title --}}
@section('title', 'Update User')

{{-- set breadcrumbName --}}
@section('breadcrumbName', 'User Management')

{{-- set breadcrumbMenu --}}
@section('breadcrumbMenu', 'Update User')

{{-- import file css (private) --}}
@push('css')
    <link rel="stylesheet" href="/admin/css/categories/category-list.css">
@endpush

@section('content')

<form action="{{ route('admin.user.update', request()->route('id')) }}" method="post">
  @csrf
  @method('put')
    <div class="form-group">
        <label for="exampleInputName">Name</label>
        <p>{{ $user->name }}</p>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <p>{{ $user->email }}</p>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Old password</label>
        <p>{{ $user->password }}</p>
      </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" name="new_password" placeholder="Password">
    </div>
    <div class="form-check">
        <label for="exampleInputRole">Role</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              Administrator
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
              Editor
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" id="exampleRadios3" value="option3" >
            <label class="form-check-label" for="exampleRadios3">
              Shipper
            </label>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection