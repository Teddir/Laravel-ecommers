@extends('dashbord')

@section('title', 'Data Customer')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

<a href="{{ url('/admin/tambah4') }}"><button class="btn btn-warning"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a>        
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
      <td><img class="card-img-top" src="/image/{{ $item->image }}" alt="{{ $item->image }}" height="70" widht="40"></td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->alamat }}</td>
      <td>{{ $item->email }}</td>
      <td>
        <a href="{{ url('/admin/edit4', $item->id) }}"><button class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i></button></a> 
        <td><form action="{{ url('/admin/destroy4', $item->id) }}" method="post">@method('delete') @csrf
        <a href=""><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
        </form>
      </td>
    </tr>
    @endforeach
    </tbody>
</table>
  

@endsection