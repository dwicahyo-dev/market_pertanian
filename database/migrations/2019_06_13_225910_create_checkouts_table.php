<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('total_price', 11,2);
            $table->integer('qty');
            $table->string('seller_note')->nullable();
            $table->uuid('order_id');
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_arrived')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->boolean('is_sented')->default(0);
            $table->string('rejected_reason')->nullable();
            $table->string('courrier_code')->nullable();
            $table->string('courrier_name')->nullable();
            $table->string('service')->nullable();
            $table->string('service_description')->nullable();
            $table->integer('service_value')->nullable();
            $table->string('etd')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('address_histories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
