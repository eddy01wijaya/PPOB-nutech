<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();
        $session->start();
            
        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');

        // Jika token sudah ada, redirect ke halaman utama
        if($jwtToken){
            return redirect()->to(site_url('/'));
        } else {
            // Data yang ingin Anda kirimkan ke view
            $data = [
                'title' => 'Login',
                'token' => $jwtToken
                // Mungkin Anda ingin menyertakan data lainnya
            ];
    
            // Memanggil view login dan layout utama
            return view('auth/login', $data);
        }
    }

    public function login_proses()
    {
        // Load the curl library
        //$curl = \Config\Services::curlrequest();

        // Mengambil data input dari formulir
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Menyiapkan data untuk permintaan API
        $postData = [
            'email' => $email,
            'password' => $password,
        ];

        // API endpoint
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/login';

        // Konfigurasi untuk panggilan API cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); // Set tipe permintaan ke POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Kirim data POST sebagai JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        // Eksekusi panggilan API
        $response = curl_exec($ch);

        // Handle respons dari panggilan API
        if ($response) {
            $responseData = json_decode($response, true);

            // Lakukan sesuatu dengan data yang diterima
            $jwtToken = isset($responseData['data']) ? $responseData['data'] : [];

            // Tutup koneksi cURL
            curl_close($ch);
        } else {
            // Handle kesalahan cURL
            echo 'Error while making API call: ' . curl_error($ch);

            // Tutup koneksi cURL
            curl_close($ch);
        }

        // Jika token berhasil diterima, set session dan redirect ke halaman utama
        if ($jwtToken) {
            $session = \Config\Services::session();
            $session->start();
            
            $session->set('jwtToken', $jwtToken['token']);
            $session->markAsTempdata('jwtToken', 43200);

            $message = '';
        } else {
            // Jika token tidak diterima, tambahkan pesan kesalahan
            $message = '?message=salah';
        }
        
        return redirect()->to(site_url('/login'.$message));
    }

    public function logout()
    {
        // Hancurkan sesi dan redirect ke halaman login
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to(site_url('/login'));
    }

    public function register(): string
    {
        // Data yang ingin Anda kirimkan ke view
        $data = [
            'title' => 'Register',
            // Mungkin Anda ingin menyertakan data lainnya
        ];

        // Memanggil view register dan layout utama
        return view('auth/register', $data);
    }

    public function profile(): string
    {
        // Memulai atau melanjutkan sesi
        $session = \Config\Services::session();

        // Mengambil nilai token dari sesi
        $jwtToken = $session->get('jwtToken');

        // Jika token ada, dapatkan data profil dari API
        if ($jwtToken) {
            // URL API untuk layanan profil
            $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/profile';

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
            if ($response) {
                $responseData = json_decode($response, true);

                // Lakukan sesuatu dengan data yang diterima
                $profile = isset($responseData['data']) ? $responseData['data'] : [];

                // Data yang ingin Anda kirimkan ke view
            } else {
                echo 'Error while making API call: ' . curl_error($ch);
            }

            // Tutup koneksi cURL
            curl_close($ch);
        }

        // Data yang ingin Anda kirimkan ke view
        $data = [
            'title' => 'Profile',
            'navbar_menu' => 'Akun',
            'profile' => $profile
            // Mungkin Anda ingin menyertakan data lainnya
        ];

        // Memanggil view profile dan layout utama
        return view('account/profile', $data);
    }

    public function profile_proses()
    {
        // Load the curl library
        //$curl = \Config\Services::curlrequest();

        // Mendapatkan data input dari formulir
        $session = \Config\Services::session();
        $jwtToken = $session->get('jwtToken');
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');

        // Menyiapkan data untuk permintaan API
        $postData = [
            'first_name' => $first_name,
            'last_name' => $last_name,
        ];

        // API endpoint
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/profile/update';

        // Konfigurasi untuk panggilan API cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Set tipe permintaan ke PUT
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Kirim data PUT sebagai JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $jwtToken, // Sertakan token JWT dalam header
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

        return redirect()->to(site_url('/profile?message='.$result['message']));
    }

    public function profile_image_proses()
    {
        // Get the input data from the form
        $session = \Config\Services::session();
        $jwtToken = $session->get('jwtToken');
        $profileImage = $this->request->getFile('profile_image');

        // Check if the file size is within the allowed limit (100KB)
        $maxFileSize = 100 * 1024; // 100KB in bytes

        if ($profileImage->getSize() > $maxFileSize) {
            // Set an error message
            $errorMessage = 'Error: The file size exceeds the allowed limit (100KB)';
            // Redirect back to the profile page with the error message
            return redirect()->to(site_url('/profile?message=' . urlencode($errorMessage)));
        }

        // Menyiapkan data untuk permintaan API
        $postData = [
            'file' => curl_file_create($profileImage->getTempName(), $profileImage->getClientMimeType(), $profileImage->getName()),
        ];

        // API endpoint
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.app/profile/image';

        // Konfigurasi untuk panggilan API cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Set tipe permintaan ke PUT
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Kirim data PUT dengan file
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $jwtToken, // Sertakan token JWT dalam header
            'Content-Type: multipart/form-data', // Set Content-Type ke multipart/form-data
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

        return redirect()->to(site_url('/profile?message=' . $result['message']));
    }
}
