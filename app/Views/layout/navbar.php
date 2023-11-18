<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg m-2">
  <div class="container-fluid"> 
    <!-- Logo and Brand Name -->
    <a class="navbar-brand" href="<?= site_url('/') ?>">
      <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="30" height="30"> SIMS PPOB
    </a>

    <!-- Navigation Links -->
    <div class="navbar d-flex" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0">
        <!-- Top Up Link -->
        <li class="nav-item">
          <a class="nav-link <?= ($navbar_menu == 'Top Up') ? 'active' : ''; ?>" aria-current="page" href="<?= site_url('/topup') ?>">Top Up</a>
        </li>

        <!-- Transaction Link -->
        <li class="nav-item">
          <a class="nav-link <?= ($navbar_menu == 'Transaction') ? 'active' : ''; ?>" href="<?= site_url('/history?n=0') ?>">Transaction</a>
        </li>

        <!-- Akun (Account) Link -->
        <li class="nav-item">
          <a class="nav-link <?= ($navbar_menu == 'Akun') ? 'active' : ''; ?>" href="<?= site_url('/profile') ?>">Akun</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Horizontal Line -->
<hr>
