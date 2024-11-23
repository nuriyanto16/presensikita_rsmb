<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class PelatihanInput extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelatihan_model', 'mod');
		$this->load->model('notifmail_model', 'mnotif');
	}

	 // Untuk Post insert/update pengajuan izin
	public function index_post()
	{

		$pengajuan_id = trim($this->post('pengajuan_id'));
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		$periode = trim($this->post('periode'));
		$nm_lembaga = trim($this->post('nm_lembaga'));
		$nm_training = trim($this->post('nm_training'));
		$tempat_tr = trim($this->post('tempat_tr'));
		$tgl_start_tr = trim($this->post('tgl_start_tr'));
		$tgl_end_tr  = trim($this->post('tgl_end_tr'));	
		$catatan = trim($this->post('catatan'));	
		$upload_files = $this->post('upload_files');
		$uploadfoto = array('file_name'=>'');
		$stat_simpan = 0;
		$success = true;

		if ($nik !== null || $comp_code !== null || $start_izin !== null || $end_date !== null ) {

        	$date = date("Y-m-d H:i:s");
        	//UPLOAD FILE
        	$x=0;
        	$cnt_file = count($upload_files);
        	$new_name = "";
        	$str = "";
        	$imageGenerate="";
        	$stat_generate=0;
        	$params_image ="";
        	while ( $x < $cnt_file) {
        		$str = explode(",", $upload_files[$x]);
        		$stat_generate = $str[0];
        		$imageGenerate = $str[1];
        		if($stat_generate == 1){
        			$new_name = $this->generateImage($imageGenerate,'png','PELATIHAN',$nik,$comp_code);
        		}else{
        			$new_name = $imageGenerate;
        		}
                $params_image = $new_name.";".$params_image;
        		$x++;	
        	}
        	$params_image_input = rtrim($params_image, "; ");
        	//UPLOAD FILE
        	$periode = date("Y");
        	$execute = $this->mod->InsUpdPelatihan($pengajuan_id, $nik, $comp_code, $periode, 
        		$date, $nm_lembaga, $nm_training, $tempat_tr, 
        		$this->_fyyyymmdd($tgl_start_tr), $this->_fyyyymmdd($tgl_end_tr), 
        		$catatan, $cnt_file, $params_image_input );	 	
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
				//$res = $this->mnotif->KonfirmasiEmail($nik,'TR');
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

	//Edit/Preview Detail Pelatihan
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
			$row = $this->mod->getPelatihanEdit($pengajuan_id);
			$DataAttach = $this->mod->getAttachment($pengajuan_id);
		} 
		
		if ($row) {

    		$build_array = array();
    		$linkpath = base_url().'uploads/pelatihan/'.$comp_code.'/';
	        foreach ($DataAttach as $row_attach) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row_attach->ID_AJU,
	                	"seq_atc" => $row_attach->SEQ_ATC,
	                	"file_name" => $row_attach->URL_ATC_TRAINING,
	                	"link" => $linkpath.$row_attach->URL_ATC_TRAINING,
	                	"base64" => $row_attach->URL_ATC_TRAINING,
	                	"is_new" => 0
	                )
	            );
	        }

			$this->response([
				"status" => true,
            	"pengajuan_id" => $row->ID_AJU,
            	"tanggal" => $row->TGL_AJU,
            	"nm_training" => $row->NM_TRAINING,
                "nm_lembaga" => $row->NM_LEMBAGA,
                "tempat_tr" => $row->TEMPAT_TR,
                "tgl_start_tr" => $row->TGL_START_TR,
                "tgl_end_tr" => $row->TGL_END_TR,
                "catatan" => $row->CATATAN,
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

	//GENERATE IMAGE BASE64 TO IMAGE
	public function generateImage($img,$image_type,$pengajuan_id,$nik,$comp_code)
    {
        $folderPath =  upload_path.'/pelatihan/'.$comp_code.'/';
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
