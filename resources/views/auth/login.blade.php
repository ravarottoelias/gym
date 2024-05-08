<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>Gymie - Login</title>
    
    <!-- BEGIN CORE FRAMEWORK -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    {{-- <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/> --}}
    <!-- END CORE FRAMEWORK -->

    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- END PLUGIN STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/login.css') }}" rel="stylesheet"/>
    {{-- 
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet"/> --}}
    <!-- END THEME STYLES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <main>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <a class="navbar-brand" href="#">{{ Utilities::getSetting('gym_name')->first() }}</a>
            </nav>
          
            <div class="row d-flex justify-content-center align-items-center _mb-auto">
                <div class="col-lg-4 col-md-5 col-sm-12">
                    <div class="wrapper animated fadeInDown">
                        <div class="panel overflow-hidden">
                            <div class="padding-md _bg-grey-900 padding-40_ _no-margin-bottom font-size-20 _color-white _text-center text-uppercase_">
                                {{-- <img src="{{'/img/gym/' . Utilities::getGymLogo()}}" width="237" height="77"> --}}
                                <h3 class="text-center">Iniciar Sesión</h3>
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="loginform" method="post" action="{{ route('login') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="box-body padding-md">
                
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control input-lg" placeholder="Email"/>
                                    </div>
                
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control input-lg" placeholder="Password"/>
                                    </div>
                
                                    <div class="form-group margin-top-20">
                                        <div class="checkbox checkbox-theme">
                                            <input type="checkbox" id="remember" name="remember">
                                            <label for="remember">Remember Me</label>
                                        </div>
                                    </div>
                
                                    <button type="submit" class="btn bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> Entrar</button>
                                </div>
                            </form>
                            <div class="padding-md">
                                
                                    <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-12 _bg-img-login">
                    <img class="img-fluid" src="{{ asset('assets/img/web/login-bg.jpg') }}" alt="">
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center mt-auto">
        <div class="inner">
        <p>GymAdmin by <a href="https://rvtech.cloud">rvtech.cloud</a>.</p>
        </div>
    </footer>


<!-- Javascript -->
<script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/core.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- bootstrap validator -->
<script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

<!-- Login Validators -->
<script src="{{ URL::asset('assets/js/login.js') }}" type="text/javascript"></script>

<!-- gymie -->
<script src="{{ URL::asset('assets/js/gymie.js') }}" type="text/javascript"></script>
</body>
</html>