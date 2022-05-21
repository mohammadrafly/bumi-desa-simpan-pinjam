<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Angsuran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AngsuranController extends BaseController
{
    public function index($id = null)
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new Angsuran();
        $content = $model->getASbyID($id)->getResult();
        $data = [
            'content'   => $content,
            'pages'     => 'Data angsuran',
            'pager'     => $model->pager,
            'user'      => $id
        ];
        //dd($content);
        return view('angsuran/index', $data);
    }

    public function add($id = null)
    {
        $data = [
            'pages' => 'Add angsuran',
            'nik'   => $id
        ];
        return view('angsuran/add', $data);
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
            'waktu' => [
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
        $model = new Angsuran();
        $model->insert([
            'nik'   => $this->request->getVar('nik'),
            'nominal' => $this->request->getVar('nominal'),
            'waktu' => $this->request->getVar('waktu'),
            'status_angsuran' => 'BELUM LUNAS',
            'kode_pembayaran' => $kode
        ]);
        session()->setFlashData('message','Berhasil menambah angsuran');
        return redirect()->to('dashboard/transaksi');
    }

    public function edit($id = null)
    {
        $model = new Angsuran();
        $data = [
            'data' => $model->where('id_angsuran', $id)->first(),
            'pages'=> 'Edit angsuran',
        ];
        return view('angsuran/edit', $data);
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
        $model = new Angsuran();
        $id = $this->request->getVar('id_angsuran');
        $data = [
            'nominal' => $this->request->getVar('nominal'),
            'waktu' => $this->request->getVar('waktu'),
            'status_angsuran' => $this->request->getVar('status_angsuran'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','angsuran telah diupdate!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function delete($id = null)
    {
        $model = new Angsuran();
        $model->where('id_angsuran', $id)->delete();
        session()->setFlashData('berhasil', 'angsuran berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi'));
    }

    public function export()
    {
        $model = new Angsuran();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID angsuran')
                    ->setCellValue('C1', 'Waktu')
                    ->setCellValue('D1', 'Status Angsuran')
                    ->setCellValue('E1', 'Nominal')
                    ->setCellValue('F1', 'NIK')
                    ->setCellValue('G1', 'Kode Pembayaran')
                    ->setCellValue('H1', 'Dibuat');
        
        $column = 2;
        // tulis data angsuran ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id_angsuran'])
                        ->setCellValue('C' . $column, $data['waktu'])
                        ->setCellValue('D' . $column, $data['status_angsuran'])
                        ->setCellValue('E' . $column, $data['nominal'])
                        ->setCellValue('F' . $column, $data['nik'])
                        ->setCellValue('G' . $column, $data['kode_pembayaran'])
                        ->setCellValue('H' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap angsuran';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function view($id = null)
    {
        helper('number');
        $model = new Angsuran();
        $content = $model->where('id_angsuran', $id)->first();
        $data = [
            'content' => $content,
            'pages'   => 'angsuran'
        ];
        //print_r($simpan);
        return view('angsuran/view', $data);
    }

    public function pdf($id = null)
    {
        helper('number');
        $dompdf = new \Dompdf\Dompdf();
        $model = new Angsuran();
        $angsuran = $model->where('id_angsuran', $id)->first();
        $data = [
            'content' => $angsuran,
            'pages'   => 'angsuran'
        ];
        $dompdf->loadHtml(view('angsuran/view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("angsuran ID:".$id.".pdf");
    }

    public function indexPersonal($id = null)
    {
        helper('number');
        $model = new Angsuran();
        $content = $model->getASbyID($id)->getResult();
        $data = [
            'content' => $content,
            'pages'   => 'My Angsuran',
            'user'    => $id,
        ];
        //dd($data);
        return view('angsuran/angsuran', $data);
    }
}
