<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\PurchaseTransactionsData;

class PurchaseTransactionsController extends Controller
{
    public function showPurchases()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchases = PurchaseTransactionsData::withTrashed()->get();

        // dd($store->toArray());
        return view('pages.purchase_transactions_pages.transactions_view')->with('purchases_data', $purchases);
    }

    public function showTrashedPurchase()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        $purchases = PurchaseTransactionsData::onlyTrashed()->get();

        return view('\pages\purchases-trash')->with('purchases_data', $purchases);
    }

    public function createPurchase()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        return view('pages.purchase_transactions_pages.create_purchase_transaction');
    }

    public function savePurchase(Request $request)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchaseTransaction = new PurchaseTransactionsData();
        $purchaseTransaction->product_id = $request['product_id'];
        $purchaseTransaction->purchase_price = $request['purchase_price'];;

        if (
            $purchaseTransaction->product_id != null
            && $purchaseTransaction->purchase_price != null
        ) {

            $purchaseTransaction->save();

            return redirect('/show-purchases');
        } else {
            return redirect('/create-purchase')->with('alert', 'Data mistake !!');
        }
    }

    public function editPurchase($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchaseData = PurchaseTransactionsData::where('id', $id)
            ->first();

        return view('pages.purchase_transactions_pages.edit_purchase_transaction')->with('purchaseData', $purchaseData);
    }

    public function updatePurchase(Request $request, $id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchaseTransaction = PurchaseTransactionsData::where('id', $id)->first();
        $purchaseTransaction->product_id = $request['product_id'];
        $purchaseTransaction->purchase_price = $request['purchase_price'];;

        if (
            $purchaseTransaction->product_id != null
            && $purchaseTransaction->purchase_price != null
        ) {

            $purchaseTransaction->save();

            return redirect('/show-purchases');
        } else {
            return redirect('/edit-purchase'."/".$id)->with('alert', 'Data mistake !!');
        }
    }

    public function deletePurchase($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $result = PurchaseTransactionsData::where('id', $id)->delete();

        return redirect('/show-purchases');
    }

    public function restorePurchase($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }
        $result = PurchaseTransactionsData::onlyTrashed()->where('id', $id)->restore();
        return redirect('/show-purchases');
    }
}