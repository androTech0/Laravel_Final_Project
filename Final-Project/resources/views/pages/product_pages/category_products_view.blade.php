@extends('layouts\main-layout')

@section('page-title')
    <title>Category Products Page</title>
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
                    <h6>Store Products Management</h6>
                    <h2>View Details For Store Products</h2>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="{{ URL('/edit-category/' . $categoryData->id) }}">Edit Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="author-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Description Of <em>{{ $categoryData->category_name }}</em> Category.</h2>
                        <br>
                        <p style="color: darkmagenta;">{{ $categoryData->category_description }}</p>
                        <br><br>
                        <div class="line-dec"></div>
                        <h2>Discover Some Of {{ $categoryData->category_name }} <em>Products</em>.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categoryData->products as $product)
                    <div class="col-lg-3">
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <img src="{{ $product->product_image }}" alt="" style="border-radius: 20px;">
                                    <h4>{{ $product->product_name }}</h4>
                                </div>
                                <div class="col-lg-12">
                                    <div class="line-dec"></div>
                                    <div class="row">
                                        @if ($product->active_discount)
                                            <div class="col-6">
                                                <span>Discount Price: <br>
                                                    <strong>{{ $product->discount_price }}</strong></span>
                                            </div>
                                        @else
                                            <div class="col-6">
                                                <span>Base Price: <br> <strong>{{ $product->base_price }}</strong>
                                                    ETH</span>
                                            </div>
                                        @endif
                                        <div class="col-6">
                                            <span>Category: <br>
                                                <strong>{{ $categoryData->category_name }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="main-button">
                                        <a href="{{ URL('/edit-product/' . $product->id) }}">Edit Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
