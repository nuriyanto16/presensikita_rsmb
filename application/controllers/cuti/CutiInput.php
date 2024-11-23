<?php

// ************************************************************************
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   
class CutiInput extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cuti_model', 'mod');
		$this->load->model('notifmail_model', 'mnotif');
	}

	 // Untuk Post insert/update pengajuan cuti
	public function index_post()
	{
		$pengajuan_id = trim($this->post('pengajuan_id'));
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		$cuti_id = trim($this->post('cuti_id'));
		$remark = trim($this->post('remark'));
		$periode = trim($this->post('periode'));
		$start_date = trim($this->post('start_date'));
		$end_date = trim($this->post('end_date'));
		$jml = trim($this->post('jml'));
		$upload_files = $this->post('upload_files');
		$uploadfoto = array('file_name'=>'');
		$success = true;
		$msg_err = "";

		if ($nik !== null || $comp_code !== null || $cuti_id !== null || $remark !== null || 
			$start_cuti !== null || $end_cuti !== null  || $jml !== null) {

        	$date = date("Y-m-d H:i:s");

        	//UPLOAD FILE
        	$x=0;
        	$cnt_file = count($upload_files);
        	$new_name = "";
        	$str = "";
        	$imageGenerate="";
        	$stat_generate=0;
        	$params_image ="";
        	$params_image ="";
        	while ( $x < $cnt_file) {
        		$str = explode(",", $upload_files[$x]);
        		$stat_generate = $str[0];
        		$imageGenerate = $str[1];
        		if($stat_generate == 1){
        			$new_name = $this->generateImage($imageGenerate,'png','CUTI',$nik,$comp_code);
        		}else{
        			$new_name = $imageGenerate;
        		}
                $params_image = $new_name.";".$params_image;
        		$x++;	
        	}
        	$params_image_input = rtrim($params_image, "; ");
        	//UPLOAD FILE
        	$periode = date("Y");
        	$execute = $this->mod->InsUpdCuti($pengajuan_id, $nik, $comp_code, $cuti_id, $remark, $periode, 
        		$date, 
        		$this->_fyyyymmdd($start_date), 
        		$this->_fyyyymmdd($end_date), 
        		$jml, $cnt_file, $params_image_input);	

			if($execute){
				$success =  true;	            
			}else{
				$success =  false;
				$msg_err = "Data gagal disimpan";
			}

		} 
		
		if ($success) {

			//NOTIF EMAIL KE ATASAN
			if($pengajuan_id=='0' || $pengajuan_id==0){
				//$res = $this->mnotif->KonfirmasiEmail($nik,'CT');
			}

			$this->response([
				'status' => true,
				'message' => 'Data berhasil disimpan'
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 200); // OK (200) being the HTTP response code
		}
	}

	// Edit/Preview Detail Izin
	public function edit_get()
	{
		// untuk mendapatkan parameter id
		$pengajuan_id = $this->get('pengajuan_id');
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');

		if ($pengajuan_id !== null) {

			//GET DETAIL HISTORY CUTI
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
        	$status = 1;
			$row = $this->mod->getCutiEdit($pengajuan_id);
			$DataAttach = $this->mod->getAttachment($pengajuan_id);

			$res_sisa_cuti = $this->mod->getSisaCuti($row->NIK,$row->COMP_CODE,$periode);

			$jml_sisa_cuti = (!$res_sisa_cuti) ? 0 : $res_sisa_cuti->JML;

		} 
		
		if ($row!=='') {

    		$build_array = array();
    		$linkpath = base_url().'uploads/cuti/'.$comp_code.'/';
	        foreach ($DataAttach as $row_attach) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row_attach->ID_AJU,
	                	"seq_atc" => $row_attach->SEQ_ATC,
	                	"file_name" => $row_attach->URL_ATC_CUTI,
	                	"link" => $linkpath.$row_attach->URL_ATC_CUTI,
	                	"base64" => $row_attach->URL_ATC_CUTI,
	                	"is_new" => 0
	                )
	            );
	        }

			$this->response([
				"status" => true,
            	"pengajuan_id" => $row->ID_AJU,
            	"id" => $row->NIK,
            	"comp_code" => $row->COMP_CODE,
            	"cuti_id" => $row->CUTI_ID,
            	"remark" => $row->ALASAN_CUTI,
            	"periode" => $periode,
            	"start_date" => $row->TGL_AWAL_CUTI,
            	"end_date" => $row->TGL_AKHIR_CUTI,
				"jml" => $row->JML,
				"jml_sisa_cuti" => $jml_sisa_cuti,
                "status_pengajuan" => $row->STAT_PENGAJUAN,
                "status_id" => $row->STS_AJU,
				'data_attachment' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data not found'
			], 200); // OK (200) being the HTTP response code
		}
	}


    // Untuk mendapatkan type cuti
    public function type_get()
	{
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		if ($nik !== null || $comp_code !== null){
			$res = $this->mod->getCutiType($nik,$comp_code);
		}

		if ($res) {

	        $build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"cuti_id" => $row->CUTI_ID,
	                    "nama_cuti" => $row->CUTI_DESC
	                )
	            );
	        }

			$this->response([
				'status' => true,
				'message' => 'Data berhasil ditampilkan',
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 200); // OK (200) being the HTTP response code
		}
	}

	//GENERATE IMAGE BASE64 TO IMAGE
    public function generateImage_($img,$pengajuan_id,$nik,$comp_code)
    {
        $folderPath =  upload_path.'cuti/'.$comp_code.'/';
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $new_name =  $pengajuan_id.'_'.strtoupper(uniqid()).'_'.date('YmdHis')."_".$nik."_".$comp_code.".".$image_type;
        $file = $folderPath.$new_name;
        file_put_contents($file, $image_base64);
        return $new_name;
    }

	public function generateImage($img,$image_type,$pengajuan_id,$nik,$comp_code)
    {
        $folderPath =  upload_path.'/cuti/'.$comp_code.'/';
        $image_base64 = base64_decode($img);
        $new_name =  $pengajuan_id.'_'.strtoupper(uniqid()).'_'.date('YmdHis')."_".$nik."_".$comp_code.".".$image_type;
        $file = $folderPath.$new_name;
        file_put_contents($file, $image_base64);
        return $new_name;
    }

    //16-12-2019
    public function _fyyyymmdd($date_str){
        $date ="";
        $dd=substr($date_str, 0, 2);
        $mm=substr($date_str, 3, 2);
        $yyyy=substr($date_str, 6, 4);
        $date = $yyyy."-".$mm."-".$dd;
        return $date;
    }

}
 