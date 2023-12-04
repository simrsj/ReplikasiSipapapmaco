<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$id_mess = $_POST['id_m'];
$jumlahPraktikan = $_POST['jp'];
$tgl_mulai = $_POST['tgl_m'];
$tgl_selesai = date('Y-m-d', strtotime($_POST['tgl_s'] . "+1 days"));

$period = new DatePeriod(
    new DateTime($tgl_mulai),
    new DateInterval('P1D'),
    new DateTime($tgl_selesai)
);

// echo "<pre>";
// print_r($period);
// echo "</pre>";

$no = 1;
$dataJSON['messKet'] = 'T';
foreach ($period as $key => $value) {

    $sql = "SELECT * FROM tb_praktik ";
    $sql .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik ";
    $sql .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik ";
    $sql .= " JOIN tb_mess ON tb_mess.id_mess = tb_mess_pilih.id_mess ";
    $sql .= " WHERE tb_praktik_tgl.praktik_tgl = '" . $value->format('Y-m-d') . "' ";
    $sql .= " AND tb_mess_pilih.id_mess = " . $id_mess;
    $sql .= " AND tb_praktik.status_praktik = 'Y'";
    // echo $sql . "<br>";
    try {
        $q = $conn->query($sql);
    } catch (Exception $ex) {
        echo "<script>alert('Maaf Data Tidak Ada -DATA JADWAL HARIAN MESS-');document.location.href='?error404';</script>";
    }

    $jumlahTotal = 0;
    while ($d = $q->fetch(PDO::FETCH_ASSOC)) {
        $jumlahTotal += $d['jumlah_praktik'];
    }

    $sql_mess = "SELECT * FROM tb_mess";
    $sql_mess .= " WHERE id_mess= " . $id_mess;
    // echo $sql_mess;
    try {
        $q_mess = $conn->query($sql_mess);
    } catch (Exception $ex) {
        echo "<script>alert('Maaf Data Tidak Ada -DATA MESS-');document.location.href='?error404';</script>";
    }

    $d_mess = $q_mess->fetch(PDO::FETCH_ASSOC);
    $messKuota = $d_mess['kapasitas_t_mess'];

    $jumlahPraktikanTotal = $jumlahPraktikan + $jumlahTotal;
    if ($jumlahPraktikanTotal >= $messKuota) {
        $dataJSON['messKet'] = 'Y';
    }
    $no++;
}
$dataJSON['messKuota'] = $messKuota;
echo json_encode($dataJSON);
