@extends('dashbord_seller')

@section('title', 'Data Keranjang')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<a href="{{ url('/admin/index5') }}"><button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true">   ChekOut</i></button></a> {{--  ->pengembangan --}}    
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name Produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Jumlah Barang</th>
      <th scope="col">Subtotal</th>
      <th scope="col">Tanggal Masuk</th>
      <th scope="col">image</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($keranjang as $item)

    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      {{-- <td>{{ $item->produks->harga }}</td> --}}
      <td>{{ $item->qty }}</td>
      <td>{{ $subtotal }}</td>
      {{-- <td>{{ $item->produks->created_at }}</td> --}}
      {{-- <td><img class="card-img-top" src="image/{{ $item->produk_image }}" alt="{{ $item->produks->image }}" height="200" widht="40"></td> --}}
      <td>
        <form action="{{ url('/admin/update3', $item->id) }}" method="post"> @method('put') @csrf
          <label for="qty">
          <input type="text" name="qty" value="{{ $item->qty }}" placeholder="Tambah Barang ">
          </label>
          <button class="btn btn-warning"><i class="fa fa-wrench" aria-hidden="true"></i></button></a>
        </form>
        </td>
        <td><form action="{{ url('/admin/destroy3', $item->id) }}" method="post">@method('delete') @csrf
          <a href=""><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
        </form>
      </td>
    </tr>
    @endforeach
    <h5 class="btn btn-danger">Total Harga: Rp.{{ $subtotal }}</h5>
    </tbody>
</table>

@endsection