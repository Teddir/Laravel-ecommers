@extends('dashbord')

@section('title', 'Data produk')

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
      <th scope="col">Keterangan</th>
      <th scope="col">Stok</th>
      <th scope="col">Terjual</th>
      <th scope="col">Diskon</th>
      <th scope="col">harga</th>
      <th scope="col">Tanggal Masuk</th>
      <th scope="col">image</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($produk as $item)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td>{{ $item->name_produk }}</td>
      <td>{{ $item->desc }}</td>
      <td>{{ $item->stok }}</td>
      <td>{{ $item->terjual }}</td>
      <td>{{ $item->diskon }}</td>
      <td>{{ $item->tgl_masuk }}</td>
      <td>{{ $item->harga }}</td>
      <td><img class="card-img-top" src="image/{{ $item->image }}" alt="{{ $item->image }}" height="80" widht="20"></td>
      <td>
        <a href="{{ route('produk.store', $item->id) }}"><button class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a>     
        <a href="{{ route('produk.edit', $item->id) }}"><button class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i></button></a>
        {{-- <td><form action="{{ route('produk.destroy', $item->id) }}" method="post">@method('delete') @csrf --}}
        <a href=""><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
        {{-- </form> --}}
      </td>
    </tr>
    @endforeach
    </tbody>
</table>


 {{-- ------------------------------------------------------------------------------------------------- create --}}

 <div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('produk.store') }}" method="POST">
            @method('post')
            @csrf
            <div class="form-group">
              <label for="nama"></label>
              <select class="form-control @error('nama') is-invalid  @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                <option selected disabled>Nama Siswa</option>
                @foreach ($produk as $item)
              <option value="{{ $item->nama }}">{{ $item->nama  }}</option>
                @endforeach
              </select>
            </div>
        
            <div class="form-group">
              <label for="desc"></label>
              <select class="form-control @error('desc') is-invalid  @enderror" id="desc" name="desc" value="{{ old('desc') }}">
                <option selected disabled>Pilih...</option>
                <option>produk</option>
                <option>sakit</option>
                <option>Izin</option>
                <option>Tanpa Keterangan</option>
              </select>
          </div>
        
        
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
</div>

  {{-- ------------------------------------------------------------------------------------------------- update --}}

  

@endsection