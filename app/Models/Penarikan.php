<?php

namespace App\Models;

use CodeIgniter\Model;

class Penarikan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penarikan';
    protected $primaryKey       = 'id_penarikan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_simpanan',
        'nominal',
        'kode_penarikan',
        'status_penarikan'
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

    public function getPenarikan()
    {
        $query = $this->db->table('penarikan')
            //menggabungkan/join antara 2 table
            ->join('simpanan', 'simpanan.id_simpanan = penarikan.id_simpanan')
            //ambil data yang sudah di query
            ->get();
        return $query;
    }

    public function getPRbyID($id)
    {
        $query = $this->db->table('penarikan')
            //set alias agar tidak terjadi koalisi/crash antar kolom
            ->select('penarikan.*, simpanan.nominal AS nominal_simpanan')
            ->join('simpanan', 'simpanan.id_simpanan = penarikan.id_simpanan', 'left')
            //ambil data sesuai parameter
            ->where('penarikan.id_simpanan', $id)
            ->get();
        return $query;
    }

    public function getPenarikanLimit6()
    {
        $query = $this->db->table('penarikan')
            ->join('simpanan', 'simpanan.id_simpanan = penarikan.id_simpanan')
            //mengurutkan data sesuai parameter
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        return $query;
    }

    function allPenarikanByID()
    {
        $query = $this->db->table('penarikan')
                ->where(['id'=>session()->get('id')])
                //hitung semua row di table
                ->countAllResults();
        return $query;
    }
}
