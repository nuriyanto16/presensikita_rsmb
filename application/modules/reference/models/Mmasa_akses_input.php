<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mmasa_akses_input
 */
class Mmasa_akses_input extends Mst_model
{
    protected $_data = null;
     // table _akses_risiko_awal
    protected $table1 = '_akses_risiko_awal a'; // without prefix
    protected $primaryKey1 = 'a.akses_risiko_awal_id';

    // table _akses_risiko_awal_unlock
    protected $table2 = '_akses_risiko_awal_unlock a'; // without prefix
    protected $primaryKey2 = 'a.akses_risiko_awal_unlock_id';

    // table _akses_risiko_mon
    protected $table3 = '_akses_risiko_mon a'; // without prefix
    protected $primaryKey3 = 'a.akses_risiko_mon_id';

    // table _akses_risiko_mon_unlock
    protected $table4 = '_akses_risiko_mon_unlock a'; // without prefix
    protected $primaryKey4 = 'a.akses_risiko_mon_unlock_id';

    // table _periode_risiko
    protected $tJoin1 = '_periode_risiko b'; // without prefix
    protected $keyJoin1 = 'b.periode_risiko_id';



    /**
     * Mmasa_akses_input constructor.
     */
    public function __construct()
    {
        parent::__construct();
      //   $this->table = config_item("table_company");
    }

    // _akses_risiko_awal
    function get_data1($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("b.periode_risiko_id ,b.periode_risiko_nama as periode_nama, a.start_date, a.end_date, a.akses_risiko_awal_id");
        $this->db->from($this->table1);
        $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');

        if ($id == null OR $id == "") {
            // data tidak aktif tidak ditampilkan
            $this->db->where("a.active", "1");

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
                  //   $this->db->or_like('compName', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by($this->primaryKey1);
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where($this->primaryKey1, $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_cnt1($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table1);
        $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $this->db->group_start();
                  $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
               //  $this->db->or_like('compName', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
    // end _akses_risiko_awal

    // _akses_risiko_awal_unlock
    function get_data2($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {   
        $tJoin2 = $this->config->item('table_unit').' c';
        $tJoin3 = $this->config->item('table_company').' d';
        $this->db->select("b.periode_risiko_nama as periode_nama, a.start_date, a.end_date, a.akses_risiko_awal_unlock_id,
                           c.unitName, c.unitCode, a.periode_risiko_id, a.unit_id, d.compName, d.compCode");
        $this->db->from($this->table2);
        $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
        $this->db->join($tJoin2, 'a.unit_id = c.unitId', 'inner');
        $this->db->join($tJoin3, 'c.compId = d.compId', 'inner');

        if ($id == null OR $id == "") {
            // data tidak aktif tidak ditampilkan
            $this->db->where("a.active", "1");

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $comps = explode("~" ,$filters[0]['value']);
                   if(count($comps) == 2){
                    $this->db->group_start();
                        $this->db->where('c.compId', $comps[1]);
                    $this->db->group_end();
                   }else{
                    $this->db->group_start();
                        $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
                        $this->db->or_like('c.unitName', $filters[0]['value']);
                        $this->db->or_like('c.compId', $filters[0]['value']);
                    $this->db->group_end();
                   }
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by($this->primaryKey2);
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where($this->primaryKey2, $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_cnt2($filters = null)
    {
        $tJoin2 = $this->config->item('table_unit').' c';
        $tJoin3 = $this->config->item('table_company').' d';
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table2);
        $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
        $this->db->join($tJoin2, 'a.unit_id = c.unitId', 'inner');
        $this->db->join($tJoin3, 'c.compId = d.compId', 'inner');
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $comps = explode("~" ,$filters[0]['value']);
                if(count($comps) == 2){
                 $this->db->group_start();
                     $this->db->where('c.compId', $comps[1]);
                 $this->db->group_end();
                }else{
                 $this->db->group_start();
                     $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
                     $this->db->or_like('c.unitName', $filters[0]['value']);
                     $this->db->or_like('c.compId', $filters[0]['value']);
                 $this->db->group_end();
                }
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
    // end _akses_risiko_awal_unlock

    // _akses_risiko_mon
    function get_data3($id = null, $offset = null, $limit = null, $order = null, $filters = null, $where = null)
    {   
        $tJoin2 = $this->config->item('table_unit').' c';
        $this->db->select("b.periode_risiko_nama as periode_nama, a.periode_bulan, a.start_date, a.end_date, a.akses_risiko_mon_id");
        $this->db->from($this->table3);
        $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
        // $this->db->join($tJoin2, 'a.unit_id = c.unitId', 'inner');

        if(!empty($where)){
            $this->db->where('a.periode_risiko_id', $where);
        }

        if ($id == null OR $id == "") {
            // data tidak aktif tidak ditampilkan
            $this->db->where("a.active", "1");

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
                  // $this->db->or_like('compName', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by("a.periode_bulan");
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where($this->primaryKey3, $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_cnt3($filters = null)
    {
    //    $tJoin2 = $this->config->item('table_unit').' c';
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table4);
        $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
        // $this->db->join($tJoin2, 'a.unit_id = c.unitId', 'inner');
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $this->db->group_start();
                  $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
               //  $this->db->or_like('compName', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
    // end _akses_risiko_mon

     // _akses_risiko_monitoring_unlock
     function get_data4($id = null, $offset = null, $limit = null, $order = null, $filters = null)
     {   
         $tJoin2 = $this->config->item('table_unit').' c';
         $tJoin3 = $this->config->item('table_company').' d';
         $this->db->select("b.periode_risiko_nama as periode_nama, a.periode_bulan, a.start_date, a.end_date,
                            a.akses_risiko_mon_unlock_id, c.unitName, c.unitCode, a.periode_risiko_id, a.unit_id,
                            d.compName, d.compCode");
         $this->db->from($this->table4);
         $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
         $this->db->join($tJoin2, 'a.unit_id = c.unitId', 'inner');
         $this->db->join($tJoin3, 'c.compId = d.compId', 'inner');
         if ($id == null OR $id == "") {
             // data tidak aktif tidak ditampilkan
             $this->db->where("a.active", "1");
 
             if (!empty($filters)) {
                $comps = explode("~" ,$filters[0]['value']);
                if(count($comps) == 2){
                 $this->db->group_start();
                     $this->db->where('c.compId', $comps[1]);
                 $this->db->group_end();
                }else{
                 $this->db->group_start();
                     $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
                     $this->db->or_like('c.unitName', $filters[0]['value']);
                     $this->db->or_like('c.compId', $filters[0]['value']);
                 $this->db->group_end();
                }
             }
 
             if (!empty($order)) {
                 $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
             } else {
                 $this->db->order_by($this->primaryKey4);
             }
 
             if (empty($offset)) $offset = 0;
             if (empty($limit)) $limit = 10;
             $this->db->limit($limit, $offset);
 
             $Q = $this->db->get();
             $this->_data = $Q->result();
         } else {
             $this->db->where($this->primaryKey4, $id);
 
             $Q = $this->db->get();
             $this->_data = $Q->row();
         }
 
         $Q->free_result();
         return $this->_data;
     }
 
     function get_data_cnt4($filters = null)
     {
        $tJoin2 = $this->config->item('table_unit').' c';
        $tJoin3 = $this->config->item('table_company').' d';
         $this->db->select("count(1) _cnt");
         $this->db->from($this->table4);
         $this->db->join($this->tJoin1, 'a.periode_risiko_id = b.periode_risiko_id', 'inner');
         $this->db->join($tJoin2, 'a.unit_id = c.unitId', 'inner');
         $this->db->join($tJoin3, 'c.compId = d.compId', 'inner');
         $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
 
         if (!empty($filters)) {
            $comps = explode("~" ,$filters[0]['value']);
            if(count($comps) == 2){
             $this->db->group_start();
                 $this->db->where('c.compId', $comps[1]);
             $this->db->group_end();
            }else{
             $this->db->group_start();
                 $this->db->like('b.periode_risiko_nama', $filters[0]['value']);
                 $this->db->or_like('c.unitName', $filters[0]['value']);
                 $this->db->or_like('c.compId', $filters[0]['value']);
             $this->db->group_end();
            }
         }
 
         $Q = $this->db->get();
         $this->_data = $Q->row()->_cnt;
         $Q->free_result();
         return $this->_data;
     }
     // end _akses_risiko_monitoring_unlock

     // proses simpan data monitoring
     function simpan_monitoring(){
        $userId =  $this->session->userdata($this->config->item('sess_prefix', 'ion_auth') . 'userid');
        $id_periode = $this->input->post('periode_id');
        $mon_id = $this->input->post('mon_id');
        $mon_id = $this->qsecure->decrypt($mon_id);
        
        $periode_bulan = $this->input->post('periode_bulan');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $is_delete = $this->input->post('is_delete');

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));

        $r = false;
        if(empty($mon_id)){
            $cek = $this->db->get_where('_akses_risiko_mon', array('periode_risiko_id' => $id_periode, 'periode_bulan' => $periode_bulan))->num_rows();
            
        if($cek == 0){
                $data = array(
                    'periode_risiko_id' => $id_periode,
                    'periode_bulan' => $periode_bulan,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'created_by' => $userId,
                    'created_date' => date('Y-m-d H:i:s')
                );

                $r =  $this->db->insert('_akses_risiko_mon', $data);
           }
        }else{
            $where = array('akses_risiko_mon_id' => $mon_id);
            if($is_delete){
                    // $r = $this->db->delete('_akses_risiko_mon', $where);
                    $data = array(
                        'active' => 0,
                        'updated_by' => $userId,
                        'updated_date' => date('Y-m-d H:i:s')
                    );
            }else{
                    $data = array(
                        'periode_risiko_id' => $id_periode,
                        'periode_bulan' => $periode_bulan,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'updated_by' => $userId,
                        'updated_date' => date('Y-m-d H:i:s')
                    );
            }
            $r = $this->db->update('_akses_risiko_mon', $data, $where);
        }

        return $r;
     }
}
