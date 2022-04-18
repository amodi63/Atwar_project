<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = ['imageable_id','imageable_type','photo','created_at','updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPhotoProduct($val)
    {
        return ($val !== null) ? asset('assets/images/admin/products/' . $val) : "";

    }
}
