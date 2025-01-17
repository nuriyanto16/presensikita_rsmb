<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Mkantor $mktr
 */
class Kantor extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_KANTOR";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Mkantor", "mktr");
    }

    public function index()
    {
        $this->data['titlehead'] = "Kantor";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/kantor.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vkantor_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mktr->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mktr->get_cnt($filters);
        $totaldata = $this->mktr->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->kantor_id);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/kantor/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/kantor/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['aksi'] = $btnAction;
            $obj['comp_name'] = $row->comp_name;
            $obj['nama_kantor'] = $row->nama_kantor;
            $obj['alamat'] = $row->alamat;
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
            $this->data['titlehead'] = "Edit Kantor";
        } else {
            $this->data['titlehead'] = "Input Kantor";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->nik = null;
        $stdClass->compid = null;
        $stdClass->nama_kantor = null;
        $stdClass->alamat = null;
        $stdClass->long = null;
        $stdClass->lat = null;
        $stdClass->batas = 0;
        
        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mktr->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('nama_kantor', 'Nama Kantor', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat Kantor', 'required');
            $this->form_validation->set_rules('compid', 'Company', 'required');

            // POSTING VARIABLE
            $stdClass->compid = $this->input->post('compid');
            $stdClass->nama_kantor = $this->input->post('nama_kantor');
            $stdClass->alamat = $this->input->post('alamat');
            $stdClass->long = $this->input->post('long');
            $stdClass->lat = $this->input->post('lat');
            $stdClass->batas = $this->input->post('batas');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();

                $stdClassComp = $this->mcompany->get_data($stdClass->compid);
                $dataIn["compid"] = $stdClass->compid;
                $dataIn["nama_kantor"] = $stdClass->nama_kantor;
                $dataIn["alamat"] = $stdClass->alamat;
                $dataIn["long"] = $stdClass->long;
                $dataIn["lat"] = $stdClass->lat;
                $dataIn["batas"] = $stdClass->batas;
               //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mktr->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Hari Libur Diperbaharui");
                    }
                } else { // insert
                    if ($this->mktr->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->compid;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Hari Libur Baru");
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
                    redirect("reference/kantor", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/kantor_form.js',
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

        $this->data['nama_kantor'] = array(
            'name' => 'nama_kantor',
            'id' => 'nama_kantor',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('nama_kantor', $stdClass->nama_kantor)
        );
        
        $this->data['alamat'] = array(
            'name' => 'alamat',
            'id' => 'alamat',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('alamat', $stdClass->alamat)
        );

        $this->data['long'] = array(
            'name' => 'long',
            'id' => 'long',
            'type' => 'text',
            'class' => 'allownumericwithdecimal form-control',
            'value' => $this->form_validation->set_value('long', $stdClass->long)
        );

        $this->data['lat'] = array(
            'name' => 'lat',
            'id' => 'lat',
            'type' => 'text',
            'class' => 'allownumericwithdecimal form-control',
            'value' => $this->form_validation->set_value('lat', $stdClass->lat)
        );

        $this->data['batas'] = array(
            'name' => 'batas',
            'id' => 'batas',
            'type' => 'text',
            'class' => 'allownumericwithdecimal form-control',
            'value' => $this->form_validation->set_value('batas', $stdClass->batas)
        );

        $this->data['csrf'] = $this->_get_sess_csrf();
        return $this->_render_page('reference/vkantor_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mktr->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cuti Tahunan Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/kantor", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mktr->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cuti Tahunan Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/kantor", 'refresh');
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
