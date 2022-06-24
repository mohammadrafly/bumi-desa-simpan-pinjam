<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    //view login
    public function index()
    {
        $data = [
            'Login' => TRUE,
            'pages' => 'Masuk'
        ];
        return view('auth/login', $data);
    }

    //view register
    public function register()
    {
        $data = [
            'Login' => FALSE,
            'pages' => 'Daftar'
        ];
        return view('auth/register' ,$data);
    }

    //register
    public function store()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[15]|is_unique[users.username]',
                'errors' => [
                    'required' => 'username harus diisi',
                    'min_length' => 'username minimal 4 Karakter',
                    'max_length' => 'username maksimal 15 Karakter',
                    'is_unique' => 'username sudah digunakan'
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 4 Karakter',
                    'max_length' => '{field} maksimal 50 Karakter',
                ]
            ],
            'nik' => [
                'rules' => 'required|min_length[16]|max_length[16]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 16 Karakter',
                    'max_length' => '{field} maksimal 16 Karakter',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[50]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 Karakter',
                    'max_length' => 'Password maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sesuai dengan password di atas',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $model = new User();
        $data = [
            'username'  => $this->request->getVar('username'),
            'name'      => $this->request->getVar('name'),
            'nik'       => $this->request->getVar('nik'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role'      => 'customer',
        ];
        if ($model->save($data)) {
            session()->setFlashdata('success', 'Anda telah berhasil daftar silahkan login.');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('error', 'Terjadi Error!');
            return redirect()->to('register');
        }
    } 

    //login user
    public function login()
    {
        $model = new User();
        //ambil data input
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        //cari username ada tau tidak
        $dataUser = $model->where([
            'username' => $username,
        ])->first();
        //statement jika $dataUser = TRUE
        if ($dataUser) {
            //verifikasi password benar atau tidak
            if (password_verify($password, $dataUser['password'])) {
                //set data untuk menampilkan data sesuai user login
                session()->set([
                    'username'  => $dataUser['username'],
                    'password'  => $dataUser['password'],
                    'id'        => $dataUser['id'],
                    'name'      => $dataUser['name'],
                    'nik'       => $dataUser['nik'],
                    'created'   => $dataUser['created'],
                    'foto_diri' => $dataUser['foto_diri'],
                    'WesLogin'  => TRUE,
                    'role'      => $dataUser['role'],
                ]);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->to('/');
            }
        //statement jika $dataUser = FALSE
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        //hapus session 
        session()->destroy();
        return redirect()->to('/');
    }
}
