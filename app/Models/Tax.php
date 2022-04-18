<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tax extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'taxes';
    public $translatable = ['name'];

    protected $fillable = ['name', 'amount', 'created_at', 'updated_at'];
}
