@extends('dashbord')

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
        <input type="number" name="phone_number" class="form-control" required>
        <p class="text-danger">{{ $errors->first('phone_number') }}</p>
    </div>
    <select name="penjual_id" class="form-control">
        <option value="">Pilih</option>
        @foreach ($user as $row)
        <option value="{{ $row->users->id}}" {{ old('penjual_id') == $row->users->id ? 'selected':'' }}>{{ $row->users->name }}</option>
        @endforeach
    </select>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Tambah</button>
    </div>
</form>
@endsection
