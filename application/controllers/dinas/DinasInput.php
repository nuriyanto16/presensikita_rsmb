<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class DinasInput extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dinas_model', 'mod');
		$this->load->model('notifmail_model', 'mnotif');
	}

	 // Untuk Post insert/update pengajuan izin
	public function index_post()
	{
		$pengajuan_id = trim($this->post('pengajuan_id'));
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		$periode = trim($this->post('periode'));
		$nm_pejabat = trim($this->post('nm_pejabat'));
		$jabatan = trim($this->post('jabatan'));
		$tujuan = trim($this->post('tujuan'));
		$keperluan = trim($this->post('keperluan'));
		$tgl_brkt = trim($this->post('tgl_brkt'));
		$tgl_plng = trim($this->post('tgl_plng'));
		$all_bdgjkt = trim($this->post('all_bdgjkt'));
		$all_lr_kota = trim($this->post('all_lr_kota'));
		$all_lr_negeri = trim($this->post('all_lr_negeri'));
		$tr_k_prbadi = trim($this->post('tr_k_prbadi'));
		$tr_k_dinas = trim($this->post('tr_k_dinas'));
		$tr_ka = trim($this->post('tr_ka'));
		$tr_pesawat = trim($this->post('tr_pesawat'));
		$tr_travel = trim($this->post('tr_travel'));
		$tr_bus = trim($this->post('tr_bus'));
		$ak_hotel = trim($this->post('ak_hotel'));
		$ak_hotel_nom = trim($this->post('ak_hotel_nom'));
		$ak_hotel_ket = trim($this->post('ak_hotel_ket'));
		$ak_tr_loc = trim($this->post('ak_tr_loc'));
		$ak_tr_loc_nom = trim($this->post('ak_tr_loc_nom'));
		$ak_tr_loc_ket = trim($this->post('ak_tr_loc_ket'));
		$ak_susp = trim($this->post('ak_susp'));
		$ak_susp_nom = trim($this->post('ak_susp_nom'));
		$ak_susp_ket = trim($this->post('ak_susp_ket'));
		$det_peserta = $this->post('det_peserta');
		$upload_files = $this->post('upload_files');
		$uploadfoto = array('file_name'=>'');

		$success = true;
		$cnt_file = 0;
		$cnt_peserta = 0;

		if ($nik !== null || $comp_code !== null || $pejabat_id !== null || $tujuan !== null || $keperluan !== null ) {

        	$date = date("Y-m-d H:i:s");

        	//UPLOAD FILE
        	$x=0;
        	
			$cnt_file = !empty($upload_files) ? count($upload_files) : 0;
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
        			$new_name = $this->generateImage($imageGenerate,'png','DINAS',$nik,$comp_code);
        		}else{
        			$new_name = $imageGenerate;
        		}
                $params_image = $new_name.";".$params_image;
        		$x++;	
        	}

        	$x=0;

        	
        	$params_peserta ="";
			

			$cnt_peserta = !empty($det_peserta) ? count($det_peserta) : 0;

    		while ( $x < $cnt_peserta) {
                $params_peserta = $det_peserta[$x].";".$params_peserta;
        		$x++;	
        	}

        	$params_image_input = rtrim($params_image, "; ");
        	$periode = date("Y");
        	$execute = $this->mod->InsUpdDinas($pengajuan_id, $nik, $comp_code, $periode, $date,
									$nm_pejabat, $jabatan, $tujuan, $keperluan, 
									$this->_fyyyymmdd($tgl_brkt), $this->_fyyyymmdd($tgl_plng), $all_bdgjkt, $all_lr_kota,
									$all_lr_negeri, $tr_k_prbadi, $tr_k_dinas, $tr_ka,
									$tr_pesawat, $tr_travel, $tr_bus, $ak_hotel, $ak_hotel_nom,
									$ak_hotel_ket, $ak_tr_loc, $ak_tr_loc_nom, $ak_tr_loc_ket, $ak_susp,
									$ak_susp_nom, $ak_susp_ket, $cnt_file, $params_image_input, $cnt_peserta, $params_peserta);	
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
				//$res = $this->mnotif->KonfirmasiEmail($nik,'PD');
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

	//Edit/Preview Detail Dinas
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
			$row = $this->mod->getDinasEdit($pengajuan_id);
			$DataAttach = $this->mod->getAttachment($pengajuan_id);
			$DataPeserta = $this->mod->getPeserta($pengajuan_id);

		} 
		
		if ($row) {

    		$build_dinas_array = array();
    		$linkpath = base_url().'uploads/dinas/'.$comp_code.'/';
	        foreach ($DataAttach as $row_attach) {
	            array_push($build_dinas_array,
	                array(
	                	"pengajuan_id" => $row_attach->ID_AJU,
	                	"seq_atc" => $row_attach->SEQ_ATC,
	                	"file_name" => $row_attach->URL_ATC_JALANDINAS,
	                	"link" => $linkpath.$row_attach->URL_ATC_JALANDINAS,
	                	"base64" => $row_attach->URL_ATC_JALANDINAS,
	                	"is_new" => 0
	                )
	            );
	        }

    		$build_peserta_array = array();
	        foreach ($DataPeserta as $row_peserta) {
	            array_push($build_peserta_array,
	                array(
	                	"pengajuan_id" => $row_peserta->ID_AJU,
	                	"id_peserta" => $row_peserta->NIK,
	                	"nama_peserta" => $row_peserta->NAMA
	                )
	            );
	        }

			$this->response([
				"status" => true,
            	"pengajuan_id" => $row->ID_AJU,
            	"tanggal" => $row->TGL_AJU,
            	"nm_pejabat" => $row->NM_PEJABAT,
                "jabatan" => $row->JABATAN,
                "tujuan" => $row->TUJUAN,
                "keperluan" => $row->KEPERLUAN,
                "tgl_brkt" => $row->TGL_BRKT,
                "tgl_plng" => $row->TGL_PLNG,
                "all_bdgjkt" => $row->ALL_BDGJKT,
                "all_lr_kota" => $row->ALL_LR_KOTA,
                "all_lr_negeri" => $row->ALL_LR_NEGERI,
                "tr_k_prbadi" => $row->TR_K_PRIBADI,
                "tr_k_dinas" => $row->TR_K_DINAS,
                "tr_ka" => $row->TR_KA,
                "tr_pesawat" => $row->TR_PESAWAT,
                "tr_travel" => $row->TR_TRAVEL,
                "tr_bus" => $row->TR_BUS,
                "ak_hotel" => $row->AK_HOTEL,
                "ak_hotel_nom" => $row->AK_HOTEL_NOM,
                "ak_hotel_ket" => $row->AK_HOTEL_KET,
                "ak_tr_loc" => $row->AK_TR_LOC,
                "ak_tr_loc_nom" => $row->AK_TR_LOC_NOM,
                "ak_tr_loc_ket" => $row->AK_TR_LOC_KET,
                "ak_susp" => $row->AK_SUSP,
                "ak_susp_nom" => $row->AK_SUSP_NOM,
                "ak_susp_ket" => $row->AK_SUSP_KET,
                "status_pengajuan" => $row->STAT_PENGAJUAN,
                "status_id" => $row->STS_AJU,
				'data_attachment' => $build_dinas_array,
				'data_peserta' => $build_peserta_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data not found'
			], 200); // OK (200) being the HTTP response code
		}
	}


    // Untuk mendapatkan jenis transportasi
    public function JenisTransport_get()
	{
		$nik = trim($this->get('id'));
		$comp_code = trim($this->get('comp_code'));
		if ($nik !== null || $comp_code !== null){
			//$res = $this->mod->getReimburseType($nik,$comp_code);
			$res = true;
		}

		if ($res) {

	        $build_array = array();
	        //foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"id_transport" => 1,
	                    "nama_transport" => "Kendaraan Pribadi"
	                ),
	                array(
	                	"id_transport" => 2,
	                    "nama_transport" => "Kendaraan Dinas"
	                ),
	                array(
	                	"id_transport" => 3,
	                    "nama_transport" => "Kereta Api"
	                ),
	                array(
	                	"id_transport" => 4,
	                    "nama_transport" => "Pesawat"
	                ),
	                array(
	                	"id_transport" => 5,
	                    "nama_transport" => "Travel"
	                ),
	                array(
	                	"id_transport" => 6,
	                    "nama_transport" => "Bus"
	                )
	            );
	        //}

			$this->response([
				'status' => true,
				'message' => 'Data berhasil ditampilkan',
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 404); // NOT_FOUND (404) being the HTTP response code
		}
	}

	// Untuk mendapatkan data pejabat
    public function Pejabat_get()
	{
		$nik = trim($this->get('id'));
		$comp_code = trim($this->get('comp_code'));
		if ($nik !== null || $comp_code !== null){
			$DataPejabat=  $this->mod->getListPejabat($nik,$comp_code);
		}

		if ($DataPejabat) {
	        
			$build_array = array();
	        foreach ($DataPejabat as $row) {
	            array_push($build_array,
	                array(
	                	"id_pejabat" => $row->NIK,
	                    "nama_pejabat" => $row->NAMA,
	                    "jabatan" => $row->JABATAN
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
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}

	// Untuk mendapatkan data peserta lain
    public function Peserta_get()
	{
		$nik = trim($this->get('id'));
		$comp_code = trim($this->get('comp_code'));
		$search = trim($this->get('search'));
		if ($nik !== null || $comp_code !== null){
			//$res = $this->mod->getReimburseType($nik,$comp_code);
			$DataPeserta =  $this->mod->getListPeserta($nik,$comp_code,$search);
		}

		if ($DataPeserta) {
	        
			$build_peserta_array = array();
	        foreach ($DataPeserta as $row_peserta) {
	            array_push($build_peserta_array,
	                array(
	                	"nik_peserta" => $row_peserta->NIK,
	                	"nama_peserta" => $row_peserta->NAMA
	                )
	            );
	        }

			$this->response([
				'status' => true,
				'message' => 'Data berhasil ditampilkan',
				'data' => $build_peserta_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data not found',
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}

	//GENERATE IMAGE BASE64 TO IMAGE
	public function generateImage($img,$image_type,$pengajuan_id,$nik,$comp_code)
    {
        $folderPath =  upload_path.'/dinas/'.$comp_code.'/';
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
