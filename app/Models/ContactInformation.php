<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ContactInformation extends Model
{
    use HasTranslations, SoftDeletes;
    protected $table = "contact_information";

    public $translatable = ['address','description'];

    protected $fillable = ['address', 'phone', 'email', 'description', 'created_at', 'updated_at'];
}
