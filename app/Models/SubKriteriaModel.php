<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class SubKriteriaModel extends Model{
    protected $table = 'subkriteria';
    protected $allowedFields = [
        'id', 'kriteriaid', 'nama', 'bobot'
    ];
}