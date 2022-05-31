<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Pinjaman;
use App\Models\User;

class PinjamanController extends BaseController
{
    public function index($id = null)
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new Pinjaman();
        $users = new User();
        $content = $model->getPbyID($id)->getResult();
        $data = [
            'content'   => $content,
            'pages'     => 'Data pinjaman',
            'pager'     => $model->pager,
            'user'      => $users->where('nik', $id)->first(),
        ];
        //dd($content);
        return view('pinjaman/index', $data);
    }

    public function add($id = null)
    {
        $data = [
            'pages' => 'Add Pinjaman',
            'nik'   => $id
        ];
        return view('pinjaman/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|min_length[11]|max_length[35]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 10 Karakter',
                    'max_length' => '{field} Maksimal 35 Karakter',
                ]
            ],
            'nominal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'jenis_pinjaman' => [
                'rules' => 'required',
                'error' => [
                    'required' => '{field} harus diisi',
                ],
            ],
            'created_at' => [
                'rules' => 'required',
                'error' => [
                    'required' => '{field} harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $kode = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6);
        $model = new pinjaman();
        $model->insert([
            'nik'   => $this->request->getVar('nik'),
            'nominal' => $this->request->getVar('nominal'),
            'jenis_pinjaman' => $this->request->getVar('jenis_pinjaman'),
            'created_at' => $this->request->getVar('created_at'),
            'status' => 'BELUM DIAMBIL',
            'kode_penarikan' => $kode
        ]);
        session()->setFlashData('message','Berhasil menambah pinjaman');
        return redirect()->to('dashboard/transaksi');
    }

    public function edit($id = null)
    {
        $model = new pinjaman();
        $data = [
            'data' => $model->where('id_pinjaman', $id)->first(),
            'pages'=> 'Edit pinjaman',
        ];
        return view('pinjaman/edit', $data);
    }

    public function update()
    {
        if (!$this->validate([
            'nominal' => [
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
            'jenis_pinjaman' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'jenis_pinjaman harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new pinjaman();
        $id = $this->request->getVar('id_pinjaman');
        $data = [
            'nominal' => $this->request->getVar('nominal'),
            'biaya_admin' => $this->request->getVar('biaya_admin'),
            'jenis_pinjaman' => $this->request->getVar('jenis_pinjaman'),
            'status_pinjaman' => $this->request->getVar('status_pinjaman'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','pinjaman telah diupdate!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function delete($id = null)
    {
        $model = new pinjaman();
        $model->where('id_pinjaman', $id)->delete();
        session()->setFlashData('berhasil', 'Pinjaman berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function export()
    {
        $model = new pinjaman();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID Pinjaman')
                    ->setCellValue('B1', 'NIK')
                    ->setCellValue('C1', 'Biaya Admin')
                    ->setCellValue('D1', 'Jenis Pinjaman')
                    ->setCellValue('E1', 'Nominal')
                    ->setCellValue('F1', 'Kode Penarikan')
                    ->setCellValue('G1', 'Dibuat');
        
        $column = 2;
        // tulis data pinjaman ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id_pinjaman'])
                        ->setCellValue('B' . $column, $data['nik'])
                        ->setCellValue('C' . $column, $data['biaya_admin'])
                        ->setCellValue('D' . $column, $data['jenis_pinjaman'])
                        ->setCellValue('E' . $column, $data['nominal'])
                        ->setCellValue('F' . $column, $data['kode_penarikan'])
                        ->setCellValue('G' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap pinjaman';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view($id = null)
    {
        helper('number');
        $model = new Pinjaman();
        $content = $model->where('id_pinjaman', $id)->first();
        $data = [
            'content' => $content,
            'pages'   => 'Pinjaman'
        ];
        //print_r($simpan);
        return view('pinjaman/view', $data);
    }

    public function pdf($id = null)
    {
        helper('number');
        $dompdf = new \Dompdf\Dompdf();
        $model = new Pinjaman();
        $pinjaman = $model->where('id_pinjaman', $id)->first();
        $data = [
            'content' => $pinjaman,
            'pages'   => 'Pinjaman'
        ];
        $dompdf->loadHtml(view('pinjaman/view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Pinjaman ID:".$id.".pdf");
    }

    public function indexPersonal($id = null)
    {
        helper('number');
        $model = new Pinjaman();
        $content = $model->getPbyID($id)->getResult();
        $data = [
            'content' => $content,
            'pages'   => 'My Pinjaman',
            'user'    => $id,
        ];
        //dd($data);
        return view('pinjaman/pinjaman', $data);
    }
}
