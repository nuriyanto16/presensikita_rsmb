<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Company
 * @property Mcompany $mcompany
 */
class Periode extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_PERIODE";
        $this->_checkAuthorization($this->MOD_ALIAS);
       
        $this->load->model("MInputPeriode", "mper");
        $this->load->model("Mcompany", "mcompany");
    }

    public function index()
    {   
        $this->data['titlehead'] = "Input Periode";
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/periode.js'
        );
        $this->data['loadfoot'] = $loadfoot;
        $this->_render_page('vinput_periode_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

   
    public function lists()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mper->get_data(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mper->get_data_cnt($filters);
        $totaldata = $this->mper->get_data_cnt();
        $maxpage = ceil($totalfiltered / $limit);

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );


        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->periode_id);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/periode/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/periode/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $this->qsecure->encrypt($row->periode_id),
                    "aksi" => $btnAction,
                    // "COMP_CODE" => $row->COMP_CODE,
                    "periode_nama" => $row->periode_nama,
                    "start_date" => $row->start_date,
                    "end_date" => $row->end_date,
                    "active" => $row->active,
                    "created_date" => $row->created_date,
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
            $this->data['titlehead'] = "Edit Karyawan";
        } else {
            $this->data['titlehead'] = "Input Karyawan";
        }
        $stdClass = new stdClass();
        $stdClass->periode_nama = null;
        $stdClass->start_date = null;
        $stdClass->end_date = null;

        

        if ($id !== 0 AND !$this->input->post('id')) {
            $stdClass = $this->mper->getKonfigurasi($id);

            $stdClass->start_date = fdate_eng_to_ind($stdClass->start_date);
            $stdClass->end_date = fdate_eng_to_ind($stdClass->end_date);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }
            $this->form_validation->set_rules('periode_nama', 'Periode Nama', 'required');

            // POSTING VARIABLE
            $stdClass->periode_nama = $this->input->post('periode_nama');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["periode_nama"] = $stdClass->periode_nama;
                $dataIn["start_date"] = cempty_to_null(fdate_ind_to_eng($stdClass->start_date));
                $dataIn["end_date"] = cempty_to_null(fdate_ind_to_eng($stdClass->end_date));

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mper->update($id, $dataIn)) {

                        $stat_upd_konf = $this->mper->updatePeriode($id, $dataIn);

                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Diupdate");
                    }
                } else { // insert

                    if (!empty($dataIn)) {
                        $this->mper->insertPeriode($dataIn);
                        $insertedCount = count($dataIn);
                        $response = ['success' => true, 'insertedCount' => $insertedCount];
                    } else {
                        $response = ['success' => false, 'errorInfo' => 'Tidak ada data yang dimasukkan'];
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
                    redirect("reference/periode", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/input_periode_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['periode_nama'] = array(
            'name' => 'periode_nama',
            'id' => 'periode_nama',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('periode_nama', $stdClass->periode_nama)
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

        return $this->_render_page('reference/vinput_periode_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function delete($id = NULL)
    {
        $this->deactivate($id);
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mper->deletePeriod($id);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Cuti Tahunan Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/periode", 'refresh');
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
