<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\Simpanan;
use App\Models\User;

class SimpananController extends BaseController
{
    public function index($id = null)
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new Simpanan();
        $users = new User();
        $content = $model->getSbyID($id)->getResult();
        $data = [
            'content'   => $content,
            'pages'     => 'Data Simpanan',
            'pager'     => $model->pager,
            'user'      => $users->where('nik', $id)->first(),
            'nik'       => $id
        ];
        //dd($content);
        return view('simpanan/index', $data);
    }

    public function add($id = null)
    {
        $data = [
            'pages' => 'Add Simpanan',
            'nik'   => $id
        ];
        return view('simpanan/add', $data);
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
            'jenis_simpanan' => [
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
        $model = new simpanan();
        $nik = $this->request->getVar('nik');
        $model->insert([
            'nik'   => $nik,
            'nominal' => $this->request->getVar('nominal'),
            'jenis_simpanan' => $this->request->getVar('jenis_simpanan'),
            'created_at' => $this->request->getVar('created_at'),
            'status_simpanan' => 'BELUM DEPOSIT',
            'kode_deposit' => $kode
        ]);
        session()->setFlashData('message','Berhasil menambah simpanan');
        return redirect()->to('dashboard/transaksi/simpanan/pengguna/'.$nik);
    }

    public function edit($id, $nik)
    {
        $model = new simpanan();
        $data = [
            'data' => $model->where('id_simpanan', $id)->first(),
            'pages'=> 'Edit Simpanan',
            'nik'  => $nik,
        ];
        //dd($data);
        return view('simpanan/edit', $data);
    }

    public function update($nik)
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
            'jenis_simpanan' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'jenis_simpanan harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new simpanan();
        $id = $this->request->getVar('id_simpanan');
        $data = [
            'nominal' => $this->request->getVar('nominal'),
            'jenis_simpanan' => $this->request->getVar('jenis_simpanan'),
            'status_simpanan' => $this->request->getVar('status_simpanan'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','Simpanan telah diupdate!');
        return $this->response->redirect(site_url('dashboard/transaksi/simpanan/pengguna/'.$nik));
    }

    public function delete($id, $nik)
    {
        $model = new Simpanan();
        $model->where('id_simpanan', $id)->delete();
        session()->setFlashData('berhasil', 'Simpanan berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi/simpanan/pengguna/'.$nik));
    }

    public function export()
    {
        $model = new Simpanan();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Laporan Simpanan')
                    ->setCellValue('B1', 'ID Simpanan')
                    ->setCellValue('C1', 'Nik')
                    ->setCellValue('D1', 'Jenis')
                    ->setCellValue('E1', 'Nominal')
                    ->setCellValue('F1', 'Status')
                    ->setCellValue('G1', 'Dibuat');
        
        $column = 2;
        // tulis data simpanan ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B' . $column, $data['id_simpanan'])
                        ->setCellValue('C' . $column, $data['nik'])
                        ->setCellValue('D' . $column, $data['jenis_simpanan'])
                        ->setCellValue('E' . $column, $data['nominal'])
                        ->setCellValue('F' . $column, $data['status_simpanan'])
                        ->setCellValue('G' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap simpanan_'.date('Y-m-d');

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view($id, $nik)
    {
        helper('number');
        $model = new Simpanan();
        $content = $model->where('id_simpanan', $id)->first();
        $data = [
            'content' => $content,
            'pages'   => 'Simpanan',
            'nik'   => $nik
        ];
        //print_r($data);
        return view('simpanan/view', $data);
    }

    public function pdf($id = null)
    {
        helper('number');
        $dompdf = new \Dompdf\Dompdf();
        $model = new Simpanan();
        $nik = $this->request->getVar('nik');
        $simpanan = $model->where('id_simpanan', $id)->first();
        $data = [
            'content' => $simpanan,
            'pages'   => 'Simpanan'
        ];
        $dompdf->loadHtml(view('simpanan/view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Simpanan ID:".$id.".pdf");
        session()->setFlashData('success', 'Berhasil print data!');
        return $this->response->redirect(site_url('dashboard/transaksi/simpanan/pengguna/'.$nik));
    }

    public function indexPersonal($id = null)
    {
        helper('number');
        $model = new Simpanan();
        $content = $model->getSbyID($id)->getResult();
        $data = [
            'content' => $content,
            'pages'   => 'My Simpanan',
            'user'    => $id,
        ];
        //dd($data);
        return view('simpanan/simpanan', $data);
    }
}
