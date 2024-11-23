<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;

class AbsensiListTest extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Absensitest_model', 'mod');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$periode = $this->get('periode');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		if ($nik !== null || $comp_code !== null || $start_date !== null || $end_date !== null) {

			//GET DETAIL ABSENSI
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
			$res = $this->mod->getAbsensiList($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir));
			$res_lap = $this->mod->getAbsensiListReport($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir));


			//GET JML REKAP PERJENIS REKAP
        	$period_awal = $start_date;//$this->mod->getPeriodTgl($comp_code,1);
       		$period_akhir = $end_date;//$this->mod->getPeriodTgl($comp_code,2);
			$res_summary = $this->mod->getAbsensiSummary($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir));
			$res_kehadiran = $this->mod->getJmlKehadiran($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir));
			$jml_hadir=0; $jml_terlambat=0; $jml_izin=0; $jml_masuk_siang=0;
			$jml_masuk_cepat=0; $jml_sakit=0; $jml_cuti=0; $jml_mangkir=0;
			$jml_dinas_luar=0; $jml_training=0; $jml_ket_lain=0; 

			foreach ($res_summary  as $row) {
				if($row->ID_ABS_TYPE==1){ // HADIR
					$jml_hadir=$jml_hadir+$row->JML;
				}else if($row->ID_ABS_TYPE==2){ // TERLAMBAT
					$jml_hadir=$jml_hadir+$row->JML;
					$jml_terlambat=$row->JML;
				}else if($row->ID_ABS_TYPE==3){ // IZIN
					$jml_izin=$row->JML; 
				}else if($row->ID_ABS_TYPE==4){ // IZIN MASUK SIANG
					$jml_masuk_siang=$row->JML;
				}else if($row->ID_ABS_TYPE==5){ // IZIN PULANG CEPAT
					$jml_masuk_cepat=$row->JML;
				}else if($row->ID_ABS_TYPE==6){ // SAKIT
					 $jml_sakit=$row->JML; 
				}else if($row->ID_ABS_TYPE==7){ // CUTI
					$jml_cuti=$row->JML;
				}else if($row->ID_ABS_TYPE==8){ // MANGKIR
					$jml_mangkir=$row->JML;
				}else if($row->ID_ABS_TYPE==9){ // DINAS LUAR
					$jml_dinas_luar=$row->JML;
				}else if($row->ID_ABS_TYPE==10){ // TRAINING
					$jml_training=$row->JML;
				}else if($row->ID_ABS_TYPE==10){ // KETERANGAN LAIN
					$jml_ket_lain=$row->JML;
				}				   
			}
			$jml_hadir= $res_kehadiran->JML;
			$jml_sakit_izin = $jml_izin+$jml_sakit;
		} 

			//$linkpath = base_url().'uploads/absensi/'.$row->PATH.'/'.$row->URL_FOTO;
            //$linkpath_pulang = base_url().'uploads/absensi/'.$row->PATH.'/'.$row->URL_FOTO_PULANG;

		
		if ($res || $res_summary) {

	        $build_array = array();
	        foreach ($res as $row) {

				$linkpath = base_url().'uploads/absensi/'.$comp_code.'/'.$row->PATH.'/';
				$linkpath_pulang = base_url().'uploads/absensi/'.$comp_code.'/'.$row->PATH.'/';
	
	            array_push($build_array,
	                array(
						"nik" => $row->NIK,
	                	"pengajuan_id" => $row->TGL,
						"tanggal" => $row->TGL,
						//PRESENSI
	                    "masuk" => ($row->JAM_IN!==null ? $row->JAM_IN : "-"),
						"keluar" => ($row->JAM_OUT!==null ? $row->JAM_OUT : "-"),
						//SMARTABSENSI
						// "masuk" => ($row->JAM_IN_V2 !==null ? $row->JAM_IN_V2  : "-"),
						// "keluar" => ($row->JAM_OUT_V2 !==null ? $row->JAM_OUT_V2  : "-"),
						"lokasi" => $row->LOKASI,
						"foto_masuk" => $linkpath.$row->FOTO_MASUK,
						"foto_pulang" => $linkpath.$row->FOTO_PULANG,
	                    "status" => $row->ABS_TYPE_DESC
	                )
	            );
	        }
			

			//Log Laporan
			$build_lap_array = array();
	        foreach ($res_lap as $row) {

				$linkpath = base_url().'uploads/absensi/'.$comp_code.'/'.$row->PATH.'/';
				$linkpath_pulang = base_url().'uploads/absensi/'.$comp_code.'/'.$row->PATH.'/';

	            array_push($build_lap_array,
	                array(
						"nik" => $row->NIK,
	                	"pengajuan_id" => $row->TGL,
						"tanggal" => $row->TGL,
						//PRESENSI
	                    "masuk" => ($row->JAM_IN!==null ? $row->JAM_IN : "-"),
						"keluar" => ($row->JAM_OUT!==null ? $row->JAM_OUT : "-"),
						//SMARTABSENSI
						// "masuk" => ($row->JAM_IN_V2 !==null ? $row->JAM_IN_V2  : "-"),
						// "keluar" => ($row->JAM_OUT_V2 !==null ? $row->JAM_OUT_V2  : "-"),
						"lokasi" => $row->LOKASI,
						"foto_masuk" => $linkpath.$row->FOTO_MASUK,
						"foto_pulang" => $linkpath.$row->FOTO_PULANG,
	                    "status" => $row->ABS_TYPE_DESC
	                )
	            );
	        }

			$merge_arr = array_merge ($build_array, $build_lap_array); 

			usort($merge_arr, $this->make_comparer(
				['tanggal', SORT_DESC]
			));


			$arr_absensi = array();
			$tmp_tanggal = "";
			$status = "";
			foreach($merge_arr as $key=>$values){

				if(!isset($exchange[$key])){
					//$exchange[$key]=$values['tanggal'];

					// if(count(array_unique($exchange))>count($exchange))
					// {
						
					// }
					// else
					// {
					// 	array_push($arr_absensi,
					// 		array(
					// 			"nik" => $values['nik'],
					// 			"pengajuan_id" => $values['pengajuan_id'],
					// 			"tanggal" => $values['tanggal'],
					// 			//PRESENSI
					// 			"masuk" => $values['masuk'],
					// 			"keluar" => $values['keluar'],
					// 			//SMARTABSENSI
					// 			// "masuk" => ($row->JAM_IN_V2 !==null ? $row->JAM_IN_V2  : "-"),
					// 			// "keluar" => ($row->JAM_OUT_V2 !==null ? $row->JAM_OUT_V2  : "-"),
					// 			"lokasi" => $values['lokasi'],
					// 			"foto_masuk" => $values['foto_masuk'],
					// 			"foto_pulang" => $values['foto_pulang'],
					// 			"status" => $values['status'],
					// 		)
					// 	);
					// }

					$exchange[$key]=$values['tanggal'];
					$tanggal = $values['tanggal'];
					$status  = $values['status'];

					if($tmp_tanggal != $tanggal ){

						array_push($arr_absensi,
							array(
								"nik" => $values['nik'],
								"pengajuan_id" => $values['pengajuan_id'],
								"tanggal" => $values['tanggal'],
								//PRESENSI
								"masuk" => $values['masuk'],
								"keluar" => $values['keluar'],
								//SMARTABSENSI
								// "masuk" => ($row->JAM_IN_V2 !==null ? $row->JAM_IN_V2  : "-"),
								// "keluar" => ($row->JAM_OUT_V2 !==null ? $row->JAM_OUT_V2  : "-"),
								"lokasi" => $values['lokasi'],
								"foto_masuk" => $values['foto_masuk'],
								"foto_pulang" => $values['foto_pulang'],
								"status" => $values['status'],
							)
						);

						$tmp_tanggal = $tanggal;
					}
				}
			}

		
			// $mergeId = 'tanggal';
			// $dataFiltered = array_reduce($merge_arr, function($c, $x) use ($mergeId)
			// {
			// $c[$x[$mergeId]] = isset($c[$x[$mergeId]])
			// 	?array_combine(
			// 		$z=array_keys($c[$x[$mergeId]]), 
			// 		array_map(function($y) use ($x, $c, $mergeId)
			// 		{
			// 			return in_array($x[$y], (array)$c[$x[$mergeId]][$y])
			// 				?$c[$x[$mergeId]][$y]
			// 				:array_merge((array)$c[$x[$mergeId]][$y], [$x[$y]]);
			// 		}, $z)
			// 	)
			// 	:$x;
			// return $c;
			// }, []);

			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'jml_hadir' => "".$res_kehadiran->JML,
				'jml_sakit_izin' => "".$jml_sakit_izin,
				'jml_cuti' => "".$jml_cuti,
				'jml_dinas' => "".$jml_dinas_luar,
				'jml_mangkir' => "".$jml_mangkir,
				'status' => true,
				'data' => $merge_arr
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'start_date' => $start_date,
				'end_date' => $end_date,
				'jml_hadir' => "0",
				'jml_sakit_izin' => "0",
				'jml_cuti' => "0",
				'jml_dinas' => "0",
				'jml_mangkir' => "0",
				'status' => false,
				'message' => 'Data not found',
				'data' => []
			], 200);
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


	protected function array_merge_recursive_distinct(array &$array1, array &$array2)
	{
		$merged = $array1;

		foreach ($array2 as $key => &$value) {
			if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
				$merged[$key] = $this->array_merge_recursive_distinct($merged[$key], $value);
			} else {
				$merged[$key] = $value;
			}
		}

		return $merged;
	}

	protected function make_comparer() {
		// Normalize criteria up front so that the comparer finds everything tidy
		$criteria = func_get_args();
		foreach ($criteria as $index => $criterion) {
			$criteria[$index] = is_array($criterion)
				? array_pad($criterion, 3, null)
				: array($criterion, SORT_ASC, null);
		}
	 
		return function($first, $second) use ($criteria) {
			foreach ($criteria as $criterion) {
				// How will we compare this round?
				list($column, $sortOrder, $projection) = $criterion;
				$sortOrder = $sortOrder === SORT_DESC ? -1 : 1;
	 
				// If a projection was defined project the values now
				if ($projection) {
					$lhs = call_user_func($projection, $first[$column]);
					$rhs = call_user_func($projection, $second[$column]);
				}
				else {
					$lhs = $first[$column];
					$rhs = $second[$column];
				}
	 
				// Do the actual comparison; do not return if equal
				if ($lhs < $rhs) {
					return -1 * $sortOrder;
				}
				else if ($lhs > $rhs) {
					return 1 * $sortOrder;
				}
			}
	 
			return 0; // tiebreakers exhausted, so $first == $second
		};
	}
	

}
