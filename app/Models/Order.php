<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'ord_id';

    protected $fillable = [
        'cus_id',
        'u_id',
        'ord_code',
        'ord_receiver_name',
        'ord_receiver_phone',
        'ord_receiver_address',
        'ord_total_price',
        'ord_buy_date',
        'ord_shipping_fee',
        'ord_shipping_method',
        'ord_shipping_date',
        'ord_note',
        'ord_status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'cus_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'ord_id', 'ord_id');
    }
    
    public function payment()
    {
        return $this->hasOne(Payment::class, 'ord_id', 'ord_id');
    }
}
