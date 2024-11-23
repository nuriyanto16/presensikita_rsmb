<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Rekapabsen
 * @property Mrcsa $mrcsa
 * @property Mcompany $mcompany
 * @property Memployee $memployee
 */
class Rekapabsen extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_LAPORAN_REKAPABSEN";
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
        $this->data['titlehead'] = "Rekapitulasi Absensi Karyawan";

        $stdClass = new stdClass();
        $stdClass->bulan_id = null;
        $stdClass->periode_id = null;
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
            HTTP_MOD_JS . 'modules/laporan/rekapabsen.js'
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

        $this->_render_page('vrekapabsen', $this->data, false, 'tmpl/vwbacktmpl');
    }

    private function generate_absen_bulanan($compid,$emp_id)
    {
        $this->db->trans_begin();

        // generate approval
        $this->generate_approval($id);

        // update rcsa
        $data['status_rcsa_id'] = 2; // Status Approval
        $this->mrcsa->update($id, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $success = false;
        } else {
            $this->db->trans_commit();
            $success = true;
        }

        // log
        if ($success === true) $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Input RCSA (RTM) di-Kirim");

        return $success;
    }


    public function listssummary()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->msum->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->msum->get_cnt($filters);
        $totaldata = $this->msum->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {

            $obj = [];
            $obj['nik'] = $row->nik_pegawai;
            $obj['tahun'] = $row->tahun;
            $obj['bulan_nama'] = $row->bulan_nama;
            $obj['emp_name'] = $row->emp_name;
            $obj['unitName'] = $row->unitName;
            $obj['position_desc'] = $row->position_desc;
            $obj['jml_hadir'] = $row->jml_hadir;
            $obj['jml_alpha'] = $row->jml_alpha;
            $obj['jml_izin'] = $row->jml_izin;
            $obj['jml_sakit'] = $row->jml_sakit;
            $obj['jml_dinas'] = $row->jml_dinas;
            $obj['jml_reimburse'] = $this->to_rupiah($row->jml_reimburse);
            $obj['jml_jam_kerja'] = $row->jml_jam_kerja;
            $obj['jml_jam_kurang'] = $row->jml_jam_kurang;
            $obj['jml_pot_point_kehadiran'] = $row->jml_pot_point_kehadiran;
            $obj['jml_pot_point_keterlambatan'] = $row->jml_pot_point_keterlambatan;
            $obj['jml_jam_lembur'] = $row->jml_jam_lembur;

            $output[] = $obj;
        }
        $build_array["data"] = $output;
        


        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    public function listsdetail()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mdet->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mdet->get_cnt($filters);
        $totaldata = $this->mdet->get_cnt($filters);
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {

            if($row->jam_masuk == $row->jam_pulang){
                $row->jam_pulang = '00:00';
            }

            $obj = [];
            $obj['nik'] = $row->nik_pegawai;
            $obj['tahun'] = $row->tahun;
            $obj['bulan_nama'] = $row->bulan_nama;
            $obj['emp_name'] = $row->emp_name;
            $obj['unitName'] = $row->unitName;
            $obj['position_desc'] = $row->position_desc;
            $obj['tanggal'] = $row->tanggal;
            $obj['jdwl_masuk'] = $row->jdwl_masuk;
            $obj['jdwl_pulang'] = $row->jdwl_pulang;
            $obj['jam_masuk'] = $row->jam_masuk;
            $obj['jam_pulang'] = $row->jam_pulang;  
            $obj['abs_type_desc'] = $row->abs_type_desc;
            $obj['keterangan'] = $row->keterangan;
            $obj['ket_libur'] = $row->ket_libur;
            $obj['jml_jam_kerja'] = number_format($row->jml_jam_kerja/60,2) ." Jam";
            $obj['jml_jam_kurang'] = number_format($row->jml_jam_kurang/60,2)  ." Jam";
            $obj['jml_terlambat'] = ($row->jml_terlambat == 1) ? "Terlambat" : "";
            $obj['jml_jam_lembur'] = $row->jml_jam_lembur ;
            $obj['ket_hitungan'] = $row->ket_hitungan ;
            $output[] = $obj;
        }
        $build_array["data"] = $output;

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    function to_rupiah($bil=null){
        $rupiah = number_format($bil, 0, ',', '.');
        return $rupiah;
    }


    public function generateabsen()
    {
        $this->form_validation->set_rules('periode_id', 'Periode Risiko', 'required|integer');
        $this->form_validation->set_rules('bulan_id', 'Organisasi', "required|integer");
        $this->form_validation->set_rules('compid', 'Perusahaan', "required|integer");
        
        $json = [];
        $status_code = 400;
        if ($this->form_validation->run()) {

            $json = [ 'det_results' => []];
            
            $periode_id = $this->input->post("periode_id");
            $bulan_id = $this->input->post("bulan_id");
            $comp_id = $this->input->post("compid");
            $emp_id = ($this->input->post('nik') !== null) ? $this->input->post('nik') : 0;
 
            $results = $this->mod->generate_absensi($comp_id, $emp_id, $periode_id, $bulan_id);

            if($results){
                $json['stat_generate'] = "Data berhasil digenerate";

                $x=0;
                while ($x <= 1) {
                    $json['det_results'][] = [
                        'stat_generate' => 'Data berhasil digenerate'
                    ];
                    $x++;
                }
            

            }else{
                $json['stat_generate'] = "Data gagal digenerate";
            }

            $status_code = 200;
        } else {
            if (!empty(form_error('periode_id'))) {
                $json['periode_id'] = form_error('periode_id');
            }
            if (!empty(form_error('comp_id'))) {
                $json['comp_id'] = form_error('comp_id');
            }
            if (!empty(form_error('bulan_id'))) {
                $json['bulan_id'] = form_error('bulan_id');
            }
        }

        $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function generatejadwal()
    {
        
        $json = [];
        $status_code = 400;

        $periode_id = $this->input->post("periode_id");
        $bulan_id = $this->input->post("bulan_id");
        $comp_id = $this->input->post("compid");
        $unit_id = $this->input->post("unit_id");
        $emp_id = ($this->input->post('nik') !== null) ? $this->input->post('nik') : 0;

        if ($periode_id != null && $bulan_id != null && $unit_id != null ) {

            $json = [ 'det_results' => []];
            
            $results = $this->mod->generate_jadwal($comp_id, $unit_id, $emp_id, $periode_id, $bulan_id);

            if($results){
                $json['stat_generate'] = "Data berhasil digenerate";

                $x=0;
                while ($x <= 1) {
                    $json['det_results'][] = [
                        'stat_generate' => 'Data berhasil digenerate'
                    ];
                    $x++;
                }
            

            }else{
                $json['stat_generate'] = "Data gagal digenerate";
            }

            $status_code = 200;
        } else {
            if (!empty(form_error('periode_id'))) {
                $json['periode_id'] = form_error('periode_id');
            }
            if (!empty(form_error('comp_id'))) {
                $json['comp_id'] = form_error('comp_id');
            }
            if (!empty(form_error('bulan_id'))) {
                $json['bulan_id'] = form_error('bulan_id');
            }
        }

        $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    public function getExportSummary() {

        $periode_id = intval($this->input->get('periode_id'));
        $bulan_id = intval($this->input->get('bulan_id'));
        $comp_id = intval($this->input->get('comp_id'));
        $emp_id = intval($this->input->get('emp_id'));
        $unitid = intval($this->input->get('unit_id'));
        $type = $this->input->get('type');
        
        if($emp_id != 0 ){
            $this->data['filtertmp'] =
            array(
                array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
                array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
                array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
                array('field' => "a.emp_id",'type' => "=",'value' => $emp_id),
                array('field' => "b.unitid",'type' => "=",'value' => $unitid)
            );
        }else{
            $this->data['filtertmp'] =
            array(
                array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
                array('field' => "b.unitid",'type' => "=",'value' => $unitid),
                array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
                array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
            );
        }


        $results = $this->msum->get(null, null, 999999, null, $this->data['filtertmp']);
		
        $header = "
        <style>
            table {
                font-family: sans-serif;
                border: 0.5mm solid black;
                border-collapse: collapse;
            }
            table.table2 {
                border: 1mm solid black;
                border-collapse: collapse;
            }
            table.layout {
                border: 0.5mm solid black;
                border-collapse: collapse;
            }
            td.layout {
                text-align: center;
                border: 0.5mm solid black;
            }
            td {
                padding: 1.5mm;
                border: 0.5mm solid black;
                vertical-align: middle;
            }
            td.redcell {
                border: 0.5mm solid black;
            }
            td.redcell2 {
                border: 0.5mm solid black;
            }
            </style>
        ";
		$header .= "<table width='100%' border='0'>       
                        <tr>
                            <td colspan='12' align='center'><strong>Laporan Rekap Absensi Karyawan</strong></td>
                        </tr>
				    </table>";
        
		$print = $header."<table align='center' border='1'>
                            <tr>
                                <td align='center'>Tahun</td>
                                <td align='center'>Bulan</td>
                                <td align='center'>NIK</td>
                                <td align='center'>Nama</td>
                                <td align='center'>Jabatan</td>
                                <td align='center'>Jumlah Hadir</td>
                                <td align='center'>Jumlah Alpha</td>
                                <td align='center'>Jumlah Izin</td>
                                <td align='center'>Jumlah Sakit</td>
                                <td align='center'>Jumlah Dinas Luar</td>
                                <td align='center'>Jumlah Reimburse</td>
                                <td align='center'>Jumlah Jam Kerja</td>
                                <td align='center'>Jumlah Kekurangan Jam</td>
                            </tr>";
        $bulan = "";
        $tahun = "";
        if ($results != null) {
            $no = 1;

            foreach($results as $row){

                $bulan = $row->bulan_nama;
                $tahun = $row->tahun;

                $print .= "<tr>
                                <td>".$row->tahun."</td>
                                <td>".$row->bulan_nama."</td>
                                <td>".$row->nik."</td>
                                <td>".$row->emp_name."</td>
                                <td>".$row->emp_name."</td>
                                <td>".$row->jml_hadir."</td>
                                <td>".$row->jml_alpha."</td>
                                <td>".$row->jml_izin."</td>
                                <td>".$row->jml_sakit."</td>
                                <td>".$row->jml_dinas."</td>
                                <td>".$this->to_rupiah($row->jml_reimburse)."</td>
                                <td>".$row->jml_jam_kerja ." Jam". "</td>
                                <td>".$row->jml_jam_kurang  ." Jam". "</td>
                        </tr>";
                $no++;
            }
        }

        
		
		$print .= "	</tbody>
                </table>";


        if($type=="pdf"){
            set_time_limit(0);
            $mpdf = new \Mpdf\Mpdf();
            //$html = $this->load->view('html_to_pdf',[],true);
            $mpdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '',
                15, // margin_left
                15, // margin right
                15, // margin top
                15, // margin bottom
                10, // margin header
                10); // margin footer
            $mpdf->WriteHTML($print);
            $mpdf->Output(); // opens in browser
            //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
        }else{
            // header("Content-type: application/octet-stream"); 
            // header("Content-Disposition: attachment;filename=export_detail_kehadiran_".$tahun."_".$bulan.".xls");
            // header("Content-Transfer-Encoding: binary");
            // header('Pragma: no-cache');
            // header('Expires: 0');
            // set_time_limit(0);
            
            echo $print;
        }
                

				
    }

    public function getExportDetail($isPdf=null) {

        $periode_id = intval($this->input->get('periode_id'));
        $bulan_id = intval($this->input->get('bulan_id'));
        $comp_id = intval($this->input->get('comp_id'));
        $emp_id = intval($this->input->get('emp_id'));
        $unitid = intval($this->input->get('unit_id'));

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
                array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
            );
        }

        // DETAIL
        $results = $this->mdet->get(null, null, 999999, null, $this->data['filtertmp']);
		$infolap = strtoupper('Bulan '.$this->bulan($bulan_id).' Tahun '.$periode_id);

        $this->data['bulan'] = $bulan_id;
        $this->data['tahun'] = $periode_id;
        $this->data['abs_types'] = $this->msum->getAbsType();
        //print_r($this->data['abs_types']);die();


        $resultKetidakhadiran = $this->msum->getRekapKetidakhadiran($bulan_id, $periode_id, $unitid, $emp_id);
        //Point Ketidakhadiran &keterlambatan
        $array_ketidakhadiran = [];
        foreach ($resultKetidakhadiran as $row) {
            if(empty($array_ketidakhadiran[$row->nik_pegawai]['point_ketidakhadiran'])){
                $array_ketidakhadiran[$row->nik_pegawai]['point_ketidakhadiran'] = '';
            }
            if(empty($array_ketidakhadiran[$row->nik_pegawai]['persen_ketidakhadiran'])){
                $array_ketidakhadiran[$row->nik_pegawai]['persen_ketidakhadiran'] = '';
            }
            if(empty($array_ketidakhadiran[$row->nik_pegawai]['point_keterlambatan'])){
                $array_ketidakhadiran[$row->nik_pegawai]['point_keterlambatan'] = '';
            }
            if(empty($array_ketidakhadiran[$row->nik_pegawai]['persen_keterlambatan'])){
                $array_ketidakhadiran[$row->nik_pegawai]['persen_keterlambatan'] = '';
            }

            $array_ketidakhadiran[$row->nik_pegawai]['point_ketidakhadiran'] = $row->point_ketidakhadiran;
            $array_ketidakhadiran[$row->nik_pegawai]['persen_ketidakhadiran'] = $row->persen_ketidakhadiran.' %';
            $array_ketidakhadiran[$row->nik_pegawai]['point_keterlambatan'] = $row->point_keterlambatan;
            $array_ketidakhadiran[$row->nik_pegawai]['persen_keterlambatan'] = $row->persen_keterlambatan.' %';

        }
        //echo '<pre>';print_r($array_ketidakhadiran);die();


        $unit =  $this->mdet->getUnit($unitid);
        
        $resultJadwal = $this->mdet->getJadwalUnit(null, $unit->multiple_kode_unit);
       
        // $build_array = array(
        //     "data" => array()
        // );
        $output = [];

        foreach ($results as $row) {

            if($row->jam_masuk == $row->jam_pulang){
                $row->jam_pulang = '00:00';
            }

            $obj = [];
            $obj['type'] = 'detail';
            $obj['nik'] = $row->nik_pegawai;
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
            $obj['ket_libur'] = $row->ket_libur;
            $obj['jml_jam_kerja'] = number_format($row->jml_jam_kerja/60,2);
            $obj['jml_jam_kurang'] = number_format($row->jml_jam_kurang/60,2);
            $obj['jml_jam_lembur'] = $row->jml_jam_lembur ;
            $obj['jml_terlambat'] = $row->jml_terlambat ;
            $obj['ket_hitungan'] = $row->ket_hitungan ;
            $obj['jml_pot_point_kehadiran'] = isset($array_ketidakhadiran[$row->nik_pegawai]['persen_ketidakhadiran']) ? $array_ketidakhadiran[$row->nik_pegawai]['persen_ketidakhadiran'] : 0;
            $obj['jml_pot_point_keterlambatan'] = isset($array_ketidakhadiran[$row->nik_pegawai]['persen_keterlambatan']) ? $array_ketidakhadiran[$row->nik_pegawai]['persen_keterlambatan'] : 0;
            $output[] = $obj;
        }
        //$build_array['data'] = $output;


        // JML JAM KERJA
        $resultSums = $this->msum->get(null, null, 999999, null, $this->data['filtertmp']);

        $outputSum = [];
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
            $objSum['jml_pot_point_kehadiran'] = "";
            $objSum['jml_pot_point_keterlambatan'] = "";
            $unitName = $rowSUm->unitName;
            $outputSum[] = $objSum;
        }

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
            $objJmlCuti['jml_jam_kerja'] = $rowJmlCuti->jml_cuti;
            $objJmlCuti['jml_jam_kurang'] = "";
            $objJmlCuti['jml_terlambat'] = "";
            $objJmlCuti['jml_jam_lembur'] = $rowJmlCuti->jml_jam_lembur ;
            $objJmlCuti['ket_hitungan'] = 0 ;
            $objJmlCuti['jml_pot_point_kehadiran'] = '';
            $objJmlCuti['jml_pot_point_keterlambatan'] = '';
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
            $objSisaCuti['jml_pot_point_kehadiran'] = '';
            $objSisaCuti['jml_pot_point_keterlambatan'] = '';
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
            $objJmlSakit['jml_pot_point_kehadiran'] = '';
            $objJmlSakit['jml_pot_point_keterlambatan'] = '';
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
            $objJmlDispensasi['jml_pot_point_kehadiran'] = '';
            $objJmlDispensasi['jml_pot_point_keterlambatan'] = '';
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
            $objJmlPelatihan['jml_pot_point_kehadiran'] = '';
            $objJmlPelatihan['jml_pot_point_keterlambatan'] = '';
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

        if($emp_id != 0 ){
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
                $objSumPersonil['jml_pot_point_kehadiran'] = isset($array_ketidakhadiran[$rowSmp->nik_pegawai]['persen_ketidakhadiran']) ? $array_ketidakhadiran[$rowSmp->nik_pegawai]['persen_ketidakhadiran'] : 0; //$rowSmp->jml_pot_point_kehadiran;
                $objSumPersonil['jml_pot_point_keterlambatan'] = isset($array_ketidakhadiran[$rowSmp->nik_pegawai]['persen_keterlambatan']) ? $array_ketidakhadiran[$rowSmp->nik_pegawai]['persen_keterlambatan'] : 0; //$rowSmp->jml_pot_point_keterlambatan;
                $objSumPersonil['jml_jam_kerja'] = $rowSmp->jml_jam_kerja;
                $objSumPersonil['jml_jam_kurang'] = $rowSmp->jml_jam_kurang;
                $objSumPersonil['jml_terlambat'] = $rowSmp->jml_terlambat;
                $objSumPersonil['jml_jam_lembur'] = $rowSmp->jml_jam_lembur ;
                $objSumPersonil['ket_hitungan'] = 0 ;
                $outputSumPersonil[] = $objSumPersonil;
            }
        }
        
        //Point Kehadiran
        $outputSumPoint1 = [];
        foreach ($resultSums as $rowSUm) {

            $objSum = [];
            $objSum['type'] = 'poin_ketidakhadiran';
            $objSum['nik'] = $rowSUm->nik_pegawai;
            $objSum['tahun'] = $rowSUm->tahun;
            $objSum['bulanx'] = $rowSUm->bulan;
            $objSum['bulan_nama'] = $rowSUm->bulan_nama;
            $objSum['emp_name'] = $rowSUm->emp_name;
            $objSum['unitName'] = $rowSUm->unitName;
            $objSum['position_desc'] = $rowSUm->position_desc;
            $objSum['tanggal'] = "Poin Ketidak Hadiran";
            $objSum['kode_jadwal'] = "";
            $objSum['jdwl_masuk'] = "";
            $objSum['jdwl_pulang'] = "";
            $objSum['jam_masuk'] = "";
            $objSum['jam_pulang'] = "";
            $objSum['abs_type_desc'] = "";
            $objSum['keterangan'] = "";
            $objSum['ket_libur'] = "";
            $objSum['jml_jam_kerja'] = "";
            $objSum['jml_jam_kurang'] = "";
            $objSum['jml_terlambat'] = "";
            $objSum['jml_jam_lembur'] = "";
            $objSum['ket_hitungan'] = 0 ;
            $objSum['jml_pot_point_kehadiran'] = isset($array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_ketidakhadiran']) ? $array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_ketidakhadiran'] : 0;
            $objSum['jml_pot_point_keterlambatan'] = isset($array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_keterlambatan']) ? $array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_keterlambatan'] : 0;
            $outputSumPoint1[] = $objSum;
        }
        //echo '<pre>';print_r($outputSumPoint1);die();

        //Point Kehadiran
        $outputSumPoint2 = [];
        foreach ($resultSums as $rowSUm) {

            $objSum = [];
            $objSum['type'] = 'poin_keterlambatan';
            $objSum['nik'] = $rowSUm->nik_pegawai;
            $objSum['tahun'] = $rowSUm->tahun;
            $objSum['bulanx'] = $rowSUm->bulan;
            $objSum['bulan_nama'] = $rowSUm->bulan_nama;
            $objSum['emp_name'] = $rowSUm->emp_name;
            $objSum['unitName'] = $rowSUm->unitName;
            $objSum['position_desc'] = $rowSUm->position_desc;
            $objSum['tanggal'] = "Poin Keterlambatan";
            $objSum['kode_jadwal'] = "";
            $objSum['jdwl_masuk'] = "";
            $objSum['jdwl_pulang'] = "";
            $objSum['jam_masuk'] = "";
            $objSum['jam_pulang'] = "";
            $objSum['abs_type_desc'] = "";
            $objSum['keterangan'] = "";
            $objSum['ket_libur'] = "";
            $objSum['jml_jam_kerja'] = "";
            $objSum['jml_jam_kurang'] = "";
            $objSum['jml_terlambat'] = "";
            $objSum['jml_jam_lembur'] = "";
            $objSum['ket_hitungan'] = 0 ;
            $objSum['jml_pot_point_kehadiran'] = isset($array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_ketidakhadiran']) ? $array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_ketidakhadiran'] : 0;
            $objSum['jml_pot_point_keterlambatan'] = isset($array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_keterlambatan']) ? $array_ketidakhadiran[$rowSUm->nik_pegawai]['persen_keterlambatan'] : 0;
            $outputSumPoint2[] = $objSum;
        }
        
        
        if($type=="pdf"){
            set_time_limit(0);
            if($varian==2){

                $resData = array_merge($output, $outputSum, $outputJmlCuti, $outputSisaCuti, $outputJmlSakit, $outputJmlDispensasi, $outputJmlPelatihan);
                $build_array["data"] = $resData;
                $this->data['results'] = $build_array['data'];

                $mpdf = new \Mpdf\Mpdf(['format' => [800, 500]]);
                $html = $this->load->view("vexport_kehadiran_varian02", $this->data, true);
            }else{
                $mpdf = new \Mpdf\Mpdf();
                //$html = $this->load->view('html_to_pdf',[],true);
                $mpdf->AddPage('L', // L - landscape, P - portrait
                    '', '', '', '',
                    15, // margin_left
                    15, // margin right
                    15, // margin top
                    15, // margin bottom
                    10, // margin header
                    10); // margin footer

                $build_array["data"] = $output;
                $build_personil_array["data"] = $outputSumPersonil;
                $this->data['results'] = $build_array['data'];
                $this->data['resultsPersonil'] = $build_personil_array['data'];
                $html = $this->load->view("vexport_kehadiran_varian01", $this->data, true);
            }

            //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
        }else if($type=="xls"){
            header("Content-type: application/octet-stream"); 
            header("Content-Disposition: attachment;filename=EXPORT_DETAIL_KEHADIRAN_".$infolap.".xls");
            header("Content-Transfer-Encoding: binary");
            header('Pragma: no-cache');
            header('Expires: 0');
            set_time_limit(0);
            if($varian==2){

                $resData = array_merge($output, $outputSum, $outputJmlCuti, $outputSisaCuti, $outputJmlSakit, $outputJmlDispensasi, $outputJmlPelatihan, $outputSumPoint1, $outputSumPoint2);

                $build_array["data"] = $resData;
                $this->data['jadwal'] = $resultJadwal;
                $this->data['results'] = $build_array['data'];

                // echo '<pre>';print_r($this->data['results']);die();
                $html = $this->load->view("vexport_kehadiran_varian02", $this->data, true);

            }else{
                if($emp_id != 0 ){
                    $build_array["data"] = $output;
                    $build_personil_array["data"] = $outputSumPersonil;
                    $this->data['results'] = $build_array['data'];
                    $this->data['jadwal'] = $resultJadwal;
                    $this->data['resultsPersonil'] = '';//$build_personil_array['data'];

                    $html = $this->load->view("vexport_kehadiran_varian01", $this->data, true);
                }else{
                    $build_array["data"] = $output;
                    $build_personil_array["data"] = $outputSumPersonil;
                    $this->data['results'] = $build_array['data'];
                    $this->data['jadwal'] = $resultJadwal;
                    $this->data['resultsPersonil'] = $build_personil_array['data'];
                    $html = $this->load->view("vexport_kehadiran_varian01", $this->data, true);
                }
            }
        
            echo $html;
            exit();
        }else if($type=="preview"){
            set_time_limit(0);
            if($varian==2){

                $resData = array_merge($output, $outputSum, $outputJmlCuti, $outputSisaCuti, $outputJmlSakit, $outputJmlDispensasi, $outputJmlPelatihan);
                $build_array["data"] = $resData;
                $this->data['jadwal'] = $resultJadwal;
                $this->data['results'] = $build_array['data'];

                $html = $this->load->view("vexport_kehadiran_varian02", $this->data, true);

            }else{
                if($emp_id != 0 ){
                    // $build_array["data"] = $output;
                    // $build_personil_array["data"] = $outputSumPersonil;
                    // $this->data['results'] = $build_array['data'];
                    // $this->data['jadwal'] = $resultJadwal;
                    // $this->data['resultsPersonil'] = $build_personil_array['data'];
                    // $html = $this->load->view("vexport_kehadiran_rinci_personil", $this->data, true);

                    // $build_array["data"] = $output;
                    // $build_personil_array["data"] = $outputSumPersonil;
                    // $this->data['results'] = $build_array['data'];
                    // $this->data['jadwal'] = $resultJadwal;
                    // $this->data['resultsPersonil'] = $build_personil_array['data'];
                    // $html = $this->load->view("vexport_kehadiran_varian01", $this->data, true);

                    $resData = array_merge($output, $outputSum, $outputJmlCuti, $outputSisaCuti, $outputJmlSakit, $outputJmlDispensasi, $outputJmlPelatihan);
                    $build_array["data"] = $resData;
                    $this->data['jadwal'] = $resultJadwal;
                    $this->data['results'] = $build_array['data'];
    
                    $html = $this->load->view("vexport_kehadiran_varian02", $this->data, true);
                }else{
                    // $build_array["data"] = $output;
                    // $build_personil_array["data"] = $outputSumPersonil;
                    // $this->data['results'] = $build_array['data'];
                    // $this->data['jadwal'] = $resultJadwal;
                    // $this->data['resultsPersonil'] = $build_personil_array['data'];
                    // $html = $this->load->view("vexport_kehadiran_varian01", $this->data, true);

                    $resData = array_merge($output, $outputSum, $outputJmlCuti, $outputSisaCuti, $outputJmlSakit, $outputJmlDispensasi, $outputJmlPelatihan);
                    $build_array["data"] = $resData;
                    $this->data['jadwal'] = $resultJadwal;
                    $this->data['results'] = $build_array['data'];
    
                    $html = $this->load->view("vexport_kehadiran_varian02", $this->data, true);
                }
            }
        
            echo $html;
            exit();
        }

        $this->load->view('vexport_kehadiran',$data);
				
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
}
