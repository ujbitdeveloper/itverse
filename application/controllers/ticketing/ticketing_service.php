<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/ticketing/index.php';

class Ticketing_service extends index
{
    public function index()
    {
        $this->load->view('ticketing/index');
    }
    public function insert_data_service()
    {
        $this->load->view('ticketing/form_new_ticketing');
    }

    public function get_data_kategori()
    {
        $data = $this->TM->get_data_kategori();
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_kategori' => $key['id_kategori'],
                    'kategori' => $key['kategori'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function get_data_service()
    {
        $data = $this->TM->get_data_ticketing($this->idUser);
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
                    'nama_karyawan' => $key['nama_karyawan'],
                    'departemen' => $key['departemen'],
                    'tanggal_request' => $key['tanggal_request'],
                    'keterangan_request' => $key['keterangan_request'],
                    'keterangan' => $key['keterangan'],
                    'pic' => $key['pic'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function insert_data_reservation()
    {
        $kategori = $this->input->post('kategori');
        $keterangan_request = $this->input->post('keterangan_request');

        $idRequest = $this->TM->get_max_kode();
        $dataInputHeader = array(
            'id_request' => $idRequest,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->idUser,
            'id_user' => $this->idUser
        );

        $dataInputDetail = array(
            'id_request' => $idRequest,
            'nik' => $this->nik,
            'nama_karyawan' => $this->namaUser,
        );

        $inputHeaderBooking = $this->RM->insert_data($dataInputHeader, 'header_booking');
        $inputDetailBooking = $this->RM->insert_data($dataInputDetail, 'detail_booking');

        redirect('reservation', 'refresh');
    }
}
