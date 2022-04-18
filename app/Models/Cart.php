<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $table = 'carts';
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'status',
        'created_at',
        'updated_at'
    ];

    public function product ()
    {
        return $this->belongsTo(Product::class);
    }
}
