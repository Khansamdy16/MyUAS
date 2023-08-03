<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaundryModel;

class Laundry extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new LaundryModel();

        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => '',
            ],
            'petugas' => [
                'title' => 'Petugas',
                'link' => base_url(). '/petugas',
                'icon' => 'fa-solid fa-user',
                'aktif' => '',
            ],
            'daftar'  => [
                'title' => 'Daftar Harga',
                'link' => base_url(). '/daftar',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
            'laundry'  => [
                'title' => 'Laundry',
                'link' => base_url(). '/laundry',
                'icon' => 'fa-solid fa-shirt',
                'aktif' => 'active',
            ],
        ];
        $this->rules = [
          'nourut' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'No.urut Laundry tidak boleh kosong',
            ]
            ],
          'tanggal' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Masuk tidak boleh kosong',
            ]
            ],
          'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama tidak boleh kosong',
            ]
            ], 
          'asrama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Asrama tidak boleh kosong',
            ]
            ], 
          'jenis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kode Jenis tidak boleh kosong',
            ]
            ],
          'harga' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Harga/Kg tidak boleh kosong',
            ]
            ],
          'berat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Berat (Kg) tidak boleh kosong',
            ]
            ],  
          'totalharga' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Total Harga tidak boleh kosong',
            ]
            ],
          'petugas' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Petugas tidak boleh kosong',
            ]
            ],  
          'tanggal2' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Pengambilan tidak boleh kosong',
            ]
            ],  
        ];
    }
    
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Laundry</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Laundry</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Laundry" ;
        

        $query = $this->pm->find();
        $data['data_laundry'] = $query; 
        return view('laundry/content', $data) ;
    } 

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Laundry</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/laundry">Laundry</a></li>
                                <li class="breadcrumb-item active">Tambah Laundry</li>
                            </ol>
                       </div>';

        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Laundry' ;
        $data['action'] = base_url() . '/laundry/simpan' ;
        return view('laundry/input', $data);
    }
    public function simpan ()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {
            
            return redirect()->back()->withInput();
        }
        if (!$this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }

        $dt = $this->request->getPost();
        try {
        $simpan = $this->pm->insert($dt) ;
        return redirect()->to('laundry')->with('success', 'Data berhasil disimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
        return redirect()->back()->withInput();     
        }
    }
    public function hapus($id)
    {
        if(empty($id)) {
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }
        try {
            $this->pm->delete($id) ;
            return redirect()->to('laundry')->with('success', 'Data laundry dengan no. urut '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('laundry')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Laundry</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/laundry">Laundry</a></li>
                                <li class="breadcrumb-item active">Edit laundry</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Laundry' ;
        $data['action'] = base_url() . '/laundry/update' ;

        $data['edit_data'] = $this->pm->find($id);
        return view('laundry/input', $data);
    }
    public function update()
    {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);

        if(!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        try{
            $this->pm->update($param, $dtEdit);
            return redirect()->to('laundry')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashData('error', $e->getMessage());
            return redirect()->back->withInput();
        }
    }
} 
    