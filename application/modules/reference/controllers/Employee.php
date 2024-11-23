<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Employee
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mposition_emp $mposemp
 * @property Memployee $memp
 */
class Employee extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_EMPLOYEE";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Munit", "munit");
        $this->load->model("Mcompany", "mcompany");
        $this->load->model("Mposition_emp", "mposemp");
        $this->load->model("Mkantor", "mktr");
        $this->load->model("Mtimeprofile", "mtmp");
        $this->load->model("Mtimeprofileperson", "mtpp");
        $this->load->model("Mkeluarga", "mkel");
        $this->load->model("Mcutiadjustment", "mcadj");
        $this->load->model("Memployee", "memp");
        $this->load->model("Mperiode", "mperiode");
    }

    public function index()
    {
        $this->data['titlehead'] = "Karyawan";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/employee.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option tipe dokumen
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company = [];
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        $this->_render_page('vemployee_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->memp->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->memp->get_cnt($filters);
        $totaldata = $this->memp->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->emp_id);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/employee/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/employee/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

//            $aktif = ($row->active) ? anchor("reference/position/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
//                anchor("reference/position/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            $obj = [];
            $obj['emp_id'] = $row->emp_id;
            $obj['emp_name'] = $row->emp_name;
            $obj['nik'] = $row->nik_pegawai;
            $obj['pegawai_id'] = $row->nik;
            $obj['email'] = $row->email;
            $obj['position_desc'] = $row->position_desc;
            $obj['unitName'] = $row->unitName;
            $obj['aksi'] = $btnAction;
            $obj['unitId'] = $row->unitId;
            $obj['compId'] = $row->COMPID;
            $obj['comp_name'] = $row->comp_name;
            $obj['positionId'] = $row->positionId;
            $obj['fid'] = $row->fid;
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
            $this->data['titlehead'] = "Edit Karyawan";
        } else {
            $this->data['titlehead'] = "Input Karyawan";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->nik = null;
        $stdClass->nik_pegawai = null;
        $stdClass->emp_name = null;
        $stdClass->email = null;
        $stdClass->COMPID = null;
        $stdClass->comp_code = null;
        $stdClass->unitId = null;
        $stdClass->positionId = null;
        $stdClass->position_code = null;
        $stdClass->kantor_id = null;
        $stdClass->company_begin = null;
        $stdClass->company_last = null;
        $stdClass->hp1 = null;
        $stdClass->jns_kelamin = null;
        $stdClass->tgl_lahir = null;
        $stdClass->tmp_lahir = null;
        $stdClass->p_alamat = null;
        $stdClass->p_kota = null;
        $stdClass->p_propinsi = null;
        $stdClass->p_kodepos = null;
        $stdClass->ktp = null;
        $stdClass->fid = null;

        

        $stdClass->religion_id = null;
        $stdClass->education = null;
        $stdClass->edu_name = null;
        $stdClass->status_nikah = null;
        $stdClass->jml_anak = null;
        $stdClass->gol_darah = null;
        $stdClass->npwp = null;
        $stdClass->no_bpjstk = null;
        $stdClass->no_bpjskes = null;
        $stdClass->no_aia = null;
        $stdClass->no_asuransi = null;

        //LAMPIRAN
        $stdClass->url_ktp = null;
        $stdClass->url_npwp = null;
        $stdClass->url_sim = null;
        $stdClass->url_bpjstk = null;
        $stdClass->url_bpjskes = null;
        $stdClass->url_aia = null;
        $stdClass->url_asuransi = null;
        $stdClass->url_profile = null;

        //Konfigurasi
        $stdClassKonfig = new stdClass();
        $stdClassKonfig->stat_sales = null;
        $stdClassKonfig->nik_atasan = null;
        $stdClassKonfig->nama_atasan_langsung = null;
        $stdClassKonfig->nik_hc = null;
        $stdClassKonfig->nik_staff = null;
        

        if ($id !== 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->memp->get($id);
            
            $stdClassKonfig =  $this->memp->getKonfigurasi($id,$stdClass->COMPID);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            $this->form_validation->set_rules('nik_pegawai', 'NIK', 'required');
            $this->form_validation->set_rules('emp_name', 'Nama', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('COMPID', 'Company', 'required');
            $this->form_validation->set_rules('unitId', 'Organisasi', 'required');
            $this->form_validation->set_rules('kantor_id', 'Kantor', 'required');
            $this->form_validation->set_rules('position_code', 'Posisi', 'required');
            $this->form_validation->set_rules('hp1', 'Nomor Hanphone', 'required');

            // POSTING VARIABLE
            $stdClass->nik = trim($this->input->post('nik'));
            $stdClass->nik_pegawai = trim($this->input->post('nik_pegawai'));
            $stdClass->emp_name = trim($this->input->post('emp_name'));
            $stdClass->email = trim($this->input->post('email'));
            $stdClass->COMPID = $this->input->post('COMPID');
            $stdClass->kantor_id = $this->input->post('kantor_id');
            $stdClass->unitId = $this->input->post('unitId');
            $stdClass->position_code = $this->input->post('position_code');
            $stdClass->company_begin = $this->input->post('company_begin');
            $stdClass->company_last = $this->input->post('company_last');
            $stdClass->jns_kelamin = $this->input->post('jns_kelamin');
            $stdClass->tgl_lahir = $this->input->post('tgl_lahir');
            $stdClass->tmp_lahir = $this->input->post('tmp_lahir');
            $stdClass->p_alamat = $this->input->post('p_alamat');
            $stdClass->p_kota = $this->input->post('p_kota');
            $stdClass->p_propinsi = $this->input->post('p_propinsi');
            $stdClass->p_kodepos = $this->input->post('p_kodepos');
            $stdClass->hp1 = $this->input->post('hp1');
            $stdClass->fid =  $this->input->post('fid');

            $stdClass->religion_id = $this->input->post('religion_id');
            $stdClass->education = $this->input->post('education');
            $stdClass->edu_name = $this->input->post('edu_name');
            $stdClass->status_nikah = $this->input->post('status_nikah');
            $stdClass->jml_anak = $this->input->post('jml_anak');
            $stdClass->gol_darah = $this->input->post('gol_darah');
            $stdClass->ktp = $this->input->post('ktp');
            $stdClass->npwp = $this->input->post('npwp');
            $stdClass->no_bpjstk = $this->input->post('no_bpjstk');
            $stdClass->no_bpjskes = $this->input->post('no_bpjskes');
            $stdClass->no_aia = $this->input->post('no_aia');
            $stdClass->no_asuransi = $this->input->post('no_asuransi');


            //KONFIGURASI 
            $stdClassKonfig->stat_sales = $this->input->post('stat_sales');
            $stdClassKonfig->nik_atasan = $this->input->post('nik_atasan');

            $ktp = $this->input->post('url_ktp');
            $sim = $this->input->post('url_sim');
            $npwp = $this->input->post('url_npwp');
            $bpjstk = $this->input->post('url_bpjstk');
            $bpjskes = $this->input->post('url_bpjskes');
            $aia = $this->input->post('url_aia');
            $asuransi = $this->input->post('url_asuransi');
            $profile = $this->input->post('url_profile');

            $dataJadwal = $this->input->post("hid_jadwal");
            $dataKeluarga = $this->input->post("hid_keluarga");
            $dataCutiAdjustment = $this->input->post("hid_cutiadjustment");
            //parsing JSON
            $dataRawJadwal = json_decode($dataJadwal, true);
            $dataRawKeluarga = json_decode($dataKeluarga, true);
            $dataRawCutiAdjustment = json_decode($dataCutiAdjustment, true);

            /*Attachment*/
            $success = true;
            $success_foto_ktp = false;
            $success_foto_sim = false;
            $success_foto_npwp = false;
            $success_foto_bpjstk = false;
            $success_foto_bpjskes = false;
            $success_foto_aia = false;
            $success_foto_asuransi = false;
            $success_foto_profile = false;

            if ($this->form_validation->run($this) === TRUE) {

                $isError = true;
                $isUpdate = false;
                $dataInTp = array();
                $dataIn = array();
                $dataIn["nik"] = $stdClass->nik;
                $dataIn["nik_pegawai"] = $stdClass->nik_pegawai;
                $dataIn["emp_name"] = $stdClass->emp_name;
                $dataIn["email"] = $stdClass->email;
                $dataIn["email_addr"] = $stdClass->email;
                $dataIn["COMPID"] = $stdClass->COMPID;
                $dataIn["unitId"] = $stdClass->unitId;
                $dataIn["position_code"] = $stdClass->position_code;
                $dataIn["kantor_id"] = $stdClass->kantor_id;
                $dataIn["company_begin"] = date("Y-m-d H:i:s", strtotime($stdClass->company_begin));
                $dataIn["company_last"] = date("Y-m-d H:i:s", strtotime($stdClass->company_last));
                $dataIn["jns_kelamin"] = $stdClass->jns_kelamin;
                $dataIn["tgl_lahir"] = date("Y-m-d H:i:s", strtotime($stdClass->tgl_lahir));
                $dataIn["tmp_lahir"] = $stdClass->tmp_lahir;
                $dataIn["p_alamat"] = $stdClass->p_alamat;
                $dataIn["p_kota"] = $stdClass->p_kota;
                $dataIn["p_propinsi"] = $stdClass->p_propinsi;
                $dataIn["p_kodepos"] = $stdClass->p_kodepos;
                $dataIn["hp1"] = $stdClass->hp1;
                $dataIn["imei1"] = $stdClass->hp1;
                $dataIn["fid"] = $stdClass->fid;

                $dataIn["religion_id"] = $stdClass->religion_id;
                $dataIn["education"] = $stdClass->education;
                $dataIn["edu_name"] = $stdClass->edu_name;
                $dataIn["status_nikah"] = $stdClass->status_nikah;
                $dataIn["jml_anak"] = $stdClass->jml_anak;
                $dataIn["gol_darah"] = $stdClass->gol_darah;
                $dataIn["ktp"] = $stdClass->ktp;
                $dataIn["npwp"] = $stdClass->npwp;
                $dataIn["no_bpjstk"] = $stdClass->no_bpjstk;
                $dataIn["no_bpjskes"] = $stdClass->no_bpjskes;
                $dataIn["no_aia"] = $stdClass->no_aia;
                $dataIn["no_asuransi"] = $stdClass->no_asuransi;
                
                $stdClassComp = $this->mcompany->get_data($stdClass->COMPID);
                $dataIn["comp_code"] = $stdClassComp->COMP_CODE;

                $nik = $stdClass->nik;
                $comp_code= $stdClassComp->COMP_CODE;

                //KONFIGURASI / PERSONALIZE

                $dataKonf["stat_sales"] =  ($stdClassKonfig->stat_sales == 1) ? 1 : 0;
                $dataKonf["nik_atasan"] =  $stdClassKonfig->nik_atasan;
                
                //ATTACHMENT

                //UPLOAD KTP
                if(isset($_FILES['foto_ktp']['name'])){
                    if($_FILES['foto_ktp']['name'] != ""){
                        $uploadfotoktp = $this->doUpload("foto_ktp", $nik, $comp_code);
                        $success_foto_ktp = $uploadfotoktp['success'];
                        $msg = (!$success) ? $uploadfotoktp['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD SIM
                if(isset($_FILES['foto_sim']['name'])){
                    if($_FILES['foto_sim']['name'] != ""){
                        $uploadfotosim = $this->doUpload("foto_sim", $nik, $comp_code);
                        $success_foto_sim = $uploadfotosim['success'];
                        $msg = (!$success) ? $uploadfotosim['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD NPWP
                if(isset($_FILES['foto_npwp']['name'])){
                    if($_FILES['foto_npwp']['name'] != ""){
                        $uploadfotonpwp = $this->doUpload("foto_npwp", $nik, $comp_code);
                        $success_foto_npwp = $uploadfotonpwp['success'];
                        $msg = (!$success) ? $uploadfotonpwp['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD BPJS TK
                if(isset($_FILES['foto_bpjs_tk']['name'])){
                    if($_FILES['foto_bpjs_tk']['name'] != ""){
                        $uploadfotobpjs_tk = $this->doUpload("foto_bpjs_tk", $nik, $comp_code);
                        $success_foto_bpjstk = $uploadfotobpjs_tk['success'];
                        $msg = (!$success) ? $uploadfotobpjs_tk['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD BPJS KESEHATAN
                if(isset($_FILES['foto_bpjs_kes']['name'])){
                    if($_FILES['foto_bpjs_kes']['name'] != ""){
                        $uploadfotobpjs_kes = $this->doUpload("foto_bpjs_kes", $nik, $comp_code);
                        $success_foto_bpjskes = $uploadfotobpjs_kes['success'];
                        $msg = (!$success) ? $uploadfotobpjs_kes['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD AIA
                if(isset($_FILES['foto_aia']['name'])){
                    if($_FILES['foto_aia']['name'] != ""){
                        $uploadfotoaia = $this->doUpload("foto_aia", $nik, $comp_code);
                        $success_foto_aia = $uploadfotoaia['success'];
                        $msg = (!$success) ? $uploadfotoaia['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD ASURANSI
                if(isset($_FILES['foto_asuransi']['name'])){
                    if($_FILES['foto_asuransi']['name'] != ""){
                        $uploadfotoasuransi = $this->doUpload("foto_asuransi", $nik, $comp_code);
                        $success_foto_asuransi = $uploadfotoasuransi['success'];
                        $msg = (!$success) ? $uploadfotoasuransi['message'] : "";
                        $msg_err=$msg;
                    }
                }

                //UPLOAD PROFILE
                if(isset($_FILES['foto_profile']['name'])){
                    if($_FILES['foto_profile']['name'] != ""){
                        $uploadfotoprofile = $this->doUpload("foto_profile", $nik, $comp_code);
                        $success_foto_profile = $uploadfotoprofile['success'];
                        $msg = (!$success) ? $uploadfotoprofile['message'] : "";
                        $msg_err=$msg;
                    }
                }

                $dataIn['url_ktp'] =  ($success_foto_ktp ? $uploadfotoktp['file_name'] : $ktp) ;
                $dataIn['url_sim'] =  ($success_foto_sim ? $uploadfotosim['file_name'] : $sim) ;
                $dataIn['url_npwp'] =  ($success_foto_npwp ? $uploadfotonpwp['file_name'] : $npwp) ;
                $dataIn['url_bpjstk'] =  ($success_foto_bpjstk ? $uploadfotobpjs_tk['file_name'] : $bpjstk) ;
                $dataIn['url_bpjskes'] =  ($success_foto_bpjskes ? $uploadfotobpjs_kes['file_name'] : $bpjskes) ;
                $dataIn['url_aia'] =  ($success_foto_aia ? $uploadfotoaia['file_name'] : $aia) ;
                $dataIn['url_asuransi'] =  ($success_foto_asuransi ? $uploadfotoasuransi['file_name'] : $asuransi);
                $dataIn['url_foto'] =  ($success_foto_profile ? $uploadfotoprofile['file_name'] : $profile);               
                


                //DETAIL 
                //TIME PROFILE
                /*
                $x=1;
                if($dataRawJadwal != null || $dataRawJadwal != ''){
                    $this->mtpp->delete_hist($stdClass->nik,$stdClass->COMPID);
                    foreach ($dataRawJadwal as $item) {
                        $dataInTp['tp_seq']  = $x;
                        $dataInTp['id_tp']  = $item['id'];
                        $dataInTp['nik']  = $stdClass->nik;
                        $dataInTp['compid']  = $stdClass->COMPID;
                        $dataInTp['comp_code']  = $stdClassComp->COMP_CODE;
                        $dataInTp['tp_start_date']  = date("Y-m-d H:i:s", strtotime($item['tgl_mulai_jdwl']));
                        $dataInTp['tp_end_date']  = date("Y-m-d H:i:s", strtotime($item['tgl_akhir_jdwl']));
                        $dataInTp['created_by']  = $this->session->userdata(sess_prefix()."userid");
                        $dataInTp['created_date']  = date("Y-m-d H:i:s");
                        $this->mtpp->insert($dataInTp);
                        $x++;
                    }
                }
                */

                //KELUARGA
                $x=1;
                if($dataRawKeluarga != null || $dataRawKeluarga != ''){
                    $this->mkel->delete_hist($stdClass->nik,$stdClass->COMPID);
                    foreach ($dataRawKeluarga as $itemKel) {
                        $dataInKel['seq']  = $x;
                        $dataInKel['nik']  = $stdClass->nik;
                        $dataInKel['compid']  = $stdClass->COMPID;
                        $dataInKel['comp_code']  = $stdClassComp->COMP_CODE;
                        $dataInKel['nama_kel']  = $itemKel['nama_kel'];
                        $dataInKel['relasi_kel']  = $itemKel['relasi_kel'];
                        $this->mkel->insert($dataInKel);
                        $x++;
                    }
                }else{
                    $this->mkel->delete_hist($stdClass->nik,$stdClass->COMPID);
                }

                //CUTI ADJUSTMENT
                $x=1;
                if($dataRawCutiAdjustment != null || $dataRawCutiAdjustment != ''){
                    $this->mcadj->delete_hist($stdClass->nik,$stdClass->COMPID);
                    foreach ($dataRawCutiAdjustment as $itemct) {
                        $dataInpCuti['seq']  = $itemct['seq_cutiadj'];
                        $dataInpCuti['nik']  = $stdClass->nik;
                        $dataInpCuti['compid']  = $stdClass->COMPID;
                        $dataInpCuti['comp_code']  = $stdClassComp->COMP_CODE;
                        $dataInpCuti['periode']  = $itemct['periode'];
                        $dataInpCuti['jml_cuti']  = $itemct['jml_cuti'];
                        $dataInpCuti['remark_adj']  = $itemct['remark_adj'];
                        $dataInpCuti['start_adj']  = date("Y-m-d H:i:s", strtotime($itemct['start_adj']));
                        $dataInpCuti['end_adj']  = date("Y-m-d H:i:s", strtotime($itemct['end_adj']));
                        $this->mcadj->insert($dataInpCuti);
                        $x++;
                    }
                }else{
                    $this->mcadj->delete_hist($stdClass->nik,$stdClass->COMPID);
                }
                //END DETAIL

                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;

                    if ($this->memp->update($id, $dataIn)) {


                        //UPDATE KONFIGURASI / PERSONALIZE
                        $stat_upd_konf = $this->memp->UpdateKonfigurasi($dataKonf,$nik,$comp_code);

                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Karyawan Diupdate");
                    }
                } else { // insert
                    if ($this->memp->insert($dataIn)) {


                        //INSERT KONFIGURASI

                        $dataInsKonf["comp_code"] =  $comp_code;
                        $dataInsKonf["nik_staff"] =  $nik;
                        $dataInsKonf["nik_atasan"] =  $stdClassKonfig->nik_atasan;
                        $dataInsKonf["stat_sales"] =  ($stdClassKonfig->stat_sales == 1) ? 1 : 0;
                        $stat_ins_konf = $this->memp->InsertKonfigurasi($dataInsKonf);

                        //END INSERT KONFIGURASI


                        //INSERT PENGGUNA//
                        $imei1 = trim($stdClass->hp1);
                        $hp1 = trim($stdClass->hp1);
                        $kode_aktif = password_hash($hp1.$this->generate(), PASSWORD_BCRYPT);
                        $dataInsPengguna = array();
                        $dataInsPengguna = array(
                            'compid' => $stdClass->COMPID,
                            'nik' => $nik,
                            'nama_user' => $stdClass->emp_name,
                            'email_addr' => $stdClass->email,
                            'kt_konci' => $hp1.$this->generate(),
                            'kode_aktif' => $kode_aktif,
                            'non_aktip' => 0,
                            'created_by' => 'REGISTER',
                            'created_date' => date('Y-m-d H:i:s'),
                            'tingkat' => 0,
                            'link_aktivasi' => 'http://presensikita.com/presensikita/aktivasi?hp1='.$hp1.'&kode_aktif='.$kode_aktif.'&imei1='.$imei1.'',
                        );
                        $stat_ins_pengguna = $this->memp->InsertPengguna($dataInsPengguna);


                        //END INSERT PENGGUNA

                        $isError = false;
                        $id = $stdClass->position_code;
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
                    redirect("reference/employee", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/employee_form.js',
            HTTP_JS_PATH.'jquery.inputmask.bundle.js'
            //HTTP_ASSET_PATH . 'bootstrap-datepicker/bootstrap-datetimepicker/bootstrap-datetimepicker.js',
            //HTTP_ASSET_PATH . 'bootstrap-datepicker/bootstrap-datetimepicker/locales/bootstrap-datetimepicker.id.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //display konfigure
        $this->data['stat_sales'] = array(
            'name' => 'stat_sales',
            'id' => 'stat_sales',
            'type' => 'checkbox',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('stat_sales', ($stdClassKonfig->stat_sales == 1) ? 1 : 0)
        );
        if(($stdClassKonfig->stat_sales == 1) ? $this->data['stat_sales']['checked'] = true : "");

        $this->data['nik_atasan'] = array(
            'name' => 'nik_atasan',
            'id' => 'nik_atasan',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('nik_atasan', $stdClassKonfig->nik_atasan)
        );

        $this->data['nama_atasan_langsung'] = array(
            'name' => 'nama_atasan_langsung',
            'id' => 'nama_atasan_langsung',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('nama_atasan_langsung', $stdClassKonfig->nama_atasan_langsung)
        );

        //display the form
        $this->data['nik'] = array(
            'name' => 'nik',
            'id' => 'nik',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '20',
            'value' => $this->form_validation->set_value('nik', $stdClass->nik)
        );
        $this->data['nik_pegawai'] = array(
            'name' => 'nik_pegawai',
            'id' => 'nik_pegawai',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '20',
            'value' => $this->form_validation->set_value('nik_pegawai', $stdClass->nik_pegawai)
        );
        $this->data['emp_name'] = array(
            'name' => 'emp_name',
            'id' => 'emp_name',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('emp_name', $stdClass->emp_name)
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('email', $stdClass->email)
        );
        $this->data['company_begin'] = array(
            'name' => 'company_begin',
            'id' => 'company_begin',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('company_begin', $stdClass->company_begin)
        );
        $this->data['company_last'] = array(
            'name' => 'company_last',
            'id' => 'company_last',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('company_last', $stdClass->company_last)
        );

        $list_jnskelamin[null] = "Pilih Jenis Kelamin";
        $list_jnskelamin[1] = "Laki-laki";
        $list_jnskelamin[2] = "Perempuan";

        $this->data['jns_kelamin'] = array(
            'name' => 'jns_kelamin',
            'id' => 'jns_kelamin',
            'options' => $list_jnskelamin,
            'value' => $this->form_validation->set_value('jns_kelamin', $stdClass->jns_kelamin),
            'class' => 'form-control'
        );

        $this->data['tgl_lahir'] = array(
            'name' => 'tgl_lahir',
            'id' => 'tgl_lahir',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('tgl_lahir', $stdClass->tgl_lahir)
        );

        $this->data['tmp_lahir'] = array(
            'name' => 'tmp_lahir',
            'id' => 'tmp_lahir',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('tmp_lahir', $stdClass->tmp_lahir)
        );

        $this->data['p_alamat'] = array(
            'name' => 'p_alamat',
            'id' => 'p_alamat',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('p_alamat', $stdClass->p_alamat)
        );

        $this->data['p_kota'] = array(
            'name' => 'p_kota',
            'id' => 'p_kota',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '100',
            'value' => $this->form_validation->set_value('p_kota', $stdClass->p_kota)
        );

        $this->data['p_propinsi'] = array(
            'name' => 'p_propinsi',
            'id' => 'p_propinsi',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '100',
            'value' => $this->form_validation->set_value('p_propinsi', $stdClass->p_propinsi)
        );

        $this->data['p_kodepos'] = array(
            'name' => 'p_kodepos',
            'id' => 'p_kodepos',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('p_kodepos', $stdClass->p_kodepos)
        );

        $this->data['hp1'] = array(
            'name' => 'hp1',
            'id' => 'hp1',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '30',
            'value' => $this->form_validation->set_value('hp1', $stdClass->hp1)
        );

        $this->data['fid'] = array(
            'name' => 'fid',
            'id' => 'fid',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '10',
            'value' => $this->form_validation->set_value('fid', $stdClass->fid)
        );

        $list_agama[null] = "Pilih Agama";
        $list_agama[1] = "Islam";
        $list_agama[2] = "Kristen Protestan";
        $list_agama[3] = "Kristen Katolik";
        $list_agama[4] = "Budha";
        $list_agama[5] = "Hindu";
        $list_agama[6] = "Konghucu";

        $this->data['religion_id'] = array(
            'name' => 'religion_id',
            'id' => 'religion_id',
            'options' => $list_agama,
            'value' => $this->form_validation->set_value('religion_id', $stdClass->religion_id),
            'class' => 'form-control'
        );

        $this->data['education'] = array(
            'name' => 'education',
            'id' => 'education',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('education', $stdClass->education)
        );

        $this->data['edu_name'] = array(
            'name' => 'edu_name',
            'id' => 'edu_name',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('edu_name', $stdClass->edu_name)
        );

        $this->data['edu_name'] = array(
            'name' => 'edu_name',
            'id' => 'edu_name',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '150',
            'value' => $this->form_validation->set_value('edu_name', $stdClass->edu_name)
        );

        $list_status[null] = "Pilih Status";
        $list_status[1] = "Belum Menikah";
        $list_status[2] = "Menikah";
        $list_status[3] = "Duda/Janda";

        $this->data['status_nikah'] = array(
            'name' => 'status_nikah',
            'id' => 'status_nikah',
            'options' => $list_status,
            'value' => $this->form_validation->set_value('status_nikah', $stdClass->status_nikah),
            'class' => 'form-control'
        );

        $this->data['jml_anak'] = array(
            'name' => 'jml_anak',
            'id' => 'jml_anak',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '2',
            'value' => $this->form_validation->set_value('jml_anak', $stdClass->jml_anak)
        );

        $this->data['gol_darah'] = array(
            'name' => 'gol_darah',
            'id' => 'gol_darah',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '2',
            'value' => $this->form_validation->set_value('gol_darah', $stdClass->gol_darah)
        );

        $this->data['ktp'] = array(
            'name' => 'ktp',
            'id' => 'ktp',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('ktp', $stdClass->ktp)
        );

        $this->data['npwp'] = array(
            'name' => 'npwp',
            'id' => 'npwp',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('npwp', $stdClass->npwp)
        );

        $this->data['no_bpjstk'] = array(
            'name' => 'no_bpjstk',
            'id' => 'no_bpjstk',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('no_bpjstk', $stdClass->no_bpjstk)
        );

        $this->data['no_bpjskes'] = array(
            'name' => 'no_bpjskes',
            'id' => 'no_bpjskes',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('no_bpjskes', $stdClass->no_bpjskes)
        );

        $this->data['no_aia'] = array(
            'name' => 'no_aia',
            'id' => 'no_aia',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('no_aia', $stdClass->no_aia)
        );

        $this->data['no_asuransi'] = array(
            'name' => 'no_asuransi',
            'id' => 'no_asuransi',
            'type' => 'text',
            'class' => 'form-control',
            'maxLength' => '50',
            'value' => $this->form_validation->set_value('no_asuransi', $stdClass->no_asuransi)
        );

        // select option company
        $this->data['filtertmp'] = array(
            0 => array(
                    'field' => "a.compid",
                    'type' => "=",
                    'value' => $stdClass->COMPID //$this->session->userdata(sess_prefix()."compId")
                )
        );

        $timeprofile = $this->mtmp->get(null, null, 999999, null, $this->data['filtertmp']);
        
        $list_timeprofile[null] = "Pilih Jadwal Kerja";
        foreach ($timeprofile as $row_jdwl) {
            $list_timeprofile[$row_jdwl->id_tp] = $row_jdwl->deskripsi;
        }

        // $this->data['id_tp'] = array(
        //     'name' => 'id_tp',
        //     'id' => 'id_tp',
        //     'options' => $list_timeprofile,
        //     'class' => 'form-control'
        // );

        // select option kantor
        $this->data['id_tp'] = array(
            'name' => 'id_tp',
            'id' => 'id_tp',
            //'value' => $this->form_validation->set_value('kantor_id', $stdClass->kantor_id),
            'class' => 'form-control col-md-12'
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
        $this->data['position_code'] = array(
            'name' => 'position_code',
            'id' => 'position_code',
            'value' => $this->form_validation->set_value('position_code', $stdClass->position_code),
            'class' => 'form-control col-md-12'
        );

        // select option unit
        $this->data['unitId'] = array(
            'name' => 'unitId',
            'id' => 'unitId',
            'value' => $this->form_validation->set_value('unitId', $stdClass->unitId),
            'class' => 'form-control col-md-12'
        );

        // select option kantor
        $this->data['kantor_id'] = array(
            'name' => 'kantor_id',
            'id' => 'kantor_id',
            'value' => $this->form_validation->set_value('kantor_id', $stdClass->kantor_id),
            'class' => 'form-control col-md-12'
        );

        //Detail jadwal kerja
        $this->data['filtertimeperson'] = array(
            0 => array(
                    'field' => "a.compid",
                    'type' => "=",
                    'value' => $stdClass->COMPID
            ),
            1 => array(
                'field' => "a.nik",
                'type' => "=",
                'value' => $stdClass->nik
            )
        );
        

        //Detail Keluarga
        $this->data['filterkeluarga'] = array(
            0 => array(
                    'field' => "a.compid",
                    'type' => "=",
                    'value' => $stdClass->COMPID
            ),
            1 => array(
                'field' => "a.nik",
                'type' => "=",
                'value' => $stdClass->nik
            )
        );

        $keluarga = $this->mkel->get(null, null, 999999, null, $this->data['filterkeluarga']);

        $this->data['keluarga'] = $keluarga;

        $list_kel = $keluarga;
        $build_array_kel = [];
        $seq_item = 1;
        foreach ($list_kel as $mKel) {
            array_push($build_array_kel,
                array(
                    'seq' => $mKel->seq,
                    'nama_kel' => $mKel->nama_kel,
                    'relasi_kel' => $mKel->relasi_kel
                )
            );
        }
        $kels = json_encode($build_array_kel);
        $this->data['kels'] = $kels;

        $this->data['hid_keluarga'] = array(
            'name' => 'hid_keluarga',
            'id' => 'hid_keluarga',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('kels', $kels)
        );
        //End Detail Keluarga


        //Detail Cuti Adjutment
        $this->data['filtercutiadjustment'] = array(
            0 => array(
                    'field' => "a.compid",
                    'type' => "=",
                    'value' => $stdClass->COMPID
            ),
            1 => array(
                'field' => "a.nik",
                'type' => "=",
                'value' => $stdClass->nik
            )
        );

        $cutiadjustment = $this->mcadj->get(null, null, 999999, null, $this->data['filtercutiadjustment']);
        $this->data['cutiadjustment'] = $cutiadjustment;

        $list_cutiadjustment = $cutiadjustment;
        $build_array_cutiadj = [];
        $seq_item = 1;
        foreach ($list_cutiadjustment as $mCutiAdj) {
            array_push($build_array_cutiadj,
                array(
                    'seq_cutiadj' => $mCutiAdj->seq,
                    'periode' => $mCutiAdj->periode,
                    'jml_cuti' => $mCutiAdj->jml_cuti,
                    'remark_adj' => $mCutiAdj->remark_adj,
                    'start_adj' => $mCutiAdj->start_adj,
                    'end_adj' => $mCutiAdj->end_adj
                )
            );
        }
        $cutiadjs = json_encode($build_array_cutiadj);
        $this->data['cutiadjs'] = $cutiadjs;

        $this->data['hid_cutiadjustment'] = array(
            'name' => 'hid_cutiadjustment',
            'id' => 'hid_cutiadjustment',
            'type' => 'hidden',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('cutiadjs', $cutiadjs)
        );

        //End Detail Cuti Adjutment

        $this->data['comp_code'] = $stdClass->comp_code;
        $this->data['url_ktp'] = $stdClass->url_ktp;
        $this->data['url_npwp'] = $stdClass->url_npwp;
        $this->data['url_sim'] = $stdClass->url_sim;
        $this->data['url_bpjstk'] = $stdClass->url_bpjstk;
        $this->data['url_bpjskes'] = $stdClass->url_bpjskes;
        $this->data['url_aia'] = $stdClass->url_aia;
        $this->data['url_asuransi'] = $stdClass->url_asuransi;
        $this->data['url_profile'] = $stdClass->url_profile;


        // option periode
        $mperiodes = $this->mperiode->get_data(null,0, 999999);
        $list_periode[null] = "Pilih Periode";
        foreach ($mperiodes as $row) {
            $list_periode[$row->periode_id] = $row->periode_nama;
        }

        $this->data['periode_id'] = array(
            'name' => 'periode_id',
            'id' => 'periode_id',
            'options' => $list_periode,
            'class' => 'form-control'
        );

        // option bulan
        $list_bulan[null] = "Pilih Bulan";
        $list_bulan[1] = "Januari";
        $list_bulan[2] = "Februari";
        $list_bulan[3] = "Maret";
        $list_bulan[4] = "April";
        $list_bulan[5] = "Mei";
        $list_bulan[6] = "Juni";
        $list_bulan[7] = "Juli";
        $list_bulan[8] = "Agustus";
        $list_bulan[9] = "September";
        $list_bulan[10] = "Oktober";
        $list_bulan[11] = "Nopember";
        $list_bulan[12] = "Desember";

        $this->data['bulan_id'] = array(
            'name' => 'bulan_id',
            'id' => 'bulan_id',
            'options' => $list_bulan,
            'class' => 'form-control'
        );

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('reference/vemployee_form', $this->data, false, 'tmpl/vwbacktmpl');
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
        redirect("reference/employee", 'refresh');
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
        redirect("reference/employee", 'refresh');
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


    public function get_node_kantor() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.COMPID', 'value' => $COMPID]
            ];
            $results = $this->mktr->get(null, 0, 999999, null, $filters);

            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->kantor_id;
                    $arr['parentId'] = $row->kantor_id;
                    $arr['unitName'] = "{$row->nama_kantor}";
                    $output[] = $arr;
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function get_node_jadwal() {

        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.COMPID', 'value' => $COMPID]
            ];
            $results = $this->mtmp->get(null, 0, 999999, null, $filters);

            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->id_tp;
                    $arr['parentId'] = $row->id_tp;
                    $arr['unitName'] = "{$row->deskripsi}";
                    $output[] = $arr;
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }


    public function get_node_employee() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        $UNITID = intval($this->input->post('UNITID'));

        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'a.compid', 'type' => '=', 'value' => $COMPID]
            ];
        }

        if (!empty($UNITID)) {
            $filters = [
                ['field' => 'a.unitid', 'type' => '=', 'value' => $UNITID]
            ];
        }

        if (!empty($UNITID) && !empty($COMPID)) {
            $filters = [
                ['field' => 'a.compid', 'type' => '=', 'value' => $COMPID],
                ['field' => 'a.unitid', 'type' => '=', 'value' => $UNITID]
            ];
        }


        if (!empty($COMPID)) {

            $results = $this->memp->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['emp_id'] = $row->emp_id;
                    $arr['emp_name'] = $row->nik_pegawai." - ".strtoupper($row->emp_name);
                    $output[] = $arr;
                }
                $out = $output;
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

            case 'SUCCESS_SINKRONISASI':
                $title = 'Sinkronisasi Berhasil';
                $message = 'Sinkronisasi data berhasil dilakukan.';
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

            case 'FAILED_SINKRONISASI':
                $title = 'Sinkronisasi Gagal';
                $message = 'Sinkronisasi data gagal !';
                $icons = '';
                break;

            case 'ERROR_VALIDATION':
                $title = '';
                break;
        }

        return message_box($title, $message, $mode, $icons, $fadeOut);
    }


    private function doUpload($file, $nik, $comp_code) {
        $this->load->library('upload');
        $this->load->library('image_lib');


        $response = array();
        $new_name = '';

        //$config['upload_path'] = dirname($_SERVER['SCRIPT_FILENAME']).'/assets/upload/konfirmasi/';
        //$config['upload_path'] = 'C:/WEB/uploads/filesdoc/'.$apl_id.'-'.$plg_id;
        //$config['upload_path'] = '/var/www/seuneu.trisula.com/html/uploads/absensi/';
        //$config['upload_path'] = '/uploads/absensi'; 
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '20971520';

        //$config['max_size'] = '2048';
        //$config['max_size'] = '2603471';

        $pfx="";
        switch($file){
            case "foto_ktp" : $pfx="_ktp"; $config['upload_path'] = upload_path.'personal/ktp/'.$comp_code.'/'; break;
            case "foto_sim" : $pfx="_sim"; $config['upload_path'] = upload_path.'personal/sim/'.$comp_code.'/'; break;
            case "foto_npwp" : $pfx="_npwp"; $config['upload_path'] = upload_path.'personal/npwp/'.$comp_code.'/'; break;
            case "foto_bpjs_tk" : $pfx="_bpjs_tk"; $config['upload_path'] = upload_path.'personal/bpjs_tk/'.$comp_code.'/'; break;
            case "foto_bpjs_kes" : $pfx="_bpjs_kes"; $config['upload_path'] = upload_path.'personal/bpjs_kes/'.$comp_code.'/'; break;
            case "foto_aia" : $pfx="_aia"; $config['upload_path'] = upload_path.'personal/aia/'.$comp_code.'/'; break;
            case "foto_asuransi" : $pfx="_asuransi"; $config['upload_path'] = upload_path.'personal/asuransi/'.$comp_code.'/'; break;
            case "foto_profile" : $pfx="_profile"; $config['upload_path'] = upload_path.'personal/photo/'; break;
            default: $pfx="err"; break;
        }

        $new_name = str_replace(":","_",trim($_FILES[$file]['name']));
        $new_name = date('Ymd His') ."_".$pfx."_".$nik."_".$comp_code."_".$new_name;
        $new_name = str_replace(" ","_",$new_name);

        $config['file_name']        = $new_name;
        $config['image_library']    = 'GD2';
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 20;
        $config['height']           = 20;
        $this->upload->initialize($config);
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();

        
        $success = true;
        $msg = '';
        try{
            $this->upload->do_upload($file);
            $msg = 'Upload successfully!';
        }catch(Exception $e){
            $success = false;
            $msg = $e->getMessage();
        }
        
        $response['success'] = $success;
        $response['file_name'] = $new_name;
        $response['message'] = $msg.';'.$new_name;
        
        return $response;
    }

    public function generate(){
    	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'!@#$%^&*()'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

		return $rand;
    }

    // SINKRONISASI

    public function sinkronUnitKerja(){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://api.rsmb.co.id:4848/app/sdi/get_master_unit_kerja',
            // CURLOPT_URL => 'http://localhost/rsmb/api/public/app/sdi/get_master_unit_kerja',
            CURLOPT_URL => API_SIMRS.'app/sdi/get_master_unit_kerja',

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

        $arrData = json_decode($response, true);
        $resData = ($arrData['response']['data']);
        // echo '<pre>';
        // print_r($resData);
        // die();
        
        foreach ($resData as $rowUnit){
            $this->mcompany->insertUnitKerja($rowUnit['kode'], $rowUnit['nama_unit_kerja']);
        }
    }

    public function sinkronJabatan(){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://api.rsmb.co.id:4848/app/sdi/get_master_jabatan',
            // CURLOPT_URL => 'http://localhost/rsmb/api/public/app/sdi/get_master_jabatan',
            CURLOPT_URL => API_SIMRS.'app/sdi/get_master_jabatan',

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

        $arrData = json_decode($response, true);
        $resData = ($arrData['response']['data']);

        
        
        foreach ($resData as $rowJab){
            $this->mcompany->insertJabatan($rowJab['kode'], $rowJab['nama_jabatan'], $rowJab['tipe'], $rowJab['jabatan_tipe']);
        }

    }

    public function sinkronPegawai(){
        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://api.rsmb.co.id:4848/app/sdi/get_pegawai_aktif',
            // CURLOPT_URL => 'http://localhost/rsmb/api/public/app/sdi/get_pegawai_aktif',
            CURLOPT_URL => API_SIMRS.'app/sdi/get_pegawai_aktif',

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


        $this->sinkronUnitKerja();
        $this->sinkronJabatan();
        $stat_sinkron = $this->mcompany->TruncatePegawai(1);

        $arrData = json_decode($response, true);
        $resData = ($arrData['response']['data']);
        $x =1;
        foreach ($resData as $rowPeg){
            //if($x <= 1){
                $stat_sinkron = $this->mcompany->insertPegawai($rowPeg['pegawai_id'],  $rowPeg['fid'],  $rowPeg['nik'],  $rowPeg['nik_ktp'],  $rowPeg['nama'], 
                $rowPeg['jenkel'],  $rowPeg['tempat_lahir'],  $rowPeg['tgl_lahir'],  $rowPeg['agama'],  $rowPeg['status_kawin'], 
                $rowPeg['pendidikan'],  $rowPeg['alamat_dom'],  $rowPeg['rt_dom'],  $rowPeg['rw_dom'],  $rowPeg['kel_dom'],  
                $rowPeg['kec_dom'],  $rowPeg['kab_dom'],  $rowPeg['prov_dom'],  $rowPeg['alamat_ktp'],  $rowPeg['rt_ktp'], 
                $rowPeg['rw_ktp'],  $rowPeg['kel_ktp'],  $rowPeg['kec_ktp'],  $rowPeg['kab_ktp'],  $rowPeg['prov_ktp'], 
                $rowPeg['no_telp'],  $rowPeg['no_hp'],  $rowPeg['no_wa'],  $rowPeg['email'],  $rowPeg['unit_kerja'],  
                $rowPeg['sk'],  $rowPeg['jabatan'],  $rowPeg['golongan'],  $rowPeg['tahun'],  $rowPeg['tgl_pensiun'], 
                $rowPeg['fasilitas_perawatan'],  $rowPeg['ptkp'],  $rowPeg['status'],  $rowPeg['nama_unit_kerja'],  $rowPeg['nama_jabatan'], 
                $rowPeg['nama_golongan'],  $rowPeg['nama_agama'],  $rowPeg['nama_pendidikan'],  $rowPeg['jenis_sk'],  $rowPeg['status_pegawai'], 
                $rowPeg['gol_darah'],  $rowPeg['id_lama'],  $rowPeg['tgl_masuk']);
            //}
            $x++;
        }

        $stat_sinkron = $this->mcompany->SinkronisasiPegawai(1);

        if($stat_sinkron){
            $sinkron = 1;
        }else{
            $sinkron = 0;
        }
        
        if($sinkron == 1){
            $success_msg = "SUCCESS_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("reference/employee", 'refresh');
        }else{
            $success_msg = "FAILED_SINKRONISASI";
            $success_msg = $this->_get_message($success_msg);
            $this->session->set_flashdata('message', $success_msg);
            redirect("reference/employee", 'refresh');
        }


    }

}
