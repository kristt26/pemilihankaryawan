<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Kriteria extends BaseController
{
	use ResponseTrait;
	public $kriteria;
	public $subkriteria;

	public function __construct()
	{
		$this->kriteria = new \App\Models\KriteriaModel();
		$this->subkriteria = new \App\Models\SubKriteriaModel();
	}

	public function index()
	{
		$dataa['datamenu'] = ['menu' => "Kriteria"];
		$data['sidebar'] = view('layout/sidebar', $dataa);
		$data['content'] = view('kriteria');
		return view('layout/layout', $data);
	}

	public function read()
	{
		$kriteria = $this->kriteria->get()->getResultObject();
		foreach ($kriteria as $key => $valuekriteria) {
			$valuekriteria->subKriteria = $this->subkriteria->where('kriteriaid', $valuekriteria->id)->get()->getResultObject();
		}
		return $this->respond($kriteria);
	}

	public function createKriteria()
	{
		$data = (array)$this->request->getJSON();
		$result = $this->kriteria->insert($data);
		$data['id'] = $this->kriteria->getInsertID();
		return $this->respond($data);
	}

	public function createSubKriteria()
	{
		$data = (array)$this->request->getJSON();
		$result = $this->subkriteria->insert($data);
		$data['id'] = $this->kriteria->getInsertID();
		return $this->respond($data);
	}

	public function updateKriteria()
	{
		$data = (array)$this->request->getJSON();
		$result = $this->kriteria->update(
			$data['id'],
			[
				'kode'=>$data['kode'],
				'nama'=>$data['nama'],
				'type'=>$data['type'],
				'bobot'=>$data['bobot'],
			]
		);
		return $this->respond($data);
	}

	public function updateSubKriteria()
	{
		$data = (array)$this->request->getJSON();
		$result = $this->subkriteria->update(
			$data['id'],
			[
				'nama'=>$data['nama'],
				'bobot'=>$data['bobot'],
			]
		);
		return $this->respond($data);
	}

	public function deleteKriteria($id)
	{
		$data = (array)$this->request->getJSON();
		$result = $this->kriteria->delete($id);
		return $this->respond($result);
	}

	public function deleteSubKriteria($id)
	{
		$data = (array)$this->request->getJSON();
		$result = $this->subkriteria->delete($id);
		return $this->respond($result);
	}
}
