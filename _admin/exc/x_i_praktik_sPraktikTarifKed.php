<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

//Mencari Data Praktik
$id_praktik = $_POST['id'];
$cek_pilih_ujian = $_POST['cek_pilih_ujian'];
$sql_praktik = "SELECT * FROM tb_praktik 
JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd
WHERE tb_praktik.id_praktik = " . $id_praktik;

$q_praktik = $conn->query($sql_praktik);
$d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

$id_jurusan_pdd = $d_praktik['id_jurusan_pdd'];
$id_jenjang_pdd = $d_praktik['id_jenjang_pdd'];
$tgl_mulai_praktik = $d_praktik['tgl_mulai_praktik'];
$tgl_selesai_praktik = $d_praktik['tgl_selesai_praktik'];
$jumlah_praktik = $d_praktik['jumlah_praktik'];

// ----------------------------------------------------------------SIMPAN DATA TARIF WAJIB
$sql_tarif_jurusan = " SELECT * FROM tb_tarif ";
$sql_tarif_jurusan .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
$sql_tarif_jurusan .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan";
$sql_tarif_jurusan .= " WHERE tb_tarif.id_jurusan_pdd = $id_jurusan_pdd AND tb_tarif.id_tarif_jenis BETWEEN 1 AND 5 AND tb_tarif.id_jenjang_pdd = 0";
$sql_tarif_jurusan .= " ORDER BY nama_tarif_jenis ASC, nama_tarif ASC ";

echo $sql_tarif_jurusan . "<br>";
$q_tarif_jurusan = $conn->query($sql_tarif_jurusan);
while ($d_tarif_jurusan = $q_tarif_jurusan->fetch(PDO::FETCH_ASSOC)) {
    $sql_insert = "INSERT INTO tb_tarif_pilih (
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
            '" . $id_praktik . "', 
            '" . date('Y-m-d', time()) . "',
            '" . $d_tarif_jurusan['nama_tarif_jenis'] . "', 
            '" . $d_tarif_jurusan['nama_tarif'] . "', 
            '" . $d_tarif_jurusan['jumlah_tarif'] . "',  
            '" . $d_tarif_jurusan['nama_tarif_satuan'] . "',
            '" . $_POST['frek' . $d_tarif_jurusan['id_tarif']] . "',
            '" . $_POST['ktt' . $d_tarif_jurusan['id_tarif']] . "',
            '" . $_POST['frek' . $d_tarif_jurusan['id_tarif']] * $_POST['ktt' . $d_tarif_jurusan['id_tarif']] * $d_tarif_jurusan['jumlah_tarif'] . "'
            )";

    // echo $sql_insert;
    echo "<br>";
    $conn->query($sql_insert);
}

// ----------------------------------------------------------------SIMPAN DATA TARIF UJIAN
if ($_POST['cek_pilih_ujian'] == 'y') {

    $sql_tarif_ujian = " SELECT * FROM tb_tarif ";
    $sql_tarif_ujian .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis";
    $sql_tarif_ujian .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan";
    $sql_tarif_ujian .= " WHERE tb_tarif.id_tarif_jenis = 6 AND tb_tarif.id_jurusan_pdd = " . $d_praktik['id_jurusan_pdd'];
    $sql_tarif_ujian .= " ORDER BY nama_tarif_jenis ASC";

    echo $sql_tarif_ujian;
    $q_tarif_ujian = $conn->query($sql_tarif_ujian);
    while ($d_tarif_ujian = $q_tarif_ujian->fetch(PDO::FETCH_ASSOC)) {
        $sql_insert = "INSERT INTO tb_tarif_pilih (
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
                '" . $id_praktik . "', 
                '" . date('Y-m-d', time()) . "',
                '" . $d_tarif_ujian['nama_tarif_jenis'] . "', 
                '" . $d_tarif_ujian['nama_tarif'] . "', 
                '" . $d_tarif_ujian['jumlah_tarif'] . "',  
                '" . $d_tarif_ujian['nama_tarif_satuan'] . "',
                '" . $_POST['frek' . $d_tarif_ujian['id_tarif']] . "',
                '" . $_POST['ktt' . $d_tarif_ujian['id_tarif']] . "',
                '" . $_POST['frek' . $d_tarif_ujian['id_tarif']] * $_POST['ktt' . $d_tarif_ujian['id_tarif']] * $d_tarif_ujian['jumlah_tarif'] . "'
                )";

        // echo $sql_insert;
        echo "<br>";
        $conn->query($sql_insert);
    }
}

// ----------------------------------------------------------------SIMPAN DATA TARIF TEMPAT

$sql_tempat = " SELECT * FROM tb_tempat";
$sql_tempat .= " JOIN tb_tarif_jenis ON tb_tempat.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis";
$sql_tempat .= " JOIN tb_tarif_satuan ON tb_tempat.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan";
$sql_tempat .= " WHERE tb_tempat.id_tarif_jenis = 7 AND tb_tempat.id_jurusan_pdd_jenis = " . $d_praktik['id_jurusan_pdd_jenis'];
$sql_tempat .= " ORDER BY tb_tempat.nama_tempat ASC";

echo $sql_tempat . "<br>";
$q_tempat = $conn->query($sql_tempat);
while ($d_tempat = $q_tempat->fetch(PDO::FETCH_ASSOC)) {
    $sql_insert = "INSERT INTO tb_tarif_pilih (
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
            '" . $id_praktik . "', 
            '" . date('Y-m-d', time()) . "',
            '" . $d_tempat['nama_tarif_jenis'] . "', 
            '" . $d_tempat['nama_tempat'] . "', 
            '" . $d_tempat['tarif_tempat'] . "',  
            '" . $d_tempat['nama_tarif_satuan'] . "',
            '" . $_POST['frek' . $d_tempat['id_tempat']] . "',
            '" . $_POST['ktt' . $d_tempat['id_tempat']] . "',
            '" . $_POST['frek' . $d_tempat['id_tempat']] * $_POST['ktt' . $d_tempat['id_tempat']] * $d_tempat['tarif_tempat'] . "'
            )";

    // echo $sql_insert;
    echo "<br>";
    $conn->query($sql_insert);
}

// ----------------------------------------------------------------UPDATE STATUS PRAKTIK


$sql_update_status_praktik = " UPDATE tb_praktik
SET status_cek_praktik = 'DTR_KED_INV'
WHERE id_praktik = $id_praktik";

echo $sql_update_status_praktik;

$conn->query($sql_update_status_praktik);
echo json_encode(['success' => 'Data Tarif Berhasil Disimpan']);
