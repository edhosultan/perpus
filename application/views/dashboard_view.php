<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if ($this->session->userdata('level') == 'Anggota') { ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard <small>Perpus Seru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-sm-12">
          <div class="col-lg-3 col-xs-6">
            <!--small box-->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?= $count_buku; ?></h3>

                <p>Jenis Buku</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="data" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!--small box-->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= $count_ebook; ?></h3>

                <p>Jenis Ebook</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="data/ebook" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>



        </div>
      </div>


      <form method="get" action="">
        <input type="text" name="tahun" value="">
        <select name="bulan" id="">
          <option value="1">Januari</option>
          <option value="2">Februari</option>
          <option value="3">Maret</option>
          <option value="4">April</option>
          <option value="5">Mei</option>
          <option value="6">Juni</option>
          <option value="7">Juli</option>
          <option value="8">Agustus</option>
          <option value="9">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
        <input type="submit" name="cari" value="cari">
      </form>
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title" style="background-color: green;">ANGGOTA PERPUSTAKAAN</h3>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0,table table-bordered table-striped table" style="background-color: grey;">
              <thead>
                <tr>
                  <th>Id Anggota</th>
                  <th>Nama Anggota</th>
                  <th>Tanggal Bergabung</th>
                  <th>Peminjaman Selama Ini</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Koneksi
                if (isset($_GET['cari'])) {
                  $bulan = $_GET['bulan'];
                  $tahun = $_GET['tahun'];
                }
                ?>
                <?php $no = 1;
                foreach ($user as $isi) { ?>
                  <tr>
                    <td><?= $isi['id_login']; ?></td>
                    <td><?= $isi['nama']; ?></>
                    <td><?= $isi['tgl_bergabung']; ?></>
                    <td><?php
                        $id = $isi['anggota_id'];
                        if (isset($_GET['cari'])) {
                          $dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE anggota_id= '$id' AND status = 'Di Kembalikan' AND year(tgl_pinjam)='$tahun' AND month(tgl_pinjam) ='$bulan'");
                        } else {
                          $dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE anggota_id= '$id' AND status = 'Di Kembalikan' ");
                        }

                        if ($dd->num_rows() > 0) {
                          echo $dd->num_rows();
                        } else {
                          echo '0';
                        }
                        ?></td>
                  </tr>
                <?php $no++;
                } ?>

              </tbody>
            </table>
          </div>

        </div>

      </div>



      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title" style="background-color: green;">TERAKHIR DIPESAN</h3>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0,table table-bordered table-striped table" style="background-color: grey;">
              <thead>
                <tr>
                  <th>Id Buku</th>
                  <th>Judul Buku</th>
                  <th>Pengarang</th>
                  <th>Buku Populer Sering Dipinjam</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Koneksi
                if (isset($_GET['cari'])) {
                  $bulan = $_GET['bulan'];
                  $tahun = $_GET['tahun'];
                }
                ?>
                <?php $no = 1;
                foreach ($buku as $isi) { ?>
                  <tr>
                    <td><?= $isi['id_buku']; ?></td>
                    <td><?= $isi['title']; ?></td>
                    <td><?= $isi['pengarang']; ?></td>
                    <td><?php
                        $id = $isi['buku_id'];
                        if (isset($_GET['cari'])) {
                          $dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE buku_id= '$id' AND status = 'Di Kembalikan' AND year(tgl_pinjam)='$tahun' AND month(tgl_pinjam) ='$bulan' ");
                        } else {
                          $dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE buku_id= '$id' AND status = 'Di Kembalikan' ");
                        }

                        if ($dd->num_rows() > 0) {
                          echo $dd->num_rows();
                        } else {
                          echo '0';
                        }
                        ?></td>
                  </tr>
                <?php $no++;
                } ?>

              </tbody>
            </table>
          </div>

        </div>

        <div class="card-footer clearfix">
          <a href="data/mailbox" class="btn btn-sm btn-info float-left">Pesan Buku Baru</a>
          <a href="data/mailbox" class="btn btn-sm btn-secondary float-right">Liat Semua Pesanan</a>
        </div>

      </div>


  </div>
  </section>
  </div>

<?php } else { ?>
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-sm-12">
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= $count_pengguna; ?></h3>

                <p>Anggota</p>
              </div>
              <div class="icon">
                <i class="fa fa-edit"></i>
              </div>
              <a href="user" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">
            <!--small box-->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?= $count_buku; ?></h3>

                <p>Jenis Buku</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="data" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!--small box-->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= $count_ebook; ?></h3>

                <p>Jenis Ebook</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="data/ebook" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= $count_pinjam; ?></h3>

                <p>Pinjam</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-plus"></i>
              </div>
              <a href="transaksi" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= $count_kembali; ?></h3>

                <p>Di Kembalikan</p>
              </div>
              <div class="icon">
                <i class="fa fa-list"></i>
              </div>
              <a href="transaksi" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?= $count_mailbox; ?></h3>

                <p>Kotak Masuk</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="data/mailbox" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
<?php } ?>



<!-- /.content -->