<?php

namespace App\Controllers;

class Karyawan extends BaseController
{
    public function __construct()
    {
        if (session()->level == 'karyawan')
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "akses ke halaman dilarang"
            );
    }
    public function index()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Karyawan';
        $data['kolomTabel'] = ['no', 'nama', 'username', 'email', 'no_telepon', 'alamat', 'aksi'];
        return view('/Karyawan/index', $data);
    }

    public function tambah()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Karyawan';
        return view('/Karyawan/tambah', $data);
    }

    public function edit($idKaryawan)
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Karyawan';
        $data['idKaryawan'] = $idKaryawan;
        return view('/Karyawan/edit', $data);
    }
}
