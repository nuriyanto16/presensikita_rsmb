<?php

require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   //require APPPATH . 'libraries/Format.php';


class AuthMobile extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'mod');
		$this->load->helper('url');
	}

    public function index_post()
    {

    	$data = (array)json_decode(file_get_contents('php://input'));
		/*$hp1 = $this->input->post('hp1');
		$imei1 = $this->input->post('imei1');*/

		$hp1 	= $data['hp1'];
		$imei1 	= $data['imei1'];

		$cek_terdaftar 	= 0;
		$cek_hp 		= 0;
		$cek_imei 		= 0;
		$cek_email 		= 0;
    
		//CEK HP (Ketersediaan hp sudah terdaftar/tidak)
		if ($hp1 !== null || $hp1 != ''){
			$res_hp = $this->mod->getAuth($hp1, null, null);
			$cek_hp = ($res_hp !== '' ? 1 : 0);
			if ($cek_hp == 0) {
				$this->response([
					'status' => false,
					'is_active' => 0,
					'nik' => '',
					'nama' => '',
					'comp_code' => '',
					'hp' => '',
					'email' => '',
					'url_foto' => '',
					'api_branch' => "seuneu.trisula.com",
					'user_auth' => "",
					'pass_auth' => "",
					'konci_seuneu' => "",
					'message' => 'No HP tidak tersedia, anda tdk dpt menggunakan aplikasi. Silahkan hubungi HC Anda !'
				], 200); // OK (200) being the HTTP response code
				exit();
			}else{
				//CEK IMEI
				if ($imei1 !== null || $imei1 !== ''){

					$res_imei = $this->mod->getAuth($hp1, $imei1, null);
					$cek_imei = ($res_imei == '') ? 0 : 1;
					
					if ($cek_imei==0) {
						$res_cek = $this->mod->getImeiKosong($hp1);
						//CEK IMEI YANG BELUM TERDAFTAR//
						if($res_cek->JML==1){
							$cek_terdaftar = 1;
						}
					}else{
						//CEK EMAIL
						$res_email = $this->mod->getAuth($hp1, $imei1, "cek_email");
						$cek_email = ($res_email == '') ? 0 : 1;

						if ($cek_email == 0) {
							$this->response([
								'status' => false,
								'is_active' => 0,
								'nik' => '',
								'nama' => '',
								'comp_code' => '',
								'hp' => '',
								'email' => '',
								'url_foto' => '',
								'api_branch' => "seuneu.trisula.com",
								'user_auth' => "",
								'pass_auth' => "",
								'konci_seuneu' => "",
								'message' => 'Email Tidak Tersedia, anda tdk dpt menggunakan aplikasi. Silahkan hubungi HC Anda !'
							], 404); // NOT_FOUND (404) being the HTTP response code
							exit();
						}
						//END CEK EMAIL
					}
				}else{
					$this->response([
						'status' => false,
						'is_active' => 0,
						'nik' => '',
						'nama' => '',
						'comp_code' => '',
						'hp' => '',
						'email' => '',
						'url_foto' => '',
						'api_branch' => "seuneu.trisula.com",
						'user_auth' => "",
						'pass_auth' => "",
						'konci_seuneu' => "",
						'message' => 'Device id not found'
					], 200); // OK (200) being the HTTP response code
					exit();
				}
				//END CEK IMEI
			}
		}else{
			$this->response([
				'status' => false,
				'is_active' => 0,
				'nik' => '',
				'nama' => '',
				'comp_code' => '',
				'hp' => '',
				'email' => '',
				'url_foto' => '',
				'api_branch' => "seuneu.trisula.com",
				'user_auth' => "",
				'pass_auth' => "",
				'konci_seuneu' => "",
				'message' => 'Data not found'
			], 200); // OK (200) being the HTTP response code
			exit();
		}

		//END CEK HP
		if($cek_terdaftar ==  1){
			$row = $res_hp;
			//CEK PENGGUNA APAKAH SUDAH TERDAFTAR//
			$res_cek_pengguna = $this->mod->getPengguna($row->NIK);

			if($res_cek_pengguna->JML>0){
				$this->response([
					'status' => false,
					'is_active' => 0,
					'nik' => '',
					'nama' => '',
					'comp_code' => '',
					'hp' => '',
					'email' => '',
					'url_foto' => '',
					'api_branch' => "seuneu.trisula.com",
					'user_auth' => "",
					'pass_auth' => "",
					'konci_seuneu' => "",
					'message' => 'User sudah terdaftar !'
				], 200); // OK (200) being the HTTP response code
				exit();
			}else{
				//JIKA PENGGUNA BELUM TERDAFTAR//
				$kode_aktif = password_hash($hp1.$this->generate(), PASSWORD_BCRYPT);
		        $dataIns = array(
		            'NIK' => $row->NIK,
		            'NAMA_USER' => $row->NAMA,
		            'EMAIL_ADDR' => $row->EMAIL_ADDR,
		            'KT_KONCI' => $hp1.$this->generate(),
		            'KODE_AKTIF' => $kode_aktif,
		            'NON_AKTIP' => 1,
		            'CREATED_BY' => 'REGISTER',
		            'CREATED_DATE' => date('Y-m-d H:i:s'),
		            'TINGKAT' => 0,
		            'LINK_AKTIVASI' => 'http://presensikita.com/presensikita/aktivasi?hp1='.$hp1.'&kode_aktif='.$kode_aktif.'&imei1='.$imei1.'',
		        );

		        //INSERT KE PENGGUNA
				if($this->mod->InsertUser($dataIns)){

					$email_target  = $row->EMAIL_ADDR; 
					$link_aktivasi = 'http://presensikita.com/presensikita/aktivasi?hp1='.$hp1.'&kode_aktif='.$kode_aktif.'&imei1='.$imei1.'';
					//$res_email = ""; //$this->KonfirmasiEmail($email_target,$link_aktivasi);

					$res_email = $this->KonfirmasiEmail($email_target,$link_aktivasi);

					$this->response([
						'data' => $res_hp,
						'status' => true,
						'is_active' => 0,
						'nik' => '',
						'nama' => '',
						'comp_code' => '',
						'hp' => '',
						'email' => '',
						'url_foto' => '',
					   	'api_branch' => "presensikita.com",
					   	'user_auth' => "",
					   	'pass_auth' => "",
					   	'konci_seuneu' => "",
						'link_email' => base_url().'aktivasi?hp1='.$hp1.'&kode_aktif='.$kode_aktif.'&imei1='.$imei1.'',
						'message' => 'Daftar Berhasil, Mohon tunggu konfirmasi pada email !',
						'status_email' => $res_email
					], 200); // NOT_FOUND (404) being the HTTP response code
				}else{
					$this->response([
						'status' => false,
						'message' => 'Registrasi Gagal, Silahkan hubungi HC Anda !'
					], 200); // OK (200) being the HTTP response code
				}
			}
	
		}else{

			//JIKA SUDAH TERDAFTAR DAN OTORISASI USER BERHASIL
			if($cek_hp == 1 && $cek_imei == 1 && $cek_email == 1){
				$comp_code = $res_email->COMP_CODE;
				$row_bc = $this->mod->getBasicAuthCompany($comp_code);
				$this->response([
				 	'status' => true,
				 	'is_active' => 1,
				 	'nik' => $res_email->NIK,
				 	'nama' => $res_email->NAMA,
				 	'comp_code' => $res_email->COMP_CODE,
				 	'hp' => $res_email->HP1,
				 	'email' => $res_email->EMAIL_ADDR,
				 	'url_foto' => base_url().'uploads/personal/photo/'.$res_email->URL_FOTO,
					'api_branch' => $row_bc->API_BRANCH,
					'user_auth' => $row_bc->USER_AUTH,
					'pass_auth' => $row_bc->PASS_AUTH,
					'konci_seuneu' => $row_bc->KONCI_SEUNEU,
				 	'message' => 'Login Berhasil, Go To Dashboard'
				], 200); // OK (200) being the HTTP response code
				//exit();
			}else{
				$this->response([
					'status' => false,
					'is_active' => 0,
					'message' => 'Maaf akun anda tidak bisa masuk, Silahkan hubungi HC Anda !'
				], 200); // OK (200) being the HTTP response code
				//exit();
			}
		}

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

    public function resetuser_post(){
    	
    }

    public function KonfirmasiEmail($email_target =null, $link_aktivasi=null){

    	$html = "Silakan klik link/tombol dibawah ini untuk aktivasi user pada aplikasi PresensiKita";

		$html .='<div>---------------------------------------------------------------------------------------</div>
		<a  href="'.$link_aktivasi.'" target="_blank">
		<button  id="approve" style="border: none;
			color: white;
			padding: 10px 25px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			background-color: #4CAF50;">Aktivasi</button></a>';
		
		//$email_target = "sayarhungs@gmail.com";

		// $config = array(
		// 	'mailtype' 	=> 'html',
		// 	'protocol' => 'smtp',
		// 	'smtp_host' => '192.168.1.235',
		// 	'smtp_port' => 25, //465, //587,
		// 	'smtp_user' => '',
		// 	'smtp_pass' => '',
		// 	'smtp_timeout' => '30',
		// 	//'smtp_cyrpto' => 'ssl',
		// 	'enableSsl' => 'false',
		// 	'charset'   => 'utf-8'
		// );

		$config = array(
			'mailtype' 	=> 'html',
			'protocol' => 'smtp',
			'smtp_host' => smtp_host,
			'smtp_port' => smtp_port, //465, //587,
			'smtp_user' => smtp_user,
			'smtp_pass' => smtp_pass,
			'smtp_timeout' => '30',
			//'smtp_cyrpto' => 'ssl',
			'enableSsl' => enableSsl,
			'charset'   => 'utf-8'
		);
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from(email_sender,'TRISULA');					
		$this->email->to($email_target);						
		$this->email->subject('Aktivasi User Aplikasi MY Trisula');			
		$this->email->message($html);

		$msg = "";
		if($this->email->send()){
			$res = sprintf($msg, "email berhasil dikirim..");
		}else{
			$res = sprintf($msg, "email gagal dikirim..");
		}

		return $res;
    }

}
