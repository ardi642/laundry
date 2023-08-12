<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;

class Paket extends BaseController
{
  protected $validation;
  protected $paketModel;

  public function __construct()
  {
    $this->paketModel = model(App\Models\PaketModel::class);
    $this->validation = \Config\Services::validation();
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

    $filters = [];
    $koloms = [
      'nama_paket', 'jenis_paket', 'satuan',
      'tarif_satuan', 'minimal_satuan', 'keterangan'
    ];
    foreach ($koloms as $kolom) {
      $filters[$kolom] = $searchValue;
    };

    $paketModel = $this->paketModel;
    $result = $paketModel->builder()
      ->select('paket.*, jenis_paket.jenis_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->orLike($filters)
      ->orderBy($orderByColumn, $orderDir)
      ->limit($length, $start)
      ->get()
      ->getResultArray();
    $recordsTotal = $paketModel->countAll();
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
    $paketModel = $this->paketModel;
    $data = $paketModel->builder()
      ->select('paket.*, jenis_paket.jenis_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->get()
      ->getResultArray();

    $resData = [
      'data' => $data
    ];
    return $this->response->setJSON($resData);
  }

  public function find($idPaket)
  {
    $paketModel = $this->paketModel;
    $data = $paketModel->builder()
      ->select('paket.*, jenis_paket.jenis_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->where('id_paket', $idPaket)
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

    if (isset($filters['id_jenis_paket'])) {
      $id_jenis_paket = $filters['id_jenis_paket'];
      unset($filters['id_jenis_paket']);
    }

    $paketModel = $this->paketModel;
    $builder = $paketModel->builder()
      ->select('paket.*, jenis_paket.jenis_paket')
      ->join('jenis_paket', 'jenis_paket.id_jenis_paket = paket.id_jenis_paket')
      ->orLike($filters);

    if (isset($id_jenis_paket))
      $builder->where('jenis_paket.id_jenis_paket', $id_jenis_paket);

    $result = $builder->get()
      ->getResultArray();
    $resData = [
      'data' => $result
    ];
    return $this->response->setJSON($resData);
  }

  public function create()
  {
    $data = $this->request->getJSON(true);

    if ($data['id_jenis_paket'] == 'null')
      $data['id_jenis_paket'] = null;

    $paketModel = $this->paketModel;
    $this->validation->setRules([
      'nama_paket' => 'required',
      'id_jenis_paket' => 'required',
      'waktu_kerja_jam' => 'required|numeric',
      'waktu_kerja_hari' => 'required|numeric',
      'satuan' => 'required',
      'tarif_satuan' => 'required|numeric',
      'minimal_satuan' => 'required|numeric'
    ]);

    if (!$this->validation->run($data)) {
      $resData = [
        'validasi' => $this->validation->getErrors()
      ];

      return $this->response
        ->setStatusCode(400)
        ->setJSON($resData);
    }

    $query = $paketModel->insert($data, false);
    if (!$query) {
      $resData = [
        'error' => $paketModel->errors()
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

  public function delete($idPaket)
  {
    $paketModel = $this->paketModel;
    $query = $paketModel->delete($idPaket);
    if (!$query) {
      $resData = [
        'error' => $paketModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }
    return $this->response->setJSON(true);
  }

  public function update($idPaket)
  {
    $paketModel = $this->paketModel;
    $data = $this->request->getJSON(true);

    if ($data['id_jenis_paket'] == 'null')
      $data['id_jenis_paket'] = null;

    $this->validation->setRules([
      'nama_paket' => 'required',
      'id_jenis_paket' => 'required',
      'waktu_kerja_jam' => 'required|numeric',
      'waktu_kerja_hari' => 'required|numeric',
      'satuan' => 'required',
      'tarif_satuan' => 'required|numeric',
      'minimal_satuan' => 'required|numeric'
    ]);
    $this->validation->run($data);
    $errorValidasi = $this->validation->getErrors();

    if (count($errorValidasi) > 0) {
      $resData = [
        'validasi' => $errorValidasi
      ];

      return $this->response
        ->setStatusCode(400)
        ->setJSON($resData);
    }

    $query = $paketModel->update($idPaket, $data);
    if (!$query) {
      $resData = [
        'error' => $paketModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }
    return $this->response->setJSON(true);
  }
}
