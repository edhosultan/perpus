<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if ($this->session->userdata('level') == 'Anggota') { ?>
  <div class="content-wrapper">
    <div class="container">
      <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            if (count($buku) > 0) {
              foreach ($buku as $data) {
                echo "'" . $data->title . "',";
              }
            }
            ?>
          ],
          datasets: [{
            label: 'Jumlah Peminjam',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
              <?php
              if (count($buku) > 0) {
                foreach ($buku as $data) {
                  echo number_format($data->jumlah_peminjaman)  . ", ";
                }
              }
              ?>
            ]
          }]
        },
      });
    </script>
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
              <a href="transaksi/mailbox" class="small-box-footer">Informasi Lebih <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
<?php } ?>

<!-- /.content -->