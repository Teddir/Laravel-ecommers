@extends('dashbord')

@section('title', 'Create kategori')

@section('dashbord1')
    
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="{{ url('/admin/create2') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name_kategori">Name Kategori New</label>
        <input type="text" name="name_kategori" class="form-control" >
        <p class="text-danger">{{ $errors->first('name_kategori') }}</p>
    </div>
    <div class="form-group">
        <label for="">Name Kategori Along</label>
        <select name="" class="form-control">
            <option value="">None</option>
            @foreach ($kategori as $row)
            <option value="{{ $row->name_kategori }}" {{ old('name_produk') == $row->id ? 'selected':'' }}>{{ $row->nazme_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">Tambah</button>
    </div>
    @foreach ($kategori as $row)
    <a href="{{ url('/admin/edit2', $row->id) }}"><button class="btn btn-secondary btn-sm">Update</button></a>
    @endforeach
</form>

@endsection
