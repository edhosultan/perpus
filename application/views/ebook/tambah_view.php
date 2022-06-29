<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-plus" style="color:green"> </i> <?= $title_web; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
            <li class="active"><i class="fa fa-plus"></i>&nbsp; <?= $title_web; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo base_url('data/prosesebook'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kategori Ebook</label>
                                        <select class="form-control select2" required="required" name="kategori_ebook">
                                            <option disabled selected value> -- Pilih Kategori Ebook -- </option>
                                            <?php foreach ($katsbook as $isibook) { ?>
                                                <option value="<?= $isibook['id_kategori_ebook']; ?>"><?= $isibook['nama_kategori_ebook']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sampul <small style="color:green">(gambar) * opsional</small></label>
                                        <input type="file" accept="image/*" name="gambar">
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Ebook</label>
                                        <input type="text" class="form-control" name="judul_ebook" placeholder="Contoh : Cara Cepat Belajar Pemrograman Web">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pengarang</label>
                                        <input type="text" class="form-control" name="pengarang_ebook" placeholder="Nama Pengarang">
                                    </div>
                                    <div class="form-group">
                                        <label>Penerbit</label>
                                        <input type="text" class="form-control" name="penerbit_ebook" placeholder="Nama Penerbit">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Masukan Link Ebook</label>
                                        <input type="text" class="form-control" name="nama_file" placeholder="Masukan Link Ebook">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan Lainnya</label>
                                        <textarea class="form-control" name="isi" id="summernotehal" style="height:120px"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="pull-right">
                                <input type="hidden" name="tambah" value="tambah">
                                <button type="submit" class="btn btn-primary btn-md">Submit</button>
                        </form>
                        <a href="<?= base_url('data/ebook'); ?>" class="btn btn-danger btn-md">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>