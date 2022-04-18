<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'total_price', 'status', 'created_at','updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product ()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase ()
    {
        return $this->hasMany(Purchase::class);
    }

}
