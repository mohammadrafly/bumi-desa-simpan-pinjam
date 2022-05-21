<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class ProfileController extends BaseController
{
    public function index($id = null)
    {
        $model = new User();
        $data = [
            'content' => $model->where('nik', $id)->first(),
            'pages'   => 'Edit Profile',
        ];
        return view('profile/index', $data);
    }

    public function faq()
    {
        $data = [
            'pages'   => 'FAQ'
        ];
        return view('profile/faq', $data);
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
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $model = new User();
        $id = $this->request->getVar('id');
        $nik = $this->request->getVar('nik');
        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'alamat' => $this->request->getVar('alamat'),
        ];
        $model->update($id, $data);
        session()->setFlashData('berhasil','Pengguna telah diupdate!');
        return $this->response->redirect(site_url('dashboard/profile/u/'.$nik));
    }
}
