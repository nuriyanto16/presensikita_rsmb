<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Generateabsen
 * @property Mrcsa $mrcsa
 * @property Mcompany $mcompany
 * @property Memployee $memployee
 */
class Generateabsen extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_LAPORAN_GENERATEABSEN";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Memployee", "memployee");
        $this->load->model("Mrekapabsen", "mod");
        $this->load->model("MrekapSummary", "msum");
        $this->load->model("MrekapDetail", "mdet");
        $this->load->model("reference/Mperiode", "mperiode");

    }

    public function index()
    {
        $this->data['titlehead'] = "Generate Ketidakhadiran & Keterlambatan";

        $stdClass = new stdClass();
        $stdClass->bulan_id = null;
        $stdClass->periode_id = null;

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

        $this->_render_page('vrekapgenerate', $this->data, false, 'tmpl/vwbacktmpl');
    }

    function to_rupiah($bil=null){
        $rupiah = number_format($bil, 0, ',', '.');
        return $rupiah;
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

    public function sendRekapAbsensi() {

        ini_set('memory_limit','1024M');
        ini_set('max_execution_time', 3600000);
        $periode_id = intval($this->input->post('periode_id'));
        $bulan_id = intval($this->input->post('bulan_id'));
        $comp_id = 1;

        $this->data['filtertmp'] =
            array(
                array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
                array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
                array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
            );

        // DETAIL
        $results = $this->mdet->getByPeriode($bulan_id, $periode_id);
        
        //$results = $this->mdet->get(null, null, 999999, null, $this->data['filtertmp']);
		$infolap = strtoupper('Bulan '.$this->bulan($bulan_id).' Tahun '.$periode_id);
        //print_r($results);
        
        $this->data['abs_types'] = $this->msum->getAbsType();

        $allUnit = $this->mdet->getUnitAll();
        
        foreach($allUnit as $unitid) {
            $unit =  $this->mdet->getUnit($unitid->unitId);
            $resultJadwal = $this->mdet->getJadwalUnit(null, $unit->multiple_kode_unit);

            $output = [];

            foreach ($results as $row) {

                $obj = [];
                $obj['type'] = 'detail';
                $obj['nik'] = $row->nik_pegawai;
                $obj['tahun'] = $row->tahun;
                $obj['bulanx'] = $row->bulan;
                $obj['bulan_nama'] = $row->bulan_nama;
                $obj['emp_id'] = $row->emp_id;
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
                $obj['ket_libur'] = $row->ket_libur;
                $obj['jml_jam_kerja'] = number_format($row->jml_jam_kerja/60,2);
                $obj['jml_jam_kurang'] = number_format($row->jml_jam_kurang/60,2);
                $obj['jml_jam_lembur'] = $row->jml_jam_lembur ;
                $obj['jml_terlambat'] = $row->jml_terlambat ;
                $obj['ket_hitungan'] = $row->ket_hitungan ;
                $output[] = $obj;
            }
            //$build_array['data'] = $output;
            

            // JML JAM KERJA
            $resultSums = $this->msum->get(null, null, 999999, null, $this->data['filtertmp']);

            $outputSUmmary = [];
            $unitName = "";
            foreach ($resultSums as $rowSUm) {

                $objSum = [];
                $objSum['type'] = 'jamkerja';
                $objSum['nik'] = $rowSUm->nik_pegawai;
                $objSum['tahun'] = $rowSUm->tahun;
                $objSum['bulanx'] = $rowSUm->bulan;
                $objSum['bulan_nama'] = $rowSUm->bulan_nama;
                $objSum['emp_name'] = $rowSUm->emp_name;
                $objSum['unitName'] = $rowSUm->unitName;
                $objSum['position_desc'] = $rowSUm->position_desc;
                $objSum['tanggal'] = "Jam Kerja";
                $objSum['kode_jadwal'] = "";
                $objSum['jdwl_masuk'] = "";
                $objSum['jdwl_pulang'] = "";
                $objSum['jam_masuk'] = "";
                $objSum['jam_pulang'] = "";
                $objSum['abs_type_desc'] = "";
                $objSum['keterangan'] = "";
                $objSum['ket_libur'] = "";
                $objSum['jml_jam_kerja'] = $rowSUm->jml_jam_kerja;
                $objSum['jml_jam_kurang'] = "";
                $objSum['jml_terlambat'] = "";
                $objSum['jml_jam_lembur'] = $rowSUm->jml_jam_lembur ;
                $objSum['ket_hitungan'] = 0 ;
                $unitName = $rowSUm->unitName;
                $outputSUmmary[] = $objSum;
            }

            // echo '<pre>';
            // print_r($outputSUmmary);
            // die();

            //Jumlah Cuti
            $outputJmlCuti = [];
            foreach ($resultSums as $rowJmlCuti) {

                $objJmlCuti = [];
                $objJmlCuti['type'] = 'jmlcuti';
                $objJmlCuti['nik'] = $rowJmlCuti->nik_pegawai;
                $objJmlCuti['tahun'] = $rowJmlCuti->tahun;
                $objJmlCuti['bulanx'] = $rowJmlCuti->bulan;
                $objJmlCuti['bulan_nama'] = $rowJmlCuti->bulan_nama;
                $objJmlCuti['emp_name'] = $rowJmlCuti->emp_name;
                $objJmlCuti['unitName'] = $rowJmlCuti->unitName;
                $objJmlCuti['position_desc'] = $rowJmlCuti->position_desc;
                $objJmlCuti['tanggal'] = "Jumlah Cuti";
                $objJmlCuti['kode_jadwal'] = "";
                $objJmlCuti['jdwl_masuk'] = "";
                $objJmlCuti['jdwl_pulang'] = "";
                $objJmlCuti['jam_masuk'] = "";
                $objJmlCuti['jam_pulang'] = "";
                $objJmlCuti['abs_type_desc'] = "";
                $objJmlCuti['keterangan'] = "";
                $objJmlCuti['ket_libur'] = "";
                $objJmlCuti['jml_jam_kerja'] = $rowJmlCuti->jml_jam_kerja;
                $objJmlCuti['jml_jam_kurang'] = "";
                $objJmlCuti['jml_terlambat'] = "";
                $objJmlCuti['jml_jam_lembur'] = $rowJmlCuti->jml_jam_lembur ;
                $objJmlCuti['ket_hitungan'] = 0 ;
                $outputJmlCuti[] = $objJmlCuti;
            }

            $outputSisaCuti = [];
            $unitName = "";
            foreach ($resultSums as $rowSisaCuti) {

                $objSisaCuti = [];
                $objSisaCuti['type'] = 'cuti';
                $objSisaCuti['nik'] = $rowSisaCuti->nik_pegawai;
                $objSisaCuti['tahun'] = $rowSisaCuti->tahun;
                $objSisaCuti['bulanx'] = $rowSisaCuti->bulan;
                $objSisaCuti['bulan_nama'] = $rowSisaCuti->bulan_nama;
                $objSisaCuti['emp_name'] = $rowSisaCuti->emp_name;
                $objSisaCuti['unitName'] = $rowSisaCuti->unitName;
                $objSisaCuti['position_desc'] = $rowSisaCuti->position_desc;
                $objSisaCuti['tanggal'] = "Jam Cuti";
                $objSisaCuti['kode_jadwal'] = "";
                $objSisaCuti['jdwl_masuk'] = "";
                $objSisaCuti['jdwl_pulang'] = "";
                $objSisaCuti['jam_masuk'] = "";
                $objSisaCuti['jam_pulang'] = "";
                $objSisaCuti['abs_type_desc'] = "";
                $objSisaCuti['keterangan'] = "";
                $objSisaCuti['ket_libur'] = "";
                $objSisaCuti['jml_jam_kerja'] = 12 - $rowSisaCuti->jml_cuti;
                $objSisaCuti['jml_jam_kurang'] = "";
                $objSisaCuti['jml_terlambat'] = "";
                $objSisaCuti['jml_jam_lembur'] = $rowSisaCuti->jml_jam_lembur ;
                $objSisaCuti['ket_hitungan'] = 0 ;
                $unitName = $rowSisaCuti->unitName;
                $outputSisaCuti[] = $objSisaCuti;
            }

            //JML SAKIT
            $outputJmlSakit = [];
            $unitName = "";
            foreach ($resultSums as $rowJmlSakit) {

                $objJmlSakit = [];
                $objJmlSakit['type'] = 'jml_sakit';
                $objJmlSakit['nik'] = $rowJmlSakit->nik_pegawai;
                $objJmlSakit['tahun'] = $rowJmlSakit->tahun;
                $objJmlSakit['bulanx'] = $rowJmlSakit->bulan;
                $objJmlSakit['bulan_nama'] = $rowJmlSakit->bulan_nama;
                $objJmlSakit['emp_name'] = $rowJmlSakit->emp_name;
                $objJmlSakit['unitName'] = $rowJmlSakit->unitName;
                $objJmlSakit['position_desc'] = $rowJmlSakit->position_desc;
                $objJmlSakit['tanggal'] = "Jumlah Sakit";
                $objJmlSakit['kode_jadwal'] = "";
                $objJmlSakit['jdwl_masuk'] = "";
                $objJmlSakit['jdwl_pulang'] = "";
                $objJmlSakit['jam_masuk'] = "";
                $objJmlSakit['jam_pulang'] = "";
                $objJmlSakit['abs_type_desc'] = "";
                $objJmlSakit['keterangan'] = "";
                $objJmlSakit['ket_libur'] = "";
                $objJmlSakit['jml_jam_kerja'] = $rowJmlSakit->jml_sakit;
                $objJmlSakit['jml_jam_kurang'] = "";
                $objJmlSakit['jml_terlambat'] = "";
                $objJmlSakit['jml_jam_lembur'] = $rowJmlSakit->jml_jam_lembur ;
                $objJmlSakit['ket_hitungan'] = 0 ;
                $unitName = $rowJmlSakit->unitName;
                $outputJmlSakit[] = $objJmlSakit;
            }

            //JML DISPENSASI
            $outputJmlDispensasi = [];
            $unitName = "";
            foreach ($resultSums as $rowJmlDispensasi) {

                $objJmlDispensasi = [];
                $objJmlDispensasi['type'] = 'jml_dispensasi';
                $objJmlDispensasi['nik'] = $rowJmlDispensasi->nik_pegawai;
                $objJmlDispensasi['tahun'] = $rowJmlDispensasi->tahun;
                $objJmlDispensasi['bulanx'] = $rowJmlDispensasi->bulan;
                $objJmlDispensasi['bulan_nama'] = $rowJmlDispensasi->bulan_nama;
                $objJmlDispensasi['emp_name'] = $rowJmlDispensasi->emp_name;
                $objJmlDispensasi['unitName'] = $rowJmlDispensasi->unitName;
                $objJmlDispensasi['position_desc'] = $rowJmlDispensasi->position_desc;
                $objJmlDispensasi['tanggal'] = "Jumlah Dispensasi";
                $objJmlDispensasi['kode_jadwal'] = "";
                $objJmlDispensasi['jdwl_masuk'] = "";
                $objJmlDispensasi['jdwl_pulang'] = "";
                $objJmlDispensasi['jam_masuk'] = "";
                $objJmlDispensasi['jam_pulang'] = "";
                $objJmlDispensasi['abs_type_desc'] = "";
                $objJmlDispensasi['keterangan'] = "";
                $objJmlDispensasi['ket_libur'] = "";
                $objJmlDispensasi['jml_jam_kerja'] = $rowJmlDispensasi->jml_dispensasi;
                $objJmlDispensasi['jml_jam_kurang'] = "";
                $objJmlDispensasi['jml_terlambat'] = "";
                $objJmlDispensasi['jml_jam_lembur'] = $rowJmlDispensasi->jml_jam_lembur ;
                $objJmlDispensasi['ket_hitungan'] = 0 ;
                $unitName = $rowJmlDispensasi->unitName;
                $outputJmlDispensasi[] = $objJmlDispensasi;
            }

            //JML PELATIHAN
            $outputJmlPelatihan = [];
            $unitName = "";
            foreach ($resultSums as $rowJmlPelatihan) {

                $objJmlPelatihan = [];
                $objJmlPelatihan['type'] = 'jml_pelatihan';
                $objJmlPelatihan['nik'] = $rowJmlPelatihan->nik_pegawai;
                $objJmlPelatihan['tahun'] = $rowJmlPelatihan->tahun;
                $objJmlPelatihan['bulanx'] = $rowJmlPelatihan->bulan;
                $objJmlPelatihan['bulan_nama'] = $rowJmlPelatihan->bulan_nama;
                $objJmlPelatihan['emp_name'] = $rowJmlPelatihan->emp_name;
                $objJmlPelatihan['unitName'] = $rowJmlPelatihan->unitName;
                $objJmlPelatihan['position_desc'] = $rowJmlPelatihan->position_desc;
                $objJmlPelatihan['tanggal'] = "Jumlah Dispensasi";
                $objJmlPelatihan['kode_jadwal'] = "";
                $objJmlPelatihan['jdwl_masuk'] = "";
                $objJmlPelatihan['jdwl_pulang'] = "";
                $objJmlPelatihan['jam_masuk'] = "";
                $objJmlPelatihan['jam_pulang'] = "";
                $objJmlPelatihan['abs_type_desc'] = "";
                $objJmlPelatihan['keterangan'] = "";
                $objJmlPelatihan['ket_libur'] = "";
                $objJmlPelatihan['jml_jam_kerja'] = $rowJmlPelatihan->jml_pelatihan;
                $objJmlPelatihan['jml_jam_kurang'] = "";
                $objJmlPelatihan['jml_terlambat'] = "";
                $objJmlPelatihan['jml_jam_lembur'] = $rowJmlPelatihan->jml_jam_lembur ;
                $objJmlPelatihan['ket_hitungan'] = 0 ;
                $unitName = $rowJmlPelatihan->unitName;
                $outputJmlPelatihan[] = $objJmlPelatihan;
            }

            $build_array = array(
                "data" => array()
            );

            $build_personil_array = array(
                "data" => array()
            );


            if(!empty($unitid)){
                $this->data['namaUnit'] = $unitName;
            }else{
                $this->data['namaUnit'] = '';
            }

            $this->data['infolap'] = $infolap;
            $outputSumPersonil = [];

            $resultSumsPersonil = $this->msum->get(null, null, 999999, null, $this->data['filtertmp']);
            foreach ($resultSumsPersonil as $rowSmp) {
                $objSumPersonil = [];
                $objSumPersonil['type'] = 'jamkerja';
                $objSumPersonil['nik'] = $rowSmp->nik_pegawai;
                $objSumPersonil['tahun'] = $rowSmp->tahun;
                $objSumPersonil['bulanx'] = $rowSmp->bulan;
                $objSumPersonil['bulan_nama'] = $rowSmp->bulan_nama;
                $objSumPersonil['emp_name'] = $rowSmp->emp_name;
                $objSumPersonil['unitName'] = $rowSmp->unitName;
                $objSumPersonil['position_desc'] = $rowSmp->position_desc;
                $objSumPersonil['jml_dinas'] = $rowSmp->jml_dinas;
                $objSumPersonil['jml_izin'] = $rowSmp->jml_izin;
                $objSumPersonil['jml_cuti'] = $rowSmp->jml_cuti;
                $objSumPersonil['jml_sakit'] = $rowSmp->jml_sakit;
                $objSumPersonil['jml_reimburse'] = $rowSmp->jml_reimburse;
                $objSumPersonil['jml_pot_point_kehadiran'] = $rowSmp->jml_pot_point_kehadiran;
                $objSumPersonil['jml_pot_point_keterlambatan'] = $rowSmp->jml_pot_point_keterlambatan;
                $objSumPersonil['jml_jam_kerja'] = $rowSmp->jml_jam_kerja;
                $objSumPersonil['jml_jam_kurang'] = $rowSmp->jml_jam_kurang;
                $objSumPersonil['jml_terlambat'] = $rowSmp->jml_terlambat;
                $objSumPersonil['jml_jam_lembur'] = $rowSmp->jml_jam_lembur ;
                $objSumPersonil['ket_hitungan'] = 0 ;
                $outputSumPersonil[] = $objSumPersonil;
            }
        }
        
        $build_array["data"] = $output;
        $build_personil_array["data"] = $outputSumPersonil;
        $this->data['results'] = $build_array['data'];
        $this->data['jadwal'] = $resultJadwal;
        $this->data['resultsPersonil'] = $build_personil_array['data'];
        $html = $this->load->view("vrekapgeneratedata", $this->data, true);
    
    
        echo $html;
        exit();
				
    }
}
