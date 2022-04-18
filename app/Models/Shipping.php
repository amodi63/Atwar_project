<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use SoftDeletes;
    protected $table = 'shippings';

    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'postal_code',
        'phone',
        'country',
        'email',
        'created_at',
        'updated_at'
    ];
}
