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
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br />
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table" width="100%">
                                <tbody>
                                    <div class="dropdown">
                                        <center>
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Cetak Laporan Buku
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="laporanbuku" target="_blank" class="cursor">ALL YEAR</a>
                                                <a class="dropdown-item" href="laporanbuku?tahun=2018" target="_blank" class="cursor">2018</a>
                                                <a class="dropdown-item" href="laporanbuku?tahun=2019" target="_blank" class="cursor">2019</a>
                                                <a class="dropdown-item" href="laporanbuku?tahun=2020" target="_blank" class="cursor">2020</a>
                                                <a class="dropdown-item" href="laporanbuku?tahun=2021" target="_blank" class="cursor">2021</a>
                                                <a class="dropdown-item" href="laporanbuku?tahun=2022" target="_blank" class="cursor">2022</a>
                                                <a class="dropdown-item" href="laporanbuku?tahun=2023" target="_blank" class="cursor">2023</a>
                                                <a class="dropdown-item" href="laporanbuku?2024" target="_blank" class="cursor">2024</a>
                                            </div>
                                        </center>
                                    </div>
                                    <br>
                                    <br>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>