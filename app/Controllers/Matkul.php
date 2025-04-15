<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MatkulModel;
use CodeIgniter\HTTP\ResponseInterface;

class Matkul extends BaseController
{
    public function index()
    {
        $model = new MatkulModel();
        $data = $model->getMatkul(); // ambil semua data dari tabel mahasiswa

        return $this->response->setJSON($data); // tampilkan dalam bentuk JSON

    }

    public function create()
    {
        $model = new MatkulModel();

        // Ambil data dari request POST
        $data = [
            'nama_matkul' => $this->request->getVar('nama_matkul'),
            'id_prodi'    => $this->request->getVar('id_prodi'),
            'sks'         => $this->request->getVar('sks'),
        ];

        // Validasi input (misalnya, bisa ditambahkan validasi disini)
        if (empty($data['nama_matkul']) || empty($data['id_prodi']) || empty($data['sks'])) {
            return $this->response->setJSON([
                'status'  => 400,
                'message' => 'Semua kolom harus diisi'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Simpan data ke database
        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status'  => 201,
                'message' => 'Data mata kuliah berhasil ditambahkan',
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
