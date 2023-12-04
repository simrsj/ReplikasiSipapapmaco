<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$jumlahPraktikan = $_POST['jp'];
$tgl_mulai = $_POST['tgl_m'];
$tgl_selesai = $_POST['tgl_s'];
$tgl_selesai = date('Y-m-d', strtotime($tgl_selesai . "+1 days"));

$period = new DatePeriod(
    new DateTime($tgl_mulai),
    new DateInterval('P1D'),
    new DateTime($tgl_selesai)
);

// echo "<pre>";
// // print_r($period);
// echo "</pre>";

$sql_mess_dalam = "SELECT * FROM tb_mess";
$sql_mess_dalam .= " WHERE kepemilikan_mess = 'dalam'";
try {
    $q_mess_dalam = $conn->query($sql_mess_dalam);
} catch (Exception $ex) {
    echo "<script>alert('Maaf Data Tidak Ada -DATA MESS DALAM-');";
    echo "document.location.href='?error404';</script>";
}

$option = '<option value=""></option>';
//cek data ketersediaan mess dalam
while ($d_mess_dalam = $q_mess_dalam->fetch(PDO::FETCH_ASSOC)) {
    $option_tambah = '<option value="' . $d_mess_dalam['id_mess'] . '">' . $d_mess_dalam['nama_mess'] . '</option>';
    $status_mess_dalam = 'tersedia';
    foreach ($period as $key => $value) {

        $jumlahTotal = 0;
        $sql = "SELECT * FROM tb_praktik ";
        $sql .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik ";
        $sql .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik ";
        $sql .= " WHERE tb_praktik_tgl.praktik_tgl = '" . $value->format('Y-m-d') . "' ";
        $sql .= " AND tb_mess_pilih.id_mess = " . $d_mess_dalam['id_mess'];
        $sql .= " AND tb_praktik.status_praktik = 'Y'";
        try {
            $q = $conn->query($sql);
        } catch (Exception $ex) {
            echo "<script>alert('Maaf Data Tidak Ada -DATA JADWAL HARIAN MESS');";
            echo "document.location.href='?error404';</script>";
        }

        $jumlahTotal = 0;
        while ($d = $q->fetch(PDO::FETCH_ASSOC)) {
            $jumlahTotal += $d['jumlah_praktik'];
        }
        $jumlahPraktikanTotal = $jumlahPraktikan + $jumlahTotal;
        if ($jumlahPraktikanTotal >= $d_mess_dalam['kapasitas_t_mess']) {
            $option_tambah = "";
            $status_mess_dalam = 'penuh';
            break;
        }
    }
    $option .= $option_tambah;
}
//eksekusi bila ketersediaan mess dalam penuh
if ($status_mess_dalam == 'penuh') {
    $sql_mess_luar = "SELECT * FROM tb_mess";
    $sql_mess_luar .= " WHERE kepemilikan_mess = 'luar'";
    try {
        $q_mess_luar = $conn->query($sql_mess_luar);
    } catch (Exception $ex) {
        echo "<script>alert('Maaf Data Tidak Ada -DATA MESS LUAR-');";
        echo "document.location.href='?error404';</script>";
    }
    while ($d_mess_luar = $q_mess_luar->fetch(PDO::FETCH_ASSOC)) {
        $option .= '<option value="' . $d_mess_luar['id_mess'] . '">' . $d_mess_luar['nama_mess'] . '</option>';
    }
}
$dataJSON['option'] = $option;

echo json_encode($dataJSON);
