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

		<h2>LAPORAN DATA MESS <br /> RS JIWA PROVINSI JAWA BARAT</h2>
		<br />
		<br />
		<br />

		<?php
		include_once "koneksi.php";
		include_once "tanggal.php";
		?>

		<table border="1" class='table table-striped table-hover'>
			<tr align="center">
				<th>NO</th>
				<th>NAMA MESS</th>
				<th>NAMA PEMILIK</th>
				<th>KONTAK PEMILIK</th>
				<th>ALAMAT MESS</th>
				<th>KAPASITAS TOTAL</th>
				<th>TERISI</th>
				<th>HARGA TANPA MAKAN</th>
				<th>HARGA DENGAN MAKAN</th>
				<th>STATUS</th>
			</tr>
			<?php
			$no = 1;
			$sql_mou = "SELECT * FROM tb_mess order by nama_mess ASC";
			$q_mou = $conn->query($sql_mou);
			$jml = 0;

			while ($data = $q_mou->fetch(PDO::FETCH_ASSOC)) {

			?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $data['nama_mess']; ?></td>
					<td><?= $data['nama_pemilik_mess']; ?></td>
					<td><?= $data['no_pemilik_mess']; ?></td>
					<td><?= $data['alamat_mess']; ?></td>
					<td><?= $data['kapasitas_t_mess']; ?></td>
					<td><?= $data['kapasitas_terisi_mess']; ?></td>
					<td><?= "Rp " . number_format($data['harga_tanpa_makan_mess'], 0, ",", "."); ?></td>
					<td><?= "Rp " . number_format($data['harga_dengan_makan_mess'], 0, ",", "."); ?></td>

					<td align="center">
						<?php if ($data['status_mess'] == 'Aktif') {
							echo "<span class='alert-success'> AKTIF </span>";
						} else {
							echo "<span class='alert-danger'> TIDAK AKTIF </span>";
						} ?>
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