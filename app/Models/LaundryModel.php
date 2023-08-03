<?php

namespace App\Models;

use CodeIgniter\Model;

class LaundryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'laundry';
    protected $primaryKey       = 'nourut';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['nourut','tanggal','nama','asrama','jenis','harga','berat','totalharga','petugas','tanggal2'];

}
function buat_no()   {    
    $this->pm->select('RIGHT(laundry.nourut,2) as no', FALSE);
    $this->pm->order_by('nourut','DESC');    
    $this->pm->limit(1);    
    $query = $this->pm->get('laundry');      //cek dulu apakah ada sudah ada kode di tabel.    
    if($query->num_rows() <> 0){      
     //jika kode ternyata sudah ada.      
     $data = $query->row();      
     $no = intval($data->no) + 1;    
    }
    else{      
     //jika kode belum ada      
     $no = 1;    
    }
    $nomax = str_pad($no, 2, "0", STR_PAD_LEFT);    
    $nojadi = "LAUNDRY".$nomax;    
    return $nojadi;  
   }
