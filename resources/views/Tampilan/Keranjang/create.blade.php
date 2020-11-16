@extends('dashbord')

@section('title', 'Create Keranjang')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="{{ url('/admin/create3') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="image/{{ $row->image }}" alt="{{ $row->produks->image }}" height="200" widht="40">
      <div class="card-body">
        <h5 class="card-title">{{ $row->produks->name_produk }}</h5>
        <p class="card-text">{{ $row->produks->desc }}</p>
        <p class="card-text" name="jumlah">{{ $row->jumlah }}</p>
        <div class="form-group">
          <label for="jumlah">jumlah</label>
          <input type="text" name="jumlah" class="form-control" value="{{$row->jumlah}}" required>
          <p class="text-danger">{{ $errors->first('jumlah') }}</p>
      </div>
        <button class="btn btn-primary btn-sm">Tambah</button>
      </div>
    </div>
  </form>
  <script>
    //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
    CKEDITOR.replace('description');
</script>
  @endsection
   <!-- PADA ADMIN LAYOUTS, TERDAPAT YIELD JS YANG BERARTI KITA BISA MEMBUAT SECTION JS UNTUK MENAMBAHKAN SCRIPT JS JIKA DIPERLUKAN -->
    <!-- LOAD CKEDITOR -->
