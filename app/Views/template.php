<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laundry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="/select2/select2.min.css" rel="stylesheet" />
  <link href="/datatable/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="/datatable/responsive.bootstrap5.min.css" rel="stylesheet" />

  <script src="<?= base_url() ?>jquery/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>datatable/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>datatable/dataTables.bootstrap5.min.js"></script>
  <script src="<?= base_url() ?>datatable/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>datatable/responsive.bootstrap5.js"></script>

  <script src="<?= base_url() ?>sweetalert2/sweetalert2@11.js"></script>
  <script src="<?= base_url() ?>select2/select2.min.js"></script>
  <script defer src="<?= base_url() ?>alpinejs/alpinejs@3.x.x_dist_cdn.min.js"></script>
  <script src="<?= base_url() ?>axios/axios.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand mb-0 h1" href="#">RWEB Laundry</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <?php $session = session() ?>
          <?php foreach ($menus as $menu => $labelMenu) : ?>
            <?php if ($session->level == 'karyawan' and $menu == 'Karyawan') continue; ?>
            <li class="nav-item">
              <a class="nav-link <?= ($menuAktif == $menu) ? "active" : "" ?>" href="<?= base_url($menu) ?>">
                <?= $labelMenu ?>
              </a>
            </li>
          <?php endforeach ?>
          <li class="nav-item ml-auto">
            <a href="/Logout" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?= $this->renderSection('content') ?>

  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <p class="text-center">Created with <span>❤️</span> By RWEB Laundry</p>
      </div>
    </div>
  </div>
  <?= $this->renderSection('script') ?>
</body>

</html>