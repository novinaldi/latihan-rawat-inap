<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        echo 'Ini adalah controller coba method index';
    }

    public function biodata($nama = '', $umur = 0)
    {
        echo "Halo nama saya $nama, saya sudah berumur $umur";
    }

    //--------------------------------------------------------------------

}