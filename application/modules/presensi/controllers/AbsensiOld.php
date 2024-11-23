<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Memployee $memp
 */
class AbsensiOld extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRESENSI_ABSENSI";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("presensi/Mabsensi", "mabs");
        $this->load->model("reference/Munit", "munit");
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Mposition_emp", "mposemp");
        $this->load->model("reference/Memployee", "memp");
    }

    public function index()
    {
        $this->data['titlehead'] = "Absensi";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/absensi.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->data['start_date'] = array(
            'name' => 'start_date',
            'id' => 'start_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('start_date', '')
        );

        $this->data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('end_date', '')
        );


        $this->_render_page('vabsensi_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mabs->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mabs->get_cnt($filters);
        $totaldata = $this->mabs->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->EMP_ID);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'presensi/absensi/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/absensi/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("presensi/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("presensi/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));
            //$linkpath = base_url().'uploads/absensi/'.$row->COMP_CODE.'/'.$row->URL_FOTO;
            //$linkpathpulang = base_url().'uploads/absensi/'.$row->COMP_CODE.'/'.$row->URL_FOTO_PULANG;
            
            $linkpath = base_url().'uploads/absensi/'.$row->COMP_CODE.'/'.$row->PATH.'/'.$row->URL_FOTO;
            $linkpathpulang = base_url().'uploads/absensi/'.$row->COMP_CODE.'/'.$row->PATH.'/'.$row->URL_FOTO_PULANG;
            
            $obj = [];
            $obj['EMP_ID'] = $row->EMP_ID;
            $obj['EMP_NAME'] = $row->EMP_NAME;
            $obj['NIK'] = $row->NIK;
            $obj['TGL_ABS'] = $row->TGL_ABS;
            $obj['JAM_IN'] = $row->JAM_IN;
            $obj['JAM_OUT'] = $row->JAM_OUT;
            $obj['LOKASI'] = $row->LOKASI;
            $obj['ABS_TYPE_DESC'] = $row->ABS_TYPE_DESC;
            $obj['POSITION_DESC'] = $row->POSITION_DESC;
            $obj['UNITNAME'] = $row->UNITNAME;
            $obj['URL_FOTO'] = "<a href='".$linkpath."' target='_blank' >Link Foto</a>";
            $obj['URL_FOTO_PULANG'] = "<a href='".$linkpathpulang."' target='_blank' >Link Foto</a>";
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
            $this->data['titlehead'] = "Edit Absensi";
        } else {
            $this->data['titlehead'] = "Input Absensi";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->NIK = null;
        $stdClass->EMP_NAME = null;
        $stdClass->EMAIL = null;
        $stdClass->COMPID = null;
        $stdClass->UNITID = null;
        $stdClass->positionId = null;
        $stdClass->POSITION_CODE = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->memp->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('NIK', 'NIK', 'required');
            $this->form_validation->set_rules('EMP_NAME', 'Nama', 'required');
            $this->form_validation->set_rules('EMAIL', 'Email', 'required');
            $this->form_validation->set_rules('COMPID', 'Company', 'required');
            $this->form_validation->set_rules('UNITID', 'Organisasi', 'required');
            $this->form_validation->set_rules('POSITION_CODE', 'Posisi', 'required');

            // POSTING VARIABLE
            $stdClass->NIK = trim($this->input->post('NIK'));
            $stdClass->EMP_NAME = trim($this->input->post('EMP_NAME'));
            $stdClass->EMAIL = trim($this->input->post('EMAIL'));
            $stdClass->COMPID = $this->input->post('COMPID');
            $stdClass->UNITID = $this->input->post('UNITID');
            $stdClass->POSITION_CODE = $this->input->post('POSITION_CODE');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["NIK"] = $stdClass->NIK;
                $dataIn["EMP_NAME"] = $stdClass->EMP_NAME;
                $dataIn["EMAIL"] = $stdClass->EMAIL;
                $dataIn["COMPID"] = $stdClass->COMPID;
                $dataIn["UNITID"] = $stdClass->UNITID;
                $dataIn["POSITION_CODE"] = $stdClass->POSITION_CODE;

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->memp->update($id, $dataIn)) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Diupdate");
                    }
                } else { // insert
                    if ($this->memp->insert($dataIn)) {
                        $isError = false;
                        $id = $stdClass->POSITION_CODE;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Baru");
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
                    redirect("presensi/absensi", 'refresh');
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
            HTTP_MOD_JS . 'modules/presensi/absensi_form.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['NIK'] = array(
            'name' => 'NIK',
            'id' => 'NIK',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '20',
            'value' => $this->form_validation->set_value('NIK', $stdClass->NIK)
        );
        $this->data['EMP_NAME'] = array(
            'name' => 'EMP_NAME',
            'id' => 'EMP_NAME',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('EMP_NAME', $stdClass->EMP_NAME)
        );
        $this->data['EMAIL'] = array(
            'name' => 'EMAIL',
            'id' => 'EMAIL',
            'type' => 'EMAIL',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('EMAIL', $stdClass->EMAIL)
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
    
        // select option posisi
        $this->data['POSITION_CODE'] = array(
            'name' => 'POSITION_CODE',
            'id' => 'POSITION_CODE',
            'value' => $this->form_validation->set_value('POSITION_CODE', $stdClass->POSITION_CODE),
            'class' => 'form-control col-md-12'
        );

        // select option unit
        $this->data['UNITID'] = array(
            'name' => 'UNITID',
            'id' => 'UNITID',
            'value' => $this->form_validation->set_value('UNITID', $stdClass->UNITID),
            'class' => 'form-control col-md-12'
        );

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('presensi/vemployee_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->memp->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("presensi/absensi", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->memp->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("presensi/absensi", 'refresh');
    }

    public function get_node_position()
    {
        $out = [];
        $company_code = null;
        $COMPID = intval($this->input->post('COMPID'));
        $mcompany = $this->mcompany->get_data($COMPID);
        if (!empty($mcompany)) {
            $company_code = $mcompany->COMP_CODE;
            $filters = [
                ['field' => 'a.company_code', 'value' => $company_code]
            ];
            $results = $this->mposemp->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->POSITION_CODE;
                    $arr['parentId'] = $row->parent_POSITION_CODE;
                    $arr['POSITION_DESC'] = "{$row->POSITION_CODE} - {$row->POSITION_DESC}";
                    $output[] = $arr;
                }
                $out = build_tree($output, 'parentId', 'id', 0);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function get_node_org() {
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
                    $arr['id'] = $row->UNITID;
                    $arr['parentId'] = $row->parentUNITID;
                    $arr['UNITNAME'] = "{$row->unitCode} - {$row->UNITNAME}";
                    $output[] = $arr;
                }
                $COMP_CODE_SAP = null;
                $comp = $this->mcompany->get_data($COMPID);
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

            case 'SUCCESS_SINKRONISASI':
                $title = 'Sinkronisasi Berhasil';
                $message = 'Sinkronisasi data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'FAILED_SINKRONISASI':
                $title = 'Sinkronisasi Gagal';
                $message = 'Sinkronisasi data gagal !';
                $icons = '';
                break;
    
        }

        return message_box($title, $message, $mode, $icons, $fadeOut);
    }




       // SINKRONISASI //
    function tarikDataAbensi(){

        $total_pegawai = 0;

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');


        if($start_date != '' && $end_date  != ''){
            
            $start_date = $this->_fyyyymmdd($start_date);
            $end_date = $this->_fyyyymmdd($end_date);

            $params = 'http://jos.jawara.co.id:500/api/finger/tft/attendance?start_date='.$start_date.'&end_date='.$end_date.'';

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $params,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
        
    
            $response = curl_exec($curl);
            curl_close($curl);
            $res = array();
            $res =  json_decode($response, true);;
            
            foreach($res['fp'] as $row){
                $dataInpKaryawan = array(
                    'machine_id' => $row['machine_id'], 
                    'ip' => $row['ip'], 
                    'port' => $row['port'], 
                    'fid' => $row['fid'], 
                    'verification_mode' => $row['verification_mode'], 
                    'work_code' =>$row['work_code'], 
                    'in_out_mode' => $row['in_out_mode'], 
                    'tanggal' => $row['time']
                );
    
                $machine_id = $row['machine_id']; 
                $ip = $row['ip']; 
                $port = $row['port']; 
                $fid = $row['fid']; 
                $verification_mode = $row['verification_mode']; 
                $work_code =$row['work_code'];
                $in_out_mode = $row['in_out_mode']; 
                $tanggal = $row['time'];
                $created_date = date('Y-m-d H:i:s');
    
                $execAbs = $this->mabs->insertLogAbsensi($machine_id, $ip, $port, $fid, $verification_mode, $work_code, $in_out_mode, $tanggal, $created_date);
    
                //$exec = $this->mabs->insertLogDataAbsensi($dataInpKaryawan);
            }
    
            $sinkron = 1;
           
            if($sinkron == 1){
                $success_msg = "SUCCESS_SINKRONISASI";
                $success_msg = $this->_get_message($success_msg);
                $this->session->set_flashdata('message', $success_msg);
                redirect("presensi/absensi", 'refresh');
            }else{
                $success_msg = "FAILED_SINKRONISASI";
                $success_msg = $this->_get_message($success_msg);
                $this->session->set_flashdata('message', $success_msg);
                redirect("presensi/absensi", 'refresh');
            }
    
        }else{
            $success_msg = "FAILED_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("presensi/absensi", 'refresh');    
        }

    
    }

    public function _fyyyymmdd($date_str){
        $date ="";
        $dd=substr($date_str, 0, 2);
        $mm=substr($date_str, 3, 2);
        $yyyy=substr($date_str, 6, 4);
        $date = $yyyy."-".$mm."-".$dd;
        return $date;
    }

    


}
