<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelanggota extends Model
{
    protected $table      = 'anggota';
    protected $primaryKey = 'anggotakode';

    protected $allowedFields = ['anggotakode', 'anggotanama', 'anggotajk', 'anggotatelp', 'anggotaalamat'];

    public function caridata($cari = '')
    {
        return $this->table('anggota')->like('anggotakode', $cari)->orLike('anggotanama', $cari);
    }
}