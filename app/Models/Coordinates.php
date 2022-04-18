<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Coordinates extends Model
{
    use HasTranslations, SoftDeletes;
    protected $table = 'coordinates';
    public $translatable = ['address'];

    protected $fillable = ['address', 'longitude', 'latitude', 'created_at', 'updated_at'];
}
