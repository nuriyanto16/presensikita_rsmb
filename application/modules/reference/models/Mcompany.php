<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mcompany
 */
class Mcompany extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'COMPID';
    /**
     * Mcompany constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = config_item("table_p_z_company");
    }

    function get_data($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $query = $this->db->select("COMPID, COMP_CODE, COMP_NAME, LOGOIMAGEE, ACTIVE, COMP_CODE_SAP, LONG, LAT, ALAMAT, PARENT_COMPID");
        $this->db->from($this->table);
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("COMPID", 1);
        }

       
        if ($id == null OR $id == "") {
            // data tidak aktif tidak ditampilkan
            $this->db->where("ACTIVE", "1");

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('COMP_CODE', $filters[0]['value']);
                    $this->db->or_like('COMP_NAME', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('COMP_CODE');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("COMPID", 1);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_cnt($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table);
        $this->db->where("ACTIVE", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("COMPID", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $this->db->group_start();
                $this->db->like('COMP_CODE', $filters[0]['value']);
                $this->db->or_like('COMP_NAME', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    //SINKRONISASI
    public function insertUnitKerja($unitid = null, $unitname = null) 
    {
        $sql = "INSERT INTO rsmb_unit_kerja (kode, nama_unit_kerja) values 
        (?,?) ON DUPLICATE KEY UPDATE nama_unit_kerja = '$unitname' ; ";
        $res = $this->db->query($sql,array($unitid, $unitname));
        // var_dump($sql);
        // die();
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertJabatan($kode = null, $nama_jabatan = null, $tipe = null, $jabatan_tipe = null) 
    {
        $sql = "INSERT INTO rsmb_jabatan (kode, nama_jabatan, tipe, jabatan_tipe) values 
        (?,?,?,?) ON DUPLICATE KEY UPDATE nama_jabatan = '$nama_jabatan' , tipe=$tipe,  jabatan_tipe='$jabatan_tipe' ; ";
        $res = $this->db->query($sql,array($kode, $nama_jabatan, $tipe, $jabatan_tipe));
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    public function insertPegawai($pegawai_id = null, $fid = null, $nik = null, $nik_ktp = null, $nama = null,
    $jenkel = null, $tempat_lahir = null, $tgl_lahir = null, $agama = null, $status_kawin = null,
    $pendidikan = null, $alamat_dom = null, $rt_dom = null, $rw_dom = null, $kel_dom = null, 
    $kec_dom = null, $kab_dom = null, $prov_dom = null, $alamat_ktp = null, $rt_ktp = null,
    $rw_ktp = null, $kel_ktp = null, $kec_ktp = null, $kab_ktp = null, $prov_ktp = null,
    $no_telp = null, $no_hp = null, $no_wa = null, $email = null, $unit_kerja = null, 
    $sk = null, $jabatan = null, $golongan = null, $tahun = null, $tgl_pensiun,
    $fasilitas_perawatan = null, $ptkp = null, $status = null, $nama_unit_kerja = null, $nama_jabatan = null,
    $nama_golongan = null, $nama_agama = null, $nama_pendidikan = null, $jenis_sk = null, $status_pegawai = null,
    $gol_darah = null, $id_lama = null, $tgl_masuk) 
    {
        $sql = "INSERT INTO rsmb_pegawai (
                        pegawai_id, fid, nik, nik_ktp, nama,
                        jenkel, tempat_lahir, tgl_lahir, agama, status_kawin,
                        pendidikan, alamat_dom, rt_dom, rw_dom, kel_dom,
                        kec_dom, kab_dom, prov_dom, alamat_ktp, rt_ktp,
                        rw_ktp, kel_ktp, kec_ktp, kab_ktp, prov_ktp,
                        no_telp, no_hp, no_wa, email, unit_kerja, 
                        sk, jabatan, golongan, tahun, tgl_pensiun,
                        fasilitas_perawatan, ptkp, status, nama_unit_kerja, nama_jabatan,
                        nama_golongan, nama_agama, nama_pendidikan, jenis_sk, status_pegawai,
                        gol_darah, id_lama, tgl_masuk
        ) values 
        (?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?,?,?,
        ?,?,?
        ) ON DUPLICATE KEY UPDATE stat = true ; ";
        $res = $this->db->query($sql,array(
            $pegawai_id, $fid, $nik, $nik_ktp, $nama,
            $jenkel, $tempat_lahir, $tgl_lahir, $agama, $status_kawin,
            $pendidikan, $alamat_dom, $rt_dom, $rw_dom, $kel_dom,
            $kec_dom, $kab_dom, $prov_dom, $alamat_ktp, $rt_ktp,
            $rw_ktp, $kel_ktp, $kec_ktp, $kab_ktp, $prov_ktp,
            $no_telp, $no_hp, $no_wa, $email, $unit_kerja,
            $sk, $jabatan, $golongan, $tahun, $tgl_pensiun,
            $fasilitas_perawatan, $ptkp, $status, $nama_unit_kerja, $nama_jabatan,
            $nama_golongan, $nama_agama, $nama_pendidikan, $jenis_sk, $status_pegawai,
            $gol_darah, $id_lama, $tgl_masuk
        ));
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    // TRUNCATE PEGAWAI
    public function truncatePegawai($id = null) 
    {
        $sql = "DELETE FROM rsmb_pegawai";
        $res = $this->db->query($sql,array($id));
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }
    // SINKRONISASI PEGAWAI
    public function SinkronisasiPegawai($id = null) 
    {
        $sql = "CALL Z_P_SINKRONISASI_PEGAWAI(?);";
        $res = $this->db->query($sql,array($id));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

}
