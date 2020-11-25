@extends('dashbord_admin')

@section('title', 'Detail Penjual')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif


{{-- {{dd($item)}} --}}
<div class="card">
  <div class="card-header">
    Akun
  </div>
  <div class="card-body">
    <img class="card-img-top" src="{{ $penjual->users[0]->avatar }}" alt="{{ $penjual->users[0]->avatar }}" height="300" widht="20">
  <h1 class="card-title">Name : {{$penjual->users[0]->name}}</h1>
  <h5 class="card-title">Toko : {{$penjual->name_toko}}</h5>
  <h5 class="card-title">Email : {{$penjual->users[0]->email}}</h5>
  <h5 class="card-title">Alamat : {{$penjual->users[0]->alamat}}</h5>
  <h5 class="card-title">Tanggal Buka : {{$penjual->users[0]->created_at}}</h5>
  <p class="card-text" style=""> Faedah.Store is faedah If You Buy Book In Here</p>
  </div>
</div>

@endsection