<?php
    include("koneksi.php");
        if ($_GET['id_produk']==''){
            $data = array(
                'harga_penjualan'      => '',
                'stok_produk'      =>  '',
                'nama_produk'      =>  '',  
                );
     echo json_encode($data);
     
        }else{
        $kueri = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk='$_GET[id_produk]'");
        $tampil = mysqli_fetch_array($kueri);
        $kueri_permintaan = mysqli_query($conn, "SELECT *,SUM(jumlah_permintaan) AS total_permintaan FROM tb_permintaanbantu, tb_permintaan WHERE tb_permintaanbantu.id_permintaan=tb_permintaan.id_permintaan AND id_toko='$_GET[id_toko]' AND tb_permintaanbantu.id_produk='$_GET[id_produk]' AND (tb_permintaanbantu.status='Di Terima')");
        $tampil_permintaan = mysqli_fetch_array($kueri_permintaan);

        $kueri_penjualan = mysqli_query($conn, "SELECT *,SUM(jumlah_penjualan) AS total_penjualan FROM tb_penjualanbantu WHERE  id_toko='$_GET[id_toko]' AND tb_penjualanbantu.id_produk='$_GET[id_produk]' AND status_penjualan='1'");
        $tampil_penjualan = mysqli_fetch_array($kueri_penjualan);

        $data = array(
                    'harga_penjualan'      =>  number_format($tampil['harga_penjualan'],0,",","."),
                    'stok_produk'      =>  number_format($tampil_permintaan['total_permintaan']-$tampil_penjualan['total_penjualan']),
                    'nama_produk'      =>  $tampil['nama_produk'],
                    );
         echo json_encode($data);
        }
?>