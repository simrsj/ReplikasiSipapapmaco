<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

//alamat file surat masuk
$alamat_unggah = "./../../_file/nilai";

// echo $alamat_unggah . "<br>";

//Cek Variable POST
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah)) {
    mkdir($alamat_unggah, 0777, $rekursif = true);
}

if ($_FILES['nilai_upload']['size'] > 0) {
    //ubah Nama File PDF
    $_FILES['nilai_upload']['name'] =  "nilai_upload_" . md5($_FILES['t_file']['name'] . date('Y-m-d H:i:s', time())) . ".pdf";

    //unggah surat dan data praktik
    if (!is_null($_FILES['nilai_upload'])) {
        $nilai_upload = (object) @$_FILES['nilai_upload'];

        //mulai unggah file surat praktik
        $unggah_nilai_upload = move_uploaded_file(
            $nilai_upload->tmp_name,
            "{$alamat_unggah}/{$nilai_upload->name}"
        );
        $alamat_unggah_nilai_upload = "./_file/nilai";
        $link_nilai_upload = "{$alamat_unggah_nilai_upload}/{$nilai_upload->name}";
    }
}

// echo $id . "_" . $link_nilai_upload . "  |  " . $link_file_data_praktikan;

//Cek Variable File
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$sql_update = "INSERT INTO tb_nilai_upload (";
$sql_update .= " id_pembimbing, ";
$sql_update .= " id_unit, ";
$sql_update .= " id_praktik,";
$sql_update .= " tgl_tambah_nilai_upload,";
$sql_update .= " file_nilai_upload";
$sql_update .= " )VALUES(";
$sql_update .= " " . $_POST['id_pembimbing'] . ", ";
$sql_update .= " " . $_POST['id_unit'] . ", ";
$sql_update .= " " . $_POST['id_praktik'] . ", ";
$sql_update .= " " . date('Y-m-d', time()) . ", ";
$sql_update .= " '" . $link_nilai_upload . "'";
$sql_update .= " )";

// echo $sql_update . "<br>";
$conn->query($sql_update);

echo json_encode(['success' => 'Data Praktik Berhasil Disimpan']);
