<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container mt-5 p-5 border border-1 rounded">
  <h5 class="text-center mb-4">Tabel Paket Cucian</h5>
  <div class="text-center mb-5">
    <a class="btn btn-success" href="/Paket/tambah" role="button">
      Tambah Paket Cucian
    </a>
  </div>
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

  let tabel = $('#tabel').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
      url: '<?= base_url() ?>api/Paket/'
    },
    columns: [{
        data: "id_paket",
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
        data: "jenis_paket"
      },
      {
        data: "nama_paket"
      },
      {
        data: null,
        render: function(data, type, row, meta) {
          let lamaHari = row.waktu_kerja_hari;
          let lamaJam = row.waktu_kerja_jam;

          if (lamaHari > 0)
            lamaHari = `${lamaHari} hari`;
          else
            lamaHari = '';

          if (lamaJam > 0)
            lamaJam = `${lamaJam} jam`;
          else
            lamaJam = ''

          return `${lamaHari != '' ? lamaHari : ''}${lamaJam != '' ? `, ${lamaJam}` : ''}`;
        }
      },
      {
        data: "satuan"
      },
      {
        data: "tarif_satuan",
        render: function(data, type, row, meta) {
          return `Rp. ${data}`;
        }
      },
      {
        data: "minimal_satuan",
        render: function(data, type, row, meta) {
          return `${data} ${row.satuan}`;
        }
      },
      {
        data: "keterangan",
        render: function(data) {
          if (data == "") return '-';
          else return data;
        }
      },
      {
        data: null,
        orderable: false,
        render: function(data, type, row, meta) {
          return `
            <a href="Paket/edit/${row.id_paket}" class="btn btn-sm btn-warning">Edit</a>
            <button class="btn btn-sm btn-danger tombol-hapus" data-row-index="${meta.row}">
            Delete
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
      text: `Anda akan menghapus paket cucian ${rowData.nama_paket} ?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    })

    if (!keputusan.isConfirmed) return;

    try {
      const response = await axios.delete(`<?= base_url() ?>api/Paket/${rowData.id_paket}`);
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
          title: `paket cucian ${rowData.nama_paket} berhasil dihapus`
        })

      }

      if (status == 'gagal') {
        Toast.fire({
          icon: 'error',
          title: `paket cucian ${rowData.nama_paket} gagal dihapus`
        })
      }
    }
  })
</script>

<?= $this->endSection() ?>