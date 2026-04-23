<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest_model extends CI_Model
{
    private $tbl_header_guest = "header_guest";
    private $tbl_detail_guest = "detail_guest";
    private $tbl_type = "ms_type";
    private $onJoinguest = "header_guest.id_guest = detail_guest.id_guest";
    private $onJoinType = "ms_type.id_type = header_guest.id_type";
    private $leftJoin = 'left';
    private $dbGuest;

    function __construct()
    {
        parent::__construct();
        $this->dbGuest = $this->load->database('guest', TRUE);
    }

    function get_data_guest()
    {
        $selectData = 'header_detail.*, header_guest.id_jenis,header_guest.created_at as tanggal, ms_type.type_guest, ms_type.button_color';
        $this->dbGuest->select($selectData);
        $this->dbGuest->from($this->tbl_header_guest);
        $this->dbGuest->join($this->tbl_detail_guest, $this->onJoinguest, $this->leftJoin);
        $this->dbGuest->join($this->tbl_type, $this->onJoinType, $this->leftJoin);
        $this->dbGuest->order_by('type_guest',);
        $query = $this->dbGuest->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }



    function get_data_type()
    {
        $selectData = 'id_type, type_guest';

        $this->dbGuest->select($selectData);
        $this->dbGuest->from($this->tbl_ruangan);
        $query = $this->dbGuest->get();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function insert_data($data, $table)
    {
        $this->dbGuest->trans_start();
        $this->dbGuest->insert($table, $data);
        if ($this->dbGuest->trans_status() === FALSE) {
            $this->dbGuest->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbGuest->trans_commit();
            return array('result' => true);
        }
    }

    function get_max_kode()
    {
        $q = $this->dbGuest->query("SELECT MAX(RIGHT(id_guest,9)) AS kd_max FROM $this->header_guest");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%09s", $tmp);
            }
        } else {
            $kd = "000000001";
        }
        return "GST-" . $kd;
    }
}

/* End of file Guest_model.php */
/* Location: ./application/models/Guest_model.php */