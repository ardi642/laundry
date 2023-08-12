<?= $this->extend('template') ?>

<?= $this->section('content') ?>

</div>
<div class="container mt-4 text-center">
  <a class="btn btn-primary" href="/JenisPaket" role="button">Kembali</a>
</div>
<form method="post" class="container mt-4 p-5 border border-1 rounded" id="form" x-data x-effect="setNotification()">
  <div class=""></div>
  <h5 class="text-center mb-5">Form Tambah Jenis Paket Cucian</h5>
  <div class="mb-3">
    <label class="form-label">Jenis Paket Cucian</label>
    <input type="text" class="form-control" name="jenis_paket" placeholder="masukkan jenis paket cucian" :value="$store.global.form.jenis_paket" x-model="$store.global.form.jenis_paket" @keyup="resetValidasi('jenis_paket')">
    <template x-if="$store.global.validasi.jenis_paket != null">
      <div class="alert alert-danger mt-2 p-1" x-text="$store.global.validasi.jenis_paket">
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
      form: {},
      validasi: {},
      state: {
        loading: false,
        status: null
      }
    })
    window.storeGlobal = Alpine.store('global');
  })

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
        title: 'jenis paket cucian berhasil ditambahkan'
      })
    }

    if (status == 'gagal') {
      Toast.fire({
        icon: 'error',
        title: 'jenis paket cucian gagal ditambahkan'
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
      const response = await axios.post('<?= base_url() ?>api/JenisPaket', data);
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