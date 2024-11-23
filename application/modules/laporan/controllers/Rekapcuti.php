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

class Rekapcuti extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REKAP_CUTI";
        $this->_checkAuthorization($this->MOD_ALIAS);
        // $this->load->model("presensi/Mcuti", "mizn");
        $this->load->model("presensi/Mcuti", "mcti");
        $this->load->helper('url');
        
    }

    public function index()
    {
        $this->data['titlehead'] = "Laporan Rekap Cuti";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/laporan/rekapcuti.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        
        // $this->data['list_company'] = $list_company;

        $this->_render_page('vrekap_cuti', $this->data, false, 'tmpl/vwbacktmpl');
    }

    
    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mcti->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mcti->get_cnt($filters);
        $totaldata = $this->mcti->get_cnt();
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
                $atr_edit['url'] = 'presensi/cuti/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/cuti/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['comp_name'] = $row->comp_name;
            $obj['emp_name'] = $row->emp_name;
            $obj['cuti_desc'] = $row->cuti_desc;
            $obj['tgl_awal_cuti'] = $row->tgl_awal_cuti;
            $obj['tgl_akhir_cuti'] = $row->tgl_akhir_cuti;
            $obj['jml'] = $row->jml;
            $obj['alasan_cuti'] = $row->alasan_cuti;
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

      

        // DETAIL
        $results = $this->mcti->get();
		// $infolap = strtoupper('Bulan '.$this->bulan($bulan_id).' Tahun '.$periode_id);
        
        // $unit =  $this->mdet->getUnit($unitid);
        // $resultJadwal = $this->mdet->getJadwalUnit(null, $unit->multiple_kode_unit);

        $build_array = array(
            "data" => array()
        );


        $output = [];

        foreach ($results as $row) {

            $obj = [];
            $obj['alasan_cuti'] = $row->alasan_cuti;
            $obj['comp_name'] = $row->comp_name;
            $obj['cuti_desc'] = $row->cuti_desc;
            $obj['emp_name'] = $row->emp_name;
            $obj['jml'] = $row->jml;
            $obj['stat_pengajuan'] = $row->stat_pengajuan;
            $obj['tgl_akhir_cuti'] = $row->tgl_akhir_cuti;
            $obj['tgl_awal_cuti'] = $row->tgl_awal_cuti;
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
                    $html = $this->load->view("vexport_rekap_cuti", $this->data, true);
           
            
        
            echo $html;
            exit();
        

        // $this->load->view('vexport_kehadiran',$data);
				
    }

}
