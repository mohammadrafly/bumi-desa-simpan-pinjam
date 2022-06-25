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
        //ambil table
        $query = $this->db->table('angsuran')
            //join antara table menggunakan foreign key
            ->join('users', 'users.nik = angsuran.nik')
            //mengurutkan data sesuai parameter
            ->orderBy('created_at', 'DESC')
            //ambil data yang sudah di query
            ->get();
        return $query;
    }

    public function getASbyID($id)
    {
        $query = $this->db->table('angsuran')
            ->join('users', 'users.nik = angsuran.nik', 'left')
            //mencari sesuai parameter
            ->where('angsuran.nik', $id)
            ->get();
        return $query;
    }

    public function getAngsuranLimit6()
    {
        $query = $this->db->table('angsuran')
            ->join('users', 'users.nik = angsuran.nik')
            ->orderBy('created_at', 'DESC')
            //limit data sesuai parameter
            ->limit(6)
            ->get();
        return $query;
    }

    function allAngsuranByID()
    {
        $query = $this->db->table('angsuran')
                //ambil data sesuai parameter
                ->where(['nik' => session()->get('nik')])
                //menghitung semua data yang ada di table
                ->countAllResults();
        return $query;
    }

    public function RangeDate($start, $end)
    {
        $query = $this->db->table('angsuran')
                ->join('users', 'users.nik = angsuran.nik', 'left')
                ->where('created_at BETWEEN "'. date('Y-m-d', strtotime($start)). '" AND "'. date('Y-m-d', strtotime($end)).'"')
                ->orderBy('created_at', 'DESC')
                ->get();
        return $query;
    }
}
