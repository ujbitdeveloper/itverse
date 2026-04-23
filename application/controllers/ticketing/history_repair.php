<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/ticketing/index.php';

class History_repair extends index
{

    public function index()
    {

        $this->load->view('ticketing/history_repair');
    }

    public function get_data_history_repair()
    {
        $data = $this->TM->get_data_repair($this->idUser);
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_request' => $key['id_request'],
                    'id_user' => $key['id_user'],
                    'id_status' => $key['id_status'],
                    'created_date' => date('Y-m-d', strtotime($key['created_date'])),
                    'finished_date' => date('Y-m-d', strtotime($key['finished_date'])),
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'worked_by' => $key['worked_by'],
                    'kategori' => $key['kategori'],
                    'nama_status' => $key['nama_status'],
                    'button_color' => $key['button_color'],
                    'nama_karyawan' => $key['nama_karyawan'],
                    'departemen' => $key['departemen'],
                    'tanggal_request' => $key['tanggal_request'],
                    'keterangan_request' => $key['keterangan_request'],
                    'keterangan_pengerjaan' => $key['keterangan_pengerjaan'],
                    'pic' => $key['pic'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }
}
