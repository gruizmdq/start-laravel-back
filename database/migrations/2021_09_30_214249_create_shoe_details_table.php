<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoe_details', function (Blueprint $table) {
            $table->bigIncrements('id_shoe_detail');
            $table->unsignedBigInteger('id_shoe');
            $table->unsignedBigInteger('id_shoe_color_primary');
            $table->unsignedBigInteger('id_shoe_color_secondary');
            $table->unsignedBigInteger('number');
            $table->float('buy_price', 10, 2)->nullable($value = false);
            $table->float('sell_price', 10, 2)->nullable($value = false);
            $table->float('sell_price_distributor', 10, 2)->nullable($value = true)->default(0);
            $table->float('sell_price_tiendanube', 10, 2)->nullable($value = true)->default(0);
            $table->float('sell_price_mercadolibre', 10, 2)->nullable($value = true)->default(0);
            $table->bigInteger('stock');
            $table->boolean('is_tiendanube')->default($value = 0);
            $table->boolean('is_mercadolibre')->default($value = 0);
            $table->boolean('is_distributor')->default($value = 0);
            $table->timestamps();

            $table->foreign('id_shoe')->references('id_shoe')->on('shoes');
            $table->foreign('id_shoe_color_primary')->references('id_shoe_color')->on('shoe_colors');
            $table->foreign('id_shoe_color_secondary')->references('id_shoe_color')->on('shoe_colors');
            $table->unique(['id_shoe', 'id_shoe_color_primary', 'id_shoe_color_secondary', 'number']);

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
        Schema::dropIfExists('shoe_details');
    }
}
