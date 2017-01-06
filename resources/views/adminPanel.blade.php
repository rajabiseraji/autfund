@extends('layouts.app')

{{-- @include('head') --}}

@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('js/materialize.js') }}"></script> --}}


<script type="text/javascript">
    jQuery(document).ready(function($) {
    
        $('select').material_select();
  

        $('.collection-item .userLi').click(function(event) {
            event.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var userId = $(this).attr('id');
            console.log(userId);
            $.ajax({
                url: '/userDelete',
                type: 'post',
                dataType: 'html',
                data: {_token: CSRF_TOKEN, userId: userId},
            })
            .done(function() {
                Materialize.Toast('Deleted', 4000);
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
        });
    });

</script>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin panel</div>

                <div class="panel-body">
                     <ul id="userlist" class="collection with-header">
                        <li class="collection-header"><h4>Users list</h4></li>
                     @foreach($users as $user)
                        <li class="collection-item"><div class="userLi" id="{{$user->id}}">{{$user->name}}<a href="#!" class="secondary-content"><i class="material-icons">delete</i></a></div></li>
                    @endforeach
                  </ul>
                


                        <div class="row">
                            <div class="col s12 ">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Register</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col s4 control-label">Name</label>

                                                <div class="col s6">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col s4 control-label">E-Mail Address</label>

                                                <div class="col s6">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col s4 control-label">Password</label>

                                                <div class="col s6">
                                                    <input id="password" type="password" class="form-control" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm" class="col s4 control-label">Confirm Password</label>

                                                <div class="col s6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col s6 offset-s4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                  
                        </div>
                        <script src="/js/app.js"></script>
                        <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
                    <link rel="stylesheet" type="text/css" href="{{ asset('css/mine.css') }}">
                          <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
                          <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">


                  <a href="http://localhost/AUTINTERNATIONAL/import/" class="btn green btn-large col s8 offset-s2">Import a bunch of tables</a>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection

