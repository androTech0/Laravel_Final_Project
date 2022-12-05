@extends('layouts\main-layout')

@section('page-title')
    <title>Index Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/index') }}" class="active">Intro</a></li>
        <li><a href="{{ URL('/login') }}">Login</a></li>
        <li><a href="{{ URL('/signup') }}">Sign up</a></li>
    </ul>
@endsection

@section('content')
    @include('layouts\index-top-banner')
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>View Some <em> Products</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="contact" action="{{ URL('/index/search-products') }}" method="get"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="current-bid">
                                    <div class="mini-heading">
                                        <h4>Search For Products</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <fieldset>
                                    <input type="text" name="search_text" class="searchText"
                                        placeholder="Type Something..." autocomplete="on">
                                </fieldset>
                            </div>
                            <div class="col-lg-3">
                                <fieldset>
                                    <div class="select">
                                        <select name="store_id">
                                            <option value="">Select Store</option>
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-3">
                                <fieldset>
                                    <div class="select">
                                        <select name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <button type="submit" class="border-button">Search</button>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <div class="current-bid">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="item">
                                                    <div class="left-img">
                                                        <img src="{{ $product->product_image }}" alt="">
                                                    </div>
                                                    <div class="right-content">
                                                        <h4>{{ $product->product_name }}</h4>
                                                        <br>
                                                        <span class="author">
                                                            <img src="{{ $product->store->store_logo }}" alt=""
                                                                style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                                                            <P style="color: rgb(255, 224, 140);">
                                                                Owner: {{ $product->store->store_name }}
                                                                <br>
                                                                Category: {{ $product->category->category_name }}
                                                            </p>
                                                        </span>
                                                        {{-- <div class="line-dec"></div> --}}
                                                        @if ($product->active_discount)
                                                            <h6>Current Price:<br> <em>{{ $product->discount_price }}
                                                                    ETH</em>
                                                            </h6>
                                                            <h5 style="text-decoration:line-through; ">
                                                                {{ $product->base_price }}ETH
                                                            </h5>
                                                        @else
                                                            <h6>Current Price:<br> <em>{{ $product->base_price }} ETH</em>
                                                            </h6>
                                                        @endif
                                                        <a href="{{ URL('/index/view-product-details/'.$product->id) }}"
                                                            style="font-size: 20px; color: palevioletred;">View
                                                            Details and Bay Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
