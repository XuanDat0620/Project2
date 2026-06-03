<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $primaryKey = 'cate_id';

    protected $fillable = [
        'cate_name',
        'cate_desc',
        'cate_status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cate_id', 'cate_id');
    }
}
