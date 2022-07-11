<?php
if (!defined('BASEPATH')) exit('No direct script acess allowed');

class M_Login extends CI_Model
{

  function GET_LOGIN($user, $pass)
  {
    $row = $this->db->query("SELECT * FROM tbl_login WHERE user ='$user' AND pass = '$pass'");
    return $row;
  }

  function insertTable($table_name, $data)
  {
    $tambah = $this->db->insert($table_name, $data);
    return $tambah;
  }
  function GET_ALL()
  {
    $allusers = $this->db->get("tbl_login");
    return $allusers->result_array();
  }
  function GET_BOOK()
  {
    $allbooks = $this->db->query("SELECT buku_id,nama_kategori,nama_rak,isbn,title,penerbit,pengarang,thn_buku,tgl_masuk,jml,SUM(tbl_buku.jml)as jumlah FROM tbl_buku JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori JOIN tbl_rak ON tbl_rak.id_rak = tbl_buku.id_rak GROUP BY tbl_buku.buku_id");
    return $allbooks->result_array();
  }
  function GET_EBOOK()
  {
    $allebooks = $this->db->query("SELECT tbl_ebook.id_ebook,ebook_id,tbl_ebook.id_kategori_ebook,nama_kategori_ebook,judul_ebook,pengarang_ebook,penerbit_ebook,tgl_masuk,COUNT(*) as jumlah FROM tbl_ebook JOIN tbl_kategori_ebook ON tbl_kategori_ebook.id_kategori_ebook = tbl_ebook.id_kategori_ebook GROUP BY tbl_ebook.ebook_id");
    return $allebooks->result_array();
  }
  function GET_PEMINJAMAN()
  {
    $allpeminjaman = $this->db->query("SELECT tbl_pinjam.pinjam_id,id_pinjam,buku_id,tbl_login.anggota_id,tgl_pinjam,lama_pinjam,COUNT(*) as jumlah FROM tbl_pinjam JOIN tbl_login ON tbl_login.anggota_id=tbl_pinjam.anggota_id GROUP BY tbl_pinjam.anggota_id");
    return $allpeminjaman->result_array();
  }
  function GET_PENGEMBALIAN()
  {
    $allpengembalian = $this->db->query("SELECT tbl_pinjam.pinjam_id,id_pinjam,buku_id,tbl_login.anggota_id,tgl_balik,tgl_kembali,COUNT(*) as jumlah FROM tbl_pinjam JOIN tbl_login ON tbl_login.anggota_id=tbl_pinjam.anggota_id GROUP BY tbl_pinjam.anggota_id");
    return $allpengembalian->result_array();
  }
  function GET_DENDA()
  {
    $alldenda = $this->db->query("SELECT id_denda,tbl_denda.pinjam_id,nama,denda,lama_waktu,tgl_denda,SUM(tbl_denda.denda) as jumlah FROM tbl_denda JOIN tbl_pinjam ON tbl_pinjam.pinjam_id = tbl_denda.pinjam_id JOIN tbl_login ON tbl_login.anggota_id = tbl_pinjam.anggota_id GROUP BY tbl_denda.pinjam_id");
    return $alldenda->result_array();
  }
  function GET_RUSAK()
  {
    $allrusak = $this->db->query("SELECT * FROM tbl_buku_rusak JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku_rusak.id_kategori JOIN tbl_rak ON tbl_rak.id_rak = tbl_buku_rusak.id_rak JOIN tbl_buku ON tbl_buku.id_buku = tbl_buku_rusak.id_buku");
    return $allrusak->result_array();
  }
  function GET_PESAN()
  {
    $allpesan = $this->db->query("SELECT tbl_mailbox.mailbox_id,id_mailbox,buku_id,tbl_login.anggota_id,tgl_transaksi,COUNT(*) as jumlah FROM tbl_mailbox JOIN tbl_login ON tbl_login.anggota_id=tbl_mailbox.anggota_id GROUP BY tbl_mailbox.anggota_id");
    return $allpesan->result_array();
  }
  function GET_FILTER()
  {
    $allusers = $this->db->query("SELECT * FROM tbl_login WHERE year(tgl_bergabung)='2019'");
    return $allusers->result_array();
  }
  function GET_TOP10()
  {
    $allusers = $this->db->query("SELECT tbl_login.anggota_id,nama,alamat,telepon,COUNT(*) as jumlah FROM tbl_kunjungan JOIN tbl_login ON tbl_login.anggota_id=tbl_kunjungan.anggota_id GROUP BY tbl_login.anggota_id");
    return $allusers->result_array();
  }
  function GET_TOPBUKU10()
  {
    $allusers = $this->db->query("SELECT tbl_buku.buku_id,title,pengarang,penerbit,COUNT(*) as jumlah FROM tbl_pinjam JOIN tbl_buku ON tbl_buku.buku_id=tbl_pinjam.buku_id GROUP BY tbl_buku.buku_id");
    return $allusers->result_array();
  }
  function SET_KUNJUNGAN($anggota_id)
  {
    $tambah = $this->db->insert('tbl_kunjungan', [
      'anggota_id' => $anggota_id,
      'tanggal' => date('Y-m-d H:i:s')
    ]);
    return $tambah;
  }
}
