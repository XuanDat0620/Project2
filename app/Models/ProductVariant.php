<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'pv_id';

    protected $fillable = [
        'p_id',
        'size_id',
        'color_id',
        'pv_price',
        'pv_stock',
        'pv_image',
        'pv_status'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class,'p_id', 'p_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }
}
