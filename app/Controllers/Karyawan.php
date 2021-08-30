<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Karyawan extends BaseController
{
	use ResponseTrait;
	public $karyawan;

	public function __construct()
	{
		$this->karyawan = new \App\Models\KaryawanModel();
	}

	public function index()
	{
		$dataa['datamenu'] = ['menu' => "Karyawan"];
		$data['sidebar'] = view('layout/sidebar', $dataa);
		$data['content'] = view('karyawan');
		return view('layout/layout', $data);
	}

	public function read()
	{
		$karyawan = $this->karyawan->get()->getResultObject();
		return $this->respond($karyawan);
	}

	public function create()
    {
        $data = (array)$this->request->getJSON();
        $this->karyawan->insert($data);
        $data['id'] = $this->karyawan->getInsertID();
        return $this->respondCreated($data);
    }

    public function update()
    {
        $data = (array)$this->request->getJSON();
        $result = $this->karyawan->update($data['id'], [
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'hp' => $data['hp'],
            'email' => $data['email'],
            'status' => $data['status']
        ]);
        return $this->respond($result);
    }

    public function delete($id)
    {
        return $this->respond($this->karyawan->delete($id));
    }
}
