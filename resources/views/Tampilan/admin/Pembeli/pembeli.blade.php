@extends('dashbord_admin')

@section('title', 'Data Customer')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<a href="{{ url('/admin/tambah3') }}"><button class="btn btn-warning"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a>        
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
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
      <td>{{ $item->name }}</td>
      <td>{{ $item->alamat }}</td>
      <td>{{ $item->email }}</td>
      <td>
        <a href="{{ url('/admin/edit3', $item->id) }}"><button class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i></button></a> 
        <a href="{{ url('/admin/destroy3', $item->id) }}"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>
  

@endsection