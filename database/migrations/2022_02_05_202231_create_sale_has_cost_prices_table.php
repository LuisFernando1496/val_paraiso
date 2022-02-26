<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleHasCostPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_has_cost_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->unsignedBigInteger('cost_price_id');
            $table->foreign('cost_price_id')->references('id')->on('cost_prices');
            $table->integer('quantity');
            $table->decimal('discount',8,2);
            $table->decimal('percent',8,2);
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
        Schema::dropIfExists('sale_has_cost_prices');
    }
}
