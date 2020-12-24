<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelanggota extends Model
{
    protected $table      = 'anggota';
    protected $primaryKey = 'anggotakode';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['anggotakode', 'anggotanama', 'anggotajk', 'anggotatelp', 'anggotaalamat'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function caridata($cari = '')
    {
    return $this->table('anggota')->like('anggotakode', $cari)->orLike('anggotanama', $cari);
    }
}