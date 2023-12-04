<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
if ($_POST['']) {
}
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/autoload.php";

// $id_praktik = decryptString($_GET['data'], $customkey);
// try {
//     $sql_praktik = "SELECT tb_praktik.id_praktik,tb_praktik.id_institusi, tb_praktik.nama_praktik, tb_praktik.tgl_mulai_praktik, tb_praktik.tgl_selesai_praktik, tb_jurusan_pdd.nama_jurusan_pdd, tb_jenjang_pdd.nama_jenjang_pdd, tb_profesi_pdd.nama_profesi_pdd FROM tb_praktik";
//     $sql_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
//     $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
//     $sql_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
//     $sql_praktik .= " WHERE tb_praktik.id_praktik = " . $id_praktik;
//     // echo $sql_praktik;
//     $q_praktik = $conn->query($sql_praktik);
//     $d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);
// } catch (Exception $ex) {
//     // echo "<script>alert('-DATA PRAKTIK-');";
//     // echo "document.location.href='?error404';</script>";
// }
// try {
//     $sql_institusi = "SELECT * FROM tb_institusi";
//     $sql_institusi .= " WHERE id_institusi = " . $d_praktik['id_institusi'];
//     $q_institusi = $conn->query($sql_institusi);
//     $d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC);
// } catch (Exception $ex) {
//     // echo "<script>alert('-DATA INSTITUSI-');";
//     // echo "document.location.href='?error404';</script>";
// }

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
$dompdf->stream('lap_akun_sipapap_maco.pdf');
exit();
