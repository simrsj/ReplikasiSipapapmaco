<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$id_user = base64_decode(urldecode($_POST['idu']));
$id_praktik = base64_decode(urldecode($_POST['idp']));
$id_tarif_pilih = base64_decode(urldecode($_POST['idtp']));
$id_mess = $_POST['id_mess'];

$sql_prvl = "SELECT * FROM tb_user_privileges";
$sql_prvl .= " WHERE id_user = " . $id_user;
try {
    $d_prvl = $conn->query($sql_prvl)->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('Unauthorized');";
    echo "document.location.href='?error404';</script>";
}

if ($d_prvl['u_praktik_mess'] == 'Y') {

    //cari data mess
    $sql_mess = "SELECT * FROM tb_mess";
    $sql_mess .= " JOIN tb_tarif_satuan ON tb_mess.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan ";
    $sql_mess .= " JOIN tb_tarif_jenis ON tb_mess.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
    $sql_mess .= " WHERE id_mess = " . $id_mess;
    try {
        $d_mess = $conn->query($sql_mess)->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('Maaf Data Tidak Ada -DATA MESS-');";
        echo "document.location.href='?error404';</script>";
    }
    // echo "<pre>";
    // print_r($d_mess);
    // echo "</pre>";

    //cari data praktik
    $sql_praktik = "SELECT * FROM tb_praktik WHERE id_praktik = " . $id_praktik;
    try {
        $d_praktik = $conn->query($sql_praktik)->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('Maaf Data Tidak Ada -DATA PRAKTIK-');";
        echo "document.location.href='?error404';</script>";
    }
    // echo "<pre>";
    // print_r($d_praktik);
    // echo "</pre>";

    $jumlah_hari_praktik = tanggal_between($d_praktik['tgl_mulai_praktik'], $d_praktik['tgl_selesai_praktik']);
    $total_tarif_mess_pilih = $jumlah_hari_praktik * $d_praktik['jumlah_praktik'] * $d_mess['tarif_tanpa_makan_mess'];

    //update ke tb_tarif_pilih
    $sql_update_tarif_mess = "UPDATE tb_tarif_pilih SET";
    $sql_update_tarif_mess .= " tgl_ubah_tarif_pilih = '" . date('Y-m-d', time()) . "',";
    $sql_update_tarif_mess .= " nama_tarif_pilih = '" . $d_mess['nama_mess'] . "',";
    $sql_update_tarif_mess .= " nominal_tarif_pilih = '" . $d_mess['tarif_tanpa_makan_mess'] . "',";
    $sql_update_tarif_mess .= " frekuensi_tarif_pilih = '" . $jumlah_hari_praktik . "',";
    $sql_update_tarif_mess .= " kuantitas_tarif_pilih = '" . $d_praktik['jumlah_praktik'] . "',";
    $sql_update_tarif_mess .= " jumlah_tarif_pilih = '" . $total_tarif_mess_pilih . "'";
    $sql_update_tarif_mess .= " WHERE id_tarif_pilih = " . $id_tarif_pilih;

    //update ke tb_mess_pilih
    $sql_update_pilih_mess = "UPDATE tb_mess_pilih SET";
    $sql_update_pilih_mess .= " id_praktik = '" . $id_praktik . "',";
    $sql_update_pilih_mess .= " id_mess = '" . $id_mess . "',";
    $sql_update_pilih_mess .= " tgl_ubah_mess_pilih = '" . date('Y-m-d', time()) . "',";
    $sql_update_pilih_mess .= " jumlah_hari_mess_pilih = '" . $jumlah_hari_praktik . "',";
    $sql_update_pilih_mess .= " total_tarif_mess_pilih = '" . $total_tarif_mess_pilih . "'";
    $sql_update_pilih_mess .= " WHERE id_tarif_pilih = " . $id_tarif_pilih;

    //Eksekusi Query
    // echo "<pre>";
    // echo $sql_update_tarif_mess . "<br>";
    // echo $sql_update_pilih_mess . "<br>";
    // echo "</pre>";
    try {
        $conn->query($sql_update_tarif_mess);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -UPDATE TARIF PILIH-');";
        echo "document.location.href='?error404';</script>";
    }
    try {
        $conn->query($sql_update_pilih_mess);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -UPDATE MESS PILIH-');";
        echo "document.location.href='?error404';</script>";
    }
} else {
    echo "<script>alert('Unauthorized');document.location.href='?error401';</script>";
}
