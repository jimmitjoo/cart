<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->tinyInteger('status')->default(0);
            $table->text('note')->nullable();
            $table->integer('total_price')->default(0);
            $table->integer('total_discount')->default(0);
            $table->integer('total_price_before_discount')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('cart_uuid')->references('id')->on('carts');
            $table->integer('amount')->default(1);

            $table->string('title')->nullable();
            $table->integer('purchasable_id')->nullable();
            $table->string('purchasable_type')->nullable();

            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('price_before_discount')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
}