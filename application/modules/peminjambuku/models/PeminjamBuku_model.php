<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PeminjamBuku_model extends CI_Model
{
  public function getHistoryPeminjamBuku()
  {
    $this->db->select('a.*,b.judul,b.image,b.penulis');
    $this->db->from('peminjam_buku a');
    $this->db->join('manajemen_buku b', 'b.id_manajemen_buku = a.id_manajemen_buku', 'left');

    $query = $this->db->get();
    return $query;
  }

  public function getDataBukuByID($id)
  {
    $this->db->select('a.*');
    $this->db->from('manajemen_buku a');
    $this->db->where('a.id_manajemen_buku', $id);

    $query = $this->db->get();
    return $query;
  }
}
