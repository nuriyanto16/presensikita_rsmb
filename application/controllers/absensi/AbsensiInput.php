<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class AbsensiInput extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Absensi_model', 'mod');
		$this->load->model('notifmail_model', 'mnotif');
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
		$status_jarak_radius = 0;
		$status_absen_mobile = 0;
		$stat_mobile = 0;
		$message_radius = "";

		$success = false;

		if ($nik !== null || $comp_code !== null || $jam !== null || $long !== null || 
			$lat !== null || $lokasi !== null || $device !== null) {

			//CEK APAKAH KARYAWAN BISA ABSEN DI APLIKASI MOBILE / TIDAK
			$res_absen_mobile = $this->mod->CekAbsenMobile($nik,$comp_code);
			$stat_mobile = $res_absen_mobile->STAT_SALES;
	
			$long_ktr = $res_absen_mobile->LONG;
			$lat_ktr = $res_absen_mobile->LAT;
			$batas_jarak = $res_absen_mobile->BATAS;
			$jarak_radius = $this->getDistanceBetween($lat, $long, $lat_ktr, $long_ktr, 'Km')." Km";

			// $jarak = (float)$jarak_radius; 
			// $batas = (float)$batas_jarak;
			// print_r($jarak.'--'.$batas);
			// exit();
				
			// $message_radius = "";
			if($stat_mobile == 1){
				$status_jarak_radius = 1;
			}else{
				
				if((float)$jarak_radius <= (float)$batas_jarak){
					$status_jarak_radius = 1;
				}else{
					$status_jarak_radius = 0;
					$message_radius = "(anda diluar jarak radius kantor)";
				}
			}	

			if($res_absen_mobile->STAT_ABSEN_MOBILE == 1){
				$status_absen_mobile  = 1;
			}else{
				$status_absen_mobile  = 0;
			}

			// print_r($jarak_radius." --- ".$stat_mobile." -- ".$status_absen_mobile."  -- ".$status_jarak_radius);
			// exit();
			// print_r($status_absen_mobile." ------ ". $status_jarak_radius);
			// exit();
			if($status_absen_mobile == 1 && $status_jarak_radius == 1){

				$id_abs_type = 1;
				$tgl_abs = date("Y-m-d");
				//$jam = $this->getTimeZone("Asia/Jakarta");
				//$jam = "2020-12-08 08:00:00";
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
					$jadwal_masuk 	=  $tgl_abs." ".$str_arr[2];
					$jadwal_pulang 	=  $tgl_abs." ".$str_arr[3];
					$id_abs_type 	=  $type; //$str_arr[4]; 
					$id_tp 			=  $str_arr[5];
					$type_jadwal 	=  $str_arr[6];
					$status_pengajuan = 0;
					$message_pengajuan = "";
	
					//JIKA JADWAL TIDAK ADA MASUK DI HARI LIBUR MAKA STATUS DIAJUKAN
					/*if($status_jadwal==0 && $status_libur==1){
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
					*/

					$status_pengajuan = 0;
	
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
					if($this->mod->InsertAbsen($type, $nik, $comp_code, $year, $tgl_abs, $jam, $id_abs_type, $long, $lat, $lokasi, $url_foto, $device, 
											  $status_pengajuan, $id_tp, $jadwal_masuk, $jadwal_pulang, $type_jadwal)){
						
						if($status_pengajuan==1){
							$res = $this->mnotif->KonfirmasiEmail($nik,'AB');
						}
						
						$success =  true;
						$message = "Absensi berhasil disimpan". $message_pengajuan;
					}else{
						$success =  false;
					}
				}
				
			}else{
				$success = false;
				$msg_err = "Maaf anda tidak bisa melakukan absensi pada mobile apps, silakan hubungi HC ". $message_radius;
				$message = "Maaf anda tidak bisa melakukan absensi pada mobile apps, silakan hubungi HC ". $message_radius;
			}


		} 
		
		if ($success) {
			$this->response([
				'status' => true,
				'message' => $message
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => true,
				'message' => $msg_err
			], 200); // OK (200) being the HTTP response code
		}
	}


    private function doUpload($file, $nik, $comp_code) {
        $this->load->library('upload');
        $response = array();
        $new_name = '';
		$nama_folder = upload_path.'/absensi/'.$comp_code.'/'.date('Y').'/'.date('Ymd').'/';

        //$config['upload_path'] = dirname($_SERVER['SCRIPT_FILENAME']).'/assets/upload/konfirmasi/';
        //$config['upload_path'] = 'C:/WEB/uploads/filesdoc/'.$apl_id.'-'.$plg_id;
        //$config['upload_path'] = '/var/www/seuneu.trisula.com/html/uploads/absensi/'.$comp_code.'/';
		
        //$config['upload_path'] = upload_path.'/absensi/'.$comp_code.'/';
		$config['upload_path'] = $nama_folder;
 
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
        
        // $new_name = str_replace(":","_",trim($_FILES[$file]['name']));
        // $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code."_".$new_name;
        // $new_name = str_replace(" ","_",$new_name);

		$new_name = str_replace(":","_",trim($_FILES[$file]['name']));
		$ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
        $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code.".".$ext;
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
	
    public function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') 
    { 

        // echo "Jarak jakarta bandung = ".$this->getDistanceBetween(-6.211544, 106.845172, -6.9175, 107.6191, 'Km')." Km";
        // exit();

        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        switch($unit) 
        { 
            case 'Mi': break; 
            case 'Km' : $distance = $distance * 1.609344; 
        } 
        return (round($distance,2)); 
	}
	
	public function getTimeZone($tz){
		$timezone = "Asia/Jakarta";
		$timezone = ($tz == "" || $tz == null)? $timezone : $tz;
		$jam = date("Y-m-d H:i:s");
		$dt = new DateTime("now", new DateTimeZone($timezone));
		$jam = $dt->format('Y-m-d H:i:s');
		return $jam;
	}


	public function setDateFolder_get($comp_code = null){
		// Set timezone
		date_default_timezone_set('UTC');
		$comp_code = "ABCDE1";

		// Start date
		$date = '2021-01-01';
		// End dates
		$end_date = '2021-12-31';

		while (strtotime($date) <= strtotime($end_date)) {
			$newDate = date("Ymd", strtotime($date));

			$nama_folder = upload_path.'/absensi/'.$comp_code.'/'.date('Y').'/'.$newDate.'/';
			mkdir($nama_folder,'0777',true); 

			echo "$newDate\n";
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
	}

}
