<div class="container p-2">
    <div class="row">
        <!-- Profile Info -->
        <div class="col">
            <!-- Conditional display of profile image -->
            <img src="<?php
                if(!strpos($profile['profile_image'], 'null') !== false){
                    echo $profile['profile_image'];
                } else{
                    echo base_url('assets/img/Profile Photo.png');
                }
            ?>" alt="" />
            <h5>Selamat datang,</h5>
            <!-- Displaying full name from the profile -->
            <h2><?= $profile['first_name'].' '.$profile['last_name'] ?></h2>
        </div>

        <!-- Balance Information -->
        <div class="col position-relative">
            <!-- Background image for the balance section -->
            <img src="<?= base_url('assets/img/Background Saldo.png') ?>" alt="" />

            <!-- Text overlay for balance display -->
            <div class="text-overlay">
                <h5>Saldo Anda</h5>
                
                <!-- Masked balance display -->
                <h2 id="maskedBalanceDisplay" >Rp ●●●●●</h2>

                <!-- Actual balance display (initially hidden) -->
                <h2 id="balanceDisplay" style="display: none;">Rp <?= number_format($balance, 0, ',', '.')?></h2>
                <br>

                <!-- Button to toggle between masked and actual balance -->
                <button type="button" class="btn btn-sm" id="hideSaldoBtn"><h7>lihat saldo</h7></button>
            </div>
        </div>
    </div>
</div>
