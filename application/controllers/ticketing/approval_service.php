<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/ticketing/index.php';

class Approval_service extends index
{
    public function index()
    {
        $this->load->view('ticketing/approval_service');
    }

    public function get_data_approval_service()
    {
        $data = $this->TM->get_data_approval($this->idUser);
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_request' => $key['id_request'],
                    'id_status' => $key['id_status'],
                    'created_date' => date('Y-m-d', strtotime($key['created_date'])),
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'worked_by' => $key['worked_by'],
                    'kategori' => $key['kategori'],
                    'nama_status' => $key['nama_status'],
                    'nama_karyawan' => $key['nama_karyawan'],
                    'departemen' => $key['departemen'],
                    'tanggal_request' => $key['tanggal_request'],
                    'keterangan_request' => $key['keterangan_request'],
                    'keterangan' => $key['keterangan'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }
}
