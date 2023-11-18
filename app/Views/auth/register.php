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
                    <!-- Formulir registrasi -->
                    <form id="registrationForm">
                        <div class="form-group">
                            <!-- Judul dengan gambar logo -->
                            <h2><img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="30" height="30"> SIMS PPOB</h2>
                            <br>
                            <!-- Subjudul untuk melengkapi data dan membuat akun -->
                            <h2>Lengkapi data untuk membuat akun</h2>

                            <!-- Input field untuk email -->
                            <div class="input-field">
                                <span class="fa fa-solid fa-at p-1"></span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                            </div><br>

                            <!-- Input field untuk nama depan -->
                            <div class="input-field">
                                <span class="fa fa-solid fa-user p-1"></span>
                                <input type="text" id="firstName" name="first_name" class="form-control" placeholder="Nama depan" required>
                            </div><br>

                            <!-- Input field untuk nama belakang -->
                            <div class="input-field">
                                <span class="fa fa-solid fa-user p-1"></span>
                                <input type="text" id="lastName" name="last_name" class="form-control" placeholder="Nama belakang" required>
                            </div><br>

                            <!-- Input field untuk password dengan opsi toggle password -->
                            <div class="input-field">
                                <span class="fa fa-light fa-lock p-1"></span>
                                <input type="password" id="password" name="password" class="form-control" minlength="8" placeholder="Buat password" required>
                                <span class="toggle-password fa fa-eye" onclick="togglePassword()"></span>
                            </div><br>

                            <!-- Input field untuk konfirmasi password dengan opsi toggle password -->
                            <div class="input-field">
                                <span class="fa fa-light fa-lock p-1"></span>
                                <input type="password" id="confirmPassword" class="form-control" placeholder="Konfirmasi password" required>
                                <span class="toggle-password fa fa-eye" onclick="togglePassword('confirmPassword')"></span>
                            </div>
                            <br>
                            <!-- Pesan respons untuk informasi kesalahan -->
                            <div id="responseMessage" class="text-center" style="color: red;"></div>
                            <br>

                            <!-- Tombol untuk melakukan registrasi -->
                            <button type="button" class="btn btn-danger btn-full" onclick="registerUser()">Register</button>
                            <br><br>
                            <!-- Informasi untuk login jika sudah memiliki akun -->
                            <div class="text-center">
                                Sudah punya akun? Login <a style="color: red;" href="<?= site_url('/login') ?>">di sini</a>
                            </div>
                            <br><br>

                        </div>
                    </form>
                </div>
                <!-- Kolom kedua untuk menampilkan ilustrasi login -->
                <div class="col">
                    <img src="<?= base_url('assets/img/Illustrasi Login.png') ?>" height="800" alt="logo">
                </div>

            </div>
        </div>    
        
    </div>
    
<?php $this->endSection() ?>
