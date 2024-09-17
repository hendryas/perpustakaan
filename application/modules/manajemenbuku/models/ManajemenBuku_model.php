<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenBuku_model extends CI_Model
{
    public function getDataBuku()
    {
        $this->db->select('a.*');
        $this->db->from('manajemen_buku a');

        $result = $this->db->get();
        return $result;
    }

    public function insertData($data)
    {
        $this->db->insert('manajemen_buku', $data);
    }

    public function editData($id, $data)
    {
        $this->db->where('id_manajemen_buku', $id);
        $this->db->update('manajemen_buku', $data);
    }

    public function deleteData($id)
    {
        $this->db->where('id_manajemen_buku', $id);
        $this->db->delete('manajemen_buku');
    }

    public function getManajemenBukuDesc()
    {
        $this->db->select('a.*');
        $this->db->from('manajemen_buku a');
        $this->db->order_by("a.id_manajemen_buku", "desc");

        $result = $this->db->get();
        return $result;
    }
}
