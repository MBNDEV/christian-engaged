<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_code', 10);
            $table->string('country_name', 100);
            $table->integer('phonecode');
            $table->string('currency_symbol', 10)->nullable();
            $table->tinyInteger('status_id')->default(1)->comment = "1-Enabled 2-Disabled";            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ce_donation_goals');
    }
}
