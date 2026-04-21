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
}
