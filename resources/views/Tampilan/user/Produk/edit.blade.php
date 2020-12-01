@extends('dashbord_seller')

@section('title', 'Update kategori')

@section('dashbord1')

@if(\Session::has('alert-failed'))
<div class="alert alert-failed">
    <div>{{Session::get('alert-failed')}}</div>
</div>
@endif
@if(\Session::has('alert-success'))
<div class="alert alert-success">
    <div>{{Session::get('alert-success')}}</div>
</div>
@endif
<form action="{{ url('/user/update1', $produk->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name_produk">Name Produk</label>
        <input type="text" name="name_produk" class="form-control" value="{{$produk->name_produk}}" required>
        <p class="text-danger">{{ $errors->first('name_produk') }}</p>
    </div>
    <div class="form-group">
        <label for="status">status</label>
        <input type="text" name="status" class="form-control" value="{{$produk->status}}" required>
        <p class="text-danger">{{ $errors->first('status') }}</p>
    </div>
    <div class="form-group">
        <label for="diskon">diskon</label>
        <input type="text" name="diskon" class="form-control" value="{{$produk->diskon}}" required>
        <p class="text-danger">{{ $errors->first('diskon') }}</p>
    </div>
    <div class="form-group">
        <label for="harga">harga</label>
        <input type="number" name="harga" class="form-control" value="{{$produk->harga}}" required>
        <p class="text-danger">{{ $errors->first('harga') }}</p>
    </div>
    <div class="form-group">
        <label for="stok">stok</label>
        <input type="text" name="stok" class="form-control" value="{{$produk->stok}}" required>
        <p class="text-danger">{{ $errors->first('stok') }}</p>
    </div>
    <div class="form-group">
        <label for="desc">desc</label>
        <input type="text" id="description" name="desc" class="form-control" value="{{$produk->desc}}" required>
        <p class="text-danger">{{ $errors->first('desc') }}</p>
    </div>
    <div class="form-group">
        <label for="image">Foto Produk</label>
        <input type="file" name="image" class="form-control" value="{{ old('image') }}" required>
        <p class="text-danger">{{ $errors->first('image') }}</p>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-sm">Update</button>
    </div>
</form>

<script>
    //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
    CKEDITOR.replace('description');

</script>
@endsection
