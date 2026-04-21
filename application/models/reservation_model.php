<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservation_model extends CI_Model
{
    private $tbl_header_booking = "header_booking";
    private $tbl_detail_booking = "detail_booking";
    private $tbl_ruangan = "ms_ruangan";
    private $onJoinBooking = "header_booking.id_booking = detail_booking.id_booking";
    private $onJoinRuangan = "ms_ruangan.id_ruangan = header_booking.id_ruangan";
    private $leftJoin = 'left';
    private $dbReservation;

    function __construct()
    {
        parent::__construct();
        $this->dbReservation = $this->load->database('reservation', TRUE);
    }

    function get_data_reservation($idUser)
    {
        $selectData = 'header_booking.id_booking,nama,nama_ruangan,keterangan,tanggal,jam_mulai,jam_selesai';
        $this->dbReservation->select($selectData);
        $this->dbReservation->from($this->tbl_header_booking);
        $this->dbReservation->join($this->tbl_detail_booking, $this->onJoinBooking, $this->leftJoin);
        $this->dbReservation->join($this->tbl_ruangan, $this->onJoinRuangan, $this->leftJoin);
        $this->dbReservation->where('id_user', $idUser);
        $query = $this->dbReservation->get_where();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function get_data_ruangan()
    {
        $selectData = 'id_ruangan, nama_ruangan';

        $this->dbReservation->select($selectData);
        $this->dbReservation->from($this->tbl_ruangan);
        $query = $this->dbReservation->get();
        $data = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data;
    }

    function insert_data($data, $table)
    {
        $this->dbReservation->trans_start();
        $this->dbReservation->insert($table, $data);
        if ($this->dbReservation->trans_status() === FALSE) {
            $this->dbReservation->trans_rollback();
            return array('result' => false);
        } else {
            $this->dbReservation->trans_commit();
            return array('result' => true);
        }
    }

    function get_max_kode()
    {
        $q = $this->dbReservation->query("SELECT MAX(RIGHT(id_booking,9)) AS kd_max FROM $this->tbl_header_booking");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%09s", $tmp);
            }
        } else {
            $kd = "000000001";
        }
        return "RSV-" . $kd;
    }
}

/* End of file Reservation_model.php */
/* Location: ./application/models/Reservation_model.php */