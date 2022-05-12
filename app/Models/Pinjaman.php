<?php

namespace App\Models;

use CodeIgniter\Model;

class Pinjaman extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pinjaman';
    protected $primaryKey       = 'id_pinjaman';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nik',
        'nominal',
        'biaya_admin',
        'jenis_pinjaman',
        'status_pinjaman',
        'kode_penarikan'
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

    public function getPinjaman()
    {
        $query = $this->db->table('pinjaman')
            ->join('users', 'users.nik = pinjaman.nik')
            ->get();
        return $query;
    }

    public function getPbyID($id)
    {
        $query = $this->db->table('pinjaman')
            ->join('users', 'users.nik = pinjaman.nik', 'left')
            ->where('pinjaman.nik', $id)
            ->get();
        return $query;
    }

    public function getPinjamanLimit6()
    {
        $query = $this->db->table('pinjaman')
            ->join('users', 'users.nik = pinjaman.nik')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        return $query;
    }

    function allPinjamanByID()
    {
        $query = $this->db->table('pinjaman')
                ->where(['id'=>session()->get('id')])
                ->countAllResults();
        return $query;
    }
}
