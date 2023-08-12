<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $session = session();
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Home';
        $data['kolomTabel'] = [
            'no', 'id order', 'nama pelanggan', 'no_telepon', 'jenis paket',
            'nama paket', 'tarif satuan', 'jumlah', 'total bayar',
            'uang pelanggan', 'uang kembalian', 'waktu masuk', 'status',
            'waktu perkiraan selesai', 'waktu diambil',
            'alamat', 'keterangan', 'aksi'
        ];
        $data['username'] = $session->username;
        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        $orderModel = model(App\Models\OrderModel::class);
        $paketModel = model(App\Models\PaketModel::class);
        $karyawanModel = model(App\Models\KaryawanModel::class);

        $data['jumlahKaryawan'] = $karyawanModel
            ->builder()
            ->countAll();

        $data['jumlahPaket'] = $paketModel
            ->builder()
            ->countAll();

        $data['totalOrderBulanIni'] = $orderModel
            ->builder()
            ->where('MONTH(waktu_masuk)', $bulanSekarang)
            ->where('YEAR(waktu_masuk)', $tahunSekarang)
            ->countAllResults();

        $data['totalOrderBelumDiambil'] = $orderModel
            ->builder()
            ->where('status !=', 'sudah diambil')
            ->countAllResults();

        return view('/Home/index', $data);
    }
}
