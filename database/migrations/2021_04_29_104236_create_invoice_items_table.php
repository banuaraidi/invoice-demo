<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->unsigned()->index();
            $table->bigInteger('service_type_id')->unsigned()->index();
            $table->string('description');
            $table->decimal('quantity');
            $table->float('unit_price', 18, 6);
            $table->integer('created_by');
            $table->integer('modified_by');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
