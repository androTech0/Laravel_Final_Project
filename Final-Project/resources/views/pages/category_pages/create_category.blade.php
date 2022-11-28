@extends('layouts\main-layout')

@section('page-title')
    <title>Create Category Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}" class="active">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
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
                        <h2>Apply For <em>Your Category</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="contact" action="{{ URL('/save-category') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="category_name">Category Name</label>
                                    <input type="text" name="category_name" id="title"
                                        placeholder="Ex. Music,Digital art,Film,Games" autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="category_description">Category Description</label>
                                    <input type="text" name="category_description" id="title" autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="logo-image">Category Logo</label>
                                    <input type="file" id="file" name="logo-image" required/>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Submit Your
                                        Applying</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
