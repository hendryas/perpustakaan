<?php
class Auth_model extends CI_Model
{
    public function getDataUser($email)
    {
        $this->db->select('user.*');
        $this->db->from('user');
        $this->db->where('email', $email);

        $result = $this->db->get();
        return $result;
    }

    public function getDataUserActive($email)
    {
        $this->db->select('user.*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('is_active', 1);

        $result = $this->db->get();
        return $result;
    }

    public function getDataUserToken($token)
    {
        $this->db->select('user_token.*');
        $this->db->from('user_token');
        $this->db->where('token', $token);

        $result = $this->db->get();
        return $result;
    }

    public function updateDataUserPassword($password, $email)
    {
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function updateDataUserActive($email)
    {
        $this->db->set('is_active', 1);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function insertDataUser($data)
    {
        $this->db->insert('user', $data);
    }

    public function insertDataUserToken($user_token)
    {
        $this->db->insert('user_token', $user_token);
    }

    public function deleteDataUserToken($email)
    {
        $this->db->delete('user_token', ['email' => $email]);
    }

    public function deleteDataUser($email)
    {
        $this->db->delete('user', ['email' => $email]);
    }
}
