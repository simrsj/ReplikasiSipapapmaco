<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

//data privileges 
$sql_prvl = "SELECT * FROM tb_user_privileges WHERE id_user = " . base64_decode(urldecode($_POST['idu']));
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

if ($d_prvl['d_pkd'] == "Y") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $sql = "DELETE FROM tb_pkd";
    $sql .= " WHERE id_pkd=  " . base64_decode(urldecode($_POST['idpkd']));
    // echo "$sql<br>";
    try {
        $conn->query($sql);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -HAPUS TARIF PKD-');";
        echo "document.location.href='?error404';</script>";
    }

    echo json_encode(["Ket" => "Berhasil Terhapus"]);
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
