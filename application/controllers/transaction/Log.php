<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
    public function index()
    {
        $this->load->view('DetailCard');
    }

    public function search()
    {
        $logFile = APPPATH . 'logs/log.txt';

        if (file_exists($logFile)) {
            $keyword = $this->input->post('keyword');
            $logContent = file_get_contents($logFile);
            $searchResults = '';

            // Mendapatkan tanggal sekarang
            $currentDate = date('Y-m-d');

            // Memeriksa apakah keyword kosong
            if (empty($keyword)) {
                // Menampilkan semua data berdasarkan tanggal sekarang
                $lines = explode("\n", $logContent);
                foreach ($lines as $line) {
                    if (strpos($line, $currentDate) !== false) {
                        $searchResults .= $this->limitTextLength(htmlspecialchars($line), 200);
                    }
                }
            } else {
                // Melakukan pencarian berdasarkan keyword
                $lines = explode("\n", $logContent);
                foreach ($lines as $line) {
                    if (strpos($line, $keyword) !== false) {
                        $searchResults .= $this->limitTextLength(htmlspecialchars($line), 200);
                    }
                }
            }

            // Mengembalikan hasil pencarian ke pemanggil Ajax
            echo '<pre>' . htmlspecialchars($searchResults) . '</pre>';
        } else {
            echo 'Log file not found.';
        }
    }

    // Fungsi untuk membatasi panjang teks dengan menambahkan ellipsis jika melebihi panjang yang ditentukan
    private function limitTextLength($text, $maxLength)
    {
        if (strlen($text) > $maxLength) {
            $text = substr($text, 0, $maxLength - 3) . '...';
        }
        return $text;
    }
}
