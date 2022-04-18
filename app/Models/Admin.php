<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use SoftDeletes;
    protected $table = "admins";
    protected $guarded = [];
    public $timestamps = true;

    public function  getImage($val){
        return ($val !== null) ? asset('assets/images/admin/profile/' . $val) : "";
    }
}
