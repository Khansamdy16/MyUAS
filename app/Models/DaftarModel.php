<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'daftar';
    protected $primaryKey       = 'kdjenis';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kdjenis','jenis','harga'];

}
