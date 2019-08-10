<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkout_id')->unsigned();
            $table->string('approval_code')->nullable();
            $table->string('bank')->nullable();
            $table->string('card_type')->nullable();
            $table->string('bill_key')->nullable();
            $table->string('biller_code')->nullable();
            $table->string('finish_redirect_url')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('masked_card')->nullable();
            $table->string('order_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('status_code')->nullable();
            $table->string('status_message')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->dateTime('transaction_expired');
            $table->dateTime('transaction_force_arrived');
            $table->dateTime('transaction_force_rejected');
            $table->dateTime('transaction_time')->nullable();
            $table->timestamps();

            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
