<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Izin
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Mlaporanharian $mlapharian
 */

class Laporanharian extends Mst_controller
{
    
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRESENSI_LAPORANHARIAN";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Memployee", "memployee");
        $this->load->model("Mlaporanharian", "mlapharian");
        $this->load->model("Laporan_model", "mod");
        $this->load->model("Approval_model", "mod_app");
    }

    public function index()
    {
        $this->data['titlehead'] = "Laporan Harian";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/laporanharian.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vlaporanharian_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mlapharian->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mlapharian->get_cnt($filters);
        $totaldata = $this->mlapharian->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->id_aju);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'presensi/laporanharian/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/laporanharian/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['comp_name'] = $row->comp_name;
            $obj['emp_name'] = $row->emp_name;
            $obj['desc_izin'] = $row->desc_izin;
            $obj['tgl_awal_izin'] = $row->tgl_awal_izin;
            $obj['tgl_akhir_izin'] = $row->tgl_akhir_izin;
            $obj['jml'] = $row->jml;
            $obj['alasan_izin'] = $row->alasan_izin;
            $obj['stat_pengajuan'] = strtoupper($row->stat_pengajuan);
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
            $this->data['titlehead'] = "Edit Laporan Harian";
        } else {
            $this->data['titlehead'] = "Input Laporan Harian";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->nik = null;
        $stdClass->deskripsi = null;
        $stdClass->compid = null;
        $stdClass->comp_code = null;
        $stdClass->id_abs_type = null;
        $stdClass->alasan_izin = null;
        $stdClass->periode = date("Y");
        $stdClass->tgl_awal_izin = null;
        $stdClass->tgl_akhir_izin = null;        
        $stdClass->jml = 0;
        $stdClass->sts_aju = null;
        $stdClass->app_nik = null;
        $stdClass->app_ket = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mlapharian->get($id);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            //$this->form_validation->set_rules('jml', 'Jumlah cuti tahunan', 'required');
            $this->form_validation->set_rules('compid', 'Company', 'required');

            // POSTING VARIABLE
            
            $stdClass->compid = $this->input->post('compid');
            $stdClassComp = $this->mcompany->get_data($stdClass->compid);

            $stdClass->pengajuan_id = $this->input->post('id');
            $stdClass->nik = $this->input->post('nik');
            $stdClass->comp_code = $stdClassComp->COMP_CODE;
            $stdClass->id_abs_type = $this->input->post('id_abs_type');
            $stdClass->alasan_izin = $this->input->post('remark');
            $stdClass->periode = date("Y");
            $stdClass->tgl_awal_izin = $this->input->post('start_date');
            $stdClass->tgl_akhir_izin = $this->input->post('end_date');
            $stdClass->jml = $this->input->post('jml');
            $sts_aju = $this->input->post('sts_aju');
            $app_nik = $this->input->post('app_nik');
            $app_ket = $this->input->post('app_ket');
            $old_images = $this->input->post('old_images');
            $det_old_attach =  $this->input->post('hid_detail_attachment');

            $action = strval($this->input->post('actionf'));

            // if ($action == "approve" || $action == "reject") {
            //     $this->form_validation->set_rules('app_ket', 'Catatan / Tanggapan', 'required|trim|max_length[4000]');
            // }

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $pengajuan_id = $id;
                $nik = $stdClass->nik;
                $comp_code = $stdClass->comp_code;
                $id_abs_type = $stdClass->id_abs_type;
                $remark = $stdClass->alasan_izin;
                $periode = $stdClass->periode;
                $start_date = $stdClass->tgl_awal_izin;
                $end_date = $stdClass->tgl_akhir_izin;
                $jml = $stdClass->jml;
                $cnt_file = 0;
                $cnt_file_old = 0;
                $cnt_exist = 0;
                $periode = date("Y");
                $date = date("Y-m-d H:i:s");
                $params_image_input = "";
                $params_image ="";


                //EXISTING FILE
                if (in_array($action, array('save'))) {
                    $dataRawOldAttach = json_decode($det_old_attach, false);
                    if($dataRawOldAttach != null || $dataRawOldAttach != ''){
                        if(!empty($old_images)){
                            $cnt_exist = count($old_images);
                            $i=0;
                            foreach($dataRawOldAttach as $row_tmp){
                                $i=0;
                                while($i<$cnt_exist){
                                    if($old_images[$i]==$row_tmp->id){
                                        $cnt_file_old = $cnt_file_old  + 1;
                                        $params_image = $row_tmp->file_name.";".$params_image;
                                    }
                                    $i++;
                                }
                            }
                        }
                    }

                    //UPLOAD FILE
                    $folderPath =  upload_path.'/';
                    $targetDir = $folderPath; 
                    $allowTypes = array('jpg','png','jpeg','gif');
                    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
                    $fileNames = array_filter($_FILES['images']['name']); 
                    $cnt_file = $cnt_file_old;

                    $x=1;
                    if(!empty($fileNames)){ 
        
                        foreach($_FILES['images']['name'] as $key=>$val){ 
                            // File upload path 
                            $fileName = basename($_FILES['images']['name'][$key]); 
                            $image_type = pathinfo($fileName, PATHINFO_EXTENSION);
                            $new_name = $this->generateImage($fileName,$image_type,$pengajuan_id,$nik,$comp_code);
                            //$targetDir =  upload_path.'/laporanharian/'.$comp_code.'/';
                            $targetDir =  upload_path.'laporanharian/'.$comp_code.'/';
                            $targetFilePath = $targetDir . $new_name; 

                            // Check whether file type is valid 
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                            if(in_array($fileType, $allowTypes)){ 
                                // Upload file to server 
                                if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){ 
                                    // Image db insert sql 
                                    //$insertValuesSQL .= "('".$fileName."', NOW()),"; 
                                }else{ 
                                    $errorUpload .= $_FILES['images']['name'][$key].' | '; 
                                } 
                            }else{ 
                                $errorUploadType .= $_FILES['images']['name'][$key].' | '; 
                            } 
                            $params_image = $new_name.";".$params_image;
                            $x++;
                        }
                        $cnt_file = $cnt_file + count($fileNames);
                        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                        $statusMsg = "Files are uploaded successfully.".$errorMsg; 
        
                    }

                    $params_image_input = rtrim($params_image, "; ");
                }
               //check to see if we are updating data

                if ($this->input->post('id')) { // update
                    $isUpdate = true;
                    if ($action === 'save') {
                        $isError = ! $this->mlapharian->InsUpdLaporan($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, 
                        $date, $this->_fyyyymmdd($start_date), $this->_fyyyymmdd($start_date), 
                        $jml, $cnt_file, $params_image_input);

                        if (!$isError) {
                            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Laporan Diperbaharui");
                        }
                   
                    } else if (in_array($action, array('approve', 'reject'))) {
    
                        $menu_id = 2;
                        $approval_id = $this->session->userdata(sess_prefix()."nik");
                        $status_id = $sts_aju;
                        $status_act_id = ($action == 'approve') ? 1 : 2;
                        $keterangan = $this->input->post('app_ket');

                        $isError = ! $this->mod_app->ApprovePengajuan($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan);

                        if (!$isError) {
                            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Apporval Laporan");
                        }

                    }
                   
                } else { // insert

                    $execute = $this->mlapharian->InsUpdLaporan($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, 
                        $date, $this->_fyyyymmdd($start_date), $this->_fyyyymmdd($start_date), 
                        $jml, $cnt_file, $params_image_input);

                    if ($execute) {
                        $isError = false;
                        $id = $stdClass->pengajuan_id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Izin Baru");
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
                    redirect("presensi/laporanharian", 'refresh');
                }
            } else {
                $this->data['errmsg'] = validation_errors();
            }
        }//endif POST

        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array(
            "https://fonts.googleapis.com/icon?family=Material+Icons",
            HTTP_ASSET_PATH . "css/image-uploader.css",
            HTTP_ASSET_PATH . 'plugins/zoomclick/zoom.css',
        );
        $this->data['loadhead'] = $loadhead;

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/laporanharian_form.js',
            HTTP_JS_PATH.'jquery.inputmask.bundle.js',
            HTTP_ASSET_PATH . "js/image-uploader.js",
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

        // select emplooye
        $this->data['nik'] = array(
            'name' => 'nik',
            'id' => 'nik',
            'value' => $this->form_validation->set_value('nik', $stdClass->nik),
            'class' => 'form-control col-md-12'
        );

        $jenisizin = $this->mlapharian->getIzinType(null, null);
        $list_jenisizin[null] = "Pilih Status Pergerakan";
        foreach ($jenisizin as $rowjns) {
            $list_jenisizin[$rowjns->JNS_IZIN] = $rowjns->DESC_IZIN;
        }

        $this->data['id_abs_type'] = array(
            'name' => 'id_abs_type',
            'id' => 'id_abs_type',
            'options' => $list_jenisizin,
            'value' => $this->form_validation->set_value('id_abs_type', $stdClass->id_abs_type),
            'class' => 'form-control',
        );

        $this->data['start_date'] = array(
            'name' => 'start_date',
            'id' => 'start_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('start_date', $stdClass->tgl_awal_izin)
        );

        $this->data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('end_date', $stdClass->tgl_akhir_izin)
        );
        
        $this->data['jml'] = array(
            'name' => 'jml',
            'id' => 'jml',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('jml', $stdClass->jml)
        );

        $this->data['remark'] = array(
            'name' => 'remark',
            'id' => 'remark',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'rows' => '2',
            'value' => $this->form_validation->set_value('remark', $stdClass->alasan_izin)
        );


        // DETAIL FOTO
        
        $build_array = array();
        $DataAttach = $this->mod->getAttachment($id);
        if($id!="0"){
            $linkpath = base_url().'uploads/laporanharian/'.$stdClass->comp_code.'/';
            foreach ($DataAttach as $row_attach) {
                array_push($build_array,
                    array(
                        "pengajuan_id" => $row_attach->ID_AJU,
                        "id" => "old-".$row_attach->SEQ_ATC,
                        "file_name" => $row_attach->URL_ATC_IZIN,
                        "src" => $linkpath.$row_attach->URL_ATC_IZIN,
                        "is_new" => 0
                    )
                );
            }
        }
        
        $detail_attachment = json_encode($build_array,JSON_UNESCAPED_SLASHES);
        $this->data['detail_attachment'] = $detail_attachment;
        
        $this->data['hid_detail_attachment'] = array(
            'name' => 'hid_detail_attachment',
            'id' => 'hid_detail_attachment',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('hid_detail_attachment', $detail_attachment)
        );

        $this->data['sts_aju'] = array(
            'name' => 'sts_aju',
            'id' => 'sts_aju',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('sts_aju', $stdClass->sts_aju)
        );
        $this->data['sts_aju_validate'] = 0;//$stdClass->sts_aju;

        $this->data['app_nik'] = array(
            'name' => 'app_nik',
            'id' => 'app_nik',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('app_nik', $stdClass->app_nik)
        );

        $this->data['app_nik'] = array(
            'name' => 'app_nik',
            'id' => 'app_nik',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('app_nik', $stdClass->app_nik)
        );

        if($stdClass->sts_aju >= 0 && $stdClass->sts_aju !== null){
            $this->data['app_ket'] = array(
                'name' => 'app_ket',
                'id' => 'app_ket',
                'type' => 'text',
                'class' => 'form-control',
                'maxLength' => '500',
                'rows' => '2',
                'value' => $this->form_validation->set_value('app_ket', $stdClass->app_ket)
            );
        }
    
        // End Detail 

        // validasi button
        $show_save_btn = false;
        $show_approve_btn = false;
        $show_reject_btn = false;
        $stat_approval_user = false;

        if($id != "0" || $id != 0){
            if($this->session->userdata(sess_prefix()."roleid") == 1 || $this->session->userdata(sess_prefix()."roleid") == 2) {
                if($stdClass->sts_aju == 0 ){
                    $show_save_btn = true;
                    $show_approve_btn = false;
                    $show_reject_btn = false;
                }
            } else {
                if($stdClass->sts_aju == 0 ){
                    $nik_atasan = $this->session->userdata(sess_prefix()."nik");
                    $nik_staff = $stdClass->nik;
                    $row_app = $this->mod_app->getStatusApproval($nik_staff, $nik_atasan, $stdClass->comp_code);
                    $stat_approval_user = ($row_app->cnt == 1) ? true : false;
                    if($stat_approval_user){
                        $show_save_btn = true;
                        $show_approve_btn = falses;
                        $show_reject_btn = false;
                    }else{
                        $show_save_btn = true;
                    }
                }else{
                    $show_save_btn = false;
                    $show_approve_btn = false;
                    $show_reject_btn = false;
                }
            }    
        }else{
            $show_save_btn = true;
        }

        $this->data['show_save_btn'] = $show_save_btn;
        $this->data['show_approve_btn'] = $show_approve_btn;
        $this->data['show_reject_btn'] = $show_reject_btn;

        // end validasi button

        $this->data['csrf'] = $this->_get_sess_csrf();
        return $this->_render_page('presensi/vlaporanharian_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mlapharian->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Izin Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("presensi/laporanharian", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mlapharian->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Izin Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("presensi/laporanharian", 'refresh');
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


    public function get_node_employee() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.compid', 'type' => '=', 'value' => $COMPID]
            ];
            $results = $this->memployee->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['nik'] = $row->nik;
                    $arr['emp_name'] = $row->nik." - ".strtoupper($row->emp_name);
                    $output[] = $arr;
                }
                $out = $output;
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    
    //GENERATE IMAGE BASE64 TO IMAGE
	public function generateImage($img,$image_type,$pengajuan_id,$nik,$comp_code)
    {
        $image_base64 = $img;
        $new_name =  $pengajuan_id.'_'.strtoupper(uniqid()).'_'.date('YmdHis')."_".$nik."_".$comp_code.".".$image_type;
        $file = $new_name;
        return $file;
    }

    //16-12-2019
    public function _fyyyymmdd($date_str){
        $date ="";
        $dd=substr($date_str, 0, 2);
        $mm=substr($date_str, 3, 2);
        $yyyy=substr($date_str, 6, 4);
        $date = $yyyy."-".$mm."-".$dd;
        return $date;
    }

}
