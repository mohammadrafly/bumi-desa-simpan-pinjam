<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permohonan;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use App\Models\Pembayaran;
use App\Models\Penarikan;

class DashboardController extends BaseController
{
    //tampil view laporan
    public function laporan()
    {
        $data = [
            'pages' => 'Laporan'
        ];
        return view('laporan/index', $data);
    }

    //dashboard
    public function index()
    {
        helper('number');
        $permohonan = new Permohonan();
        $simpanan = new Simpanan();
        $pinjaman = new Pinjaman();
        $angsuran = new Angsuran();
        $pembayaran = new Pembayaran();
        $penarikan = new Penarikan();

        //mengtotal semua nominal di table tertentu
		$resultPinjaman = $pinjaman->select('sum(nominal) as sumQuantities')->first();
		$totalPinjaman = $resultPinjaman['sumQuantities'];

        $resultSimpanan = $simpanan->select('sum(nominal) as sumQuantities')->first();
		$totalSimpanan = $resultSimpanan['sumQuantities'];

        $resultAngsuran = $angsuran->select('sum(nominal) as sumQuantities')->first();
        $totalAngsuran = $resultAngsuran['sumQuantities'];

        $resultPembayaran = $pembayaran->select('sum(nominal) as sumQuantities')->first();
        $totalPembayaran = $resultPembayaran['sumQuantities'];

        $resultPenarikan = $penarikan->select('sum(nominal) as sumQuantities')->first();
        $totalPenarikan = $resultPenarikan['sumQuantities'];

        $data = [
            'pages' => 'Dashboard',
            'total_pinjaman' => $totalPinjaman,
            'total_simpanan' => $totalSimpanan,
            'total_angsuran' => $totalAngsuran,
            'total_pembayaran' => $totalPembayaran,
            'total_penarikan' => $totalPenarikan,
            //limit tampil data
            'pinjaman' => $pinjaman->getPinjamanLimit6()->getResult(),
            'simpanan' => $simpanan->getSimpananLimit6()->getResult(),
        ];
        return view('dashboard/index', $data);
    }
}
