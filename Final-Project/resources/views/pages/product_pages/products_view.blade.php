@extends('layouts\main-layout')

@section('page-title')
    <title>Stores Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}"class="active">Products</a></li>
        <li><a href="{{ URL('/show-purchase') }}">Purchase Transactions</a></li>
        <li><a href="{{ URL('/logout') }}">Logout</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')
    <div class="page-heading normal-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Products Management</h6>
                    <h2>View Details For Products</h2>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="{{ URL('/create-product') }}">Create Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
