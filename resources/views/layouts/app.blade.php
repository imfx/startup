@extends('startup::layouts/master')

@section('app')
	@include('startup::layouts/nav')

    @yield('content')
@endsection
