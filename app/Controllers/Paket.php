<?php

namespace App\Controllers;

class Paket extends BaseController
{

    public function index()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Paket';
        $data['kolomTabel'] = [
            'no', 'jenis paket', 'nama paket', 'waktu kerja', 'satuan',
            'tarif satuan', 'minimal satuan', 'keterangan', 'aksi'
        ];
        return view('/Paket/index', $data);
    }

    public function tambah()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Paket';
        return view('/Paket/tambah', $data);
    }

    public function edit($idPaket)
    {
        $jenisPaketModel = model(App\Models\PaketModel::class);
        $dataPaket = $jenisPaketModel->find($idPaket);
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Paket';
        $data['dataPaket'] = $dataPaket;
        return view('/Paket/edit', $data);
    }
}
