<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;

class Order extends BaseController
{
  protected $validation;
  protected $orderModel;
  protected $orderRules;

  public function __construct()
  {
    $this->orderModel = model(App\Models\OrderModel::class);
    $this->validation = \Config\Services::validation();
    $this->orderRules = [
      'nama_pelanggan' => 'required',
      'id_paket' => 'required',
      'jumlah' => 'required|numeric',
      'status' => 'required',
      'no_telepon' => 'required',
      'alamat' => 'required',
      'uang_pelanggan' => 'required|numeric'
    ];
  }

  public function selectDatatable()
  {
    $params = $this->request->getVar();
    $searchValue = $params['search']['value'];
    $orderByIndex = $params['order'][0]['column'];
    $orderByColumn = $params['columns'][$orderByIndex]['data'];
    $orderDir = $params['order'][0]['dir'];
    $start = $params['start'];
    $length = $params['length'];
    $orderModel = $this->orderModel;

    $filters = [];
    $koloms = [
      'nama_pelanggan', 'alamat', 'jenis_paket',
      'nama_paket', 'satuan_tertentu', 'tarif_satuan_tertentu',
      'waktu_masuk', 'waktu_diambil', 'waktu_perkiraan_selesai',
      'jumlah', 'status', 'order.keterangan', 'total_bayar',
      'uang_pelanggan', 'uang_kembalian'
    ];
    foreach ($koloms as $kolom) {
      $filters[$kolom] = $searchValue;
    };

    $builder = $orderModel->builder()
      ->select('order.*, paket.nama_paket, paket.minimal_satuan, jenis_paket.jenis_paket')
      ->join('paket', 'paket.id_paket = order.id_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->groupStart()
      ->orLike($filters)
      ->groupEnd();

    if (isset($params['tanggal_dari'])) {
      $builder->where('DATE(waktu_masuk) >= ', $params['tanggal_dari']);
      unset($params['tanggal_dari']);
    }

    if (isset($params['tanggal_sampai'])) {
      $builder->where('DATE(waktu_masuk) <= ', $params['tanggal_sampai']);
      unset($params['tanggal_sampai']);
    }

    if (isset($params['id_jenis_paket']))
      $builder->where('jenis_paket.id_jenis_paket', $params['id_jenis_paket']);

    if (isset($params['id_paket']))
      $builder->where('paket.id_paket', $params['id_paket']);

    if (isset($params['status']))
      $builder->where('status', $params['status']);


    $result = $builder->limit($length, $start)
      ->orderBy($orderByColumn, $orderDir)
      ->get()
      ->getResultArray();

    $recordsTotal = $orderModel->countAll();
    $recordsFiltered = count($result);

    $resData = [
      'draw' => $this->request->getVar('draw'),
      'data' => $result,
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
    ];
    return $this->response->setJSON($resData);
  }

  public function selectAll()
  {
    $orderModel = $this->orderModel;
    $data = $orderModel->builder()
      ->select('order.*, paket.nama_paket, paket.minimal_satuan, jenis_paket.jenis_paket')
      ->join('paket', 'paket.id_paket = order.id_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->get()
      ->getResultArray();
    $resData = [
      'data' => $data
    ];
    return $this->response->setJSON($resData);
  }

  public function find($idOrder)
  {
    $orderModel = $this->orderModel;
    $data = $orderModel->builder()
      ->select('order.*, paket.nama_paket, paket.minimal_satuan, jenis_paket.jenis_paket')
      ->join('paket', 'paket.id_paket = order.id_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->get()
      ->getResultArray();
    $resData = [
      'data' => $data
    ];
    return $this->response->setJSON($resData);
  }

  public function findByFilters()
  {
    $filters = $this->request->getVar();
    $orderModel = $this->orderModel;
    $result = $orderModel
      ->builder()
      ->select('order.*, paket.nama_paket, paket.minimal_satuan, jenis_paket.jenis_paket')
      ->join('paket', 'paket.id_paket = order.id_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->like($filters)
      ->get()
      ->getResultArray();
    $resData = [
      'data' => $result
    ];
    return $this->response->setJSON($resData);
  }

  public function create()
  {

    $data = $this->request->getJSON(true);
    $paketModel = model(App\Models\PaketModel::class);
    $orderModel = $this->orderModel;

    $this->validation->setRules($this->orderRules);
    $this->validation->run($data);
    $validasi = $this->validation->getErrors();

    if (!isset($data['id_paket'])) {
      $dataPaket = null;
    } else
      $dataPaket = $paketModel->find($data['id_paket']);

    $jumlah = $data['jumlah'] ?? null;

    if ($dataPaket != null and $jumlah != null) {
      if ($jumlah < $dataPaket['minimal_satuan']) {
        $validasi['jumlah'] = "minimal jumlah satuan untuk paket cucian ini 
        adalah {$dataPaket['minimal_satuan']} {$dataPaket['satuan']}";
      }
    }

    if (count($validasi) > 0) {
      $resData = [
        'validasi' => $validasi
      ];

      return $this->response
        ->setStatusCode(400)
        ->setJSON($resData);
    }

    $data['satuan_tertentu'] = $dataPaket['satuan'];
    $data['tarif_satuan_tertentu'] = $dataPaket['tarif_satuan'];
    $data['total_bayar'] = $dataPaket['tarif_satuan'] * $data['jumlah'];
    $data['uang_kembalian'] = $data['uang_pelanggan'] - $data['total_bayar'];

    $waktu = date("Y-m-d H:i:s");
    $data['waktu_masuk'] = $waktu;

    if ($data['status'] == 'sudah diambil')
      $data['waktu_diambil'] = $waktu;

    $jam = $dataPaket['waktu_kerja_jam'];
    $hari = $dataPaket['waktu_kerja_hari'];

    $data['waktu_perkiraan_selesai'] =  date(
      'Y-m-d H:i:s',
      strtotime(
        '+' . $jam . ' hours +' . $hari . ' days',
        strtotime($waktu)
      )
    );

    $query = $orderModel->insert($data, false);
    if (!$query) {
      $resData = [
        'error' => $orderModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }

    $resData = [
      'data' => $data
    ];
    return $this->response->setJSON($resData);
  }

  public function delete($idOrder)
  {
    $orderModel = $this->orderModel;
    $query = $orderModel->delete($idOrder);
    if (!$query) {
      $resData = [
        'error' => $orderModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }
    return $this->response->setJSON(true);
  }

  public function update($idOrder)
  {
    $data = $this->request->getJSON(true);
    $paketModel = model(App\Models\PaketModel::class);
    $orderModel = $this->orderModel;

    $this->validation->setRules($this->orderRules);
    $this->validation->run($data);
    $validasi = $this->validation->getErrors();

    if (!isset($data['id_paket'])) {
      $dataPaket = null;
    } else
      $dataPaket = $paketModel->find($data['id_paket']);

    $jumlah = $data['jumlah'] ?? null;

    if ($dataPaket != null and $jumlah != null) {
      if ($jumlah < $dataPaket['minimal_satuan']) {
        $validasi['jumlah'] = "minimal jumlah satuan untuk paket cucian ini 
        adalah {$dataPaket['minimal_satuan']} {$dataPaket['satuan']}";
      }
    }

    if (count($validasi) > 0) {
      $resData = [
        'validasi' => $validasi
      ];

      return $this->response
        ->setStatusCode(400)
        ->setJSON($resData);
    }

    $dataLama = $orderModel->find($idOrder);

    if ($dataLama['status'] == 'sudah diambil') {
      return $this->response
        ->setStatusCode(500)
        ->setJSON([
          'error' => 'status cucian sudah diambil sehingga tidak bisa diubah'
        ]);
    }


    $data['satuan_tertentu'] = $dataPaket['satuan'];
    $data['tarif_satuan_tertentu'] = $dataPaket['tarif_satuan'];
    $data['total_bayar'] = $dataPaket['tarif_satuan'] * $data['jumlah'];
    $data['uang_kembalian'] = $data['uang_pelanggan'] - $data['total_bayar'];

    $waktu = date("Y-m-d H:i:s");

    if ($data['status'] == 'sudah diambil')
      $data['waktu_diambil'] = $waktu;

    $query = $orderModel->update($idOrder, $data);
    if (!$query) {
      $resData = [
        'error' => $orderModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }
    return $this->response->setJSON(true);
  }
}
