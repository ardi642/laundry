<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
  protected $table = 'order';
  protected $allowedFields = [
    'id_order', 'nama_pelanggan', 'alamat', 'no_telepon',
    'id_paket', 'satuan_tertentu', 'tarif_satuan_tertentu',
    'waktu_masuk', 'waktu_diambil', 'waktu_perkiraan_selesai',
    'jumlah', 'status', 'keterangan', 'total_bayar',
    'uang_pelanggan', 'uang_kembalian'
  ];
  protected $primaryKey = 'id_order';
  protected $useAutoIncrement = true;
  protected $returnType     = 'array';
  protected $useSoftDeletes = false;
  protected $useTimestamps = false;
}
