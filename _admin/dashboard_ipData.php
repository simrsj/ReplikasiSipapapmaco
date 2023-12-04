<?php

$id_ins = $_SESSION['id_institusi'];

//////////////////// DATA INSTITUSi ////////////////////
try {

	$sql_ins = " SELECT * FROM tb_institusi ";
	$sql_ins .= "JOIN tb_user on tb_institusi.id_institusi = tb_user.id_institusi ";
	$sql_ins .= "JOIN tb_kerjasama on tb_institusi.id_institusi = tb_kerjasama.id_institusi ";
	$sql_ins .= "WHERE tb_kerjasama.arsip IS NULL AND tb_institusi.id_institusi = " . $id_ins;
	// echo $sql_ins;
	$q_ins = $conn->query($sql_ins);
	$d_ins = $q_ins->fetch(PDO::FETCH_ASSOC);
	if ($q_ins->rowCount() > 0) {
		$dAr_ins['nama_institusi'] = $d_ins['nama_institusi'];
		$dAr_ins['akronim_institusi'] = $d_ins['akronim_institusi'];
		$dAr_ins['logo_institusi'] = $d_ins['logo_institusi'];
		$dAr_ins['alamat_institusi'] = $d_ins['alamat_institusi'];
		$dAr_ins['akred_institusi'] = $d_ins['akred_institusi'];
		$dAr_ins['tglAkhirAkred_institusi'] = $d_ins['tglAkhirAkred_institusi'];
		$dAr_ins['fileAkred_institusi'] = $d_ins['fileAkred_institusi'];
		$dAr_ins['ket_institusi'] = $d_ins['ket_institusi'];
		$dAr_ins['tgl_selesai_mou'] = $d_ins['tgl_selesai_mou'];
	} else {
		$sql_ins = " SELECT * FROM tb_institusi ";
		$sql_ins .= "JOIN tb_user on tb_institusi.id_institusi = tb_user.id_institusi ";
		$sql_ins .= "WHERE tb_institusi.id_institusi = " . $id_ins;
		$q_ins = $conn->query($sql_ins);
		$d_ins = $q_ins->fetch(PDO::FETCH_ASSOC);
		$dAr_ins['nama_institusi'] = $d_ins['nama_institusi'];
		$dAr_ins['akronim_institusi'] = $d_ins['akronim_institusi'];
		$dAr_ins['logo_institusi'] = $d_ins['logo_institusi'];
		$dAr_ins['alamat_institusi'] = $d_ins['alamat_institusi'];
		$dAr_ins['akred_institusi'] = $d_ins['akred_institusi'];
		$dAr_ins['tglAkhirAkred_institusi'] = $d_ins['tglAkhirAkred_institusi'];
		$dAr_ins['fileAkred_institusi'] = $d_ins['fileAkred_institusi'];
		$dAr_ins['ket_institusi'] = $d_ins['ket_institusi'];
		$dAr_ins['tgl_selesai_mou'] = "";
	}
} catch (Throwable $e) {
}

//////////////////// DATA INSTITUSi ////////////////////

function manipulasiTanggal($tgl, $jumlah = 1, $format = 'days')
{
	$currentDate = $tgl;
	return date('Y-m-d', strtotime($jumlah . ' ' . $format, strtotime($currentDate)));
}
