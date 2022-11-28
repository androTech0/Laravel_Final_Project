<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductData;
class ProductsController extends Controller
{
    public function showProducts()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $products = ProductData::withTrashed()->get();

        $products = $products->map(function ($product) {
            $product->product_image = Storage::disk('public')->url($product->product_image);
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
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        return view('pages.product_pages.create_category');
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

        $productData = ProductData::where('id', $id)
            ->first();

        return view('pages.product_pages.edit_category')->with('productData', $productData);
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
                return redirect('/update-product'."/".$id)->with('alert', 'Data mistake !!');
            }
        }

        $product->product_name = $request['product_name'];
        $product->description = $request['description'];
        $product->store_id = $request['store_id'];
        $product->category_id = $request['category_id'];
        $product->base_price = $request['base_price'];
        $product->discount_price = $request['discount_price'];

        if($product->product_name != null
            && $product->description != null
            && $product->store_id != null
            && $product->category_id != null
            && $product->base_price != null
            && $product->discount_price != null
            ){
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
}