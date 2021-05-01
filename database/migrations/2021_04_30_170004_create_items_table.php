<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specifics');
            $table->float('availability_threshold');
            $table->boolean('is_expirydate_applicable');
            $table->boolean('is_item_dependent');
            $table->bigInteger('item_type_id')->unsigned();
            $table->bigInteger('unit_measure_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('item_type_id')->references('id')->on('item_types');    
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('unit_measure_id')->references('id')->on('unit_measures');    
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
