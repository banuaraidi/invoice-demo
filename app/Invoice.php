<?php

namespace App;

use App\Country;
use App\Customer;
use App\InvoiceItem;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'from_customer_id',
        'to_customer_id',
        'subject',
        'issue_date',
        'due_date',
        'due_notes',
        'status',
        'currency_id',
        'subtotal',
        'tax',
        'payment',
        'amount_due',
        'paid_at',
        'created_by',
        'modified_by'
    ];

    public function fromCustomer()
    {
        return $this->belongsTo(Customer::class, 'from_customer_id');
    }

    public function toCustomer()
    {
        return $this->belongsTo(Customer::class, 'to_customer_id');
    }

    public function currency()
    {
        return $this->belongsTo(Country::class, 'currency_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}
