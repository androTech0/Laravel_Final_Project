@extends('layouts\main-layout')

@section('page-title')
    <title>Sign Up Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/index') }}">Intro</a></li>
        <li><a href="{{ URL('/login') }}">Login</a></li>
        <li><a href="{{ URL('/signup') }}" class="active">Sign up</a></li>
    </ul>
@endsection

@section('content')
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Create <em>Your Acount</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="contact" action="{{ URL('/submit-account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="username">Your Username</label>
                                    <input type="username" name="username" id="username" placeholder="Ex. @alansmithee"
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="email">Gmail</label>
                                    <input type="email" name="email" id="email" placeholder="Ex. username@gmail.com"
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
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="phone-number">Phone Number</label>
                                    <input type="text" name="phone-number" id="phone_number"
                                        placeholder="Ex. 970-59-944-3987" autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="visa-card">Visa Card</label>
                                    <input type="text" name="visa-card" id="visa_card"
                                        placeholder="Ex. XXXX-XXXX-XXXX-XXXX" autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="user-image">Your Image</label>
                                    <input type="file" id="file" name="user-image" required />
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Submit Your
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
