<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseTransactionsData extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "products";

    public function Product()
    {
        return $this->belongsTo('App\Models\ProductData');
    }
}
