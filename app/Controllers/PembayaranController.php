<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pembayaran;

class PembayaranController extends BaseController
{
    public function index($id = null)
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new pembayaran();
        $content = $model->getPBbyID($id)->getResult();
        $data = [
            'content'   => $content,
            'pages'     => 'Data Pembayaran',
            'pager'     => $model->pager,
            'id'      => $id
        ];
        //dd($content);
        return view('pembayaran/index', $data);
    }

    public function add($id = null)
    {
        $data = [
            'pages' => 'Add Pembayaran',
            'id'   => $id
        ];
        return view('pembayaran/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'id_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'nominal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new pembayaran();
        $model->insert([
            'id_pembayaran'   => $this->request->getVar('id_pembayaran'),
            'nominal' => $this->request->getVar('nominal'),
        ]);
        session()->setFlashData('message','Berhasil menambah pembayaran');
        return redirect()->to('dashboard/transaksi');
    }

    public function export()
    {
        $model = new Pembayaran();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID Pembayaran')
                    ->setCellValue('B1', 'ID Angsuran')
                    ->setCellValue('C1', 'Nominal')
                    ->setCellValue('D1', 'Waktu Transaksi');
        
        $column = 2;
        // tulis data pembayaran ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id_pembayaran'])
                        ->setCellValue('B' . $column, $data['id_angsuran'])
                        ->setCellValue('C' . $column, $data['nominal'])
                        ->setCellValue('D' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap pembayaran';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view($id = null)
    {
        helper('number');
        $model = new Pembayaran();
        $content = $model->where('id_pembayaran', $id)->first();
        $data = [
            'content' => $content,
            'pages'   => 'pembayaran'
        ];
        //print_r($simpan);
        return view('pembayaran/view', $data);
    }

    public function pdf($id = null)
    {
        helper('number');
        $dompdf = new \Dompdf\Dompdf();
        $model = new Pembayaran();
        $pembayaran = $model->where('id_pembayaran', $id)->first();
        $data = [
            'content' => $pembayaran,
            'pages'   => 'pembayaran'
        ];
        $dompdf->loadHtml(view('pembayaran/view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("pembayaran ID:".$id.".pdf");
    }
}
