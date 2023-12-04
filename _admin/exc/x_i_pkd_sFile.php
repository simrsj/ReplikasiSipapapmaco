<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$id = base64_decode(urldecode($_POST['id']));

//alamat file surat masuk
$alamat_unggah = "./../../_file/pkd";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah)) {
    mkdir($alamat_unggah, 0777, $rekursif = true);
}

//cek data kesesuaian file 
if ($_FILES['file_surat']['size'] > (1024 * 1024)) {
    $ket = "size";
} else if ($_FILES['file_surat']['type'] != "application/pdf") {
    $ket = "type";
} else {
    if ($_FILES['file_surat']['size'] > 0) {
        //ubah Nama File PDF
        $_FILES['file_surat']['name'] = "file_surat_pkd" . md5($_FILES['file_surat']['name'] . date('Y-m-d H:i:s', time())) . ".pdf";

        //unggah surat dan data praktik
        if (!is_null($_FILES['file_surat'])) {
            $file_surat = (object) @$_FILES['file_surat'];

            //mulai unggah file surat praktik
            $unggah_file_surat = move_uploaded_file(
                $file_surat->tmp_name,
                "{$alamat_unggah}/{$file_surat->name}"
            );
            $alamat_unggah_file_surat = "./_file/pkd";
            $link_file_surat = "{$alamat_unggah_file_surat}/{$file_surat->name}";
        }
    }

    $q = base64_decode(urldecode($_POST['q']));
    $sql_update = "UPDATE tb_pkd SET ";
    $sql_update .= " file_surat_pkd = '" . $link_file_surat . "'";
    $sql_update .= " WHERE id_pkd = " . $id;
    // echo $q . "<br>";
    // echo $sql_update . "<br>";
    try {
        $conn->query($q);
        $conn->query($sql_update);
        $ket = "Berhasil Tersimpan";
    } catch (Exception $ex) {
        echo "<script>alert('$ex -SIMPAN FILE PKD-');";
        echo "document.location.href='?error404';</script>";
    }
}

echo json_encode(['ket' => $ket]);
