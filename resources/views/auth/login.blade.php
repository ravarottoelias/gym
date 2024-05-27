@extends('auth.login-layout')

@section('content')
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
        @if (session('confirmation-success'))
            <div class="alert alert-success">
                {{ session('confirmation-success') }}
            </div>
        @endif
        @if (session('confirmation-danger'))
            <div class="alert alert-danger">
                {!! session('confirmation-danger') !!}
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
            
                <p><a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></p>
            
        </div>
    </div>
</div>
@endsection