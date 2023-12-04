<?php
if (empty($_SESSION['username_user'])) {
?>
	<?php
	// include "./_log-sign/exc/x_captcha.php";
	?>
	<nav class="navbar navbar-expand navbar-light fixed-top bg-light topbar static-top shadow opacity-1">
		<a class="text-decoration-none" href="?">
			<div class="row">
				<div class="col-auto my-auto">
					<img src="./_img/rsj.svg" width="28" />
				</div>
				<div class="col text-left text-sm ">
					<span class="text-primary b">
						SIPAPAP MACO &nbsp; <br>
						<span class="d-none d-md-block">
							(Sistem Informasi Pendaftaran Penjadwalan Praktikan Mahasiswa dan Co-Ass)<br>
						</span>
					</span>
					<span class="badge badge-primary"> <?= tanggal_hari(date('w', time())) . ", " . tanggal(date("Y-m-d", time())); ?>, <span id="jam"></span></span>
				</div>
			</div>
		</a>
		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto ">
			<!-- Nav Item - Menu 3 Bar -->
			<li class="nav-item dropdown no-arrow  my-auto align-middle">
				<a class="nav-item dropdown-toggle d-flex btn btn-outline-primary btn-xs" href="#" id="menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="d-none d-md-block">Menu &nbsp;</div>
					<div class="fa fa-bars my-auto"></div>
				</a>
				<!-- Dropdown - User Information -->
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-scroll dropdown-menu-lg-right shadow p-2 rounded animated--grow-in" aria-labelledby="menu">
					<a class="btn btn-danger btn-sm col-md mb-2" href="?panduan">
						<span class="b">PANDUAN</span>
					</a>
					<a class="btn btn-outline-dark btn-sm col-md mb-2" href="?">
						Dashboard
					</a>
					<a class="btn btn-outline-info btn-sm col-md mb-2" href="?info_diklat">
						Jadwal Praktik
					</a>
					<a class="btn btn-outline-success btn-sm col-md mb-2" href="?reg">
						Register
					</a>
					<a class="btn btn-outline-primary btn-sm col-md" href="?login">
						Log-In
					</a>
				</div>
			</li>
		</ul>
	</nav>
	<br><br><br>
	<?php
	if (isset($_GET['reg'])) include "_log-sign/view/v_register.php";
	elseif (isset($_GET['login'])) include "_log-sign/view/v_login.php";
	elseif (isset($_GET['act_user']) && isset($_GET['crypt'])) include "_log-sign/view/v_aktivasi_akun.php";
	elseif (isset($_GET['forgot_pass'])) include "_log-sign/view/v_lupa_password.php";
	elseif (isset($_GET['forgot_pass_user'])) include "_log-sign/view/v_lupa_password_isi.php";
	elseif (isset($_GET['panduan'])) include "panduan.php";
	elseif (isset($_GET['info_diklat'])) include "_log-sign/view/v_info_diklat.php";
	else include "_log-sign/view/v_dashboard.php";
	?>

	<script>
		var span = document.getElementById("jam");
		time();

		function time() {
			var d = new Date();
			var s = formattedNumber = ("0" + d.getSeconds()).slice(-2);
			var m = formattedNumber = ("0" + d.getMinutes()).slice(-2);
			var h = formattedNumber = ("0" + d.getHours()).slice(-2);
			span.textContent = h + ":" + m + ":" + s;
		}
		setInterval(time, 1000);
	</script>
<?php
} else {
?>
	<script>
		alert('Anda sebelumnya SUDAH LOGIN dengan nama <?= $_SESSION['username_user ']; ?>');
		alert('Anda akan diarahkan langsung ke halaman');
	</script>
<?php
	header("Refresh:0");
}
?>