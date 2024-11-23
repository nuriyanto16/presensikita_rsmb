<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mlembur
 */
class Mlembur extends Mst_model
{
    protected $_data = null;
    protected $table = "z_head_lembur"; // without prefix
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

        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, a.pj, a.wkt_awal, a.wkt_akhir, a.pj,
                            e.compid, e.comp_code, e.comp_name, pe.position_desc as position, o.unitName as unit,
                            a.nik, f.nik_pegawai, f.emp_name, a.sts_aju, a.sts_aju_ho,
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            case a.sts_aju_ho 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan_ho,
                            a.jns_aju, b.desc_aju,
                            c.desc_stat AS desc_izin,
                            c.desc_stat As jns_izin,
                            a.head_text1 AS id_abs_type,
                            a.remark AS alasan_lembur, 
                            date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_awal_lembur, 
                            date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_akhir_lembur,
                            STR_TO_DATE(a.tgl_aju, '%Y-%m-%d') -  STR_TO_DATE(a.tgl_aju, '%Y-%m-%d') + 1 AS jml,
                            a.app_nik, a.app_ket,  a.active");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_jns_stat c','a.head_text1=c.jns_stat');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " o", "f.unitId = o.unitId", "inner");
        $this->db->join(config_item('table_position_employee') . " pe", "f.position_code = pe.position_code", "left");
        
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

            }else if($role_id  == 4 ) { // Personal
                $this->db->where("f.nik", $nik);
            }else {

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
                $this->db->order_by('a.tgl_aju','DESC');
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
        $this->db->join('z_jns_stat c','a.head_text1=c.jns_stat');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " o", "f.unitId = o.unitId", "inner");
        $this->db->join(config_item('table_position_employee') . " pe", "f.position_code = pe.position_code", "left");
        
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

            }else if($role_id  == 4 ) { // Personal
                $this->db->where("f.nik", $nik);
            }else {

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
    public function InsUpdLembur($pengajuan_id = null, $nik = null, $comp_code = null, $id_abs_type = null, 
        $remark = null, $periode=null, $date=null, $start_date = null, $end_date = null, $start_time = null, $end_time = null, 
        $pj = null,  $jml = null, $cnt_file=null, $params_image_input=null) 
        {
        $sql = "CALL Z_P_SIMPAN_LEMBUR(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, $date, $start_date, $end_date, $start_time, $end_time, $pj, $jml, $cnt_file, $params_image_input));
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
        $this->db->select("A.JNS_STAT AS JNS_IZIN, A.DESC_STAT AS DESC_IZIN");
        $this->db->from('z_jns_stat A');
        //$this->db->order_by("A.ID_ABS_TYPE","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    function getExport($start_date = null , $end_date = null)
    {
        $role_id = $this->session->userdata(sess_prefix()."roleid");
        $admin_defPositionId = $this->session->userdata(sess_prefix()."admin_defPositionId");
        $admin_kdunit = $this->session->userdata(sess_prefix()."admin_kdunit");
        $unit_code = $this->session->userdata(sess_prefix()."unitCode");
        $nik = $this->session->userdata(sess_prefix()."nik");

        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, a.pj, a.wkt_awal, a.wkt_akhir, a.pj,
                            e.compid, e.comp_code, e.comp_name, pe.position_desc as position, o.unitName as unit,
                            a.nik, f.nik_pegawai, f.emp_name, a.sts_aju, a.sts_aju_ho,
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            case a.sts_aju_ho 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan_ho,
                            a.jns_aju, b.desc_aju,
                            c.desc_stat AS desc_izin,
                            c.desc_stat As jns_izin,
                            a.head_text1 AS id_abs_type,
                            a.remark AS alasan_lembur, 
                            date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_awal_lembur, 
                            date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_akhir_lembur,
                            STR_TO_DATE(a.tgl_aju, '%Y-%m-%d') -  STR_TO_DATE(a.tgl_aju, '%Y-%m-%d') + 1 AS jml,
                            a.app_nik, a.app_ket,  a.active");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_jns_stat c','a.head_text1=c.jns_stat');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " o", "f.unitId = o.unitId", "inner");
        $this->db->join(config_item('table_position_employee') . " pe", "f.position_code = pe.position_code", "left");
        
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
       
        // Add date filtering if dates are provided
        if ($start_date && $end_date) {
            $this->db->group_start()
                ->group_start()
                    ->where("a.tgl_aju >= ", $start_date)
                    ->where("a.tgl_aju <= ", $end_date)
                    ->where("a.active", 1)
                ->group_end()
            ->group_end();
        }

        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

}
