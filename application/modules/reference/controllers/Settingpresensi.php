<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Msettingpresensi $mspr
 */
class Settingpresensi extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_SETTINGPRESENSI";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Msettingpresensi", "mspr");
    }

    public function index()
    {
        $this->data['titlehead'] = "Setting Presensi";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/settingpresensi.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vsettingpresensi_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mspr->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mspr->get_cnt($filters);
        $totaldata = $this->mspr->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {

            $encyrpt = $row->id_menu."split".$row->compid;

            $idx1 = $this->qsecure->encrypt($row->id_menu);
            $id = $this->qsecure->encrypt($encyrpt);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/settingpresensi/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/settingpresensi/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['comp_name'] = $row->comp_name;
            $obj['remark'] = $row->remark;
            $obj['start_date'] = $row->start_date;
            $obj['end_date'] = $row->end_date;
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
            $str = explode("split",$id);
            $id =  $str[0];
            $compid_ = $str[1];
            $this->data['titlehead'] = "Edit Periode Tanggal Presensi";
        } else {
            $this->data['titlehead'] = "Input Periode Tanggal Presensi";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->id_menu = null;
        $stdClass->comp_code = null;
        $stdClass->compid = null;
        $stdClass->remark = null;
        $stdClass->start_date = null;
        $stdClass->end_date = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mspr->get($id, null, null , null, null, $compid_);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('end_date', 'Tanggal AKhir', 'required');
            $this->form_validation->set_rules('compid', 'Company', 'required');

            // POSTING VARIABLE
            $stdClass->compid = $this->input->post('compid');
            $stdClass->id_menu = $this->input->post('id_menu');
            $stdClass->remark = $this->input->post('remark');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();

                $stdClassComp = $this->mcompany->get_data($stdClass->compid);
                $dataIn["id_menu"] = $stdClass->id_menu;
                $dataIn["compid"] = $stdClass->compid;
                $dataIn["comp_code"] = $stdClassComp->COMP_CODE;
                $dataIn["remark"] = $stdClass->remark;
                $dataIn["start_date"] = date("Y-m-d H:i:s", strtotime($stdClass->start_date));
                $dataIn["end_date"] = date("Y-m-d H:i:s", strtotime($stdClass->end_date));
               //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mspr->update_presensi($id, $compid_, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Tanggal Presensi Diperbaharui");
                    }
                } else { // insert
                    if ($this->mspr->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->compid;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Tanggal Presensi Baru");
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
                    redirect("reference/settingpresensi", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/settingpresensi_form.js',
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

        $list_menu[null] = "Pilih Menu";
        $list_menu[1] = "Absensi";
        $list_menu[2] = "Izin";
        $list_menu[3] = "Cuti";
        $list_menu[4] = "Pengobatan";
        $list_menu[5] = "Penggantian Biaya";
        $list_menu[6] = "Dinas";
        $list_menu[7] = "Pelatihan";
        $list_menu[8] = "Daftar Pengajuan";
        $list_menu[9] = "Riwayat Pengajuan";
        $list_menu[10] = "Notifikasi";


        $this->data['id_menu'] = array(
            'name' => 'id_menu',
            'id' => 'id_menu',
            'options' => $list_menu,
            'value' => $this->form_validation->set_value('id_menu', $stdClass->id_menu),
            'class' => 'form-control'
        );


        $this->data['remark'] = array(
            'name' => 'remark',
            'id' => 'remark',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('remark', $stdClass->remark)
        );
        
        $this->data['start_date'] = array(
            'name' => 'start_date',
            'id' => 'start_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('start_date', $stdClass->start_date)
        );

        $this->data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('end_date', $stdClass->end_date)
        );

        $this->data['csrf'] = $this->_get_sess_csrf();
        return $this->_render_page('reference/vsettingpresensi_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mspr->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Absen Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/settingpresensi", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mspr->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Absen Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/settingpresensi", 'refresh');
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
