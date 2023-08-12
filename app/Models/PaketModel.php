<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
  protected $table = 'paket';
  protected $allowedFields = [
    'id_paket', 'nama_paket', 'id_jenis_paket',
    'waktu_kerja_jam', 'waktu_kerja_hari', 'satuan',
    'tarif_satuan', 'minimal_satuan', 'keterangan'
  ];
  protected $primaryKey = 'id_paket';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = false;
  protected $useTimestamps = false;
}
