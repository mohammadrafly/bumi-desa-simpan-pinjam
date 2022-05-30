<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\User;

class PenggunaController extends BaseController
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $model = new User();
        $data = [
            'content' => $model->paginate(10, 'content'),
            'pages'   => 'Data Pengguna',
            'pengguna'  => $model->pager,
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
                'rules' => 'required|min_length[4]|max_length[20]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                ]
            ],
            'nik' => [
                'rules' => 'required|min_length[11]|max_length[35]|is_unique[users.nik]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 10 Karakter',
                    'max_length' => '{field} Maksimal 35 Karakter',
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
            'nik'   => $this->request->getVar('nik'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => $this->request->getVar('role'),
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
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $model = new User();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => $this->request->getVar('role'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','Pengguna telah diupdate!');
        return $this->response->redirect(site_url('dashboard/pengguna'));
    }

    public function delete($id = null)
    {
        $model = new User();
        $model->where('id', $id)->delete($id);
        session()->setFlashData('berhasil', 'Pengguna berhasil dihapus!');
        return $this->response->redirect(site_url('dashboard/pengguna'));
    }

    public function export()
    {
        $model = new User();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID Pengguna')
                    ->setCellValue('B1', 'Username')
                    ->setCellValue('C1', 'Nama')
                    ->setCellValue('E1', 'Role')
                    ->setCellValue('F1', 'Alamat')
                    ->setCellValue('G1', 'NIK')
                    ->setCellValue('H1', 'Join');
        
        $column = 2;
        // tulis data user ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id'])
                        ->setCellValue('B' . $column, $data['username'])
                        ->setCellValue('C' . $column, $data['name'])
                        ->setCellValue('E' . $column, $data['role'])
                        ->setCellValue('F' . $column, $data['alamat'])
                        ->setCellValue('G' . $column, $data['nik'])
                        ->setCellValue('H' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Pengguna';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
