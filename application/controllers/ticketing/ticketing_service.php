<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/ticketing/index.php';

class Ticketing_service extends index
{
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

    public function selesai_user_service($id)
    {
        $where = array(
            'id_request' => $id
        );
        $data = array(
            'id_status' => 5,
            'updated_date' => date('Y-m-d'),
            'updated_by' => $this->idUser
        );

        $tableHeader = 'header_ticket';
        $update_data = $this->TM->update_data($data, $tableHeader, $where);

        redirect('service', 'refresh');
    }
    public function get_data_karyawan()
    {
        $data = $this->TM->data_karyawan($this->idUser);
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_karyawan' => $key['id_karyawan'],
                    'nama_karyawan' => $key['nama_karyawan'],
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
                    'finished_date' => $key['finished_date'] != null ? date('Y-m-d', strtotime($key['finished_date'])) : "-",
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'worked_by' => $key['worked_by'],
                    'kategori' => $key['kategori'],
                    'nama_status' => $key['nama_status'],
                    'nama_karyawan' => $key['nama_karyawan'],
                    'departemen' => $key['departemen'],
                    'tanggal_request' => $key['tanggal_request'],
                    'keterangan_request' => $key['keterangan_request'],
                    'keterangan_pengerjaan' => $key['keterangan_pengerjaan'],
                    'button_color' => $key['button_color'],
                    'pic' => $key['pic'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function insert_data_service()
    {
        $kategori = $this->input->post('kategori');
        $keterangan_request = $this->input->post('keterangan_request');
        $idRequest = $this->TM->get_max_kode();


        $dataInputHeader = array(
            'id_request' => $idRequest,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->idUser,
            'id_user' => $this->idUser,
            'id_status'    => 1,
            'id_kategori'    => $kategori,
        );

        $dataInputDetail = array(
            'id_request' => $idRequest,
            'nama_karyawan' => $this->namaUser,
            'tanggal_request'    => date('Y-m-d H:i:s'),
            'keterangan_request' => $keterangan_request,
        );

        $inputHeaderTicket = $this->TM->insert_data($dataInputHeader, 'header_ticket');
        $inputDetailTicket = $this->TM->insert_data($dataInputDetail, 'detail_ticket');

        redirect('service', 'refresh');
    }
}
