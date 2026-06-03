<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'ord_detail_id';

    protected $fillable = [
        'ord_id',
        'pv_id',
        'ord_detail_quantity',
        'ord_detail_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'ord_id', 'ord_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'pv_id', 'pv_id');
    }
}
