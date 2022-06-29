<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library(array('cart'));
		if ($this->session->userdata('masuk_sistem_rekam') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->data['title_web'] = 'Data Pinjam Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, `anggota_id`, 
		`status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali` 
		FROM tbl_pinjam ORDER BY id_pinjam DESC");

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/pinjam_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function pinjam()
	{

		$this->data['nop'] = $this->M_Admin->buat_kode('tbl_pinjam', 'PJ', 'id_pinjam', 'ORDER BY id_pinjam DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");

		$this->data['title_web'] = 'Tambah Pinjam Buku ';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function detailpinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
			`anggota_id`, `status`, 
			`tgl_pinjam`, `lama_pinjam`, 
			`tgl_balik`, `tgl_kembali` 
			FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}

		$this->data['title_web'] = 'Detail Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function kembalipinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
			`anggota_id`, `status`, 
			`tgl_pinjam`, `lama_pinjam`, 
			`tgl_balik`, `tgl_kembali` 
			FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}


		$this->data['title_web'] = 'Kembali Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/kembali', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function prosespinjam()
	{
		$post = $this->input->post();

		if (!empty($post['tambah'])) {

			$tgl = $post['tgl'];
			$tgl2 = date('Y-m-d', strtotime('+' . $post['lama'] . ' days', strtotime($tgl)));

			$hasil_cart = array_values(unserialize($this->session->userdata('cart')));
			foreach ($hasil_cart as $isi) {
				$data[] = array(
					'pinjam_id' => htmlentities($post['nopinjam']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => 'Dipinjam',
					'tgl_pinjam' => htmlentities($post['tgl']),
					'lama_pinjam' => htmlentities($post['lama']),
					'tgl_balik'  => $tgl2,
					'tgl_kembali'  => '0',
				);
			}
			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->insert_batch('tbl_pinjam', $data);

				$cart = array_values(unserialize($this->session->userdata('cart')));
				for ($i = 0; $i < count($cart); $i++) {
					unset($cart[$i]);
					$this->session->unset_userdata($cart[$i]);
					$this->session->unset_userdata('cart');
				}
			}

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}

		if ($this->input->get('pinjam_id')) {
			$this->M_Admin->delete_table('tbl_pinjam', 'pinjam_id', $this->input->get('pinjam_id'));
			$this->M_Admin->delete_table('tbl_denda', 'pinjam_id', $this->input->get('pinjam_id'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p>  Hapus Transaksi Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}

		if ($this->input->get('kembali')) {
			$id = $this->input->get('kembali');
			$pinjam = $this->db->query("SELECT  * FROM tbl_pinjam WHERE pinjam_id = '$id'");

			foreach ($pinjam->result_array() as $isi) {
				$pinjam_id = $isi['pinjam_id'];
				$denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
				$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
				if ($denda->num_rows() > 0) {
					$s = $denda->row();
					echo $s->denda;
				} else {
					$date1 = date('Ymd');
					$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
					$diff = $date2 - $date1;
					if ($diff >= 0) {
						$harga_denda = 0;
						$lama_waktu = 0;
					} else {
						$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
						$harga_denda = $jml * ($dd->harga_denda * abs($diff));
						$lama_waktu = abs($diff);
					}
				}
			}

			$data = array(
				'status' => 'Di Kembalikan',
				'tgl_kembali'  => date('Y-m-d'),
			);

			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->where('pinjam_id', $this->input->get('kembali'));
				$this->db->update('tbl_pinjam', $data);
			}

			$data_denda = array(
				'pinjam_id' => $this->input->get('kembali'),
				'denda' => $harga_denda,
				'lama_waktu' => $lama_waktu,
				'tgl_denda' => date('Y-m-d'),
			);
			$this->db->insert('tbl_denda', $data_denda);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Pengembalian Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}
	}

	//mailbox
	public function mailbox()
	{
		$this->data['title_web'] = 'Data Mailbox';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['mailbox'] = $this->db->query("SELECT DISTINCT `id_mailbox`,`mailbox_id`, `buku_id`, `anggota_id`, 
		`status`, `tgl_transaksi` FROM tbl_mailbox ORDER BY id_mailbox DESC");

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('mailbox/mailbox_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function mailboxtambah()
	{

		$this->data['nomb'] = $this->M_Admin->buat_kode('tbl_mailbox', 'MB', 'id_mailbox', 'ORDER BY id_mailbox DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['mailbox'] =  $this->db->query("SELECT * FROM tbl_mailbox ORDER BY id_mailbox DESC");
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");

		$this->data['title_web'] = 'Pesan Buku ';

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('mailbox/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function detailmailbox()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$this->data['nomb'] = $this->M_Admin->buat_kode('tbl_mailbox', 'MB', 'id_mailbox', 'ORDER BY id_mailbox DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['mailbox'] =  $this->db->query("SELECT * FROM tbl_mailbox ORDER BY id_mailbox DESC");
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");

		$this->data['title_web'] = 'Pesan Buku ';

		$this->data['title_web'] = 'Detail Mailbox Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('mailbox/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function mailboxedit()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$count = $this->M_Admin->CountTableId('tbl_mailbox', 'mailbox_id', $id);
		if ($count > 0) {
			$this->data['mailbox'] = $this->db->query("SELECT DISTINCT `mailbox_id`, 
			`buku_id`, 
			`anggota_id`, `status`, 
			`tgl_transaksi` 
			FROM tbl_mailbox WHERE mailbox_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi/mailbox') . '"</script>';
		}

		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");
		$this->data['title_web'] = 'Edit Transaksi Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('mailbox/edit_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function prosesmailbox()
	{
		$post = $this->input->post();

		if (!empty($post['tambah'])) {

			$tgl = $post['tgl_transaksi'];

			$hasil_cart = array_values(unserialize($this->session->userdata('cart')));
			foreach ($hasil_cart as $isi) {
				$data[] = array(
					'mailbox_id' => htmlentities($post['nomb']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => 'Dipesan',
					'tgl_transaksi' => htmlentities($post['tgl_transaksi'])
				);
			}
			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->insert_batch('tbl_mailbox', $data);

				$cart = array_values(unserialize($this->session->userdata('cart')));
				for ($i = 0; $i < count($cart); $i++) {
					unset($cart[$i]);
					$this->session->unset_userdata($cart[$i]);
					$this->session->unset_userdata('cart');
				}
			}

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Pesan Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/mailbox'));
		}

		if ($this->input->get('id_mailbox')) {
			$this->M_Admin->delete_table('tbl_mailbox', 'id_mailbox', $this->input->get('id_mailbox'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p>  Hapus Transaksi Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/mailbox'));
		}

		if (!empty($this->input->post('edit_view'))) {
			$post = $this->input->post();
			// setting konfigurasi upload
			$config['upload_path'] = './assets_style/image/buku/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
			// load library upload
			$this->load->library('upload', $config);
			// upload gambar 1
			if (!empty($_FILES['sampul']['name'] || $_FILES['lampiran']['name'])) {

				$this->upload->initialize($config);

				if ($this->upload->do_upload('sampul')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} /*else {
					return false;
				}*/

				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$file2 = array('upload_data' => $this->upload->data());
				} /*else {
					return false;
				}*/

				$sampul = './assets_style/image/buku/' . htmlentities($post['sampul']);
				if (file_exists($sampul)) {
					unlink($sampul);
				}



				$data = array(
					'mailbox_id' => htmlentities($post['nomb']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => 'Dipesan',
					'tgl_transaksi' => htmlentities($post['tgl_transaksi'])
				);
			} elseif (!empty($_FILES['sampul']['name'])) {
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sampul')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}


				$gambar = './assets_style/image/buku/' . htmlentities($post['gmbr']);
				if (file_exists($gambar)) {
					unlink($gambar);
				}

				$data = array(
					'mailbox_id' => htmlentities($post['nomb']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => 'Dipesan',
					'tgl_transaksi' => htmlentities($post['tgl_transaksi'])
				);
			} elseif (!empty($_FILES['lampiran']['name'])) {

				$this->upload->initialize($config);

				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$file2 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}

				$lampiran = './assets_style/image/buku/' . htmlentities($post['lamp']);
				if (file_exists($lampiran)) {
					unlink($lampiran);
				}

				// script uplaod file kedua
				$this->upload->do_upload('lampiran');
				$file2 = array('upload_data' => $this->upload->data());

				$data = array(
					'mailbox_id' => htmlentities($post['nomb']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => 'Dipesan',
					'tgl_transaksi' => htmlentities($post['tgl_transaksi'])
				);
			} else {
				$data = array(
					'mailbox_id' => htmlentities($post['nomb']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $isi['id'],
					'status' => 'Dipesan',
					'tgl_transaksi' => htmlentities($post['tgl_transaksi'])
				);
			}
			$this->db->where('id_mailbox', htmlentities($post['edit_view']));
			$this->db->update('tbl_mailbox', $data);
			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Pesan Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/mailbox'));
		}
	}





	//denda
	public function denda()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['denda'] =  $this->db->query("SELECT * FROM tbl_biaya_denda ORDER BY id_biaya_denda DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_biaya_denda', 'id_biaya_denda', $id);
			if ($count > 0) {
				$this->data['den'] = $this->db->query("SELECT *FROM tbl_biaya_denda WHERE id_biaya_denda='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('transaksi/denda') . '"</script>';
			}
		}

		$this->data['title_web'] = ' Denda ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('denda/denda_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function dendaproses()
	{
		if (!empty($this->input->post('tambah'))) {
			$post = htmlentities($this->input->post());
			$data = array(
				'harga_denda' => htmlentities($post['harga']),
				'stat' => 'Tidak Aktif',
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->insert('tbl_biaya_denda', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah  Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}

		if (!empty($this->input->post('edit'))) {
			$dd = $this->M_Admin->get_tableid('tbl_biaya_denda', 'stat', 'Aktif');
			foreach ($dd as $isi) {
				$data1 = array(
					'stat' => 'Tidak Aktif',
				);
				$this->db->where('id_biaya_denda', $isi['id_biaya_denda']);
				$this->db->update('tbl_biaya_denda', $data1);
			}

			$post = $this->input->post();
			$data = array(
				'harga_denda' => htmlentities($post['harga']),
				'stat' => $post['status'],
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->where('id_biaya_denda', $post['edit']);
			$this->db->update('tbl_biaya_denda', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}

		if (!empty($this->input->get('denda_id'))) {
			$this->db->where('id_biaya_denda', $this->input->get('denda_id'));
			$this->db->delete('tbl_biaya_denda');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Harga Denda Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}
	}


	public function result()
	{

		$user = $this->M_Admin->get_tableid_edit('tbl_login', 'anggota_id', $this->input->post('kode_anggota'));
		error_reporting(0);
		if ($user->nama != null) {
			echo '<table class="table table-striped">
						<tr>
							<td>Nama Anggota</td>
							<td>:</td>
							<td>' . $user->nama . '</td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td>:</td>
							<td>' . $user->telepon . '</td>
						</tr>
						<tr>
							<td>E-mail</td>
							<td>:</td>
							<td>' . $user->email . '</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td>' . $user->alamat . '</td>
						</tr>
						<tr>
							<td>Level</td>
							<td>:</td>
							<td>' . $user->level . '</td>
						</tr>
					</table>';
		} else {
			echo 'Anggota Tidak Ditemukan !';
		}
	}

	public function buku()
	{
		$id = $this->input->post('kode_buku');
		$row = $this->db->query("SELECT * FROM tbl_buku WHERE buku_id ='$id'");

		if ($row->num_rows() > 0) {
			$tes = $row->row();
			$item = array(
				'id'      => $id,
				'qty'     => 1,
				'price'   => '1000',
				'name'    => $tes->title,
				'options' => array('isbn' => $tes->isbn, 'thn' => $tes->thn_buku, 'penerbit' => $tes->penerbit)
			);
			if (!$this->session->has_userdata('cart')) {
				$cart = array($item);
				$this->session->set_userdata('cart', serialize($cart));
			} else {
				$index = $this->exists($id);
				$cart = array_values(unserialize($this->session->userdata('cart')));
				if ($index == -1) {
					array_push($cart, $item);
					$this->session->set_userdata('cart', serialize($cart));
				} else {
					$cart[$index]['quantity']++;
					$this->session->set_userdata('cart', serialize($cart));
				}
			}
		} else {
		}
	}

	public function buku_list()
	{
?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Title</th>
					<th>Penerbit</th>
					<th>Tahun</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $items['name']; ?></td>
						<td><?= $items['options']['penerbit']; ?></td>
						<td><?= $items['options']['thn']; ?></td>
						<td style="width:17%">
							<a href="javascript:void(0)" id="delete_buku<?= $no; ?>" data_<?= $no; ?>="<?= $items['id']; ?>" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<script>
						$(document).ready(function() {
							$("#delete_buku<?= $no; ?>").click(function(e) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url('transaksi/del_cart'); ?>",
									data: 'kode_buku=' + $(this).attr("data_<?= $no; ?>"),
									beforeSend: function() {},
									success: function(html) {
										$("#tampil").html(html);
									}
								});
							});
						});
					</script>
				<?php $no++;
				} ?>
			</tbody>
		</table>
		<?php foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
			<input type="hidden" value="<?= $items['id']; ?>" name="idbuku[]">
		<?php } ?>
		<div id="tampil"></div>
<?php
	}

	public function del_cart()
	{
		error_reporting(0);
		$id = $this->input->post('buku_id');
		$index = $this->exists($id);
		$cart = array_values(unserialize($this->session->userdata('cart')));
		unset($cart[$index]);
		$this->session->set_userdata('cart', serialize($cart));
		// redirect('jual/tambah');
		echo '<script>$("#result_buku").load("' . base_url('transaksi/buku_list') . '");</script>';
	}

	private function exists($id)
	{
		$cart = array_values(unserialize($this->session->userdata('cart')));
		for ($i = 0; $i < count($cart); $i++) {
			if ($cart[$i]['buku_id'] == $id) {
				return $i;
			}
		}
		return -1;
	}
}
