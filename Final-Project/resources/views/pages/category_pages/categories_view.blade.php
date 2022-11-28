@extends('layouts\main-layout')

@section('page-title')
    <title>Categories Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}" class="active">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
        <li><a href="{{ URL('/show-purchases') }}">Purchase Transactions</a></li>
        <li><a href="{{ URL('/logout') }}">Logout</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')
    <div class="page-heading normal-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Categories Management</h6>
                    <h2>View Details For Categories</h2>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="{{ URL('/create-category') }}">Create Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
