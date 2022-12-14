<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoryData extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "categories";
    protected $primaryKey = 'id';
    public function Products()
    {
        return $this->hasMany('App\Models\ProductData','category_id')->withTrashed();
    }
}