<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreData extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "stores";

    public function Products()
    {
        return $this->hasMany('App\Models\ProductData');
    }
}
