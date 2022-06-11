<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\User;

class AnggotaController extends BaseController
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $model = new User();
        $data = [
            'content' => $model->GetUserWithoutSU()->paginate(10, 'data'),
            'pages'   => 'Data Anggota',
            'pengguna'  => $model->pager,
        ];
        //dd($data);
        return view('anggota/index', $data);
    }
}
