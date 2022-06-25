<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\User;
use App\Models\Simpanan;
use App\Models\Permohonan;
use App\Models\Angsuran;
use App\Models\Penarikan;
use App\Models\Pinjaman;
use App\Models\Pembayaran;

class PenggunaController extends BaseController
{
    public function index()
    {
        $model = new User();
        $data = [
            'content' => $model->getUser()->getResult(),
            'pages'   => 'Data Pengguna',
        ];
        //dd($data);
        return view('pengguna/index', $data);
    }

    public function add()
    {
        $data = [
            'pages' => 'Add Pengguna',
        ];
        return view('pengguna/add', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[4]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'nik' => [
                'rules' => 'required|min_length[16]|max_length[16]|is_unique[users.nik]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 16 Karakter',
                    'max_length' => '{field} Maksimal 16 Karakter',
                    'is_unique' => '{field} NIK sudah terpakai'
                ]
            ],
            'phone' => [
                'rules' => 'required|min_length[11]|max_length[13]|is_unique[users.phone]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 11 Karakter',
                    'max_length' => '{field} Maksimal 13 Karakter',
                    'is_unique' => '{field} Sudah dipakai!'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[35]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 35 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new User();
        $model->insert([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'phone' => $this->request->getVar('phone'),
            'gender' => $this->request->getVar('gender'),
            'nik'   => $this->request->getVar('nik'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => 'customer',
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);
        session()->setFlashData('message','Berhasil menambah Pengguna');
        return redirect()->to('dashboard/pengguna');
    }

    public function edit($id = null)
    {
        $model = new User();
        $data = [
            'data' => $model->where('id', $id)->first(),
            'pages'=> 'Edit Pengguna',
        ];
        return view('pengguna/edit', $data);
    }

    public function update()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|min_length[4]|max_length[20]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 255 Karakter',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'error' => [
                    'required' => 'Role harus diisi',
                ],
            ],
            'phone' => [
                'rules' => 'min_length[11]|max_length[13]',
                'errors' => [
                    'min_length' => '{field} Minimal 11 Karakter',
                    'max_length' => '{field} Maksimal 13 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $model = new User();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'phone' => $this->request->getVar('phone'),
            'alamat' => $this->request->getVar('alamat'),
            'gender' => $this->request->getVar('gender'),
            'role' => $this->request->getVar('role'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','Pengguna telah diupdate!');
        return $this->response->redirect(site_url('dashboard/pengguna'));
    }

    public function delete($id)
    {
        $user = new User();
        $user->where('id', $id)->delete($id);
        session()->setFlashData('berhasil', 'Pengguna berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/pengguna'));
    }

    public function export()
    {
        $model = new User();
        $start = $this->request->getVar('tgl_mulai');
        $end = $this->request->getVar('tgl_akhir');
        $data = $model->RangeDate($start, $end)->getResult();
        //dd($data);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
        $spreadsheet->getActiveSheet()->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('F')->getNumberFormat()
                    ->setFormatCode('0000000000000000');
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Laporan Pengguna')
                    ->setCellValue('A2', 'ID Pengguna')
                    ->setCellValue('B2', 'Username')
                    ->setCellValue('C2', 'Nama')
                    ->setCellValue('D2', 'Role')
                    ->setCellValue('E2', 'Alamat')
                    ->setCellValue('F2', 'NIK')
                    ->setCellValue('G2', 'Join');
        $column = 3;
        // tulis data angsuran ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $column, $data->id)
                    ->setCellValue('B' . $column, $data->username)
                    ->setCellValue('C' . $column, $data->name)
                    ->setCellValue('D' . $column, $data->role)
                    ->setCellValue('E' . $column, $data->alamat)
                    ->setCellValue('F' . $column, $data->nik)
                    ->setCellValue('G' . $column, $data->created);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Pengguna_'.$start.'_-_'.$end;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    //ambil password sesuai id
    public function gantiPassword($id = null)
    {
        $model = new User();
        $data = [
            'data' => $model->where('id', $id)->first(),
            'pages' => 'Ganti Password'
        ];
        //dd($data);
        return view('pengguna/password', $data);
    }

    public function updatePassword()
    {
        if (!$this->validate([
            'password' => [
                'rules' => 'required|min_length[6]|max_length[50]|is_unique[users.password]',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                    'min_length' => 'Password minimal 6 Karakter',
                    'max_length' => 'Password maksimal 50 Karakter',
                    'is_unique' => 'Anda sudah menggunakan sandi ini baru-baru ini. Pilih yang lain.',
                ]
            ],
            'conf_password' => [
                'rules' => 'matches[password]|required',
                'errors' => [
                    'required' => 'Konfirmasi password baru harus diisi',
                    'matches' => 'Konfirmasi password tidak sesuai dengan password di atas',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new User();
        $id = $this->request->getVar('id');
        $data = [
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','Pengguna telah diupdate!');
        return $this->response->redirect(site_url('dashboard/pengguna'));
    }

    public function laporanIndex()
    {
        $data = [
            'pages'   => 'Laporan Pengguna',
        ];
        //dd($data);
        return view('pengguna/laporan', $data);
    }
}
