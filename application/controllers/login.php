<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'lm');
    }

    public function index()
    {
        if ($this->session->userdata('login') == TRUE) {
            redirect('dashboard');
        }
        $this->load->view('login/index');
    }

    public function auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cekAuthLogin = $this->lm->get_data_login($username, $password);

        if ($cekAuthLogin) {
            foreach ($cekAuthLogin as $key) {
                $data_session = array(
                    'id_user'       => $key['id'],
                    'id_karyawan'   => $key['id_karyawan'],
                    'username'      => $key['username'],
                    'nik'           => $key['nik'],
                    'nama_karyawan' => $key['nama_karyawan'],
                    'id_jabatan'    => $key['id_jabatan'],
                    'id_dept'       => $key['id_dept'],
                    'id_section'    => $key['id_section'],
                    'is_request'    => $key['is_request'],
                    'is_active'     => $key['is_active'],
                    'company_name'     => $key['kode_perusahaan'],
                    'role' => $key['kode_jabatan'],
                    'login_status' => true,
                );

                $this->session->set_userdata('ses_log_user', $data_session);
                if ($this->session->userdata('ses_log_user')['login_status'] == true) {
                    redirect('dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('notif', 'GagalLogin');
                    redirect('login', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('notif', 'GagalLogin');
            redirect('login', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
