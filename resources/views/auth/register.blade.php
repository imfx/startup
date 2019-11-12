@extends('startup::layouts/master')

@section('app')
    
    <div class="d-flex align-items-center vh-100">
        <form class="form-signup" action="{{ route('register') }}" method="POST">         
            @csrf

            <h3 class="mt-4 mb-5 font-weight-bold text-center">Regístrate</h3>

            @include('startup::layouts/errors')

            <label for="name" class="sr-only">Nombre</label>
            {{ form()->text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nombre', 'required', 'autofocus']) }}

            <label for="email" class="sr-only">Email</label>
            {{ form()->email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required']) }}

            <label for="password" class="sr-only">Password</label>
            {{ form()->password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required']) }}

            <button type="submit" class="btn btn-primary btn-block mt-4">Registrarme</button>

            <div class="mt-4 text-center">
                Ya tienes cuenta?

                <a href="{{ route('login') }}">
                    Inicia Sesión
                </a>
            </div>

            <div class="mt-4 text-center text-muted">
                &copy; {{ date('Y') }} {{ env('APP_NAME') }}.
            </div>
        </form>
    </div>

@endsection
