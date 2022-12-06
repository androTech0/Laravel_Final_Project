@extends('layouts\main-layout')

@section('page-title')
    <title>Product Detalis Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/index') }}" class="active">Intro</a></li>
    </ul>
@endsection

@section('content')
    <div class="page-heading normal-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Liberty NFT Market</h6>
                    <h2>View Item Details</h2>
                    <span style="color:white;">{{ $product->store->store_name }} >
                        {{ $product->category->category_name }}</span>
                    {{-- <div class="buttons">
                        <div class="main-button">
                            <a href="explore.html">Explore Our Items</a>
                        </div>
                        <div class="border-button">
                            <a href="create.html">Create Your NFT</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-image">
                        <img src="{{ $product->product_image }}" alt="" style="border-radius: 20px;">
                    </div>
                </div>
                <div class="col-lg-5 align-self-center">
                    <span class="author">
                        <img src="{{ $product->store->store_logo }}" alt=""
                            style="max-width: 50px; border-radius: 50%;">
                        <h5>Owner Store: <br>
                            <p style="color:rgb(207, 176, 90);">{{ $product->store->store_name }}</p>
                        </h5>
                    </span>
                    <p style="font-size: 18px; font-weight:700;"><span
                            style="font-size: 18px; font-weight:700; color:palevioletred;">Item name :
                        </span> {{ $product->product_name }}</p>
                    <p style="font-size: 18px; font-weight:700;"><span
                            style="font-size: 18px; font-weight:700; color:palevioletred;">Item description :
                        </span> {{ $product->description }}</p>
                    <div class="row">
                        <div class="col-4">
                            @if ($product->active_discount)
                                <span class="bid">
                                    Current Price<br><strong>{{ $product->discount_price }} ETH</strong><br>
                                </span>
                            @else
                                <span class="bid">
                                    Current Price<br><strong>{{ $product->base_price }} ETH</strong><br>
                                </span>
                            @endif
                        </div>
                        <div class="col-4">
                            <span class="owner">
                                Base Price<br><strong>{{ $product->base_price }} ETH</strong><br>
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="ends">
                                Category<br><strong>{{ $product->category->category_name }}</strong><br>
                            </span>
                        </div>
                    </div>
                    <form id="contact" enctype="multipart/form-data"
                        action="{{ URL('/index/save-transaction/' . $product->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="quantity-text">Quentity :</label>
                                    <input type="number" min="1" max="20" name="quantity"
                                        class="quantity-text" value="1" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-5">
                                <button type="submit" id="form-submit" class="main-button">Bay Now</button>
                            </div>
                            <div class="col-lg-4">
                                @if (@isset($alert1))
                                    <p style="font-size: 18px; font-weight:700; color:rgb(34, 238, 61);">
                                        {{ $alert1 }}</p>
                                @elseif (@isset($alert2))
                                    <p style="font-size: 18px; font-weight:700; color:rgb(247, 15, 15);">
                                        {{ $alert1 }}</p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
