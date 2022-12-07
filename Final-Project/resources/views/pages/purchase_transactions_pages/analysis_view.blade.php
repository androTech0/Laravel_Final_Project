@extends('layouts\main-layout')

@section('page-title')
    <title>Product Analysis Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
        <li><a href="{{ URL('/show-analysis') }}"class="active">Transactions Analysis</a></li>
        <li><a href="{{ URL('/logout') }}">Logout</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')
    <div class="page-heading normal-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Transactions Analysis</h6>
                    <h2>View Analysis For Products</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="author-page">
        <div class="container">
            @foreach ($products as $product)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="author">
                            <img src="{{ $product->product_image }}" alt=""
                                style="border-radius: 50%; max-width: 170px;">
                            <h4>{{ $product->product_name }} <br> <a
                                    href="{{ URL('/show-store-products/' . $product->store_id) }}">{{ $product->store->store_name }}</a>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-info">
                            <div class="row">
                                <div class="col-4">
                                    <div class="info-item">
                                        <i class="fa fa-arrow-trend-up"></i>
                                        <h6>{{ $product->average }} <em>Eth</em></h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info-item">
                                        <i class="fa fa-cart-shopping"></i>
                                        <h6>{{ $product->purchase_transactions_count }} <em>Bill</em></h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info-item">
                                        <i class="fa fa-ethereum"></i>
                                        <h6>{{ $product->purchase_transactions_sum_purchase_price }} <em>Eth</em></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="main-button">
                                        <a href="{{ URL('/show-transactions/{id}') }}">Show Transactions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            @endforeach
        </div>
    </div>
@endsection
