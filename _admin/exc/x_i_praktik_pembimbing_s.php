<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_pembimbing_pilih WHERE id_praktik='" . base64_decode(urldecode($_POST['id_praktik'])) . "';";
$conn->query($sql);
if ($_POST['jurusan'] == 1) {
    for ($no = 1; $no <= $_POST['jumlah_praktik']; $no++) {
        $sql = "INSERT INTO tb_pembimbing_pilih (";
        $sql .= " id_praktik, ";
        $sql .= " id_pembimbing, ";
        $sql .= " id_praktikan ";
        $sql .= " )VALUES (";
        $sql .= " '" . base64_decode(urldecode($_POST['id_praktik'])) . "', ";
        $sql .= " '" . $_POST['id_pembimbing' . $no] . "', ";
        $sql .= " '" . $_POST['id_praktikan' . $no] . "'";
        $sql .= " )";
        // echo "$sql <br>";
        $conn->query($sql);
    }
} else {
    for ($no = 1; $no <= $_POST['jumlah_praktik']; $no++) {
        $sql = "INSERT INTO tb_pembimbing_pilih (";
        $sql .= " id_praktik, ";
        $sql .= " id_pembimbing, ";
        $sql .= " id_unit, ";
        $sql .= " id_praktikan ";
        $sql .= " )VALUES (";
        $sql .= " '" . base64_decode(urldecode($_POST['id_praktik'])) . "', ";
        $sql .= " '" . $_POST['id_pembimbing' . $no] . "', ";
        $sql .= " '" . $_POST['id_unit' . $no] . "', ";
        $sql .= " '" . $_POST['id_praktikan' . $no] . "'";
        $sql .= " )";
        // echo "$sql <br>";
        $conn->query($sql);
    }
}
echo json_encode(['success' => 'Sukses']);
