<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpenyakit extends Model
{
    protected $table      = 'penyakit';
    protected $primaryKey = 'penyakitid';

    protected $allowedFields = ['penyakitnm'];

    public function caridata($cari = '')
    {
        return $this->table('penyakit')->like('penyakitnm', $cari);
    }
}