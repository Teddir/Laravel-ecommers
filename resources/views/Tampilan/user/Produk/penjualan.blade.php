@extends('dashbord_seller')

@section('title', 'Data Penjualan')

@section('dashbord1')


@foreach ($finish as $item)
@if (empty($item)){
<img src="{{asset('/image/Empty.png')}}" alt="">
}
@else

    
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
      <td>{{ $item->produks->name_produk }}</td>
      <td>{{ $item->qty  }}</td>
      <td>{{ number_format($item->produks->harga) }}</td>
      <td>{{ $item->status }}</td>
      <td>{{ number_format($subtotal = $item->produks->harga *  $item->qty)}}</td>
      <td>{{ $item->created_at }}</td>
      <td>
        <form action="{{ url('/user/destroy1', $item->id) }}" method="post">@csrf @method('delete')
          <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </form>
      </td>
      <td>
          <a href="{{ url('user/invoice', $item->user_id) }}"><button class="btn btn-warning"><i class="fa fa-info-circle" aria-hidden="true"></i></button></a>
      </td>
    </tr>
  </tbody>
</table>
<h5 class="card-title">Keterangan</h5>
<p class="card-text">status : 0 = Confirm, 1 = proses, 3 = finish</p>
</div>
</div>
{{-- <a class="btn btn-warning mt-3">Keutungan : {{number_format($untung = $subtotal +=+ $item->produks->harga)}} </a> --}}
@endif
@endforeach

@endsection
