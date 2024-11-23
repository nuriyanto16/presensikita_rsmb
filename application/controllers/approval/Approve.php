<?php

// ************************************************************************
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
   use Restserver\Libraries\REST_Controller;
   
class Approve extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Approval_model', 'mod');
	}

	public function index_post()
	{
		$pengajuan_id = trim($this->post('pengajuan_id')); 	//ID Head pengajuan
		$approval_id = trim($this->post('approval_id')); 	//NIK Yang approve
		$comp_code = trim($this->post('comp_code'));		
		$periode = trim($this->post('periode'));
		$menu_id = trim($this->post('menu_id'));			//Menu ID
		$status_id = trim($this->post('status_id'));		//Status Id Existing pengajuan
		$status_act_id = trim($this->post('status_act_id'));	//1 Setuju, 2 Ditolak
		$keterangan = trim($this->post('keterangan'));    

		$success = true;

		if ($pengajuan_id !== null || $approval_id !== null || $comp_code !== null || $periode !== null || $menu_id !== null || 
			$status_id !== null || $status_act_id !== null) {

        	$date = date("Y-m-d H:i:s");
			
			if($menu_id != '14'){
				$execute = $this->mod->ApprovePengajuan($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan);	
			}else{
				$execute = $this->mod->ApprovePengajuanLembur($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan);	
			}
			
			if($execute){
				$success =  true;
				//$stat_kirim_email = $this->KonfirmasiEmail($pengajuan_id);     
			}else{
				$success =  false;
				$msg_err = "Data gagal disimpan";
			}
		} 
		
		if ($success) {
			$this->response([
				'status' => true,
				'message' => 'Approval berhasil disimpan'
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 200); // OK (200) being the HTTP response code
		}

	}

	public function approveee_post()
	{
		$pengajuan_id = trim($this->post('pengajuan_id')); 	//ID Head pengajuan
		$approval_id = trim($this->post('approval_id')); 	//NIK Yang approve
		$comp_code = trim($this->post('comp_code'));		
		$periode = trim($this->post('periode'));
		$menu_id = trim($this->post('menu_id'));			//Menu ID
		$status_id = trim($this->post('status_id'));		//Status Id Existing pengajuan
		$status_act_id = trim($this->post('status_act_id'));	//1 Setuju, 2 Ditolak
		$keterangan = trim($this->post('keterangan'));    

		$success = true;
		$stat_kirim_email = $this->KonfirmasiEmail($pengajuan_id); 
		
		if ($success) {
			$this->response([
				'status' => true,
				'message' => 'Approval berhasil disimpan'
			], 200); // OK (200) being the HTTP response code
		} else {
			$this->response([
				'status' => false,
				'message' => $msg_err
			], 200); // OK (200) being the HTTP response code
		}
	}


	public function KonfirmasiEmail($pengajuan_id=null){

		$row = $this->mod->getPengajuanRow($pengajuan_id);
		$msg = "";

		if($row){
			$nik  = $row->NIK;
			$nama_karyawan  = $row->NAMA_KARYAWAN;
			$jabatan = $row->JABATAN;
			$nama_pengajuan = $row->DESC_AJU." ".$row->JENIS_AJU;
			$tanggal_mulai = $row->TGL_MULAI;
			$tanggal_akhir = " s/d ". $row->TGL_AKHIR;
			$tanggal_pengajuan = $tanggal_mulai.$tanggal_akhir;
			$status_pengajuan = $row->STAT_PENGAJUAN;
			$email_cc = "";
			$email_staff = "";
	
			if($row->JNS_AJU == "PO" || $row->JNS_AJU == "LS" || $row->JNS_AJU =="FR" ){
				if($row->NOTIF_OBAT==1){
					$row_email = $this->mod->getMail($row->NIK_OBAT);
					$email_cc = $row_email->EMAIL_ADDR;
				}
			}else{
				if($row->NOTIF_HC==1){
					$row_email = $this->mod->getMail($row->NIK_HC);
					$email_cc = $row_email->EMAIL_ADDR;
				}
			}


			if($row->NOTIF_STAFF==1){
				$row_email_staff = $this->mod->getMail($row->NIK);
				$email_staff = $row_email_staff->EMAIL_ADDR;
			}

			$arr_p = array();
			$arr_p[0] = $email_cc;
			$arr_p[1] = $email_staff;
			$to_email = implode(" , ",$arr_p);
			$cnt_mail = count($arr_p);

			if($cnt_mail > 0){
				$html  = "Berikut di informasikan data approval dari Aplikasi Mobile App MyTrisula :";
				$html .= "<table>
							<tr>
								<td>NIK</td>
								<td>:</td>
								<td>".$nik."</td>
							</tr>
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td>".$nama_karyawan."</td>
							</tr>
							<tr>
								<td>Jabatan</td>
								<td>:</td>
								<td>".$jabatan."</td>
							</tr>
							<tr>
								<td>Nama Pengajuan</td>
								<td>:</td>
								<td>".$nama_pengajuan."</td>
							</tr>
							<tr>
								<td>Tanggal Pengajuan</td>
								<td>:</td>
								<td>".$tanggal_pengajuan."</td>
							</tr>
							<tr>
								<td>Status Pengajuan</td>
								<td>:</td>
								<td>".$status_pengajuan."</td>
							</tr>
						  </table> 
						  ";

		
			
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
				$this->email->from(email_sender,'MY TRISULA APPS');					
				$this->email->to($to_email);						
				$this->email->subject('Informasi Approval Aplikasi MY Trisula Pengajuan '.$nama_pengajuan.'');			
				$this->email->message($html);
		
				
				if($this->email->send()){
					$res = sprintf($msg, "email berhasil dikirim..");
				}else{
					$res = sprintf($msg, "email gagal dikirim..");
				}

			}else{
				$res = sprintf($msg, "email gagal dikirim..");
			}
		}else{
			$res = sprintf($msg, "email gagal dikirim..");
		}


		return $res;
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

}
