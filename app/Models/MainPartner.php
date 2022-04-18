<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainPartner extends Model
{
    use SoftDeletes;
    protected $table = 'main_partners';
    protected $fillable = [
        'link',
        'photo',
        'created_at',
        'updated_at'
    ];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/admin/mainPartners/' . $val) : "";
    }
}
