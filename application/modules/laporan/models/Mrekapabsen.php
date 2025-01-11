<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mrekapabsen
 */
class Mrekapabsen extends Mst_model
{
    protected $_data = null;
    protected $table = "rcsa"; // without prefix
    protected $primaryKey = 'rcsa_id';

    /**
     * Mrcsa constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function generate_absensi($comp_id = null, $emp_id = null, $periode_id = null, $bulan_id = null) 
    {
	    set_time_limit(300);
        $sql = "CALL Z_P_LAP_GENERATE_ABSENSI_BULANAN(?,?,?,?)";
        $res = $this->db->query($sql,array($comp_id, $emp_id, $periode_id, $bulan_id));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    public function generate_jadwal($comp_id = null, $unit_id = null, $emp_id = null, $periode_id = null, $bulan_id = null) 
    {
        $sql = "CALL Z_P_LAP_GENERATE_ABSENSI_BULANAN_UNIT(?,?,?,?,?)";
        $res = $this->db->query($sql,array($comp_id, $unit_id, $emp_id, $periode_id, $bulan_id));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }
}
