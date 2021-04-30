<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_customer_id')->unsigned()->index();
            $table->bigInteger('to_customer_id')->unsigned()->index();
            $table->string('subject');
            $table->date('issue_date');
            $table->date('due_date');
            $table->string('due_notes')->nullable();
            $table->string('status');
            $table->bigInteger('currency_id')->unsigned()->index();
            $table->float('subtotal', 18, 6);
            $table->float('tax', 18, 6);
            $table->float('payment', 18, 6);
            $table->timestamp('paid_at')->nullable();
            $table->integer('created_by');
            $table->integer('modified_by');
            $table->timestamps();
            $table->foreign('currency_id')->references('id')->on('countries');
            $table->foreign('from_customer_id')->references('id')->on('customers');
            $table->foreign('to_customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
