<?php

namespace App\Controllers;

class JenisPaket extends BaseController
{

    public function index()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'JenisPaket';
        $data['kolomTabel'] = ['no', 'jenis paket', 'aksi'];
        return view('/JenisPaket/index', $data);
    }

    public function tambah()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'JenisPaket';
        return view('/JenisPaket/tambah', $data);
    }

    public function edit($idJenisPaket)
    {
        $jenisPaketModel = model(App\Models\JenisPaketModel::class);
        $dataJenisPaket = $jenisPaketModel->find($idJenisPaket);
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'JenisPaket';
        $data['dataJenisPaket'] = $dataJenisPaket;
        return view('/JenisPaket/edit', $data);
    }
}
