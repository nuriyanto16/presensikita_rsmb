<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Periode_risiko
 * @property Mmasa_akses_input $Mmasa_akses_input
 */
class Masa_akses_input extends Mst_controller
{
    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_REF_MASA_AKSES_INPUT";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mmasa_akses_input", "makses");
        $this->load->model("Mperiode_risiko", "mperiode");
        $this->load->model("utility/Muser_manage", "muser_manage");
        $this->load->model("Mcompany", "mcompany");
    }

    public function index(){
        $this->data['titlehead'] = "Masa Akses Input Risiko";

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/reference/akses_input.js'
        );
        $this->data['loadfoot'] = $loadfoot;
        $this->data['perusahaan'] = $this->muser_manage->company();

        $this->_render_page('vakses_input_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    // table _akses_risiko_awal
    public function lists()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->makses->get_data1(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->makses->get_data_cnt1($filters);
        $totaldata = $this->makses->get_data_cnt1();
        $maxpage = ceil($totalfiltered / $limit);
        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->akses_risiko_awal_id);
            $ciri = $this->qsecure->encrypt(1);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/masa_akses_input/edit_form/'.$ciri.'/';
                $atr_edit['class'] = '';
            }

            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/masa_akses_input/delete/'.$ciri.'/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

        //            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
        //                anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $id,
                    "aksi" => $btnAction,
                    "periode_nama" => $row->periode_nama,
                    "start_date" => fdate_eng_to_ind($row->start_date),
                    "end_date" => fdate_eng_to_ind($row->end_date),
                )
            );
        }

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }
    // end table _akses_risiko_awal

    // table _akses_risiko_awal_unlock
    public function lists2()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->makses->get_data2(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->makses->get_data_cnt2($filters);
        $totaldata = $this->makses->get_data_cnt2();
        $maxpage = ceil($totalfiltered / $limit);
        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->akses_risiko_awal_unlock_id);
            $ciri = $this->qsecure->encrypt(2);
            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/masa_akses_input/edit_form/'.$ciri.'/';
                $atr_edit['class'] = '';
            } 

            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/masa_akses_input/delete/'.$ciri.'/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            } 

            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

        //            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
        //            anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $id,
                    "aksi" => $btnAction,
                    "unitNama" => $row->unitCode ." - ".$row->unitName,
                    "periode_nama" => $row->periode_nama,
                    "start_date" => fdate_eng_to_ind($row->start_date),
                    "end_date" => fdate_eng_to_ind($row->end_date),
                )
            );
        }

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }
    // end table _akses_risiko_awal_unlock

    // table _akses_risiko_mon
    public function lists3()
    {
        $id_awal = $this->qsecure->decrypt($this->uri->segment(4));
        $detAwal = $this->makses->get_data1($id_awal);
        
        $where = $detAwal->periode_risiko_id;
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->makses->get_data3(null, $start, $limit, $order, $filters, $where);
        $totalfiltered = $this->makses->get_data_cnt3($filters);
        $totaldata = $this->makses->get_data_cnt3();
        $maxpage = ceil($totalfiltered / $limit);
        if(!empty($where)){
            $build_array = array(
                "last_page" => $maxpage,
                "recordsTotal" => $totaldata,
                "recordsFiltered" => $totalfiltered,
                "data" => array()
            );

       
            foreach ($results as $row) {
                $id = $this->qsecure->encrypt($row->akses_risiko_mon_id);

                if ($this->_edit) {
                   $edit_btn = '<li><a href="#" onclick="insertModal(`'.$id.'`)"><i class="fa fa-edit"></i> Edit</a></li>';
                } else {
                    $edit_btn = '<li><a href="#"><i class="fa fa-edit"></i> Edit (No Access)</a></li>';
                }

                if ($this->_delete) {
                    $del_btn = '<li><a href="#" onclick="hapus(`'.$id.'`)"><i class="fa fa-trash"></i> Hapus </a></li>';
                } else {
                    $del_btn = '<li><a href="#"><i class="fa fa-trash"></i> Hapus (No Access)</a></li>';
                }

                $btnAction = '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-gear"></i> Aksi <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-act" role="menu"> ';
                $btnAction .= $edit_btn." ".$del_btn ;
                $btnAction .= '  </ul>
                        </div>';

                // $btnAction = btn_action_group($id, $atr_edit, $atr_del);

            //            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
            //                anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

                array_push($build_array["data"],
                    array(
                        "DT_RowId" => $id,
                        "aksi" => $btnAction,
                        "periode_tahun" => date('Y', strtotime($row->start_date)),
                        "periode_bulan" => bulan($row->periode_bulan),
                        "start_date" => fdate_eng_to_ind($row->start_date),
                        "end_date" => fdate_eng_to_ind($row->end_date),
                    )
                );
            }
        }else{
            $build_array = array(
                "last_page" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array()
            );
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }
    // end table _akses_risiko_mon

    // table _akses_risiko_monitoring_unlock
    public function lists4()
    {
        $start = $this->input->post('start');
        $limit = $this->input->post('length');
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');

        $results = $this->makses->get_data4(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->makses->get_data_cnt4($filters);
        $totaldata = $this->makses->get_data_cnt4();
        $maxpage = ceil($totalfiltered / $limit);
        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->akses_risiko_mon_unlock_id);
            $ciri = $this->qsecure->encrypt(4);
            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'reference/masa_akses_input/edit_form/'.$ciri.'/';
                $atr_edit['class'] = '';
            }

            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'reference/masa_akses_input/delete/'.$ciri.'/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus data ?')";
            } 

            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

        //            $aktif =  ($row->active) ? anchor("reference/company/deactivate/{$id}", "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan data ?');")) :
        //            anchor("reference/company/activate/{$id}    ", "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan data ?');"));

            array_push($build_array["data"],
                array(
                    "DT_RowId" => $id,
                    "aksi" => $btnAction,
                    "unitNama" => $row->unitCode." - ".$row->unitName,
                    "periode_nama" => date('Y', strtotime($row->start_date)),
                    "periode_bulan" => bulan($row->periode_bulan),
                    "start_date" => fdate_eng_to_ind($row->start_date),
                    "end_date" => fdate_eng_to_ind($row->end_date),
                )
            );
        }

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }
    // end table _akses_risiko_monitoring_unlock

    public function edit_form()
    {
        $id = 0;
        $ids = trim($this->uri->segment(5));
        $ciri = $this->qsecure->decrypt(trim($this->uri->segment(4))); 
        if($ciri == 1){
            $this->akses_awal_risiko($id, $ids);
        }else if($ciri == 2){
            $this->akses_awal_risiko_unlock($id, $ids);
        }else if($ciri == 4){
            $this->akses_mon_risiko_unlock($id, $ids);
        }
    }

    // edit_form akses_awal_risiko dan auto genereate akses_mon_risiko
    public function akses_awal_risiko($id, $ids){
        $this->data['id'] = $ids;
        if (!empty($this->data['id'])) {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Masa Akses Input Awal";
        } else {
            $this->data['titlehead'] = "Insert Masa Akses Input Awal";
        }

        // default value
        $stdClass = new stdClass();
        // $stdClass->periode_risiko_nama = '';
        $stdClass->periode_risiko_id = '';
        $stdClass->start_date = '';
        $stdClass->end_date = '';

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->makses->get_data1($id);
            $stdClass->start_date = fdate_eng_to_ind($stdClass->start_date);
            $stdClass->end_date = fdate_eng_to_ind($stdClass->end_date);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('periode_risiko_id', 'Periode Risiko', 'required');
            $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required');

            // POSTING VARIABLE
            $stdClass->periode_risiko_id = $this->input->post('periode_risiko_id');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
               
                $tglAwal = date('Y-m-d', strtotime($stdClass->start_date));
                $tglAkhir = date('Y-m-d', strtotime($stdClass->end_date));
                $dataIn["start_date"] = $tglAwal;
                $dataIn["end_date"] = $tglAkhir;

                $userId =  $this->session->userdata($this->config->item('sess_prefix', 'ion_auth') . 'userid');
                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    $dataIn['updated_by'] = $userId;
                    $dataIn['updated_date'] = date('Y-m-d H:i:s');
                    $result = $this->db->update('_akses_risiko_awal', $dataIn, array('akses_risiko_awal_id' => $id));
                    // if ($this->makses->update($id, $dataIn)) {
                    if ($result) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Diupdate");
                    }
                } else { // insert
                  $dataIn["periode_risiko_id"] = $stdClass->periode_risiko_id;
                  $dataIn['created_by'] = $userId;
                  $dataIn['created_date'] = date('Y-m-d H:i:s');
                  $data_periode = $this->mperiode->get_data($stdClass->periode_risiko_id);
                  $tAwal = $data_periode->start_date;
                  $tAkhir = $data_periode->end_date;
                  //proses insert 
                    $return = false;
                    $this->db->trans_begin();

                    $Head = $this->db->insert('_akses_risiko_awal', $dataIn);
                    $mulai = date('Y-m', strtotime($tAwal));
                    $selesai = date('Y-m', strtotime($tAkhir));
                    $i=0;
                    while($mulai <= $selesai) { 
                        if($i == 0){
                            $start_date = $tAwal;
                            $end_date = date('Y-m-t', strtotime($tAwal));
                        }else if($mulai == $selesai){
                            $start_date = date('Y-m-01', strtotime($tAkhir));
                            $end_date = $tAkhir;
                        }else{
                            $start_date = date('Y-m-01', strtotime($mulai));
                            $end_date = date('Y-m-t', strtotime($mulai));
                        }
                        
                        
                        $dataDet = array(
                            'periode_risiko_id' => $stdClass->periode_risiko_id, 
                            'periode_bulan' => date('m', strtotime($mulai)),
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'created_by' => $userId,
                            'created_date' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('_akses_risiko_mon', $dataDet);
                        
                        $mulai = date('Y-m', strtotime("+1 month", strtotime($mulai)));
                        $i++;
                    }

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $return = false;
                    } else {
                        $this->db->trans_commit();
                        $return = true;
                    }
                  // end proses

                    if ($return) {
                        $isError = false;
                        $id = $this->makses->id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Masa Akses input Awal Baru");
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
                    redirect("reference/masa_akses_input", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/akses_input_form/akses_awal.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $periodeList = $this->mperiode->get_data();
        $optionPeriode = array();
        foreach($periodeList as $opt){
            $optionPeriode[$opt->periode_risiko_id] = $opt->periode_risiko_nama;
        }
        //display the form
        // $this->data['periode_risiko_nama'] = array(
        //     'name' => 'periode_risiko_nama',
        //     'id' => 'periode_risiko_nama',
        //     'type' => 'text',
        //     'class' => 'form-control',
        //     // 'maxLength' => '10',
        //     'value' => $this->form_validation->set_value('periode_risiko_nama', $stdClass->periode_risiko_nama)
        // );

        // select option parent
        $this->data['periode_risiko_id'] = array(
            'name' => 'periode_risiko_id',
            'id' => 'periode_risiko_id',
            'selected' => $this->form_validation->set_value('periode_risiko_id', $stdClass->periode_risiko_id),
            'options' => $optionPeriode,
            'class' => 'form-control'
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

        return $this->_render_page('reference/vakses_input_form/vakses_awal', $this->data, false, 'tmpl/vwbacktmpl');
    }
    // end edit_form akses_awal_risiko

    // edit_form akses_awal_risiko_unlock dan auto genereate akses_mon_risiko
    public function akses_awal_risiko_unlock($id, $ids){
        $this->data['id'] = $ids;
        if (!empty($this->data['id'])) {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Masa Akses Input Awal (Unlock)";
        } else {
            $this->data['titlehead'] = "Insert Masa Akses Input Awal (Unlock)";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->compCode = '';
        $stdClass->periode_risiko_id = '';
        $stdClass->unit_id = '';
        $stdClass->start_date = '';
        $stdClass->end_date = '';

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->makses->get_data2($id);
            $stdClass->unitName = $stdClass->unitCode;
            $stdClass->start_date = fdate_eng_to_ind($stdClass->start_date);
            $stdClass->end_date = fdate_eng_to_ind($stdClass->end_date);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('periode_risiko_id', 'Periode Risiko', 'required');

            // $this->form_validation->set_rules('compId', 'Company', 'required');
            $this->form_validation->set_rules('unit_id', 'Organisasi', 'required');
            $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required');

            // POSTING VARIABLE
            $stdClass->periode_risiko_id = $this->input->post('periode_risiko_id');
            $stdClass->unit_id = $this->input->post('unit_id');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
               
                $tglAwal = date('Y-m-d', strtotime($stdClass->start_date));
                $tglAkhir = date('Y-m-d', strtotime($stdClass->end_date));
                $dataIn["start_date"] = $tglAwal;
                $dataIn["end_date"] = $tglAkhir;
                $dataIn["unit_id"] = $stdClass->unit_id;
                $dataIn["periode_risiko_id"] = $stdClass->periode_risiko_id;

                $userId =  $this->session->userdata($this->config->item('sess_prefix', 'ion_auth') . 'userid');
                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    $dataIn['updated_by'] = $userId;
                    $dataIn['updated_date'] = date('Y-m-d H:i:s');
                    $result = $this->db->update('_akses_risiko_awal_unlock', $dataIn, array('akses_risiko_awal_unlock_id' => $id));
                    // if ($this->makses->update($id, $dataIn)) {
                    if ($result) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Masa Akses input Awal (Unlock)");
                    }
                } else { // insert
                  $dataIn['created_by'] = $userId;
                  $dataIn['created_date'] = date('Y-m-d H:i:s');
                  //proses insert 
                    $return = false;

                    $return = $this->db->insert('_akses_risiko_awal_unlock', $dataIn);
                  // end proses

                    if ($return) {
                        $isError = false;
                        $id = $this->makses->id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Masa Akses input Awal (Unlock) Baru");
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
                    redirect("reference/masa_akses_input", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/akses_input_form/akses_awal_unlock.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $periodeList = $this->mperiode->get_data();
        $optionPeriode = array();
        $optionPeriode[""] = " - Pilih -";
        foreach($periodeList as $opt){
            $optionPeriode[$opt->periode_risiko_id] = $opt->periode_risiko_nama;
        }
        //display the form

        // select option parent
        $this->data['periode_risiko_id'] = array(
            'name' => 'periode_risiko_id',
            'id' => 'periode_risiko_id',
            'selected' => $this->form_validation->set_value('periode_risiko_id', $stdClass->periode_risiko_id),
            'options' => $optionPeriode,
            'class' => 'form-control'
        );

       
        
        $this->data['start_date'] = array(
               'name' => 'start_date',
               'id' => 'start_date',
               'type' => 'text',
               'value' => $this->form_validation->set_value('start_date', $stdClass->start_date),
               'class' => 'form-control tanggals',
               'placeholder' => 'dd-mm-yyyy'
         );

         $this->data['unit_id'] = array(
                'name' => 'unit_id',
                'id' => 'unit_id',
                'value' => $this->form_validation->set_value('unit_id', $stdClass->unit_id),
                'class' => 'form-control'
        );

            // select option company
            $companies = $this->mcompany->get_data(null, null, 999999);
            $list_company[null] = "Pilih Perusahaan";
            foreach ($companies as $row) {
                $list_company[$row->compCode] = $row->compName;
            }
            $this->data['company_code'] = array(
                'name' => 'company_code',
                'id' => 'company_code',
                'value' => $this->form_validation->set_value('compId', $stdClass->compCode),
                'options' => $list_company,
                'class' => 'form-control'
            );

         $this->data['end_date'] = array(
               'name' => 'end_date',
               'id' => 'end_date',
               'type' => 'text',
               'value' => $this->form_validation->set_value('end_date', $stdClass->end_date),
               'class' => 'form-control tanggals',
               'placeholder' => 'dd-mm-yyyy'
         );

         if($id > 0){
            $this->data['periode_risiko_id']['readonly'] = "readonly";
        }else{
            $this->data['start_date']['readonly'] = "readonly";
            $this->data['end_date']['readonly'] = "readonly";
        }

        $this->data['csrf'] = $this->_get_sess_csrf();

        return $this->_render_page('reference/vakses_input_form/vakses_awal_unlock', $this->data, false, 'tmpl/vwbacktmpl');
    }
    // end edit_form akses_awal_risiko_unlock

     // edit_form akses_mon_risiko_unlock dan auto genereate akses_mon_risiko
     public function akses_mon_risiko_unlock($id, $ids){
        $this->data['id'] = $ids;
        if (!empty($this->data['id'])) {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Masa Akses Input Monitoring (Unlock)";
        } else {
            $this->data['titlehead'] = "Insert Masa Akses Input Monitoring (Unlock)";
        }

        // default value
        $stdClass = new stdClass();
        $stdClass->compCode = '';
        $stdClass->periode_risiko_id = '';
        $stdClass->periode_bulan = '';
        $stdClass->unit_id = '';
        $stdClass->start_date = '';
        $stdClass->end_date = '';

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $stdClass = $this->makses->get_data4($id);
            // $stdClass->unitName = $stdClass->unitCode." - ".$stdClass->unitName;
            $stdClass->start_date = fdate_eng_to_ind($stdClass->start_date);
            $stdClass->end_date = fdate_eng_to_ind($stdClass->end_date);
        }

        if (isset($_POST) && !empty($_POST)) {
            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
                show_error($this->lang->line('error_csrf'));
            }

            //validate form input
            $this->form_validation->set_rules('periode_risiko_id', 'Periode Risiko', 'required');

            $this->form_validation->set_rules('unit_id', 'Organisasi *', 'required');
            $this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('end_date', 'Tanggal Akhir', 'required');

            // POSTING VARIABLE
            $stdClass->periode_risiko_id = $this->input->post('periode_risiko_id');
            $stdClass->unit_id = $this->input->post('unit_id');
            $stdClass->periode_bulan  = $this->input->post('periode_bulan');
            $stdClass->start_date = $this->input->post('start_date');
            $stdClass->end_date = $this->input->post('end_date');
            $stdClass->periode_bulan = $this->input->post('periode_bulan');

            if ($this->form_validation->run($this) === TRUE) {
                $isError = true;
                $isUpdate = false;

                $dataIn = array();
               
                $tglAwal = date('Y-m-d', strtotime($stdClass->start_date));
                $tglAkhir = date('Y-m-d', strtotime($stdClass->end_date));
                $dataIn["start_date"] = $tglAwal;
                $dataIn["end_date"] = $tglAkhir;
                $dataIn["unit_id"] = $stdClass->unit_id;
                $dataIn["periode_risiko_id"] = $stdClass->periode_risiko_id;
                $dataIn["periode_bulan"] = $stdClass->periode_bulan;

                $userId =  $this->session->userdata($this->config->item('sess_prefix', 'ion_auth') . 'userid');
                //check to see if we are updating data
                if ($id > 0 AND $this->input->post('id')) { // update
                    $isUpdate = true;
                    $dataIn['updated_by'] = $userId;
                    $dataIn['updated_date'] = date('Y-m-d H:i:s');
                    $result = $this->db->update('_akses_risiko_mon_unlock', $dataIn, array('akses_risiko_mon_unlock_id' => $id));
                    // if ($this->makses->update($id, $dataIn)) {
                    if ($result) {
                        $isError = false;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Masa Akses input Monitoring (Unlock)");
                    }
                } else { // insert
                  $dataIn['created_by'] = $userId;
                  $dataIn['created_date'] = date('Y-m-d H:i:s');
                  //proses insert 
                    $return = false;

                    $return = $this->db->insert('_akses_risiko_mon_unlock', $dataIn);
                  // end proses

                    if ($return) {
                        $isError = false;
                        $id = $this->makses->id;
                        $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Masa Akses input Monitoring (Unlock) Baru");
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
                    redirect("reference/masa_akses_input", 'refresh');
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
            HTTP_MOD_JS . 'modules/reference/akses_input_form/akses_mon_unlock.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $periodeList = $this->mperiode->get_data();
        $optionPeriode = array();
        $optionPeriode[""] = " - Pilih -";
        foreach($periodeList as $opt){
            $optionPeriode[$opt->periode_risiko_id] = date('Y', strtotime($opt->start_date));
        }
        //display the form

        // select option parent
        $this->data['periode_risiko_id'] = array(
            'name' => 'periode_risiko_id',
            'id' => 'periode_risiko_id',
            'selected' => $this->form_validation->set_value('periode_risiko_id', $stdClass->periode_risiko_id),
            'options' => $optionPeriode,
            'class' => 'form-control'
        );

        $this->data['periode_bulan'] = array(
            'name' => 'periode_bulan',
            'id' => 'periode_bulan',
            // 'selected' => $this->form_validation->set_value('periode_bulan', $stdClass->periode_bulan),
            // 'options' => $optionPeriode,
            'class' => 'form-control'
        );

       
        
        $this->data['start_date'] = array(
               'name' => 'start_date',
               'id' => 'start_date',
               'type' => 'text',
               'value' => $this->form_validation->set_value('start_date', $stdClass->start_date),
               'class' => 'form-control tanggals',
               'placeholder' => 'dd-mm-yyyy'
         );

            $this->data['unit_id'] = array(
                    'name' => 'unit_id',
                    'id' => 'unit_id',
                    'value' => $this->form_validation->set_value('unit_id', $stdClass->unit_id),
                    'class' => 'form-control'
            );

                // select option company
                $companies = $this->mcompany->get_data(null, null, 999999);
                $list_company[null] = "Pilih Perusahaan";
                foreach ($companies as $row) {
                    $list_company[$row->compCode] = $row->compName;
                }
                $this->data['company_code'] = array(
                    'name' => 'company_code',
                    'id' => 'company_code',
                    'value' => $this->form_validation->set_value('compId', $stdClass->compCode),
                    'options' => $list_company,
                    'class' => 'form-control'
                );

         $this->data['end_date'] = array(
               'name' => 'end_date',
               'id' => 'end_date',
               'type' => 'text',
               'value' => $this->form_validation->set_value('end_date', $stdClass->end_date),
               'class' => 'form-control tanggals',
               'placeholder' => 'dd-mm-yyyy'
         );

         if($id > 0){
            $this->data['periode_risiko_id']['readonly'] = "readonly";
        }else{
            $this->data['start_date']['readonly'] = "readonly";
            $this->data['end_date']['readonly'] = "readonly";
        }

        $this->data['csrf'] = $this->_get_sess_csrf();
        $this->data['perusahaan'] = $this->muser_manage->company();

        return $this->_render_page('reference/vakses_input_form/vakses_mon_unlock', $this->data, false, 'tmpl/vwbacktmpl');
    }
    // end edit_form akses_mon_risiko_unlock

    // delete data
    // jadi nonaktifkan data
    public function delete( $ciri = NULL,$id = NULL)
    {
        //        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        //        $id = intval($id);
        //        $res = $this->makses->delete($id);
        //        if ($res) {
        //            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Company Dihapus");
        //            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
        //        } else {
        //            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
        //        }
        //        redirect('reference/company', 'refresh');

        $this->deactivate($id, $ciri);
    }

    //activate
    public function activate($id)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 1;
        $activation = $this->makses->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/periode_risiko", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL, $ciri)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $ciri = $this->qsecure->decrypt($ciri);
        $id = (int)$id;
        $deactivate = false;

        $data['active'] = 0;
        // $deactivate = $this->makses->update($id, $data);
        if($ciri == 1){
            $where = array('akses_risiko_awal_id' => $id);
            $deactivate = $this->makses->update_data('_akses_risiko_awal', $data, $where);
        }else if($ciri == 2){
            $where = array('akses_risiko_awal_unlock_id' => $id);
            $deactivate = $this->makses->update_data('_akses_risiko_awal_unlock', $data, $where);
        }else if($ciri == 4){
            $where = array('akses_risiko_mon_unlock_id' => $id);
            $deactivate = $this->makses->update_data('_akses_risiko_mon_unlock', $data, $where);
        }
        
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Periode Risiko Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
        }
        redirect("reference/masa_akses_input", 'refresh');
    }

    // get data periode by id javascript
    public function get_periode(){
        $id = $this->input->post('id_periode');
        $Q = $this->mperiode->get_data($id);
        $Q->start_date = fdate_eng_to_ind($Q->start_date);
        $Q->end_date = fdate_eng_to_ind($Q->end_date);

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($Q));
    }

    // get data monitoring by id javascript
    public function get_monitoring(){
        $id = $this->input->post('mon_id');
        $id = $this->qsecure->decrypt($id);
        $Q = $this->makses->get_data3($id);
        $Q->akses_risiko_mon_id = $this->qsecure->encrypt($Q->akses_risiko_mon_id);
        $Q->start_date = fdate_eng_to_ind($Q->start_date);
        $Q->end_date = fdate_eng_to_ind($Q->end_date);

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($Q));
    }

    // get data monitoring (Unlock) by id javascript
    public function get_monitoring_unlock(){
        $id = $this->input->post('mon_id');
        $id = $this->qsecure->decrypt($id);
        $Q = $this->makses->get_data4($id);
        $Q->akses_risiko_mon_unlock_id = $this->qsecure->encrypt($Q->akses_risiko_mon_unlock_id);
        $Q->start_date = fdate_eng_to_ind($Q->start_date);
        $Q->end_date = fdate_eng_to_ind($Q->end_date);

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($Q));
    }

    // get all periode bulan in periode
    public function get_bulan(){
        $periode_id = $this->input->post('id_periode');
        $Q = $this->makses->get_list('_akses_risiko_mon', array('periode_risiko_id' => $periode_id), 'periode_bulan ');

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($Q));
    }

    // simpan dan update masa akses input monitoring 
    function simpan_updateMonitoring(){
       $r = $this->makses->simpan_monitoring();
       
       $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($r));
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
