<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<?php
$idkatbook = $ebook->id_kategori_ebook;

$katbook = $this->M_Admin->get_tableid_edit('tbl_kategori_ebook', 'id_kategori_ebook', $idkatbook);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-book" style="color:green"> </i> <?= $title_web; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
			<li class="active"><i class="fa fa-book"></i>&nbsp; <?= $title_web; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4><?= $ebook->judul_ebook; ?></h4>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-striped table-bordered">
							<tr>
								<td>Sampul Buku</td>
								<td><?php if (!empty($ebook->sampul !== "0")) { ?>
										<a href="<?= base_url('assets_style/image/ebook/' . $ebook->sampul); ?>" target="_blank">
											<img src="<?= base_url('assets_style/image/ebook/' . $ebook->sampul); ?>" style="width:170px;height:170px;" class="img-responsive">
										</a>
									<?php } else {
										echo '<br/><p style="color:red">* Tidak ada Sampul</p>';
									} ?>
								</td>
							</tr>
							<tr>
								<td>Judul Ebook</td>
								<td><?= $ebook->judul_ebook; ?></td>
							</tr>
							<tr>
								<td>Kategori</td>
								<td><?= $katbook->nama_kategori_ebook; ?></td>
							</tr>
							<tr>
								<td>Penerbit</td>
								<td><?= $ebook->penerbit_ebook; ?></td>
							</tr>
							<tr>
								<td>Pengarang</td>
								<td><?= $ebook->pengarang_ebook; ?></td>
							</tr>
							<tr>
								<td>Link Ebook</td>
								<td><a href="<?= $ebook->nama_file; ?>" target="_blank">klik disini</a></td>
							</tr>
							<tr>
								<td>Keterangan Lainnya</td>
								<td><?= $ebook->isi; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>