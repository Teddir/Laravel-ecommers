@extends('dashbord')

@section('title', 'Data Keranjang')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name Produk</th>
      <th scope="col">Status</th>
      <th scope="col">Diskon</th>
      <th scope="col">Price</th>
      <th scope="col">Jumlah Item</th>
      <th scope="col">image</th>
      <th colspan="4"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($keranjang as $item)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td>{{ $item->produks->user_id }}</td>
      <td>{{ $item->produks->status }}</td>
      <td>{{ $item->produks->diskon }}</td>
      <td>{{ $item->produks->harga }}</td>
      <td>{{ $item->produks->price }}</td>
      <td>{{ $item->produks->created_at }}</td>
      <td><img class="card-img-top" src="image/{{ $item->image }}" alt="{{ $item->produks->image }}" height="200" widht="40"></td>
      <td>
        <td><form action="{{ url('/admin/update3', $item->id) }}" method="post">@method('put') @csrf
                  <td><label for="jumlah">
                    <input type="number" name="jumlah" id="jumlah" placeholder="{{ $item->jumlah }}" value="{{ $item->jumlah }}">
                  </label>
                </td>
              </td>
                <button class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
              </form>     
      </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection