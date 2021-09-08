<?php namespace App\Models;

use CodeIgniter\Model;

class KarOutModel extends Model
{
    protected $table = 'karyawaninoutlet';
    protected $allowedFields = [
        'id', 'karyawanid', 'outletid', 'periodeid',
    ];
}