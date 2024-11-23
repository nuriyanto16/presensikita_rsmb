<?php

class Notifmail_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN DATA PENGAJUAN PER ROW
    public function getPengajuanRow($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select(" NIK,
                            NAMA_KARYAWAN,
                            JABATAN,
                            TO_CHAR(TGL_AJU_PARAMS, 'dd-mm-YYYY') AS TGL_MULAI,
                            TO_CHAR(TGL_AJU_PARAMS_END, 'dd-mm-YYYY') AS TGL_AKHIR,
                            DESC_AJU AS DESC_AJU,
                            CASE WHEN TIPE_PENGAJUAN <> '' THEN  TRIM('('||TIPE_PENGAJUAN||')')  ELSE '' END AS JENIS_AJU,
                            STAT_PENGAJUAN,
                            NIK_HC, NIK_ATASAN, NIK_HC, 
							NOTIF_ATASAN, NOTIF_HC,  NOTIF_STAFF, STAT_ABSEN_MOBILE");
        $this->db->from('z_view_pengajuan_his');
        $this->db->where('ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
	}
	
	public function getNotifikasiData($id = null, $jns_aju = null) 
    {
        $sql = "SELECT RN, ID_AJU, TGL, NIK_NOTIFIKASI, NIK, EMAIL_ADDR, STAT_PENGAJUAN, MENU_ID, DESC_AJU FROM
		(
		SELECT ROW_NUMBER() OVER (ORDER BY A.TGL DESC) AS RN,
		B.ID_AJU, 
		A.TGL,
		A.IS_READ,
		A.NIK AS NIK_NOTIFIKASI,
		B.NIK,
		D.NAMA,
		D.EMAIL_ADDR,
		A.STS_AJU,
		CASE A.STS_AJU
			WHEN 0 THEN 'DIAJUKAN'
			WHEN 1 THEN 'DISETUJUI'
			WHEN 2 THEN 'DITOLAK'
		END AS STAT_PENGAJUAN,
		CASE B.JNS_AJU
			WHEN 'IZ' THEN 2
			WHEN 'CT' THEN 3
			WHEN 'PO' THEN 4
			WHEN 'LS' THEN 4
			WHEN 'FR' THEN 4
			WHEN 'PB' THEN 5
			WHEN 'PD' THEN 6
			WHEN 'TR' THEN 7
			WHEN 'AB' THEN 1
		END AS MENU_ID,
		C.DESC_AJU
		FROM z_notifikasi A
		JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
		JOIN z_jns_aju C ON B.JNS_AJU=C.JNS_AJU
		JOIN z_karyawan D ON B.NIK=D.NIK
		WHERE NIK = ? AND B.JNS_AJU = ?
		) WHERE RN=1 ";
		$result = $this->db->query($sql,array($id,$jns_aju));
		$ret = $result->result();
		return $ret;
    }

    public function KonfirmasiEmail($nik=null, $jns_aju=null){

		$pengajuan_id = '0';
		$res = $this->getNotifikasiData($nik, $jns_aju);
		foreach($res as $row){
			$pengajuan_id = $row->ID_AJU;
			$email_atasan = $row->EMAIL_ADDR;
		}

		$stat_notif_atasan = 0 ;
		$row = $this->getPengajuanRow($pengajuan_id);
		$msg = "";

		if($row){
			$nik  = $row->NIK;
			$nama_karyawan  = $row->NAMA_KARYAWAN;
			$jabatan = $row->JABATAN;
			$nama_pengajuan = $row->DESC_AJU." ".$row->JENIS_AJU;
			$tanggal_mulai = $row->TGL_MULAI;
			$tanggal_akhir = " s/d ". $row->TGL_AKHIR;
			if($jns_aju == 'PO' || $jns_aju == 'LS' || $jns_aju == 'FR' ||  $jns_aju == 'PB'){
				$tanggal_pengajuan = $tanggal_mulai;
			}else{
				$tanggal_pengajuan = $tanggal_mulai.$tanggal_akhir;
			}
			$status_pengajuan = $row->STAT_PENGAJUAN;
			$stat_notif_atasan = $row->NOTIF_ATASAN;
			
			if($email_atasan !== null && $stat_notif_atasan ==1){
				$html  = "Berikut di informasikan data pengajuan approval dari Aplikasi Mobile MyTrisula :";
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
				$this->email->to($email_atasan);						
				$this->email->subject('Informasi Pengajuan Approval '.$nama_pengajuan.' Aplikasi MY Trisula');			
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

}
