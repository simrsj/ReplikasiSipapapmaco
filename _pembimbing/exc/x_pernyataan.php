<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
$exp_arr_id = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['id']))));
$id = $exp_arr_id[1];
if ($_POST['pernyataan'] == "Y") {
    try {
        $sql = "UPDATE tb_praktikan SET ";
        $sql .= "pernyataan_praktikan = 'Y' ";
        $sql .= "WHERE id_praktikan = " . $id;
        // echo $sql;
        $q = $conn->query($sql);
    } catch (Exception $ex) {
        echo "<script>alert('-PERNYATAAN-');";
        echo "document.location.href='?error404';</script>";
    }
    $dataJSON['ket'] = "SETUJU";
} else {
    $dataJSON['ket'] = "TIDAK SETUJU";
}
echo json_encode($dataJSON);
