<?php

// ************************************************************************
// Ini ditambahkan untuk REST
// ************************************************************************
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// Extend nya tetep ke CI_Controller bukan ke REST_Controller
class Aktivasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'mod');
	}

    public function index()
    {

		$hp1 = $this->input->get('hp1');
		$kode_aktif = $this->input->get('kode_aktif');
		$imei1 = $this->input->get('imei1');

        $dataPengguna = array('NON_AKTIP' => 0);
        $dataKaryawan = array('IMEI1' => $imei1);

        //UPDATE KE PENGGUNA & KARYAWAN
		if($this->mod->UpdatePengguna($kode_aktif,$dataPengguna) && $this->mod->UpdateKaryawan($hp1,$dataKaryawan)){
			echo 'Aktivasi berhasil, Silakan buka aplikasi mobile PresensiKita !';
			exit();
		}else{
			echo 'Aktivasi Gagal, Silahkan hubungi HC Anda !';
			exit();
		}

    }


}
