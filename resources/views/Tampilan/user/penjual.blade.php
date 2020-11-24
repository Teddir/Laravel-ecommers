@extends('dashbord_seller')

@section('title', 'Data Diri')

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
      <th scope="col">Avatar</th>
      <th scope="col">Name</th>
      <th scope="col">Name Toko</th>
      <th scope="col">Phone</th>
      <th scope="col">Alamat</th>
      <th scope="col">Email</th>
      <th scope="col">Tgl Dibuat</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($penjual as $item)
    {{-- {{dd($item)}} --}}
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td><img class="card-img-top" src="{{ $item->users[0]->avatar }}" alt="{{ $item->users[0]->avatar }}" height="200" widht="40"></td>
      <td>{{ $item->users[0]->name }}</td>
      <td>{{ $item->name_toko }}</td>
      <td>{{ $item->phone_number }}</td>
      <td>{{ $item->users[0]->alamat }}</td>
      <td>{{ $item->users[0]->email }}</td>
      <td>{{ $item->created_at }}</td>
      <td>
        <a href="{{ url('/user/edit2', $item->id) }}"><button class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i></button></a> 
        <form action="{{ url('/user/destroy2', $item->id) }}" method="post">@method('delete') @csrf
        <a href=""><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
        </form>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>
  

@endsection