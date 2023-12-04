<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

# ------------------------------------------------------------------------------------------------------------------------------------- CONNECTION
$servername = "localhost";
$database = "db_sm";
$username = "root";
$password = "simrs12345";

try {
    $conn = new PDO(
        "mysql:host=$servername; dbname=$database",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

# ------------------------------------------------------------------------------------------------------------------------------------- EXC. DATABASE & GET VARIABLE

$sql_praktik = "SELECT * FROM tb_praktik";
$sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
$sql_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
$sql_praktik .= " WHERE tb_praktik.id_praktik = " . $_GET['ip'];
$q_praktik = $conn->query($sql_praktik);
$d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

//ukuran font ditentukan jurusan
$ukuranFontIsi = "16px";

//logo Gambar
$img =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/logopemprov.png';

//spesimen tte edi sutardi
$tte_edi =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/tte/edi_sutardi.jpeg';

//Cari Data Nilai
$sql_nilai = " SELECT * FROM `tb_pembimbing_pilih`";
$sql_nilai .= " JOIN tb_nilai_kep ON tb_pembimbing_pilih.id_pembimbing = tb_nilai_kep.id_pembimbing";
$sql_nilai .= " JOIN tb_unit ON tb_pembimbing_pilih.id_unit = tb_unit.id_unit";
$sql_nilai .= " JOIN tb_praktikan ON tb_nilai_kep.id_praktikan = tb_praktikan.id_praktikan ";
$sql_nilai .= " WHERE tb_nilai_kep.id_praktik = " . $_GET['ip'];
$sql_nilai .= " GROUP BY tb_praktikan.id_praktikan";
$q_nilai = $conn->query($sql_nilai);

# ------------------------------------------------------------------------------------------------------------------------------------- FUNCTION

//format tanggal Contoh : 23 Maret 2022
function tanggal($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

# ------------------------------------------------------------------------------------------------------------------------------------- LIB. DOMPDF
require_once("../vendor/dompdf/autoload.inc.php");

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
            height : 2cm;
            vertical-align: bottom;
            font-size: ' . $ukuranFontIsi . ';
            line-height: 15px;
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
<center style="font-size: 21.3333px; line-height: 18px"><u><b>REKAPITULASI NILAI KUMULATIF MAHASISWA</b></u></td></center>
<br>
';
//isi Judul
$html .= '
<table border="0" style="font-size: ' . $ukuranFontIsi . '; line-height: 18px">
    <tr style="vertical-align: text-top;">
        <td>
            NAMA INSTUTUSI PENDIDIKAN<br>
            PROGRAM STUDI<br>
            TANGGAL PRAKTIK
        </td>
        <td>
            : ' . $d_praktik['nama_institusi'] . ' <br>
            : ' . $d_praktik['nama_jenjang_pdd'] . ' KEPERAWATAN<br>
            : ' . tanggal($d_praktik['tgl_mulai_praktik']) . ' S.D. ' . tanggal($d_praktik['tgl_selesai_praktik']) . ' <br>
        </td>
    </tr>
</table>
<br>
';

//isi data nilai
$html .= '
<table width="100%" style="font-size: 14.6667px;" class="s">
    <tr class="s" style="font-size: 14.6667px; background-color: #8db4e2;">
        <th class="s" rowspan="2">NO</th>
        <th class="s" rowspan="2">NAMA MAHASISWA</th>
        <th class="s" colspan="10">NILAI </th>
        <th class="s" rowspan="2">RUANGAN</th>
        <th class="s" rowspan="2">KET</th>
    </tr>
    <tr class="s" style="font-size: 9.3333px; background-color: #8db4e2;">
        <th class="s" width="20px">LP</th>
        <th class="s" width="20px">Pre-<br>Post</th>
        <th class="s" width="20px">SPTK</th>
        <th class="s" width="20px">PENKES</th>
        <th class="s" width="20px">DOKEP</th>
        <th class="s" width="20px">ASKEP</th>
        <th class="s" width="20px">KOMTER</th>
        <th class="s" width="20px">TAK</th>
        <th class="s" width="20px">RESUME</th>
        <th class="s" width="20px">SIKAP</th>
    </tr>
';

//isi baris table nilai
$no = 1;
while ($d_nilai = $q_nilai->fetch(PDO::FETCH_ASSOC)) {

    // nilai lp
    if ($d_nilai["lp"] == 0) {
        $lp = "cK";
        $nLp = "";
    } else {
        $lp = "";
        $nLp = $d_nilai["lp"];
    }

    //Nilai prepost
    if ($d_nilai["prepost"] == 0) {
        $prepost = "cK";
        $nPrepost = "";
    } else {
        $prepost = "";
        $nPrepost = $d_nilai["prepost"];
    }

    //nilai sptk
    if ($d_nilai["sptk"] == 0) {
        $sptk = "cK";
        $nSptk = "";
    } else {
        $sptk = "";
        $nSptk = $d_nilai["sptk"];
    }

    //nilai penkes
    if ($d_nilai["penkes"] == 0) {
        $penkes = "cK";
        $nPenkes = "";
    } else {
        $penkes = "";
        $nPenkes = $d_nilai["penkes"];
    }

    //nilai dokep
    if ($d_nilai["dokep"] == 0) {
        $dokep = "cK";
        $nDokep = "";
    } else {
        $dokep = "";
        $nDokep = $d_nilai["dokep"];
    }

    //nilai komter
    if ($d_nilai["komter"] == 0) {
        $komter = "cK";
        $nKomter = "";
    } else {
        $komter = "";
        $nKomter = $d_nilai["komter"];
    }

    //nilai tak
    if ($d_nilai["tak"] == 0) {
        $tak = "cK";
        $nTak = "";
    } else {
        $tak = "";
        $nTak = $d_nilai["tak"];
    }

    //nilai kasus
    if ($d_nilai["kasus"] == 0) {
        $kasus = "cK";
        $nKasus = "";
    } else {
        $kasus = "";
        $nKasus = $d_nilai["kasus"];
    }

    //nilai ujian
    if ($d_nilai["ujian"] == 0) {
        $ujian = "cK";
        $nUjian = "";
    } else {
        $ujian = "";
        $nUjian = $d_nilai["ujian"];
    }

    //nilai Sikap
    if ($d_nilai["sikap"] == 0) {
        $sikap = "cK";
        $nSikap = "";
    } else {
        $sikap = "";
        $nSikap = $d_nilai["sikap"];
    }

    $html .= '
        <tr  class="s" style="text-align: center;">
            <td class="s">' . $no . '</td>
            <td class="s" style="text-align: left;">' . $d_nilai["nama_praktikan"] . '</td>
            <td class="s ' . $lp . '">' . $nLp . '</td>
            <td class="s ' . $prepost . '">' . $nPrepost . '</td>
            <td class="s ' . $sptk . '">' . $nSptk . '</td>
            <td class="s ' . $penkes . '">' . $nPenkes . '</td>
            <td class="s ' . $dokep . '">' . $nDokep . '</td>
            <td class="s ' . $komter . '">' . $nKomter . '</td>
            <td class="s ' . $tak . '">' . $nTak . '</td>
            <td class="s ' . $kasus . '">' . $nKasus . '</td>
            <td class="s ' . $ujian . '">' . $nUjian . '</td>
            <td class="s ' . $sikap . '">' . $nSikap . '</td>
            <td class="s">' . $d_nilai["nama_unit"] . '</td>
            <td class="s">' . $d_nilai["ket_nilai"] . '</td>
        </tr>
        ';
    $no++;
}

//tutup tabel nilai
$html .= '
</table>
';

//tag ttd surat
$html .= '
<table border="1" style="font-size: ' . $ukuranFontIsi . '; line-height: 18px; width: 100% !important">
<tr>
    <td width="420px">
    </td>
    <td style="text-align:center;">
        KEPALA BAGIAN<br>
        PENDIDIKAN, PELATIHAN, <br>
        PENELITIAN DAN PENGEMBANGAN<br>
    </td>
</tr>
<tr>
    <td width="420px">
    </td>
    <td style="text-align:center;">
        <img src="' . $tte_edi . '" style="width: 200px !important, heigth: 100px !important;">
    </td>
</tr>
</table>
';

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
$dompdf->stream('Data Nilai.pdf');
