<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductData;
use App\Models\CategoryData;
use App\Models\StoreData;

class ProductsController extends Controller
{
    public function showProducts()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $products = ProductData::with('Category')->with('Store')->withTrashed()->get();
        //dd($products->toArray());
        $products = $products->map(function ($product) {
            $product->product_image = Storage::disk('public')->url($product->product_image);
            $product->store->store_logo = Storage::disk('public')->url($product->store->store_logo);
            return $product;
        });


        return view('pages.product_pages.products_view')->with('products_data', $products);
    }

    public function showTrashedProducts()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        $products = ProductData::onlyTrashed()->get();

        return view('\pages\products-trash')->with('products_data', $products);
    }

    public function createProduct()
    {

        $categories = CategoryData::withTrashed()->get();
        $stores = StoreData::withTrashed()->get();

        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        return view('pages.product_pages.create_product')
            ->with('categoriesData', $categories)
            ->with('storesData', $stores);
    }

    public function saveProduct(Request $request)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $image = $request->file('logo-image');
        $path = 'uploads/products-images/';
        $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . $name;

        Storage::disk('public')->put($fullPath, file_get_contents($image));

        $status = Storage::disk('public')->exists($fullPath);

        if ($status) {
            $product = new ProductData();
            $product->product_name = $request['product_name'];
            $product->description = $request['description'];
            $product->product_image = $fullPath;
            $product->store_id = $request['store_id'];
            $product->category_id = $request['category_id'];
            $product->base_price = $request['base_price'];
            $product->discount_price = $request['discount_price'];
            $product->active_discount = $request['active_discount'];
            $product->save();

            return redirect('/show-products');
        } else {
            return redirect('/create-product')->with('alert', 'Data mistake !!');
        }
    }

    public function editProduct($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        $categories = CategoryData::withTrashed()->get();
        $stores = StoreData::withTrashed()->get();
        $productData = ProductData::where('id', $id)
            ->first();

        return view('pages.product_pages.edit_product')
            ->with('product', $productData)
            ->with('categoriesData', $categories)
            ->with('storesData', $stores);
    }

    public function updateProduct(Request $request, $id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $product = ProductData::where('id', $id)->first();

        $image = $request->file('logo-image');
        if ($image != null) {
            $path = 'uploads/products-images/';
            $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . $name;

            Storage::disk('public')->put($fullPath, file_get_contents($image));

            $status = Storage::disk('public')->exists($fullPath);

            if ($status) {
                $product->product_image = $fullPath;
            } else {
                return redirect('/edit-product' . "/" . $id)->with('alert', 'Data mistake !!');
            }
        }

        $product->product_name = $request['product_name'];
        $product->description = $request['description'];
        $product->store_id = $request['store_id'];
        $product->category_id = $request['category_id'];
        $product->base_price = $request['base_price'];
        $product->discount_price = $request['discount_price'];
        $product->active_discount = $request['active_discount'];

        if (
            $product->product_name != null
            && $product->description != null
            && $product->store_id != null
            && $product->category_id != null
            && $product->base_price != null
            && $product->discount_price != null
        ) {
            $product->save();
        }


        return redirect('/show-products');
    }

    public function deleteProduct($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $result = ProductData::where('id', $id)->delete();

        return redirect('/show-products');
    }

    public function restoreProduct($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        $result = ProductData::onlyTrashed()->where('id', $id)->restore();
        return redirect('/show-products');
    }

    public function showStoreProducts($id)
    {
        $storeData = StoreData::where('id', $id)
            ->with('Products')
            ->with('Products.Category')
            ->first();

        $storeData->store_logo = Storage::disk('public')->url($storeData->store_logo);
        $storeData->products = $storeData->products->map(function ($product) {
            $product->product_image = Storage::disk('public')->url($product->product_image);
            $product->category->category_logo = Storage::disk('public')->url($product->category->category_logo);
            return $product;
        });

        // dd($storeData->toArray());

        return view('pages.product_pages.store_products_view')
            ->with('storeData', $storeData);
    }

    public function showCategoryProducts($id)
    {
        $categoryData = CategoryData::where('id', $id)
            ->with('Products')
            ->with('Products.Store')
            ->first();

        $categoryData->category_logo = Storage::disk('public')->url($categoryData->category_logo);
        $categoryData->products = $categoryData->products->map(function ($product) {
            $product->product_image = Storage::disk('public')->url($product->product_image);
            $product->store->store_logo = Storage::disk('public')->url($product->store->store_logo);
            return $product;
        });

        // dd($categoryData->toArray());

        return view('pages.product_pages.category_products_view')
            ->with('categoryData', $categoryData);
    }
}