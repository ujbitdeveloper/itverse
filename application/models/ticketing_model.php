<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticketing_model extends CI_Model
{
    private $tbl_header_ticket = "header_ticket";
    private $tbl_detail_ticket = "detail_ticket";
    private $kategori = "ms_kategori";
    private $karyawan = "ms_karyawan";
    private $status = "ms_status";
    private $tbl_mskaryawan = "db_surat.ms_karyawan";
    private $onJoinTicketing = "header_ticket.id_request = detail_ticket.id_request";
    private $onJoinKategori = "ms_kategori.id_kategori = header_ticket.id_kategori";
    private $onJoinStatus = "ms_status.id_status = header_ticket.id_status";
    private $onJoinKaryawan = "header_ticket.worked_by = db_surat.ms_karyawan.id";

    private $leftJoin = 'left';
    private $dbTicketing;

    function __construct()
    {
        parent::__construct();
        $this->dbTicketing = $this->load->database('ticketing', TRUE);
    }

    function get_data_ticketing($idUser)
    {
        $this->dbTicketing->select('
            header_ticket.id_request,
            header_ticket.id_user,
            header_ticket.id_status,
            header_ticket.created_date,
            header_ticket.start_date,
            header_ticket.end_date,
            header_ticket.finished_date,
            header_ticket.worked_by,
            ms_kategori.kategori,
            ms_status.nama_status,
            ms_status.button_color,
            detail_ticket.nama_karyawan,
            detail_ticket.departemen,
            detail_ticket.tanggal_request,
            detail_ticket.keterangan_request,
            detail_ticket.keterangan_pengerjaan,
            ms_karyawan.nama_karyawan as pic
        ');
        $this->dbTicketing->from($this->tbl_header_ticket);
        $this->dbTicketing->join($this->tbl_detail_ticket, $this->onJoinTicketing, $this->leftJoin);
        $this->dbTicketing->join($this->kategori, $this->onJoinKategori, $this->leftJoin);
        $this->dbTicketing->join($this->status, $this->onJoinStatus, $this->leftJoin);
        $this->dbTicketing->join($this->tbl_mskaryawan, $this->onJoinKaryawan, $this->leftJoin);
        $this->dbTicketing->where('header_ticket.id_user', $idUser);
        $this->dbTicketing->order_by('header_ticket.id', 'ASC');

        $query = $this->dbTicketing->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function get_data_repair($idUser)
    {
        $this->dbTicketing->select('
            header_ticket.id_request,
            header_ticket.id_user,
            header_ticket.id_status,
            header_ticket.created_date,
            header_ticket.start_date,
            header_ticket.end_date,
            header_ticket.finished_date,
            header_ticket.worked_by,
            ms_kategori.kategori,
            ms_status.nama_status,
            ms_status.button_color,
            detail_ticket.nama_karyawan,
            detail_ticket.departemen,
            detail_ticket.tanggal_request,
            detail_ticket.keterangan_request,
            detail_ticket.keterangan_pengerjaan,
            ms_karyawan.nama_karyawan as pic
        ');
        $this->dbTicketing->from($this->tbl_header_ticket);
        $this->dbTicketing->join($this->tbl_detail_ticket, $this->onJoinTicketing, $this->leftJoin);
        $this->dbTicketing->join($this->kategori, $this->onJoinKategori, $this->leftJoin);
        $this->dbTicketing->join($this->status, $this->onJoinStatus, $this->leftJoin);
        $this->dbTicketing->join($this->tbl_mskaryawan, $this->onJoinKaryawan, $this->leftJoin);

        $this->dbTicketing->where('header_ticket.worked_by', $idUser);
        $this->dbTicketing->where_in('header_ticket.id_status', [4, 5]);

        $this->dbTicketing->order_by('header_ticket.id', 'ASC');

        $query = $this->dbTicketing->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function get_data_approval($idUser)
    {
        $this->dbTicketing->select('
            header_ticket.id_request,
            header_ticket.id_status,
            header_ticket.start_date,
            header_ticket.end_date,
            header_ticket.created_date,
            header_ticket.finished_date,
            header_ticket.worked_by,
            ms_kategori.kategori,
            detail_ticket.nama_karyawan,
            detail_ticket.departemen,
            detail_ticket.tanggal_request,
            detail_ticket.keterangan_request,
            detail_ticket.keterangan_pengerjaan,
            ms_status.nama_status
        ');
        $this->dbTicketing->from($this->tbl_header_ticket);
        $this->dbTicketing->join($this->tbl_detail_ticket, $this->onJoinTicketing, $this->leftJoin);
        $this->dbTicketing->join($this->kategori, $this->onJoinKategori, $this->leftJoin);
        $this->dbTicketing->join($this->status, $this->onJoinStatus, $this->leftJoin);

        $this->dbTicketing->where_in('header_ticket.id_status', [1, 2]);
        $this->dbTicketing->where_in('worked_by', [0, $idUser]);

        $this->dbTicketing->order_by('header_ticket.id_request', 'DESC');

        $query = $this->dbTicketing->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function get_data_kategori()
    {
        $selectData = 'id_kategori, kategori';

        $this->dbTicketing->select($selectData);
        $this->dbTicketing->from($this->kategori);
        $query = $this->dbTicketing->get();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function get_data_history_repair($start, $end, $id){
      $this->dbTicketing->select('
            header_ticket.id_request,
            header_ticket.id_user,
            header_ticket.id_status,
            header_ticket.created_date,
            header_ticket.start_date,
            header_ticket.end_date,
            header_ticket.finished_date,
            header_ticket.worked_by,
            ms_kategori.kategori,
            ms_status.nama_status,
            ms_status.button_color,
            detail_ticket.nama_karyawan,
            detail_ticket.departemen,
            detail_ticket.tanggal_request,
            detail_ticket.keterangan_request,
            detail_ticket.keterangan_pengerjaan,
            ms_karyawan.nama_karyawan as pic
        ');
        $this->dbTicketing->from($this->tbl_header_ticket);
        $this->dbTicketing->join($this->tbl_detail_ticket, $this->onJoinTicketing, $this->leftJoin);
        $this->dbTicketing->join($this->kategori, $this->onJoinKategori, $this->leftJoin);
        $this->dbTicketing->join($this->status, $this->onJoinStatus, $this->leftJoin);
        $this->dbTicketing->join($this->tbl_mskaryawan, $this->onJoinKaryawan, $this->leftJoin);
        $this->dbTicketing->where('header_ticket.worked_by', $id);
        $this->dbTicketing->where('date(header_ticket.created_date) >=', $start);
        $this->dbTicketing->where('date(header_ticket.created_date) <=', $end);
        $this->dbTicketing->order_by('header_ticket.id', 'ASC');

        $query = $this->dbTicketing->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }
    function data_karyawan($id)
    {
        $selectData = 'nama_karyawan, id as id_karyawan';
        $where = array(
            'id_section' => 2,
            'id <>' => $id,
            'is_active' => 1
        );
        $this->db->select($selectData);
        $this->db->from($this->karyawan);
        $this->db->where($where);
        $query = $this->db->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function insert_data($data, $table)
    {
        $this->dbTicketing->trans_start();
        $this->dbTicketing->insert($table, $data);
        if ($this->dbTicketing->trans_status() === FALSE) {
            $this->dbTicketing->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbTicketing->trans_commit();
            return array('result' => true);
        }
    }

    function update_data($data, $table, $where)
    {
        $this->dbTicketing->trans_start();
        $this->dbTicketing->where($where);
        $this->dbTicketing->update($table, $data);
        if ($this->dbTicketing->trans_status() === FALSE) {
            $this->dbTicketing->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbTicketing->trans_commit();
            return array('result' => true);
        }
    }

    function get_max_kode()
    {
        $q = $this->dbTicketing->query("SELECT MAX(RIGHT(id_request,9)) AS kd_max FROM $this->tbl_header_ticket");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%09s", $tmp);
            }
        } else {
            $kd = "000000001";
        }
        return "TKT-" . $kd;
    }
}

/* End of file Reservation_model.php */
/* Location: ./application/models/Reservation_model.php */