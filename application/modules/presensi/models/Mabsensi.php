<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mabsensi
 */
class Mabsensi extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'EMP_ID';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_absensi_log");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("c.emp_id, c.emp_name, c.nik, c.nik_pegawai, c.email, c.fid"
            . ", DATE_FORMAT(a.tanggal, '%d-%M-%Y') AS tanggal, "
            . ", DATE_FORMAT(a.tanggal, '%d-%m-%Y %H:%i:%s') AS tglfinger, "
            . ", b.comp_code, c.compid, c.unitid, c.positionid, c.position_code, c.active"
            . ", o.unitname, pe.position_desc");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_employee') . " c", "a.fid=c.fid", "inner");
        $this->db->join(config_item('table_company') . " b", "c.compid = b.compid", "inner");
        $this->db->join(config_item('table_unit') . " o", "c.unitid = o.unitid", "inner");
        $this->db->join(config_item('table_position_employee') . " pe", "c.position_code = pe.position_code", "inner");
        $this->db->where("c.active", "1"); // data tidak aktif tidak ditampilkan

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("c.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("c.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("c.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("c.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }

        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('EMP_NAME', $filters[0]['value']);
                        $this->db->or_like('NIK', $filters[0]['value']);
                        $this->db->group_end();
                    } else {
                        $this->db->group_start();
                        foreach ($filters as $filter) {
                            if ($filter['field'] == 'UNITNAME') {
                                $filter['field'] = "o." . $filter['field'];
                            }
                            if ($filter['field'] == 'fid') {
                                $filter['field'] = "a." . $filter['field'];
                            }
                            if ($filter['field'] == 'B.COMPID') {
                                $filter['field'] = "b.COMPID";
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
                $this->db->order_by('a.tanggal','DESC');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("C.EMP_ID", $id);

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
        $this->db->join(config_item('table_employee') . " c", "a.fid=c.fid", "inner");
        $this->db->join(config_item('table_company') . " b", "c.compid = b.compid", "inner");
        $this->db->join(config_item('table_unit') . " o", "c.unitid = o.unitid", "inner");
        $this->db->join(config_item('table_position_employee') . " pe", "c.position_code = pe.position_code", "inner");
        $this->db->where("c.active", "1"); // data tidak aktif tidak ditampilkan

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("c.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("c.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("c.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("c.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('EMP_NAME', $filters[0]['value']);
                    $this->db->or_like('NIK', $filters[0]['value']);
                    $this->db->group_end();
                } else {
                    $this->db->group_start();
                    foreach ($filters as $filter) {
                        if ($filter['field'] == 'UNITNAME') {
                            $filter['field'] = "o." . $filter['field'];
                        }
                        if ($filter['field'] == 'fid') {
                            $filter['field'] = "a." . $filter['field'];
                        }
                        if ($filter['field'] == 'B.COMPID') {
                            $filter['field'] = "b.COMPID";
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


    //SINKRONISASI

    function insertLogDataAbsensi($data){
        $this->db->trans_begin();
        $this->db->insert("z_absensi_log", $data); 
        // $this->db->set($data);   
        // $this->db->insert($this->db->insert_string('z_absensi_log', $data).' ON DUPLICATE KEY UPDATE stat=1;');
        // //$this->db->on_duplicate_update('stat = 1')->insert_batch('z_absensi_log',$data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;           
        }
        else
        {
            $this->db->trans_commit();           
            return true;          
        }
    }


    public function insertLogAbsensi(
        $machine_id = null, $ip = null, $port =null, $fid = null, $verification_mode = null, $work_code = null, 
        $in_out_mode = null, $tanggal = null, $created_date = null, $tglinput = null
    ) 
    {
        $sql = "INSERT INTO z_absensi_log (machine_id, ip, port, fid, verification_mode, work_code, in_out_mode, tanggal, created_date, tglinput) values 
        (?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE stat = '1'; ";
        $res = $this->db->query($sql,array($machine_id, $ip, $port, $fid, $verification_mode, $work_code, $in_out_mode, $tanggal, $created_date, $tglinput));
        //$res->free_result();
        //$result = $res->result();
        // //@mysqli_next_result($this->db->conn_id);
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

}
