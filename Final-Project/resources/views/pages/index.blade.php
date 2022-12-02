@extends('layouts\main-layout')

@section('page-title')
    <title>Index Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/index') }}" class="active">Intro</a></li>
        <li><a href="{{ URL('/login') }}">Login</a></li>
        <li><a href="{{ URL('/signup') }}">Sign up</a></li>
    </ul>
@endsection

@section('content')
    @include('layouts\index-top-banner')
@endsection
