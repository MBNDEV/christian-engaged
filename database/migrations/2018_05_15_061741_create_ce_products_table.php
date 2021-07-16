<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name', 100);
            $table->text('product_description');
            $table->integer('product_category_id');
            $table->string('product_image', 100);
            $table->decimal('price', 10, 2);
            $table->string('sku', 100)->nullable();
            $table->varchar('seo_keywords', 100);         // Added for Meta tags 
            $table->varchar('seo_slug', 100);              // Added for Meta tags 
            $table->varchar('seo_description', 100);         // Added for Meta tags 
            $table->varchar('seo_title', 100);              // Added for Meta tags 
            $table->tinyInteger('is_featured')->default(2)->comment = "1-Featured 2-Default";
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
        Schema::dropIfExists('ce_products');
    }
}
