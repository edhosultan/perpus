<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		if ($this->session->userdata('masuk_sistem_rekam') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
	}

	public function index()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");
		$this->data['title_web'] = 'Data Buku';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/buku_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukudetail()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku', 'id_buku', $this->uri->segment('3'));
		if ($count > 0) {
			$this->data['buku'] = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', $this->uri->segment('3'));
			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('data') . '"</script>';
		}

		$this->data['title_web'] = 'Data Buku Detail';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukuedit()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku', 'id_buku', $this->uri->segment('3'));
		if ($count > 0) {

			$this->data['buku'] = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', $this->uri->segment('3'));

			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('data') . '"</script>';
		}

		$this->data['title_web'] = 'Data Buku Edit';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/edit_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukutambah()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();


		$this->data['title_web'] = 'Tambah Buku';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}


	public function prosesbuku()
	{
		if (!empty($this->input->get('buku_id'))) {

			$buku = $this->M_Admin->get_tableid_edit('tbl_buku', 'id_buku', htmlentities($this->input->get('buku_id')));

			$sampul = './assets_style/image/buku/' . $buku->sampul;
			if (file_exists($sampul)) {
				unlink($sampul);
			}

			$this->M_Admin->delete_table('tbl_buku', 'id_buku', $this->input->get('buku_id'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Berhasil Hapus Buku !</p>
			</div></div>');
			redirect(base_url('data'));
		}
		if (!empty($this->input->post('tambah'))) {

			$post = $this->input->post();
			// setting konfigurasi upload
			$config['upload_path'] = './assets_style/image/buku/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc';
			$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
			// load library upload
			$this->load->library('upload', $config);
			$buku_id = $this->M_Admin->buat_kode('tbl_buku', 'BK', 'id_buku', 'ORDER BY id_buku DESC LIMIT 1');

			// upload gambar 1
			if (!empty($_FILES['gambar']['name'] && $_FILES['lampiran']['name'])) {

				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}

				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$file2 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				$data = array(
					'buku_id' => $buku_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'sampul' => $file1['upload_data']['file_name'],
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} elseif (!empty($_FILES['gambar']['name'])) {
				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				$data = array(
					'buku_id' => $buku_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'sampul' => $file1['upload_data']['file_name'],
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
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

				// script uplaod file kedua
				$this->upload->do_upload('lampiran');
				$file2 = array('upload_data' => $this->upload->data());
				$data = array(
					'buku_id' => $buku_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'sampul' => '0',
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'buku_id' => $buku_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'sampul' => '0',
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			}

			$this->db->insert('tbl_buku', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data'));
		}

		if (!empty($this->input->post('edit'))) {
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
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'sampul' => $file1['upload_data']['file_name'],
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
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
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'sampul' => $file1['upload_data']['file_name'],
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
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

				// script uplaod file kedua
				$this->upload->do_upload('lampiran');
				$file2 = array('upload_data' => $this->upload->data());

				$data = array(
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			}

			$this->db->where('id_buku', htmlentities($post['edit']));
			$this->db->update('tbl_buku', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data'));
		}
	}

	public function kategori()
	{

		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['kategori'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_kategori', 'id_kategori', $id);
			if ($count > 0) {
				$this->data['kat'] = $this->db->query("SELECT *FROM tbl_kategori WHERE id_kategori='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('data/kategori') . '"</script>';
			}
		}

		$this->data['title_web'] = 'Data Kategori ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('kategori/kat_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function katproses()
	{
		if (!empty($this->input->post('tambah'))) {
			$post = $this->input->post();
			$data = array(
				'nama_kategori' => htmlentities($post['kategori']),
			);

			$this->db->insert('tbl_kategori', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori'));
		}

		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'nama_kategori' => htmlentities($post['kategori']),
			);
			$this->db->where('id_kategori', htmlentities($post['edit']));
			$this->db->update('tbl_kategori', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori'));
		}

		if (!empty($this->input->get('kat_id'))) {
			$this->db->where('id_kategori', $this->input->get('kat_id'));
			$this->db->delete('tbl_kategori');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori'));
		}
	}

	public function rak()
	{

		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_rak', 'id_rak', $id);
			if ($count > 0) {
				$this->data['rak'] = $this->db->query("SELECT *FROM tbl_rak WHERE id_rak='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('data/rak') . '"</script>';
			}
		}

		$this->data['title_web'] = 'Data Rak Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('rak/rak_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function rakproses()
	{
		if (!empty($this->input->post('tambah'))) {
			$post = $this->input->post();
			$data = array(
				'nama_rak' => htmlentities($post['rak']),
			);

			$this->db->insert('tbl_rak', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Rak Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak'));
		}

		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'nama_rak' => htmlentities($post['rak']),
			);
			$this->db->where('id_rak', htmlentities($post['edit']));
			$this->db->update('tbl_rak', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Rak Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak'));
		}

		if (!empty($this->input->get('rak_id'))) {
			$this->db->where('id_rak', $this->input->get('rak_id'));
			$this->db->delete('tbl_rak');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Rak Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/rak'));
		}
	}















	//buku rusak
	public function buku_rusak()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['bukurusak'] =  $this->db->query("SELECT * FROM tbl_buku_rusak ORDER BY id_buku_rusak DESC");
		$this->data['title_web'] = 'Data Buku Rusak';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku_rusak/bukurusak_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function bukurusakdetail()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku_rusak', 'id_buku_rusak', $this->uri->segment('3'));
		if ($count > 0) {
			$this->data['bukurusak'] = $this->M_Admin->get_tableid_edit('tbl_buku_rusak', 'id_buku_rusak', $this->uri->segment('3'));
			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
		} else {
			echo '<script>alert("BUKU RUSAK TIDAK DITEMUKAN");window.location="' . base_url('data/buku_rusak') . '"</script>';
		}

		$this->data['title_web'] = 'Data Buku Rusak Detail';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku_rusak/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukurusakedit()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_buku_rusak', 'id_buku_rusak', $this->uri->segment('3'));
		if ($count > 0) {

			$this->data['bukurusak'] = $this->M_Admin->get_tableid_edit('tbl_buku_rusak', 'id_buku_rusak', $this->uri->segment('3'));

			$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
			$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku ASC")->result_array();
		} else {
			echo '<script>alert("BUKU RUSAK TIDAK DITEMUKAN");window.location="' . base_url('data/buku_rusak') . '"</script>';
		}

		$this->data['title_web'] = 'Data Buku Rusak Edit';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku_rusak/edit_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function bukurusaktambah()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
		$this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();
		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku ASC")->result_array();


		$this->data['title_web'] = 'Tambah Buku Rusak';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku_rusak/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}


	public function prosesbukurusak()
	{
		if (!empty($this->input->get('buku_rusak_id'))) {

			$bukurusak = $this->M_Admin->get_tableid_edit('tbl_buku_rusak', 'id_buku_rusak', htmlentities($this->input->get('buku_rusak_id')));
			$this->M_Admin->delete_table('tbl_buku_rusak', 'id_buku_rusak', $this->input->get('buku_rusak_id'));
			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Berhasil Hapus Buku !</p>
			</div></div>');
			redirect(base_url('data/buku_rusak'));
		}
		if (!empty($this->input->post('tambah'))) {

			$post = $this->input->post();
			// setting konfigurasi upload
			$config['upload_path'] = './assets_style/image/buku/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc';
			$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
			// load library upload
			$this->load->library('upload', $config);
			$buku_rusak_id = $this->M_Admin->buat_kode('tbl_buku_rusak', 'BKR', 'id_buku_rusak', 'ORDER BY id_buku_rusak DESC LIMIT 1');

			// upload gambar 1
			if (!empty($_FILES['gambar']['name'] && $_FILES['lampiran']['name'])) {

				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}

				// script uplaod file kedua
				if ($this->upload->do_upload('lampiran')) {
					$this->upload->data();
					$file2 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				$data = array(
					'buku_rusak_id' => $buku_rusak_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} elseif (!empty($_FILES['gambar']['name'])) {
				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				$data = array(
					'buku_rusak_id' => $buku_rusak_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
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

				// script uplaod file kedua
				$this->upload->do_upload('lampiran');
				$file2 = array('upload_data' => $this->upload->data());
				$data = array(
					'buku_rusak_id' => $buku_rusak_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'buku_rusak_id' => $buku_rusak_id,
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			}

			$this->db->insert('tbl_buku_rusak', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/buku_rusak'));
		}

		if (!empty($this->input->post('edit'))) {
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
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
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
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
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
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'id_kategori' => htmlentities($post['kategori']),
					'id_rak' => htmlentities($post['rak']),
					'id_buku' => htmlentities($post['buku']),
					'isbn' => htmlentities($post['isbn']),
					'title'  => htmlentities($post['title']),
					'pengarang' => htmlentities($post['pengarang']),
					'penerbit' => htmlentities($post['penerbit']),
					'thn_buku' => htmlentities($post['thn']),
					'isi' => $this->input->post('ket'),
					'jml_rusak' => htmlentities($post['jml']),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			}

			$this->db->where('id_buku_rusak', htmlentities($post['edit']));
			$this->db->update('tbl_buku_rusak', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Buku Rusak Sukses !</p>
			</div></div>');
			redirect(base_url('data/buku_rusak'));
		}
	}








	//ebook
	public function ebook()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['ebook'] =  $this->db->query("SELECT * FROM tbl_ebook ORDER BY id_ebook DESC");
		$this->data['title_web'] = 'Data Ebook';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('ebook/ebook_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function ebookdetail()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_ebook', 'id_ebook', $this->uri->segment('3'));
		if ($count > 0) {
			$this->data['ebook'] = $this->M_Admin->get_tableid_edit('tbl_ebook', 'id_ebook', $this->uri->segment('3'));
			$this->data['katsbook'] =  $this->db->query("SELECT * FROM tbl_kategori_ebook ORDER BY id_kategori_ebook DESC")->result_array();
		} else {
			echo '<script>alert("EBOOK TIDAK DITEMUKAN");window.location="' . base_url('data/ebook') . '"</script>';
		}

		$this->data['title_web'] = 'Data Ebook Detail';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('ebook/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function ebookedit()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_ebook', 'id_ebook', $this->uri->segment('3'));
		if ($count > 0) {

			$this->data['ebook'] = $this->M_Admin->get_tableid_edit('tbl_ebook', 'id_ebook', $this->uri->segment('3'));

			$this->data['katsbook'] =  $this->db->query("SELECT * FROM tbl_kategori_ebook ORDER BY id_kategori_ebook DESC")->result_array();
		} else {
			echo '<script>alert("BUKU TIDAK DITEMUKAN");window.location="' . base_url('data/ebook') . '"</script>';
		}

		$this->data['title_web'] = 'Data Ebook Edit';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('ebook/edit_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function ebooktambah()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['katsbook'] = $this->db->query("SELECT * FROM tbl_kategori_ebook ORDER BY id_kategori_ebook DESC")->result_array();


		$this->data['title_web'] = 'Tambah Ebook';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('ebook/tambah_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function hapusebook($id_ebook)
	{
		$this->M_Admin->delete_table('tbl_ebook', 'id_ebook', $id_ebook);

		$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Berhasil Hapus Ebook !</p>
			</div></div>');
		redirect(base_url('data/ebook'));
	}

	public function prosesebook()
	{
		if (!empty($this->input->get('ebook_id'))) {

			$ebook = $this->M_Admin->get_tableid_edit('tbl_ebook', 'id_ebook', htmlentities($this->input->get('ebook_id')));

			$sampul = './assets_style/image/ebook/' . $ebook->sampul;
			if (file_exists($sampul)) {
				unlink($sampul);
			}


			$this->M_Admin->delete_table('tbl_ebook', 'id_ebook', $this->input->get('ebook_id'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Berhasil Hapus Ebook !</p>
			</div></div>');
			redirect(base_url('data/ebook'));
		}
		if (!empty($this->input->post('tambah'))) {

			$post = $this->input->post();
			// setting konfigurasi upload
			$config['upload_path'] = './assets_style/image/ebook/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc';
			$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
			// load library upload
			$this->load->library('upload', $config);
			$ebook_id = $this->M_Admin->buat_kode('tbl_ebook', 'EB', 'id_ebook', 'ORDER BY id_ebook DESC LIMIT 1');

			// upload gambar 1
			if (!empty($_FILES['gambar']['name'])) {

				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}

				$data = array(
					'ebook_id' => $ebook_id,
					'id_kategori_ebook' => htmlentities($post['kategori_ebook']),
					'sampul' => $file1['upload_data']['file_name'],
					'judul_ebook'  => htmlentities($post['judul_ebook']),
					'pengarang_ebook' => htmlentities($post['pengarang_ebook']),
					'penerbit_ebook' => htmlentities($post['penerbit_ebook']),
					'isi' => $this->input->post('isi'),
					'nama_file' => $this->input->post('nama_file'),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} elseif (!empty($_FILES['gambar']['name'])) {
				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				$data = array(
					'ebook_id' => $ebook_id,
					'id_kategori_ebook' => htmlentities($post['kategori_ebook']),
					'sampul' => $file1['upload_data']['file_name'],
					'judul_ebook'  => htmlentities($post['judul_ebook']),
					'pengarang_ebook' => htmlentities($post['pengarang_ebook']),
					'penerbit_ebook' => htmlentities($post['penerbit_ebook']),
					'isi' => $this->input->post('isi'),
					'nama_file' => $this->input->post('nama_file'),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} elseif (!empty($_FILES['lampiran']['name'])) {


				$file2 = array('upload_data' => $this->upload->data());
				$data = array(
					'ebook_id' => $ebook_id,
					'id_kategori_ebook' => htmlentities($post['kategori_ebook']),
					'sampul' => '0',
					'judul_ebook'  => htmlentities($post['judul_ebook']),
					'pengarang_ebook' => htmlentities($post['pengarang_ebook']),
					'penerbit_ebook' => htmlentities($post['penerbit_ebook']),
					'isi' => $this->input->post('isi'),
					'nama_file' => $this->input->post('nama_file'),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			} else {
				$data = array(
					'ebook_id' => $ebook_id,
					'id_kategori_ebook' => htmlentities($post['kategori_ebook']),
					'sampul' => '0',
					'judul_ebook'  => htmlentities($post['judul_ebook']),
					'pengarang_ebook' => htmlentities($post['pengarang_ebook']),
					'penerbit_ebook' => htmlentities($post['penerbit_ebook']),
					'isi' => $this->input->post('isi'),
					'nama_file' => $this->input->post('nama_file'),
					'tgl_masuk' => date('Y-m-d H:i:s')

				);
			}

			$this->db->insert('tbl_ebook', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Ebook Sukses !</p>
			</div></div>');
			redirect(base_url('data/ebook'));
		}

		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			// setting konfigurasi upload
			$config['upload_path'] = './assets_style/image/buku/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
			// load library upload
			$this->load->library('upload', $config);
			// upload gambar 1
			if (!empty($_FILES['gambar']['name'])) {

				$this->upload->initialize($config);

				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				$gambar = './assets_style/image/ebook/' . htmlentities($post['gmbr']);
				if (file_exists($gambar)) {
					unlink($gambar);
				}



				$data = array(
					'id_kategori_ebook' => htmlentities($post['kategori_ebook']),
					'judul_ebook'  => htmlentities($post['judul_ebook']),
					'pengarang_ebook' => htmlentities($post['pengarang_ebook']),
					'penerbit_ebook' => htmlentities($post['penerbit_ebook']),
					'isi' => $this->input->post('isi'),
					'nama_file' => $this->input->post('nama_file'),
					'tgl_masuk' => date('Y-m-d H:i:s')

				);
			} else {
				$data = array(
					'id_kategori_ebook' => htmlentities($post['kategori_ebook']),
					'judul_ebook'  => htmlentities($post['judul_ebook']),
					'pengarang_ebook' => htmlentities($post['pengarang_ebook']),
					'penerbit_ebook' => htmlentities($post['penerbit_ebook']),
					'isi' => $this->input->post('isi'),
					'nama_file' => $this->input->post('nama_file'),
					'tgl_masuk' => date('Y-m-d H:i:s')
				);
			}

			$this->db->where('id_ebook', htmlentities($post['edit']));
			$this->db->update('tbl_ebook', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Ebook Sukses !</p>
			</div></div>');
			redirect(base_url('data/ebook'));
		}
	}

	public function kategori_ebook()
	{

		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['kategori_ebook'] =  $this->db->query("SELECT * FROM tbl_kategori_ebook ORDER BY id_kategori_ebook DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_kategori_ebook', 'id_kategori_ebook', $id);
			if ($count > 0) {
				$this->data['katbook'] = $this->db->query("SELECT *FROM tbl_kategori_ebook WHERE id_kategori_ebook='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('data/kategori_ebook') . '"</script>';
			}
		}

		$this->data['title_web'] = 'Data Kategori Ebook ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('kategori_ebook/katbook_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function katprosesbook()
	{
		if (!empty($this->input->post('tambah'))) {
			$post = $this->input->post();
			$data = array(
				'nama_kategori_ebook' => htmlentities($post['kategori_ebook']),
			);

			$this->db->insert('tbl_kategori_ebook', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah Kategori Ebook Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori_ebook'));
		}

		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(
				'nama_kategori_ebook' => htmlentities($post['kategori_ebook']),
			);
			$this->db->where('id_kategori_ebook', htmlentities($post['edit']));
			$this->db->update('tbl_kategori_ebook', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Kategori Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori_ebook'));
		}

		if (!empty($this->input->get('katbook_id'))) {
			$this->db->where('id_kategori_ebook', $this->input->get('katbook_id'));
			$this->db->delete('tbl_kategori_ebook');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Kategori Ebook Sukses !</p>
			</div></div>');
			redirect(base_url('data/kategori_ebook'));
		}
	}




	//mailbox
	public function mailbox()
	{
		$this->data['title_web'] = 'Data Mailbox';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['mailbox'] = $this->db->query("SELECT DISTINCT `id_mailbox`,`mailbox_id`, `buku_id`, `anggota_id`, 
		`status`, `tgl_transaksi` FROM tbl_mailbox ORDER BY id_mailbox DESC");

		$this->data['user'] = $this->M_Admin->get_table('tbl_login');

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

	public function mailboxdetail()
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
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('data/mailbox') . '"</script>';
		}

		$this->data['buku'] =  $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");

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
		$this->data['buku'] = $this->db->query("SELECT * FROM tbl_buku ORDER BY id_buku DESC");
		$count = $this->M_Admin->CountTableId('tbl_mailbox', 'mailbox_id', $id);
		if ($count > 0) {
			$this->data['mailbox'] = $this->db->query("SELECT DISTINCT `mailbox_id`, 
			`buku_id`, 
			`anggota_id`, `status`, 
			`tgl_transaksi` 
			FROM tbl_mailbox WHERE mailbox_id = '$id'")->row();
		} else {
			echo '<script>alert("EDIT TIDAK DITEMUKAN");window.location="' . base_url('data/mailbox') . '"</script>';
		}
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
					'status' => htmlentities($post['status']),
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
			<p> Pesan Buku Sukses Silahkan Datang Ke Perpus Yah!</p>
			</div></div>');
			redirect(base_url('data/mailbox'));
		}

		if ($this->input->get('id_mailbox')) {
			$this->M_Admin->delete_table('tbl_mailbox', 'id_mailbox', $this->input->get('id_mailbox'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p>  Hapus Transaksi Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('data/mailbox'));
		}

		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();

			// upload gambar 1
			if (!empty($_FILES['gambar']['name'])) {
				if ($this->upload->do_upload('gambar')) {
					$this->upload->data();
					$file1 = array('upload_data' => $this->upload->data());
				} else {
					return false;
				}
				if ($this->upload->data()) {
				}
				$data = array(
					'status' => htmlentities($post['status'])

				);
			} else {
				$data = array(
					'status' => htmlentities($post['status'])
				);
			};
			$this->db->where('mailbox_id', htmlentities($post['mailbox_id']));
			$this->db->update('tbl_mailbox', $data);
			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
		<p> Edit Pesan Buku Sukses !</p>
		</div></div>');
			redirect(base_url('data/mailbox'));
		}
	}
}
