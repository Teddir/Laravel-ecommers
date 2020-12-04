<?php
use App\produks;
use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        produks::create([
            'penjual_id' => 3,
            'name_produk' => 'Matahari',
            'desc' => 'Kamu sahabat Sejati Akan selalu Bersama walau engaku susah maupun tidak.....ingat Itu Ali',
            'harga' => 88000,
            'stok' => 80,
            'image' => 'https://via.placeholder.com/150',
        ]);

        // produks::create([
        //     'penjual_id' => 1,
        //     'name_produk' => 'Bulan',
        //     'desc' => 'Berharap Untuk Selalu Melaju Tanpa Ada Arti Yang Pasti Seperti Air Yang Tak Tahu Akan Arah',
        //     'harga' => 90000,
        //     'stok' => 90,
        //     'image' => 'https://via.placeholder.com/150',
        // ]);

        // produks::create([
        //     'penjual_id' => 1,
        //     'name_produk' => 'The K2',
        //     'desc' => 'The K2 sendiri menceritakan tentang kisah Kim Je Ha (Ji Chang Wook), 
        //                 mantan prajurit dan kini menjadi seorang pengawal dengan julukan K2 di bawah naungan JSS. 
        //                 Je Ha ditugaskan untuk mengawal Choi Yoo Jin (Song Yoon Ah) yakni istri dari calon presiden 
        //                 Jang Se Joon (Cho Seong Ha)',
        //     'harga' => 98000,
        //     'stok' => 50,
        //     'image' => 'https://via.placeholder.com/150',
        // ]);

    }
}
