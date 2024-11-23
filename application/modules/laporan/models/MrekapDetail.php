<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class MrekapDetail
 */
class MrekapDetail extends Mst_model
{
    protected $_data = null;
    protected $table = "z_lap_rekap_details"; // without prefix
    protected $primaryKey = 'emp_id';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("z_lap_rekap_details");
    }

    function getUnitAll()
    {
        $this->db->select("u.unitId, u.unitCode, u.unitName, u.unitAlias, u.parentUnitId"
            . ", u.active, u.COMPID, u.costcenter_code, u.multiple_kode_unit"
            . ", c.COMP_CODE, c.COMP_NAME, c.COMP_CODE_SAP");
        $this->db->from("z_unit u");
        $this->db->join(config_item("table_p_z_company") . " c", "u.COMPID=c.COMPID", "inner");
        $this->db->where("u.active", "1"); // data tidak aktif tidak ditampilkan
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    function getByPeriode($bulan = null, $tahun = null)
    {
        $this->db->select("a.bulan, d.bulan_nama,  a.tahun, a.emp_id, b.emp_name, b.nik, b.nik_pegawai,
            DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggal, DATE_FORMAT(a.jdwl_masuk, '%H:%i') AS jdwl_masuk, DATE_FORMAT(a.jdwl_pulang, '%H:%i') AS jdwl_pulang,
            DATE_FORMAT(a.jam_masuk, '%H:%i') AS jam_masuk, DATE_FORMAT(a.jam_pulang, '%H:%i') AS jam_pulang, a.id_abs_type, e.abs_type_desc, a.keterangan,
            a.stat_libur, a.ket_libur, a.id_tp, a.jml_jam_kerja, a.jml_jam_kurang, a.jml_terlambat, a.jml_psw,
            o.unitName, pe.position_desc, a.kode_jadwal, a.jml_jam_lembur, a.jml_terlambat, 0 as jml_pot_point_kehadiran, 0 as jml_pot_point_keterlambatan,
            CASE WHEN a.tanggal > NOW() THEN 0 ELSE 1 END AS ket_hitungan");
        $this->db->from("z_lap_rekap_details a");
        $this->db->join(config_item('table_employee') . " b", "a.emp_id = b.emp_id", "INNER");
        $this->db->join("z_periode " . " c", "a.tahun = c.periode_id", "INNER");
        $this->db->join("z_bulan " . " d", "a.bulan = d.bulan_id", "INNER");
        $this->db->join("z_absen_type " . " e", "a.id_abs_type = e.id_abs_type", "INNER");
        $this->db->join(config_item('table_unit') . " o", "b.unitId = o.unitId", "INNER");
        $this->db->join(config_item('table_position_employee') . " pe", "b.position_code = pe.position_code", "INNER");

        $this->db->where("b.active", "1"); // data tidak aktif tidak ditampilkan

        $this->db->where("a.bulan", $bulan);
        $this->db->where("a.tahun", $tahun);

        $Q = $this->db->get();
        $this->_data = $Q->result();
    
        $Q->free_result();
        return $this->_data;
    }


    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.bulan, d.bulan_nama,  a.tahun, a.emp_id, b.emp_name, b.nik, b.nik_pegawai,
            DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggal, DATE_FORMAT(a.jdwl_masuk, '%H:%i') AS jdwl_masuk, DATE_FORMAT(a.jdwl_pulang, '%H:%i') AS jdwl_pulang,
            DATE_FORMAT(a.jam_masuk, '%H:%i') AS jam_masuk, DATE_FORMAT(a.jam_pulang, '%H:%i') AS jam_pulang, a.id_abs_type, e.abs_type_desc, a.keterangan,
            a.stat_libur, a.ket_libur, a.id_tp, a.jml_jam_kerja, a.jml_jam_kurang, a.jml_terlambat, a.jml_psw,
            o.unitName, pe.position_desc, a.kode_jadwal, a.jml_jam_lembur, a.jml_terlambat, 0 as jml_pot_point_kehadiran, 0 as jml_pot_point_keterlambatan,
            CASE WHEN a.tanggal > NOW() THEN 0 ELSE 1 END AS ket_hitungan");
        $this->db->from("z_lap_rekap_details a");
        $this->db->join(config_item('table_employee') . " b", "a.emp_id = b.emp_id", "INNER");
        $this->db->join("z_periode " . " c", "a.tahun = c.periode_id", "INNER");
        $this->db->join("z_bulan " . " d", "a.bulan = d.bulan_id", "INNER");
        $this->db->join("z_absen_type " . " e", "a.id_abs_type = e.id_abs_type", "INNER");
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
                                $filter['field'] = "o." . $filter['field'];
                            }
                            $this->db->where($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }else{
                $this->db->where("a.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('a.tahun, a.bulan, a.emp_id, a.tanggal','ASC');
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
        $this->db->from("z_lap_rekap_details a");
        $this->db->join(config_item('table_employee') . " b", "a.emp_id = b.emp_id", "INNER");
        $this->db->join("z_periode " . " c", "a.tahun = c.periode_id", "INNER");
        $this->db->join("z_bulan " . " d", "a.bulan = d.bulan_id", "INNER");
        $this->db->join("z_absen_type " . " e", "a.id_abs_type = e.id_abs_type", "INNER");

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
            $this->db->where("a.emp_id", $this->session->userdata(sess_prefix()."empId"));
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    function getUnit($id = null)
    {
        $this->db->select("u.unitId, u.unitCode, u.unitName, u.unitAlias, u.parentUnitId"
            . ", u.active, u.COMPID, u.costcenter_code, u.multiple_kode_unit"
            . ", c.COMP_CODE, c.COMP_NAME, c.COMP_CODE_SAP");
        $this->db->from("z_unit u");
        $this->db->join(config_item("table_p_z_company") . " c", "u.COMPID=c.COMPID", "inner");
        $this->db->where("u.active", "1"); // data tidak aktif tidak ditampilkan
        $this->db->where("unitId", $id);
        $Q = $this->db->get();
      
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    function getJadwalUnit($id = null, $listjadwal = null)
    {
        $listjadwal_ = explode(";",$listjadwal);
        $this->db->select("a.id_tp, a.deskripsi, a.kode "
                      ." ,CASE WHEN a.hari_1 = 1 THEN 'MASUK' ELSE '' END AS hari_1, DATE_FORMAT(a.hari_1_jam_in, '%H:%i')  AS hari_1_jam_in, DATE_FORMAT(a.hari_1_jam_out, '%H:%i')  AS hari_1_jam_out,  "
                      ." ,CASE WHEN a.hari_2 = 1 THEN 'MASUK' ELSE '' END AS hari_2, DATE_FORMAT(a.hari_2_jam_in, '%H:%i:%s')  AS hari_2_jam_in, DATE_FORMAT(a.hari_2_jam_out, '%H:%i:%s')  AS hari_2_jam_out,  "
                      ." ,CASE WHEN a.hari_3 = 1 THEN 'MASUK' ELSE '' END AS hari_3, DATE_FORMAT(a.hari_3_jam_in, '%H:%i:%s')  AS hari_3_jam_in, DATE_FORMAT(a.hari_3_jam_out, '%H:%i:%s')  AS hari_3_jam_out,  "
                      ." ,CASE WHEN a.hari_4 = 1 THEN 'MASUK' ELSE '' END AS hari_4, DATE_FORMAT(a.hari_4_jam_in, '%H:%i:%s')  AS hari_4_jam_in, DATE_FORMAT(a.hari_4_jam_out, '%H:%i:%s')  AS hari_4_jam_out,  "
                      ." ,CASE WHEN a.hari_5 = 1 THEN 'MASUK' ELSE '' END AS hari_5, DATE_FORMAT(a.hari_5_jam_in, '%H:%i:%s')  AS hari_5_jam_in, DATE_FORMAT(a.hari_5_jam_out, '%H:%i:%s')  AS hari_5_jam_out,  "
                      ." ,CASE WHEN a.hari_6 = 1 THEN 'MASUK' ELSE '' END AS hari_6, DATE_FORMAT(a.hari_6_jam_in, '%H:%i:%s')  AS hari_6_jam_in, DATE_FORMAT(a.hari_6_jam_out, '%H:%i:%s')  AS hari_6_jam_out,  "
                      ." ,CASE WHEN a.hari_7 = 1 THEN 'MASUK' ELSE '' END AS hari_7, DATE_FORMAT(a.hari_7_jam_in, '%H:%i:%s')  AS hari_7_jam_in, DATE_FORMAT(a.hari_7_jam_out, '%H:%i:%s')  AS hari_7_jam_out,  "
                      . ", b.compid, b.comp_name, a.active");
        $this->db->from("z_time_profile a");
        $this->db->join(config_item('table_company') . " b", "b.compid = a.compid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan

        if ($listjadwal != null) {
            $this->db->where_in('a.id_tp', $listjadwal_);
        }

        if ($id == null OR $id == "") {
            $this->db->order_by('a.id_tp');
            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 20;
            $this->db->limit($limit, $offset);
            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.id_tp", $id);
            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }
}
