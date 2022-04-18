<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];


    public function cartProduct()
    {
        return $this->hasMany(Cart::class);
    }

    public function cartHasProduct($product_id)
    {
        return self::cartProduct()->where('product_id', $product_id)->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
