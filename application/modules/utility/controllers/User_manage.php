<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User_manage
 * @property Muser_manage $muser_manage
 */
class User_manage extends Mst_controller
{

    function __construct()
    {
        parent::__construct();
        $this->MOD_ALIAS = "MOD_USERMANAGE";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->helper(array('url', 'language'));
        $this->load->model("Ion_auth_model", "mauth");
        $this->load->model("Muser_manage", "muser_manage");
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function index()
    {
        $this->data['titlehead'] = "Pengaturan Pengguna";

        // custom load javascript, place at footer                
        // $tagjs1 = "$(document).ready(function() {
        //                $('#dt-listuser')
        //                     .DataTable({
        //                         responsive: true,
        //                         searching: true,
        //                         paging: true,
        //                         ordering: false
        //                     });
        //            });";
        // $loadfoot['tagjs'] = array($tagjs1);
        
        $loadhead['stylesheet'] = array(
            HTTP_ASSET_PATH . 'vendor/switchery/dist/switchery.min.css'
        );
        
        $this->data['loadhead'] = $loadhead;
        
        $loadfoot['javascript'] = array(
            HTTP_ASSET_PATH . 'vendor/moment/moment.js',
            HTTP_ASSET_PATH . 'vendor/wselect/wSelect.min.js',
            HTTP_ASSET_PATH . 'vendor/switchery/dist/switchery.min.js',
            HTTP_MOD_JS . 'modules/utility/user_manage_form_js.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        // elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin()) //remove this elseif if you want to enable this for non-admins
        // {
        //     //redirect them to the home page because they must be an administrator to view this
        //     return show_error('You must be an administrator to access this page.');
        // } else {
        //     //list the users
        //     // $this->data['users'] = $this->muser_manage->get_users();
        // }
        $this->_render_page('utility/vuser_list', $this->data, false, 'tmpl/vwbacktmpl');
        //$this->template->load('tmpl/vwbacktmpl','vuser_list',$data);
    }

    public function list_user(){  
        // $this->_checkAuthorization($this->MOD_ALIAS);
        
        $this->load->helper('url');
        $seq = 1;
        $list = $this->muser_manage->get_datatablesList();
        $data = array();
        foreach ($list as $user) {

            $id = $this->qsecure->encrypt($user->id);

            $atr_edit = null; $atr_del = null;
            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'utility/user_manage/edit_form/';
                $atr_edit['class'] = '';
            }
            if ($this->_delete) {
                $atr_del['title'] = 'Hapus';
                $atr_del['url'] = 'utility/user_manage/delete/';
                $atr_del['class'] = '';
                $atr_del['onclick'] = "return confirm('Hapus user ?')";
            }
            $btnAction = btn_action_group($id, $atr_edit, $atr_del);

            $aktif =  ($user->active) ? anchor("utility/user_manage/deactivate/" . $this->qsecure->encrypt($user->id), "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan user ?');")) :
                                anchor("utility/user_manage/activate/" . $this->qsecure->encrypt($user->id), "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan user ?');")); 
            

            $row = array();
            $row[] = $btnAction;
            $row[] = $user->username;
            $row[] = $user->email;
            $row[] = $user->full_name;
            $row[] = $user->unitCode." - ".$user->unitName;
            $row[] = $user->role_name;
            $row[] = $user->last_login;
            $row[] = $aktif;
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->muser_manage->count_allList(),
                        "recordsFiltered" => $this->muser_manage->count_filteredList(),
                        "data" => $data,
                );
        
        echo json_encode($output);
    }

    function getCompany(){
        $modul = $this->input->post('modul');
        $compId = $this->input->post('compId');

        if($modul=="site"){
            echo $this->muser_manage->site($compId);
        }
    }
    
    function getJabatanWakil() {
        
        $positionId = $this->input->post('positionId');

        echo $this->muser_manage->jabatanWakil($positionId);
    }

    public function edit_form()
    {
        $id = 0;
        $this->data['id'] = $this->uri->segment(4);
        
        if (trim($this->data['id']) != "") {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Pengguna";
        } else {
            $this->data['titlehead'] = "Input Pengguna";
        }
        
        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array(
            HTTP_ASSET_PATH . 'vendor/wselect/wSelect.css',
            HTTP_ASSET_PATH . 'vendor/switchery/dist/switchery.min.css'
        );
        $this->data['loadhead'] = $loadhead;

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_ASSET_PATH . 'vendor/wselect/wSelect.min.js',
            HTTP_ASSET_PATH . 'vendor/switchery/dist/switchery.min.js',
            HTTP_MOD_JS . 'modules/utility/user_manage_form_js.js'
        );
        
        
        // custom load javascript, place at footer
        $tagjs1 = "$(document).ready(function() {                            
                        $('#role_id').select2();  
                        $('#positionId').select2();  
                        $('#representPositionId').select2(); 
                        
                        if ($('#represent').is(':checked'))
                        {
                          // it is checked
                            $('#represent_position').show();
                        } else {
                            $('#represent_position').hide();
                        }   
                        
        });";

        $loadfoot['tagjs'] = array($tagjs1);
  
        $this->data['loadfoot'] = $loadfoot;

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        // elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin()) //remove this elseif if you want to enable this for non-admins
        // {
        //     //redirect them to the home page because they must be an administrator to view this
        //     return show_error('You must be an administrator to access this page.');
        // }


        //$tables = $this->config->item('tables', 'ion_auth');

        //validate form input
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('role_id', 'User Role', 'required');
        $this->form_validation->set_rules('compName', 'Company', 'required');
        $this->form_validation->set_rules('positionDesc', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('prefix', 'Sapaan', 'required');
        $this->form_validation->set_rules('photo', "Avatar", 'trim');
        $this->form_validation->set_rules('phone', "No Telp", 'trim');

        if (trim($this->data['id']) == "") { // new mode
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi password', 'required');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback__whitespace_unamecheck|callback__username_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__email_check');

        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('is_uniqueq', '%s sudah digunakan !');
        $this->form_validation->set_message('_email_check', '{field} sudah digunakan (duplikat) !');
        $this->form_validation->set_message('_username_check', '{field} sudah digunakan (duplikat) !');
        $this->form_validation->set_message('_whitespace_unamecheck', '{field} tidak boleh berisi spasi !');

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $user = $this->muser_manage->get_users($id);
            //$user->photo = ($user->photo == null) ? null :  $user->photo; //coba
            
        } else {
            $user = new stdClass();
            $user->username = '';
            $user->full_name = '';
            $user->prefix = '';
            $user->email = '';
            $user->photo = 'avatar.png';
            $user->role_id = '';
            $user->phone = '';
            $user->nik = '';
            $user->positionId = 0;
            $user->positionName = '';
            $user->positionDesc = '';
            $user->empId = 0;
            $user->compId = 0;
            $user->compName = '';
            $user->unitId = 0;
            $user->unitName = '';
            $user->unitCode = '';
            $user->represent = false;
            $user->representPositionId = 0;
            $user->representPositionName = '';
            $user->dt_superadmin = false;
            $user->dt_admin = false;
            $user->dt_user = false;
            
        }
        
        $this->data['user'] = $user;
        
        if (isset($_POST) && !empty($_POST)) {
//            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
//                show_error($this->lang->line('error_csrf'));
//            }

            //update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', 'Konfirmasi password', 'required');
            }

            // POSTING VARIABLE
            $username = strtolower($this->input->post('username'));
            $role_id = $this->input->post('role_id');
            $prefix = $this->input->post('prefix');
            $full_name = $this->input->post('full_name');
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');
            $nik = $this->input->post('nik');
            $phone = $this->input->post('phone');
            $compName = $this->input->post('compName');
            $empId = $this->input->post('empId');
            $compId = $this->input->post('compId');
            $unitId = $this->input->post('unitId');
            $unitName = $this->input->post('unitName');
            $positionId = $this->input->post('positionId');
            $positionDesc = $this->input->post('positionDesc');
            $user->photo = $this->input->post('photo');
            $represent = $this->input->post('represent');
            if(isset($represent)) {
                $user->represent = true;
            }else{
                $user->represent = false;
            }
            
            $representPositionId = $this->input->post('representPositionId');
            if(isset($representPositionId)) {
                $user->representPositionId = $this->input->post('representPositionId');
            }

            $dt_superadmin = $this->input->post('dt_superadmin');
            if(isset($dt_superadmin)) {
                $user->dt_superadmin = true;
            }else{
                $user->dt_superadmin = false;
            }

            $dt_admin = $this->input->post('dt_admin');
            if(isset($dt_admin)) {
                $user->dt_admin = true;
            }else{
                $user->dt_admin = false;
            }

            $dt_user = $this->input->post('dt_user');
            if(isset($dt_user)) {
                $user->dt_user = true;
            }else{
                $user->dt_user = false;
            }
            
            //check to see if we are updating the user
            if ($id > 0 AND $this->input->post('id')) { // update
                
                $user->role_id = $role_id;
                $data = array(
                    'username' => $username,
                    'full_name' => $full_name,
                    'prefix' => $prefix,
                    'email' => $email,
                    'phone' => $phone,
                    'nik' => $nik,
                    'empId' => $empId,
                    'compId' => $compId,
                    'unitId' => $unitId,
                    'positionId' => $positionId,
                    'positionDesc' => $positionDesc,
                    'represent' => $user->represent,
                    'representPositionId' => $user->representPositionId,
                    'dt_superadmin' => $user->dt_superadmin,
                    'dt_admin' => $user->dt_admin,
                    'dt_user' => $user->dt_user
                );

                if ($this->input->post('password')) {
                    $data['password'] = trim($this->input->post('password'));
                }
                
                //--== Begin Perform Upload File
                if (!empty($_FILES["filephoto"]['name'])){
                  $return_val = $this->uploadFile('profile', 'filephoto');  
   
                  if(!$return_val['err']) {
                      $data["photo"] = $return_val['file_name'];
                      $this->data['errmsg'] = "uploaded";
                  } else {
                      $this->data['errmsg'] = $return_val['errmsg'];
                      
                       $this->data['message'] = $this->session->flashdata('message');
                       $this->session->set_flashdata('err', $this->data['errmsg']);
                    
                      //return show_error($this->data['errmsg']);
                  }
                }else{
                    //$data["photo"] =  $this->input->post('photo');
                }


                if ($this->form_validation->run($this) === TRUE) {

                    $this->mauth->update($id, $data);
                    //$this->muser_manage->update_record("sec_user",$data, "id",$id);
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Update User");    
                    $this->mauth->update_role($id, array('role_id' => $role_id));
                   // if ($user_profile["photo"] !== "") {
                   //     $this->session->set_userdata(sess_prefix() . "avatar", $user_profile["photo"]);
                   // }
                    $this->session->set_flashdata('message', "Update user berhasil..");
                    redirect("utility/user_manage", 'refresh');

                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->mauth->errors() ? $this->mauth->errors() : ""));
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);
                    $this->data['username_edit'] = $username;
                    
                    $user->username = $this->input->post('username');
                    $user->full_name = $this->input->post('full_name');
                    $user->prefix = $this->input->post('prefix');
                    $user->email = $this->input->post('email');
                    $user->role_id = $this->input->post('role_id');
                    $user->nik = $this->input->post('nik');
                    $user->phone = $this->input->post('phone');
                    $user->positionDesc = $this->input->post('positionDesc');
                    $user->empId = $this->input->post('empId');
                    $user->compId = $this->input->post('compId');
                    $user->unitId = $this->input->post('unitId');
                    $user->unitName = $this->input->post('unitName');
                    $user->positionId = $this->input->post('positionId');
                    $user->photo = $this->input->post('photo');
                    $represent = $this->input->post('represent');
                    if(isset($represent)) {
                        $user->represent = true;
                    }else{
                        $user->represent = false;
                    }

                    $representPositionId = $this->input->post('representPositionId');
                    if(isset($representPositionId)) {
                        $user->representPositionId = $this->input->post('representPositionId');
                    }

                    $dt_superadmin = $this->input->post('dt_superadmin');
                    if(isset($dt_superadmin)) {
                        $user->dt_superadmin = true;
                    }else{
                        $user->dt_superadmin = false;
                    }

                    $dt_admin = $this->input->post('dt_admin');
                    if(isset($dt_admin)) {
                        $user->dt_admin = true;
                    }else{
                        $user->dt_admin = false;
                    }

                    $dt_user = $this->input->post('dt_user');
                    if(isset($dt_user)) {
                        $user->dt_user = true;
                    }else{
                        $user->dt_user = false;
                    }

                    $this->data['user'] = $user;
                    
                }
                    
            } else { // insert

                //--== Begin Perform Upload File
                $additional_data = array();
                
                if (!empty($_FILES["filephoto"]['name'])){
                    $return_val = $this->uploadFile('profile', 'filephoto');  
           
                    $additional_data["photo"] = $user->photo;
                    // if(!$return_val['err']) {
                        $data["photo"] = $return_val['file_name'];
                        $additional_data["photo"] = $return_val['file_name'];
                    // } else {
                    //     $this->data['errmsg'] = $return_val['errmsg'];
                    // }
                }else{
                    $data["photo"] = 'avatar.png';
                }
                
                $additional_data["full_name"] = $full_name;
                $additional_data["prefix"] = $prefix;
                $additional_data["empId"] = $empId;
                $additional_data["compId"] = $compId;
                $additional_data["unitId"] = $unitId;
                $additional_data["positionId"] = $positionId;
                $additional_data["positionDesc"] = $positionDesc;
                $additional_data["nik"] = $nik;
                $additional_data["phone"] = $phone;
                $additional_data["represent"] = $user->represent;
                $additional_data["representPositionId"] = $user->representPositionId;
                $additional_data["dt_superadmin"] = $user->dt_superadmin;
                $additional_data["dt_admin"] = $user->dt_admin;
                $additional_data["dt_user"] = $user->dt_user;
                
                $groups[] = $role_id;
                
                if ($this->form_validation->run($this) === TRUE) {
                    $id=$this->ion_auth->register($username, $password, $email, $additional_data, $groups);
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Tambah User");        
                    $this->session->set_flashdata('message', ($this->mauth->messages() ? $this->mauth->messages() : "Tambah user berhasil.."));
                    redirect("utility/user_manage", 'refresh');
                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('err_message')));
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $user = new stdClass();
                    $user->username = $this->input->post('username');
                    $user->full_name = $this->input->post('full_name');
                    $user->prefix = $this->input->post('prefix');
                    $user->email = $this->input->post('email');
                    $user->role_id = $this->input->post('role_id');
                    $user->nik = $this->input->post('nik');
                    $user->phone = $this->input->post('phone');
                    $user->empId = $this->input->post('empId');
                    $user->compId = $this->input->post('compId');
                    $user->compName = $this->input->post('compName');
                    $user->unitId = $this->input->post('unitId');
                    $user->unitName = $this->input->post('unitName');
                    $user->positionId = $this->input->post('positionId');
                    $user->positionDesc = $this->input->post('positionDesc');
                    $user->photo = $this->input->post('photo');
                    $user->prefix = $this->input->post('prefix');
                    $represent = $this->input->post('represent');
                    if(isset($represent)) {
                        $user->represent = true;
                    }else{
                        $user->represent = false;
                    }

                    $dt_superadmin = $this->input->post('dt_superadmin');
                    if(isset($dt_superadmin)) {
                        $user->dt_superadmin = true;
                    }else{
                        $user->dt_superadmin = false;
                    }

                    $dt_admin = $this->input->post('dt_admin');
                    if(isset($dt_admin)) {
                        $user->dt_admin = true;
                    }else{
                        $user->dt_admin = false;
                    }

                    $dt_user = $this->input->post('dt_user');
                    if(isset($dt_user)) {
                        $user->dt_user = true;
                    }else{
                        $user->dt_user = false;
                    }

                    $this->data['user'] = $user;
                }
                
              
            }
        }//endif POST

        
        //display the create user form
        $this->data['full_name'] = array(
            'name' => 'full_name',
            'id' => 'full_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('full_name', $user->full_name),
            'class' => 'form-control',
            'placeholder' => 'Nama Lengkap'
        );
        $this->data['nik'] = array(
            'name' => 'nik',
            'id' => 'nik',
            'readonly' => 'true',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nik', $user->nik),
            'class' => 'form-control',
            'placeholder' => 'NIK'
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
            'class' => 'form-control',
            'placeholder' => 'Tlp'
        );
        $this->data['unit'] = array(
            'name' => 'unit',
            'id' => 'unit',
            'readonly' => 'true',
            'type' => 'text',
            'value' => $this->form_validation->set_value('unit', $user->unitName),
            'class' => 'form-control',
            'placeholder' => 'Unit'
        );
        $this->data['photo_edit'] = array(
            'name' => 'photo',
            'id' => 'photo',
            'type' => 'text',
            'readonly' => 'true',
            'value' => $this->form_validation->set_value('photo', $user->photo),
            'class' => 'form-control'
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'password min 8 char',
            'autocomplete' => 'new-password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'konfirmasi password'
        );

        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'value' => $this->form_validation->set_value('email', $user->email),
            'class' => 'form-control',
            'placeholder' => 'email'
        );
        $this->data['email_edit'] = $user->email;

        $this->data['username'] = array(
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'value' => $this->form_validation->set_value('username', $user->username),
            'class' => 'form-control',
            'placeholder' => 'username'
        );
        $this->data['positionDesc'] = array(
            'name' => 'positionDesc',
            'id' => 'positionDesc',
            'readonly' => 'true',
            'type' => 'text',
            'value' => $this->form_validation->set_value('positionDesc', $user->positionDesc),
            'class' => 'form-control',
            'placeholder' => 'Nama Jabatan'
        );
        $this->data['username_edit'] = $user->username;

        $this->data['empId'] = array(
            'name' => 'empId',
            'id' => 'empId',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('empId', $user->empId),
            'class' => 'form-control',
            'placeholder' => 'Copmany ID' 
        );
        
        $this->data['compId'] = array(
            'name' => 'compId',
            'id' => 'compId',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('compId', $user->compId),
            'class' => 'form-control',
            'placeholder' => 'Copmany ID' 
        );

        $this->data['compName'] = array(
            'name' => 'compName',
            'id' => 'compName',
            'readonly' => 'true',
            'type' => 'text',
            'value' => $this->form_validation->set_value('compName', $user->compName),
            'class' => 'form-control',
            'placeholder' => 'Company'
        );

        $this->data['unitId'] = array(
            'name' => 'unitId',
            'id' => 'unitId',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('unitId', $user->unitId),
            'class' => 'form-control',
            'placeholder' => 'Unit ID' 
        );

        $this->data['positionId'] = array(
            'name' => 'positionId',
            'id' => 'positionId',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('positionId', $user->positionId),
            'class' => 'form-control',
            'placeholder' => 'Nama Position ID' 
        );
        

        // option list avatar                
        $list_avatar = array(
            array(
                'img_name' => '160x160.png',
                'img_ico' => '160x160_ico.png',
                'img_title' => '- Pilih Avatar -'
            ),
            array(
                'img_name' => 'avatar1.png',
                'img_ico' => 'avatar_ico1.png',
                'img_title' => 'Avatar-1'
            ),
            array(
                'img_name' => 'avatar2.png',
                'img_ico' => 'avatar_ico2.png',
                'img_title' => 'Avatar-2'
            ),
            array(
                'img_name' => 'avatar3.png',
                'img_ico' => 'avatar_ico3.png',
                'img_title' => 'Avatar-3'
            ),
            array(
                'img_name' => 'avatar4.png',
                'img_ico' => 'avatar_ico4.png',
                'img_title' => 'Avatar-4'
            ),
            array(
                'img_name' => 'avatar5.png',
                'img_ico' => 'avatar_ico5.png',
                'img_title' => 'Avatar-5'
            ),
        );

        $this->data['user_photo'] = $user->photo;
        $this->data['role_id'] = $this->form_validation->set_value('role_id', $user->role_id);
        $this->data['csrf'] = $this->_get_sess_csrf();
        $this->data['list_avatar'] = $list_avatar;

        // option role or group user
        $data_roles = $this->muser_manage->get_roles();
        $list_role ['0'] = '- Pilih role -';
        foreach ($data_roles as $row) {
            $list_role[$row->role_id] = $row->role_name;
        }
        $this->data['list_role'] = $list_role;
        
        $this->data['perusahaan'] = $this->muser_manage->company();
        
        $list_prefix["Bpk."] = "Bpk."; 
        $list_prefix["Ibu."] = "Ibu."; 
        
        $this->data['list_prefix'] = $list_prefix;

        $this->_render_page('utility/vuser_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    //profile  user
    function profile_user()
    {
        $id = $this->session->userdata(sess_prefix() . "userid");
        //$id = $this->qsecure->decrypt($id);

        $this->data['titlehead'] = "Profil Pengguna";

        // custom load stylesheet, place at header
        $loadhead['stylesheet'] = array(
            HTTP_ASSET_PATH . 'plugins/wselect/wSelect.css'
        );
        $this->data['loadhead'] = $loadhead;

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            /*- DataTables JavaScript -*/
            HTTP_ASSET_PATH . 'plugins/wselect/wSelect.min.js',
            HTTP_MOD_JS . 'modules/auth/profile_user_js.js',
        );
        $this->data['loadfoot'] = $loadfoot;


        if (!$this->ion_auth->logged_in() || (!$this->mauth->user()->row()->id == $id)) {
            redirect('auth', 'refresh');
        }

        $user = $this->mauth->user($id)->row();

        //validate form input
        $this->form_validation->set_rules('full_name', "Nama Lengkap", 'required');
        $this->form_validation->set_rules('phone', "Telp/Hp.", 'trim');
        $this->form_validation->set_rules('nik', "NIK.", 'required');

        if (isset($_POST) && !empty($_POST)) {

            $nik = $this->input->post('nik');
            $phone = $this->input->post('phone');

            $data = array(
                'phone' => $phone,
                'nik' => $nik
            );

            $additional_data = array();

            $return_val = $this->uploadFile('profile', 'filephoto');  
   
              if(!$return_val['err']) {
                  $data["photo"] = $return_val['file_name'];
                  $this->data['errmsg'] = "uploaded";
              } else {
                  $this->data['errmsg'] = $return_val['errmsg'];
                  
                   $this->data['message'] = $this->session->flashdata('message');
                   $this->session->set_flashdata('err', $this->data['errmsg']);
                
                  //return show_error($this->data['errmsg']);
              }
            //---=== end upload file


            if ($this->form_validation->run($this) === TRUE) {
                $this->mauth->update($id, $data);
                $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Update User"); 

                $this->session->set_flashdata('message', "Update user berhasil..");
                redirect("utility/user_manage/profile_user", 'refresh');

            } else {
                //set the flash data error message if there is one
                $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->mauth->errors() ? $this->mauth->errors() : ""));
                $this->data['message'] = $this->session->flashdata('message');
                $this->session->set_flashdata('err', $this->data['errmsg']);
                $this->data['username_edit'] = '';

                $user->nik = $this->input->post('nik');
                $user->phone = $this->input->post('phone');
                if(isset($represent)) {
                    $user->represent = true;
                }else{
                    $user->represent = false;
                }

                $representPositionId = $this->input->post('representPositionId');
                if(isset($representPositionId)) {
                    $user->representPositionId = $this->input->post('representPositionId');
                }
                $this->data['user'] = $user;
                
            }
        }

        //display the edit user form
        //$this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['csrf'] = $this->_get_csrf_q();

        //set the flash data error message if there is one
        $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('err_message')));
        $this->data['message'] = $this->session->flashdata('message');

        //pass the user to the view
        $this->data['user'] = $user;
        // $this->data['groups'] = $groups;
        // $this->data['currentGroups'] = $currentGroups;

        //display the create user form
        $this->data['full_name'] = array(
            'name' => 'full_name',
            'readOnly' => true,
            'id' => 'full_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('full_name', $user->full_name),
            'class' => 'form-control',
            'placeholder' => 'Nama Lengkap'
        );
        $this->data['nik'] = array(
            'name' => 'nik',
            'id' => 'nik',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nik', $user->nik),
            'class' => 'form-control',
            'placeholder' => 'NIK'
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
            'class' => 'form-control',
            'placeholder' => 'Tlp'
        );
        $this->data['photo_edit'] = array(
            'name' => 'photo',
            'id' => 'photo',
            'type' => 'text',
            'readonly' => 'true',
            'value' => $this->form_validation->set_value('photo', $user->photo),
            'class' => 'form-control'
        );

        $this->data['email'] = array(
            'name' => 'email',
            'readOnly' => true,
            'id' => 'email',
            'type' => 'email',
            'value' => $this->form_validation->set_value('email', $user->email),
            'class' => 'form-control',
            'placeholder' => 'email'
        );
        $this->data['email_edit'] = $user->email;

        $this->data['username'] = array(
            'name' => 'username',
            'readOnly' => true,
            'id' => 'username',
            'type' => 'text',
            'value' => $this->form_validation->set_value('username', $user->username),
            'class' => 'form-control',
            'placeholder' => 'username'
        );
        $this->data['username_edit'] = $user->username;
        // option list avatar

        $list_avatar = array(
            array(
                'img_name' => '160x160.png',
                'img_ico' => '160x160_ico.png',
                'img_title' => '- Pilih Avatar -'
            ),
            array(
                'img_name' => 'avatar1.png',
                'img_ico' => 'avatar_ico1.png',
                'img_title' => 'Avatar-1'
            ),
            array(
                'img_name' => 'avatar2.png',
                'img_ico' => 'avatar_ico2.png',
                'img_title' => 'Avatar-2'
            ),
            array(
                'img_name' => 'avatar3.png',
                'img_ico' => 'avatar_ico3.png',
                'img_title' => 'Avatar-3'
            ),
            array(
                'img_name' => 'avatar4.png',
                'img_ico' => 'avatar_ico4.png',
                'img_title' => 'Avatar-4'
            ),
            array(
                'img_name' => 'avatar5.png',
                'img_ico' => 'avatar_ico5.png',
                'img_title' => 'Avatar-5'
            ),
        );

        $this->data['list_avatar'] = $list_avatar;

        $this->_render_page('utility/profile_user', $this->data, false, 'tmpl/vwbacktmpl');
    }

    function listUnit(){
        $this->load->helper('url');

        $list = $this->muser_manage->get_datatables();
        
        $data = array();
        foreach ($list as $user) {
            $row = array();
            $row[] = $user->unitId;
            $row[] = $user->comp_name;
            $row[] = $user->unitCode;
            $row[] = $user->unitName;
        
            $data[] = $row;
        }

        //$data_tree = $this->muser_manage->buildTree($list);

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->muser_manage->count_all(),
                        "recordsFiltered" => $this->muser_manage->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);
    }

    function getUnit(){
        $id = $this->input->post('unitId');
        $data = $this->muser_manage->get_record(config_item("view_unit"), array("unitId"=>$id),"unitId,unitCode,unitName");

        echo json_encode($data);
    }

    //activate the user
    public function activate($id)
    {
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin())) {
            return show_error('You must be an administrator to action this method.');
        }
        if ($id != null && $id != "") {
            $id = $this->qsecure->decrypt($id);
        }
        $id = (int)$id;
        $activation = $this->mauth->activate($id);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"User Diaktifkan");
            $this->session->set_flashdata('message', $this->mauth->messages());
        } else {
            $this->session->set_flashdata('err', $this->mauth->errors());
        }
        redirect("utility/user_manage", 'refresh');

    }

    //deactivate the user
    public function deactivate($id = NULL)
    {
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin())) {
            return show_error('You must be an administrator to action this method.');
        }

        if ($id != null && $id != "") {
            $id = $this->qsecure->decrypt($id);
        }
        $id = (int)$id;
        if ($id == 1) {
            redirect('utility/user_manage/list_user', 'refresh');
        }

        $deactivate = $this->mauth->deactivate($id);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"User Dinonaktifkan");
            $this->session->set_flashdata('message', $this->mauth->messages());
        } else {
            $this->session->set_flashdata('err', $this->mauth->errors());
        }
        redirect("utility/user_manage", 'refresh');
    }

    //delete the user
    public function delete($id = NULL)
    {
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin())) {
            return show_error('You must be an administrator to action this method.');
        }

        if ($id != null && $id != "") {
            $id = $this->qsecure->decrypt($id);
        }
        $id = (int)$id;
        if ($id == 1) {
            redirect('utility/user_manage', 'refresh');
        }
        $res = $this->mauth->delete_user($id);
        if ($res) {
            $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"User Dihapus");
            $this->session->set_flashdata('message', $this->mauth->messages());
        } else {
            $this->session->set_flashdata('err', $this->mauth->errors());
        }
        //redirect them back to the auth page
        redirect('utility/user_manage', 'refresh');
    }

    function _whitespace_unamecheck($username)
    {
        //$str = $this->input->post("username");        
        //if (ctype_space($username) OR strpos($username, ' ') !== false) {
        if (preg_match('/\s/', $username)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _username_check($username)
    {
        if ($this->muser_manage->username_exists($username, $this->qsecure->decrypt($this->input->post("id")))) {
            $this->form_validation->set_message('_username_check', '{field} sudah digunakan (duplikat) !');
            return FALSE;
        } else {
            return TRUE;
        }

    }

    function _email_check($email)
    {
        if ($this->muser_manage->email_exists($email, $this->qsecure->decrypt($this->input->post("id")))) {
            $this->form_validation->set_message('_email_check', '{field} sudah digunakan (duplikat) !');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _get_csrf_q()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_userdata('csrfkey', $key);
        $this->session->set_userdata('csrfvalue', $value);
        return array($key => $value);
    }
    
    function sinkronisasi() {
    }
}
