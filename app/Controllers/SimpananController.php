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
        $model->insert([
            'nik'   => $this->request->getVar('nik'),
            'nominal' => $this->request->getVar('nominal'),
            'jenis_simpanan' => $this->request->getVar('jenis_simpanan'),
            'created_at' => $this->request->getVar('created_at'),
            'status_simpanan' => 'BELUM DEPOSIT',
            'kode_deposit' => $kode
        ]);
        session()->setFlashData('message','Berhasil menambah simpanan');
        return redirect()->to('dashboard/transaksi');
    }

    public function edit($id = null)
    {
        $model = new simpanan();
        $data = [
            'data' => $model->where('id_simpanan', $id)->first(),
            'pages'=> 'Edit Simpanan',
        ];
        return view('simpanan/edit', $data);
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
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function delete($id = null)
    {
        $model = new Simpanan();
        $model->where('id_simpanan', $id)->delete();
        session()->setFlashData('berhasil', 'Simpanan berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function export()
    {
        $model = new Simpanan();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID Simpanan')
                    ->setCellValue('B1', 'NIK')
                    ->setCellValue('C1', 'Jenis Simpanan')
                    ->setCellValue('D1', 'Nominal')
                    ->setCellValue('E1', 'Status Simpanan')
                    ->setCellValue('F1', 'Dibuat');
        
        $column = 2;
        // tulis data simpanan ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id_simpanan'])
                        ->setCellValue('C' . $column, $data['nik'])
                        ->setCellValue('D' . $column, $data['jenis_simpanan'])
                        ->setCellValue('E' . $column, $data['nominal'])
                        ->setCellValue('F' . $column, $data['status_simpanan'])
                        ->setCellValue('G' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap simpanan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view($id = null)
    {
        helper('number');
        $model = new Simpanan();
        $content = $model->where('id_simpanan', $id)->first();
        $data = [
            'content' => $content,
            'pages'   => 'Simpanan'
        ];
        //print_r($simpan);
        return view('simpanan/view', $data);
    }

    public function pdf($id = null)
    {
        helper('number');
        $dompdf = new \Dompdf\Dompdf();
        $model = new Simpanan();
        $simpanan = $model->where('id_simpanan', $id)->first();
        $data = [
            'content' => $simpanan,
            'pages'   => 'Simpanan'
        ];
        $dompdf->loadHtml(view('simpanan/view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Simpanan ID:".$id.".pdf");
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
