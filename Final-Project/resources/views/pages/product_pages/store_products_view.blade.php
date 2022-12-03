@extends('layouts\main-layout')

@section('page-title')
    <title>Store Products Page</title>
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
                            <a href="{{ URL('/edit-store/' . $storeData->id) }}">Edit Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="author-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="author">
                        <img src="{{ $storeData->store_logo }}"
                            style="border-radius: 10%; max-width: 170px; max-height: 100px;">
                        <h4>{{ $storeData->store_name }}
                            <br>
                            <p style="color: darkmagenta;"> {{ $storeData->store_description }} </p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <br><br>
                    <div class="right-info">
                        <div class="row">
                            <div class="col-12">
                                <div class="main-button">
                                    <a href="{{ URL('/edit-store/' . $storeData->id) }}">Edit Store Data</a>
                                </div>
                            </div>
                        </div>
                        @if ($storeData->deleted_at)
                            <div class="row">
                                <div class="col-12">
                                    <div class="main-button">
                                        <a href="{{ URL('/restore-store/' . $storeData->id) }}">View Store</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <div class="main-button">
                                        <a href="{{ URL('/delete-store/' . $storeData->id) }}">Hide Store</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Discover Some Of Our <em>Products</em>.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($storeData->products as $product)
                    <div class="col-lg-3">
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="author">
                                        <img src="{{ $storeData->store_logo }}" alt=""
                                            style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                                    </span>
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
                                                <strong>{{ $product->category->category_name }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="line-dec"></div>
                                @if ($product->deleted_at)
                                    <div class="col-lg-12">
                                        <div class="border-button">
                                            <a href="{{ URL('/restore-product/' . $product->id) }}">View Product</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-12">
                                        <div class="border-button">
                                            <a href="{{ URL('/delete-product/' . $product->id) }}">Hide Product</a>
                                        </div>
                                    </div>
                                @endif
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
