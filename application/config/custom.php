<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['upload_path'] = 'uploadfile/';
$config['upload_path_thumb'] = 'uploadfile/thumb/';
$config['maxfile_size'] = 1024 * 10; // // in kilobytes (2048 = 2MB)
$config['maxfile_size_desc'] = 'Batas ukuran maksimal 10 MB per file';

//$config['db_eoffice'] = 'db_pupuk_indonesia_eoffice';
$config['db_presensikita'] = 'db_presensi_rsmb';
$config['table_company'] = $config['db_presensikita'] . '.z_compcode';
$config['table_site'] = $config['db_presensikita'] . '.pre_site';
$config['table_unit'] = $config['db_presensikita'] . '.z_unit';
$config['table_unit_acting_as'] = $config['db_presensikita'] . '.z_unit_acting_as';
$config['table_costcenter'] = $config['db_presensikita'] . '.z_costcenter';
$config['table_position'] = $config['db_presensikita'] . '.z_position';
$config['table_position_employee'] = $config['db_presensikita'] . '.z_position_employee';
$config['table_employee'] = $config['db_presensikita'] . '.z_karyawan';
$config['table_user'] = $config['db_presensikita'] . '.pre_sec_user';
$config['table_absensi'] = $config['db_presensikita'] . '.z_absensi';
$config['table_absensi_log'] = $config['db_presensikita'] . '.z_absensi_log';
$config['table_absensi_type'] = $config['db_presensikita'] . '.z_absen_type';
$config['table_time_profile'] = $config['db_presensikita'] . '.z_time_profile';
$config['table_timeprofile_person'] = $config['db_presensikita'] . '.z_tp_person';
$config['table_keluarga'] = $config['db_presensikita'] . '.z_keluarga';
$config['table_cuti_tahunan'] = $config['db_presensikita'] . '.z_cuti';
$config['table_cuti_adjustment'] = $config['db_presensikita'] . '.z_cuti_adj';
$config['table_periode_absen'] = $config['db_presensikita'] . '.z_periode_gaji';
$config['table_setting_periode'] = $config['db_presensikita'] . '.z_setting_periode';
$config['table_setting_harilibur'] = $config['db_presensikita'] . '.z_factory_cal';
$config['table_kantor'] = $config['db_presensikita'] . '.z_kantor';


$config['view_user'] = $config['db_presensikita'] . '.pre_v_sec_user';
$config['view_unit'] = $config['db_presensikita'] . '.z_v_unit';


//Z_TABLES
$config['table_p_z_company'] = $config['db_presensikita'] . '.z_compcode';


$config['position_vp_manris'] = '50041863';
$config['position_vp_tkk'] = '50041866';
$config['position_vp_sisman'] = '50041869';
$config['position_svp_tkk'] = '50041861';
$config['position_dirut'] = '50000219';
$config['unit_komp_tkk'] = '50038753';
