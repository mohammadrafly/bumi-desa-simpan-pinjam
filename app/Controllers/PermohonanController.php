<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permohonan;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PermohonanController extends BaseController
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $model = new Permohonan();
        $data = [
            'content' => $model->orderBY('created_at', 'DESC')->paginate(10, 'content'),
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
            'statu_permohonan' => 'HOLD',
        ]);
        session()->setFlashData('message','Berhasil menambah permohonan');
        return redirect()->to('dashboard/permohonan');
    }

    public function edit($id = null)
    {
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
        $id = $this->request->getVar('id_permohonan');
        $data = [
            'status_permohonan' => $this->request->getVar('status_permohonan'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','permohonan telah diupdate!');
        return $this->response->redirect(site_url('dashboard/permohonan'));
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
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'NIK')
                    ->setCellValue('C1', 'Judul')
                    ->setCellValue('D1', 'Nominal')
                    ->setCellValue('E1', 'Jenis')
                    ->setCellValue('F1', 'Status')
                    ->setCellValue('G1', 'Dibuat');
        
        $column = 2;
        // tulis data pinjaman ke cell
        foreach($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['id_permohonan'])
                        ->setCellValue('B' . $column, $data['nik'])
                        ->setCellValue('C' . $column, $data['judul_permohonan'])
                        ->setCellValue('D' . $column, $data['nominal_permohonan'])
                        ->setCellValue('E' . $column, $data['jenis_permohonan'])
                        ->setCellValue('F' . $column, $data['status_permohonan'])
                        ->setCellValue('G' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Permohonan';

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
            'statu_permohonan' => 'HOLD',
        ]);
        session()->setFlashData('message','Berhasil menambah permohonan');
        return redirect()->to('dashboard/my/permohonan/u/'.$id);
    }
}
