<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('order_date');
            $table->string('email', 100);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->integer('billing_address_id');
            $table->integer('shipping_address_id');
            $table->decimal('order_amount', 10, 2);
            $table->tinyInteger('order_status')->default(0)->comment = "0 unpaid  1 Processing 2 dispatched 3 Delivered 4 Under Review 5 Cancelled 6 Error";
            $table->tinyInteger('payment_status')->default(0)->comment = "0 pending 1 paid 2 any payment error";
            $table->integer('shipstation_id')->nullable();
            $table->string('carrier', 100)->nullable();
            $table->string('service', 100)->nullable();
            $table->string('tracking_number', 100)->nullable();
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
        Schema::dropIfExists('ce_orders');
    }
}
