@extends('layouts\main-layout')

@section('page-title')
    <title>Products Page</title>
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
        <div class="featured-explore">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-features owl-carousel">
                            <div class="item">
                                <div class="thumb">
                                    <img src="assets/images/featured-01.jpg" alt="" style="border-radius: 20px;">
                                    <div class="hover-effect">
                                        <div class="content">
                                            <h4>Triple Mutant Ape Bored</h4>
                                            <span class="author">
                                                <img src="assets/images/author.jpg" alt=""
                                                    style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                                                <h6>Liberty Artist<br><a href="#">@libertyart</a></h6>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <img src="assets/images/featured-02.jpg" alt="" style="border-radius: 20px;">
                                    <div class="hover-effect">
                                        <div class="content">
                                            <h4>Bored Ape Kennel Club</h4>
                                            <span class="author">
                                                <img src="assets/images/author.jpg" alt=""
                                                    style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                                                <h6>Liberty Artist<br><a href="#">@libertyart</a></h6>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <img src="assets/images/featured-03.jpg" alt="" style="border-radius: 20px;">
                                    <div class="hover-effect">
                                        <div class="content">
                                            <h4>Genesis Club by KMT</h4>
                                            <span class="author">
                                                <img src="assets/images/author.jpg" alt=""
                                                    style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                                                <h6>Liberty Artist<br><a href="#">@libertyart</a></h6>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <img src="assets/images/featured-04.jpg" alt="" style="border-radius: 20px;">
                                    <div class="hover-effect">
                                        <div class="content">
                                            <h4>Crypto Aurora Guy</h4>
                                            <span class="author">
                                                <img src="assets/images/author.jpg" alt=""
                                                    style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                                                <h6>Liberty Artist<br><a href="#">@libertyart</a></h6>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="discover-items">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Discover Some Of Our <em>Products</em>.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products_data as $product)
                    <div class="col-lg-3">
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span class="author">
                                        <img src="{{ $product->store->store_logo }}" alt=""
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
