<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SocialLink extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'social_links';
    public $translatable = ['name'];

    protected $fillable = ['name', 'link', 'photo', 'created_at', 'updated_at'];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/socialLink/' . $val) : "";
    }
}
