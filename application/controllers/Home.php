<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
            parent::__construct();
            $this->load->model('mcommon','mcom');
        }
	public function index(){                                          
            $data['titlehead'] = "Dashboard";
            $this->template->load('tmpl/vwfronttmpl','vhome',$data);                        
	}               
               
}
