<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_for_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('salesperson_id')->nullable();
            $table->integer('productPrevious_id')->nullable();
            $table->unsignedBigInteger('catagory_id');
            $table->string('product_name');
            $table->integer('product_price');
            $table->string('product_description');
            $table->foreign('catagory_id')->references('id')->on('catagories')->onDelete('cascade');
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
        Schema::dropIfExists('products_for_sales');
    }
};
