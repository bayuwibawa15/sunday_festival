<?php
    include("koneksi.php");
        if ($_GET['id_penjualan']==''){
            $data = array(
                'harga_penjualan'      => '',
                'jumlah_penjualan'      =>  '',
                'nama_solar'      =>  '',
                'total'      =>  '',
                );
     echo json_encode($data);
     
        }else{
        $kueri = mysqli_query($conn, "SELECT * FROM tb_penjualan,tb_solar WHERE tb_solar.id_solar=tb_penjualan.id_solar AND status='Setuju' AND id_penjualan='$_GET[id_penjualan]'");
        $tampil = mysqli_fetch_array($kueri);
            $total = $tampil['harga_penjualan']*$tampil['jumlah_penjualan'];
        $data = array(
                    'harga_penjualan'      =>  number_format($tampil['harga_penjualan'],0,",","."),
                    'jumlah_penjualan'      =>  $tampil['jumlah_penjualan'],
                    'nama_solar'      =>  $tampil['nama_solar'],
                    'total'      =>  number_format($total,0,",","."),
                    );
         echo json_encode($data);
        }
?>