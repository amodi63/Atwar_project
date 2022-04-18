<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'services';
    public $translatable = ['title', 'short_description', 'description'];

    protected $fillable = ['title', 'short_description', 'description', 'photo', 'created_at', 'updated_at'];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/service/' . $val) : "";
    }
}
