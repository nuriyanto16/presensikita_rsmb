<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class PengajuanList extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengajuan_model', 'mod');
	}

	// Daftar Pengajuan 
	public function daftar_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');
		$jns_aju = $this->get('jns_aju');
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {
			//GET DETAIL HISTORY PENGAJUAN
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
        	$status = -1;
			$res = $this->mod->getPengajuanList($nik,$comp_code,
			$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),
			$periode,$status,$jns_aju);
			$year=date('Y');
		} 
		
		if ($res) {

    		$build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"menu_id" => $row->MENU_ID,
	                	"tanggal" => $row->TGL_AJU,
	                    "nama_pengajuan" => $row->DESC_AJU,
	                    "nama" => $row->NAMA_KARYAWAN,
	                    "status_pengajuan" => $row->STAT_PENGAJUAN,
	                    "status_id" => $row->STS_AJU
	                )
	            );
	        }

			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $year,
				'status' => true,
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

	// Daftar History/Riwayat
	public function history_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');
		$status = $this->get('status');
		$jns_aju = $this->get('jns_aju');
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {
			//GET DETAIL HISTORY PENGAJUAN
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
			$res = $this->mod->getHistoryPengajuanList($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),$periode,$status,$jns_aju);
			$year=date('Y');
		} 
		
		if ($res) {

    		$build_array = array();
    		$nominal = "";
	        foreach ($res as $row) {

	        	if($row->MENU_ID==4){
	        		$nominal = "Rp. ".$this->to_rupiah($row->HEAD_TEXT2);
	        	}else{
	        		$nominal = "";
	        	}

	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"menu_id" => $row->MENU_ID,
	                	"tanggal" => $row->TGL_AJU,
	                    "nama_pengajuan" => $row->DESC_AJU,
	                    "tipe_pengajuan" => $row->TIPE_PENGAJUAN,
	                    "nama" => $row->NAMA_KARYAWAN,
	                    "nominal" => $nominal,
	                    "status_pengajuan" => $row->STAT_PENGAJUAN,
	                    "status_id" => $row->STS_AJU
	                )
	            );
	        }

			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $year,
				'status' => true,
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data not found',
				'tahun' => $year,
				'status' => false,
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}


    // Untuk mendapatkan type Pengajuan
    public function type_get()
	{
		$nik = trim($this->post('id'));
		$comp_code = trim($this->post('comp_code'));
		if ($nik !== null || $comp_code !== null){
			$res = $this->mod->getPengajuanType($nik,$comp_code);
		}

		if ($res) {

	        $build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"jns_aju" => $row->JNS_AJU,
	                    "nama_pengajuan" => $row->DESC_AJU
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
				'message' => $msg_err,
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}

    function to_rupiah($bil=null){
        $rupiah = number_format($bil, 0, ',', '.');
        return $rupiah;
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
