<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class Personalinfo extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Personalinfo_model', 'mod');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		if ($nik !== null) {
			$row = $this->mod->getPersonalInfo($nik);
		} 
		
		if ($row) {
			$linkpath = base_url().'uploads/personal';
			
    		$build_array = array();
	    	$comp_code  = $row->COMP_CODE.'/';
            array_push($build_array,
                array(
                	"NIK" 					=> $row->NIK,
                	"NAMA" 					=> $row->NAMA,
                	"COMP_CODE" 			=> $row->COMP_CODE,
                	"COMP_NAME" 			=> $row->COMP_NAME,
                	"DEPT" 					=> $row->DEPT,
                	"BAG" 					=> $row->BAG,
                	"TGL_MSK_TRISULA" 		=> $row->TGL_MSK_TRISULA,
                	"TGL_MSK_COMP" 			=> $row->TGL_MSK_COMP,
					"SIM1" 					=> $row->SIM1,
					"TGL_LAHIR" 			=> $row->TGL_LAHIR,
                	"TMP_LAHIR" 			=> $row->TMP_LAHIR,
                	"URL_FOTO" 				=> $row->URL_FOTO,
                	"JNS_KELAMIN" 			=> ($row->JNS_KELAMIN == "1") ? "Laki-laki" : "Perempuan",
                	"STATUS_NIKAH" 			=> $row->STATUS_NIKAH,
                	"AGAMA" 				=> $row->AGAMA,
                	"GOL_DARAH" 			=> $row->GOL_DARAH,
                	"JML_ANAK" 				=> $row->JML_ANAK,
                	"HP1" 					=> $row->HP1,
                	"IMEI1" 				=> $row->IMEI1,
                	"HP2" 					=> $row->HP2,
					"EMAIL_ADDR" 	    	=> $row->EMAIL_ADDR,
					"ALAMAT" 			    => $row->ALAMAT,
                	"KTP" 					=> $row->KTP,
                	"URL_KTP" 				=> $row->URL_KTP,
                	"URL_KTP_DOWNLOAD"		=> ($row->URL_KTP) ? $linkpath.'/ktp/'.$comp_code.$row->URL_KTP : "",
                	"URL_SIM" 				=> $row->URL_SIM,
                	"URL_SIM_DOWNLOAD"   	=> ($row->URL_SIM) ? $linkpath.'/sim/'.$comp_code.$row->URL_SIM : "",
                	"NPWP" 					=> $row->NPWP,
                	"URL_NPWP" 				=> $row->URL_NPWP,
                	"URL_NPWP_DOWNLOAD"   	=> ($row->URL_NPWP) ? $linkpath.'/npwp/'.$comp_code.$row->URL_NPWP : "",
                	"NO_BPJS_TK" 			=> $row->NO_BPJS_TK,
                	"URL_BPJSTK" 			=> $row->URL_BPJSTK,
                	"URL_BPJSTK_DOWNLOAD"   => ($row->URL_BPJSTK) ? $linkpath.'/bpjs_tk/'.$comp_code.$row->URL_BPJSTK : "",
                	"NO_BPJS_KS" 			=> $row->NO_BPJS_KS,
                	"URL_BPJSKES" 			=> $row->URL_BPJSKES,
                	"URL_BPJSKES_DOWNLOAD"  => ($row->URL_BPJSKES) ? $linkpath.'/bpjs_kes/'.$comp_code.$row->URL_BPJSKES : "",
                	"NO_AIA" 				=> $row->NO_AIA,
                	"URL_AIA" 				=> $row->URL_AIA,
                	"URL_AIA_DOWNLOAD"  	=> ($row->URL_AIA) ? $linkpath.'/aia/'.$comp_code.$row->URL_AIA : "",
                	"NO_ASURANSI_KES_SWA" 	=> $row->NO_ASURANSI_KES_SWA,
                	"URL_ASURANSI" 			=> $row->URL_ASURANSI,
					"URL_ASURANSI_DOWNLOAD" => ($row->URL_ASURANSI) ? $linkpath.'/asuransi/'.$comp_code.$row->URL_ASURANSI : "",
					"URL_PROFILE" 			=> $row->URL_PROFILE,
                	"URL_PROFILE_DOWNLOAD" => ($row->URL_PROFILE) ? $linkpath.'/photo/'.$row->URL_PROFILE : "",
                )
            );
	        

			$this->response([
				'status' => true,
				'message' => 'Success',
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data not found',
				'data' => $row
			], 200); // OK (200) being the HTTP response code
		}



	}




}
