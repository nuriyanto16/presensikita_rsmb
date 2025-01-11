<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Pastikan untuk memuat file PhpSpreadsheet yang dibutuhkan
// require_once(APPPATH . 'third_party/PhpSpreadsheet-1.17.0/src/PhpSpreadsheet/IOFactory.php');
// require_once(APPPATH . 'third_party/PhpSpreadsheet-1.17.0/src/PhpSpreadsheet/Spreadsheet.php');

class PhpSpreadsheet_Loader {

    public function __construct() {
        // Tidak ada yang perlu dilakukan di sini
    }

    public function readExcel($file_path) {
        // Menggunakan PhpSpreadsheet untuk membaca file Excel
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);
        return $spreadsheet;
    }
}
