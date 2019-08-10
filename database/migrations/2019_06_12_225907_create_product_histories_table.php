<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_real_id')->unsigned();
            $table->string('thumbnail');
            $table->integer('agriculture_id')->unsigned();
            $table->integer('quality_id')->unsigned();
            $table->string('product_name');
            $table->integer('store_id')->unsigned();
            $table->decimal('price', 11, 2);
            $table->integer('stock');
            $table->text('description');
            $table->timestamps();

            $table->foreign('agriculture_id')->references('id')->on('agricultures')->onDelete('cascade');
            $table->foreign('quality_id')->references('id')->on('qualities')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_histories');
    }
}
