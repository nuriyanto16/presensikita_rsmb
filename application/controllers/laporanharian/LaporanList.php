<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class LaporanList extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Laporan_model', 'mod');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');
		$nik_cari = $this->get('nik_cari');
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {

			//GET DETAIL HISTORY CUTI
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
        	$status = 1;
			$res = $this->mod->getLaporanList($nik,$nik_cari,$comp_code,
					$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),
					$periode,$status);

		} 
		
		if ($res) {

    		$build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"tanggal" => $row->TGL_AWAL_IZIN,
						"nama_izin" => $row->DESC_IZIN,
						"remark" => $row->REMARK,
	                    "tanggal_mulai" => $row->TGL_AWAL_IZIN,
	                    "tanggal_selesai" => $row->TGL_AKHIR_IZIN,
	                    "status_pengajuan" => $row->STAT_PENGAJUAN,
	                    "status_id" => $row->STS_AJU
	                )
	            );
	        }

			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $periode,
				'status' => true,
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $periode,
				'status' => false,
				'message' => 'Data not found',
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
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
