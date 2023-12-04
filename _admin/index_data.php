<?php
//akun dan hak akses 
if (isset($_GET['aku']) && $d_prvl['r_akun'] == 'Y') {
	if (isset($_GET['ha']) && $_SESSION['level_user'] == 1) include "_admin/view/v_akun_hak_akses.php";
	else include "_admin/view/v_akun.php";
}
//log book 
elseif (isset($_GET['logbook']) && $d_prvl['r_logbook'] == 'Y') {
	if (isset($_GET['ked_residen_jkh']) && isset($_GET['data'])) include "_admin/view/v_ked_residen_jkh_input.php";
	elseif (isset($_GET['ked_residen_pkd']) && isset($_GET['data'])) include "_admin/view/v_ked_residen_pkd_input.php";
	elseif (isset($_GET['ked_residen_pi']) && isset($_GET['data'])) include "_admin/view/v_ked_residen_pi_input.php";
	elseif (isset($_GET['ked_coass_nilai']) && isset($_GET['u'])) include "_admin/update/u_ked_coass_nilai.php";
	elseif (isset($_GET['ked_coass_p3d']) && isset($_GET['u'])) include "_admin/update/u_ked_coass_p3d.php";
	elseif (isset($_GET['ked_coass_jkh']) && isset($_GET['data'])) include "_admin/view/v_ked_coass_jkh_input.php";
	elseif (isset($_GET['ked_coass_kyd']) && isset($_GET['data'])) include "_admin/view/v_ked_coass_kyd_input.php";
	elseif (isset($_GET['ked_coass_psw']) && isset($_GET['data'])) include "_admin/view/v_ked_coass_psw_input.php";
	elseif (isset($_GET['ked_coass_materi']) && isset($_GET['data'])) include "_admin/view/v_ked_coass_materi_input.php";
	elseif (isset($_GET['ked_coass_lppp']) && isset($_GET['u'])) include "_admin/update/u_ked_coass_lppp.php";
	elseif (isset($_GET['data'])) include "_admin/view/v_logbook_detail.php";
	else include "_admin/view/v_logbook.php";
}
//kuesioner pembimbing 
elseif (isset($_GET['kuesioner']) && $d_prvl['level_user'] == 1) {
	if (isset($_GET['jawaban'])) include "_admin/view/v_kuesioner_jawaban.php";
	else include "_admin/view/v_kuesioner.php";
}
//kuesioner sarpras
elseif (isset($_GET['kuesioner_sarpras']) && $d_prvl['level_user'] == 1) {
	if (isset($_GET['jawaban'])) include "_admin/view/v_kuesioner_sarpras_jawaban.php";
	else include "_admin/view/v_kuesioner_sarpras.php";
}
//arsip praktik
elseif (isset($_GET['pars']) && $d_prvl['status_aktivasi_user'] == "Y") {
	if (isset($_GET['dp'])) include "_admin/view/v_praktik_arsip_dataPraktik.php";
	else include "_admin/view/v_praktik_arsip.php";
} elseif (isset($_GET['akr'])) {
	include "_admin/view/v_akreditasi.php";
}
//menu informasi dan jadwal praktik
elseif (isset($_GET['info_diklat'])) include "_admin/view/v_info_diklat.php";
elseif (isset($_GET['ins'])) {
	if (isset($_GET['i'])) {
		include "_admin/insert/i_institusi.php";
	} elseif (isset($_GET['u'])) {
		include "_admin/update/u_institusi.php";
	} elseif (isset($_GET['d'])) {
		include "_admin/delete/d_institusi.php";
	} elseif (isset($_GET['val'])) {
		include "_admin/view/v_institusi_val.php";
	} else {
		include "_admin/view/v_institusi.php";
	}
} elseif (isset($_GET['jrs'])) {
	include "_admin/view/v_jurusan.php";
} elseif (isset($_GET['jjg'])) {
	include "_admin/view/v_jenjang.php";
}
//kuota praktik
elseif (isset($_GET['kta']) && $d_prvl['r_kuota'] == 'Y') include "_admin/view/v_kuota.php";
elseif (isset($_GET['lapor'])) {
	if (isset($_GET['dtl'])) {
		include "_admin/view/v_lapor_detail.php";
	} else {
		include "_admin/view/v_lapor.php";
	}
} elseif (isset($_GET['mes'])) {
	include "_admin/view/v_mess.php";
} elseif (isset($_GET['kerjasama'])) {
	if (isset($_GET['i'])) {
		include "_admin/insert/i_mou.php";
	} elseif (isset($_GET['u'])) {
		include "_admin/update/u_mou.php";
	} elseif (isset($_GET['a'])) {
		include "_admin/view/v_mou_arsip.php";
	} else {
		include "_admin/view/v_mou.php";
	}
}
//daftar data pemibimbing
elseif (isset($_GET['d_pmbb']) && $d_prvl['r_daftar_pembimbing'] == 'Y') {
	if (isset($_GET['detail']))
		include "_admin/view/v_daftarPembimbingDetail.php";
	else
		include "_admin/view/v_daftarPembimbing.php";
}
//praktik
else if (isset($_GET['ptk']) && $d_prvl['r_praktik'] == 'Y' && $d_prvl['status_aktivasi_user'] == "Y") {
	if (isset($_GET['i']) && $d_prvl['c_praktik'] == 'Y') include "_admin/insert/i_praktik.php";
	else if (isset($_GET['u']) && $d_prvl['u_praktik'] == 'Y') include "_admin/update/u_praktik.php";
	elseif (isset($_GET['m_i']) && $d_prvl['c_praktik_mess'] == 'Y') include "_admin/insert/i_praktik_mess.php";
	elseif (isset($_GET['m_u']) && $d_prvl['u_praktik_mess'] == 'Y') include "_admin/update/u_praktik_mess.php";
	else include "_admin/view/v_praktik.php";
}
//praktikan
else if (isset($_GET['ptkn']) && $d_prvl['r_praktikan'] == 'Y' && $d_prvl['status_aktivasi_user'] == "Y") {
	if (isset($_GET['i']) && $d_prvl['c_praktikan'] == 'Y') include "_admin/insert/i_praktik_praktikan.php";
	else if (isset($_GET['u']) && $d_prvl['u_praktikan'] == 'Y') include "_admin/view/u_praktikan.php";
	else if (isset($_GET['akun_praktikan'])) include "_print/p_akun_praktikan.php";
	else include "_admin/view/v_praktik_praktikan.php";
}
//praktik pemibimbing
else if (isset($_GET['pmbb']) && $d_prvl['r_praktik_pembimbing'] == 'Y' && $d_prvl['status_aktivasi_user'] == "Y") {
	if (isset($_GET['i'])) include "_admin/insert/i_praktik_pembimbing.php";
	else include "_admin/view/v_praktik_pembimbing.php";
}
//praktik tarif
elseif (isset($_GET['ptrf']) && $d_prvl['r_praktik_tarif'] == 'Y') {
	if (isset($_GET['i']) && $d_prvl['c_praktik_tarif'] == 'Y') include "_admin/insert/i_praktik_tarif.php";
	else include "_admin/view/v_praktik_tarif.php";
}
//praktik bayar
elseif (isset($_GET['pbyr']) && $d_prvl['status_aktivasi_user'] == "Y") {
	if (isset($_GET['i']) && $d_prvl['c_praktik_bayar'] == 'Y') include "_admin/insert/i_praktik_bayar.php";
	else include "_admin/view/v_praktik_bayar.php";
}
//praktik nilai
elseif (isset($_GET['pnilai']) && $d_prvl['status_aktivasi_user'] == "Y") {
	if (isset($_GET['i']) && isset($_GET['pmbb'])) include "_admin/insert/i_praktik_nilaiKep.php";
	elseif (isset($_GET['u']) && isset($_GET['pmbb'])) include "_admin/update/u_praktik_nilaiKep.php";
	elseif (isset($_GET['upi']) && isset($_GET['pmbb'])) include "_admin/insert/i_praktik_nilai_upload.php";
	elseif (isset($_GET['upu']) && isset($_GET['pmbb']) && isset($_GET['idnu'])) include "_admin/update/u_praktik_nilai_upload.php";
	else include "_admin/view/v_praktik_nilai.php";
} elseif (isset($_GET['pfs'])) {
	include "_admin/view/v_profesi.php";
} elseif (isset($_GET['uni'])) {
	include "_admin/view/v_unit.php";
} elseif (isset($_GET['tmp'])) {
	include "_admin/view/v_tempat.php";
} elseif (isset($_GET['trf'])) {
	include "_admin/view/v_tarif.php";
} elseif (isset($_GET['trs'])) {
	if (isset($_GET['dtl'])) {
		include "_admin/view/v_transaksi_detail.php";
	} else {
		include "_admin/view/v_transaksi.php";
	}
}
//PKD
elseif (isset($_GET['pkd']) && $d_prvl['r_pkd'] == 'Y') {
	if (isset($_GET['i']) && $d_prvl['c_pkd'] == 'Y')
		include "_admin/insert/i_pkd.php";
	else if (isset($_GET['u']) && $d_prvl['u_pkd'] == 'Y')
		include "_admin/update/u_pkd.php";
	else if (isset($_GET['pkdt']) && $d_prvl['c_pkd'] == 'Y')
		include "_admin/view/v_pkd_tarif.php";
	else
		include "_admin/view/v_pkd.php";
}
//PRINT 
elseif (isset($_GET['lap_akun_pdf'])) include "_print/p_akun_praktikan.php";
//testing 
elseif (isset($_GET['test']))	include "test.php";
//panduan
elseif (isset($_GET['panduan']))	include "panduan.php";
//data dashboard
else {
	if ($_SESSION['level_user'] == 1)
		include "_admin/dashboard_admin.php";
	else if ($_SESSION['level_user'] == 2)
		include "_admin/dashboard_ip.php";
	else if ($_SESSION['level_user'] == 3)
		include "_admin/dashboard_admin_pkd.php";
}
