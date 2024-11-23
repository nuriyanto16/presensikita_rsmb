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
class Kontak extends CI_Controller
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

		// $this->load->model('Mahasiswa_model', 'Mhs_model');
	}
	public function index_get()
	{
		$id = $this->get('iduser');
		if ($id == '') {
			$kontak = $this->db->get('t_user')->result();
		} else {
			$this->db->where('iduser', $id);
			$kontak = $this->db->get('t_user')->result();
		}
		$this->response($kontak, 200);
	}
}
