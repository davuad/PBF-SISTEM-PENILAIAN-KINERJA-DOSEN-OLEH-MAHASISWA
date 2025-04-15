<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dosen extends BaseController
{
    public function index()
    {
        $model = new DosenModel();
        $data = $model->getDosen(); // ambil semua data dari tabel dosen

        return $this->response->setJSON($data); // tampilkan dalam bentuk JSON

    }
    public function create()
    {
        $model = new DosenModel();

        // Ambil data yang dikirimkan melalui POST
        $data = [
            'nama_dosen' => $this->request->getVar('nama_dosen'),
            'nidn'       => $this->request->getVar('nidn'),
            'id_prodi'   => $this->request->getVar('id_prodi'),
            'id_matkul'  => $this->request->getVar('id_matkul'),
        ];

        // Validasi input
        if (empty($data['nama_dosen']) || empty($data['nidn']) || empty($data['id_prodi']) || empty($data['id_matkul'])) {
            return $this->response->setJSON([
                'status'  => 400,
                'message' => 'Semua kolom harus diisi'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Masukkan data ke database
        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status'  => 201,
                'message' => 'Data dosen berhasil ditambahkan',
                'data'    => $data
            ])->setStatusCode(ResponseInterface::HTTP_CREATED);
        } else {
            return $this->response->setJSON([
                'status'  => 400,
                'message' => 'Gagal menambahkan data'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }
    }
}
