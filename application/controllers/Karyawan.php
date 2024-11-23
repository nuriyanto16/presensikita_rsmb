<?php

// ************************************************************************
// Ini ditambahkan untuk REST
// ************************************************************************
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
// ************************************************************************


// Extend nya tetep ke CI_Controller bukan ke REST_Controller
class Karyawan extends CI_Controller
{

	// ************************************************************************
	// Ini ditambahkan untuk REST
	// ************************************************************************
	use REST_Controller {
		REST_Controller::__construct as private __resTraitConstruct;
	}
	// ************************************************************************

	public function __construct()
	{
		parent::__construct();
		// ************************************************************************
		// Ini ditambahkan untuk REST
		// ************************************************************************
		$this->__resTraitConstruct();
		// ************************************************************************

		$this->load->model('Karyawan_model', 'Kar_model');
	}
	public function index_get()
	{
		// untuk mendapatkan parameter id
		$comp_code = $this->get('comp_code');
		$nik = $this->get('nik');

		if ($comp_code === null) {
			if ($nik === null) { // jika area dan nik = NULL
				$karyawan = $this->Kar_model->getKaryawan();
			} else {
				$karyawan = $this->Kar_model->getKaryawan(null, $nik);
			}
		} else {
			if ($nik === null) {
				$karyawan = $this->Kar_model->getKaryawan($comp_code, null);
			} else {
				$karyawan = $this->Kar_model->getKaryawan($comp_code, $nik);
			}
		}

		if ($karyawan) {
			$this->response([
				'status' => true,
				'data' => $karyawan
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'ID not found'
			], 404); // NOT_FOUND (404) being the HTTP response code
		}
	}
}
