<?php
include '../koneksi.php';
$in = file_get_contents('php://input');
$decoded = json_decode($in, true);

$kodePenerima = $decoded['kodePenerima'];
$kodePengirim = $decoded['kodePengirim'];

$kodeGabungan_1 = $kodePenerima.$kodePengirim;
$kodeGabungan_2 = $kodePengirim.$kodePenerima;

$queryObrolan = mysqli_query($conn, "SELECT * FROM tb_chat WHERE kode = '$kodeGabungan_1' OR kode = '$kodeGabungan_2' ORDER BY id_chat ASC");
while($rowObrolan = mysqli_fetch_array($queryObrolan)) {
    if($rowObrolan['id_pengirim'] != 'admin') {
        $userid = $rowObrolan['id_pengirim'];
        $query = mysqli_query($conn, "SELECT * FROM tb_toko WHERE id_toko = '$userid'");
        $row = mysqli_fetch_array($query);
        $kecil = strtolower($row['nama_toko']);
    }
    ?>
    <?php if($_SESSION['level'] == 'Admin') { ?>
        <?php if($rowObrolan['id_penerima'] == $kodePenerima) { ?>
            <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right">Admin</span>
                    <span class="direct-chat-timestamp float-left"><?php echo tglIndonesia(date('d F Y H:i:s', strtotime($rowObrolan['created'])));?></span>
                </div>
                <img class="direct-chat-img" src="avatar5.png" alt="message user image">
                <div class="direct-chat-text">
                    <?php echo $rowObrolan['isi'];?>
                </div>
            </div>
        <?php }else { ?>
            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left"><?php echo ucwords($kecil);?></span>
                    <span class="direct-chat-timestamp float-right"><?php echo tglIndonesia(date('d F Y H:i:s', strtotime($rowObrolan['created'])));?></span>
                </div>
                <img class="direct-chat-img" src="kisspng-computer.png" alt="message user image">
                <div class="direct-chat-text">
                    <?php echo $rowObrolan['isi'];?>
                </div>
            </div>
        <?php } ?>
    <?php }else { ?>
        <?php if($rowObrolan['id_penerima'] == $kodePenerima) { ?>
            <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right"><?php echo ucwords($kecil);?></span>
                    <span class="direct-chat-timestamp float-left"><?php echo tglIndonesia(date('d F Y H:i:s', strtotime($rowObrolan['created'])));?></span>
                </div>
                <img class="direct-chat-img" src="kisspng-computer.png" alt="message user image">
                <div class="direct-chat-text">
                    <?php echo $rowObrolan['isi'];?>
                </div>
            </div>
        <?php }else { ?>
            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">Admin</span>
                    <span class="direct-chat-timestamp float-right"><?php echo tglIndonesia(date('d F Y H:i:s', strtotime($rowObrolan['created'])));?></span>
                </div>
                <img class="direct-chat-img" src="avatar5.png" alt="message user image">
                <div class="direct-chat-text">
                    <?php echo $rowObrolan['isi'];?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php } ?>