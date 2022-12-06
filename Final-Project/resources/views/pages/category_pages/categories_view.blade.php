@extends('layouts\main-layout')

@section('page-title')
    <title>Categories Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}" class="active">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
        <li><a href="{{ URL('/show-transactions') }}">Purchase Transactions</a></li>
        <li><a href="{{ URL('/logout') }}">Logout</a></li>
        {{-- <li><a href="{{ URL('/prifile') }}">Profile</a></li> --}}
    </ul>
@endsection

@section('content')
    <div class="page-heading normal-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Categories Management</h6>
                    <h2>View Details For Categories</h2>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="{{ URL('/create-category') }}">Create Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="categories-collections">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="collections">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>Explore All <em>Categories</em> In Market.</h2>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="owl-collection owl-carousel">
                                    @foreach ($categories_data as $category)
                                        <div class="item">
                                            <img src="{{ $category->category_logo }}" alt="">
                                            <div class="down-content">
                                                <h4>{{ $category->category_description }}</h4>
                                                <span class="collection">Items In
                                                    Category:<br><strong>{{ $category->products_count }}</strong></span>
                                                <span
                                                    class="category">Category:<br><strong>{{ $category->category_name }}</strong></span>
                                                <br><br>
                                                <div class="border-button">
                                                    <a href="{{ URL('/edit-category/' . $category->id) }}">Edit
                                                        Category</a>
                                                </div>
                                                @if ($category->deleted_at)
                                                    <div class="border-button">
                                                        <a href="{{ URL('/restore-category/' . $category->id) }}">View
                                                            Category</a>
                                                    </div>
                                                @else
                                                    <div class="border-button">
                                                        <a href="{{ URL('/delete-category/' . $category->id) }}">Hide
                                                            Category</a>
                                                    </div>
                                                @endif
                                                <div class="main-button">
                                                    <a href="{{ URL('/show-category-products/' . $category->id) }}">Explore
                                                        Products</a>
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
        </div>
    </div>
@endsection
