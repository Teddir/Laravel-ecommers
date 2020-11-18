@extends('dashbord')

@section('title', 'Data Produk')

@section('dashbord1')
    
@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<a href="{{ url('/admin/tambah1') }}"><button class="btn btn-warning"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a>        
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name Produk</th>
      <th scope="col">Stok</th>
      <th scope="col">Status</th>
      <th scope="col">harga</th>
      <th scope="col">Tanggal Masuk</th>
      <th scope="col">image</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    <tr>
        @foreach ($produk as $item)
      <th scope="row">{{ $loop->iteration }}</th>    
      <td>{{ $item->name_produk }}</td>
      <td>{{ $subtotal }}</td>
      <td>{{ $item->status }}</td>
      <td>{{ $item->harga }}</td>
      <td>{{ $item->created_at }}</td>
      <td><img class="card-img-top" src="image/{{ $item->image }}" alt="{{ $item->image }}" height="200" widht="40"></td>
     
    </tr>
    @endforeach
    </tbody>
</table>
  

@endsection