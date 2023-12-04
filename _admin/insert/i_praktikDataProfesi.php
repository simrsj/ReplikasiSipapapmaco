<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

//Mencari jenjang
$id_jurusan_pdd = $_GET['jur'];
$sql_profesi = "SELECT * FROM tb_profesi_pdd";
$sql_profesi .= " WHERE id_jurusan_pdd = " . $id_jurusan_pdd;
// echo $sql_profesi;
$q_profesi = $conn->query($sql_profesi);
?>

<?php if ($_GET['jen'] == 9) { ?>
    <select class='select2 select2-selection__rendered' name='profesi' id="profesi" required>
        <option value="">-- Pilih --</option>
        <?php while ($d_profesi = $q_profesi->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?= $d_profesi['id_profesi_pdd']; ?>">
                <?= $d_profesi['nama_profesi_pdd']; ?>
            </option>
        <?php } ?>
    </select>
<?php } else { ?>
    <span class="b i text-xl">-</span>
<?php } ?>
<script>
    <?php if ($_GET['jen'] == 9) { ?>
        $(".select2").select2({
            placeholder: "-- Pilih --",
            allowClear: true,
            width: "100%",
        });
    <?php } ?>
</script>