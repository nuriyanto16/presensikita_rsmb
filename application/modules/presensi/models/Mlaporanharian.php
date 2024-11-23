<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mlaporanharian
 */
class Mlaporanharian extends Mst_model
{
    protected $_data = null;
    protected $table = "z_head_laporan"; // without prefix
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
                            e.compid, e.comp_code, e.comp_name,
                            a.nik, f.emp_name, a.sts_aju, 
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            a.jns_aju, b.desc_aju,
                            c.desc_stat AS desc_izin,
                            c.desc_stat As jns_izin,
                            a.head_text1 AS id_abs_type,
                            a.remark AS alasan_izin, 
                            date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_awal_izin, 
                            date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_akhir_izin,
                            STR_TO_DATE(a.tgl_aju, '%Y-%m-%d') -  STR_TO_DATE(a.tgl_aju, '%Y-%m-%d') + 1 AS jml,
                            a.app_nik, a.app_ket");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_jns_stat c','a.head_text1=c.jns_stat');
        $this->db->join(config_item('table_company') . " e", "e.comp_code = a.comp_code", "inner");
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik  AND  f.comp_code = a.comp_code", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
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
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_jns_stat c','a.head_text1=c.jns_stat');
        $this->db->join(config_item('table_company') . " e", "e.comp_code = a.comp_code", "inner");
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik  AND  f.comp_code = a.comp_code", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
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
    public function InsUpdLaporan($pengajuan_id = null, $nik = null, $comp_code = null, $id_abs_type = null, 
        $remark = null, $periode=null, $date=null, $start_date = null, $end_date = null, $jml = null,
        $cnt_file=null, $params_image_input=null) 
        {
        $sql = "CALL Z_P_SIMPAN_LAPORAN(?,?,?,?,?,?,?,?,?,?,?,?)";
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

}
