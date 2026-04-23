<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
    public $namaUser;
    public $idUser;
    public $nik;
    function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('ses_log_user')['login_status']) != TRUE) {
            redirect('');
        };

        //data session login
        $session = $this->session->userdata('ses_log_user');
        $this->namaUser = $session['nama_karyawan'];
        $this->idUser = $session['id_karyawan'];
        $this->nik = $session['nik'];

        //load data model
        $this->load->model('Ticketing_model', 'TM');
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

    public function show_meeting()
    {
        $this->load->view('reservation/show_meeting');
    }
}
