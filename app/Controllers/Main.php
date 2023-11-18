<?php

namespace App\Controllers;

class Main extends BaseController
{
    public function index()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();
        $session->remove('transaction_data');
        
        // Mendapatkan nilai token dari query string
        $jwtToken = $session->get('jwtToken');
        
        // Jika tidak ada token, redirect ke halaman login
        if (!$jwtToken) {
            return redirect()->to(site_url('/login'));
        }

        // Mendapatkan saldo dan data layanan dari API
        $balance = $this->show_API($jwtToken, 'balance');
        $balance = $balance['balance'];
        $arrayService = $this->show_API($jwtToken, 'services');
        $arrayBanner = $this->show_API($jwtToken, 'banner');
        $profile = $this->show_API($jwtToken, 'profile');

        // Data yang ingin Anda kirimkan ke view
        $data = [
            'title' => 'Menu Utama',
            'navbar_menu' => '',
            'profile' => $profile,
            'balance' => $balance,
            'services' => $arrayService,
            'banners' => $arrayBanner
            // Mungkin Anda ingin menyertakan data lainnya
        ];

        // Memanggil view beranda dan layout utama
        return view('dashboard/index', $data);
    }

    public function topup()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();
        $session->remove('transaction_data');
        
        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');
        
        // Jika tidak ada token, redirect ke halaman login
        if (!$jwtToken) {
            return redirect()->to(site_url('/login'));
        }
        
        // Mendapatkan saldo dan profil dari API
        $balance = $this->show_API($jwtToken, 'balance');
        $balance = $balance['balance'];
        $profile = $this->show_API($jwtToken, 'profile');

        // Data yang ingin Anda kirimkan ke view
        $data = [
            'title' => 'Top Up',
            'navbar_menu' => 'Top Up',
            'token' => $jwtToken,
            'profile' => $profile,
            'balance' => $balance
            // Mungkin Anda ingin menyertakan data lainnya
        ];

        // Memanggil view beranda dan layout utama
        return view('transaction/topup', $data);
    }

    public function topup_proses()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();
        $session->remove('transaction_data');
        
        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');

        // Mendapatkan jumlah top-up dari formulir
        $topup_amount = $this->request->getPost('topupAmount');
        
        // Menyiapkan data untuk permintaan API
        $postData = [
            'top_up_amount' => $topup_amount
        ];
        
        // API endpoint
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/topup';
        
        // Konfigurasi untuk panggilan API cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); // Set tipe permintaan ke POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Kirim data POST sebagai JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $jwtToken,
            'Content-Type: application/json',
        ]);

        // Eksekusi panggilan API
        $response = curl_exec($ch);

        // Handle respons dari panggilan API
        if ($response) {
            $responseData = json_decode($response, true);

            // Lakukan sesuatu dengan data yang diterima
            $result = isset($responseData) ? $responseData : [];

            // Tutup koneksi cURL
            curl_close($ch);
        } else {
            // Handle kesalahan cURL
            echo 'Error while making API call: ' . curl_error($ch);

            // Tutup koneksi cURL
            curl_close($ch);
        }

        // Jika tidak ada hasil, set pesan kosong
        if (!$result) {
            $result['message'] = '';
        }

        // Redirect ke halaman top-up dengan pesan hasil API
        return redirect()->to(site_url('/topup?message=' . $result['message']));
    }

    public function transaction_service()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();
        
        // Jika tidak ada data transaksi dalam sesi, ambil dari URL dan simpan dalam sesi
        if (!$session->get('transaction_data')) {
            // Ambil parameter dari URL
            $service = $this->request->getGet('service');
            $name = $this->request->getGet('name');
            $tarif = $this->request->getGet('tarif');

            // Simpan parameter dalam sesi sebagai array
            $transaction_data = [
                'service' => $service,
                'name' => $name,
                'tarif' => $tarif,
            ];
            $session->set('transaction_data', $transaction_data);
        } else {
            $transaction_data = $session->get('transaction_data');
        }
        
        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');
        
        // Jika tidak ada token, redirect ke halaman login
        if (!$jwtToken) {
            return redirect()->to(site_url('/login'));
        }
        
        // Mendapatkan saldo dan profil dari API
        $balance = $this->show_API($jwtToken, 'balance');
        $balance = $balance['balance'];
        $profile = $this->show_API($jwtToken, 'profile');

        // Data yang ingin Anda kirimkan ke view
        $data = [
            'title' => 'Transaction',
            'navbar_menu' => '',
            'token' => $jwtToken,
            'profile' => $profile,
            'balance' => $balance,
            'transaction_data' => $transaction_data
            // Mungkin Anda ingin menyertakan data lainnya
        ];

        // Memanggil view beranda dan layout utama
        return view('transaction/transaction', $data);
    }

    public function transaction_service_proses()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();

        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');

        // Mendapatkan kode layanan dari formulir
        $service_code = $this->request->getPost('service');
        
        // Menyiapkan data untuk permintaan API
        $postData = [
            'service_code' => $service_code
        ];
        
        // API endpoint
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/transaction';
        
        // Konfigurasi untuk panggilan API cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); // Set tipe permintaan ke POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Kirim data POST sebagai JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $jwtToken,
            'Content-Type: application/json',
        ]);

        // Eksekusi panggilan API
        $response = curl_exec($ch);

        // Handle respons dari panggilan API
        if ($response) {
            $responseData = json_decode($response, true);

            // Lakukan sesuatu dengan data yang diterima
            $result = isset($responseData) ? $responseData : [];

            // Tutup koneksi cURL
            curl_close($ch);
        } else {
            // Handle kesalahan cURL
            echo 'Error while making API call: ' . curl_error($ch);

            // Tutup koneksi cURL
            curl_close($ch);
        }

        // Jika tidak ada pesan, set pesan kosong
        if (!$result['message']) {
            $result['message'] = '';
        }

        // Redirect ke halaman transaksi dengan pesan hasil API
        return redirect()->to(site_url('/transaction?service=' . $service_code . '&message=' . $result['message']));
    }

    public function transaction_history()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();
        $session->remove('transaction_data');
        
        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');
        
        // Jika tidak ada token, redirect ke halaman login
        if (!$jwtToken) {
            return redirect()->to(site_url('/login'));
        }
        
        // Mendapatkan offset dari URL (halaman berikutnya)
        $n_offset = $this->request->getGet('n');
        
        // Jika offset tidak ada, set ke 0
        if (!$n_offset) {
            $n_offset = 0;
        }
        
        // Mendapatkan saldo, profil, dan riwayat transaksi dari API
        $balance = $this->show_API($jwtToken, 'balance');
        $balance = $balance['balance'];
        $profile = $this->show_API($jwtToken, 'profile');
        $history = $this->show_API($jwtToken, 'transaction/history?offset=' . $n_offset . '&limit=5');
        
        // Format ulang tanggal dalam riwayat transaksi
        foreach ($history['records'] as &$record) {
            if (isset($record['created_on'])) {
                $createdOn = new \DateTime($record['created_on']);
                $record['formatted_created_on'] = $createdOn->format('d F Y H:i \W\I\B');
            }
        }

        // Data yang ingin Anda kirimkan ke view
        $data = [
            'title' => 'History',
            'navbar_menu' => 'Transaction',
            'token' => $jwtToken,
            'profile' => $profile,
            'balance' => $balance,
            'history' => $history['records']
            // Mungkin Anda ingin menyertakan data lainnya
        ];

        // Memanggil view beranda dan layout utama
        return view('transaction/history', $data);
    }

    private function show_API($jwtToken, $api_show)
    {
        if ($jwtToken) {
            // URL API
            $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/' . $api_show;
            
            // Konfigurasi cURL untuk panggilan API
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $jwtToken,
                'Content-Type: application/json',
            ]);

            // Eksekusi panggilan API
            $response = curl_exec($ch);

            // Handle respons dari panggilan API sesuai kebutuhan
            // Handle respons dari panggilan API sesuai kebutuhan
            if ($response) {
                $responseData = json_decode($response, true);

                // Lakukan sesuatu dengan data yang diterima
                $result = isset($responseData['data']) ? $responseData['data'] : [];

                // Data yang ingin Anda kirimkan ke view
                
            } else {
                echo 'Error while making API call: ' . curl_error($ch);
            }

            // Tutup koneksi cURL
            curl_close($ch);
        }
        return $result;
    }
}