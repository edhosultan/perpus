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
    $allbooks = $this->db->query("SELECT * FROM tbl_buku JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku.id_kategori JOIN tbl_rak ON tbl_rak.id_rak = tbl_buku.id_rak");
    return $allbooks->result_array();
  }
  function GET_EBOOK()
  {
    $allebooks = $this->db->query("SELECT * FROM tbl_ebook JOIN tbl_kategori_ebook ON tbl_kategori_ebook.id_kategori_ebook = tbl_ebook.id_kategori_ebook");
    return $allebooks->result_array();
  }
  function GET_PEMINJAMAN()
  {
    $allpeminjaman = $this->db->get("tbl_pinjam");
    return $allpeminjaman->result_array();
  }
  function GET_PENGEMBALIAN()
  {
    $allpengembalian = $this->db->get("tbl_pinjam");
    return $allpengembalian->result_array();
  }
  function GET_DENDA()
  {
    $alldenda = $this->db->query("SELECT * FROM tbl_denda JOIN tbl_pinjam ON tbl_pinjam.pinjam_id = tbl_denda.pinjam_id JOIN tbl_login ON tbl_login.anggota_id = tbl_pinjam.anggota_id");
    return $alldenda->result_array();
  }
  function GET_RUSAK()
  {
    $allrusak = $this->db->query("SELECT * FROM tbl_buku_rusak JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_buku_rusak.id_kategori JOIN tbl_rak ON tbl_rak.id_rak = tbl_buku_rusak.id_rak JOIN tbl_buku ON tbl_buku.id_buku = tbl_buku_rusak.id_buku");
    return $allrusak->result_array();
  }
  function GET_PESAN()
  {
    $allpesan = $this->db->get("tbl_mailbox");
    return $allpesan->result_array();
  }
  function GET_FILTER()
  {
    $allusers = $this->db->query("SELECT * FROM tbl_login WHERE year(tgl_bergabung)='2019'");
    return $allusers->result_array();
  }
}
