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
class AbsensiSummary extends CI_Controller
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

		$this->load->model('Absensi_model', 'mod');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		if ($nik !== null || $comp_code !== null) {
			$res = $this->mod->getAbsensiSummary($nik,$comp_code);
		} 
		
		if ($res) {
			$this->response([
				'status' => true,
				'data' => $res
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'ID not found'
			], 404); // NOT_FOUND (404) being the HTTP response code
		}
	}




}
