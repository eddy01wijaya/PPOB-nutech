<!-- app/Views/beranda.php -->
<?php $this->extend('layout/default') ?>

<?php $this->section('content') ?>
    <!-- Include navbar from layout -->
    <?= $this->include('layout/navbar') ?>

    <div class="m-3">
        <!-- Include user_dashboard from dashboard folder -->
        <?= $this->include('dashboard/user_dashboard') ?>
        <br>
        <h3><b>Semua Transaksi</b></h3>
        <br>

        <?php
        // Loop through history array and display each transaction
        foreach ($history as $history_item) {
            echo '<div class="card">';
            echo '<div class="card-body d-flex justify-content-between">';
            echo '<div class="text">';
            
            // Determine transaction type and format accordingly
            if($history_item['transaction_type']=='TOPUP'){
                echo '<h3 style="color: turquoise;"><b>+ ';
            } else{
                echo '<h3 style="color: red;"><b>- ';
            }
            echo number_format($history_item['total_amount'], 0, ',', '.').'<b></h3>';
            echo '<p class="card-text">' . $history_item['formatted_created_on'] . '</p>';
            echo '</div>';
            
            // Display transaction description in the right column
            echo '<div class="text-center">';
            echo '<p class="text-muted">'.$history_item['description'].'</p>';
            echo '</div>';
            
            echo '</div>';
            echo '</div><br>';
        }
        ?>

        <!-- Show more button -->
        <div class="text-center">
            <a style="color: red;" type="button" class="btn" href="/history?n=<?= $_GET['n']+5?>"><h7><b> Show more <b></h7></a>
        </div>
    </div>
<?php $this->endSection() ?>
