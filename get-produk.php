<?php
    include("koneksi.php");
        if ($_GET['id_produk']==''){
            $data = array(
                'harga_pembelian'      => '',
                'harga_penjualan'      => '',
                'stok_produk'      =>  '',
                'nama_produk'      =>  '',
                'status_stok'      =>  '',
                );
     echo json_encode($data);
     
        }else{
        $kueri = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk='$_GET[id_produk]'");
        $tampil = mysqli_fetch_array($kueri);
        if($tampil['stok_produk']>9){
            $status_stok ='Banyak';
        }else{
            $status_stok ='Sedikit';
        }

        $data = array(
                    'harga_pembelian'      =>  number_format($tampil['harga_pembelian'],0,",","."),
                    'harga_penjualan'      =>  number_format($tampil['harga_penjualan'],0,",","."),
                    'stok_produk'      =>  $tampil['stok_produk'],
                    'nama_produk'      =>  $tampil['nama_produk'],
                    'status_stok'      =>  $status_stok,
                    );
         echo json_encode($data);
        }
?>