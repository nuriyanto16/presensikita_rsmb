<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Costcenter
 * @property Mcostcenter $mcostcenter
 */
class Costcenter extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_COSTCENTER";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mcostcenter", "mcostcenter");
    }

    public function index()
    {
        $this->data['titlehead'] = "Cost Center";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/costcenter.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $this->_render_page('vcostcenter_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mcostcenter->get_data(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mcostcenter->get_data_cnt($filters);
        $totaldata = $this->mcostcenter->get_data_cnt();
        $maxpage = ceil($totalfiltered / $limit);

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->costcenter_code);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/costcenter/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/costcenter/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "aksi" => $btnAction,
                    "costcenter_code" => $row->costcenter_code,
                    "costcenter_desc" => $row->costcenter_desc,
                    "valid_from" => fdate_eng_to_ind($row->valid_from),
                    "valid_to" => fdate_eng_to_ind($row->valid_to)
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
            $this->data['titlehead'] = "Edit Cost Center";
        } else {
            $this->data['titlehead'] = "Input Cost Center";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->costcenter_code = null;
        $stdClass->costcenter_desc = '';
        $stdClass->valid_from = null;
        $stdClass->valid_to = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mcostcenter->get_data($id);
            $stdClass->valid_from = fdate_eng_to_ind($stdClass->valid_from);
            $stdClass->valid_to = fdate_eng_to_ind($stdClass->valid_to);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('costcenter_code', 'Cost Center', 'required');

            // POSTING VARIABLE
            $stdClass->costcenter_code = $this->input->post('costcenter_code');
            $stdClass->costcenter_desc = $this->input->post('costcenter_desc');
            $stdClass->valid_from = $this->input->post('valid_from');
            $stdClass->valid_to = $this->input->post('valid_to');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["costcenter_code"] = $stdClass->costcenter_code;
                $dataIn["costcenter_desc"] = $stdClass->costcenter_desc;
                $dataIn["valid_from"] = cempty_to_null(fdate_ind_to_eng($stdClass->valid_from));
                $dataIn["valid_to"] = cempty_to_null(fdate_ind_to_eng($stdClass->valid_to));

                //check to see if we are updating data
                if ($id !== 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mcostcenter->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cost Center Diupdate");
                    }
                } else { // insert
                    if ($this->mcostcenter->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->costcenter_code;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cost Center Baru");
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
                    redirect("reference/costcenter", 'refresh');
                }
            } else {
                //set the flash data error message if there is one
                $this->data['errmsg'] = validation_errors();
            }
        }//endif POST

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/costcenter_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['costcenter_code'] = array(
            'name' => 'costcenter_code',
            'id' => 'costcenter_code',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '20',
            'value' => $this->form_validation->set_value('costcenter_code', $stdClass->costcenter_code)
        );
        $this->data['costcenter_desc'] = array(
            'name' => 'costcenter_desc',
            'id' => 'costcenter_desc',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'value' => $this->form_validation->set_value('costcenter_desc', $stdClass->costcenter_desc)
        );
        $this->data['valid_from'] = array(
            'name' => 'valid_from',
            'id' => 'valid_from',
            'type' => 'text',
            'value' => $this->form_validation->set_value('valid_from', $stdClass->valid_from),
            'class' => 'form-control',
            'placeholder' => 'dd-mm-yyyy'
        );
        $this->data['valid_to'] = array(
            'name' => 'valid_to',
            'id' => 'valid_to',
            'type' => 'text',
            'value' => $this->form_validation->set_value('valid_to', $stdClass->valid_to),
            'class' => 'form-control',
            'placeholder' => 'dd-mm-yyyy'
        );

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('reference/vcostcenter_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    // delete data
    // jadi nonaktifkan data
    public function delete($id = NULL)
    {
        $this->deactivate($id);
    }

    //activate
    public function activate($id)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 1;
        $activation = $this->mcostcenter->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cost Center Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/costcenter", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 0;
        $deactivate = $this->mcostcenter->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cost Center Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/costcenter", 'refresh');
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
