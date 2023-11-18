<!-- app/Views/beranda.php -->
<?php $this->extend('layout/default') ?>

<?php $this->section('content') ?>
    <!-- Include navbar from layout -->
    <?= $this->include('layout/navbar') ?>
    <div class="m-3">
        <!-- Include user_dashboard from dashboard folder -->
        <?= $this->include('dashboard/user_dashboard') ?>
        <br>
        <h4>Silahkan masukkan</h4>
        <h2>Nominal Top Up</h2>
        <br><br>

        <!-- Display success or error message if present -->
        <div class="container m-0">
            <?php
            if(isset($_GET['message'])){
                echo '<div id="responseMessage" class="text-center" style="color: ';
                echo ($_GET['message'] == 'Top Up Balance berhasil') ? 'turquoise;border: 1px solid turquoise; width:200px">' : 'red;border: 1px solid red; width:200px">';
                echo $_GET['message'].'</div> <br>';
            }
            ?>

            <!-- Input form for top-up amount -->
            <div class="row">
                <div class="col">
                    <form action="<?= site_url('/topup_proses') ?>" method="post">
                        <div class="input-field">
                            <span class="fa fa-credit-card p-1"></span>
                            <input type="number" class="form-control" id="topupAmount" name="topupAmount" min="10000" max="1000000" placeholder="Masukkan Top Up" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-secondary btn-full" id="topupButton" disabled>Top Up</button>
                    </form>
                </div>

                <!-- Predefined top-up amounts buttons -->
                <div class="col">
                    <div class="container m-0">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-full" onclick="fillAmount(10000)">Rp10.000 </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-full" onclick="fillAmount(20000)">Rp20.000 </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-full" onclick="fillAmount(50000)">Rp50.000 </button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-full" onclick="fillAmount(100000)">Rp100.000 </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-full" onclick="fillAmount(250000)">Rp250.000 </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-full" onclick="fillAmount(500000)">Rp500.000 </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection() ?>
