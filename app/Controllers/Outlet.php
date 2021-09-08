<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Outlet extends BaseController
{
    use ResponseTrait;
    public $outlet;
    public $karyawan;
    public $karout;

    public function __construct()
    {
        $this->outlet = new \App\Models\OutletModel();
        $this->karyawan = new \App\Models\KaryawanModel();
        $this->karout = new \App\Models\KarOutModel();
    }

    public function index()
    {
        $dataa['datamenu'] = ['menu' => "Outlet"];
        $data['sidebar'] = view('layout/sidebar', $dataa);
        $data['content'] = view('outlet');
        return view('layout/layout', $data);
    }

    public function read()
    {
        $data['outlets'] = $this->outlet->get()->getResultObject();
        foreach ($data['outlets'] as $keyOut => $valueout) {
            $valueout->karyawan = $this->karyawan->query("SELECT
                `karyawan`.*,
                `karyawaninoutlet`.`id` AS karoutid
            FROM
                `karyawan`
                LEFT JOIN `karyawaninoutlet`
            ON `karyawan`.`id` = `karyawaninoutlet`.`karyawanid`
                LEFT JOIN `periode` ON `karyawaninoutlet`.`periodeid` = `periode`.`id`
            WHERE periode.status='1'")->getResultObject();
        }
        $data['karyawan'] = [];
        $karyawan = $this->karyawan->get()->getResultArray();
        $inRole = $this->karyawan->query("SELECT
            `karyawan`.*
        FROM
            `karyawan`
            LEFT JOIN `karyawaninoutlet`
        ON `karyawan`.`id` = `karyawaninoutlet`.`karyawanid`
            LEFT JOIN `periode` ON `karyawaninoutlet`.`periodeid` = `periode`.`id`
        WHERE periode.status='1'")->getResultArray();
        foreach ($karyawan as $keyKar => $valueKar) {
            $key = array_search($valueKar['nama'], array_column($inRole, 'nama'));
            if ($key === false) {
                array_push($data['karyawan'], $valueKar);
            }

        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = (array) $this->request->getJSON();
        $this->outlet->insert($data);
        $data['id'] = $this->outlet->getInsertID();
        return $this->respondCreated($data);
    }

    public function createKar()
    {
        $periode = new \App\Models\PeriodeModel();
        $aktif = $periode->where('status', '1')->get()->getRowArray();
        $data = (array) $this->request->getJSON();
        $data['periodeid'] = $aktif['id'];
        $this->karout->insert($data);
        $data['karoutid'] = $this->karout->getInsertID();
        return $this->respondCreated($data);
    }

    public function update()
    {
        $data = (array) $this->request->getJSON();
        $result = $this->outlet->update($data['id'], [
            'outlet' => $data['outlet'],
        ]);
        return $this->respond($result);
    }

    public function delete($id)
    {
        return $this->respond($this->outlet->delete($id));
    }

    public function deleteKar($id)
    {
        return $this->respond($this->karout->delete($id));
    }
}