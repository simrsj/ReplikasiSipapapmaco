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


	<!-- Custom styles for this template -->
	<link href="../css/sb-admin-2.min.css" rel="stylesheet">
	<!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->

	<!-- Add-ons -->
</head>

<body>

	<center>

		<h2>LAPORAN DATA PEMBIMBING <br> RS JIWA PROVINSI JAWA BARAT</h2>
		<br> <br> <br>
		<table border="1" class='table table-striped table-hover'>
			<tr align="center">
				<th>NO</th>
				<th>NIP/NIPK PEMBIMBING</th>
				<th>NAMA PEMBIMBING</th>
				<th>JENIS PEMBIMBING</th>
				<th>STATUS</th>
			</tr>
			<?php
			$no = 1;
			$sql_pembimbing = "SELECT * FROM tb_pembimbing ";
			$sql_pembimbing .= " JOIN tb_pembimbing_jenis ON tb_pembimbing.id_pembimbing_jenis = tb_pembimbing_jenis.id_pembimbing_jenis";
			$sql_pembimbing .= " JOIN tb_jenjang_pdd ON tb_pembimbing.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
			$sql_pembimbing .= " ORDER BY nama_pembimbing ASC";
			$q_pembimbing = $conn->query($sql_pembimbing);
			while ($data = $q_pembimbing->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $data['no_id_pembimbing']; ?></td>
					<td><?= $data['nama_pembimbing']; ?></td>
					<td><?= $data['nama_pembimbing_jenis']; ?></td>
					<td align="center">
						<?php if ($data['status_pembimbing'] == 'Y') { ?>
							<span class='alert-success'>AKTIF</span>
						<?php } else { ?>
							<span class='alert-danger'>TIDAK AKTIF</span>
						<?php } ?>
					</td>
				</tr>
			<?php
			}
			?>



		</table>
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