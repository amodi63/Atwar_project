<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use HasTranslations, SoftDeletes;
    protected $table = 'partners';
    public $translatable = ['name','description'];
    protected $fillable = [
        'name',
        'parent_id',
        'photo',
        'link',
        'description',
        'created_at',
        'updated_at'
    ];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/partners/' . $val) : "";
    }

    public function scopeParent($query)
    {
        return  $query -> whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return  $query -> whereNotNull('parent_id');
    }

    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
