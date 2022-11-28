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
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('product_id');
            $table->integer('purchase_price');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_transactions');
    }
};
