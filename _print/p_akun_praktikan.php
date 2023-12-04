<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/autoload.php";

$id_praktik = decryptString($_GET['data'], $customkey);
try {
    $sql_praktik = "SELECT tb_praktik.id_praktik,tb_praktik.id_institusi, tb_praktik.nama_praktik, tb_praktik.tgl_mulai_praktik, tb_praktik.tgl_selesai_praktik, tb_jurusan_pdd.nama_jurusan_pdd, tb_jenjang_pdd.nama_jenjang_pdd, tb_profesi_pdd.nama_profesi_pdd FROM tb_praktik";
    $sql_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
    $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
    $sql_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
    $sql_praktik .= " WHERE tb_praktik.id_praktik = " . $id_praktik;
    // echo $sql_praktik;
    $q_praktik = $conn->query($sql_praktik);
    $d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo $e->getMessage();
}
try {
    $sql_institusi = "SELECT * FROM tb_institusi";
    $sql_institusi .= " WHERE id_institusi = " . $d_praktik['id_institusi'];
    $q_institusi = $conn->query($sql_institusi);
    $d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo $e->getMessage();
}


$ukuranFontIsi = "16px";
$img =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/logopemprov.png';

require_once($_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
// $options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

# ------------------------------------------------------------------------------------------------------------------------------------- HTML TARIF

//tag awal html
$html = '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <style>
    @page { 
        size: 21.5cm 33cm potrait; 
        margin: 1cm 1cm 0cm 1cm ; 
        }
        @font-face {
            font-family: "source_sans_proregular";           
            src: local("Source Sans Pro"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }        
        body{
            font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;            
        }
        header {
            position: fixed;
        }
        main {
            margin-top: 3.3cm;
            margin-top: 0cm;
        }
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height : 0.5cm;
            vertical-align: bottom;
            font-size: ' . $ukuranFontIsi . ';
            line-height: 10px;
        }
        .s {
            padding: 3px 3px 3px 3px;
            border: 1px solid black;
            border-collapse: collapse;
        }
        .cK {
            background-color: #8db4e2;
        }
        .page_break { page-break-before: always; }
    </style>

</head>
';

//tag buka body
$html .= '
<body>
';

//tag kop surat
$html .= '
<!--header -->
<table width="100%" border=0 >
    <tr>
        <th class="text-center">
            <img src="' . $img . '" style="width: 100px !important, heigth:150px !important;">
        </th>
        <td style="text-align: center;">
            <span style="line-height: 20px">
                <span style="font-size: 18.667px; ">PEMERINTAH DAERAH PROVINSI JAWA BARAT</span><br>
                <span style="font-size: 21.333px;"> DINAS KESEHATAN</span><br>
                <span style="font-weight: bold; font-size: 24px;"> RUMAH SAKIT JIWA</span><br>
            </span>
            <span style="line-height: 13px">
                <span style="font-size: 13.333px;">
                Jalan Kolonel Masturi KM. 7 – Cisarua Telepon: (022) 2700260<br>
                Fax: (022) 2700304 Website: www.rsj.jabarprov.go.id email: rsj@jabarprov.go.id<br>
                KABUPATEN BANDUNG BARAT – 40551
                </span>
            </span>
        </td>
    </tr>
</table>
<hr>
<!--/header-->
';

//judul Surat
$html .= '
<main>
<br>
<center style="font-size: 21.3333px; line-height: 18px"><b>DATA AKUN PRAKTIKAN SIPAPAP MACO</b></td></center>
<br>
';

//isi Judul
$html .= '
<table border="0" style="font-size: 12px; line-height: 18px">
    <tr style="vertical-align: text-top;">
        <td>
        Nama Institusi Pendidikan : <b>' . $d_institusi['nama_institusi'] . '</b><br>
        Nama Praktik : <b>' . $d_praktik['nama_praktik'] . '</b><br>
            Tanggal Mulai Praktik : <b>' . tanggal($d_praktik['tgl_mulai_praktik']) . '</b><br>
            Tanggal Selesai Praktik : <b>' . tanggal($d_praktik['tgl_selesai_praktik']) . '</b><br>
        </td>
        <td>
        Jurusan : <b>' . $d_praktik['nama_jurusan_pdd'] . '</b><br>
        Jenjang : <b>' . $d_praktik['nama_jenjang_pdd'] . '</b><br>
        Profesi : <b>' . $d_praktik['nama_profesi_pdd'] . '</b><br>
        Link Aplikasi : <b style="color:blue">https://s.id/SIPAPAPMACORSJ</b><br>
        </td>
    </tr>
</table>
<br>
';

//isi data
$html .= '
<table width="100%" style="font-size: 14.6667px;" class="s">
    <tr class="s" style="font-size: 14.6667px; background-color: #8db4e2;">
        <th class="s">NO</th>
        <th class="s">NAMA PRAKTIKAN</th>
        <th class="s">ID PRAKTIKAN</th>
        <th class="s">USERNAME</th>
        <th class="s">PASSWORD</th>
    </tr>
';

try {
    $sql_praktikan = "SELECT * FROM tb_praktikan";
    $sql_praktikan .= " WHERE id_praktik = " . $id_praktik;
    $q_praktikan = $conn->query($sql_praktikan);
} catch (Exception $ex) {
    // echo "<script>alert('-DATA praktikan-');";
    // echo "document.location.href='?error404';</script>";
}
$no = 1;
while ($d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC)) {
    $username = date('y') . $id_praktik . $d_praktikan['id_praktikan'];
    $password = "@RSJJABARSM" . $no;
    $html .= '
    <tr class="s" style="font-size: 12px;">
        <td class="s"><center>' . $no . '</center></td>
        <td class="s">' . $d_praktikan['nama_praktikan'] . '</td>
        <td class="s">' . $d_praktikan['no_id_praktikan'] . '</td>
        <td class="s">' . $username . '</td>
        <td class="s">' . $password . '</td>
    </tr>
    ';
    $no++;

    $sql_id_user = "SELECT MAX(id_user) AS ID FROM tb_user";
    $q_id_user  = $conn->query($sql_id_user);
    $d_id_user = $q_id_user->fetch(PDO::FETCH_ASSOC);
    $id_user = $d_id_user['ID'] + 1;

    $sql_update = "UPDATE tb_praktikan SET ";
    $sql_update .= " id_user = '" . $id_user . "'";
    $sql_update .= " WHERE id_praktikan = " . $d_praktikan['id_praktikan'];
    $conn->query($sql_update);

    $sql_delete_user = "DELETE FROM tb_user WHERE username_user ='" . $username . "'";
    $conn->query($sql_delete_user);

    $sql_insert_user = "INSERT INTO tb_user (";
    $sql_insert_user .= " id_user, ";
    $sql_insert_user .= " id_institusi, ";
    $sql_insert_user .= " username_user, ";
    $sql_insert_user .= " password_user, ";
    $sql_insert_user .= " nama_user, ";
    $sql_insert_user .= " email_user, ";
    $sql_insert_user .= " level_user,";
    $sql_insert_user .= " no_telp_user, ";
    $sql_insert_user .= " tgl_buat_user, ";
    $sql_insert_user .= " status_aktivasi_user, ";
    $sql_insert_user .= " status_user";
    $sql_insert_user .= " ) VALUES (";
    $sql_insert_user .= " '" . $id_user . "', ";
    $sql_insert_user .= " '" . $d_institusi['id_institusi'] . "', ";
    $sql_insert_user .= " '" . $username . "', ";
    $sql_insert_user .= " '" . md5($password) . "', ";
    $sql_insert_user .= " '" . $d_praktikan['nama_praktikan'] . "', ";
    $sql_insert_user .= " '" . $d_praktikan['email_praktikan'] . "', ";
    $sql_insert_user .= " '5', ";
    $sql_insert_user .= " '" . $d_praktikan['telp_praktikan'] . "',";
    $sql_insert_user .= " '" . date('Y-m-d', time()) . "', ";
    $sql_insert_user .= " 'Y',";
    $sql_insert_user .= " 'Y'";
    $sql_insert_user .= " )";
    // echo "<br>" . $sql_insert_user;
    $conn->query($sql_insert_user);
}
//tutup tabel data
$html .= '
</table>
';

//tag ttd surat
// $html .= '

// <table class="table table-dark">
// <tr>
//     <td width="420px">
//     </td>
//     <td style="text-align:center;">
//         KEPALA BAGIAN<br>
//         PENDIDIKAN, PELATIHAN, <br>
//         PENELITIAN DAN PENGEMBANGAN<br>
//     </td>
// </tr>
// <tr>
//     <td width="420px">
//     </td>
//     <td style="text-align:center;">
//     </td>
// </tr>
// </table>
// ';


//Footer
$html .= "
<footer>
<center>Dicetak Pada Jam : <b>" . date("G:i:s") . "</b>, Tanggal : <b>" . tanggal(date("Y-m-d")) . "</b></center>
</footer>
";
//tag tutup body
$html .= "</body>";

//tag tutup html
$html .= "</html>";

$dompdf->loadHtml($html);

// Setting ukuran dan orientasi kertas
// $customPaper = array(0, 0, 812.5984252, 1247.2440945);
// $dompdf->setPaper($customPaper, 'potrait');

// Rendering dari HTML Ke PDF
$dompdf->render();

// Melakukan output file Pdf
$dompdf->stream('akun_praktikan_' . $d_praktik['tgl_mulai_praktik'] . '_' . $d_praktik['tgl_selesai_praktik'] . '_' . $d_institusi['nama_institusi'] . '_' . $d_praktik['nama_praktik'] . '_.pdf');
