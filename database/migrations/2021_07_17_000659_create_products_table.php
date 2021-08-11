<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->string('product_name_eng');
            $table->string('product_slug_eng');
            $table->string('product_name_bang');
            $table->string('product_slug_bang');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tag_eng');
            $table->string('product_tag_bang');
            $table->string('product_size_eng')->nullable();
            $table->string('product_size_bang')->nullable();
            $table->string('product_color_eng');
            $table->string('product_color_bang');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('short_descp_eng');
            $table->string('short_descp_bang');
            $table->longText('long_descp_eng');
            $table->longText('long_descp_bang');
            $table->string('product_thumbnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('products');
    }
}
