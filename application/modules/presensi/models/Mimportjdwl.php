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
                $this->db->or_where("u.unitid", 1);
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("u.unitid", $this->session->userdata(sess_prefix()."unitId"));
                $this->db->or_where("u.unitid", 1);
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
                $this->db->where("u.unitid", 1);
                $this->db->where("u.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("u.unitid", 1);
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

    public function deleteAllOrganisasi() {
        // Check if there's data in the table
        $count = $this->db->count_all('z_unit'); // Get the count of records in the 'organisasi' table
        
        if ($count > 0) {
            // Delete all organizational data from the table
            $this->db->empty_table('z_unit'); // Assuming your table is named 'organisasi'
            return true; // Indicate that deletion was successful
        } else {
            return false; // Indicate that no deletion was performed
        }
    }

    public function insertOrganisasi($data) {
        // Insert data into the organizational table
        $this->db->insert('z_unit', $data); // Assuming your table is named 'organisasi'
    }
}
