<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'phone_code',
        'iso_code',
        'currency_code',
        'currency_symbol',
        'name',
        'status',
        'created_by',
        'modified_by'
    ];
}
