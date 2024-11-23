<?php

require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   //require APPPATH . 'libraries/Format.php';


class SinkronisasiPegawai extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sinkronisasi_model', 'mod');
		$this->load->helper('url');
	}

    public function index_post()
    {

    	$data = (array)json_decode(file_get_contents('php://input'));
		$key 	= $data['key'];
		$cekKaryawan 		= 0;

		if ($key !== null){

			$resKaryawan = $this->mod->getKaryawan($key);
			$resUnit = $this->mod->getUnit($key);
			$resPosisi = $this->mod->getPosition($key);
			$resPersonalize = $this->mod->getPersonalize($key);
			$resUser= $this->mod->getUsers($key);

			$cekKaryawan = ($resKaryawan !== '' ? 1 : 0);

			if ($cekKaryawan == 1) {
				$this->response([
					'status' => true,
					'karyawan' => $resKaryawan,
					'unit' => $resUnit,
					'posisi' => $resPosisi,
					'personalize' => $resPersonalize,
					'user' => $resUser,
					'message' => 'Data teredia !'
				], 200); // OK (200) being the HTTP response code
			}
		}else{

			$this->response([
				'status' => false,
				'karyawan' => null,
				'unit' => null,
				'posisi' => null,
				'message' => 'Data tidak teredia !'
			], 200); // OK (200) being the HTTP response code
		}

	

    }



}
