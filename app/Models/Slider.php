<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $fillable = ['photo', 'created_at', 'updated_at'];


    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/sliders/' . $val) : "";
    }
}
