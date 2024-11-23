<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Organisasi
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mcostcenter $mcostcenter
 */
class Importjdwl extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRESENSI_IMPORTJDWL";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mimportjdwl", "munit");
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Mcostcenter", "mcostcenter");
    }

    public function index()
    {
        $this->data['titlehead'] = "Import Jadwal";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/importjdwl.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option company
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vimportjdwl_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');
        $comp_id = intval($this->input->post('comp_id'));

        $results = $this->munit->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->munit->get_cnt($filters);
        $totaldata = $this->munit->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->unitId);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/organisasi/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Import Jadwal';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Import Jadwal ?')";
            }



            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/organisasi/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/organisasi/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['id'] = $row->unitId;
            $obj['parentId'] = $row->parentUnitId;
            $obj['unitCode'] = $row->unitCode;
            $obj['unitName'] = $row->unitName;
            $obj['tahun'] = "2024";
            $obj['bulan'] = "Oktober";
            //$obj['costcenter_code'] = $row->costcenter_code;
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }

        if ($totalfiltered <> $totaldata) {
            $build_array["data"] = $output;
        } else {
            $comp_code_sap = null;
            $comp = $this->mcompany->get_data($comp_id);
            //if ($comp != null) $comp_code_sap = $comp->COMP_CODE_SAP;
            //$build_array["data"] = build_tree($output, 'parentId', 'id', $comp_code_sap);
            $build_array["data"] = build_tree($output, 'parentId', 'id', NULL);
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
            $this->data['titlehead'] = "Edit Organisasi";
        } else {
            $this->data['titlehead'] = "Input Organisasi";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->COMPID = null;
        $stdClass->parentUnitId = null;
        $stdClass->unitCode = '';
        $stdClass->unitName = '';
        $stdClass->unitAlias = '';
        $stdClass->costcenter_code = '';

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->munit->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('COMPID', 'Company', 'required');
            $this->form_validation->set_rules('unitCode', 'Kode', 'required');
            $this->form_validation->set_rules('unitName', 'Nama', 'required');
            //$this->form_validation->set_rules('parentUnitId', 'Parent Org', 'required');

            // POSTING VARIABLE
            $stdClass->COMPID = $this->input->post('COMPID');
            $stdClass->parentUnitId = $this->input->post('parentUnitId');
            $stdClass->unitCode = $this->input->post('unitCode');
            $stdClass->unitName = $this->input->post('unitName');
            $stdClass->unitAlias = $this->input->post('unitAlias');
            //$stdClass->costcenter_code = $this->input->post('costcenter_code');


            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["COMPID"] = $stdClass->COMPID;
                $dataIn["parentUnitId"] = empty($stdClass->parentUnitId) ? null : $stdClass->parentUnitId;
                $dataIn["unitCode"] = $stdClass->unitCode;
                $dataIn["unitName"] = $stdClass->unitName;
                $dataIn["unitAlias"] = $stdClass->unitAlias;
                //$dataIn["costcenter_code"] = cempty_to_null($stdClass->costcenter_code);

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->munit->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Diupdate");
                    }
                } else { // insert
                    if ($this->munit->insert($dataIn)) {
                        $isError = false;
                        $id = $this->munit->id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Baru");
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
                    redirect("reference/organisasi", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/organisasi_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['unitCode'] = array(
            'name' => 'unitCode',
            'id' => 'unitCode',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('unitCode', $stdClass->unitCode)
        );
        $this->data['unitName'] = array(
            'name' => 'unitName',
            'id' => 'unitName',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '250',
            'value' => $this->form_validation->set_value('unitName', $stdClass->unitName)
        );
        $this->data['unitAlias'] = array(
            'name' => 'unitAlias',
            'id' => 'unitAlias',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '250',
            'value' => $this->form_validation->set_value('unitAlias', $stdClass->unitAlias)
        );

        // select option company
        $companies = $this->mcompany->get_data(null, null, 999999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['COMPID'] = array(
            'name' => 'COMPID',
            'id' => 'COMPID',
            'value' => $this->form_validation->set_value('COMPID', $stdClass->COMPID),
            'options' => $list_company,
            'class' => 'form-control'
        );

        // select option parent
        $this->data['parentUnitId'] = array(
            'name' => 'parentUnitId',
            'id' => 'parentUnitId',
            'value' => $this->form_validation->set_value('parentUnitId', $stdClass->parentUnitId),
            'class' => 'form-control col-md-12'
        );

        // select option cost center
        // $costcenters = $this->mcostcenter->get_data(null, 0, 999999);
        // $list_costcenter[null] = "Pilih Cost Center";
        // foreach ($costcenters as $row) {
        //     $list_costcenter[$row->costcenter_code] = $row->costcenter_code;
        // }
        // $this->data['costcenter_code'] = array(
        //     'name' => 'costcenter_code',
        //     'id' => 'costcenter_code',
        //     'value' => $this->form_validation->set_value('costcenter_code', $stdClass->costcenter_code),
        //     'options' => $list_costcenter,
        //     'class' => 'form-control'
        // );

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('reference/vorganisasi_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function sinkronOrganisasi(){
        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://api.rsmb.co.id:4848/app/sdi/get_organisasi',
            // CURLOPT_URL => 'http://localhost/rsmb/api/public/app/sdi/get_organisasi',
            CURLOPT_URL => API_SIMRS.'app/sdi/get_organisasi',

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


        $this->munit->deleteAllOrganisasi();

        $arrData = json_decode($response, true);
        $resData = ($arrData['response']['data']);

        foreach ($resData as $rowPeg) {
            // Initialize default values if certain keys are missing
            $rowPeg['is_deleted'] = $rowPeg['is_deleted'] ?? 0;
    
            // Insert modified data into the database
            $insertData = array(
                'unitId' => $rowPeg['id'],
                'unitCode' => $rowPeg['code'],
                'unitName' => $rowPeg['name'],
                'unitAlias' => '4',
                'parentUnitId' => null, //sementara pakai id (harusnya ini sudah di set dari simrs)
                'defPositionId' => 1,
                'siteId' => 1,
                'active' => 1,
                'unitCodeDsm' => null,
                'COMPID' => 1,
                'costcenter_code' => '',
                'multiple_kode_unit' => ''
            );

    
            if (!$this->munit->insertOrganisasi($insertData)) {
                $success = false; 
            }
        }
    
        if($success){
            $success_msg = "SUCCESS_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("reference/organisasi", 'refresh');
        }else{
            $success_msg = "FAILED_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("reference/organisasi", 'refresh');
        }

    }

    public function get_node() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'u.COMPID', 'value' => $COMPID]
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
                $out = build_tree($output, 'parentId', 'id', NULL);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    //delete data = menonaktifkan data
    public function delete($id = NULL)
    {
        /*if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $res = $this->munit->delete($id);
        if ($res) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Dihapus");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
        }
        redirect('reference/organisasi', 'refresh');*/

        $this->deactivate($id);
    }

    //activate
    public function activate($id)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 1;
        $activation = $this->munit->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/organisasi", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 0;
        $deactivate = $this->munit->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/organisasi", 'refresh');
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
