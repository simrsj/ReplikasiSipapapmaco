<?php
//nilai Kedokteran (Co-Ass)
if (isset($_GET["ked_coass_nilai"])) {
	if (isset($_GET['u'])) include "_admin/update/u_ked_coass_nilai.php";
	else include "_admin/view/v_ked_coass_nilai.php";
}
//data Log Book Kedokteran residen
else if (isset($_GET["ked_residen_elogbook"]) && decryptString($_GET['jenis'], $customkey) == 1) {
	//data Log Book Jadwal Kegiatan Harian
	if ($_GET["ked_residen_elogbook"] == "jkh") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_residen_jkh_input.php";
		else include "_admin/view/v_ked_residen_jkh.php";
	}
	//data Log Book Pencapaian Kompetensi Dasar
	else if ($_GET["ked_residen_elogbook"] == "pkd") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_residen_pkd_input.php";
		else include "_admin/view/v_ked_residen_jkh.php";
	}
	//data Log Book Presentasi Ilmiah
	else if ($_GET["ked_residen_elogbook"] == "pi") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_residen_pi_input.php";
		else include "_admin/view/v_ked_residen_pi.php";
	} else pilihmenu();
}
//data Log Book Kedokteran Co-Ass
else if (isset($_GET["ked_coass_elogbook"]) && decryptString($_GET['jenis'], $customkey) == 2) {
	//data Log Book Pencapaian Komptensi Keterampilan P3D
	if ($_GET["ked_coass_elogbook"] == "p3d") {
		if (isset($_GET['u'])) include "_admin/update/u_ked_coass_p3d.php";
		else include "_admin/view/v_ked_coass_p3d.php";
	}
	//data Log Book Jadwal Kegiatan Harian
	else if ($_GET["ked_coass_elogbook"] == "jkh") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_coass_jkh_input.php";
		else include "_admin/view/v_ked_coass_jkh.php";
	}
	//data Log Book Kejadian Yang Ditemukan
	else if ($_GET["ked_coass_elogbook"] == "kyd") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_coass_kyd_input.php";
		else include "_admin/view/v_ked_coass_kyd.php";
	}
	//data Log Book Pembuatan Status Wajib
	else if ($_GET["ked_coass_elogbook"] == "psw") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_coass_psw_input.php";
		else include "_admin/view/v_ked_coass_psw.php";
	}
	//data Log Book materi
	else if ($_GET["ked_coass_elogbook"] == "materi") {
		if (isset($_GET['data'])) include "_admin/view/v_ked_coass_materi_input.php";
		else include "_admin/view/v_ked_coass_materi.php";
	}
	//data Log Book lppp
	else if ($_GET["ked_coass_elogbook"] == "lppp") {
		if (isset($_GET['u'])) include "_admin/update/u_ked_coass_lppp.php";
		else include "_admin/view/v_ked_coass_lppp.php";
	} else pilihmenu();
} else pilihmenu();

function pilihmenu()
{
	echo
	'
	<div class="jumbotron border-2 m-2  shadow">
		<div class="jumbotron-fluid">
			<div class="text-gray-700">
				<h5 class="text-center">Silahkan Pilih <b>Menu</b></h5>
			</div>
		</div>
	</div>
	';
}
