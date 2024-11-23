<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Jenis_risiko
 * @property Mjenis_risiko $mjenis_risiko
 */
class Jenis_risiko extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_JENIS_RISIKO";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mjenis_risiko", "mjenis_risiko");
    }

    public function index()
    {
        $this->data['titlehead'] = "Jenis Risiko";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/jenis_risiko.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $this->_render_page('vjenis_risiko_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mjenis_risiko->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mjenis_risiko->get_cnt($filters);
        $totaldata = $this->mjenis_risiko->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->jenis_risiko_id);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/jenis_risiko/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/jenis_risiko/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/jenis_risiko/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/jenis_risiko/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['parent_id'] = $row->parent_id;
            $obj['id'] = $row->jenis_risiko_id;
            $obj['jenis_risiko_no'] = $row->jenis_risiko_no;
            $obj['jenis_risiko_nama'] = $row->jenis_risiko_nama;
            $obj['start_date'] = fdate_eng_to_ind($row->start_date);
            $obj['end_date'] = fdate_eng_to_ind($row->end_date);
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }

        if ($totalfiltered <> $totaldata) {
            $build_array["data"] = $output;
        } else {
            $build_array["data"] = build_tree($output, "parent_id", "id", null);
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
            $this->data['titlehead'] = "Edit Jenis Risiko";
        } else {
            $this->data['titlehead'] = "Input Jenis Risiko";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->jenis_risiko_id = null;
        $stdClass->parent_id = null;
        $stdClass->jenis_risiko_no = '';
        $stdClass->jenis_risiko_nama = '';
        $stdClass->start_date = null;
        $stdClass->end_date = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mjenis_risiko->get($id);
            $stdClass->start_date = fdate_eng_to_ind($stdClass->start_date);
            $stdClass->end_date = fdate_eng_to_ind($stdClass->end_date);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('jenis_risiko_no', 'Nomor', 'required');
            $this->form_validation->set_rules('jenis_risiko_nama', 'Nama', 'required');

            // POSTING VARIABLE
            $stdClass->jenis_risiko_no = $this->input->post('jenis_risiko_no');
            $stdClass->parent_id = $this->input->post('parent_id');
            $stdClass->jenis_risiko_nama = $this->input->post('jenis_risiko_nama');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["jenis_risiko_no"] = $stdClass->jenis_risiko_no;
                $dataIn["parent_id"] = cempty_to_null($stdClass->parent_id);
                $dataIn["jenis_risiko_nama"] = $stdClass->jenis_risiko_nama;
                $dataIn["start_date"] = cempty_to_null(fdate_ind_to_eng($stdClass->start_date));
                $dataIn["end_date"] = cempty_to_null(fdate_ind_to_eng($stdClass->end_date));

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    $dataIn["updated_by"] = $this->get_userid();
                    $dataIn["updated_date"] = date("Y-m-d H:i:s");
                    if ($this->mjenis_risiko->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jenis Risiko Diupdate");
                    }
                } else { // insert
                    $dataIn["created_by"] = $this->get_userid();
                    $dataIn["created_date"] = date("Y-m-d H:i:s");
                    if ($this->mjenis_risiko->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->jenis_risiko_id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jenis Risiko Baru");
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
                    redirect("reference/jenis_risiko", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/jenis_risiko_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['jenis_risiko_no'] = array(
            'name' => 'jenis_risiko_no',
            'id' => 'jenis_risiko_no',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('jenis_risiko_no', $stdClass->jenis_risiko_no)
        );
        $this->data['jenis_risiko_nama'] = array(
            'name' => 'jenis_risiko_nama',
            'id' => 'jenis_risiko_nama',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'value' => $this->form_validation->set_value('jenis_risiko_nama', $stdClass->jenis_risiko_nama)
        );

        // select option parent
        $this->data['parent_id'] = array(
            'name' => 'parent_id',
            'id' => 'parent_id',
            'value' => $this->form_validation->set_value('parent_id', $stdClass->parent_id),
            'class' => 'form-control col-md-12'
        );

        $this->data['start_date'] = array(
            'name' => 'start_date',
            'id' => 'start_date',
            'type' => 'text',
            'value' => $this->form_validation->set_value('start_date', $stdClass->start_date),
            'class' => 'form-control',
            'placeholder' => 'dd-mm-yyyy'
        );
        $this->data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'type' => 'text',
            'value' => $this->form_validation->set_value('end_date', $stdClass->end_date),
            'class' => 'form-control',
            'placeholder' => 'dd-mm-yyyy'
        );

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('reference/vjenis_risiko_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mjenis_risiko->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jenis Risiko Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/jenis_risiko", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mjenis_risiko->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Jenis Risiko Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/jenis_risiko", 'refresh');
    }

    public function get_node()
    {
        $out = [];
        $results = $this->mjenis_risiko->get(null, 0, 999999);
        if ($results != null) {
            // build tree
            $output = [];
            foreach ($results as $row) {
                $arr = [];
                $arr['id'] = $row->jenis_risiko_id;
                $arr['parent_id'] = $row->parent_id;
                $arr['jenis_risiko_nama'] = "{$row->jenis_risiko_no} - {$row->jenis_risiko_nama}";
                $output[] = $arr;
            }
            $out = build_tree($output, 'parent_id', 'id', null);
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
