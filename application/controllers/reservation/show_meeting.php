<?php

defined('BASEPATH') or exit('No direct script access allowed');

class show_meeting extends CI_Controller
{
    public function index($id_ruangan = null)
    {
        $data['id_ruangan'] = $id_ruangan;
        $this->load->view('reservation/show_meeting', $data);
    }
    public function get_meeting_api($id_ruangan = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Reservation_model', 'RM');

        if (!$id_ruangan || !is_numeric($id_ruangan)) {
            echo json_encode(['status' => false]);
            return;
        }

        $list_meeting = $this->RM->get_meeting_today($id_ruangan);
        $ruangan = $this->RM->get_ruangan($id_ruangan);
        $current_meeting = null;

        $now = date('H:i:s');
        $now_time = strtotime($now);

        foreach ($list_meeting as &$row) {
            $start_time = strtotime($row->jam_mulai);
            $end_time   = strtotime($row->jam_selesai);

            if ($now_time >= $start_time && $now_time <= $end_time) {
                $row->is_active_meeting = true;
                $current_meeting = $row;
            } else {
                $row->is_active_meeting = false;
            }
        }

        echo json_encode([
            'status' => true,
            'list_meeting' => $list_meeting,
            'current_meeting' => $current_meeting,
            'ruangan' => $ruangan[0]['nama_ruangan'],
        ]);
    }
}
