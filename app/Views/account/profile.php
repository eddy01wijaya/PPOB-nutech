<!-- app/Views/beranda.php -->
<?php $this->extend('layout/default') ?>

<?php $this->section('content') ?>
    <?= $this->include('layout/navbar') ?>
    
    <div class="m-3 text-center" style="position: relative;">
        <div style="position: relative; display: inline-block;">
            <!-- Form untuk mengunggah gambar profil -->
            <form id="upload-form" action="<?= site_url('/profile_image_proses') ?>" method="post" enctype="multipart/form-data" >
                <input type="file" name="profile_image" id="file-input" style="display: none;" accept="image/*">
                <!-- Label yang mengandung gambar profil dan ikon edit -->
                <label for="file-input" style="cursor: pointer;">
                    <img id="profile-image" src="<?php
                        // Menampilkan gambar profil atau gambar default jika tidak ada
                        if (!strpos($profile['profile_image'], 'null') !== false) {
                            echo $profile['profile_image'];
                        } else {
                            echo base_url('assets/img/Profile Photo.png');
                        }
                    ?>" alt="Profile" height="150px">
                    <div class="edit-icon" style="position: absolute; bottom: 0; right: 0;">
                        <i class="fa fa-pen" style="color: #000000;"></i>
                    </div>
                </label>
                <button type="submit" style="display: none;">Upload</button>
            </form>
        </div>
        <!-- Menampilkan nama pengguna -->
        <h2 id="user-name"><?= $profile['first_name'].' '.$profile['last_name'] ?></h2>
    </div>

    <div class="m-5 p-5 text-justify">
        <!-- Menampilkan pesan berdasarkan parameter GET -->
        <?php if(isset($_GET['message'])){
                if($_GET['message']=='Update Profile Image berhasil'){
                    echo'<div id="responseMessage" class="text-center" style="color: turquoise;border: 1px solid turquoise; width:300px">';
                }elseif($_GET['message']=='Sukses'){
                    echo'<div hidden>';
                }else{
                    echo'<div id="responseMessage" class="text-center" style="color: red;border: 1px solid red; width:300px">';
                }
                echo $_GET['message'].'</div> <br>';
            }
        ?>

        <!-- Form untuk mengedit profil -->
        <form action="<?= site_url('/profile_proses') ?>" method="post" id="profile-form">
            <h5>Email</h5>
            <!-- Input field untuk email (non-editable) -->
            <div class="input-field">
                <span class="fa fa-solid fa-at p-1"></span>
                <input id="email" type="text" value="<?= $profile['email'] ?>" required disabled>
            </div><br>
            <h5>Nama Depan</h5>
            <!-- Input field untuk nama depan (editable) -->
            <div class="input-field">
                <span class="fa fa-light fa-user p-1"></span>
                <input id="first_name" name="first_name" type="text" value="<?= $profile['first_name'] ?>" required disabled>
            </div><br>
            <h5>Nama Belakang</h5>
            <!-- Input field untuk nama belakang (editable) -->
            <div class="input-field">
                <span class="fa fa-light fa-user p-1"></span>
                <input id="last_name" name="last_name" type="text" value="<?= $profile['last_name'] ?>" required disabled>
            </div><br>
            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit" class="btn btn-danger btn-full" id="save-btn" style="display: none;">Simpan</button>
            <!-- Tombol untuk mengaktifkan mode edit -->
            <button type="button" class="btn btn-outline-danger btn-full" id="edit-btn">Edit Profile</button>
            <br><br>
            <!-- Tombol untuk logout -->
            <a href="<?= site_url('logout') ?>" class="btn btn-danger btn-full" id="logout-btn">Logout</a>
        </form>
    </div>
<?php $this->endSection() ?>
