@extends('dashbord')

@section('title', 'Data Order')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    
    <a href="{{ url('/admin/index9') }}"><button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true">   Buat Pesanan</i></button></a>     
<table class="table table-striped mt-1">
  <thead>
    <tr>
      
      <th scope="col">Subtotal</th>
      <th colspan="3"></th>       
    </tr>
  </thead>
  <tbody>
    @foreach ($produk as $item)
    {{-- {{dd($item)}} --}}
    <tr>
      <th>Rp.{{ $subtotal }}</th>
      <td>
       
      </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection