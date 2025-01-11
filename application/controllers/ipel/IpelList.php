<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class IpelList extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ipel_model', 'mod');
	}

	public function index_get()
	{
		$username = $_SERVER['PHP_AUTH_USER'] ?? 'Not Set';
		$password = $_SERVER['PHP_AUTH_PW'] ?? 'Not Set';
		$valid_logins = $this->config->item('rest_valid_logins');
		
		// Check if the username exists in the array before accessing it
		if (!isset($valid_logins[$username]) || $valid_logins[$username] !== $password) {
			$this->response([
				'status' => false,
				'message' => "Unauthorized",
			], 401); // 401 Unauthorized HTTP response code
			return;
		}


		// untuk mendapatkan parameter id
		$tahun = $this->get('tahun');
		$bulan = $this->get('bulan');
		$res = null;
		if ($tahun !== null || $bulan !== null) {
			//GET DETAIL HISTORY IPEL
			$res = $this->mod->getIpelList($tahun,$bulan);
		} 
		
		if ($res) {

    		$build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"nik_pegawai" => $row->nik_pegawai,
	                	"nama" => $row->nama,
	                    "fid" => $row->fid,
	                    "nama_unit" => $row->nama_unit,
	                    "nama_posisi" => $row->nama_posisi,
	                    "tahun" => $row->tahun,
	                    "bulan" => $row->bulan,
						"jml_pot_point_kehadiran" => $row->jml_pot_point_kehadiran,
						"jml_pot_point_keterlambatan" => $row->jml_pot_point_keterlambatan
	                )
	            );
	        }

			$this->response([
				'tahun' => $tahun,
				'bulan' => $bulan,
				'status' => true,
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'tahun' => $tahun,
				'bulan' => $bulan,
				'status' => false,
				'message' => 'Data not found',
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}


}
