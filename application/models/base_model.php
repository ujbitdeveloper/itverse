<?php
defined('BASEPATH') or exit('No direct script access allowed');

class base_model extends CI_Model
{

    private $db_mst;
    private $dbase;
    function __construct()
    {
        parent::__construct();
        $this->db_mst = $this->load->database('master', TRUE);
    }

    function get_data_all($table, $database)
    {
        $this->cek_database($database);
        $this->dbase->select('*');
        $this->dbase->from($table);
        return $this->dbase->get_where()->result_array();
    }

    function get_data_all_sort($table, $sort, $typeSort, $database)
    {
        $this->cek_database($database);
        $this->dbase->select('*');
        $this->dbase->from($table);
        $this->dbase->order_by($sort, $typeSort); // (tanggal , desc/asc)
        return $this->dbase->get_where()->result_array();
    }

    function get_where_sort($table, $where, $sort, $typeSort, $database)
    {
        $this->cek_database($database);
        $this->dbase->select('*');
        $this->dbase->from($table);
        $this->dbase->where($where);
        $this->dbase->order_by($sort, $typeSort); // (tanggal , desc/asc)
        $query = $this->dbase->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function get_where($select, $table, $where, $database)
    {
        $this->cek_database($database);
        $this->dbase->select($select);
        $this->dbase->from($table);
        $this->dbase->where($where);
        $query = $this->dbase->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function insert_data($data, $table, $database)
    {
        $this->cek_database($database);
        $this->dbase->trans_start();
        $this->dbase->insert($table, $data);
        if ($this->dbase->trans_status() === FALSE) {
            $this->dbase->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbase->trans_commit();
            return array('result' => true);
        }
    }

    function update_data($data, $table, $where, $database)
    {
        $this->cek_database($database);
        $this->dbase->trans_begin();
        $this->dbase->where($where);
        $this->dbase->update($table, $data);
        if ($this->dbase->trans_status() === FALSE) {
            $this->dbase->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbase->trans_commit();
            return array('result' => true);
        }
    }

    function delete_data($table, $where, $database)
    {
        $this->cek_database($database);
        $this->dbase->trans_begin();
        $this->dbase->where($where);
        $this->dbase->delete($table);

        if ($this->$database->trans_status() === FALSE) {
            $hasil  = $this->dbase->error();
            $this->dbase->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbase->trans_commit();
            return array('result' => true);
        }
    }


    function get_max_kode($sort, $table, $hint, $database)
    {
        $this->cek_database($database);
        $q = $this->dbase->query("SELECT MAX(RIGHT($sort,9)) AS kd_max FROM $table");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%09s", $tmp);
            }
        } else {
            $kd = "000000001";
        }
        return "$hint-" . $kd;
    }

    function cek_database($database)
    {
        if ($database == 'master') {
            $this->dbase = $this->db_mst;
        } else {
            $this->dbase = $this->db;
        }
    }
}

/* End of file master_model.php */
/* Location: ./application/models/master_model.php */