<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth for authentication
 *
 * @author MST
 *
 * @property Ion_auth $ion_auth
 * @property Ion_auth_model $mauth
 */
class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model("Ion_auth_model", "mauth");
        $this->load->model("Mst_model", "mbase");
        $this->load->library('simplecaptcha');
        //$this->load->library('ldap_auth');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');

        } else {
            /** remark by kiq
             * //set the flash data error message if there is one
             * $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
             *
             * //list the users
             * $this->data['users'] = $this->ion_auth->users()->result();
             * foreach ($this->data['users'] as $k => $user)
             * {
             * $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
             * }
             *
             * $this->_render_page('auth/index', $this->data);
             */
            redirect('home', 'refresh');
        }
    }

    function setLogin()
    {

        //check to see if the user is logging in
        //check for "remember me"
        $remember = (bool)$this->input->post('remember');
        //$returnurl = trim($this->uri->segment(4));

        if ($this->mauth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
            //if the login is successful
            //--cek Role akses data
            /*if ($this->input->post('opt_dataview') != "") {
                $sessx['mode_listdata'] = $this->input->post('opt_dataview');
                $this->session->set_userdata($sessx);

                if ($returnurl != "") {
                    $returnurl = $this->qsecure->decrypt($returnurl);
                    redirect($returnurl, 'refresh');
                } else {
                    //redirect('home', 'refresh');
                    redirect('main/dashboard', 'refresh');
                }
            } else {
                $dtuser = $this->mbase->get_user_profile();
                $this->data["ref_mode_listdata"] = $dtuser->dt_superadmin . ";" . $dtuser->dt_admin . ";" . $dtuser->dt_user;
                $default_mode_listdata = "";
                if ($dtuser->dt_superadmin != 0 && $dtuser->dt_admin != 0 && $dtuser->dt_user != 0) {
                    $default_mode_listdata = "user";
                } elseif ($dtuser->dt_superadmin != 0 && $dtuser->dt_admin != 0 && $dtuser->dt_user == 0) {
                    $default_mode_listdata = "administrator";
                } elseif ($dtuser->dt_superadmin != 0 && $dtuser->dt_admin == 0 && $dtuser->dt_user == 0) {
                    $default_mode_listdata = "superadmin";
                } elseif ($dtuser->dt_superadmin != 0 && $dtuser->dt_admin == 0 && $dtuser->dt_user != 0) {
                    $default_mode_listdata = "user";
                } elseif ($dtuser->dt_superadmin == 0 && $dtuser->dt_admin != 0 && $dtuser->dt_user != 0) {
                    $default_mode_listdata = "user";
                } elseif ($dtuser->dt_superadmin == 0 && $dtuser->dt_admin == 0 && $dtuser->dt_user != 0) {
                    $default_mode_listdata = "user";
                } elseif ($dtuser->dt_superadmin != 0 && $dtuser->dt_admin != 0 && $dtuser->dt_user == 0) {
                    $default_mode_listdata = "administrator";
                } elseif ($dtuser->dt_superadmin == 0 && $dtuser->dt_admin != 0 && $dtuser->dt_user == 0) {
                    $default_mode_listdata = "administrator";
                } elseif ($dtuser->dt_superadmin != 0 && $dtuser->dt_admin == 0 && $dtuser->dt_user == 0) {
                    $default_mode_listdata = "superadmin";
                }
                $this->data["default_mode_listdata"] = $default_mode_listdata;
                $this->ion_auth->logout();
            }*/

            $sessx['mode_listdata'] = 'user';
            $this->session->set_userdata($sessx);

            $returnurl = $this->session->userdata('referred_from');
            if (!empty($returnurl)) {
                //$returnurl = $this->qsecure->decrypt($returnurl);
                $this->session->unset_userdata('referred_from');
                redirect($returnurl, 'refresh');
            } else {
                //redirect('home', 'refresh');
                redirect('main/dashboard', 'refresh');
            }
        } else {
            //if the login was un-successful
            //redirect them back to the login page
            $err = ($this->ion_auth->errors() == "" ? "Maaf username dan password tidak sesuai !" : $this->ion_auth->errors());
            $this->session->set_flashdata('errmsg', $err);
            $this->data['errmsg'] = $err;
            //redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
        }
    }

    function test_ldap()
    {

        $username = "test.aplikasi";
        $password = "Aeroas1@";

        if ($this->ldap_auth->connect()) {

            if ($this->ldap_auth->auth($username, $password)) {

                // User Ldap tersedia
                $user = $this->mbase->get_record(config_item('view_user'), array('username' => $username));

                if (count($user) == 0) {
                    //user not existing

                    $info_ldap = $this->ldap_auth->info($username, "username");

                    $email = $info_ldap[0]["userprincipalname"][0];
                    $fullname = $info_ldap[0]["displayname"][0];

                    print_r($email . " " . $fullname);
                    exit;


                }


                $this->ldap_auth->closed();

            } else {
                $this->ldap_auth->closed();

                echo $err = "User & Password LDAP tidak sesuai, silahkan hubungi administrator";

            }

        } else {
            $this->ldap_auth->closed();

            echo $err = "Koneksi LDAP GAGAL!";

        }
    }

    //log the user in
    function login()
    {

        if ($this->ion_auth->logged_in()) {
            redirect('main/dashboard', 'refresh');
        }

        $this->data['titlehead'] = "Login";
        $this->data["ref_mode_listdata"] = "";

        //validate form input
        $this->form_validation->set_rules('identity', ((strtolower($this->config->item('identity', 'ion_auth')) == 'email') ? 'E-mail' : 'Username'), 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            /*$ldapFlag = $this->mbase->get_record('setting', array('settingName' => 'ldap_flag'), 'settingValue')->settingValue;

            if ((int)$ldapFlag == 0) {

                $this->setLogin();

            } else {
                //bind ldap

                $username = $this->input->post('identity');
                $password = $this->input->post('password');

                if ($this->ldap_auth->connect()) {

                    if ($this->ldap_auth->auth($username, $password)) {

                        // User Ldap tersedia
                        $user = $this->mbase->get_record(config_item('view_user'), array('username' => $username));

                        if (count($user) == 0) {
                            //user not existing

                            $info_ldap = $this->ldap_auth->info($username, "username");
                            //print_r($info_ldap);exit;

                            $email = $info_ldap[0]["userprincipalname"][0];
                            $fullname = $info_ldap[0]["displayname"][0];

                            $additional_data["unitId"] = 0;
                            $additional_data["positionId"] = 0;
                            $additional_data["nik"] = '';
                            $additional_data["phone"] = '';
                            $additional_data["full_name"] = $fullname;
                            $additional_data["photo"] = 'avatar.png';
                            $additional_data["represent"] = 0;
                            $additional_data["representPositionId"] = 0;
                            $additional_data["dt_user"] = 1;

                            $groups[] = 4;

                            $id = $this->ion_auth->register($username, $password, $email, $additional_data, $groups);

                            $this->mcommon->setLog($id, $this->MOD_ALIAS, $id, "Tambah User Ldap");

                        }

                        $this->setLogin();
                        $this->ldap_auth->closed();

                    } else {
                        $this->ldap_auth->closed();

                        $err = "User & Password LDAP tidak sesuai, silahkan hubungi administrator";
                        $this->session->set_flashdata('errmsg', $err);
                        $this->data['errmsg'] = $err;
                    }
                } else {
                    $this->ldap_auth->closed();

                    $err = "Koneksi LDAP GAGAL!";
                    $this->session->set_flashdata('errmsg', $err);
                    $this->data['errmsg'] = $err;
                }
            }*/

            $this->setLogin();
        } else {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $this->data['errmsg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errmsg');
        }


        $this->data['identity'] = array('name' => 'identity',
            'id' => 'identity',
            'type' => 'text',
            'value' => $this->form_validation->set_value('identity'),
            // optional
            'class' => 'form-control',
            'placeholder' => ((strtolower($this->config->item('identity', 'ion_auth')) == 'email') ? 'E-mail' : 'Username'),
            'autofocus' => 'true',
            'style' => 'border-radius: 10px'
        );
        $this->data['password'] = array('name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'value' => $this->form_validation->set_value('password'),
            // optional
            'class' => 'form-control',
            'placeholder' => 'Password',
            'style' => 'border-radius: 10px'
        );


        $this->_render_page('auth/login', $this->data);
    }

    //log the user out
    function logout()
    {
        $this->data['titlehead'] = "Logout";

        //$this->sessauth->remove(); // remove session for sso app

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('auth/login', 'refresh'); //redirect('home', 'refresh');
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


            //render view
            $this->_render_page('auth/change_password', $this->data, false, 'tmpl/vwbacktmpl');
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('errmsg', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    //forgot password
    function forgot_password()
    {
        $this->data['titlehead'] = "Lupa Password";
        //setting validation rules by checking wheather identity is username or email

        if ($this->config->item('identity', 'ion_auth') == 'username') {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }

        if ($this->form_validation->run() == false) {
            //setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control'
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            //set any errors and display the form
            $this->data['err_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            //$this->data['message'] = $this->session->flashdata('message');
            $this->_render_page('auth/forgot_password', $this->data, false, 'tmpl/vwauthtmpl');
        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') == 'username') {
                    $this->ion_auth->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth->set_message('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('err', $this->ion_auth->messages());
                redirect("auth/forgot_password", 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('info', $this->ion_auth->messages());
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('err', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    //reset password - final step for forgotten password
    public function reset_password($code = NULL)
    {
        $this->data['titlehead'] = "Reset Password";
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form

                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                    'class' => 'form-control'
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                    'class' => 'form-control'
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                $this->_render_page('auth/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }


    //activate the user
    function activate($id, $code = false)
    {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('err', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    //deactivate the user
    function deactivate($id = NULL)
    {
        $this->data['titlehead'] = "Deactivate User";
        $this->data['loadhead'] = array();
        $this->data['loadfoot'] = array();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int)$id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('auth/deactivate_user', $this->data, false, 'tmpl/vwMainTmpl');
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('auth/list_user', 'refresh');
        }
    }

    //edit a user
    function xx_edit_user($id)
    {
        $this->data['titlehead'] = "Edit User";
        $this->data['loadhead'] = array();
        $this->data['loadfoot'] = array();

        //custom load javascript, place at footer
        $tagjs1 = "$('#date_birth').datepicker({
						format: 'yyyy-mm-dd',
						clearBtn: true,
						autoclose: true,
						todayHighlight: true
					});";
        $this->data['loadfoot']['tagjs'] = array($tagjs1);


        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $userPr = $this->ion_auth->user_getprofile($id);
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('gender', $this->lang->line('edit_user_validation_gender_label'), 'trim');
        $this->form_validation->set_rules('place_birth', $this->lang->line('edit_user_validation_place_birth_label'), 'trim');
        $this->form_validation->set_rules('date_birth', $this->lang->line('edit_user_validation_date_birth_label'), 'trim');
        $this->form_validation->set_rules('institution_name', $this->lang->line('edit_user_validation_institution_name_label'), 'trim');
        $this->form_validation->set_rules('institution_addr', $this->lang->line('edit_user_validation_institution_addr_label'), 'trim');
        $this->form_validation->set_rules('institution_city', $this->lang->line('edit_user_validation_institution_city_label'), 'trim');
        $this->form_validation->set_rules('institution_province', $this->lang->line('edit_user_validation_institution_province_label'), 'trim');
        $this->form_validation->set_rules('institution_country', $this->lang->line('edit_user_validation_institution_country_label'), 'trim');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            //update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('institution_name'),
                    //'company'    => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );


                $dataProfile = array(
                    'gender' => $this->input->post('gender'),
                    'date_birth' => $this->input->post('date_birth'),
                    'place_birth' => $this->input->post('place_birth'),
                    'institution_name' => $this->input->post('institution_name'),
                    'institution_addr' => $this->input->post('institution_addr'),
                    'institution_city' => $this->input->post('institution_city'),
                    'institution_province' => $this->input->post('institution_province'),
                    'institution_country' => $this->input->post('institution_country'),
                    'phone' => $this->input->post('phone'),
                );

                //update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }


                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }

                //check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {

                    // update profile by kiQ
                    if ($id > 0) {
                        $cek = $this->ion_auth->user_getprofile($id);
                        if (is_object($cek) && $cek->uid > 0) {
                            $this->ion_auth->update_profile($id, $dataProfile);
                        } else {
                            $dataProfile['uid'] = $id;
                            $this->ion_auth->insert_profile($dataProfile);
                        }
                    }

                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth/list_user', 'refresh');
                    } else {
                        redirect('home', 'refresh');
                    }

                } else {
                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('err_message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth/list_user', 'refresh');
                    } else {
                        redirect('home', 'refresh');
                    }

                }

            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('err_message')));
        $this->data['message'] = $this->session->flashdata('message');

        //pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
            'class' => 'form-control',
            'placeholder' => 'enter first name'
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
            'class' => 'form-control',
            'placeholder' => 'enter last name'
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
            'class' => 'form-control',
            'placeholder' => 'enter company name',
        );
        /*$this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
                        'class' => 'form-control',
            'placeholder' => 'enter phone number',
        );*/

        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'enter password',
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'enter confirm password'
        );

        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $user->email),
            'class' => 'form-control',
            'disabled' => 'true'
        );
        $this->data['username'] = array(
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'value' => $this->form_validation->set_value('username', $user->username),
            'class' => 'form-control',
            'disabled' => 'true'
        );

        $this->data['male'] = array(
            'name' => 'gender',
            'id' => 'gender',
            'checked' => ($userPr->gender == "m" ? TRUE : FALSE),
            'value' => "m"
        );

        $this->data['female'] = array(
            'name' => 'gender',
            'id' => 'gender',
            'checked' => ($userPr->gender == "f" ? TRUE : FALSE),
            'value' => "f"
        );

        $this->data['place_birth'] = array(
            'name' => 'place_birth',
            'id' => 'place_birth',
            'type' => 'text',
            'value' => $this->form_validation->set_value('place_birth', $userPr->place_birth),
            'class' => 'form-control',
            'placeholder' => 'enter place birth',
        );
        $this->data['date_birth'] = array(
            'name' => 'date_birth',
            'id' => 'date_birth',
            'type' => 'text',
            'readOnly' => 'true',
            'value' => $this->form_validation->set_value('date_birth', $userPr->date_birth),
            'class' => 'form-control',
            'placeholder' => 'enter date of birth',
        );
        $this->data['institution_name'] = array(
            'name' => 'institution_name',
            'id' => 'institution_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('institution_name', $userPr->institution_name),
            'class' => 'form-control',
            'placeholder' => 'enter institution name',
        );
        $this->data['institution_addr'] = array(
            'name' => 'institution_addr',
            'id' => 'institution_addr',
            'type' => 'text',
            'value' => $this->form_validation->set_value('institution_addr', $userPr->institution_addr),
            'class' => 'form-control',
            'placeholder' => 'enter institution address',
        );
        $this->data['institution_city'] = array(
            'name' => 'institution_city',
            'id' => 'institution_city',
            'type' => 'text',
            'value' => $this->form_validation->set_value('institution_city', $userPr->institution_city),
            'class' => 'form-control',
            'placeholder' => 'enter institution city',
        );
        $this->data['institution_province'] = array(
            'name' => 'institution_province',
            'id' => 'institution_province',
            'type' => 'text',
            'value' => $this->form_validation->set_value('institution_province', $userPr->institution_province),
            'class' => 'form-control',
            'placeholder' => 'enter institution province',
        );
        $this->data['institution_country'] = array(
            'name' => 'institution_country',
            'id' => 'institution_country',
            'type' => 'text',
            'value' => $this->form_validation->set_value('institution_country', $userPr->institution_country),
            'class' => 'form-control',
            'placeholder' => 'enter institution country',
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $userPr->phone),
            'class' => 'form-control',
            'placeholder' => 'enter phone number',
        );

        $this->_render_page('auth/edit_user', $this->data, false, 'tmpl/vwMainTmpl');
    }

    // create a new group
    function xx_create_group()
    {
        $this->data['titlehead'] = $this->lang->line('create_group_title');
        $this->data['loadhead'] = array();
        $this->data['loadfoot'] = array();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/list_user", 'refresh');
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : ""));
            $this->data['message'] = $this->session->flashdata('message');

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
                'class' => 'form-control',
                'placeholder' => 'enter group name',
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
                'class' => 'form-control',
                'placeholder' => 'enter description',
            );

            $this->_render_page('auth/create_group', $this->data, false, 'tmpl/vwMainTmpl');
        }
    }

    //edit a group
    function xx_edit_group($id)
    {
        $this->data['loadhead'] = array();
        $this->data['loadfoot'] = array();

        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth/list_user', 'refresh');
        }

        $this->data['titlehead'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('err_message', $this->ion_auth->errors());
                }
                redirect("auth/list_user", 'refresh');
            }
        }

        //set the flash data error message if there is one
        $this->data['errmsg'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('err_message')));
        $this->data['message'] = $this->session->flashdata('message');

        //pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
            'class' => 'form-control',
            'placeholder' => 'enter group name'
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
            'class' => 'form-control',
            'placeholder' => 'enter description'
        );

        $this->_render_page('auth/edit_group', $this->data, false, 'tmpl/vwMainTmpl');
    }

    function register_form()
    {
        $this->data['titlehead'] = "Registrasi";

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_ASSET_PATH . 'plugins/datatables/jquery.dataTables.rowGrouping.js',
            HTTP_MOD_JS . 'modules/auth/auth_js.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        if ($this->ion_auth->logged_in()) {
            redirect('main/dashboard', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', 'Username', 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', 'Nomor telepon/hp', 'trim');
        $this->form_validation->set_rules('address', 'Alamat', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi password', 'required');

        $this->form_validation->set_rules('inst_id', 'Nama Instansi', 'trim');
        $this->form_validation->set_rules('captcha', 'Teks captcha', 'required|trim|callback_check_captcha');

        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('is_unique', '{field} sudah digunakan ! !');

        if ($this->form_validation->run() == true) {
            $email = strtolower($this->input->post('email'));
            //$identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            $additional_data = array(
                'full_name' => $this->input->post('full_name')
            );
            $group_ids = array();
            $user_profile = array();
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data, $group_ids, $user_profile)) {
            // check to see if we are creating the user
            // redirect them back to the login page
            $this->session->set_flashdata('info', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->session->set_flashdata('err', $this->data['message']);
        }


        $this->_render_page('auth/regis_form', $this->data, false, 'tmpl/vwauthtmpl');
    }


    public function captcha()
    {
        $this->simplecaptcha->CreateImage();
    }

    function check_captcha()
    {
        $captcha = $this->input->post('captcha');
        if (trim($captcha) != '') {
            if ($captcha != $this->session->userdata('coolcaptcha')) {
                //if ($captcha != $this->session->flashdata('coolcaptcha')) {
                $this->form_validation->set_message('check_captcha', '%s tidak sesuai !');
                return FALSE;
            } else {
                return TRUE;
            }
            $this->session->unset_userdata("coolcaptcha");
        }
    }


    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        //$this->session->keep_flashdata('csrfkey');
        $this->session->set_flashdata('csrfvalue', $value);
        //$this->session->keep_flashdata('csrfvalue');
        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')
        ) {
            return TRUE;
        } else {
            return FALSE;
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

    function _valid_csrf_q()
    {
        if ($this->input->post($this->session->userdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->userdata('csrfkey')) == $this->session->userdata('csrfvalue')
        ) {
            $this->session->unset_userdata('csrfkey');
            $this->session->unset_userdata('csrfvalue');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false, $tmpl = 'tmpl/vwauthtmpl')
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        //$view_html = $this->load->view($view, $this->viewdata, $render);
        $view_html = $this->template->load($tmpl, $view, $this->viewdata, $render);
        if (!$render) return $view_html;
    }

    function whitespace_check($str)
    {
        if (ctype_space($str)) {
            $this->form_validation->set_message('whitespace_check', 'The {field} field can not contain whitespace');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
