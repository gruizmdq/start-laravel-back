<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSucursalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_sucursal_items', function (Blueprint $table) {
            $table->id("id_stock_sucursal_item");
            $table->unsignedBigInteger('id_shoe_detail');
            $table->unsignedBigInteger('id_sucursal');
            $table->bigInteger('stock');
            $table->timestamps();

            $table->foreign('id_shoe_detail')->references('id_shoe_detail')->on('shoe_details');
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursals');
            $table->unique(['id_shoe_detail', 'id_sucursal']);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_sucursal_items');
    }
}
