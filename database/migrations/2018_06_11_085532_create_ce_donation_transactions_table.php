<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeDonationTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_donation_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doantions_id');
            $table->string('txn_id', 50);
            $table->decimal('txn_amount', 10, 2);
            $table->string('currency', 10);
            $table->string('txn_status', 50);
            $table->string('payment_source_id', 50)->nullable();
            $table->string('payment_object', 50)->nullable();
            $table->string('payment_brand', 20)->nullable();
            $table->string('payment_last4', 10)->nullable();
            $table->string('cvc_check', 10)->nullable();
            $table->string('failure_code', 100)->nullable();
            $table->string('failure_message', 10)->nullable();
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
        Schema::dropIfExists('ce_donation_transactions');
    }
}
