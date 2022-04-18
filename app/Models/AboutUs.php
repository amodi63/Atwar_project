<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'about_us';
    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'created_at', 'updated_at'];
}
