<?php if (!defined('BASEPATH')) exit('No direct script acess allowed');
class M_Statis extends ci_model
{


  function data()
  {
    $this->db->order_by('id_pinjam', 'DESC');
    return $query = $this->db->get('tbl_pinjam');
  }

  public function detail_join($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_pinjam as p');
    $this->db->join('tbl_login as a', 'a.anggota_id = p.anggota_id');

    $this->db->where('p.id_pinjam', $where);
    return $query = $this->db->get();


    return $this->db->get();
  }

  public function dataJoin()
  {
    $this->db->select('*');
    $this->db->from('tbl_pinjam as p');
    $this->db->join('tbl_login as a', 'a.anggota_id = p.anggota_id');

    $this->db->order_by('p.id_pinjam', 'DESC');
    return $query = $this->db->get();
  }

  public function top3buku()
  {
    $top3buku = $this->db->query("SELECT COUNT(b.buku_id) as total FROM tbl_pinjam as p JOIN tbl_buku as b ON b.buku_id = p.buku_id GROUP BY p.buku_id LIMIT 3");
    return $top3buku->result_array();
    return $query = $this->db->get();
  }

  public function top3anggota()
  {
    $top3anggota = $this->db->query("SELECT COUNT(a.anggota_id) as total FROM tbl_pinjam as p JOIN tbl_login as a ON a.anggota_id = p.anggota_id GROUP BY p.anggota_id LIMIT 3");
    return $top3anggota->result_array();
    return $query = $this->db->get();
  }
}
