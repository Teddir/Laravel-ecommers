@extends('dashbord_seller')

@section('title', 'Create Produk')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
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
        <label for="status">Status</label>
        <select name="status" class="form-control" required>
            <option value="0" {{ old('status') == 'Publish' ? 'selected':'' }}>Publish</option>
            <option value="1" {{ old('status') == 'Draft' ? 'selected':'' }}>Draft</option>
        </select>
        <p class="text-danger">{{ $errors->first('status') }}</p>
    </div>
    <div class="form-group">
        <label for="diskon">diskon</label>
        <input type="number" name="diskon" class="form-control" required>
        <p class="text-danger">{{ $errors->first('diskon') }}</p>
    </div>
    <div class="form-group">
        <label for="desc">Deskripsi</label>

        <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
        <textarea name="desc" id="description" class="form-control">{{ old('desc') }}</textarea>
        <p class="text-danger">{{ $errors->first('desc') }}</p>
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
