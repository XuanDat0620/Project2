<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'pay_id';

    protected $fillable = [
        'ord_id',
        'pm_id',
        'pay_amount',
        'pay_status',
        'pay_transaction_code',
        'pay_date'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'ord_id', 'ord_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'pm_id', 'pm_id');
    }
}
