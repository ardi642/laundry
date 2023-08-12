<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Login Ke Sistem Laundry</title>




  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>bootstrap/bootstrap.min.css" rel="stylesheet" />

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
  <script defer src="/alpinejs/alpinejs@3.x.x_dist_cdn.min.js"></script>
</head>

<body class="text-center">
  <main class="form-signin">
    <form method="post" action="/Login/proses_login" x-data>
      <img class="mb-4" src="/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Silahkan Login Ke RWEB Laundry</h1>
      <template x-if="$store.validasi.username != '' ">
        <div class="alert alert-danger mt-2 p-1" x-text="$store.validasi.username">
        </div>
      </template>
      <template x-if="$store.validasi.password != '' ">
        <div class="alert alert-danger mt-2 p-1" x-text="$store.validasi.password">
        </div>
      </template>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="masukkan username" name="username" :value="$store.input.username" @keyup="resetValidasi('username')">
        <label for="floatingInput">username</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="masukkan password" name="password" @keyup="resetValidasi('password')">
        <label for="floatingPassword">Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; RWEB Laundry 2023</p>
    </form>
  </main>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('validasi', {
        username: `<?= $validasi['username'] ?? '' ?>`,
        password: `<?= $validasi['password'] ?? '' ?>`
      })

      Alpine.store('input', {
        username: `<?= $input['username'] ?? '' ?>`,
        password: `<?= $input['password'] ?? '' ?>`
      })
      window.storeValidasi = Alpine.store('validasi');
      window.storeInput = Alpine.store('input');
    })

    function resetValidasi(name) {
      storeValidasi[name] = "";
    }
  </script>

</body>

</html>