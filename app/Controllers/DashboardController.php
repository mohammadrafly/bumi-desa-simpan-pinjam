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
    public function laporan()
    {
        $data = [
            'pages' => 'Laporan'
        ];
        return view('laporan/index', $data);
    }

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

        $usersSimpanan = $simpanan->select('MONTH(simpanan.created_at) AS time, COUNT(id_simpanan) AS total')
        ->join('users', 'users.nik = simpanan.nik')
        ->groupBy('MONTH(simpanan.created_at)')
        ->get();
        $usersPinjaman = $pinjaman->select('MONTH(pinjaman.created_at) AS waktu, COUNT(id_pinjaman) AS jumlah')
        ->join('users', 'users.nik = pinjaman.nik')
        ->groupBy('MONTH(pinjaman.created_at)')
        ->get();

        $data = [
            'pages' => 'Dashboard',
            'total_pinjaman' => $totalPinjaman,
            'total_simpanan' => $totalSimpanan,
            'total_angsuran' => $totalAngsuran,
            'total_pembayaran' => $totalPembayaran,
            'total_penarikan' => $totalPenarikan,
            'pinjaman' => $pinjaman->getPinjamanLimit6()->getResult(),
            'simpanan' => $simpanan->getSimpananLimit6()->getResult(),
            'grafikSimpanan' => $usersSimpanan,
            'grafikPinjaman' => $usersPinjaman,
        ];
        return view('dashboard/index', $data);
    }
}
