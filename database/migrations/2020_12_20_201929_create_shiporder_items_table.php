<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiporderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiporder_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ship_order_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamps();

            $table->foreign('ship_order_id')->references('id')->on('ship_orders');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shiporder_items');
    }
}
