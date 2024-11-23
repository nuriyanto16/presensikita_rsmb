<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Mpenjadwalan $memp
 */

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Izinsakit extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRESENSI_PENJADWALAN";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("presensi/Mizin", "mizn");
        $this->load->helper('url');
        
    }

    public function index()
    {
        $this->data['titlehead'] = "Laporan Izin/Sakit";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/laporan/izinsakit.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        
        // $this->data['list_company'] = $list_company;

        $this->_render_page('vlaporan_izin_sakit', $this->data, false, 'tmpl/vwbacktmpl');
    }

    
    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mizn->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mizn->get_cnt($filters);
        $totaldata = $this->mizn->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->id_aju);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'presensi/izin/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/izin/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//          

            $obj = [];
            $obj['comp_name'] = $row->comp_name;
            $obj['emp_name'] = $row->emp_name;
            $obj['desc_izin'] = $row->desc_izin;
            $obj['tgl_awal_izin'] = $row->tgl_awal_izin;
            $obj['tgl_akhir_izin'] = $row->tgl_akhir_izin;
            $obj['jml'] = $row->jml;
            $obj['alasan_izin'] = $row->alasan_izin;
            $obj['stat_pengajuan'] = strtoupper($row->stat_pengajuan);
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }
        $build_array["data"] = $output;

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

  
    public function getExporExcel() {

        // $periode_id = intval($this->input->get('periode_id'));
        // $bulan_id = intval($this->input->get('bulan_id'));
        // $comp_id = intval($this->input->get('comp_id'));
        // $emp_id = intval($this->input->get('emp_id'));
        // $unitid = intval($this->input->get('unit_id'));
        // $type = $this->input->get('type');
        // $varian = $this->input->get('varian');
        
        // if($emp_id != 0 ){
        //     $this->data['filtertmp'] =
        //     array(
        //         array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
        //         array('field' => "b.unitid",'type' => "=",'value' => $unitid),
        //         array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
        //         array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
        //         array('field' => "a.emp_id",'type' => "=",'value' => $emp_id)
        //     );
        // }else{
        //     $this->data['filtertmp'] =
        //     array(
        //         array('field' => "a.compid",'type' => "=",'value' => $comp_id ),
        //         array('field' => "b.unitid",'type' => "=",'value' => $unitid),
        //         array('field' => "a.tahun",'type' => "=",'value' => $periode_id ),
        //         array('field' => "a.bulan",'type' => "=",'value' => $bulan_id ),
        //     );
        // }

        // DETAIL
        $results = $this->mizn->get();
		// $infolap = strtoupper('Bulan '.$this->bulan($bulan_id).' Tahun '.$periode_id);
        
        // $unit =  $this->mdet->getUnit($unitid);
        // $resultJadwal = $this->mdet->getJadwalUnit(null, $unit->multiple_kode_unit);

        $build_array = array(
            "data" => array()
        );


        $output = [];

        foreach ($results as $row) {

            $obj = [];
            $obj['alasan_izin'] = $row->alasan_izin;
            $obj['comp_name'] = $row->comp_name;
            $obj['desc_izin'] = $row->desc_izin;
            $obj['emp_name'] = $row->emp_name;
            $obj['jml'] = $row->jml;
            $obj['stat_pengajuan'] = $row->stat_pengajuan;
            $obj['tgl_akhir_izin'] = $row->tgl_akhir_izin;
            $obj['tgl_awal_izin'] = $row->tgl_awal_izin;
            $output[] = $obj;
        }
        $build_array['data'] = $output;


            header("Content-type: application/octet-stream"); 
            header("Content-Disposition: attachment;filename=EXPORT_DETAIL_KEHADIRAN_".$infolap.".xls");
            header("Content-Transfer-Encoding: binary");
            header('Pragma: no-cache');
            header('Expires: 0');
            set_time_limit(0);
                    $build_array["data"] = $output;
                    $build_personil_array["data"] = $outputSumPersonil;
                    $this->data['results'] = $build_array['data'];
                    $this->data['jadwal'] = $resultJadwal;
                    $this->data['resultsPersonil'] = $build_personil_array['data'];
                    $html = $this->load->view("vexport_izin_sakit", $this->data, true);
           
            
        
            echo $html;
            exit();
        

        $this->load->view('vexport_kehadiran',$data);
				
    }

}
