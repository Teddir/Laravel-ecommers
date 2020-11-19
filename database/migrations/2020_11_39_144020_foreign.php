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
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris');
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
        
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks')->cascedeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs');
        });

        Schema::table('penjuals', function (Blueprint $table) {
            $table->foreignId('penjual_id')->nullable()->constrained('users');
            $table->foreignId('produk_id')->nullable()->constrained('produks');
            $table->foreignId('message_id')->nullable()->constrained('hubungis');
        });

        Schema::table('hubungis', function (Blueprint $table) {
            $table->foreignId('hubungi_id')->nullable()->constrained('users');
        });

        Schema::table('chekouts', function (Blueprint $table) {
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs');
            $table->foreignId('produk_id')->nullable()->constrained('produks');
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
