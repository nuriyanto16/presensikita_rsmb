<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class NotifikasiList extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notifikasi_model', 'mod');
	}

	// Daftar Notifikasi 
	public function notif_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {
			//GET DETAIL HISTORY PENGAJUAN
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
			$res = $this->mod->getNotifikasiList($nik,$comp_code,
				$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),$periode);
				$year=date('Y');
		} 
		
		if ($res) {

    		$build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"menu_id" => $row->MENU_ID,
	                	"is_read" => $row->IS_READ,
	                	"nik_notifikasi" => $row->NIK_NOTIFIKASI,
	                	"nik" => $row->NIK,
	                	"nama" => $row->NAMA,
	                	"tanggal" => $row->TGL,
	                    "nama_pengajuan" => $row->DESC_AJU,
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
				'start_date' => $start_date,
				'end_date' => $end_date,
				'status' => false,
				'message' => 'Data not found',
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}

	// Update Status Notifikasi 
	public function update_get()
	{
		// untuk mendapatkan parameter id
		$pengajuan_id = $this->get('pengajuan_id');
		$nik_notifikasi = $this->get('nik_notifikasi');
		$status_id = $this->get('status_id');
		if ($pengajuan_id !== null || $nik_notifikasi !== null || $status_id !== null) {
			//GET DETAIL HISTORY PENGAJUAN
        	$dataIns = array(
	            'IS_READ' =>  1
	        );
        	$execute = $this->mod->UpdateStatusNotifikasi($dataIns, $pengajuan_id, $nik_notifikasi, $status_id);	
			if($execute){
				$success =  true;	            
			}else{
				$success =  false;
				$msg_err = "Data gagal diupdate";
			}
			
		} 
		
		if ($success) {
			$this->response([
				'status' => true,
				'message' => 'Notifikasi berhasil diupdate'
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
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
