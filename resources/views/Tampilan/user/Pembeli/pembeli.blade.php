@extends('dashbord_seller')

@section('title', 'Data Customer')

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
      <th scope="col">Foto</th>
      <th scope="col">Customer</th>
      <th scope="col">Alamat</th>
      <th scope="col">Email</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($user as $item)
    {{-- {{dd($item)}} --}}
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td><img class="card-img-top" src="{{ $item->avatar }}" alt="{{ $item->avatar }}" height="200" widht="40"></td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->alamat }}</td>
      <td>{{ $item->email }}</td>
      <td>
        <form action="{{ url('/admin/destroy3', $item->id) }}" method="post">@method('delete') @csrf
        <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>
  

@endsection