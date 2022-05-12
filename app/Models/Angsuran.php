<?php

namespace App\Models;

use CodeIgniter\Model;

class Angsuran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'angsuran';
    protected $primaryKey       = 'id_angsuran';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nominal',
        'waktu',
        'status_angsuran',
        'kode_pembayaran',
        'nik'
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

    public function getAngsuran()
    {
        $query = $this->db->table('angsuran')
            ->join('users', 'users.nik = angsuran.nik')
            ->get();
        return $query;
    }

    public function getASbyID($id)
    {
        $query = $this->db->table('angsuran')
            ->join('users', 'users.nik = angsuran.nik', 'left')
            ->where('angsuran.nik', $id)
            ->get();
        return $query;
    }

    public function getAngsuranLimit6()
    {
        $query = $this->db->table('angsuran')
            ->join('users', 'users.nik = angsuran.nik')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        return $query;
    }

    function allAngsuranByID()
    {
        $query = $this->db->table('angsuran')
                ->where(['id'=>session()->get('id')])
                ->countAllResults();
        return $query;
    }
}
