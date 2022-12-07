@extends('layouts\main-layout')

@section('page-title')
    <title>Purchase Transactions Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}" >Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
        <li><a href="{{ URL('/show-analysis') }}"class="active">Transactions Analysis</a></li>
        <li><a href="{{ URL('/logout') }}">Logout</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')

@endsection
