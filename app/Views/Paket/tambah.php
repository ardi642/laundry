<?= $this->extend('template') ?>

<?= $this->section('content') ?>

</div>
<div class="container mt-4 text-center">
  <a class="btn btn-primary" href="/Paket" role="button">Kembali</a>
</div>
<form method="post" class="container mt-4 p-5 border border-1 rounded" id="form" x-data x-effect="setNotification()">
  <div class=""></div>
  <h5 class="text-center mb-5">Form Tambah Paket Cucian</h5>
  <div class="mb-3">
    <label class="form-label">Jenis Paket Cucian</label>
    <div x-show="$store.global.state.jenisPaketTerload === true">
      <select class="form-select jenis-paket" name="id_jenis_paket" class="form-control" x-model="$store.global.form.id_jenis_paket" @change="resetValidasi('id_jenis_paket')" x-init="loadSelectJenisPaket">
        <template x-for="jenisPaket in $store.global.jenisPakets">
          <option :value="jenisPaket.id_jenis_paket" x-text="jenisPaket.jenis_paket" :selected="$store.global.form.id_jenis_paket=jenisPaket.id_jenis_paket"></option>
        </template>
      </select>
      <template x-if="$store.global.validasi.id_jenis_paket != null">
        <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.id_jenis_paket">
        </div>
      </template>
    </div>
    <div x-show="$store.global.state.jenisPaketTerload === null">sedang memuat jenis paket cucian ...</div>
    <div x-show="$store.global.state.jenisPaketTerload === false">
      gagal memuat jenis paket cucian <button class="btn btn-primary" @click="loadSelectJenisPaket" type="button">muat ulang</button>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama Paket Cucian</label>
    <input type="text" class="form-control" name="nama_paket" placeholder="masukkan nama paket cucian" :value="$store.global.form.nama_paket" x-model="$store.global.form.nama_paket" @keyup="resetValidasi('nama_paket')">
    <template x-if="$store.global.validasi.nama_paket != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.nama_paket">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Waktu Kerja Hari</label>
    <input type="number" class="form-control" name="waktu_kerja_hari" placeholder="masukkan waktu kerja hari" :value="$store.global.form.waktu_kerja_hari" x-model="$store.global.form.waktu_kerja_hari" @keyup="resetValidasi('waktu_kerja_hari')">
    <template x-if="$store.global.validasi.waktu_kerja_hari != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.waktu_kerja_hari">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Waktu Kerja Jam</label>
    <input type="number" class="form-control" name="waktu_kerja_jam" placeholder="masukkan waktu kerja jam" :value="$store.global.form.waktu_kerja_jam" x-model="$store.global.form.waktu_kerja_jam" @keyup="resetValidasi('waktu_kerja_jam')">
    <template x-if="$store.global.validasi.waktu_kerja_jam != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.waktu_kerja_jam">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Satuan</label>
    <input type="text" class="form-control" name="satuan" placeholder="masukkan satuan" :value="$store.global.form.satuan" x-model="$store.global.form.satuan" @keyup="resetValidasi('satuan')">
    <template x-if="$store.global.validasi.satuan != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.satuan">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Tarif Satuan</label>
    <input type="number" class="form-control" name="tarif_satuan" placeholder="masukkan tarif satuan" :value="$store.global.form.tarif_satuan" x-model="$store.global.form.tarif_satuan" @keyup="resetValidasi('tarif_satuan')">
    <template x-if="$store.global.validasi.tarif_satuan != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.tarif_satuan">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Minimal Satuan</label>
    <input type="number" class="form-control" name="minimal_satuan" placeholder="masukkan minimal satuan" :value="$store.global.form.minimal_satuan" x-model="$store.global.form.minimal_satuan" @keyup="resetValidasi('minimal_satuan')">
    <template x-if="$store.global.validasi.minimal_satuan != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.minimal_satuan">
      </div>
    </template>
  </div>
  <div class="mb-3">
    <label class="form-label">Keterangan (Optional)</label>
    <textarea class="form-control" name="keterangan" placeholder="masukkan keterangan" :value="$store.global.form.keterangan" x-model="$store.global.form.keterangan" @keyup="resetValidasi('keterangan')" rows="3"></textarea>
    <template x-if="$store.global.validasi.keterangan != null">
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
    <button class="btn btn-primary" type="reset" @click="handleReset">Reset</button>
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
      jenisPakets: [],
      form: {
        id_jenis_paket: null
      },
      validasi: {},
      state: {
        loading: false,
        status: null,
        jenisPaketTerload: null
      }
    })
    window.storeGlobal = Alpine.store('global');
  })

  async function loadSelectJenisPaket() {
    storeGlobal.state.jenisPaketTerload = null
    try {
      const response = await axios.get(`<?= base_url() ?>api/JenisPaket/selectAll`);
      storeGlobal.jenisPakets = response.data.data;
      storeGlobal.jenisPakets.unshift({
        id_jenis_paket: null,
        jenis_paket: 'pilih jenis paket cucian'
      });
      storeGlobal.state.jenisPaketTerload = true;

      this.$nextTick(() => {
        storeGlobal.form.id_jenis_paket = null;
      })

    } catch (error) {
      storeGlobal.state.jenisPaketTerload = false;
    }
  }

  function resetValidasi(name) {
    const storeValidasi = storeGlobal.validasi;
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
        title: 'paket cucian berhasil ditambahkan'
      })
    }

    if (status == 'gagal') {
      Toast.fire({
        icon: 'error',
        title: 'paket cucian gagal ditambahkan'
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

    storeState.loading = true;
    try {
      const response = await axios.post('<?= base_url() ?>api/Paket', data);
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

  function handleReset(e) {
    e.preventDefault();
    const storeForm = storeGlobal.form;
    const storeValidasi = storeGlobal.validasi;
    const storeState = storeGlobal.state;
    removeObjectProperties(storeForm);
    removeObjectProperties(storeValidasi);
    storeState.status = null;
    storeState.loading = false;
    document.getElementById('form').reset();
  }
</script>
<?= $this->endSection() ?>