@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            {{ Breadcrumbs::render('invoices.edit', $invoice) }}
        </div>
    </div>
    @if($invoice)
    {!! Form::model($invoice, ['route' => ['invoices.update', $invoice->id], 'method' => 'put', 'class'=>'form', 'enctype' => 'multipart/form-data', 'id' => 'invoice-form']) !!}
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="text-right pr-2 pb-2">
                <button class='btn btn-outline-primary' type='submit' value='submit'>
                    <i class='fa fa-edit'> </i> Update
                </button>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    {!! Form::label('invoice_id', 'Invoice ID') !!}
                    {!! Form::text('invoice_id', sprintf('%04d', $invoice->id), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('issue_date', 'Issue Date') !!}
                    {!! Form::text('issue_date', date('d/m/Y', strtotime($invoice->issue_date)), ['class' => 'form-control date-param']) !!}
                    {!! $errors->first('issue_date', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('due_date', 'Due Date') !!}
                    {!! Form::text('due_date', $invoice->due_date ? date('d/m/Y', strtotime($invoice->due_date)) : '', ['class' => 'form-control']) !!}
                    {!! $errors->first('due_date', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', $invoiceStatus, old('status', $invoice->status), ['class' => 'form-control ' . $errors->first('status', 'error'), 'id' => 'status', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('status', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('subject', 'Subject') !!}
                    {!! Form::text('subject', $invoice->subject, ['class' => 'form-control']) !!}
                    {!! $errors->first('subject', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('due_notes', 'Due Notes') !!}
                    {!! Form::text('due_notes', $invoice->due_notes, ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('currency', 'Currency') !!}
                    {!! Form::select('currency', $currencyCode, old('currency', $invoice->currency_id), ['class' => 'form-control ' . $errors->first('currency', 'error'), 'id' => 'status', 'autocomplete' => 'off']) !!}
                    {!! $errors->first('currency', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('from_customer_id', 'Customer (From)') !!}
                    {!! Form::select('from_customer_id', $customers, old('from_customer_id', $invoice->from_customer_id), ['class' => 'form-control ' . $errors->first('from_customer_id', 'error'), 'id' => 'from_customer_id', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('from_customer_id', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('to_customer_id', 'Customer (To)') !!}
                    {!! Form::select('to_customer_id', $customers, old('to_customer_id', $invoice->to_customer_id), ['class' => 'form-control ' . $errors->first('to_customer_id', 'error'), 'id' => 'to_customer_id', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('to_customer_id', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="addressLine1">Address (Line 1)</label>
                    {!! Form::text('address_1_customer_from', $invoice->from_customer->master_address->address_1, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-6">
                    <label for="addressLine1">Address (Line 1)</label>
                    {!! Form::text('address_1_customer_to', $invoice->to_customer->master_address->address_1, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('city_customer_from', $invoice->from_customer->master_address->city, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('address_2_customer_from', 'Address (Line 2)') !!}
                    {!! Form::text('address_2_customer_from', $invoice->from_customer->master_address->address_2, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('city_customer_to', 'City') !!}
                    {!! Form::text('city_customer_to', $invoice->to_customer->master_address->city, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('address_2_customer_to', 'Address (Line 2)') !!}
                    {!! Form::text('address_2_customer_to', $invoice->to_customer->master_address->address_2, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('country', 'Country') !!}
                    {!! Form::text('country_customer_from', $invoice->from_customer->master_address->country->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('country_customer_from', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('country', 'Country') !!}
                    {!! Form::text('country_customer_to', $invoice->to_customer->master_address->country->name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('country_customer_to', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="row pt-4 pb-10">
        <div class="col-md-10 mx-auto">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">Item Type</th>
                    <th scope="col" class="text-center">Description</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Unit Price</th>
                    <th scope="col" class="text-center">Amount</th>
                    </tr>
                </thead>
                @foreach($invoice->items as $item)
                <tbody>
                    <tr>
                        <td style="width: 20%" class="pl-3">{{ $item->service->name }}</td>
                        <td style="width: 29%" class="pl-3">{{ $item->description }}</td>
                        <td style="width: 17%" class="text-right pr-3">{{ number_format($item->quantity, 2) }}</td>
                        <td style="width: 17%" class="text-right pr-3">{{ $invoice->currency->currency_code . ' ' . number_format($item->unit_price, 2) }}</td>
                        <td style="width: 17%" class="text-right pr-3">{{ $invoice->currency->currency_code . ' ' . number_format($item->quantity * $item->unit_price, 2) }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <table class="table  table-sm table-borderless">
                <tbody>
                    <tr>
                        <td style="width: 14%"></td>
                        <td style="width: 28%">&nbsp;</td>
                        <td style="width: 20%">&nbsp;</td>
                        <td style="width: 20%" class="text-right pr-3">Subtotal</td>
                        <td style="width: 20%" class="text-right pr-3">{{ $invoice->currency->currency_code . ' ' . number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 12%"></td>
                        <td style="width: 28%">&nbsp;</td>
                        <td style="width: 20%">&nbsp;</td>
                        <td style="width: 20%" class="text-right pr-3">Tax (10%)</td>
                        <td style="width: 20%" class="text-right pr-3">{{ $invoice->currency->currency_code . ' ' . number_format($invoice->tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 12%"></td>
                        <td style="width: 28%">&nbsp;</td>
                        <td style="width: 20%">&nbsp;</td>
                        <td style="width: 20%" class="text-right pr-3">Payments</td>
                        <td style="width: 20%" class="text-right pr-3">{{ $invoice->currency->currency_code . ' ' . $invoice->payment ? '-'.number_format($invoice->payment, 2) : '0.00' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 12%"></td>
                        <td style="width: 28%">&nbsp;</td>
                        <td style="width: 20%">&nbsp;</td>
                        <td style="width: 20%" class="text-right pr-3"><h5>Amount Due</h5></td>
                        <td style="width: 20%" class="text-right pr-3">{{ $invoice->currency->currency_code . ' ' .  number_format(($invoice->subtotal + $invoice->tax) - $invoice->payment, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('select[name=from_customer_id]').change(function(){
                $.get('/api/customer/' + $(this).val(), function( data ) {
                    $('input[name=address_1_customer_from]').val(data.address_1)
                    $('input[name=address_2_customer_from]').val(data.address_2)
                    $('input[name=city_customer_from]').val(data.city)
                    $('input[name=country_customer_from]').val(data.country)
                })
            });
            $('select[name=to_customer_id]').change(function(){
                $.get('/api/customer/' + $(this).val(), function( data ) {
                    $('input[name=address_1_customer_to]').val(data.address_1)
                    $('input[name=address_2_customer_to]').val(data.address_2)
                    $('input[name=city_customer_to]').val(data.city)
                    $('input[name=country_customer_to]').val(data.country)
                });
            });
        })
    </script>
@endsection