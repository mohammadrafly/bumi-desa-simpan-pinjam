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
        'biaya_admin'
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
        $query = $this->db->table('pembayaran')
            ->join('angsuran', 'angsuran.id_angsuran = pembayaran.id_angsuran')
            ->get();
        return $query;
    }

    public function getPBbyID($id)
    {
        $query = $this->db->table('pembayaran')
            ->select('pembayaran.*, angsuran.nominal AS nominal_angsuran')
            ->join('angsuran', 'angsuran.id_angsuran = pembayaran.id_angsuran', 'left')
            ->where('pembayaran.id_angsuran', $id)
            ->get();
        return $query;
    }

    public function getPembayaranLimit6()
    {
        $query = $this->db->table('pembayaran')
            ->join('angsuran', 'angsuran.id_angsuran = pembayaran.id_angsuran')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();
        return $query;
    }
}
