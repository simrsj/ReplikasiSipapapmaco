<?php
$id = $_POST['id_mentor_rsj'];
$nip_nipk = $_POST['nip_nipk_mentor_rsj'];
$name = $_POST['name_mentor_rsj'];
$unit = $_POST['unit_mentor_rsj'];
$info = $_POST['info_mentor_rsj'];
$min = $_POST['min_mentor_rsj'];

$sql_update = "UPDATE `tb_mentor_rsj` 
SET 
nip_nipk_mentor_rsj = '$nip_nipk', 
name_mentor_rsj = '$name', 
unit_mentor_rsj = '$unit', 
info_mentor_rsj = '$info',
min_mentor_rsj = '$min'
WHERE `id_mentor_rsj` = $id";

$conn->query($sql_update);
?>
<script>
	document.location.href = "?pmb";
</script>