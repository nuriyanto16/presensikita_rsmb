<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class ReimburseList extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reimburse_model', 'mod');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {

			//GET DETAIL HISTORY REIMBURSE
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
        	$status = 1;
			$res = $this->mod->getReimburseList($nik,$comp_code,
				$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),
				$periode,$status);
			$year=date('Y');
		} 
		
		if ($res) {

    		$build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"id" => $row->NIK,
	                	"tanggal" => $row->TGL_AJU,
	                	"tanggal_kuitansi" => $row->TGL_AJU,
	                	"jenis_reimburse_id" => $row->JNS_AJU,
	                    "nama_reimburse" => $row->DESC_GANTIB,
	                    "nominal" => "Rp. ".$this->to_rupiah($row->NOM_KUITANSI),
	                    "keterangan" => $row->KET_GANTIB,
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
