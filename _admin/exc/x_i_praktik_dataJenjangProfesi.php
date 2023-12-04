<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

//mencari jenis jurusan
$sql_jenis_jurusan = "SELECT tb_jenjang_pdd.id_jenjang_pdd, tb_jenjang_pdd.nama_jenjang_pdd 
FROM tb_jurusan_pdd 
JOIN tb_jurusan_pdd_jenjang  ON tb_jurusan_pdd.id_jurusan_pdd = tb_jurusan_pdd_jenjang.id_jurusan_pdd
JOIN tb_jenjang_pdd ON tb_jenjang_pdd.id_jenjang_pdd = tb_jurusan_pdd_jenjang.id_jenjang_pdd
WHERE tb_jurusan_pdd.id_jurusan_pdd = ".$_POST['id_jurusan_pdd'] ."
GROUP BY tb_jenjang_pdd.id_jenjang_pdd, tb_jenjang_pdd.nama_jenjang_pdd";


$q_jenis_jurusan = $conn->query($sql_jenis_jurusan);
$d_jenis_jurusan = $q_jenis_jurusan->fetch(PDO::FETCH_ASSOC);
//  var_dump($sql_jenis_jurusan) . "<br>";
foreach($d_jenis_jurusan as $row){
    echo $row['id_jenjang_pdd'];
    echo $row['nama_jenjang_pdd'];
    
}
