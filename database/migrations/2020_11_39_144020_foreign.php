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
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->cascedeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascedeOnDelete();
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs')->cascedeOnDelete();
        });
        
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->cascedeOnDelete();
        });

        Schema::table('keranjangdetails', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks')->cascedeOnDelete();
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs')->cascedeOnDelete();
        });


        Schema::table('finishs', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks')->cascedeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascedeOnDelete();
        });

        Schema::table('penjuals', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->cascedeOnDelete();
            $table->foreignId('produk_id')->nullable()->constrained('produks')->cascedeOnDelete();
            $table->foreignId('message_id')->nullable()->constrained('hubungis')->cascedeOnDelete();
        });

        Schema::table('hubungis', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->cascedeOnDelete();
        });

        Schema::table('chekouts', function (Blueprint $table) {
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjangs')->cascedeOnDelete();
            $table->foreignId('produk_id')->nullable()->constrained('produks')->cascedeOnDelete();
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
