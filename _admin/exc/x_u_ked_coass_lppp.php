<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
try {
    $sql = "DELETE FROM tb_logbook_ked_coass_lppp WHERE id_praktikan = " . $idpr;
    // echo "$sql<br>";
    $conn->query($sql);
    $sql = "DELETE FROM tb_logbook_ked_coass_lppp_ket WHERE id_praktikan = " . $idpr;
    // echo "$sql<br>";
    $conn->query($sql);


    $sql_pertanyaan = "SELECT * FROM tb_pertanyaan ";
    $sql_pertanyaan .= " WHERE kategori_pertanyaan = 'LPPP'";
    // echo "$sql_pertanyaan<br>";
    $q_pertanyaan = $conn->query($sql_pertanyaan);
    $no = 1;
    while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) {
        $sql = "INSERT INTO tb_logbook_ked_coass_lppp VALUE (";
        $sql .= "NULL, ";
        $sql .= $idpr . ", ";
        $sql .= $d_pertanyaan['id'] . ", ";
        $sql .= "'" . date('Y-m-d G:i:s') . "', ";
        $sql .= "'" . $_POST['skor' . $no] . "' ";
        $sql .= ")";

        // echo "$sql<br>";
        $conn->query($sql);
        $no++;
    }
    $sql = "INSERT INTO tb_logbook_ked_coass_lppp_ket VALUE (";
    $sql .= "NULL, ";
    $sql .= $idpr . ", ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "'" . $_POST['ket'] . "' ";
    $sql .= ")";

    $conn->query($sql);
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'SUCCESS'
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'ERROR'
    ]);
}
