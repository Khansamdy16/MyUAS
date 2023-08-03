<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => 'active',
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
            'laundry' => [
                'title' => 'Laundry',
                'link' => base_url(). '/laundry',
                'icon' => 'fa-solid fa-shirt',
                'aktif' => '',
            ],
        ];
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                       </div>
                       <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="#">Beranda</a></li>
                            </ol>
                       </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to Laundry Santri";
        $data['selamat_datang'] = "Selamat datang di aplikasi laundry";
        return view('template/content', $data) ;    
    }
}
