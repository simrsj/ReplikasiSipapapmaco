<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$id = $_POST['id_user'];
$foto_asal = $_POST['foto_asal'];

//Cek Variable File
// echo "<pre>";
// print_r($_FILES);
// print_r($_POST);
// echo "</pre>";

$alamat_unggah_foto = "./../../_img/akun";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah_foto)) {
    mkdir($alamat_unggah_foto, 0777, $rekursif = true);
}

//foto dari Data ubah
if ($foto_asal == 'ubah') {
    if ($_FILES['u_foto']['size'] > 0) {
        $extensi_file = pathinfo($_FILES['u_foto']['name'], PATHINFO_EXTENSION);
        //ubah Nama foto
        $_FILES['u_foto']['name'] = $id . "." . $extensi_file;

        //unggah 
        if (!is_null($_FILES['u_foto'])) {
            $foto = (object) @$_FILES['u_foto'];

            //mulai unggah file 
            $unggah_foto = move_uploaded_file(
                $foto->tmp_name,
                "{$alamat_unggah_foto}/{$foto->name}"
            );
            $alamat_unggah_foto = "./_img/akun";

            // link alamat file 
            $link_foto = "{$alamat_unggah_foto}/{$foto->name}";
        }
    }
} //foto dari Data tambah
else {
    if ($_FILES['c_foto']['size'] > 0) {
        $extensi_file = pathinfo($_FILES['c_foto']['name'], PATHINFO_EXTENSION);
        //ubah Nama foto
        $_FILES['c_foto']['name'] = $id . "." . $extensi_file;

        //unggah 
        if (!is_null($_FILES['c_foto'])) {
            $foto = (object) @$_FILES['c_foto'];

            //mulai unggah file 
            $unggah_foto = move_uploaded_file(
                $foto->tmp_name,
                "{$alamat_unggah_foto}/{$foto->name}"
            );
            $alamat_unggah_foto = "./_img/akun";

            // link alamat file 
            $link_foto = "{$alamat_unggah_foto}/{$foto->name}";
        }
    }
}

//Cek Variable File
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$sql_u_foto = "UPDATE tb_user SET ";
$sql_u_foto .= " foto_user = '" . $link_foto . "'";
$sql_u_foto .= " WHERE id_user = " . $id;

// echo $sql_u_foto . "<br>";
$conn->query($sql_u_foto);
echo json_encode(['success' => 'Data Berhasil Disimpan']);
