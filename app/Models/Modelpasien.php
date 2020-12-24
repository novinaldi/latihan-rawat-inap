<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpasien extends Model
{
    protected $table      = 'pasien';
    protected $primaryKey = 'pasienno';
    protected $allowedFields = ['pasienno', 'pasiennoktp', 'pasiennama', 'pasienalamat', 'pasientmplahir', 'pasientgllahir', 'pasienjk', 'pasientelp'];

    public function caridata($cari = '')
    {
        return $this->table('pasien')->like('pasienno', $cari)->orLike('pasiennama', $cari);
    }
}