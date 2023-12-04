<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title>CETAK PRINT DATA LAPORAN MOU RSJ </title>

	<!-- Custom fonts for this template -->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

	<center>

		<h2>LAPORAN KERJASAMA INSTITUSI PENDIDIKAN <br>DI RS JIWA PROVINSI JAWA BARAT</h2>
		<br />
		<br />
		<br />
		<table border="1" class='table table-striped table-hover'>
			<tr align="center">
				<th>NO</th>
				<th>NAMA INSTITUSI</th>
				<th>TANGGAL AKHIR MOU</th>
				<th>NO MOU RSJ</th>
				<th>NO MOU INSTITUSI</th>
				<th>STATUS</th>
			</tr>
			<?php
			$no = 1;
			$sql_kerjasama = "SELECT * FROM tb_kerjasama ";
			$sql_kerjasama .= " JOIN tb_institusi ON tb_kerjasama.id_institusi = tb_institusi.id_institusi ";
			$sql_kerjasama .= " ORDER BY tb_institusi.nama_institusi ASC";
			// echo $sql_kerjasama;
			$q_kerjasama = $conn->query($sql_kerjasama);
			$berlaku = 0;
			$tb = 0;
			while ($data = $q_kerjasama->fetch(PDO::FETCH_ASSOC)) {
				$date_end = strtotime($data['tgl_selesai_mou']);
				$date_now = strtotime(date('Y-m-d', time()));
				$date_diff = ($date_now - $date_end) / 24 / 60 / 60;

				if ($date_diff <= 0) {
					$status = "<span class='alert-success'>BERLAKU</span>";
					$berlaku = $berlaku + 1;
				} elseif ($date_diff > 0) {
					$status = "<span class='alert-danger'>TIDAK BERLAKU</span>";
					$tb = $tb + 1;
				}
			?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $data['nama_institusi']; ?></td>
					<td><?= tanggal($data['tgl_selesai_mou']); ?></td>
					<td><?= $data['no_pks_rsj']; ?></td>
					<td><?= $data['no_pks_institusi']; ?></td>
					<td align="center"><?= $status; ?></td>
				</tr>
			<?php
			}
			?>



		</table>
		<h5 align="right" class="alert-danger">JUMLAH MOU TIDAK BERLAKU : <?= $tb; ?> Institusi</h5>
		<h5 align="right">JUMLAH MOU YANG MASIH BERLAKU : <?= $berlaku; ?> Institusi</h5>
		<h5 align="right">Dicetak Pada : <?= tanggal(date('Y-m-d', time())); ?></h5>
		<br />

		<!-- <a href="cetak.php" target="_blank">CETAK</a> -->


		<script>
			window.print();
		</script>

</body>

<!-- JS -->

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

</html>