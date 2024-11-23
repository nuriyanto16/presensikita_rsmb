<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class CutiList extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cuti_model', 'mod');
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
			$year=date('Y');
			//GET DETAIL HISTORY CUTI
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
        	$status = 1;
			$res = $this->mod->getCutiList($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),$periode,$status);

			//GET JML CUTI DIGUNAKAN
			$res_cuti_digunakan = $this->mod->getCutiDigunakan($nik,$comp_code,$periode); 
			$jml_digunakan = (!$res_cuti_digunakan) ? 0 : $res_cuti_digunakan->JML;

			//GET JML SISA CUTI
			$res_sisa_cuti = $this->mod->getSisaCuti($nik,$comp_code,$periode); 
			$jml_sisa_cuti = (!$res_sisa_cuti) ? 0 : $res_sisa_cuti->JML;
			
			
		} 
		
		if ($res || $res_cuti_digunakan || $res_sisa_cuti) {

	        $build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"nama_cuti" => $row->CUTI_DESC,
	                    "tanggal" => $row->TGL_AWAL_CUTI,
	                    "tanggal_mulai" => $row->TGL_AWAL_CUTI,
	                    "tanggal_selesai" => $row->TGL_AKHIR_CUTI,
	                    "jml" => $row->JML,
	                    "alasan" => $row->ALASAN_CUTI,
	                    "status_pengajuan" => $row->STAT_PENGAJUAN,
	                    "status_id" => $row->STS_AJU
	                )
	            );
	        }

			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $year,
				'jml_digunakan' => "".$jml_digunakan,
				'jml_sisa_cuti' => "".$jml_sisa_cuti,
				'status' => true,
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $year,
				'jml_digunakan' => '',
				'jml_sisa_cuti' => '',
				'status' => false,
				'status' => false,
				'data' => [],
				'message' => 'Data not found'
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



