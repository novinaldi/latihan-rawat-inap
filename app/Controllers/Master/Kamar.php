<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Kamar extends BaseController
{
    public function index()
    {
        $tombolcari = $this->request->getVar('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getVar('cari');
            session()->set('carikamar', $cari);

            return redirect()->to('/kamar/index');
        } else {
            $cari = session()->get('carikamar');
        }

        if ($cari) {
            $datakamar = $this->kamar->caridata($cari);
        } else {
            $datakamar = $this->kamar;
        }

        $nohalaman = $this->request->getVar('page_kamar') ? $this->request->getVar('page_kamar') : 1;

        $data = [
            'datakamar' => $datakamar->paginate(10, 'kamar'),
            'pager' => $this->kamar->pager,
            'nohalaman' => $nohalaman,
        ];

        return view('kamar/viewdata', $data);
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('kamar/formtambah')
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $namakamar = $this->request->getVar('namakamar');
            $kodekamar = $this->request->getVar('kodekamar');

            $valid = $this->validate([
                'kodekamar' => [
                    'rules' => 'required|is_unique[kamar.kamarkode]',
                    'label' => 'Kode kamar',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada, silahkan dengan kode yang lain'
                    ]
                ],
                'namakamar' => [
                    'rules' => 'required',
                    'label' => 'Nama kamar',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $validation = $this->validator;
                $msg = [
                    'error' => [
                        'kodekamar' => $validation->getError('kodekamar'),
                        'namakamar' => $validation->getError('namakamar')
                    ]
                ];
            } else {
                $this->kamar->insert([
                    'kamarnm' => $namakamar,
                    'kamarkode' => $kodekamar,
                    'kamarstt' => 0
                ]);
                $berhasil = '<div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                                Data kamar dengan kode ' . $kodekamar . ' / ' . $namakamar . ' Berhasil tersimpan...
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
        $this->kamar->delete($id);
        return redirect()->to('/kamar');
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');

            $data = [
                'row' => $this->kamar->find($kode)
            ];
            $msg = [
                'data' => view('kamar/formedit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $namakamar = $this->request->getVar('namakamar');
            $kodekamar = $this->request->getVar('kodekamar');

            $valid = $this->validate([
                'namakamar' => [
                    'rules' => 'required',
                    'label' => 'Nama kamar',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $validation = $this->validator;
                $msg = [
                    'error' => [
                        'namakamar' => $validation->getError('namakamar')
                    ]
                ];
            } else {
                $this->kamar->update($kodekamar, [
                    'kamarnm' => $namakamar,
                ]);
                $berhasil = '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-info"></i> Berhasil !</h5>
                                Data kamar dengan kode <strong>' . $kodekamar . ' / ' . $namakamar . '</strong> Berhasil di-Update...
                              </div>';
                session()->setFlashdata('pesan', $berhasil);

                $msg = [
                    'sukses' => ''
                ];
            }

            echo json_encode($msg);
        }
    }
}