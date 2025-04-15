<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Prodi extends BaseController
{
    // TAMPILKAN SEMUA PRODI
    public function index()
    {
        $model = new ProdiModel();
        $data = $model->findAll();

        return $this->response->setJSON($data);
    }

    // TAMBAH DATA PRODI
    public function create()
    {
        $model = new ProdiModel();

        $data = [
            'nama_prodi' => $this->request->getVar('nama_prodi'),
        ];

        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status' => 201,
                'message' => 'Data prodi berhasil ditambahkan',
                'data' => $data
            ])->setStatusCode(ResponseInterface::HTTP_CREATED);
        } else {
            return $this->response->setJSON([
                'status' => 400,
                'message' => 'Gagal menambahkan data'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }
    }
}

