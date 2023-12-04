<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
$sql_prvl = "SELECT * FROM tb_user_privileges";
$sql_prvl .= " WHERE id_user = " . base64_decode(urldecode($_GET['id']));
try {
    $d_prvl = $conn->query($sql_prvl)->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('Unauthorized');";
    echo "document.location.href='?error404';</script>";
}

if ($d_prvl['c_praktik_mess'] == 'Y') {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    //cari data mess
    $sql_mess = "SELECT * FROM tb_mess";
    $sql_mess .= " JOIN tb_tarif_satuan ON tb_mess.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan";
    $sql_mess .= " JOIN tb_tarif_jenis ON tb_mess.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis";
    $sql_mess .= " WHERE id_mess = " . $_POST['id_mess'];
    try {
        $d_mess = $conn->query($sql_mess)->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA MESS-');";
        echo "document.location.href='?error404';</script>";
    }

    //cari data praktik
    $sql_praktik = "SELECT * FROM tb_praktik WHERE id_praktik = " . $_POST['id'];
    try {
        $d_praktik = $conn->query($sql_praktik)->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRAKTIK-');";
        echo "document.location.href='?error404';</script>";
    }
    $jumlah_hari_praktik = tanggal_between($d_praktik['tgl_mulai_praktik'], $d_praktik['tgl_selesai_praktik']);
    $total_tarif_mess_pilih = $jumlah_hari_praktik * $d_praktik['jumlah_praktik'] * $d_mess['tarif_tanpa_makan_mess'];
    // echo $jumlah_hari_praktik . "<br>";

    //mencari id_tarif_pilih yang belum ada
    $sql_tarif_pilih = "SELECT * FROM tb_tarif_pilih ORDER BY id_tarif_pilih ASC";
    try {
        $q_tarif_pilih = $conn->query($sql_tarif_pilih);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA TARIF PILIH-');";
        echo "document.location.href='?error404';</script>";
    }
    $no = 1;
    while ($d_tarif_pilih = $q_tarif_pilih->fetch(PDO::FETCH_ASSOC)) {
        if ($d_tarif_pilih['id_tarif_pilih'] != $no) {
            break;
        }
        $no++;
    }
    $id_tarif_pilih = $no;

    //tambah ke tb_tarif_pilih
    $sql_insert_tarif_mess = "INSERT INTO tb_tarif_pilih (";
    $sql_insert_tarif_mess .= " id_tarif_pilih,";
    $sql_insert_tarif_mess .= " id_praktik,";
    $sql_insert_tarif_mess .= " tgl_input_tarif_pilih,";
    $sql_insert_tarif_mess .= " nama_jenis_tarif_pilih,";
    $sql_insert_tarif_mess .= " nama_tarif_pilih,";
    $sql_insert_tarif_mess .= " nominal_tarif_pilih,";
    $sql_insert_tarif_mess .= " nama_satuan_tarif_pilih,";
    $sql_insert_tarif_mess .= " frekuensi_tarif_pilih,";
    $sql_insert_tarif_mess .= " kuantitas_tarif_pilih,";
    $sql_insert_tarif_mess .= " jumlah_tarif_pilih";
    $sql_insert_tarif_mess .= " ) VALUES (";
    $sql_insert_tarif_mess .= " '" . $id_tarif_pilih . "',";
    $sql_insert_tarif_mess .= " '" . $_POST['id'] . "',";
    $sql_insert_tarif_mess .= " '" . date('Y-m-d', time()) . "',";
    $sql_insert_tarif_mess .= " '" . $d_mess['nama_tarif_jenis'] . "',";
    $sql_insert_tarif_mess .= " '" . $d_mess['nama_mess'] . "',";
    $sql_insert_tarif_mess .= " '" . $d_mess['tarif_tanpa_makan_mess'] .    "',";
    $sql_insert_tarif_mess .= " '" . $d_mess['nama_tarif_satuan'] . "',";
    $sql_insert_tarif_mess .= " '" . $jumlah_hari_praktik . "',";
    $sql_insert_tarif_mess .= " '" . $d_praktik['jumlah_praktik'] . "',";
    $sql_insert_tarif_mess .= " '" . $total_tarif_mess_pilih . "')";

    //tambah ke tb_mess_pilih
    $sql_insert_pilih_mess = "INSERT INTO tb_mess_pilih (";
    $sql_insert_pilih_mess .= " id_praktik,";
    $sql_insert_pilih_mess .= " id_mess,";
    $sql_insert_pilih_mess .= " id_tarif_pilih,";
    $sql_insert_pilih_mess .= " tgl_input_mess_pilih,";
    $sql_insert_pilih_mess .= " jumlah_hari_mess_pilih,";
    $sql_insert_pilih_mess .= " total_tarif_mess_pilih";
    $sql_insert_pilih_mess .= " ) VALUES (";
    $sql_insert_pilih_mess .= " '" . $_POST['id'] . "',";
    $sql_insert_pilih_mess .= " '" . $_POST['id_mess'] . "',";
    $sql_insert_pilih_mess .= " '" . $id_tarif_pilih . "',";
    $sql_insert_pilih_mess .= " '" . date('Y-m-d', time()) . "',";
    $sql_insert_pilih_mess .= " '" . $jumlah_hari_praktik . "',";
    $sql_insert_pilih_mess .= " '" . $total_tarif_mess_pilih . "'";
    $sql_insert_pilih_mess .= " )";

    //Eksekusi Query
    // echo $sql_insert_tarif_mess . "<br>";
    // echo $sql_insert_pilih_mess . "<br>";

    try {
        $conn->query($sql_insert_tarif_mess);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -INSERT TARIF MESS-');";
        echo "document.location.href='?error404';</script>";
    }
    try {
        $conn->query($sql_insert_pilih_mess);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -INSERT PILIH MESS-');";
        echo "document.location.href='?error404';</script>";
    }
} else {
    echo "<script>alert('Unauthorized');document.location.href='?error401';</script>";
}
