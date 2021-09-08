<?php namespace App\Models;

use CodeIgniter\Model;

class OutletModel extends Model
{
    protected $table = 'outlets';
    protected $allowedFields = [
        'id', 'outlet',
    ];
}