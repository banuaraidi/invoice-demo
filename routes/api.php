<?php

use App\Customer;
Use App\Invoice;
use App\Http\Resources\InvoiceCollection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$pageSize = 10;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/invoices', function (Request $request) use($pageSize) {
    $size = $request->input('size') ?: $pageSize;
    $data = Invoice::with('currency:id,currency_code', 'fromCustomer:id,name', 'toCustomer:id,name')->paginate($size);
    return new InvoiceCollection($data);
});

Route::get('/customer/{customerId}', function ($customerId) {

    $customer = Customer::with('masterAddress.country')->where('id','=', $customerId)->first()->toArray();

    $response = [
        'customer_name' => $customer['name'],
        'address_1' => $customer['master_address']['address_1'],
        'address_2' => $customer['master_address']['address_2'],
        'address_3' => $customer['master_address']['address_3'],
        'city' => $customer['master_address']['city'],
        'country' => $customer['master_address']['country']['name'],
    ];

    return $response;

})->where('customerId', '[0-9]+');

Route::get('/invoices/{invoiceId}', function ($invoiceId) {
    return Invoice::with(
        'currency:id,currency_code', 
        'fromCustomer.masterAddress.country', 
        'toCustomer.masterAddress.country',
        'items.service'
    )->where('invoices.id','=',$invoiceId)->first();
})->where('invoiceId', '[0-9]+');
