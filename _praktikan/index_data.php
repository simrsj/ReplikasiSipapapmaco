<?php
//akun dan hak akses 
if (isset($_GET['kep_kompetensi']))	include "_praktikan/kep_kompetensi.php";
//nilai Kedokteran (Co-Ass)
// else if (isset($_GET["ked_coass_nilai"])) include "_praktikan/view/v_ked_coass_nilai.php";
//data Log Book Kedokteran Co-Ass
else if (isset($_GET["ked_residen_elogbook"]) && decryptString($_GET['jenis'], $customkey) == 1) {
	//data Log Book residen Jadwal Kegiatan Harian
	if ($_GET["ked_residen_elogbook"] == "jkh") include "_admin/view/v_ked_residen_jkh_input.php";
	//data Log Book residen pencapaian kompetensi dasar
	else if ($_GET["ked_residen_elogbook"] == "pkd") include "_admin/view/v_ked_residen_pkd_input.php";
	//data Log Book residen Presentasi Ilmiah
	else if ($_GET["ked_residen_elogbook"] == "pi") include "_admin/view/v_ked_residen_pi_input.php";
}
//data Log Book Kedokteran Co-Ass
else if (isset($_GET["ked_coass_elogbook"]) && decryptString($_GET['jenis'], $customkey) == 2) {
	//data Log Book Pencapaian Komptensi Keterampilan P3D
	if ($_GET["ked_coass_elogbook"] == "p3d") include "_praktikan/view/v_ked_coass_p3d.php";
	//data Log Book Jadwal Kegiatan Harian
	else if ($_GET["ked_coass_elogbook"] == "jkh") include "_admin/view/v_ked_coass_jkh_input.php";
	//data Log Book Kejadian Yang Ditemukan
	else if ($_GET["ked_coass_elogbook"] == "kyd") include "_admin/view/v_ked_coass_kyd_input.php";
	//data Log Book Pembuatan Status Wajib
	else if ($_GET["ked_coass_elogbook"] == "psw") include "_admin/view/v_ked_coass_psw_input.php";
	//data Log Book materi
	else if ($_GET["ked_coass_elogbook"] == "materi") include "_admin/view/v_ked_coass_materi_input.php";
	//data Log Book lppp
	else if ($_GET["ked_coass_elogbook"] == "lppp") include "_praktikan/view/v_ked_coass_lppp.php";
}
//data dashboard
else {
	include "_praktikan/dashboard_praktikan.php";
}
