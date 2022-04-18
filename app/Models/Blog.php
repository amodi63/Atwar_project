<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'blogs';
    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'photo', 'created_at', 'updated_at'];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/blog/' . $val) : "";
    }
}
