<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_title', 100);
            $table->string('video_image', 100);
            $table->string('video_url', 100);
            $table->integer('topic_id');
            $table->text('source');
            $table->text('transcript');            
            $table->text('video_description');            
            $table->string('video_duration', 20);
            $table->string('related_videos', 20)->nullable(); 
            $table->tinyInteger('sort_order');
            $table->tinyInteger('is_featured')->default(2)->comment = "1-Featured 2-Default";
            $table->string('featured_image', 100)->nullable();
            $table->tinyInteger('featured_sort_order')->nullable();
            $table->tinyInteger('publish_status')->default(1)->comment = "1-Enabled 2-Disabled 3-Deleted";
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
        Schema::dropIfExists('ce_videos');
    }
}
