@extends('dashbord')

@section('title', 'Update kategori')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="{{ url('/admin/update2', $kategori->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name_kategori">Name Produk</label>
        <input type="text" name="name_kategori" class="form-control" value="{{$kategori->name_kategori}}" required>
        <p class="text-danger">{{ $errors->first('name_kategori') }}</p>
    </div>
    <div class="form-group">
        <label for="created_at">created_at</label>
        <input type="text" name="created_at" class="form-control" value="{{$kategori->created_at}}" required>
        <p class="text-danger">{{ $errors->first('created_at') }}</p>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Update</button>
    </div>
  </form>
@endsection
