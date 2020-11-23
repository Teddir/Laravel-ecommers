@extends('dashbord')

@section('title', 'Update Penjual')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{ url('/admin/update3', $user->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name">Username</label>
        <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
        <p class="text-danger">{{ $errors->first('name') }}</p>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
        <p class="text-danger">{{ $errors->first('email') }}</p>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{$user->alamat}}" required>
        <p class="text-danger">{{ $errors->first('alamat') }}</p>
    </div>
    <div class="form-group">
        <label for="avatar">Foto Produk</label>
        <input type="file" name="avatar" class="form-control" value="{{ old('avatar') }}" required>
        <p class="text-danger">{{ $errors->first('avatar') }}</p>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Update</button>
    </div>
</form>
@endsection
