@extends('layouts\main-layout')

@section('page-title')
    <title>Create Store Page</title>
@endsection

@section('top-menu')
    <ul class="nav">
        <li><a href="{{ URL('/show-stores') }}" class="active">Stores</a></li>
        <li><a href="{{ URL('/show-categories') }}">Categories</a></li>
        <li><a href="{{ URL('/show-products') }}">Products</a></li>
        <li><a href="{{ URL('/show-analysis') }}">Transactions Analysis</a></li>
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
                        <h2>Apply For <em>Your Store</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form id="contact" action="{{URL('/save-store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="store-name">Store Name</label>
                                    <input type="text" name="store-name" id="title" placeholder="Ex. Neon Store"
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="store-description">Description For Store</label>
                                    <input type="text" name="store-description" id="description"
                                     autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset>
                                    <label for="logo-image">Store Logo</label>
                                    <input type="file" id="file" name="logo-image" />
                                </fieldset>
                            </div>
                            <div class="col-lg-8">
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
