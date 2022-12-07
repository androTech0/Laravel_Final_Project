<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\PurchaseTransactionsData;
use App\Models\ProductData;

class PurchaseTransactionsController extends Controller
{
    public function showProductAnalysis()
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $products = ProductData::with('Store')
            ->withSum('PurchaseTransactions', 'purchase_price')
            ->withCount('PurchaseTransactions')
            ->withTrashed()
            ->get();

        $products = $products->map(function ($product) {
            $product->product_image = Storage::disk('public')->url($product->product_image);
            if ($product->purchase_transactions_sum_purchase_price > 0) {
                $product->average = $product->purchase_transactions_sum_purchase_price / $product->purchase_transactions_count;
            }
            if ($product->average <= 0) {
                $product->average = 0;
            }
            if ($product->purchase_transactions_sum_purchase_price == null) {
                $product->purchase_transactions_sum_purchase_price = 0;
            }
            if ($product->purchase_transactions_count == null) {
                $product->purchase_transactions_count = 0;
            }
            return $product;
        });

        // dd($products->toArray());

        return view('pages.purchase_transactions_pages.analysis_view')
            ->with('products', $products);
    }

    public function showPurchases($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchases = PurchaseTransactionsData::where('product_id', $id)
            ->with('Product')
            ->withTrashed()
            ->get();

        $purchases = $purchases->map(function ($purchase) {
            $purchase->created_at_date = date('y-m-d', strtotime($purchase->created_at));
            $purchase->created_at_time = date('H:i:s', strtotime($purchase->created_at));
            return $purchase;
        });

        // dd($purchases->toArray());
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

    public function savePurchase(Request $request, $id)
    {

        $product = ProductData::where('id', $id)->first();

        for ($x = 1; $x <= $request['quantity']; $x++) {
            $purchaseTransaction = new PurchaseTransactionsData();
            $purchaseTransaction->product_id = $product->id;
            if ($product->active_discount) {
                $purchaseTransaction->purchase_price = $product->discount_price;
            } else {
                $purchaseTransaction->purchase_price = $product->base_price;
            }

            $result = $purchaseTransaction->save();

            if ($result == false) {
                return redirect('/index/view-product-details/' . $id)->with('alert2', 'Failed transaction !!');
            }
        }

        return redirect('/index/view-product-details/' . $id)->with('alert1', 'Successful transaction !!');
    }

    public function editPurchase($id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchaseData = PurchaseTransactionsData::where('id', $id)
            ->withTrashed()
            ->first();

        return view('pages.purchase_transactions_pages.edit_purchase_transaction')->with('purchaseData', $purchaseData);
    }

    public function updatePurchase(Request $request, $id)
    {
        if (!Session::get('login')) {
            return view('pages.login_pages.login')->with('alert', 'you have login first');
        }

        $purchaseTransaction = PurchaseTransactionsData::where('id', $id)->withTrashed()->first();
        $purchaseTransaction->product_id = $request['product_id'];
        $purchaseTransaction->purchase_price = $request['purchase_price'];;

        if (
            $purchaseTransaction->product_id != null
            && $purchaseTransaction->purchase_price != null
        ) {

            $purchaseTransaction->save();

            return redirect('/show-purchases');
        } else {
            return redirect('/edit-purchase' . "/" . $id)->with('alert', 'Data mistake !!');
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