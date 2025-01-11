<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Organisasi
 * @property Munit $munit
 * @property Mcompany $mcompany
 * @property Mcostcenter $mcostcenter
 */
class Importjdwl extends Mst_controller
{
    function __construct()
    {
        parent::__construct();
        $this->MOD_ALIAS = "MOD_PRESENSI_IMPORTJDWL";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mimportjdwl", "munit");
        $this->load->model("reference/Mcompany", "mcompany");
        $this->load->model("reference/Mcostcenter", "mcostcenter");
        $this->load->model("reference/Mperiode", "mperiode");
       
    }

    public function index()
    {
        // Path file Excel
        $this->data['titlehead'] = "Import Jadwal";
        $stdClass = new stdClass();
        $stdClass->bulan_id = null;
        $stdClass->periode_id = null;

        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/presensi/importjdwl.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        //--== select option company
        $companies = $this->mcompany->get_data(null, null, 999);
        $list_company[null] = "Pilih Perusahaan";
        foreach ($companies as $row) {
            $list_company[$row->COMPID] = $row->COMP_NAME;
        }
        $this->data['list_company'] = $list_company;

        // $mperiodes = $this->mperiode->get_data(null,0, 999999);
        // $list_periode[null] = "Pilih Periode";
        // foreach ($mperiodes as $row) {
        //     $list_periode[$row->periode_id] = $row->periode_nama;
        // }

        // $this->data['periode_id'] = array(
        //     'name' => 'periode_id',
        //     'id' => 'periode_id',
        //     'value' => $this->form_validation->set_value('periode_id', $stdClass->periode_id),
        //     'options' => $list_periode,
        //     'class' => 'form-control'
        // );

        $current_year = date('Y');
        $list_tahun[null] = "Pilih Tahun";
        $list_tahun[$current_year - 1] = $current_year - 1; // Tahun sebelumnya
        $list_tahun[$current_year] = $current_year; // Tahun sekarang
        $list_tahun[$current_year + 1] = $current_year + 1; // Tahun berikutnya

        $this->data['periode_id'] = array(
            'name' => 'periode_id',
            'id' => 'periode_id',
            'options' => $list_tahun,
            'value' => $this->form_validation->set_value('periode_id', $stdClass->periode_id),
            'class' => 'form-control'
        );

        // option bulan
        $current_month = date('n');
        $list_bulan[null] = "Pilih Bulan";
        for ($i = -2; $i <= 2; $i++) {
            $adjusted_month = $current_month + $i;
        
            // Menangani kondisi di mana bulan menjadi lebih dari 12 atau kurang dari 1
            if ($adjusted_month < 1) {
                $adjusted_month += 12;
            }
            if ($adjusted_month > 12) {
                $adjusted_month -= 12;
            }
        
            // Menangani nama bulan
            $nama_bulan = [
                1 => "Januari",
                2 => "Februari",
                3 => "Maret",
                4 => "April",
                5 => "Mei",
                6 => "Juni",
                7 => "Juli",
                8 => "Agustus",
                9 => "September",
                10 => "Oktober",
                11 => "Nopember",
                12 => "Desember"
            ];
        
            $list_bulan[$adjusted_month] = $nama_bulan[$adjusted_month];
        }

        $this->data['bulan_id'] = array(
            'name' => 'bulan_id',
            'id' => 'bulan_id',
            'options' => $list_bulan,
            'value' => $this->form_validation->set_value('bulan_id', $stdClass->bulan_id),
            'class' => 'form-control'
        );

        $this->_render_page('vimportjdwl_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function lists()
    {
        $start = intval($this->input->post('start'));
        $limit = intval($this->input->post('length'));
        $filters = $this->input->post('filters');
        $order = $this->input->post('order');
        $comp_id = intval($this->input->post('comp_id'));

        $results = $this->munit->get(null, $start, $limit, $order, $filters);
        $totalfiltered = $this->munit->get_cnt($filters);
        $totaldata = $this->munit->get_cnt();
        $maxpage = $limit <> 0 ? ceil($totalfiltered / $limit) : 0;

        $build_array = array(
            "last_page" => $maxpage,
            "recordsTotal" => $totaldata,
            "recordsFiltered" => $totalfiltered,
            "data" => array()
        );
        $output = [];

        foreach ($results as $row) {
            $id = $this->qsecure->encrypt($row->unitId);
            $btnAction = "<button type='button' 
                class='btn btn-primary btnShowModal' 
                data-id='{$row->unitCode}'
                data-unit-name='{$row->unitName}'>
                Upload Jadwal Kerja
                </button>";
            $obj = [];
            $obj['id'] = $row->unitId;
            $obj['parentId'] = $row->parentUnitId;
            $obj['unitCode'] = $row->unitCode;
            $obj['unitName'] = $row->unitName;
            $obj['aksi'] = $btnAction;
            $output[] = $obj;
        }

        if ($totalfiltered <> $totaldata) {
            $build_array["data"] = $output;
        } else {
            $comp_code_sap = null;
            $comp = $this->mcompany->get_data($comp_id);
            //if ($comp != null) $comp_code_sap = $comp->COMP_CODE_SAP;
            //$build_array["data"] = build_tree($output, 'parentId', 'id', $comp_code_sap);
            $build_array["data"] = build_tree($output, 'parentId', 'id', NULL);
        }

        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($build_array));
    }

    // public function uploadjadwal(){

    //     // Cek jika ada file yang di-upload
    //     if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
    //         $config['upload_path'] = upload_path.'import_jadwal/'; // Direktori tempat menyimpan file
    //         $config['allowed_types'] = 'xlsx'; // Format file yang diperbolehkan
    //         $this->load->library('upload', $config);

    //         if (!$this->upload->do_upload('file')) {
    //             echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
    //             return;
    //         } else {
    //             $fileData = $this->upload->data();
    //             $fileName = $fileData['file_name']; // Ambil nama file yang di-upload
    //         }
    //     }

    //     // Ambil data dari form
    //     $tahun = $this->input->post('tahun');
    //     $bulan = $this->input->post('bulan');
    //     $kdunit = $this->input->post('kdunit');

    //     exit();

        
    //     //PROSES IMPORT
    //     $filePath = upload_path.'import_jadwal/arafah.xlsx'; // Sesuaikan path file Anda
    //     $this->load->library('PhpSpreadsheet_Loader');
    //     try {
    //         // Memuat file Excel
    //         $spreadsheet = $this->phpspreadsheet_loader->readExcel($filePath);

    //         // Mengambil data dari spreadsheet
    //         $sheet = $spreadsheet->getActiveSheet();
    //         $data = $sheet->toArray(null, true, true, true);

    //         // Tampilkan data
    //         // echo '<pre>';
    //         // print_r($data);
    //         // echo '</pre>';

    //         // Iterasi data baris per baris
    //         $x=0;
    //         $columns = [
    //             'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
    //             'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI'
    //         ];
    //         foreach ($data as $row) {
    //             if($x>0) {
    //                 // Ambil data ID Finger, Nama, Jabatan, dan Unit
    //                 $id_finger = $row['A'];
    //                 $nama = $row['B'];
    //                 $jabatan = $row['C'];
    //                 $unit = $row['D'];

    //                 // Loop untuk setiap kolom tanggal (E hingga AI)
    //                 foreach ($columns as $column) {
                        
    //                     // Periksa jika kolom tidak kosong
    //                     if (!empty($row[$column])) {
    //                         // Format tanggal sesuai dengan format yang diinginkan
    //                         $tanggal = '2024-12-' . str_pad(ord($column) - ord('E') + 1, 2, '0', STR_PAD_LEFT);

    //                         // Insert atau Update data dan mendapatkan hasilnya
    //                         $result = $this->munit->InsertUpdateShift($id_finger, $tanggal, $row[$column]);

    //                         // Mengecek hasil dan memberikan feedback
    //                         if (is_numeric($result)) {
    //                             echo $id_finger." -- ".$tanggal." -- ". $row[$column]."</br/>";
    //                             // Jika result adalah ID yang baru dimasukkan
    //                             // echo "Data berhasil dimasukkan dengan ID: " . $result . "<br>";
    //                         } else if ($result) {
    //                             // Jika result adalah true (update berhasil)
    //                             echo "Data berhasil diperbarui.<br>";
    //                         } else {
    //                             // Jika result adalah false (tidak ada perubahan)
    //                             echo "Tidak ada perubahan pada data.<br>";
    //                         }
    //                     }
    //                 }
    //                 echo "<br/>";
    //             }
    //             $x++;
    //         }

            

    //         // Periksa apakah ada data untuk diimpor
    //         if (!empty($data)) {
    //             // Masukkan data ke database menggunakan model
    //             echo "Data berhasil diimpor.";
    //         } else {
    //             echo "Tidak ada data untuk diimpor.";
    //         }
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }


    public function uploadjadwal() {

        // Cek jika ada file yang di-upload
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $config['upload_path'] = upload_path.'importjadwal/';
            $config['allowed_types'] = 'xlsx';
            // Mengganti nama file
            // $newFileName = 'jadwal_' . date('Ymd_His') . '.xlsx'; // Ganti dengan format yang sesuai
            // $config['file_name'] = $newFileName; // Menetapkan nama baru untuk file
               // Mengganti nama file jika perlu
            $newFileName = 'jadwal_' . date('Ymd_His') . '.xlsx'; // Ganti dengan format yang sesuai
            $config['file_name'] = $newFileName;
            $this->upload->initialize($config);
                

            if (!$this->upload->do_upload('file')) {
                // Jika upload gagal
                echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
                return;
            } else {
      
                // Ambil nama file yang di-upload
                $fileData = $this->upload->data();
                $fileName = $fileData['file_name']; // Nama file yang di-upload
                $filePath = $config['upload_path'] . $fileName; // Gabungkan path dan nama file
            }
        }       
    
        // Ambil data dari form
        $tahun = $this->input->post('periode_id');
        $bulan = $this->input->post('bulan_id');
        $kdunit = $this->input->post('kdunit');        

        $all_tp = "";
        $resAllCode = $this->munit->get_multiple_kode_unit_by_unitAll();
        foreach ($resAllCode as $rowALlcode) {
            $all_tp .=",".$rowALlcode->id_tp;
        }
        $bulan_param = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        // PROSES IMPORT
        $this->load->library('PhpSpreadsheet_Loader');
        try {
            // Memuat file Excel
            $spreadsheet = $this->phpspreadsheet_loader->readExcel($filePath);
    
            // Mengambil data dari spreadsheet
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, true, true);
    
            // Iterasi data baris per baris
            $x = 0;

            $message = "";
            foreach ($data as $row) {
                if ($x > 0) {
                    // Ambil data ID Finger, Nama, Jabatan, dan Unit
                    $id_finger = $row['A'];
                    $nama = $row['B'];
                    $jabatan = $row['C'];
                    $unit = $row['D'];

                    // CEK ID TP YANG TERDAFTAR DI UNIT
                    $multiple_kode_unit = $this->munit->get_multiple_kode_unit_by_unitCode($kdunit);
                    $multile_tp = str_replace(";", ",", $multiple_kode_unit);
                    $multile_tp = $multile_tp.$all_tp;

                    $rowPeg = $this->munit->getNikPegawai($id_finger);
                    $columns = [
                        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
                        'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI'
                    ];
                    // Loop untuk setiap kolom tanggal (E hingga AI)
                    foreach ($columns as $column) {
                        // Periksa jika kolom tidak kosong
                        if (!empty($row[$column])) {
                            // Format tanggal sesuai dengan format yang diinginkan
                            //$tanggal = ''.$tahun.'-'.$bulan_param.'-'. str_pad(ord($column) - ord('E') + 1, 2, '0', STR_PAD_LEFT);
                            
                            $columnIndex = $this->columnToIndex($column) - 4;
        
                            // Format tanggal sesuai dengan format yang diinginkan
                            $tanggal = $tahun . '-' . $bulan_param . '-' . str_pad($columnIndex, 2, '0', STR_PAD_LEFT);

                            // var_dump($tanggal);
                            // Insert atau Update data dan mendapatkan hasilnya
                            // GET ID TP
                            // echo $id_finger." ". $row[$column] ." ".$tanggal. "<br>";
                            $rowTp = $this->munit->getIdTpFromCodes($multile_tp, $row[$column]);
                        
                            if (isset($rowTp) && !empty($rowTp) && isset($rowPeg) && !empty($rowPeg)) {
                            // if (isset($rowTp) && !empty($rowTp) ) {
                                $result = $this->munit->InsertUpdateShift($rowPeg['nik'], $tanggal, $rowTp['id_tp']);
                                if (is_numeric($result)) {
                                    //$id_finger." -- ".$tanggal." -- ". $row[$column]."</br/>";
                                    $message ="Data berhasil diimpor";
                                } else if ($result) {
                                    $message ="Data berhasil diperbarui";
                                } else {
                                    $message ="Tidak ada perubahan pada data";
                                }
                            }
    
                            // Mengecek hasil dan memberikan feedback

                        }
                    }
                }
                $x++;
            }
    
            // Periksa apakah ada data untuk diimpor
            // Proses untuk menyimpan data ke database
            if (!empty($data)) {
                // Masukkan data ke database menggunakan model
                // Contoh: $this->some_model->saveData($data);
                $message = "Data berhasil diimpor.";
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => true, 'message' => $message]));
            } else {
                $message = "Tidak ada data untuk diimpor.";
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => $message]));
            }
        } catch (Exception $e) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => $e->getMessage()]));
        }
    }

    function columnToIndex($column) {
        $column = strtoupper($column); // Pastikan huruf kapital
        $length = strlen($column);
        $index = 0;
        
        // Menghitung indeks berdasarkan kolom, misalnya A = 1, Z = 26, AA = 27, dst.
        for ($i = 0; $i < $length; $i++) {
            $index *= 26; // Setiap huruf menggeser 26 kali (A-Z)
            $index += ord($column[$i]) - ord('A') + 1;
        }
        
        return $index;
    }
    

    public function get_node() {
        $out = [];

        $COMPID = intval($this->input->post('COMPID'));
        if (!empty($COMPID)) {
            $filters = [
                ['field' => 'u.COMPID', 'value' => $COMPID]
            ];
            $results = $this->munit->get(null, 0, 999999, null, $filters);
            if ($results != null) {
                // build tree
                $output = [];
                foreach ($results as $row) {
                    $arr = [];
                    $arr['id'] = $row->unitId;
                    $arr['parentId'] = $row->parentUnitId;
                    $arr['unitName'] = "{$row->unitCode} - {$row->unitName}";
                    $output[] = $arr;
                }
                $out = build_tree($output, 'parentId', 'id', NULL);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    //delete data = menonaktifkan data
    public function delete($id = NULL)
    {
        /*if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $res = $this->munit->delete($id);
        if ($res) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Dihapus");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DELETED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DELETED'));
        }
        redirect('reference/organisasi', 'refresh');*/

        $this->deactivate($id);
    }

    //activate
    public function activate($id)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 1;
        $activation = $this->munit->update($id, $data);
        if ($activation) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Diaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_ACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_ACTIVATED'));
        }
        redirect("reference/organisasi", 'refresh');
    }

    //deactivate
    public function deactivate($id = NULL)
    {
        if ($id != null && $id != "") $id = $this->qsecure->decrypt($id);
        $id = (int)$id;

        $data['active'] = 0;
        $deactivate = $this->munit->update($id, $data);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(), $this->MOD_ALIAS, $id, "Organisasi Dinonaktifkan");
            $this->session->set_flashdata('message', $this->_get_message('SUCCESS_DEACTIVATED'));
        } else {
            $this->session->set_flashdata('err', $this->_get_message('FAILED_DEACTIVATED'));
        }
        redirect("reference/organisasi", 'refresh');
    }

    function _get_message($msg_type, $message = '', $mode = 'success', $icons = 'check', $fadeOut = true)
    {
        $title = '';
        switch ($msg_type) {
            //--== SUCCESS
            case 'SUCCESS_INSERTED':
                $title = 'Tambah Berhasil';
                $message = 'Penambahan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_UPDATED':
                $title = 'Update Berhasil';
                $message = 'Pembaharuan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_DELETED':
                $title = 'Hapus Berhasil';
                $message = 'Penghapusan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_ACTIVATED':
                $title = 'Mengaktifkan Berhasil';
                $message = 'Pengaktifan data berhasil dilakukan.';
                $icons = 'check';
                break;

            case 'SUCCESS_DEACTIVATED':
                $title = 'Menonaktifkan Berhasil';
                $message = 'Penonaktifan data berhasil dilakukan.';
                $icons = 'check';
                break;

            //---== FAILED
            case 'FAILED_INSERTED':
                $title = 'Tambah Gagal';
                $message = 'Penambahan data gagal !';
                $icons = '';
                break;

            case 'FAILED_UPDATED':
                $title = 'Update Gagal';
                $message = 'Pembaharuan data gagal !';
                $icons = '';
                break;

            case 'FAILED_DELETED':
                $title = 'Hapus Gagal';
                $message = 'Penghapusan data gagal !';
                $icons = '';
                break;

            case 'FAILED_ACTIVATED':
                $title = 'Mengaktifkan Gagal';
                $message = 'Pengaktifan data gagal !';
                $icons = '';
                break;

            case 'FAILED_DEACTIVATED':
                $title = 'Menonaktifkan Gagal';
                $message = 'Penonaktifan data gagal !';
                $icons = '';
                break;

            case 'ERROR_VALIDATION':
                $title = '';
                break;
        }

        return message_box($title, $message, $mode, $icons, $fadeOut);
    }
   
}
