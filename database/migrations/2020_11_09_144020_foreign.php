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
        Schema::table('kategoris', function (Blueprint $table) {
            $table->foreignId('main_id')->nullable()->constrained('mainmenus');
            $table->foreignId('parent_id')->nullable()->constrained('produks');

        }); 
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('produk_id')->nullable()->constrained('produks');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris');
            $table->foreignId('kota_id')->nullable()->constrained('kotas');
        });

        Schema::table('mod_banks', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
        
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->cascedeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users');
        });  

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('user_name')->nullable()->constrained('users');
            $table->foreignId('user_phone')->nullable()->constrained('users');
            $table->foreignId('user_alamat')->nullable()->constrained('users');
            $table->foreignId('kota_id')->nullable()->constrained('kotas'); //field ini akan merujuk ke table districts
    
        });   

        Schema::table('produks', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris');
        });   

        Schema::table('orderdetails', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('produk_id')->nullable()->constrained('produks');
        });   

        Schema::table('penjuals', function (Blueprint $table) {
            $table->foreignId('message_id')->nullable()->constrained('hubungis');
        });   

        Schema::table('hubungis', function (Blueprint $table) {
            $table->foreignId('hubungi_id')->nullable()->constrained('users');
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
