<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Rekapabsen
 * @property Mrcsa $mrcsa
 * @property Mcompany $mcompany
 * @property Memployee $memployee
 */
class Rekapjenis extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_LAPORAN_REKAPJENIS";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Memployee", "memployee");
        $this->load->model("Mrekapabsen", "mod");
        $this->load->model("MrekapSummary", "msum");
        $this->load->model("MrekapJenis", "mdet");
        $this->load->model("reference/Mperiode", "mperiode");

    }

    public function index()
    {
        $this->data['titlehead'] = "Rekapitulasi Per Jenis Kehadiran";

        $stdClass = new stdClass();
        $stdClass->bulan_id = null;
        $stdClass->periode_id = null;
        $stdClass->jenis_id = null;
        $stdClass->compid = null;
        $stdClass->nik = null;
        $stdClass->unitid = null;
        $stdClass->start_date = null;
        $stdClass->end_date = null;  


        //$compid = $stdClass->comp_id;
        $nik = $stdClass->nik;
        $start_date = $stdClass->start_date;
        $end_date = $stdClass->end_date;
        $unitid = $stdClass->unitid;


        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/laporan/rekapjenis.js'
        );
        $this->data['loadfoot'] = $loadfoot;


        // option periode
        $mperiodes = $this->mperiode->get_data(null,0, 999999);
        $list_periode[null] = "Pilih Periode";
        foreach ($mperiodes as $row) {
            $list_periode[$row->periode_id] = $row->periode_nama;
        }

        $this->data['periode_id'] = array(
            'name' => 'periode_id',
            'id' => 'periode_id',
            'value' => $this->form_validation->set_value('periode_id', $stdClass->periode_id),
            'options' => $list_periode,
            'class' => 'form-control'
        );

        // option bulan
        $list_bulan[null] = "Pilih Bulan";
        $list_bulan[1] = "Januari";
        $list_bulan[2] = "Februari";
        $list_bulan[3] = "Maret";
        $list_bulan[4] = "April";
        $list_bulan[5] = "Mei";
        $list_bulan[6] = "Juni";
        $list_bulan[7] = "Juli";
        $list_bulan[8] = "Agustus";
        $list_bulan[9] = "September";
        $list_bulan[10] = "Oktober";
        $list_bulan[11] = "Nopember";
        $list_bulan[12] = "Desember";

        $this->data['bulan_id'] = array(
            'name' => 'bulan_id',
            'id' => 'bulan_id',
            'options' => $list_bulan,
            'value' => $this->form_validation->set_value('bulan_id', $stdClass->bulan_id),
            'class' => 'form-control'
        );

        // option bulan
        $list_jenis[null] = "Pilih Jenis Kehadiran";
        $list_jenis[1] = "Cuti";
        $list_jenis[2] = "Dinas Malam";
        $list_jenis[3] = "Surat Tugas";
        $list_jenis[4] = "Tukar Jadwa/Shift";
        $list_jenis[5] = "Siang Malam";
        $list_jenis[6] = "Alfa/Tidak Hadir";

        $this->data['jenis_id'] = array(
            'name' => 'jenis_id',
            'id' => 'jenis_id',
            'options' => $list_jenis,
            'value' => $this->form_validation->set_value('jenis_id', $stdClass->jenis_id),
            'class' => 'form-control'
        );

        // select option company
        $companies = $this->mcompany->get_data(null, null, 999999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }

        $this->data['compid'] = array(
            'name' => 'compid',
            'id' => 'compid',
            'value' => $this->form_validation->set_value('compid', $stdClass->compid),
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

        // select unit
        $this->data['unitid'] = array(
            'name' => 'unitid',
            'id' => 'unitid',
            'value' => $this->form_validation->set_value('unitid', $stdClass->unitid),
            'class' => 'form-control'
        );

        $this->_render_page('vrekapperjenis', $this->data, false, 'tmpl/vwbacktmpl');
    }

    function to_rupiah($bil=null){
        $rupiah = number_format($bil, 0, ',', '.');
        return $rupiah;
    }
    
    public function getExportDetail($isPdf=null) {

        $periode_id = intval($this->input->get('periode_id'));
        $bulan_id = intval($this->input->get('bulan_id'));
        $comp_id = intval($this->input->get('comp_id'));
        $emp_id = intval($this->input->get('emp_id'));
        $unitid = intval($this->input->get('unit_id'));
        $jenis_id = intval($this->input->get('jenis_id'));

        // if($jenis_id<0 || empty($jenis_id)){
        //     echo "Mohon lengkapi paramter";
        //     return;
        // }

        $type = $this->input->get('type');
        $varian = $this->input->get('varian');
        
        if($emp_id != 0 ){
            $this->data['filtertmp'] =
            array(
                array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
                array('field' => "b.unitid",'type' => "=",'value' => $unitid),
                array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
                array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
                array('field' => "a.emp_id",'type' => "=",'value' => $emp_id)
            );
        }else{
            $this->data['filtertmp'] =
            array(
                array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
                array('field' => "b.unitid",'type' => "=",'value' => $unitid),
                array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
                array('field' => "a.bulan",'type' => "=",'value' => $bulan_id )
            );
        }

        // DETAIL
        $results = $this->mdet->get(null, null, 999999, null, $this->data['filtertmp'], $jenis_id);
		$infolap = strtoupper($this->jenis_report($jenis_id).' Bulan '.$this->bulan($bulan_id).' Tahun '.$periode_id);
        $this->data['bulan'] = $bulan_id;
        $this->data['tahun'] = $periode_id;
        $this->data['abs_types'] = $this->msum->getAbsType();
        $unit =  $this->mdet->getUnit($unitid);
        
        $output = [];

        foreach ($results as $row) {

            if($row->jam_masuk == $row->jam_pulang){
                $row->jam_pulang = '00:00';
            }

            $obj = [];
            $obj['type'] = 'detail';
            $obj['nik'] = $row->nik_pegawai;
            $obj['nama'] = $row->emp_name;
            $obj['tahun'] = $row->tahun;
            $obj['bulanx'] = $row->bulan;
            $obj['bulan_nama'] = $row->bulan_nama;
            $obj['emp_name'] = $row->emp_name;
            $obj['unitName'] = $row->unitName;
            $obj['position_desc'] = $row->position_desc;
            $obj['tanggal'] = $row->tanggal;
            $obj['kode_jadwal'] = $row->kode_jadwal;
            $obj['jdwl_masuk'] = $row->jdwl_masuk;
            $obj['jdwl_pulang'] = $row->jdwl_pulang;
            $obj['jam_masuk'] = $row->jam_masuk;
            $obj['jam_pulang'] = $row->jam_pulang;  
            $obj['abs_type_desc'] = $row->abs_type_desc;
            $obj['id_abs_type'] = $row->id_abs_type;
            $obj['keterangan'] = $row->keterangan;
            $obj['counter'] = $row->counter;
            $output[] = $obj;
        }

        $unitName = "";

        $build_array = array(
            "data" => array()
        );

        if(!empty($unitid)){
            $this->data['namaUnit'] = $unitName;
        }else{
            $this->data['namaUnit'] = '';
        }

        $this->data['infolap'] = $infolap;
     
        if($type=="xls"){
            header("Content-type: application/octet-stream"); 
            header("Content-Disposition: attachment;filename=EXPORT_DETAIL_".$infolap.".xls");
            header("Content-Transfer-Encoding: binary");
            header('Pragma: no-cache');
            header('Expires: 0');
            set_time_limit(0);
            $resData = $output; // $output adalah data yang ingin Anda kirim ke view
            $build_array["data"] = $resData;
            $this->data['jenisLaporan'] = $this->jenis_report($jenis_id); 
            $this->data['jenis_id'] = $jenis_id; 
            $this->data['bulan'] = $this->bulan($bulan_id);
            $this->data['tahun'] = $periode_id;
            $this->data['results'] = $resData; // Kirim data ke view
            $html = $this->load->view("vexport_kehadiran_perjenis", $this->data, true);
        }
        echo $html;
        exit();
        

    //     // $this->load->view('vexport_kehadiran',$data);
				
    }


    public function printpdf(){
        $mpdf = new \Mpdf\Mpdf();
       //$html = $this->load->view('html_to_pdf',[],true);
        $html = "TEST";
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
    }

    public function bulan($var){
        $ret = "";
        switch ($var) {
            case 1  : $ret = "Januari"; break;
            case 2  : $ret = "Februari"; break;
            case 3  : $ret = "Maret"; break;
            case 4  : $ret = "April"; break;
            case 5  : $ret = "Mei"; break;
            case 6  : $ret = "Juni"; break;
            case 7  : $ret = "Juli"; break;
            case 8  : $ret = "Agustus"; break;
            case 9  : $ret = "September"; break;
            case 10 : $ret = "Oktober"; break;
            case 11 : $ret = "Nopember"; break;
            case 12 : $ret = "Desember"; break;
            default : "";
        }
        return $ret;
    }

    public function jenis_report($var){
        $ret = "";
        switch ($var) {
            case 1  : $ret = "CUTI"; break;
            case 2  : $ret = "DINAS MALAM"; break;
            case 3  : $ret = "SURAT TUGAS"; break;
            case 4  : $ret = "TUKAR JADWAL SHIFT"; break;
            case 5  : $ret = "SIANG MALAM"; break;
            case 6  : $ret = "ALFA/TIDAK HADIR"; break;
            default : "";
        }
        return $ret;
    }
}
