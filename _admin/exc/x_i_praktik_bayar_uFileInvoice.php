<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
//alamat file surat masuk
$alamat_unggah = "./../../_file/invoice";


$type = explode('/', $_FILES['file_invoice']['type']);
if ($_FILES['file_invoice']['size'] > 0) {

    //ubah Nama File PDF
    $_FILES['file_invoice']['name'] = "invoice_" .   md5($_FILES['t_file']['name'] . date('Y-m-d H:i:s', time())) . "." . $type[1];

    //unggah surat dan data praktik
    if (!is_null($_FILES['file_invoice'])) {
        $file_invoice = (object) @$_FILES['file_invoice'];

        //mulai unggah file surat praktik
        $unggah_file_invoice = move_uploaded_file(
            $file_invoice->tmp_name,
            "{$alamat_unggah}/{$file_invoice->name}"
        );
        $alamat_unggah_file_invoice = "./_file/invoice";
        $link_file_invoice = "{$alamat_unggah_file_invoice}/{$file_invoice->name}";
    }
}

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$sql_update_file = "UPDATE tb_praktik SET ";
$sql_update_file .= " fileInv_praktik = '" . $link_file_invoice . "' ";
$sql_update_file .= " WHERE id_praktik = " . base64_decode(urldecode($_POST['idp']));

// echo $sql_update_file . "<br>";
$conn->query($sql_update_file);
