<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\hubungis;
use App\messages;
use App\orders;
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
        'id_hubungi' => $faker->buildingNumber,
        'name' => $faker->name,
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
        'id_order' => $faker->buildingNumber,
        'id_produk' => $faker->buildingNumber,
        'jumlah' => $faker->buildingNumber,
    ];
});

