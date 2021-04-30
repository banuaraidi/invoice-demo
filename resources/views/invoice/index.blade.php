@extends('layouts.app')

@section('content')
<div class="modal delete-popup" id="delete_confirm">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-body">
                <p id="delete_modal_msg">Are you sure want to delete this record?</p>
                <div class="text-right">
                    <button type="button" class="btn btn-danger" id="delete-btn">Delete</button>
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
                </div>
            </div>            
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
        {{ Breadcrumbs::render('invoices.index') }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mx-auto">
            @if (Session::get('message'))
            <div class="alert alert-info" role="alert">
                {!! Session::get('message') !!}
            </div>
            @endif
            <div class="text-right pr-2 pb-2">
                <a class="ml-2 blue" href="{{ route("invoices.create")}}"><i class="fas fa-plus"></i> Create New</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">Invoice ID</th>
                    <th scope="col" class="text-center">Issue Date</th>
                    <th scope="col" class="text-center">Due Date</th>
                    <th scope="col" class="text-center">Subject</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Customer (From)</th>
                    <th scope="col" class="text-center">Customer (To)</th>
                    <th scope="col" class="text-center">Total</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                    <tr>
                        <td class='text-center'><a href="{{ route('invoices.show', $invoice->id )}}">{{ sprintf('%04d',$invoice->id) }}<a/></td>
                        <td class='text-center'>{{ date('d/m/Y', strtotime($invoice->issue_date)) }}</td>
                        <td class='text-center'>{{ date('d/m/Y', strtotime($invoice->due_date)) }}</td>
                        <td>{{ $invoice->subject }}</td>
                        <td>{{ $invoice->status }}</td>
                        <td>{{ $invoice->from_customer->name }}</td>
                        <td>{{ $invoice->to_customer->name }}</td>
                        <td class='text-right'>{{ $invoice->currency->currency_code . ' ' . number_format($invoice->subtotal + $invoice->tax, 2) }}</td>
                        <td class="text-right d-flex">
                            <a href="{{ route('invoices.edit', [$invoice->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="right" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('invoices.destroy', [$invoice->id]) }}" method="POST" class="form-delete">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <a href="#" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fas fa-trash"></i></a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">No data yet.</td>
                    </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".form-delete").on("click", function (e) {
                e.preventDefault();
                var $form = $(this);
                $("#delete_confirm").modal({backdrop: false, keyboard: false}).on("click", "#delete-btn", function () {
                    $('#delete_confirm').modal('toggle');
                    $form.submit();
                });
            });
        });
    </script>
@endsection
