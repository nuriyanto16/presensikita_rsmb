<?php

class Ipel_model extends CI_Model
{
    private $_data = null;
    public function getIpelList($tahun = null, $bulan = null) // $id defaultnya adalah null
    {
        $this->db->select("b.nik_pegawai, b.emp_name as nama, b.fid, c.unitName as nama_unit, 
        d.position_desc as nama_posisi, a.bulan, a.tahun,  
        a.jml_pot_point_kehadiran,  a.jml_pot_point_keterlambatan");
        $this->db->from('z_lap_rekap_summary a');
        $this->db->join('z_karyawan b','a.emp_id = b.emp_id');
        $this->db->join('z_unit c','b.unitid = c.unitId');
        $this->db->join('z_position_employee d','b.position_code = d.position_code');
        $this->db->where('b.active =',1);
        $this->db->where('a.tahun =', $tahun);
        $this->db->where('a.bulan =', $bulan);         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

}
