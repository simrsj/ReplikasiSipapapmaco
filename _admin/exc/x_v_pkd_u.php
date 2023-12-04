<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

//data privileges 
$sql_prvl = "SELECT * FROM tb_user_privileges WHERE id_user = " . base64_decode(urldecode($_POST['idu']));
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

if ($d_prvl['u_pkd'] == "Y") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $no = $_POST['no'];
    $jumlah_total = $_POST['u_frek' . $no] * $_POST['u_jumlah' . $no];
    $sql = "UPDATE tb_pkd_tarif SET";
    $sql .= " nama_pkd_tarif='" . $_POST['u_nama' . $no] . "', ";
    $sql .= " frekuensi_pkd_tarif='" . $_POST['u_frek' . $no] . "', ";
    $sql .= " satuan_pkd_tarif='" . $_POST['u_satuan' . $no] . "', ";
    $sql .= " jumlah_pkd_tarif='" . $_POST['u_jumlah' . $no] . "', ";
    $sql .= " total_pkd_tarif='" . $jumlah_total . "'";
    $sql .= " WHERE id_pkd_tarif=" . base64_decode(urldecode($_POST['idpkdt']));
    // echo $sql . "<br>";
    $conn->query($sql);
    echo json_encode(["Ket" => "Berhasil Terubah"]);
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
