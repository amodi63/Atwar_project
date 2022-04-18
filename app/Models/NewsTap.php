<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class NewsTap extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'news_taps';
    public $translatable = ['description'];

    protected $fillable = ['description', 'created_at', 'updated_at'];
}
