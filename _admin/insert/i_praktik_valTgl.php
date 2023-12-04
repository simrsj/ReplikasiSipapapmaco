<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
$jumlah_praktik = $_POST['jumlah'];
$id_jurusan = $_POST['jurusan'];
$tanggal_mulai_praktik = $_POST['tgl_mulai_praktik'];
$tanggal_selesai_praktik1 = date('Y-m-d', strtotime($_POST['tgl_selesai_praktik'] . "+1 days"));

$period = new DatePeriod(
    new DateTime($tanggal_mulai_praktik),
    new DateInterval('P1D'),
    new DateTime($tanggal_selesai_praktik1)
);

// echo "<pre>";
// print_r($period);
// echo "</pre>";

$no = 1;
$dataJSON['ket'] = 'Y';
foreach ($period as $key => $value) {

    try {
        //mencari jumlah praktikan sesuai dengan tanggal praktik
        $sql = "SELECT * FROM tb_praktik ";
        $sql .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik ";
        $sql .= " WHERE tb_praktik_tgl.praktik_tgl = '" . $value->format('Y-m-d') . "' ";
        $sql .= " AND tb_praktik.id_jurusan_pdd = " . $id_jurusan;
        $sql .= " AND tb_praktik.status_praktik = 'Y'";
        // echo "$sql<br>";
        $q = $conn->query($sql);
    } catch (PDOException $e) {
        echo "<script>alert('$-DATA PRAKTIK-');document.location.href='?error404';</script>";
    }

    $jumlah_total = 0;
    while ($d = $q->fetch(PDO::FETCH_ASSOC)) {
        $jumlah_total += $d['jumlah_praktik'];
    }

    try {
        //mencari kuota sesuai dengan jurusannya
        $sql_k = "SELECT * FROM tb_kuota";
        $sql_k .= " WHERE id_jurusan_pdd = " . $id_jurusan;
        // echo $sql_k . "<br>";
        $q_k = $conn->query($sql_k);
        $d_k = $q_k->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<script>alert('$-DATA PRAKTIK-');document.location.href='?error404';</script>";
    }
    $jumlah_keseluruhan = $jumlah_praktik + $jumlah_total;
    if ($jumlah_keseluruhan > $d_k['jumlah_kuota']) {
        $dataJSON['ket'] = 'T';
        break;
    }
    $no++;
}
echo json_encode($dataJSON);
