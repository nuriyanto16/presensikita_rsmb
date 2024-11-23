<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Periode_risiko
 * @property Mperiode_risiko $mperiode_risiko
 */
class Periode_risiko extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_PERIODE_RISIKO";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mperiode_risiko", "mperiode");
    }

    public function index()
    {
        $this->data['titlehead'] = "Periode Risiko";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/periode_risiko.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $this->_render_page('vperiode_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mperiode->get_data(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mperiode->get_data_cnt($filters);
        $totaldata = $this->mperiode->get_data_cnt();
        $maxpage = ceil($totalfiltered / $limit);
        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->periode_risiko_id);

            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/periode_risiko/edit_form/';
                $atr_edit['class'] = '';
            } else {
                $atr_edit['title'] = 'Edit (No Access)';
                $atr_edit['url'] = '#';
                $atr_edit['class'] = '';
            }

            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/periode_risiko/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            } else {
                $atr_del['title'] = 'Hapus (No Access)';
                $atr_del['url'] = '#';
                $atr_del['class'] = '';
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

            //            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
            //                anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $this->qsecure->encrypt($row->periode_risiko_id),
                    "aksi" => $btnAction,
                    "periode_nama" => $row->periode_risiko_nama,
                    "start_date" => fdate_eng_to_ind($row->start_date),
                    "end_date" => fdate_eng_to_ind($row->end_date),
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
            $this->data['titlehead'] = "Edit Periode Risiko";
        } else {
            $this->data['titlehead'] = "Input Periode Risiko";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->periode_risiko_nama = '';
        $stdClass->start_date = '';
        $stdClass->end_date = '';

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mperiode->get_data($id);
            $stdClass->start_date = fdate_eng_to_ind($stdClass->start_date);
            $stdClass->end_date = fdate_eng_to_ind($stdClass->end_date);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('periode_risiko_nama', 'Periode Risiko Nama', 'required');
            $this->form_validation->set_rules('start_date', 'Periode Risiko Name', 'required');
            $this->form_validation->set_rules('end_date', 'Periode Risiko Code SAP', 'required');

            // POSTING VARIABLE
            $stdClass->periode_risiko_nama = $this->input->post('periode_risiko_nama');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["periode_risiko_nama"] = $stdClass->periode_risiko_nama;
                $tglAwal = date('Y-m-d', strtotime($stdClass->start_date));
                $tglAkhir = date('Y-m-d', strtotime($stdClass->end_date));
                $dataIn["start_date"] = $tglAwal;
                $dataIn["end_date"] = $tglAkhir;

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    $dataIn['updated_by'] = $this->session->userdata($this->config->item('sess_prefix', 'ion_auth') . 'userid');
                    $dataIn['updated_date'] = date('Y-m-d H:i:s');
                    if ($this->mperiode->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Diupdate");
                    }
                } else { // insert
                  $dataIn['created_by'] = $this->session->userdata($this->config->item('sess_prefix', 'ion_auth') . 'userid');
                  $dataIn['created_date'] = date('Y-m-d H:i:s');
                    if ($this->mperiode->insert($dataIn)) {
                        $isError = false;
                        $id = $this->mperiode->id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Baru");
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
                    redirect("reference/periode_risiko", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/periode_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['periode_risiko_nama'] = array(
            'name' => 'periode_risiko_nama',
            'id' => 'periode_risiko_nama',
            'type' => 'text',
            'class' => 'form-control',
            // 'maxLength' => '10',
            'value' => $this->form_validation->set_value('periode_risiko_nama', $stdClass->periode_risiko_nama)
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

        return $this->_render_page('reference/vperiode_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    // delete data
    // jadi nonaktifkan data
    public function delete($id = NULL)
    {
//        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
//        $id = intval($id);
//        $res = $this->mperiode->delete($id);
//        if ($res) {
//            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Company Dihapus");
//            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
//        } else {
//            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
//        }
//        redirect('reference/company', 'refresh');

        $this->deactivate($id);
    }

    //activate
    public function activate($id)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 1;
        $activation = $this->mperiode->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/periode_risiko", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 0;
        $deactivate = $this->mperiode->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
        }
        redirect("reference/periode_risiko", 'refresh');
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
