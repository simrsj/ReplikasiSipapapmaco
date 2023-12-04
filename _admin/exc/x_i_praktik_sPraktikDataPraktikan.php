<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/phpspreadsheet/autoload.php";

// --------------------------------------SIMPAN DATA PRAKTIK--------------------------------------------

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['file_data_praktikan']['name']) && in_array($_FILES['file_data_praktikan']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['file_data_praktikan']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['file_data_praktikan']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    for ($i = 1; $i < count($sheetData); $i++) {
        $nama = $sheetData[$i]['1'];
        $id_p = $sheetData[$i]['2'];
        $hp = $sheetData[$i]['3'];
        $wa = $sheetData[$i]['4'];
        $email = $sheetData[$i]['5'];
        $kota_kab = $sheetData[$i]['6'];
        $sql = "INSERT INTO tb_praktikan ";
        $sql .= " (id_praktik, nama_praktikan,no_id_praktikan,telp_praktikan, wa_praktikan, email_praktikan, kota_kab_praktikan, tgl_input_praktikan ) ";
        $sql .= " VALUES ";
        $sql .= " (" . $_POST['id'] . ",'$nama','$id_p','$hp','$wa','$email','$kota_kab', '" . date('Y-m-d', time()) . "')";
        // echo "$sql<br>";
        $conn->query($sql);
    }
}
