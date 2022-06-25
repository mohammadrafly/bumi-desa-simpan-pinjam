<?php

namespace App\Models;

use CodeIgniter\Model;

class Simpanan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'simpanan';
    protected $primaryKey       = 'id_simpanan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nik',
        'nominal',
        'kode_deposit',
        'jenis_simpanan',
        'status_simpanan',
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

    public function getSimpanan()
    {
        $query = $this->db->table('simpanan')
            //menggabugkan antar 2 table
            ->join('users', 'users.nik = simpanan.nik')
            //mengurutkan data sesuai parameter
            ->orderBy('created_at', 'DESC')
            ->get();
        return $query;
    }

    public function getSbyID($id)
    {
        $query = $this->db->table('simpanan')
            ->join('users', 'users.nik = simpanan.nik', 'left')
            //ambil data sesuai parameter
            ->where('simpanan.nik', $id)
            ->get();
        return $query;
    }

    public function getSimpananLimit6()
    {
        $query = $this->db->table('simpanan')
            ->join('users', 'users.nik = simpanan.nik')
            ->orderBy('simpanan.created_at', 'DESC')
            //limit data sesuai parameter
            ->limit(10)
            ->get();
        return $query;
    }

    public function allSimpananByID()
    {
        $query = $this->db->table('simpanan')
                ->where(['nik' => session()->get('nik')])
                //hitung semua row
                ->countAllResults();
        return $query;
    }

    public function RangeDate($start, $end)
    {
        $query = $this->db->table('simpanan')
                ->join('users', 'users.nik = simpanan.nik', 'left')
                ->where('created_at BETWEEN "'. date('Y-m-d', strtotime($start)). '" AND "'. date('Y-m-d', strtotime($end)).'"')
                ->orderBy('created_at', 'DESC')
                ->get();
        return $query;
    }
}
