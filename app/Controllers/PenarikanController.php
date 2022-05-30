<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\Penarikan;
use App\Models\Simpanan;
use App\Models\User;

class PenarikanController extends BaseController
{
    public function index($id = null)
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new Penarikan();
        $users = new User();
        $content = $model->getPRbyID($id)->getResult();
        $data = [
            'content'   => $content,
            'pages'     => 'Data Penarikan',
            'pager'     => $model->pager,
            'user'      => $id
        ];
        //dd($content);
        return view('penarikan/index', $data);
    }

    public function add($id, $nominal, $nik)
    {
        $data = [
            'pages' => 'Add penarikan',
            'id'   => $id,
            'nominal' => $nominal,
            'nik' => $nik
        ];
        return view('penarikan/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|min_length[11]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 10 Karakter',
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
        $kode = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6);
        $nominal_simpanan = $this->request->getVar('nominal_simpanan');
        $nominal_penarikan = $this->request->getVar('nominal');
        $nik = $this->request->getVar('nik');
        $model = new Penarikan();
        $data = [
            'id_simpanan'   => $this->request->getVar('id_simpanan'),
            'nominal' => $this->request->getVar('nominal'),
            'status_penarikan' => 'BELUM DIAMBIL',
            'kode_penarikan' => $kode
        ];
        if ($model->insert($data)){
            $simpanan = new Simpanan();
            $result = $nominal_simpanan - $nominal_penarikan;
            $id = $this->request->getVar('id_simpanan');
            $data = [
                'nominal' => $result
            ];
            $simpanan->update($id,$data);
            session()->setFlashData('message','Berhasil menambah penarikan');
            return redirect()->to('dashboard/transaksi/simpanan/pengguna/'.$nik);
        } else {
            echo 'Error';
        }
    }

    public function edit($id = null)
    {
        $model = new Penarikan();
        $data = [
            'data' => $model->where('id_penarikan', $id)->first(),
            'pages'=> 'Edit penarikan',
        ];
        return view('penarikan/edit', $data);
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
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new Penarikan();
        $id = $this->request->getVar('id_penarikan');
        $data = [
            'nominal' => $this->request->getVar('nominal'),
            'status_penarikan' => $this->request->getVar('status_penarikan'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','penarikan telah diupdate!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function delete($id = null)
    {
        $model = new Penarikan();
        $model->where('id_penarikan', $id)->delete();
        session()->setFlashData('berhasil', 'penarikan berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function export()
    {
        $model = new Penarikan();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID penarikan')
                    ->setCellValue('B1', 'NIK')
                    ->setCellValue('C1', 'Nominal')
                    ->setCellValue('D1', 'Kode Penarikan')
                    ->setCellValue('E1', 'Dibuat');
        
        $column = 2;
        // tulis data penarikan ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id_penarikan'])
                        ->setCellValue('B' . $column, $data['nik'])
                        ->setCellValue('C' . $column, $data['nominal'])
                        ->setCellValue('D' . $column, $data['kode_penarikan'])
                        ->setCellValue('E' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap penarikan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view($id = null)
    {
        helper('number');
        $model = new Penarikan();
        $content = $model->where('id_penarikan', $id)->first();
        $data = [
            'content' => $content,
            'pages'   => 'penarikan'
        ];
        //print_r($simpan);
        return view('penarikan/view', $data);
    }

    public function pdf($id = null)
    {
        helper('number');
        $dompdf = new \Dompdf\Dompdf();
        $model = new Penarikan();
        $penarikan = $model->where('id_penarikan', $id)->first();
        $data = [
            'content' => $penarikan,
            'pages'   => 'penarikan'
        ];
        $dompdf->loadHtml(view('penarikan/view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("penarikan ID:".$id.".pdf");
    }

    public function indexPersonal($id = null)
    {
        helper('number');
        $model = new Penarikan();
        $content = $model->getPRbyID($id)->getResult();
        $data = [
            'content' => $content,
            'pages'   => 'My Penarikan',
            'user'    => $id,
        ];
        //dd($data);
        return view('penarikan/penarikan', $data);
    }
}
