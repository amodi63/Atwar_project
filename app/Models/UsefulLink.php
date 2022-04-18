<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class UsefulLink extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'useful_links';
    public $translatable = ['name'];

    protected $fillable = ['name', 'link', 'created_at', 'updated_at'];
}
