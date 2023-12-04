<?php
if ($_SESSION['status_user'] == "Y") {

	//data user 
	try {
		$sql_user = "SELECT * FROM tb_user WHERE id_user=" . $_SESSION['id_user'];
		// echo $sql_user;
		$q_user = $conn->query($sql_user);
		$d_user = $q_user->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $ex) {
		echo "<script>alert('$ex -DATA PRIVILEGES-');";
		echo "document.location.href='?error404';</script>";
	}

	//data praktikan dan user 
	try {
		$sql_praktikan = "SELECT * FROM tb_praktikan ";
		$sql_praktikan .= " JOIN tb_user ON tb_praktikan.id_user = tb_user.id_user";
		$sql_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik= tb_praktik.id_praktik";
		$sql_praktikan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
		$sql_praktikan .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
		$sql_praktikan .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
		$sql_praktikan .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
		$sql_praktikan .= " WHERE tb_user.id_user = " . $_SESSION['id_user'];
		// echo $sql_praktikan;
		$q_praktikan = $conn->query($sql_praktikan);
		$d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $ex) {
		// echo "<script>alert('-DATA PEMBIMBING-');";
		// echo "document.location.href='?error404';</script>";
	}

	$_SESSION['id_praktikan'] = encryptString($d_praktikan['id_praktikan'], $customkey);
?>

	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white fixed-top topbar  bg-sipapapmaco-abstrack1 static-top shadow-lg">
					<a class="text-decoration-none d-flex " href="?">
						<img src="./_img/rsj.svg" width="28" class="" />
						<span class="b m-2 text-light">
							SIPAPAP MACO
							<div class="d-md-none">
								<div class="badge badge-primary text-md"><?= tanggal_hari(date('w')) . " " . date("d M Y"); ?>, <span id="jam1"></span></div>
							</div>
							<span class="d-none d-md-block text-light">(Sistem Informasi Pendaftaran Penjadwalan Praktikan Mahasiswa dan Co-Ass)</span>
						</span>
					</a>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto ">
						<!-- Nav Item - Menu 3 Bar -->
						<li class="nav-item dropdown no-arrow  my-auto align-middle">
							<a class="nav-item dropdown-toggle d-flex btn btn-light btn-sm" href="#" id="menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="d-none d-md-block text-primary">Menu</div>
								<div class="fa fa-bars d-md-none my-auto text-primary"></div>
							</a>
							<!-- Dropdown - User Information -->
							<div class=" dropdown-menu dropdown-menu-scroll dropdown-menu-right shadow animated--grow-in" aria-labelledby="menu">
								<?php if ($d_praktikan['id_jurusan_pdd'] == 1) { ?>
									<?php if ($d_praktikan['id_profesi_pdd'] == 1) { ?>
										<!-- Kedokteran Residen  -->
										<!-- <a class="dropdown-item b " href="?ked_coass_nilai">
											Penilaian
										</a> -->
										<div class="text-center mb-2">
											<span class="badge badge-dark text-md col">e-Log Book</span>
										</div>
										<a class="dropdown-item " href="?ked_residen_elogbook=jkh&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Jadwal Kegiatan Harian
										</a>
										<a class="dropdown-item " href="?ked_residen_elogbook=pkd&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Pencapaian Kompetensi Dasar
										</a>
										<a class="dropdown-item " href="?ked_residen_elogbook=pi&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Presentasi Ilmiah
										</a>
									<?php } else if ($d_praktikan['id_profesi_pdd'] == 2) { ?>
										<!-- Kedokteran Co-Ass  -->
										<!-- <a class="dropdown-item b " href="?ked_coass_nilai">
											Penilaian
										</a> -->
										<div class="text-center mb-2">
											<span class="badge badge-dark text-md col">e-Log Book</span>
										</div>
										<a class="dropdown-item " href="?ked_coass_elogbook=p3d&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>">
											Pencapaian Kompetensi Keterampilan P3D
										</a>
										<a class="dropdown-item " href="?ked_coass_elogbook=jkh&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Jadwal Kegiatan Harian
										</a>
										<a class="dropdown-item " href="?ked_coass_elogbook=kyd&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Kasus Yang Ditemukan
										</a>
										<a class="dropdown-item " href="?ked_coass_elogbook=psw&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Pembuatan Status Wajib
										</a>
										<a class="dropdown-item " href="?ked_coass_elogbook=materi&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>&data=<?= $_SESSION['id_praktikan'] ?>">
											Materi
										</a>
										<a class="dropdown-item " href="?ked_coass_elogbook=lppp&jenis=<?= encryptString($d_praktikan['id_profesi_pdd'], $customkey) ?>">
											Lembar Penilaian Perilaku Profesional
										</a>
									<?php } ?>
								<?php } else if ($d_praktikan['id_jurusan_pdd'] == 2) { ?>
									<a class="dropdown-item" href="?kep_nilai">
										<i class="fa-regular fa-pen-to-square"></i>
										Penilaian Praktikan
									</a>
									<div class="dropdown-divider"></div>
								<?php } ?>
								<hr>
								<a class="dropdown-item text-center rounded-sm b text-danger" href="#" data-toggle="modal" data-target="#log-out">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>
						<div class="topbar-divider"></div>
						<!-- Nav Item - User -->
						<li class="nav-item dropdown no-arrow ">
							<a class="d-none d-md-block ">
								<div class="badge badge-primary text-md"><?= tanggal_hari(date('w')) . " " . date("d M Y"); ?>, <span id="jam2"></span>
								</div>
							</a>
							<a class="nav-link h-0 dropdown-toggle accordion pl-0 pr-0" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="d-none d-md-block badge badge-light text-truncate text-primary b shadow-lg" style="max-width: 200px;">
									<?= $d_praktikan['nama_praktikan']; ?>&nbsp;
									<i class="far fa-user"></i>
								</span>
								<span class="d-md-none my-auto text-primary badge badge-light b shadow-lg">
									<i class="far fa-user"></i>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<div class="dropdown-item d-md-none text-center b  text-primary text-decoration-none" href="?setting">
									<?= $d_praktikan['nama_praktikan']; ?>
								</div>
								<a class="dropdown-item" href="?setting">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Pengaturan
								</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#log-out">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>

				<!-- Logout Modal-->
				<div class="modal fade" id="log-out">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Yakin Keluar?</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
								<a class="btn btn-danger" href="?lo">Ya</a>
							</div>
						</div>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="wrapper mt-4 mb-4">
					<?php
					include "_praktikan/index_data.php";
					?>
				</div>
				<footer class="footer sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>RS Jiwa Provinsi Jawa Barat <?= date('Y'); ?></span>
						</div>
					</div>
				</footer>
			</div>
		</div>

	</div>
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<script>
		var span1 = document.getElementById("jam1");
		var span2 = document.getElementById("jam2");
		time();

		function time() {
			var d = new Date();
			var s = formattedNumber = ("0" + d.getSeconds()).slice(-2);
			var m = formattedNumber = ("0" + d.getMinutes()).slice(-2);
			var h = formattedNumber = ("0" + d.getHours()).slice(-2);
			span1.textContent = h + ":" + m + ":" + s;
			span2.textContent = h + ":" + m + ":" + s;
		}
		setInterval(time, 1000);
	</script>
<?php
} else {
?>
	<script>
		alert('Anda belum Login, Silahkan Login Terlebih dahulu');
		document.location.href = "/SM/index.php";
	</script>
<?php
}
?>