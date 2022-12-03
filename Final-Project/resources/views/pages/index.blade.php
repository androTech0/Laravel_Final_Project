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
                    <div class="current-bid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mini-heading">
                                    <h4>Search For Products</h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <select name="Category" class="form-select" aria-label="Default select example"
                                        id="chooseCategory" onchange="this.form.click()">
                                        <option selected>Sort By: Latest</option>
                                        <option type="checkbox" name="option1" value="old">Sort By: Oldest</option>
                                        <option value="low">Sort By: Lowest</option>
                                        <option value="high">Sort By: Highest</option>
                                    </select>
                                </fieldset>
                            </div>
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="item">
                                        <div class="left-img">
                                            <img src="{{ $product->product_image }}" alt="">
                                        </div>
                                        <div class="right-content">
                                            <h4>{{ $product->product_name }}</h4>
                                            <P style="color: rgb(240, 184, 33);">Owner: {{ $product->store->store_name }}</p>
                                            <div class="line-dec"></div>
                                            @if ($product->active_discount)
                                                <h6>Current Price:<br> <em>{{ $product->discount_price }} ETH</em></h6>
                                                <h5 style="text-decoration:line-through; ">{{ $product->base_price }}ETH</h5>
                                            @else
                                                <h6>Current Price:<br> <em>{{ $product->base_price }} ETH</em></h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
