<!-- app/Views/beranda.php -->
<?php $this->extend('layout/default') ?>

<?php $this->section('content') ?>
    <!-- Include navbar from layout -->
    <?= $this->include('layout/navbar') ?>

    <div class="m-3">
        <!-- Include user_dashboard from dashboard folder -->
        <?= $this->include('dashboard/user_dashboard') ?>

        <!-- Services section -->
        <div class="container m-5">
            <div class="row">
                <?php
                // Loop through services array and display each service
                foreach ($services as $service) {
                    echo '<div class="col text-center">';
                    echo '<a href="'.base_url('transaction?service='.$service['service_code']).'&name='.$service['service_name'].'&tarif='.$service['service_tariff'].'" style="text-decoration: none; color: #333;">';
                    echo '<img src="' . base_url('assets/img/'.$service['service_code']) . '.png" alt="" />';
                    echo '<br>'.$service['service_name'].'</a>';
                    // ... (add other elements as needed)
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <!-- End services section -->

        <!-- Banner section -->
        <div class="wrapper">
            <h4>Temukan promo menarik</h4>
            <div class="photobanner">
                <?php
                // Loop through banners array and display each banner image
                foreach ($banners as $banner) {
                    echo '<img src="'.$banner['banner_image'].'" alt="" />';
                }
                ?>
            </div>
        </div>
        <!-- End banner section -->
    </div>
<?php $this->endSection() ?>
