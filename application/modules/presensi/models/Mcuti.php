<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mcuti
 */
class Mcuti extends Mst_model
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
        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, 
                            e.compid, e.comp_code, e.comp_name, g.unitname as unit_name, 
                            a.nik, f.emp_name, a.sts_aju, 
                            d.alasan_cuti,
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            a.jns_aju, b.desc_aju,
                            c.cuti_id, c.cuti_desc,
                            d.cuti_id AS id_abs_type,
                            d.alasan_cuti, 
                            date_format(d.tgl_awal_cuti, '%d-%m-%Y') AS tgl_awal_cuti, 
                            date_format(d.tgl_akhir_cuti, '%d-%m-%Y') AS tgl_akhir_cuti,
                            DATEDIFF(d.tgl_akhir_cuti, d.tgl_awal_cuti) + 1 AS jml,
                            a.app_nik, a.app_ket");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_cuti_m c','a.head_text1=c.cuti_id');
        $this->db->join('z_r_cuti d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " g", "g.unitid = f.unitid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
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
                $this->db->order_by('comp_name');
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
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_cuti_m c','a.head_text1=c.cuti_id');
        $this->db->join('z_r_cuti d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " g", "g.unitid = f.unitid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
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
    public function InsUpdCuti($pengajuan_id = null, $nik = null, $comp_code = null, $id_abs_type = null, 
        $remark = null, $periode=null, $date=null, $start_date = null, $end_date = null, $jml = null,
        $cnt_file=null, $params_image_input=null) 
        {
        $sql = "CALL Z_P_SIMPAN_CUTI(?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, $date, $start_date, $end_date, $jml, $cnt_file, $params_image_input));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        //print_r($this->db->conn_id);
        //exit();

        if ($res !== NULL) {
        return TRUE;
        }
        return FALSE;
    }

    function getExport($start_date = null , $end_date = null)
    {
        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, 
                            e.compid, e.comp_code, e.comp_name, g.unitname as unit_name, 
                            a.nik, f.nik_pegawai, f.emp_name, a.sts_aju, 
                            d.alasan_cuti,
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            a.jns_aju, b.desc_aju,
                            c.cuti_id, c.cuti_desc,
                            d.cuti_id AS id_abs_type,
                            d.alasan_cuti, 
                            date_format(d.tgl_awal_cuti, '%d-%m-%Y') AS tgl_awal_cuti, 
                            date_format(d.tgl_akhir_cuti, '%d-%m-%Y') AS tgl_akhir_cuti,
                            DATEDIFF(d.tgl_akhir_cuti, d.tgl_awal_cuti) + 1 AS jml,
                            a.app_nik, a.app_ket");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_cuti_m c','a.head_text1=c.cuti_id');
        $this->db->join('z_r_cuti d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " g", "g.unitid = f.unitid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
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
                    ->where("d.tgl_awal_cuti >= ", $start_date)
                    ->where("d.tgl_awal_cuti <= ", $end_date)
                    ->where("a.active", 1)
                ->group_end()
                ->or_group_start()
                    ->where("d.tgl_akhir_cuti >= ", $start_date)
                    ->where("d.tgl_akhir_cuti <= ", $end_date)
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
