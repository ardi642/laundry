<?php

namespace App\Controllers;

class Login extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = model(App\Models\KaryawanModel::class);
    }

    public function index()
    {
        $session = session();
        $validasi = $session->getFlashdata('validasi') ?? [];
        $input = $session->getFlashdata('input') ?? [];
        $data['validasi'] = $validasi;
        $data['input'] = $input;
        return view('/Login/index', $data);
    }

    public function proses_login()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = (string) $this->request->getPost('password');
        $karyawanModel = $this->karyawanModel;

        $dataKaryawan = $karyawanModel->builder()
            ->where('username', $username)
            ->get()
            ->getRowArray();

        $validasi = [];

        if ($dataKaryawan == null) {
            if ($username == "")
                $validasi['username'] = 'anda belum memasukkan username';
            else
                $validasi['username'] = 'username tidak terdaftar';
        } else if (!password_verify($password, $dataKaryawan['password'])) {
            if ($password == "")
                $validasi['password'] = 'anda belum memasukkan password';
            else
                $validasi['password'] = 'password salah';
        }

        $session->setFlashdata('validasi', $validasi);
        $session->setFlashdata('input', $this->request->getPost());
        if (count($validasi) > 0)
            return redirect()->back();

        $session->set($dataKaryawan);
        return redirect('/');
    }
}
