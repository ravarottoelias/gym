@extends('auth.login-layout')

@section('content')
<div class="wrapper animated fadeInDown">
    <div class="panel overflow-hidden">
        <div class="padding-md _bg-grey-900 padding-40_ _no-margin-bottom font-size-20 _color-white _text-center text-uppercase_">
            {{-- <img src="{{'/img/gym/' . Utilities::getGymLogo()}}" width="237" height="77"> --}}
            <h3 class="text-center">Recuperación de contraseña</h3>
            <p class="text-center">¡Busquemos tu cuenta! Ingresa el correo electrónico con el que te registraste.</p>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fa-regular fa-envelope"></i>  {{ session('status') }}
            </div>
        @endif
        <form id="loginform" method="post" action="{{ route('password.email') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="box-body padding-md">
                <div class="form-group">
                    <input type="text" name="email" class="form-control input-lg" placeholder="Email"/>
                </div>

                <button type="submit" class="btn bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> Recuperar</button>

            </div>
        </form>
        <div class="padding-md">
            <p>¿Ya tienes cuenta?<a href="/login">Iniciar sesión</a></p>
        </div>
    </div>
</div>
@endsection