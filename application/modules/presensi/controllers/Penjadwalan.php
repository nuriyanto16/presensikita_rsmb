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

class Penjadwalan extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRESENSI_PENJADWALAN";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("reference/Munit", "munit");
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Mposition_emp", "mposemp");
        $this->load->model("reference/Mkantor", "mktr");
        $this->load->model("reference/Mtimeprofile", "mtmp");
        $this->load->model("reference/Mtimeprofileperson", "mtpp");
        $this->load->model("reference/Mkeluarga", "mkel");
        $this->load->model("reference/Mcutiadjustment", "mcadj");
        $this->load->model("reference/Mperiode", "mperiode");
        $this->load->model("Mpenjadwalan", "memp");
        $this->load->helper('url');
        
    }

    public function index()
    {
        $this->data['titlehead'] = "Penjadwalan";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/importjdwl.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vpenjadwalan_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->memp->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->memp->get_cnt($filters);
        $totaldata = $this->memp->get_cnt($filters);
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->emp_id);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'presensi/penjadwalan/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/penjadwalan/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, null);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['emp_id'] = $row->emp_id;
            $obj['emp_name'] = $row->emp_name;
            $obj['nik'] = $row->nik;
            $obj['email'] = $row->email;
            $obj['position_desc'] = $row->position_desc;
            $obj['unitName'] = $row->unitName;
            $obj['aksi'] = $btnAction;
            $obj['unitId'] = $row->unitId;
            $obj['compId'] = $row->COMPID;
            $obj['comp_name'] = $row->comp_name;
            $obj['positionId'] = $row->positionId;
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }
        $build_array["data"] = $output;

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    public function listsHistoryJadwal()
    {
        $nik = $this->input->post('nik');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');
        // select option company
        $this->data['filtertmp'] = array(
            0 => array(
                    'field' => "a.nik",
                    'type' => "=",
                    'value' => $nik
            ),
            1 => array(
                'field' => "year(a.tp_start_date)",
                'type' => "=",
                'value' => $tahun
            ),
            2 => array(
                'field' => "month(a.tp_start_date)",
                'type' => "=",
                'value' => $bulan
            )
        );

        //$timeprofile = $this->mtpp->get(null, null, 999999, null, $this->data['filtertmp']);

        $results = $this->mtpp->get(null, $start, $limit, $order, $this->data['filtertmp']);
        $totalfiltered = $this->mtpp->get_cnt($this->data['filtertmp']);
        $totaldata = $this->mtpp->get_cnt($this->data['filtertmp']);
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->tp_seq);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'presensi/penjadwalan/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/penjadwalan/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));
            
            $obj = [];
            $obj['tp_seq'] = $row->tp_seq;
            $obj['id_tp'] = $row->id_tp;
            $obj['tanggal'] = $row->tp_start_date;
            $obj['deskripsi'] = $row->deskripsi;
            $obj['kode'] = $row->kode;
            $obj['hari_1_jam_in'] = $row->hari_1_jam_in;
            $obj['hari_1_jam_out'] = $row->hari_1_jam_out;
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }
        $build_array["data"] = $output;

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    public function edit_form()
    {
        $id = 0;
        $this->data['id'] = trim($this->uri->segment(4));
        if ($this->data['id'] != "") {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Penjadwalan Karyawan";
        } else {
            $this->data['titlehead'] = "Penjadwalan Karyawan";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->emp_id = null;
        $stdClass->nik = null;
        $stdClass->emp_name = null;
        $stdClass->email = null;
        $stdClass->COMPID = null;
        $stdClass->comp_code = null;
        $stdClass->unitId = null;
        $stdClass->positionId = null;
        $stdClass->position_code = null;
        $stdClass->kantor_id = null;
        $stdClass->bulan_id = null;
        $stdClass->periode_id = null;
        $stdClass->multiple_kode_unit = null;
        

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->memp->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            $this->form_validation->set_rules('emp_name', 'Nama', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('COMPID', 'Company', 'required');
            $this->form_validation->set_rules('unitId', 'Organisasi', 'required');
            $this->form_validation->set_rules('kantor_id', 'Kantor', 'required');
            $this->form_validation->set_rules('position_code', 'Posisi', 'required');
            $this->form_validation->set_rules('hp1', 'Nomor Hanphone', 'required');

            // POSTING VARIABLE
            $stdClass->nik = trim($this->input->post('nik'));
            $stdClass->emp_name = trim($this->input->post('emp_name'));
            $stdClass->email = trim($this->input->post('email'));
            $stdClass->COMPID = $this->input->post('COMPID');
            $stdClass->kantor_id = $this->input->post('kantor_id');
            $stdClass->unitId = $this->input->post('unitId');
            $stdClass->position_code = $this->input->post('position_code');  

            if ($this->form_validation->run($this) === TRUE) {

                $isError = true;
                $isUpdate = false;
                $dataInTp = array();
                $dataIn = array();
                $dataIn["emp_id"] = $stdClass->emp_id;
                $dataIn["nik"] = $stdClass->nik;
                $dataIn["emp_name"] = $stdClass->emp_name;
                $dataIn["email"] = $stdClass->email;
                $dataIn["email_addr"] = $stdClass->email;
                $dataIn["COMPID"] = $stdClass->COMPID;
                $dataIn["unitId"] = $stdClass->unitId;
                $dataIn["position_code"] = $stdClass->position_code;
                $dataIn["kantor_id"] = $stdClass->kantor_id;
                
                $stdClassComp = $this->mcompany->get_data($stdClass->COMPID);
                $dataIn["comp_code"] = $stdClassComp->COMP_CODE;

                $nik = $stdClass->nik;
                $comp_code= $stdClassComp->COMP_CODE;

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;

                    if ($this->memp->update($id, $dataIn)) {


                        //UPDATE KONFIGURASI / PERSONALIZE
                        $stat_upd_konf = $this->memp->UpdateKonfigurasi($dataKonf,$nik,$comp_code);

                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Diupdate");
                    }
                } else { // insert
                    if ($this->memp->insert($dataIn)) {
    
                        $isError = false;
                        $id = $stdClass->position_code;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Baru");
                    }
                }//endif insert or update

                if ($isError) {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = $this->_get_message(($isUpdate) ? "FAILED_UPDATED" : "FAILED_INSERTED");
                    $this->session->set_flashdata('errmsg', $this->data['errmsg']);
                } else {
                    $success_msg = ($isUpdate) ? "SUCCESS_UPDATED" : "SUCCESS_INSERTED";
                    $success_msg = $this->_get_message($success_msg);
                    $this->session->set_flashdata('message', $success_msg);
                    redirect("presensi/penjadwalan", 'refresh');
                }
            } else {
                $this->data['errmsg'] = validation_errors();
            }
        }//endif POST

        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array();
        $this->data['loadhead'] = $loadhead;

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/penjadwalan_form.js',
            HTTP_JS_PATH.'jquery.inputmask.bundle.js'
            //HTTP_ASSET_PATH . 'bootstrap-datepicker/bootstrap-datetimepicker/bootstrap-datetimepicker.js',
            //HTTP_ASSET_PATH . 'bootstrap-datepicker/bootstrap-datetimepicker/locales/bootstrap-datetimepicker.id.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['emp_id'] = array(
            'name' => 'emp_id',
            'id' => 'emp_id',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('emp_id', $stdClass->emp_id)
        );
        $this->data['nik'] = array(
            'name' => 'nik',
            'id' => 'nik',
            'type' => 'hidden',
            'class' => 'form-control',
            'maxLength' => '20',
            'value' => $this->form_validation->set_value('nik', $stdClass->nik)
        );
        $this->data['nik_pegawai'] = array(
            'name' => 'nik_pegawai',
            'id' => 'nik_pegawai',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '20',
            'value' => $this->form_validation->set_value('nik_pegawai', $stdClass->nik_pegawai)
        );
        $this->data['emp_name'] = array(
            'name' => 'emp_name',
            'id' => 'emp_name',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('emp_name', $stdClass->emp_name)
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('email', $stdClass->email)
        );

        // select option company
        $this->data['filtertmp'] = array(
            0 => array(
                    'field' => "a.compid",
                    'type' => "=",
                    'value' => $stdClass->COMPID //$this->session->userdata(sess_prefix()."compId")
                )
        );

        // select option kantor
        $this->data['id_tp'] = array(
            'name' => 'id_tp',
            'id' => 'id_tp',
            //'value' => $this->form_validation->set_value('kantor_id', $stdClass->kantor_id),
            'class' => 'form-control col-md-12'
        );

        $this->data['multiple_kode_unit'] = array(
            'name' => 'multiple_kode_unit',
            'id' => 'multiple_kode_unit',
            'value' => $this->form_validation->set_value('multiple_kode_unit', $stdClass->multiple_kode_unit),
            'class' => 'form-control col-md-12'
        );

        // select option company
        $companies = $this->mcompany->get_data(null, null, 999999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }

        $this->data['COMPID'] = array(
            'name' => 'COMPID',
            'id' => 'COMPID',
            'value' => $this->form_validation->set_value('COMPID', $stdClass->COMPID),
            'options' => $list_company,
            'class' => 'form-control'
        );
    
        // select option posisi
        $this->data['position_code'] = array(
            'name' => 'position_code',
            'id' => 'position_code',
            'value' => $this->form_validation->set_value('position_code', $stdClass->position_code),
            'class' => 'form-control col-md-12'
        );

        // select option unit
        $this->data['unitId'] = array(
            'name' => 'unitId',
            'id' => 'unitId',
            'value' => $this->form_validation->set_value('unitId', $stdClass->unitId),
            'class' => 'form-control col-md-12'
        );

        // select option kantor
        $this->data['kantor_id'] = array(
            'name' => 'kantor_id',
            'id' => 'kantor_id',
            'value' => $this->form_validation->set_value('kantor_id', $stdClass->kantor_id),
            'class' => 'form-control col-md-12'
        );

        // option periode
        $mperiodes = $this->mperiode->get_data(null,0, 999999);
        $list_periode[null] = "Pilih Periode";
        foreach ($mperiodes as $row) {
            $list_periode[$row->periode_id] = $row->periode_nama;
        }

        $this->data['periode_id'] = array(
            'name' => 'periode_id',
            'id' => 'periode_id',
            //'value' => $this->form_validation->set_value('periode_id', $stdClass->periode_id),
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
            //'value' => $this->form_validation->set_value('bulan_id', $stdClass->bulan_id),
            'class' => 'form-control'
        );

        //End Detail Jadwal Kerja
        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('presensi/vpenjadwalan_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    //delete data
    public function delete($id = NULL)
    {
        $this->deactivate($id);
    }

    //activate
    public function activate($id)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 1;
        $activation = $this->memp->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("presensi/penjadwalan", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->memp->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("presensi/penjadwalan", 'refresh');
    }

    public function get_node_position()
    {
        $out = [];
        $company_code = null;
        $COMPID = intval($this->input->post('COMPID'));
        $mcompany = $this->mcompany->get_data($COMPID);
        if (!empty($mcompany)) {
            $company_code = $mcompany->COMP_CODE;
            $filters = [
                ['field' => 'a.company_code', 'value' => $company_code]
            ];
            $results = $this->mposemp->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->position_code;
                    $arr['parentId'] = $row->parent_position_code;
                    $arr['position_desc'] = "{$row->position_code} - {$row->position_desc}";
                    $output[] = $arr;
                }
                $out = build_tree($output, 'parentId', 'id', null);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function get_node_org() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'u.COMPID', 'value' => $COMPID]
            ];
            $results = $this->munit->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->unitId;
                    $arr['parentId'] = $row->parentUnitId;
                    $arr['unitName'] = "{$row->unitCode} - {$row->unitName}";
                    $output[] = $arr;
                }
                $COMP_CODE_SAP = null;
                $comp = $this->mcompany->get_data($COMPID);
                if ($comp != null) $COMP_CODE_SAP = $comp->COMP_CODE_SAP;
                $out = build_tree($output, 'parentId', 'id', $COMP_CODE_SAP);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }


    public function get_node_kantor() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.COMPID', 'value' => $COMPID]
            ];
            $results = $this->mktr->get(null, 0, 999999, null, $filters);

            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->kantor_id;
                    $arr['parentId'] = $row->kantor_id;
                    $arr['unitName'] = "{$row->nama_kantor}";
                    $output[] = $arr;
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function get_node_jadwal() {

        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.COMPID', 'value' => $COMPID]
            ];
            $results = $this->mtmp->get(null, 0, 999999, null, $filters);

            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->id_tp;
                    $arr['parentId'] = $row->id_tp;
                    $arr['unitName'] = "{$row->deskripsi}";
                    $output[] = $arr;
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }


    public function get_node_employee() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.compid', 'type' => '=', 'value' => $COMPID]
            ];
            $results = $this->memp->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['emp_id'] = $row->emp_id;
                    $arr['emp_name'] = $row->nik." - ".strtoupper($row->emp_name);
                    $output[] = $arr;
                }
                $out = $output;
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function upload_excel() {
        $nik = $this->input->post('nik');
        if($_FILES['excel_file']['name']) {
            $ar_filename = explode('.',$_FILES['excel_file']['name']); 
            if(strtoupper($ar_filename[1]) <> 'XLSX') {
                echo "{success:false, errorInfo:'File bukan format XLSX!'}";
                die();
            }

            else if(count($ar_filename) != 2) {
                echo "{success:false, errorInfo:'Format File tidak valid'}";
                die();
            }else {       			
                $arr_file = $ar_filename[0];
                $arr_ext = $ar_filename[1];
                
                $filex = $_FILES['excel_file']['name'];
                
                $new_name = $arr_file."_".uniqid().'.'.$arr_ext;
                
                $targetDir =  upload_path.'jadwal/'.$new_name;
                move_uploaded_file($_FILES['excel_file']['tmp_name'], $targetDir);
                @chmod($file_name_new, 0777);
                
            }
         }else {
            echo "{success:false, errorInfo:'File tidak ditemukan!'}";
            die();
        }

        $spreadsheet = IOFactory::load($targetDir);
        $worksheet = $spreadsheet->getActiveSheet();
        $currentDate = date("Y-m-d H:i:s");
        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            
            // $timeFrom = $rowData[3];
            // list($hours, $minutes, $seconds) = explode(':', $timeFrom);
            // $timeFromFormatted = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            // $timeTo = $rowData[4];
            // list($hours, $minutes, $seconds) = explode(':', $timeTo);
            // $timeToFormatted = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            // Assuming your Excel data corresponds to columns like 'col1', 'col2', etc.
            
            $data = array(
                'nik' => $nik,
                'tp_start_date' => date("Y-m-d H:i:s", strtotime($currentDate)),
                'tp_end_date' => date("Y-m-d H:i:s", strtotime($currentDate)),
                'compid' => 1,
                'comp_code' => 'ABCDE1',
                'id_tp' => $rowData[4]
                // Add more columns here
            );

            if ($nik != '') {
                $insertedData[] = $data;
            }

        }

        if (!empty($insertedData)) {
            $this->memp->InsertMultipleJadwal($insertedData);
            $insertedCount = count($insertedData);
            $response = ['success' => true, 'insertedCount' => $insertedCount];
        } else {
            $response = ['success' => false, 'errorInfo' => 'Tidak ada data yang dimasukkan'];
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);

    }
    public function insertUpdateJadwal()
    {
        $id_tp = $this->input->post("id_tp");
        $nik = $this->input->post("nik");
        $tp_start_date = $this->input->post("tp_start_date");
        $tp_end_date = $this->input->post("tp_end_date");
        $mode = $this->input->post("mode");

        $json = [];
        $status_code = 400;
        if ($id_tp != '' && $nik != '') {
            
            if($mode == 'new'){
                $dataIn["nik"] = $nik;
                $dataIn["id_tp"] = $id_tp;
                $dataIn["comp_code"] = 'ABCDE1';
                $dataIn["compid"] = 1;
                $dataIn["tp_start_date"] =  date("Y-m-d H:i:s", strtotime($tp_start_date));
                $dataIn["tp_end_date"] =  date("Y-m-d H:i:s", strtotime($tp_end_date));
                $results = $this->memp->Insertjadwal($dataIn);
                if ($results) {
                    $status_code = 200;
                    $json = ['status' => '1'];
                }
            }else if($mode == 'edit'){
                $tgl =  date("Y-m-d H:i:s", strtotime($tp_start_date));;
                $dataIn["id_tp"] = $id_tp;
                $results = $this->memp->Updatejadwal($dataIn,$tgl,$nik);
                if ($results) {
                    $status_code = 200;
                    $json = ['status' => '1'];
                }
            }


        } else {
            if (!empty(form_error('id_tp'))) {
                $json['id_tp'] = form_error('id_tp');
            }
        }

        $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }


    public function deleteJadwal()
    {
        $tp_seq = $this->input->post("tp_seq");
        $nik = $this->input->post("nik");
        $mode = $this->input->post("mode");

        $json = [];
        $status_code = 400;
        if ($tp_seq != '') {
            if($mode == 'delete'){
                $dataIn["active"] = 0;
                $results = $this->memp->deletejadwal($dataIn,$tp_seq);
                if ($results) {
                    $status_code = 200;
                    $json = ['status' => '1'];
                }
            }
        } else {
            if (!empty(form_error('tp_seq'))) {
                $json['tp_seq'] = form_error('tp_seq');
            }
        }

        $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    function _get_message($msg_type, $message = '', $mode = 'success', $icons = 'check', $fadeOut = true)
    {
        $title = '';
        switch ($msg_type) {
            //--== SUCCESS
            case 'SUCCESS_INSERTED':
                $title = 'Tambah Berhasil';
                $message = 'Penambahan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_UPDATED':
                $title = 'Update Berhasil';
                $message = 'Pembaharuan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_DELETED':
                $title = 'Hapus Berhasil';
                $message = 'Penghapusan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_ACTIVATED':
                $title = 'Mengaktifkan Berhasil';
                $message = 'Pengaktifan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_DEACTIVATED':
                $title = 'Menonaktifkan Berhasil';
                $message = 'Penonaktifan data berhasil dilakukan.';
                $icons = 'check';
                break;

            //---== FAILED
            case 'FAILED_INSERTED':
                $title = 'Tambah Gagal';
                $message = 'Penambahan data gagal !';
                $icons = '';
                break;

            case 'FAILED_UPDATED':
                $title = 'Update Gagal';
                $message = 'Pembaharuan data gagal !';
                $icons = '';
                break;

            case 'FAILED_DELETED':
                $title = 'Hapus Gagal';
                $message = 'Penghapusan data gagal !';
                $icons = '';
                break;

            case 'FAILED_ACTIVATED':
                $title = 'Mengaktifkan Gagal';
                $message = 'Pengaktifan data gagal !';
                $icons = '';
                break;

            case 'FAILED_DEACTIVATED':
                $title = 'Menonaktifkan Gagal';
                $message = 'Penonaktifan data gagal !';
                $icons = '';
                break;

            case 'ERROR_VALIDATION':
                $title = '';
                break;
        }

        return message_box($title, $message, $mode, $icons, $fadeOut);
    }


    private function doUpload($file, $nik, $comp_code) {
        $this->load->library('upload');
        $this->load->library('image_lib');


        $response = array();
        $new_name = '';

        //$config['upload_path'] = dirname($_SERVER['SCRIPT_FILENAME']).'/assets/upload/konfirmasi/';
        //$config['upload_path'] = 'C:/WEB/uploads/filesdoc/'.$apl_id.'-'.$plg_id;
        //$config['upload_path'] = '/var/www/seuneu.trisula.com/html/uploads/absensi/';
        //$config['upload_path'] = '/uploads/absensi'; 
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '20971520';

        //$config['max_size'] = '2048';
        //$config['max_size'] = '2603471';

        $pfx="";
        switch($file){
            case "foto_ktp" : $pfx="_ktp"; $config['upload_path'] = upload_path.'personal/ktp/'.$comp_code.'/'; break;
            case "foto_sim" : $pfx="_sim"; $config['upload_path'] = upload_path.'personal/sim/'.$comp_code.'/'; break;
            case "foto_npwp" : $pfx="_npwp"; $config['upload_path'] = upload_path.'personal/npwp/'.$comp_code.'/'; break;
            case "foto_bpjs_tk" : $pfx="_bpjs_tk"; $config['upload_path'] = upload_path.'personal/bpjs_tk/'.$comp_code.'/'; break;
            case "foto_bpjs_kes" : $pfx="_bpjs_kes"; $config['upload_path'] = upload_path.'personal/bpjs_kes/'.$comp_code.'/'; break;
            case "foto_aia" : $pfx="_aia"; $config['upload_path'] = upload_path.'personal/aia/'.$comp_code.'/'; break;
            case "foto_asuransi" : $pfx="_asuransi"; $config['upload_path'] = upload_path.'personal/asuransi/'.$comp_code.'/'; break;
            case "foto_profile" : $pfx="_profile"; $config['upload_path'] = upload_path.'personal/photo/'; break;
            default: $pfx="err"; break;
        }

        $new_name = str_replace(":","_",trim($_FILES[$file]['name']));
        $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code."_".$new_name;
        $new_name = str_replace(" ","_",$new_name);

        $config['file_name']        = $new_name;
        $config['image_library']    = 'GD2';
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 20;
        $config['height']           = 20;
        $this->upload->initialize($config);
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();

        
        $success = true;
        $msg = '';
        try{
            $this->upload->do_upload($file);
            $msg = 'Upload successfully!';
        }catch(Exception $e){
            $success = false;
            $msg = $e->getMessage();
        }
        
        $response['success'] = $success;
        $response['file_name'] = $new_name;
        $response['message'] = $msg.';'.$new_name;
        
        return $response;
    }

    public function generate(){
    	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'!@#$%^&*()'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

		return $rand;
    }

}
