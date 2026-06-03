<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'p_id';

    protected $fillable = [
        'p_name','p_image','p_desc','p_status','cate_id','brand_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'cate_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'p_id', 'p_id');
    }
}
