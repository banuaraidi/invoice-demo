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
                    {!! Form::label('subject', 'Subject') !!}
                    {!! Form::text('subject', old('subject'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('issue_date', 'Issue Date') !!}
                    {!! Form::text('issue_date', old('issue_date'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('due_date', 'Due Date') !!}
                    {!! Form::text('due_date', old('due_date'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('fromCustomer', 'Customer (From)') !!}
                    {!! Form::text('fromCustomer', old('fromCustomer'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('toCustomer', 'Customer (To)') !!}
                    {!! Form::text('toCustomer', old('toCustomer'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="addressLine1">Address (Line 1)</label>
                    {!! Form::text('addressLine1From', old('addressLine1From'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-6">
                    <label for="addressLine1">Address (Line 1)</label>
                    {!! Form::text('addressLine1To', old('addressLine1To'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('cityFrom', old('cityForm'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('addressLine2', 'Address (Line 2)') !!}
                    {!! Form::text('addressLine2From', old('addressLine2From'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('cityTo', old('cityTo'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('addressLine2', 'Address (Line 2)') !!}
                    {!! Form::text('addressLine2To', old('addressLine2To'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    {!! Form::label('country', 'Country') !!}
                    {!! Form::text('countryFrom', old('countryFrom'), ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('country', 'Country') !!}
                    {!! Form::text('countryTo', old('countryTo'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection