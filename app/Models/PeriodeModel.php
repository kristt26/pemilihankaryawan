<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class PeriodeModel extends Model{
    protected $table = 'periode';
    protected $allowedFields = [
        'id', 'periode', 'status'
    ];
}