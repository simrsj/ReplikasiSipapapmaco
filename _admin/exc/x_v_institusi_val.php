<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
if ($_POST['status'] == 'terima') {
    $sql = "UPDATE tb_institusi SET ";
    $sql .= " tempStatus_institusi = '" . $_POST['status'] . "'";
    $sql .= " WHERE id_institusi = " . $_POST['id'];

    $sql_ins = "SELECT * FROM tb_institusi";
    $sql_ins .= " WHERE id_institusi = " . $_POST['id'];
    $q_ins = $conn->query($sql_ins);
    $d_ins = $q_ins->fetch(PDO::FETCH_ASSOC);

    //mulai unggah file surat praktik
    $fileLogo = explode("/", $d_ins['tempLogo_institusi']);
    $link_logo = "./../../_img/logo_institusi/" . $fileLogo[4];
    $link_logo_db = "./_img/logo_institusi/" . $fileLogo[4];
    copy("./../../" . $fileLogo[1] . "/" . $fileLogo[2] . "/" . $fileLogo[3] . "/" . $fileLogo[4], $link_logo);
    unlink("./../../" . $fileLogo[1] . "/" . $fileLogo[2] . "/" . $fileLogo[3] . "/" . $fileLogo[4]);

    $sql_ins_u = "UPDATE tb_institusi SET ";
    $sql_ins_u .= " akronim_institusi = '" . $d_ins['tempAkronim_institusi'] . "',";
    $sql_ins_u .= " logo_institusi = '" . $link_logo_db . "',";
    $sql_ins_u .= " alamat_institusi = '" . $d_ins['tempAlamat_institusi'] . "',";
    $sql_ins_u .= " akred_institusi = '" . $d_ins['tempAkred_institusi'] . "',";
    $sql_ins_u .= " tglAkhirAkred_institusi = '" . $d_ins['tempTglAkhirAkred_institusi'] . "',";
    $sql_ins_u .= " fileAkred_institusi = '" . $d_ins['tempFileAkred_institusi'] . "'";
    $sql_ins_u .= " WHERE id_institusi = " . $_POST['id'];

    echo "$sql_ins_u<br>";
    $conn->query($sql_ins_u);
} elseif ($_POST['status'] == 'tolak') {
    $sql = "UPDATE tb_institusi SET ";
    $sql .= " tempStatus_institusi = '" . $_POST['status'] . "' ";
    $sql .= " tempKet_institusi = '" . $_POST['ket'] . "'";
    $sql .= " WHERE id_institusi = " . $_POST['id'];
}

echo "$sql<br>";
$conn->query($sql);

json_encode(['success' => 'Sukses']);
