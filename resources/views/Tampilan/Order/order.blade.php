@extends('dashbord')

@section('title', 'Data Order')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    
    <a href="{{ route('produk.store') }}"><button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true">   Buat Pesanan</i></button></a>     
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">image</th>
      <th scope="col">Name Barang</th>
      <th scope="col">Harga</th>
      <th scope="col">Jumlah Barang</th>
      <th scope="col">Subtotal</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $item)
    {{-- {{dd($item)}} --}}
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td><img class="card-img-top" src="/image/{{ $item->image }}" alt="{{ $item->image }}" height="80" widht="20"></td>
      <td>{{ $item->produks->name_produk }}</td>
      <td>Rp.{{ $item->produks->harga }}</td>
      <td>{{ $item->keranjangs->qty }}</td>
      <th>Rp.{{ $subtotal }}</th>
      <td>
       
      </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection