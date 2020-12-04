<?php

use App\penjuals;
use Illuminate\Database\Seeder;

class PenjualTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        penjuals::create([
            'user_id' => 1,
            'name_toko' => 'Kalangan.store',
            'phone_number' => 87907578,
        ]);

        penjuals::create([
            'user_id' => 2,
            'name_toko' => 'Bukune.store',
            'phone_number' => 756876725,
        ]);

    }
}
