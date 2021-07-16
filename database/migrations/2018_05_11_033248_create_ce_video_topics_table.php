<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeVideoTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_video_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_topic', 100);
            $table->tinyInteger('sort_order');
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
        Schema::dropIfExists('ce_video_topics');
    }
}
