<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailedCheckoutProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_checkout_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkout_id')->unsigned();
            $table->integer('checkout_process_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
            $table->foreign('checkout_process_id')->references('id')->on('checkout_processes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailed_checkout_processes');
    }
}
