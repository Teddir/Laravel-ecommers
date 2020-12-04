@extends('dashbord_seller')
@section('dashbord1')
    <!-- Main Section -->
    <div class="container">
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Konfirmasi</h1>
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
            <form action="{{ url('/user/sendEmail') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="{{$user->email}}" value="{{$user->email}}" required>
                </div>
                <div class="form-group">
                <input hidden  type="text" class="form-control" id="name" name="nama" value="{{$user->name}}" placeholder="{{$user->name}}" required>
                </div>
                <div class="form-group">
                    <input hidden  type="text" class="form-control" id="judul" name="judul" value="Assalamualaikum Bapak/Ibu" placeholder="Assalamualaikum Bapak/Ibu" required>
                </div>
                <div class="form-group">
                <textarea hidden class="form-control" id="editor1" name="pesan" value="" placeholder="{{$user->finish}}"  required>
                </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Confirmasi</button>
                </div>
            </form>
        </div>
        <!-- /.content -->
    </section>
</div>
<script>
    CKEDITOR.replace( 'editor1' );
</script>
    <!-- /.main-section -->
@endsection