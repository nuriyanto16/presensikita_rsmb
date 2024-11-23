<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Conf_approval
 * @property Mconf_approval $mconf
 */
class Conf_approval extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_CONF_APPROVAL";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("reference/Mkatdok", "mkatdok");
        $this->load->model("Mconf_approval", "mconf");
    }

    public function index()
    {
        $this->data['titlehead'] = "Konfigurasi Approval";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/utility/conf_approval.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option comp code
        $comps = $this->mconf->get_company();
        $list_comp = [];
        foreach ($comps as $row) {
            $list_comp[$row->compCode] = $row->compName;
        }

        $this->data['katdok_id'] = $this->form_validation->set_value('katdok_id', $conf->katdok_id);
        $mkatdoks = $this->mkatdok->get_data(null, true);
        $list_katdok[''] = '- Pilih Kategori Dokumen -';
        foreach ($mkatdoks as $row) {
                $list_katdok[$row->katdok_id] = $row->katdok_nama;
        }

        $this->data['list_comp'] = $list_comp;
        $this->data['list_katdok'] = $list_katdok;

        $this->_render_page('vconf_approval_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $draw = intval($this->input->post('draw'));
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $filter_comp = $this->input->post('filter_comp');
        $filter_dok = $this->input->post('filter_dok');

        $search_string = null;
        if (!empty($search['value'])) {
            $search_string = trim($search['value']);
        }

        $results = $this->mconf->get_data(null, $start, $limit, $filter_comp, $search_string, $order, $filter_dok);
        $totalfiltered = $this->mconf->get_data_cnt($filter_comp, $search_string, $filter_dok);
        $totaldata = $this->mconf->get_data_cnt($filter_comp, null, $filter_dok);

        $build_array = array(
            "draw" => $draw,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->conf_approval_id);

            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'utility/conf_approval/edit_form/';
                $atr_edit['class'] = '';
            } else {
                $atr_edit['title'] = 'Edit (No Access)';
                $atr_edit['url'] = '#';
                $atr_edit['class'] = '';
            }

            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'utility/conf_approval/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            } else {
                $atr_del['title'] = 'Hapus (No Access)';
                $atr_del['url'] = '#';
                $atr_del['class'] = '';
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $this->qsecure->encrypt($row->conf_approval_id),
                    "aksi" => $btnAction,
                    "urutan" => $row->urutan,
                    "position_desc" => $row->position_desc,
                    "unit_name" => $row->unit_name,
                    "group_app" => $row->group_app
                )
            );
        }

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    public function position_unit_lists()
    {
        $draw = intval($this->input->post('draw'));
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $filter_comp = $this->input->post('filter_comp');

        $search_string = null;
        if (!empty($search['value'])) {
            $search_string = trim($search['value']);
        }

        $results = $this->mconf->get_position_unit($start, $limit, $filter_comp, $search_string, $order);
        $totalfiltered = $this->mconf->get_position_unit_cnt($filter_comp, $search_string);
        $totaldata = $this->mconf->get_position_unit_cnt($filter_comp);

        $build_array = array(
            "draw" => $draw,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            array_push($build_array["data"],
                array(
                    "DT_RowId" => $row->position_code,
                    "position_code" => $row->position_code,
                    "position_desc" => $row->position_desc,
                    "unit_code" => $row->org_code,
                    "unit_name" => $row->unit_name
                )
            );
        }

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
            $this->data['titlehead'] = "Edit Konfigurasi Approval";
        } else {
            $this->data['titlehead'] = "Input Konfigurasi Approval";
        }

        // default value
        $conf = new stdClass();
        $conf->position_code = null;
        $conf->position_desc = '';
        $conf->unit_id = null;
        $conf->unit_name = '';

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $conf = $this->mconf->get_data($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('comp_code', 'Perusahaan', 'required');
            $this->form_validation->set_rules('position_code', 'Posisi', 'required');
            $this->form_validation->set_rules('unit_id', 'Unit', 'required');
            $this->form_validation->set_rules('urutan', 'Urutan', 'required');
            $this->form_validation->set_rules('katdok_id', 'kategori Dokumen', 'required');

            // POSTING VARIABLE
            $conf->comp_code = $this->input->post('comp_code');
            $conf->position_code = $this->input->post('position_code');
            $conf->position_desc = $this->input->post('position_desc');
            $conf->unit_id = $this->input->post('unit_id');
            $conf->unit_name = $this->input->post('unit_name');
            $conf->urutan = $this->input->post('urutan');
            $conf->group_app = $this->input->post('group_app');
            $conf->katdok_id = $this->input->post('katdok_id');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["comp_code"] = $conf->comp_code;
                $dataIn["position_code"] = $conf->position_code;
                $dataIn["unit_id"] = $conf->unit_id;
                $dataIn["urutan"] = $conf->urutan;
                $dataIn["group_app"] = cempty_to_null($conf->group_app);
                $dataIn["katdok_id"] = $conf->katdok_id;

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    $dataIn["updated_by"] = $this->_userid;
                    $dataIn["updated_date"] = date("Y-m-d H:i:s");

                    if ($this->mconf->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Konfigurasi Approval Diupdate");
                    }
                } else { // insert
                    $dataIn["created_by"] = $this->_userid;
                    $dataIn["created_date"] = date("Y-m-d H:i:s");

                    if ($this->mconf->insert($dataIn)) {
                        $isError = false;
                        $id = $this->mconf->id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Konfigurasi Approval Baru");
                    }
                }//endif insert or update

                if ($isError) {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = $this->_get_message(($isUpdate) ? "FAILED_UPDATED" : "FAILED_INSERTED");
                    $this->session->set_flashdata('err', $this->data['errmsg']);
                } else {
                    $success_msg = ($isUpdate) ? "SUCCESS_UPDATED" : "SUCCESS_INSERTED";
                    $success_msg = $this->_get_message($success_msg);
                    $this->session->set_flashdata('message', $success_msg);
                    redirect("utility/conf_approval", 'refresh');
                }
            } else {
                //set the flash data error message if there is one
                $this->data['errmsg'] = validation_errors();
                $this->session->set_flashdata('err', $this->data['errmsg']);
            }
        }//endif POST

        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array();
        $this->data['loadhead'] = $loadhead;

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/utility/conf_approval_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['comp_code'] = $this->form_validation->set_value('comp_code', $conf->comp_code);
        $comps = $this->mconf->get_company();
        $list_comp = [];
        foreach ($comps as $row) {
            $list_comp[$row->compCode] = $row->compName;
        }
        $this->data['list_comp'] = $list_comp;

        $this->data['urutan'] = array(
            'name' => 'urutan',
            'id' => 'urutan',
            'type' => 'number',
            'value' => $this->form_validation->set_value('urutan', $conf->urutan),
            'class' => 'form-control'
        );

        $this->data['position_code'] = array(
            'name' => 'position_code',
            'id' => 'position_code',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('position_code', $conf->position_code)
        );

        $this->data['position_desc'] = array(
            'name' => 'position_desc',
            'id' => 'position_desc',
            'type' => 'text',
            'value' => $this->form_validation->set_value('position_desc', $conf->position_desc),
            'class' => 'form-control',
            'readonly' => null
        );

        $this->data['unit_id'] = array(
            'name' => 'unit_id',
            'id' => 'unit_id',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('unit_id', $conf->unit_id)
        );
        $this->data['unit_name'] = array(
            'name' => 'unit_name',
            'id' => 'unit_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('unit_name', $conf->unit_name),
            'class' => 'form-control',
            'readonly' => null
        );

        $this->data['group_app'] = array(
            'name' => 'group_app',
            'id' => 'group_app',
            'type' => 'number',
            'value' => $this->form_validation->set_value('group_app', $conf->group_app),
            'class' => 'form-control'
        );
        
        $this->data['katdok_id'] = $this->form_validation->set_value('katdok_id', $conf->katdok_id);
        $mkatdoks = $this->mkatdok->get_data(null, true);
        $list_katdok[''] = '- Pilih Kategori Dokumen -';
        foreach ($mkatdoks as $row) {
                $list_katdok[$row->katdok_id] = $row->katdok_nama;
        }

        $this->data['list_katdok'] = $list_katdok;
        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('utility/vconf_approval_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    //delete data
    public function delete($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $res = $this->mconf->delete($id);
        if ($res) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Konfigurasi Approval Dihapus");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
        }
        redirect('utility/conf_approval', 'refresh');
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
