<?php

namespace App\Models;

use CodeIgniter\Model;

class permohonan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'permohonan';
    protected $primaryKey       = 'id_permohonan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nik',
        'judul_permohonan',
        'nominal_permohonan',
        'jenis_permohonan',
        'status_permohonan',
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

    public function getPermohonan()
    {
        $query = $this->db->table('permohonan')
            ->join('users', 'users.nik = permohonan.nik')
            ->get();
        return $query;
    }

    public function getPHbyID($id)
    {
        $query = $this->db->table('permohonan')
            ->join('users', 'users.nik = permohonan.nik', 'left')
            ->where('permohonan.nik', $id)
            ->get();
        return $query;
    }

    public function getPermohonanLimit6()
    {
        $query = $this->db->table('permohonan')
            ->join('users', 'users.nik = permohonan.nik')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        return $query;
    }

    function allPermohonanByID()
    {
        $query = $this->db->table('permohonan')
                ->where(['id'=>session()->get('id')])
                ->countAllResults();
        return $query;
    }
}
