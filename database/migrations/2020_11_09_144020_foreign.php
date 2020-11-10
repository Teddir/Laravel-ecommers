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
            $table->foreignId('id_main')->constrained('mainmenus');
        }); 
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_produk')->constrained('produks');
            $table->foreignId('id_kategori')->constrained('kategoris');
            $table->foreignId('id_kota')->constrained('kotas');
        });

        Schema::table('mod_banks', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users');
        });
        
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->foreignId('id_kategori')->constrained('kategoris')->cascedeOnDelete();
            $table->foreignId('id_user')->constrained('users');
        });  

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users');
        });   

        Schema::table('produks', function (Blueprint $table) {
            $table->foreignId('id_kategori')->constrained('kategoris');
        });   

        Schema::table('orderdetails', function (Blueprint $table) {
            $table->foreignId('id_order')->constrained('orders');
            $table->foreignId('id_produk')->constrained('produks');
        });   

        Schema::table('penjuals', function (Blueprint $table) {
            $table->foreignId('id_message')->constrained('hubungis');
        });   

        Schema::table('hubungis', function (Blueprint $table) {
            $table->foreignId('id_hubungi')->constrained('users');
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
