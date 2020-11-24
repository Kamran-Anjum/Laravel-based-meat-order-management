<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('wp_order_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_cell');
            $table->string('billing_address');
            $table->string('shipping_address');
            $table->string('city');
            $table->string('post_code');
            $table->string('country');
            $table->string('total_amount');
            $table->string('status');
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
        Schema::dropIfExists('wp_orders');
    }
}
