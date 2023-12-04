---------------------- i_praktik_bayar.php
<div>
    <?php
    #data tempat pilih
    $sql_tempat = "SELECT * FROM tb_praktik 
                        JOIN tb_tempat_pilih ON tb_praktik.id_praktik = tb_tempat_pilih.id_praktik 
                        JOIN tb_tempat ON tb_tempat_pilih.id_tempat = tb_tempat.id_tempat 
                        JOIN tb_tarif_satuan ON tb_tempat.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan
                        WHERE tb_praktik.id_praktik = '" . $id_praktik . "'";
    $q_tempat = $conn->query($sql_tempat);

    while ($d_tempat = $q_tempat->fetch(PDO::FETCH_ASSOC)) {
        array_push(
            $data,
            array(
                $no,
                $d_tempat['nama_tempat'] . " (Tempat)",
                $d_tempat['nama_tarif_satuan'],
                "Rp " . number_format($d_tempat['tarif_tempat'], 0, ",", "."),
                $d_tempat['frek_tempat_pilih'],
                $d_tempat['kuan_tempat_pilih'],
                "Rp " . number_format($d_tempat['total_tarif_tempat_pilih'], 0, ",", ".")
            )
        );
        $total_tarif = $total_tarif + $d_tempat['total_tarif_tempat_pilih'];
        $no++;
    }

    #data mess pilih
    $sql_mess = "SELECT * FROM tb_praktik 
                        JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik 
                        JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess 
                        JOIN tb_institusi on tb_institusi.id_institusi = tb_praktik.id_institusi
                        WHERE tb_praktik.id_praktik = '" . $id_praktik . "'";
    $q_mess = $conn->query($sql_mess);

    while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
        if ($d_mess['makan_mess_pilih'] == 'y') {
            $makan = "(Dengan Makan)";
        } elseif ($d_mess['makan_mess_pilih'] == 't') {
            $makan = "(Tanpa Makan)";
        } else {
            $makan = "(<i><b>ERROR</b></i>)";
        }
        array_push(
            $data,
            array(
                $no,
                $d_mess['nama_mess'] . " (Mess) " . $makan,
                "Hari/Orang",
                "Rp " . number_format(
                    $d_mess['total_tarif_mess_pilih'] / ($d_mess['jumlah_praktik'] * $d_mess['total_hari_mess_pilih']),
                    0,
                    ",",
                    "."
                ),
                $d_mess['jumlah_praktik'],
                $d_mess['total_hari_mess_pilih'],
                "Rp " . number_format($d_mess['total_tarif_mess_pilih'], 0, ",", ".")
            )
        );
        $total_tarif = $total_tarif + $d_mess['total_tarif_mess_pilih'];
        $no++;
    }
    ?>
</div>
----------------------