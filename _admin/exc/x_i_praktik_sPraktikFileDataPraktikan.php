<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

$id = $_POST['id'];

//alamat file surat masuk
$alamat_unggah = "./../../_file/praktik";


if ($_FILES['file_data_praktikan']['size'] > 0) {
    //ubah Nama File PDF
    $_FILES['file_data_praktikan']['name'] = "data_praktikan_" . $id . "_" . date('Y-m-d', time()) . ".xlsx";

    //unggah surat dan data praktik
    if (!is_null($_FILES['file_data_praktikan'])) {
        $file_data_praktikan = (object) @$_FILES['file_data_praktikan'];

        //mulai unggah file surat praktik
        $unggah_file_data_praktikan = move_uploaded_file(
            $file_data_praktikan->tmp_name,
            "{$alamat_unggah}/{$file_data_praktikan->name}"
        );
        $alamat_unggah_file_data_praktikan = "./_file/praktik";
        $link_file_data_praktikan = "{$alamat_unggah_file_data_praktikan}/{$file_data_praktikan->name}";
    }
}

// echo $id . "_" . $link_file_surat . "  |  " . $link_file_data_praktikan;

//Cek Variable File
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$sql_update = "UPDATE tb_praktik SET 
    data_praktik = '" . $link_file_data_praktikan . "'
    WHERE id_praktik = $id
    ";

// echo $sql_update . "<br>";
$conn->query($sql_update);
