<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('donation_date');
            $table->integer('goal_id');
            $table->string('email', 100);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->decimal('donation_amount', 10, 2); 
            $table->tinyInteger('payment_status')->default(0)->comment = "0 pending 1 paid 2 any payment error";
            $table->string('phone', 50);
            $table->string('address_line_1', 255);
            $table->string('address_line_2', 255)->nullable();
            $table->integer('country_id');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('zipcode', 45);
            $table->tinyInteger('is_recurring')->default(0)->comment = "0-Onetime 1-Recurring";
            $table->string('stripe_customer_id', 100)->nullable();
            $table->date('next_payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ce_donations');
    }
}
