<?php

use App\Country;
use App\Customer;
use App\CustomerAddress;
use App\Invoice;
use App\InvoiceItem;
use App\ServiceType;

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialData extends Migration
{
    private function initDataServiceTypes()
    {
        $serviceTypes = [
            [
                'code' => 'SERV',
                'name' => 'Service',
                'status' => 'Active',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'CONS',
                'name' => 'Consultation',
                'status' => 'Active',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        ServiceType::insert($serviceTypes);
    }

    private function initDataCountries()
    {
        $countries = [
            [
                'phone_code' => '+62',
                'iso_code' => 'ID',
                'currency_code' => 'IDR',
                'currency_symbol' => 'Rp',
                'name' => 'INDONESIA',
                'status' => 'Active',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'phone_code' => '+60',
                'iso_code' => 'MY',
                'currency_code' => 'MYR',
                'currency_symbol' => '',
                'name' => 'MALAYSIA',
                'status' => 'Active',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'phone_code' => '+65',
                'iso_code' => 'SG',
                'currency_code' => 'SGD',
                'currency_symbol' => '',
                'name' => 'SINGAPORE',
                'status' => 'Active',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'phone_code' => '+62',
                'iso_code' => 'AU',
                'currency_code' => 'AUD',
                'currency_symbol' => '',
                'name' => 'AUSTRALIA',
                'status' => 'Active',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Country::insert($countries);
    }

    private function initDataCustomer()
    {
        $customers = [
            [
                'name' => 'Discovery Designs',
                'email' => 'support@discoverydesign.com',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Barrington',
                'email' => 'support@barrington.com',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Customer::insert($customers);

        $addresses = [
            [
                'customer_id' => 1,
                'is_master' => true,
                'address_1' => '41 St Vincent Place',
                'address_2' => 'G1 2ER',
                'address_3' => '',
                'city' => 'Brisbane',
                'country_id' => 4,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'customer_id' => 2,
                'is_master' => true,
                'address_1' => '7 Greate Suffolk Street',
                'address_2' => 'SE1 0NS',
                'address_3' => '',
                'city' => 'Singapore',
                'country_id' => 3,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        CustomerAddress::insert($addresses);
    }

    private function initDataInvoice()
    {
        $invoice = [
            [
                'from_customer_id' => 1,
                'to_customer_id' => 2,
                'subject' => 'Sprint Marketing Campaign',
                'issue_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDay(),
                'due_notes' => 'upon receipt',
                'status' => 'Paid',
                'currency_id' => 3,
                'subtotal' => 28510,
                'tax' => 2851,
                'payment' => 31361,
                'paid_at' => Carbon::now(),
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'from_customer_id' => 2,
                'to_customer_id' => 1,
                'subject' => 'Demo data',
                'issue_date' => Carbon::now()->addDay(),
                'due_date' => Carbon::now()->addDay(3),
                'due_notes' => '',
                'status' => 'Draft',
                'currency_id' => 3,
                'subtotal' => 10000,
                'tax' => 1000,
                'payment' => 0,
                'paid_at' => null,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'from_customer_id' => 1,
                'to_customer_id' => 2,
                'subject' => 'Demo data',
                'issue_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDay(),
                'due_notes' => '',
                'status' => 'Unpaid',
                'currency_id' => 3,
                'subtotal' => 30000,
                'tax' => 3000,
                'payment' => 0,
                'paid_at' => null,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Invoice::insert($invoice);

        $invoiceItems = [
            [
                'invoice_id' => 1,
                'service_type_id' => 1,
                'description' => 'Design',
                'quantity' => 41,
                'unit_price' => 230,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'invoice_id' => 1,
                'service_type_id' => 2,
                'description' => 'Development',
                'quantity' => 57,
                'unit_price' => 330,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'invoice_id' => 1,
                'service_type_id' => 1,
                'description' => 'Meetings',
                'quantity' => 4.5,
                'unit_price' => 60,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'invoice_id' => 2,
                'service_type_id' => 2,
                'description' => 'Meetings',
                'quantity' => 2,
                'unit_price' => 5000,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], [
                'invoice_id' => 3,
                'service_type_id' => 2,
                'description' => 'Meetings',
                'quantity' => 3,
                'unit_price' => 10000,
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        InvoiceItem::insert($invoiceItems);
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->initDataServiceTypes();
        $this->initDataCountries();
        $this->initDataCustomer();
        $this->initDataInvoice();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
