<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class PenilaianModel extends Model{
    protected $table = 'nilaialternatif';
    protected $allowedFields = [
        'id', 'subkriteriaid', 'periodeid', 'karyawanid'
    ];
}