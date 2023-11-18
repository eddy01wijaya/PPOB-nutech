<!-- app/Views/beranda.php -->
<?php $this->extend('layout/default') ?>

<?php $this->section('content') ?>
    <!-- Container utama dengan padding dan teks tengah -->
    <div class="m-5 p-5 text-center">
        <div class="container m-0">
            <!-- Baris (row) untuk menyusun elemen di dalam kolom -->
            <div class="row">
                <!-- Kolom pertama dengan margin dan padding -->
                <div class="col m-5 p-5">
                    <!-- Judul dengan gambar logo -->
                    <h2><img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="30" height="30"> SIMS PPOB</h2>
                    <br>
                    <!-- Subjudul untuk masuk atau membuat akun -->
                    <h2>Masuk atau buat akun untuk memulai</h2>
                    <!-- Formulir login -->
                    <form id="loginForm" action="<?= site_url('/login_proses') ?>" method="post">
                        <div class="form-group">
                            <!-- Input field untuk email -->
                            <div class="input-field">
                                <span class="fa fa-solid fa-at p-1"></span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                            </div><br>

                            <!-- Input field untuk password dengan opsi toggle password -->
                            <div class="input-field">
                                <span class="fa fa-light fa-lock p-1"></span>
                                <input type="password" id="password" name="password" minlength="8" class="form-control" placeholder="Masukkan password Anda" required>
                                <span class="toggle-password fa fa-eye" onclick="togglePassword()"></span>
                            </div>

                            <br>
                            <!-- Pesan kesalahan jika email/password salah -->
                            <?php
                            if(isset($_GET['message']))
                                echo'<div id="responseMessage" class="text-center" style="color: red;border: 1px solid red">Email/password salah</div>';
                            ?>
                            <br>

                            <!-- Tombol untuk melakukan login -->
                            <button type="submit" class="btn btn-danger btn-full">Login</button>
                            <br><br>         
                        </div>
                    </form>
                    
                    <!-- Informasi untuk registrasi -->
                    <div class="text-center">
                        Belum punya akun? Registrasi <a style="color: red;" href="<?= site_url('/register') ?>">di sini</a>
                    </div>
                    
                </div>
                
                <!-- Kolom kedua untuk menampilkan ilustrasi login -->
                <div class="col">
                    <img src="<?= base_url('assets/img/Illustrasi Login.png') ?>" height="800" alt="logo">
                </div>

            </div>
        </div>    
        
    </div>
    
<?php $this->endSection() ?>
