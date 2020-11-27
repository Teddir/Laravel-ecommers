<?php
        require_once('../config/+koneksi.php');
        require_once('../model/database.php');
        include "../model/makanan/f_dessert.php";

        $connection = new Database($host, $user, $pass, $database);
        $mn = new Food($connection); 
        $content = "
        <style type='text/css'>
        .tabel { border-collapse:collapse;}
        .tabel th { padding:8px 10px; background-color:grey; color:white; width:70px;}
        .tabel td{padding:3px;}
        img{width:70px;}
        </style>

        ";

        $content .= '
        <page>
        <link rel="logo" href="tempat logo kamu">
        <div style="padding:4mm; border:1px solid;" align="center">
        <span style="font-size:25px;"> Menu Makanan Kedai Kamyusi </span>
        </div>

        <div style="padding:20px 0 10px 0; font-size:15px;">
        Laporan Data Menu
        </div>

        <table border="1px" class="tabel">
        <tr>
        <th align="center">No.</th>
        <th align="center">Kode Menu</th>
        <th align="center">Nama Menu</th>
        <th align="center">Harga</th>
        <th align="center">Jumlah Menu</th>
        <th align="center">Gambar Menu</th>
        </tr>';
        $no = 1;
        $tampil = $mn->tampil();
        while ($data = $tampil->fetch_object()) {
        $content  .='
        <tr>
        <td align="center">'.$no++.'.'.'</td>
        <td align="center">'.$data->kode_menu.'</td>
        <td align="center">'.$data->nama_menu.'</td>
        <td align="center">'.$data->harga.'</td>
        <td align="center">'.$data->jumlah_menu.'</td>
        <td><img src="../img_menu/makanan/'.$data->gambar.'"></td>
        </tr>
        ';
        }

        $content .='
        </table>

        </page>
        ';

        require DIR.'/html2pdf_v5.2-master/vendor/autoload.php';
        use Spipu\Html2Pdf\Html2Pdf;
        $html2pdf = new Html2Pdf('P','A4','en', true, 'UTF-8', array(15, 15, 15, 15), false); 
        $html2pdf->writeHTML($content);
        $html2pdf->output();
        ?>
