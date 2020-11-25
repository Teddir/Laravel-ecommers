@extends('dashbord_admin')

@section('title', 'Create Penjual')

@section('dashbord1')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<form action="{{ url('/admin/create2') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name_toko">Name Toko</label>
        <input type="text" name="name_toko" class="form-control" required>
        <p class="text-danger">{{ $errors->first('name_toko') }}</p>
    </div>
    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" required>
        <p class="text-danger">{{ $errors->first('phone_number') }}</p>
    </div>
    <select class="form-control @error('user_id') is-invalid  @enderror" id="user_id" name="user_id">
        <option selected disabled>Nama Penjual</option>
        @foreach ($user as $item)
      <option value="{{ $item->id }}">{{ $item->name  }}</option>
        @endforeach
      </select>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Tambah</button>
    </div>
</form>
@endsection
