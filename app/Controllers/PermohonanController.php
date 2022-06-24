<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permohonan;
use App\Models\Pinjaman;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PermohonanController extends BaseController
{
    public function index()
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = new Permohonan();
        $data = [
            'content' => $model->getPermohonan()->getResult(),
            'pages'   => 'Data Permohonan',
            'permohonan'  => $model->pager,
        ];
        //dd($data);
        return view('permohonan/index', $data);
    }

    public function add()
    {
        $user  = new User();      
        $data = [
            'pages' => 'Add permohonan',
            'content2'=> $user->getUser()->getResult(),
        ];
        //dd($data);
        return view('permohonan/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|min_length[11]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'judul_permohonan' => [
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
            'nominal_permohonan' => [
                'rules' => 'required',
                'error' => [
                    'required' => '{field} harus diisi',
                ],
            ],
            'jenis_permohonan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new Permohonan();
        $model->insert([
            'nik' => $this->request->getVar('nik'),
            'judul_permohonan' => $this->request->getVar('judul_permohonan'),
            'nominal_permohonan'   => $this->request->getVar('nominal_permohonan'),
            'jenis_permohonan' => $this->request->getVar('jenis_permohonan'),
            'status_permohonan' => 'MENUNGGU',
        ]);
        session()->setFlashData('success','Berhasil menambah permohonan');
        return redirect()->to('dashboard/permohonan');
    }

    public function edit($id = null)
    {
        helper('number');
        $model = new Permohonan();
        $data = [
            'data' => $model->where('id_permohonan', $id)->first(),
            'pages'=> 'Edit Permohonan',
        ];
        return view('permohonan/edit', $data);
    }

    public function update()
    {
        if (!$this->validate([
            'status_permohonan' => [
                'rules' => 'required',
                'error' => [
                    'required' => '{field} harus diisi',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $model = new Permohonan();
        $pinjaman = new Pinjaman();
        $id = $this->request->getVar('id_permohonan');
        $data = [
            'status_permohonan' => $this->request->getVar('status_permohonan'),
        ];
        $kode = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6);
        $data_pinjaman = [
            'nominal' => $this->request->getVar('nominal_permohonan'),
            'nik' => $this->request->getVar('nik'),
            'kode_penarikan' => $kode,
            'jenis_pinjaman' => 'BIASA',
            'status_pinjaman' => 'BELUM DIAMBIL'
        ];
        if ($data['status_permohonan'] === 'DITERIMA') {
            if ($model->update($id, $data)) {
                if ($pinjaman->insert($data_pinjaman)) {
                    session()->setFlashData('success','Berhasil update & menambahkan pinjaman!');
                    return redirect()->to('dashboard/permohonan');
                } else {
                    session()->setFlashData('error','Gagal update & menambahkan pinjaman!');
                    return redirect()->to('dashboard/permohonan');
                }
            } else {
                session()->setFlashData('error','Gagal update!');
                return redirect()->to('dashboard/permohonan');
            }
        } elseif ($model->update($id, $data)) {
            session()->setFlashData('success','Berhasil update data!');
            return redirect()->to('dashboard/permohonan');
        } else {
            session()->setFlashData('error','Gagal Mengambil Value DITERIMA!');
            return redirect()->to('dashboard/permohonan');
        }
        //dd($data_pinjaman);
    }

    public function delete($id = null)
    {
        $model = new Permohonan();
        $model->where('id_permohonan', $id)->delete($id);
        session()->setFlashData('berhasil', 'permohonan berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/permohonan'));
    }

    public function export()
    {
        $model = new Permohonan();
        $data = $model->getPermohonan()->getResult();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()
                    ->setFormatCode('#,##0.00');
        $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
        $spreadsheet->getActiveSheet()->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('B')->getNumberFormat()
                    ->setFormatCode('0000000000000000');
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Laporan Permohonan')
                    ->setCellValue('A2', 'ID Permohonan')
                    ->setCellValue('B2', 'NIK')
                    ->setCellValue('C2', 'Nama')
                    ->setCellValue('D2', 'Judul')
                    ->setCellValue('E2', 'Jenis')
                    ->setCellValue('F2', 'Nominal')
                    ->setCellValue('G2', 'Status')
                    ->setCellValue('H2', 'Dibuat');
        $column = 3;
        // tulis data angsuran ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $data->id_permohonan)
                    ->setCellValue('B' . $column, $data->nik)
                    ->setCellValue('C' . $column, $data->name)
                    ->setCellValue('D' . $column, $data->judul_permohonan)
                    ->setCellValue('E' . $column, $data->jenis_permohonan)
                    ->setCellValue('F' . $column, $data->nominal_permohonan)
                    ->setCellValue('G' . $column, $data->status_permohonan)
                    ->setCellValue('H' . $column, $data->created_at);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Permohonan_'.date('Y-m-d');

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function indexPersonal($id = null)
    {
        helper('number');
        $model = new Permohonan();
        $content = $model->getPHbyID($id)->getResult();
        $data = [
            'content' => $content,
            'pages'   => 'My Permohonan',
            'user'    => $id,
        ];
        //dd($data);
        return view('permohonan/permohonan', $data);
    }

    public function addPersonal($id = null)
    {
        $user  = new User();      
        $data = [
            'pages' => 'Add permohonan',
            'id'    => $id,
            'content'=> $user->where('nik', $id)->first(),
        ];
        //($data);
        return view('permohonan/add-personal', $data);
    }

    public function storePersonal($id = null)
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'judul_permohonan' => [
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
            'nominal_permohonan' => [
                'rules' => 'required',
                'error' => [
                    'required' => '{field} harus diisi',
                ],
            ],
            'jenis_permohonan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new Permohonan();
        $model->insert([
            'nik' => $this->request->getVar('nik'),
            'judul_permohonan' => $this->request->getVar('judul_permohonan'),
            'nominal_permohonan'   => $this->request->getVar('nominal_permohonan'),
            'jenis_permohonan' => $this->request->getVar('jenis_permohonan'),
            'status_permohonan' => 'MENUNGGU',
        ]);
        session()->setFlashData('success','Berhasil menambah permohonan');
        return redirect()->to('dashboard/my/permohonan/u/'.$id);
    }
}
