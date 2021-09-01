<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use ocs\wplib\Wplib as WP;
class Analysis extends BaseController
{
	use ResponseTrait;
	public $karyawan;
	public $penilaian;
	public $kriteria;
	public $subkriteria;
	public $periode;

	public function __construct()
	{
		$this->penilaian = new \App\Models\PenilaianModel();
        $this->karyawan = new \App\Models\KaryawanModel();
        $this->kriteria = new \App\Models\KriteriaModel();
        $this->subkriteria = new \App\Models\SubKriteriaModel();
        $this->periode = new \App\Models\PeriodeModel();
	}

	public function index()
	{
        $dataa['datamenu'] = ['menu' => "Analysis"];
		$data['sidebar'] = view('layout/sidebar', $dataa);
		$data['content'] = view('analysis');
		return view('layout/layout', $data);
	}
    
	public function read()
	{
        $periode = $this->periode->where('status', '1')->get()->getRowObject();
        $kriteria = $this->kriteria->get()->getResultArray();
		$karyawan = $this->karyawan->get()->getResultArray();
        foreach ($karyawan as $keykar => $kar) {
            $karyawanid = $kar['id'];
            $karyawan[$keykar]['nilai'] = array();
            foreach ($kriteria as $key => $kri) {
                $kriteriaid = $kri['id'];
                $nilai = $this->penilaian->query("SELECT
                    `nilaialternatif`.*,
                    `subkriteria`.`bobot`
                FROM
                    `nilaialternatif`
                    LEFT JOIN `subkriteria` ON
                    `subkriteria`.`id` = `nilaialternatif`.`subkriteriaid`
                    LEFT JOIN `kriteria` ON `kriteria`.`id` = `subkriteria`.`kriteriaid` WHERE periodeid='$periode->id' AND karyawanid='$karyawanid' AND kriteriaid='$kriteriaid'")->getRowArray();
                $item = [
                    "kode"=> $kri['kode'],
                    "bobot"=> $nilai['bobot'],
                ];
                array_push($karyawan[$keykar]['nilai'], $item);
            }
        }
        $a['wp'] = new wp($kriteria, $karyawan, 0);
        $a['matriks'] = $karyawan;
		return $this->respond($a);
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
