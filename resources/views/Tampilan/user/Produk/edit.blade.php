@extends('dashbord_seller')

@section('title', 'Update kategori')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{ url('/admin/update1', $produk->id) }}" method="post" enctype="multipart/form-data">
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
        <label for="kategori_id">Kategori</label>

        <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
        <select name="kategori_id" class="form-control">
            <option value="">Pilih</option>
            @foreach ($kategori as $row)
            <option value="{{ $row->id }}" {{ old('kategori_id') == $row->id ? 'selected':'' }}>
                {{ $row->name_kategori }}</option>
            @endforeach
        </select>
        <p class="text-danger">{{ $errors->first('kategori_id') }}</p>
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
        <input type="text" name="desc" class="form-control" value="{{$produk->desc}}" required>
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
@endsection
