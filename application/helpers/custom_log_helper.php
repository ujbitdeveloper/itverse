<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('custom_log')) {
    /**
     * Custom log dengan folder terpisah
     *
     * @param string $folder  nama folder log (absen, cuti, dll)
     * @param string $message isi log
     * @param string $level   info | error | debug
     */
    function custom_log($folder, $message, $level = 'info')
    {
        $CI = &get_instance();
        $basePath = APPPATH . 'logs/' . $folder . '/';

        // Buat folder jika belum ada
        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }

        // Format nama file per hari
        $filename = 'log-' . date('Y-m-d') . '.log';
        $filePath = $basePath . $filename;

        // Format log
        $time = date('Y-m-d H:i:s');
        $ip = $CI->input->ip_address();
        $log = strtoupper($level) . " - {$time} --> [IP: {$ip}] -- {$message}" . PHP_EOL;

        // Tulis ke file
        file_put_contents($filePath, $log, FILE_APPEND);
    }
}
