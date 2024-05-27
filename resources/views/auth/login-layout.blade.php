<!DOCTYPE html>
<html lang="es">
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
    <!-- END CORE FRAMEWORK -->

    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- END PLUGIN STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/login.css') }}" rel="stylesheet"/>
    <!-- END THEME STYLES -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="d-flex flex-column h-100">
    <main>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <a class="navbar-brand" href="{{ route('login') }}">{{ Utilities::getSetting('gym_name') }}</a>
            </nav>
          
            <div class="row d-flex justify-content-center align-items-center _mb-auto">
                <div class="col-lg-4 col-md-5 col-sm-12">
                    @yield('content')
                </div>
                <div class="col-lg-8 col-md-7 col-sm-12 _bg-img-login">
                    <img class="img-fluid" src="{{ asset('assets/img/web/login-bg.jpg') }}" alt="">
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center mt-auto">
        <div class="inner">
        <div class="d-flex justify-content-center align-items-center height-50 text-content">GymAdmin by <a href="https://rvtech.cloud" class="ml-2"> rvtech.cloud</a></div>
        </div>
    </footer>


    <!-- Javascript -->
    <script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/login.js') }}" type="text/javascript"></script>

</body>
</html>