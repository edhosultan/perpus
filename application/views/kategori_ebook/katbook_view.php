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
			echo $this->session->flashdata('pesan');
		} ?>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-4">
						<div class="box box-primary">
							<div class="box-header with-border">
								<?php if (!empty($this->input->get('id'))) { ?>
									<h4> Edit Kategori Ebook</h4>
								<?php } else { ?>
									<h4> Tambah Kategori Ebook</h4>
								<?php } ?>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<?php if (!empty($this->input->get('id'))) { ?>
									<form method="post" action="<?= base_url('data/katprosesbook'); ?>">
										<div class="form-group">
											<label for="">Nama Kategori Ebook</label>
											<input type="text" name="kategori_ebook" value="<?= $katbook->nama_kategori_ebook; ?>" id="kategori_ebook" class="form-control" placeholder="Contoh : Pemrograman Web">

										</div>
										<br />
										<input type="hidden" name="edit" value="<?= $katbook->id_kategori_ebook; ?>">
										<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Kategori Ebook</button>
									</form>
								<?php } else { ?>

									<form method="post" action="<?= base_url('data/katprosesbook'); ?>">
										<div class="form-group">
											<label for="">Nama Kategori Ebook</label>
											<input type="text" name="kategori_ebook" id="kategori" class="form-control" placeholder="Contoh : Pemrograman Web">

										</div>
										<br />
										<input type="hidden" name="tambah" value="tambah">
										<button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Kategori Ebook</button>
									</form>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="box box-primary">
							<div class="box-header with-border">
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped table" width="100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Kategori Ebook</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($kategori_ebook->result_array() as $book) { ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $book['nama_kategori_ebook']; ?></td>
													<td style="width:20%;">
														<a href="<?= base_url('data/kategori?id=' . $book['id_kategori_ebook']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
														<a href="<?= base_url('data/katprosesbook?kat_id=' . $book['id_kategori_ebook']); ?>" onclick="return confirm('Anda yakin Kategori ebook ini akan dihapus ?');">
															<button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
													</td>
												</tr>
											<?php $no++;
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>