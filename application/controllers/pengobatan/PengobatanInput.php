<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class PengobatanInput extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengobatan_model', 'mod');
		$this->load->model('Personalinfo_model', 'modk');
		$this->load->model('notifmail_model', 'mnotif');
	}

 	// Untuk Post insert/update pengajuan pengobatan
	public function index_post()
	{
		$pengajuan_id = trim($this->post('pengajuan_id'));
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		$pengobatan_id = trim($this->post('pengobatan_id'));
		$nama_kuitansi = trim($this->post('nama_kuitansi'));
		$tanggal = trim($this->post('tanggal'));
		$diagnosa  = trim($this->post('diagnosa'));
		$nominal  = trim($this->post('nominal'));
		$nilai_diganti  = trim($this->post('nilai_diganti'));
		$periode = trim($this->post('periode'));
		$upload_files = $this->post('upload_files');
		$uploadfoto = array('file_name'=>'');
		$stat_simpan = 0;
		$success = true;

		if ($nik !== null || $comp_code !== null || $start_izin !== null || $end_date !== null) {

        	$date = date("Y-m-d H:i:s");
			$date = $this->_fyyyymmdd($tanggal); // date("Y-m-d H:i:s");
			
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
        			$new_name = $this->generateImage($imageGenerate,'png','PENGOBATAN',$nik,$comp_code);
        		}else{
        			$new_name = $imageGenerate;
        		}
                $params_image = $new_name.";".$params_image;
        		$x++;	
        	}
        	$params_image_input = rtrim($params_image, "; ");
        	//UPLOAD FILE
        	$periode = date("Y");
        	$execute = $this->mod->InsUpdPengobatan($pengajuan_id, $nik, $comp_code, $periode, $date, $pengobatan_id, $nama_kuitansi, $diagnosa, $nominal, $nilai_diganti, $cnt_file, $params_image_input);
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
				//$res = $this->mnotif->KonfirmasiEmail($nik,$pengobatan_id);
			}
			$this->response([
				'status' => true,
				'message' => 'Data berhasil disimpan'
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 200); // NOT_FOUND (404) being the HTTP response code
		}
	}

	//Edit/Preview Detail Izin
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
			$row = $this->mod->getPengobatanEdit($pengajuan_id);
			$DataAttach = $this->mod->getAttachment($pengajuan_id);

		} 
		
		if ($row) {

    		$build_array = array();
    		$linkpath = base_url().'uploads/pengobatan/'.$comp_code.'/';
	        foreach ($DataAttach as $row_attach) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row_attach->ID_AJU,
	                	"seq_atc" => $row_attach->SEQ_ATC,
	                	"file_name" => $row_attach->URL_ATC_OBAT,
	                	"link" => $linkpath.$row_attach->URL_ATC_OBAT,
	                	"base64" => $row_attach->URL_ATC_OBAT,
	                	"is_new" => 0
	                )
	            );
	        }

			$this->response([
				"status" => true,
            	"pengajuan_id" => $row->ID_AJU,
            	"tanggal" => $row->TGL_AJU,
            	"pengobatan_id" => $row->JNS_AJU,
                "jenis_pengobatan" => $row->DESC_AJU,
                "diagnosa" => $row->DIAGNOSA,
                "nama_kuitansi" => $row->NAMA_KUITANSI,
                "nominal" => $row->NOM_KUITANSI,
                "nilai_diganti" => $row->NILAI_DIGANTI,
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

    // Untuk mendapatkan nama kuitansi
    public function NamaKuitansi_get()
	{
		$nik = trim($this->get('id'));
		$comp_code = trim($this->get('comp_code'));
		if ($nik !== null || $comp_code !== null){
			$res = $this->mod->getKeluarga($nik,$comp_code);
			$res_kar = $this->modk->getPersonalInfo($nik);
		}

		if ($res_kar) {

	        $build_array = array();

	        	array_push($build_array,
	                array(
	                	"relasi_kel" => '',
	                	"nama_kuitansi" => $res_kar->NAMA,
	                	"nominal_pengurang" => 0
	                )
	            );

	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"relasi_kel" => $row->RELASI_KEL,
	                	"nama_kuitansi" => $row->NAMA_KEL,
	                	"nominal_pengurang" => 0
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
				'message' => 'Data not found',
			], 200); // OK (200) being the HTTP response code
		}
	}

	//GENERATE IMAGE BASE64 TO IMAGE
	public function generateImage($img,$image_type,$pengajuan_id,$nik,$comp_code)
    {
        $folderPath =  upload_path.'/pengobatan/'.$comp_code.'/';
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