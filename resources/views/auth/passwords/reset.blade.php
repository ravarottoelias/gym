@extends('auth.login-layout')

@section('content')
<div class="wrapper animated fadeInDown">
    <div class="panel overflow-hidden">
        <div class="padding-md _bg-grey-900 padding-40_ _no-margin-bottom font-size-20 _color-white _text-center text-uppercase_">
            <h3 class="text-center">Nueva contraseña</h3>
            <p class="text-center">Ingresa tu correo electrónico y crea una nueva contraseña.</p>
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
        <form id="loginform" method="post" action="{{ route('password.request') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="box-body padding-md">
                <div class="form-group">
                    <label for="email" class="col-md-12 control-label">Email</label>
                    <div class="col-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-12 control-label">Nueva contraseña</label>
                    <div class="col-12">
                        <input type="password" class="form-control" name="password" id="invalidPassword" required aria-describedby="invalidPassword">
                        @if ($errors->has('password'))
                        <div class="invalid-feedback" id="invalidPassword">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-12 control-label">Confirmar contraseña</label>
                    <div class="col-12">
                        <input type="password" class="form-control" name="password_confirmation" id="invalidPasswordConfirmation" required aria-describedby="invalidPasswordConfirmation">
                        @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback" id="invalidPasswordConfirmation">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> Confirmar</button>

            </div>
        </form>
        <div class="padding-md">
            <p>¿Ya tienes cuenta?<a href="/login">Iniciar sesión</a></p>
        </div>
    </div>
</div>
@endsection