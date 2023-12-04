<body class="bg-gradient-primary">
  <meta http-equiv="refresh" content="60">
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="h5 font-weight-bold row">
      <ul class="navbar-nav col">
        <li class="nav-item active">
          <img src="./_img/logopemprov.png" class="img-fluid" alt="Responsive image" width="30px">
          <img src="./_img/logorsj.png" class="img-fluid" alt="Responsive image" width="30px">
          <img src="./_img/paripurnakars.png" class="img-fluid" alt="Responsive image" width="40px">
          <img src="./_img/wbk.png" class="img-fluid" alt="Responsive image" width="30px">
          DASHBOARD PRAKTIKAN DAN MESS/PEMONDOKAN
          <span class="badge badge-primary text-md"><?= tanggal_hari(date('w')) . " " . date("d M Y"); ?>, <span id="jam"></span></span>
        </li>
      </ul>
      <ul class="navbar-nav col-auto font-weight-bold">
        <a class="btn btn-outline-success btn-sm  my-auto" href="?reg"><i class="fas fa-user-plus"></i> REGISTRASI</a>&nbsp;
        <a class="btn btn-outline-primary btn-sm  my-auto" href="?lo"><i class="fas fa-sign-in-alt"></i> LOGIN</a>
      </ul>
    </div>
  </nav>

  <!-- DATA PRAKTIKAN -->
  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-3">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-3">
              <div class="text-center">
                <div class="h5 text-gray-900 mb-1"><span class="badge badge-primary text-lg">DATA PRAKTIKAN</span></div>
              </div>
              <hr>
              <?php
              $sql_praktik = "SELECT * FROM tb_praktik";
              $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
              $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
              $sql_praktik .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
              $sql_praktik .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "'";
              // $sql_praktik = "SELECT * FROM tb_praktik ";
              // $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
              // $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
              // $sql_praktik .= " WHERE tb_praktik.status_praktik = 'Y'";
              // $sql_praktik .= " ORDER BY tb_praktik.tgl_selesai_praktik ASC";

              // echo $sql_praktik;

              $q_praktik = $conn->query($sql_praktik);
              $r_praktik = $q_praktik->rowCount();

              // echo $cal . "-" . $r_praktik . "-" . $round_col . "<br>";
              if ($r_praktik > 0) {
                $round_col = ceil(12 / $r_praktik);
              ?>
                <div class="row">
                  <?php
                  while ($d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-<?= $round_col; ?> text-center">
                      <b>
                        <?php
                        if ($d_praktik['akronim_institusi'] == NULL) {
                          echo $d_praktik['nama_institusi'];
                        } else {
                          echo $d_praktik['akronim_institusi'];
                        }
                        ?>
                      </b><br>
                      <?php
                      if ($d_praktik['logo_institusi'] == '') {
                        $link_logo_institusi = "./_img/logo_institusi/default.png";
                      } else {
                        $link_logo_institusi = $d_praktik['logo_institusi'];
                      }
                      ?>
                      <img src="<?= $link_logo_institusi; ?>" class="img-fluid" alt="Responsive image" width="75px" height="75px"><br>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              <?php
              } else {
              ?>
                <div class="jumbotron text-center my-auto">
                  <div class="display-4 my-auto text-lg text-uppercase font-weight-bold mb-2">Praktikan Tidak Ada </div>
                  <p class="lead mt-2 mb-0">
                    <a class="btn btn-outline-success" href="?reg" target="_blank" role="button">Ayo Daftar !!! </a>
                  </p>
                </div>
              <?php
              }
              ?>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- DATA MESS -->
  <div class=" container">
    <div class="card o-hidden border-0 shadow-lg my-3">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-3">
              <div class="text-center">
                <div class="h5 text-gray-900 mb-1"><span class="badge badge-primary text-lg">DATA MESS</span></div>
              </div>
              <?php
              $sql_mess = "SELECT * FROM tb_mess ";
              $sql_mess .= " WHERE nama_pemilik_mess = 'RS Jiwa Provinsi Jawa Barat' ";
              $sql_mess .= " ORDER BY tb_mess.nama_mess ASC";

              $q_mess = $conn->query($sql_mess);
              $r_mess = $q_mess->rowCount();
              ?>
              <div class="table-responsive">
                <table class="table">
                  <thead class="table-dark">
                    <tr class="font-weight-bold text-center">
                      <th scope='col'>NO</th>
                      <th>NAMA MESS</th>
                      <th>NAMA PEMILIK</th>
                      <th>KAPASITAS TOTAL</th>
                      <th>KAPASITAS TERISI</th>
                      <th>KAPASITAS SISA</th>
                      <th>Rincian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $jumlah_terisi = 0;
                    while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                      $sql_mess1 = "SELECT tb_praktik.id_praktik, nama_mess, nama_institusi, nama_jurusan_pdd, jumlah_praktik, tgl_mulai_praktik, tgl_selesai_praktik, praktik_tgl  FROM tb_praktik";
                      $sql_mess1 .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                      $sql_mess1 .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                      $sql_mess1 .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                      $sql_mess1 .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                      $sql_mess1 .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                      $sql_mess1 .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "' AND  tb_mess.id_mess = " . $d_mess['id_mess'];
                      $sql_mess1 .= " ORDER BY tb_mess.nama_mess ASC";
                      // echo $sql_mess1 . "<br>";
                      $q_mess1 = $conn->query($sql_mess1);
                      $jumlah_terisi = 0;
                      while ($d_mess1 = $q_mess1->fetch(PDO::FETCH_ASSOC)) {
                        $jumlah_terisi += $d_mess1['jumlah_praktik'];
                      }
                    ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $d_mess['nama_mess']; ?></td>
                        <td><?= $d_mess['nama_pemilik_mess']; ?></td>
                        <td class="text-center"><?= $d_mess['kapasitas_t_mess']; ?></td>
                        <td class="text-center"><?= $jumlah_terisi; ?></td>
                        <td class="text-center"><?= $d_mess['kapasitas_t_mess'] - $jumlah_terisi; ?></td>
                        <td class="text-center">
                          <button class="btn btn-outline-primary btn-sm" data-toggle="collapse" data-target="#c_<?= $d_mess['id_mess']; ?>">
                            <i class="fas fa-info-circle"></i>
                          </button>

                          <!-- data detail mess  -->
                      <tr>
                        <td colspan="7" class="p-0">
                          <div id="accordion<?= $d_mess['id_mess']; ?>">
                            <div id="c_<?= $d_mess['id_mess']; ?>" class="collapse" data-parent="#accordion<?= $d_mess['id_mess']; ?>">
                              <?php
                              $sql_messPraktik = "SELECT * FROM tb_praktik";
                              $sql_messPraktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                              $sql_messPraktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                              $sql_messPraktik .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                              $sql_messPraktik .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                              $sql_messPraktik .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "'  AND tb_mess_pilih.id_mess = " . $d_mess['id_mess'];
                              // echo $sql_messPraktik . "<br>";
                              $q_messPraktik = $conn->query($sql_messPraktik);
                              if ($q_messPraktik->rowCount() > 0) {
                              ?>
                                <table class="table table-hover table-striped text-center">
                                  <thead class="table-light">
                                    <tr class="font-weight-bold ">
                                      <th>Nama Institusi</th>
                                      <th>Jurusan</th>
                                      <th>Jumlah Praktik</th>
                                      <th>Tanggal Mulai</th>
                                      <th>Tanggal Selesai</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    while ($d_messPraktik = $q_messPraktik->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                      <tr>
                                        <td><?= $d_messPraktik['nama_institusi']; ?></td>
                                        <td><?= $d_messPraktik['nama_jurusan_pdd']; ?></td>
                                        <td><?= $d_messPraktik['jumlah_praktik']; ?></td>
                                        <td><?= tanggal($d_messPraktik['tgl_mulai_praktik']); ?></td>
                                        <td><?= tanggal($d_messPraktik['tgl_selesai_praktik']); ?></td>
                                      </tr>
                                    <?php
                                    }
                                    ?>
                                  </tbody>
                                </table>
                              <?php
                              } else {
                              ?>
                                <div class="jumbotron">
                                  <div class="jumbotron-fluid font-weight-bold text-center">
                                    DATA PRAKTIK TIDAK ADA
                                  </div>
                                </div>
                              <?php
                              }
                              ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                      </td>
                      </tr>
                    <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- DATA PEMONDOKAN -->
  <div class=" container">
    <div class="card o-hidden border-0 shadow-lg my-3">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-3">
              <div class="text-center">
                <div class="h5 text-gray-900 mb-1"><span class="badge badge-primary text-lg">DATA PEMONDOKAN</span></div>
              </div>
              <?php
              $sql_mess = "SELECT * FROM tb_mess ";
              $sql_mess .= " WHERE nama_pemilik_mess != 'RS Jiwa Provinsi Jawa Barat' AND status_mess = 'y'";
              $sql_mess .= " ORDER BY tb_mess.nama_mess ASC";

              $q_mess = $conn->query($sql_mess);
              $r_mess = $q_mess->rowCount();
              ?>
              <div class="table-responsive">
                <table class="table">
                  <thead class="table-dark">
                    <tr class="font-weight-bold text-center">
                      <th scope='col'>NO</th>
                      <th>NAMA MESS</th>
                      <th>NAMA PEMILIK</th>
                      <th>KAPASITAS TOTAL</th>
                      <th>KAPASITAS TERISI</th>
                      <th>KAPASITAS SISA</th>
                      <th>Rincian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $jumlah_terisi = 0;
                    while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                      $sql_mess1 = "SELECT tb_praktik.id_praktik, nama_mess, nama_institusi, nama_jurusan_pdd, jumlah_praktik, tgl_mulai_praktik, tgl_selesai_praktik, praktik_tgl  FROM tb_praktik";
                      $sql_mess1 .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                      $sql_mess1 .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                      $sql_mess1 .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                      $sql_mess1 .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                      $sql_mess1 .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                      $sql_mess1 .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "' AND  tb_mess.id_mess = " . $d_mess['id_mess'];
                      $sql_mess1 .= " ORDER BY tb_mess.nama_mess ASC";
                      // echo $sql_mess1 . "<br>";
                      $q_mess1 = $conn->query($sql_mess1);
                      $jumlah_terisi = 0;
                      while ($d_mess1 = $q_mess1->fetch(PDO::FETCH_ASSOC)) {
                        $jumlah_terisi += $d_mess1['jumlah_praktik'];
                      }
                    ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $d_mess['nama_mess']; ?></td>
                        <td><?= $d_mess['nama_pemilik_mess']; ?></td>
                        <td class="text-center"><?= $d_mess['kapasitas_t_mess']; ?></td>
                        <td class="text-center"><?= $jumlah_terisi; ?></td>
                        <td class="text-center"><?= $d_mess['kapasitas_t_mess'] - $jumlah_terisi; ?></td>
                        <td class="text-center">
                          <button class="btn btn-outline-primary btn-sm" data-toggle="collapse" data-target="#c_<?= $d_mess['id_mess']; ?>">
                            <i class="fas fa-info-circle"></i>
                          </button>

                          <!-- data detail mess  -->
                      <tr>
                        <td colspan="7" class="p-0">
                          <div id="accordion<?= $d_mess['id_mess']; ?>">
                            <div id="c_<?= $d_mess['id_mess']; ?>" class="collapse" data-parent="#accordion<?= $d_mess['id_mess']; ?>">
                              <?php
                              $sql_messPraktik = "SELECT * FROM tb_praktik";
                              $sql_messPraktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                              $sql_messPraktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                              $sql_messPraktik .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                              $sql_messPraktik .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                              $sql_messPraktik .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "'  AND tb_mess_pilih.id_mess = " . $d_mess['id_mess'];

                              // echo $sql_messPraktik . "<br>";
                              $q_messPraktik = $conn->query($sql_messPraktik);
                              if ($q_messPraktik->rowCount() > 0) {
                              ?>
                                <table class="table table-hover table-striped text-center">
                                  <thead class="table-light">
                                    <tr class="font-weight-bold ">
                                      <th>Nama Institusi</th>
                                      <th>Jurusan</th>
                                      <th>Jumlah Praktik</th>
                                      <th>Tanggal Mulai</th>
                                      <th>Tanggal Selesai</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    while ($d_messPraktik = $q_messPraktik->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                      <tr>
                                        <td><?= $d_messPraktik['nama_institusi']; ?></td>
                                        <td><?= $d_messPraktik['nama_jurusan_pdd']; ?></td>
                                        <td><?= $d_messPraktik['jumlah_praktik']; ?></td>
                                        <td><?= tanggal($d_messPraktik['tgl_mulai_praktik']); ?></td>
                                        <td><?= tanggal($d_messPraktik['tgl_selesai_praktik']); ?></td>
                                      </tr>
                                    <?php
                                    }
                                    ?>
                                  </tbody>
                                </table>
                              <?php
                              } else {
                              ?>
                                <div class="jumbotron">
                                  <div class="jumbotron-fluid font-weight-bold text-center">
                                    DATA PRAKTIK TIDAK ADA
                                  </div>
                                </div>
                              <?php
                              }
                              ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                      </td>
                      </tr>
                    <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

<script type="text/javascript">
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