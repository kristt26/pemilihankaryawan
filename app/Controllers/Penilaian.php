<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Penilaian extends BaseController
{
    use ResponseTrait;
    public $penilaian;
    public $karyawan;
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
        $dataa['datamenu'] = ['menu' => "Penilaian"];
        $data['sidebar'] = view('layout/sidebar', $dataa);
        $data['content'] = view('penilaian');
        return view('layout/layout', $data);
    }

    public function read()
    {
        $periode = $this->periode->where('status', '1')->get()->getRowObject();
        $karyawan = $this->karyawan->where('status', '1')->get()->getResultObject();
        $kriteria = $this->kriteria->get()->getResultObject();
        foreach ($karyawan as $key => $kar) {
            $kar->nilai = array();
            foreach ($kriteria as $k => $v) {
                $kar->nilai[$k] = clone $v;
            }
            // $kar->nilai = clone $kriteria;
            foreach ($kar->nilai as $key => $kri) {
                $kri->subKriteria = $this->subkriteria->where('kriteriaid', $kri->id)->get()->getResultObject();
                $kri->nilai = $this->penilaian->query("SELECT
                        `nilaialternatif`.*
                    FROM
                        `nilaialternatif`
                        LEFT JOIN `subkriteria` ON
                        `subkriteria`.`id` = `nilaialternatif`.`subkriteriaid`
                        LEFT JOIN `kriteria` ON `kriteria`.`id` = `subkriteria`.`kriteriaid` WHERE periodeid='$periode->id' AND karyawanid='$kar->id' AND kriteriaid='$kri->id'")->getRowObject();
            }
        }
        return $this->respond($karyawan);
    }

    public function create()
    {
        $data = $this->request->getJSON();
        $periode = $this->periode->where('status', '1')->get()->getRowObject();
        $this->penilaian->transStart();
        foreach ($data->nilai as $key => $value) {
            $item = [
                'subkriteriaid' => $value->setNilai->id,
                'periodeid' => $periode->id,
                'karyawanid' => $data->id,
            ];
            $this->penilaian->insert($item);
            $item['id'] = $this->penilaian->getInsertID();
            $value->nilai = $item;
        }
        if ($this->penilaian->transStatus()) {
            $this->penilaian->transCommit();
            return $this->respondCreated($data);
        } else {
            $this->penilaian->transRollback();
            return $this->fail($data);
        }
    }

    public function update()
    {
        $data = (array)$this->request->getJSON();
        $result = $this->penilaian->update($data['id'], [
            'periode' => $data['periode'],
            'status' => $data['status']
        ]);
        return $this->respond($result);
    }

    public function delete($id)
    {
        return $this->respond($this->penilaian->delete($id));
    }
}
