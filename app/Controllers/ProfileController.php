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
        //dd($data);
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
            'foto_diri' => [
                'rules' => 'mime_in[foto_diri,image/jpg,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'mime_in'  => 'Maaf file yang anda upload memiliki format yang tidak diizinkan! silahkan upload dengan format JPG, JPEG, dan PNG.',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $img    = $this->request->getFile('foto_diri');
        $randName = $img->getRandomName();
        $nik = $this->request->getVar('nik');

        if ($img->isValid() && ! $img->hasMoved()) {
            $img->move('profile',$randName);
            $model = new User();
            $id = $this->request->getVar('id');
            $data = [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'alamat' => $this->request->getVar('alamat'),
                'foto_diri' => $randName,
            ];
            $model->update($id, $data);
            session()->setFlashData('success','Detail akun berhasil diupdate!');
            return $this->response->redirect(site_url('dashboard/profile/u/'.$nik));
        } else {
            $model = new User();
            $id = $this->request->getVar('id');
            $data = [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'alamat' => $this->request->getVar('alamat'),
            ];
            $model->update($id, $data);
            session()->setFlashData('success','Detail akun berhasil diupdate!');
            return $this->response->redirect(site_url('dashboard/profile/u/'.$nik));
        }
    }
}
