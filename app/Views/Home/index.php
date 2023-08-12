<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container mt-5 mb-0">
  <div class="fs-4">Selamat Datang <span><?= $username ?></span></div>
</div>
<div class="container mt-3" x-data>
  <div class="row">
    <div class="col-12 col-md-3 mb-4 mb-md-0">
      <div class="card">
        <div class=" card-body">
          <h5 class="card-title">Jumlah Karyawan</h5>
          <div class="card-text fs-3"><?= $jumlahKaryawan ?></div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3 mb-4 mb-md-0">
      <div class="card">
        <div class=" card-body">
          <h5 class="card-title">Total Order Bulan Ini</h5>
          <div class="card-text fs-3"><?= $totalOrderBulanIni ?></div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3 mb-4 mb-md-0">
      <div class="card">
        <div class=" card-body">
          <h5 class="card-title">Total Order Belum Diambil</h5>
          <div class="card-text fs-3"><?= $totalOrderBelumDiambil ?></div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-3 mb-4 mb-md-0">
      <div class="card">
        <div class=" card-body">
          <h5 class="card-title">Jumlah Paket Tersedia</h5>
          <div class="card-text fs-3"><?= $jumlahPaket ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-4 p-5 border border-1 rounded" x-data>
  <h5 class="text-center mb-4">Data Order Cucian</h5>
  <div class="row mb-4">
    <div class="col-12 col-md-3 mb-2 mb-md-0">Rentang Waktu Order Masuk :</div>
    <div class="col-12 col-md-auto mb-2 mb-md-0">
      <input type="date" class="form-control" id="tanggal-dari" @change="tabel.draw()">
    </div>
    <div class="col-12 col-md-auto mb-2 mb-md-0">sampai</div>
    <div class="col-12 col-md-auto mb-2 mb-md-0">
      <input type="date" class="form-control" :value="getDate()" id="tanggal-sampai" @change="tabel.draw()">
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12 col-md-3 mb-2 mb-md-0">Jenis Paket :</div>
    <div class="col-12 col-md-3 mb-2 mb-md-0">
      <select id="id-jenis-paket" class="form-control select">
      </select>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12 col-md-3 mb-2 mb-md-0">Nama Paket :</div>
    <div class="col-12 col-md-3 mb-2 mb-md-0">
      <select id="id-paket" class="form-control select">
        <option value="">tes tes</option>
      </select>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-12 col-md-3 mb-2 mb-md-0">Status :</div>
    <div class="col-12 col-md-3 mb-2 mb-md-0">
      <select id="status" class="form-control select">
        <option value="">Pilih status Cucian</option>
        <option value="belum diproses">belum diproses</option>
        <option value="proses">proses</option>
        <option value="selesai diproses">selesai diproses</option>
        <option value="sudah diambil" selected>sudah diambil</option>
        <option value="hilang">hilang</option>
      </select>
    </div>
  </div>
  <div x-init="tabel.draw()"></div>
  <div class="table-responsive">
    <table id="tabel" class="table table-hover table-striped dataTable">
      <thead>
        <tr>
          <?php foreach ($kolomTabel as $kolom) : ?>
            <th><?= $kolom ?></th>
          <?php endforeach ?>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <?php foreach ($kolomTabel as $kolom) : ?>
            <th><?= $kolom ?></th>
          <?php endforeach ?>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true
  })

  function getDate(dateString = null) {
    let dateObj;
    if (dateString == null) {
      dateObj = new Date();
    } else {
      const dateTime = Date.parse(dateString);
      dateObj = new Date(dateTime);
    }
    let date = dateObj.getDate() + '';
    let month = (dateObj.getMonth() + 1) + '';
    let year = dateObj.getFullYear() + '';

    date = date.length == 1 ? '0' + date : date;
    month = month.length == 1 ? '0' + month : month;

    return `${year}-${month}-${date}`;
  }

  $("#id-jenis-paket").select2({
    allowClear: true,
    placeholder: 'pilih jenis paket cucian',
    ajax: {
      url: "<?= base_url() ?>api/JenisPaket/findByFilters",
      data: function(params) {
        return {
          'jenis_paket': params.term
        }
      },
      dataType: 'json',
      processResults: function(data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        const newData = data.data.map(function(item, index) {
          return {
            id: item.id_jenis_paket,
            text: item.jenis_paket,
            ...item
          }
        })
        return {
          results: newData
        };
      }
    }
  });

  $("#id-paket").select2({
    allowClear: true,
    placeholder: 'pilih nama paket cucian',
    ajax: {
      url: "<?= base_url() ?>api/Paket/findByFilters",
      data: function(params) {
        let id_jenis_paket = $('#id-jenis-paket').val();
        const data = {
          'nama_paket': params.term
        };

        if (id_jenis_paket != null)
          data['id_jenis_paket'] = id_jenis_paket

        return data;
      },
      dataType: 'json',
      processResults: function(data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        const newData = data.data.map(function(item, index) {
          return {
            id: item.id_paket,
            text: item.nama_paket,
            ...item
          }
        })
        return {
          results: newData
        };
      }
    }
  });

  $('.select').on('change', function(e) {
    tabel.draw();
  })

  let tabel = $('#tabel').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    order: [
      [11, 'desc']
    ],
    ajax: {
      url: '<?= base_url() ?>api/Order/',
      data: function(d) {
        let tanggal_dari = $('#tanggal-dari').val();
        let tanggal_sampai = $('#tanggal-sampai').val();
        let id_jenis_paket = $('#id-jenis-paket').val();
        let id_paket = $('#id-paket').val();
        let status = $('#status').val();

        if (tanggal_dari != "")
          d.tanggal_dari = tanggal_dari;

        if (tanggal_sampai != "")
          d.tanggal_sampai = tanggal_sampai;

        if (id_jenis_paket != "" && id_jenis_paket != null)
          d.id_jenis_paket = id_jenis_paket

        if (id_paket != "" && id_paket != null)
          d.id_paket = id_paket

        if (status != "" && status != null)
          d.status = status


      }
    },
    columns: [{
        data: "id_order",
        render: function(data, type, row, meta) {
          let length = meta.settings.fnRecordsDisplay();
          let orderDirection = meta.settings.aaSorting[0][1];
          if (orderDirection == 'asc')
            return meta.row + 1;
          else
            return length - (meta.row);
        }
      },
      {
        data: "id_order",
      },
      {
        data: "nama_pelanggan",
      },
      {
        data: "no_telepon"
      },
      {
        data: "jenis_paket",
      },
      {
        data: "nama_paket",
      },
      {
        data: "tarif_satuan_tertentu",
      },
      {
        data: "jumlah",
        render: function(data, type, row, meta) {
          return `${data} (${row.satuan_tertentu})`
        }
      },
      {
        data: "total_bayar",
      },
      {
        data: "uang_pelanggan",
      },
      {
        data: "uang_kembalian",
      },
      {
        data: "waktu_masuk",
      },
      {
        data: "status",
      },
      {
        data: "waktu_perkiraan_selesai",
      },
      {
        data: "waktu_diambil",
        render: function(data, type, row, meta) {
          return `${data == null ? '-' : data}`;
        }
      },
      {
        data: "alamat",
        render: function(data, type, row, meta) {
          return `${data == '' ? '-' : data}`;
        }
      },
      {
        data: "keterangan",
        render: function(data, type, row, meta) {
          return `${data == '' ? '-' : data}`;
        }
      },
      {
        data: null,
        orderable: false,
        render: function(data, type, row, meta) {
          return `
            <a href="<?= base_url() ?>Order/detail/${row.id_order}" class="btn btn-sm btn-success">Detail</a>
            ${row.status != 'sudah diambil' ? 
              `<a href="<?= base_url() ?>Order/edit/${row.id_order}" class="btn btn-sm btn-warning">Edit</a>`
            : ""}
            <button class="btn btn-sm btn-danger tombol-hapus" data-row-index="${meta.row}">
            Hapus
            </button>
                `;
        }
      }
    ]
  });

  $('#tabel').on('click', '.tombol-hapus', async function(e) {
    let rowIndex = $(this).data('rowIndex');
    let rowData = tabel.row(rowIndex).data();
    let status;
    let keputusan = await Swal.fire({
      title: 'Apakah Anda yakin?',
      text: `Anda akan menghapus data order dengan id order ${rowData.id_order} 
      dari pelanggan ${rowData.nama_pelanggan} ?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    })

    if (!keputusan.isConfirmed) return;

    try {
      const response = await axios.delete(`<?= base_url() ?>api/Order/${rowData.id_order}`);
      status = 'sukses';
    } catch (error) {
      console.log(error);
      const statusCode = error.response?.status;
      const data = error.response?.data;
      status = 'gagal';
    } finally {
      if (status == 'sukses') {
        tabel.draw();
        Toast.fire({
          icon: 'success',
          title: `data order dengan id order ${rowData.id_order} dari pelanggan ${rowData.nama_pelanggan} berhasil dihapus`
        })

      }

      if (status == 'gagal') {
        Toast.fire({
          icon: 'error',
          title: `data order dengan id order ${rowData.id_order} dari pelanggan ${rowData.nama_pelanggan} gagal dihapus`
        })
      }
    }
  })
</script>

<?= $this->endSection() ?>