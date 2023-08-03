<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetugasModel;

class petugas extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new PetugasModel();

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
                'aktif' => 'active',
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
                'aktif' => '',
            ],
        ];
        $this->rules = [
          'id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Id tidak boleh kosong',
            ]
            ],
          'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username tidak boleh kosong',
            ]
            ],
          'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password tidak boleh kosong',
            ]
            ],  
        ];
    }
    
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Petugas</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Petugas</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Petugas" ;
        

        $query = $this->pm->find();
        $data['data_petugas'] = $query; 
        return view('petugas/content', $data) ;
    } 

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Petugas</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/petugas">Petugas</a></li>
                                <li class="breadcrumb-item active">Tambah Petugas</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Petugas' ;
        $data['action'] = base_url() . '/petugas/simpan' ;
        return view('petugas/input', $data);
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
        return redirect()->to('petugas')->with('success', 'Data berhasil disimpan');
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
            return redirect()->to('petugas')->with('success', 'Data petugas dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('petugas')->with('error',$e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Petugas</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/petugas">Petugas</a></li>
                                <li class="breadcrumb-item active">Edit Petugas</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Petugas' ;
        $data['action'] = base_url() . '/petugas/update' ;

        $data['edit_data'] = $this->pm->find($id);
        return view('petugas/input', $data);
    }
    public function update()
    {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);

        if(!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        if (empty($dtEdit['password'])) {
            unset($dtEdit['password']);
        }
        try{
            $this->pm->update($param, $dtEdit);
            return redirect()->to('petugas')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashData('error', $e->getMessage());
            return redirect()->back->withInput();
        }
    }
} 
    