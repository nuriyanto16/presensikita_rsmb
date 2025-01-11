<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Munit
 */
class Mimportjdwl extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'unitId';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_unit");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("u.unitId, u.unitCode, u.unitName, u.unitAlias, u.parentUnitId"
            . ", u.active, u.COMPID, u.costcenter_code"
            . ", c.COMP_CODE, c.COMP_NAME, c.COMP_CODE_SAP");
        $this->db->from("{$this->table} u");
        $this->db->join(config_item("table_p_z_company") . " c", "u.COMPID=c.COMPID", "left");
        $this->db->where("u.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("c.COMPID", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("u.unitid", $this->session->userdata(sess_prefix()."unitId"));
                // $this->db->or_where("u.unitid", 1);
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("u.unitid", $this->session->userdata(sess_prefix()."unitId"));
                // $this->db->or_where("u.unitid", 1);
            }else{
                $this->db->where("c.COMPID", $this->session->userdata(sess_prefix()."compId"));
            }
        }
        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('unitCode', $filters[0]['value']);
                        $this->db->or_like('unitName', $filters[0]['value']);
                        $this->db->group_end();
                    } else {
                        $this->db->group_start();
                        foreach ($filters as $filter) {
                            $this->db->like($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('parentUnitId');
                $this->db->order_by('unitName');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("unitId", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_cnt($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} u");
        $this->db->join(config_item("table_p_z_company") . " c", "u.COMPID=c.COMPID", "left");
        $this->db->where("u.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("c.COMPID", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                // $this->db->where("u.unitid", 1);
                $this->db->where("u.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                // $this->db->where("u.unitid", 1);
                $this->db->where("u.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else{
                $this->db->where("c.COMPID", $this->session->userdata(sess_prefix()."compId"));
            }
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('unitCode', $filters[0]['value']);
                    $this->db->or_like('unitName', $filters[0]['value']);
                    $this->db->group_end();
                } else {
                    $this->db->like($filters[0]['field'], $filters[0]['value'], true);
                }
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    function get_data($id = null, $active = null)
    {
        $this->db->select("u.unitId, unitCode, unitName, unitAlias, unitCodeDsm,
        parentUnitId, u.siteId, u.active, b.siteName");
        $this->db->from("{$this->table} u");
        $this->db->join(config_item("table_site") . " b", "u.siteId=b.siteId", "left");
        $this->db->where("u.active", "1"); // data tidak aktif tidak ditampilkan

        if ($id == null OR $id == "") {
            if ($active) {
                $this->db->where("u.active", 1);
            } else if ($active === false) {
                $this->db->where("u.active", 0);
            }

            $this->db->order_by("u.parentUnitId", "asc");
            $this->db->order_by("u.unitCode", "asc");
            $this->db->order_by("u.unitId", "asc");

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("u.unitId", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_site($id = null, $active = null)
    {
        $this->db->select("siteId, siteCode, siteName");
        $this->db->from(config_item("table_site"));

        if ($id == null OR $id == "") {
            if ($active) {
                $this->db->where("active", 1);
            } else if ($active === false) {
                $this->db->where("active", 0);
            }

            $this->db->order_by("siteCode", "asc");

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("siteId", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_defPosition($id = null, $active = null)
    {
        $this->db->select("positionId, positionName");
        $this->db->from("position");

        if ($id == null OR $id == "") {
            if ($active) {
                $this->db->where("active", 1);
            } else if ($active === false) {
                $this->db->where("active", 0);
            }

            $this->db->order_by("positionId", "asc");

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("positionId", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    public function buildTree($elements, $parentId = 0)
    {
        $site = array();
        foreach ($elements as $element) {
            if ($element->parentUnitId == $parentId) {
                $element->treename = $element->unitName;
                $site[] = $element;
                $children = $this->buildTree($elements, $element->unitId);
                if ($children) {
                    //$element['children'] = $children;
                    foreach ($children as $chd) {
                        if (strlen($chd->treename) >= 14 && substr($chd->treename, 0, 14) == "&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->unitName;
                        } elseif (strlen($chd->treename) >= 32 && substr($chd->treename, 0, 32) == "&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->unitName;
                        } elseif (strlen($chd->treename) >= 32 && substr($chd->treename, 0, 50) == "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->unitName;
                        } elseif (strlen($chd->treename) >= 68 && substr($chd->treename, 0, 60) == "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.|_&nbsp;" . $chd->unitName;
                        } else {
                            $chd->treename = "&nbsp;|_&nbsp;" . $chd->unitName;
                        }
                        $site[] = $chd;
                    }
                }
            }
        }
        return $site;
    }

    public function code_exists($unitCode, $unitId = null)
    {
        if (empty($unitCode)) return FALSE;

        $this->db->select("count(1) as cnt");
        $this->db->from($this->table);
        $this->db->where('unitCode', $unitCode);
        if ($unitId != null) {
            $this->db->where('unitId!=', $unitId);
        }
        $Q = $this->db->get();
        $this->_data = $Q->row()->cnt;
        $Q->free_result();
        if ($this->_data > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_multiple_kode_unit_by_unitCode($unitCode) {
        // Query untuk memilih multiple_kode_unit dari tabel z_unit
        $this->db->select('multiple_kode_unit');
        $this->db->where('unitCode', $unitCode); // Kondisi pencarian berdasarkan unitCode
        $query = $this->db->get('z_unit'); // Tabel z_unit

        // Mengecek apakah ada data
        if ($query->num_rows() > 0) {
            // Mengembalikan hasil pertama (bentuk objek)
            return $query->row()->multiple_kode_unit;
        } else {
            // Jika tidak ada data ditemukan, mengembalikan null atau pesan error
            return null;
        }
    }

    public function get_multiple_kode_unit_by_unitAll() {
        // Query untuk memilih multiple_kode_unit dari tabel z_unit
        $this->db->select('id_tp');
        $this->db->from("z_time_profile");
        $this->db->where('jenis_pengajuan_id', 2);
   
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }
    
    public function getIdTpFromCodes($modified_string, $param_kode) {
        // Menyusun query untuk mencari id_tp
        $this->db->select('id_tp');
        $this->db->from('z_time_profile');
        $this->db->where_in('id_tp', explode(',', $modified_string)); // Gunakan explode untuk mengubah string menjadi array
        $this->db->where('kode', $param_kode); // Menambahkan kondisi kode
        $this->db->limit(1);
        
        // Menjalankan query dan mengambil hasil
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row_array();// Mengembalikan data sebagai array asosiatif
        } else {
            return null; // Jika tidak ada data ditemukan
        }
    }

    public function getNikPegawai($fid) {
        // Menyusun query untuk mencari id_tp
        $this->db->select('nik');
        $this->db->from('z_karyawan');
        $this->db->where('fid', $fid); // Menambahkan kondisi kode
        $this->db->limit(1);
        
        // Menjalankan query dan mengambil hasil
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row_array();// Mengembalikan data sebagai array asosiatif
        } else {
            return null; // Jika tidak ada data ditemukan
        }
    }

    public function InsertUpdateShift_($nik, $tp_start_date, $shift) {
        // Cek apakah sudah ada data dengan ID Finger dan tanggal
        $this->db->where('nik', $nik);
        $this->db->where('tp_start_date', $tp_start_date);
        $query = $this->db->get('z_tp_person');

        // Jika data sudah ada, lakukan update
        if ($query->num_rows() > 0) {
            // Update data jika sudah ada
            $data = array(
                'id_tp' => $shift
            );
            $this->db->set('counter', 'counter + 1', false);  // false agar tidak dianggap sebagai string
            $this->db->where('nik', $nik);
            $this->db->where('tp_start_date', $tp_start_date);
            $this->db->update('z_tp_person', $data);
            return $this->db->affected_rows() > 0;
        } else {
            // Jika data belum ada, lakukan insert
            $data = array(
                'nik' => $nik,
                'tp_start_date' => $tp_start_date,
                'tp_end_date' => $tp_start_date,
                'id_tp' => $shift,
                'compid' => 1,
                'comp_code' => 'ABCDE1'
            );
            $this->db->insert('z_tp_person', $data);
            return $this->db->insert_id();
        }
    }

    public function InsertUpdateShift($nik, $tp_start_date, $shift) {
        // Cek apakah sudah ada data dengan NIK dan tanggal
        $query = $this->db->select('id_tp, tp_start_date, counter') // Tambahkan id_tp di sini
                 ->where('nik', $nik)
                 ->where('tp_start_date', $tp_start_date)
                 ->get('z_tp_person');
    
        if ($query->num_rows() > 0) {
            // Data ditemukan, ambil data yang ada
            $existing_data = $query->row();
    
            if (isset($existing_data->id_tp) && $existing_data->id_tp == $shift) {
                // Jika id_tp dan tp_start_date sama, hanya tambahkan counter
                $data = array(
                    'id_tp' => $shift
                );
                $this->db->set($data);
                $this->db->where('nik', $nik);
                $this->db->where('tp_start_date', $tp_start_date);
                $this->db->update('z_tp_person');
            } else {
                // Jika id_tp berbeda, update id_tp dan tambahkan counter
                $data = array(
                    'id_tp' => $shift
                );
                $this->db->set('counter', 'counter + 1', false); // Operasi numerik
                $this->db->set($data);
                $this->db->where('nik', $nik);
                $this->db->where('tp_start_date', $tp_start_date);
                $this->db->update('z_tp_person');
            }
            return $this->db->affected_rows() > 0;
        } else {
            // Jika data belum ada, lakukan insert
            $data = array(
                'nik' => $nik,
                'tp_start_date' => $tp_start_date,
                'tp_end_date' => $tp_start_date,
                'id_tp' => $shift,
                'counter' => 0, // Mulai dengan counter = 1 untuk data baru
                'compid' => 1,
                'comp_code' => 'ABCDE1'
            );
            $this->db->insert('z_tp_person', $data);
            return $this->db->insert_id();
        }
    }
    






}
