<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'categories';
    public $translatable = ['name'];

    protected $fillable = ['name', 'is_active', 'created_at', 'updated_at'];
     public function products(){
         return $this->hasMany(Product::class);
     }
}
