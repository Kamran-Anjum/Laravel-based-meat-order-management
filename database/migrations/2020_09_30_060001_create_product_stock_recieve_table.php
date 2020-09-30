<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStockRecieveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_recieves', function (Blueprint $table) {
            $table->id();
            $table->integer('po_id');
            $table->integer('supplier_id');
            $table->integer('product_id');
            $table->integer('recieve_qty');
            $table->integer('recieved_by');
            $table->integer('rec_status');
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
        Schema::dropIfExists('product_stock_recieves');
    }
}
