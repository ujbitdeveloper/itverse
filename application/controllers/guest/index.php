<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('ses_log_user')['login_status']) != TRUE) {
            redirect('');
        };
    }

    public function index()
    {
        $this->load->view('guest/index');
    }
}
