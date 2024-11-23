<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class MrekapSummary
 */
class MrekapSummary extends Mst_model
{
    protected $_data = null;
    protected $table = "z_lap_rekap_summary"; // without prefix
    protected $primaryKey = 'emp_id';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("z_lap_rekap_summary");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.bulan, d.bulan_nama,  a.tahun, a.emp_id, b.emp_name, b.nik, b.nik_pegawai, a.jml_hadir, a.jml_alpha,"
            . ",  a.jml_dinas, a.jml_izin, a.jml_cuti, a.jml_sakit, a.jml_dispensasi, a.jml_pelatihan, a.jml_reimburse, a.jml_jam_kurang, a.jml_jam_kerja "
            . ",  a.jml_pot_point_kehadiran, a.jml_pot_point_keterlambatan, a.jml_jam_lembur, jml_terlambat"
            . ",  o.unitName, pe.position_desc");

        $this->db->from("z_lap_rekap_summary a");
        $this->db->join(config_item('table_employee') . " b", "a.emp_id = b.emp_id", "INNER");
        $this->db->join("z_periode " . " c", "a.tahun = c.periode_id", "INNER");
        $this->db->join("z_bulan " . " d", "a.bulan = d.bulan_id", "INNER");
        $this->db->join(config_item('table_unit') . " o", "b.unitId = o.unitId", "INNER");
        $this->db->join(config_item('table_position_employee') . " pe", "b.position_code = pe.position_code", "INNER");

        $this->db->where("b.active", "1"); // data tidak aktif tidak ditampilkan

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }

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
                            if ($filter['field'] == 'UNITNAME') {
                                $filter['field'] = "O." . $filter['field'];
                            }
                            $this->db->where($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }else{
                $this->db->where("b.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('a.tahun, a.bulan, a.emp_id','ASC');
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
        $this->db->from("z_lap_rekap_summary a");
        $this->db->join(config_item('table_employee') . " b", "a.emp_id = b.emp_id", "INNER");
        $this->db->join("z_periode " . " c", "a.tahun = c.periode_id", "INNER");
        $this->db->join("z_bulan " . " d", "a.bulan = d.bulan_id", "INNER");
        $this->db->join(config_item('table_unit') . " o", "b.unitId = o.unitId", "INNER");
        $this->db->join(config_item('table_position_employee') . " pe", "b.position_code = pe.position_code", "INNER");

        $this->db->where("b.active", "1"); // data tidak aktif tidak ditampilkan

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }

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
                        if ($filter['field'] == 'UNITNAME') {
                            $filter['field'] = "O." . $filter['field'];
                        }
                        $this->db->where($filter['field'], $filter['value'], true);
                    }
                    $this->db->group_end();
                }
            }
        }else{
            $this->db->where("b.emp_id", $this->session->userdata(sess_prefix()."empId"));
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    public function getAbsType()
    {
        $this->db->select("A.ID_ABS_TYPE, A.ABS_TYPE_DESC, A.FLAG_KETIDAKHADIRAN");
        $this->db->from('z_absen_type A');
        $this->db->order_by("A.ID_ABS_TYPE","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    function getRekapKetidakhadiran($bulan = null, $tahun = null, $unitid = null, $emp_id = null)
    {
        $this->db->select("a.*, b.emp_id, b.nik");
        $this->db->from("rekap_ketidakhadiran a");
        $this->db->join(config_item('table_employee') . " b", "a.nik_pegawai = b.nik_pegawai", "INNER");
        $this->db->where("b.active", "1"); // data tidak aktif tidak ditampilkan
        $this->db->where("a.bulan", $bulan);
        $this->db->where("a.tahun", $tahun);
        if($unitid){
            $this->db->where("b.unitId", $unitid);
        }
        if($emp_id){
            $this->db->where("b.emp_id", $emp_id);
        }

        $Q = $this->db->get();
        $this->_data = $Q->result();
    
        $Q->free_result();
        return $this->_data;
    }

}
