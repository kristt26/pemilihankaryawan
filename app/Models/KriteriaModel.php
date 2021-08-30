<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class KriteriaModel extends Model{
    protected $table = 'kriteria';
    protected $allowedFields = [
        'id', 'kode', 'nama', 'type', 'bobot'
    ];
}