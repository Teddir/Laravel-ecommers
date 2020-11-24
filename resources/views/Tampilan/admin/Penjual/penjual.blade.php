@extends('dashbord_admin')

@section('title', 'Data Penjual')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<a href="{{ url('/admin/tambah2') }}"><button class="btn btn-warning"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a>        
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name Toko</th>
      <th scope="col">Phone</th>
      <th scope="col">Tgl Dibuat</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($penjual as $item)
    {{-- {{dd($item)}} --}}
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>    
      <td>{{ $item->name_toko }}</td>
      <td>{{ $item->phone_number }}</td>
      <td>{{ $item->created_at }}</td>
      <td>
        <a href="{{ url('/admin/edit2', $item->id) }}"><button class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i></button></a> 
        <a href="{{ url('/admin/destroy2', $item->id) }}"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
        <a href="{{ url('/admin/destroy2', $item->id) }}"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>
  

@endsection