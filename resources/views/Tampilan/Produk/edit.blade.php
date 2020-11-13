@extends('dashbord')

@section('title', 'Update kategori')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="{{ url('/produk',$produk->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name_produk">Name Produk</label>
        <input type="text" name="name_produk" class="form-control" value="{{$produk->name_produk}}" required>
        <p class="text-danger">{{ $errors->first('name_produk') }}</p>
    </div>
    <div class="form-group">
        <label for="tgl_masuk">tgl_masuk</label>
        <input type="date" name="tgl_masuk" class="form-control" value="{{$produk->tgl_masuk}}" required>
        <p class="text-danger">{{ $errors->first('tgl_masuk') }}</p>
    </div>
    <div class="form-group">
        <label for="terjual">terjual</label>
        <input type="text" name="terjual" class="form-control" value="{{$produk->terjual}}" required>
        <p class="text-danger">{{ $errors->first('terjual') }}</p>
    </div>
    <div class="form-group">
      <label for="diskon">diskon</label>
      <input type="text" name="diskon" class="form-control"  value="{{$produk->diskon}}" required>
      <p class="text-danger">{{ $errors->first('diskon') }}</p>
  </div>
    <div class="form-group">
      <label for="harga">harga</label>
      <input type="text" name="harga" class="form-control" value="{{$produk->harga}}" required>
      <p class="text-danger">{{ $errors->first('harga') }}</p>
  </div>
  <div class="form-group">
    <label for="stok">stok</label>
    <input type="text" name="stok" class="form-control" value="{{$produk->stok}}" required>
    <p class="text-danger">{{ $errors->first('stok') }}</p>
</div>
<div class="form-group">
    <label for="desc">desc</label>
    <input type="text" name="desc" class="form-control" value="{{$produk->desc}}" required>
    <p class="text-danger">{{ $errors->first('desc') }}</p>
</div>
  <div class="form-group">
    <label for="image">Foto Produk</label>
    <input type="file" name="image" class="form-control" value="{{ old('image') }}" alt={{$produk->image}}">
    <p class="text-danger">{{ $errors->first('image') }}</p>
</div>

    <div class="form-group">
        <button class="btn btn-primary btn-sm">Update</button>
    </div>
  </form>
@endsection
