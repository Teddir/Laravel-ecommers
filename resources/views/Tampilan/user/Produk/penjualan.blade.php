@extends('dashbord_seller')

@section('title', 'Data Produk')

@section('dashbord1')
    

@foreach ($finish as $item)
<div class="card" style="width: 50rem;">
  <div class="card-body">
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name Prooduk</th>
      <th scope="col">Jumlah Terjual</th>
      <th scope="col">Harga Barang</th>
      <th scope="col">Status</th>
      <th scope="col">Total</th>
      <th scope="col">Tanggal</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td>{{ $item->produks[0]->name_produk }}</td>
      <td>{{ $item->qty  }}</td>
      <td>{{ $item->produks[0]->harga }}</td>
      <td>{{ $item->status }}</td>
      <td>{{ number_format($item->keranjangdetails[0]->subtotal) }}</td>
      <td>{{ $item->created_at }}</td>
      <td>
      <td>
        <a href="{{ url('/user/destroy1', $item->id) }}"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
      </td>
    </tr>
  </tbody>
</table>
<h5 class="card-title">Keterangan</h5>
<p class="card-text">status : 0 = Confirm, 1 = proses, 3 = finish</p>
<a href="#" class="btn btn-primary">Confirm</a>
</div>
</div>
@endforeach

@endsection