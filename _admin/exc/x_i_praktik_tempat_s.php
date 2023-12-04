<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

//data praktik
$sql_praktik = "SELECT * FROM tb_praktik 
JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd
WHERE tb_praktik.id_praktik = " . $_POST['id'];
$q_praktik = $conn->query($sql_praktik);
$d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

//data tempat
$sql_tempat = "SELECT * FROM tb_tempat
JOIN tb_tarif_satuan ON tb_tempat.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan
JOIN tb_tarif_jenis ON tb_tempat.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis
WHERE tb_tempat.id_tempat = " . $_POST['tempat'];
$q_tempat = $conn->query($sql_tempat);
$d_tempat = $q_tempat->fetch(PDO::FETCH_ASSOC);

if ($d_praktik['id_jurusan_pdd_jenis'] == 1) {

    $frek = $d_praktik['jumlah_praktik'];
    $kuan = tanggal_between($d_praktik['tgl_mulai_praktik'], $d_praktik['tgl_selesai_praktik']);
    $total_tarif = $frek * $kuan * $d_tempat['tarif_tempat'];
} else {
    $frek = 1;
    $kuan = 1;
    $total_tarif = $frek * $kuan * $d_tempat['tarif_tempat'];
}
$sql_t = "INSERT INTO tb_tarif_pilih (
    id_praktik, 
    tgl_input_tarif_pilih,
    nama_jenis_tarif_pilih,
    nama_tarif_pilih,
    nominal_tarif_pilih,
    nama_satuan_tarif_pilih,
    frekuensi_tarif_pilih,
    kuantitas_tarif_pilih,
    jumlah_tarif_pilih
    ) VALUES (
        '" . $_POST['id'] . "', 
            '" . date('Y-m-d', time()) . "',
            '" . $d_tempat['nama_tarif_jenis'] . "', 
            '" . $d_tempat['nama_tempat'] . "', 
            '" . $d_tempat['tarif_tempat'] . "',  
            '" . $d_tempat['nama_tarif_satuan'] . "',
        '" . $frek . "', 
        '" . $kuan . "', 
        '" . $total_tarif . "'
    )";
$sql_u = "UPDATE tb_praktik SET
status_cek_praktik = 'TMP'
WHERE id_praktik = '" . $_POST['id'] . "'
";

// echo $sql_t . "<br>";
// echo $sql_u . "<br>";
$conn->query($sql_t);
$conn->query($sql_u);
