<?php

namespace App\Controllers;

use App\Models\Modelanggota;

class Anggota extends BaseController
{
    public function index()
    {
        $tombolcari = $this->request->getVar('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getVar('cari');
            session()->set('carianggota', $cari);

            return redirect()->to('/anggota/index');
        } else {
            $cari = session()->get('carianggota');
        }

        if ($cari) {
            $dataanggota = $this->anggota->caridata($cari);
        } else {
            $dataanggota = $this->anggota;
        }

        $nohalaman = $this->request->getVar('page_anggota') ? $this->request->getVar('page_anggota') : 1;

        $data = [
            'dataanggota' => $dataanggota->paginate(10, 'anggota'),
            'pager' => $this->anggota->pager,
            'nohalaman' => $nohalaman,
        ];

        return view('anggota/viewdata', $data);
    }

    function destroy()
    {
        session()->destroy();
    }

    public function tambah()
    {
        return view('anggota/formtambah');
    }

    public function simpan()
    {
        $kodeanggota = $this->request->getVar('kodeanggota');
        $namaanggota = $this->request->getVar('namaanggota');
        $jenkel = $this->request->getVar('jenkel');
        $telp = $this->request->getVar('telp');
        $alamat = $this->request->getVar('alamat');

        $valid = $this->validate([
            'kodeanggota' => [
                'rules' => 'required|is_unique[anggota.anggotakode]',
                'label' => 'Kode Anggota',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar, silahkan coba kode yang lain'
                ]
            ],
            'namaanggota' => [
                'rules' => 'required',
                'label' => 'Nama Anggota',
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
                'rules' => 'required',
                'label' => 'Nomor Telp atau HP',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'label' => 'Alamat',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ]);


        if (!$valid) {
            return view('anggota/formtambah', [
                'validation' => $this->validator
            ]);
        } else {
            $this->anggota->insert([
                'anggotakode' => $kodeanggota,
                'anggotanama' => $namaanggota,
                'anggotajk' => $jenkel,
                'anggotatelp' => $telp,
                'anggotaalamat' => $alamat
            ]);

            return redirect()->to('/anggota/index');
        }
    }

    public function hapus($kode)
    {
        $this->anggota->delete($kode);
        return redirect()->to('/anggota/index');
    }

    public function edit($kode)
    {
        $ambildata = $this->anggota->find($kode);
        $data = [
            'kode' => $ambildata['anggotakode'],
            'nama' => $ambildata['anggotanama'],
            'jk' => $ambildata['anggotajk'],
            'telp' => $ambildata['anggotatelp'],
            'alamat' => $ambildata['anggotaalamat'],
        ];

        return view('anggota/formedit', $data);
    }

    public function update()
    {
        $kodeanggota = $this->request->getVar('kodeanggota');
        $namaanggota = $this->request->getVar('namaanggota');
        $jenkel = $this->request->getVar('jenkel');
        $telp = $this->request->getVar('telp');
        $alamat = $this->request->getVar('alamat');

        $this->anggota->update($kodeanggota, [
            'anggotanama' => $namaanggota,
            'anggotajk' => $jenkel,
            'anggotatelp' => $telp,
            'anggotaalamat' => $alamat
        ]);

        return redirect()->to('/anggota/index');
    }
}