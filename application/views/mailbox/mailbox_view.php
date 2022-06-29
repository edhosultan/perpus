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
				<div class="box box-primary">
					<div class="box-header with-border"><?php if ($this->session->userdata('level') == 'Anggota') { ?>
							<a href="mailboxtambah"><button class="btn btn-primary">
									<i class="fa fa-plus"> </i> Pesan Buku</button></a><?php } ?>

					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<br />
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>ID Mailbox</th>
										<th>ID Anggota</th>
										<th>Nama</th>
										<th>Tanggal Transaksi</th>
										<th style="width:10%">Status</th>
										<th>
											<center>Aksi</center>
										</th>
									</tr>
								</thead>
								<?php if ($this->session->userdata('level') == 'Petugas') { ?>
									<tbody>
										<?php
										$no = 1;
										foreach ($mailbox->result_array() as $isi) {
											$anggota_id = $isi['anggota_id'];
											$ang = $this->db->query("SELECT * FROM tbl_login WHERE anggota_id = '$anggota_id'")->row();
											$mailbox_id = $isi['mailbox_id'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $isi['mailbox_id']; ?></td>
												<td><?= $isi['anggota_id']; ?></td>
												<td><?= $ang->nama; ?></td>
												<td><?= $isi['tgl_transaksi']; ?></td>
												<td>
													<center><?= $isi['status']; ?></center>
												</td>

												<?php if ($this->session->userdata('level') == 'Petugas') { ?> <?php } ?>
												<td>
													<a href="<?= base_url('transaksi/mailboxedit/' . $isi['mailbox_id']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
													<a href="<?= base_url('transaksi/detailmailbox/' . $isi['mailbox_id']); ?>">
														<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Detail</button></a>
													<a href="<?= base_url('transaksi/prosesmailbox?id_mailbox=' . $isi['id_mailbox']); ?>" onclick="return confirm('Anda yakin Pesan ini akan dihapus ?');">
														<button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>

											</tr>
										<?php $no++;
										} ?>
									</tbody>
								<?php } elseif ($this->session->userdata('level') == 'Anggota') { ?>
									<tbody>
										<?php $no = 1;
										foreach ($mailbox->result_array() as $isi) {
											$anggota_id = $isi['anggota_id'];
											$ang = $this->db->query("SELECT * FROM tbl_login WHERE anggota_id = '$anggota_id'")->row();
											$mailbox_id = $isi['mailbox_id'];
											if ($this->session->userdata('ses_id') == $ang->id_login) {
										?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $isi['mailbox_id']; ?></td>
													<td><?= $isi['anggota_id']; ?></td>
													<td><?= $ang->nama; ?></td>
													<td><?= $isi['tgl_transaksi']; ?></td>
													<td>
														<center><?= $isi['status']; ?></center>
													</td>
													<td>
														<a href="<?= base_url('transaksi/mailboxedit/' . $isi['mailbox_id']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
														<a href="<?= base_url('transaksi/detailmailbox/' . $isi['mailbox_id']); ?>">
															<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Detail</button></a>
														<a href="<?= base_url('transaksi/prosesmailbox?id_mailbox=' . $isi['id_mailbox']); ?>" onclick="return confirm('Anda yakin Pesan ini akan dihapus ?');">
															<button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
													</td>

												</tr>
										<?php $no++;
											}
										} ?>
									</tbody>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>