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
            ->join('users', 'users.nik = simpanan.nik')
            ->get();
        return $query;
    }

    public function getSbyID($id)
    {
        $query = $this->db->table('simpanan')
            ->join('users', 'users.nik = simpanan.nik', 'left')
            ->where('simpanan.nik', $id)
            ->get();
        return $query;
    }

    public function getSimpananLimit6()
    {
        $query = $this->db->table('simpanan')
            ->join('users', 'users.nik = simpanan.nik')
            ->orderBy('simpanan.created_at', 'DESC')
            ->limit(6)
            ->get();
        return $query;
    }

    function allSimpananByID()
    {
        $query = $this->db->table('simpanan')
                ->where(['id'=>session()->get('id')])
                ->countAllResults();
        return $query;
    }
}
