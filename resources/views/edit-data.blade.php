@extends('layouts.main')
@section('title', 'Edit Data')
@section('home', 'active')
@section('content')
<h2 class="title">Edit Data</h2>
@if(Session::has('success')) <div class="success">{{Session::get('success')}}</div> @endif
<form action="{{ route('form.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $editData['id'] }}">
   <div class="row">
    <div class="group">
        <label for="name">Name</label>
        <input required type="text" name="name" id="name" value="{{ $editData['name'] }}">
        @error('name') <span class="error"></span> @enderror
    </div>
    <div class="group">
        <label for="password">Password</label>
        <input required type="password" name="password" id="password" value="{{ $editData['password'] }}">
        @error('password') <span class="error"></span> @enderror
    </div>
   </div>
   <div class="row">
    <div class="group">
        <label for="email">Email</label>
        <input required type="email" name="email" id="email" value="{{ $editData['email'] }}">
        @error('email') <span class="error"></span> @enderror
    </div>
    <div class="group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept="image/*">
        @error('image') <span class="error"></span> @enderror
    </div>
   </div>
   <div class="row">
    <div class="group">
        <label for="mobile">Mobile</label>
        <input required type="number" name="mobile" id="mobile" value="{{ $editData['mobile'] }}">
        @error('mobile') <span class="error"></span> @enderror
    </div>
    <div class="group">
        <label for="date">Date</label>
        <input required type="date" name="date" id="date" value="{{ $editData['date'] }}">
        @error('date') <span class="error"></span> @enderror
    </div>
   </div>
   <div class="group">
    <label for="role">Role</label>
    <select required name="role" id="role">
        <option value="">Select</option>
        <option value="Admin" {{ $editData['role'] == 'Admin' ? 'selected' : '' }}>Admin</option>
        <option value="User" {{ $editData['role'] == 'User' ? 'selected' : '' }}>User</option>
    </select>
    @error('role') <span class="error"></span> @enderror
   </div>
   <button>Submit</button>
</form>
@endsection
