<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'products';
    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'offer',
        'category_id',
        'company_id',
        'model_id',
        'sku',
        'quantity',
        'in_stock',
        'created_at',
        'updated_at'
    ];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/products/' . $val) : "";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function model()
    {
        return $this->belongsTo(Models::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
