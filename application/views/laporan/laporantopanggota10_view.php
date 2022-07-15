<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-edit" style="color:green"> </i> <?= $title_web; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
            <li class="active"><i class="fa fa-file-text"></i>&nbsp; <?= $title_web; ?></li>
        </ol>
    </section>
    <section class="content">
        <?php if (!empty($this->session->flashdata())) {
            echo $this->session->flashdata('LAPORAN');
        } ?>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Data Top 10 Peminjam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- <li class="breadcrumb-item"><a href="<?= base_url('u1'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Purchase Order</li> -->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <!-- <div class="card-header">
                        <h3 class="card-title">Per Periode</h3>
                    </div> -->
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" action="<?= base_url('laporan/laporantopanggota10') ?>" method="POST" target="_blank">
                                <div class="card-body">
                                    <div class="form-group">
                                        <!-- <input type="hidden" name="nilaifilter" value="1"> -->
                                        <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="tanggalawal" required=""> <br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="tanggalakhir" required=""> <br>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>