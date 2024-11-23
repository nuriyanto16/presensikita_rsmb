<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   
class Dashboard extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Absensi_model', 'mabsen');
		$this->load->model('Cuti_model', 'mcuti');
		$this->load->model('Pengobatan_model', 'mpengobatan');
		$this->load->model('Pelatihan_model', 'mpelatihan');
		$this->load->model('Pengajuan_model', 'mpengajuan');
		$this->load->model('Karyawan_model', 'mkaryawan');
	}

	public function index_get()
	{
		// untuk mendapatkan parameter id
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$start_date = $this->get('start_date');
		$end_date = $this->get('end_date');
		$date = date("Y-m-d H:i:s");
		$year = date("Y");

		if ($nik !== null || $comp_code !== null) {
			$res_kehadiran = $this->mabsen->getJmlKehadiran($nik,$comp_code,$this->_fyyyymmdd($start_date),$this->_fyyyymmdd($end_date));
			$res_tdkkehadiran = $this->mabsen->getJmlTidakhadir($nik,$comp_code,$this->_fyyyymmdd($start_date),$this->_fyyyymmdd($end_date));
			$res_cuti = $this->mcuti->getSisaCuti($nik,$comp_code,$year);
			
			//CUTI
			$res_cuti_digunakan = $this->mcuti->getCutiDigunakan($nik,$comp_code,$year); 
			//$jml_digunakan = (!$res_cuti_digunakan->JML) ? 0 : $res_cuti_digunakan->JML;
			$jml_digunakan = (!$res_cuti_digunakan->JML) ? 0 : $res_cuti_digunakan->JML;
			$jml_sisa_cuti = (!$res_cuti->JML) ? 0 : $res_cuti->JML;
			//PENGOBATAN
			$res_pengobatan_digunakan = $this->mpengobatan->getPengobatanDigunakan($nik,$comp_code,$year);
			if($res_pengobatan_digunakan->JML > 0){
				$jml_pengobatan_digunakan = "Rp. ".$this->to_rupiah($res_pengobatan_digunakan->JML);
			}else{
				$jml_pengobatan_digunakan = "Rp. 0";
			}
			
			//TRAINING
			$res_next_training = $this->mpelatihan->getJmlNextTraining($nik,$comp_code,$year,$date); 
			$jml_next_training = $res_next_training->JML;

			//PENGAJUAN
			$res_pengajuan = $this->mpengajuan->getJmlPengajuan($nik,$comp_code,$year,$date); 
			$jml_pengajuan = $res_pengajuan->JML;

			//JML DIAJUKAN
			$res_pending = $this->mpengajuan->getJmlPending($nik,$comp_code,$year,$date); 
			$jml_pending = $res_pending->JML;

			$res_notifikasi = $this->mpengajuan->getJmlNotifikasi($nik,$comp_code,$year,$date); 
			$jml_notif 	= $res_notifikasi->JML;

			$res_kar = $this->mkaryawan->getKaryawanRow($comp_code,$nik); 
			$nama_karyawan = $res_kar->NAMA;
			$nama_perusahaan= $res_kar->COMP_NAME;
			$nik = $res_kar->NIK;
			$foto = base_url().'uploads/personal/photo/'.$res_kar->URL_FOTO;

		} 
		
		if ($res_kehadiran) {
			$year = date("Y");

			$this->response([
				'status' => true,
				'url_foto' => $foto,
				'nik' => $nik,
				'nama' => $nama_karyawan,
				'jml_notif' => "".$jml_notif,
				'jml_kehadiran_absen' => "".$res_kehadiran->JML,
				'jml_tidakkehadiran_absen' => "".$res_tdkkehadiran->JML,
				'jml_sisa_cuti' => $jml_sisa_cuti,
				'jml_cuti_digunakan' => $jml_digunakan,
				'jml_sisa_plafond' => $jml_pengobatan_digunakan,
				'jml_pengobatan_digunakan' => $jml_pengobatan_digunakan,
				'jml_pengajuan' => $jml_pengajuan,
				'jml_pending' => $jml_pending,
				'jml_next_training' => $jml_next_training,
				'nama_training' => "",
				'next_training' => "",
				'nama_perusahaan' => "SEMANGAT PAGI \nTIM ". $nama_perusahaan,
				'message' => ''
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'nama' => $nama_karyawan,
				'url_foto' => $foto,
				'nik' => $nik,
				'jml_notif' => '',
				'jml_kehadiran_absen' => '',
				'jml_tidakkehadiran_absen' => '',
				'jml_sisa_cuti' => '',
				'jml_cuti_digunakan' => '',
				'jml_sisa_plafond' => '',
				'jml_pengobatan_digunakan' => '',
				'jml_pengajuan' => '',
				'jml_pending' => '',
				'jml_next_training' => '',
				'nama_training' => '',
				'next_training' => '',
				'nama_perusahaan' => "",
				'status' => false,
				'message' => 'Data not found'
			], 200); // OK (200) being the HTTP response code
		}
	}


	public function menu_get()
	{
		// untuk mendapatkan parameter id
		
		$nik = $this->get('id');
		$comp_code = $this->get('comp_code');
		$res = $this->mpengajuan->getMenuPeriode($comp_code);
		if ($nik !== null || $comp_code !== null) {
			$res_absen = $this->mabsen->getPeriodeGaji_($comp_code);
		}

		$build_array = array();
		$year = date("Y");
        foreach ($res as $row) {
			if($row->ID_MENU == 1){
				array_push($build_array,
					array(
						'menu_id' => 1,
						'title'=> 'Absensi',
						'periode'=> $year,
						'start_date'=> $res_absen['start_date'],
						'end_date'=> $res_absen['end_date']
					)
				);
			}else{
				array_push($build_array,
					array(
						'menu_id' => (int)$row->ID_MENU,
						'title'=> $row->REMARK,
						'periode'=> $year,
						'start_date'=> $row->START_DATE,
						'end_date'=> $row->END_DATE
					)
				);
			}
        }

		if ($nik !== null || $comp_code !== null) {
			$this->response([
				'status' => true,
				'api_branch' => "presensikita.com",
				'data' => $build_array
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'api_branch' => "",
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

    function to_rupiah($bil=null){
        $rupiah = number_format($bil, 0, ',', '.');
        return $rupiah;
    }

}
