<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Mst_controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'language'));
        $this->load->model("Ion_auth_model", "mauth");
        $this->load->model("muser_manage", "muser_manage");
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
    }

    function index()
    {
        $id = $this->session->userdata(sess_prefix() . "userid");
        //$id = $this->qsecure->decrypt($id);

        $this->data['titlehead'] = "Profil Pengguna";

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
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

        if (isset($_POST) && !empty($_POST)) {
            $phone = $this->input->post('phone');

            $data = array(
                'phone' => $phone
            );

            if (!empty($_FILES['filephoto']['name'])) {
                $return_val = $this->uploadFile('profile', 'filephoto');
                if (is_array($return_val)) {
                    $data["photo"] = $return_val['file_name'];
                    $this->data['errmsg'] = "uploaded";
                } else {
                    $this->data['errmsg'] = "Gagal upload file";
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('errmsg', $this->data['errmsg']);
                }
            }
            //---=== end upload file


            if ($this->form_validation->run($this) === TRUE) {
                $this->mauth->update($id, $data);
                $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Update Profil");

                $this->session->set_flashdata('message', "Update Profil berhasil..");
                redirect("utility/profile", 'refresh');

            } else {
                //set the flash data error message if there is one
                $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->mauth->errors() ? $this->mauth->errors() : ""));
                $this->data['message'] = $this->session->flashdata('message');
                $this->session->set_flashdata('errmsg', $this->data['errmsg']);
                
                $user->phone = $this->input->post('phone');
               
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
        
        $this->data['unitcode'] = $this->get_unitcode();
        $this->data["positionname"] = $this->get_positionname();
        
        $this->template->load('tmpl/vwbacktmpl', 'utility/profile_user', $this->data);
        
        //$this->_render_page('utility/profile_user', $this->data, false, 'tmpl/vwbacktmpl');
    }
    
    //change password
    function change_password()
    {
        $this->data['titlehead'] = "Ganti Password";
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        $this->form_validation->set_message('required', '%s harus diisi !');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            $this->data['errmsg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password Lama'
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                'class' => 'form-control',
                'placeholder' => 'Password Baru'
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                'class' => 'form-control',
                'placeholder' => 'Konfirmasi Password Baru'
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id
            );
            
            $this->data['unitcode'] = $this->get_unitcode();
            $this->data["positionname"] = $this->get_positionname();
        
            $this->template->load('tmpl/vwbacktmpl', 'utility/change_password', $this->data);
            //render view
            //$this->_render_page('auth/change_password', $this->data, false, 'tmpl/vwbacktmpl');
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('errmsg', $this->ion_auth->errors());
                redirect('utility/change_password', 'refresh');
            }
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
    
}
