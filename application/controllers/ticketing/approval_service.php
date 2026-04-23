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
                    'keterangan_pengerjaan' => $key['keterangan_pengerjaan'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function approve_service($id)
    {
        $where = array(
            'id_request' => $id
        );
        $data = array(
            'id_status' => 2,
            'worked_by' => $this->idUser
        );
        $table = 'header_ticket';
        $update_data = $this->TM->update_data($data, $table, $where);

        redirect('approval_service', 'refresh');
    }

    public function finish_service()
    {
        $id = $this->input->post('idTransaksiSelesai');
        $keterangan = $this->input->post('keterangan_selesai_service');


        $where = array(
            'id_request' => $id
        );
        $data = array(
            'id_status' => 4,
            'worked_by' => $this->idUser,
            'finished_date' => date('Y-m-d')
        );
        $dataDetail = array(
            'keterangan_pengerjaan' => $keterangan,
        );

        $tableHeader = 'header_ticket';
        $tableDetail = 'detail_ticket';
        $update_data = $this->TM->update_data($data, $tableHeader, $where);
        $update_data = $this->TM->update_data($dataDetail, $tableDetail, $where);

        redirect('approval_service', 'refresh');
    }
    public function asign_service()
    {
        $id = $this->input->post('idTransaksiAsign');
        $idKaryawan = $this->input->post('karyawan');
        $keterangan = $this->input->post('keterangan_selesai_asign');

        // var_dump($id);
        // die();
        $where = array(
            'id_request' => $id
        );
        $data = array(
            'worked_by' => $idKaryawan,
        );
        $dataDetail = array(
            'keterangan_asign' => $keterangan,
        );

        $tableHeader = 'header_ticket';
        $tableDetail = 'detail_ticket';
        $update_data = $this->TM->update_data($data, $tableHeader, $where);
        $update_data = $this->TM->update_data($dataDetail, $tableDetail, $where);

        redirect('approval_service', 'refresh');
    }
}
