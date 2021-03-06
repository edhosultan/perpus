<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php
        $d = $this->db->query("SELECT * FROM tbl_login WHERE id_login='$idbo'")->row();
        if (!empty($d->foto !== "-")) {
        ?>
          <br />
          <img src="<?php echo base_url(); ?>assets_style/image/<?php echo $d->foto; ?>" alt="#" c lass="user-image" style="border:2px solid #fff;height:auto;width:100%;" />
        <?php } else { ?>
          <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
          <i class="fa fa-user fa-4x" style="color:#fff;"></i>
        <?php } ?>
      </div>
      <div class="pull-left info" style="margin-top: 5px;">
        <p><?php echo $d->nama; ?></p>
        <p><?= $d->level; ?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
      <br />
      <br />
      <br />
      <br />
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <?php if ($this->session->userdata('level') == 'Petugas') { ?>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if ($this->uri->uri_string() == 'dashboard') {
                      echo 'active';
                    } ?>">
          <a href="<?php echo base_url('dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->uri_string() == 'user') {
                      echo 'active';
                    } ?>
        <?php if ($this->uri->uri_string() == 'user/tambah') {
          echo 'active';
        } ?>
        <?php if ($this->uri->uri_string() == 'user/edit/' . $this->uri->segment('3')) {
          echo 'active';
        } ?>">
          <a href="<?php echo base_url('user'); ?>" class="cursor">
            <i class="fa fa-user"></i> <span>Data Pengguna</span></a>
        </li>
        <li class="treeview <?php if ($this->uri->uri_string() == 'data/kategori') {
                              echo 'active';
                            } ?>
				<?php if ($this->uri->uri_string() == 'data/rak') {
          echo 'active';
        } ?>
				<?php if ($this->uri->uri_string() == 'data') {
          echo 'active';
        } ?>
				<?php if ($this->uri->uri_string() == 'data/bukutambah') {
          echo 'active';
        } ?>
				<?php if ($this->uri->uri_string() == 'data/bukudetail/' . $this->uri->segment('3')) {
          echo 'active';
        } ?>
				<?php if ($this->uri->uri_string() == 'data/bukuedit/' . $this->uri->segment('3')) {
          echo 'active';
        } ?>">
          <a href="#">
            <i class="fa fa-pencil-square"></i>
            <span>Book </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->uri_string() == 'data') {
                          echo 'active';
                        } ?>
						<?php if ($this->uri->uri_string() == 'data/bukutambah') {
              echo 'active';
            } ?>
						<?php if ($this->uri->uri_string() == 'data/bukudetail/' . $this->uri->segment('3')) {
              echo 'active';
            } ?>
						<?php if ($this->uri->uri_string() == 'data/bukuedit/' . $this->uri->segment('3')) {
              echo 'active';
            } ?>">
              <a href="<?php echo base_url("data"); ?>" class="cursor">
                <span class="fa fa-book"></span> Data Buku

              </a>
            </li>
            <li class=" <?php if ($this->uri->uri_string() == 'data/kategori') {
                          echo 'active';
                        } ?>">
              <a href="<?php echo base_url("data/kategori"); ?>" class="cursor">
                <span class="fa fa-tags"></span> Kategori

              </a>
            </li>
            <li class=" <?php if ($this->uri->uri_string() == 'data/rak') {
                          echo 'active';
                        } ?>">
              <a href="<?php echo base_url("data/rak"); ?>" class="cursor">
                <span class="fa fa-list"></span> Rak

              </a>
            </li>
            <li class=" <?php if ($this->uri->uri_string() == 'data/buku_rusak') {
                          echo 'active';
                        } ?>">
              <a href="<?php echo base_url("data/buku_rusak"); ?>" class="cursor">
                <span class="fa fa-book"></span> Buku Rusak

              </a>
            </li>
            <li class=" <?php if ($this->uri->uri_string() == 'data/mailbox') {
                          echo 'active';
                        } ?>">
              <a href="<?php echo base_url("data/mailbox"); ?>" class="cursor">
                <span class="fa fa-book"></span> Mailbox

              </a>
            </li>
          </ul>
          <a href="#">
            <i class="fa fa-pencil-square"></i>
            <span>Ebook </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->uri_string() == 'data') {
                          echo 'active';
                        } ?>
						<?php if ($this->uri->uri_string() == 'data/ebooktambah') {
              echo 'active';
            } ?>
						<?php if ($this->uri->uri_string() == 'data/ebookdetail/' . $this->uri->segment('3')) {
              echo 'active';
            } ?>
						<?php if ($this->uri->uri_string() == 'data/ebookedit/' . $this->uri->segment('3')) {
              echo 'active';
            } ?>">
              <a href="<?php echo base_url("data/ebook"); ?>" class="cursor">
                <span class="fa fa-book"></span> Data Ebook

              </a>
            </li>
            <li class=" <?php if ($this->uri->uri_string() == 'data/kategori_ebook') {
                          echo 'active';
                        } ?>">
              <a href="<?php echo base_url("data/kategori_ebook"); ?>" class="cursor">
                <span class="fa fa-tags"></span> Kategori Ebook

              </a>
            </li>

          </ul>
        </li>
        <li class="treeview 
					<?php if ($this->uri->uri_string() == 'transaksi') {
            echo 'active';
          } ?>
					<?php if ($this->uri->uri_string() == 'transaksi/pinjam') {
            echo 'active';
          } ?>
					<?php if ($this->uri->uri_string() == 'transaksi/detailpinjam/' . $this->uri->segment('3')) {
            echo 'active';
          } ?>
					<?php if ($this->uri->uri_string() == 'transaksi/kembalipinjam/' . $this->uri->segment('3')) {
            echo 'active';
          } ?>">
          <a href="#">
            <i class="fa fa-download"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($this->uri->uri_string() == 'transaksi') {
                          echo 'active';
                        } ?>
							<?php if ($this->uri->uri_string() == 'transaksi/pinjam') {
                echo 'active';
              } ?>
							<?php if ($this->uri->uri_string() == 'transaksi/detailpinjam/' . $this->uri->segment('3')) {
                echo 'active';
              } ?>
							<?php if ($this->uri->uri_string() == 'transaksi/kembalipinjam/' . $this->uri->segment('3')) {
                echo 'active';
              } ?>">
              <a href="<?php echo base_url("transaksi"); ?>" class="cursor">
                <span class="fa fa-upload"></span> Peminjaman

              </a>
            </li>
            <!--
						<li class="">
							<a href="<?php echo base_url("buku"); ?>" class="cursor">
								<span class="fa fa-list"></span> laporan
								
							</a>
						</li>-->
          </ul>
        </li>
        <li class="treeview 
					<?php if ($this->uri->uri_string() == 'transaksi') {
            echo 'active';
          } ?>
					<?php if ($this->uri->uri_string() == 'transaksi/pinjam') {
            echo 'active';
          } ?>
					<?php if ($this->uri->uri_string() == 'transaksi/detailpinjam/' . $this->uri->segment('3')) {
            echo 'active';
          } ?>
					<?php if ($this->uri->uri_string() == 'transaksi/kembalipinjam/' . $this->uri->segment('3')) {
            echo 'active';
          } ?>">
          <a href="#">
            <i class="fa fa-download"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="">
              <a href="<?php echo base_url('laporan/laporananggota_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Anggota</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporanbuku_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Buku</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporanebook_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Ebook</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporanpeminjaman_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Peminjaman</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporanpengembalian_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Pengembalian</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporandenda_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Denda</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporanrusak_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Buku Rusak</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporanpesan_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Laporan Mailbox</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporantop10_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Top 10 Pengunjung</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporantopbuku10_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Top 10 Buku</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('laporan/laporantopanggota10_view'); ?>" class="cursor">
                <i class="fa fa-print"></i> <span>Cetak Top 10 Anggota</span>
              </a>
            </li>
          </ul>

        </li>
        <li class="<?php if ($this->uri->uri_string() == 'transaksi/denda') {
                      echo 'active';
                    } ?>">
          <a href="<?php echo base_url("transaksi/denda"); ?>" class="cursor">
            <i class="fa fa-money"></i> <span>Denda</span>

          </a>
        </li>
      <?php } ?>




      <!-- anggota -->
      <?php if ($this->session->userdata('level') == 'Anggota') { ?>
        <li class="<?php if ($this->uri->uri_string() == 'transaksi') {
                      echo 'active';
                    } ?>">
          <a href="<?php echo base_url("transaksi"); ?>" class="cursor">
            <i class="fa fa-upload"></i> <span>Data Peminjaman Anggota</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->uri_string() == 'data') {
                      echo 'active';
                    } ?>
				<?php if ($this->uri->uri_string() == 'data/detailmailbox/' . $this->uri->segment('3')) {
          echo 'active';
        } ?>">
          <a href="<?php echo base_url("data/mailbox"); ?>" class="cursor">
            <i class="fa fa-book"></i> <span>Pesan Buku</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->uri_string() == 'data') {
                      echo 'active';
                    } ?>
				<?php if ($this->uri->uri_string() == 'data/bukudetail/' . $this->uri->segment('3')) {
          echo 'active';
        } ?>">
          <a href="<?php echo base_url("data"); ?>" class="cursor">
            <i class="fa fa-search"></i> <span>Cari Buku</span>
          </a>
        </li>
        </li>
        <li class="<?php if ($this->uri->uri_string() == 'data') {
                      echo 'active';
                    } ?>
				<?php if ($this->uri->uri_string() == 'data/ebookdetail/' . $this->uri->segment('3')) {
          echo 'active';
        } ?>">
          <a href="<?php echo base_url("data/ebook"); ?>" class="cursor">
            <i class="fa fa-search"></i> <span>Cari Ebook</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->uri_string() == 'user/edit/' . $this->uri->segment('3')) {
                      echo 'active';
                    } ?>">
          <a href="<?php echo base_url('user/edit/' . $this->session->userdata('ses_id')); ?>" class="cursor">
            <i class="fa fa-user"></i> <span>Data Anggota</span>
          </a>
        </li>
        <li class="">
          <a href="<?php echo base_url('user/detail/' . $this->session->userdata('ses_id')); ?>" target="_blank" class="cursor">
            <i class="fa fa-print"></i> <span>Cetak kartu Anggota</span>
          </a>
        </li>
      <?php } ?>
      <!--
        <li class="treeview">
            <a href="#">
              <i class="fa fa-pencil-square"></i>
              <span>Menu</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

            </ul>
        </li>-->

    </ul>
    <div class="clearfix"></div>
    <br />
    <br />
  </section>
  <!-- /.sidebar -->
</aside>