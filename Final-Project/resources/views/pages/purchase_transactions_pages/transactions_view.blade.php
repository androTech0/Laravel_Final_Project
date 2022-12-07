@extends('layouts\main-layout')

@section('page-title')
    <title>Purchase Transactions Page</title>
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
    <div class="author-page">
        <div class="container">
            @foreach ($purchases_data as $transaction)
                <br>
                <div class="row">
                    <div class="col-lg-11">
                        <div class="right-info">
                            <div class="row">
                                <div class="col-3">
                                    <div class="info-item">
                                        <i class="fa fa-dollar"> Purchase</i>
                                        <h6>{{ $transaction->purchase_price }} <em>Eth</em></h6>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="info-item">
                                        <i class="fa fa-dollar"> Base Price</i>
                                        <h6>{{ $transaction->product->base_price }} <em>Eth</em></h6>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="info-item">
                                        <i class="fa fa-calendar"></i>
                                        <h6>{{ $transaction->created_at_date }} <em>Date</em></h6>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="info-item">
                                        <i class="fa fa-clock"></i>
                                        <h6>{{ $transaction->created_at_time }} <em>Time</em></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
