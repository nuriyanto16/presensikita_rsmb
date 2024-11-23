<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mst_controller
 *
 * @author MST
 *
 * @property CI_DB $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Form_validation $validation
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 * @property CI_Javascript $javascript
 * @property CI_Jquery $jquery
 * @property CI_Utf8 $utf8
 * @property CI_Security $security
 * @property CI_Migration $migration
 * @property CI_Parser $parser
 *
 * @property Qsecure $qsecure
 * @property Mcommon $mcommon
 * @property Mrole_manage $mrole
 */
class Mst_controller extends MX_Controller
{
    protected $MOD_ALIAS = "";
    public $data;
    public $viewdata;
    public $crud;

    protected $_userid;
    protected $_username;
    protected $_useremail;
    protected $_userfullname;
    protected $_roleid;
    protected $_rolename;
    protected $_rolealias;
    protected $_compid;
    protected $_compcode;
    protected $_compname;
    protected $_siteid;
    protected $_sitecode;
    protected $_sitename;
    protected $_unitid;
    protected $_unitname;
    protected $_positionid;
    protected $_positionname;
    protected $_positiontype;
    protected $_positionlevel;
    protected $_idjenissurat;
    protected $_parentunitid;
    protected $_unitcode;
    protected $_positiondesc;
    protected $_positioncode;

    public $_new,$_edit,$_delete,$_print,$_approve;
    public $unit_code, $position_name, $unit_name, $position_desc;

    public $unit_list = array();
    public $error_upload;

    function __construct()
    {
        parent::__construct();

        //$this->lang->load('auth');
        $this->load->model("Mst_model", "mbase");
        $this->load->model("Mcommon", "mcommon");
        $this->load->model("utility/mrole_manage","mrole");
        $this->load->helper('cookie');
        $this->load->library('upload');

        if (!$this->ion_auth->logged_in()) {
            //redirect('auth/login', 'refresh');
            $this->session->set_userdata('referred_from', current_url());
            redirect('auth', 'refresh');
        } else {
            $this->_userid = $this->session->userdata(sess_prefix() . "userid");
            $this->_username = $this->session->userdata(sess_prefix() . "username");
            $this->_useremail = $this->session->userdata(sess_prefix() . "email");
            $this->_userfullname = $this->session->userdata(sess_prefix() . "full_name");
            $this->_roleid = $this->session->userdata(sess_prefix() . "roleid");
            $this->_rolename = $this->session->userdata(sess_prefix() . "rolename");
            $this->_rolealias = $this->session->userdata(sess_prefix() . "rolealias");

            $this->_compid= $this->session->userdata(sess_prefix() . "compId");
            $dataComp = $this->mcommon->getCompany($this->_compid);
            $this->_compname = ($dataComp!=null) ? $dataComp->COMP_NAME : "";
            $this->_compcode = ($dataComp!=null) ? $dataComp->COMP_CODE : "";

            /*$this->_siteid= $this->session->userdata(sess_prefix() . "siteId");
            $dataSite = $this->mcommon->getSite($this->_siteid);
            $this->_sitename = ($dataSite!=null) ? $dataSite->siteName : "";
            $this->_sitecode = ($dataSite!=null) ? $dataSite->siteCode : "";*/

            $this->_unitid= $this->session->userdata(sess_prefix() . "unitId");
            $this->_positionid= $this->session->userdata(sess_prefix() . "positionId");
            $this->_positioncode = $this->session->userdata(sess_prefix() . "positioncode");

            /*//cek mewakili
            if($dt_user->represent) {
                $this->_unitid=$dt_user->unitId;
                $this->_positionid=$dt_user->representPositionId;
            }

            //cek pelaksana harian
            $dt_acting = $this->mcommon->getActingAs($this->_userid);
            if(!empty($dt_acting) && count($dt_acting) > 0) {
                $this->_unitid=$dt_acting->unitId;
                $this->_positionid=$dt_acting->positionId;
            }*/

            $dataUnit= $this->mcommon->getUnit($this->_unitid);
            $this->_unitname = ($dataUnit!=null) ? $dataUnit->unitName : "";
            $this->_parentunitid= ($dataUnit!=null) ? $dataUnit->parentUnitId : 0;
            $this->_unitcode = ($dataUnit!=null) ? $dataUnit->unitCode : "";

            $dataPosition= $this->mcommon->getPosition($this->_positionid);
            $this->_positionname = ($dataPosition!=null) ? $dataPosition->positionName : "";
            $this->_positiontype = ($dataPosition!=null) ? $dataPosition->positionType : "Staff";
            $this->_positionlevel = ($dataPosition!=null) ? $dataPosition->positionLevel : 6;

            //$this->_positiondesc = ($dt_user!=null) ? $dt_user->positionDesc : "";
        }

    }

    public function _checkAuthorization($MOD_ALIAS)
    {
        $this->MOD_ALIAS = $MOD_ALIAS;
        $isAuthorized = false;
        $user_id = $this->session->userdata(sess_prefix() . "userid");
        $role_id = $this->session->userdata(sess_prefix() . "roleid");
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
            if ($this->MOD_ALIAS == "MOD_HOME" OR $this->mcommon->checkMenuAccess($role_id, $this->MOD_ALIAS)) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized) {
            redirect('main/dashboard', 'refresh');
        }else{
            $this->crud = $this->mcommon->getMenuAccessCRUD($role_id, $this->MOD_ALIAS);

            if($this->crud!=null) {
                $this->_new = $this->crud->allow_new;
                $this->_edit = $this->crud->allow_edit;
                $this->_delete = $this->crud->allow_delete;
                $this->_print = $this->crud->allow_print;
                $this->_approve = $this->crud->allow_approve;
            }else{
                $this->_new = false;
                $this->_edit =  false;
                $this->_delete =  false;
                $this->_print =  false;
                $this->_approve =  false;
            }

        }

        $this->unit_code = $this->get_unitcode();
        $this->position_name = $this->get_positionname();
        $this->unit_name = $this->get_unitname();
        $this->position_desc = $this->get_positiondesc();

    }

    function _render_page($view, $data = null, $render = false, $tmpl = 'tmpl/vwbacktmpl')
    {

        //$this->viewdata = (empty($data)) ? $this->data : $data;

        $this->data["_new"] = $this->_new;
        $this->data["_edit"] = $this->_edit;
        $this->data["_delete"] = $this->_delete;
        $this->data["_print"] = $this->_print;
        $this->data["_approve"] = $this->_approve;

        $this->data["unitcode"] = $this->unit_code;
        $this->data["positionname"] = $this->position_name;
        $this->data["unitname"] = $this->unit_name;
        $this->data["positiondesc"] = $this->position_desc;

        $view_html = $this->template->load($tmpl, $view, $this->data, $render);
        if (!$render) return $view_html;
    }

    public function _set_sess_opd($unit_id)
    {
        $this->session->set_userdata($this->SNAME_UNIT_ID, $unit_id);
    }

    public function _get_sess_opd()
    {
        $this->session->userdata($this->SNAME_UNIT_ID);
    }

    public function _get_sess_csrf()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_userdata('csrfkey', $key);
        $this->session->set_userdata('csrfvalue', $value);
        return array($key => $value);
    }

    public function _valid_sess_csrf()
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

    public function is_admin()
    {
        if ($this->_roleid == 1 || $this->_roleid == 2) {
            return TRUE;
        }
        return FALSE;
    }

    public function generateNoSuratReg($tahunSurat,$idJenisSurat,$positionLevelApprove) {

        $no_urutSurat ="";

        if($positionLevelApprove == 1 || $positionLevelApprove == 2) {
            $field = "noSuratReg";
            $order_by = "noSuratReg DESC";

            $where["no_tahunSurat"] = $tahunSurat;
            $where["idJenisSurat"] = $idJenisSurat;
            $data = $this->mbase->get_record('draft_surat',$where,$field, $order_by, 1);

            if(!empty($data)) {

                $urutSurat = intval($data->noSuratReg) + 1;
                $no_urutSurat = str_pad($urutSurat,4,'0',STR_PAD_LEFT);
            } else {
                $no_urutSurat = str_pad(1,4,'0',STR_PAD_LEFT);
            }
        }

        return $no_urutSurat;
    }

    public function generateNoSurat($siteCode, $unitCode, $aliasJenisSurat,
                                    $kodeJenisSurat, $tahunSurat) {

        $field = "no_urutSurat,no_urutSurat2";
        $order_by = "no_urutSurat2 DESC, no_urutSurat DESC";


        if($aliasJenisSurat == "PE" || $aliasJenisSurat == "SE" ||
            $aliasJenisSurat == "BA"){
            $where["no_aliasJenisSurat"] = $aliasJenisSurat;
        }

        if($aliasJenisSurat == "EXT") {
            $where["no_siteCode"] = $siteCode;
        }

        $where["no_unitCode"] = $unitCode;
        $where["no_kodeJenisSurat"] = $kodeJenisSurat;
        $where["no_tahunSurat"] = $tahunSurat;

        $data = $this->mbase->get_record('draft_surat',$where,$field, $order_by, 1);

        $jml_urut = 3;
        $max_nil = 1000;
        if($aliasJenisSurat == "BA") {
            $jml_urut = 2;
            $max_nil = 100;
        }

        $no_surat = "";
        $urutSurat = 0;
        $urutSurat2 = 0;
        $no_urutSurat="";
        $no_urutSurat2="";
        if(count($data) > 0) {

            $urutSurat = intval($data->no_urutSurat) + 1;
            if($urutSurat >= $max_nil) {
                $urutSurat = 1;
                $urutSurat2 = $data->no_urutSurat2 + 1;
            }

            $no_urutSurat = str_pad($urutSurat,$jml_urut,'0',STR_PAD_LEFT);
        } else {
            $no_urutSurat = str_pad(1,$jml_urut,'0',STR_PAD_LEFT);
        }

        if($urutSurat2 > 0) {
            $no_urutSurat2 = "/".$urutSurat2;
        }else{
            $no_urutSurat2 = "";
        }

        $thn = substr($tahunSurat,2,2);

        switch($aliasJenisSurat) {
            case "INT" :
                $no_surat = $unitCode ."/" .$kodeJenisSurat.$no_urutSurat.$no_urutSurat2."/". $thn;
                break;
            case "EXT" :
                $no_surat = $siteCode."/".$unitCode ."-" .$kodeJenisSurat.$no_urutSurat.$no_urutSurat2."/". $thn;
                break;
            case "PE" :
                $no_surat = $unitCode ."/" .$aliasJenisSurat."-".$kodeJenisSurat.$no_urutSurat.$no_urutSurat2."/". $thn;
                break;
            case "SE" :
                $no_surat = $unitCode ."/" .$aliasJenisSurat."-".$kodeJenisSurat.$no_urutSurat.$no_urutSurat2."/". $thn;
                break;
            case "BA" :
                $no_surat = $unitCode ."/" .$aliasJenisSurat."-".$kodeJenisSurat.$no_urutSurat.$no_urutSurat2."/". $thn;
                break;
        }

        $data_no["no_surat"] = $no_surat;
        $data_no["no_urut_surat"] = $no_urutSurat;
        $data_no["no_urut_surat2"] = $urutSurat2;

        return $data_no;
    }

    public function uploadFile($path,$file,$ftp=false) {
        $data=null;

        $path_upload = BASE_UPLOAD_PATH . "/" . $path;
        if(!is_dir($path_upload)) mkdir($path_upload);

        $config['upload_path'] = $path_upload; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|txt|csv|xls|xlsx|doc|docx|ppt|pptx'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '10048'; //maksimum besar file 10M
        $config['max_width'] = '1788'; //lebar maksimum 1288 px
        $config['max_height'] = '1968'; //tinggi maksimu 768 px

//        if($change_filename) {
//            if($change_name!="") {
//                $config['file_name'] = $change_name . "_" . time();
//            } else {
//                $config['file_name'] = $_FILES[$file]['name'] . "_" . time(); //nama yang terupload nantinya
//            }
//        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload($file)) {
            $data = $this->upload->data();

            $this->error_upload = $this->upload->display_errors();

            if($ftp) {
                $this->load->library('ftp');

                $ftp_host = $this->mbase->get_row('setting','settingName','ftp_host')->settingValue;
                $ftp_port = $this->mbase->get_row('setting','settingName','ftp_port')->settingValue;
                $ftp_user = $this->mbase->get_row('setting','settingName','ftp_user')->settingValue;
                $ftp_pass = $this->mbase->get_row('setting','settingName','ftp_pass')->settingValue;
                $ftp_root = $this->mbase->get_row('setting','settingName','ftp_root')->settingValue;
                $ftp_debug = $this->mbase->get_row('setting','settingName','ftp_debug')->settingValue;

                //FTP configuration
                $ftp_config['hostname'] = $ftp_host;
                $ftp_config['username'] = $ftp_user;
                $ftp_config['password'] = $ftp_pass;
                $ftp_config['port']     = $ftp_port;
                $ftp_config['passive']  = FALSE;
                if((int)$ftp_debug == 1){
                    $ftp_config['debug']    = TRUE;
                }else{
                    $ftp_config['debug']    = FALSE;
                }

                //Connect to the remote server
                $this->ftp->connect($ftp_config);

                $mode='ascii';
                $permission = '0775';

                if(is_array($data)) {

                    foreach ($data as $value){
                        $fileName = $value['file_name'];
                        $source_file = $value['full_path'];

                        //File upload path of remote server
                        $dest_root =$ftp_root;
                        $dest_file = $dest_root . 'upload/'.$fileName;

                        //Upload file to the remote server
                        $this->ftp->upload($source_file, $dest_file, $mode, $permission);

                        //Delete file from local server
                        //@unlink($source);
                    }

                } else {

                    $fileName = $data['file_name'];
                    $source_file = $data['full_path'];

                    //File upload path of remote server
                    $dest_root = $ftp_root;
                    $dest_file = $dest_root . 'upload/'.$fileName;

                    //Upload file to the remote server
                    $this->ftp->upload($source_file, $dest_file, $mode, $permission);
                }


                //Close FTP connection
                $this->ftp->close();
            }

//            $data['err'] = false;
//            $data['errmsg'] = "";
        } else {
            $data = false;
        }

        return $data;
    }

    public function get_error_upload(){
        return $this->error_upload;
    }

    public function downloadFile($idLampiran,$ftp=false) {

        $attachment = $this->mbase->get_record('lampiran_surat',array('idLampiran' => $idLampiran));

        $content_type = $attachment->fileType;
        $filename = $attachment->fileName;
        $filename_path = FCPATH . "\\" .BASE_UPLOAD_PATH . "\\" . $attachment->filePath . "\\" . $filename;

        //echo $filename_path;exit;

        //$filename_path

        if(!$ftp) {
//            //download ke lokal storage
//            if(!is_dir($path_upload)) mkdir($path_upload);
//
//            // Make sure the file exists
//            if (!file_exists($filename_path))

            $len = filesize($filename_path);

            // Begin writing headers
            ob_clean(); // Clear any previously written headers in the output buffer

            $filename_info = pathinfo($filename);
            $extension = "." . $filename_info['extension'];
            $basename = basename($filename, $extension);

            $mod_filename = $basename . $extension;

            $type_download = 'attachment';
            //if($preview) $type_download = 'inline';

            header("Content-Disposition: $type_download; filename=\"$mod_filename\"");
            header("Content-Type: $content_type");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".$len);
            header("Pragma: no-cache");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Expires: 0");
            @readfile($filename_path);
            exit;

        } else {
            //download ke server ftp storage

            $this->load->library('ftp');

            $ftp_host = $this->mbase->get_row('setting','settingName','ftp_host')->settingValue;
            $ftp_port = $this->mbase->get_row('setting','settingName','ftp_port')->settingValue;
            $ftp_user = $this->mbase->get_row('setting','settingName','ftp_user')->settingValue;
            $ftp_pass = $this->mbase->get_row('setting','settingName','ftp_pass')->settingValue;
            $ftp_root = $this->mbase->get_row('setting','settingName','ftp_root')->settingValue;
            $ftp_debug = $this->mbase->get_row('setting','settingName','ftp_debug')->settingValue;

            //FTP configuration
            $ftp_config['hostname'] = $ftp_host;
            $ftp_config['username'] = $ftp_user;
            $ftp_config['password'] = $ftp_pass;
            $ftp_config['port']     = $ftp_port;
            $ftp_config['passive']  = FALSE;
            if((int)$ftp_debug == 1){
                $ftp_config['debug']    = TRUE;
            }else{
                $ftp_config['debug']    = FALSE;
            }

            //Connect to the remote server
            $this->ftp->connect($ftp_config);

            $remote_path = $ftp_root . 'upload/'.$filename;
            $local_path  = $filename_path;
            $mode='ascii';
            //Upload file to the remote server
            $this->ftp->download($remote_path, $local_path, $mode);

            //Close FTP connection
            $this->ftp->close();
        }

    }

    public function getHirarkiUnit($unitId) {
        $unit = array();
        $child = array();
        $dt = $this->mbase->get_record('v_unit',array('unitId' => $unitId));

        if(!empty($dt)) {
            $parentUnitId = $dt->parentUnitId;
            if($parentUnitId !== null) {
                $unit[] = $parentUnitId;

                $child = $this->getHirarkiUnit($parentUnitId);
                if($child) {
                    $unit[] = $child;
                }
            }
        }


        return $unit;
    }

    public function getHirarkiUnitSelect2Tree($unitId) {
        $countUnit = count($unitId);
        if($countUnit > 1){
            $buildUp = '';
            foreach($unitId as $rowParent){
                if($buildUp == null){
                    $buildUp .= $rowParent;
                }else{
                    $buildUp .= ",".$rowParent;
                }
                $dt = $this->mbase->get_list(config_item("view_unit"),array('parentUnitId' => $rowParent));
                if($dt) {
                    foreach($dt as $rowChild){
                    
                        $buildUp .= ",".$rowChild->unitId;
                    }
                }
            }
        }else{
            $buildUp = $unitId[0];
            $dt = $this->mbase->get_list(config_item("view_unit"),array('parentUnitId' => $unitId[0]));
            if($dt) {
                foreach($dt as $rowChild){
                    $buildUp .= ",".$rowChild->unitId;
                }
            }
        }
        
        return $buildUp;
    }

    public function getHirarkiChildUnit($unitId) {
        $unit = array();
        $dt = $this->mbase->get_list(config_item("view_unit"), array('parentUnitId' => $unitId));

        if($dt != null && count($dt) > 0) {
            foreach ($dt as $chd) {
                $unit[] = $chd->unitId;
                $child = $this->getHirarkiChildUnit($chd->unitId);
                if(is_array($child) && count($child) > 0) {
                    $unit = array_merge($unit, $child);
                }
            }
        }

        return $unit;
    }

    public function renderHirarki($units) {

        foreach($units as $value) {
            if(!is_array($value)) {
                array_push($this->unit_list, $value);
            } else {
                $this->renderHirarki($value);
            }
        }

    }

    public function getParentApprove($parentunitid) {

        $units = $this->getHirarkiUnit($this->get_unitid());
        $this->renderHirarki($units);
        $unit_arr = $this->getUnit_list();

        $where ="";
        $where .= "unitId = '".$parentunitid."' ";

        if(!empty($this->_idjenissurat)) {
            $where .= " AND positionId IN (select positionId from off_position_surat where idJenisSurat = '".$this->_idjenissurat."') ";
        }

        if(count($unit_arr) > 0){
            $where .= " AND unitId IN (" . implode(', ', $unit_arr) . ") ";
        }


        $data = $this->mbase->get_record("v_sec_user",$where);

        if(empty($data)) {
            $dt = $this->mbase->get_record('v_unit',array('unitId' => $parentunitid));

            if(!empty($dt)){
                if($dt->parentUnitId != "" || $dt->parentUnitId!=null){

                    return $this->getParentApprove($dt->parentUnitId);
                }
            }

            return array();
        }else {
            return $data;
        }
        //$surat = $this->mbase->get_record("v_sec_user",$where);

    }

    public function get_idjenissurat() {
        return $this->_idjenissurat;
    }

    public function set_idjenissurat($_idjenissurat) {
        $this->_idjenissurat = $_idjenissurat;
    }

    public function getUnit_list() {
        return $this->unit_list;
    }

    public function get_userid() {
        return $this->_userid;
    }

    public function get_username() {
        return $this->_username;
    }

    public function get_useremail() {
        return $this->_useremail;
    }

    public function get_userfullname() {
        return $this->_userfullname;
    }

    public function get_phone() {
        return $this->_phone;
    }

    public function get_roleid() {
        return $this->_roleid;
    }

    public function get_rolename() {
        return $this->_rolename;
    }

    public function get_rolealias() {
        return $this->_rolealias;
    }

    public function get_compid() {
        return $this->_compid;
    }

    public function get_compname() {
        return $this->_compname;
    }

    public function get_compcode() {
        return $this->_compcode;
    }

    public function get_siteid() {
        return $this->_siteid;
    }

    public function get_sitename() {
        return $this->_sitename;
    }

    public function get_unitid() {
        return $this->_unitid;
    }

    public function get_unitname() {
        return $this->_unitname;
    }

    public function get_positionid() {
        return $this->_positionid;
    }

    public function get_positionname() {
        return $this->_positionname;
    }

    public function get_positiontype() {
        return $this->_positiontype;
    }

    public function get_positionlevel() {
        return $this->_positionlevel;
    }

    public function get_parentunitid() {
        return $this->_parentunitid;
    }

    public function get_unitcode() {
        return $this->_unitcode;
    }

    public function get_sitecode() {
        return $this->_sitecode;
    }

    public function get_positiondesc() {
        return $this->_positiondesc;
    }

    public function get_positioncode() {
        return $this->_positioncode;
    }

    public function get_currentDate() {
        date_default_timezone_set('Asia/Jakarta');
        return date("Y-m-d H:i:s");
    }

    public function getLabelStatus() {

        $list_status[0] = "Pilih Status";
        $list_status[1] = "Created";
        $list_status[2] = "Progress";
        $list_status[3] = "Completed";
        $list_status[4] = "Rejected";

        return $list_status;
    }

    public function getLabelStatusMonitoring() {

        $list_status[1] = "Belum diverifikasi";
        $list_status[2] = "Sedang diverifikasi";
        $list_status[3] = "Setuju";
        $list_status[4] = "Tidak Setuju";

        return $list_status;
    }

    public function getIconStatus($status, $status_label) {

        $img = base_url() . "/assets/images/";
        if($status == 1){
            $img .=  "ic_created.gif";
        }else if($status == 2){
            $img .=  "ic_progress.gif";
        } else if($status == 3){
            $img .=  "ic_completed.png";
        } else if($status == 4){
            $img .=  "ic_reject.gif";
        } else {
            $img =  "";
        }

        if ($img != ""){
            return "<img src='$img' alt='$status_label' title='$status_label' />";
        }else{
            return "";
        }

    }

    public function internal_doc($surat,$surat_to,$surat_cc)
    {
        $head = "
            <table width='650' border='0' style='text-align: center;' >
                <tr>
                    <td><img src='".assets_url()."images/logo.png' style='max-width: 200px; max-height: 200px;'></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align='right' style='font-size: 12pt; letter-spacing: 2pt;'>Antar Unit Kerja</td>
                </tr>
            </table>";

        $nama_attn = "";
        $unit_code = "";
        $header_to = "";
        $header_cc = "";
        $unit_code_cc = "";


        $attn_arr = array();
        $unit_code_arr = array();
        $unit_code_cc_arr = array();

        if(count($surat_to) > 0) {

            $header_to .= "<td style='font-size: 11.5pt;'>Kepada</td>
                                <td style='font-size: 10.5pt;'> :";

            foreach($surat_to as $row) {
                array_push($attn_arr,$row->full_name);
                array_push($unit_code_arr,$row->unitCode);

                $header_to .= "&nbsp;&nbsp;&nbsp;-&nbsp;".$row->prefix ." ".$row->full_name."<br/>";
            }

            //if(count($attn_arr)>0) $nama_attn = implode (", ", $attn_arr);
            if(count($unit_code_arr)>0) $unit_code = implode (", ", $unit_code_arr);

            $header_to .= "</td>";

            if(count($surat_to) >= 5) {
                $nama_attn ="-";
                $header_to = "";
            }

        }

        if (count($surat_cc) > 0) {
            $header_cc .= "<td style='font-size: 10.5pt;'>";

            foreach($surat_cc as $row) {
                array_push($unit_code_cc_arr,$row->userFullName);

                $header_cc .= "&nbsp;&nbsp;&nbsp;-&nbsp; ".$row->userFullName."<br/>";
            }

            if(count($unit_code_cc_arr)>0) $unit_code_cc = implode (", ", $unit_code_cc_arr);

            $header_cc .= "</td>";

        }

        //$tglSurat = fdate_by_format($surat->tglSurat,"Y-m-d",'d F Y');
        $tglSurat_cr=date_create($surat->tglSurat);
        $tglSurat_asli = date_format($tglSurat_cr,"d-n-Y");
        $tglSurat = $this->tgl_indo($tglSurat_asli);

        $subject = $surat->perihal;
        $perihal = "";
        if(strlen($subject) > 45) {
            $subject = "*) ";
            $perihal = $subject . $surat->perihal;
        }

        $userNameApprove = $surat->userNameApprove;
        $html_plh= "";
        // SET PELAKSANA HARIAN
        if($surat->userIdPlhApprove > 0) {
            //cek pelaksana harian
            $dt_acting = $this->mcommon->getActingAs($surat->userIdPlhApprove);
            if(count($dt_acting) > 0) {
                $html_plh = "<tr><td>Pelaksana Harian</td></tr>";
                $userNameApprove = $dt_acting->userFullName;
            }
        }

        //--QR Code
        $path_upload_qr = BASE_UPLOAD_PATH . "/qrcode/";
        if(!is_dir($path_upload_qr)) mkdir($path_upload_qr);

        $filename_path_qr = $path_upload_qr . 'qr_code_'.$surat->unitCodeApprove.'_'.$surat->idDraft.'.png';
        if(file_exists($filename_path_qr)) unlink ($filename_path_qr);

        $this->load->library('ciqrcode');
        $qrFileName = 'qr_code_'.$surat->unitCodeApprove.'_'.$surat->idDraft;
        $params['data'] = $this->qsecure->encrypt($surat->idDraft.'_'
            .$userNameApprove."_"
            .$surat->unitCodeApprove.'_'
            .$surat->positionNameApprove.'_'
            .$surat->unitNameApprove.'_'
            .$surat->jenisSurat.'_'
            .$surat->noSurat.'_'
            .date('Y-m-d'));
        $params['level'] = 'H';
        $params['size'] = 2;
        $params['savename'] = $path_upload_qr."$qrFileName.png";
        $this->ciqrcode->generate($params);
        //--end QR Code

        $header = "
            <table width='550' border='0' style='padding-left: 100px;'>
                <tr><td colspan='4' style='font-size: 5pt;' height='5'>&nbsp;</td></tr>
                <tr>
                    <td width='50' style='font-size: 10.5pt;'>".$tglSurat."</td>
                </tr>
                <tr>
                    <td style='font-size: 11.5pt;'>Nomor</td>
                    <td style='font-size: 10.5pt;'>: ".$surat->no_surat."</td>
                </tr>
                <tr>
                    ".$header_to."
                    <td colspan='2' style='font-size: 5pt;' height='5'>&nbsp;</td>
                </tr>
                <tr>
                    <td style='font-size: 11.5pt;'>Dari</td>
                    <td style='font-size: 10.5pt;'>: ".$surat->fromUnitName."</td>
                </tr>
                <tr>
                    <td style='font-size: 11.5pt;'>Hal</td>
                    <td style='font-size: 10.5pt;'>: ".$surat->perihal."</td>
                </tr>
            </table>";

        $detail = "
            <table width='650' border='0' style='padding-left: 99px; font-size: 10.5pt;'>";
        if($perihal!="") $detail .="<tr><td>".$perihal."</td></tr>";
        $detail.="
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td style='text-align: justify; text-justify: inter-word;'>
                       ".$surat->isiSurat."
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>";

        $detail.= "<tr><td>Jabatan ".$surat->positionNameApprove." - ".$surat->unitNameApprove."</td></tr>
                    ".$html_plh."
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>Nama Pejabat ".$userNameApprove."</td></tr>
                    <tr><td>".$surat->nik."</td></tr>
                    
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td>Tembusan : </td>
                    </tr>
                    <tr>
                        ".$header_cc."
                    </tr>
                </table>";


        $footer = '
                        <table width="800" style="border-collapse:collapse;">
                            <tr>
                                <td align="left" style="border-top:1px solid #000;font-size:10px;font-weight:bold;"><i>'.date("D, j M Y H:i").'</i></td>
                                <td align="right" style="border-top:1px solid #000;font-size:10px;font-weight:bold;"><i>Page {PAGENO} of ({nbpg})</i></td>
                            </tr>
                        </table>';

        $html = $head. $header. $detail;
        $this->mpdf=new mPDF('utf-8', 'A4', 0, 'myriadpro');
        $this->mpdf->AddPage();
        $this->mpdf->WriteHTML($html, 2);
        $this->mpdf->SetHTMLFooter($footer);
        $path_upload =  BASE_UPLOAD_PATH . "/draft_surat/";
        $this->mpdf->Output('srt_eksternal_'.date("ymdHis").'.pdf','I');
        $path_upload = BASE_UPLOAD_PATH . "/internal/";
        if(!is_dir($path_upload)) mkdir($path_upload);

        $filename_path = $path_upload . 'srt_internal_'.$surat->unitCodeApprove.'_'.$surat->idDraft.'.pdf';


        // if(file_exists($filename_path)) unlink ($filename_path);
        // $this->mpdf->Output($filename_path);


        // $filex = pathinfo($filename_path);

        // $filex["isi_body"] = $header. $detail;
        // $filex["file_type"] = "application/".$filex['extension'];
        // $filex["file_size"] = intval(filesize($filename_path) / 1024);

        // return $filex;
    }

    public function eksternal_doc($surat,$surat_to_eks,$surat_cc,$surat_cc_eks,$site)
    {

        $tglSurat_cr=date_create($surat->tglSurat);
        $tglSurat_asli = date_format($tglSurat_cr,"d-n-Y");
        $tglSurat = $this->tgl_indo($tglSurat_asli);

        $unit_code_cc = "";
        $unit_code_cc_arr = array();
        if(count($surat_cc) > 0) {
            foreach($surat_cc as $row) {
                array_push($unit_code_cc_arr,$row->unitCode);
            }

            if(count($unit_code_cc_arr)>0) $unit_code_cc = implode (", ", $unit_code_cc_arr);
        }

        $surat_to = "";
        $surat_to_eks_arr = array();
        if(count($surat_to_eks) > 0) {
            foreach($surat_to_eks as $row) {
                array_push($surat_to_eks_arr,$row->namaEks);
            }

            if(count($surat_to_eks_arr)>0) $surat_to = implode (", ", $surat_to_eks_arr);
        }

        $surat_cc_eks_int = "";
        $surat_cc_eks_arr = array();
        if(count($surat_cc_eks) > 0) {
            foreach($surat_cc_eks as $row) {
                array_push($surat_cc_eks_arr,$row->namaCcEks);
            }

            if(count($surat_cc_eks_arr)>0) $surat_cc_eks_int = implode (", ", $surat_cc_eks_arr);
        }

        $surat_cc_arr = array();
        if(count($surat_cc) > 0) {
            foreach($surat_cc as $row) {
                array_push($surat_cc_arr,$row->unitCode);
            }
            $surat_cc_eks_int .= ', ';
            if(count($surat_cc_arr)>0) $surat_cc_eks_int .= implode (", ", $surat_cc_arr);
        }

        $userNameApprove = $surat->userNameApprove;
        $html_plh= "";
        // SET PELAKSANA HARIAN
        if($surat->userIdPlhApprove > 0) {
            //cek pelaksana harian
            $dt_acting = $this->mcommon->getActingAs($surat->userIdPlhApprove);
            if(count($dt_acting) > 0) {
                $html_plh = "<tr><td>Pelaksana Harian</td></tr>";
                $userNameApprove = $dt_acting->userFullName;
            }
        }


        //--QR Code
        $path_upload_qr = BASE_UPLOAD_PATH . "/qrcode/";
        if(!is_dir($path_upload_qr)) mkdir($path_upload_qr);

        $filename_path_qr = $path_upload_qr . 'qrcode_eks_'.$surat->unitCodeApprove.'_'.$surat->idDraft.'.png';
        if(file_exists($filename_path_qr)) unlink ($filename_path_qr);

        $this->load->library('ciqrcode');
        $qrFileName = 'qrcode_eks_'.$surat->unitCodeApprove.'_'.$surat->idDraft;
        $params['data'] = $this->qsecure->encrypt($surat->idDraft.'_'
            .$userNameApprove."_"
            .$surat->unitCodeApprove.'_'
            .$surat->positionNameApprove.'_'
            .$surat->unitNameApprove.'_'
            .$surat->jenisSurat.'_'
            .$surat->noSurat.'_'
            .date('Y-m-d'));
        $params['level'] = 'H';
        $params['size'] = 2;
        $params['savename'] = $path_upload_qr."$qrFileName.png";
        $this->ciqrcode->generate($params);

        //        $this->load->library('ciqrcode');
        //        $qrFileName = "qrcode_eks_1";
        //        $params['data'] = $this->qsecure->encrypt("1_Direktur Keuangan_DK_Direktur_Direktur Keuangan_Surat Internal_DK/001/2018_2018-04-04");
        //        $params['level'] = 'H';
        //        $params['size'] = 2;
        //        $params['savename'] = $path_upload_qr."$qrFileName.png";
        //        $this->ciqrcode->generate($params);

        $head = "
        <table width='700' border='0' style='padding-left: 20px; ' >
            <tr>
                <td colspan='3' style='padding-left: 40px; '>
                    <img src='".assets_url()."images/logo_off_1.png' style='max-width: 200px; max-height: 200px;'>
                </td>
            </tr>
            <tr><td colspan='3'>&nbsp;</td></tr>
            <tr>
                <td width=400>&nbsp;</td>
                <td width=150 style='font-size: 6pt;'>
                    ".$site->siteAlias." <br/>
                    ".$site->address." <br/>
                    ".$site->address2."t <br/>
                    ".$site->zipCode." <br/>
                    ".$site->city." - ".$site->negara."
                </td>
                <td valign='top' width=150 style='font-size: 6pt;'>
                    tel.".$site->phone." <br/>
                    fax.".$site->fax." <br/>
                    ".$site->website."
                </td>
            </tr>
            <tr><td colspan='3'>&nbsp;</td></tr>
            <tr><td colspan='3'>&nbsp;</td></tr>
        </table>";

        $header = "
        <table width='700' border='0' style='padding-left: 20px;' >
            <tr>
                <td style='padding-left: 130px; font-size: 12pt;'>
                    Kepada Yth: <br/>
                    ".$surat_to." <br/>
                    di Tempat
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <table width='700' border='0' style='padding-left: 20px; '>
            <tr>
                <td style='width: 130px; font-size: 6pt;'>".$site->city."</td>
                <td colspan=3 style='font-size: 10.5pt;'>".$tglSurat."</td>
            </tr>
            <tr>
                <td style='font-size: 6pt;'>Nomor kami / Our number</td>
                <td colspan=3 style='font-size: 10.5pt;'>".$surat->noSurat."</td>
            </tr>
            <tr>
                <td style='font-size: 6pt;'>Perihal/Subject</td>
                <td colspan=3 style='font-size: 10.5pt;'>".$surat->perihal."</td>
            </tr>
        </table>";

        $detail = "
        <table width='700' border='0' style='padding-left: 150px; font-size: 10.5pt;'>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Dengan hormat,</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td style='text-align: justify; text-justify: inter-word;'>
                    ".$surat->isiSurat."
                </td>
            </tr>
        </table>";
        $no_suratReg ="";
        if($surat->noSuratReg!="") $no_suratReg = "<tr><td align='left' style='padding-left: 50px;font-size: 12pt;'>" .substr($surat->no_tahunSurat,2,2)  . $surat->noSuratReg."</td></tr>";
        if($surat->onBehalfOf) {

            $footer2 = "<tr><td style='font-size: 12pt;'> A.n. ".$surat->onBehalfOfPositionDescs."</td></tr>
                ".$html_plh."
                <tr><td align='right' style='padding-right: 50px;'><img src='".base_url()."uploadfile/qrcode/".$qrFileName.".png' style='max-width: 130px; max-height: 130px;'></td></tr>
                <tr><td style='font-size: 12pt;'>".$userNameApprove."</td></tr>";

        } else {

            $footer2 = "<tr><td style='font-size: 12pt;'> ".$surat->positionDescApprove."</td></tr>
                ".$html_plh."
                <tr><td align='right' style='padding-right: 50px;'><img src='".base_url()."uploadfile/qrcode/".$qrFileName.".png' style='max-width: 130px; max-height: 130px;'></td></tr>
                <tr><td style='font-size: 12pt;'>".$userNameApprove."</td></tr>";

        }

        $footer = "
        <table width='700' border='0' style='padding-left: 150px;'>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td style='font-size: 10.5pt;'>Hormat kami,</td>
            </tr>
            <tr>
                <td style='font-size: 12pt;'>
                    ".$site->siteName."
                </td>
            </tr>
            ".$footer2."
            ".$no_suratReg."
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td style='font-size: 10.5pt;'>
                    Tembusan : <br/>
                    - Yth ".$surat_cc_eks_int." <br/>
                </td>
            </tr>
        </table>";


        $page_footer = '
                    <table width="800" style="border-collapse:collapse;">
                        <tr>
                            <td align="left" style="border-top:1px solid #000;font-size:10px;font-weight:bold;"><i>'.date("D, j M Y H:i").'</i></td>
                            <td align="right" style="border-top:1px solid #000;font-size:10px;font-weight:bold;"><i>Page {PAGENO} of ({nbpg})</i></td>
                        </tr>
                    </table>';

        $html = $head. $header. $detail .$footer;
        $this->mpdf=new mPDF('utf-8', 'A4', 0, 'myriadpro', 2, 2, 16, 2, 0, 0, 'P');
        $this->mpdf->AddPage();
        $this->mpdf->WriteHTML($html, 2);
        //$this->mpdf->SetHTMLFooter($page_footer);

        // $this->mpdf->Output('srt_eksternal_'.date("ymdHis").'.pdf','I');

        $path_upload = BASE_UPLOAD_PATH . "/draft_surat/";
        if(!is_dir($path_upload)) mkdir($path_upload);

        $filename_path = $path_upload . 'srt_eksternal_'.$surat->unitCodeApprove.'_'.$surat->idDraft.'.pdf';

        if(file_exists($filename_path)) unlink ($filename_path);
        $this->mpdf->Output($filename_path);

        $filex = pathinfo($filename_path);
        $filex["isi_body"] = $header. $detail;
        $filex["file_type"] = "application/".$filex['extension'];
        $filex["file_size"] = intval(filesize($filename_path) / 1024);

        return $filex;
    }

    public function eksternal_eng_doc($surat,$surat_to_eks,$surat_cc,$surat_cc_eks,$site)
    {

        $tglSurat_cr=date_create($surat->tglSurat);
        $tglSurat_asli = date_format($tglSurat_cr,"d-n-Y");
        $tglSurat = $this->tgl_indo($tglSurat_asli);

        $unit_code_cc = "";
        $unit_code_cc_arr = array();
        if(count($surat_cc) > 0) {
            foreach($surat_cc as $row) {
                array_push($unit_code_cc_arr,$row->unitCode);
            }

            if(count($unit_code_cc_arr)>0) $unit_code_cc = implode (", ", $unit_code_cc_arr);
        }

        $surat_to = "";
        $surat_to_eks_arr = array();
        if(count($surat_to_eks) > 0) {
            foreach($surat_to_eks as $row) {
                array_push($surat_to_eks_arr,$row->namaEks);
            }

            if(count($surat_to_eks_arr)>0) $surat_to = implode (", ", $surat_to_eks_arr);
        }

        $surat_cc_eks_int = "";
        $surat_cc_eks_arr = array();
        if(count($surat_cc_eks) > 0) {
            foreach($surat_cc_eks as $row) {
                array_push($surat_cc_eks_arr,$row->namaCcEks);
            }

            if(count($surat_cc_eks_arr)>0) $surat_cc_eks_int = implode (", ", $surat_cc_eks_arr);
        }

        $surat_cc_arr = array();
        if(count($surat_cc) > 0) {
            foreach($surat_cc as $row) {
                array_push($surat_cc_arr,$row->unitCode);
            }
            $surat_cc_eks_int .= ', ';
            if(count($surat_cc_arr)>0) $surat_cc_eks_int .= implode (", ", $surat_cc_arr);
        }

        $userNameApprove = $surat->userNameApprove;
        $html_plh= "";
        // SET PELAKSANA HARIAN
        if($surat->userIdPlhApprove > 0) {
            //cek pelaksana harian
            $dt_acting = $this->mcommon->getActingAs($surat->userIdPlhApprove);
            if(count($dt_acting) > 0) {
                $html_plh = "<tr><td>Pelaksana Harian</td></tr>";
                $userNameApprove = $dt_acting->userFullName;
            }
        }


        //--QR Code
        $path_upload_qr = BASE_UPLOAD_PATH . "/qrcode/";
        if(!is_dir($path_upload_qr)) mkdir($path_upload_qr);

        $filename_path_qr = $path_upload_qr . 'qrcode_eks_'.$surat->unitCodeApprove.'_'.$surat->idDraft.'.png';
        if(file_exists($filename_path_qr)) unlink ($filename_path_qr);

        $this->load->library('ciqrcode');
        $qrFileName = 'qrcode_eks_'.$surat->unitCodeApprove.'_'.$surat->idDraft;
        $params['data'] = $this->qsecure->encrypt($surat->idDraft.'_'
            .$userNameApprove."_"
            .$surat->unitCodeApprove.'_'
            .$surat->positionNameApprove.'_'
            .$surat->unitNameApprove.'_'
            .$surat->jenisSurat.'_'
            .$surat->noSurat.'_'
            .date('Y-m-d'));
        $params['level'] = 'H';
        $params['size'] = 2;
        $params['savename'] = $path_upload_qr."$qrFileName.png";
        $this->ciqrcode->generate($params);

        //        $this->load->library('ciqrcode');
        //        $qrFileName = "qrcode_eks_1";
        //        $params['data'] = $this->qsecure->encrypt("1_Direktur Keuangan_DK_Direktur_Direktur Keuangan_Surat Internal_DK/001/2018_2018-04-04");
        //        $params['level'] = 'H';
        //        $params['size'] = 2;
        //        $params['savename'] = $path_upload_qr."$qrFileName.png";
        //        $this->ciqrcode->generate($params);

        $head = "
        <table width='700' border='0' style='padding-left: 20px; ' >
            <tr>
                <td colspan='3' style='padding-left: 40px; '>
                    <img src='".assets_url()."images/logo_off_1.png' style='max-width: 200px; max-height: 200px;'>
                </td>
            </tr>
            <tr><td colspan='3'>&nbsp;</td></tr>
            <tr>
                <td width=400>&nbsp;</td>
                <td width=150 style='font-size: 6pt;'>
                    ".$site->siteAlias." <br/>
                    ".$site->address." <br/>
                    ".$site->address2."t <br/>
                    ".$site->zipCode." <br/>
                    ".$site->city." - ".$site->negara."
                </td>
                <td valign='top' width=150 style='font-size: 6pt;'>
                    tel.".$site->phone." <br/>
                    fax.".$site->fax." <br/>
                    ".$site->website."
                </td>
            </tr>
            <tr><td colspan='3'>&nbsp;</td></tr>
            <tr><td colspan='3'>&nbsp;</td></tr>
        </table>";

        $header = "
        <table width='700' border='0' style='padding-left: 20px;' >
            <tr>
                <td style='padding-left: 130px; font-size: 12pt;'>
                    To : <br/>
                    ".$surat_to." <br/>
                    Tempat
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <table width='700' border='0' style='padding-left: 20px; '>
            <tr>
                <td style='width: 130px; font-size: 6pt;'>".$site->city."</td>
                <td colspan=3 style='font-size: 10.5pt;'>".$tglSurat."</td>
            </tr>
            <tr>
                <td style='font-size: 6pt;'>Nomor kami / Our number</td>
                <td colspan=3 style='font-size: 10.5pt;'>".$surat->noSurat."</td>
            </tr>
            <tr>
                <td style='font-size: 6pt;'>Perihal/Subject</td>
                <td colspan=3 style='font-size: 10.5pt;'>".$surat->perihal."</td>
            </tr>
        </table>";

        $detail = "
        <table width='700' border='0' style='padding-left: 150px; font-size: 10.5pt;'>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Dear,</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td style='text-align: justify; text-justify: inter-word;'>
                    ".$surat->isiSurat."
                </td>
            </tr>
        </table>";
        $no_suratReg="";
        if($surat->noSuratReg!="") $no_suratReg = "<tr><td align='left' style='padding-left: 50px;font-size: 12pt;'>" .substr($surat->no_tahunSurat,2,2)  . $surat->noSuratReg."</td></tr>";
        if($surat->onBehalfOf) {

            $footer2 = "<tr><td style='font-size: 12pt;'> A.n. ".$surat->onBehalfOfPositionDescs."</td></tr>
                ".$html_plh."
                <tr><td align='right' style='padding-right: 50px;'><img src='".base_url()."uploadfile/qrcode/".$qrFileName.".png' style='max-width: 130px; max-height: 130px;'></td></tr>
                <tr><td style='font-size: 12pt;'>".$userNameApprove."</td></tr>";

        } else {

            $footer2 = "<tr><td style='font-size: 12pt;'> ".$surat->positionDescApprove."</td></tr>
                ".$html_plh."
                <tr><td align='right' style='padding-right: 50px;'><img src='".base_url()."uploadfile/qrcode/".$qrFileName.".png' style='max-width: 130px; max-height: 130px;'></td></tr>
                <tr><td style='font-size: 12pt;'>".$userNameApprove."</td></tr>";

        }

        $footer = "
        <table width='700' border='0' style='padding-left: 150px;'>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td style='font-size: 10.5pt;'>Sincerely Yours,</td>
            </tr>
            <tr>
                <td style='font-size: 12pt;'>
                    ".$site->siteName."
                </td>
            </tr>
            ".$footer2."
            ".$no_suratReg."
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td style='font-size: 10.5pt;'>
                    CC : ".$surat_cc_eks_int." <br/>
                </td>
            </tr>
        </table>";


        $page_footer = '
                    <table width="800" style="border-collapse:collapse;">
                        <tr>
                            <td align="left" style="border-top:1px solid #000;font-size:10px;font-weight:bold;"><i>'.date("D, j M Y H:i").'</i></td>
                            <td align="right" style="border-top:1px solid #000;font-size:10px;font-weight:bold;"><i>Page {PAGENO} of ({nbpg})</i></td>
                        </tr>
                    </table>';

        $html = $head. $header. $detail .$footer;
        $this->mpdf=new mPDF('utf-8', 'A4', 0, 'myriadpro', 2, 2, 16, 2, 0, 0, 'P');
        $this->mpdf->AddPage();
        $this->mpdf->WriteHTML($html, 2);
        //$this->mpdf->SetHTMLFooter($page_footer);

        // $this->mpdf->Output('srt_eksternal_'.date("ymdHis").'.pdf','I');

        $path_upload = BASE_UPLOAD_PATH . "/draft_surat/";
        if(!is_dir($path_upload)) mkdir($path_upload);

        $filename_path = $path_upload . 'srt_eksternal_eng_'.$surat->unitCodeApprove.'_'.$surat->idDraft.'.pdf';

        if(file_exists($filename_path)) unlink ($filename_path);
        $this->mpdf->Output($filename_path);

        $filex = pathinfo($filename_path);
        $filex["isi_body"] = $header. $detail;
        $filex["file_type"] = "application/".$filex['extension'];
        $filex["file_size"] = intval(filesize($filename_path) / 1024);

        return $filex;
    }

    public function testing_doc($idx)
    {

        $this->srt_edaran_doc($idx);
    }

    public function send_mail($to, $subject, $body, $attachment = null, $cc = null, $bcc = null)
    {
        $this->load->config("email", true);
        $config = $this->config->item("email");

        if ($config['allow_sendmail'] == false) {
            return false;
        }

        $this->load->library("email");
        $this->email->initialize($config);
        $this->email->from($config['fromemail'], $config['fromname']);
        $this->email->to($to);

        if ($attachment !== null) $this->email->attach($attachment);
        if ($cc !== null) $this->email->cc($cc);
        if ($bcc !== null) $this->email->bcc($bcc);

        $this->email->subject($subject);
        $this->email->message($body);

        if (!$this->email->send()) {
            // Generate error
            $this->log->write_log("error", "Gagal mengirim email.");
            return false;
        }

        return true;
    }

    public function send_email($fromEmail = "", $fromName = "", $toEmail = "",
                               $subjectEmail = "", $bodyEmail = "", $attachment= "", $cc="")
    {
        require_once(APPPATH . "third_party/Mailerfactory.php");
        $this->config->load('email', true);

        $config["smtp_host"] = config_item("smtp_host");
        $config["smtp_port"] = config_item("smtp_port");
        $config["smtp_user"] = config_item("smtp_user");
        $config["smtp_pass"] = config_item("smtp_pass");
        $config["smtp_auth"] = config_item("smtp_auth");
        $config["smtp_secure"] = config_item("smtp_secure");
        $config["smtp_user_name"] = config_item("fromname");

        $mail = Mailerfactory::init($config);
        $mail->Subject = $subjectEmail;
        $mail->Body = $bodyEmail;
        if ($fromEmail != "") $mail->From = $fromEmail;
        $mail->FromName = $fromName;
        $mail->SetWordWrap();
        $mail->IsHTML(TRUE);

        if($attachment!=""){
            if(!is_array($attachment)) {
                $mail->addAttachment($attachment);
            }else{
                foreach ($attachment as $attach) {
                    $mail->addAttachment($attach);
                }
            }

        }

        if(!is_array($toEmail)) {
            $mail->AddAddress($toEmail);
        }else{
            foreach ($toEmail as $to) {
                $mail->AddAddress($to);
            }
        }


        if (! is_array($cc)) {
            $mail->AddCC($cc);
        }else{
            foreach ($cc as $each) {
                $mail->AddCC($each);
            }
        }

        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[0] . '-' . $bulan[ (int)$pecahkan[1] ] . '-' . $pecahkan[2];
    }
}
