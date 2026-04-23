<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/reservation/index.php';
class Reservation_room extends index
{
    public function get_data_reservation()
    {
        $data = $this->RM->get_data_reservation($this->idUser);
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_booking' => $key['id_booking'],
                    'id_ruangan' => $key['id_ruangan'],
                    'is_active' => $key['is_active'],
                    'nama' => $key['nama'],
                    'ruangan' => $key['nama_ruangan'],
                    'keterangan' => $key['keterangan'],
                    'tanggal' => $key['tanggal'],
                    'jam_mulai' => $key['jam_mulai'],
                    'jam_selesai' => $key['jam_selesai'],
                    'jam' => $key['jam_mulai'] . " - " . $key['jam_selesai'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }

    public function data_ruangan()
    {
        $data = $this->RM->get_data_ruangan();
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_ruangan' => $key['id_ruangan'],
                    'nama_ruangan' => $key['nama_ruangan'],
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

        $pengecekanJamdanRuangan = $this->RM->pengecekanoverlap($tanggal, $jam_mulai, $jam_selesai, $id_ruangan);

        if ($pengecekanJamdanRuangan != null) {
            $this->session->set_flashdata('notif', 'jamOverlap');
            redirect('reservation', 'refresh');
        } else {
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

            if ($inputDetailBooking) {
                $this->session->set_flashdata('notif', 'berhasilInsert');
            } else {
                $this->session->set_flashdata('notif', 'GagalInsert');
            }

            redirect('reservation', 'refresh');
        }
    }

    public function cancle_booking($id)
    {
        $where = array(
            'id_booking' => $id
        );

        $dataUpdate = array(
            'is_active' => 0,
            'updated_date' => date('Y-m-d'),
            'updated_by' => $this->idUser
        );

        $inputHeaderBooking = $this->RM->update_data($dataUpdate, 'header_booking', $where);
        redirect('reservation', 'refresh');
    }

    public function edit_reservation()
    {
        $tanggal = $this->input->post('tanggal_edit');
        $jam_mulai = $this->input->post('jam_dari_edit');
        $jam_selesai = $this->input->post('jam_sampai_edit');
        $keterangan = $this->input->post('keterangan_edit');
        $id_ruangan = $this->input->post('idRuangan');
        $idbooking =  $this->input->post('idBooking');

        $pengecekanJamdanRuangan = $this->RM->pengecekanoverlap($tanggal, $jam_mulai, $jam_selesai, $id_ruangan);

        if ($pengecekanJamdanRuangan != null) {
            $this->session->set_flashdata('notif', 'jamOverlap');
            redirect('reservation', 'refresh');
        } else {
            $where = array(
                'id_booking' => $idbooking
            );
            $dataUpdateHeader = array(
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => $this->idUser
            );
            $dataUpdateDetail = array(
                'tanggal' => $tanggal,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'keterangan' => $keterangan,
            );
            $UpdateHeaderBooking = $this->RM->update_data($dataUpdateHeader, 'header_booking', $where);
            $UpdateDetailBooking = $this->RM->update_data($dataUpdateDetail, 'detail_booking', $where);

            if ($UpdateDetailBooking) {
                $this->session->set_flashdata('notif', 'berhasilUpdate');
            } else {
                $this->session->set_flashdata('notif', 'GagalUpdate');
            }

            redirect('reservation', 'refresh');
        }
    }
}
