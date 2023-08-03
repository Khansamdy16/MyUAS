<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id','username','password'];

}
