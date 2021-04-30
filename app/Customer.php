<?php

namespace App;

use App\CustomerAddress;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'created_by',
        'modified_by'
    ];

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }

    public function masterAddress()
    {
        // return $this->addresses()->where('is_master','=', 1);
        return $this->hasOne(CustomerAddress::class, 'customer_id')->where('is_master','=', 1);
    }
}
