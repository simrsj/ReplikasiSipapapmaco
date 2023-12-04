<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
$sql_prvl = "SELECT * FROM tb_user_privileges";
$sql_prvl .= " WHERE id_user = " . base64_decode(urldecode($_POST['idu']));
try {
    $d_prvl = $conn->query($sql_prvl)->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('Unauthorized');";
    echo "document.location.href='?error404';</script>";
}

if ($d_prvl['c_praktik_tarif'] == 'Y') {
    $no = 1;
    while ($_POST['bt'] >= $no) {
        //tambah ke tb_tarif_pilih
        $sql_insert_tarif = "INSERT INTO tb_tarif_pilih (";
        // $sql_insert_tarif .= " id_tarif_pilih,";
        $sql_insert_tarif .= " id_praktik,";
        $sql_insert_tarif .= " tgl_input_tarif_pilih,";
        $sql_insert_tarif .= " nama_jenis_tarif_pilih,";
        $sql_insert_tarif .= " nama_tarif_pilih,";
        $sql_insert_tarif .= " nominal_tarif_pilih,";
        $sql_insert_tarif .= " nama_satuan_tarif_pilih,";
        $sql_insert_tarif .= " frekuensi_tarif_pilih,";
        $sql_insert_tarif .= " kuantitas_tarif_pilih,";
        $sql_insert_tarif .= " jumlah_tarif_pilih";
        $sql_insert_tarif .= " ) VALUES (";
        $sql_insert_tarif .= " '" . base64_decode(urldecode($_POST['idp'])) . "',";
        $sql_insert_tarif .= " '" . date('Y-m-d', time()) . "',";
        $sql_insert_tarif .= " '" . $_POST['nama_tarif_jenis' . $no] . "',";
        $sql_insert_tarif .= " '" . $_POST['nama_tarif' . $no] . "',";
        $sql_insert_tarif .= " '" . $_POST['tarif' . $no] . "',";
        $sql_insert_tarif .= " '" . $_POST['nama_tarif_satuan' . $no] . "',";
        $sql_insert_tarif .= " '" . $_POST['frekuensi' . $no] . "',";
        $sql_insert_tarif .= " '" . $_POST['kuantitas' . $no] . "',";
        $sql_insert_tarif .= " '" . $_POST['tarif' . $no] * $_POST['frekuensi' . $no] * $_POST['kuantitas' . $no] . "'";
        $sql_insert_tarif .= " )";
        echo $sql_insert_tarif . "<br>";

        //Eksekusi Query
        try {
            $conn->query($sql_insert_tarif);
        } catch (Exception $ex) {
            echo "<script>alert('$ex -INSERT TARIF MESS-');";
            echo "document.location.href='?error404';</script>";
        }
        $no++;
    }
} else {
    echo "<script>alert('Unauthorized');document.location.href='?error401';</script>";
}
