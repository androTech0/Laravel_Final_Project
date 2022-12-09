<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryData;
use App\Models\ProductData;

class CategoriesController extends Controller
{
    public function showCategories()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $categories = CategoryData::withCount('Products')->withTrashed()->get();
        $categories = $categories->map(function ($category) {
            $category->category_logo = Storage::disk('public')->url($category->category_logo);
            return $category;
        });

        // dd($store->toArray());
        return view('pages.category_pages.categories_view')->with('categories_data', $categories);
    }

    public function showTrashedCategory()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        $categories = CategoryData::onlyTrashed()->get();

        return view('\pages\categories-trash')->with('categories_data', $categories);
    }

    public function createCategory()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        return view('pages.category_pages.create_category');
    }

    public function saveCategory(Request $request)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $image = $request->file('logo-image');
        $path = 'uploads/categories-images/';
        $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . $name;

        Storage::disk('public')->put($fullPath, file_get_contents($image));

        $status = Storage::disk('public')->exists($fullPath);

        if ($status) {
            $category = new CategoryData();
            $category->category_name = $request['category_name'];
            $category->category_description = $request['category_description'];
            $category->category_logo = $fullPath;
            $category->save();

            return redirect('/show-categories');
        } else {
            return redirect('/create-category')->with('alert', 'Data mistake !!');
        }
    }

    public function editCategory($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $categoryData = CategoryData::where('id', $id)
            ->withTrashed()
            ->first();

        return view('pages.category_pages.edit_category')->with('categoryData', $categoryData);
    }

    public function updateCategory(Request $request, $id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $category = CategoryData::where('id', $id)->first();

        $image = $request->file('logo-image');
        if ($image != null) {
            $path = 'uploads/categories-images/';
            $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . $name;

            Storage::disk('public')->put($fullPath, file_get_contents($image));

            $status = Storage::disk('public')->exists($fullPath);

            if ($status) {
                $category->category_logo = $fullPath;
            } else {
                return redirect('/edit-category' . "/" . $id)->with('alert', 'Data mistake !!');
            }
        }

        $category->category_name = $request['category_name'];
        $category->category_description = $request['category_description'];

        if ($category->category_name != null && $category->category_description != null) {
            $category->save();
        }

        return redirect('/show-categories');
    }

    public function deleteCategory($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        ProductData::where('category_id', $id)->delete();
        $result = CategoryData::where('id', $id)->delete();

        return redirect('/show-categories');
    }

    public function restoreCategory($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        ProductData::onlyTrashed()->where('category_id', $id)->delete();
        $result = CategoryData::onlyTrashed()->where('id', $id)->restore();
        return redirect('/show-categories');
    }
}