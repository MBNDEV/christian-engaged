<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_leaders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('designation', 100);
            $table->string('profile_pic', 100);
            $table->string('short_description', 255);   
            $table->tinyInteger('status')->default('1')->comment = "1-Enabled 2-Disabled 3-Deleted";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ce_leaders');
    }
}
