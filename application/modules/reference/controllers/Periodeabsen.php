<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Mperiodeabsen $mpab
 */
class Periodeabsen extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_PERIODEABSEN";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Mperiodeabsen", "mpab");
    }

    public function index()
    {
        $this->data['titlehead'] = "Setting Periode Absen";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/periodeabsen.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vperiodeabsen_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mpab->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mpab->get_cnt($filters);
        $totaldata = $this->mpab->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->compid);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/periodeabsen/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/periodeabsen/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['comp_name'] = $row->comp_name;
            $obj['tgl_awal'] = $row->tgl_awal;
            $obj['tgl_akhir'] = $row->tgl_akhir;
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
            $this->data['titlehead'] = "Edit Periode Absen";
        } else {
            $this->data['titlehead'] = "Input Periode Absen";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->nik = null;
        $stdClass->compid = null;
        $stdClass->tgl_awal = null;
        $stdClass->tgl_akhir = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mpab->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('tgl_awal', 'Jumlah cuti tahunan', 'required');
            $this->form_validation->set_rules('compid', 'Company', 'required');

            // POSTING VARIABLE
            $stdClass->compid = $this->input->post('compid');
            $stdClass->tgl_awal = $this->input->post('tgl_awal');
            $stdClass->tgl_akhir = $this->input->post('tgl_akhir');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();

                $stdClassComp = $this->mcompany->get_data($stdClass->compid);
                $dataIn["compid"] = $stdClass->compid;
                $dataIn["comp_code"] = $stdClassComp->COMP_CODE;
                $dataIn["tgl_awal"] = $stdClass->tgl_awal;
                $dataIn["tgl_akhir"] = $stdClass->tgl_akhir;
               //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mpab->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Absen Diperbaharui");
                    }
                } else { // insert
                    if ($this->mpab->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->compid;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Absen Baru");
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
                    redirect("reference/periodeabsen", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/periodeabsen_form.js',
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
        
        $this->data['tgl_awal'] = array(
            'name' => 'tgl_awal',
            'id' => 'tgl_awal',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('tgl_awal', $stdClass->tgl_awal)
        );

        $this->data['tgl_akhir'] = array(
            'name' => 'tgl_akhir',
            'id' => 'tgl_akhir',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('tgl_akhir', $stdClass->tgl_akhir)
        );

        $this->data['csrf'] = $this->_get_sess_csrf();
        return $this->_render_page('reference/vperiodeabsen_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mpab->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Absen Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/periodeabsen", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mpab->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Absen Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/periodeabsen", 'refresh');
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
