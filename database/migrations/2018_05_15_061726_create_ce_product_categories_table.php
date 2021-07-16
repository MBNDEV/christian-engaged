<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_category', 255);
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
        Schema::dropIfExists('ce_product_categories');
    }
}
