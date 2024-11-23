<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mabsensi
 */
class MabsensiOld extends Mst_model
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

        $this->table = config_item("table_absensi");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("C.EMP_ID, C.EMP_NAME, C.NIK, C.EMAIL"
            . ", CONCAT( DATE_FORMAT(A.TGL_ABS, '%Y'),'/' ,DATE_FORMAT(A.TGL_ABS, '%Y%m%d')) AS PATH,"
            . ", DATE_FORMAT(A.TGL_ABS, '%d-%M-%Y') AS TGL_ABS, "
            . ", DATE_FORMAT(A.JAM_IN, '%H:%i') JAM_IN, DATE_FORMAT(A.JAM_OUT, '%H:%i') JAM_OUT, A.ID_ABS_TYPE, A.LONGITUDE, A.LATITUDE"
            . ", A.LOKASI, A.URL_FOTO, A.URL_FOTO_PULANG, D.ABS_TYPE_DESC"
            . ", A.COMP_CODE, C.COMPID, C.UNITID, C.POSITIONID, C.POSITION_CODE, C.ACTIVE"
            . ", O.UNITNAME, PE.POSITION_DESC");
        $this->db->from("{$this->table} A");
        $this->db->join(config_item('table_company') . " B", "A.COMP_CODE = B.COMP_CODE", "INNER");
        $this->db->join(config_item('table_employee') . " C", "A.NIK=C.NIK AND B.COMPID=C.COMPID", "INNER");
        $this->db->join(config_item('table_absensi_type') . " D",'A.ID_ABS_TYPE=D.ID_ABS_TYPE');
        $this->db->join(config_item('table_unit') . " O", "C.UNITID = O.UNITID", "INNER");
        $this->db->join(config_item('table_position_employee') . " PE", "C.POSITION_CODE = PE.POSITION_CODE", "INNER");
        $this->db->where("C.ACTIVE", "1"); // data tidak aktif tidak ditampilkan


        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("B.COMPID", $this->session->userdata(sess_prefix()."compId"));
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
                                $filter['field'] = "O." . $filter['field'];
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
                $this->db->order_by('A.TGL_ABS, A.JAM_IN','DESC');
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
        $this->db->from("{$this->table} A");
        $this->db->join(config_item('table_company') . " B", "A.COMP_CODE = B.COMP_CODE", "INNER");
        $this->db->join(config_item('table_employee') . " C", "A.NIK=C.NIK AND B.COMPID=C.COMPID", "INNER");
        $this->db->join(config_item('table_absensi_type') . " D",'A.ID_ABS_TYPE=D.ID_ABS_TYPE');
        $this->db->join(config_item('table_unit') . " O", "C.UNITID = O.UNITID", "INNER");
        $this->db->join(config_item('table_position_employee') . " PE", "C.POSITION_CODE = PE.POSITION_CODE", "INNER");
        $this->db->where("C.ACTIVE", "1"); // data tidak aktif tidak ditampilkan

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("B.COMPID", $this->session->userdata(sess_prefix()."compId"));
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
                            $filter['field'] = "O." . $filter['field'];
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
        $in_out_mode = null, $tanggal = null, $created_date = null
    ) 
    {
        $sql = "INSERT INTO z_absensi_log (machine_id, ip, port, fid, verification_mode, work_code, in_out_mode, tanggal, created_date) values 
        (?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE stat = '1'; ";
        $res = $this->db->query($sql,array($machine_id, $ip, $port, $fid, $verification_mode, $work_code, $in_out_mode, $tanggal, $created_date));
        //$res->free_result();
        //$result = $res->result();
        // //@mysqli_next_result($this->db->conn_id);
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

}
