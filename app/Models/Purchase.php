<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use  SoftDeletes;
    protected $table = 'purchases';
    protected $fillable = ['customer_id', 'order_id', 'shipping_id', 'product_id', 'quantity', 'created_at','updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product ()
    {
        return $this->belongsTo(Product::class);
    }

    public function order ()
    {
        return $this->belongsTo(Order::class);
    }

    public function shipping ()
    {
        return $this->belongsTo(Shipping::class);
    }
}
