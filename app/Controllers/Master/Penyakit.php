<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Penyakit extends BaseController
{
    public function index()
    {
        $tombolcari = $this->request->getVar('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getVar('cari');
            session()->set('caripenyakit', $cari);

            return redirect()->to('/penyakit/index');
        } else {
            $cari = session()->get('caripenyakit');
        }

        if ($cari) {
            $datapenyakit = $this->penyakit->caridata($cari);
        } else {
            $datapenyakit = $this->penyakit;
        }

        $nohalaman = $this->request->getVar('page_penyakit') ? $this->request->getVar('page_penyakit') : 1;

        $data = [
            'datapenyakit' => $datapenyakit->paginate(10, 'penyakit'),
            'pager' => $this->penyakit->pager,
            'nohalaman' => $nohalaman,
        ];

        return view('penyakit/viewdata', $data);
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('penyakit/formtambah')
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $namapenyakit = $this->request->getVar('namapenyakit');

            $valid = $this->validate([
                'namapenyakit' => [
                    'rules' => 'required',
                    'label' => 'Nama Penyakit',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $validation = $this->validator;
                $msg = [
                    'error' => [
                        'namapenyakit' => $validation->getError('namapenyakit')
                    ]
                ];
            } else {
                $this->penyakit->insert([
                    'penyakitnm' => $namapenyakit
                ]);
                $berhasil = '<div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                                Data Penyakit Berhasil tersimpan...
                              </div>';
                session()->setFlashdata('pesan', $berhasil);

                $msg = [
                    'sukses' => ''
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapus($id)
    {
        $this->penyakit->delete($id);
        return redirect()->to('/penyakit');
    }
}