<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkamar extends Model
{
    protected $table      = 'kamar';
    protected $primaryKey = 'kamarkode';

    protected $allowedFields = ['kamarkode', 'kamarnm'];

    public function caridata($cari = '')
    {
        return $this->table('kamar')->like('kamarkode', $cari)->orLike('kamarnm', $cari);
    }
}