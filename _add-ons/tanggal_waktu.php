<?php
date_default_timezone_set('Asia/Jakarta');

// Get the current time
$current_time = new DateTime();

// Add 1 minute to the current time
$current_time->add(new DateInterval('PT1M'));

function tanggal($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tanggal_min_alt($tanggal)
{
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agu',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[0] . '-' . $bulan[(int)$pecahkan[1]] . '-' . $pecahkan[2];
}

function tanggal_minimal($tanggal)
{
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agu',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tanggal_hari($tanggal)
{
	$hari = array(

		0 => 'Minggu',
		'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		"Jum'at",
		'Sabtu'
	);

	return $hari[$tanggal];
}

function tanggal_hari_calender($tanggal)
{
	$hari = array(
		'Sun' =>   'Minggu',
		'Mon' =>   'Senin',
		'Tue' =>   'Selasa',
		'Wed' =>   'Rabu',
		'Thu' =>   'Kamis',
		'Fri' =>   "Jum'at",
		'Sat' =>   'Sabtu'
	);

	return $hari[$tanggal];
}

function tanggal_bulan($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	return $bulan[$tanggal];
}

function tanggal_between($tgl_awal, $tgl_akhir)
{
	$tgl_kalkulasi = strtotime($tgl_akhir) - strtotime($tgl_awal);

	return round($tgl_kalkulasi / (60 * 60 * 24)) + 1;
}


function tanggal_between_nonweekend($tgl_awal, $tgl_akhir)
{
	$mulai = new DateTime($tgl_awal);
	$selesai = new DateTime($tgl_akhir);
	$oneday = new DateInterval("P1D");

	$hari = array();
	$no = 0;

	foreach (new DatePeriod($mulai, $oneday, $selesai->add($oneday)) as $hari) {
		$hari_num = $hari->format("N"); /* 'N' number hari 1 (mon) to 7 (sun) */
		if ($hari_num < 6) { /* mingguan */
			$hari[$hari->format("Y-m-d")] = $no;
		}
		$no++;
	}
	// print_r($hari);
	echo count($hari);
}

function tanggal_between_week($tgl_awal, $tgl_akhir)
{
	$mulai = DateTime::createFromFormat('Y-m-d', $tgl_awal);
	$selesai = DateTime::createFromFormat('Y-m-d', $tgl_akhir);
	if ($tgl_awal > $tgl_akhir)
		return tanggal_between_week($tgl_akhir, $tgl_awal);
	return ceil($mulai->diff($selesai)->days / 7);
}

function tanggal_sisa($tgl_awal, $tgl_akhir)
{
	$d1 = new DateTime($tgl_awal);
	$d2 = new DateTime($tgl_akhir);
	$interval = $d1->diff($d2);
	$diffInDays    = $interval->d;
	$diffInMonths  = $interval->m;
	$diffInYears   = $interval->y;
	return $diffInYears . " Tahun " . $diffInMonths . " Bulan " . $diffInDays . " Hari";
}

function waktu_sisa($waktu_awal, $waktu_akhir)
{
	$d1 = new DateTime($waktu_awal);
	$d2 = new DateTime($waktu_akhir);
	$interval = $d1->diff($d2);
	$diffInSeconds = $interval->s;
	$diffInMinutes = $interval->i;
	$diffInHours   = $interval->h;
	return $diffInHours . " Jam " . $diffInMinutes . " Menit " . $diffInSeconds . " Detik";
}
