<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
//alamat file surat masuk
$alamat_unggah = "./../../_file/bayar";


$type = explode('/', $_FILES['t_file']['type']);
if ($_FILES['t_file']['size'] > 0) {

    //ubah Nama File PDF
    $_FILES['t_file']['name'] = "byr_" . md5($_FILES['t_file']['name'] . date('Y-m-d H:i:s', time())) . "." . $type[1];

    //unggah surat dan data praktik
    if (!is_null($_FILES['t_file'])) {
        $file_bayar = (object) @$_FILES['t_file'];

        //mulai unggah file surat praktik
        $unggah_file_bayar = move_uploaded_file(
            $file_bayar->tmp_name,
            "{$alamat_unggah}/{$file_bayar->name}"
        );
        $alamat_unggah_file_bayar = "./_file/bayar";
        $link_file_bayar = "{$alamat_unggah_file_bayar}/{$file_bayar->name}";
    }
}

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$sql_update_file = "UPDATE tb_bayar SET ";
$sql_update_file .= " file_bayar = '" . $link_file_bayar . "' ";
$sql_update_file .= " WHERE id_bayar = " . base64_decode(urldecode($_POST['idb']));

// echo $sql_update_file . "<br>";
$conn->query($sql_update_file);
