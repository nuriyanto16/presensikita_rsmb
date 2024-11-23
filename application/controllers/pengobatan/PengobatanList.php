<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class PengobatanList extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengobatan_model', 'mod');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$periode = $this->get('periode');
		$jml_digunakan = 0;
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {

			//GET DETAIL HISTORY CUTI
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
        	$status = 1;
			$res = $this->mod->getPengobatanList($nik,$comp_code,
				$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir),
				$periode,$status);

			
			//PENGOBATAN
			$periode = date("Y");
			$res_pengobatan_digunakan = $this->mod->getPengobatanDigunakan($nik,$comp_code,$periode);
			if($res_pengobatan_digunakan->JML > 0){
				$jml_pengobatan_digunakan = "".$this->to_rupiah($res_pengobatan_digunakan->JML);
				$sisa_pengobatan = 1000000 - $res_pengobatan_digunakan->JML; //kedepannya bisa di ambil dari table untuk sisa pengobatan
				$sisa_pengobatan_str = "".$this->to_rupiah($sisa_pengobatan);
			}else{
				$jml_pengobatan_digunakan = "0";
				$sisa_pengobatan = 1000000; //kedepannya bisa di ambil dari table untuk sisa pengobatan
				$sisa_pengobatan_str = "".$this->to_rupiah(1000000);
			}

		} 
		
		if ($res) {

    		$build_array = array();
	        foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengajuan_id" => $row->ID_AJU,
	                	"tanggal" => $row->TGL_AJU,
	                	"pengobatan_id" => $row->JNS_AJU,
	                    "jenis_pengobatan" => $row->DESC_AJU,
	                    "nama_kuitansi" => $row->NAMA_KUITANSI,
	                    "nominal" => "Rp. ".$this->to_rupiah($row->NILAI_DIGANTI),
	                    "nilai_diganti" => $row->NILAI_DIGANTI,
	                    "status_pengajuan" => $row->STAT_PENGAJUAN,
	                    "status_id" => $row->STS_AJU
	                )
	            );
	        }

			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $periode,
				'jml_digunakan' => 'Rp. '.$jml_pengobatan_digunakan,
				'jml_sisa_plafond' => ' - ',
				'status' => true,
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'tahun' => $periode,
				'jml_digunakan' => 'Rp. 0',
				'jml_sisa_plafond' => ' - ',
				'status' => false,
				'message' => 'ID not found',
				'data' => []
			], 200); // OK (200) being the HTTP response code
		}
	}


	// Untuk mendapatkan jenis pengobatan
    public function type_get()
	{
		$nik = trim($this->get('id'));
		$comp_code = trim($this->get('comp_code'));
		if ($nik !== null || $comp_code !== null){
			$res = true;
		}

		if ($res) {

	        $build_array = array();
	        //foreach ($res as $row) {
	            array_push($build_array,
	                array(
	                	"pengobatan_id" => 'PO',
	                    "jenis_pengobatan" => "Pengobatan"
	                ),
	                array(
	                	"pengobatan_id" => 'LS',
	                    "jenis_pengobatan" => "Lensa"
	                ),
	                array(
	                	"pengobatan_id" => 'FR',
	                    "jenis_pengobatan" => "Frame Kacamata"
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
