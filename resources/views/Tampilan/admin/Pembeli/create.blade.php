@extends('dashbord_seller')

@section('title', 'Create Customer')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{ url('/admin/create3') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="avatar">Foto </label>
        <input type="file" name="avatar" class="form-control" value="{{ old('avatar') }}" required>
        <p class="text-danger">{{ $errors->first('avatar') }}</p>
    </div>    
    <div class="form-group">
        <label for="name">Username</label>
        <input type="text" name="name" class="form-control" required>
        <p class="text-danger">{{ $errors->first('name') }}</p>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" class="form-control" required>
        <p class="text-danger">{{ $errors->first('alamat') }}</p>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
        <p class="text-danger">{{ $errors->first('email') }}</p>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
        <p class="text-danger">{{ $errors->first('password') }}</p>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation" class="form-control" required>
        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Tambah</button>
    </div>
</form>
@endsection
