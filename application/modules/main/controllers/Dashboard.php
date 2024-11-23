<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ajaxray\PHPWatermark\Watermark;

/**
 * Class Dashboard
 * @property Mdashboard $mdash
 */
class Dashboard extends Mst_controller
{

    public function __construct()
    {

        parent::__construct();

        $this->MOD_ALIAS = "MOD_HOME";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mdashboard", "mdash");
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Memployee", "memployee");
        $this->load->model('Absensi_model', 'mod');
        $this->load->library('Geo_php');
    }

    public function index()
    {
        $this->data['titlehead'] = "Dashboard";

        $stdClass = new stdClass();
        $stdClass->compid = null;
        $stdClass->nik = null;
        $stdClass->nik_ = null;
        $stdClass->tgl_awal = null;
        $stdClass->tgl_akhir = null;  

        //1
        $jml_absen_total= 0;
        $jml_absen_pending = 0;
        $jml_absen_approved = 0;
        $jml_absen_disapproved = 0;
        //2
        $jml_sakit_total= 0;
        $jml_sakit_pending = 0;
        $jml_sakit_approved = 0;
        $jml_sakit_disapproved = 0;
        //3
        $jml_cuti_total= 0;
        $jml_cuti_pending = 0;
        $jml_cuti_approved = 0;
        $jml_cuti_disapproved = 0;
        //4
        $jml_obat_total= 0;
        $jml_obat_pending = 0;
        $jml_obat_approved = 0;
        $jml_obat_disapproved = 0;
        //5
        $jml_biaya_total= 0;
        $jml_biaya_pending = 0;
        $jml_biaya_approved = 0;
        $jml_biaya_disapproved = 0;
        //6
        $jml_dinas_total= 0;
        $jml_dinas_pending = 0;
        $jml_dinas_approved = 0;
        $jml_dinas_disapproved = 0;
        //7
        $jml_pelatihan_total= 0;
        $jml_pelatihan_pending = 0;
        $jml_pelatihan_approved = 0;
        $jml_pelatihan_disapproved = 0;





        if (isset($_GET) && !empty($_GET)) {
            $comp_id = ($this->input->get('compid') !== "") ? $this->input->get('compid') : "";
            $nik = ($this->input->get('nik') !== "") ? $this->input->get('nik') : "";
            $start_date = ($this->input->get('start_date') !== "") ? $this->input->get('start_date') : "";
            $end_date = ($this->input->get('end_date') !== "") ? $this->input->get('end_date') : "";
        }else{
            $compid = null;
            $nik = null;
            $start_date = null;
            $end_date = null;
        }
        $stdClass->comp_id = ($this->input->get('compid') !== "") ? $this->input->get('compid') : "";
        $stdClass->nik = ($this->input->get('nik') !== "") ? $this->input->get('nik') : "";
        $stdClass->start_date = ($this->input->get('start_date') !== "") ? $this->input->get('start_date') : "";
        $stdClass->end_date = ($this->input->get('end_date') !== "") ? $this->input->get('end_date') : "";


        //LATEST ABSEN

        if($this->session->userdata(sess_prefix()."roleid") == 1 ){
            $compid_ = !empty($this->input->get('compid')) ? $this->input->get('compid') : $this->session->userdata(sess_prefix()."compId"); 
            if(empty($compid_)){
                $compid_ = 1;
            }           
            $mcompany = $this->mcompany->get_data($compid_);
            $comp_code = $mcompany->COMP_CODE;
            $res_absen = $this->mod->getPeriodeGaji_($comp_code);
            $periode_awal = (isset($_GET) && !empty($_GET)) ? $start_date : $res_absen['start_date'];
            $periode_akhir = (isset($_GET) && !empty($_GET)) ? $end_date : $res_absen['end_date'];
            $res = $this->mod->getAbsensiListDashboard($nik,$comp_code,$this->_fyyyymmdd($periode_awal),$this->_fyyyymmdd($periode_akhir));
        }else{
            $compid_ = $this->session->userdata(sess_prefix()."compId");
            $mcompany = $this->mcompany->get_data($compid_);
            // $comp_code = $mcompany->COMP_CODE;
            $comp_code = "ABCDE1";
            $res_absen = $this->mod->getPeriodeGaji_($comp_code);
            $periode_awal = (isset($_GET) && !empty($_GET)) ? $start_date : $res_absen['start_date'];
            $periode_akhir = (isset($_GET) && !empty($_GET)) ? $end_date : $res_absen['end_date'];
            $res = $this->mod->getAbsensiListDashboard($nik,$comp_code,$this->_fyyyymmdd($periode_awal),$this->_fyyyymmdd($periode_akhir));
        }



        $stdClass->nik_ = ($this->input->get('nik_') !== "") ? $this->input->get('nik_') : "";

        $compid = $stdClass->comp_id;
        $nik = $stdClass->nik;
        $start_date = $stdClass->start_date;
        $end_date = $stdClass->end_date;

        //JUMLAH PENGAJUAN
        $dataJmlPengajuan = $this->mdash->getJmlPengajuan(null, $stdClass->comp_id, $stdClass->nik, $stdClass->start_date, $stdClass->end_date);
        foreach($dataJmlPengajuan as $row_jp){
            if($row_jp->jenis_pengajuan_id == 1){
                $jml_absen_total = $row_jp->jml;
            }
            else if($row_jp->jenis_pengajuan_id == 2){
                $jml_sakit_total = $row_jp->jml;
            }
            else if($row_jp->jenis_pengajuan_id == 3){
                $jml_cuti_total = $row_jp->jml;
            }
            else if($row_jp->jenis_pengajuan_id == 4){
                $jml_obat_total = $row_jp->jml;
            }
            else if($row_jp->jenis_pengajuan_id == 5){
                $jml_biaya_total = $row_jp->jml;
            }
            else if($row_jp->jenis_pengajuan_id == 6){
                $jml_dinas_total = $row_jp->jml;
            }
            else if($row_jp->jenis_pengajuan_id == 7){
                $jml_pelatihan_total = $row_jp->jml;
            }
        }

        //Jumlah Pengajuan Pending
        $dataJmlPengajuanPending = $this->mdash->getJmlPengajuan(0, $stdClass->comp_id, $stdClass->nik, $stdClass->start_date, $stdClass->end_date);
        foreach($dataJmlPengajuanPending as $row_pd){
            if($row_pd->jenis_pengajuan_id == 1){
                $jml_absen_pending = $row_pd->jml;
            }
            else if($row_pd->jenis_pengajuan_id == 2){
                $jml_sakit_pending = $row_pd->jml;
            }
            else if($row_pd->jenis_pengajuan_id == 3){
                $jml_cuti_pending = $row_pd->jml;
            }
            else if($row_pd->jenis_pengajuan_id == 4){
                $jml_obat_pending = $row_pd->jml;
            }
            else if($row_pd->jenis_pengajuan_id == 5){
                $jml_biaya_pending = $row_pd->jml;
            }
            else if($row_pd->jenis_pengajuan_id == 6){
                $jml_dinas_pending = $row_pd->jml;
            }
            else if($row_pd->jenis_pengajuan_id == 7){
                $jml_pelatihan_pending = $row_pd->jml;
            }
        }

        //Jumlah Pengajuan Approved
        $dataJmlPengajuanApproved = $this->mdash->getJmlPengajuan(1, $stdClass->comp_id, $stdClass->nik, $stdClass->start_date, $stdClass->end_date);
        foreach($dataJmlPengajuanApproved as $row_ja){
            if($row_ja->jenis_pengajuan_id == 1){
                $jml_absen_approved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 2){
                $jml_sakit_approved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 3){
                $jml_cuti_approved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 4){
                $jml_obat_approved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 5){
                $jml_biaya_approved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 6){
                $jml_dinas_approved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 7){
                $jml_pelatihan_approved = $row_ja->jml;
            }
        }

        //Jumlah Pengajuan Disapproved
        $dataJmlPengajuanDisapproved = $this->mdash->getJmlPengajuan(2, $stdClass->comp_id, $stdClass->nik, $stdClass->start_date, $stdClass->end_date);
        foreach($dataJmlPengajuanDisapproved as $row_ja){
            if($row_ja->jenis_pengajuan_id == 1){
                $jml_absen_disapproved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 2){
                $jml_sakit_disapproved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 3){
                $jml_cuti_disapproved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 4){
                $jml_obat_disapproved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 5){
                $jml_biaya_disapproved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 6){
                $jml_dinas_disapproved = $row_ja->jml;
            }
            else if($row_ja->jenis_pengajuan_id == 7){
                $jml_pelatihan_disapproved = $row_ja->jml;
            }
        }

        $this->data['jml_absen_total']= $jml_absen_total;
        $this->data['jml_absen_pending'] = $jml_absen_pending;
        $this->data['jml_absen_approved'] = $jml_absen_approved;
        $this->data['jml_absen_disapproved'] = $jml_absen_disapproved;

        $this->data['jml_sakit_total']= $jml_sakit_total;
        $this->data['jml_sakit_pending'] = $jml_sakit_pending;
        $this->data['jml_sakit_approved'] = $jml_sakit_approved;
        $this->data['jml_sakit_disapproved'] = $jml_sakit_disapproved;

        $this->data['jml_cuti_total']= $jml_cuti_total;
        $this->data['jml_cuti_pending'] = $jml_cuti_pending;
        $this->data['jml_cuti_approved'] = $jml_cuti_approved;
        $this->data['jml_cuti_disapproved'] = $jml_cuti_disapproved;

        $this->data['jml_obat_total']= $jml_obat_total;
        $this->data['jml_obat_pending'] = $jml_obat_pending;
        $this->data['jml_obat_approved'] = $jml_obat_approved;
        $this->data['jml_obat_disapproved'] = $jml_obat_disapproved;

        $this->data['jml_biaya_total']= $jml_biaya_total;
        $this->data['jml_biaya_pending'] = $jml_biaya_pending;
        $this->data['jml_biaya_approved'] = $jml_biaya_approved;
        $this->data['jml_biaya_disapproved'] = $jml_biaya_disapproved;

        $this->data['jml_dinas_total']= $jml_dinas_total;
        $this->data['jml_dinas_pending'] = $jml_dinas_pending;
        $this->data['jml_dinas_approved'] = $jml_dinas_approved;
        $this->data['jml_dinas_disapproved'] = $jml_dinas_disapproved;

        $this->data['jml_pelatihan_total']= $jml_pelatihan_total;
        $this->data['jml_pelatihan_pending'] = $jml_pelatihan_pending;
        $this->data['jml_pelatihan_approved'] = $jml_pelatihan_approved;
        $this->data['jml_pelatihan_disapproved'] = $jml_pelatihan_disapproved;

        $jml_hadir=0; $jml_terlambat=0; $jml_izin=0; $jml_masuk_siang=0;
        $jml_masuk_cepat=0; $jml_sakit=0; $jml_cuti=0; $jml_mangkir=0;
        $jml_dinas_luar=0; $jml_training=0; $jml_ket_lain=0; 
        $jml_sakit_izin = 0;

        if ($nik !== null || $compid !== null || $start_date !== null || $end_date !== null) {

            $compid_ = $this->session->userdata(sess_prefix()."compId");
            $mcompany = $this->mcompany->get_data($compid);
            $comp_code = $mcompany->COMP_CODE;

			//GET DETAIL ABSENSI
	        $period_awal  = $start_date;//$this->mod->getPeriodTgl($comp_code,3);
        	$period_akhir = $end_date; //$this->mod->getPeriodTgl($comp_code,2);
			//GET JML REKAP PERJENIS REKAP
        	$period_awal = $start_date;//$this->mod->getPeriodTgl($comp_code,1);
       		$period_akhir = $end_date;//$this->mod->getPeriodTgl($comp_code,2);
			$res_summary = $this->mod->getAbsensiSummary($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir));
			//$res_kehadiran = $this->mod->getJmlKehadiran($nik,$comp_code,$this->_fyyyymmdd($period_awal),$this->_fyyyymmdd($period_akhir));
            $jml_mangkir = 0;
            $jml_terlambat= 0;

			foreach ($res_summary  as $row) {
                
				if($row->ID_ABS_TYPE==1){ // HADIR
					//$jml_hadir=$jml_hadir+$row->JML;
				}else if($row->ID_ABS_TYPE==2){ // TERLAMBAT
					//$jml_terlambat=$row->JML;
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
                $jml_hadir = $jml_hadir + $row->JML_HADIR;	
                $jml_mangkir = $jml_mangkir + $row->JML_MANGKIR;
                $jml_terlambat= $jml_terlambat + $row->JML_TERLAMBAT;		   
			}
			
			$jml_sakit_izin = $jml_izin+$jml_sakit;
            
		} 
		
        //TOTAL KARYAWAN
        $filters = [
            ['field' => 'a.compid', 'value' => $compid]
        ];
        $this->data['total_karyawan'] = $this->memployee->get_cnt($filters);
        $this->data['total_kehadiran'] = $jml_hadir;
        $this->data['total_sakit'] = $jml_sakit_izin;
        $this->data['total_terlambat'] = $jml_terlambat;
        $this->data['total_dinas'] = $jml_dinas_luar;
        $this->data['total_mangkir'] = $jml_mangkir;



        $this->data['detail_absen'] = $res;

        // select option company
        $companies = $this->mcompany->get_data(null, null, 999999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }

        $this->data['compid'] = array(
            'name' => 'compid',
            'id' => 'compid',
            'value' => $this->form_validation->set_value('compid', $compid),
            'options' => $list_company,
            'class' => 'form-control'
        );

        // select emplooye
        $this->data['nik'] = array(
            'name' => 'nik',
            'id' => 'nik',
            'value' => $this->form_validation->set_value('nik', $nik),
            'class' => 'form-control'
        );

        //$this->data['nik_']  = $stdClass->nik_;

        $this->data['start_date'] = array(
            'name' => 'start_date',
            'id' => 'start_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('start_date', $periode_awal)
        );

        $this->data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('end_date', $periode_akhir)
        );


        // custom load javascript, place at footer
        $loadhead['stylesheet'] = array(
            //HTTP_ASSET_PATH . 'vendor/pivottable/dist/pivot.css',
        );
        $this->data['loadhead'] = $loadhead;
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/main/dashboard_js.js'
        );

        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array(
            //"https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.3.1/css/ol.css"
        );
        $this->data['loadhead'] = $loadhead;

        $this->data['loadfoot'] = $loadfoot;
        $this->data['csrf'] = $this->_get_sess_csrf();

        $this->_render_page('vdashboard', $this->data, false, 'tmpl/vwbacktmpl');
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

    public function listAbsensiMaps()
    {
        if($this->session->userdata(sess_prefix()."roleid") == 1 ){
            $comp_id = ($this->input->get('compid') !== "") ? $this->input->get('compid') : "";
        }else{
            $comp_id =  $this->session->userdata(sess_prefix()."compId");
        }

        $nik = ($this->input->get('nik') !== "" ) ? $this->input->get('nik') : "";
        $start_date = ($this->input->get('start_date') !== "") ? $this->input->get('start_date') : "";
        $end_date = ($this->input->get('end_date') !== "") ? $this->input->get('end_date') : "";

        $objeks = $this->mdash->getdataMapAbsensi($comp_id, $nik, $start_date, $end_date);
        $geojson_writer = new GeoJSON();
        foreach ($objeks as $row) {
            $geom = $this->geo_php->load_geom($row->geom_text, 'wkt');
            //$photo = base_url('uploads/absensi/'.$row->comp_code.'/'.$row->foto_masuk);
            $photo = base_url().'uploads/absensi/'.$row->comp_code.'/'.$row->path.'/'.$row->foto_masuk;
            //$photo = assets_url('photo/lampu') . 'no_image_available.png';

            $metaData = [
                'Geom' => $geom,
                'emp_name' => $row->emp_name,
                'tgl_absen' => $row->tgl_absen,
                'lokasi' => $row->lokasi,
                'jam_in' => $row->jam_in,
                'jam_out' => $row->jam_out,
                'comp_code' => $row->comp_code,
                'foto_masuk' => $row->foto_masuk,
                'foto_pulang' => $row->foto_pulang,
                'abs_type_desc' => $row->abs_type_desc,
                'Long' => $row->longitude,
                'Lat' => $row->latitude,
                'Photo' => $photo
            ];

            $geom->setMetaData($metaData);
            $geojson = $geojson_writer->write($geom, true);
            $build_array[] = $geojson;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($build_array));
    }

    
}
