<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-4 text-center">
  <a class="btn btn-primary" href="/Order" role="button">Kembali</a>
</div>
<div class="container mt-5 p-5 border border-1 rounded" x-data>
  <h4 class="text-center mb-4">Rincian Order Cucian</h4>
  <div class="row d-flex justify-content-center">
    <div class="col-8 text-center">
      <div class="row">
        <div class="col">Id Order Cucian</div>
        <div class="col"><?= $dataOrder['id_order'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Nama Pelanggan</div>
        <div class="col"><?= $dataOrder['nama_pelanggan'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">No Telepon</div>
        <div class="col"><?= $dataOrder['no_telepon'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Jenis Paket</div>
        <div class="col"><?= $dataOrder['jenis_paket'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Nama Paket</div>
        <div class="col"><?= $dataOrder['nama_paket'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Tarif Per Satuan (<?= $dataOrder['satuan_tertentu'] ?>)</div>
        <div class="col"><?= $dataOrder['tarif_satuan_tertentu'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Jumlah (<?= $dataOrder['satuan_tertentu'] ?>)</div>
        <div class="col">2</div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Total Bayar</div>
        <div class="col">Rp. <?= $dataOrder['total_bayar'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Uang Pelanggan</div>
        <div class="col">Rp. <?= $dataOrder['uang_pelanggan'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Uang Kembalian</div>
        <div class="col">Rp. <?= $dataOrder['uang_kembalian'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Waktu Masuk</div>
        <div class="col"><?= $dataOrder['waktu_masuk'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Waktu Perkiraan Selesai</div>
        <div class="col"><?= $dataOrder['waktu_perkiraan_selesai'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Waktu Diambil</div>
        <div class="col"><?= $dataOrder['waktu_diambil'] == '' ? '-' : $dataOrder['waktu_diambil']  ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Status</div>
        <div class="col"><?= $dataOrder['status'] ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Alamat</div>
        <div class="col"><?= $dataOrder['alamat'] == '' ? '-' : $dataOrder['alamat']  ?></div>
        <hr class="mt-2">
      </div>
      <div class="row">
        <div class="col">Keterangan</div>
        <div class="col"><?= $dataOrder['keterangan'] == '' ? '-' : $dataOrder['keterangan']  ?></div>
        <hr class="mt-2">
      </div>
    </div>
  </div>

</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->endSection() ?>