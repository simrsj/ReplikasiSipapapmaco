<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

//Mencari jenjang
$id_jurusan_pdd = $_GET['jur'];
$sql_jenjang = "SELECT * FROM tb_jurusan_pdd_jenjang";
$sql_jenjang .= " JOIN tb_jenjang_pdd ON tb_jurusan_pdd_jenjang.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
$sql_jenjang .= " WHERE id_jurusan_pdd = " . $id_jurusan_pdd;
$sql_jenjang .= " GROUP BY tb_jenjang_pdd.nama_jenjang_pdd";
// echo $sql_jenjang;
$q_jenjang = $conn->query($sql_jenjang);
?>

<select class='select2' name='jenjang' id="jenjang" required>
    <option value="">-- Pilih --</option>
    <?php
    while ($d_jenjang = $q_jenjang->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <option value="<?= $d_jenjang['id_jenjang_pdd']; ?>">
            <?= $d_jenjang['nama_jenjang_pdd']; ?>
        </option>
    <?php
    }
    ?>
</select>
<script>
    $('#jenjangLoader').fadeIn(0);
    $(".select2").select2({
        placeholder: "-- Pilih --",
        allowClear: true,
        width: "100%",
    });

    $('#jenjang').on('select2:select', function() {
        $('#profesiData').load('_admin/insert/i_praktikDataProfesi.php?jur=' + $("#jurusan").val() + '&jen=' + $("#jenjang").val());
        $('#profesiData').fadeIn(1);
        $('#profesiKet').fadeOut(0);
    });

    $('#jenjangLoader').fadeOut(0);
</script>