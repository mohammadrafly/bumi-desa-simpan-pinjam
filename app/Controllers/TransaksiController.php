<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class TransaksiController extends BaseController
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $model = new User();
        $data = [
            'content' => $model->paginate(10, 'content'),
            'pages'   => 'Data Transaksi',
            'pager'  => $model->pager,
        ];
        //dd($data);
        return view('transaksi/index', $data);
    }
}
