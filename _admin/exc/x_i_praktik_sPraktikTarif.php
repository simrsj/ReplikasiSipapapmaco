<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

echo "<pre>";
print_r($_POST);
echo "</pre>";

// --------------------------------------SIMPAN DATA PRAKTIK--------------------------------------------

//mencari jenis jurusan
$sql_jenis_jurusan = "SELECT * FROM tb_jurusan_pdd 
WHERE id_jurusan_pdd = " . $_POST['id_jurusan_pdd'];

$q_jenis_jurusan = $conn->query($sql_jenis_jurusan);
$d_jenis_jurusan = $q_jenis_jurusan->fetch(PDO::FETCH_ASSOC);

//eksekusi jika kedokteran
if ($_POST['id_jurusan_pdd'] == 1) {
    if ($_POST['id_profesi_pdd'] == 1) {
        $status_cek_praktik = "DPT_KED_PPDS";
    } else {
        $status_cek_praktik = "DPT_KED";
    }
} else {
    $status_cek_praktik = "DPT";
}

//elsekusi jika selain kedokteran
if ($d_jenis_jurusan['id_jurusan_pdd_jenis'] != 1) {
    //cek materi_upip
    if ($_POST['materi_upip'] == 'y') {
        $materi_upip = 'y';
    } else {
        $materi_upip = 't';
    }

    //cek materi_napza
    if ($_POST['materi_napza'] == 'y') {
        $materi_napza = 'y';
    } else {
        $materi_napza = 't';
    }
} else {
    $materi_upip = NULL;
    $materi_napza = NULL;
}

//mess/pemondokan optional serta pemilihan dengan dan tanpa makan mess, jika selain profesi PPDS dan mess/pemondokan Tidak maka ELSE.
if ($_POST['id_profesi_pdd'] == 1) {
    $makan_mess = null;
} else {
    $makan_mess = $_POST['makan_mess'];
}

$sql_insert = "INSERT INTO tb_praktik (
    id_praktik, 
    id_institusi, 
    nama_praktik,
    tgl_input_praktik,
    tgl_mulai_praktik,
    tgl_selesai_praktik,
    no_surat_praktik,
    jumlah_praktik,
    id_jurusan_pdd_jenis,
    id_jurusan_pdd,
    id_jenjang_pdd,
    id_profesi_pdd,
    id_user,
    nama_koordinator_praktik,
    email_koordinator_praktik,
    telp_koordinator_praktik,
    status_cek_praktik, 
    status_praktik,
    pilih_mess_praktik,
    makan_mess_praktik,
    materi_upip_praktik,
    materi_napza_praktik
    ) VALUES (
        '" . $_POST['id'] . "', 
        '" . $_POST['institusi'] . "', 
        '" . $_POST['nama_praktik'] . "',
        '" . date('Y-m-d', time()) . "', 
        '" . $_POST['tgl_mulai_praktik'] . "', 
        '" . $_POST['tgl_selesai_praktik'] . "',
        '" . $_POST['no_surat'] . "',
        '" . $_POST['jumlah_praktik'] . "', 
        '" . $d_jenis_jurusan['id_jurusan_pdd_jenis'] . "', 
        '" . $_POST['id_jurusan_pdd'] . "',
        '" . $_POST['id_jenjang_pdd'] . "',
        '" . $_POST['id_profesi_pdd'] . "', 
        '" . $_POST['user'] . "',
        '" . $_POST['nama_koordinator_praktik'] . "', 
        '" . $_POST['email_koordinator_praktik'] . "',
        '" . $_POST['telp_koordinator_praktik'] . "', 
        '" . $status_cek_praktik . "', 
        'D',
        '" . $_POST['pilih_mess'] . "',
        '" . $makan_mess . "',
        '" . $materi_upip . "',
        '" . $materi_napza . "'
        )";

// echo $sql_insert . "<br>";
$conn->query($sql_insert);
// --------------------------------------SIMPAN GENERATE TANGGAL--------------------------------------------

$d1 = $_POST['tgl_mulai_praktik'];
$d2 = $_POST['tgl_selesai_praktik'];
$d2 = date('Y-m-d', strtotime($d2 . "+1 days"));

$period = new DatePeriod(
    new DateTime($d1),
    new DateInterval('P1D'),
    new DateTime($d2)
);

// echo "<pre>";
// // print_r($period);
// echo "</pre>";

$no = 1;
foreach ($period as $key => $value) {
    $sql = "INSERT INTO tb_praktik_tgl (
        id_praktik, 
        praktik_tgl
    ) VALUES (
        '" . $_POST['id'] . "', 
        '" . $value->format('Y-m-d') . "'
    )";
    // echo " $sql<br>";
    $conn->query($sql);
    $no++;
}

// --------------------------------------SIMPAN DATA TARIF--------------------------------------------

//Eksekusi jika jenis jurusan selain dari kedokteran
if ($d_jenis_jurusan['id_jurusan_pdd_jenis'] != 1) {
    $id_praktik = $_POST['id'];

    //Mencari Data Jurusan
    $id_jurusan_pdd = $_POST['id_jurusan_pdd'];
    $sql_jurusan_pdd = "SELECT * FROM tb_jurusan_pdd WHERE id_jurusan_pdd = " . $id_jurusan_pdd;
    $q_jurusan_pdd = $conn->query($sql_jurusan_pdd);
    $d_jurusan_pdd = $q_jurusan_pdd->fetch(PDO::FETCH_ASSOC);

    //Mencari id_jenjang_pdd
    $id_jenjang_pdd = $_POST['id_jenjang_pdd'];

    $tgl_mulai_praktik = $_POST['tgl_mulai_praktik'];
    $tgl_selesai_praktik = $_POST['tgl_selesai_praktik'];
    $jumlah_praktik = $_POST['jumlah_praktik'];

    //SQL menentukan tarif berdasarkan jenis jurusan

    $sql_tarif_jurusan = " SELECT * FROM tb_tarif";
    $sql_tarif_jurusan .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
    $sql_tarif_jurusan .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan  ";
    $sql_tarif_jurusan .= " WHERE tb_tarif.id_jurusan_pdd = $id_jurusan_pdd AND tb_tarif.id_tarif_jenis BETWEEN 1 AND 5 ";
    $sql_tarif_jurusan .= " AND tb_tarif.id_jenjang_pdd = 0 AND tb_tarif.status_tarif = 'y'";
    $sql_tarif_jurusan .= " ORDER BY nama_tarif_jenis ASC, nama_tarif ASC ";

    // echo "<br><br>";
    // echo $sql_tarif_jurusan;
    // echo "<br><br>";

    $q_tarif_jurusan = $conn->query($sql_tarif_jurusan);
    while ($d_tarif_jurusan = $q_tarif_jurusan->fetch(PDO::FETCH_ASSOC)) {

        if ($d_tarif_jurusan['tipe_tarif'] == 'SEKALI') {
            $frekuensi = 1;
        } elseif ($d_tarif_jurusan['tipe_tarif'] == 'TARIF-') {
            $frekuensi = tanggal_between_nonweekend($tgl_mulai_praktik, $tgl_selesai_praktik);
        } elseif ($d_tarif_jurusan['tipe_tarif'] == 'TARIF+') {
            $frekuensi = tanggal_between($tgl_mulai_praktik, $tgl_selesai_praktik);
        } elseif ($d_tarif_jurusan['tipe_tarif'] == 'MINGGUAN') {
            $frekuensi = tanggal_between_week($tgl_mulai_praktik, $tgl_selesai_praktik);
        } else {
            $frekuensi = $d_tarif_jurusan['tipe_tarif'];
        }

        if ($d_tarif_jurusan['frekuensi_tarif'] != 0) {
            $frekuensi = $d_tarif_jurusan['frekuensi_tarif'];
        }

        if ($d_tarif_jurusan['kuantitas_tarif'] != 0) {
            $kuantitas = $d_tarif_jurusan['kuantitas_tarif'];
        } else {
            $kuantitas = $jumlah_praktik;
        }

        //eksekusi jika salah satu materi dipilih (upip dan-atau napza)
        if ($d_tarif_jurusan['nama_tarif'] == 'Materi') {
            $ket_tarif = $d_tarif_jurusan['ket_tarif'];

            //eksekusi jika materi upip dipilih
            if ($materi_upip == 'y') {
                $ket_tarif = $d_tarif_jurusan['ket_tarif'] . ", UPIP";
                $frekuensi += 1;
            }

            //eksekusi jika materi napza dipilih
            if ($materi_napza == 'y') {
                $ket_tarif =  $ket_tarif . ", NAPZA";
                $frekuensi += 1;
            }

            $nama_tarif = $d_tarif_jurusan['nama_tarif'] . " (" . $ket_tarif . ")";
        } else {
            $nama_tarif = $d_tarif_jurusan['nama_tarif'];
        }

        $sql_insert = "INSERT INTO tb_tarif_pilih (
        id_praktik, 
        tgl_input_tarif_pilih,
        nama_jenis_tarif_pilih,
        nama_tarif_pilih,
        nominal_tarif_pilih,
        nama_satuan_tarif_pilih,
        frekuensi_tarif_pilih,
        kuantitas_tarif_pilih,
        jumlah_tarif_pilih
        ) VALUES (
            '" . $id_praktik . "', 
            '" . date('Y-m-d', time()) . "',
            '" . $d_tarif_jurusan['nama_tarif_jenis'] . "', 
            '" . $nama_tarif . "', 
            '" . $d_tarif_jurusan['jumlah_tarif'] . "',  
            '" . $d_tarif_jurusan['nama_tarif_satuan'] . "',
            '" . $frekuensi . "',
            '" . $kuantitas . "', 
            '" . $frekuensi * $kuantitas * $d_tarif_jurusan['jumlah_tarif'] . "'
            )";

        echo $sql_insert;
        echo "<br>";
        $conn->query($sql_insert);
    }
    echo "<br>";

    //SQL BST Eksekusi bila jurusan selain dari kedokteran
    if ($id_jurusan_pdd != 1) {
        $sql_tarif_jenjang = " SELECT * FROM tb_tarif ";
        $sql_tarif_jenjang .= "  JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
        $sql_tarif_jenjang .= " JOIN tb_jenjang_pdd ON tb_tarif.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd ";
        $sql_tarif_jenjang .= "  JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan ";
        $sql_tarif_jenjang .= "  WHERE tb_tarif.id_jurusan_pdd = " . $id_jurusan_pdd;
        $sql_tarif_jenjang .= "  AND tb_tarif.id_jenjang_pdd = " . $id_jenjang_pdd . " AND tb_tarif.id_tarif_jenis BETWEEN 1 AND 6 ";
        $sql_tarif_jenjang .= "  AND tb_tarif.status_tarif = 'y'";
        $sql_tarif_jenjang .= "  ORDER BY nama_jenjang_pdd ASC";

        $q_tarif_jenjang = $conn->query($sql_tarif_jenjang);

        while ($d_tarif_jenjang = $q_tarif_jenjang->fetch(PDO::FETCH_ASSOC)) {
            if ($d_tarif_jenjang['tipe_tarif'] == 'SEKALI') {
                $frekuensi = 1;
            } elseif ($d_tarif_jenjang['tipe_tarif'] == 'TARIF-') {
                $frekuensi = tanggal_between_nonweekend($tgl_mulai_praktik, $tgl_selesai_praktik);
            } elseif ($d_tarif_jenjang['tipe_tarif'] == 'TARIF+') {
                $frekuensi = tanggal_between($tgl_mulai_praktik, $tgl_selesai_praktik);
            } elseif ($d_tarif_jenjang['tipe_tarif'] == 'MINGGUAN') {
                $frekuensi = tanggal_between_week($tgl_mulai_praktik, $tgl_selesai_praktik);
            } else {
                $frekuensi = $d_tarif_jenjang['tipe_tarif'];
            }


            if ($d_tarif_jenjang['frekuensi_tarif'] != 0) {
                $frekuensi = $d_tarif_jenjang['frekuensi_tarif'];
            }

            if ($d_tarif_jenjang['kuantitas_tarif'] != 0) {
                $kuantitas = $d_tarif_jenjang['kuantitas_tarif'];
            } else {
                $kuantitas = $jumlah_praktik;
            }
            // echo $kuantitas;

            $sql_insert_tarif_jenjang = " INSERT INTO tb_tarif_pilih (
                id_praktik, 
                tgl_input_tarif_pilih, 
                nama_jenis_tarif_pilih,
                nama_tarif_pilih,
                nominal_tarif_pilih,
                nama_satuan_tarif_pilih,
                frekuensi_tarif_pilih,
                kuantitas_tarif_pilih,
                jumlah_tarif_pilih
            ) VALUES (
                '" . $id_praktik . "', 
                '" . date('Y-m-d', time()) . "', 
                '" . $d_tarif_jenjang['nama_tarif_jenis'] . "', 
                '" . $d_tarif_jenjang['nama_tarif'] . "', 
                '" . $d_tarif_jenjang['jumlah_tarif'] . "',  
                '" . $d_tarif_jenjang['nama_tarif_satuan'] . "',
                '" . $frekuensi . "', 
                '" . $kuantitas . "', 
                '" . $frekuensi * $kuantitas * $d_tarif_jenjang['jumlah_tarif'] . "'
            )";

            // echo $sql_insert_tarif_jenjang;
            // echo "<br>";
            $conn->query($sql_insert_tarif_jenjang);
        }
    }
    echo "<br><br>";

    //SQL Tarif Ujian 
    $cek_pilih_ujian = $_POST['cek_pilih_ujian'];

    // echo $cek_pilih_ujian . "<br>";
    if ($cek_pilih_ujian == 'y') {
        $sql_tarif_ujian = " SELECT * FROM tb_tarif ";
        $sql_tarif_ujian .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
        $sql_tarif_ujian .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan ";
        $sql_tarif_ujian .= "  WHERE tb_tarif.id_tarif_jenis = 6 AND tb_tarif.id_jurusan_pdd = " . $id_jurusan_pdd;
        $sql_tarif_ujian .= "  AND tb_tarif.status_tarif = 'y'";
        $sql_tarif_ujian .= "  ORDER BY nama_tarif_jenis ASC";

        // echo $sql_tarif_ujian;

        $q_tarif_ujian = $conn->query($sql_tarif_ujian);

        while ($d_tarif_ujian = $q_tarif_ujian->fetch(PDO::FETCH_ASSOC)) {
            if ($d_tarif_ujian['tipe_tarif'] == 'SEKALI') {
                $frekuensi = 1;
            } elseif ($d_tarif_ujian['tipe_tarif'] == 'INPUT') {
                echo "INPUT";
            } elseif ($d_tarif_ujian['tipe_tarif'] == 'TARIF-') {
                $frekuensi = tanggal_between_nonweekend($tgl_mulai_praktik, $tgl_selesai_praktik);
            } elseif ($d_tarif_ujian['tipe_tarif'] == 'TARIF+') {
                $frekuensi = tanggal_between($tgl_mulai_praktik, $tgl_selesai_praktik);
            } elseif ($d_tarif_ujian['tipe_tarif'] == 'MINGGUAN') {
                $frekuensi = tanggal_between_week($tgl_mulai_praktik, $tgl_selesai_praktik);
            } else {
                $frekuensi = $d_tarif_ujian['tipe_tarif'];
            }

            if ($d_tarif_ujian['frekuensi_tarif'] != 0) {
                $frekuensi = $d_tarif_ujian['frekuensi_tarif'];
            }

            if ($d_tarif_ujian['kuantitas_tarif'] != 0) {
                $kuantitas = $d_tarif_ujian['kuantitas_tarif'];
            } else {
                $kuantitas = $jumlah_praktik;
            }
            // echo $kuantitas;

            $sql_insert_tarif_ujian = " INSERT INTO tb_tarif_pilih (
                id_praktik, 
                tgl_input_tarif_pilih, 
                nama_jenis_tarif_pilih,
                nama_tarif_pilih,
                nominal_tarif_pilih,
                nama_satuan_tarif_pilih,
                frekuensi_tarif_pilih,
                kuantitas_tarif_pilih,
                jumlah_tarif_pilih,
                ujian_tarif_pilih
            ) VALUES (
                '" . $id_praktik . "', 
                '" . date('Y-m-d', time()) . "', 
                '" . $d_tarif_ujian['nama_tarif_jenis'] . "', 
                '" . $d_tarif_ujian['nama_tarif'] . "', 
                '" . $d_tarif_ujian['jumlah_tarif'] . "',  
                '" . $d_tarif_ujian['nama_tarif_satuan'] . "',  
                '" . $frekuensi . "', 
                '" . $kuantitas . "', 
                '" . $frekuensi * $kuantitas * $d_tarif_ujian['jumlah_tarif'] . "',
                'y' 
            )";

            // echo $sql_insert_tarif_ujian;
            // echo "<br>";
            $conn->query($sql_insert_tarif_ujian);
        }
    }
    echo "<br><br>";

    $sql_update_status_praktik = " UPDATE tb_praktik";
    $sql_update_status_praktik .= " SET status_cek_praktik = 'DPT'";
    $sql_update_status_praktik .= " WHERE id_praktik = $id_praktik";

    $conn->query($sql_update_status_praktik);
    json_encode(['success' => 'Data Tarif Berhasil Disimpan']);
}
