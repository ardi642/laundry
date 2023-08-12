<?= $this->extend('template') ?>

<?= $this->section('content') ?>

</div>
<div class="container mt-4 text-center">
  <a class="btn btn-primary" href="/Order" role="button">Kembali</a>
</div>
<form method="post" class="container mt-4 p-5 border border-1 rounded" id="form" x-data x-effect="setNotification()">
  <div x-init="$watch('$store.global.paketSelected.data', aturKeterangan)"></div>
  <div x-init="$watch('$store.global.form', aturKeterangan)"></div>
  <h5 class="text-center mb-5">Form Tambah Order Cucian Pelanggan</h5>
  <div class="mb-3">
    <label class="form-label">Nama Pelanggan</label>
    <input type="text" name="nama_pelanggan" class="form-control" placeholder="masukkan nama pelanggan" :value="$store.global.form.nama_pelanggan" x-model="$store.global.form.nama_pelanggan" @keyup="resetValidasi('nama_pelanggan')">
    <template x-if="$store.global.validasi.nama_pelanggan != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.nama_pelanggan">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">No. Telepon Pelanggan</label>
    <input type="number" name="no_telepon" class="form-control" placeholder="masukkan no. telepon pelanggan" :value="$store.global.form.no_telepon" x-model="$store.global.form.no_telepon" @keyup="resetValidasi('no_telepon')">
    <template x-if="$store.global.validasi.no_telepon != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.no_telepon">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Jenis Paket Cucian</label>
    <select class="select-jenis-paket form-control" x-data="{keyId: 'id_jenis_paket', keyText: 'jenis_paket', optionSelected: $store.global.jenisPaketSelected, handleInit: handleInitjenisPaketSelect}" x-init="handleInit">
    </select>
    <template x-if="$store.global.validasi.id_jenis_paket != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.id_jenis_paket">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama Paket Cucian</label>
    <select class="select-nama-paket form-control" x-data="{keyId: 'id_paket', keyText: 'nama_paket', optionSelected: $store.global.paketSelected, handleInit: handleInitPaketSelect}" x-init="handleInit">
    </select>
    <template x-if="$store.global.validasi.id_paket != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.id_paket">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label" x-text="aturTextTarifSatuan"></label>
    <input type="text" class="form-control" :value="$store.global.keterangan.tarif" placeholder="Anda belum memilih nama paket cucian" disabled>
  </div>
  <div class="mb-3">
    <label class="form-label">Jumlah</label>
    <input type="number" name="jumlah" class="form-control" placeholder="masukkan jumlah satuan" :value="$store.global.form.jumlah" x-model="$store.global.form.jumlah" @keyup="resetValidasi('jumlah')">
    <template x-if="$store.global.validasi.jumlah != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.jumlah">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Total Bayar</label>
    <input type="text" class="form-control" :value="$store.global.keterangan.total_bayar" disabled>
  </div>
  <div class="mb-3">
    <label class="form-label">Uang Pelanggan (jika belum membayar isi angka 0)</label>
    <input type="number" name="uang_pelanggan" class="form-control" placeholder="masukkan uang pelanggan" :value="$store.global.form.uang_pelanggan" x-model="$store.global.form.uang_pelanggan" @keyup="resetValidasi('uang_pelanggan')">
    <template x-if="$store.global.validasi.uang_pelanggan != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.uang_pelanggan">
      </div>
    </template>
  </div>
  <template x-if="$store.global.form.uang_pelanggan != null && $store.global.form.uang_pelanggan != ''">
    <div class="mb-3">
      <label class="form-label">Uang Kembalian</label>
      <input type="text" class="form-control" :value="$store.global.keterangan.uang_kembalian" disabled>
    </div>
  </template>
  <div class="mb-3">
    <label class="form-label">Status Cucian</label>
    <select class="select-status-cucian form-control" name="status" x-model="$store.global.form.status" @change="resetValidasi('status')">
      <option value="" selected>Pilih status Cucian</option>
      <option value="belum diproses">belum diproses</option>
      <option value="proses">proses</option>
      <option value="selesai diproses">selesai diproses</option>
      <option value="sudah diambil">sudah diambil</option>
      <option value="hilang">hilang</option>
    </select>
    <template x-if="$store.global.validasi.status != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.status">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Alamat Pelanggan</label>
    <textarea name="alamat" class="form-control" rows="3" placeholder="masukkan alamat pelanggan" x-value="$store.global.form.alamat" x-model="$store.global.form.alamat" @keyup="resetValidasi('alamat')"></textarea>
    <template x-if=" $store.global.validasi.alamat !=null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.alamat">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Keterangan (Optional)</label>
    <textarea name="keterangan" class="form-control" rows="3" placeholder="masukkan keterangan pengeluaran" x-value="$store.global.form.keterangan" x-model="$store.global.form.keterangan" @keyup="resetValidasi('keterangan')"></textarea>
    <template x-if=" $store.global.validasi.keterangan !=null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.keterangan">
      </div>
    </template>
  </div>
  <div class="d-grid gap-2">
    <template x-if="$store.global.state.loading">
      <button class="btn btn-primary" type="submit" disabled>
        <span class="spinner-border spinner-border-sm"></span>
        <span class="visually-hidden">Loading...</span>
      </button>
    </template>
    <template x-if="!$store.global.state.loading">
      <button class="btn btn-primary" type="submit" @click="handleSubmit">Tambah</button>
    </template>
    <a class="btn btn-primary" type="reset" @click="handleReset">Reset</a>
  </div>
</form>
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

  document.addEventListener('alpine:init', () => {
    Alpine.store('global', {
      form: {
        uang_pelanggan: null
      },
      validasi: {},
      jenisPaketSelected: {
        id_jenis_paket: null,
        jenis_paket: null
      },
      paketSelected: {
        id_paket: null,
        nama_paket: null
      },
      keterangan: {
        tarif: null,
        total_bayar: 0,
        uang_kembalian: 0
      },
      state: {
        loading: false,
        status: null
      }

    });
    window.storeGlobal = Alpine.store('global');
  })

  function aturTarif() {
    let data = storeGlobal.paketSelected.data;
    if (data == null) {
      storeGlobal.keterangan.tarif = null;
      return;
    }
    storeGlobal.keterangan.tarif = `Rp. ${data.tarif_satuan}`;
  }

  function aturTotalBayar() {
    let data = storeGlobal.paketSelected.data;
    let tarifSatuan = data?.tarif_satuan ?? 0;
    let jumlah = parseInt(storeGlobal.form.jumlah) || 0;
    let uangPelanggan = parseInt(storeGlobal.form.uang_pelanggan) || 0;

    let totalBayar = (tarifSatuan * jumlah);

    storeGlobal.keterangan.total_bayar = `Rp. ${totalBayar}`;
  }

  function aturUangKembalian() {
    let data = storeGlobal.paketSelected.data;
    let tarifSatuan = data?.tarif_satuan ?? 0;
    let jumlah = parseInt(storeGlobal.form.jumlah) || 0;
    let uangPelanggan = parseInt(storeGlobal.form.uang_pelanggan) || 0;

    let totalBayar = (tarifSatuan * jumlah);
    let uangKembalian = uangPelanggan - totalBayar;

    storeGlobal.keterangan.uang_kembalian = `Rp. ${uangKembalian}`;
  }

  function aturTextTarifSatuan() {
    let satuan = storeGlobal.paketSelected.data?.satuan;
    if (satuan == null)
      return `Tarif Per Satuan`;
    return `Tarif Per Satuan (${satuan})`;
  }

  function aturKeterangan() {
    aturTextTarifSatuan();
    aturTarif();
    aturTotalBayar();
    aturUangKembalian();
  }

  function handleInitjenisPaketSelect() {

    // mengupdate optionSelected berdasarkan option yang dipilih
    function handleOptionSelected(e) {
      let data = $(this.$el).select2('data')[0] || null;
      if (data == null) {
        this.optionSelected[this.keyId] = null;
        this.optionSelected[this.keyText] = null;
      } else {
        this.optionSelected[this.keyId] = data.id;
        this.optionSelected[this.keyText] = data.text;
      }

    }

    // mengupdate option yang dipilih berdasarkan perubahan optionSelected
    function handleSelectedIdModified() {
      if (this.optionSelected[this.keyId] == null) {
        $(this.$el).val(null).trigger('change');
        return;
      }

      // uncomment kode di bawah jika inisialisasi options secara manual
      // $(this.$el).val(this.optionSelected[this.keyId]).trigger('change');

      // uncomment kode di bawah jika inisialisasi options melalui ajax serverside
      let option = new Option(this.optionSelected[this.keyText],
        this.optionSelected[this.keyId], true, true);
      $(this.$el).empty().append(option);
    }

    // mengupdate optionSelected berdasarkan option yang dipilih
    let that = this;
    $(this.$el).on('change', function(e) {
      handleOptionSelected.bind(that)(e);
    })

    // this.$watch('options', (options) => {
    //   // mengupdate option yang dipilih berdasarkan perubahan id
    //   handleSelectedIdModified.bind(this)();
    // })

    this.$watch('optionSelected', (options) => {
      // mengupdate option yang dipilih berdasarkan perubahan id
      handleSelectedIdModified.bind(this)();
    })

    // inisialisasi isi option secara manual atau melalui pemanggilan ajax select2
    this.$nextTick(() => {
      $(this.$el).select2({
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

      // mengupdate option yang dipilih berdasarkan perubahan optionSelected
      handleSelectedIdModified.bind(this)();

    });
  }

  function handleInitPaketSelect() {

    // mengupdate optionSelected berdasarkan option yang dipilih
    function handleOptionSelected(e) {
      let data = $(this.$el).select2('data')[0] || null;

      if (storeGlobal.validasi.id_paket != null) {
        delete storeGlobal.validasi.id_paket;
      }

      if (data == null) {
        this.optionSelected[this.keyId] = null;
        this.optionSelected[this.keyText] = null;
        this.optionSelected.data = null;
      } else {
        this.optionSelected.data = data;
        this.optionSelected[this.keyId] = data.id;
        this.optionSelected[this.keyText] = data.text;
      }
    }

    // mengupdate option yang dipilih berdasarkan perubahan optionSelected
    function handleSelectedIdModified(options) {
      if (this.optionSelected[this.keyId] == null) {
        $(this.$el).val(null).trigger('change');
        return;
      }

      // uncomment kode di bawah jika inisialisasi options secara manual
      // $(this.$el).val(this.optionSelected[this.keyId]).trigger('change');

      // uncomment kode di bawah jika inisialisasi options melalui ajax serverside
      let option = new Option(this.optionSelected[this.keyText],
        this.optionSelected[this.keyId], true, true);
      $(this.$el).empty().append(option);
    }

    // mengupdate optionSelected berdasarkan option yang dipilih
    let that = this;
    $(this.$el).on('change', function(e) {
      handleOptionSelected.bind(that)(e);
    })

    // this.$watch('options', (options) => {
    //   // mengupdate option yang dipilih berdasarkan perubahan id
    //   handleSelectedIdModified.bind(this)();
    // })

    this.$watch('optionSelected', (options) => {
      // mengupdate option yang dipilih berdasarkan perubahan id
      handleSelectedIdModified.bind(this)();
    })

    // inisialisasi isi option secara manual atau melalui pemanggilan ajax select2
    this.$nextTick(() => {
      $(this.$el).select2({
        allowClear: true,
        placeholder: 'pilih nama paket cucian',
        ajax: {
          url: "<?= base_url() ?>api/Paket/findByFilters",
          data: function(params) {
            let id_jenis_paket = $('.select-jenis-paket').val();
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

      // mengupdate option yang dipilih berdasarkan perubahan optionSelected
      handleSelectedIdModified.bind(this)();

    });
  }

  function resetValidasi(name) {
    storeValidasi = Alpine.store('global').validasi;
    delete storeValidasi[name];
  }

  function removeObjectProperties(obj) {
    Object.keys(obj).forEach(key => {
      delete obj[key];
    });
    return obj;
  }

  function setNotification() {
    const storeState = storeGlobal.state;
    const status = storeState.status;
    if (status == 'sukses') {
      document.getElementById('form').reset();
      Toast.fire({
        icon: 'success',
        title: 'data order cucian berhasil ditambahkan'
      })
    }

    if (status == 'gagal') {
      Toast.fire({
        icon: 'error',
        title: 'data order cucian gagal ditambahkan'
      })
    }
    storeState.status = null;
    storeState.loading = false;
  }

  function getFormData(el) {
    const formData = new FormData(el);
    const data = {};
    for (let [key, value] of formData.entries()) {
      data[key] = value;
    }
    return data;
  }

  async function handleSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('form');
    const data = getFormData(form);
    const storeForm = storeGlobal.form;
    const storeValidasi = storeGlobal.validasi;
    const storeState = storeGlobal.state;

    data.id_paket = storeGlobal.paketSelected.id_paket;

    storeState.loading = true;
    try {
      const response = await axios.post('<?= base_url() ?>api/Order/', data);
      storeState.status = 'sukses';
    } catch (error) {
      const statusCode = error.response?.status;
      const data = error.response?.data;
      if (statusCode == 400) {
        removeObjectProperties(storeValidasi);
        Object.assign(storeValidasi, data.validasi);
      } else if (statusCode == 500) {
        storeState.status = 'gagal';
      }
    } finally {
      storeState.loading = false;
    }
  }

  async function handleReset(e) {
    e.preventDefault();
    document.getElementById('form').reset();
    storeGlobal.keterangan = {
      tarif: null,
      total_bayar: 0,
      uang_kembalian: 0
    };
    await $('.select-jenis-paket').val(null).trigger('change');
    // storeGlobal.jenisPaketSelected.id_jenis_paket = null;
    // storeGlobal.jenisPaketSelected.jenisPaket = null;
    await $('.select-nama-paket').val(null).trigger('change');
    // storeGlobal.paketSelected.id_paket = null;
    // storeGlobal.paketSelected.nama_paket = null;
  }
</script>
<?= $this->endSection() ?>