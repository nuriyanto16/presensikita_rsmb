<?php

require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   require APPPATH . 'libraries/Format.php';

class Example extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('karyawan_model');
    }

    public function index_get()
    {
        $id = $this->get('id');

        if($id>0){
            $karyawan = true;
        }else{
            $karyawan = true; 
        }
        
        if($karyawan){
            $this->response([
                'status' => true,
                'data' => 1
            ], 200); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID not found'
            ], 404); // NOT_FOUND (404) being the HTTP response code
        }
    }


}
