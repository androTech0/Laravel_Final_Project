<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id',true);
            $table->text('product_name')->unique();
            $table->text('description');
            $table->text('product_image');
            $table->integer('store_id');
            $table->integer('category_id');
            $table->integer('base_price');
            $table->integer('discount_price')->nullable();
            $table->boolean('active_discount')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories');
            $table->foreign('store_id')
                    ->references('id')
                    ->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
};