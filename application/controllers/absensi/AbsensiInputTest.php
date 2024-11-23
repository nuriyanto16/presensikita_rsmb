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
class AbsensiInputTest extends CI_Controller
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

	public function index_post()
	{
		// untuk mendapatkan parameter id
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		$jam = trim($this->post('jam'));
		$type = trim($this->post('type'));
		$long = trim($this->post('long'));
		$lat = trim($this->post('lat'));
		$lokasi = trim($this->post('lokasi'));
		$device = trim($this->post('device'));
		$uploadfoto = array('file_name'=>'');

		$status_absen_mobile = false;
		$success = false;

		if ($nik !== null || $comp_code !== null || $jam !== null || $long !== null || 
			$lat !== null || $lokasi !== null || $device !== null) {

			//CEK APAKAH KARYAWAN BISA ABSEN DI APLIKASI MOBILE / TIDAK
			$res_absen_mobile = $this->mod->CekAbsenMobile($nik);
			if($res_absen_mobile->STAT_ABSEN_MOBILE == 1){
				$status_absen_mobile  = true;
			}else{
				$status_absen_mobile  = false;
			}
		
			if($status_absen_mobile){

				$id_abs_type = 1;
				$tgl_abs = date("Y-m-d");
				$jam = date("Y-m-d H:i:s");
				$year = date("Y");
	
				//CEK ABSENSI
				$rowCek = $this->mod->getCekAbsensi($nik,$comp_code,$jam,$type);
				$dataArr = $rowCek->RESULT;
				$str_arr = explode (";", $dataArr);  
				  /* Return Dokumentasi
				   0. Status Jadwal : 1=true, 0=false, 
				   1. Status Libur  : 1=true, 0=false,
				   2. Jam Masuk
				   3. Jam Pulang
				   4. Status Terlambat : 1=Tidak Terlambat, 2=Terlambat (Masuk,Terlambat)
				*/
	
				if($dataArr!==null){
					$success = true;
	
					$status_jadwal 	=  $str_arr[0];
					$status_libur 	=  $str_arr[1];
					$jadwal_masuk 	=  $str_arr[2];
					$jadwal_pulang 	=  $str_arr[3];
					$id_abs_type 	=  $type; //$str_arr[4]; 
					$status_pengajuan = 0;
					$message_pengajuan = "";
	
					// print_r($str_arr);
					// exit();
	
					//JIKA JADWAL TIDAK ADA MASUK DI HARI LIBUR MAKA STATUS DIAJUKAN
					if($status_jadwal==0 && $status_libur==1){
						$status_pengajuan = 1;
						$message_pengajuan = " & proses pengajuan absensi";
					}
	
					if($status_jadwal==1 && $status_libur==1){
						$status_pengajuan = 1;
						$message_pengajuan = " & proses pengajuan absensi";
					}

					if($status_jadwal==0 && $status_libur==0){
						$status_pengajuan = 1;
						$message_pengajuan = " & proses pengajuan absensi";
					}
	
					// if($status_jadwal==0 && $status_libur==0){
					// 	$status_pengajuan = 1;
					// 	$message_pengajuan = " & proses pengajuan absensi";
					// }
	
				}else{
					$success = false;
					$msg_err = "Data tidak tersedia";
				}
	
				
				//UPLOAD FILE
				if($success){
					if(isset($_FILES['foto_absen']['name'])){
						if($_FILES['foto_absen']['name'] != ""){
							$uploadfoto = $this->doUpload("foto_absen", $nik, $comp_code);
							$success = $uploadfoto['success'];
							$msg = (!$success) ? $uploadfoto['message'] : "";
							$msg_err=$msg;
						}
					}
				}
	
				if($success){
	
					$url_foto = $uploadfoto['file_name'];
					//INSERT KE TABLE ABSENSI
					if($this->mod->InsertAbsen($type, $nik, $comp_code, $year, $tgl_abs, $jam, $id_abs_type, $long, $lat, $lokasi, $url_foto, $device, $status_pengajuan)){
						$success =  true;
						$message = "Absensi berhasil disimpan". $message_pengajuan;
					}else{
						$success =  false;
					}
				}
				
			}else{
				$success = true;
				$msg_err = "Maaf anda tidak bisa melakukan absensi pada mobile apps, silakan hubungi HC";
				$message = "Maaf anda tidak bisa melakukan absensi pada mobile apps, silakan hubungi HC";
			}


		} 
		
		if ($success) {
			$this->response([
				'status' => true,
				'message' => $message
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 200); // OK (200) being the HTTP response code
		}
	}


    private function doUpload($file, $nik, $comp_code) {
        $this->load->library('upload');
        $response = array();
        $new_name = '';

        //$config['upload_path'] = dirname($_SERVER['SCRIPT_FILENAME']).'/assets/upload/konfirmasi/';
        //$config['upload_path'] = 'C:/WEB/uploads/filesdoc/'.$apl_id.'-'.$plg_id;
        //$config['upload_path'] = '/var/www/seuneu.trisula.com/html/uploads/absensi/'.$comp_code.'/';
        $config['upload_path'] = upload_path.'/absensi/'.$comp_code.'/';
        //$config['upload_path'] = '/uploads/absensi';
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '50%';
        $config['width']= 600;
        $config['height']= 400;
        $config['allowed_types'] = 'jpg|jpeg|png';
        //$config['max_size'] = '20971520';
        //$config['max_size'] = '2048';
        //$config['max_size'] = '2603471';
        
        $pfx="";
        switch($file){
            case "foto_absen" : $pfx="_foto_absensi"; break;
            default: $pfx="err"; break;
        }
        
        $new_name = str_replace(":","_",trim($_FILES[$file]['name']));
        $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code."_".$new_name;
        $new_name = str_replace(" ","_",$new_name);

        $config['file_name'] = $new_name;

        $this->upload->initialize($config);
        
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

    public function generateImage($img,$comp_code)
    {
        $folderPath =  upload_path.'/absensi/'.$comp_code.'/';
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code."_".$new_name;
        $file = $folderPath . uniqid() . '.png';
        file_put_contents($file, $image_base64);
    }

}
