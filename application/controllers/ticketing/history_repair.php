<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '/controllers/ticketing/index.php';
require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

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

    public function export_excel_history(){

        $start = $this->input->get('start');
        $end = $this->input->get('end');

       
        $tglAwal = date_indo($start);
        $tglAkhir = date_indo($end);

        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('UJB')
            ->setLastModifiedBy('UJB')
            ->setTitle("History Service")
            ->setSubject("History Service")
            ->setDescription("History Service")
            ->setKeywords("History Service");

        $style_col = array(
            'font' => array(
                'bold' => true,
                 'color' => array(
                    'rgb' => 'FFFFFF' // Warna text putih
                    )
                ), // Set font nya jadi bold
                  'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => '13c2c2' // Warna biru
                    )
                ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );


        $excel->setActiveSheetIndex(0)->setCellValue('A1', "History Service(" . "Periode " . $tglAwal . " s/d " . $tglAkhir . ")");

        $excel->getActiveSheet()->mergeCells('A1:H1');
        $excel->getActiveSheet()->mergeCells('A2:H2');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "No Request");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Kategori");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Tanggal Request");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Tanggal Selesai");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Keterangan Request");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Keterangan Pekerjaan");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "PIC");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Status");


        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);

        $detailhistory = $this->TM->get_data_history_repair($start, $end, $this->idUser);
            
        $numrow = 4;
        foreach ($detailhistory as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data['id_request']);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['kategori']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['created_date']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['finished_date']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['keterangan_request']);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['keterangan_pengerjaan']);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['pic']);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['nama_status']);
        

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $numrow++;
        }
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(22);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(22);


        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $excel->getActiveSheet(0)->setTitle("History Service");
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="HistoryServiceReport.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
