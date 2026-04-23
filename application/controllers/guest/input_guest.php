<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Input_guest extends CI_Controller
{

    public function index()
    {
        $this->load->view('guest/input_new_guest');
    }
}
