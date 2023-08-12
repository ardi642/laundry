<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPaketModel extends Model
{
  protected $table = 'jenis_paket';
  protected $allowedFields = ['id_jenis_paket', 'jenis_paket'];
  protected $primaryKey = 'id_jenis_paket';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = false;
  protected $useTimestamps = false;
}
