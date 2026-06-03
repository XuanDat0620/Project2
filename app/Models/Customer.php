<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'cus_id';

    protected $fillable = [
        'cus_name',
        'cus_email',
        'cus_password',
        'cus_phone',
        'cus_gender',
        'cus_address',
        'cus_dob',
        'cus_status'
    ];

    protected $hidden = [
        'cus_password',
        'remember_token',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
