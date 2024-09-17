<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
  public function insertData($data)
  {
    $this->db->insert('peminjam_buku', $data);
  }

  public function getDataBukuID($id)
  {
    $this->db->select('a.*');
    $this->db->from('manajemen_buku a');
    $this->db->where('a.id_manajemen_buku', $id);

    $result = $this->db->get();
    return $result;
  }
}
