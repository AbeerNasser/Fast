<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_supports', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->text('details');
            $table->unsignedBigInteger('delegate_id')->nullable();
            $table->foreign('delegate_id')->references('id')->on('delegates') ->onDelete('SET NULL');
            $table->enum('type_of_problem', ['a','b','c','d']);
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants') ->onDelete('SET NULL');
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
        Schema::dropIfExists('customer_supports');
    }
}
