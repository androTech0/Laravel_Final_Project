<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductData;
use App\Models\CategoryData;
use App\Models\StoreData;

class UserShowController extends Controller
{
    public function index()
    {

        $categories = CategoryData::get();
        $stores = StoreData::get();
        $products = ProductData::with('Category')->with('Store')->get();

        $products = $products->map(function ($product) {
            $product->product_image = Storage::disk('public')->url($product->product_image);
            $product->store->store_logo = Storage::disk('public')->url($product->store->store_logo);
            $product->category->category_logo = Storage::disk('public')->url($product->category->category_logo);
            return $product;
        });

        // dd($products->toArray());

        return view('pages.index')
            ->with('categories', $categories)
            ->with('stores', $stores)
            ->with('products', $products);
    }
}