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

    public function searchProduct(Request $request)
    {

        $categories = CategoryData::get();
        $stores = StoreData::get();

        if ($request['search_text']) {
            if ($request['category_id'] && $request['store_id']) {

                $products = ProductData::with('Category')->with('Store')
                    ->where('product_name', 'Like', "%{$request['search_text']}%")
                    ->where('category_id', '=', $request['category_id'])
                    ->where('store_id', '=', $request['store_id'])
                    ->get();

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
            } else if ($request['category_id']) {

                $products = ProductData::with('Category')->with('Store')
                    ->where('product_name', 'Like', "%{$request['search_text']}%")
                    ->where('category_id', '=', $request['category_id'])
                    ->get();

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
            } else if ($request['store_id']) {

                $products = ProductData::with('Category')->with('Store')
                    ->where('product_name', 'Like', "%{$request['search_text']}%")
                    ->where('store_id', '=', $request['store_id'])
                    ->get();

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
            } else {
                $products = ProductData::with('Category')->with('Store')
                    ->where('product_name', 'Like', "%{$request['search_text']}%")
                    ->get();

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
        } else {
            if ($request['category_id'] && $request['store_id']) {

                $products = ProductData::with('Category')->with('Store')
                    ->where('category_id', '=', $request['category_id'])
                    ->where('store_id', '=', $request['store_id'])
                    ->get();

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
            } else if ($request['category_id']) {

                $products = ProductData::with('Category')->with('Store')
                    ->where('category_id', '=', $request['category_id'])
                    ->get();

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
            } else if ($request['store_id']) {

                $products = ProductData::with('Category')->with('Store')
                    ->where('store_id', '=', $request['store_id'])
                    ->get();

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
            } else {
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
    }

    public function viewProductDetails($id)
    {

        $product = ProductData::where('id', $id)
            ->with('Category')
            ->with('Store')
            ->first();

        $product->product_image = Storage::disk('public')->url($product->product_image);
        $product->store->store_logo = Storage::disk('public')->url($product->store->store_logo);
        $product->category->category_logo = Storage::disk('public')->url($product->category->category_logo);

        // dd($product->toArray());

        return view('pages.user_pages.view_product_details')
        ->with('product',$product);
    }
}