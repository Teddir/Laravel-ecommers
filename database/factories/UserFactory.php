<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\hubungis;
use App\kategoris;
use App\keranjangs;
use App\kotas;
use App\mainmenus;
use App\messages;
use App\mod_banks;
use App\orders;
use App\penjuals;
use App\produks;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => 3,
        'name' => $faker->name,
        'avatar' => 'https://via.placeholder.com/150',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'alamat' => $faker->streetAddress,
        'phone_number' => 12345677,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(messages::class, function (Faker $faker) {
    do {
        $from = 1;
        $to = 2;
        $is_read = rand(0, 1);
    } while ($from === $to);

    return [
        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
        'is_read' => $is_read,
    ];
});
$factory->define(hubungis::class, function (Faker $faker) {
    return [
        'hubungi_id' => 2,
        'email' => $faker->unique()->safeEmail,
        'subjek' => $faker->slug,
        'message' => $faker->sentence,

    ];
});
$factory->define(produks::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'penjual_id' => 2,
        'name_produk' => $faker->name,
        'desc' => $faker->text,
        'harga' => 7800,
        'stok' => 8,
        'image' => 'https://via.placeholder.com/150',
    ];
});
$factory->define(orders::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'produk_id' => 1,
        'pesan' => $faker->text,
        'pengiriman' => 1,
        'subtotal' => $faker->buildingNumber,
        'invoice' => $faker->text,
        'status' => 1,
    ];
});
$factory->define(keranjangs::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'produk_id' => 1,
        'qty' => 4,

    ];
});
$factory->define(penjuals::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'name_toko' => $faker->name,
        'phone_number' => 756876725,
    ];
});
$factory->define(kotas::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'name_kota' => $faker->city,
        'onkos_kirim' => $faker->buildingNumber,
    ];
});
$factory->define(kategoris::class, function (Faker $faker) {
    return [
        'produk_id' => 1,
        'name_kategori' => $faker->name,
    ];
});

$factory->define(Chekouts::class, function (Faker $faker) {
    return [
        'produk_id' => 1,
        'keranjang_id' => 1,
        'name_kategori' => $faker->name,
    ];
});
