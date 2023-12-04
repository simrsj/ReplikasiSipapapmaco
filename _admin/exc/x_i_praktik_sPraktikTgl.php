<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

// --------------------------------------SIMPAN DATA PRAKTIK--------------------------------------------

$id_praktik = $_POST['id'];
$d1 = $_POST['tgl_mulai_praktik'];
$d2 = $_POST['tgl_selesai_praktik'];
$d2 = date('Y-m-d', strtotime($d2 . "+1 days"));

$period = new DatePeriod(
    new DateTime($d1),
    new DateInterval('P1D'),
    new DateTime($d2)
);

echo "<pre>";
print_r($period);
echo "</pre>";

$no = 1;
foreach ($period as $key => $value) {
    $sql = "INSERT INTO tb_praktik_tgl (
        id_praktik, 
        praktik_tgl
    ) VALUES (
        $id_praktik, 
        '" . $value->format('Y-m-d') . "'
    )";
    echo "$sql <br>";
    $conn->query($sql);
    $no++;
}
