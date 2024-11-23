<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Company
 * @property Mcompany $mcompany
 */
class Company extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_COMPANY";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Msettingpresensi", "mspr");
        $this->load->model("Mperiodeabsen", "mpab");
        $this->load->model("Memployee", "memp");
    }

    public function index()
    {   
        $this->data['titlehead'] = "Perusahaan";
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/company.js'
        );
        $this->data['loadfoot'] = $loadfoot;
        $this->_render_page('vcompany_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mcompany->get_data(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mcompany->get_data_cnt($filters);
        $totaldata = $this->mcompany->get_data_cnt();
        $maxpage = ceil($totalfiltered / $limit);

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );


        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->COMPID);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/company/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/company/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $this->qsecure->encrypt($row->COMPID),
                    "aksi" => $btnAction,
                    "COMP_CODE" => $row->COMP_CODE,
                    "COMP_NAME" => $row->COMP_NAME,
                    "ALAMAT" => $row->ALAMAT,
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
            $this->data['titlehead'] = "Edit Company";
        } else {
            $this->data['titlehead'] = "Input Company";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->COMP_CODE = '';
        $stdClass->COMP_NAME = '';
        $stdClass->COMP_CODE_SAP = '';
        $stdClass->LONG = '';
        $stdClass->LAT = '';
        $stdClass->ALAMAT = '';

        $stdClassKonfig = new stdClass();
        $NAMA_ATASAN_HO = null;
        $NIK_ATASAN_HO = null;


        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mcompany->get_data($id);
            $stdClassKonfig =  $this->memp->getKonfigurasiHo($stdClass->COMPID);
            $NAMA_ATASAN_HO  = $stdClassKonfig->NAMA_ATASAN_HO;
            $NIK_ATASAN_HO = $stdClassKonfig->NIK_ATASAN_HO;
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            //$this->form_validation->set_rules('COMP_CODE', 'Company Code', 'required');
            $this->form_validation->set_rules('COMP_NAME', 'Company Name', 'required');
            //$this->form_validation->set_rules('COMP_CODE_SAP', 'Company Code SAP', 'required');

            // POSTING VARIABLE
            $stdClass->COMP_CODE = $this->input->post('COMP_CODE');
            $stdClass->COMP_NAME = $this->input->post('COMP_NAME');
            $stdClass->LONG = $this->input->post('LONG');
            $stdClass->LAT = $this->input->post('LAT');
            $stdClass->COMP_CODE_SAP = $this->input->post('COMP_CODE_SAP');
            $stdClass->ALAMAT = $this->input->post('ALAMAT');
            $NIK_ATASAN_HO = $this->input->post('NIK_ATASAN_HO');
            $NAMA_ATASAN_HO = $this->input->post('NAMA_ATASAN_HO');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
                $dataIn["COMP_CODE"] = $stdClass->COMP_CODE;
                $dataIn["COMP_NAME"] = $stdClass->COMP_NAME;
                $dataIn["LONG"] = $stdClass->LONG;
                $dataIn["LAT"] = $stdClass->LAT;
                $dataIn["COMP_CODE_SAP"] = $stdClass->COMP_CODE_SAP;
                $dataIn["ALAMAT"] = $stdClass->ALAMAT;
                $dataIn["NIK_HO"] = $NIK_ATASAN_HO;

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($this->mcompany->update($id, $dataIn)) {

                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Company Diupdate");
                    }
                } else { // insert

                    $randomcode = rand(); 
                    $compcode_random     = strtoupper(substr(MD5($randomcode),0,6)); 
                    $dataIn["COMP_CODE"] = $compcode_random;
                    $dataIn["API_BRANCH"] = "presensikita.com";
                    $dataIn["USER_AUTH"] = "MieAyam";
                    $dataIn["PASS_AUTH"] = "$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK";
                    $dataIn["KONCI_SEUNEU"] = "$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK";


                    if ($this->mcompany->insert($dataIn)) {

                        $isError = false;
                        $id = $this->mcompany->id;

                        //INSERT SETTING PERIODE
                        $mcompany = $this->mcompany->get_data($id);
                        $arr_remark = array("Absensi","Izin","Cuti","Pengobatan","Penggantian Biaya",
                        "Dinas","Pelatihan","Daftar Pengajuan","Riwayat Pengajuan","Notifikasi");
                        $x = 0;
                        while($x < 10){
                            $dataInPresensi = array();    
                            $dataInPresensi["ID_MENU"] = $x+1;
                            $dataInPresensi["COMPID"] = $id;
                            $dataInPresensi["COMP_CODE"] = $mcompany->COMP_CODE;
                            $dataInPresensi["START_DATE"] = date("Y")."-01-01 00:00:00";
                            $dataInPresensi["END_DATE"] = date("Y").'-12-31 23:59:59';
                            $dataInPresensi["REMARK"] = $arr_remark[$x];
                            $this->mspr->insert_presensi($dataInPresensi);
                            $x++;
                        }
                        //END INSERT SETTING PERIODE

                        //INSERT PERIODE ABSEN
                        $dataInPeriod["compid"] = $id;
                        $dataInPeriod["comp_code"] = $mcompany->COMP_CODE;
                        $dataInPeriod["tgl_awal"] = 21;
                        $dataInPeriod["tgl_akhir"] = 20;
                        $this->mpab->insert($dataInPeriod);

                        //END INSERT PERIODE ABSEN
                        $comp_code = $mcompany->COMP_CODE;
                        //CREATE DIRECTORY
                        if (!is_dir('uploads/absensi/'.$comp_code)) {
                            mkdir('./uploads/absensi/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/cuti/'.$comp_code)) {
                            mkdir('./uploads/cuti/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/dinas/'.$comp_code)) {
                            mkdir('./uploads/dinas/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/izin/'.$comp_code)) {
                            mkdir('./uploads/izin/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/pelatihan/'.$comp_code)) {
                            mkdir('./uploads/pelatihan/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/pengobatan/'.$comp_code)) {
                            mkdir('./uploads/pengobatan/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/reimburse/'.$comp_code)) {
                            mkdir('./uploads/reimburse/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/spj/'.$comp_code)) {
                            mkdir('./uploads/spj/' . $comp_code, 0777, TRUE);
                        }

                        //PERSONAL
                        if (!is_dir('uploads/personal/aia/'.$comp_code)) {
                            mkdir('./uploads/personal/aia/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/asuransi/'.$comp_code)) {
                            mkdir('./uploads/personal/asuransi/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/bpjs_kes/'.$comp_code)) {
                            mkdir('./uploads/personal/bpjs_kes/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/bpjs_tk/'.$comp_code)) {
                            mkdir('./uploads/personal/bpjs_tk/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/ktp/'.$comp_code)) {
                            mkdir('./uploads/personal/ktp/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/npwp/'.$comp_code)) {
                            mkdir('./uploads/personal/npwp/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/photo/'.$comp_code)) {
                            mkdir('./uploads/personal/photo/' . $comp_code, 0777, TRUE);
                        }
                        if (!is_dir('uploads/personal/sim/'.$comp_code)) {
                            mkdir('./uploads/personal/sim/' . $comp_code, 0777, TRUE);
                        }


                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Company Baru");
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
                    redirect("reference/company", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/company_form.js',
            HTTP_JS_PATH.'jquery.inputmask.bundle.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display the form
        $this->data['COMP_CODE'] = array(
            'name' => 'COMP_CODE',
            'id' => 'COMP_CODE',
            'type' => 'text',
            'class' => 'form-control',
            'readonly' => true,
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('COMP_CODE', $stdClass->COMP_CODE)
        );

        $this->data['COMP_NAME'] = array(
            'name' => 'COMP_NAME',
            'id' => 'COMP_NAME',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('COMP_NAME', $stdClass->COMP_NAME)
        );

        $this->data['ALAMAT'] = array(
            'name' => 'ALAMAT',
            'id' => 'ALAMAT',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'rows' => '2',
            'value' => $this->form_validation->set_value('ALAMAT', $stdClass->ALAMAT)
        );

        // $this->data['COMP_CODE_SAP'] = array(
        //     'name' => 'COMP_CODE_SAP',
        //     'id' => 'COMP_CODE_SAP',
        //     'type' => 'text',
        //     'class' => 'form-control',
        //     'maxLength' => '50',
        //     'value' => $this->form_validation->set_value('COMP_CODE_SAP', $stdClass->COMP_CODE_SAP)
        // );

        $this->data['LONG'] = array(
            'name' => 'LONG',
            'id' => 'LONG',
            'type' => 'text',
            'class' => 'allownumericwithdecimal form-control',
            'maxLength' => '100',
            'value' => $this->form_validation->set_value('LONG', $stdClass->LONG)
        );

        $this->data['LAT'] = array(
            'name' => 'LAT',
            'id' => 'LAT',
            'type' => 'text',
            'class' => 'allownumericwithdecimal form-control',
            'maxLength' => '100',
            'value' => $this->form_validation->set_value('LAT', $stdClass->LAT)
        );

        $this->data['NIK_ATASAN_HO'] = array(
            'name' => 'NIK_ATASAN_HO',
            'id' => 'NIK_ATASAN_HO',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('NIK_ATASAN_HO', $NIK_ATASAN_HO)
        );

        $this->data['NAMA_ATASAN_HO'] = array(
            'name' => 'NAMA_ATASAN_HO',
            'id' => 'NAMA_ATASAN_HO',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('NAMA_ATASAN_HO', $NAMA_ATASAN_HO)
        );

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('reference/vcompany_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    // delete data
    // jadi nonaktifkan data
    public function delete($id = NULL)
    {
//        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
//        $id = intval($id);
//        $res = $this->mcompany->delete($id);
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
        $activation = $this->mcompany->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Company Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/company", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 0;
        $deactivate = $this->mcompany->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Company Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/company", 'refresh');
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

    public function get_node_company() {
        $out = [];
        $results = $this->mcompany->get_data(null, 0, 999999, null, null);
        if ($results != null) {
            // build tree
            $output = [];
            foreach ($results as $row) {
                $arr = [];
                $arr['id'] = $row->COMPID;
                $arr['parentId'] = $row->PARENT_COMPID;
                $arr['compName'] = "{$row->COMP_NAME}";
                $output[] = $arr;
            }
            $out = build_tree($output, 'parentId', 'id', NULL);
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') 
    { 

        // echo "Jarak jakarta bandung = ".$this->getDistanceBetween(-6.211544, 106.845172, -6.9175, 107.6191, 'Km')." Km";
        // exit();

        $theta = $longitude1 - $longitude2; 
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
        switch($unit) 
        { 
            case 'Mi': break; 
            case 'Km' : $distance = $distance * 1.609344; 
        } 
        return (round($distance,2)); 
    }


}
