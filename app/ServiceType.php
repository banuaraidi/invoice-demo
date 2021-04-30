<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_types';
    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
        'created_by',
        'modified_by',
    ];
}
