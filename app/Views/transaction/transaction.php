<!-- app/Views/beranda.php -->
<?php $this->extend('layout/default') ?>

<?php $this->section('content') ?>
    <!-- Include navbar from layout -->
    <?= $this->include('layout/navbar') ?>
    <div class="m-3">
        <!-- Include user_dashboard from dashboard folder -->
        <?= $this->include('dashboard/user_dashboard') ?>
        <br>
        <h4>Pembayaran</h4>
        <h3><img src="<?= base_url('assets/img/'.$transaction_data['service'].".png")?>" alt="" /><b><?= $transaction_data['name'] ?></b></h3>
        <br><br>

        <!-- Display success or error message if present -->
        <?php
        if(isset($_GET['message'])){
            echo '<div id="responseMessage" class="text-center" style="color: ';
            echo ($_GET['message'] == 'Transaksi berhasil') ? 'turquoise;border: 1px solid turquoise; width:200px">' : 'red;border: 1px solid red; width:200px">';
            echo $_GET['message'].'</div> <br>';
        }
        ?>

        <!-- Transaction form -->
        <div class="container m-0">
            <div class="row">
                <div class="col">
                    <div class="form-group py-2">
                        <!-- Display service icon -->
                        <div class="input-field">
                            <span class="fa fa-credit-card p-1"></span>
                            <input type="text" value="<?= $transaction_data['tarif'] ?>" required disabled>
                        </div>
                        <!-- Additional input fields if needed -->
                        <input type="text">
                    </div>

                    <!-- Payment form -->
                    <form action="<?= site_url('/transaction_proses') ?>" method="post">
                        <!-- Hidden input for service information -->
                        <input type="text" id="service" name="service" value="<?= $transaction_data['service'] ?>" hidden>
                        <!-- Button to submit payment -->
                        <button type="submit" class="btn btn-danger btn-full">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection() ?>
