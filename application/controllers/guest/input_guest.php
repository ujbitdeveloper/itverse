<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Input_guest extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('guest_model', 'GM');
    }
    public function index()
    {
        $this->load->view('guest/input_new_guest');
    }

    public function insert_guest(){
        $id_jenis = $this->input->post('id_jenis');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $alamat = $this->input->post('alamat');
        $posisi = $this->input->post('posisi');
        $no_tlp = $this->input->post('no_tlp');
        $instansi = $this->input->post('instansi');
        $tujuan = $this->input->post('tujuan');
        $keperluan = $this->input->post('keperluan');
        $foto_base64 = $this->input->post('foto_base64');
        $generateId = $this->GM->get_max_kode();
        if($foto_base64){
            $foto_base64 = str_replace('data:image/jpeg;base64,', '', $foto_base64);
            $foto_base64 = str_replace(' ', '+', $foto_base64);

            $image = base64_decode($foto_base64);

            $filename = 'foto_' . time() . '.jpg';
            $filepath = './assets/resource/img/' . $filename;
            file_put_contents($filepath, $image);
        }

        $dataInputDetail = array(
            'id_guest' => $generateId,
            'nama_lengkap' => $nama_lengkap,
            'alamat_lengkap' => $alamat,
            'instansi' => $instansi,
            'bertemu_dengan' => $tujuan,
            'keperluan' => $keperluan,
            'posisi_lamaran' => $posisi,
            'no_tlp' => $no_tlp,
            'foto' => $filename,
        );
        $dataInputHeader = array(
            'id_guest' => $generateId,
            'id_type' => (int)$id_jenis,
        );


        $inputDataHeader = $this->GM->insert_data($dataInputHeader, 'header_guest');

        $inputDataDetail = $this->GM->insert_data($dataInputDetail, 'detail_guest');

        if ($inputDataHeader) {
            $this->session->set_flashdata('notif', 'berhasilInsert');
         } else {
            $this->session->set_flashdata('notif', 'GagalInsert');
        }

        redirect('input_guest', 'refresh');

     
    }

    public function get_data_kategori(){
        $data = $this->GM->get_data_type();
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_type' => $key['id_type'],
                    'type_guest' => $key['type_guest'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }


}
