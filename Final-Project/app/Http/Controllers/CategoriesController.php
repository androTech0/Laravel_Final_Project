<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryData;
class CategoriesController extends Controller
{
    public function showCategories()
    {
        if (!Session::get('login')) {
            return view('\pages\login')->with('alert', 'you have login first');
        }

        $categories = CategoryData::withTrashed()->get();

        $categories = $categories->map(function ($category) {
            $category->category_logo = Storage::disk('public')->url($category->category_logo);
            return $category;
        });

        // foreach ($stores as $store) {
        //     $img_link = Storage::url($store->store_logo);
        //     $store->store_logo = $img_link;
        // }

        // dd($store->toArray());
        return view('\pages\category_view')->with('categories_data', $categories);
    }

    public function showTrashedCategory()
    {
        $categories = CategoryData::onlyTrashed()->get();

        return view('\pages\categories-trash')->with('categories_data', $categories);
    }

    public function createCategory()
    {
        if (!Session::get('login')) {
            return view('\pages\login')->with('alert', 'you have login first');
        }
        return view('pages.create_store');
    }

    public function saveCategory(Request $request)
    {
        if (!Session::get('login')) {
            return view('pages.login')->with('alert', 'you have login first');
        }

        $image = $request->file('logo-image');
        $path = 'uploads/categories-images';
        $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . $name;

        Storage::disk('public')->put($fullPath, file_get_contents($image));

        $status = Storage::disk('public')->exists($fullPath);

        if ($status) {
            $category = new CategoryData();
            $category->category_name = $request['store-name'];
            $category->category_logo = $fullPath;
            $category->save();

            return redirect('/show-categories');
        } else {
            return redirect('/create-category')->with('alert', 'Data mistake !!');
        }
    }

    public function editStore($id)
    {
        if (!Session::get('login')) {
            return view('\pages\login')->with('alert', 'you have login first');
        }

        $storeData = CategoryData::where('id', $id)
            ->first();

        return view('\pages\edit_store')->with('storeData', $storeData);
    }

    public function updateStore(Request $request, $id)
    {
        if (!Session::get('login')) {
            return view('\pages\login')->with('alert', 'you have login first');
        }

        $store = CategoryData::where('id', $id)->first();

        $image = $request->file('logo-image');
        if ($image != null) {
            $path = 'uploads/store-logos/';
            $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . $name;

            Storage::disk('local')->put($fullPath, file_get_contents($image));

            $status = Storage::disk('local')->exists($fullPath);

            if ($status) {
                $store->store_logo = $fullPath;
            } else {
                return redirect('/create-store')->with('alert', 'Data mistake !!');
            }
        }

        $store->store_name = $request['store-name'];
        $store->store_address = $request['store-address'];
        $store->save();

        return redirect('/show-stores');
    }

    public function deleteStore($id)
    {
        if (!Session::get('login')) {
            return view('\pages\login')->with('alert', 'you have login first');
        }

        $result = CategoryData::where('id', $id)->delete();

        return redirect('/show-stores');
    }

    public function restoreStore($id)
    {
        $result = CategoryData::onlyTrashed()->where('id', $id)->restore();
        return redirect('/show-stores');
    }
}