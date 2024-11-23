<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Memployee
 */
class Memployee extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'emp_id';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_employee");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.emp_id, a.emp_name, a.nik, a.nik_pegawai, a.email, a.role_id "
            . ", DATE_FORMAT(a.company_begin, '%d-%m-%Y') AS company_begin, DATE_FORMAT(a.company_last, '%d-%m-%Y') AS company_last "
            . ", a.jns_kelamin, a.tmp_lahir, DATE_FORMAT(a.tgl_lahir, '%d-%m-%Y') AS tgl_lahir, a.p_alamat, a.p_kota, a.p_propinsi, a.p_kodepos, a.hp1  "
            . ", a.religion_id, a.education, a.edu_name, a.status_nikah, a.jml_anak, a.gol_darah "
            . ", a.ktp, a.npwp, a.no_bpjstk, a.no_bpjskes, a.no_aia, a.no_asuransi  "
            . ", a.url_ktp, a.url_sim, a.url_npwp, a.url_bpjstk, a.url_bpjskes, a.url_aia, a.url_asuransi, a.url_foto AS url_profile"
            . ", a.COMPID, a.comp_code, l.comp_name, a.unitId, a.positionId, a.position_code, a.active"
            . ", o.unitName, pe.position_desc, a.kantor_id, k.nama_kantor, a.fid");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_unit') . " o", "a.unitId = o.unitId", "left");
        $this->db->join(config_item('table_position_employee') . " pe", "a.position_code = pe.position_code", "left");
        $this->db->join(config_item('table_kantor') . " k", "a.kantor_id = k.kantor_id", "left");
        $this->db->join(config_item('table_company') . " l", "a.compid = l.compid", "left");
        $this->db->join(config_item('table_user') . " m", "a.emp_id = m.empId", "left");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        // if($this->session->userdata(sess_prefix()."roleid") != 1 ){
        //     if($this->session->userdata(sess_prefix()."roleid") == 2 ){
        //         $this->db->where("a.COMPID", $this->session->userdata(sess_prefix()."compId"));
        //     }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
        //         $this->db->where("a.unitid", $this->session->userdata(sess_prefix()."unitId"));
        //     }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
        //         $this->db->where("a.emp_id", $this->session->userdata(sess_prefix()."empId"));
        //     }else{
        //         $this->db->where("a.COMPID", $this->session->userdata(sess_prefix()."compId"));
        //     }
        // }
        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('emp_name', $filters[0]['value']);
                        $this->db->or_like('nik', $filters[0]['value']);
                        $this->db->group_end();
                    } else {
                        $this->db->group_start();
                        foreach ($filters as $filter) {
                            if ($filter['field'] == 'unitName') {
                                $filter['field'] = "o." . $filter['field'];
                            }
                            $this->db->like($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('emp_name');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.emp_id", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_cnt($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_unit') . " o", "a.unitId = o.unitId", "left");
        $this->db->join(config_item('table_position_employee') . " pe", "a.position_code = pe.position_code", "left");
        $this->db->join(config_item('table_kantor') . " k", "a.kantor_id = k.kantor_id", "left");
        $this->db->join(config_item('table_company') . " l", "a.compid = l.compid", "left");
        $this->db->join(config_item('table_user') . " m", "a.emp_id = m.empId", "left");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        // if($this->session->userdata(sess_prefix()."roleid") != 1 ){
        //     if($this->session->userdata(sess_prefix()."roleid") == 2 ){
        //         $this->db->where("a.COMPID", $this->session->userdata(sess_prefix()."compId"));
        //     }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
        //         $this->db->where("a.unitid", $this->session->userdata(sess_prefix()."unitId"));
        //     }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
        //         $this->db->where("a.emp_id", $this->session->userdata(sess_prefix()."empId"));
        //     }else{
        //         $this->db->where("a.COMPID", $this->session->userdata(sess_prefix()."compId"));
        //     }
        // }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('emp_name', $filters[0]['value']);
                    $this->db->or_like('nik', $filters[0]['value']);
                    $this->db->group_end();
                } else {
                    $this->db->group_start();
                    foreach ($filters as $filter) {
                        if ($filter['field'] == 'unitName') {
                            $filter['field'] = "o." . $filter['field'];
                        }
                        $this->db->like($filter['field'], $filter['value'], true);
                    }
                    $this->db->group_end();
                }
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }


    function getKonfigurasi($emp_id = null, $compid = null)
    {
        $this->db->select("b.emp_id, a.nik_staff, a.nik_atasan, a.nik_hc, a.stat_absen_mobile, a.stat_sales, c.emp_name as nama_atasan_langsung ");
        $this->db->from("z_personalize a");
        $this->db->join(config_item('table_employee') . " b", "a.nik_staff = b.nik AND a.comp_code = b.comp_code", "inner");
        $this->db->join(config_item('table_employee') . " c", "a.nik_atasan = c.nik AND a.comp_code = b.comp_code", "left");
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("b.compid", $this->session->userdata(sess_prefix()."compId"));
        }

        $this->db->where("b.emp_id", $emp_id);
        $this->db->where("b.compid", $compid);
        
        $Q = $this->db->get();
        $this->_data = $Q->row();
      
        $Q->free_result();
        return $this->_data;
    }

    function getKonfigurasiHo($compid = null)
    {
        $this->db->select("a.nik_ho AS NIK_ATASAN_HO, b.emp_name as NAMA_ATASAN_HO ");
        $this->db->from("z_compcode a");
        $this->db->join(config_item('table_employee') . " b", "b.nik = a.nik_ho AND a.comp_code = b.comp_code", "left");
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("b.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        $this->db->where("a.compid", $compid);
        
        $Q = $this->db->get();
        $this->_data = $Q->row();
      
        $Q->free_result();
        return $this->_data;
    }

    public function UpdateKonfigurasi($data,$nik,$comp_code){
        $this->db->trans_begin();
        $this->db->where("nik_staff",$nik);
        $this->db->where("comp_code",$comp_code);
        $this->db->update("z_personalize", $data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return=false;           
        }
        else
        {
            $this->db->trans_commit();           
            $return=true;          
        }
        return $return;
    }

    public function InsertKonfigurasi($data){
        $this->db->trans_begin();
        $this->db->insert("z_personalize", $data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return=false;           
        }
        else
        {
            $this->db->trans_commit();           
            $return=true;          
        }
        return $return;
    }

    public function InsertPengguna($data){
        $this->db->trans_begin();
        $this->db->insert("z_pengguna", $data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return=false;           
        }
        else
        {
            $this->db->trans_commit();           
            $return=true;          
        }
        return $return;
    }

}
