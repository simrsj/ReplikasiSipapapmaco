<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

echo "<pre>";
// var_dump($_POST);
print_r($_POST);
echo "</pre>";

for ($no = 1; $no <= $_POST['jp']; $no++) {
    $sql = "INSERT INTO tb_pembimbing_pilih ";
    $sql .= " (id_praktik, id_pembimbing, id_unit, id_praktikan) ";
    $sql .= " VALUES ";
    $sql .= " ('" . $_POST['id_praktik'] . "', '" . $_POST['id_pembimbing' . $no] . "', '" . $_POST['id_unit' . $no] . "', '" . $_POST['id_praktikan' . $no] . "')";

    // $sql_update_pmbb = "UPDATE tb_pembimbing SET";
    // $sql_update_pmbb .= " kali_pembimbing = 1 ";
    // $sql_update_pmbb .= " WHERE id_pembimbing=" . $_POST['id_pembimbing' . $no];

    echo "$sql <br>";
    // echo "$sql_update_pmbb <br>";
    $conn->query($sql);
    // $conn->query($sql_update_pmbb);
}
json_encode(['success' => 'Sukses']);
