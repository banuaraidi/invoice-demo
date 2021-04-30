<?php

namespace App;

use App\ServiceType;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
    protected $fillable = [
        'invoice_id',
        'service_type_id',
        'description',
        'quantity',
        'unit_price',
        'created_by',
        'modified_by'
    ];

    public function service()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
}
