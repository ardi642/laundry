<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;

class JenisPaket extends BaseController
{
  protected $validation;
  protected $jenisPaketModel;

  public function __construct()
  {
    $this->jenisPaketModel = model(App\Models\JenisPaketModel::class);
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

    $jenisPaketModel = $this->jenisPaketModel;

    $result = $jenisPaketModel->orLike([
      'jenis_paket' => $searchValue
    ])
      ->orderBy($orderByColumn, $orderDir)
      ->limit($length, $start)
      ->findAll();
    $recordsTotal = $jenisPaketModel->countAll();
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
    $jenisPaketModel = $this->jenisPaketModel;
    $data = $jenisPaketModel->findAll();
    $resData = [
      'data' => $data
    ];
    return $this->response->setJSON($resData);
  }

  public function find($idJenisPaket)
  {
    $jenisPaketModel = $this->jenisPaketModel;
    $data = $jenisPaketModel->find($idJenisPaket);
    $resData = [
      'data' => $data
    ];
    return $this->response->setJSON($resData);
  }

  public function findByFilters()
  {
    $filters = $this->request->getVar();
    $jenisPaketModel = $this->jenisPaketModel;
    $result = $jenisPaketModel
      ->builder()
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
    $jenisPaketModel = $this->jenisPaketModel;
    $this->validation->setRules([
      'jenis_paket' => "required|is_unique[jenis_paket.jenis_paket, jenis_paket, {$data['jenis_paket']}]"
    ]);

    if (!$this->validation->run($data)) {
      $resData = [
        'validasi' => $this->validation->getErrors()
      ];

      return $this->response
        ->setStatusCode(400)
        ->setJSON($resData);
    }

    $query = $jenisPaketModel->insert($data, false);
    if (!$query) {
      $resData = [
        'error' => $jenisPaketModel->errors()
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

  public function delete($idJenisPaket)
  {
    $jenisPaketModel = $this->jenisPaketModel;
    $query = $jenisPaketModel->delete($idJenisPaket);
    if (!$query) {
      $resData = [
        'error' => $jenisPaketModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }
    return $this->response->setJSON(true);
  }

  public function update($idJenisPaket)
  {
    $jenisPaketModel = $this->jenisPaketModel;
    $data = $this->request->getJSON(true);
    $this->validation->setRules([
      'jenis_paket' => "required|is_unique[jenis_paket.jenis_paket, jenis_paket, {$data['jenis_paket']}]"
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

    $query = $jenisPaketModel->update($idJenisPaket, $data);
    if (!$query) {
      $resData = [
        'error' => $jenisPaketModel->errors()
      ];
      return $this->response
        ->setStatusCode(500)
        ->setJSON($resData);
    }
    return $this->response->setJSON(true);
  }
}
