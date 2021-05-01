<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDependencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_dependences', function (Blueprint $table) {
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('independent_item_id')->unsigned();
        });

        Schema::table('item_dependences', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('independent_item_id')->references('id')->on('items');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_dependences');
    }
}
