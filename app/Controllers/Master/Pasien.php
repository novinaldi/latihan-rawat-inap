<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Pasien extends BaseController
{
    public function index()
    {
        $tombolcari = $this->request->getVar('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getVar('cari');
            session()->set('caripasien', $cari);

            return redirect()->to('/pasien/index');
        } else {
            $cari = session()->get('caripasien');
        }

        if ($cari) {
            $datapasien = $this->pasien->caridata($cari);
        } else {
            $datapasien = $this->pasien;
        }

        $nohalaman = $this->request->getVar('page_pasien') ? $this->request->getVar('page_pasien') : 1;

        $data = [
            'datapasien' => $datapasien->paginate(10, 'pasien'),
            'pager' => $this->pasien->pager,
            'nohalaman' => $nohalaman,
        ];

        return view('pasien/viewdata', $data);
    }

    public function hapus($kode)
    {
        $this->pasien->delete($kode);
        return redirect()->to('/pasien/index');
    }

    public function tambah()
    {
        return view('pasien/formtambah');
    }

    public function simpan()
    {
        $nopasien = $this->request->getVar('nopasien');
        $namapasien = $this->request->getVar('namapasien');
        $nik = $this->request->getVar('nik');
        $tmplahir = $this->request->getVar('tmplahir');
        $tgllahir = $this->request->getVar('tgllahir');
        $jenkel = $this->request->getVar('jenkel');
        $telp = $this->request->getVar('telp');
        $alamat = $this->request->getVar('alamat');

        $valid = $this->validate([
            'nopasien' => [
                'rules' => 'required|is_unique[pasien.pasienno]',
                'label' => 'No.Pasien',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar, silahkan coba nomor yang lain'
                ]
            ],
            'nik' => [
                'rules' => 'required|is_unique[pasien.pasiennoktp]',
                'label' => 'No.KTP Pasien',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar, silahkan coba nomor yang lain'
                ]
            ],
            'namapasien' => [
                'rules' => 'required',
                'label' => 'Nama Pasien',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'jenkel' => [
                'rules' => 'required',
                'label' => 'Jenis Kelamin',
                'errors' => [
                    'required' => '{field} wajib dipilih',
                ]
            ],
            'telp' => [
                'rules' => 'required|numeric',
                'label' => 'Nomor Telp atau HP',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus dalam bentuk angka'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'label' => 'Alamat',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'tmplahir' => [
                'rules' => 'required',
                'label' => 'Tempat Lahir',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'tgllahir' => [
                'rules' => 'required',
                'label' => 'Tgl.Lahir',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ]);


        if (!$valid) {
            return view('pasien/formtambah', [
                'validation' => $this->validator
            ]);
        } else {
            $this->pasien->insert([
                'pasienno' => $nopasien,
                'pasiennama' => $namapasien,
                'pasiennoktp' => $nik,
                'pasientmplahir' => $tmplahir,
                'pasientgllahir' => $tgllahir,
                'pasienalamat' => $alamat,
                'pasienjk' => $jenkel,
                'pasientelp' => $telp
            ]);

            return redirect()->to('/pasien/index');
        }
    }

    public function edit($nopasien)
    {
        $data = [
            'row' => $this->pasien->find($nopasien)
        ];
        return view('pasien/formedit', $data);
    }

    public function update()
    {
        $nopasien = $this->request->getVar('nopasien');
        $namapasien = $this->request->getVar('namapasien');
        $nik = $this->request->getVar('nik');
        $tmplahir = $this->request->getVar('tmplahir');
        $tgllahir = $this->request->getVar('tgllahir');
        $jenkel = $this->request->getVar('jenkel');
        $telp = $this->request->getVar('telp');
        $alamat = $this->request->getVar('alamat');

        $this->pasien->update($nopasien, [
            'pasiennama' => $namapasien,
            'pasiennoktp' => $nik,
            'pasientmplahir' => $tmplahir,
            'pasientgllahir' => $tgllahir,
            'pasienalamat' => $alamat,
            'pasienjk' => $jenkel,
            'pasientelp' => $telp
        ]);

        return redirect()->to('/pasien/index');
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $nopasien = $this->request->getVar('nopasien');
            $data = [
                'row' => $this->pasien->find($nopasien)
            ];
            $msg = [
                'data' => view('pasien/detaildata', $data)
            ];
            echo json_encode($msg);
        }
    }
}