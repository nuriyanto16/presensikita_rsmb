<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Mtimeprofile $mtmp
 */
class Timeprofile extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_TIMEPROFILE";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Munit", "munit");
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Mtimeprofile", "mtmp");
        $this->load->model("Mtimeprofileunit", "mtmpunit");
    }

    public function index()
    {
        $this->data['titlehead'] = "Jadwal Kerja";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/timeprofile.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vtimeprofile_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');
        $listjadwal = $this->input->post('listjadwal');
        
        $results = $this->mtmp->get(null, $start, $limit, $order, $filters, $listjadwal);
        $totalfiltered = $this->mtmp->get_cnt($filters, $listjadwal);
        $totaldata = $this->mtmp->get_cnt(null, $listjadwal);
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->id_tp);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/timeprofile/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/timeprofile/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));
            
            $obj = [];
            $obj['id_tp'] = $row->id_tp;
            $obj['comp_name'] = $row->comp_name;
            $obj['deskripsi'] = $row->deskripsi;
            $obj['kode'] = $row->kode;
            $obj['hari_1'] = $row->hari_1;
            $obj['hari_1_jam_in'] = $row->hari_1_jam_in;
            $obj['hari_1_jam_out'] = $row->hari_1_jam_out;
            $obj['hari_2'] = $row->hari_2;
            $obj['hari_2_jam_in'] = $row->hari_2_jam_in;
            $obj['hari_2_jam_out'] = $row->hari_2_jam_out;
            $obj['hari_3'] = $row->hari_3;
            $obj['hari_3_jam_in'] = $row->hari_3_jam_in;
            $obj['hari_3_jam_out'] = $row->hari_3_jam_out;
            $obj['hari_4'] = $row->hari_4;
            $obj['hari_4_jam_in'] = $row->hari_4_jam_in;
            $obj['hari_4_jam_out'] = $row->hari_4_jam_out;
            $obj['hari_5'] = $row->hari_5;
            $obj['hari_5_jam_in'] = $row->hari_5_jam_in;
            $obj['hari_5_jam_out'] = $row->hari_5_jam_out;
            $obj['hari_6'] = $row->hari_6;
            $obj['hari_6_jam_in'] = $row->hari_6_jam_in;
            $obj['hari_6_jam_out'] = $row->hari_6_jam_out;
            $obj['hari_7'] = $row->hari_7;
            $obj['hari_7_jam_in'] = $row->hari_7_jam_in;
            $obj['hari_7_jam_out'] = $row->hari_7_jam_out;
            $obj['hari_7_jam_out'] = $row->hari_7_jam_out;
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }
        $build_array["data"] = $output;

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    public function listsUnit()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');
        $listjadwal = $this->input->post('listjadwal');
        
        $results = $this->mtmpunit->get(null, $start, $limit, $order, $filters, $listjadwal);
        $totalfiltered = $this->mtmpunit->get_cnt($filters, $listjadwal);
        $totaldata = $this->mtmpunit->get_cnt(null, $listjadwal);
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->id_tp);
            $atr_del = null;
            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/timeprofile/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/timeprofile/deleteunit/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, null, $atr_del);
 
            $obj = [];
            $obj['id_tp'] = $row->id_tp;
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
            $this->data['titlehead'] = "Edit Jadwal Kerja";
        } else {
            $this->data['titlehead'] = "Input Jadwal Kerja";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->nik = null;
        $stdClass->deskripsi = null;
        $stdClass->compid = null;
        $stdClass->hari_1 = null;
        $stdClass->hari_2 = null;
        $stdClass->hari_3 = null;
        $stdClass->hari_4 = null;
        $stdClass->hari_5 = null;
        $stdClass->hari_6 = null;
        $stdClass->hari_7 = null;
        $stdClass->hari_1_jam_in = null;
        $stdClass->hari_2_jam_in = null;
        $stdClass->hari_3_jam_in = null;
        $stdClass->hari_4_jam_in = null;
        $stdClass->hari_5_jam_in = null;
        $stdClass->hari_6_jam_in = null;
        $stdClass->hari_7_jam_in = null;
        $stdClass->hari_1_jam_out = null;
        $stdClass->hari_2_jam_out = null;
        $stdClass->hari_3_jam_out = null;
        $stdClass->hari_4_jam_out = null;
        $stdClass->hari_5_jam_out = null;
        $stdClass->hari_6_jam_out = null;
        $stdClass->hari_7_jam_out = null;


        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mtmp->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('deskripsi', 'Nama', 'required');
            $this->form_validation->set_rules('compid', 'Company', 'required');

            // POSTING VARIABLE
            $stdClass->deskripsi = trim($this->input->post('deskripsi'));
            $stdClass->compid = $this->input->post('compid');
            $stdClass->hari_1 = $this->input->post('hari_1');
            $stdClass->hari_2 = $this->input->post('hari_2');
            $stdClass->hari_3 = $this->input->post('hari_3');
            $stdClass->hari_4 = $this->input->post('hari_4');
            $stdClass->hari_5 = $this->input->post('hari_5');
            $stdClass->hari_6 = $this->input->post('hari_6');
            $stdClass->hari_7 = $this->input->post('hari_7');
            $stdClass->hari_1_jam_in = $this->input->post('hari_1_jam_in');
            $stdClass->hari_2_jam_in = $this->input->post('hari_2_jam_in');
            $stdClass->hari_3_jam_in = $this->input->post('hari_3_jam_in');
            $stdClass->hari_4_jam_in = $this->input->post('hari_4_jam_in');
            $stdClass->hari_5_jam_in = $this->input->post('hari_5_jam_in');
            $stdClass->hari_6_jam_in = $this->input->post('hari_6_jam_in');
            $stdClass->hari_7_jam_in = $this->input->post('hari_7_jam_in');
            $stdClass->hari_1_jam_out = $this->input->post('hari_1_jam_out');
            $stdClass->hari_2_jam_out = $this->input->post('hari_2_jam_out');
            $stdClass->hari_3_jam_out = $this->input->post('hari_3_jam_out');
            $stdClass->hari_4_jam_out = $this->input->post('hari_4_jam_out');
            $stdClass->hari_5_jam_out = $this->input->post('hari_5_jam_out');
            $stdClass->hari_6_jam_out = $this->input->post('hari_6_jam_out');
            $stdClass->hari_7_jam_out = $this->input->post('hari_7_jam_out');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;
                $min_date = '1900-01-01 ';
                $dataIn = array();
                
                $stdClassComp = $this->mcompany->get_data($stdClass->compid);
                $dataIn["comp_code"] = $stdClassComp->COMP_CODE;
                $dataIn["compid"] = $stdClass->compid;
                $dataIn["deskripsi"] = $stdClass->deskripsi;
                $dataIn["hari_1"] = ($stdClass->hari_1 == 1) ? 1 : 0;
                $dataIn["hari_2"] = ($stdClass->hari_2 == 1) ? 1 : 0;
                $dataIn["hari_3"] = ($stdClass->hari_3 == 1) ? 1 : 0;
                $dataIn["hari_4"] = ($stdClass->hari_4 == 1) ? 1 : 0;
                $dataIn["hari_5"] = ($stdClass->hari_5 == 1) ? 1 : 0;
                $dataIn["hari_6"] = ($stdClass->hari_6 == 1) ? 1 : 0;
                $dataIn["hari_7"] = ($stdClass->hari_7 == 1) ? 1 : 0;
                $dataIn["hari_1_jam_in"] = ($stdClass->hari_1_jam_in !== '' ) ? $min_date.$stdClass->hari_1_jam_in : null;
                $dataIn["hari_2_jam_in"] = ($stdClass->hari_2_jam_in !== '' ) ? $min_date.$stdClass->hari_2_jam_in : null;
                $dataIn["hari_3_jam_in"] = ($stdClass->hari_3_jam_in !== '' ) ? $min_date.$stdClass->hari_3_jam_in : null;
                $dataIn["hari_4_jam_in"] = ($stdClass->hari_4_jam_in !== '' ) ? $min_date.$stdClass->hari_4_jam_in : null;
                $dataIn["hari_5_jam_in"] = ($stdClass->hari_5_jam_in !== '' ) ? $min_date.$stdClass->hari_5_jam_in : null;
                $dataIn["hari_6_jam_in"] = ($stdClass->hari_6_jam_in !== '' ) ? $min_date.$stdClass->hari_6_jam_in : null;
                $dataIn["hari_7_jam_in"] = ($stdClass->hari_7_jam_in !== '' ) ? $min_date.$stdClass->hari_7_jam_in : null;
                $dataIn["hari_1_jam_out"] = ($stdClass->hari_1_jam_out !== '' ) ? $min_date.$stdClass->hari_1_jam_out : null;
                $dataIn["hari_2_jam_out"] = ($stdClass->hari_2_jam_out !== '' ) ? $min_date.$stdClass->hari_2_jam_out : null;
                $dataIn["hari_3_jam_out"] = ($stdClass->hari_3_jam_out !== '' ) ? $min_date.$stdClass->hari_3_jam_out : null;
                $dataIn["hari_4_jam_out"] = ($stdClass->hari_4_jam_out !== '' ) ? $min_date.$stdClass->hari_4_jam_out : null;
                $dataIn["hari_5_jam_out"] = ($stdClass->hari_5_jam_out !== '' ) ? $min_date.$stdClass->hari_5_jam_out : null;
                $dataIn["hari_6_jam_out"] = ($stdClass->hari_6_jam_out !== '' ) ? $min_date.$stdClass->hari_6_jam_out : null;
                $dataIn["hari_7_jam_out"] = ($stdClass->hari_7_jam_out !== '' ) ? $min_date.$stdClass->hari_7_jam_out : null;

               //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mtmp->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jadwal Kerja Diperbaharui");
                    }
                } else { // insert

                    $dataIn["id_tp"] = $this->mtmp->get_new_id();

                    if ($this->mtmp->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->compid;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jadwal Kerja Baru");
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
                    redirect("reference/timeprofile", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/timeprofile_form.js',
            HTTP_JS_PATH.'jquery.inputmask.bundle.js'
        );
        $this->data['loadfoot'] = $loadfoot;

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

        //display the form
        $this->data['deskripsi'] = array(
            'name' => 'deskripsi',
            'id' => 'deskripsi',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('deskripsi', $stdClass->deskripsi)
        );
        
        $this->data['hari_1'] = array(
            'name' => 'hari_1',
            'id' => 'hari_1',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_1', ($stdClass->hari_1 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_1 == 'MASUK') ? $this->data['hari_1']['checked'] = true : "");
    
        $this->data['hari_1_jam_in'] = array(
            'name' => 'hari_1_jam_in',
            'id' => 'hari_1_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hari_1_jam_in', $stdClass->hari_1_jam_in)
        );

        $this->data['hari_1_jam_out'] = array(
            'name' => 'hari_1_jam_out',
            'id' => 'hari_1_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hari_1_jam_out', $stdClass->hari_1_jam_out)
        );

        $this->data['hari_2'] = array(
            'name' => 'hari_2',
            'id' => 'hari_2',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_2', ($stdClass->hari_2 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_2 == 'MASUK') ? $this->data['hari_2']['checked'] = true : "");
    
        $this->data['hari_2_jam_in'] = array(
            'name' => 'hari_2_jam_in',
            'id' => 'hari_2_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hari_2_jam_in', $stdClass->hari_2_jam_in)
        );

        $this->data['hari_2_jam_out'] = array(
            'name' => 'hari_2_jam_out',
            'id' => 'hari_2_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hari_2_jam_out', $stdClass->hari_2_jam_out)
        );

        $this->data['hari_3'] = array(
            'name' => 'hari_3',
            'id' => 'hari_3',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_3', ($stdClass->hari_3 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_3 == 'MASUK') ? $this->data['hari_3']['checked'] = true : "");
    
        $this->data['hari_3_jam_in'] = array(
            'name' => 'hari_3_jam_in',
            'id' => 'hari_3_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hari_3_jam_in', $stdClass->hari_3_jam_in)
        );

        $this->data['hari_3_jam_out'] = array(
            'name' => 'hari_3_jam_out',
            'id' => 'hari_3_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hari_3_jam_out', $stdClass->hari_3_jam_out)
        );

        $this->data['hari_4'] = array(
            'name' => 'hari_4',
            'id' => 'hari_4',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_4', ($stdClass->hari_4 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_4 == 'MASUK') ? $this->data['hari_4']['checked'] = true : "");
    
        $this->data['hari_4_jam_in'] = array(
            'name' => 'hari_4_jam_in',
            'id' => 'hari_4_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '40',
            'value' => $this->form_validation->set_value('hari_4_jam_in', $stdClass->hari_4_jam_in)
        );

        $this->data['hari_4_jam_out'] = array(
            'name' => 'hari_4_jam_out',
            'id' => 'hari_4_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '40',
            'value' => $this->form_validation->set_value('hari_4_jam_out', $stdClass->hari_4_jam_out)
        );

        $this->data['hari_5'] = array(
            'name' => 'hari_5',
            'id' => 'hari_5',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_5', ($stdClass->hari_5 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_5 == 'MASUK') ? $this->data['hari_5']['checked'] = true : "");
    
        $this->data['hari_5_jam_in'] = array(
            'name' => 'hari_5_jam_in',
            'id' => 'hari_5_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('hari_5_jam_in', $stdClass->hari_5_jam_in)
        );

        $this->data['hari_5_jam_out'] = array(
            'name' => 'hari_5_jam_out',
            'id' => 'hari_5_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('hari_5_jam_out', $stdClass->hari_5_jam_out)
        );

        $this->data['hari_6'] = array(
            'name' => 'hari_6',
            'id' => 'hari_6',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_6', ($stdClass->hari_6 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_6 == 'MASUK') ? $this->data['hari_6']['checked'] = true : "");
    
        $this->data['hari_6_jam_in'] = array(
            'name' => 'hari_6_jam_in',
            'id' => 'hari_6_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '60',
            'value' => $this->form_validation->set_value('hari_6_jam_in', $stdClass->hari_6_jam_in)
        );

        $this->data['hari_6_jam_out'] = array(
            'name' => 'hari_6_jam_out',
            'id' => 'hari_6_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '60',
            'value' => $this->form_validation->set_value('hari_6_jam_out', $stdClass->hari_6_jam_out)
        );

        $this->data['hari_7'] = array(
            'name' => 'hari_7',
            'id' => 'hari_7',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hari_7', ($stdClass->hari_7 == 'MASUK') ? 1 : 0)
        );
        if(($stdClass->hari_7 == 'MASUK') ? $this->data['hari_7']['checked'] = true : "");
    
        $this->data['hari_7_jam_in'] = array(
            'name' => 'hari_7_jam_in',
            'id' => 'hari_7_jam_in',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '70',
            'value' => $this->form_validation->set_value('hari_7_jam_in', $stdClass->hari_7_jam_in)
        );

        $this->data['hari_7_jam_out'] = array(
            'name' => 'hari_7_jam_out',
            'id' => 'hari_7_jam_out',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '70',
            'value' => $this->form_validation->set_value('hari_7_jam_out', $stdClass->hari_7_jam_out)
        );



        $this->data['csrf'] = $this->_get_sess_csrf();
        return $this->_render_page('reference/vtimeprofile_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mtmp->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jadwal Kerja Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/timeprofile", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mtmp->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jadwal Kerja Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/timeprofile", 'refresh');
    }

    public function get_node_org() {
        $out = [];

        $compid = intval($this->input->post('compid'));
        if (!empty($compid)) {
            $filters = [
                ['field' => 'u.compid', 'value' => $compid]
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
                $comp = $this->mcompany->get_data($compid);
                if ($comp != null) $COMP_CODE_SAP = $comp->COMP_CODE_SAP;
                $out = build_tree($output, 'parentId', 'id', $COMP_CODE_SAP);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
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
}
