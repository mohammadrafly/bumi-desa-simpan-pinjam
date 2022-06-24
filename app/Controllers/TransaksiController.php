<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class TransaksiController extends BaseController
{
    public function index()
    {
        $model = new User();
        $data = [
            //ambil data tanpa superuser
            'content' => $model->AmbilUserTanpaSuperUser()->getResult(),
            'pages'   => 'Data Transaksi',
        ];
        //dd($data);
        return view('transaksi/index', $data);
    }
}
