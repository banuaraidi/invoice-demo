<?php

// invoice

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('invoices.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Invoices', route('invoices.index'));
});

Breadcrumbs::for('invoices.create', function ($trail) {
    $trail->parent('invoices.index');
    $trail->push('Create', route('invoices.create'));
});

Breadcrumbs::for('invoices.show', function ($trail, $invoice) {
    $trail->parent('invoices.index');
    $trail->push(sprintf('%04d', $invoice->id) . ' ' . $invoice->status, route('invoices.show', $invoice->id));
});

Breadcrumbs::for('invoices.edit', function ($trail, $invoice) {
    $trail->parent('invoices.index');
    $trail->push('Edit ' . sprintf('%04d', $invoice->id), route('invoices.edit', $invoice->id));
});