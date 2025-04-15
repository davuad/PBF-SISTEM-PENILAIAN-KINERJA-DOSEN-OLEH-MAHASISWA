<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Mahasiswa extends BaseController
{
    use ResponseTrait;

    // TAMPIL DATA
    public function index()
    {
        $model = new MahasiswaModel();
        $data = $model->getMahasiswa(); // tampilkan data dengan nama prodi

        return $this->respond($data, 200); // respon JSON
    }

    // CREATE / TAMBAH DATA
    public function create()
    {
        $model = new \App\Models\MahasiswaModel();
    
        $data = [
            'npm' => $this->request->getVar('npm'),
            'password' => $this->request->getVar('password'),
            'nama_mhs' => $this->request->getVar('nama_mhs'),
            'kelas' => $this->request->getVar('kelas'),
            'id_prodi' => $this->request->getVar('id_prodi'),
        ];
    
        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status' => 201,
                'message' => 'Data mahasiswa berhasil ditambahkan',
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
