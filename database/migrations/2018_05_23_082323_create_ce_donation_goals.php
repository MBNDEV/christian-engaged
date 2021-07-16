<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeDonationGoals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_donation_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('background_image', 100);
            $table->decimal('goal_amount', 10, 2);
            $table->tinyInteger('status')->default(1)->comment = "1-Enabled 2-Disabled 3-Deleted";
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
        Schema::dropIfExists('ce_donation_goals');
    }
}
