<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// echo "<pre>" . print_r($_FILES) . "</pre>";
// echo "<pre>" . print_r($_POST) . "</pre>";

$exp_arr_idpp = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['idpp']))));
$idpp = $exp_arr_idpp[1];
$exp_arr_profesi = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['profesi']))));
$profesi = $exp_arr_idpp[1];
//alamat file
$alamat_unggah = "./../../_file/praktik/praktikan";

//pembuatan alamat bila tidak ada
if (!is_dir($alamat_unggah)) {
    mkdir($alamat_unggah, 0777, $rekursif = true);
}

//cek data kesesuaian file tambah

//FILE WAJIB t_swab SIZE
// if ($_FILES['t_swab']['size'] > (1024 * 256) || $_FILES['t_foto']['size'] > (1024 * 256)) {
//     if ($profesi != 0 && $_FILES['t_ijazah']['size'] > (1024 * 256)) {
//         $ket = "size";
//     }
//     $ket = "size";
// }
if ($_FILES['t_foto']['size'] > (1024 * 256)) {
    if ($profesi != 0 && $_FILES['t_ijazah']['size'] > (1024 * 3072)) {
        $ket = "size";
    }
    $ket = "size";
}
//FILE WAJIB t_swab TYPE
// } else if ($_FILES['t_swab']['type'] != "application/pdf" || $_FILES['t_foto']['type'] != "image/jpeg") {
//     if ($profesi != 0 && $_FILES['t_ijazah']['type'] != "application/pdf") {
//         $ket = "type";
//     }
//     $ket = "type";
// } 
else if ($_FILES['t_foto']['type'] != "image/jpeg") {
    if ($profesi != 0 && $_FILES['t_ijazah']['type'] != "application/pdf") {
        $ket = "type";
    }
    $ket = "type";
} else {


    $exp_arr_q = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['q']))));
    $q = $exp_arr_q[1];

    $conn->query($q);

    //Bila t_swab di unggah
    if (isset($_FILES['t_swab'])) {
        $_FILES['t_swab']['name'] = md5($_FILES['t_swab']['name'] . $_FILES['t_swab']['size'] . date('Y-m-d H:i:s', time())) . ".pdf";
        if (!is_null($_FILES['t_swab'])) {
            $t_swab = (object) @$_FILES['t_swab'];

            $unggah_t_swab = move_uploaded_file(
                $t_swab->tmp_name,
                "{$alamat_unggah}/{$t_swab->name}"
            );
            $alamat_unggah_t_swab = "./_file/praktik/praktikan";
            $link_t_swab = "{$alamat_unggah_t_swab}/{$t_swab->name}";
        }
        $sql_update_swab_sertifikat = "UPDATE tb_praktikan SET ";
        $sql_update_swab_sertifikat .= " file_swab_praktikan = '" . $link_t_swab . "'";
        $sql_update_swab_sertifikat .= " WHERE id_praktikan = " . $idpp;
        // echo $sql_update_swab_sertifikat;
        $conn->query($sql_update_swab_sertifikat);
    }

    if ($profesi != 0) {
        $_FILES['t_ijazah']['name'] = md5($_FILES['t_ijazah']['name'] . $_FILES['t_ijazah']['size'] . date('Y-m-d H:i:s', time())) . ".pdf";
        if (!is_null($_FILES['t_ijazah'])) {
            $t_ijazah = (object) @$_FILES['t_ijazah'];

            $unggah_t_ijazah = move_uploaded_file(
                $t_ijazah->tmp_name,
                "{$alamat_unggah}/{$t_ijazah->name}"
            );
            $alamat_unggah_t_ijazah = "./_file/praktik/praktikan";
            $link_t_ijazah = "{$alamat_unggah_t_ijazah}/{$t_ijazah->name}";
        }
        $sql_update_ijazah = "UPDATE tb_praktikan SET ";
        $sql_update_ijazah .= " file_ijazah_praktikan = '" . $link_t_ijazah . "'";
        $sql_update_ijazah .= " WHERE id_praktikan = " . $idpp;
        // echo $sql_update_ijazah;
        $conn->query($sql_update_ijazah);
    }

    $_FILES['t_foto']['name'] = md5($_FILES['t_foto']['name'] . $_FILES['t_foto']['size'] . date('Y-m-d H:i:s', time())) . ".jpg";
    if (!is_null($_FILES['t_foto'])) {
        $t_foto = (object) @$_FILES['t_foto'];

        $unggah_t_foto = move_uploaded_file(
            $t_foto->tmp_name,
            "{$alamat_unggah}/{$t_foto->name}"
        );
        $alamat_unggah_t_foto = "./_file/praktik/praktikan";
        $link_t_foto = "{$alamat_unggah_t_foto}/{$t_foto->name}";

        $sql_update_foto = "UPDATE tb_praktikan SET ";
        $sql_update_foto .= " foto_praktikan = '" . $link_t_foto . "'";
        $sql_update_foto .= " WHERE id_praktikan = " . $idpp;
        // echo $sql_update_foto;
        $conn->query($sql_update_foto);
    }
    $ket = "sesuai";
}
$dataJSON['ket'] = $ket;
echo json_encode($dataJSON);
