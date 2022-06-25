<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id_pembayaran';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_angsuran',
        'nominal',
        'biaya_admin',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPembayaran()
    {
        //ambil data dari table
        $query = $this->db->table('pembayaran')
            //join menggabungkan antara 2 table dengan foreign key
            ->join('angsuran', 'angsuran.id_angsuran = pembayaran.id_angsuran')
            //ambil data yang sudah di query
            ->get();
        return $query;
    }

    public function getPBbyID($id)
    {
        $query = $this->db->table('pembayaran')
            //set nama alias agar tidak terjadi koalisi/crash antar kolom
            ->select('pembayaran.*, angsuran.nominal AS nominal_angsuran')
            ->join('angsuran', 'angsuran.id_angsuran = pembayaran.id_angsuran', 'left')
            //ambil data sesuai parameter
            ->where('pembayaran.id_angsuran', $id)
            ->get();
        return $query;
    }

    public function getPembayaranLimit6()
    {
        $query = $this->db->table('pembayaran')
            ->join('angsuran', 'angsuran.id_angsuran = pembayaran.id_angsuran')
            //mengurutkan data sesuai parameter
            ->orderBy('created_at', 'DESC')
            //limit data sesuai parameter
            ->limit(6)
            ->get();
        return $query;
    }

    public function RangeDate($start, $end)
    {
        $query = $this->db->table('pembayaran')
                ->where('created_at BETWEEN "'. date('Y-m-d', strtotime($start)). '" AND "'. date('Y-m-d', strtotime($end)).'"')
                ->orderBy('created_at', 'DESC')
                ->get();
        return $query;
    }
}
