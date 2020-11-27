<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\TextUI\XmlConfiguration\UpdateSchemaLocationTo93;

class Foreign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->foreignId('penjual_id')->nullable()->constrained('penjuals')->onDelete('cascade')->onUpdate('cascade');
        });
        
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('keranjangdetails', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::table('finishes', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('penjual_id')->nullable()->constrained('penjuals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('keranjangdetail_id')->nullable()->constrained('keranjangdetails')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('penjuals', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('message_id')->nullable()->constrained('hubungis')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('hubungis', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
