<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_users', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 100);  
            $table->string('profile_picture', 100)->nullable();
            $table->tinyInteger('status')->default('2')->comment = "1-Enabled 2-Disabled 3-Deleted";
            $table->tinyInteger('user_type')->default('2')->comment = "1-Admin 2-Customer";
            $table->string('hash_token', 100)->nullable()->comment = "For user activation and Password reset";
            $table->rememberToken();
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
        Schema::dropIfExists('ce_users');
    }
}
