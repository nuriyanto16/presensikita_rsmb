<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Position
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 */
class Position extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_ORGANISASI";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Munit", "munit");
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Mposition_emp", "mposemp");
    }

    public function index()
    {
        $this->data['titlehead'] = "Posisi / Jabatan";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/position.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMP_CODE] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vposition_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mposemp->get(null, $start, $limit, $order, $filters);
       
        $totalfiltered = $this->mposemp->get_cnt($filters);
        $totaldata = $this->mposemp->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->position_code);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/position/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/position/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['parent_position_code'] = $row->parent_position_code;
            $obj['position_code'] = $row->position_code;
            $obj['position_desc'] = $row->position_desc;
            // $obj['unitName'] = $row->unitName;
            // $obj['valid_from'] = fdate_eng_to_ind($row->valid_from);
            // $obj['valid_to'] = fdate_eng_to_ind($row->valid_to);
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }

        // if ($totalfiltered <> $totaldata) {
            $build_array["data"] = $output;
        // }
        //  else {
        //     $build_array["data"] = build_tree($output, "parent_position_code", "position_code", NULL);
        // }

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
            $this->data['titlehead'] = "Edit Posisi / Jabatan";
        } else {
            $this->data['titlehead'] = "Input Posisi / Jabatan";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->position_code = null;
        $stdClass->parent_position_code = null;
        $stdClass->position_desc = '';
        $stdClass->company_code = null;
        $stdClass->org_code = null;
        $stdClass->is_structural = 0;
        $stdClass->valid_from = null;
        $stdClass->valid_to = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mposemp->get($id);
            $stdClass->valid_from = fdate_eng_to_ind($stdClass->valid_from);
            $stdClass->valid_to = fdate_eng_to_ind($stdClass->valid_to);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('position_code', 'Kode', 'required');
            $this->form_validation->set_rules('position_desc', 'Nama', 'required');
            $this->form_validation->set_rules('company_code', 'Company', 'required');
            $this->form_validation->set_rules('org_code', 'Organisasi', 'required');

            // POSTING VARIABLE
            $stdClass->position_code = $this->input->post('position_code');
            $stdClass->parent_position_code = $this->input->post('parent_position_code');
            $stdClass->position_desc = $this->input->post('position_desc');
            $stdClass->company_code = $this->input->post('company_code');
            $stdClass->org_code = $this->input->post('org_code');
            $stdClass->is_structural = $this->input->post('is_structural');
            $stdClass->valid_from = $this->input->post('valid_from');
            $stdClass->valid_to = $this->input->post('valid_to');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["position_code"] = $stdClass->position_code;
                $dataIn["parent_position_code"] = empty($stdClass->parent_position_code) ? null : $stdClass->parent_position_code;
                $dataIn["position_desc"] = $stdClass->position_desc;
                $dataIn["company_code"] = $stdClass->company_code;
                $dataIn["org_code"] = $stdClass->org_code;
                $dataIn["is_structural"] = $stdClass->is_structural;
                $dataIn["valid_from"] = cempty_to_null(fdate_ind_to_eng($stdClass->valid_from));
                $dataIn["valid_to"] = cempty_to_null(fdate_ind_to_eng($stdClass->valid_to));

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mposemp->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Posisi / Jabatan Diupdate");
                    }
                } else { // insert
                    if ($this->mposemp->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->position_code;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Posisi / Jabatan Baru");
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
                    redirect("reference/position", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/position_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['position_code'] = array(
            'name' => 'position_code',
            'id' => 'position_code',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('position_code', $stdClass->position_code)
        );
        $this->data['position_desc'] = array(
            'name' => 'position_desc',
            'id' => 'position_desc',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '250',
            'value' => $this->form_validation->set_value('position_desc', $stdClass->position_desc)
        );

        // select option company
        $companies = $this->mcompany->get_data(null, null, 999999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMP_CODE] = $row->COMP_NAME;
        }
        $this->data['company_code'] = array(
            'name' => 'company_code',
            'id' => 'company_code',
            'value' => $this->form_validation->set_value('company_code', $stdClass->company_code),
            'options' => $list_company,
            'class' => 'form-control'
        );

        // select option parent
        $this->data['parent_position_code'] = array(
            'name' => 'parent_position_code',
            'id' => 'parent_position_code',
            'value' => $this->form_validation->set_value('parent_position_code', $stdClass->parent_position_code),
            'class' => 'form-control col-md-12'
        );

        // select option unit
        $this->data['org_code'] = array(
            'name' => 'org_code',
            'id' => 'org_code',
            'value' => $this->form_validation->set_value('org_code', $stdClass->org_code),
            'class' => 'form-control col-md-12'
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

        return $this->_render_page('reference/vposition_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mposemp->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Posisi / Jabatan Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/position", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mposemp->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Posisi / Jabatan Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/position", 'refresh');
    }

    public function get_node()
    {
        $out = [];
        $company_code = strval($this->input->post('COMP_CODE'));
        if (!empty($company_code)) {
            $filters = [
                ['field' => 'company_code', 'value' => $company_code]
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

        $company_code = strval($this->input->post('COMP_CODE'));
        if (!empty($company_code)) {
            $filters = [
                ['field' => 'COMP_CODE', 'value' => $company_code]
            ];

            $COMP_CODE_SAP = null;
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
                $out = build_tree($output, 'parentId', 'id', null);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function sinkronJabatan(){
         
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://api.rsmb.co.id:4848/app/sdi/get_jabatan',
            // CURLOPT_URL =>  'http://localhost/rsmb/api/public/app/sdi/get_jabatan',
            CURLOPT_URL => API_SIMRS.'app/sdi/get_jabatan',

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-username: r5mb53!',
                'x-password: p4r1purn4'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);


        $this->mposemp->deleteAllJabatan();

        $arrData = json_decode($response, true);
        $resData = ($arrData['response']['data']);

        foreach ($resData as $rowPeg) {
            // Initialize default values if certain keys are missing
            $rowPeg['is_deleted'] = $rowPeg['is_deleted'] ?? 0;
    
            // Insert modified data into the database
            $insertData = array(
                'position_code' => $rowPeg['id'],
                'position_desc' => $rowPeg['nama'],
                'parent_position_code' => $rowPeg['nama'] === "Direktur" ? null : '01',
                'company_code' => 'ABCDE1',
                'org_code' => null, //sementara nul karena ini berhubungan dengan modul organisasi dan dari sim rs belum ada kolom ini di organisasi
                'is_structural' => '0',
                'grade' => null,
                'grade_desc' => null,
                'valid_from' => null,
                'valid_to' => null,
                'active' => 1
            );

           

            if (!$this->mposemp->insertJabatan($insertData)) {
                $success = false; 
            }
        }
    
        if($success){
            $success_msg = "SUCCESS_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("reference/position", 'refresh');
        }else{
            $success_msg = "FAILED_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("reference/position", 'refresh');
        }

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
