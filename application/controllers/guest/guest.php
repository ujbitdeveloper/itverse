<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/guest/index.php';

class Guest extends index
{
    public function get_data_guest()
    {
        $data = $this->GM->get_data_guest();
        $no = 1;
        $arr['data'] = array();
        if (!empty($data)) {
            foreach ($data as $key) :
                $arr['data'][] = array(
                    'no' => $no,
                    'id_type' => $key['id_type'],
                    'type_guest' => $key['type_guest'],
                    'nama_lengkap' => $key['nama_lengkap'],
                    'alamat_lengkap' => $key['alamat_lengkap'],
                    'instansi' => $key['instansi'] != null ? $key['instansi'] : "-",
                    'bertemu_dengan' => $key['bertemu_dengan'] != null ? $key['bertemu_dengan'] : "-",
                    'keperluan' => $key['keperluan'] != null ? $key['keperluan'] : "-",
                    'posisi_lamaran' => $key['posisi_lamaran'] != null ? $key['posisi_lamaran'] : "-",
                    'no_tlp' => $key['no_tlp'],
                    'foto' => $key['foto'],
                    'tanggal' => $key['created_at'],
                    'button_color' => $key['button_color'],
                );
                $no++;
            endforeach;
        }
        echo json_encode($arr);
    }
}
