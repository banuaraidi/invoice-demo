@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            {{ Breadcrumbs::render('invoices.create') }}
        </div>
    </div>
    {!! Form::open(['route' => 'invoices.store', 'method' => 'post', 'class'=>'form', 'id'=>'invoice-form']) !!}
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="text-right pr-2 pb-2">
                <button class='btn btn-outline-primary' type='submit' value='submit'>
                    <i class='fa fa-save'> </i> Save
                </button>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    {!! Form::label('invoice_id', 'Invoice ID') !!}
                    {!! Form::text('invoice_id', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('issue_date', 'Issue Date') !!}
                    {!! Form::text('issue_date', old('issue_date'), ['class' => 'form-control date-param']) !!}
                    {!! $errors->first('issue_date', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('due_date', 'Due Date') !!}
                    {!! Form::text('due_date', old('due_date'), ['class' => 'form-control']) !!}
                    {!! $errors->first('due_date', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', $invoiceStatus, old('status'), ['class' => 'form-control ' . $errors->first('status', 'error'), 'id' => 'status', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('status', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('subject', 'Subject') !!}
                    {!! Form::text('subject', old('subject'), ['class' => 'form-control']) !!}
                    {!! $errors->first('subject', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('due_notes', 'Due Notes') !!}
                    {!! Form::text('due_notes', old('due_notes'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('currency', 'Currency') !!}
                    {!! Form::select('currency', $currencyCode, old('currency'), ['class' => 'form-control ' . $errors->first('currency', 'error'), 'id' => 'status', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('currency', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('from_customer_id', 'Customer (From)') !!}
                    {!! Form::select('from_customer_id', $customers, old('from_customer_id'), ['class' => 'form-control ' . $errors->first('from_customer_id', 'error'), 'id' => 'from_customer_id', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('from_customer_id', '<div class="error-message">:message</div>') !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('to_customer_id', 'Customer (To)') !!}
                    {!! Form::select('to_customer_id', $customers, old('to_customer_id'), ['class' => 'form-control ' . $errors->first('to_customer_id', 'error'), 'id' => 'to_customer_id', 'autocomplete' => 'off' ]) !!}
                    {!! $errors->first('to_customer_id', '<div class="error-message">:message</div>') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="address_1_customer_from">Address (Line 1)</label>
                    {!! Form::text('address_1_customer_from', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-6">
                    <label for="address_1_customer_to">Address (Line 1)</label>
                    {!! Form::text('address_1_customer_to', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    {!! Form::label('city_customer_from', 'City') !!}
                    {!! Form::text('city_customer_from', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('address_2_customer_from', 'Address (Line 2)') !!}
                    {!! Form::text('address_2_customer_from', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('city_customer_to', 'City') !!}
                    {!! Form::text('city_customer_to', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('address_2_customer_to', 'Address (Line 2)') !!}
                    {!! Form::text('address_2_customer_to', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('country_customer_from', 'Country') !!}
                    {!! Form::text('country_customer_from', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('country_customer_to', 'Country') !!}
                    {!! Form::text('country_customer_to', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
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