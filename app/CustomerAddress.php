<?php

namespace App;

use App\Country;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer_addresses';
    protected $fillable = [
        'customer_id',
        'is_main_address',
        'address_1',
        'address_2',
        'address_3',
        'country_id',
        'created_by',
        'modified_by'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
