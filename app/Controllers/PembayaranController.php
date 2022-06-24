<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\Pembayaran;

class PembayaranController extends BaseController
{
    //delete sesuai id
    public function delete($id)
    {
        $model = new Pembayaran();
        $model->where('id_pembayaran', $id)->delete($id);
        session()->setFlashData('berhasil', 'Pembayaran berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    //tampil sesaui id
    public function index($id = null)
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new Pembayaran();
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
            'nominal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'biaya_admin' => [
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
        $id = $this->request->getVar('id_angsuran');
        $model->insert([
            'id_angsuran'   => $this->request->getVar('id_angsuran'),
            'nominal' => $this->request->getVar('nominal'),
            'biaya_admin' => $this->request->getVar('biaya_admin'),
            'created_at' => $this->request->getVar('created_at'),
        ]);
        session()->setFlashData('message','Berhasil menambah pembayaran');
        return redirect()->to('dashboard/transaksi/pembayaran/angsuran/'.$id);
    }

    public function export()
    {
        $model = new Pembayaran();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()
                ->setFormatCode('#,##0.00');
        $spreadsheet->getActiveSheet()->mergeCells('A1:D1');
        $spreadsheet->getActiveSheet()->getStyle('A1')
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Laporan Pembayaran')
                ->setCellValue('A2', 'ID Pembayaran')
                ->setCellValue('B2', 'ID Angsuran')
                ->setCellValue('C2', 'Nominal')
                ->setCellValue('D2', 'Waktu Transaksi');
        $column = 3;
        // tulis data angsuran ke cell
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
        $fileName = 'Rekap pembayaran_'.date('Y-m-d');

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

    public function indexPersonal($nik,$id)
    {
        helper('number');
        $model = new Pembayaran();
        $content = $model->getPBbyID($id)->getResult();
        $data = [
            'content' => $content,
            'pages'   => 'My Pembayaran',
            'user'    => $id,
        ];
        //dd($data);
        return view('pembayaran/pembayaran', $data);
    }
}
