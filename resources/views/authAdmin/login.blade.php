<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Online</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/dataTables.responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>

    <style type="text/css">
        div#content-inner-login {float:center; padding:0px 0 15px 0; margin:30px 50px 130px 50px; background-color:#fff;}
    </style>
</head>
<body>
            @if(\Session::has('alert'))

                <div class="alert alert-danger">

                    <div>{{Session::get('alert')}}</div>

                </div>

            @endif

            @if(\Session::has('alert-success'))

                <div class="alert alert-success">

                    <div>{{Session::get('alert-success')}}</div>

                </div>

            @endif

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       <form method="POST" action="{{ route('admin.login.submit') }}">
                                @csrf
                            <fieldset>
                                <div class="form-group">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>
                                    <input id="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"  placeholder="username" name="username" type="username" 
                                    value="{{ old('username') }}"required autofocus size="21" maxlength="20">
                                      @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" class="form-control" placeholder=" Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"name="password" type="password" size="21" maxlength="20">
                                     @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="LOGIN" class="btn btn-lg btn-success btn-block"/>
                                  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/dataTables.responsive.js')}}"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>
    
</body>
</html>