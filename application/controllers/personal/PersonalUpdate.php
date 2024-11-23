<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class PersonalUpdate extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Personalinfo_model', 'mod');
	}

	public function index_post()
	{
		// untuk mendapatkan parameter id
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));

        $ktp = trim($this->post('URL_KTP'));
        $sim = trim($this->post('URL_SIM'));
        $npwp = trim($this->post('URL_NPWP'));
        $bpjstk = trim($this->post('URL_BPJSTK'));
        $bpjskes = trim($this->post('URL_BPJSKES'));
        $aia = trim($this->post('URL_AIA'));
        $asuransi = trim($this->post('URL_ASURANSI'));
        $profile = trim($this->post('URL_PROFILE'));

		$uploadfotoktp = array('file_name'=>'');
		$uploadfotosim = array('file_name'=>'');
		$uploadfotonpwp = array('file_name'=>'');
		$uploadfotobpjs_tk = array('file_name'=>'');
		$uploadfotobpjs_kes = array('file_name'=>'');
		$uploadfotoaia = array('file_name'=>'');
        $uploadfotoasuransi = array('file_name'=>'');
        $uploadfotoprofile = array('file_name'=>'');

		$success = true;
		$success_foto_ktp = false;
		$success_foto_sim = false;
		$success_foto_npwp = false;
		$success_foto_bpjstk = false;
		$success_foto_bpjskes = false;
		$success_foto_aia = false;
        $success_foto_asuransi = false;
        $success_foto_profile = false;

		if ($nik !== null || $comp_code !== null ) {

			//UPLOAD KTP
            if(isset($_FILES['foto_ktp']['name'])){
                if($_FILES['foto_ktp']['name'] != ""){
                    $uploadfotoktp = $this->doUpload("foto_ktp", $nik, $comp_code);
                    $success_foto_ktp = $uploadfotoktp['success'];
                    $msg = (!$success) ? $uploadfotoktp['message'] : "";
                    $msg_err=$msg;
                }
            }

			//UPLOAD SIM
            if(isset($_FILES['foto_sim']['name'])){
                if($_FILES['foto_sim']['name'] != ""){
                    $uploadfotosim = $this->doUpload("foto_sim", $nik, $comp_code);
                    $success_foto_sim = $uploadfotosim['success'];
                    $msg = (!$success) ? $uploadfotosim['message'] : "";
                    $msg_err=$msg;
                }
            }

			//UPLOAD NPWP
            if(isset($_FILES['foto_npwp']['name'])){
                if($_FILES['foto_npwp']['name'] != ""){
                    $uploadfotonpwp = $this->doUpload("foto_npwp", $nik, $comp_code);
                    $success_foto_npwp = $uploadfotonpwp['success'];
                    $msg = (!$success) ? $uploadfotonpwp['message'] : "";
                    $msg_err=$msg;
                }
            }

			//UPLOAD BPJS TK
            if(isset($_FILES['foto_bpjs_tk']['name'])){
                if($_FILES['foto_bpjs_tk']['name'] != ""){
                    $uploadfotobpjs_tk = $this->doUpload("foto_bpjs_tk", $nik, $comp_code);
                    $success_foto_bpjstk = $uploadfotobpjs_tk['success'];
                    $msg = (!$success) ? $uploadfotobpjs_tk['message'] : "";
                    $msg_err=$msg;
                }
            }

			//UPLOAD BPJS KESEHATAN
            if(isset($_FILES['foto_bpjs_kes']['name'])){
                if($_FILES['foto_bpjs_kes']['name'] != ""){
                    $uploadfotobpjs_kes = $this->doUpload("foto_bpjs_kes", $nik, $comp_code);
                    $success_foto_bpjskes = $uploadfotobpjs_kes['success'];
                    $msg = (!$success) ? $uploadfotobpjs_kes['message'] : "";
                    $msg_err=$msg;
                }
            }

			//UPLOAD AIA
            if(isset($_FILES['foto_aia']['name'])){
                if($_FILES['foto_aia']['name'] != ""){
                    $uploadfotoaia = $this->doUpload("foto_aia", $nik, $comp_code);
                    $success_foto_aia = $uploadfotoaia['success'];
                    $msg = (!$success) ? $uploadfotoaia['message'] : "";
                    $msg_err=$msg;
                }
            }

			//UPLOAD ASURANSI
            if(isset($_FILES['foto_asuransi']['name'])){
                if($_FILES['foto_asuransi']['name'] != ""){
                    $uploadfotoasuransi = $this->doUpload("foto_asuransi", $nik, $comp_code);
                    $success_foto_asuransi = $uploadfotoasuransi['success'];
                    $msg = (!$success) ? $uploadfotoasuransi['message'] : "";
                    $msg_err=$msg;
                }
            }

            //UPLOAD PROFILE
            if(isset($_FILES['foto_profile']['name'])){
                if($_FILES['foto_profile']['name'] != ""){
                    $uploadfotoprofile = $this->doUpload("foto_profile", $nik, $comp_code);
                    $success_foto_profile = $uploadfotoprofile['success'];
                    $msg = (!$success) ? $uploadfotoprofile['message'] : "";
                    $msg_err=$msg;
                }
            }

            if($success){
	        	$dataIns = array(
		            'URL_KTP' =>  ($success_foto_ktp ? $uploadfotoktp['file_name'] : $ktp) ,
		            'URL_SIM' =>  ($success_foto_sim ? $uploadfotosim['file_name'] : $sim) ,
		            'URL_NPWP' =>  ($success_foto_npwp ? $uploadfotonpwp['file_name'] : $npwp) ,
		            'URL_BPJSTK' =>  ($success_foto_bpjstk ? $uploadfotobpjs_tk['file_name'] : $bpjstk) ,
		            'URL_BPJSKES' =>  ($success_foto_bpjskes ? $uploadfotobpjs_kes['file_name'] : $bpjskes) ,
		            'URL_AIA' =>  ($success_foto_aia ? $uploadfotoaia['file_name'] : $aia) ,
                    'URL_ASURANSI' =>  ($success_foto_asuransi ? $uploadfotoasuransi['file_name'] : $asuransi),
                    'URL_FOTO' =>  ($success_foto_profile ? $uploadfotoprofile['file_name'] : $profile)
		        );

		        //INSERT KE ABSENSI
				if($this->mod->UpdatePengguna($dataIns,$nik)){
					$success =  true;
				}else{
					$success =  false;
				}
            }

		} 
		
		if ($success) {
			$this->response([
				'status' => true,
				'message' => 'Absensi berhasil disimpan'
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 404); // NOT_FOUND (404) being the HTTP response code
		}
	}


    private function doUpload($file, $nik, $comp_code) {
        $this->load->library('upload');
        $this->load->library('image_lib');


        $response = array();
        $new_name = '';

        //$config['upload_path'] = dirname($_SERVER['SCRIPT_FILENAME']).'/assets/upload/konfirmasi/';
        //$config['upload_path'] = 'C:/WEB/uploads/filesdoc/'.$apl_id.'-'.$plg_id;
        //$config['upload_path'] = '/var/www/seuneu.trisula.com/html/uploads/absensi/';
        //$config['upload_path'] = '/uploads/absensi'; 
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '20971520';

        //$config['max_size'] = '2048';
        //$config['max_size'] = '2603471';

        $pfx="";
        switch($file){
            case "foto_ktp" : $pfx="_ktp"; $config['upload_path'] = upload_path.'personal/ktp/'.$comp_code.'/'; break;
            case "foto_sim" : $pfx="_sim"; $config['upload_path'] = upload_path.'personal/sim/'.$comp_code.'/'; break;
            case "foto_npwp" : $pfx="_npwp"; $config['upload_path'] = upload_path.'personal/npwp/'.$comp_code.'/'; break;
            case "foto_bpjs_tk" : $pfx="_bpjs_tk"; $config['upload_path'] = upload_path.'personal/bpjs_tk/'.$comp_code.'/'; break;
            case "foto_bpjs_kes" : $pfx="_bpjs_kes"; $config['upload_path'] = upload_path.'personal/bpjs_kes/'.$comp_code.'/'; break;
            case "foto_aia" : $pfx="_aia"; $config['upload_path'] = upload_path.'personal/aia/'.$comp_code.'/'; break;
            case "foto_asuransi" : $pfx="_asuransi"; $config['upload_path'] = upload_path.'personal/asuransi/'.$comp_code.'/'; break;
            case "foto_profile" : $pfx="_profile"; $config['upload_path'] = upload_path.'personal/photo/'; break;
            default: $pfx="err"; break;
        }

        $new_name = str_replace(":","_",trim($_FILES[$file]['name']));
        $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code."_".$new_name;
        $new_name = str_replace(" ","_",$new_name);

        $config['file_name']        = $new_name;
        $config['image_library']    = 'GD2';
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 20;
        $config['height']           = 20;
        $this->upload->initialize($config);
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();

        
        $success = true;
        $msg = '';
        try{
            $this->upload->do_upload($file);
            $msg = 'Upload successfully!';
        }catch(Exception $e){
            $success = false;
            $msg = $e->getMessage();
        }
        
        $response['success'] = $success;
        $response['file_name'] = $new_name;
        $response['message'] = $msg.';'.$new_name;
        
        return $response;
    }

}
