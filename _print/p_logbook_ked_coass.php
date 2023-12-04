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

$id_praktikan = decryptString($_GET['data'], $customkey);
try {
  $sql = "SELECT * FROM tb_praktik";
  $sql .= " JOIN tb_praktikan ON tb_praktik.id_praktik = tb_praktikan.id_praktik";
  $sql .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
  $sql .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
  $sql .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
  $sql .= " WHERE tb_praktikan.id_praktikan = " . $id_praktikan;
  // echo $sql;
  $q = $conn->query($sql);
  $d = $q->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  echo $e->getMessage();
}
try {
  $sql_institusi = "SELECT * FROM tb_institusi";
  $sql_institusi .= " WHERE id_institusi = " . $d['id_institusi'];
  // echo $sql_institusi;
  $q_institusi = $conn->query($sql_institusi);
  $d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  echo $e->getMessage();
}

$ukuranFontIsi = "16px";
$img =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/logopemprov.png';
$cover =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/logo_logbook_ked_coass.png';
$css =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_add-ons/cssCustom.css';

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
        size: 14.85cm 21cm potrait; 
        margin: 1cm 1cm 0cm 2cm ; 
        }        
        body{
            // font-family: "source_sans_proregular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;  
            font-family: "Times New Roman", Times, serif;          
        }
        header {
            position: fixed;
        }
        main {
            margin-top: 3.3cm;
            margin-top: 0cm;
        }
        table {
          border-collapse: collapse;
          width: 100%;
        }
  
        th,
        td {
          border: 1px solid black;
          padding: 3px;
        }
  
        .border-0 {
          border: 0px solid black;
          padding: 3px;
        }
  
        .border-1 {
            border: 1px solid;
            position: sticky;
            border-radius: 5px;
            border-spacing: 0cap;
            border-width:1px !important;
        }
        th {
          background-color: #f2f2f2;
        }
        .fs-18 {font-size: 25px;}
        .fs-16 {font-size: 21.3333px;}
        .fs-14 {font-size: 18.6667px;}
        .fs-12 {font-size: 16px;}
        .fs-10 {font-size: 13.3333px;}
        .fs-8 {font-size: 10.6667px;}
        .f-arial {font-family: Arial, sans-serif;}
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
        .my-auto {
          margin-bottom: auto !important;
          margin-top: auto !important;
        }
        .page_break { page-break-before: always; }
        .b{ font-weight: bolder; }
        .i{ font-style: italic; }
        .u{ text-decoration: underline; }
        .t-center { text-align: center;}
        .t-right { text-align: right;}
        .t-justify {text-align: justify;}
    </style>
</head>
';

//tag buka body
$html .= '
<body>
';

//cover
$html .= '
<center class="b fs-18 f-arial">
    BUKU LOG PENDIDIKAN KLINIK<br>
    ILMU KEDOKTERAN JIWA<br>
    RS JIWA PROVINSI JAWA BARAT<br>
    <br><br>
    <img src="' . $cover . '" style="width: 85% !important, heigth:90% !important;">
    <br><br><br>
    RUMAH SAKIT JIWA<br>
    PROVINSI JAWA BARAT
</center>
';

//hal baru
$html .= '
<div class="page_break"></div>
';

//biodata
$html .= '
<center class="">
    <b>BIODATA MAHASISWA</b><br><br>
    <img src="' . $d['foto_praktikan'] . '" style="width: 120px !important, heigth:180px !important;" alt="Foto Tidak Ada"><br><br><br>
    <table width="100%" class="border-0">
        <tr>
            <td>
                NAMA
            </td>
            <td>
                : ' . $d['nama_praktikan'] . '
            </td><br><br>
        </tr>
        <tr>
            <td>
                NPM
            </td>
            <td>
                : ' . $d['no_id_praktikan'] . '
            </td><br><br>
        </tr>
        <tr>
            <td>
                TANGGAL LAHIR
            </td>
            <td>
                : ' . tanggal($d['tgl_lahir_praktikan']) . '
            </td><br><br>
        </tr>
        <tr>
            <td>
                KELOMPOK
            </td>
            <td>
                : ' . $d['nama_praktik'] . '
            </td><br><br>
        </tr>
        <tr>
            <td>
                PERIODE
            </td>
            <td>
                : ' . tanggal($d['tgl_mulai_praktik']) . ' - ' . tanggal($d['tgl_selesai_praktik']) . '
            </td><br><br>
        </tr>
        <tr>
            <td>
                ALAMAT
            </td>
            <td>
                : ' . $d['alamat_praktikan'] . '
            </td><br><br>
        </tr>
        <tr>
            <td>
                NOMOR HP
            </td>
            <td>
                : ' . $d['telp_praktikan'] . ' - WA(' . $d['telp_praktikan'] . ')
            </td><br><br>
        </tr>
        <tr>
            <td>
            </td>
            <td class="t-right">
            Cisarua, ' . tanggal(date('Y-m-d')) . '
            </td><br><br>
        </tr>
        <tr class="t-center">
            <td>
            Mahasiswa<br><br><br><br><br><br><br>
            </td>
            <td>
                Ketua Tim Koordinator Pendidikan<br>
                Rumah Sakit Jiwa <br>
                Provinsi Jawa Barat<br><br><br><br><br>
            </td>
        </tr>
        <tr class="t-center">
            <td>
            (' . $d['nama_praktikan'] . ')
            </td>
            <td>
                (Lina Budiyanti, dr., Sp.KJ.)
            </td>
        </tr>
    </table>
</center>
';

//hal baru
$html .= '
<div class="page_break"></div>
';

//TUJUAN BEMBELAJARAN
$html .= '
<center class="">
    <b>TUJUAN PEMBELAJARAN</b><br><br>
</center>
<div class="t-justify">
    Setelah menjalani stase Ilmu Kedokteran Jiwa di Rumah Sakit Jiwa  Provinsi Jawa Barat, mahasiswa tahap profesi diharapkan akan mampu :
    <ol>
    <li>Membentuk rapport yang baik dalam hubungan dokter-pasien</li>
    <li>Melakukan investigasi (observasi serta anamnesis) psikiatrik</li>
    <li>Melakukan pemeriksaan status mental sesuai pedoman yang ditetapkan</li>
    <li>Menegakkan Diagnosis Multiaksial, dan/Diagnosis Kerja dan Diagnosis Banding (DK/DD)</li>
    <li>Memperkirakan prognosis</li>
    <li>Memelih serta mengusulkan pemeriksaan tambahan /penunjang yang dibutuhkan</li>
    <li>Merencanakan Penatalaksanaan yang benar dan rasional</li>
    <li>Membantu secara ilmiah serta selalu tanggap terhadap apa yang terjadi/ mungkin terjadi pada pasien yang dikelola</li>
    <li>Melaksanakan pelayanan kesehatan jiwa rawat jalan/rawat inap/intensif/IGD</li>
    <li>Melaksanakan penyuluhan kesehatan jiwa masyarakat</li>
    <li>Melakukan pengelolaan awal dan rujukan pada kasus-kasus gangguan jiwa</li>
    <li>Bersikap professional dalam melakukan pelayanan medis yang dilandasi oleh <i>Good Medical Practitice</i></li>
    </ol>
</div>
';

//hal baru
$html .= '
<div class="page_break"></div>
';

//MATERI PEMBELAJARAN SESUAI TINGKAT KOMPETENSI SKDI
$html .= '
<center>
  <b>MATERI PEMBELAJARAN SESUAI TINGKAT KOMPETENSI SKDI</b><br />
  <div class="fs-12 ">
    Daftar Penyakit sesuai Standar Kompetensi Dokter Indonesia Tahun 2019.
  </div>
  <table width="100%" border="1">
    <tr>
      <th style="width: 20px">No.</th>
      <th>POKOK BAHASAN</th>
      <th>SUB POKOK BAHASAN</th>
    </tr>
    <tr>
      <td colspan="3" class="t-center"><b>Daftar Penyakit Ilmu Kesehatan Jiwa</b></td>
    </tr>
    <tr>
      <td>1.</td>
      <td>Gangguan somatoform, Insomnia</td>
      <td>
        Definisi, diagnosis, pemeriksaan penunjang/psikometri, tatalaksana
        psikofarmaka, tatalaksana nonpsikofarmaka, rujukan
      </td>
    </tr>
    <tr>
      <td>2.</td>
      <td>
        Gangguan Cemas menyeluruh, PTSD, Gangguan cemas baur depresi, gangguan
        panik, trokotilomani
      </td>
      <td>
        Definisi, diagnosis, pemeriksaan penunjang/psikometri, tatalaksana awal,
        rujukan
      </td>
    </tr>
    <tr>
      <td>3.</td>
      <td>
        Fobia, Gangguan obsesif konvulsif, Gangguan penyesuaian, Reaksi stres
        akut
      </td>
      <td>
        Definisi, diagnosis, pemeriksaan penunjang/psikometri, tatalaksana awal,
        rujukan
      </td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Disfungsi seksual</td>
      <td>Definisi, Diagnosis, rujukan</td>
    </tr>
    <tr>
      <td>5.</td>
      <td>Gangguan psikotik</td>
      <td>Definisi, diagnosis, pemeriksaan tatalaksana awal, rujukan</td>
    </tr>
    <tr>
      <td>6.</td>
      <td>Delirium</td>
      <td>Definisi, diagnosis, pemeriksaan tatalaksana awal, rujukan</td>
    </tr>
    <tr>
      <td>7.</td>
      <td>Retardasi Mental</td>
      <td>Definisi, diagnosis, pemeriksaan tatalaksana awal, rujukan</td>
    </tr>
    <tr>
      <td>8.</td>
      <td>Gangguan spektrum autisme, GPPH, Gangguan tingkah laku</td>
      <td>Definisi, Diagnosis, rujukan</td>
    </tr>
    <tr>
      <td>9.</td>
      <td>Gangguan makan</td>
      <td>Definisi, diagnosis, rujukan</td>
    </tr>
    <tr>
      <td>10.</td>
      <td>Gangguan mood</td>
      <td>Definisi, diagnosis, pemeriksaan tatalaksana awal, rujukan</td>
    </tr>
    <tr>
      <td>11.</td>
      <td>Gangguan kepribadian dan perilaku masa dewasa</td>
      <td>Definisi, diagnosis, rujukan</td>
    </tr>
    <tr>
      <td>12.</td>
      <td>Adiksi/ketergantungan narkoba</td>
      <td>Definisi, diagnosis, pemeriksaan tatalaksana awal, rujukan</td>
    </tr>
    <tr>
      <td>13.</td>
      <td>Adiksi/ketergantungan narkoba</td>
      <td>Definisi, diagnosis, pemeriksaan tatalaksana awal, rujukan</td>
    </tr>
  </table>
</center>
';

//hal baru
$html .= '
<div class="page_break"></div>
';

//DAFTAR KETERAMPILAN KLINIS SESUAI STANDAR KOMPETENSI DOKTER INDONESIA 2019
$html .= '
<center>
  <b>
    DAFTAR KETERAMPILAN KLINIS SESUAI<br />
    STANDAR KOMPETENSI DOKTER INDONESIA 2019
  </b>
  <table width="100%" border="1">
    <tr>
      <th style="width: 20px">No.</th>
      <th colspan="2" class="t-center">Daftar Keterampilan</th>
    </tr>
    <tr>
      <td rowspan="5">1.</td>
      <td rowspan="5">Anamnesis</td>
      <td>Autoanamnesis dengan pasien</td>
    </tr>
    <tr>
      <td>Alloanamnesis dengan anggota keluarga/orang lain, yang bermakna</td>
    </tr>
    <tr>
      <td>Memperoleh data mengenai keluhan/masalah utama</td>
    </tr>
    <tr>
      <td>Menelusuri riwayat perjalanan penyakit sekarang/dahulu</td>
    </tr>
    <tr>
      <td>
        Memperoleh data bermakna mengenai riwayat, perkembangan, pendidikan,
        pekerjaan, perkawinan, kehidupan keluarga
      </td>
    </tr>
    <tr>
      <td rowspan="13">2.</td>
      <td rowspan="13">Pemeriksaan Psikiatri</td>
      <td>Penilaian status mental</td>
    </tr>
    <tr>
      <td>Penilaian kesadaran</td>
    </tr>
    <tr>
      <td>Penilaian persepsi orientasi intelegensi secara klinis</td>
    </tr>
    <tr>
      <td>Penilaian orientasi</td>
    </tr>
    <tr>
      <td>Penilaian intelegensi secara klinis</td>
    </tr>
    <tr>
      <td>Penilaian bentuk dan isi pikir</td>
    </tr>
    <tr>
      <td>Penilaian <i>mood</i> dan afek</td>
    </tr>
    <tr>
      <td>Penilaian motorik</td>
    </tr>
    <tr>
      <td>Penilaian pengendalian impuls</td>
    </tr>
    <tr>
      <td>Penilaian kemampuan menilai realitas (<i>judgement</i>)</td>
    </tr>
    <tr>
      <td>Penilaian kemampuan tilikan (<i>insight</i>)</td>
    </tr>
    <tr>
      <td>
        Penilaian kemampuan fungsional (<i>general assessment of functioning</i
        >)
      </td>
    </tr>
    <tr>
      <td>Tes kepribadian (proyektif, inventori, dll)<br><br><br><br></td>
    </tr>
    <tr>
      <td rowspan="6">3.</td>
      <td rowspan="6">Diagnosis Dan Identifikasi Masalah</td>
      <td>
        Menegakkan diagnosis kerja berdasarkan kriteria, diagnosis multiaksial
      </td>
    </tr>
    <tr>
      <td>Membuat diagnosis banding (diagnosis differensial)</td>
    </tr>
    <tr>
      <td>Identifikasi kedaruratan psikiatrik</td>
    </tr>
    <tr>
      <td>Identifikasi masalah di bidang fisik, psikologis, sosial</td>
    </tr>
    <tr>
      <td>Mempertimbangan prognosis</td>
    </tr>
    <tr>
      <td>Menentukan indikasi rujuk</td>
    </tr>
    <tr>
      <td rowspan="4">4.</td>
      <td rowspan="4">Pemeriksaan Tambahan</td>
      <td>Melakukan Mini Mental State Examination</td>
    </tr>
    <tr>
      <td>Melakukan kunjungan rumah apabila diperlukan</td>
    </tr>
    <tr>
      <td>Melakukan kerjasama konsultatif dengan teman Sejawat lainnya</td>
    </tr>
    <tr>
      <td>Melakukan deteksi dini gangguan mental emosional pada anak</td>
    </tr>
    <tr>
      <td rowspan="9">5.</td>
      <td rowspan="9">Terapi</td>
      <td>
        Memberikan terapi psikofarmaka (obat-obatantipsikotik, anticemas,
        antidepresan, antikolinergik, sedatif)
      </td>
    </tr>
    <tr>
      <td><i>Electroconvulsion therapy</i> (ECT)</td>
    </tr>
    <tr>
      <td>Psikoterapi suportif: konselling</td>
    </tr>
    <tr>
      <td>Psikoterapi modifikasi perilaku</td>
    </tr>
    <tr>
      <td><i>Cognitive Behavior Therapy</i> (CBT)</td>
    </tr>
    <tr>
      <td>Psikoterapi psikoanalitik</td>
    </tr>
    <tr>
      <td><i>GroupTherapy</i></td>
    </tr>
    <tr>
      <td><i>Family Therapy</i></td>
    </tr>
    <tr>
      <td>Edukasi Keluarga</td>
    </tr>
  </table>
</center>
';

//hal baru
$html .= '
<div class="page_break"></div>
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
$dompdf->stream('logbook_ked_coass_' . $d['tgl_mulai_praktik'] . '_' . $d['tgl_selesai_praktik'] . '_' . $d_institusi['nama_institusi'] . '_' . $d['nama_praktikan'] . '.pdf');
// $dompdf->stream('logbook_ked_coass_.pdf');
