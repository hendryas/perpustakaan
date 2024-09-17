<?php
class MasterCustomer_model extends CI_Model
{
  public function getDataCustomer()
  {
    $this->db->select('a.*');
    $this->db->where('a.delete_sts', 0);
    $this->db->from('customer a');

    $result = $this->db->get();
    return $result;
  }
}
