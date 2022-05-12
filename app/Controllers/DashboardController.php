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
    public function index()
    {
        helper('number');
        $permohonan = new Permohonan();
        $simpanan = new Simpanan();
        $pinjaman = new Pinjaman();
        $angsuran = new Angsuran();
        $pembayaran = new Pembayaran();
        $penarikan = new Penarikan();
        /*$usersSimpanan = $simpanan->select('MONTH(created_at) AS time, COUNT(id_simpanan) AS total')
        ->groupBy('MONTH(created_at)')
        ->get();
        $usersPinjaman = $pinjaman->select('MONTH(created_at) AS waktu, COUNT(id_pinjaman) AS jumlah')
        ->groupBy('MONTH(created_at)')
        ->get();
        $usersByRole = $user->select('role AS roles, COUNT(id) AS ids')
        ->groupBy('role')
        ->get();
        $data = $permohonan->getPermohonan()->getResult();
        */
        //sum
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
        ];
        return view('dashboard/index', $data);
    }
}
