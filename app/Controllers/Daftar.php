<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DaftarModel;

class Daftar extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new DaftarModel();

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
                'aktif' => 'active',
            ],
            'laundry'  => [
                'title' => 'Laundry',
                'link' => base_url(). '/laundry',
                'icon' => 'fa-solid fa-shirt',
                'aktif' => '',
            ],
        ];
        $this->rules = [
          'kdjenis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kode tidak boleh kosong',
            ]
            ],
          'jenis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis tidak boleh kosong',
            ]
            ],
          'harga' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Harga tidak boleh kosong',
            ]
            ],  
        ];
    }
    
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Daftar Harga</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Daftar Harga</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Daftar Harga Laundry" ;
        

        $query = $this->pm->find();
        $data['data_daftar'] = $query; 
        return view('daftar/content', $data) ;
    } 

    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Daftar Harga</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url()  .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url()  .'/daftar">Daftar Harga</a></li>
                                <li class="breadcrumb-item active">Edit Daftar Harga</li>
                            </ol>
                       </div>';
        $data['menu'] = $this->menu;
        $data['title_card'] = 'Edit Daftar Harga' ;
        $data['breadcrumb'] = $breadcrumb;
        $data['action'] = base_url() . '/daftar/update' ;

        $data['edit_data'] = $this->pm->find($id);
        return view('daftar/input', $data);
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
            return redirect()->to('daftar')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashData('error', $e->getMessage());
            return redirect()->back->withInput();
        }
    }
} 
    