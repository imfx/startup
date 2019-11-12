@extends('startup::layouts/master')

@section('app')
    
    <div class="d-flex align-items-center vh-100">
        <form class="form-signin" action="{{ route('login') }}" method="POST">
            @csrf

            <h3 class="mb-4 font-weight-bold text-center">Inicio de Sesión</h3>

            @include('startup::layouts/errors')

            <label for="email" class="sr-only">Email</label>
            {{ form()->email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required', 'autofocus']) }}

            <label for="password" class="sr-only">Password</label>
            {{ form()->password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required']) }}

            <a href="javascript:;">
                Olvidé mi contraseña
            </a>

            <button type="submit" class="btn btn-primary btn-block mt-4">Ingresar</button>

            @if (config('startup.registration_enabled'))
                <div class="mt-4 text-center">
                    Todavía no tienes cuenta?

                    <a href="{{ route('register') }}">
                        Regístrate
                    </a>
                </div>
            @endif

            <div class="mt-4 text-center text-muted">
                &copy; {{ date('Y') }} {{ env('APP_NAME') }}.
            </div>
        </form>
    </div>

@endsection
