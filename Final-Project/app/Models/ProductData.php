<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductData extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "products";
    protected $primaryKey = 'id';
    public function Store()
    {
        return $this->belongsTo('App\Models\StoreData','store_id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Models\CategoryData','category_id');
    }

    public function PurchaseTransactions()
    {
        return $this->hasMany('App\Models\PurchaseTransactionsData','product_id');
    }
}