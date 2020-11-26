<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Finishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qty')->default(1);
            $table->integer('status')->default(0)->comment('0 = confirm, 1 = prosses, 2 = finish');
            $table->integer('pengiriman')->default(0)->comment('0 = standar, 1 = kilat');
            $table->integer('produk_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('Order');
    }
}
