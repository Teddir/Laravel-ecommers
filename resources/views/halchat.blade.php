  @extends('layouts.chat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach ($users as $user)
                    <li class="user" id="{{ $user->id }}">
                        @if ($user->unread)
                    
                        <span class="pending">{{ $user->unread }}</span>

                        @endif

                        <div class="media">
                            <div class="media-left">
                                <img src="{{ $user->avatar }}" alt="" class="media-project">
                            </div>
                            <div class="media-body">
                                <p class="name">{{ $user->name }}</p>
                                <p class="email">{{ $user->email}}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

            <div class="col-md-8" id="messages">
                
            </div>
        </div>
    </div>
</div>
<form action="">
<div class="col-lg-6">
<div class="input-group ">
    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
    </div>
  </div>
</div>
</form>
@endsection
