<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoes', function (Blueprint $table) {
            $table->id("id_shoe");
            $table->string('code');
            $table->unsignedBigInteger('id_shoe_brand');
            $table->timestamps();

            $table->foreign('id_shoe_brand')->references('id_shoe_brand')->on('shoe_brands');

            $table->unique(['code', 'id_shoe_brand']);

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
        Schema::dropIfExists('shoes');
    }
}
