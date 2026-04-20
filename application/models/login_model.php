<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_data_login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('v_login');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->where('is_active', 1);
        $this->db->limit(1);

        //get query and processing
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result_array();
            // return true;
        } else {
            return false; //if data is wrong
        }
    }

    public function updatePassword($password, $id)
    {
        $where = array(
            'id' => $id
        );
        $data = array(
            'password' => $password,
            'is_reset' => 0
        );
        $this->db->trans_begin();
        $this->db->where($where);
        $this->db->update('ms_user', $data);

        if ($this->db->trans_status() === FALSE) {
            $hasil  = $this->db->error();
            $this->db->trans_rollback();
            return array('result' => false);
        } else {
            $this->db->trans_commit();
            return array('result' => true);
        }
    }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */