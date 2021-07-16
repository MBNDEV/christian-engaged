<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeEmailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_email_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('message');
            $table->tinyInteger('publish_status')->default(2)->comment = "1-Enabled 2-Disabled";
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
        Schema::dropIfExists('ce_email_template');
    }
}
