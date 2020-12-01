@extends('dashbord_seller')

@section('title', 'Create Produk')

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
<form action="{{ url('/user/create1') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name_produk">Name Produk</label>
        <input type="text" name="name_produk" class="form-control" required>
        <p class="text-danger">{{ $errors->first('name_produk') }}</p>
    </div>  
    <div class="form-group">
        <label for="desc">Deskripsi</label>

        <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
        <textarea name="desc" id="description" class="form-control">{{ old('desc') }}</textarea>
        <p class="text-danger">{{ $errors->first('desc') }}</p>
    </div>
    <div class="form-group">
        <label for="harga">harga</label>
        <input type="number" name="harga" class="form-control" required>
        <p class="text-danger">{{ $errors->first('harga') }}</p>
    </div>
    <div class="form-group">
        <label for="stok">stok</label>
        <input type="text" name="stok" class="form-control" required>
        <p class="text-danger">{{ $errors->first('stok') }}</p>
    </div>
    <div class="form-group">
        <label for="image">Foto Produk</label>
        <input type="file" name="image" class="form-control" value="{{ old('image') }}" required>
        <p class="text-danger">{{ $errors->first('image') }}</p>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-sm">Tambah</button>
    </div>
</form>

<script>
    //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
    CKEDITOR.replace('description');

</script>
@endsection
<!-- PADA user LAYOUTS, TERDAPAT YIELD JS YANG BERARTI KITA BISA MEMBUAT SECTION JS UNTUK MENAMBAHKAN SCRIPT JS JIKA DIPERLUKAN -->
<!-- LOAD CKEDITOR -->
