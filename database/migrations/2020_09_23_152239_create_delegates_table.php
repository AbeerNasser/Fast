<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sn_img')->nullable();
            $table->string('sn_no')->nullable();
            $table->boolean('delegate_status')->default(0);
            $table->boolean('temp_disable')->default(0);
            $table->string('password');
            $table->string('phone');
            $table->float('total_price')->default(0);
            $table->text('notes')->nullable();
            $table->text('firebase_token')->nullable();
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
        Schema::dropIfExists('delegates');
    }
}
