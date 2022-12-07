@extends('layouts\main-layout')

@section('page-title')
    <title>Stores Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}" class="active">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
        <li><a href="{{ URL('/show-analysis') }}">Transactions Analysis</a></li>
        <li><a href="{{ URL('/logout') }}">Logout</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')
    <div class="page-heading normal-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Stores Management</h6>
                    <h2>View Details For Stores</h2>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="{{ URL('/create-store') }}">Create Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="author-page">
        <div class="container">
            @foreach ($stores_data as $store)
                <br><br><br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="author">
                            <img src="{{ $store->store_logo }}" style="border-radius: 10%; max-width: 170px; max-height: 100px;">
                            <h4>{{ $store->store_name }}
                                <br>
                                <p style="color: darkmagenta;"> {{ $store->store_description }} </p>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <br><br>
                        <div class="right-info">
                            <div class="row">
                                <div class="col-12">
                                    <div class="main-button">
                                        <a href="{{ URL('/edit-store/' . $store->id) }}">Edit Store Data</a>
                                    </div>
                                </div>
                            </div>
                            @if ($store->deleted_at)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="main-button">
                                            <a href="{{ URL('/restore-store/' . $store->id) }}">View Store</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="main-button">
                                            <a href="{{ URL('/delete-store/' . $store->id) }}">Hide Store</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="main-button">
                                        <a href="{{ URL('/show-store-products/' . $store->id) }}">Show Store Products</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

{{-- <h2>* User Name : {{Session::get('username')}}.</h2>
    <h2>* Email : {{Session::get('email')}}</h2>
    <h2>* Status Login : {{Session::get('login')}}</h2> --}}
