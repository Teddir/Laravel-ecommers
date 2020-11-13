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
        'id' => $faker->buildingNumber,
        'name' => $faker->name,
        'avatar' => 'https://via.placeholder.com/150',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone_number' => $faker->phoneNumber,
        'alamat' => $faker->streetAddress,
        // 'id_kota' => $faker->buildingNumber,
        // 'id_produk' => $faker->buildingNumber,
        // 'id_kategori' => $faker->buildingNumber,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(messages::class, function (Faker $faker) {
    do
    {
        $from = rand(1, 30);
        $to = rand(1, 30);
        $is_read = rand(0, 1);
    } while ($from === $to);

    return [
        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
        'is_read' => $is_read
    ];
});
$factory->define(hubungis::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'subjek' => $faker->slug,
        'message' => $faker->sentence,
        'date' => $faker->date,

    ];
});
$factory->define(produks::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'name_produk' => $faker->name,
        'desc' => $faker->dateTimeThisCentury,
        'harga' => $faker->buildingNumber,
        'stok' => $faker->buildingNumber,
        'image' => 'https://via.placeholder.com/150',
        'terjual' => $faker->buildingNumber,
        'diskon' => $faker->buildingNumber,
        'tgl_masuk' => $faker->date,
    ];
});
$factory->define(orderdetails::class, function (Faker $faker) {
    return [
        'id_produk' => $faker->buildingNumber,
        'jumlah' => $faker->buildingNumber,
    ];
});
$factory->define(orders::class, function (Faker $faker) {
    return [
        'status_order' => $faker->state,
        'tgl_order' => $faker->date,
        'time' => $faker->time,
    ];
});
$factory->define(mod_banks::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'name_bank' => $faker->name,
        'rekening_number' => $faker->bankAccountNumber,
        'image' => 'https://via.placeholder.com/150',
    ];
});
$factory->define(keranjangs::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'jumlah' => $faker->buildingNumber,
        'date' => $faker->date,
    ];
});
$factory->define(mainmenus::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'name_menu' => $faker->name,
        'link' => $faker->link,
        'aktif' => $faker->date,
    ];
});
$factory->define(penjuals::class, function (Faker $faker) {
    return [
        // 'id_kategori' => $faker->buildingNumber,
        'name_penjual' => $faker->name,
        'avatar' => 'https://via.placeholder.com/150',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'email' => $faker->buildingNumber,
        'alamat' => $faker->streetAddress,
        'phone_number' => $faker->buildingNumber,
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
        // 'id_kategori' => $faker->buildingNumber,
        'name_kategori' => $faker->name,
        'keterangan' => $faker->sentence,
        'image' => 'https://via.placeholder.com/150',
        'tgl_posting' => $faker->date,
    ];
});
