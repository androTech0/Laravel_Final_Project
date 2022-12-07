<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\StoreData;
use App\Models\ProductData;

class StoresController extends Controller
{
    public function showStores()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $stores = StoreData::withTrashed()->get();

        $stores = $stores->map(function ($store) {
            $store->store_logo = Storage::disk('public')->url($store->store_logo);
            return $store;
        });

        // dd($store->toArray());
        return view('pages.store_pages.stores_view')->with('stores_data', $stores);
    }

    public function showTrashedStores()
    {
        $stores = StoreData::onlyTrashed()->get();

        return view('pages.store_pages.stores-trash')->with('stores_data', $stores);
    }

    public function createStore()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        return view('pages.store_pages.create_store');
    }

    public function saveStore(Request $request)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $image = $request->file('logo-image');
        $path = 'uploads/store-logos/';
        $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . $name;

        Storage::disk('public')->put($fullPath, file_get_contents($image));

        $status = Storage::disk('public')->exists($fullPath);

        if ($status) {
            $store = new StoreData();
            $store->store_name = $request['store-name'];
            $store->store_description = $request['store-description'];
            $store->store_logo = $fullPath;
            $store->save();

            return redirect('/show-stores');
        } else {
            return redirect('/create-store')->with('alert', 'Data mistake !!');
        }
    }

    public function editStore($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $storeData = StoreData::where('id', $id)
            ->withTrashed()
            ->first();

        return view('pages.store_pages.edit_store')->with('storeData', $storeData);
    }

    public function updateStore(Request $request, $id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $store = StoreData::where('id', $id)->withTrashed()->first();

        $image = $request->file('logo-image');
        if ($image != null) {
            $path = 'uploads/store-logos/';
            $name =  time() + rand(1, 9999999999999) . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . $name;

            Storage::disk('public')->put($fullPath, file_get_contents($image));

            $status = Storage::disk('public')->exists($fullPath);

            if ($status) {
                $store->store_logo = $fullPath;
            } else {
                return redirect('/edit-store' . "/" . $id)->with('alert', 'Data mistake !!');
            }
        }

        $store->store_name = $request['store-name'];
        $store->store_description = $request['store-description'];

        if ($store->store_name != null && $store->store_description != null) {
            $store->save();
            return redirect('/show-stores');
        } else {
            return redirect('/edit-store' . "/" . $id)->with('alert', 'Data mistake !!');
        }
    }

    public function deleteStore($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        ProductData::where('store_id', $id)->delete();
        $result = StoreData::where('id', $id)->delete();

        return redirect('/show-stores');
    }

    public function restoreStore($id)
    {
        $result = StoreData::onlyTrashed()->where('id', $id)->restore();
        return redirect('/show-stores');
    }
}