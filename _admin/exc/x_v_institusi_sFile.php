<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$id = $_POST['id_institusi'];


//Cek Variable File
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$alamat_unggah_file_akred = "./../../_file/akred";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah_file_akred)) {
    mkdir($alamat_unggah_file_akred, 0777, $rekursif = true);
}

if ($_FILES['t_fileAkred_institusi']['size'] > 0) {
    //ubah Nama File PDF
    $_FILES['t_fileAkred_institusi']['name'] = "akred_" . $id . "_" . date('Y-m-d', time()) . ".pdf";

    //unggah 
    if (!is_null($_FILES['t_fileAkred_institusi'])) {
        $file_akred = (object) @$_FILES['t_fileAkred_institusi'];

        //mulai unggah file 
        $unggah_file_akred = move_uploaded_file(
            $file_akred->tmp_name,
            "{$alamat_unggah_file_akred}/{$file_akred->name}"
        );
        $alamat_unggah_file_akred = "./_file/akred";

        // link alamat file 
        $link_file_akred = "{$alamat_unggah_file_akred}/{$file_akred->name}";
    }
}

$alamat_unggah_logo = "./../../_img/logo_institusi";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah_logo)) {
    mkdir($alamat_unggah_logo, 0777, $rekursif = true);
}

if ($_FILES['t_logo_institusi']['size'] > 0) {
    //ubah Nama File PDF
    $_FILES['t_logo_institusi']['name'] = $id . ".png";

    //unggah 
    if (!is_null($_FILES['t_logo_institusi'])) {
        $logo = (object) @$_FILES['t_logo_institusi'];

        //mulai unggah file 
        $unggah_logo = move_uploaded_file(
            $logo->tmp_name,
            "{$alamat_unggah_logo}/{$logo->name}"
        );
        $alamat_unggah_logo = "./_img/logo_institusi";

        // link alamat file 
        $link_logo = "{$alamat_unggah_logo}/{$logo->name}";
    }
}

//Cek Variable File
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

$sql_u_institusi = "UPDATE tb_institusi SET ";
$sql_u_institusi .= " fileAkred_institusi = '" . $link_file_akred . "',";
$sql_u_institusi .= " logo_institusi = '" . $link_logo . "'";
$sql_u_institusi .= " WHERE id_institusi = " . $id;

// echo $sql_u_institusi . "<br>";
$conn->query($sql_u_institusi);
echo json_encode(['success' => 'Data Institusi Berhasil Disimpan']);
