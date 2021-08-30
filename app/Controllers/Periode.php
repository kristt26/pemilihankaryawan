<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Periode extends BaseController
{
	use ResponseTrait;
	public $periode;

	public function __construct()
	{
		$this->periode = new \App\Models\PeriodeModel();
	}

	public function index()
	{
		$dataa['datamenu'] = ['menu' => "Periode"];
		$data['sidebar'] = view('layout/sidebar', $dataa);
		$data['content'] = view('periode');
		return view('layout/layout', $data);
	}

	public function read()
	{
		$karyawan = $this->periode->get()->getResultObject();
		return $this->respond($karyawan);
	}

	public function create()
    {
        $data = (array)$this->request->getJSON();
        $this->periode->query("UPDATE periode SET status='0'");
        $this->periode->insert($data);
        $data['id'] = $this->periode->getInsertID();
        return $this->respondCreated($data);
    }

    public function update()
    {
        $data = (array)$this->request->getJSON();
        $result = $this->periode->update($data['id'], [
            'periode' => $data['periode'],
            'status' => $data['status']
        ]);
        return $this->respond($result);
    }

    public function delete($id)
    {
        return $this->respond($this->periode->delete($id));
    }
}
