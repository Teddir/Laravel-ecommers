@extends('dashbord_admin')

@section('title', 'Update Penjual')

@section('dashbord1')

@if(\Session::has('alert-failed'))
<div class="alert alert-failed">
    <div>{{Session::get('alert-failed')}}</div>
</div>
@endif
@if(\Session::has('alert-success'))
<div class="alert alert-success">
    <div>{{Session::get('alert-success')}}</div>
</div>
@endif
<form action="{{ url('/admin/update2', $penjual->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name_toko">Name Toko</label>
        <input type="text" name="name_toko" class="form-control" value="{{$penjual->name_toko}}" required>
        <p class="text-danger">{{ $errors->first('name_toko') }}</p>
    </div>
    <div class="form-group">
        <label for="phone_number">phone_number</label>
        <input type="number" name="phone_number" class="form-control" value="{{$penjual->phone_number}}" required>
        <p class="text-danger">{{ $errors->first('phone_number') }}</p>
    </div>
    {{-- <select name="user_id" class="form-control">
        <option value="">Pilih</option>
        @foreach ($user as $row)
        <option value="{{ $row->name }}" {{ old('user_id') == $row->name ? 'selected':'' }}>{{ $row->users->name }}</option>
        @endforeach
    </select> --}}
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Update</button>
    </div>
</form>
@endsection
