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
class Padamel extends CI_Controller
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

		$this->load->model('Padamel_model', 'Pdml_model');
	}
	public function index_get()
	{
		// untuk mendapatkan parameter id
		$area = $this->get('area');
		$nik = $this->get('nik');

		if ($area === null) {
			if ($nik === null) { // jika area dan nik = NULL
				$karyawan = $this->Pdml_model->getPadamel();
			} else {
				$karyawan = $this->Pdml_model->getPadamel(null, $nik);
			}
		} else {
			if ($nik === null) {
				$karyawan = $this->Pdml_model->getPadamel($area, null);
			} else {
				$karyawan = $this->Pdml_model->getPadamel($area, $nik);
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
