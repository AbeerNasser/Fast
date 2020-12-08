<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->boolean('flagord');
            $table->string('address');
            $table->float('order_price');
            $table->float('total_price');
            $table->integer('order_status')->default(0);
            $table->enum('payment_way', ['cash','vesa']);
            $table->text('notes')->nullable();
            $table->integer('date')->nullable();
            $table->timestamp('applay_date')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->unsignedBigInteger('delegate_id')->nullable();
            $table->foreign('delegate_id')->references('id')->on('delegates')->onDelete('SET NULL');
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('SET NULL');
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
        Schema::dropIfExists('orders');
    }
}
