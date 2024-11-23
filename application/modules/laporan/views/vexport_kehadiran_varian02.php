<html>
<head>
    <title><?php echo isset($title_head) ? $title_head : '' ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style type='text/css'>

    table {
        font-size : 10pt;
        font-family: sans-serif;
        border: 0.5mm solid black;
        border-collapse: collapse;
    }
    table.table2 {
        font-size : 10pt;
        border: 1mm solid black;
        border-collapse: collapse;
    }
    table.layout {
        font-size : 10pt;
        border: 0.5mm solid black;
        border-collapse: collapse;
    }
    td.layout {
        font-size : 10pt;
        text-align: center;
        border: 0.5mm solid black;
    }
    td {
        font-size : 10pt;
        padding: 1.5mm;
        border: 0.5mm solid black;
        vertical-align: middle;
    }
    td.redcell {
        font-size : 10pt;
        border: 0.5mm solid black;
    }
    td.redcell2 {
        font-size : 10pt;
        border: 0.5mm solid black;
    }



    </style>
</head>
<body>

    <?php
    function get_days_in_month($month, $year)
    {
        if ($month == "02")
        {
            if ($year % 4 == 0) return 29;
            else return 28;
        }
        else if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") return 31;
        else return 30;
    }
    $totDays = get_days_in_month($bulan, $tahun);
    $tot_colspan = $totDays + 9;

    function bln($var){
        $ret = "";
        switch ($var) {
            case 1  : $ret = "Januari"; break;
            case 2  : $ret = "Februari"; break;
            case 3  : $ret = "Maret"; break;
            case 4  : $ret = "April"; break;
            case 5  : $ret = "Mei"; break;
            case 6  : $ret = "Juni"; break;
            case 7  : $ret = "Juli"; break;
            case 8  : $ret = "Agustus"; break;
            case 9  : $ret = "September"; break;
            case 10 : $ret = "Oktober"; break;
            case 11 : $ret = "Nopember"; break;
            case 12 : $ret = "Desember"; break;
            default : "";
        }
        return $ret;
    }

    ?>
    <td colspan="34" align="center">
        <strong>JADWAL <?php echo strtoupper($namaUnit) ?></strong><br/>
        <strong><?php echo $infolap ?></strong>
    </td>
    <br/> <br/>
    <?php      
    $grouped = [];
    $columns = [];
    $isi_content = "";    
    $jam_masuk = "-";
    $jam_pulang = "-";
    $tgl = "";
    $printType2 = "";
    $total_poin_ketidakhadiran = 0;
    $total_poin_keterlambatan = 0;
    $tot_person = 0;

    $res = json_decode(json_encode($results));
  
    foreach ($res as $row) {
        $isi_content  = "";
        $jam_masuk = "-";
        $jam_pulang = "-";
        $jam_masuk = ($row->jam_masuk == '00:00:00') ? '-' : $row->jam_masuk;
        $jam_pulang = ($row->jam_pulang == '00:00:00') ? '-' : $row->jam_pulang;
        /*
        if($row->id_abs_type == 12){
            if($jam_masuk != '-' || $jam_pulang  !='-'){
                $isi_content  = $row->ket_libur.'<br style="mso-data-placement:same-cell;" />'.$jam_masuk.'<br style="mso-data-placement:same-cell;" />'.$jam_pulang;
            }else{
                $isi_content  = $row->ket_libur;
            }
        }else{  
            if($row->id_abs_type == 8){
                $isi_content = $row->keterangan;
            }else if($row->id_abs_type == 1 || $row->id_abs_type == 2){
                $isi_content = $jam_masuk.'<br style="mso-data-placement:same-cell;" />'.$jam_pulang;
            }else{

                if($jam_masuk != '-' || $jam_pulang  !='-'){
                    $isi_content = $row->keterangan.'<br style="mso-data-placement:same-cell;" />'.$jam_masuk.'<br style="mso-data-placement:same-cell;" />'.$jam_pulang;
                }else{
                    $isi_content = $row->keterangan;
                }
                
            } 
        }
        */

        if($row->type == "detail"){
            if($row->kode_jadwal == "L"){
                $isi_content = "<span style='color:red;font-weight:bold'>".$row->kode_jadwal.'</span>';
            }else{
                $isi_content = $row->kode_jadwal;
            }
            
            $tgl = "";
            //$tgl = '&nbsp;'.substr($row->tanggal,0,2).'<br style="mso-data-placement:same-cell;" />'.bln(substr($row->tanggal,4,2)).'&nbsp;';
            $tgl = '&nbsp;'.substr($row->tanggal,0,2).'&nbsp;';

        }else if($row->type == "jamkerja"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Jam <br style="mso-data-placement:same-cell;" /> Kerja';
        }else if($row->type == "jmlcuti"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Jumlah  <br style="mso-data-placement:same-cell;" /> Cuti';
        }else if($row->type == "cuti"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Sisa  <br style="mso-data-placement:same-cell;" /> Cuti';
        }else if($row->type == "jml_sakit"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Jumlah  <br style="mso-data-placement:same-cell;" /> Sakit';
        }else if($row->type == "jml_dinas"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Jumlah  <br style="mso-data-placement:same-cell;" /> Dinas';
        }else if($row->type == "jml_dispensasi"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Jumlah  <br style="mso-data-placement:same-cell;" /> Dispensasi';
        }else if($row->type == "jml_pelatihan"){
            $tgl = "";
            $isi_content = $row->jml_jam_kerja;
            $tgl = 'Jumlah  <br style="mso-data-placement:same-cell;" /> Pelatihan';
        }else if($row->type == "poin_ketidakhadiran"){
            $tgl = "";
            $isi_content = $row->jml_pot_point_kehadiran;
            $tgl = 'Poin  <br style="mso-data-placement:same-cell;" /> Ketidak Hadiran';

            if(!empty($row->jml_pot_point_kehadiran)){
                
                $total_poin_ketidakhadiran += str_replace(' %','',$row->jml_pot_point_kehadiran);
                $tot_person += 1;
            }
            
        }else if($row->type == "poin_keterlambatan"){
            $tgl = "";
            $isi_content = $row->jml_pot_point_keterlambatan;
            $tgl = 'Poin  <br style="mso-data-placement:same-cell;" /> Keterlambatan';
            
            if(!empty($row->jml_pot_point_keterlambatan)){
                
                $total_poin_keterlambatan += str_replace(' %','',$row->jml_pot_point_keterlambatan);
            }
        }
 
        //$columns[$jabatan] = $jabatan;

        $grouped[$row->emp_name][$tgl] = $isi_content;
        $columns[$tgl] = $tgl;

        $unit = $row->unitName;
        $jabatan = $row->position_desc;
        $grouped[$row->emp_name]['unit'] = $unit;
        $grouped[$row->emp_name]['jabatan'] = $jabatan;
        //$columns[$jabatan] = $jabatan;
    }

    //sort($columns);
    $defaults = array_fill_keys($columns, '-');

    array_unshift($columns, 'Unit');
    array_unshift($columns, 'Jabatan');
    array_unshift($columns, 'Nama');
    
    ?>
    <table class="layout" border="1">
    <?php 
        printf(
            "<tr class='layout'><th>%s</th></tr>\n",
            implode('</th><th>', $columns)
        );
        
        foreach ($grouped as $name => $records) {
            $unit = $records['unit'];
            $jabatan = $records['jabatan'];
            isset($records['test']);
            unset($records['unit']);
            unset($records['jabatan']);
            printf(
                "<tr>
                   
                    <td align='left' class='layout'>%s</td>
                    <td align='center' class='layout'>". $jabatan ."</td>
                    <td align='center' class='layout'>". $unit ."</td>
                    <td align='center' class='layout'>%s</td>
                </tr>\n",
                $name,
                implode('</td><td align="center" class="layout">', array_replace($defaults, $records))
            );
        }

        $avg_poin_ketidakhadiran = 0;
        if($total_poin_ketidakhadiran > 0){
            $avg_poin_ketidakhadiran = round($total_poin_ketidakhadiran / $tot_person,2);
        }

        $avg_poin_keterlambatan = 0;
        if($total_poin_keterlambatan > 0){
            $avg_poin_keterlambatan = round($total_poin_keterlambatan / $tot_person,2);
        }
        
        

        echo "<tr>
                <td align='right' colspan='".$tot_colspan."'>Rata-rata &nbsp;</td>
                <td align='center'>".$avg_poin_ketidakhadiran."%</td>
                <td align='center'>".$avg_poin_keterlambatan."%</td>
            </tr>";
    ?>
    </table> 
    
    <br/><br/><br/>
    <table style="border: none;">
        <tr>
            <td colspan="2" style="border: none; vertical-align: top;" >
                <!-- P : PAGI Jam 07.00 - 14.00	<br/>
                KA.RU : Jam 08.00 - 15.00	<br/>
                P# : PAGI(Sabtu) Jam 08.00 - 13.00	 <br/>
                S : SORE Jam 14.00 - 21.00	 <br/>
                M : MALAM Jam 21.00 - 07.00	 <br/>
                M1 : Midle Pagi	 <br/>
                M2 : Midle Siang	 <br/>
                M3 : Midle Sore	 <br/> -->
                <?php 
                foreach ($jadwal as $rowJdwl) {
                    echo $rowJdwl->kode." : ".$rowJdwl->hari_1_jam_in." - ".$rowJdwl->hari_1_jam_out."<br/>";
                }
                ?>
                L : LIBUR	 <br/>
            </td>
            <td align="center" colspan="8" style="border: none;">
                Mengetahui
                <br/><br/><br/><br/>
                ( .................... )
            </td>
            <td colspan="5" style="border: none;" valign="top">
                CD	CUTI DISPENSASI		<br/>		
                CS	CUTI SAKIT			<br/>	
                CN	CUTI NIKAH		<br/>		
                CH	CUTI HAMIL			<br/>	
                C1 - C12		CUTI TAHUNAN		<br/>		
                C1# - C12#		CUTI TAHUNAN		<br/>		
                ST	SURAT TUGAS				<br/>
                -	LEMBUR				<br/>
                /	TUKAR DINAS				<br/>

            </td>
            <td align="center" colspan="5" style="border: none;">
                KA Ruangan  
                <br/><br/><br/><br/>
                ( .................... )
            </td>
        </tr>
    </table>




</body>
</html>



