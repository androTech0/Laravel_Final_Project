@extends('layouts\main-layout')

@section('page-title')
    <title>Create Product Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}"class="active">Products</a></li>
        <li><a href="{{ URL('/show-purchase') }}">Purchase Transactions</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Edit For <em>Your Product</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="contact" action="{{ URL('/update-product/' . $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="title" autocomplete="on"
                                        value="{{ $product->product_name }}" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="description">Product Description</label>
                                    <input type="text" name="description" id="description" autocomplete="on"
                                        value="{{ $product->description }}"required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="logo-image">Product Image</label>
                                    <input type="file" id="file" name="logo-image" />
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <label for="base_price">Product Price</label>
                                    <input type="number" name="base_price" id="description"
                                        value="{{ $product->base_price }}" autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" name="discount_price" id="description" autocomplete="on"
                                        value="{{ $product->discount_price }}" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="store_id">Select Store</label>
                                    <div class="select">
                                        <select name="store_id">
                                            @foreach ($storesData as $store)
                                                @if ($store->id = $product->store_id)
                                                    <option value="{{ $store->id }}" @selected(true)>
                                                        {{ $store->store_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="category_id">Select Category</label>
                                    <div class="select">
                                        <select name="category_id">
                                            @foreach ($categoriesData as $category)
                                                @if ($category->id = $product->category_id)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="active_discount">Active Discount</label>
                                    <br><br>
                                    @if ($product->active_discount)
                                        <input value="1" type="radio" name="active_discount" id="yes" checked>
                                        <input value="0" type="radio" name="active_discount" id="no">
                                    @else
                                        <input value="1" type="radio" name="active_discount" id="yes">
                                        <input value="0" type="radio" name="active_discount" id="no" checked>
                                    @endif
                                    <div class="switch">
                                        <label for="yes">Yes</label>
                                        <label for="no">No</label>
                                        <span></span>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-8">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Submit Your
                                        Update</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
