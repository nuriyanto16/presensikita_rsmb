<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Pelatihan
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Mdinas $mdns
 */

class Dinas extends Mst_controller
{
    
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRESENSI_DINAS";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Memployee", "memployee");
        $this->load->model("Mdinas", "mdns");
        $this->load->model("Dinas_model", "mod");
        $this->load->model("Approval_model", "mod_app");
    }

    public function index()
    {
        $this->data['titlehead'] = "Dinas";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/dinas.js'
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
            'class' => 'form-control'
        );

        $this->data['end_date'] = array(
            'name' => 'end_date',
            'id' => 'end_date',
            'type' => 'text',
            'class' => 'form-control'
        );

        $this->_render_page('vdinas_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->mdns->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->mdns->get_cnt($filters);
        $totaldata = $this->mdns->get_cnt();
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
                $atr_edit['url'] = 'presensi/dinas/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'presensi/dinas/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['comp_name'] = $row->comp_name;
            $obj['unit'] = $row->unit;
            $obj['emp_name'] = $row->emp_name;
            $obj['tujuan'] = $row->tujuan;
            $obj['tgl_brkt'] = $row->tgl_brkt;
            $obj['tgl_plng'] = $row->tgl_plng;
            $obj['jml'] = $row->jml;
            $obj['keperluan'] = $row->keperluan;
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
            $this->data['titlehead'] = "Edit Dinas";
        } else {
            $this->data['titlehead'] = "Input Dinas";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->nik = null;
        $stdClass->deskripsi = null;
        $stdClass->compid = null;
        $stdClass->comp_code = null;
        $stdClass->tujuan = null;
        $stdClass->nm_pejabat = null;
        $stdClass->jabatan = null;
        $stdClass->keperluan = null;
        $stdClass->all_bdgjkt = null;
        $stdClass->all_lr_kota = null;
        $stdClass->all_lr_negeri = null;
        $stdClass->tr_k_pribadi = null;
        $stdClass->tr_k_dinas = null;
        $stdClass->tr_ka = null;
        $stdClass->tr_pesawat = null;
        $stdClass->tr_travel = null;
        $stdClass->tr_bus = null;
        $stdClass->ak_hotel = null;
        $stdClass->ak_hotel_nom = 0;
        $stdClass->ak_hotel_ket = null;
        $stdClass->ak_tr_loc = null;
        $stdClass->ak_tr_loc_nom = 0;
        $stdClass->ak_tr_loc_ket = null;
        $stdClass->ak_susp = null;
        $stdClass->ak_susp_nom = 0;
        $stdClass->ak_susp_ket = null;
        $stdClass->periode = date("Y");
        $stdClass->tgl_brkt = null;
        $stdClass->tgl_plng = null;    
        $stdClass->jml = 0;
        $stdClass->sts_aju = null;
        $stdClass->app_nik = null;
        $stdClass->app_ket = null;

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->mdns->get($id);
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
            $stdClass->tujuan = $this->input->post('tujuan');
            $stdClass->keperluan = $this->input->post('keperluan');
            $stdClass->nm_pejabat = $this->input->post('nm_pejabat');
            $stdClass->jabatan = $this->input->post('jabatan');
            $stdClass->all_bdgjkt = $this->input->post('all_bdgjkt');
            $stdClass->all_lr_kota = $this->input->post('all_lr_kota');
            $stdClass->all_lr_negeri = $this->input->post('all_lr_negeri');
            $stdClass->tr_k_pribadi = $this->input->post('tr_k_pribadi');
            $stdClass->tr_k_dinas = $this->input->post('tr_k_dinas');
            $stdClass->tr_ka = $this->input->post('tr_ka');
            $stdClass->tr_pesawat = $this->input->post('tr_pesawat');
            $stdClass->tr_travel = $this->input->post('tr_travel');
            $stdClass->tr_bus = $this->input->post('tr_bus');
            $stdClass->ak_hotel = $this->input->post('ak_hotel');
            $stdClass->ak_hotel_nom = $this->input->post('ak_hotel_nom');
            $stdClass->ak_hotel_ket = $this->input->post('ak_hotel_ket');
            $stdClass->ak_tr_loc = $this->input->post('ak_tr_loc');
            $stdClass->ak_tr_loc_nom = $this->input->post('ak_tr_loc_nom');
            $stdClass->ak_tr_loc_ket = $this->input->post('ak_tr_loc_ket');
            $stdClass->ak_susp = $this->input->post('ak_susp');
            $stdClass->ak_susp_nom = $this->input->post('ak_susp_nom');
            $stdClass->ak_susp_ket = $this->input->post('ak_susp_ket');
            $stdClass->periode = date("Y");
            $stdClass->tgl_brkt = $this->input->post('tgl_brkt');
            $stdClass->tgl_plng = $this->input->post('tgl_plng');
            $stdClass->jml = $this->input->post('jml');
            $sts_aju = $this->input->post('sts_aju');
            $app_nik = $this->input->post('app_nik');
            $app_ket = $this->input->post('app_ket');
            $old_images = $this->input->post('old_images');
            $det_old_attach =  $this->input->post('hid_detail_attachment');
            $dataPeserta = $this->input->post("hid_peserta");
            

            $action = strval($this->input->post('actionf'));

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $pengajuan_id = $id;
                $nik = $stdClass->nik;
                $compid = $stdClass->compid;
                $comp_code = $stdClass->comp_code;
                $periode = $stdClass->periode;
                $tgl_brkt = $stdClass->tgl_brkt;
                $tgl_plng = $stdClass->tgl_plng;
                $jml = $stdClass->jml;
                $tujuan = $stdClass->tujuan;
                $nm_pejabat = $stdClass->nm_pejabat;
                $jabatan = $stdClass->jabatan;
                $keperluan = $stdClass->keperluan;

                $all_bdgjkt = ($stdClass->all_bdgjkt == 1) ? 1 : 0; 
                $all_lr_kota = ($stdClass->all_lr_kota == 1) ? 1 : 0; 
                $all_lr_negeri = ($stdClass->all_lr_negeri == 1) ? 1 : 0; 
                $tr_k_pribadi = ($stdClass->tr_k_pribadi == 1) ? 1 : 0; 
                $tr_k_dinas = ($stdClass->tr_k_dinas == 1) ? 1 : 0; 
                $tr_ka = ($stdClass->tr_ka == 1) ? 1 : 0; 
                $tr_pesawat = ($stdClass->tr_pesawat == 1) ? 1 : 0; 
                $tr_travel = ($stdClass->tr_travel == 1) ? 1 : 0; 
                $tr_bus = ($stdClass->tr_bus == 1) ? 1 : 0; 
                $ak_hotel = ($stdClass->ak_hotel == 1) ? 1 : 0; 
                $ak_hotel_nom = $stdClass->ak_hotel_nom;
                $ak_hotel_ket = $stdClass->ak_hotel_ket;
                $ak_tr_loc = ($stdClass->ak_tr_loc == 1) ? 1 : 0; 
                $ak_tr_loc_nom = $stdClass->ak_tr_loc_nom;
                $ak_tr_loc_ket = $stdClass->ak_tr_loc_ket;
                $ak_susp = ($stdClass->ak_susp == 1) ? 1 : 0; 
                $ak_susp_nom = $stdClass->ak_susp_nom;
                $ak_susp_ket = $stdClass->ak_susp_ket;

                $dataRawPeserta = json_decode($dataPeserta, true);

                $cnt_file = 0;
                $cnt_file_old = 0;
                $cnt_exist = 0;
                $periode = date("Y");
                $date = date("Y-m-d H:i:s");
                $params_image_input = "";
                $params_image ="";
                $catatan = "";

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
                            //$targetDir =  upload_path.'/izin/'.$comp_code.'/';
                            $targetDir =  upload_path.'dinas/'.$comp_code.'/';
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

                //DETAIL PESERTA
                $x=1;
                $cnt_peserta = 0;
                $params_peserta ="";
                if($dataRawPeserta != null || $dataRawPeserta != ''){
                    $cnt_peserta = 1;
                    foreach ($dataRawPeserta as $itemKel) {
                        $dataInKel['id_aju']  = $id;
                        $dataInKel['seq']  = $cnt_peserta;
                        $dataInKel['nik']  = $itemKel['nik_karyawan'];
                        $dataInKel['compid']  = $compid;
                        $dataInKel['comp_code']  = $comp_code;
                        $params_peserta = $itemKel['nik_karyawan'].";".$params_peserta;
                        $cnt_peserta++;
                    }
                }

 
                if ($this->input->post('id')) { // update                   

                    $isUpdate = true;
                    if ($action === 'save') {
                        $isError = !$this->mod->InsUpdDinas($pengajuan_id, $nik, $comp_code, $periode, $date,
                        $nm_pejabat, $jabatan, $tujuan, $keperluan, 
                        $this->_fyyyymmdd($tgl_brkt), $this->_fyyyymmdd($tgl_plng), $all_bdgjkt, $all_lr_kota,
                        $all_lr_negeri, $tr_k_pribadi, $tr_k_dinas, $tr_ka,
                        $tr_pesawat, $tr_travel, $tr_bus, $ak_hotel, $ak_hotel_nom,
                        $ak_hotel_ket, $ak_tr_loc, $ak_tr_loc_nom, $ak_tr_loc_ket, $ak_susp,
                        $ak_susp_nom, $ak_susp_ket, $cnt_file, $params_image_input, $cnt_peserta, $params_peserta);	


                        if (!$isError) {
                            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Pelatihan Diperbaharui");
                        }
                   
                    } else if (in_array($action, array('approve', 'reject'))) {
    
                        $menu_id = 6;
                        $approval_id = $this->session->userdata(sess_prefix()."nik");
                        $status_id = $sts_aju;
                        $status_act_id = ($action == 'approve') ? 1 : 2;
                        $keterangan = $this->input->post('app_ket');

                        $isError = ! $this->mod_app->ApprovePengajuan($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan);

                        if (!$isError) {
                            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Apporval Pelatihan");
                        }

                    }
                   
                } else { // insert

                    $execute = $this->mod->InsUpdDinas($pengajuan_id, $nik, $comp_code, $periode, $date,
                        $nm_pejabat, $jabatan, $tujuan, $keperluan, 
                        $this->_fyyyymmdd($tgl_brkt), $this->_fyyyymmdd($tgl_plng), $all_bdgjkt, $all_lr_kota,
                        $all_lr_negeri, $tr_k_pribadi, $tr_k_dinas, $tr_ka,
                        $tr_pesawat, $tr_travel, $tr_bus, $ak_hotel, $ak_hotel_nom,
                        $ak_hotel_ket, $ak_tr_loc, $ak_tr_loc_nom, $ak_tr_loc_ket, $ak_susp,
                        $ak_susp_nom, $ak_susp_ket, $cnt_file, $params_image_input, $cnt_peserta, $params_peserta);	

                    if ($execute) {
                        $isError = false;
                        $id = $stdClass->pengajuan_id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Pelatihan Baru");
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
                    redirect("presensi/dinas", 'refresh');
                }
            } else {
                $this->data['errmsg'] = validation_errors();
            }
        }//endif POST

        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array(
            "https://fonts.googleapis.com/icon?family=Material+Icons",
            HTTP_ASSET_PATH . "css/image-uploader.css",
            HTTP_ASSET_PATH . 'vendor/politespace/politespace.css',
            HTTP_ASSET_PATH . 'plugins/zoomclick/zoom.css',
        );
        $this->data['loadhead'] = $loadhead;

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/dinas_form.js',
            HTTP_ASSET_PATH . 'vendor/politespace/politespace.js',
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

        $this->data['tgl_brkt'] = array(
            'name' => 'tgl_brkt',
            'id' => 'tgl_brkt',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('tgl_brkt', $stdClass->tgl_brkt)
        );

        $this->data['tgl_plng'] = array(
            'name' => 'tgl_plng',
            'id' => 'tgl_plng',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('tgl_plng', $stdClass->tgl_plng)
        );
        
        $this->data['jml'] = array(
            'name' => 'jml',
            'id' => 'jml',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('jml', $stdClass->jml)
        );

        $this->data['nm_pejabat'] = array(
            'name' => 'nm_pejabat',
            'id' => 'nm_pejabat',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('nm_pejabat', $stdClass->nm_pejabat)
        );

        $this->data['jabatan'] = array(
            'name' => 'jabatan',
            'id' => 'jabatan',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('jabatan', $stdClass->jabatan)
        );

        $this->data['tujuan'] = array(
            'name' => 'tujuan',
            'id' => 'tujuan',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('tujuan', $stdClass->tujuan)
        );

        $this->data['keperluan'] = array(
            'name' => 'keperluan',
            'id' => 'keperluan',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('keperluan', $stdClass->keperluan)
        );

        $this->data['all_bdgjkt'] = array(
            'name' => 'all_bdgjkt',
            'id' => 'all_bdgjkt',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('all_bdgjkt', ($stdClass->all_bdgjkt == 1) ? 1 : 0)
        );
        if(($stdClass->all_bdgjkt) ? $this->data['all_bdgjkt']['checked'] = true : "");
        $this->data['all_lr_kota'] = array(
            'name' => 'all_lr_kota',
            'id' => 'all_lr_kota',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('all_lr_kota', ($stdClass->all_lr_kota == 1) ? 1 : 0)
        );
        if(($stdClass->all_lr_kota) ? $this->data['all_lr_kota']['checked'] = true : "");
        $this->data['all_lr_negeri'] = array(
            'name' => 'all_lr_negeri',
            'id' => 'all_lr_negeri',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('all_lr_negeri', ($stdClass->all_lr_negeri == 1) ? 1 : 0)
        );
        if(($stdClass->all_lr_negeri) ? $this->data['all_lr_negeri']['checked'] = true : "");
        $this->data['tr_k_pribadi'] = array(
            'name' => 'tr_k_pribadi',
            'id' => 'tr_k_pribadi',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('tr_k_pribadi', ($stdClass->tr_k_pribadi == 1) ? 1 : 0)
        );
        if(($stdClass->tr_k_pribadi) ? $this->data['tr_k_pribadi']['checked'] = true : "");
        $this->data['tr_k_dinas'] = array(
            'name' => 'tr_k_dinas',
            'id' => 'tr_k_dinas',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('tr_k_dinas', ($stdClass->tr_k_dinas == 1) ? 1 : 0)
        );
        if(($stdClass->tr_k_dinas) ? $this->data['tr_k_dinas']['checked'] = true : "");
        $this->data['tr_ka'] = array(
            'name' => 'tr_ka',
            'id' => 'tr_ka',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('tr_ka', ($stdClass->tr_ka == 1) ? 1 : 0)
        );
        if(($stdClass->tr_ka) ? $this->data['tr_ka']['checked'] = true : "");
        $this->data['tr_pesawat'] = array(
            'name' => 'tr_pesawat',
            'id' => 'tr_pesawat',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('tr_pesawat', ($stdClass->tr_pesawat == 1) ? 1 : 0)
        );
        if(($stdClass->tr_pesawat) ? $this->data['tr_pesawat']['checked'] = true : "");
        $this->data['tr_travel'] = array(
            'name' => 'tr_travel',
            'id' => 'tr_travel',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('tr_travel', ($stdClass->tr_travel == 1) ? 1 : 0)
        );
        if(($stdClass->tr_travel) ? $this->data['tr_travel']['checked'] = true : "");
        $this->data['tr_bus'] = array(
            'name' => 'tr_bus',
            'id' => 'tr_bus',
            'type' => 'checkbox',
            'value' => $this->form_validation->set_value('tr_bus', ($stdClass->tr_bus == 1) ? 1 : 0)
        );
        if(($stdClass->tr_bus) ? $this->data['tr_bus']['checked'] = true : "");


        $this->data['ak_hotel'] = array(
            'name' => 'ak_hotel',
            'id' => 'ak_hotel',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('ak_hotel', ($stdClass->ak_hotel == 1) ? 1 : 0)
        );
        if(($stdClass->ak_hotel) ? $this->data['ak_hotel']['checked'] = true : "");

        $this->data['ak_hotel_nom'] = array(
            'name' => 'ak_hotel_nom',
            'id' => 'ak_hotel_nom',
            'type' => 'number',
            'min' => '0',
            'step' => '1',
            'pattern' => '[0-9]*',
            'class' => 'form-control',
            'placeholder' => '[0-9]',
            'data-politespace' => null,
            'data-politespace-grouplength' => "3",
            'data-politespace-delimiter' => ',',
            'data-politespace-reverse' => null,
            'data-politespace-decimal-mark' => '.',
            'value' => $this->form_validation->set_value('ak_hotel_nom', $stdClass->ak_hotel_nom)
        );

        $this->data['ak_hotel_ket'] = array(
            'name' => 'ak_hotel_ket',
            'id' => 'ak_hotel_ket',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'rows' => '2',
            'value' => $this->form_validation->set_value('ak_hotel_ket', $stdClass->ak_hotel_ket)
        );

        $this->data['ak_tr_loc'] = array(
            'name' => 'ak_tr_loc',
            'id' => 'ak_tr_loc',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('ak_tr_loc', ($stdClass->ak_tr_loc == 1) ? 1 : 0)
        );
        if(($stdClass->ak_tr_loc) ? $this->data['ak_tr_loc']['checked'] = true : "");

        $this->data['ak_tr_loc_nom'] = array(
            'name' => 'ak_tr_loc_nom',
            'id' => 'ak_tr_loc_nom',
            'type' => 'number',
            'min' => '0',
            'step' => '1',
            'pattern' => '[0-9]*',
            'class' => 'form-control',
            'placeholder' => '[0-9]',
            'data-politespace' => null,
            'data-politespace-grouplength' => "3",
            'data-politespace-delimiter' => ',',
            'data-politespace-reverse' => null,
            'data-politespace-decimal-mark' => '.',
            'value' => $this->form_validation->set_value('ak_tr_loc_nom', $stdClass->ak_tr_loc_nom)
        );

        $this->data['ak_tr_loc_ket'] = array(
            'name' => 'ak_tr_loc_ket',
            'id' => 'ak_tr_loc_ket',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'rows' => '2',
            'value' => $this->form_validation->set_value('ak_tr_loc_ket', $stdClass->ak_tr_loc_ket)
        );

        $this->data['ak_susp'] = array(
            'name' => 'ak_susp',
            'id' => 'ak_susp',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('ak_susp', ($stdClass->ak_susp == 1) ? 1 : 0)
        );
        if(($stdClass->ak_susp) ? $this->data['ak_susp']['checked'] = true : "");

        $this->data['ak_susp_nom'] = array(
            'name' => 'ak_susp_nom',
            'id' => 'ak_susp_nom',
            'type' => 'number',
            'min' => '0',
            'step' => '1',
            'pattern' => '[0-9]*',
            'class' => 'form-control',
            'placeholder' => '[0-9]',
            'data-politespace' => null,
            'data-politespace-grouplength' => "3",
            'data-politespace-delimiter' => ',',
            'data-politespace-reverse' => null,
            'data-politespace-decimal-mark' => '.',
            'value' => $this->form_validation->set_value('ak_susp_nom', $stdClass->ak_susp_nom)
        );

        $this->data['ak_susp_ket'] = array(
            'name' => 'ak_susp_ket',
            'id' => 'ak_susp_ket',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '500',
            'rows' => '2',
            'value' => $this->form_validation->set_value('ak_susp_ket', $stdClass->ak_susp_ket)
        );

        // DETAIL FOTO
        
        $build_array = array();
        $DataAttach = $this->mod->getAttachment($id);
        if($id!="0"){
            $linkpath = base_url().'uploads/dinas/'.$stdClass->comp_code.'/';
            foreach ($DataAttach as $row_attach) {
                array_push($build_array,
                    array(
                        "pengajuan_id" => $row_attach->ID_AJU,
                        "id" => "old-".$row_attach->SEQ_ATC,
                        "file_name" => $row_attach->URL_ATC_JALANDINAS,
                        "src" => $linkpath.$row_attach->URL_ATC_JALANDINAS,
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
        $this->data['sts_aju_validate'] = $stdClass->sts_aju;

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

            //Detail Peserta
            $this->data['filterkeluarga'] = array(
                0 => array(
                        'field' => "a.compid",
                        'type' => "like",
                        'value' => $this->session->userdata(sess_prefix()."compId")
                ),
                1 => array(
                    'field' => "a.nik",
                    'type' => "like",
                    'value' => $stdClass->nik
                )
            );
    
            $peserta = $this->mod->getPeserta($id);
    
            $this->data['peserta'] = $peserta;
    
            $list_peserta = $peserta;
            $build_array_peserta = [];
            $seq_item = 1;
            foreach ($list_peserta as $mKel) {
                array_push($build_array_peserta,
                    array(
                        'seq' => $seq_item,
                        'nik_karyawan' => $mKel->NIK,
                        'nama_karyawan' => $mKel->NAMA
                    )
                );
                $seq_item++;
            }
            $peserta_list = json_encode($build_array_peserta);
            $this->data['peserta_list'] = $peserta_list;
    
            $this->data['hid_peserta'] = array(
                'name' => 'hid_peserta',
                'id' => 'hid_peserta',
                'type' => 'hidden',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('peserta_list', $peserta_list)
            );
            //End Detail Peserta
    
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
                    $show_approve_btn = true;
                    $show_reject_btn = true;
                }
            } else {
                if($stdClass->sts_aju == 0 ){
                    $nik_atasan = $this->session->userdata(sess_prefix()."nik");
                    $nik_staff = $stdClass->nik;
                    $row_app = $this->mod_app->getStatusApproval($nik_staff, $nik_atasan, $stdClass->comp_code);
                    $stat_approval_user = ($row_app->cnt == 1) ? true : false;
                    if($stat_approval_user){
                        $show_save_btn = true;
                        $show_approve_btn = true;
                        $show_reject_btn = true;
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
        return $this->_render_page('presensi/vdinas_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        $activation = $this->mdns->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Izin Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("presensi/dinas", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = strval($id);

        $data['active'] = 0;
        $deactivate = $this->mdns->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Pelatihan Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("presensi/dinas", 'refresh');
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

    public function getExportExcel($fromDate=null, $toDate=null) {

        $fromDate = DateTime::createFromFormat('d-m-Y', $fromDate);
        $toDate = DateTime::createFromFormat('d-m-Y', $toDate);
        $start_date = $fromDate->format('Y-m-d');
        $end_date = $toDate->format('Y-m-d');
        // DETAIL
        $results = $this->mdns->getExport($start_date, $end_date);
        $build_array = array(
            "data" => array()
        );

        $output = [];

        foreach ($results as $row) {

            $obj = [];
            $obj['unit'] = $row->unit;
            $obj['nik_pegawai'] = $row->nik_pegawai;
            $obj['emp_name'] = $row->emp_name;
            $obj['keperluan'] = $row->keperluan;
            $obj['tujuan'] = $row->tujuan;
            $obj['tgl_brkt'] = $row->tgl_brkt;
            $obj['tgl_plng'] = $row->tgl_plng;
            $obj['jml'] = $row->jml;
            $obj['stat_pengajuan'] = strtoupper($row->stat_pengajuan);
            $output[] = $obj;
        }


        $build_array['data'] = $output;
        header("Content-type: application/octet-stream"); 
        header("Content-Disposition: attachment;filename=EXPORT_IZIN_SAKIT_".$start_date."_".$end_date.".xls");
        header("Content-Transfer-Encoding: binary");
        header('Pragma: no-cache');
        header('Expires: 0');
        set_time_limit(0);
        $build_array["data"] = $output;
        $this->data['results'] = $build_array['data'];
        $this->data['params'] = $start_date." S/D ".$end_date;
        $html = $this->load->view("vdinas_export", $this->data, true);
        
    
        echo $html;
        exit();
				
    }

}
