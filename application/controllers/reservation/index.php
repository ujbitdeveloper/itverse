<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
    private $namaUser;
    private $idUser;
    private $nik;
    function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('ses_log_user')['login_status']) != TRUE) {
            redirect('');
        };
        //data session login
        $session = $this->session->userdata('ses_log_user');
        $this->namaUser = $session['nama_karyawan'];
        $this->idUser = $session['id_user'];
        $this->nik = $session['nik'];

        //load data model
        $this->load->model('Reservation_model', 'RM');
    }

    public function index()
    {
        $this->load->view('reservation/index');
    }

    public function form_reservation()
    {
        $this->load->view('reservation/form_new_reservation');
    }

    public function get_data_reservation()
    {
        $data = $this->RM->get_data_reservation($this->idUser);
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id' => $key['id_booking'],
                    'nama' => $key['nama'],
                    'ruangan' => $key['nama_ruangan'],
                    'keterangan' => $key['keterangan'],
                    'tanggal' => $key['tanggal'],
                    'jam_mulai' => $key['jam_mulai'],
                    'jam_selesai' => $key['jam_selesai'],
                    'jam' => $key['jam_mulai'] . " - " . $key['jam_selesai'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function data_ruangan()
    {
        $data = $this->RM->get_data_ruangan();
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_ruangan' => $key['id_ruangan'],
                    'nama_ruangan' => $key['nama_ruangan'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function insert_data_reservation()
    {
        $tanggal = $this->input->post('tanggal');
        $jam_mulai = $this->input->post('jam_dari');
        $jam_selesai = $this->input->post('jam_sampai');
        $keterangan = $this->input->post('keterangan');
        $id_ruangan = $this->input->post('Ruangan');


        $idbooking = $this->RM->get_max_kode();


        $dataInputHeader = array(
            'id_booking' => $idbooking,
            'id_ruangan' => $id_ruangan,
            'id_user' => $this->idUser,
            'is_active' => 1,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->idUser
        );
        $dataInputDetail = array(
            'id_booking' => $idbooking,
            'tanggal' => $tanggal,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'keterangan' => $keterangan,
            'nik' => $this->nik,
            'nama' => $this->namaUser,
        );

        $inputHeaderBooking = $this->RM->insert_data($dataInputHeader, 'header_booking');
        $inputDetailBooking = $this->RM->insert_data($dataInputDetail, 'detail_booking');

        redirect('reservation', 'refresh');
    }

    public function edit_data_reservation() {}
}
