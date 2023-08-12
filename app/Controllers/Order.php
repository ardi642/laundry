<?php

namespace App\Controllers;

class Order extends BaseController
{

    public function index()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Order';
        $data['kolomTabel'] = [
            'no', 'id order', 'nama pelanggan', 'no_telepon', 'jenis paket',
            'nama paket', 'tarif satuan', 'jumlah', 'total bayar',
            'uang pelanggan', 'uang kembalian', 'waktu masuk', 'status',
            'waktu perkiraan selesai', 'waktu diambil',
            'alamat', 'keterangan', 'aksi'
        ];
        return view('/Order/index', $data);
    }

    public function tambah()
    {
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Order';
        return view('/Order/tambah', $data);
    }

    public function edit($idOrder)
    {
        $orderModel = model(App\Models\OrderModel::class);
        $dataOrder = $orderModel->builder()
            ->select('order.*, paket.nama_paket')
            ->join('paket', 'paket.id_paket = order.id_paket')
            ->where('id_order', $idOrder)
            ->get()
            ->getRowArray();

        // dd($dataOrder);
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'Order';
        $data['dataOrder'] = $dataOrder;
        return view('/Order/edit', $data);
    }

    public function detail($idOrder)
    {
        $orderModel = model(App\Models\OrderModel::class);
        $dataOrder = $orderModel->builder()
            ->select('order.*, paket.nama_paket, paket.minimal_satuan, jenis_paket.jenis_paket')
            ->join('paket', 'paket.id_paket = order.id_paket')
            ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
            ->where('id_order', $idOrder)
            ->get()
            ->getRowArray();
        $data['menus'] = config('App')->menus;
        $data['menuAktif'] = 'pesanan';
        $data['dataOrder'] = $dataOrder;
        return view('/Order/detail', $data);
    }
}
