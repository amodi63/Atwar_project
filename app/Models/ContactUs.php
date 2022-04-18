<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes;
    protected $table = 'contact_us';

    protected $fillable = ['customer_id', 'subject', 'name', 'email', 'description', 'created_at', 'updated_at'];
}
