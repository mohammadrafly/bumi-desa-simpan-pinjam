<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AnggotaController extends BaseController
{
    public function index()
    {   
        //$model untuk memanggil model User
        $model = new User();
        //data array//var content memanggil model user tanpa superuser//var pages berisi value Data Anggota
        $data = [
            'content' => $model->AmbilUserTanpaSuperUser()->getResult(),
            'pages'   => 'Data Anggota',
        ];
        return view('anggota/index', $data);
    }
}
