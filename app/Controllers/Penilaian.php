<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenilaianModel;
use CodeIgniter\HTTP\ResponseInterface;

class Penilaian extends BaseController
{
    public function index()
    {
    
        $model = new PenilaianModel();
        $data = $model->findAll(); // ambil semua data dari tabel mahasiswa

        return $this->response->setJSON($data); // tampilkan dalam bentuk JSON

    }
    public function create()
    {
        $model = new PenilaianModel();

        // Ambil data yang dikirimkan melalui POST
        $data = [
            'id_prodi'      => $this->request->getVar('id_prodi'),
            'id_dosen'      => $this->request->getVar('id_dosen'),
            'sks'           => $this->request->getVar('sks'),
            'aspek_nilai'   => $this->request->getVar('aspek_nilai'),
            'saran'         => $this->request->getVar('saran'),
        ];

        // Validasi input
        if (empty($data['id_prodi']) || empty($data['id_dosen']) || empty($data['sks']) || empty($data['aspek_nilai'])) {
            return $this->response->setJSON([
                'status'  => 400,
                'message' => 'Semua kolom harus diisi'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Masukkan data ke database
        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status'  => 201,
                'message' => 'Data penilaian berhasil ditambahkan',
                'data'    => $data
            ])->setStatusCode(ResponseInterface::HTTP_CREATED);
        } else {
            return $this->response->setJSON([
                'status'  => 400,
                'message' => 'Gagal menambahkan data penilaian'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }
    }
}

