<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_cms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_title', 100);
            $table->text('page_content');
            $table->string('page_url', 100);
            $table->string('meta_title', 100);
            $table->string('meta_keyword', 100);
            $table->text('meta_description');
            $table->tinyInteger('publish_status')->default(2)->comment = "1-Enabled 2-Disabled 3-Deleted";
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
        Schema::dropIfExists('ce_cms');
    }
}
