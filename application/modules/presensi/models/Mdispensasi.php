<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mdispensasi
 */
class Mdispensasi extends Mst_model
{
    protected $_data = null;
    protected $table = "z_head_aju"; // without prefix
    protected $primaryKey = 'id_aju';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {

        $role_id = $this->session->userdata(sess_prefix()."roleid");
        $admin_defPositionId = $this->session->userdata(sess_prefix()."admin_defPositionId");
        $admin_kdunit = $this->session->userdata(sess_prefix()."admin_kdunit");
        $unit_code = $this->session->userdata(sess_prefix()."unitCode");
        $nik = $this->session->userdata(sess_prefix()."nik");

        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, a.no_surat,
                            e.compid, e.comp_code, e.comp_name,f.jabatan as position,o.unitName as unit,
                            a.nik, f.emp_name, a.sts_aju, 
                            d.alasan_dispensasi as alasan,
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            a.jns_aju, b.desc_aju,
                            c.jns_izin, c.desc_izin,
                            d.jns_izin AS id_abs_type,
                            a.head_text1 AS id_abs_type, 
                            date_format(d.tgl_awal_dispensasi, '%d-%m-%Y') AS tgl_awal, 
                            date_format(d.tgl_akhir_dispensasi, '%d-%m-%Y') AS tgl_akhir,
                            d.wkt_awal_dispensasi,
                            d.wkt_akhir_dispensasi,
                            DATEDIFF(d.tgl_akhir_dispensasi, d.tgl_awal_dispensasi) + 1 AS jml,
                            a.app_nik, a.app_ket, f.unor, f.unker, a.active");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_jns_izin c','a.head_text1=c.jns_izin');
        $this->db->join('z_r_dispensasi d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_company') . " e", "e.comp_code = a.comp_code", "inner");
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_unit') . " o", "f.unitId = o.unitId", "inner");
        $this->db->where_in('c.jns_izin', ['DA','LP','MS','PC']);

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        }

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("f.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("f.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }

        if($role_id  != 1 ){
            //$this->db->where("C.COMPID", $this->session->userdata(sess_prefix()."compId"));
            if($role_id  == 2 ){ // Admin Unor
                $unitcode = substr($admin_kdunit,0,2)."000000";
                $this->db->where("concat(left(f.kdunit,2),'000000')",$unitcode);
            }else if($role_id  == 3 ){ // Admin Unker
                if($admin_defPositionId==1){ // level Eselon 1
                    $unitcode = substr($admin_kdunit,0,2)."000000";
                    $this->db->where("concat(left(f.kdunit,2),'000000')",$unitcode);
                }else if($admin_defPositionId==2){ // level Eselon 2
                    $unitcode = substr($admin_kdunit,0,4)."0000";
                    $this->db->where("concat(left(f.kdunit,4),'0000')",$unitcode);
                }else if($admin_defPositionId==3){ // level Eselon 3
                    $unitcode = substr($admin_kdunit,0,6)."00";
                    $this->db->where("concat(left(f.kdunit,6),'00')",$unitcode);
                }else if($admin_defPositionId==4){ // level Eselon 4
                    $this->db->where("f.kdunit",$admin_kdunit);
                }
            }else if($role_id  == 4 ) { // Personal
                $this->db->where("f.nik", $nik);
            }else if($role_id  == 5 ) { // Personal
                $this->db->where("f.nik", $nik);
            }else{
                $unitcode = $unit_code;
                $this->db->where("f.kdunit",$unitcode);
            }
        }

        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('nik', $filters[0]['value']);
                        $this->db->or_like('comp_name', $filters[0]['value']);
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
                $this->db->order_by('a.tgl_aju','desc');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.id_aju", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_cnt($filters = null)
    {

        $role_id = $this->session->userdata(sess_prefix()."roleid");
        $admin_defPositionId = $this->session->userdata(sess_prefix()."admin_defPositionId");
        $admin_kdunit = $this->session->userdata(sess_prefix()."admin_kdunit");
        $unit_code = $this->session->userdata(sess_prefix()."unitCode");
        $nik = $this->session->userdata(sess_prefix()."nik");
    
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_jns_izin c','a.head_text1=c.jns_izin');
        $this->db->join('z_r_dispensasi d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_company') . " e", "e.comp_code = a.comp_code", "inner");
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_unit') . " o", "f.unitId = o.unitId", "inner");
        $this->db->where_in('c.jns_izin', ['DA','LP','MS','PC']);

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        }

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("f.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("f.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }

        if($role_id  != 1 ){
            //$this->db->where("C.COMPID", $this->session->userdata(sess_prefix()."compId"));
            if($role_id  == 2 ){ // Admin Unor
                $unitcode = substr($admin_kdunit,0,2)."000000";
                $this->db->where("concat(left(f.kdunit,2),'000000')",$unitcode);
            }else if($role_id  == 3 ){ // Admin Unker
                if($admin_defPositionId==1){ // level Eselon 1
                    $unitcode = substr($admin_kdunit,0,2)."000000";
                    $this->db->where("concat(left(f.kdunit,2),'000000')",$unitcode);
                }else if($admin_defPositionId==2){ // level Eselon 2
                    $unitcode = substr($admin_kdunit,0,4)."0000";
                    $this->db->where("concat(left(f.kdunit,4),'0000')",$unitcode);
                }else if($admin_defPositionId==3){ // level Eselon 3
                    $unitcode = substr($admin_kdunit,0,6)."00";
                    $this->db->where("concat(left(f.kdunit,6),'00')",$unitcode);
                }else if($admin_defPositionId==4){ // level Eselon 4
                    $this->db->where("f.kdunit",$admin_kdunit);
                }
            }else if($role_id  == 4 ) { // Personal
                $this->db->where("f.nik", $nik);
            }else if($role_id  == 5 ) { // Personal
                $this->db->where("f.nik", $nik);
            }else{
                $unitcode = $unit_code;
                $this->db->where("f.kdunit",$unitcode);
            }
        }
        
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('nik', $filters[0]['value']);
                    $this->db->or_like('comp_name', $filters[0]['value']);
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

    // INSERT/UPDATE
    public function InsUpdDispensasi($pengajuan_id = null, $nik = null, $comp_code = null, $id_abs_type = null, 
        $remark = null, $periode=null, $date=null, $start_date = null, $end_date = null, $start_time = null, $end_time = null, $jml = null, $no_surat = null, 
        $cnt_file=null, $params_image_input=null) 
        {
        $sql = "CALL Z_P_SIMPAN_DISPENSASI(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, $date, $start_date, $end_date, $start_time, $end_time, $jml, $no_surat, $cnt_file, $params_image_input));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        $res->free_result();
        if ($res !== NULL) {
        return TRUE;
        }
        return FALSE;
        }

    //UNTUK MENAMPILKAN TIPE IZIN
    public function getIzinType($id = null, $comp_code = null)
    {
        $this->db->select("JNS_IZIN, DESC_IZIN");
        $this->db->from('z_jns_izin');
        $this->db->where_in('jns_izin', ['DA','LP','MS','PC']);
        //$this->db->order_by("A.ID_ABS_TYPE","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

}
