<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Angsuran;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AngsuranController extends BaseController
{   

    public function index($id = null)
    {
        //helper angka untuk convert angka ke format tertentu
        helper('number');
        $model = new Angsuran();
        $users = new User();
        //ambil angsuran by id
        $content = $model->getASbyID($id)->getResult();
        $data = [
            'content'   => $content,
            'pages'     => 'Data angsuran',
            'user'      => $users->where('nik', $id)->first(),
        ];
        //dd($content);
        return view('angsuran/index', $data);
    }

    //tambah sesuai nik
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
        //validasi inputan
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
        //generate 6 huruf acak
        $kode = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6);
        $model = new Angsuran();
        $nik = $this->request->getVar('nik');
        //insert data ke db
        $model->insert([
            'nik'   => $this->request->getVar('nik'),
            'nominal' => $this->request->getVar('nominal'),
            'waktu' => $this->request->getVar('waktu'),
            'status_angsuran' => 'BELUM LUNAS',
            'kode_pembayaran' => $kode
        ]);
        session()->setFlashData('message','Berhasil menambah angsuran');
        return redirect()->to('dashboard/transaksi/angsuran/pengguna/'.$nik);
    }

    public function edit($id, $nik)
    {
        $model = new Angsuran();
        $data = [
            'data' => $model->where('id_angsuran', $id)->first(),
            'pages'=> 'Edit angsuran',
            'nik'  => $nik,
        ];
        //dd($data);
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
        $nik = $this->request->getVar('nik');
        $data = [
            'nominal' => $this->request->getVar('nominal'),
            'waktu' => $this->request->getVar('waktu'),
            'status_angsuran' => $this->request->getVar('status_angsuran'),
        ];
        //update
        $model->update($id, $data);
        session()->setFlashData('berhasil','angsuran telah diupdate!');
        return redirect()->to('dashboard/transaksi/angsuran/pengguna/'.$nik);
    }

    public function delete($id, $nik)
    {
        $model = new Angsuran();
        $model->where('id_angsuran', $id)->delete();
        session()->setFlashData('berhasil', 'angsuran berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/transaksi/angsuran/pengguna/'.$nik));
    }

    public function export()
    {
        $model = new Angsuran();
        //ambil semua data
        $data = $model->getAngsuran()->getResult();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()
                    ->setFormatCode('#,##0.00');
        $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
        $spreadsheet->getActiveSheet()->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('E')->getNumberFormat()
                    ->setFormatCode('0000000000000000');
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Laporan Angsuran')
                    ->setCellValue('A2', 'ID Angsuran')
                    ->setCellValue('B2', 'Nama')
                    ->setCellValue('C2', 'Status')
                    ->setCellValue('D2', 'Nominal')
                    ->setCellValue('E2', 'NIK')
                    ->setCellValue('F2', 'Kode Angsuran')
                    ->setCellValue('G2', 'Waktu')
                    ->setCellValue('H2', 'Dibuat');
        $column = 3;
        // tulis data angsuran ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data->id_angsuran)
                        ->setCellValue('B' . $column, $data->name)
                        ->setCellValue('C' . $column, $data->status_angsuran)
                        ->setCellValue('D' . $column, $data->nominal)
                        ->setCellValue('E' . $column, $data->nik)
                        ->setCellValue('F' . $column, $data->kode_pembayaran)
                        ->setCellValue('G' . $column, $data->waktu)
                        ->setCellValue('H' . $column, $data->created_at);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap angsuran_'.date('Y-m-d');

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
        //library dompdf
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

    //sesuai nik anggota
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
