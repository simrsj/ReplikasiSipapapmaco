<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";

$idp = decryptString($_POST['idp'], $customkey);

//alamat file surat masuk
$alamat_unggah = "./../../_file/praktik";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah)) {
    mkdir($alamat_unggah, 0777, $rekursif = true);
}

if (
    $_FILES['file_surat']['size'] > 3072 * 1024 ||
    $_FILES['file_akred_institusi']['size'] > 3072 * 1024 ||
    $_FILES['file_akred_jurusan']['size'] > 3072 * 1024
) {
    $dataJSON['ket'] = "size";
} else if (
    $_FILES['file_surat']['type'] == "application\/pdf" ||
    $_FILES['file_akred_institusi']['type'] == "application\/pdf" ||
    $_FILES['file_akred_jurusan']['type'] == "application\/pdf"
) {
    $dataJSON['ket'] = "type";
} else {


    if ($_FILES['file_surat']['size'] > 0) {
        //ubah Nama File PDF
        $_FILES['file_surat']['name'] = "file_surat_" . $idp . "_" . md5($_FILES['file_surat']['name']) . "_" . date('Y-m-d') . ".pdf";

        //unggah surat dan data praktik
        if (!is_null($_FILES['file_surat'])) {
            $file_surat = (object) @$_FILES['file_surat'];

            //mulai unggah file surat praktik
            $unggah_file_surat = move_uploaded_file(
                $file_surat->tmp_name,
                "{$alamat_unggah}/{$file_surat->name}"
            );
            $alamat_unggah_file_surat = "./_file/praktik";
            $link_file_surat = "{$alamat_unggah_file_surat}/{$file_surat->name}";
        }
    }

    if ($_FILES['file_akred_institusi']['size'] > 0) {
        //ubah Nama File PDF
        $_FILES['file_akred_institusi']['name'] = "file_akred_institusi_" . $idp . "_" . md5($_FILES['file_akred_institusi']['name']) . "_" . date('Y-m-d') . ".pdf";

        //unggah surat dan data praktik
        if (!is_null($_FILES['file_akred_institusi'])) {
            $file_akred_institusi = (object) @$_FILES['file_akred_institusi'];

            //mulai unggah file surat praktik
            $unggah_file_akred_institusi = move_uploaded_file(
                $file_akred_institusi->tmp_name,
                "{$alamat_unggah}/{$file_akred_institusi->name}"
            );
            $alamat_unggah_file_akred_institusi = "./_file/praktik";
            $link_file_akred_institusi = "{$alamat_unggah_file_akred_institusi}/{$file_akred_institusi->name}";
        }
    }

    if ($_FILES['file_akred_jurusan']['size'] > 0) {
        //ubah Nama File PDF
        $_FILES['file_akred_jurusan']['name'] = "file_akred_jurusan_" . $idp . "_" . md5($_FILES['file_akred_jurusan']['name']) . "_" . date('Y-m-d') . ".pdf";

        //unggah surat dan data praktik
        if (!is_null($_FILES['file_akred_jurusan'])) {
            $file_akred_jurusan = (object) @$_FILES['file_akred_jurusan'];

            //mulai unggah file surat praktik
            $unggah_file_akred_jurusan = move_uploaded_file(
                $file_akred_jurusan->tmp_name,
                "{$alamat_unggah}/{$file_akred_jurusan->name}"
            );
            $alamat_unggah_file_akred_jurusan = "./_file/praktik";
            $link_file_akred_jurusan = "{$alamat_unggah_file_akred_jurusan}/{$file_akred_jurusan->name}";
        }
    }

    $sql_update = "UPDATE tb_praktik SET ";
    $sql_update .= " surat_praktik = '" . $link_file_surat . "',";
    $sql_update .= " akred_institusi_praktik = '" . $link_file_akred_institusi . "',";
    $sql_update .= " akred_jurusan_praktik = '" . $link_file_akred_jurusan . "'";
    $sql_update .= " WHERE id_praktik = " . $idp;
    // echo $sql_update . "<br>";

    $conn->query(decryptString($_POST['q'], $customkey));
    $conn->query($sql_update);
    $dataJSON['ket'] = "Y";
}

// $dataJSON['file'] = $_FILES['file_surat']['type'];
// $dataJSON['dataFILES'] = print_r($_FILES);
// $dataJSON['dataPOST'] = print_r($_POST);
echo json_encode($dataJSON);
