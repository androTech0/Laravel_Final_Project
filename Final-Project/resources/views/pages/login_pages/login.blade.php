@extends('layouts\main-layout')

@section('page-title')
    <title>Login Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/index') }}">Intro</a></li>
        <li><a href="{{ URL('/login') }}" class="active">Login</a></li>
        <li><a href="{{ URL('/signup') }}">Sign up</a></li>
    </ul>
@endsection

@section('content')
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Login <em>Your Acount</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="contact" action="{{ URL('/login-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" placeholder="Ex. @alansmithee"
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Ex. Asd2&3!rq5d@1"
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Login Your
                                        Account</button>
                                </fieldset>
                            </div>
                            @if(\Session::has('alert'))
                                <div class="alert alert-danger">
                                    <div>{{Session::get('alert')}}</div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
