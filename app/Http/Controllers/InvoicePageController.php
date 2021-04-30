<?php

namespace App\Http\Controllers;

use DB;
use App\Customer;
use App\Invoice;
use Carbon\Carbon;
use App\Http\Requests\InvoiceSaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class InvoicePageController extends Controller
{
    protected $invoiceStatus = [
        'Draft' => 'Draft',
        'Unpaid' => 'Unpaid',
        'Paid' => 'Paid'
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = null;
        $request = Request::create('/api/invoices', 'GET');
        $response = Route::dispatch($request);
        if($response){
            $invoices = json_decode($response->getContent());
        }

        return view('invoice.index', ['invoices' => $invoices->data ?? []]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $invoice = null;
        $request = Request::create('/api/invoices/' . $id, 'GET');
        $response = Route::dispatch($request);
        if($response){
            $invoice = json_decode($response->getContent());
        }
        return view('invoice.show', [
            'invoice' => $invoice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $invoice = null;
        $request = Request::create('/api/invoices/' . $id, 'GET');
        $response = Route::dispatch($request);
        if($response){
            $invoice = json_decode($response->getContent());
        }
        $customers = Customer::pluck('name', 'id')->prepend('Please Select','')->toArray();

        return view('invoice.edit', [
            'customers' => $customers,
            'invoice' => $invoice,
            'invoiceStatus' => collect($this->invoiceStatus)->prepend('Please Select', '')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceSaveRequest $request, Invoice $invoice)
    {
        $input = $request->only([
            'subject',
            'issue_date',
            'due_date',
            'due_notes',
            'from_customer_id',
            'to_customer_id'
        ]);

        if(!empty($input['issue_date'])) {
            $input['issue_date'] = Carbon::createFromFormat('d/m/Y', $input['issue_date'])->format('Y-m-d');
        }

        if(!empty($input['due_date'])) {
            $input['due_date'] = Carbon::createFromFormat('d/m/Y', $input['due_date'])->format('Y-m-d');
        }

        $invoice->subject = $input['subject'];
        $invoice->issue_date = $input['issue_date'];
        $invoice->due_date = $input['due_date'];
        $invoice->due_notes = $input['due_notes'];
        $invoice->from_customer_id = $input['from_customer_id'];
        $invoice->to_customer_id = $input['to_customer_id'];

        $invoice->save();

        return redirect()->route('invoices.show', [$invoice->id])->with('message', 'Invoice ' . sprintf('%04d', $invoice->id) . ' has been updated');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return redirect()->route('invoice.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoiceId = sprintf('%04d', $invoice->id);
        
        DB::transaction(function() use ($invoice) {
            $invoice->items()->delete();
            $invoice->delete();
        });

        return redirect()->route('invoices.index')->with('message', 'Invoice ' . $invoiceId . ' has been deleted');
    }
}