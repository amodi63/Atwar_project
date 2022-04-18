<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Models extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'models';
    public $translatable = ['name'];

    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function products(){
        return $this->hasMany(Product::class, 'model_id');
    }
}
