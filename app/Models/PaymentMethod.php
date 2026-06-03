<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $primaryKey = 'pm_id';

    protected $fillable = [
        'pm_name',
        'pm_desc',
        'pm_status'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'pm_id', 'pm_id');
    }
}
