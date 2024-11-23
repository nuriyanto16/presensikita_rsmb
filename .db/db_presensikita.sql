/*
 Navicat Premium Data Transfer

 Source Server         : MARIADB_LOCAL
 Source Server Type    : MariaDB
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : db_presensikita

 Target Server Type    : MariaDB
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 27/07/2021 14:47:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for log_activity
-- ----------------------------
DROP TABLE IF EXISTS `log_activity`;
CREATE TABLE `log_activity`  (
  `logdate` datetime(0) NULL DEFAULT NULL,
  `ipaddress` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `compname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `userid` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modulalias` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `activity` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `httpagent` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `httphost` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mac_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log_activity
-- ----------------------------
INSERT INTO `log_activity` VALUES ('2020-06-22 16:30:15', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '1', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-22 16:32:11', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '1', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-22 16:43:20', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_KANTOR', '1', 'Hari Libur Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 10:40:32', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_KANTOR', '2', 'Hari Libur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 10:42:40', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '1000', 'Karyawan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 13:50:18', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '1000', 'Karyawan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:09:34', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_USERMANAGE', '6', 'Tambah User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:16:06', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '4', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:19:46', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '2', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:20:49', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '2', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:21:42', '::1', 'DESKTOP-AIRGNI8', '6', 'MOD_REF_COMPANY', '2', 'Company Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:23:49', '::1', 'DESKTOP-AIRGNI8', '6', 'MOD_REF_CUTITAHUNAN', '2', 'Cuti Tahunan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:24:35', '::1', 'DESKTOP-AIRGNI8', '6', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:24:54', '::1', 'DESKTOP-AIRGNI8', '6', 'MOD_PRESENSI_IZIN', 'ABCDE2.IZ.06.2020.000001', 'Izin Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:33:20', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_COMPANY', '3', 'Company Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:43:38', '::1', 'DESKTOP-AIRGNI8', '6', 'MOD_PRESENSI_IZIN', 'ABCDE2.IZ.06.2020.000001', 'Izin Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:54:03', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '2', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:57:08', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '1', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 14:58:00', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '4', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 15:01:08', '::1', 'DESKTOP-AIRGNI8', '6', 'MOD_REF_ORGANISASI', '6', 'Organisasi Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-23 15:44:22', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRIVMANAGE', '2', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-24 20:35:59', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '19', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-06-30 15:03:10', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_MODULEMANAGE', '40', 'Tambah Modul', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-01 09:37:21', '127.0.0.1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_PERIODEABSEN', '2', 'Periode Absen Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-09 17:37:00', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_MODULEMANAGE', '41', 'Tambah Modul', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:10:07', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_COMPANY', '3', 'Company Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:16:26', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_KANTOR', '3', 'Hari Libur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:17:10', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_ORGANISASI', '7', 'Organisasi Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:18:01', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_ORGANISASI', '10000', 'Posisi / Jabatan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:22:05', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_CUTITAHUNAN', '3', 'Cuti Tahunan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:25:18', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '45', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:27:01', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '45', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 17:27:37', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_REF_EMPLOYEE', '45', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 19:33:12', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_LAPORANHARIAN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 19:34:20', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_LAPORANHARIAN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 19:35:16', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_LAPORANHARIAN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-07-10 19:36:17', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_LAPORANHARIAN', '3F8D04.LP.07.2020.000003', 'Laporan Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:78.0) Gecko/20100101 Firefox/78.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-17 11:21:21', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_USERMANAGE', '3', 'Update User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-17 11:21:35', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_USERMANAGE', '2', 'Update User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-28 14:20:07', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_IZIN', 'ABCDE1.IZ.05.2020.000003', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-28 14:24:00', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_IZIN', 'ABCDE1.IZ.05.2020.000004', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-28 14:40:01', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-28 14:40:26', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_IZIN', 'ABCDE1.IZ.09.2020.000001', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-28 15:31:08', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_IZIN', 'ABCDE1.IZ.09.2020.000001', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2020-09-28 15:44:04', '::1', 'DESKTOP-AIRGNI8', '2', 'MOD_PRESENSI_CUTI', 'ABCDE1.CT.05.2020.000002', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 10:32:10', '127.0.0.1', 'eabsensi.local', '2', 'MOD_MODULEMANAGE', '42', 'Tambah Modul', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 13:17:14', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 13:19:04', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 13:45:06', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', 'bceff1a6-d7d8-11eb-9d1f-00ffe12eb819', 'Lembur Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 13:51:28', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 13:55:06', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '437b0fc6-d7dd-11eb-9c0b-00ffe12eb819', 'Lembur Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-06-28 13:55:40', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '437b0fc6-d7dd-11eb-9c0b-00ffe12eb819', 'Lembur Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-12 13:12:14', '127.0.0.1', 'eabsensi.local', '2', 'MOD_REF_EMPLOYEE', '10', 'Karyawan Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:16:02', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:16:22', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '84076fb1-e53c-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:28:26', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '84076fb1-e53c-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:29:36', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '84076fb1-e53c-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:30:17', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:32:13', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '8180e6cd-e53e-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:34:01', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '8180e6cd-e53e-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:35:25', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '8180e6cd-e53e-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:36:37', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '8180e6cd-e53e-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:38:28', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:38:37', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', 'a5dd8b7c-e53f-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:40:31', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:40:40', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', 'ef5caa42-e53f-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:41:40', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:42:27', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:43:38', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '3457f264-e540-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:48:59', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:49:26', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '1e1d0149-e541-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:50:29', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_CUTI', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:51:08', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_CUTI', '53de13b7-e541-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:54:04', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_PENGOBATAN', '', 'Pengobatan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:54:09', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_PENGOBATAN', 'd40a5aa0-e541-11eb-a65f-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:54:36', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_GANTIBIAYA', '', 'Penggantian Biaya Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:56:10', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_DINAS', '', 'Pelatihan Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 14:57:21', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_DINAS', '1f5020a5-e542-11eb-a65f-00ffe1', 'Pelatihan Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 15:19:07', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_DINAS', '1f5020a5-e542-11eb-a65f-00ffe1', 'Pelatihan Diperbaharui', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 15:19:26', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_DINAS', '1f5020a5-e542-11eb-a65f-00ffe1', 'Apporval Pelatihan', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:07:21', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_DINAS', '1f5020a5-e542-11eb-a65f-00ffe1', 'Apporval Pelatihan', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:08:59', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_DINAS', '1f5020a5-e542-11eb-a65f-00ffe1', 'Apporval Pelatihan', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:10:48', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:20:07', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:24:17', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', 'd9ba2829-e54d-11eb-a65f-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:24:46', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', 'd9ba2829-e54d-11eb-a65f-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-15 16:25:20', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LAPORANHARIAN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-21 15:53:45', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-21 15:53:59', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_IZIN', '29867cc5-ea01-11eb-99b8-00ffe1', 'Apporval Izin', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 10:26:40', '127.0.0.1', 'eabsensi.local', '2', 'MOD_REF_COMPANY', '1', 'Company Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 10:26:56', '127.0.0.1', 'eabsensi.local', '2', 'MOD_REF_COMPANY', '1', 'Company Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 10:27:21', '127.0.0.1', 'eabsensi.local', '2', 'MOD_REF_COMPANY', '1', 'Company Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 10:27:42', '127.0.0.1', 'eabsensi.local', '2', 'MOD_REF_COMPANY', '1', 'Company Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 11:25:16', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LAPORANHARIAN', '', 'Izin Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 11:30:47', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:00:39', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', 'c1062270-eb6e-11eb-82e0-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:31:33', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', 'c1062270-eb6e-11eb-82e0-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:32:08', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRESENSI_LEMBUR', 'c1062270-eb6e-11eb-82e0-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:33:27', '127.0.0.1', 'eabsensi.local', '2', 'MOD_USERMANAGE', '3', 'Update User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:34:59', '127.0.0.1', 'eabsensi.local', '2', 'MOD_USERMANAGE', '13', 'Tambah User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:35:59', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRIVMANAGE', '3', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:37:01', '127.0.0.1', 'eabsensi.local', '2', 'MOD_USERMANAGE', '13', 'Update User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:40:46', '127.0.0.1', 'eabsensi.local', '2', 'MOD_PRIVMANAGE', '3', 'Update Otorisasi', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:42:07', '127.0.0.1', 'eabsensi.local', '13', 'MOD_PRESENSI_LEMBUR', '0', 'Lembur Baru', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:42:58', '127.0.0.1', 'eabsensi.local', '13', 'MOD_REF_COMPANY', '1', 'Company Diupdate', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-23 16:44:48', '127.0.0.1', 'eabsensi.local', '2', 'MOD_USERMANAGE', '3', 'Update User', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-26 14:00:33', '127.0.0.1', 'eabsensi.local', '13', 'MOD_PRESENSI_LEMBUR', '3f86446f-eb9a-11eb-82e0-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');
INSERT INTO `log_activity` VALUES ('2021-07-26 14:16:05', '127.0.0.1', 'eabsensi.local', '3', 'MOD_PRESENSI_LEMBUR', '3f86446f-eb9a-11eb-82e0-00ffe12eb819', 'Apporval Lembur', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:90.0) Gecko/20100101 Firefox/90.0', 'localhost', '');

-- ----------------------------
-- Table structure for m_paket
-- ----------------------------
DROP TABLE IF EXISTS `m_paket`;
CREATE TABLE `m_paket`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_satuan` decimal(10, 0) NULL DEFAULT NULL,
  `harga` decimal(10, 0) NULL DEFAULT NULL,
  `masa_berlaku` int(11) NULL DEFAULT NULL,
  `jml_karyawan` int(11) NULL DEFAULT NULL,
  `disc` float NOT NULL,
  `jml_bln` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_m_paket`(`id`, `nama_paket`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_paket
-- ----------------------------
INSERT INTO `m_paket` VALUES (1, 'Starter Plan', '1 Bulan', 10000, 200000, 30, 20, 0, 1);
INSERT INTO `m_paket` VALUES (2, 'Basic Plan', '3 Bulan', 10000, 600000, 90, 20, 0.03, 3);
INSERT INTO `m_paket` VALUES (3, 'Advanced Plan', '6 Bulan', 10000, 1200000, 180, 20, 0.06, 6);
INSERT INTO `m_paket` VALUES (4, 'Corporate Plan', '1 Tahun', 10000, 2400000, 365, 20, 0.12, 12);
INSERT INTO `m_paket` VALUES (5, 'Paket Free', '2 Minggu', 0, 0, 14, 5, 0, 0);

-- ----------------------------
-- Table structure for m_peserta
-- ----------------------------
DROP TABLE IF EXISTS `m_peserta`;
CREATE TABLE `m_peserta`  (
  `id` bigint(6) NOT NULL AUTO_INCREMENT,
  `inst_id` int(11) NULL DEFAULT NULL,
  `inst_code` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_peserta` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `peserta_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `passwd` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgllahir` date NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `remember` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` bit(1) NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `forgotten_password_code` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `activation_code` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember_code` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto_peserta` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'default_img.png',
  `provinsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kota` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nohp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `inst_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expired_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_peserta
-- ----------------------------
INSERT INTO `m_peserta` VALUES (1, NULL, '0F3F10', 'nuriyanto1@gmail.com', 'nuriyanto1@gmail.com', 'Nuriyanto', 'Nuriyanto', '$2y$08$MbtGRpEMxOLismU4b4CfQOKALNs3J/VWFt4syliKal2rjYCOzd86i', NULL, NULL, NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat ', 'Bandung', 'Bandung', '087823337000', 'PT. MST 1', NULL);
INSERT INTO `m_peserta` VALUES (2, NULL, '885B63', 'nuriyanto2@gmail.com', 'nuriyanto2@gmail.com', 'Nuriyanto', 'Nuriyanto', '$2y$08$vjZI4kV/9SmZRLJetuYeOOgBiHUlpMyX2C/jiID8kQBBCtpsIq0oK', NULL, NULL, NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat', 'Bandung', 'Bandung', '087823339000', 'PT. MST 1', NULL);
INSERT INTO `m_peserta` VALUES (3, NULL, 'CE4E27', 'sayarhungs1@gmail.com', 'sayarhungs1@gmail.com', 'Nuriyanto', 'Nuriyanto', '$2y$08$/mEf9LySffM0BY1piEuVZ.6HujrEBVz1D0XL1gtVwGQFhgh7kgvim', NULL, NULL, NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat', 'Bandung', 'Kopo', '087823339001', 'PT. MST 2', NULL);
INSERT INTO `m_peserta` VALUES (4, NULL, '9F6421', 'sayarhungs2@gmail.com', 'sayarhungs2@gmail.com', 'Nuriyanto Nur', 'Nuriyanto Nur', '$2y$08$YAS7Xc0V1GNkI8RXELQBau.0P3IbFaPYpYCxP4daTdotJ0lwuzW/2', NULL, '0000-00-00 00:00:00', NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat', 'Bandung', 'Kopo', '087823339008', 'PT. MST 2', NULL);
INSERT INTO `m_peserta` VALUES (5, NULL, '9D2776', 'sayarhungs3@gmail.com', 'sayarhungs3@gmail.com', 'Nuriyanto Nur', 'Nuriyanto Nur', '$2y$08$CWzfzhYIgz/XClPDnImtpOf8zsxYypzmGsVo/xp175f7xGeZRc2Ka', NULL, '0000-00-00 00:00:00', NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat', 'Bandung', 'Kopo', '087823339007', 'PT. MST 3', NULL);
INSERT INTO `m_peserta` VALUES (6, NULL, '32B9FF', 'sayarhungs4@gmail.com', 'sayarhungs4@gmail.com', 'Nuriyanto Nur 2', 'Nuriyanto Nur 2', '$2y$08$yVbDhxWRDJd7KnLwYPTqV.zF/9vojWCRxMQt6Ti5pxX6BDJ/ihGg.', NULL, '0000-00-00 00:00:00', NULL, b'1', NULL, NULL, NULL, 'Nz3HhF/DFR/8F4broqJOOu', 'default_img.png', 'Jawa Barat', 'Bandung', 'Kopo', '087823339010', 'PT. MST 4', NULL);
INSERT INTO `m_peserta` VALUES (7, NULL, 'C96B42', 'sayarhungs6@gmail.com', 'sayarhungs6@gmail.com', 'Nuriyanto Nur', 'Nuriyanto Nur', '$2y$08$gAyJVr5t.9ojwKJ/QKR/gOIqE0GdB9cp5JWhd1IdPrzIlr2qf4N8m', NULL, NULL, NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat', 'Bandung', 'Kopo', '08782333999', 'PT. MST 2', NULL);
INSERT INTO `m_peserta` VALUES (8, NULL, 'FD3049', 'sayarhungs7@gmail.com', 'sayarhungs7@gmail.com', 'Nuriyanto', 'Nuriyanto', '$2y$08$QwOyX3AKryZK0t95o/nQuuSQLb3H.L8mBG4yltxmJQPozelLG/VPK', NULL, '0000-00-00 00:00:00', NULL, b'1', NULL, NULL, NULL, NULL, 'default_img.png', 'Jawa Barat', 'Bandung', 'Bandung', '08782338889', 'PT. MST', NULL);

-- ----------------------------
-- Table structure for notif
-- ----------------------------
DROP TABLE IF EXISTS `notif`;
CREATE TABLE `notif`  (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `notif_date` datetime(0) NULL DEFAULT NULL,
  `src_uid` int(11) NULL DEFAULT NULL,
  `dest_uid` int(11) NULL DEFAULT NULL,
  `notif_subj` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `notif_msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `notif_url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_read` bit(1) NULL DEFAULT b'0',
  `notif_date_read` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`notif_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of notif
-- ----------------------------
INSERT INTO `notif` VALUES (1, '2020-03-18 16:56:07', 29, 168, 'Approval RCSA', 'PI-RTM-04 [2020]', 'rcsa/input_rtm/edit_form/714e27863a2d4f251142ae3297b3b65d4e9f3fdcc89f1e2b0760d8e526f5be3dc69b64fc69a20029c70f797b6e6ab5b1078990d10a4fd1d942f20ac4221559e7GwKhd-oJdMCN_OPiQ3MkWRk2Muv3aUfYgR0cfxgdR8k', b'1', '2020-03-19 10:23:22');
INSERT INTO `notif` VALUES (2, '2020-03-19 10:34:57', 168, 77, 'Approval RCSA', 'PI-RTM-04 [2020]', 'rcsa/input_rtm/edit_form/7537d1f28237b4124051479f1281f166a23a2aac9eb0e14807e3eb18e18abe1a7643a41f5be3ed4335efd72419c9ed6ef3be4baa89f8e7cc909536a121bbae8cSiFnlP7QW8b4ZBYWkd4yY1X5Vag6TUHRTZgbCVHiPZ8', b'1', '2020-03-19 10:36:10');
INSERT INTO `notif` VALUES (3, '2020-03-19 15:37:26', 29, 168, 'Approval RCSA', 'KTI-SB2-01 [2020]', 'rcsa/input_non_rtm//edit_form/38e7711f54741ea7b52a736eb3149f15e5d43ec61bb6b8fa23fbd2584f83f6a011806995635d65e69e86d92240076338a63ff43625e5d3cf9234c76b4f1edc45Nyd71dXTFo0BlAlTmWdMqMkW0Ew8y0DPIR4LJcWcdro', b'1', '2020-03-19 15:41:39');
INSERT INTO `notif` VALUES (4, '2020-03-20 09:48:10', 77, 58, 'Approval RCSA', 'PI-RTM-04 [2020]', 'rcsa/input_rtm//edit_form/dbb9201cc62c27f741affe91353a679e55df737421e89c13c5faf65f7e85196eaee558a74e32ba51e492eab4c5eeebdb7e5b17520cdbb0a613afdbeb033ecc63DIGWx14RlA5it02wE6haKCnd4FeSC0DAUoY3cIGxUok', b'1', '2020-03-20 10:26:23');
INSERT INTO `notif` VALUES (5, '2020-03-20 10:47:08', 58, 168, 'Approval RCSA', 'PI-RTM-01 [2020]', 'rcsa/input_rtm//edit_form/a3970701ae9f0fddafd642dfacf242653be8ee0a006ca3c39d22c8aaf3a9fad678fc569fd38062a596741644b4cf13ae5e2e63514e1a6534d3eed3505dd430a0er9l9Vp9L1vi3rmg7rTMVhJuhpcKrMAEe_ekvOI0hgA', b'0', NULL);
INSERT INTO `notif` VALUES (6, '2020-03-23 23:14:45', 29, 168, 'Approval Monitoring RCSA', 'PI-RTM-01 [Januari 2020]', 'rcsa/monitoring_rtm//edit_form/9b692ce73f0ee5d50e1a0af72ded0fa515c97f303916649278156be42da6b482ed92a6a85bc9ec7454f4ea6692dbadd047b475c9d5adc7423e54612680e475ce1ruSKE8g1UJYqq356306outgnP2s3sRahN9MXRvq61I', b'1', '2020-03-24 01:36:37');
INSERT INTO `notif` VALUES (7, '2020-03-24 01:41:19', 168, 77, 'Approval Monitoring RCSA', 'PI-RTM-01 [Januari 2020]', 'rcsa/monitoring_rtm//edit_form/4644071927f34733117ff2823553fd3ee1907ce095e54156644a29597eac44824927ec7394fe9b1de406f00c531b930c70cac81d8ec0ae86c56688f8c0d079e8Ke6Z-QHZUzymvID6i5XcMLwQI7GTG4ws6p69R-SIpII', b'1', '2020-03-24 01:41:43');
INSERT INTO `notif` VALUES (8, '2020-03-24 01:43:30', 77, 58, 'Approval Monitoring RCSA', 'PI-RTM-01 [Januari 2020]', 'rcsa/monitoring_rtm//edit_form/a55afcbefa84ef1da048e8826ccf1ff3350b6ce47441ca8883411c64e4639aae8069b0ed6125ab3775485b8a6f199d17079bff9045ae72462f3dd311096907aeRfGmqQYsWRTwD5Qf0CflyJXskAahxtThC6qYpfy38QU', b'1', '2020-03-24 01:43:47');
INSERT INTO `notif` VALUES (9, '2020-03-24 09:50:17', 29, 168, 'Approval RCSA', 'PI-RTM-05 [2020]', 'rcsa/input_rtm//edit_form/38a5688aca9bbc419df45d72411b41d0b8a77a50b6331f3d3282eae14a1075a70eb8563bd6da426a2bfde8326635a925429ccc45acb0973d3e7ffc3ff26a7e7fQRBxsE60DlVKQtWRCgR71BShHiZtpn9MhwGcZvaJajo', b'1', '2020-03-24 09:52:17');
INSERT INTO `notif` VALUES (10, '2020-03-24 09:53:26', 168, 77, 'Approval RCSA', 'PI-RTM-05 [2020]', 'rcsa/input_rtm//edit_form/a16ce0e16a58883b4e59bf9d5f05fde52033768aeda8672204cb38fdac20a4e44f61c5fcffe95f9a13064bcaa4e047b3493a882abc6b2a81b6dc036bfd5d7f50rLZuklkYBGFoZ67V_o4ycPHzAlGI8u2X7f5zfuf5AOw', b'1', '2020-03-24 09:54:21');
INSERT INTO `notif` VALUES (11, '2020-03-24 09:55:00', 77, 58, 'Approval RCSA', 'PI-RTM-05 [2020]', 'rcsa/input_rtm//edit_form/80ec5aa6a0ec5d25534fa67786b2840481e6b1d98faac2cacb3c14dd02e33fa329a47ae4b10d58f96a131418d0f161f5e23a7d89a1d20e81d706f6ec9f244419NUJZpPlE5FDZUBJ4ODJDiPjn_2-JDgvzAN9omcziMus', b'1', '2020-03-24 09:55:42');
INSERT INTO `notif` VALUES (12, '2020-03-24 10:19:56', 29, 168, 'Approval Monitoring RCSA', 'PI-RTM-01 [Februari 2020]', 'rcsa/monitoring_rtm//edit_form/adb344a60d0f66d0349651f848a64a22b351d8a3d918584faa752739c4cc15f4a5352a880ec5677b0f8bae9b4c51c7b67ae897dd172ce609ff2cf680fe2c066bG7zTCBXVaOOWTwHj96Y3RAefPISoDwRmyf6RvpR9fHk', b'1', '2020-03-24 10:21:06');
INSERT INTO `notif` VALUES (13, '2020-03-24 10:21:30', 168, 77, 'Approval Monitoring RCSA', 'PI-RTM-01 [Februari 2020]', 'rcsa/monitoring_rtm//edit_form/f4597076bf47659cc1623791fb8db38bb103b1315c48c98ec505373e8597983ec13f928587400fd2c0f454ea195732d2d750c1a48a6a12707c079e8d7ef917aazrp9rlqnohEzyr3TVmyZJ0pzgw-x999oHpzM9-KWbp0', b'1', '2020-03-24 10:22:11');
INSERT INTO `notif` VALUES (14, '2020-03-24 10:23:42', 58, 77, 'Approval Monitoring RCSA', 'PI-RTM-01 [Februari 2020]', 'rcsa/monitoring_rtm//edit_form/3b7920fd3cf53a8a8f43ee320239163547e6c020431e6c759dcb6bde6e77e5f0bcdc22f608fcdb63029339d6330ae057288373dba1443b4533a3845f230c1c834kEJkgF--4Q9gmXHKadVJwje0kd6WqBrwT6W5kKB1SA', b'1', '2020-05-01 21:59:58');
INSERT INTO `notif` VALUES (15, '2020-04-02 13:14:13', 58, 168, 'Approval RCSA', 'KTI-SB2-01 [2020]', 'rcsa/input_non_rtm//edit_form/cf1efc59431351a6948b3831316c618e45d459d5c4c81b1fcadbbf0312d15d85c55660888769926cb2ab98b12e33af846af3cc6de8e02d51141671b8195f643aC-V2TRHsIIhBV8AgI55DIjVBQZN7UXOurwb4ZmJDcSQ', b'0', NULL);
INSERT INTO `notif` VALUES (16, '2020-04-02 16:12:02', 200, 58, 'Approval RCSA', 'PI-RTM-07 [2020]', 'rcsa/input_rtm//edit_form/de69c3468a20fd6b70ce05698a545750720e0bd5f0f39972f3f205ecb4f12c7146d8c3338a956d1170b87e153b07f76a2737419a6a9eb9fda58ec5364d78b938jgLe1cYNUwnJKb7ZYgbxtVdyutjWpCEH096fcY4abbg', b'1', '2020-04-02 16:12:35');
INSERT INTO `notif` VALUES (17, '2020-04-02 16:12:55', 58, 2, 'Approval RCSA', 'PI-RTM-07 [2020]', 'rcsa/input_rtm//edit_form/b6efaaa31ae3aa910e0ac9983c3b29f4d04804a54bc484a99fa69ed6b1a7fb3d45eeebf6837ad3fa205c4b13712dc177e6fe6ee93eb6857a097261c751b3870bI0mcHPzyBicEaSVExpEdOCoXT5APUnnEtoxBlyx-dtA', b'1', '2020-04-02 16:14:00');
INSERT INTO `notif` VALUES (18, '2020-04-02 16:15:42', 91, 2, 'Approval RCSA', 'PI-RTM-07 [2020]', 'rcsa/input_rtm//edit_form/14c3ed9ba42d4fc3b023baef6d31ea43be6ea649ee939390629fa825da42da499d59bf44db6665bcf0502fad6c43e2f16eaf1f1e9a96cbf4d4464d2bbc633c1cMnXmXCRjaQQQACJuAQc1GmRLci8jD8zA089yafEoxnA', b'1', '2020-04-02 16:15:57');
INSERT INTO `notif` VALUES (19, '2020-04-05 20:42:03', 29, 2, 'Approval Input Risiko Aksi Korporasi', 'Aksi korporasi 1', 'korporasi/input_risiko//edit_form/4158f4b2f923938145aa994023e035afceee5436c30652b70ef9ed59fa4f73623ed2822977f8c67b644a6d1226276edee4ba42edeb9ba819ea12e3ba271daed8vBmJ4QzEUc3APzEEweMT8aqAfHAZfSQKNLKv0uIM-0Q', b'1', '2020-04-05 20:42:32');
INSERT INTO `notif` VALUES (20, '2020-04-08 08:47:47', 29, 2, 'Approval Input Risiko Aksi Korporasi', 'Aksi korporasi 2', 'korporasi/input_risiko//edit_form/523cd7d126f23f00b42037730629188895ca95253fbc04709add1fd5303275c81cfc3c561a3279eb3273348199b86495e5f2f5c57d505972a6900d9e60d67f0bufSVHrrz-nw6-KTgUIbQsUtQTZQKhbAxkvRVkwjhjFM', b'1', '2020-04-08 08:47:59');
INSERT INTO `notif` VALUES (21, '2020-04-20 13:45:32', 1400, 2, 'Approval RCSA', 'PI-RTM-08 [2020]', 'rcsa/input_rtm//edit_form/886759cd90e8bd0e3b8a16a0b293d58a03fb6fef0508dd809042fe756bec2c2d7a00be49e4fa59dd1cb894eac5ff0db4eb6488a07ee7cf17aac5fffd378eb335JZKGwM9J2iLpu6EzH8JQ9s6UeC38aWT7PzEnrH3SMwg', b'1', '2020-04-20 13:48:06');
INSERT INTO `notif` VALUES (22, '2020-04-20 13:48:45', 1403, 2, 'Approval RCSA', 'PI-RTM-08 [2020]', 'rcsa/input_rtm//edit_form/ebab766d78ecb63ecd15b9084cf6b39dfe838228ef86041fad4356a080ca57811f51b5011aef18d78b99b446679b29a1ea24aaa05313dbc984a03ab68cc892b2NaAbc1MgITbNcTBFx9TwF8EnNeQAhnpnkoCeKqIwqbo', b'1', '2020-04-23 22:05:36');

-- ----------------------------
-- Table structure for pre_sec_user
-- ----------------------------
DROP TABLE IF EXISTS `pre_sec_user`;
CREATE TABLE `pre_sec_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `prefix` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `full_name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `ip_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `current_login` datetime(0) NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `activation_code` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `forgotten_password_code` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `forgotten_password_time` int(11) NULL DEFAULT NULL,
  `remember_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nik` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `empId` bigint(20) NULL DEFAULT NULL,
  `compId` int(11) NULL DEFAULT NULL,
  `unitId` bigint(20) NULL DEFAULT NULL,
  `positionId` int(11) NULL DEFAULT NULL,
  `positionDesc` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `positionCode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `represent` tinyint(4) NULL DEFAULT NULL,
  `representUnitId` int(11) NULL DEFAULT NULL,
  `representPositionId` int(11) NULL DEFAULT NULL,
  `active` tinyint(4) NULL DEFAULT NULL,
  `dt_superadmin` tinyint(4) NOT NULL,
  `dt_admin` tinyint(4) NOT NULL,
  `dt_user` tinyint(4) NOT NULL,
  `lastNoSuratReg` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_pre_sec_users`(`id`, `username`, `email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pre_sec_user
-- ----------------------------
INSERT INTO `pre_sec_user` VALUES (2, 'superadmin', 'Bpk.', 'Administrator', 'sayarhungs@gmail.com', '$2a$08$Z20BlJQq/klrboZxnOjotehMQ2dRQmTtZY2aY5zK9wFY18P/./gwW', '2017-07-01 14:43:00', '2021-07-27 04:10:41', '::1', NULL, '', '', '', NULL, NULL, 'avatar4.png', '087823339007', '201609006', 1, 1, 1, 6, 'Project Manager', '10000004', 1, NULL, 0, 1, 0, 0, 1, '');
INSERT INTO `pre_sec_user` VALUES (3, 'admin', 'Bpk.', 'Admin Aplikasi', 'tanyasrirejekinovianti@gmail.com', '$2a$08$uve9usrKpt8IlzCRwnCl.eFafx.iN/izIo1KNagzd0BNn8TIu472O', '2018-12-19 17:47:00', '2021-07-26 09:15:52', '', NULL, '', '', '', NULL, '', 'avatar.png', '', '201706004', 9, 1, 3, 3, 'HR & GA', '10000004', 0, NULL, 0, 1, 0, 0, 1, NULL);
INSERT INTO `pre_sec_user` VALUES (6, 'indorental_hrd', 'Bpk.', 'Admin / HR Indorental', '1001_idrabsen@gmail.com', '$2a$08$zS40OvktmJ/2rWc/u7EKYeXktqvu/jXiXb1RVJPHTz8GLSA4NkiZu', '2020-06-23 14:09:33', '0000-00-00 00:00:00', '::1', NULL, NULL, NULL, NULL, NULL, 'Nz3HhF/DFR/8F4broqJOOu', 'profile123.png', '', '1001', NULL, 2, 6, 0, 'Admin HR', NULL, 0, NULL, 0, 1, 0, 0, 0, NULL);
INSERT INTO `pre_sec_user` VALUES (7, 'Nuriyanto', 'Bpk.', 'Nuriyanto', 'sayarhungs1@gmail.com', '$2y$08$/mEf9LySffM0BY1piEuVZ.6HujrEBVz1D0XL1gtVwGQFhgh7kgvim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', '087823339001', NULL, NULL, 3, NULL, NULL, NULL, '10000004', NULL, NULL, NULL, 1, 0, 0, 0, NULL);
INSERT INTO `pre_sec_user` VALUES (13, 'azis', 'Bpk.', 'Abdul Azis', 'abah.khansa@gmail.com', '$2a$08$8byBam8rykeM.7gDvYz3DOMh2XzPd5R5S.IRZHLHT2YUwyBLot/oa', '2021-07-23 11:34:59', '2021-07-26 09:01:24', '127.0.0.1', NULL, NULL, NULL, NULL, NULL, NULL, '20200710_172701__profile_A001_3F8D04_avatar5.png', '', '201609002', 3, 1, 1, 6, 'Direktur Utama', NULL, 0, NULL, 0, 1, 0, 0, 0, NULL);

-- ----------------------------
-- Table structure for pre_site
-- ----------------------------
DROP TABLE IF EXISTS `pre_site`;
CREATE TABLE `pre_site`  (
  `siteId` int(11) NOT NULL AUTO_INCREMENT,
  `siteCode` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `siteName` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `siteAlias` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `compId` int(11) NULL DEFAULT NULL,
  `address` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address2` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address3` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `city` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `negara` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `zipCode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `website` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`siteId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pre_site
-- ----------------------------
INSERT INTO `pre_site` VALUES (1, 'A000', 'PT Mitra Sinerji Teknoindo', 'PT Mitra Sinerji Teknoindo', 1, 'Metro Indah Mall', '', '', 'Bandung', 'Indonesia', '+62 21 536 54 900', '+62 21 8064 7955', '11480', '-', 'http://pupuk-indonesia.com', 1);

-- ----------------------------
-- Table structure for sec_login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `sec_login_attempts`;
CREATE TABLE `sec_login_attempts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sec_modul
-- ----------------------------
DROP TABLE IF EXISTS `sec_modul`;
CREATE TABLE `sec_modul`  (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `module_alias` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `module_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mod_icon_cls` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mod_seq` int(11) NOT NULL,
  `module_pid` int(11) NULL DEFAULT NULL,
  `publish` int(11) NOT NULL,
  `mod_group` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_sapage` tinyint(4) NOT NULL,
  PRIMARY KEY (`module_id`) USING BTREE,
  INDEX `idx_sec_modul`(`module_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sec_modul
-- ----------------------------
INSERT INTO `sec_modul` VALUES (1, 'Dashboard', 'MOD_HOME', 'main/dashboard', 'icon-pie-chart', 0, 0, 1, 'main', 0);
INSERT INTO `sec_modul` VALUES (2, 'Utilitas', 'MOD_UTILITY', '#', 'icon-settings', 99, 0, 1, 'utility', 0);
INSERT INTO `sec_modul` VALUES (3, 'Master Data', 'MOD_REF', '#', 'icon-docs', 1, 0, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (4, 'Transaction', 'MOD_RCSA', '#', 'icon-layers', 1, 0, 1, 'rcsa', 0);
INSERT INTO `sec_modul` VALUES (5, 'Laporan', 'MOD_REP', '#', 'icon-chart', 5, 0, 1, 'laporan', 0);
INSERT INTO `sec_modul` VALUES (6, 'Daftar Pengguna', 'MOD_USERMANAGE', 'utility/user_manage', '', 1, 2, 1, 'utility', 0);
INSERT INTO `sec_modul` VALUES (7, 'Group / Role', 'MOD_ROLEMANAGE', 'utility/role_manage', '', 2, 2, 1, 'utility', 0);
INSERT INTO `sec_modul` VALUES (8, 'Atur Otorisasi', 'MOD_PRIVMANAGE', 'utility/privilege_manage', '', 3, 2, 1, 'utility', 0);
INSERT INTO `sec_modul` VALUES (9, 'Daftar Modul', 'MOD_MODULEMANAGE', 'utility/module_manage', '', 4, 2, 1, 'utility', 0);
INSERT INTO `sec_modul` VALUES (10, 'Perusahaan', 'MOD_REF_COMPANY', 'reference/company', '', 1, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (11, 'Organisasi', 'MOD_REF_ORGANISASI', 'reference/organisasi', '', 3, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (12, 'Posisi / Jabatan', 'MOD_REF_POSITION', 'reference/position', '', 5, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (13, 'Cost Center', 'MOD_REF_COSTCENTER', 'reference/costcenter', '', 4, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (14, 'Karyawan', 'MOD_REF_EMPLOYEE', 'reference/employee', '', 11, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (16, 'Presensi', 'MOD_PRESENSI', '#', 'icon-layers', 2, 0, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (17, 'Absensi', 'MOD_PRESENSI_ABSENSI', 'presensi/absensi', '', 1, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (18, 'Jadwal Kerja', 'MOD_REF_TIMEPROFILE', 'reference/timeprofile', '', 6, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (19, 'Setting Cuti Tahunan', 'MOD_REF_CUTITAHUNAN', 'reference/cutitahunan', '', 7, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (20, 'Setting Periode Absensi', 'MOD_REF_PERIODEABSEN', 'reference/periodeabsen', '', 8, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (21, 'Setting Tanggal Presensi', 'MOD_REF_SETTINGPRESENSI', 'reference/settingpresensi', '', 9, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (32, 'Izin / Sakit', 'MOD_PRESENSI_IZIN', 'presensi/izin', '', 2, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (33, 'Cuti', 'MOD_PRESENSI_CUTI', 'presensi/cuti', '', 3, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (34, 'Pengobatan', 'MOD_PRESENSI_PENGOBATAN', 'presensi/pengobatan', '', 4, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (35, 'Penggantian Biaya', 'MOD_PRESENSI_GANTIBIAYA', 'presensi/gantibiaya', '', 5, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (36, 'Pelatihan', 'MOD_PRESENSI_PELATIHAN', 'presensi/pelatihan', '', 6, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (37, 'Dinas', 'MOD_PRESENSI_DINAS', 'presensi/dinas', '', 5, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (38, 'Setting Hari Libur', 'MOD_REF_HARILIBUR', 'reference/harilibur', '', 10, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (39, 'Kantor', 'MOD_REF_KANTOR', 'reference/kantor', '', 2, 3, 1, 'ref', 0);
INSERT INTO `sec_modul` VALUES (40, 'Rekapitulasi Absensi', 'MOD_LAPORAN_REKAPABSEN', 'laporan/rekapabsen', '', 1, 5, 1, 'laporan', 0);
INSERT INTO `sec_modul` VALUES (41, 'Laporan Harian', 'MOD_PRESENSI_LAPORANHARIAN', 'presensi/laporanharian', '', 8, 16, 1, 'presensi', 0);
INSERT INTO `sec_modul` VALUES (42, 'Lembur', 'MOD_PRESENSI_LEMBUR', 'presensi/lembur', '', 9, 16, 1, 'presensi', 0);

-- ----------------------------
-- Table structure for sec_role
-- ----------------------------
DROP TABLE IF EXISTS `sec_role`;
CREATE TABLE `sec_role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_alias` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sec_role
-- ----------------------------
INSERT INTO `sec_role` VALUES (1, 'Super Administrator', 'superadmin', 1);
INSERT INTO `sec_role` VALUES (2, 'Administrator', 'admin-mr', 1);
INSERT INTO `sec_role` VALUES (3, 'Approval', 'approval-1-2', 1);
INSERT INTO `sec_role` VALUES (4, 'Member', 'risk-officer', 1);
INSERT INTO `sec_role` VALUES (7, 'Direksi', 'direksi', 1);

-- ----------------------------
-- Table structure for sec_role_priv
-- ----------------------------
DROP TABLE IF EXISTS `sec_role_priv`;
CREATE TABLE `sec_role_priv`  (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `allow_view` tinyint(4) NOT NULL,
  `allow_new` tinyint(4) NOT NULL,
  `allow_edit` tinyint(4) NOT NULL,
  `allow_delete` tinyint(4) NOT NULL,
  `allow_print` tinyint(4) NOT NULL,
  `allow_approve` tinyint(4) NOT NULL,
  PRIMARY KEY (`role_id`, `module_id`) USING BTREE,
  INDEX `module_id`(`module_id`) USING BTREE,
  CONSTRAINT `sec_role_priv_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `sec_modul` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sec_role_priv
-- ----------------------------
INSERT INTO `sec_role_priv` VALUES (1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 2, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 3, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 4, 0, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (1, 5, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 6, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 7, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 8, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 9, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 10, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 11, 1, 1, 1, 0, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 12, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 13, 0, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (1, 14, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 16, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 17, 1, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (1, 18, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 19, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 20, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 21, 1, 0, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 32, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 33, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 34, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 35, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 36, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 37, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 38, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 39, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 40, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 41, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (1, 42, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 3, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 4, 0, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (2, 10, 1, 0, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 11, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 12, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 14, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 16, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 17, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 18, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 19, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 20, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 21, 1, 0, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 32, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 33, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 34, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 35, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 36, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 37, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 38, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 39, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 40, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 41, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (2, 42, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 3, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 4, 0, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (3, 10, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 11, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 14, 1, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (3, 16, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 17, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 18, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 19, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 20, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 21, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 32, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 33, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 34, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 35, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 36, 0, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (3, 37, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 38, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 39, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 40, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 41, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (3, 42, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 3, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 4, 0, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (4, 10, 1, 0, 1, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (4, 11, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 12, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 14, 1, 0, 0, 0, 0, 0);
INSERT INTO `sec_role_priv` VALUES (4, 16, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 17, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 18, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 19, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 20, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 21, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 32, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 33, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 34, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 35, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 36, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 37, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 38, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 39, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 40, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 41, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (4, 42, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (5, 10, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (5, 11, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (6, 10, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (6, 11, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 3, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 4, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 10, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 16, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 17, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 18, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 19, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 20, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 21, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 32, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 33, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 34, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 35, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 36, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 37, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 38, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 39, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 40, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 41, 1, 1, 1, 1, 1, 1);
INSERT INTO `sec_role_priv` VALUES (7, 42, 1, 1, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for sec_user_role
-- ----------------------------
DROP TABLE IF EXISTS `sec_user_role`;
CREATE TABLE `sec_user_role`  (
  `userid` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`userid`, `role_id`) USING BTREE,
  INDEX `idx_sec_role`(`userid`, `role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sec_user_role
-- ----------------------------
INSERT INTO `sec_user_role` VALUES (1, 1);
INSERT INTO `sec_user_role` VALUES (2, 1);
INSERT INTO `sec_user_role` VALUES (3, 2);
INSERT INTO `sec_user_role` VALUES (4, 4);
INSERT INTO `sec_user_role` VALUES (5, 4);
INSERT INTO `sec_user_role` VALUES (6, 2);
INSERT INTO `sec_user_role` VALUES (6, 4);
INSERT INTO `sec_user_role` VALUES (7, 4);
INSERT INTO `sec_user_role` VALUES (8, 4);
INSERT INTO `sec_user_role` VALUES (9, 4);
INSERT INTO `sec_user_role` VALUES (10, 4);
INSERT INTO `sec_user_role` VALUES (11, 4);
INSERT INTO `sec_user_role` VALUES (12, 4);
INSERT INTO `sec_user_role` VALUES (13, 3);
INSERT INTO `sec_user_role` VALUES (14, 4);
INSERT INTO `sec_user_role` VALUES (15, 4);
INSERT INTO `sec_user_role` VALUES (16, 4);
INSERT INTO `sec_user_role` VALUES (17, 4);
INSERT INTO `sec_user_role` VALUES (18, 4);
INSERT INTO `sec_user_role` VALUES (19, 4);
INSERT INTO `sec_user_role` VALUES (20, 4);
INSERT INTO `sec_user_role` VALUES (21, 4);
INSERT INTO `sec_user_role` VALUES (22, 4);
INSERT INTO `sec_user_role` VALUES (23, 4);
INSERT INTO `sec_user_role` VALUES (24, 4);
INSERT INTO `sec_user_role` VALUES (25, 4);
INSERT INTO `sec_user_role` VALUES (26, 4);
INSERT INTO `sec_user_role` VALUES (27, 4);
INSERT INTO `sec_user_role` VALUES (28, 4);
INSERT INTO `sec_user_role` VALUES (29, 4);
INSERT INTO `sec_user_role` VALUES (30, 4);
INSERT INTO `sec_user_role` VALUES (31, 4);
INSERT INTO `sec_user_role` VALUES (32, 4);
INSERT INTO `sec_user_role` VALUES (33, 4);
INSERT INTO `sec_user_role` VALUES (34, 4);
INSERT INTO `sec_user_role` VALUES (35, 4);
INSERT INTO `sec_user_role` VALUES (36, 4);
INSERT INTO `sec_user_role` VALUES (37, 4);
INSERT INTO `sec_user_role` VALUES (38, 4);
INSERT INTO `sec_user_role` VALUES (39, 4);
INSERT INTO `sec_user_role` VALUES (40, 4);
INSERT INTO `sec_user_role` VALUES (41, 4);
INSERT INTO `sec_user_role` VALUES (42, 4);
INSERT INTO `sec_user_role` VALUES (43, 4);
INSERT INTO `sec_user_role` VALUES (44, 4);
INSERT INTO `sec_user_role` VALUES (45, 4);
INSERT INTO `sec_user_role` VALUES (46, 4);
INSERT INTO `sec_user_role` VALUES (47, 4);
INSERT INTO `sec_user_role` VALUES (48, 4);
INSERT INTO `sec_user_role` VALUES (49, 4);
INSERT INTO `sec_user_role` VALUES (50, 4);
INSERT INTO `sec_user_role` VALUES (51, 4);
INSERT INTO `sec_user_role` VALUES (52, 4);
INSERT INTO `sec_user_role` VALUES (53, 4);
INSERT INTO `sec_user_role` VALUES (54, 4);
INSERT INTO `sec_user_role` VALUES (55, 4);
INSERT INTO `sec_user_role` VALUES (56, 4);
INSERT INTO `sec_user_role` VALUES (57, 4);
INSERT INTO `sec_user_role` VALUES (58, 4);
INSERT INTO `sec_user_role` VALUES (59, 4);
INSERT INTO `sec_user_role` VALUES (60, 2);
INSERT INTO `sec_user_role` VALUES (61, 4);
INSERT INTO `sec_user_role` VALUES (62, 4);
INSERT INTO `sec_user_role` VALUES (63, 4);
INSERT INTO `sec_user_role` VALUES (64, 4);
INSERT INTO `sec_user_role` VALUES (65, 4);
INSERT INTO `sec_user_role` VALUES (66, 4);
INSERT INTO `sec_user_role` VALUES (67, 4);
INSERT INTO `sec_user_role` VALUES (68, 4);
INSERT INTO `sec_user_role` VALUES (69, 4);
INSERT INTO `sec_user_role` VALUES (70, 4);
INSERT INTO `sec_user_role` VALUES (71, 4);
INSERT INTO `sec_user_role` VALUES (72, 4);
INSERT INTO `sec_user_role` VALUES (73, 4);
INSERT INTO `sec_user_role` VALUES (74, 4);
INSERT INTO `sec_user_role` VALUES (75, 4);
INSERT INTO `sec_user_role` VALUES (76, 4);
INSERT INTO `sec_user_role` VALUES (77, 4);
INSERT INTO `sec_user_role` VALUES (78, 4);
INSERT INTO `sec_user_role` VALUES (79, 4);
INSERT INTO `sec_user_role` VALUES (80, 4);
INSERT INTO `sec_user_role` VALUES (81, 4);
INSERT INTO `sec_user_role` VALUES (82, 4);
INSERT INTO `sec_user_role` VALUES (83, 4);
INSERT INTO `sec_user_role` VALUES (84, 4);
INSERT INTO `sec_user_role` VALUES (85, 4);
INSERT INTO `sec_user_role` VALUES (86, 4);
INSERT INTO `sec_user_role` VALUES (87, 4);
INSERT INTO `sec_user_role` VALUES (88, 4);
INSERT INTO `sec_user_role` VALUES (89, 4);
INSERT INTO `sec_user_role` VALUES (90, 4);
INSERT INTO `sec_user_role` VALUES (91, 6);
INSERT INTO `sec_user_role` VALUES (92, 4);
INSERT INTO `sec_user_role` VALUES (93, 4);
INSERT INTO `sec_user_role` VALUES (94, 4);
INSERT INTO `sec_user_role` VALUES (95, 4);
INSERT INTO `sec_user_role` VALUES (96, 4);
INSERT INTO `sec_user_role` VALUES (97, 4);
INSERT INTO `sec_user_role` VALUES (98, 4);
INSERT INTO `sec_user_role` VALUES (99, 4);
INSERT INTO `sec_user_role` VALUES (100, 4);
INSERT INTO `sec_user_role` VALUES (101, 4);
INSERT INTO `sec_user_role` VALUES (102, 4);
INSERT INTO `sec_user_role` VALUES (103, 4);
INSERT INTO `sec_user_role` VALUES (104, 4);
INSERT INTO `sec_user_role` VALUES (105, 4);
INSERT INTO `sec_user_role` VALUES (106, 4);
INSERT INTO `sec_user_role` VALUES (107, 4);
INSERT INTO `sec_user_role` VALUES (108, 4);
INSERT INTO `sec_user_role` VALUES (109, 4);
INSERT INTO `sec_user_role` VALUES (110, 4);
INSERT INTO `sec_user_role` VALUES (111, 4);
INSERT INTO `sec_user_role` VALUES (112, 4);
INSERT INTO `sec_user_role` VALUES (113, 4);
INSERT INTO `sec_user_role` VALUES (114, 4);
INSERT INTO `sec_user_role` VALUES (115, 4);
INSERT INTO `sec_user_role` VALUES (116, 4);
INSERT INTO `sec_user_role` VALUES (117, 4);
INSERT INTO `sec_user_role` VALUES (118, 4);
INSERT INTO `sec_user_role` VALUES (119, 4);
INSERT INTO `sec_user_role` VALUES (120, 4);
INSERT INTO `sec_user_role` VALUES (121, 4);
INSERT INTO `sec_user_role` VALUES (122, 4);
INSERT INTO `sec_user_role` VALUES (123, 4);
INSERT INTO `sec_user_role` VALUES (124, 4);
INSERT INTO `sec_user_role` VALUES (125, 4);
INSERT INTO `sec_user_role` VALUES (126, 4);
INSERT INTO `sec_user_role` VALUES (127, 4);
INSERT INTO `sec_user_role` VALUES (128, 4);
INSERT INTO `sec_user_role` VALUES (129, 4);
INSERT INTO `sec_user_role` VALUES (130, 4);
INSERT INTO `sec_user_role` VALUES (131, 4);
INSERT INTO `sec_user_role` VALUES (132, 4);
INSERT INTO `sec_user_role` VALUES (133, 4);
INSERT INTO `sec_user_role` VALUES (134, 4);
INSERT INTO `sec_user_role` VALUES (135, 4);
INSERT INTO `sec_user_role` VALUES (136, 4);
INSERT INTO `sec_user_role` VALUES (137, 4);
INSERT INTO `sec_user_role` VALUES (138, 4);
INSERT INTO `sec_user_role` VALUES (139, 4);
INSERT INTO `sec_user_role` VALUES (140, 4);
INSERT INTO `sec_user_role` VALUES (141, 4);
INSERT INTO `sec_user_role` VALUES (142, 4);
INSERT INTO `sec_user_role` VALUES (143, 4);
INSERT INTO `sec_user_role` VALUES (144, 4);
INSERT INTO `sec_user_role` VALUES (145, 4);
INSERT INTO `sec_user_role` VALUES (146, 4);
INSERT INTO `sec_user_role` VALUES (147, 4);
INSERT INTO `sec_user_role` VALUES (148, 4);
INSERT INTO `sec_user_role` VALUES (149, 4);
INSERT INTO `sec_user_role` VALUES (150, 4);
INSERT INTO `sec_user_role` VALUES (151, 4);
INSERT INTO `sec_user_role` VALUES (152, 4);
INSERT INTO `sec_user_role` VALUES (153, 4);
INSERT INTO `sec_user_role` VALUES (154, 4);
INSERT INTO `sec_user_role` VALUES (155, 4);
INSERT INTO `sec_user_role` VALUES (156, 4);
INSERT INTO `sec_user_role` VALUES (157, 4);
INSERT INTO `sec_user_role` VALUES (158, 4);
INSERT INTO `sec_user_role` VALUES (159, 4);
INSERT INTO `sec_user_role` VALUES (160, 4);
INSERT INTO `sec_user_role` VALUES (161, 4);
INSERT INTO `sec_user_role` VALUES (162, 4);
INSERT INTO `sec_user_role` VALUES (163, 4);
INSERT INTO `sec_user_role` VALUES (164, 4);
INSERT INTO `sec_user_role` VALUES (165, 4);
INSERT INTO `sec_user_role` VALUES (166, 4);
INSERT INTO `sec_user_role` VALUES (167, 4);
INSERT INTO `sec_user_role` VALUES (168, 4);
INSERT INTO `sec_user_role` VALUES (169, 4);
INSERT INTO `sec_user_role` VALUES (170, 4);
INSERT INTO `sec_user_role` VALUES (171, 4);
INSERT INTO `sec_user_role` VALUES (172, 4);
INSERT INTO `sec_user_role` VALUES (173, 4);
INSERT INTO `sec_user_role` VALUES (174, 4);
INSERT INTO `sec_user_role` VALUES (175, 4);
INSERT INTO `sec_user_role` VALUES (176, 4);
INSERT INTO `sec_user_role` VALUES (177, 4);
INSERT INTO `sec_user_role` VALUES (178, 4);
INSERT INTO `sec_user_role` VALUES (179, 4);
INSERT INTO `sec_user_role` VALUES (180, 4);
INSERT INTO `sec_user_role` VALUES (181, 4);
INSERT INTO `sec_user_role` VALUES (182, 4);
INSERT INTO `sec_user_role` VALUES (183, 4);
INSERT INTO `sec_user_role` VALUES (184, 4);
INSERT INTO `sec_user_role` VALUES (185, 4);
INSERT INTO `sec_user_role` VALUES (186, 4);
INSERT INTO `sec_user_role` VALUES (187, 4);
INSERT INTO `sec_user_role` VALUES (188, 4);
INSERT INTO `sec_user_role` VALUES (189, 4);
INSERT INTO `sec_user_role` VALUES (190, 4);
INSERT INTO `sec_user_role` VALUES (191, 4);
INSERT INTO `sec_user_role` VALUES (192, 4);
INSERT INTO `sec_user_role` VALUES (193, 4);
INSERT INTO `sec_user_role` VALUES (194, 4);
INSERT INTO `sec_user_role` VALUES (195, 4);
INSERT INTO `sec_user_role` VALUES (196, 4);
INSERT INTO `sec_user_role` VALUES (197, 4);
INSERT INTO `sec_user_role` VALUES (198, 4);
INSERT INTO `sec_user_role` VALUES (199, 4);
INSERT INTO `sec_user_role` VALUES (200, 4);
INSERT INTO `sec_user_role` VALUES (201, 4);
INSERT INTO `sec_user_role` VALUES (202, 4);
INSERT INTO `sec_user_role` VALUES (203, 4);
INSERT INTO `sec_user_role` VALUES (204, 4);
INSERT INTO `sec_user_role` VALUES (205, 4);
INSERT INTO `sec_user_role` VALUES (206, 4);
INSERT INTO `sec_user_role` VALUES (207, 4);
INSERT INTO `sec_user_role` VALUES (208, 4);
INSERT INTO `sec_user_role` VALUES (209, 4);
INSERT INTO `sec_user_role` VALUES (210, 4);
INSERT INTO `sec_user_role` VALUES (211, 4);
INSERT INTO `sec_user_role` VALUES (212, 4);
INSERT INTO `sec_user_role` VALUES (213, 4);
INSERT INTO `sec_user_role` VALUES (214, 4);
INSERT INTO `sec_user_role` VALUES (215, 4);
INSERT INTO `sec_user_role` VALUES (216, 4);
INSERT INTO `sec_user_role` VALUES (217, 4);
INSERT INTO `sec_user_role` VALUES (218, 4);
INSERT INTO `sec_user_role` VALUES (219, 4);
INSERT INTO `sec_user_role` VALUES (220, 4);
INSERT INTO `sec_user_role` VALUES (221, 4);
INSERT INTO `sec_user_role` VALUES (222, 4);
INSERT INTO `sec_user_role` VALUES (223, 4);
INSERT INTO `sec_user_role` VALUES (224, 3);

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order`  (
  `id_order` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_order` timestamp(0) NOT NULL DEFAULT current_timestamp,
  `id_m_paket` int(11) NULL DEFAULT NULL,
  `id_m_peserta` bigint(20) NULL DEFAULT NULL,
  `bukti_bayar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `konfiramsi_bayar` tinyint(4) NULL DEFAULT 0,
  `tgl_konfirmasi` datetime(0) NULL DEFAULT NULL,
  `fileupload_bayar` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stat_bayar` tinyint(4) NULL DEFAULT 0,
  `stat_active` tinyint(4) NULL DEFAULT 0,
  `tgl_active` datetime(0) NULL DEFAULT NULL,
  `active` tinyint(4) NULL DEFAULT 1,
  `total_harga` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_satuan` decimal(10, 0) NULL DEFAULT NULL,
  `jml_karyawan` int(11) NULL DEFAULT NULL,
  `masa_berlaku` int(11) NULL DEFAULT NULL,
  `disc` float NULL DEFAULT NULL,
  PRIMARY KEY (`id_order`) USING BTREE,
  INDEX `idx_m_paket_tmp`(`id_order`, `id_m_paket`, `id_m_peserta`, `no_order`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES (1, '9D2776', '2020-09-17 09:53:57', 5, 9, '', 0, '0000-00-00 00:00:00', 'free.jpg', 1, 0, NULL, 1, NULL, NULL, 5, 14, NULL);
INSERT INTO `t_order` VALUES (2, '36AD60', '2020-09-17 09:57:13', 1, 5, NULL, 0, NULL, NULL, 0, 0, NULL, 1, '250.000', 12500, 20, 1, 0);
INSERT INTO `t_order` VALUES (3, 'D691D9', '2020-09-17 09:57:42', 1, 5, NULL, 0, NULL, NULL, 0, 0, NULL, 1, '250.000', 12500, 20, 1, 0);
INSERT INTO `t_order` VALUES (4, '32B9FF', '2020-09-17 10:00:33', 5, 10, '', 0, '0000-00-00 00:00:00', 'free.jpg', 1, 0, NULL, 1, NULL, NULL, 5, 14, NULL);
INSERT INTO `t_order` VALUES (5, '9DC05E', '2020-09-17 10:01:42', 3, 6, NULL, 0, NULL, NULL, 0, 0, NULL, 1, '1.500.000', 12500, 20, 6, 0.06);
INSERT INTO `t_order` VALUES (6, 'C96B42', '2020-09-17 10:12:11', 5, 11, '', 0, '0000-00-00 00:00:00', 'free.jpg', 1, 0, NULL, 1, NULL, NULL, 5, 14, NULL);
INSERT INTO `t_order` VALUES (7, 'FD3049', '2020-09-22 08:54:55', 5, 12, '', 0, '0000-00-00 00:00:00', 'free.jpg', 1, 0, NULL, 1, NULL, NULL, 5, 14, NULL);
INSERT INTO `t_order` VALUES (8, '241DE3', '2020-09-22 08:55:28', 1, 8, NULL, 0, '2020-09-22 09:05:46', 'buktibayar_1600740346.png', 1, 0, NULL, 1, '1.250.000', 12500, 100, 1, 0);
INSERT INTO `t_order` VALUES (9, 'E84A17', '2020-09-22 09:06:36', 1, 8, NULL, 0, NULL, NULL, 0, 0, NULL, 1, '375.000', 12500, 30, 1, 0);

-- ----------------------------
-- Table structure for t_pesan
-- ----------------------------
DROP TABLE IF EXISTS `t_pesan`;
CREATE TABLE `t_pesan`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pesan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_pesan
-- ----------------------------
INSERT INTO `t_pesan` VALUES (6, 'Nur', 'sayarhungs@gmail.com', 'Haii');
INSERT INTO `t_pesan` VALUES (7, 'Haii', 'sayarhungs@gmail.com', 'Test');

-- ----------------------------
-- Table structure for tr_visitor
-- ----------------------------
DROP TABLE IF EXISTS `tr_visitor`;
CREATE TABLE `tr_visitor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `waktu` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expired_date` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tanggal` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 433 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tr_visitor
-- ----------------------------
INSERT INTO `tr_visitor` VALUES (1, '::1', '22:08:59', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (2, '::1', '22:09:06', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (3, '::1', '22:09:15', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (4, '::1', '22:09:15', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (5, '::1', '22:09:27', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (6, '::1', '22:09:28', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (7, '::1', '22:09:30', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (8, '::1', '22:09:31', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (9, '::1', '22:09:32', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (10, '::1', '22:18:26', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (11, '::1', '22:18:29', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (12, '::1', '22:22:37', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (13, '::1', '22:22:41', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (14, '::1', '22:25:26', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (15, '::1', '22:25:55', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (16, '::1', '22:26:42', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (17, '::1', '22:26:50', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (18, '::1', '22:27:02', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (19, '::1', '22:27:19', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (20, '::1', '22:27:30', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (21, '::1', '22:27:53', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (22, '::1', '22:28:12', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (23, '::1', '22:28:55', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (24, '::1', '22:34:27', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (25, '::1', '22:34:41', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (26, '::1', '22:35:05', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (27, '::1', '22:36:10', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (28, '::1', '22:36:36', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (29, '::1', '22:37:28', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (30, '::1', '22:39:24', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (31, '::1', '22:39:27', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (32, '::1', '22:39:39', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (33, '::1', '22:40:11', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (34, '::1', '22:40:28', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (35, '::1', '22:43:07', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (36, '::1', '22:43:10', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (37, '::1', '22:43:28', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (38, '::1', '22:43:51', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (39, '::1', '22:44:50', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (40, '::1', '22:46:28', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (41, '::1', '22:47:24', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (42, '::1', '22:47:39', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (43, '::1', '22:48:11', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (44, '::1', '22:48:26', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (45, '::1', '22:50:57', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (46, '::1', '22:51:18', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (47, '::1', '22:53:02', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (48, '::1', '22:53:21', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (49, '::1', '22:53:39', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (50, '::1', '22:53:51', NULL, '0000-00-00 00:00:00', '2020-07-19');
INSERT INTO `tr_visitor` VALUES (51, '::1', '14:31:38', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (52, '::1', '14:31:42', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (53, '::1', '14:31:46', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (54, '::1', '15:19:57', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (55, '::1', '15:20:01', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (56, '::1', '15:20:03', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (57, '::1', '15:20:24', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (58, '::1', '15:20:26', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (59, '::1', '15:20:29', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (60, '::1', '15:20:31', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (61, '::1', '15:20:32', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (62, '::1', '15:20:37', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (63, '::1', '15:20:40', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (64, '::1', '16:17:10', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (65, '::1', '16:17:13', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (66, '::1', '16:18:24', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (67, '::1', '16:20:00', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (68, '::1', '16:22:07', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (69, '::1', '16:22:53', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (70, '::1', '16:23:07', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (71, '::1', '16:23:18', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (72, '::1', '16:24:19', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (73, '::1', '16:28:21', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (74, '::1', '16:28:39', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (75, '::1', '16:30:44', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (76, '::1', '16:31:02', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (77, '::1', '16:31:56', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (78, '::1', '16:32:11', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (79, '::1', '16:32:34', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (80, '::1', '16:46:18', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (81, '::1', '16:46:31', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (82, '::1', '16:47:57', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (83, '::1', '16:48:15', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (84, '::1', '16:48:30', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (85, '::1', '16:48:51', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (86, '::1', '16:49:04', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (87, '::1', '16:49:46', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (88, '::1', '16:50:01', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (89, '::1', '16:50:32', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (90, '::1', '16:50:58', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (91, '::1', '16:52:13', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (92, '::1', '16:52:28', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (93, '::1', '16:52:56', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (94, '::1', '16:53:43', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (95, '::1', '16:53:56', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (96, '::1', '16:54:42', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (97, '::1', '16:55:19', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (98, '::1', '16:55:34', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (99, '::1', '16:55:44', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (100, '::1', '16:56:01', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (101, '::1', '16:56:30', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (102, '::1', '16:58:42', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (103, '::1', '16:59:16', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (104, '::1', '17:05:33', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (105, '::1', '17:06:10', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (106, '::1', '17:06:31', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (107, '::1', '17:07:56', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (108, '::1', '17:09:02', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (109, '::1', '17:09:18', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (110, '::1', '17:13:46', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (111, '::1', '17:14:23', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (112, '::1', '17:21:04', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (113, '::1', '17:21:33', NULL, '0000-00-00 00:00:00', '2020-07-20');
INSERT INTO `tr_visitor` VALUES (114, '::1', '14:09:05', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (115, '::1', '14:09:12', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (116, '::1', '14:09:17', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (117, '::1', '14:18:15', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (118, '::1', '14:18:16', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (119, '::1', '14:18:18', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (120, '::1', '14:28:28', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (121, '::1', '14:29:04', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (122, '::1', '14:29:16', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (123, '::1', '14:30:39', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (124, '::1', '14:30:50', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (125, '::1', '14:31:16', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (126, '::1', '14:34:11', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (127, '::1', '14:34:44', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (128, '::1', '14:38:15', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (129, '::1', '14:46:34', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (130, '::1', '14:46:52', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (131, '::1', '14:47:21', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (132, '::1', '14:47:53', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (133, '::1', '14:48:37', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (134, '::1', '14:48:57', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (135, '::1', '14:50:03', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (136, '::1', '14:50:40', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (137, '::1', '14:50:55', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (138, '::1', '14:51:00', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (139, '::1', '14:51:14', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (140, '::1', '14:51:17', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (141, '::1', '14:51:20', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (142, '::1', '14:51:29', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (143, '::1', '14:58:28', NULL, '0000-00-00 00:00:00', '2020-07-21');
INSERT INTO `tr_visitor` VALUES (144, '::1', '14:12:33', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (145, '::1', '14:12:38', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (146, '::1', '14:12:43', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (147, '::1', '14:12:51', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (148, '::1', '14:12:53', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (149, '::1', '14:12:59', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (150, '::1', '14:13:20', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (151, '::1', '14:13:22', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (152, '::1', '14:13:30', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (153, '::1', '14:13:34', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (154, '::1', '14:13:36', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (155, '::1', '14:13:43', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (156, '::1', '16:10:12', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (157, '::1', '16:10:27', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (158, '::1', '16:10:44', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (159, '::1', '16:11:10', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (160, '::1', '16:11:12', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (161, '::1', '16:11:14', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (162, '::1', '16:11:15', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (163, '::1', '16:11:21', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (164, '::1', '16:11:22', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (165, '::1', '16:11:29', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (166, '::1', '16:11:52', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (167, '::1', '16:11:54', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (168, '::1', '16:11:57', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (169, '::1', '16:11:58', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (170, '::1', '16:13:05', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (171, '::1', '16:16:42', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (172, '::1', '16:16:45', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (173, '::1', '16:16:50', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (174, '::1', '16:16:51', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (175, '::1', '16:16:53', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (176, '::1', '16:16:54', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (177, '::1', '16:16:57', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (178, '::1', '16:17:53', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (179, '::1', '16:17:55', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (180, '::1', '16:18:56', NULL, '0000-00-00 00:00:00', '2020-08-04');
INSERT INTO `tr_visitor` VALUES (181, '::1', '15:57:31', NULL, '0000-00-00 00:00:00', '2020-08-07');
INSERT INTO `tr_visitor` VALUES (182, '::1', '15:57:48', NULL, '0000-00-00 00:00:00', '2020-08-07');
INSERT INTO `tr_visitor` VALUES (183, '::1', '05:44:07', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (184, '::1', '05:44:23', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (185, '::1', '05:44:31', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (186, '::1', '05:44:54', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (187, '::1', '05:44:56', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (188, '::1', '05:45:01', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (189, '::1', '05:45:05', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (190, '::1', '05:45:19', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (191, '::1', '05:45:20', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (192, '::1', '05:45:27', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (193, '::1', '05:58:57', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (194, '::1', '05:58:59', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (195, '::1', '05:59:02', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (196, '::1', '05:59:04', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (197, '::1', '05:59:11', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (198, '::1', '05:59:12', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (199, '::1', '05:59:14', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (200, '::1', '06:04:08', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (201, '::1', '06:04:23', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (202, '::1', '06:04:28', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (203, '::1', '06:04:52', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (204, '::1', '06:09:12', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (205, '::1', '06:09:48', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (206, '::1', '06:11:48', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (207, '::1', '06:16:15', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (208, '::1', '06:17:44', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (209, '::1', '06:26:22', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (210, '::1', '06:29:04', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (211, '::1', '06:30:45', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (212, '::1', '06:31:30', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (213, '::1', '06:33:37', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (214, '::1', '06:35:17', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (215, '::1', '06:35:35', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (216, '::1', '06:40:38', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (217, '::1', '06:41:40', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (218, '::1', '06:42:14', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (219, '::1', '06:42:43', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (220, '::1', '06:43:05', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (221, '::1', '06:52:20', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (222, '::1', '06:57:58', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (223, '::1', '06:58:26', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (224, '::1', '06:59:25', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (225, '::1', '06:59:40', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (226, '::1', '06:59:47', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (227, '::1', '06:59:52', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (228, '::1', '07:00:03', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (229, '::1', '07:00:05', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (230, '::1', '07:00:06', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (231, '::1', '07:00:09', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (232, '::1', '07:00:10', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (233, '::1', '07:00:12', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (234, '::1', '07:00:13', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (235, '::1', '07:00:19', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (236, '::1', '07:00:20', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (237, '::1', '07:00:21', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (238, '::1', '07:02:23', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (239, '::1', '07:02:28', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (240, '::1', '07:02:33', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (241, '::1', '07:06:26', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (242, '::1', '07:10:03', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (243, '::1', '07:11:15', NULL, '0000-00-00 00:00:00', '2020-08-20');
INSERT INTO `tr_visitor` VALUES (244, '::1', '09:19:17', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (245, '::1', '09:19:21', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (246, '::1', '09:19:23', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (247, '::1', '09:19:26', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (248, '::1', '09:19:29', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (249, '::1', '09:22:39', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (250, '::1', '09:41:57', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (251, '::1', '09:41:58', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (252, '::1', '09:41:59', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (253, '::1', '09:42:01', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (254, '::1', '09:42:02', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (255, '::1', '09:42:08', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (256, '::1', '09:47:14', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (257, '::1', '09:56:03', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (258, '::1', '09:59:22', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (259, '::1', '09:59:29', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (260, '::1', '10:50:16', NULL, '0000-00-00 00:00:00', '2020-09-01');
INSERT INTO `tr_visitor` VALUES (261, '::1', '16:31:13', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (262, '::1', '16:31:16', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (263, '::1', '16:41:02', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (264, '::1', '16:41:07', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (265, '::1', '16:41:13', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (266, '::1', '16:41:16', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (267, '::1', '16:41:38', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (268, '::1', '16:41:40', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (269, '::1', '16:41:41', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (270, '::1', '16:41:44', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (271, '::1', '16:45:27', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (272, '::1', '16:45:33', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (273, '::1', '16:45:34', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (274, '::1', '16:45:36', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (275, '::1', '16:54:39', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (276, '::1', '16:54:43', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (277, '::1', '16:54:45', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (278, '::1', '17:21:13', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (279, '::1', '17:21:17', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (280, '::1', '17:21:20', NULL, '0000-00-00 00:00:00', '2020-09-09');
INSERT INTO `tr_visitor` VALUES (281, '::1', '21:21:30', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (282, '::1', '21:21:33', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (283, '::1', '21:21:34', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (284, '::1', '21:22:09', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (285, '::1', '21:27:44', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (286, '::1', '21:27:46', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (287, '::1', '21:28:02', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (288, '::1', '21:28:11', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (289, '::1', '21:28:12', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (290, '::1', '21:28:13', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (291, '::1', '21:28:14', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (292, '::1', '21:28:51', NULL, '0000-00-00 00:00:00', '2020-09-10');
INSERT INTO `tr_visitor` VALUES (293, '::1', '08:50:52', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (294, '::1', '08:50:57', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (295, '::1', '09:08:50', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (296, '::1', '09:09:35', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (297, '::1', '09:09:39', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (298, '::1', '09:09:40', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (299, '::1', '09:09:42', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (300, '::1', '09:09:43', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (301, '::1', '09:10:23', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (302, '192.168.0.100', '09:11:13', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (303, '::1', '09:16:12', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (304, '::1', '09:16:13', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (305, '::1', '09:16:16', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (306, '::1', '09:16:18', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (307, '::1', '09:16:21', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (308, '::1', '09:16:22', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (309, '::1', '09:16:27', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (310, '::1', '09:16:29', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (311, '192.168.0.100', '09:42:40', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (312, '192.168.0.100', '09:42:48', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (313, '192.168.0.100', '09:42:52', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (314, '::1', '09:49:53', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (315, '::1', '09:50:38', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (316, '::1', '09:50:40', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (317, '::1', '09:50:42', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (318, '::1', '09:50:43', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (319, '::1', '09:51:30', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (320, '::1', '09:51:32', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (321, '::1', '10:03:37', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (322, '::1', '10:04:20', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (323, '::1', '10:04:21', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (324, '::1', '10:04:23', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (325, '::1', '10:04:24', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (326, '::1', '10:04:25', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (327, '::1', '10:20:06', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (328, '192.168.0.100', '15:31:46', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (329, '192.168.0.100', '15:31:48', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (330, '::1', '17:43:17', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (331, '::1', '17:43:20', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (332, '::1', '18:08:05', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (333, '::1', '18:08:06', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (334, '::1', '18:08:08', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (335, '::1', '18:08:09', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (336, '::1', '18:08:10', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (337, '::1', '18:09:07', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (338, '::1', '18:09:09', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (339, '::1', '18:09:10', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (340, '::1', '18:09:52', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (341, '::1', '18:09:53', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (342, '::1', '18:10:02', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (343, '::1', '18:10:08', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (344, '::1', '18:10:09', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (345, '::1', '18:10:16', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (346, '::1', '18:10:41', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (347, '::1', '18:10:42', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (348, '::1', '18:10:52', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (349, '::1', '18:10:53', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (350, '::1', '18:10:54', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (351, '::1', '18:10:55', NULL, '0000-00-00 00:00:00', '2020-09-11');
INSERT INTO `tr_visitor` VALUES (352, '::1', '11:50:30', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (353, '::1', '11:50:38', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (354, '::1', '11:50:39', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (355, '::1', '11:50:42', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (356, '::1', '11:50:44', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (357, '::1', '11:50:55', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (358, '::1', '11:50:58', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (359, '::1', '11:51:03', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (360, '::1', '13:11:22', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (361, '::1', '13:11:24', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (362, '::1', '13:11:30', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (363, '::1', '15:49:09', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (364, '::1', '15:49:11', NULL, '0000-00-00 00:00:00', '2020-09-15');
INSERT INTO `tr_visitor` VALUES (365, '::1', '09:49:15', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (366, '::1', '09:49:18', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (367, '::1', '09:49:39', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (368, '::1', '09:49:45', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (369, '::1', '09:51:14', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (370, '::1', '09:51:26', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (371, '::1', '09:51:27', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (372, '::1', '09:52:56', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (373, '::1', '09:54:05', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (374, '::1', '09:56:03', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (375, '::1', '09:56:09', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (376, '::1', '09:56:24', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (377, '::1', '09:56:50', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (378, '::1', '09:57:36', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (379, '::1', '09:58:35', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (380, '::1', '10:00:59', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (381, '::1', '10:01:37', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (382, '::1', '10:03:05', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (383, '::1', '10:03:07', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (384, '::1', '10:03:12', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (385, '::1', '10:03:51', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (386, '::1', '11:54:50', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (387, '::1', '11:54:57', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (388, '::1', '12:01:17', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (389, '::1', '12:01:20', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (390, '::1', '12:01:21', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (391, '::1', '12:01:23', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (392, '::1', '12:02:47', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (393, '::1', '12:03:09', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (394, '::1', '12:03:10', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (395, '::1', '12:05:24', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (396, '::1', '12:05:26', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (397, '::1', '12:05:33', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (398, '::1', '12:05:35', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (399, '::1', '12:09:12', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (400, '::1', '12:09:14', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (401, '::1', '12:09:23', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (402, '::1', '12:52:56', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (403, '::1', '13:05:11', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (404, '::1', '13:05:12', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (405, '::1', '13:05:13', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (406, '::1', '13:05:15', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (407, '192.168.0.100', '14:20:31', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (408, '192.168.0.100', '14:21:10', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (409, '192.168.0.100', '14:21:18', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (410, '192.168.0.100', '14:21:22', NULL, '0000-00-00 00:00:00', '2020-09-17');
INSERT INTO `tr_visitor` VALUES (411, '::1', '08:53:45', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (412, '::1', '08:53:49', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (413, '::1', '08:55:07', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (414, '::1', '08:55:12', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (415, '::1', '08:55:15', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (416, '::1', '08:55:17', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (417, '::1', '09:06:06', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (418, '::1', '09:06:08', NULL, '0000-00-00 00:00:00', '2020-09-22');
INSERT INTO `tr_visitor` VALUES (419, '::1', '17:42:54', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (420, '::1', '17:44:58', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (421, '::1', '17:45:01', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (422, '::1', '17:46:24', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (423, '::1', '17:46:29', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (424, '::1', '17:46:30', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (425, '::1', '17:46:31', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (426, '::1', '17:48:34', NULL, '0000-00-00 00:00:00', '2020-09-25');
INSERT INTO `tr_visitor` VALUES (427, '::1', '08:59:14', NULL, '0000-00-00 00:00:00', '2020-09-28');
INSERT INTO `tr_visitor` VALUES (428, '::1', '09:29:44', NULL, '0000-00-00 00:00:00', '2020-09-29');
INSERT INTO `tr_visitor` VALUES (429, '::1', '10:14:37', NULL, '0000-00-00 00:00:00', '2020-10-13');
INSERT INTO `tr_visitor` VALUES (430, '::1', '16:33:51', NULL, '0000-00-00 00:00:00', '2020-10-13');
INSERT INTO `tr_visitor` VALUES (431, '::1', '16:37:32', NULL, '0000-00-00 00:00:00', '2020-10-13');
INSERT INTO `tr_visitor` VALUES (432, '::1', '16:37:33', NULL, '0000-00-00 00:00:00', '2020-10-13');

-- ----------------------------
-- Table structure for z_absen_type
-- ----------------------------
DROP TABLE IF EXISTS `z_absen_type`;
CREATE TABLE `z_absen_type`  (
  `ID_ABS_TYPE` double NOT NULL,
  `ABS_TYPE_DESC` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  INDEX `idx_z_absen_type`(`ID_ABS_TYPE`, `ABS_TYPE_DESC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_absen_type
-- ----------------------------
INSERT INTO `z_absen_type` VALUES (0, 'Hari Libur');
INSERT INTO `z_absen_type` VALUES (1, 'Hadir');
INSERT INTO `z_absen_type` VALUES (2, 'Terlambat');
INSERT INTO `z_absen_type` VALUES (3, 'Izin');
INSERT INTO `z_absen_type` VALUES (4, 'Izin Terlambat');
INSERT INTO `z_absen_type` VALUES (5, 'Izin Pulang Cepat');
INSERT INTO `z_absen_type` VALUES (6, 'Sakit');
INSERT INTO `z_absen_type` VALUES (7, 'Cuti');
INSERT INTO `z_absen_type` VALUES (8, 'Alpha');
INSERT INTO `z_absen_type` VALUES (9, 'Dinas Luar');
INSERT INTO `z_absen_type` VALUES (10, 'Training');
INSERT INTO `z_absen_type` VALUES (11, 'Keterangan Lain');
INSERT INTO `z_absen_type` VALUES (12, 'Hari Libur');
INSERT INTO `z_absen_type` VALUES (13, 'Lupa Absen');
INSERT INTO `z_absen_type` VALUES (14, 'Lembur');

-- ----------------------------
-- Table structure for z_absensi
-- ----------------------------
DROP TABLE IF EXISTS `z_absensi`;
CREATE TABLE `z_absensi`  (
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMPID` int(11) NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_ABS` datetime(0) NOT NULL,
  `JAM_IN` datetime(0) NULL DEFAULT NULL,
  `JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `ID_ABS_TYPE` int(11) NOT NULL,
  `REMARK` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LONGITUDE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LATITUDE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LOKASI` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `URL_FOTO` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DEVICE` int(11) NULL DEFAULT NULL COMMENT '0 - Upload\r\n1 - Mobile',
  `URL_FOTO_PULANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ID_TP` int(11) NULL DEFAULT NULL,
  `EMP_ID` bigint(20) NULL DEFAULT 0,
  `JADWAL_MASUK` datetime(0) NULL DEFAULT NULL,
  `JADWAL_PULANG` datetime(0) NULL DEFAULT NULL,
  `UNITID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`NIK`, `COMP_CODE`, `TGL_ABS`, `ID_ABS_TYPE`) USING BTREE,
  UNIQUE INDEX `idx_emp_absensi`(`NIK`, `COMP_CODE`, `TGL_ABS`, `ID_ABS_TYPE`) USING BTREE,
  INDEX `idx_z_absensi`(`NIK`, `COMP_CODE`, `TGL_ABS`, `JAM_IN`, `JAM_OUT`, `ID_ABS_TYPE`, `EMP_ID`) USING BTREE,
  INDEX `idx_nik_absensi`(`NIK`) USING BTREE,
  INDEX `idx_empid_absensi`(`EMP_ID`) USING BTREE,
  INDEX `idx_tgl_absensi`(`TGL_ABS`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_absensi
-- ----------------------------
INSERT INTO `z_absensi` VALUES ('201609002', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 16:08:10', NULL, 1, NULL, '107.6647156', '-6.9639804', 'Unnamed Road, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 3, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609002', 0, 'ABCDE1', '2020-05-04 00:00:00', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 08:13:10', '2020-04-01 18:56:52', 1, NULL, '107.7274321', '-6.952906', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '20200401_081310__foto_absensi_6_ABCDE1_JPEG_20200401_081300_.png', 1, '', 1, 6, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 08:52:34', NULL, 1, NULL, '107.7272441', '-6.9529736', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 07:46:22', NULL, 1, NULL, '107.7272441', '-6.9529736', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 08:02:55', NULL, 1, NULL, '107.7274218', '-6.9528984', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 07:54:26', NULL, 1, NULL, '107.7274321', '-6.952906', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:01:37', NULL, 1, NULL, '107.7274321', '-6.952906', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 08:17:42', NULL, 1, NULL, '107.7274321', '-6.952906', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 07:59:37', NULL, 1, NULL, '107.7274523', '-6.952899', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 08:41:57', NULL, 1, NULL, '107.7274479', '-6.9528951', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 09:24:12', NULL, 1, NULL, '107.7274513', '-6.952895', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 08:58:51', NULL, 1, NULL, '107.7274024', '-6.9529022', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 08:57:42', NULL, 1, NULL, '107.7274073', '-6.9529013', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:13:59', NULL, 1, NULL, '107.7274071', '-6.9528995', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 08:01:30', NULL, 1, NULL, '107.7274064', '-6.9528985', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 08:30:02', NULL, 1, NULL, '107.7274063', '-6.9528979', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 08:03:48', NULL, 1, NULL, '107.727407', '-6.9529001', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 08:41:19', NULL, 1, NULL, '107.7274056', '-6.9529039', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 08:46:36', NULL, 1, NULL, '107.7274071', '-6.9529015', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 08:06:24', NULL, 1, NULL, '107.7274224', '-6.9529013', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609003', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:03:08', NULL, 1, NULL, '107.7274204', '-6.9529039', 'Jl. Kiwi Raya No.2, Cimekar, Cileunyi, Bandung, Jawa Barat 40623, Indonesia', '', 1, NULL, 1, 6, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 08:04:05', NULL, 1, NULL, '107.6657395', '-6.9638858', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 07:39:04', NULL, 1, NULL, '107.6650893', '-6.9614622', 'Jl. Ciwastra No.1, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 07:52:35', NULL, 1, NULL, '107.665728', '-6.9638806', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '20200408_075235__foto_absensi_201609004_ABCDE1_JPEG_20200408_075227_.png', 1, NULL, 1, 5, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 07:44:35', NULL, 1, NULL, '107.6629441', '-6.9585811', 'Jl. Setia Graha II No.52, Margasari, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 5, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 08:13:44', NULL, 1, NULL, '107.6657236', '-6.9638958', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 06:59:45', NULL, 1, NULL, '107.6621878', '-6.9588251', 'Jl. Marga Makmur No.15, Margasari, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 5, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 07:01:08', NULL, 1, NULL, '107.6646775', '-6.9622744', 'Jl. Harmony Park Residence, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 07:05:37', NULL, 1, NULL, '107.664681', '-6.9622782', 'Jl. Harmony Park Residence, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 07:45:31', NULL, 1, NULL, '107.6657204', '-6.9638952', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 07:39:59', NULL, 1, NULL, '107.6657209', '-6.9638948', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 07:00:39', NULL, 1, NULL, '107.6664861', '-6.962823', 'Jl. Baturaden Raya No.16, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 07:04:22', NULL, 1, NULL, '107.6673026', '-6.9635184', 'Jl. Baturaden II No.32, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 10:19:32', NULL, 1, NULL, '107.665718', '-6.96391', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 10:08:54', NULL, 1, NULL, '107.6672475', '-6.9634664', 'Jl. Baturaden I No.11, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-01 00:00:00', '2020-05-01 06:55:04', NULL, 1, NULL, '107.6679824', '-6.9634694', 'Jl. Baturaden IV No.8, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-05-01 08:00:00', '2020-05-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-04 00:00:00', '2020-05-04 07:20:19', NULL, 1, NULL, '107.6657158', '-6.9639144', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 08:20:37', NULL, 1, NULL, '107.6657158', '-6.9639144', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 07:51:33', NULL, 1, NULL, '107.666112', '-6.9613127', 'Jl. Rancasawo No.10, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 08:56:50', NULL, 1, NULL, '107.6657127', '-6.9639109', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-11 00:00:00', '2020-05-11 07:04:53', NULL, 1, NULL, '107.6651919', '-6.9623007', 'Jl. Ciwastra No.1, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-11 08:00:00', '2020-05-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 08:02:22', NULL, 1, NULL, '107.6657265', '-6.9638918', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 08:15:43', NULL, 1, NULL, '107.6657265', '-6.9638864', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 08:05:22', NULL, 1, NULL, '107.665372', '-6.9610191', 'Jl. Ciwastra No.82, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 11:01:42', NULL, 1, NULL, '107.665372', '-6.9610191', 'Jl. Ciwastra No.82, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-18 00:00:00', '2020-05-18 08:22:23', NULL, 1, NULL, '107.6661385', '-6.9639476', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-18 08:00:00', '2020-05-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:09:48', NULL, 1, NULL, '107.6657289', '-6.9638924', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 08:04:29', NULL, 1, NULL, '107.665372', '-6.9610191', 'Jl. Ciwastra No.82, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 5, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609004', 0, 'ABCDE1', '2020-05-22 00:00:00', '2020-05-22 13:42:02', NULL, 1, NULL, '107.6657301', '-6.9638925', 'Baturaden Techno Regency Blok C1, RT.01 / RW.07, Mekarjaya, Ranacasari, Mekarjaya, Kec. Rancasari, Kota Bandung, Jawa Barat 40292, Indonesia', '', 1, NULL, 1, 5, '2020-05-22 08:00:00', '2020-05-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 06:14:06', NULL, 1, NULL, '107.6334715', '-6.9515383', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200401_061406__foto_absensi_4_ABCDE1_JPEG_20200401_061355_.png', 1, NULL, 1, 4, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-02 00:00:00', '2020-04-02 07:07:45', NULL, 1, NULL, '107.6334744', '-6.9515282', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200402_070745__foto_absensi_4_ABCDE1_JPEG_20200402_070739_.png', 1, NULL, 1, 4, '2020-04-02 08:00:00', '2020-04-02 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-03 00:00:00', '2020-04-03 07:21:17', NULL, 1, NULL, '107.6334731', '-6.9515372', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200403_072117__foto_absensi_4_ABCDE1_JPEG_20200403_072109_.png', 1, NULL, 1, 4, '2020-04-03 08:00:00', '2020-04-03 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 08:18:59', NULL, 1, NULL, '107.6423004', '-6.9465298', 'Jl. Soekarno-Hatta No.526, RW.09, Cijaura, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40286, Indonesia', '20200407_081859__foto_absensi_201609005_ABCDE1_JPEG_20200407_081854_.png', 1, NULL, 1, 4, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 08:22:36', NULL, 1, NULL, '107.6334719', '-6.9514529', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200408_082236__foto_absensi_201609005_ABCDE1_JPEG_20200408_082231_.png', 1, NULL, 1, 4, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 07:25:13', NULL, 1, NULL, '107.6334818', '-6.9515177', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200409_072513__foto_absensi_201609005_ABCDE1_JPEG_20200409_072509_.png', 1, NULL, 1, 4, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 08:11:07', NULL, 1, NULL, '107.6334807', '-6.9515256', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200414_081107__foto_absensi_201609005_ABCDE1_JPEG_20200414_081104_.png', 1, NULL, 1, 4, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:10:06', NULL, 1, NULL, '107.6334744', '-6.9515231', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200415_081006__foto_absensi_201609005_ABCDE1_JPEG_20200415_081002_.png', 1, NULL, 1, 4, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 08:11:41', NULL, 1, NULL, '107.6334744', '-6.9515231', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200416_081141__foto_absensi_201609005_ABCDE1_JPEG_20200416_081138_.png', 1, NULL, 1, 4, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 08:38:41', NULL, 1, NULL, '107.6334744', '-6.9515231', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200417_083841__foto_absensi_201609005_ABCDE1_JPEG_20200417_083839_.png', 1, NULL, 1, 4, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 07:39:31', NULL, 1, NULL, '107.6334726', '-6.9515255', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200421_073931__foto_absensi_201609005_ABCDE1_JPEG_20200421_073929_.png', 1, NULL, 1, 4, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 07:48:36', NULL, 1, NULL, '107.6334682', '-6.951524', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '20200422_074836__foto_absensi_201609005_ABCDE1_JPEG_20200422_074835_.png', 1, NULL, 1, 4, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 09:14:37', NULL, 1, NULL, '107.6334718', '-6.9515271', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 08:06:36', NULL, 1, NULL, '107.633484', '-6.9515348', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 07:59:38', NULL, 1, NULL, '107.6334574', '-6.9515686', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 09:53:09', NULL, 1, NULL, '107.6334134', '-6.9515899', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:10:36', NULL, 1, NULL, '107.6334823', '-6.95154', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 07:58:41', NULL, 1, NULL, '107.6334825', '-6.9515406', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-04 00:00:00', '2020-05-04 09:02:36', NULL, 1, NULL, '107.6414653', '-6.945548', 'Jl. Soekarno-Hatta No.587, Binong, Kec. Batununggal, Kota Bandung, Jawa Barat 40275, Indonesia', '20200504_090236__foto_absensi_201609005_ABCDE1_JPEG_20200504_090229_.png', 1, NULL, 1, 4, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 08:35:03', NULL, 1, NULL, '107.6334823', '-6.9515349', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 07:59:27', NULL, 1, NULL, '107.6334874', '-6.9515393', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 08:44:53', NULL, 1, NULL, '107.6334845', '-6.9515399', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 07:57:15', NULL, 1, NULL, '107.6334872', '-6.9515439', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 08:14:59', NULL, 1, NULL, '107.6334862', '-6.9515421', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 09:13:01', NULL, 1, NULL, '107.6334847', '-6.9515397', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:37:35', NULL, 1, NULL, '107.6334848', '-6.9515385', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 09:15:02', NULL, 1, NULL, '107.6334834', '-6.9515473', 'Jl. Batu Indah I No.32, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia', '', 1, NULL, 1, 4, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-06-05 00:00:00', '2020-06-05 07:51:54', NULL, 1, NULL, '107.6596065', '-6.9433617', 'Jl. MTC Tim. No.28, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '20200605_075154__foto_absensi_201609005_ABCDE1_JPEG_20200605_075144_.png', 1, NULL, 1, 4, '2020-06-05 08:00:00', '2020-06-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609005', 0, 'ABCDE1', '2020-06-16 00:00:00', '2020-06-16 08:06:16', NULL, 1, NULL, '107.6431013', '-6.9463007', 'Jl. Soekarno-Hatta No.528, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 4, '2020-06-16 08:00:00', '2020-06-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-03-31 00:00:00', '2020-03-31 14:59:49', '2020-03-31 21:02:58', 1, NULL, '107.5700398', '-6.9702273', 'Komp Permata Kopo Blok EA No. 237, Margahayu Selatan, Margahayu, Bandung, West Java 40226, Indonesia', '20200331_145949__foto_absensi_1_ABCDE1_JPEG_20200331_145945_.png', 1, '20200331_210258__foto_absensi_1_ABCDE1_JPEG_20200331_205703_.png', 1, 1, '2020-03-31 08:00:00', '2020-03-31 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 07:23:12', '2020-04-01 19:43:16', 1, NULL, '107.5671982', '-6.971993', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200401_072312__foto_absensi_1_ABCDE1_JPEG_20200401_072311_.png', 1, '20200401_194316__foto_absensi_1_ABCDE1_JPEG_20200401_194316_.png', 1, 1, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-02 00:00:00', '2020-04-02 07:54:04', '2020-04-02 20:02:39', 1, NULL, '107.5700328', '-6.970222', 'Komp Permata Kopo Blok EA No. 237, Margahayu Selatan, Margahayu, Bandung, West Java 40226, Indonesia', '20200402_075404__foto_absensi_1_ABCDE1_JPEG_20200402_075405_.png', 1, '', 1, 1, '2020-04-02 08:00:00', '2020-04-02 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-03 00:00:00', '2020-04-03 08:00:20', '2020-04-03 20:49:01', 1, NULL, '107.5697424', '-6.9715265', 'Unnamed Road, Margahayu Selatan, Margahayu, Bandung, West Java 40226, Indonesia', '20200403_080021__foto_absensi_1_ABCDE1_JPEG_20200403_080020_.png', 1, '', 1, 1, '2020-04-03 08:00:00', '2020-04-03 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-06 00:00:00', NULL, '2020-04-06 23:38:39', 2, NULL, '107.5671982', '-6.971993', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', NULL, 1, '20200406_233839__foto_absensi_201609006_ABCDE1_JPEG_20200406_233837_.png', 1, 1, '2020-04-06 08:00:00', '2020-04-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 07:36:31', '2020-04-07 21:01:08', 1, NULL, '107.5700197', '-6.97026', 'Komp Permata Kopo Blok EA No. 237, Margahayu Selatan, Margahayu, Bandung, West Java 40226, Indonesia', '20200407_073631__foto_absensi_201609006_ABCDE1_JPEG_20200407_073627_.png', 1, '', 1, 1, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 07:14:49', '2020-04-08 20:33:01', 1, NULL, '107.5670839', '-6.9721121', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200408_071449__foto_absensi_201609006_ABCDE1_JPEG_20200408_071442_.png', 1, '', 1, 1, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 07:43:21', NULL, 1, NULL, '107.5670863', '-6.9721231', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200409_074321__foto_absensi_201609006_ABCDE1_JPEG_20200409_074319_.png', 1, NULL, 1, 1, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-10 00:00:00', '2020-04-10 04:02:20', NULL, 1, NULL, '107.5670839', '-6.9721113', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200410_040220__foto_absensi_201609006_ABCDE1_JPEG_20200410_040219_.png', 1, NULL, 1, 1, '2020-04-10 08:00:00', '2020-04-10 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 07:25:14', '2020-04-14 19:27:10', 1, NULL, '107.5670507', '-6.9721686', 'Jl. Margahayu Kencana Raya No.7, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200414_072514__foto_absensi_201609006_ABCDE1_JPEG_20200414_072510_.png', 1, '20200414_192710__foto_absensi_201609006_ABCDE1_JPEG_20200414_192709_.png', 1, 1, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 07:38:50', '2020-04-15 21:34:57', 1, NULL, '107.5700283', '-6.970207', 'Komp Permata Kopo Blok EA No. 237, Margahayu Selatan, Margahayu, Bandung, West Java 40226, Indonesia', '20200415_073850__foto_absensi_201609006_ABCDE1_JPEG_20200415_073849_.png', 1, '20200415_213457__foto_absensi_201609006_ABCDE1_JPEG_20200415_213457_.png', 1, 1, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 07:41:45', NULL, 1, NULL, '107.5700283', '-6.970207', 'Komp Permata Kopo Blok EA No. 237, Margahayu Selatan, Margahayu, Bandung, West Java 40226, Indonesia', '20200416_074145__foto_absensi_201609006_ABCDE1_JPEG_20200416_074141_.png', 1, NULL, 1, 1, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 07:19:02', NULL, 1, NULL, '107.5670763', '-6.9721421', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200417_071902__foto_absensi_201609006_ABCDE1_JPEG_20200417_071901_.png', 1, NULL, 1, 1, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 07:43:12', '2020-04-21 23:33:29', 1, NULL, '107.567079', '-6.9721497', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200421_074312__foto_absensi_201609006_ABCDE1_JPEG_20200421_074314_.png', 1, '20200421_233329__foto_absensi_201609006_ABCDE1_JPEG_20200421_233334_.png', 1, 1, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 07:40:13', NULL, 1, NULL, '107.5670772', '-6.9721429', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200422_074013__foto_absensi_201609006_ABCDE1_JPEG_20200422_074016_.png', 1, NULL, 1, 1, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 07:24:23', NULL, 1, NULL, '107.567057', '-6.9721353', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200423_072423__foto_absensi_201609006_ABCDE1_JPEG_20200423_072427_.png', 1, NULL, 1, 1, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 07:26:00', NULL, 1, NULL, '107.5670666', '-6.9721332', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200424_072600__foto_absensi_201609006_ABCDE1_JPEG_20200424_072558_.png', 1, NULL, 1, 1, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 07:48:47', NULL, 1, NULL, '107.5671105', '-6.9720814', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200428_074847__foto_absensi_201609006_ABCDE1_JPEG_20200428_074846_.png', 1, NULL, 1, 1, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 07:38:47', NULL, 1, NULL, '107.5670629', '-6.9721365', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200429_073847__foto_absensi_201609006_ABCDE1_JPEG_20200429_073846_.png', 1, NULL, 1, 1, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 07:38:20', NULL, 1, NULL, '107.5670699', '-6.9721225', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200430_073820__foto_absensi_201609006_ABCDE1_JPEG_20200430_073821_.png', 1, NULL, 1, 1, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 07:20:40', NULL, 1, NULL, '107.5670675', '-6.9721293', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200505_072040__foto_absensi_201609006_ABCDE1_JPEG_20200505_072036_.png', 1, NULL, 1, 1, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 07:31:51', NULL, 1, NULL, '107.56708', '-6.9720341', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200506_073151__foto_absensi_201609006_ABCDE1_JPEG_20200506_073148_.png', 1, NULL, 1, 1, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 07:48:29', NULL, 1, NULL, '107.5670772', '-6.972034', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200508_074829__foto_absensi_201609006_ABCDE1_JPEG_20200508_074827_.png', 1, NULL, 1, 1, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 07:50:14', NULL, 1, NULL, '107.567114', '-6.9720607', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200512_075014__foto_absensi_201609006_ABCDE1_JPEG_20200512_075011_.png', 1, NULL, 1, 1, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 07:43:26', NULL, 1, NULL, '107.5670785', '-6.9720397', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200513_074326__foto_absensi_201609006_ABCDE1_JPEG_20200513_074323_.png', 1, NULL, 1, 1, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 06:51:47', NULL, 1, NULL, '107.5671012', '-6.9720492', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200514_065147__foto_absensi_201609006_ABCDE1_JPEG_20200514_065144_.png', 1, NULL, 1, 1, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 08:07:51', NULL, 1, NULL, '107.5671435', '-6.9720474', 'Moh. K. 3 Blok F No.8, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200515_080751__foto_absensi_201609006_ABCDE1_JPEG_20200515_080745_.png', 1, NULL, 1, 1, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 04:59:53', NULL, 1, NULL, '107.5670959', '-6.9720464', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200519_045953__foto_absensi_201609006_ABCDE1_JPEG_20200519_045950_.png', 1, NULL, 1, 1, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 04:45:15', NULL, 1, NULL, '107.5671025', '-6.9720403', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200520_044515__foto_absensi_201609006_ABCDE1_JPEG_20200520_044513_.png', 1, NULL, 1, 1, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-05-22 00:00:00', '2020-05-22 06:51:34', '2020-05-22 23:34:08', 1, NULL, '107.5671023', '-6.972039', 'JL. Cilokot, RT. 05 RW. 03, Margahayu, Margahayu Sel., Kec. Margahayu, Bandung, Jawa Barat 40226, Indonesia', '20200522_065134__foto_absensi_201609006_ABCDE1_JPEG_20200522_065133_.png', 1, '20200522_233408__foto_absensi_201609006_ABCDE1_JPEG_20200522_233409_.png', 1, 1, '2020-05-22 08:00:00', '2020-05-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 0, 'ABCDE1', '2020-06-10 00:00:00', '2020-06-10 11:03:48', NULL, 1, NULL, '107.6593967', '-6.943494', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '20200610_110348__foto_absensi_201609006_ABCDE1_JPEG_20200610_110345_.png', 1, NULL, 1, 1, '2020-06-10 08:00:00', '2020-06-10 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 1, 'ABCDE1', '2021-07-02 00:00:00', '2021-07-02 07:00:00', '2021-07-02 17:50:00', 1, NULL, '111.31629', '-7.66519', 'PT. Mitra Sinerji Teknoindo Jalan Soekarno Hatta', '20200612_055637__foto_absensi_201609006_ABCDE1_JPEG_20200612_055632_.png', 1, '', 1, 1, '2021-07-02 08:00:00', '2021-07-02 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609006', 1, 'ABCDE1', '2021-07-13 00:00:00', '2021-07-13 09:12:14', '2021-07-13 09:39:04', 1, NULL, '107.6594501', '-6.9434875', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '20200623_091214__foto_absensi_201609006_ABCDE1_testing.png', 1, '20200623_093904__foto_absensi_201609006_ABCDE1_JPEG_20200623_093906_.png', 9, 1, '2021-07-13 08:00:00', '2021-07-13 17:00:00', 1);
INSERT INTO `z_absensi` VALUES ('201609006', 1, 'ABCDE1', '2021-07-15 00:00:00', '2021-07-15 14:15:24', NULL, 1, NULL, '111.31629', '-7.66519', 'PT. Mitra Sinerji Teknoindo Jalan Soekarno Hatta', '', 1, NULL, 1, 1, '2021-07-15 08:00:00', '2021-07-15 17:00:00', 1);
INSERT INTO `z_absensi` VALUES ('201609006', 1, 'ABCDE1', '2021-07-16 00:00:00', '2021-07-16 09:28:59', NULL, 1, NULL, '111.31629', '-7.66519', 'PT. Mitra Sinerji Teknoindo Jalan Soekarno Hatta', '', 1, NULL, 9, 1, '2021-07-16 08:00:00', '2021-07-16 08:00:00', 1);
INSERT INTO `z_absensi` VALUES ('201609006', 1, 'ABCDE1', '2021-07-21 00:00:00', '2021-07-21 17:08:36', NULL, 1, NULL, '111.31629', '-7.66519', 'PT. Mitra Sinerji Teknoindo Jalan Soekarno Hatta', '20210721_120836__foto_absensi_201609006_ABCDE1.png', 1, NULL, 9, 1, '2021-07-21 08:00:00', '2021-07-21 08:00:00', 1);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 08:14:50', NULL, 1, NULL, '107.595728', '-6.9375465', 'Jl. Peta No.119, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '20200401_081450__foto_absensi_7_ABCDE1_JPEG_20200401_081432_.png', 1, NULL, 1, 7, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 08:52:52', NULL, 1, NULL, '107.5958233', '-6.9385644', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '20200407_085252__foto_absensi_201609007_ABCDE1_JPEG_20200407_085225_.png', 1, NULL, 1, 7, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 08:37:39', NULL, 1, NULL, '107.5956776', '-6.938564', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '20200409_083739__foto_absensi_201609007_ABCDE1_JPEG_20200409_083718_.png', 1, NULL, 1, 7, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-10 00:00:00', '2020-04-10 05:33:55', NULL, 1, NULL, '107.5954534', '-6.9372908', 'Jl. Peta No.121, Situ Saeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-04-10 08:00:00', '2020-04-10 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 07:23:00', NULL, 1, NULL, '107.5958233', '-6.9385644', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '20200415_072300__foto_absensi_201609007_ABCDE1_JPEG_20200415_072228_.png', 1, NULL, 1, 7, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 07:30:15', NULL, 1, NULL, '107.5956643', '-6.9385714', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '20200416_073015__foto_absensi_201609007_ABCDE1_JPEG_20200416_072912_.png', 1, NULL, 1, 7, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 07:30:25', NULL, 1, NULL, '107.5969329', '-6.9369127', 'Jl. Bojongloa No.40, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '20200421_073025__foto_absensi_201609007_ABCDE1_JPEG_20200421_072935_.png', 1, NULL, 1, 7, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 09:25:49', NULL, 1, NULL, '107.5959944', '-6.9378312', 'Jl. Peta No.105, RT.01, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 08:25:59', NULL, 1, NULL, '107.595674', '-6.9385202', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 08:10:10', NULL, 1, NULL, '107.5954534', '-6.9372908', 'Jl. Peta No.121, Situ Saeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 07:48:51', NULL, 1, NULL, '107.5954534', '-6.9372908', 'Jl. Peta No.121, Situ Saeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 09:00:00', NULL, 1, NULL, '107.593234', '-6.9402725', 'Jl. Raya Kopo No.249, Kopo, Kec. Bojongloa Kaler, Kota Bandung, Jawa Barat 40233, Indonesia', '', 1, NULL, 1, 7, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:46:09', NULL, 1, NULL, '107.5953964', '-6.9390492', 'Gg. Parasdi No.5, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 09:01:53', NULL, 1, NULL, '107.5958751', '-6.9378601', '01, Jl. Peta No.113, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40224, Indonesia', '', 1, NULL, 1, 7, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-01 00:00:00', '2020-05-01 09:33:08', NULL, 1, NULL, '107.5947136', '-6.9376409', 'Jl. Raya Kopo No.191, Suka Asih, Kec. Bojongloa Kaler, Kota Bandung, Jawa Barat 40231, Indonesia', '', 1, NULL, 1, 7, '2020-05-01 08:00:00', '2020-05-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 07:12:50', NULL, 1, NULL, '107.5956749', '-6.9385481', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 08:07:44', NULL, 1, NULL, '107.595717', '-6.9384727', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-07 00:00:00', '2020-05-07 08:15:28', NULL, 1, NULL, '107.5956492', '-6.9374483', 'Jl. Peta No.119, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-07 08:00:00', '2020-05-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 10:41:43', NULL, 1, NULL, '107.5956525', '-6.9374528', 'Jl. Peta No.119, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 08:28:41', NULL, 1, NULL, '107.5956791', '-6.9385602', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 07:25:57', NULL, 1, NULL, '107.595718', '-6.9384734', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 09:40:10', NULL, 1, NULL, '107.5957184', '-6.9384735', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 08:04:01', NULL, 1, NULL, '107.5956622', '-6.9385649', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:42:25', NULL, 1, NULL, '107.5958233', '-6.9385644', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609007', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 09:35:29', NULL, 1, NULL, '107.5956596', '-6.9385698', 'Gg. Parasdi No.2, Situsaeur, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40234, Indonesia', '', 1, NULL, 1, 7, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-03-31 00:00:00', '2020-03-31 23:07:17', NULL, 1, NULL, '107.591313', '-6.8977233', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '20200331_230717__foto_absensi_8_ABCDE1_JPEG_20200331_230717_.png', 1, NULL, 1, 8, '2020-03-31 08:00:00', '2020-03-31 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 07:48:10', NULL, 1, NULL, '107.5912948', '-6.8978034', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '20200401_074810__foto_absensi_8_ABCDE1_JPEG_20200401_074812_.png', 1, NULL, 1, 8, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 07:28:30', NULL, 1, NULL, '107.5914203', '-6.8977156', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '20200407_072830__foto_absensi_201609008_ABCDE1_JPEG_20200407_072815_.png', 1, NULL, 1, 8, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 08:11:28', NULL, 1, NULL, '107.5913602', '-6.8977055', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '20200408_081128__foto_absensi_201609008_ABCDE1_JPEG_20200408_081125_.png', 1, NULL, 1, 8, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 10:13:35', NULL, 1, NULL, '107.5928641', '-6.8974849', 'Jl. Dr. Djunjunan No.72, Sukabungah, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 8, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 08:11:32', NULL, 1, NULL, '107.5912967', '-6.8976933', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 08:21:03', NULL, 1, NULL, '107.5926411', '-6.8979149', 'Jl. Dr. Djunjunan No.39, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 08:08:22', NULL, 1, NULL, '107.5912764', '-6.8977284', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 08:26:30', NULL, 1, NULL, '107.5976727', '-6.8998767', 'Jl. Pasir Kaliki No.198, Sukabungah, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 8, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 08:13:30', NULL, 1, NULL, '107.5912784', '-6.8976761', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:13:24', NULL, 1, NULL, '107.591286', '-6.8977183', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 08:27:11', NULL, 1, NULL, '107.5924943', '-6.8968554', 'Jl. Dr. Djunjunan No.78a, Sukabungah, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 8, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-04 00:00:00', '2020-05-04 08:38:00', NULL, 1, NULL, '107.5924943', '-6.8974989', 'Jl. Dr. Djunjunan No.45, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 08:12:20', NULL, 1, NULL, '107.591272', '-6.8976794', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 08:19:57', NULL, 1, NULL, '107.5913773', '-6.8977166', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 08:18:04', NULL, 1, NULL, '107.5925591', '-6.8976487', 'Jl. Dr. Djunjunan No.41, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-11 00:00:00', '2020-05-11 07:58:45', NULL, 1, NULL, '107.5912839', '-6.8977779', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-11 08:00:00', '2020-05-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 08:07:27', NULL, 1, NULL, '107.5914035', '-6.8977084', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 08:18:39', NULL, 1, NULL, '107.5924943', '-6.8974989', 'Jl. Dr. Djunjunan No.45, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 08:13:38', NULL, 1, NULL, '107.5913629', '-6.8977487', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 08:04:16', NULL, 1, NULL, '107.5947136', '-6.897415', 'Jl. Cibarengkok No.149, Sukabungah, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 8, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-18 00:00:00', '2020-05-18 08:25:41', NULL, 1, NULL, '107.5912909', '-6.8977154', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-18 08:00:00', '2020-05-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:13:32', NULL, 1, NULL, '107.5913401', '-6.8978064', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201609008', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 08:12:28', NULL, 1, NULL, '107.5913731', '-6.8977385', 'Jl. Baladewa Utara No.148, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia', '', 1, NULL, 1, 8, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 08:13:57', NULL, 1, NULL, '107.6439136', '-6.984704', 'Jl. Cikoneng No.88, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-02 00:00:00', '2020-04-02 08:34:22', NULL, 1, NULL, '107.6487231', '-6.9861297', 'Jl. de Green Garden Residence, Lengkong, Kec. Bojongsoang, Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 10, '2020-04-02 08:00:00', '2020-04-02 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 07:59:31', NULL, 1, NULL, '107.6595204', '-6.9434633', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 09:02:41', NULL, 1, NULL, '107.6468733', '-6.9862007', 'Jl. Cikoneng No.19, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-13 00:00:00', '2020-04-13 14:26:09', NULL, 1, NULL, '107.6594664', '-6.9434969', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-04-13 08:00:00', '2020-04-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 08:03:46', NULL, 1, NULL, '107.6387342', '-6.9836145', 'Jl. Cikoneng perum akita ruko No.18k, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:08:40', NULL, 1, NULL, '107.6450235', '-6.9862718', 'Perumahan Akita 1 No.8i, Jl. Cikoneng, Bojongsoang, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 08:13:24', NULL, 1, NULL, '107.6439136', '-6.984704', 'Jl. Cikoneng No.88, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 08:35:24', NULL, 1, NULL, '107.6387342', '-6.9829703', 'Jl. Cikoneng perum akita ruko No.18k, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-20 00:00:00', '2020-04-20 08:50:48', NULL, 1, NULL, '107.6594699', '-6.9435413', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-04-20 08:00:00', '2020-04-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 08:36:29', NULL, 1, NULL, '107.6479906', '-6.9869423', 'Jl. Cikoneng, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 08:39:08', NULL, 1, NULL, '107.6383643', '-6.9826624', 'Jl. Cikoneng perum akita ruko No.18k, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 08:24:10', NULL, 1, NULL, '107.6439136', '-6.984704', 'Jl. Cikoneng No.88, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 08:34:58', NULL, 1, NULL, '107.6442836', '-6.9850119', 'Jl. Cikoneng No.88, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 14:24:57', NULL, 1, NULL, '107.65945', '-6.9435361', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 08:13:04', NULL, 1, NULL, '107.6387342', '-6.9832924', 'Jl. Cikoneng perum akita ruko No.18k, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:15:13', NULL, 1, NULL, '107.6387342', '-6.9832924', 'Jl. Cikoneng perum akita ruko No.18k, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 08:22:02', NULL, 1, NULL, '107.6476132', '-6.9868165', 'Y P I Darul Hakim, Jl. Cikoneng No.99, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-04 00:00:00', '2020-05-04 09:02:58', NULL, 1, NULL, '107.659493', '-6.9435547', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 08:27:43', NULL, 1, NULL, '107.6483531', '-6.9874322', 'Jl. Cikoneng No.Y P I Darul Hakim, Jl. Cikoneng No.99, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 08:54:03', NULL, 1, NULL, '107.6450235', '-6.9862718', 'Perumahan Akita 1 No.8i, Jl. Cikoneng, Bojongsoang, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 08:52:56', NULL, 1, NULL, '107.6427404', '-6.984853', 'Jl. Cikoneng No.65, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-11 00:00:00', '2020-05-11 15:39:24', NULL, 1, NULL, '107.6594532', '-6.9434589', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-05-11 08:00:00', '2020-05-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 08:43:43', NULL, 1, NULL, '107.6483531', '-6.9893647', 'Bumi Cikoneng Indah No.19, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 08:51:58', NULL, 1, NULL, '107.6427408', '-6.9848515', 'Jl. Cikoneng No.65, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 08:39:03', NULL, 1, NULL, '107.6483531', '-6.986466', 'Jl. Cikoneng, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 08:59:35', NULL, 1, NULL, '107.6442836', '-6.9850119', 'Jl. Cikoneng No.88, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-18 00:00:00', '2020-05-18 08:45:13', NULL, 1, NULL, '107.6594591', '-6.9434865', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-05-18 08:00:00', '2020-05-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 10:08:32', NULL, 1, NULL, '107.6485459', '-6.9882689', 'Jl. Cikoneng, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 09:56:15', NULL, 1, NULL, '107.6472432', '-6.9865086', 'Y P I Darul Hakim, Jl. Cikoneng No.99, Bojongsoang, Kec. Bojongsoang, Bandung, Jawa Barat 40288, Indonesia', '', 1, NULL, 1, 10, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-05-29 00:00:00', '2020-05-29 08:39:58', NULL, 1, NULL, '107.6594729', '-6.9434884', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-05-29 08:00:00', '2020-05-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-02 00:00:00', '2020-06-02 08:15:16', '2020-06-02 17:37:12', 1, NULL, '107.6594502', '-6.9434782', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-02 08:00:00', '2020-06-02 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-03 00:00:00', '2020-06-03 08:07:29', NULL, 1, NULL, '107.6594468', '-6.9435001', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-06-03 08:00:00', '2020-06-03 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-08 00:00:00', '2020-06-08 07:52:23', '2020-06-08 17:37:55', 1, NULL, '107.6594856', '-6.9435603', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-08 08:00:00', '2020-06-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-09 00:00:00', '2020-06-09 08:07:02', '2020-06-09 17:33:18', 1, NULL, '107.6594654', '-6.9434827', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-09 08:00:00', '2020-06-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-10 00:00:00', '2020-06-10 08:08:59', '2020-06-10 17:21:42', 1, NULL, '107.6594512', '-6.9434578', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-10 08:00:00', '2020-06-10 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-11 00:00:00', '2020-06-11 07:58:38', '2020-06-11 17:01:21', 1, NULL, '107.6594688', '-6.9435343', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-11 08:00:00', '2020-06-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-12 00:00:00', '2020-06-12 07:56:47', '2020-06-12 17:22:23', 1, NULL, '107.6598223', '-6.9467465', 'Jl. Jupiter Barat No.39, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-12 08:00:00', '2020-06-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-17 00:00:00', '2020-06-17 08:07:26', '2020-06-17 17:39:17', 1, NULL, '107.6594681', '-6.9434539', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 10, '2020-06-17 08:00:00', '2020-06-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706001', 0, 'ABCDE1', '2020-06-18 00:00:00', '2020-06-18 08:01:55', NULL, 1, NULL, '107.6594873', '-6.943544', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 10, '2020-06-18 08:00:00', '2020-06-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-13 00:00:00', '2020-04-13 15:00:46', NULL, 1, NULL, '107.6594471', '-6.9435022', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '20200413_150046__foto_absensi_201706003_ABCDE1_JPEG_20200413_150041_.png', 1, NULL, 1, 15, '2020-04-13 08:00:00', '2020-04-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 08:06:01', NULL, 1, NULL, '107.6145473', '-6.9198811', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:42:02', NULL, 1, NULL, '107.6145548', '-6.9198056', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 08:31:26', NULL, 1, NULL, '107.6145473', '-6.9198811', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 08:41:22', NULL, 1, NULL, '107.6145473', '-6.9198811', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 08:54:38', NULL, 1, NULL, '107.6145403', '-6.9198825', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 07:57:46', NULL, 1, NULL, '107.6145417', '-6.9198868', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 09:14:35', NULL, 1, NULL, '107.6146039', '-6.9199263', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 09:08:52', NULL, 1, NULL, '107.614582', '-6.9198195', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 07:52:47', NULL, 1, NULL, '107.6145831', '-6.919822', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:48:09', NULL, 1, NULL, '107.6145838', '-6.9198213', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 08:01:42', NULL, 1, NULL, '107.6145829', '-6.9198192', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 09:10:14', NULL, 1, NULL, '107.6146218', '-6.9195608', 'Jl. Ramli No.7, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 09:20:00', NULL, 1, NULL, '107.6145856', '-6.9198595', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 08:02:33', NULL, 1, NULL, '107.6145823', '-6.91986', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 15:29:08', NULL, 1, NULL, '107.6145863', '-6.9198618', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 09:34:25', NULL, 1, NULL, '107.615269', '-6.9199646', 'Jl. Embong No.17, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 09:24:33', NULL, 1, NULL, '107.614537', '-6.9198899', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 09:49:42', NULL, 1, NULL, '107.6145302', '-6.9198915', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 10:53:39', NULL, 1, NULL, '107.6145789', '-6.9198195', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 12:14:07', NULL, 1, NULL, '107.6145789', '-6.91982', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-05-28 00:00:00', '2020-05-28 22:10:39', NULL, 1, NULL, '107.6145734', '-6.9198026', 'Jl. Ramli No.11a, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-05-28 08:00:00', '2020-05-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-03 00:00:00', '2020-06-03 18:49:37', NULL, 1, NULL, '107.6145458', '-6.9198811', 'Jl. Naripan No.68, Kb. Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112, Indonesia', '', 1, NULL, 1, 15, '2020-06-03 08:00:00', '2020-06-03 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-09 00:00:00', '2020-06-09 08:34:49', '2020-06-09 17:32:25', 1, NULL, '107.6594877', '-6.9435387', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 15, '2020-06-09 08:00:00', '2020-06-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-10 00:00:00', '2020-06-10 08:29:54', '2020-06-10 17:39:00', 1, NULL, '107.6609653', '-6.9441723', 'Jl. Jupiter Utama No.12, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 15, '2020-06-10 08:00:00', '2020-06-10 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-11 00:00:00', '2020-06-11 17:31:19', '2020-06-11 17:31:24', 1, NULL, '107.6594618', '-6.9435085', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 15, '2020-06-11 08:00:00', '2020-06-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-12 00:00:00', '2020-06-12 08:24:02', NULL, 1, NULL, '107.6594877', '-6.9435336', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 15, '2020-06-12 08:00:00', '2020-06-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-15 00:00:00', '2020-06-15 17:33:03', '2020-06-15 17:33:08', 1, NULL, '107.6594464', '-6.9434845', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 15, '2020-06-15 08:00:00', '2020-06-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-16 00:00:00', '2020-06-16 08:33:31', '2020-06-16 17:37:50', 1, NULL, '107.6594841', '-6.9435164', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 15, '2020-06-16 08:00:00', '2020-06-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-17 00:00:00', '2020-06-17 08:36:00', '2020-06-17 17:32:33', 1, NULL, '107.6594867', '-6.9435425', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 15, '2020-06-17 08:00:00', '2020-06-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706003', 0, 'ABCDE1', '2020-06-18 00:00:00', '2020-06-18 08:32:31', NULL, 1, NULL, '107.6607384', '-6.9439336', 'Blok M 2, Jl. Jupiter Bar. Utama I No.5, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 15, '2020-06-18 08:00:00', '2020-06-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 04:58:26', NULL, 1, NULL, '107.6540469', '-6.9579585', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 06:06:28', NULL, 1, NULL, '107.6520528', '-6.9592757', 'Jl. Kencanawangi Utara No.22, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '20200407_060628__foto_absensi_201706004_ABCDE1_JPEG_20200407_060612_.png', 1, NULL, 1, 9, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 08:32:55', NULL, 1, NULL, '107.6540483', '-6.9579585', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '20200408_083255__foto_absensi_201706004_ABCDE1_JPEG_20200408_083245_.png', 1, NULL, 1, 9, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 08:22:48', NULL, 1, NULL, '107.6540483', '-6.9579585', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '20200409_082248__foto_absensi_201706004_ABCDE1_JPEG_20200409_082244_.png', 1, NULL, 1, 9, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 08:23:48', NULL, 1, NULL, '107.6540483', '-6.9579585', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:24:10', NULL, 1, NULL, '107.6540483', '-6.9579585', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 07:40:57', NULL, 1, NULL, '107.659615', '-6.9434764', 'Metro Indah Mall Blok H-29, No. 590, Kecamatan Buah Batu, Jl. Soekarno-Hatta, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 08:41:24', NULL, 1, NULL, '107.6540483', '-6.9579585', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-20 00:00:00', '2020-04-20 08:20:46', NULL, 1, NULL, '107.6594617', '-6.9434981', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-04-20 08:00:00', '2020-04-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 08:35:26', NULL, 1, NULL, '107.6540465', '-6.9579601', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 07:33:31', NULL, 1, NULL, '107.6540482', '-6.9579586', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 08:37:53', NULL, 1, NULL, '107.6540407', '-6.9579597', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 07:34:42', NULL, 1, NULL, '107.6540532', '-6.9579569', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 12:43:55', NULL, 1, NULL, '107.659463', '-6.9434696', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 07:31:31', NULL, 1, NULL, '107.6540532', '-6.9579589', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:14:43', NULL, 1, NULL, '107.654049', '-6.957958', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 08:10:13', NULL, 1, NULL, '107.6540411', '-6.9579597', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-04 00:00:00', '2020-05-04 08:59:47', NULL, 1, NULL, '107.6594654', '-6.9434825', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 07:31:42', NULL, 1, NULL, '107.6540434', '-6.9579632', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 07:09:11', NULL, 1, NULL, '107.654049', '-6.9579574', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 07:44:23', NULL, 1, NULL, '107.6540381', '-6.9579455', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-11 00:00:00', '2020-05-11 08:21:59', NULL, 1, NULL, '107.6594576', '-6.943552', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-05-11 08:00:00', '2020-05-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 06:32:34', NULL, 1, NULL, '107.6540481', '-6.9579528', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 07:56:31', NULL, 1, NULL, '107.6540439', '-6.9579636', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 09:24:32', NULL, 1, NULL, '107.6540409', '-6.9579598', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 07:49:10', NULL, 1, NULL, '107.6540425', '-6.9579633', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-18 00:00:00', '2020-05-18 08:47:06', NULL, 1, NULL, '107.6594733', '-6.9434839', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-05-18 08:00:00', '2020-05-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:12:49', NULL, 1, NULL, '107.6540409', '-6.9579598', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 08:29:38', NULL, 1, NULL, '107.6540465', '-6.9579595', 'Jl. Cijawura Indah No.6, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 9, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-06-15 00:00:00', '2020-06-15 08:26:44', NULL, 1, NULL, '107.6594778', '-6.9434687', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-06-15 08:00:00', '2020-06-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-06-16 00:00:00', '2020-06-16 17:37:52', NULL, 1, NULL, '107.6594773', '-6.9434577', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-06-16 08:00:00', '2020-06-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-06-17 00:00:00', '2020-06-17 17:33:00', '2020-06-17 17:33:20', 1, NULL, '107.6594545', '-6.9435227', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 9, '2020-06-17 08:00:00', '2020-06-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201706004', 0, 'ABCDE1', '2020-06-18 00:00:00', '2020-06-18 08:15:50', NULL, 1, NULL, '107.6594851', '-6.9434827', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 9, '2020-06-18 08:00:00', '2020-06-18 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-01 00:00:00', '2020-04-01 09:27:57', NULL, 1, NULL, '107.6561106', '-6.9567309', 'Jl. Ciwastra No.159, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-01 08:00:00', '2020-04-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 08:17:30', NULL, 1, NULL, '107.6557525', '-6.9568806', 'Jl. Raya Ciwastra No.12, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '20200407_081730__foto_absensi_201805002_ABCDE1_JPEG_20200407_081722_.png', 1, NULL, 1, 12, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 08:05:15', NULL, 1, NULL, '107.6559478', '-6.9570328', 'Jl. Raya Ciwastra No.12, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '20200408_080515__foto_absensi_201805002_ABCDE1_JPEG_20200408_080459_.png', 1, NULL, 1, 12, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 09:20:20', '2020-04-09 17:04:05', 1, NULL, '107.6557525', '-6.9578464', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '20200409_092020__foto_absensi_201805002_ABCDE1_JPEG_20200409_092023_.png', 1, '20200409_170405__foto_absensi_201805002_ABCDE1_JPEG_20200409_170404_.png', 1, 12, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 07:57:18', NULL, 1, NULL, '107.6560284', '-6.9568707', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 07:50:57', NULL, 1, NULL, '107.6558463', '-6.9569111', 'Jl. Raya Ciwastra No.12, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 08:10:34', NULL, 1, NULL, '107.6561225', '-6.9565446', 'Jl. Ciwastra No.147, Margasari, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 08:16:30', NULL, 1, NULL, '107.6557525', '-6.9578464', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 08:07:13', NULL, 1, NULL, '107.6557075', '-6.9578833', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 08:09:36', NULL, 1, NULL, '107.6557525', '-6.9578464', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 07:50:35', '2020-04-28 17:06:11', 1, NULL, '107.6557525', '-6.9568806', 'Jl. Raya Ciwastra No.12, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, '', 1, 12, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 07:44:14', '2020-04-29 17:27:39', 1, NULL, '107.6560109', '-6.9568541', 'Jl. Raya Ciwastra No.12, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, '', 1, 12, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 07:50:39', '2020-05-05 17:10:46', 1, NULL, '107.6557525', '-6.9578464', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, '', 1, 12, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 07:39:41', NULL, 1, NULL, '107.6557153', '-6.9578925', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 07:21:32', NULL, 1, NULL, '107.6557525', '-6.9578464', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 07:42:07', NULL, 1, NULL, '107.6557086', '-6.957888', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 07:46:17', NULL, 1, NULL, '107.6519661', '-6.9554589', 'Jl. Margacinta No.204, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 07:50:32', NULL, 1, NULL, '107.6557086', '-6.957888', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201805002', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 07:26:56', NULL, 1, NULL, '107.6556606', '-6.9578343', 'Jl. Margacinta No.41A, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287, Indonesia', '', 1, NULL, 1, 12, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 07:26:23', '2020-04-07 23:33:59', 1, NULL, '107.6638759', '-6.94658', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 08:17:05', '2020-04-08 17:50:52', 1, NULL, '107.6594301', '-6.9434898', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-09 00:00:00', NULL, '2020-04-09 21:06:10', 2, NULL, '107.6638706', '-6.9465808', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', NULL, 1, '', 1, 13, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-10 00:00:00', '2020-04-10 07:02:37', NULL, 1, NULL, '107.663878', '-6.9465824', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 13, '2020-04-10 08:00:00', '2020-04-10 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:30:39', NULL, 1, NULL, '107.6638795', '-6.9465842', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 13, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 08:24:32', '2020-04-21 17:04:02', 1, NULL, '107.6638774', '-6.9465835', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 07:24:11', '2020-04-22 17:06:16', 1, NULL, '107.6638817', '-6.9465916', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 07:40:39', '2020-04-23 17:05:24', 1, NULL, '107.6638773', '-6.9465838', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 08:44:45', '2020-04-24 18:42:31', 1, NULL, '107.6638746', '-6.9465838', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 08:13:22', NULL, 1, NULL, '107.6638764', '-6.9465816', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 13, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 07:56:48', '2020-04-29 17:05:45', 1, NULL, '107.6638766', '-6.946585', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 07:21:37', '2020-04-30 17:09:32', 1, NULL, '107.6638769', '-6.9465851', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-01 00:00:00', '2020-05-01 08:45:06', NULL, 1, NULL, '107.6638756', '-6.9465887', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 13, '2020-05-01 08:00:00', '2020-05-01 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 08:33:28', '2020-05-05 17:05:25', 1, NULL, '107.6638776', '-6.9465869', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-07 00:00:00', '2020-05-07 08:43:24', NULL, 1, NULL, '107.6638769', '-6.946591', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 13, '2020-05-07 08:00:00', '2020-05-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 16:51:04', '2020-05-08 16:51:08', 1, NULL, '107.6594525', '-6.9434818', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-12 00:00:00', NULL, '2020-05-12 17:05:20', 2, NULL, '107.6638721', '-6.9465848', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', NULL, 1, '', 1, 13, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 07:21:52', '2020-05-14 23:10:42', 1, NULL, '107.6638777', '-6.9465917', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, '', 1, 13, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 07:22:06', NULL, 1, NULL, '107.6638762', '-6.9465922', 'Jl. Mars Bar. III No.8, RT.02/RW.09, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 13, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-27 00:00:00', '2020-05-27 07:37:29', '2020-05-27 17:05:30', 1, NULL, '108.3829128', '-7.3337833', 'Jl. H. Basyari, Dewasari, Kec. Cijeungjing, Kabupaten Ciamis, Jawa Barat 46271, Indonesia', '', 1, '', 1, 13, '2020-05-27 08:00:00', '2020-05-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-28 00:00:00', '2020-05-28 07:24:57', '2020-05-28 18:14:14', 1, NULL, '108.3829128', '-7.3337833', 'Jl. H. Basyari, Dewasari, Kec. Cijeungjing, Kabupaten Ciamis, Jawa Barat 46271, Indonesia', '', 1, '', 1, 13, '2020-05-28 08:00:00', '2020-05-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201807001', 0, 'ABCDE1', '2020-05-29 00:00:00', '2020-05-29 08:00:21', '2020-05-29 17:05:41', 1, NULL, '108.3829128', '-7.3337833', 'Jl. H. Basyari, Dewasari, Kec. Cijeungjing, Kabupaten Ciamis, Jawa Barat 46271, Indonesia', '', 1, '', 1, 13, '2020-05-29 08:00:00', '2020-05-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 09:15:50', NULL, 1, NULL, '107.5344368', '-6.8711265', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '20200408_091550__foto_absensi_201810001_ABCDE1_JPEG_20200408_091535_.png', 1, NULL, 1, 11, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 08:15:58', NULL, 1, NULL, '107.5344563', '-6.8711447', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '20200409_081558__foto_absensi_201810001_ABCDE1_JPEG_20200409_081548_.png', 1, NULL, 1, 11, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 08:21:56', '2020-04-14 17:46:39', 1, NULL, '107.5344277', '-6.8711174', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, '', 1, 11, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 08:23:12', NULL, 1, NULL, '107.5344544', '-6.8711457', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 10:12:26', '2020-04-21 10:38:32', 1, NULL, '107.5344536', '-6.8711426', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, '', 1, 11, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 08:53:18', NULL, 1, NULL, '107.5344521', '-6.871143', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 08:36:35', NULL, 1, NULL, '107.5344411', '-6.8711339', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 09:14:06', NULL, 1, NULL, '107.5344505', '-6.8711413', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-27 00:00:00', '2020-04-27 08:05:56', NULL, 1, NULL, '107.5344392', '-6.8711448', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-27 08:00:00', '2020-04-27 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-28 00:00:00', '2020-04-28 08:51:26', NULL, 1, NULL, '107.5344528', '-6.8711423', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-28 08:00:00', '2020-04-28 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-29 00:00:00', '2020-04-29 08:56:17', NULL, 1, NULL, '107.5344541', '-6.8711426', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-04-29 08:00:00', '2020-04-29 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-04-30 00:00:00', NULL, '2020-04-30 22:49:29', 2, NULL, '107.5344386', '-6.8711268', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', NULL, 1, '', 1, 11, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-04 00:00:00', NULL, '2020-05-04 18:27:54', 2, NULL, '107.5344553', '-6.8711455', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', NULL, 1, '', 1, 11, '2020-05-04 08:00:00', '2020-05-04 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 08:47:02', '2020-05-05 17:17:06', 1, NULL, '107.534462', '-6.871136', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, '', 1, 11, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-06 00:00:00', '2020-05-06 08:25:26', NULL, 1, NULL, '107.5344523', '-6.871138', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-06 08:00:00', '2020-05-06 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-08 00:00:00', '2020-05-08 09:05:59', NULL, 1, NULL, '107.5344559', '-6.871133', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-08 08:00:00', '2020-05-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-11 00:00:00', '2020-05-11 09:29:39', NULL, 1, NULL, '107.534461', '-6.8711409', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-11 08:00:00', '2020-05-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 08:46:13', NULL, 1, NULL, '107.53446', '-6.871138', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 10:12:04', NULL, 1, NULL, '107.5344549', '-6.8711402', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-14 00:00:00', '2020-05-14 09:42:37', NULL, 1, NULL, '107.5344605', '-6.8711371', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-14 08:00:00', '2020-05-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-15 00:00:00', '2020-05-15 09:27:10', NULL, 1, NULL, '107.5344571', '-6.8711415', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-15 08:00:00', '2020-05-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-19 00:00:00', '2020-05-19 08:33:44', NULL, 1, NULL, '107.5344545', '-6.871132', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-19 08:00:00', '2020-05-19 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201810001', 0, 'ABCDE1', '2020-05-20 00:00:00', '2020-05-20 09:29:26', NULL, 1, NULL, '107.5344555', '-6.8711393', 'Jl. Kyai H. Usman Dhomiri No.24, Padasuka, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40526, Indonesia', '', 1, NULL, 1, 11, '2020-05-20 08:00:00', '2020-05-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-07 00:00:00', '2020-04-07 14:54:52', '2020-04-07 17:14:45', 1, NULL, '107.5918127', '-6.8906978', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '20200407_145452__foto_absensi_201904002_ABCDE1_JPEG_20200407_145450_.png', 1, '20200407_171445__foto_absensi_201904002_ABCDE1_JPEG_20200407_171442_.png', 1, 14, '2020-04-07 08:00:00', '2020-04-07 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-08 00:00:00', '2020-04-08 07:40:13', '2020-04-08 18:01:50', 1, NULL, '107.5918127', '-6.8906978', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '20200408_074013__foto_absensi_201904002_ABCDE1_JPEG_20200408_074006_.png', 1, '20200408_180150__foto_absensi_201904002_ABCDE1_JPEG_20200408_180149_.png', 1, 14, '2020-04-08 08:00:00', '2020-04-08 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-09 00:00:00', '2020-04-09 15:17:21', NULL, 1, NULL, '107.5918127', '-6.8906978', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '20200409_151721__foto_absensi_201904002_ABCDE1_JPEG_20200409_151721_.png', 1, NULL, 1, 14, '2020-04-09 08:00:00', '2020-04-09 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-14 00:00:00', '2020-04-14 15:07:02', NULL, 1, NULL, '107.5918055', '-6.8907151', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '20200414_150702__foto_absensi_201904002_ABCDE1_JPEG_20200414_150649_.png', 1, NULL, 1, 14, '2020-04-14 08:00:00', '2020-04-14 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-15 00:00:00', '2020-04-15 11:44:55', NULL, 1, NULL, '107.591799', '-6.8906902', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-15 08:00:00', '2020-04-15 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-16 00:00:00', '2020-04-16 13:45:17', NULL, 1, NULL, '107.591799', '-6.8906902', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '20200416_134517__foto_absensi_201904002_ABCDE1_JPEG_20200416_134517_.png', 1, NULL, 1, 14, '2020-04-16 08:00:00', '2020-04-16 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-17 00:00:00', '2020-04-17 16:25:42', NULL, 1, NULL, '107.591799', '-6.8906902', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-17 08:00:00', '2020-04-17 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-20 00:00:00', '2020-04-20 13:09:42', NULL, 1, NULL, '107.6594435', '-6.9435092', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', '', 1, NULL, 1, 14, '2020-04-20 08:00:00', '2020-04-20 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-21 00:00:00', '2020-04-21 09:54:50', NULL, 1, NULL, '107.591799', '-6.8906902', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-21 08:00:00', '2020-04-21 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-22 00:00:00', '2020-04-22 10:16:39', NULL, 1, NULL, '107.5917997', '-6.8906913', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-22 08:00:00', '2020-04-22 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-23 00:00:00', '2020-04-23 12:23:31', NULL, 1, NULL, '107.5917717', '-6.8906761', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-23 08:00:00', '2020-04-23 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-24 00:00:00', '2020-04-24 14:48:19', NULL, 1, NULL, '107.5917987', '-6.890691', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-24 08:00:00', '2020-04-24 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-04-30 00:00:00', '2020-04-30 10:59:54', NULL, 1, NULL, '107.5918095', '-6.8907171', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-04-30 08:00:00', '2020-04-30 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-05-05 00:00:00', '2020-05-05 14:08:04', NULL, 1, NULL, '107.5918095', '-6.890718', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-05-05 08:00:00', '2020-05-05 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-05-11 00:00:00', NULL, '2020-05-11 16:12:13', 2, NULL, '107.6594295', '-6.9434907', 'Jl. MTC VI No.16, Sekejati, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia', NULL, 1, '', 1, 14, '2020-05-11 08:00:00', '2020-05-11 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-05-12 00:00:00', '2020-05-12 15:40:48', NULL, 1, NULL, '107.5918226', '-6.8907144', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-05-12 08:00:00', '2020-05-12 17:00:00', NULL);
INSERT INTO `z_absensi` VALUES ('201904002', 0, 'ABCDE1', '2020-05-13 00:00:00', '2020-05-13 09:45:56', NULL, 1, NULL, '107.5918221', '-6.8907146', 'Gg. H.Sanusi No.38, Cipedes, Kec. Sukajadi, Kota Bandung, Jawa Barat 40162, Indonesia', '', 1, NULL, 1, 14, '2020-05-13 08:00:00', '2020-05-13 17:00:00', NULL);

-- ----------------------------
-- Table structure for z_bank
-- ----------------------------
DROP TABLE IF EXISTS `z_bank`;
CREATE TABLE `z_bank`  (
  `ID_BANK` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA_BANK` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_BANK`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_bank
-- ----------------------------
INSERT INTO `z_bank` VALUES ('BCA', 'BCA');
INSERT INTO `z_bank` VALUES ('BNI', 'BNI');
INSERT INTO `z_bank` VALUES ('BRI', 'BRI');
INSERT INTO `z_bank` VALUES ('CIMB', 'CIMB NIAGA');
INSERT INTO `z_bank` VALUES ('DNM', 'DANAMON');
INSERT INTO `z_bank` VALUES ('MNDR', 'MANDIRI');
INSERT INTO `z_bank` VALUES ('OCBC', 'OCBC NISP');
INSERT INTO `z_bank` VALUES ('PRMT', 'PERMATA');

-- ----------------------------
-- Table structure for z_bulan
-- ----------------------------
DROP TABLE IF EXISTS `z_bulan`;
CREATE TABLE `z_bulan`  (
  `bulan_id` int(11) NOT NULL,
  `bulan_nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`bulan_id`) USING BTREE,
  INDEX `id_bulan`(`bulan_id`, `bulan_nama`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_bulan
-- ----------------------------
INSERT INTO `z_bulan` VALUES (1, 'Januari');
INSERT INTO `z_bulan` VALUES (2, 'Februari');
INSERT INTO `z_bulan` VALUES (3, 'Maret');
INSERT INTO `z_bulan` VALUES (4, 'April');
INSERT INTO `z_bulan` VALUES (5, 'Mei');
INSERT INTO `z_bulan` VALUES (6, 'Juni');
INSERT INTO `z_bulan` VALUES (7, 'Juli');
INSERT INTO `z_bulan` VALUES (8, 'Agustus');
INSERT INTO `z_bulan` VALUES (9, 'September');
INSERT INTO `z_bulan` VALUES (10, 'Oktober');
INSERT INTO `z_bulan` VALUES (11, 'Nopember');
INSERT INTO `z_bulan` VALUES (12, 'Desember');

-- ----------------------------
-- Table structure for z_compcode
-- ----------------------------
DROP TABLE IF EXISTS `z_compcode`;
CREATE TABLE `z_compcode`  (
  `COMPID` bigint(20) NOT NULL AUTO_INCREMENT,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_NAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DEFAULT_ROLE` int(11) NOT NULL,
  `API_BRANCH` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `USER_AUTH` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `PASS_AUTH` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `KONCI_SEUNEU` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ACTIVE` tinyint(1) NULL DEFAULT 1,
  `LOGOIMAGEE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `COMP_CODE_SAP` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LONG` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LAT` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ALAMAT` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `URL_LOGO` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `JML_JAM_ISTIRAHAT` decimal(10, 0) NULL DEFAULT 1,
  `BATAS_JAM_MASUK` decimal(10, 0) NULL DEFAULT 4,
  `BATAS_JAM_PULANG` decimal(10, 0) NULL DEFAULT 4,
  `PARENT_COMPID` int(11) NULL DEFAULT NULL,
  `NIK_HO` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`COMPID`) USING BTREE,
  UNIQUE INDEX `idx_z_compcode_id`(`COMPID`) USING BTREE,
  INDEX `idx_z_compcode`(`COMPID`, `COMP_CODE`, `COMP_NAME`, `ACTIVE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_compcode
-- ----------------------------
INSERT INTO `z_compcode` VALUES (1, 'ABCDE1', 'PT. MITRA SINERJI TEKNOINDO', 6, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, '107.65933592', '6.9434041', 'Metro Indah Mall', NULL, 1, 4, 4, NULL, '201706004');
INSERT INTO `z_compcode` VALUES (2, 'ABCDE2', 'PT. INDORENTAL', 0, 'idrabsen.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, '-6.947881', '107.6071944', 'Metro Indah Mall', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (3, '3F8D04', 'SMART ABSENSI', 0, 'smartabsensi.co.id', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, '107.65933592', '6.9434041', 'Metro Indah Mall Ruko Blok G-16 Lt. 2 & 3, Bandung', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (4, 'CE4E27', 'PT. MST 2', 0, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, NULL, NULL, 'Kopo', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (5, '9F6421', 'PT. MST 2', 0, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, NULL, NULL, 'Kopo', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (6, '9D2776', 'PT. MST 3', 0, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, NULL, NULL, 'Kopo', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (7, '32B9FF', 'PT. MST 4', 0, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, NULL, NULL, 'Kopo', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (8, 'C96B42', 'PT. MST 2', 0, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, NULL, NULL, 'Kopo', NULL, 1, 4, 4, NULL, NULL);
INSERT INTO `z_compcode` VALUES (9, 'FD3049', 'PT. MST', 0, 'presensikita.com', 'MieAyam', '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', '$2a$07$0y7lSld1shio7C8sfG8r2.SS5AEZmN3P.h2wXBBWT94/lgalUfAfK', 1, NULL, NULL, NULL, NULL, 'Bandung', NULL, 1, 4, 4, NULL, NULL);

-- ----------------------------
-- Table structure for z_costcenter
-- ----------------------------
DROP TABLE IF EXISTS `z_costcenter`;
CREATE TABLE `z_costcenter`  (
  `costcenter_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `costcenter_desc` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `valid_from` date NULL DEFAULT NULL,
  `valid_to` date NULL DEFAULT NULL,
  `active` bit(1) NULL DEFAULT b'1',
  PRIMARY KEY (`costcenter_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_costcenter
-- ----------------------------
INSERT INTO `z_costcenter` VALUES ('E007020005', '----', '2018-01-01', '2030-12-31', b'1');
INSERT INTO `z_costcenter` VALUES ('H002220000', 'Test', '2020-02-01', '2020-12-31', b'1');

-- ----------------------------
-- Table structure for z_cuti
-- ----------------------------
DROP TABLE IF EXISTS `z_cuti`;
CREATE TABLE `z_cuti`  (
  `COMPID` int(11) NOT NULL,
  `CUTI_ID` int(11) NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JML_CUTI` int(11) NOT NULL DEFAULT 0,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`COMPID`) USING BTREE,
  UNIQUE INDEX `z_cuti_idx`(`COMPID`, `CUTI_ID`) USING BTREE,
  INDEX `COMP_CODE`(`COMP_CODE`) USING BTREE,
  INDEX `CUTI_ID`(`CUTI_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_cuti
-- ----------------------------
INSERT INTO `z_cuti` VALUES (1, 1, 'ABCDE1', 12, 1);
INSERT INTO `z_cuti` VALUES (2, 1, 'ABCDE2', 14, 1);
INSERT INTO `z_cuti` VALUES (3, 1, '3F8D04', 14, 1);

-- ----------------------------
-- Table structure for z_cuti_adj
-- ----------------------------
DROP TABLE IF EXISTS `z_cuti_adj`;
CREATE TABLE `z_cuti_adj`  (
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMPID` int(11) NULL DEFAULT NULL,
  `JML_CUTI` double NOT NULL,
  `START_ADJ` datetime(0) NOT NULL,
  `END_ADJ` datetime(0) NOT NULL,
  `PERIODE` double NOT NULL,
  `REMARK_ADJ` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SEQ` int(11) NULL DEFAULT NULL,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  UNIQUE INDEX `idx_cuti_adj_id`(`NIK`, `COMPID`, `PERIODE`) USING BTREE,
  INDEX `idx_cuti_adj`(`NIK`, `COMP_CODE`, `COMPID`, `ACTIVE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_cuti_adj
-- ----------------------------
INSERT INTO `z_cuti_adj` VALUES ('201609001', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609002', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609005', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609004', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609003', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609007', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609008', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201706004', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201810001', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201805002', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201807001', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201904002', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201706003', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609006', 'ABCDE1', 1, 10, '2020-04-08 00:00:00', '2020-04-29 00:00:00', 2019, 'Keterangan', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201609006', 'ABCDE1', 1, 5, '2020-04-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Jumlah cuti tahun lalu', 2, 1);
INSERT INTO `z_cuti_adj` VALUES ('1001', 'ABCDE2', 2, 5, '2020-06-01 00:00:00', '2020-12-30 00:00:00', 2020, 'Penyesuaian Cuti 2020', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1003', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1004', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1005', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1006', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1007', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1008', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1009', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1010', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1011', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1012', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1013', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1014', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1015', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1016', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1017', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1018', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1019', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1020', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1021', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1022', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1023', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1024', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1025', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1026', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1027', 'ABCDE2', 2, 0, '2020-01-01 01:37:13', '2020-12-31 23:37:13', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('1002', 'ABCDE2', 2, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Jumlah Cuti', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('A001', '3F8D04', 3, 2, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Sisa Cuti Tahunan 2019', 1, 1);
INSERT INTO `z_cuti_adj` VALUES ('201706001', 'ABCDE1', 1, 0, '2020-01-01 00:00:00', '2020-12-31 00:00:00', 2020, 'Penyesuaian Cuti', 1, 1);

-- ----------------------------
-- Table structure for z_cuti_h
-- ----------------------------
DROP TABLE IF EXISTS `z_cuti_h`;
CREATE TABLE `z_cuti_h`  (
  `ID_AJU` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `EMP_ID` int(11) NULL DEFAULT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CUTI_ID` int(11) NOT NULL,
  `JML_CUTI` int(11) NOT NULL,
  `START_CUTI` datetime(0) NOT NULL,
  `END_CUTI` datetime(0) NOT NULL,
  `PERIODE` int(11) NULL DEFAULT NULL,
  `REMARK_CUTI` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STATUS` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`ID_AJU`) USING BTREE,
  UNIQUE INDEX `idx_cuti_h`(`ID_AJU`) USING BTREE,
  INDEX `idx_cuti_h_nik`(`NIK`, `COMP_CODE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for z_cuti_m
-- ----------------------------
DROP TABLE IF EXISTS `z_cuti_m`;
CREATE TABLE `z_cuti_m`  (
  `CUTI_ID` double NOT NULL,
  `CUTI_DESC` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`CUTI_ID`) USING BTREE,
  INDEX `idx_cuti_m`(`CUTI_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_cuti_m
-- ----------------------------
INSERT INTO `z_cuti_m` VALUES (1, 'Cuti Tahunan');
INSERT INTO `z_cuti_m` VALUES (2, 'Anggota Keluarga Dalam 1 Rumah Meninggal Dunia');
INSERT INTO `z_cuti_m` VALUES (3, 'Cuti Haid');
INSERT INTO `z_cuti_m` VALUES (4, 'Cuti Ibadah');
INSERT INTO `z_cuti_m` VALUES (5, 'Cuti Keguguran Kandungan');
INSERT INTO `z_cuti_m` VALUES (6, 'Cuti Melahirkan');
INSERT INTO `z_cuti_m` VALUES (7, 'Cuti Rumah Tinggal Kebanjiran;Kebakaran');
INSERT INTO `z_cuti_m` VALUES (8, 'Cuti Tidak Dibayar');
INSERT INTO `z_cuti_m` VALUES (9, 'Istri Pekerja Melahirkan Atau Keguguran Kandungan');
INSERT INTO `z_cuti_m` VALUES (10, 'Khitanan Anak Pekerja');
INSERT INTO `z_cuti_m` VALUES (11, 'Meninggalnya Saudara Kandung Pekerja');
INSERT INTO `z_cuti_m` VALUES (12, 'Pembaptisan Anak Pekerja');
INSERT INTO `z_cuti_m` VALUES (13, 'Pernikahan Anak Pekerja');
INSERT INTO `z_cuti_m` VALUES (14, 'Pernikahan Pekerja');
INSERT INTO `z_cuti_m` VALUES (15, 'Suami;Istri;Anak;Menantu;Orang Tua;Mertua Pekerja Meninggal Dunia');

-- ----------------------------
-- Table structure for z_factory_cal
-- ----------------------------
DROP TABLE IF EXISTS `z_factory_cal`;
CREATE TABLE `z_factory_cal`  (
  `LIBUR_ID` bigint(11) NOT NULL AUTO_INCREMENT,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGAL` datetime(0) NOT NULL,
  `ID_TP` double NOT NULL,
  `TIME_CODE` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MASUK_KERJA` double NOT NULL,
  `KETERANGAN` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  `COMPID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`LIBUR_ID`) USING BTREE,
  INDEX `idx_factory_cal`(`LIBUR_ID`, `COMP_CODE`, `ID_TP`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_factory_cal
-- ----------------------------
INSERT INTO `z_factory_cal` VALUES (6, 'ABCDE1', '2020-01-01 00:00:00', 0, '', 0, 'Tahun Baru Masehi', 1, 1);
INSERT INTO `z_factory_cal` VALUES (7, 'ABCDE1', '2020-01-25 00:00:00', 0, '', 0, 'Tahun Baru Imlek', 1, 1);
INSERT INTO `z_factory_cal` VALUES (8, 'ABCDE1', '2020-03-22 00:00:00', 0, '', 0, 'Isra Mi\'raj', 1, 1);
INSERT INTO `z_factory_cal` VALUES (9, 'ABCDE1', '2020-03-25 00:00:00', 0, '', 0, 'Hari Suci Nyepi', 1, 1);
INSERT INTO `z_factory_cal` VALUES (10, 'ABCDE1', '2020-04-10 00:00:00', 0, '', 0, 'Jumat Agung', 1, 1);
INSERT INTO `z_factory_cal` VALUES (11, 'ABCDE1', '2020-04-01 00:00:00', 0, '', 0, 'Hari Buruh', 1, 1);
INSERT INTO `z_factory_cal` VALUES (12, 'ABCDE1', '2020-04-07 00:00:00', 0, '', 0, 'Hari Waisak', 1, 1);
INSERT INTO `z_factory_cal` VALUES (13, 'ABCDE1', '2020-05-21 00:00:00', 0, '', 0, 'Kenaikan Isa Almasih', 1, 1);
INSERT INTO `z_factory_cal` VALUES (14, 'ABCDE1', '2020-05-22 00:00:00', 0, '', 0, 'Cuti Bersama Kenaikan Isa Almasih', 1, 1);
INSERT INTO `z_factory_cal` VALUES (15, 'ABCDE1', '2020-05-24 00:00:00', 0, '', 0, 'Hari Raya Idul Fitri', 1, 1);
INSERT INTO `z_factory_cal` VALUES (16, 'ABCDE1', '2020-05-25 00:00:00', 0, '', 0, 'Hari Raya Idul Fitri', 1, 1);
INSERT INTO `z_factory_cal` VALUES (17, 'ABCDE1', '2020-06-01 00:00:00', 0, '', 0, 'Hari Lahir Pancasila', 1, 1);
INSERT INTO `z_factory_cal` VALUES (18, 'ABCDE1', '2020-07-31 00:00:00', 0, '', 0, 'Idul Adha', 1, 1);
INSERT INTO `z_factory_cal` VALUES (19, 'ABCDE1', '2020-08-17 00:00:00', 0, '', 0, 'Hari Kemerdekaan', 1, 1);
INSERT INTO `z_factory_cal` VALUES (20, 'ABCDE1', '2020-08-20 00:00:00', 0, '', 0, 'Tahun Baru Islam', 1, 1);
INSERT INTO `z_factory_cal` VALUES (21, 'ABCDE1', '2020-08-21 00:00:00', 0, '', 0, 'Cuti Bersama Tahun Baru Islam', 1, 1);
INSERT INTO `z_factory_cal` VALUES (22, 'ABCDE1', '2020-10-28 00:00:00', 0, '', 0, 'Cuti Bersama Maulid Nabi Muhammad SAW', 1, 1);
INSERT INTO `z_factory_cal` VALUES (23, 'ABCDE1', '2020-10-29 00:00:00', 0, '', 0, 'Maulid Nabi Muhammad SAW', 1, 1);
INSERT INTO `z_factory_cal` VALUES (24, 'ABCDE1', '2020-10-30 00:00:00', 0, '', 0, 'Cuti Bersama Maulid Nabi Muhammad SAW', 1, 1);
INSERT INTO `z_factory_cal` VALUES (25, 'ABCDE1', '2020-12-24 00:00:00', 0, '', 0, 'Cuti Bersama Hari Natal', 1, 1);
INSERT INTO `z_factory_cal` VALUES (26, 'ABCDE1', '2020-12-25 00:00:00', 0, '', 0, 'Hari Natal', 1, 1);
INSERT INTO `z_factory_cal` VALUES (27, '3F8D04', '2020-01-01 00:00:00', 0, '', 0, 'Tahun Baru Masehi', 1, 3);
INSERT INTO `z_factory_cal` VALUES (28, '3F8D04', '2020-01-25 00:00:00', 0, '', 0, 'Tahun Baru Imlek', 1, 3);
INSERT INTO `z_factory_cal` VALUES (29, '3F8D04', '2020-03-22 00:00:00', 0, '', 0, 'Isra Mi\'raj', 1, 3);
INSERT INTO `z_factory_cal` VALUES (30, '3F8D04', '2020-03-25 00:00:00', 0, '', 0, 'Hari Suci Nyepi', 1, 3);
INSERT INTO `z_factory_cal` VALUES (31, '3F8D04', '2020-04-10 00:00:00', 0, '', 0, 'Jumat Agung', 1, 3);
INSERT INTO `z_factory_cal` VALUES (32, '3F8D04', '2020-04-01 00:00:00', 0, '', 0, 'Hari Buruh', 1, 3);
INSERT INTO `z_factory_cal` VALUES (33, '3F8D04', '2020-04-07 00:00:00', 0, '', 0, 'Hari Waisak', 1, 3);
INSERT INTO `z_factory_cal` VALUES (34, '3F8D04', '2020-05-21 00:00:00', 0, '', 0, 'Kenaikan Isa Almasih', 1, 3);
INSERT INTO `z_factory_cal` VALUES (35, '3F8D04', '2020-05-22 00:00:00', 0, '', 0, 'Cuti Bersama Kenaikan Isa Almasih', 1, 3);
INSERT INTO `z_factory_cal` VALUES (36, '3F8D04', '2020-05-24 00:00:00', 0, '', 0, 'Hari Raya Idul Fitri', 1, 3);
INSERT INTO `z_factory_cal` VALUES (37, '3F8D04', '2020-05-25 00:00:00', 0, '', 0, 'Hari Raya Idul Fitri', 1, 3);
INSERT INTO `z_factory_cal` VALUES (38, '3F8D04', '2020-06-01 00:00:00', 0, '', 0, 'Hari Lahir Pancasila', 1, 3);
INSERT INTO `z_factory_cal` VALUES (39, '3F8D04', '2020-07-31 00:00:00', 0, '', 0, 'Idul Adha', 1, 3);
INSERT INTO `z_factory_cal` VALUES (40, '3F8D04', '2020-08-17 00:00:00', 0, '', 0, 'Hari Kemerdekaan', 1, 3);
INSERT INTO `z_factory_cal` VALUES (41, '3F8D04', '2020-08-20 00:00:00', 0, '', 0, 'Tahun Baru Islam', 1, 3);
INSERT INTO `z_factory_cal` VALUES (42, '3F8D04', '2020-08-21 00:00:00', 0, '', 0, 'Cuti Bersama Tahun Baru Islam', 1, 3);
INSERT INTO `z_factory_cal` VALUES (43, '3F8D04', '2020-10-28 00:00:00', 0, '', 0, 'Cuti Bersama Maulid Nabi Muhammad SAW', 1, 3);
INSERT INTO `z_factory_cal` VALUES (44, '3F8D04', '2020-10-29 00:00:00', 0, '', 0, 'Maulid Nabi Muhammad SAW', 1, 3);
INSERT INTO `z_factory_cal` VALUES (45, '3F8D04', '2020-10-30 00:00:00', 0, '', 0, 'Cuti Bersama Maulid Nabi Muhammad SAW', 1, 3);
INSERT INTO `z_factory_cal` VALUES (46, '3F8D04', '2020-12-24 00:00:00', 0, '', 0, 'Cuti Bersama Hari Natal', 1, 3);
INSERT INTO `z_factory_cal` VALUES (47, '3F8D04', '2020-12-25 00:00:00', 0, '', 0, 'Hari Natal', 1, 3);

-- ----------------------------
-- Table structure for z_group_kar
-- ----------------------------
DROP TABLE IF EXISTS `z_group_kar`;
CREATE TABLE `z_group_kar`  (
  `GROUP_ID_KAR` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `GRP_DESC` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_group_kar
-- ----------------------------
INSERT INTO `z_group_kar` VALUES ('1', 'KARYAWAN TETAP');
INSERT INTO `z_group_kar` VALUES ('2', 'KARYAWAN KONTRAK');

-- ----------------------------
-- Table structure for z_head_aju
-- ----------------------------
DROP TABLE IF EXISTS `z_head_aju`;
CREATE TABLE `z_head_aju`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_CODE` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TGL_AJU` datetime(0) NOT NULL,
  `JNS_AJU` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STS_AJU` int(11) NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HEAD_TEXT1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HEAD_TEXT2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `APP_NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_KET` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ACTIVE` tinyint(1) NULL DEFAULT 1,
  UNIQUE INDEX `idx_z_head_aju_id`(`ID_AJU`) USING BTREE,
  INDEX `idx_z_head_aju`(`ID_AJU`, `COMP_CODE`, `TGL_AJU`, `JNS_AJU`, `STS_AJU`, `NIK`, `ACTIVE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_head_aju
-- ----------------------------
INSERT INTO `z_head_aju` VALUES ('1e1d0149-e541-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 09:48:59', 'IZ', 1, '201609006', 'LP', '-', '201609006', '', 1);
INSERT INTO `z_head_aju` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 10:19:06', 'PD', 1, '201609006', 'Berguru', '-', '201609006', '', 1);
INSERT INTO `z_head_aju` VALUES ('29867cc5-ea01-11eb-99b8-00ffe1', 'ABCDE1', '2021-07-21 10:53:45', 'IZ', 1, '201609006', 'SK', '-', '201609006', '', 1);
INSERT INTO `z_head_aju` VALUES ('53de13b7-e541-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 09:50:28', 'CT', 1, '201609006', '1', '-', '201609006', '', 1);
INSERT INTO `z_head_aju` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 09:30:17', 'IZ', 1, '201609006', 'MS', '-', '201609006', 'ok', 1);
INSERT INTO `z_head_aju` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 09:16:02', 'IZ', 1, '201609006', 'JK', '-', '201609006', 'Approve', 1);
INSERT INTO `z_head_aju` VALUES ('a5dd8b7c-e53f-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 09:38:27', 'IZ', 1, '201609006', 'PC', '-', '201609006', '', 1);
INSERT INTO `z_head_aju` VALUES ('d40a5aa0-e541-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-01 00:00:00', 'FR', 1, '201609006', '3', '0', '201609006', '', 1);
INSERT INTO `z_head_aju` VALUES ('e71eae3e-e541-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-01 00:00:00', 'PB', 0, '201609006', '1', '100000', NULL, NULL, 1);
INSERT INTO `z_head_aju` VALUES ('ef5caa42-e53f-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 09:40:31', 'IZ', 1, '201609006', 'SK', '-', '201609006', '', 1);

-- ----------------------------
-- Table structure for z_head_laporan
-- ----------------------------
DROP TABLE IF EXISTS `z_head_laporan`;
CREATE TABLE `z_head_laporan`  (
  `ID_AJU` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_CODE` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TGL_AJU` datetime(0) NOT NULL,
  `JNS_AJU` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STS_AJU` int(11) NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HEAD_TEXT1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HEAD_TEXT2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `REMARK` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_KET` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ACTIVE` tinyint(1) NULL DEFAULT 1,
  INDEX `idx_z_head_aju`(`ID_AJU`, `COMP_CODE`, `TGL_AJU`, `JNS_AJU`, `STS_AJU`, `NIK`, `ACTIVE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_head_laporan
-- ----------------------------
INSERT INTO `z_head_laporan` VALUES ('9448233a-e54e-11eb-a65f-00ffe1', 'ABCDE1', '2021-07-15 11:25:20', 'LP', 0, '201609006', 'DN', '-', 'Membuat laporan pendahuluan', NULL, NULL, 1);
INSERT INTO `z_head_laporan` VALUES ('fc288008-eb6d-11eb-82e0-00ffe1', 'ABCDE1', '2021-07-23 06:25:16', 'LP', 0, '201609006', 'PR', '-', 'Lembur 001', NULL, NULL, 1);

-- ----------------------------
-- Table structure for z_head_lembur
-- ----------------------------
DROP TABLE IF EXISTS `z_head_lembur`;
CREATE TABLE `z_head_lembur`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_CODE` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TGL_AJU` datetime(0) NOT NULL,
  `JNS_AJU` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STS_AJU` int(11) NOT NULL,
  `STS_AJU_HO` int(11) NULL DEFAULT 0,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HEAD_TEXT1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HEAD_TEXT2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `REMARK` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_KET` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ACTIVE` tinyint(1) NULL DEFAULT 1,
  `WKT_AWAL` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `WKT_AKHIR` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `PJ` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_NIK_HO` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `APP_KET_HO` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  UNIQUE INDEX `idx_z_head_laporan`(`ID_AJU`) USING BTREE,
  INDEX `idx_z_head_aju`(`ID_AJU`, `COMP_CODE`, `TGL_AJU`, `JNS_AJU`, `STS_AJU`, `NIK`, `ACTIVE`, `STS_AJU_HO`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_head_lembur
-- ----------------------------
INSERT INTO `z_head_lembur` VALUES ('3f86446f-eb9a-11eb-82e0-00ffe12eb819', 'ABCDE1', '2021-07-23 11:42:07', 'OT', 0, 0, '201609005', 'PR', '-', 'Lembur Create Dokumentasi', '201609002', NULL, 1, '08:00:00', '09:00:00', 'Azis', '201706004', NULL);
INSERT INTO `z_head_lembur` VALUES ('c1062270-eb6e-11eb-82e0-00ffe12eb819', 'ABCDE1', '2021-07-23 06:30:47', 'OT', 0, 0, '201609006', 'PN', '-', 'Lembur mengerjakan laporan dokumentasi 01', '201609006', NULL, 1, '17:00:00', '20:00:00', 'Nur', '201609006', NULL);
INSERT INTO `z_head_lembur` VALUES ('d9ba2829-e54d-11eb-a65f-00ffe12eb819', 'ABCDE1', '2021-07-15 11:20:07', 'OT', 0, 0, '201609006', 'PR', '-', 'Mengerjakan dokumen teknis', '201609006', NULL, 1, '18:00:00', '20:00:00', 'Nuriyanto', NULL, NULL);

-- ----------------------------
-- Table structure for z_jns_aju
-- ----------------------------
DROP TABLE IF EXISTS `z_jns_aju`;
CREATE TABLE `z_jns_aju`  (
  `JNS_AJU` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DESC_AJU` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `idx_jns_aju`(`JNS_AJU`, `DESC_AJU`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_jns_aju
-- ----------------------------
INSERT INTO `z_jns_aju` VALUES ('AB', 'ABSENSI DI HARI LIBUR');
INSERT INTO `z_jns_aju` VALUES ('CT', 'CUTI');
INSERT INTO `z_jns_aju` VALUES ('FR', 'FRAME KACAMATA');
INSERT INTO `z_jns_aju` VALUES ('IZ', 'IZIN/SAKIT');
INSERT INTO `z_jns_aju` VALUES ('LP', 'LAPORAN HARIAN');
INSERT INTO `z_jns_aju` VALUES ('LS', 'LENSA');
INSERT INTO `z_jns_aju` VALUES ('OT', 'LEMBUR');
INSERT INTO `z_jns_aju` VALUES ('PB', 'PENGGANTIAN BIAYA');
INSERT INTO `z_jns_aju` VALUES ('PD', 'PERJALANAN DINAS');
INSERT INTO `z_jns_aju` VALUES ('PO', 'PENGOBATAN');
INSERT INTO `z_jns_aju` VALUES ('TR', 'TRAINING');

-- ----------------------------
-- Table structure for z_jns_gantib
-- ----------------------------
DROP TABLE IF EXISTS `z_jns_gantib`;
CREATE TABLE `z_jns_gantib`  (
  `JNS_GANTIB` tinyint(4) NOT NULL,
  `DESC_GANTIB` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `idx_jns_gantib`(`JNS_GANTIB`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_jns_gantib
-- ----------------------------
INSERT INTO `z_jns_gantib` VALUES (1, 'TRANSPORT');
INSERT INTO `z_jns_gantib` VALUES (2, 'MEAL(ENTERTAINMENT)');
INSERT INTO `z_jns_gantib` VALUES (3, 'ACCOMODATION');
INSERT INTO `z_jns_gantib` VALUES (4, 'DAILY ALLOWANCE');

-- ----------------------------
-- Table structure for z_jns_izin
-- ----------------------------
DROP TABLE IF EXISTS `z_jns_izin`;
CREATE TABLE `z_jns_izin`  (
  `JNS_IZIN` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DESC_IZIN` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  INDEX `idx_jns_izin`(`JNS_IZIN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_jns_izin
-- ----------------------------
INSERT INTO `z_jns_izin` VALUES ('MS', 'Izin Masuk Siang');
INSERT INTO `z_jns_izin` VALUES ('PC', 'Izin Pulang Cepat');
INSERT INTO `z_jns_izin` VALUES ('JK', 'Izin');
INSERT INTO `z_jns_izin` VALUES ('SK', 'Sakit');
INSERT INTO `z_jns_izin` VALUES ('LP', 'Lupa Absen');

-- ----------------------------
-- Table structure for z_jns_stat
-- ----------------------------
DROP TABLE IF EXISTS `z_jns_stat`;
CREATE TABLE `z_jns_stat`  (
  `JNS_STAT` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DESC_STAT` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`JNS_STAT`) USING BTREE,
  INDEX `idx_jns_izin`(`JNS_STAT`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_jns_stat
-- ----------------------------
INSERT INTO `z_jns_stat` VALUES ('CN', 'CANCEL');
INSERT INTO `z_jns_stat` VALUES ('DN', 'DONE');
INSERT INTO `z_jns_stat` VALUES ('PN', 'PENDING');
INSERT INTO `z_jns_stat` VALUES ('PR', 'PROGRESS');

-- ----------------------------
-- Table structure for z_kantor
-- ----------------------------
DROP TABLE IF EXISTS `z_kantor`;
CREATE TABLE `z_kantor`  (
  `kantor_id` int(11) NOT NULL AUTO_INCREMENT,
  `compid` bigint(20) NULL DEFAULT NULL,
  `emp_id` bigint(20) NULL DEFAULT NULL,
  `nama_kantor` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `long` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lat` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `batas` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`kantor_id`) USING BTREE,
  UNIQUE INDEX `idx_kantor_id`(`kantor_id`) USING BTREE,
  INDEX `idx_kantor`(`kantor_id`, `compid`, `nama_kantor`, `active`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_kantor
-- ----------------------------
INSERT INTO `z_kantor` VALUES (1, 1, NULL, 'Kantor Pusat Metro Indah Mall', 'Metro Indah Mall Ruko Blok G-16 Lt. 2 & 3, Bandung', '107.6572813', '-6.9434534', '0.5', 1);
INSERT INTO `z_kantor` VALUES (2, 2, NULL, 'Idr Gudang, Metro Indah Mall', 'Metro Indah Mall Bandung', '107.6593617', '-6.9426293', '0.4', 1);
INSERT INTO `z_kantor` VALUES (3, 3, NULL, 'Kantor Pusat Bandung', 'Bandung', '107.65933592', '6.9434041', '0.5', 1);

-- ----------------------------
-- Table structure for z_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `z_karyawan`;
CREATE TABLE `z_karyawan`  (
  `EMP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMP_NAME` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NIK` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `COMPID` int(11) NOT NULL,
  `UNITID` int(11) NULL DEFAULT NULL,
  `POSITIONID` int(11) NULL DEFAULT NULL,
  `POSITION_CODE` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `KANTOR_ID` bigint(11) NULL DEFAULT NULL,
  `ENTERPRISE_BEGIN` datetime(0) NULL DEFAULT NULL,
  `ACTIVE` bit(1) NULL DEFAULT b'1',
  `EMAIL_ADDR` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `NAMA` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `COMPANY_BEGIN` datetime(0) NULL DEFAULT NULL,
  `COMPANY_LAST` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `NATIONALITY` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `RELIGION_ID` tinyint(1) NULL DEFAULT NULL,
  `NATIONALITY_ID` tinyint(1) NULL DEFAULT NULL,
  `EDUCATION` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `EDU_NAME` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `TMP_LAHIR` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `TGL_LAHIR` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `P_ALAMAT` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `P_KOTA` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `P_KODEPOS` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `P_PROPINSI` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `P_ID_NEGARA` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `SIM1` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `HP1` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `IMEI1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `SIM2` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `HP2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `IMEI2` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `KTP` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `GAJI` decimal(20, 0) NULL DEFAULT NULL,
  `STATUS_NIKAH` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `JML_ANAK` tinyint(4) NULL DEFAULT NULL,
  `URL_FOTO` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `JNS_KELAMIN` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `GOL_DARAH` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `NPWP` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `PTKP_STATUS` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `TERMINATION` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `DATE_TERMINATION` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `CREATED_BY` int(20) NULL DEFAULT NULL,
  `CREATED_DATE` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `MODIFY_BY` int(20) NULL DEFAULT NULL,
  `MODIFY_DATE` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `JABATAN` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_KTP` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_SIM` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_NPWP` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_BPJSTK` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_BPJSKES` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_AIA` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `URL_ASURANSI` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `NO_BPJSTK` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `NO_BPJSKES` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `NO_AIA` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `NO_ASURANSI` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ROLE_ID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`EMP_ID`) USING BTREE,
  UNIQUE INDEX `idx_z_karyawan_id`(`EMP_ID`) USING BTREE,
  INDEX `idx_z_karyawan`(`EMP_ID`, `EMP_NAME`, `NIK`, `EMAIL`, `COMPID`, `UNITID`, `KANTOR_ID`, `POSITIONID`, `COMP_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_karyawan
-- ----------------------------
INSERT INTO `z_karyawan` VALUES (1, 'Nuriyanto', '201609006', 'sayarhungs@gmail.com', 1, 1, 6, '10000004', 1, NULL, b'1', 'sayarhungs@gmail.com', 'Nuriyanto', 'ABCDE1', '2020-01-01 00:00:00', '2020-06-23 14:52:58', '201609006', 1, NULL, 'S1', 'Teknik Informatika', 'Bandung', '2020-06-23 14:52:58', 'Jalan Rahayu 5 Blok 3 D No. 96', 'Bandung', '40218', 'Jawa Barat', NULL, NULL, '087823339007', '087823339007', NULL, NULL, NULL, '123123123', NULL, '2', 2, '20200409_160423__profile_201609006_ABCDE1_profile123.png', '1', '-', '123123123', NULL, NULL, '2020-06-23 14:52:58', NULL, '2020-06-23 14:52:58', NULL, '2020-06-23 14:52:58', NULL, '20200409_162510__ktp_201609006_ABCDE1_TOPOLOGI.png', '20200409_160317__sim_201609006_ABCDE1_profile123.png', '20200409_160423__npwp_201609006_ABCDE1_profile123.png', '20200409_160423__bpjs_tk_201609006_ABCDE1_profile123.png', '20200409_160423__bpjs_kes_201609006_ABCDE1_profile123.png', '20200409_160423__aia_201609006_ABCDE1_profile123.png', '20200409_160423__asuransi_201609006_ABCDE1_profile123.png', '123123123', '213123123123', '123123123', '12313123', NULL);
INSERT INTO `z_karyawan` VALUES (2, 'Zaenal Ariepin', '201609001', 'zpaceghost@gmail.com', 1, 2, 6, '10000002', 1, NULL, b'1', 'zpaceghost@gmail.com', 'Zaenal Ariepin', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:52:59', '201609001', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:52:59', NULL, NULL, NULL, NULL, NULL, NULL, '08122359254', '08122359254', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:52:59', NULL, '2020-06-23 14:52:59', NULL, '2020-06-23 14:52:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (3, 'Abdul Azis', '201609002', 'abah.khansa@gmail.com', 1, 1, 6, '10000003', 1, NULL, b'1', 'abah.khansa@gmail.com', 'Abdul Azis', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:00', '201609002', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:00', NULL, NULL, NULL, NULL, NULL, NULL, '085222275272', '085222275272', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:00', NULL, '2020-06-23 14:53:00', NULL, '2020-06-23 14:53:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (4, 'Ardia M Ginanjar', '201609005', 'ardia.mgz@gmail.com', 1, 1, 6, '10000004', 1, NULL, b'1', 'ardia.mgz@gmail.com', 'Ardia M Ginanjar', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:00', '201609005', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:00', NULL, NULL, NULL, NULL, NULL, NULL, '081312110303', '081312110303', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:00', NULL, '2020-06-23 14:53:00', NULL, '2020-06-23 14:53:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (5, 'Moch. Adnan', '201609004', 'xdnan.007@gmail.com', 1, 1, 6, '10000004', 1, NULL, b'1', 'xdnan.007@gmail.com', 'Moch. Adnan', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:01', '201609004', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:01', NULL, NULL, NULL, NULL, NULL, NULL, '081289440708', '081289440708', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:01', NULL, '2020-06-23 14:53:01', NULL, '2020-06-23 14:53:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (6, 'Danny Triyatna', '201609003', 'dany.triyatna@gmail.com', 1, 1, 6, '10000004', 1, NULL, b'1', 'dany.triyatna@gmail.com', 'Danny Triyatna', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:02', '201609003', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:02', NULL, NULL, NULL, NULL, NULL, NULL, '081322900089', '081322900089', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:02', NULL, '2020-06-23 14:53:02', NULL, '2020-06-23 14:53:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (7, 'Husni Sabar', '201609007', 'aang.husni@gmail.com', 1, 1, 6, '10000004', 1, NULL, b'1', 'aang.husni@gmail.com', 'Husni Sabar', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:03', '201609007', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:03', NULL, NULL, NULL, NULL, NULL, NULL, '081222262718', '081222262718', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:03', NULL, '2020-06-23 14:53:03', NULL, '2020-06-23 14:53:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (8, 'Irvan Romdani', '201609008', 'irvan.romdani@gmail.com', 1, 1, 6, '10000004', 1, NULL, b'1', 'irvan.romdani@gmail.com', 'Irvan Romdani', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:04', '201609008', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:04', NULL, NULL, NULL, NULL, NULL, NULL, '081320058854', '081320058854', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:04', NULL, '2020-06-23 14:53:04', NULL, '2020-06-23 14:53:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (9, 'Sri Rejeki', '201706004', 'tanyasrirejekinovianti@gmail.com', 1, 3, 3, '10000007', 1, NULL, b'1', 'tanyasrirejekinovianti@gmail.com', 'Sri Rejeki', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:11', '201706004', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:11', NULL, NULL, NULL, NULL, NULL, NULL, '081222565364', '081222565364', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:11', NULL, '2020-06-23 14:53:11', NULL, '2020-06-23 14:53:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (10, 'Dessy Nurfitriyah', '201706001', 'desinurfitriah4@gmail.com', 1, 2, 6, '10000006', 1, NULL, b'1', 'desinurfitriah4@gmail.com', 'Dessy Nur Fitriyah', 'ABCDE1', '2020-03-30 00:00:00', '2020-06-23 00:00:00', '201706001', 1, NULL, '', '', '', '2020-06-23 00:00:00', '', '', '', '', NULL, NULL, '085720544907', '085720544907', NULL, NULL, NULL, '', NULL, '', 0, '', '2', '', '', NULL, NULL, '2021-07-12 13:12:14', NULL, '2021-07-12 13:12:14', NULL, '2021-07-12 13:12:14', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL);
INSERT INTO `z_karyawan` VALUES (11, 'Suci Ismayanti', '201810001', 'suciismayantiputri15@gmail.com', 1, 2, 6, '10000006', 1, NULL, b'1', 'suciismayantiputri15@gmail.com', 'Suci Ismayanti', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:22', '201810001', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:22', NULL, NULL, NULL, NULL, NULL, NULL, '082321710788', '082321710788', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:22', NULL, '2020-06-23 14:53:22', NULL, '2020-06-23 14:53:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (12, 'Agung Sulaksana', '201805002', 'sulaksana34@gmail.com', 1, 3, 3, '10000005', 1, NULL, b'1', 'sulaksana34@gmail.com', 'Agung Sulaksana', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:24', '201805002', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:24', NULL, NULL, NULL, NULL, NULL, NULL, '08996867174', '08996867174', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:24', NULL, '2020-06-23 14:53:24', NULL, '2020-06-23 14:53:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (13, 'Hasan Amal', '201807001', 'greatsans98@gmail.com', 1, 3, 6, '10000005', 1, NULL, b'1', 'greatsans98@gmail.com', 'Hasan Amal', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:27', '201807001', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:27', NULL, NULL, NULL, NULL, NULL, NULL, '08985766866', '08985766866', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:27', NULL, '2020-06-23 14:53:27', NULL, '2020-06-23 14:53:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (14, 'Indrazit', '201904002', 'indrazitmegandana53@gmail.com', 1, 3, 6, '10000005', 1, NULL, b'1', 'indrazitmegandana53@gmail.com', 'Indrazit', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:24', '201904002', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:24', NULL, NULL, NULL, NULL, NULL, NULL, '085795192521', '085795192521', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:24', NULL, '2020-06-23 14:53:24', NULL, '2020-06-23 14:53:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (15, 'Rizka Azka', '201706003', 'rizka.azka29@gmail.com', 1, 3, 6, '10000006', 1, NULL, b'1', 'rizka.azka29@gmail.com', 'Rizka Azka', 'ABCDE1', '2020-03-30 13:10:15', '2020-06-23 14:53:25', '201706003', 1, NULL, NULL, NULL, NULL, '2020-06-23 14:53:25', NULL, NULL, NULL, NULL, NULL, NULL, '082118360212', '082118360212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2020-06-23 14:53:25', NULL, '2020-06-23 14:53:25', NULL, '2020-06-23 14:53:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (18, 'Budi', '1001', '1001_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', NULL, NULL, 'ABCDE2', '2020-06-01 00:00:00', '2020-06-24 14:29:51', NULL, 1, NULL, '', '', '', '2020-06-24 14:29:51', '', '', '', '', NULL, NULL, '087823331000', NULL, NULL, NULL, NULL, '', NULL, '2', 0, '', '1', '', '', NULL, NULL, '2020-06-24 14:29:51', NULL, '2020-06-24 14:29:51', NULL, '2020-06-24 14:29:51', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL);
INSERT INTO `z_karyawan` VALUES (19, 'Gerry Yohanes H', '1002', '1002_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1002_idrabsen@gmail.com', 'Gerry Yohanes H', 'ABCDE2', '1970-01-01 07:00:00', '1970-01-01 07:00:00', NULL, 1, NULL, '', '', '', '1970-01-01 07:00:00', '', 'Bandung', '', 'Jawa Barat', NULL, NULL, '081224420381', '081224420381', NULL, NULL, NULL, '', NULL, '', 0, '', '', '', '', NULL, NULL, '2020-06-24 20:35:59', NULL, '2020-06-24 20:35:59', NULL, '2020-06-24 20:35:59', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL);
INSERT INTO `z_karyawan` VALUES (20, 'Sheila Azizah', '1003', '1003_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1003_idrabsen@gmail.com', 'Sheila Azizah', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '082218309694', '082218309694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (21, 'Wahyu Triyono', '1004', '1004_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1004_idrabsen@gmail.com', 'Wahyu Triyono', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081324800656', '081324800656', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (22, 'Dewi Pujianti', '1005', '1005_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1005_idrabsen@gmail.com', 'Dewi Pujianti', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081324800626', '081324800626', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (23, 'Novi Siti Shifa', '1006', '1006_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1006_idrabsen@gmail.com', 'Novi Siti Shifa', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081312001995', '081312001995', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (24, 'Inna', '1007', '1007_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1007_idrabsen@gmail.com', 'Inna', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081808318085', '081808318085', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (25, 'Wulan', '1008', '1008_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1008_idrabsen@gmail.com', 'Wulan', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '087825522616', '087825522616', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (26, 'Desi Permatasari', '1009', '1009_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1009_idrabsen@gmail.com', 'Desi Permatasari', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '088999151289', '088999151289', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (27, 'Puji', '1010', '1010_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1010_idrabsen@gmail.com', 'Puji', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '082127306090', '082127306090', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (28, 'Edu', '1011', '1011_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1011_idrabsen@gmail.com', 'Edu', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081220209130', '081220209130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (29, 'Haryanto', '1012', '1012_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1012_idrabsen@gmail.com', 'Haryanto', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '082218218589', '082218218589', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (30, 'Wawan Hendrawan', '1013', '1013_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1013_idrabsen@gmail.com', 'Wawan Hendrawan', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '087823678442', '087823678442', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (31, 'Edi', '1014', '1014_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1014_idrabsen@gmail.com', 'Edi', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081220355505', '081220355505', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (32, 'Agus Priyono ', '1015', '1015_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1015_idrabsen@gmail.com', 'Agus Priyono ', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081321642630', '081321642630', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (33, 'Erik Setiawan', '1016', '1016_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1016_idrabsen@gmail.com', 'Erik Setiawan', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081380429056', '081380429056', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (34, 'Syaifudin', '1017', '1017_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1017_idrabsen@gmail.com', 'Syaifudin', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081218819192', '081218819192', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (35, 'Irfan', '1018', '1018_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1018_idrabsen@gmail.com', 'Irfan', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081285380158', '081285380158', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (36, 'Kevin', '1019', '1019_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1019_idrabsen@gmail.com', 'Kevin', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '089657359545', '089657359545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (37, 'Rico', '1020', '1020_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1020_idrabsen@gmail.com', 'Rico', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '082122553343', '082122553343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (38, 'Arif', '1021', '1021_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1021_idrabsen@gmail.com', 'Arif', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081366900071', '081366900071', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (39, 'Barus', '1022', '1022_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1022_idrabsen@gmail.com', 'Barus', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081297026234', '081297026234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (40, 'Herman', '1023', '1023_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1023_idrabsen@gmail.com', 'Herman', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '082131313919', '082131313919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (41, 'Shinta', '1024', '1024_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1024_idrabsen@gmail.com', 'Shinta', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081212211117', '081212211117', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (42, 'Hendro', '1025', '1025_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1025_idrabsen@gmail.com', 'Hendro', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '085320688881', '085320688881', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (43, 'Cipto', '1026', '1026_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1026_idrabsen@gmail.com', 'Cipto', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '081280515517', '081280515517', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (44, 'Sodiq', '1027', '1027_idrabsen@gmail.com', 2, 4, NULL, '1000', 2, NULL, b'1', '1027_idrabsen@gmail.com', 'Sodiq', 'ABCDE2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Bandung', NULL, 'Jawa Barat', NULL, NULL, '082115077820', '082115077820', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-24 14:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_karyawan` VALUES (45, 'Nama Karyawan', 'A001', 'A001_presensikita@gmail.com', 3, 7, NULL, '10000', 3, NULL, b'1', 'A001_presensikita@gmail.com', 'Nama Karyawan', '3F8D04', '2020-07-01 00:00:00', '2020-07-01 00:00:00', NULL, 1, NULL, 'S1', 'Manajemen', 'Bandung', '2020-07-10 00:00:00', 'Bandung', 'Bandung', '40222', 'Jawa Barat', NULL, NULL, '0878000000', '0878000000', NULL, NULL, NULL, '', NULL, '1', 0, '20200710_172701__profile_A001_3F8D04_avatar5.png', '1', 'O', '', NULL, NULL, '2020-07-10 17:27:37', NULL, '2020-07-10 17:27:37', NULL, '2020-07-10 17:27:37', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL);

-- ----------------------------
-- Table structure for z_keluarga
-- ----------------------------
DROP TABLE IF EXISTS `z_keluarga`;
CREATE TABLE `z_keluarga`  (
  `SEQ` int(11) NULL DEFAULT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMPID` int(1) NULL DEFAULT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NAMA_KEL` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `RELASI_KEL` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `JNS_KELAMIN` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MSH_HIDUP` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `GANTI_OBAT` int(6) NULL DEFAULT 80,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  INDEX `NIK`(`NIK`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_keluarga
-- ----------------------------
INSERT INTO `z_keluarga` VALUES (1, '201609002', 1, 'ABCDE1', 'Nama Istri', 'Istri', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (2, '201609002', 1, 'ABCDE1', 'Nama Anak 1', 'Anak', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (1, '201609001', 1, 'ABCDE1', 'Nama Istri', 'Istri', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (2, '201609001', 1, 'ABCDE1', 'Nama Anak 1', 'Anak', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (1, '161111', 1, 'ABCDE1', 'Nama Istri', 'Istri', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (2, '161111', 1, 'ABCDE1', 'Nama Anak', 'Anak', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (1, '201609006', 1, 'ABCDE1', 'Resti Hadiyani', 'Istri', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (2, '201609006', 1, 'ABCDE1', 'Farel', 'Anak', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (3, '201609006', 1, 'ABCDE1', 'Muzammil', 'Anak', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (1, '1001', 2, 'ABCDE2', 'Nama Istri', 'Istri', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (1, 'A001', 3, '3F8D04', 'Nama Istri', 'Anak', NULL, NULL, 80, 1);
INSERT INTO `z_keluarga` VALUES (2, 'A001', 3, '3F8D04', 'Nama Anak', 'Anak', NULL, NULL, 80, 1);

-- ----------------------------
-- Table structure for z_keys
-- ----------------------------
DROP TABLE IF EXISTS `z_keys`;
CREATE TABLE `z_keys`  (
  `id` double NOT NULL,
  `user_id` double NOT NULL,
  `key` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` double NOT NULL,
  `ignore_limits` double NOT NULL DEFAULT 0,
  `is_private_key` double NOT NULL DEFAULT 0,
  `ip_addresses` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_keys
-- ----------------------------
INSERT INTO `z_keys` VALUES (1, 1, '$2y$10$8s17VAT1sDea3EtZQMdXgOFgXVtI9N4MsgPWkbDMq1RI3ckgmnlEK', 1, 0, 0, NULL, '2019-01-01 10:38:57');
INSERT INTO `z_keys` VALUES (2, 2, '$2y$10$7creS1hbvgilxW9L0ZgSmuWZLuzLy8HuehXxJx0LDWOaAAKm4SnAK', 1, 0, 0, NULL, '2019-01-01 00:00:00');

-- ----------------------------
-- Table structure for z_lap_absensi_log
-- ----------------------------
DROP TABLE IF EXISTS `z_lap_absensi_log`;
CREATE TABLE `z_lap_absensi_log`  (
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMPID` int(11) NULL DEFAULT NULL,
  `COMP_CODE` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `UNITID` int(11) NOT NULL,
  `TGL_ABS` datetime(0) NOT NULL,
  `JAM_IN` datetime(0) NULL DEFAULT NULL,
  `JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `ID_ABS_TYPE` int(11) NOT NULL,
  `ID_TP` int(11) NULL DEFAULT NULL,
  `EMP_ID` int(11) NOT NULL,
  `JADWAL_MASUK` datetime(0) NULL DEFAULT NULL,
  `JADWAL_PULANG` datetime(0) NULL DEFAULT NULL,
  `REMARK` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`NIK`, `TGL_ABS`, `ID_ABS_TYPE`, `UNITID`, `EMP_ID`) USING BTREE,
  UNIQUE INDEX `idx_emp_absensi`(`NIK`, `UNITID`, `TGL_ABS`, `ID_ABS_TYPE`) USING BTREE,
  INDEX `idx_nik_absensi`(`NIK`) USING BTREE,
  INDEX `idx_empid_absensi`(`EMP_ID`) USING BTREE,
  INDEX `idx_tgl_absensi`(`TGL_ABS`) USING BTREE,
  INDEX `idx_z_absensi`(`NIK`, `UNITID`, `TGL_ABS`, `JAM_IN`, `JAM_OUT`, `ID_ABS_TYPE`, `EMP_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_lap_absensi_log
-- ----------------------------
INSERT INTO `z_lap_absensi_log` VALUES ('201609005', 1, 'ABCDE1', 1, '2021-07-13 00:00:00', NULL, NULL, 9, 1, 1, '2021-07-13 08:00:00', '2021-07-13 17:00:00', NULL);
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-06 00:00:00', NULL, NULL, 6, 1, 1, '2021-07-06 08:00:00', '2021-07-06 17:00:00', NULL);
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-05 00:00:00', NULL, '2021-07-05 17:00:00', 1, 1, 1, '2021-07-05 08:00:00', '2021-07-05 17:00:00', 'Izin Pulang Cepat');
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-01 00:00:00', NULL, NULL, 3, 1, 1, '2021-07-01 08:00:00', '2021-07-01 17:00:00', NULL);
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-09 00:00:00', NULL, NULL, 6, 1, 1, '2021-07-09 08:00:00', '2021-07-09 17:00:00', NULL);
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-08 00:00:00', '2021-07-08 08:00:00', '2021-07-08 17:00:00', 1, 1, 1, '2021-07-08 08:00:00', '2021-07-08 17:00:00', 'Lupa Absen');
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-15 00:00:00', '2021-07-15 14:15:24', NULL, 1, 1, 1, '2021-07-15 08:00:00', '2021-07-15 17:00:00', NULL);
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-16 00:00:00', '2021-07-16 09:28:59', NULL, 1, 9, 1, '2021-07-16 08:00:00', '2021-07-16 08:00:00', NULL);
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-13 00:00:00', '2021-07-13 09:12:14', '2021-07-13 09:39:04', 9, 1, 1, '2021-07-13 08:00:00', '2021-07-13 17:00:00', 'Dinas');
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-02 00:00:00', '2021-07-02 08:00:00', '2021-07-02 17:50:00', 1, 1, 1, '2021-07-02 08:00:00', '2021-07-02 17:00:00', 'Izin Terlambat');
INSERT INTO `z_lap_absensi_log` VALUES ('201609006', 1, 'ABCDE1', 1, '2021-07-12 00:00:00', NULL, NULL, 7, 1, 1, '2021-07-12 08:00:00', '2021-07-12 17:00:00', 'Cuti Tahunan');

-- ----------------------------
-- Table structure for z_lap_rekap_details
-- ----------------------------
DROP TABLE IF EXISTS `z_lap_rekap_details`;
CREATE TABLE `z_lap_rekap_details`  (
  `nik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `emp_id` int(22) NOT NULL,
  `compid` bigint(20) NOT NULL,
  `unitid` int(11) NULL DEFAULT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tanggal` datetime(0) NOT NULL,
  `jdwl_masuk` datetime(0) NULL DEFAULT NULL,
  `jdwl_pulang` datetime(0) NULL DEFAULT NULL,
  `jam_masuk` datetime(0) NOT NULL,
  `jam_pulang` datetime(0) NOT NULL,
  `id_abs_type` int(11) NULL DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stat_libur` tinyint(11) NULL DEFAULT NULL,
  `ket_libur` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_tp` bigint(20) NULL DEFAULT NULL,
  `jml_jam_kerja` decimal(10, 0) NULL DEFAULT 0,
  `jml_jam_kurang` decimal(10, 0) NULL DEFAULT 0,
  `jml_terlambat` int(11) NULL DEFAULT NULL,
  `jml_psw` int(11) NULL DEFAULT NULL,
  `remark` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`nik`, `emp_id`, `compid`, `bulan`, `tahun`, `tanggal`) USING BTREE,
  UNIQUE INDEX `idx_lap_rekap_bulanan`(`emp_id`, `compid`, `bulan`, `tahun`, `nik`, `tanggal`, `unitid`) USING BTREE,
  INDEX `idx_emp_id`(`emp_id`) USING BTREE,
  INDEX `idx_nip`(`nik`) USING BTREE,
  INDEX `idx_tahun`(`tahun`) USING BTREE,
  INDEX `idx_tgl`(`tanggal`) USING BTREE,
  INDEX `idx_abs_type`(`id_abs_type`) USING BTREE,
  INDEX `idx_unitid`(`unitid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_lap_rekap_details
-- ----------------------------
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-21 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-22 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-23 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-24 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-25 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-26 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-27 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-28 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-29 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-06-30 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-01 00:00:00', '2021-07-01 08:00:00', '2021-07-01 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Izin', NULL, NULL, 1, NULL, NULL, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-02 00:00:00', '2021-07-02 08:00:00', '2021-07-02 17:00:00', '2021-07-02 08:00:00', '2021-07-02 17:50:00', 1, 'Hadir', NULL, NULL, 1, 530, 0, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-03 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-04 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-05 00:00:00', '2021-07-05 08:00:00', '2021-07-05 17:00:00', '0000-00-00 00:00:00', '2021-07-05 17:00:00', 1, 'Hadir', NULL, NULL, 1, 240, 240, 0, 1, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-06 00:00:00', '2021-07-06 08:00:00', '2021-07-06 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 'Sakit', NULL, NULL, 1, NULL, NULL, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-07 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-08 00:00:00', '2021-07-08 08:00:00', '2021-07-08 17:00:00', '2021-07-08 08:00:00', '2021-07-08 17:00:00', 1, 'Hadir', NULL, NULL, 1, 480, 0, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-09 00:00:00', '2021-07-09 08:00:00', '2021-07-09 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 'Sakit', NULL, NULL, 1, NULL, NULL, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-10 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-11 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-12 00:00:00', '2021-07-12 08:00:00', '2021-07-12 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Cuti', NULL, NULL, 1, NULL, NULL, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-13 00:00:00', '2021-07-13 08:00:00', '2021-07-13 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 'Dinas Luar', NULL, NULL, 1, 480, 0, 0, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-14 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-15 00:00:00', '2021-07-15 08:00:00', '2021-07-15 17:00:00', '2021-07-15 14:15:24', '0000-00-00 00:00:00', 1, 'Hadir', NULL, NULL, 1, 240, 240, 1, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-16 00:00:00', '2021-07-16 08:00:00', '2021-07-16 08:00:00', '2021-07-16 09:28:59', '0000-00-00 00:00:00', 1, 'Hadir', NULL, NULL, 9, 240, 240, 1, 0, '1');
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-17 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-18 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Hari Libur', 1, 'Hari Libur', NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-19 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);
INSERT INTO `z_lap_rekap_details` VALUES ('201609006', 1, 1, 1, 7, 2021, '2021-07-20 00:00:00', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Alpha', NULL, NULL, NULL, NULL, 480, 0, 0, NULL);

-- ----------------------------
-- Table structure for z_lap_rekap_summary
-- ----------------------------
DROP TABLE IF EXISTS `z_lap_rekap_summary`;
CREATE TABLE `z_lap_rekap_summary`  (
  `emp_id` bigint(22) NOT NULL,
  `compid` bigint(20) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jml_hadir` int(11) NULL DEFAULT NULL,
  `jml_terlambat` int(11) NULL DEFAULT NULL,
  `jml_alpha` int(11) NULL DEFAULT NULL,
  `jml_cuti` int(11) NULL DEFAULT NULL,
  `jml_dinas` int(11) NULL DEFAULT NULL,
  `jml_izin` int(11) NULL DEFAULT NULL,
  `jml_sakit` int(11) NULL DEFAULT NULL,
  `jml_reimburse` decimal(10, 0) NULL DEFAULT NULL,
  `jml_jam_kurang` decimal(10, 0) NULL DEFAULT NULL,
  `jml_jam_kerja` decimal(10, 0) NULL DEFAULT NULL,
  `remark` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`emp_id`, `compid`, `bulan`, `tahun`) USING BTREE,
  UNIQUE INDEX `idx_lap_rekap_bulanan`(`emp_id`, `compid`, `bulan`, `tahun`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_lap_rekap_summary
-- ----------------------------
INSERT INTO `z_lap_rekap_summary` VALUES (1, 1, 7, 2021, 5, 2, 12, 1, 1, 1, 2, 0, 108, 37, NULL);

-- ----------------------------
-- Table structure for z_menu
-- ----------------------------
DROP TABLE IF EXISTS `z_menu`;
CREATE TABLE `z_menu`  (
  `ID_MENU` double NOT NULL,
  `URUT` double NOT NULL,
  `PARENT_MENU` double NOT NULL,
  `NAMA_MENU` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ROUTE_MENU` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ICON_MENU` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID_MENU`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_menu
-- ----------------------------
INSERT INTO `z_menu` VALUES (1, 1, 0, 'Dashboard', 'grit', 'mif-meter');
INSERT INTO `z_menu` VALUES (2, 2, 0, 'Data Pribadi', '#', 'mif-user');
INSERT INTO `z_menu` VALUES (3, 3, 0, 'Report', '#', 'mif-assignment');
INSERT INTO `z_menu` VALUES (4, 4, 0, 'Setting Perusahaan', '#', 'mif-organization');
INSERT INTO `z_menu` VALUES (5, 5, 0, 'Master Data', '#', 'mif-news');
INSERT INTO `z_menu` VALUES (6, 6, 0, 'Managemen User', '#', 'mif-users');
INSERT INTO `z_menu` VALUES (7, 1, 2, 'Profil', 'grit/personal_info', 'mif-user');
INSERT INTO `z_menu` VALUES (8, 2, 2, 'Absensi', '-', 'mif-fingerprint');
INSERT INTO `z_menu` VALUES (9, 3, 2, 'Cuti', '-', 'mif-exit');
INSERT INTO `z_menu` VALUES (10, 4, 2, 'Slip Gaji', '-', 'mif-file-empty');
INSERT INTO `z_menu` VALUES (11, 5, 2, 'Medical', '-', 'mif-heart');
INSERT INTO `z_menu` VALUES (12, 6, 2, 'Reimburse', '-', 'mif-hotel');
INSERT INTO `z_menu` VALUES (13, 7, 2, 'Perjalanan Dinas', '-', 'mif-local-airport');
INSERT INTO `z_menu` VALUES (14, 8, 2, 'Training', '-', 'mif-users');
INSERT INTO `z_menu` VALUES (15, 1, 3, 'Daftar Karyawan', '-', 'mif-users');
INSERT INTO `z_menu` VALUES (16, 2, 3, 'Daftar Absensi', '-', 'mif-fingerprint');
INSERT INTO `z_menu` VALUES (17, 3, 3, 'Daftar Suspense', '-', 'mif-file-empty');
INSERT INTO `z_menu` VALUES (18, 4, 3, 'Daftar Reimburse', '-', 'mif-heart');
INSERT INTO `z_menu` VALUES (19, 5, 3, 'Daftar Training', '-', 'mif-users');
INSERT INTO `z_menu` VALUES (20, 6, 3, 'Daftar Cuti', '-', 'mif-exit');
INSERT INTO `z_menu` VALUES (21, 1, 4, 'Daftar Departemen', '-', 'mif-fingerprint');
INSERT INTO `z_menu` VALUES (22, 2, 4, 'Jumlah Hari Cuti', '-', 'mif-exit');
INSERT INTO `z_menu` VALUES (23, 3, 4, 'Adjusment Cuti', '-', 'mif-exit');
INSERT INTO `z_menu` VALUES (24, 4, 4, 'Periode Gaji', '-', 'mif-exit');
INSERT INTO `z_menu` VALUES (25, 5, 4, 'Kalendar Perusahaan', '-', 'mif-calendar');
INSERT INTO `z_menu` VALUES (26, 1, 5, 'Company Code', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (27, 2, 5, 'PTKP', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (28, 3, 5, 'Group Karyawan', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (29, 4, 5, 'Relasi Keluarga', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (30, 5, 5, 'Bank', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (31, 6, 5, 'Agama', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (32, 7, 5, 'Kewarganegaraan', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (33, 8, 5, 'Tipe Cuti', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (34, 9, 5, 'Tipe Absensi', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (35, 1, 6, 'Daftar User', '-', 'mif-meter');
INSERT INTO `z_menu` VALUES (36, 2, 6, 'Akses Role', '-', 'mif-meter');

-- ----------------------------
-- Table structure for z_nationality
-- ----------------------------
DROP TABLE IF EXISTS `z_nationality`;
CREATE TABLE `z_nationality`  (
  `NATIONALITY_ID` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NATIONALITY` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`NATIONALITY_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_nationality
-- ----------------------------
INSERT INTO `z_nationality` VALUES ('AUS', 'AUSTRALIA');
INSERT INTO `z_nationality` VALUES ('CHN', 'CHINA');
INSERT INTO `z_nationality` VALUES ('IDN', 'INDONESIA');
INSERT INTO `z_nationality` VALUES ('IND', 'INDIA');
INSERT INTO `z_nationality` VALUES ('JPN', 'JAPAN');
INSERT INTO `z_nationality` VALUES ('KOR', 'KOREA');

-- ----------------------------
-- Table structure for z_notifikasi
-- ----------------------------
DROP TABLE IF EXISTS `z_notifikasi`;
CREATE TABLE `z_notifikasi`  (
  `ID_AJU` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL` datetime(0) NOT NULL,
  `STS_AJU` int(11) NOT NULL,
  `IS_READ` int(11) NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notif_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `notif_date_read` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notif_id`) USING BTREE,
  INDEX `z_notifikasi`(`ID_AJU`, `TGL`, `STS_AJU`, `NIK`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_notifikasi
-- ----------------------------
INSERT INTO `z_notifikasi` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', '2021-07-15 09:16:02', 0, 0, '201609006', 1, NULL);
INSERT INTO `z_notifikasi` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', '2021-07-15 09:16:22', 1, 0, '201609006', 2, NULL);
INSERT INTO `z_notifikasi` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', '2021-07-15 09:28:26', 1, 0, '201609006', 3, NULL);
INSERT INTO `z_notifikasi` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', '2021-07-15 09:29:36', 1, 0, '201609006', 4, NULL);
INSERT INTO `z_notifikasi` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', '2021-07-15 09:30:17', 0, 0, '201609006', 5, NULL);
INSERT INTO `z_notifikasi` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', '2021-07-15 09:32:13', 1, 0, '201609006', 6, NULL);
INSERT INTO `z_notifikasi` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', '2021-07-15 09:34:01', 1, 0, '201609006', 7, NULL);
INSERT INTO `z_notifikasi` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', '2021-07-15 09:35:25', 1, 0, '201609006', 8, NULL);
INSERT INTO `z_notifikasi` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', '2021-07-15 09:36:37', 1, 0, '201609006', 9, NULL);
INSERT INTO `z_notifikasi` VALUES ('a5dd8b7c-e53f-11eb-a65f-00ffe1', '2021-07-15 09:38:27', 0, 0, '201609006', 10, NULL);
INSERT INTO `z_notifikasi` VALUES ('a5dd8b7c-e53f-11eb-a65f-00ffe1', '2021-07-15 09:38:37', 1, 0, '201609006', 11, NULL);
INSERT INTO `z_notifikasi` VALUES ('ef5caa42-e53f-11eb-a65f-00ffe1', '2021-07-15 09:40:31', 0, 0, '201609006', 12, NULL);
INSERT INTO `z_notifikasi` VALUES ('ef5caa42-e53f-11eb-a65f-00ffe1', '2021-07-15 09:40:40', 1, 0, '201609006', 13, NULL);
INSERT INTO `z_notifikasi` VALUES ('3457f264-e540-11eb-a65f-00ffe1', '2021-07-15 09:42:26', 0, 0, '201609006', 14, NULL);
INSERT INTO `z_notifikasi` VALUES ('3457f264-e540-11eb-a65f-00ffe1', '2021-07-15 09:43:38', 1, 0, '201609006', 15, NULL);
INSERT INTO `z_notifikasi` VALUES ('1e1d0149-e541-11eb-a65f-00ffe1', '2021-07-15 09:48:59', 0, 0, '201609006', 16, NULL);
INSERT INTO `z_notifikasi` VALUES ('1e1d0149-e541-11eb-a65f-00ffe1', '2021-07-15 09:49:26', 1, 0, '201609006', 17, NULL);
INSERT INTO `z_notifikasi` VALUES ('53de13b7-e541-11eb-a65f-00ffe1', '2021-07-15 09:50:28', 0, 0, '201609006', 18, NULL);
INSERT INTO `z_notifikasi` VALUES ('53de13b7-e541-11eb-a65f-00ffe1', '2021-07-15 09:51:08', 1, 0, '201609006', 19, NULL);
INSERT INTO `z_notifikasi` VALUES ('d40a5aa0-e541-11eb-a65f-00ffe1', '2021-07-01 00:00:00', 0, 0, '201609006', 20, NULL);
INSERT INTO `z_notifikasi` VALUES ('d40a5aa0-e541-11eb-a65f-00ffe1', '2021-07-15 09:54:09', 1, 0, '201609006', 21, NULL);
INSERT INTO `z_notifikasi` VALUES ('e71eae3e-e541-11eb-a65f-00ffe1', '2021-07-01 00:00:00', 0, 0, '201609006', 22, NULL);
INSERT INTO `z_notifikasi` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', '2021-07-15 09:56:10', 0, 0, '201609006', 23, NULL);
INSERT INTO `z_notifikasi` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', '2021-07-15 10:19:26', 1, 0, '201609006', 24, NULL);
INSERT INTO `z_notifikasi` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', '2021-07-15 11:07:21', 1, 0, '201609006', 25, NULL);
INSERT INTO `z_notifikasi` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', '2021-07-15 11:08:59', 1, 0, '201609006', 26, NULL);
INSERT INTO `z_notifikasi` VALUES ('29867cc5-ea01-11eb-99b8-00ffe1', '2021-07-21 10:53:45', 0, 0, '201609006', 27, NULL);
INSERT INTO `z_notifikasi` VALUES ('29867cc5-ea01-11eb-99b8-00ffe1', '2021-07-21 10:53:59', 1, 0, '201609006', 28, NULL);

-- ----------------------------
-- Table structure for z_oldcompany
-- ----------------------------
DROP TABLE IF EXISTS `z_oldcompany`;
CREATE TABLE `z_oldcompany`  (
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ID_OLD_COMP` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DEPT_LAMA` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `BAGIAN_LAMA` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  INDEX `NIK`(`NIK`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for z_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `z_pengguna`;
CREATE TABLE `z_pengguna`  (
  `ID_USER` double NOT NULL AUTO_INCREMENT,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA_USER` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `EMAIL_ADDR` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `KT_KONCI` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `KODE_AKTIF` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TINGKAT` int(11) NOT NULL,
  `NON_AKTIP` int(11) NOT NULL,
  `DATE_NON_AKTIP` datetime(0) NULL DEFAULT NULL,
  `CREATED_BY` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `CREATED_DATE` datetime(0) NULL DEFAULT NULL,
  `MODIFY_BY` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MODIFY_DATE` datetime(0) NULL DEFAULT NULL,
  `FOTO` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LINK_AKTIVASI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `STAT_INSTALL` tinyint(4) NULL DEFAULT NULL,
  `COMPID` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_USER`) USING BTREE,
  INDEX `idx_pengguna`(`ID_USER`, `NIK`, `NAMA_USER`, `EMAIL_ADDR`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_pengguna
-- ----------------------------
INSERT INTO `z_pengguna` VALUES (1, '1', 'Nuriyanto', 'sayarhungs@gmail.com', '087823339007Q#qJT', '$2y$10$RfQx7Ayuf1e7Pi5e4ysRY.yc/tgnMxBaZ7CYjVJcbLiH5SFiw.GBi', 0, 0, NULL, 'REGISTER', '2020-03-23 11:46:14', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=087823339007&kode_aktif=$2y$10$RfQx7Ayuf1e7Pi5e4ysRY.yc/tgnMxBaZ7CYjVJcbLiH5SFiw.GBi&imei1=087823339007', NULL, 1);
INSERT INTO `z_pengguna` VALUES (2, '2', 'Zaenal Ariepin', 'zpaceghost@gmail.com', '08122359254Q#qJT', '$2y$10$50nTrvVATeaFyA.fkFt2heO.VXt2ub5/4mNbxVOaugMlr5gjPZwHe', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=082115701190&kode_aktif=$2y$10$50nTrvVATeaFyA.fkFt2heO.VXt2ub5/4mNbxVOaugMlr5gjPZwHe&imei1=082115701190', NULL, 1);
INSERT INTO `z_pengguna` VALUES (3, '3', 'Abdul Azis', 'abah.khansa@gmail.com', '085222275272Q#qJT', '$2y$10$uOotiz2txkMmlpH/amtV5O6E3WOYchrC7jWUn7QhDsy2UOYTMjkQq', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=082115800590&kode_aktif=$2y$10$uOotiz2txkMmlpH/amtV5O6E3WOYchrC7jWUn7QhDsy2UOYTMjkQq&imei1=082115800590', NULL, 1);
INSERT INTO `z_pengguna` VALUES (4, '4', 'Ardia M Ginanjar', 'ardia.mgz@gmail.com', '081312110303Q#qJT', '$2y$10$1bwm8NsMuvX1t47sQPj8eeG46cFi85XUTdxWL9q22DCJCVIQjZ5C.', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=08161185796&kode_aktif=$2y$10$1bwm8NsMuvX1t47sQPj8eeG46cFi85XUTdxWL9q22DCJCVIQjZ5C.&imei1=08161185796', NULL, 1);
INSERT INTO `z_pengguna` VALUES (5, '5', 'Moch. Adnan', 'xdnan.007@gmail.com', '081289440708Q#qJT', '$2y$10$Epd3JwdYx4d3z3cSQts.sesRRXGlcn3oll8kprwPB/syK.GqKZL4e', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=087784600551&kode_aktif=$2y$10$Epd3JwdYx4d3z3cSQts.sesRRXGlcn3oll8kprwPB/syK.GqKZL4e&imei1=866907038373238', NULL, 1);
INSERT INTO `z_pengguna` VALUES (6, '6', 'Danny Triyatna', 'dany.triyatna@gmail.com', '081322900089Q#qJT', '$2y$10$XuAmHITJGVnTrWTqhIKI/.jQ0JcZ6VZvnoj1kHx9mHPDq.lJJBLs.', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=087738916969&kode_aktif=$2y$10$XuAmHITJGVnTrWTqhIKI/.jQ0JcZ6VZvnoj1kHx9mHPDq.lJJBLs.&imei1=087738916969', NULL, 1);
INSERT INTO `z_pengguna` VALUES (7, '7', 'Husni Sabar', 'aang.husni@gmail.com', '081222262718Q#qJT', '$2y$10$xN.kCWLRL9.Y53UAWvtepOTBhrh/fiV.n0xGFDZdHM48LGGyJ0JdO', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=08129199998&kode_aktif=$2y$10$xN.kCWLRL9.Y53UAWvtepOTBhrh/fiV.n0xGFDZdHM48LGGyJ0JdO&imei1=08129199998', NULL, 1);
INSERT INTO `z_pengguna` VALUES (8, '8', 'Irvan Romdani', 'irvan.romdani@gmail.com', '081320058854Q#qJT', '$2y$10$MrvnfuBAio0xH5PMyIbieOj6ff5lD9.Z/ixcBZVWDGFqCt0tcDlM2', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=085722300436&kode_aktif=$2y$10$MrvnfuBAio0xH5PMyIbieOj6ff5lD9.Z/ixcBZVWDGFqCt0tcDlM2&imei1=085722300436', NULL, 1);
INSERT INTO `z_pengguna` VALUES (9, '9', 'Sri Rejeki', 'tanyasrirejekinovianti@gmail.com', '081222565364Q#qJT', '$2y$10$qTfBxaMTZYcHLwVRZfICTeCIKdr/uvrTf5yB1esgE/QLw8CDAormC', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=081322900089&kode_aktif=$2y$10$qTfBxaMTZYcHLwVRZfICTeCIKdr/uvrTf5yB1esgE/QLw8CDAormC&imei1=081322900089', NULL, 1);
INSERT INTO `z_pengguna` VALUES (10, '10', 'Dessy Nur Fitriyah', 'desinurfitriah4@gmail.com', '085720544907Q#qJT', '$2y$10$OwOthV9uzpI.mTgYNGD.bOoVclR6DuRs3oO7x1H.94uMDBUPXxQqa', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=08129609025&kode_aktif=$2y$10$OwOthV9uzpI.mTgYNGD.bOoVclR6DuRs3oO7x1H.94uMDBUPXxQqa&imei1=08129609025', NULL, 1);
INSERT INTO `z_pengguna` VALUES (11, '11', 'Suci Ismayanti', 'suciismayantiputri15@gmail.com', '082321710788Q#qJT', '$2y$10$jnT8AwXbuRlsGyLjYi6VauqqKjqNUqa6ktGeKUEdGUpuAoLgGhmmq', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=08129371878&kode_aktif=$2y$10$jnT8AwXbuRlsGyLjYi6VauqqKjqNUqa6ktGeKUEdGUpuAoLgGhmmq&imei1=08129371878', NULL, 1);
INSERT INTO `z_pengguna` VALUES (12, '12', 'Agung Sulaksana', 'sulaksana34@gmail.com', '08996867174Q#qJT', '$2y$10$lOfVPo.qE3D8ECCIJ72EpOE3uT3lbY6FVs8g2Lab/f2hbS9iKh96W', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=08562133289&kode_aktif=$2y$10$lOfVPo.qE3D8ECCIJ72EpOE3uT3lbY6FVs8g2Lab/f2hbS9iKh96W&imei1=08562133289', NULL, 1);
INSERT INTO `z_pengguna` VALUES (13, '13', 'Hasan Amal', 'greatsans98@gmail.com', '08985766866Q#qJT', '$2y$10$JNRghs732IadzbN/Nbo/suVwTM93Y9gsziEYuJTs1eeNXbX4BPXOe', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=08561072832&kode_aktif=$2y$10$JNRghs732IadzbN/Nbo/suVwTM93Y9gsziEYuJTs1eeNXbX4BPXOe&imei1=08561072832', NULL, 1);
INSERT INTO `z_pengguna` VALUES (14, '14', 'Indrazit', 'indrazitmegandana53@gmail.com', '085795192521Q#qJT', '$2y$10$lNLa0019QghrmXLX5xfDUepvG7eiPtWVznZLSdb6aORNXSDa9JZFi', 0, 0, NULL, 'REGISTER', '2020-03-04 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=081394779126&kode_aktif=$2y$10$lNLa0019QghrmXLX5xfDUepvG7eiPtWVznZLSdb6aORNXSDa9JZFi&imei1=081394779126', NULL, 1);
INSERT INTO `z_pengguna` VALUES (15, '15', 'Rizka Azka', 'rizka.azka29@gmail.com', '082118360212Q#qJT', '$2y$10$Kpu5qxAob3HPc8o4gBQYquXVptwUcC.Avk8EVKgy.yIpr/wS1G/tW', 0, 0, NULL, 'REGISTER', '2020-03-05 00:00:00', NULL, NULL, NULL, 'http://seuneu.trisula.com/aktivasi?hp1=081320306555&kode_aktif=$2y$10$Kpu5qxAob3HPc8o4gBQYquXVptwUcC.Avk8EVKgy.yIpr/wS1G/tW&imei1=081320306555', NULL, 1);
INSERT INTO `z_pengguna` VALUES (17, '1001', 'Budi Rental', '1001_idrabsen@gmail.com', '087823331000fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, 'REGISTER', '2020-06-23 13:50:17', NULL, NULL, NULL, 'http://presensikita.com/presensikita/aktivasi?hp1=087823331000&kode_aktif=$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy&imei1=087823331000', NULL, 2);
INSERT INTO `z_pengguna` VALUES (18, '1002', 'Gerry Yohanes H', '1002_idrabsen@gmail.com', '081224420381fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (19, '1003', 'Sheila Azizah', '1003_idrabsen@gmail.com', '082218309694fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (20, '1004', 'Wahyu Triyono', '1004_idrabsen@gmail.com', '081324800656fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (21, '1005', 'Dewi Pujianti', '1005_idrabsen@gmail.com', '081324800626fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (22, '1006', 'Novi Siti Shifa', '1006_idrabsen@gmail.com', '081312001995fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (23, '1007', 'Inna', '1007_idrabsen@gmail.com', '081808318085fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (24, '1008', 'Wulan', '1008_idrabsen@gmail.com', '087825522616fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (25, '1009', 'Desi Permatasari', '1009_idrabsen@gmail.com', '088999151289fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (26, '1010', 'Puji', '1010_idrabsen@gmail.com', '082127306090fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (27, '1011', 'Edu', '1011_idrabsen@gmail.com', '081220209130fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (28, '1012', 'Haryanto', '1012_idrabsen@gmail.com', '082218218589fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (29, '1013', 'Wawan Hendrawan', '1013_idrabsen@gmail.com', '087823678442fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (30, '1014', 'Edi', '1014_idrabsen@gmail.com', '081220355505fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (31, '1015', 'Agus Priyono ', '1015_idrabsen@gmail.com', '081321642630fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (32, '1016', 'Erik Setiawan', '1016_idrabsen@gmail.com', '081380429056fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (33, '1017', 'Syaifudin', '1017_idrabsen@gmail.com', '081218819192fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (34, '1018', 'Irfan', '1018_idrabsen@gmail.com', '081285380158fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (35, '1019', 'Kevin', '1019_idrabsen@gmail.com', '089657359545fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (36, '1020', 'Rico', '1020_idrabsen@gmail.com', '082122553343fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (37, '1021', 'Arif', '1021_idrabsen@gmail.com', '081366900071fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (38, '1022', 'Barus', '1022_idrabsen@gmail.com', '081297026234fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (39, '1023', 'Herman', '1023_idrabsen@gmail.com', '082131313919fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (40, '1024', 'Shinta', '1024_idrabsen@gmail.com', '081212211117fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (41, '1025', 'Hendro', '1025_idrabsen@gmail.com', '085320688881fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (42, '1026', 'Cipto', '1026_idrabsen@gmail.com', '081280515517fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (43, '1027', 'Sodiq', '1027_idrabsen@gmail.com', '082115077820fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-06-24 14:42:47', NULL, NULL, NULL, NULL, 1, 2);
INSERT INTO `z_pengguna` VALUES (44, 'A001', 'Nama Karyawan', 'A001_presensikita@gmail.com', '0878000000fghKG', '$2y$10$EM0JCJdoeFIdDPHvQnSSvOCYF4IdIc7ZOY2rEhxEayHXGt1Ws0Isy', 0, 0, NULL, '2', '2020-07-10 17:31:08', NULL, NULL, NULL, NULL, 1, 3);

-- ----------------------------
-- Table structure for z_periode
-- ----------------------------
DROP TABLE IF EXISTS `z_periode`;
CREATE TABLE `z_periode`  (
  `periode_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `periode_nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`periode_id`) USING BTREE,
  UNIQUE INDEX `idx_periode_id`(`periode_id`) USING BTREE,
  INDEX `id_periode`(`periode_id`, `periode_nama`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2022 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_periode
-- ----------------------------
INSERT INTO `z_periode` VALUES (2019, '2019', '2019-01-01', '2019-12-31', b'1', 2, '2020-03-04 10:57:03', NULL, NULL);
INSERT INTO `z_periode` VALUES (2020, '2020', '2020-01-01', '2020-12-31', b'1', 2, '2020-03-04 10:57:17', 2, '2020-03-11 02:55:42');
INSERT INTO `z_periode` VALUES (2021, '2021', '2021-01-01', '2021-12-31', b'1', 2, '2021-07-15 16:45:01', NULL, NULL);

-- ----------------------------
-- Table structure for z_periode_gaji
-- ----------------------------
DROP TABLE IF EXISTS `z_periode_gaji`;
CREATE TABLE `z_periode_gaji`  (
  `COMPID` int(11) NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_AWAL` int(11) NOT NULL,
  `TGL_AKHIR` int(11) NOT NULL,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  `STAT_BULAN` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`COMPID`) USING BTREE,
  INDEX `COMP_CODE`(`COMP_CODE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_periode_gaji
-- ----------------------------
INSERT INTO `z_periode_gaji` VALUES (1, 'ABCDE1', 21, 20, 1, 1);
INSERT INTO `z_periode_gaji` VALUES (2, 'ABCDE2', 27, 27, 1, 1);
INSERT INTO `z_periode_gaji` VALUES (3, '3F8D04', 21, 20, 1, 1);

-- ----------------------------
-- Table structure for z_personalize
-- ----------------------------
DROP TABLE IF EXISTS `z_personalize`;
CREATE TABLE `z_personalize`  (
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK_ATASAN` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK_STAFF` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK_HC` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `NOTIF_ATASAN` tinyint(1) NULL DEFAULT 1,
  `NOTIF_HC` tinyint(1) NULL DEFAULT 1,
  `STAT_ABSEN_MOBILE` tinyint(1) NULL DEFAULT 1,
  `NOTIF_STAFF` tinyint(1) NULL DEFAULT 1,
  `MOD_IZIN` tinyint(1) NULL DEFAULT 1,
  `MOD_CUTI` tinyint(1) NULL DEFAULT 1,
  `MOD_OBAT` tinyint(1) NULL DEFAULT 1,
  `MOD_REIMBURSE` tinyint(1) NULL DEFAULT 1,
  `MOD_DINAS` tinyint(1) NULL DEFAULT 1,
  `MOD_TRAINING` tinyint(1) NULL DEFAULT 1,
  `GANTI_OBAT` smallint(6) NULL DEFAULT 100,
  `NIK_OBAT` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `NOTIF_OBAT` tinyint(1) NULL DEFAULT 0,
  `STAT_SALES` tinyint(1) NULL DEFAULT 0,
  INDEX `idx_personalize`(`COMP_CODE`, `NIK_ATASAN`, `NIK_STAFF`, `NIK_HC`, `NOTIF_ATASAN`, `NOTIF_HC`, `STAT_ABSEN_MOBILE`, `STAT_SALES`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_personalize
-- ----------------------------
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609006', '201609006', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609001', '201609001', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201609002', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '8', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201609005', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201609004', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201609003', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201609007', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201609008', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201706004', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201706001', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201810001', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201805002', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201807001', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201904002', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE1', '201609002', '201706003', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1001', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, NULL, 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1002', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1003', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1004', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1005', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1006', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1007', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1008', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1009', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1010', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1011', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1012', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1013', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1014', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1015', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1016', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1017', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1018', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1019', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1020', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1021', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1022', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1023', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1024', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1025', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1026', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('ABCDE2', '1001', '1027', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);
INSERT INTO `z_personalize` VALUES ('3F8D04', 'A001', 'A001', '0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 100, '0', 0, 1);

-- ----------------------------
-- Table structure for z_position
-- ----------------------------
DROP TABLE IF EXISTS `z_position`;
CREATE TABLE `z_position`  (
  `positionId` int(11) NOT NULL AUTO_INCREMENT,
  `positionCode` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `positionAlias` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `positionName` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `positionType` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `positionLevel` int(11) NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`positionId`) USING BTREE,
  INDEX `idx_position`(`positionId`, `positionCode`, `positionAlias`, `positionName`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for z_position_employee
-- ----------------------------
DROP TABLE IF EXISTS `z_position_employee`;
CREATE TABLE `z_position_employee`  (
  `position_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `position_desc` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `parent_position_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `company_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `org_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_structural` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `grade` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `grade_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `valid_from` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `valid_to` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `active` bit(1) NULL DEFAULT b'1',
  PRIMARY KEY (`position_code`) USING BTREE,
  INDEX `idx_z_position_employee`(`position_code`, `position_desc`, `parent_position_code`, `company_code`, `org_code`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_position_employee
-- ----------------------------
INSERT INTO `z_position_employee` VALUES ('10000001', 'Posisi PT. Mitra Sinerji', NULL, 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('10000002', 'Komisaris', '10000001', 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('10000003', 'Direktur Utama', '10000001', 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('10000004', 'Project Manager', '10000001', 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('10000005', 'Programmer', '10000001', 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('10000006', 'Marketing', '10000001', 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('10000007', 'HR & GA', '10000001', 'ABCDE1', '10000000', '0', NULL, NULL, '2020-01-01', '2030-12-31', b'1');
INSERT INTO `z_position_employee` VALUES ('1000', 'Digital Marketing Internet', NULL, 'ABCDE2', '1000', NULL, NULL, NULL, '2020-06-01', NULL, b'1');
INSERT INTO `z_position_employee` VALUES ('1001', 'Asisten Digital Marketing', '1000', 'ABCDE2', '1000', NULL, NULL, NULL, '2020-06-17', NULL, b'1');
INSERT INTO `z_position_employee` VALUES ('10000', 'Nama Posisi Presensikita', NULL, '3F8D04', '7', NULL, NULL, NULL, '2020-01-01', '2020-12-31', b'1');

-- ----------------------------
-- Table structure for z_r_absensi
-- ----------------------------
DROP TABLE IF EXISTS `z_r_absensi`;
CREATE TABLE `z_r_absensi`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_ABS` datetime(0) NOT NULL,
  `JAM_IN` datetime(0) NULL DEFAULT NULL,
  `JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `ID_ABS_TYPE` int(11) NOT NULL,
  `REMARK` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LONGITUDE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LATITUDE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LOKASI` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `URL_FOTO` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DEVICE` int(11) NULL DEFAULT NULL,
  `URL_FOTO_PULANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  INDEX `idx_z_r_absensi`(`ID_AJU`, `NIK`, `COMP_CODE`, `TGL_ABS`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_absensi
-- ----------------------------
INSERT INTO `z_r_absensi` VALUES ('ABCDE1.AB.06.2020.00', '201609006', 'ABCDE1', '2020-06-18 00:00:00', '2020-06-18 10:48:29', NULL, 1, NULL, '107.6622593', '-6.944', 'PT. Mitra Sinerji Teknoindo Jalan Soekarno Hatta', '20200618_104829__foto_absensi_201609006_ABCDE1_testing.png', 1, NULL);

-- ----------------------------
-- Table structure for z_r_cuti
-- ----------------------------
DROP TABLE IF EXISTS `z_r_cuti`;
CREATE TABLE `z_r_cuti`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CUTI_ID` int(11) NOT NULL,
  `ALASAN_CUTI` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_AWAL_CUTI` datetime(0) NOT NULL,
  `TGL_AKHIR_CUTI` datetime(0) NOT NULL,
  `ACTIVE` tinyint(1) NULL DEFAULT 1,
  INDEX `idx_z_r_cuti`(`ID_AJU`, `CUTI_ID`, `ACTIVE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_cuti
-- ----------------------------
INSERT INTO `z_r_cuti` VALUES ('53de13b7-e541-11eb-a65f-00ffe1', 1, 'Cuti tahunan', '2021-07-12 00:00:00', '2021-07-12 00:00:00', 1);

-- ----------------------------
-- Table structure for z_r_cuti_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_cuti_url`;
CREATE TABLE `z_r_cuti_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_CUTI` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_cuti_url
-- ----------------------------
INSERT INTO `z_r_cuti_url` VALUES ('53de13b7-e541-11eb-a65f-00ffe1', 1, '0_60EFE8C4F05A6_20210715095028_201609006_ABCDE1.png');
INSERT INTO `z_r_cuti_url` VALUES ('ABCDE1.CT.05.2020.000001', 1, 'ABCDE1.CT.05.2020.000001_5EB57F67080F8_20200508224855_201609006_ABCDE1.png');
INSERT INTO `z_r_cuti_url` VALUES ('ABCDE1.CT.05.2020.000002', 1, '0_5EB57D1162D78_20200508223857_201609002_ABCDE1.png');

-- ----------------------------
-- Table structure for z_r_gantib
-- ----------------------------
DROP TABLE IF EXISTS `z_r_gantib`;
CREATE TABLE `z_r_gantib`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JNS_GANTIB` double NOT NULL,
  `TGL_KUITANSI` datetime(0) NOT NULL,
  `NOM_KUITANSI` decimal(20, 0) NOT NULL,
  `KET_GANTIB` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`) USING BTREE,
  UNIQUE INDEX `idx_r_gantib_id`(`ID_AJU`) USING BTREE,
  INDEX `idx_r_gantib`(`ID_AJU`, `JNS_GANTIB`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_gantib
-- ----------------------------
INSERT INTO `z_r_gantib` VALUES ('ABCDE1.PB.05.2020.000001', 1, '2020-05-11 00:00:00', 150000, 'Penggantian Transport');
INSERT INTO `z_r_gantib` VALUES ('ABCDE1.PB.05.2020.000002', 3, '2020-05-12 00:00:00', 300000, 'Travel Bandung - Jakarta');
INSERT INTO `z_r_gantib` VALUES ('ABCDE1.PB.05.2020.000003', 1, '2020-05-12 00:00:00', 400000, 'Test');
INSERT INTO `z_r_gantib` VALUES ('ABCDE1.PB.05.2020.000004', 1, '2020-05-12 00:00:00', 300000, 'Test');
INSERT INTO `z_r_gantib` VALUES ('e71eae3e-e541-11eb-a65f-00ffe1', 1, '2021-07-01 00:00:00', 100000, 'Bensin');

-- ----------------------------
-- Table structure for z_r_gantib_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_gantib_url`;
CREATE TABLE `z_r_gantib_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_GANTIB` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  UNIQUE INDEX `z_r_gantib_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_gantib_url
-- ----------------------------
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000001', 1, '0_5EC209591B9AD_20200518110441_201609006_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000001', 2, '0_5EC209591C5FB_20200518110441_201609006_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000002', 1, '0_5EC20B02989BD_20200518111146_201609002_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000002', 2, '0_5EC20B0297DB7_20200518111146_201609002_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000003', 1, 'ABCDE1.PB.05.2020.000003_5ECDCE071EE9A_20200527091847_201609006_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000004', 1, '0_5ECDCDF8E57AB_20200527091832_201609006_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('ABCDE1.PB.05.2020.000004', 2, '0_5ECDCDF8E4525_20200527091832_201609006_ABCDE1.png');
INSERT INTO `z_r_gantib_url` VALUES ('e71eae3e-e541-11eb-a65f-00ffe1', 1, '0_60EFE9BC4B4BB_20210715095436_201609006_ABCDE1.png');

-- ----------------------------
-- Table structure for z_r_izin
-- ----------------------------
DROP TABLE IF EXISTS `z_r_izin`;
CREATE TABLE `z_r_izin`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JNS_IZIN` int(11) NOT NULL,
  `ALASAN_IZIN` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_AWAL_IZIN` datetime(0) NOT NULL,
  `TGL_AKHIR_IZIN` datetime(0) NOT NULL,
  PRIMARY KEY (`ID_AJU`) USING BTREE,
  UNIQUE INDEX `idx_r_izin_id`(`ID_AJU`) USING BTREE,
  INDEX `idx_r_izin`(`ID_AJU`, `JNS_IZIN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_izin
-- ----------------------------
INSERT INTO `z_r_izin` VALUES ('1e1d0149-e541-11eb-a65f-00ffe1', 13, 'Lupa absen bro', '2021-07-08 00:00:00', '2021-07-08 00:00:00');
INSERT INTO `z_r_izin` VALUES ('29867cc5-ea01-11eb-99b8-00ffe1', 6, 'Sakit Test', '2021-07-09 00:00:00', '2021-07-09 00:00:00');
INSERT INTO `z_r_izin` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', 4, 'Izin terlambat mau meeting dulu guys', '2021-07-02 00:00:00', '2021-07-02 00:00:00');
INSERT INTO `z_r_izin` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', 3, 'Izin ada keperluan', '2021-07-01 00:00:00', '2021-07-01 00:00:00');
INSERT INTO `z_r_izin` VALUES ('a5dd8b7c-e53f-11eb-a65f-00ffe1', 5, 'Izin Pulang Cepat', '2021-07-05 00:00:00', '2021-07-05 00:00:00');
INSERT INTO `z_r_izin` VALUES ('ef5caa42-e53f-11eb-a65f-00ffe1', 6, 'Sakit 123', '2021-07-06 00:00:00', '2021-07-06 00:00:00');

-- ----------------------------
-- Table structure for z_r_izin_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_izin_url`;
CREATE TABLE `z_r_izin_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_IZIN` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  UNIQUE INDEX `idx_r_izin_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_izin_url
-- ----------------------------
INSERT INTO `z_r_izin_url` VALUES ('1e1d0149-e541-11eb-a65f-00ffe1', 1, '0_60EFE86B29E35_20210715094859_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('29867cc5-ea01-11eb-99b8-00ffe1', 1, '0_60F7E09928680_20210721105345_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('3457f264-e540-11eb-a65f-00ffe1', 1, '0_60EFE6E2ED2E7_20210715094226_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('3F8D04.IZ.07.2020.000001', 1, '0_5F08600815996_20200710193312_A001_3F8D04.png');
INSERT INTO `z_r_izin_url` VALUES ('3F8D04.IZ.07.2020.000002', 1, '0_5F08604C1741D_20200710193420_A001_3F8D04.png');
INSERT INTO `z_r_izin_url` VALUES ('8180e6cd-e53e-11eb-a65f-00ffe1', 1, '0_60EFE4096949D_20210715093017_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('84076fb1-e53c-11eb-a65f-00ffe1', 1, '0_60EFE0B28D296_20210715091602_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('a5dd8b7c-e53f-11eb-a65f-00ffe1', 1, '0_60EFE5F3E3BB7_20210715093827_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE1.IZ.05.2020.000001', 1, 'ABCDE1.IZ.05.2020.000001_5EB5207817F06_20200508160352_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE1.IZ.05.2020.000002', 1, 'ABCDE1.IZ.05.2020.000002_5EB28915DAD1B_20200506165325_201609002_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE1.IZ.05.2020.000002', 2, 'ABCDE1.IZ.05.2020.000002_5EB28915E2E31_20200506165325_201609002_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE1.IZ.05.2020.000002', 3, 'ABCDE1.IZ.05.2020.000002_5EC4C6AF73893_20200520125703_201609002_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE1.IZ.05.2020.000004', 1, '0_5ECDCF84F3311_20200527092508_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE1.IZ.05.2020.000004', 2, '0_5ECDCF84F2845_20200527092508_201609006_ABCDE1.png');
INSERT INTO `z_r_izin_url` VALUES ('ABCDE2.IZ.06.2020.000001', 1, 'ABCDE2.IZ.06.2020.000001_5EF1B2AA10C47_20200623144338_1001_ABCDE2.png');
INSERT INTO `z_r_izin_url` VALUES ('ef5caa42-e53f-11eb-a65f-00ffe1', 1, '0_60EFE66F3AA2E_20210715094031_201609006_ABCDE1.png');

-- ----------------------------
-- Table structure for z_r_jalandinas
-- ----------------------------
DROP TABLE IF EXISTS `z_r_jalandinas`;
CREATE TABLE `z_r_jalandinas`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NM_PEJABAT` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `JABATAN` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TUJUAN` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `KEPERLUAN` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TGL_BRKT` datetime(0) NOT NULL,
  `TGL_PLNG` datetime(0) NOT NULL,
  `ALL_BDGJKT` tinyint(4) NULL DEFAULT NULL,
  `ALL_LR_KOTA` tinyint(4) NULL DEFAULT NULL,
  `ALL_LR_NEGERI` tinyint(4) NULL DEFAULT NULL,
  `TR_K_PRIBADI` tinyint(4) NULL DEFAULT NULL,
  `TR_K_DINAS` tinyint(4) NULL DEFAULT NULL,
  `TR_KA` tinyint(4) NULL DEFAULT NULL,
  `TR_PESAWAT` tinyint(4) NULL DEFAULT NULL,
  `TR_TRAVEL` tinyint(4) NULL DEFAULT NULL,
  `TR_BUS` tinyint(4) NULL DEFAULT NULL,
  `AK_HOTEL` tinyint(4) NULL DEFAULT NULL,
  `AK_HOTEL_NOM` bigint(20) NULL DEFAULT NULL,
  `AK_HOTEL_KET` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `AK_TR_LOC` tinyint(4) NULL DEFAULT NULL,
  `AK_TR_LOC_NOM` bigint(20) NULL DEFAULT NULL,
  `AK_TR_LOC_KET` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `AK_SUSP` tinyint(4) NULL DEFAULT NULL,
  `AK_SUSP_NOM` bigint(20) NULL DEFAULT NULL,
  `AK_SUSP_KET` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID_AJU`) USING BTREE,
  UNIQUE INDEX `idx_r_jalandinas`(`ID_AJU`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_jalandinas
-- ----------------------------
INSERT INTO `z_r_jalandinas` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', 'Abdul Azis', 'Direktur Utama', 'Banten - Singapore - Amerika - Arab', 'Berguru', '2021-07-13 00:00:00', '2021-07-13 00:00:00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 5000000, 'Hotel', 1, 1000000, 'Transport', 1, 10000000, 'Suspense');
INSERT INTO `z_r_jalandinas` VALUES ('ABCDE1.PD.05.2020.000001', 'Agung Sulaksana', 'Programmer', 'Singapore', 'Meeting', '2020-05-13 00:00:00', '2020-05-13 00:00:00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4000000, 'Tes1', 1, 500000, 'Tes2', 1, 400000, 'Keterangan');

-- ----------------------------
-- Table structure for z_r_jalandinas_peserta
-- ----------------------------
DROP TABLE IF EXISTS `z_r_jalandinas_peserta`;
CREATE TABLE `z_r_jalandinas_peserta`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_AJU`, `NIK`, `COMP_CODE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_jalandinas_peserta
-- ----------------------------
INSERT INTO `z_r_jalandinas_peserta` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', '201609005', 'ABCDE1', 1);

-- ----------------------------
-- Table structure for z_r_jalandinas_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_jalandinas_url`;
CREATE TABLE `z_r_jalandinas_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_JALANDINAS` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  UNIQUE INDEX `idx_r_jalandinas_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_jalandinas_url
-- ----------------------------
INSERT INTO `z_r_jalandinas_url` VALUES ('1f5020a5-e542-11eb-a65f-00ffe1', 1, '1f5020a5-e542-11eb-a65f-00ffe1_60EFEF7AE65DB_20210715101906_201609006_ABCDE1.png');

-- ----------------------------
-- Table structure for z_r_laporan_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_laporan_url`;
CREATE TABLE `z_r_laporan_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_IZIN` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  UNIQUE INDEX `idx_r_izin_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_laporan_url
-- ----------------------------
INSERT INTO `z_r_laporan_url` VALUES ('3F8D04.LP.07.2020.000003', 1, '3F8D04.LP.07.2020.000003_5F0860C1931A4_20200710193617_A001_3F8D04.png');
INSERT INTO `z_r_laporan_url` VALUES ('3F8D04.LP.07.2020.000003', 2, '0_5F086084B03B2_20200710193516_A001_3F8D04.png');
INSERT INTO `z_r_laporan_url` VALUES ('3F8D04.LP.07.2020.000004', 1, 'LH_5F0844DF6FF14_20200710173719_A001_3F8D04.png');
INSERT INTO `z_r_laporan_url` VALUES ('9448233a-e54e-11eb-a65f-00ffe1', 1, '0_60EFFF0081779_20210715112520_201609006_ABCDE1.png');
INSERT INTO `z_r_laporan_url` VALUES ('ABCDE1.LP.07.2020.000001', 1, 'IZIN_5F06BE3B161C1_20200709135035_1_ABCDE1.png');
INSERT INTO `z_r_laporan_url` VALUES ('ABCDE1.LP.07.2020.000002', 1, 'LH_5F06C7ACE1E81_20200709143052_201609006_ABCDE1.png');
INSERT INTO `z_r_laporan_url` VALUES ('fc288008-eb6d-11eb-82e0-00ffe1', 1, '0_60FA44ACC9DA2_20210723062516_201609006_ABCDE1.jpg');

-- ----------------------------
-- Table structure for z_r_lembur_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_lembur_url`;
CREATE TABLE `z_r_lembur_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_LEMBUR` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  UNIQUE INDEX `idx_r_izin_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_lembur_url
-- ----------------------------
INSERT INTO `z_r_lembur_url` VALUES ('3f86446f-eb9a-11eb-82e0-00ffe12eb819', 1, '60FA8EEFB02CD_20210723114207_201609005_ABCDE1.png');
INSERT INTO `z_r_lembur_url` VALUES ('c1062270-eb6e-11eb-82e0-00ffe12eb819', 1, '60FA45F7243AD_20210723063047_201609006_ABCDE1.jpg');
INSERT INTO `z_r_lembur_url` VALUES ('d9ba2829-e54d-11eb-a65f-00ffe12eb819', 1, '60EFFDC7D5087_20210715112007_201609006_ABCDE1.png');

-- ----------------------------
-- Table structure for z_r_obat
-- ----------------------------
DROP TABLE IF EXISTS `z_r_obat`;
CREATE TABLE `z_r_obat`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA_KUITANSI` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_KUITANSI` datetime(0) NOT NULL,
  `DIAGNOSA` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOM_KUITANSI` decimal(20, 0) NOT NULL,
  `NILAI_DIGANTI` decimal(20, 0) NOT NULL,
  PRIMARY KEY (`ID_AJU`) USING BTREE,
  UNIQUE INDEX `idx_r_obat`(`ID_AJU`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_obat
-- ----------------------------
INSERT INTO `z_r_obat` VALUES ('ABCDE1.FR.05.2020.000001', '0', '2020-05-12 00:00:00', 'TEst', 400000, 0);
INSERT INTO `z_r_obat` VALUES ('ABCDE1.PO.05.2020.000001', '0', '2020-05-04 00:00:00', 'Sakit', 400000, 0);
INSERT INTO `z_r_obat` VALUES ('ABCDE1.PO.05.2020.000002', '0', '2020-05-04 00:00:00', 'Sakit', 200000, 0);
INSERT INTO `z_r_obat` VALUES ('ABCDE1.PO.06.2020.000001', 'Nuriyanto', '2020-06-22 00:00:00', 'Sakit deman', 100000, 100000);
INSERT INTO `z_r_obat` VALUES ('d40a5aa0-e541-11eb-a65f-00ffe1', '3', '2021-07-01 00:00:00', 'Beli frame', 500000, 0);

-- ----------------------------
-- Table structure for z_r_obat_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_obat_url`;
CREATE TABLE `z_r_obat_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` int(11) NOT NULL,
  `URL_ATC_OBAT` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  INDEX `idx_r_obat_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_obat_url
-- ----------------------------
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.FR.05.2020.000001', 1, 'ABCDE1.FR.05.2020.000001_5EDA06599AEC6_20200605154617_201609006_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.PO.05.2020.000001', 1, '0_5EB8CD318DD3A_20200511105737_201609006_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.PO.05.2020.000001', 2, 'ABCDE1.PO.05.2020.000001_5EB8D0C631027_20200511111254_201609006_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.PO.05.2020.000002', 1, 'ABCDE1.PO.05.2020.000002_5EB8D1D78E357_20200511111727_201609002_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.PO.05.2020.000002', 2, 'ABCDE1.PO.05.2020.000002_5EB8D1D788577_20200511111727_201609002_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.PO.05.2020.000002', 3, 'ABCDE1.PO.05.2020.000002_5EB8D1D787642_20200511111727_201609002_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('ABCDE1.PO.06.2020.000001', 1, 'PENGOBATAN_5EF01A4B1C2D0_20200622094115_201609006_ABCDE1.png');
INSERT INTO `z_r_obat_url` VALUES ('d40a5aa0-e541-11eb-a65f-00ffe1', 1, '0_60EFE99C0C8F2_20210715095404_201609006_ABCDE1.png');

-- ----------------------------
-- Table structure for z_r_training
-- ----------------------------
DROP TABLE IF EXISTS `z_r_training`;
CREATE TABLE `z_r_training`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NM_TRAINING` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NM_LEMBAGA` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TEMPAT_TR` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGL_START_TR` datetime(0) NOT NULL,
  `TGL_END_TR` datetime(0) NOT NULL,
  `CATATAN` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID_AJU`) USING BTREE,
  INDEX `idx_z_r_training`(`ID_AJU`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_training
-- ----------------------------
INSERT INTO `z_r_training` VALUES ('ABCDE1.TR.05.2020.000001', 'Training iOS', 'PT. MItra Sinerji Teknoindo', 'Bandung', '2020-05-12 00:00:00', '2020-05-13 00:00:00', '');

-- ----------------------------
-- Table structure for z_r_training_url
-- ----------------------------
DROP TABLE IF EXISTS `z_r_training_url`;
CREATE TABLE `z_r_training_url`  (
  `ID_AJU` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQ_ATC` double NOT NULL,
  `URL_ATC_TRAINING` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_AJU`, `SEQ_ATC`) USING BTREE,
  INDEX `idx_z_r_training_url`(`ID_AJU`, `SEQ_ATC`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_r_training_url
-- ----------------------------
INSERT INTO `z_r_training_url` VALUES ('ABCDE1.TR.05.2020.000001', 1, 'ABCDE1.TR.05.2020.000001_5EC4CC583BDDE_20200520132112_201609006_ABCDE1.png');
INSERT INTO `z_r_training_url` VALUES ('ABCDE1.TR.05.2020.000001', 2, 'ABCDE1.TR.05.2020.000001_5EC4CACC3F444_20200520131436_201609006_ABCDE1.png');
INSERT INTO `z_r_training_url` VALUES ('ABCDE1.TR.05.2020.000001', 3, '0_5EC4A52054AD1_20200520103352_201609006_ABCDE1.png');
INSERT INTO `z_r_training_url` VALUES ('ABCDE1.TR.05.2020.000001', 4, 'ABCDE1.TR.05.2020.000001_5EC4CAD763B23_20200520131447_201609006_ABCDE1.png');

-- ----------------------------
-- Table structure for z_relasi_kel
-- ----------------------------
DROP TABLE IF EXISTS `z_relasi_kel`;
CREATE TABLE `z_relasi_kel`  (
  `RELASI_KEL` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DESC_RELASI` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`RELASI_KEL`) USING BTREE,
  INDEX `idx_relasi_keluarga`(`RELASI_KEL`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_relasi_kel
-- ----------------------------
INSERT INTO `z_relasi_kel` VALUES ('1', 'SUAMI');
INSERT INTO `z_relasi_kel` VALUES ('2', 'ISTRI');
INSERT INTO `z_relasi_kel` VALUES ('3', 'ANAK');
INSERT INTO `z_relasi_kel` VALUES ('4', 'AYAH');
INSERT INTO `z_relasi_kel` VALUES ('5', 'IBU');
INSERT INTO `z_relasi_kel` VALUES ('6', 'KAKAK');
INSERT INTO `z_relasi_kel` VALUES ('7', 'ADIK');

-- ----------------------------
-- Table structure for z_religion
-- ----------------------------
DROP TABLE IF EXISTS `z_religion`;
CREATE TABLE `z_religion`  (
  `RELIGION_ID` tinyint(1) NOT NULL,
  `AGAMA` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`RELIGION_ID`) USING BTREE,
  INDEX `idx_z_religion`(`RELIGION_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_religion
-- ----------------------------
INSERT INTO `z_religion` VALUES (1, 'ISLAM');
INSERT INTO `z_religion` VALUES (2, 'KRISTEN PROTESTAN');
INSERT INTO `z_religion` VALUES (3, 'KRISTEN KATOLIK');
INSERT INTO `z_religion` VALUES (4, 'BUDHA');
INSERT INTO `z_religion` VALUES (5, 'HINDU');
INSERT INTO `z_religion` VALUES (6, 'KONGHUCU');

-- ----------------------------
-- Table structure for z_role
-- ----------------------------
DROP TABLE IF EXISTS `z_role`;
CREATE TABLE `z_role`  (
  `TINGKAT` double NOT NULL,
  `COMP_CODE` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA_ROLE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`TINGKAT`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_role
-- ----------------------------
INSERT INTO `z_role` VALUES (0, 'TRNT', 'ADMIN_ALL');
INSERT INTO `z_role` VALUES (1, 'TRNT', 'ADMIN_READ');
INSERT INTO `z_role` VALUES (2, 'TRNT', 'TC_HC');
INSERT INTO `z_role` VALUES (3, 'TRNT', 'TC_HC_READ');
INSERT INTO `z_role` VALUES (4, 'TRNT', 'DIR_TRNT');
INSERT INTO `z_role` VALUES (5, 'TRNT', 'HC_TRNT');
INSERT INTO `z_role` VALUES (6, 'TRNT', 'USER_TRNT');
INSERT INTO `z_role` VALUES (7, 'TI', 'DIR_TI');
INSERT INTO `z_role` VALUES (8, 'TI', 'HC_TI');
INSERT INTO `z_role` VALUES (9, 'TI', 'USER_TI');
INSERT INTO `z_role` VALUES (10, 'TTI', 'DIR_TTI');
INSERT INTO `z_role` VALUES (11, 'TTI', 'HC_TTI');
INSERT INTO `z_role` VALUES (12, 'TTI', 'USER_TTI');
INSERT INTO `z_role` VALUES (13, 'MIDO', 'DIR_MIDO');
INSERT INTO `z_role` VALUES (14, 'MIDO', 'HC_MIDO');
INSERT INTO `z_role` VALUES (15, 'MIDO', 'USER_MIDO');
INSERT INTO `z_role` VALUES (16, 'TRSC', 'DIR_TRISCO');
INSERT INTO `z_role` VALUES (17, 'TRSC', 'HC_TRISCO');
INSERT INTO `z_role` VALUES (18, 'TRSC', 'USER_TRISCO');
INSERT INTO `z_role` VALUES (19, 'TMSB', 'DIR_TRIMAS');
INSERT INTO `z_role` VALUES (20, 'TMSB', 'HC_TRIMAS');
INSERT INTO `z_role` VALUES (21, 'TMSB', 'USER_TRIMAS');
INSERT INTO `z_role` VALUES (22, 'CINT', 'DIR_CHITOSE');
INSERT INTO `z_role` VALUES (23, 'CINT', 'HC_CHITOSE');
INSERT INTO `z_role` VALUES (24, 'CINT', 'USER_CHITOSE');

-- ----------------------------
-- Table structure for z_role_det
-- ----------------------------
DROP TABLE IF EXISTS `z_role_det`;
CREATE TABLE `z_role_det`  (
  `TINGKAT` double NOT NULL,
  `COMP_CODE` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ID_GROUP_MENU` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`TINGKAT`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_role_det
-- ----------------------------
INSERT INTO `z_role_det` VALUES (0, 'ALL', '1');
INSERT INTO `z_role_det` VALUES (1, 'ALL', '2');
INSERT INTO `z_role_det` VALUES (2, 'ALL', '3');
INSERT INTO `z_role_det` VALUES (3, 'ALL', '4');
INSERT INTO `z_role_det` VALUES (4, 'TRNT', '4');
INSERT INTO `z_role_det` VALUES (5, 'TRNT', '3');
INSERT INTO `z_role_det` VALUES (6, 'TRNT', '5');
INSERT INTO `z_role_det` VALUES (7, 'TI', '4');
INSERT INTO `z_role_det` VALUES (8, 'TI', '3');
INSERT INTO `z_role_det` VALUES (9, 'TI', '5');
INSERT INTO `z_role_det` VALUES (10, 'TTI', '4');
INSERT INTO `z_role_det` VALUES (11, 'TTI', '3');
INSERT INTO `z_role_det` VALUES (12, 'TTI', '5');
INSERT INTO `z_role_det` VALUES (13, 'MIDO', '4');
INSERT INTO `z_role_det` VALUES (14, 'MIDO', '3');
INSERT INTO `z_role_det` VALUES (15, 'MIDO', '5');
INSERT INTO `z_role_det` VALUES (16, 'TRSC', '4');
INSERT INTO `z_role_det` VALUES (17, 'TRSC', '3');
INSERT INTO `z_role_det` VALUES (18, 'TRSC', '5');
INSERT INTO `z_role_det` VALUES (19, 'TMSB', '4');
INSERT INTO `z_role_det` VALUES (20, 'TMSB', '3');
INSERT INTO `z_role_det` VALUES (21, 'TMSB', '5');
INSERT INTO `z_role_det` VALUES (22, 'CINT', '4');
INSERT INTO `z_role_det` VALUES (23, 'CINT', '3');
INSERT INTO `z_role_det` VALUES (24, 'CINT', '5');

-- ----------------------------
-- Table structure for z_setting_periode
-- ----------------------------
DROP TABLE IF EXISTS `z_setting_periode`;
CREATE TABLE `z_setting_periode`  (
  `ID_MENU` int(11) NOT NULL,
  `COMPID` int(11) NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `START_DATE` datetime(0) NULL DEFAULT NULL,
  `END_DATE` datetime(0) NULL DEFAULT NULL,
  `REMARK` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`ID_MENU`, `COMPID`, `COMP_CODE`) USING BTREE,
  INDEX `idx_z_setting_periode`(`ID_MENU`, `COMPID`, `COMP_CODE`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_setting_periode
-- ----------------------------
INSERT INTO `z_setting_periode` VALUES (1, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Absensi', 1);
INSERT INTO `z_setting_periode` VALUES (1, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Absensi', 1);
INSERT INTO `z_setting_periode` VALUES (1, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Absensi', 1);
INSERT INTO `z_setting_periode` VALUES (2, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Izin', 1);
INSERT INTO `z_setting_periode` VALUES (2, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Izin', 1);
INSERT INTO `z_setting_periode` VALUES (2, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Izin', 1);
INSERT INTO `z_setting_periode` VALUES (3, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Cuti', 1);
INSERT INTO `z_setting_periode` VALUES (3, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Cuti', 1);
INSERT INTO `z_setting_periode` VALUES (3, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Cuti', 1);
INSERT INTO `z_setting_periode` VALUES (4, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Pengobatan', 1);
INSERT INTO `z_setting_periode` VALUES (4, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Pengobatan', 1);
INSERT INTO `z_setting_periode` VALUES (4, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Pengobatan', 1);
INSERT INTO `z_setting_periode` VALUES (5, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Penggantian Biaya', 1);
INSERT INTO `z_setting_periode` VALUES (5, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Penggantian Biaya', 1);
INSERT INTO `z_setting_periode` VALUES (5, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Penggantian Biaya', 1);
INSERT INTO `z_setting_periode` VALUES (6, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Dinas', 1);
INSERT INTO `z_setting_periode` VALUES (6, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Dinas', 1);
INSERT INTO `z_setting_periode` VALUES (6, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Dinas', 1);
INSERT INTO `z_setting_periode` VALUES (7, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Pelatihan', 1);
INSERT INTO `z_setting_periode` VALUES (7, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Pelatihan', 1);
INSERT INTO `z_setting_periode` VALUES (7, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Pelatihan', 1);
INSERT INTO `z_setting_periode` VALUES (8, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Daftar Pengajuan', 1);
INSERT INTO `z_setting_periode` VALUES (8, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Daftar Pengajuan', 1);
INSERT INTO `z_setting_periode` VALUES (8, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Daftar Pengajuan', 1);
INSERT INTO `z_setting_periode` VALUES (9, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Riwayat Pengajuan', 1);
INSERT INTO `z_setting_periode` VALUES (9, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Riwayat Pengajuan', 1);
INSERT INTO `z_setting_periode` VALUES (9, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Riwayat Pengajuan', 1);
INSERT INTO `z_setting_periode` VALUES (10, 1, 'ABCDE1', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Notifikasi', 1);
INSERT INTO `z_setting_periode` VALUES (10, 2, 'ABCDE2', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Notifikasi', 1);
INSERT INTO `z_setting_periode` VALUES (10, 3, '3F8D04', '2021-01-01 00:00:00', '2021-12-31 23:59:59', 'Notifikasi', 1);

-- ----------------------------
-- Table structure for z_time_code
-- ----------------------------
DROP TABLE IF EXISTS `z_time_code`;
CREATE TABLE `z_time_code`  (
  `TIME_CODE` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIMENAME` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_time_code
-- ----------------------------
INSERT INTO `z_time_code` VALUES ('CM01', 'HARI LIBUR');
INSERT INTO `z_time_code` VALUES ('PH01', 'PINDAH HARI KERJA');
INSERT INTO `z_time_code` VALUES ('LB01', 'LIBUR HARI KEMERDEKAAN');
INSERT INTO `z_time_code` VALUES ('LB02', 'LIBUR HARI RAYA IDUL FITRI');

-- ----------------------------
-- Table structure for z_time_profile
-- ----------------------------
DROP TABLE IF EXISTS `z_time_profile`;
CREATE TABLE `z_time_profile`  (
  `ID_TP` bigint(20) NOT NULL AUTO_INCREMENT,
  `COMPID` int(11) NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DESKRIPSI` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HARI_1` tinyint(1) NOT NULL,
  `HARI_1_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_1_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `HARI_2` tinyint(1) NOT NULL,
  `HARI_2_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_2_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `HARI_3` tinyint(1) NOT NULL,
  `HARI_3_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_3_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `HARI_4` tinyint(1) NOT NULL,
  `HARI_4_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_4_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `HARI_5` tinyint(1) NOT NULL,
  `HARI_5_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_5_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `HARI_6` tinyint(1) NOT NULL,
  `HARI_6_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_6_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `HARI_7` tinyint(1) NOT NULL,
  `HARI_7_JAM_IN` datetime(0) NULL DEFAULT NULL,
  `HARI_7_JAM_OUT` datetime(0) NULL DEFAULT NULL,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  `TYPE_HARI` int(1) NULL DEFAULT 1,
  `JML_JAM_ISTIRAHAT` int(3) NULL DEFAULT NULL,
  `BATAS_JAM_MASUK` int(3) NULL DEFAULT NULL,
  `BATAS_JAM_PULANG` int(3) NULL DEFAULT NULL,
  `TOLERANSI_TELAT` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_TP`, `COMPID`, `COMP_CODE`) USING BTREE,
  INDEX `idx_z_time_profile`(`ID_TP`, `COMPID`, `COMP_CODE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_time_profile
-- ----------------------------
INSERT INTO `z_time_profile` VALUES (1, 1, 'ABCDE1', 'Time Profile MST', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 00:01:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 1, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (2, 2, 'ABCDE2', 'Time Profile IDR', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 00:01:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 1, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (3, 3, '3F8D04', 'Time Profile Presensi', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 00:01:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 1, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (4, 4, 'C824E1', 'Jadwal Kerja IBP 08:00 s/d 16:00 (8 Jam)', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 00:01:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 17:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 1, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (5, 4, 'C824E1', 'Jadwal Kerja IBP 08:00 s/d 19:00 (12 Jam)', 1, '1900-01-01 08:00:00', '1900-01-01 19:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 19:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 19:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 19:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 19:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 1, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (6, 4, 'C824E1', 'Jadwal Kerja IBP 16:00 s/d 08:00 (16 Jam)', 1, '1900-01-01 16:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 16:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 16:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 16:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 16:00:00', '1900-01-01 08:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 2, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (7, 4, 'C824E1', 'Jadwal Kerja IBP 19:00 s/d 08:00 (12 Jam)', 1, '1900-01-01 19:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 19:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 19:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 19:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 19:00:00', '1900-01-01 08:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 2, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (8, 4, 'C824E1', 'Jadwal Kerja IBP 08:00 s/d 08:00 (24 Jam)', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 2, 60, 240, 210, 60);
INSERT INTO `z_time_profile` VALUES (9, 1, 'ABCDE1', 'Jadwal Kerja MST 08:00 s/d 08:00 (24 Jam)', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 1, '1900-01-01 08:00:00', '1900-01-01 08:00:00', 0, NULL, NULL, 0, NULL, NULL, 1, 1, 60, 240, 210, 60);

-- ----------------------------
-- Table structure for z_tp_person
-- ----------------------------
DROP TABLE IF EXISTS `z_tp_person`;
CREATE TABLE `z_tp_person`  (
  `TP_SEQ` int(11) NOT NULL,
  `ID_TP` int(11) NOT NULL,
  `COMPID` int(11) NOT NULL,
  `COMP_CODE` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIK` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TP_START_DATE` datetime(0) NOT NULL,
  `TP_END_DATE` datetime(0) NOT NULL,
  `CREATED_BY` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_DATE` datetime(0) NOT NULL,
  `ACTIVE` tinyint(4) NULL DEFAULT 1,
  `TOKEN` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`TP_SEQ`, `ID_TP`, `COMPID`, `COMP_CODE`, `NIK`) USING BTREE,
  UNIQUE INDEX `idx_tp_person`(`TP_SEQ`, `ID_TP`, `COMPID`, `COMP_CODE`, `NIK`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_tp_person
-- ----------------------------
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609001', '1990-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-02-19 10:42:59', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609002', '1990-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-02-19 10:43:09', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609003', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609004', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609005', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-02-20 13:38:27', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609006', '2020-04-01 00:00:00', '2020-12-06 00:00:00', '2', '2020-06-22 16:32:11', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609007', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201609008', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201706001', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '2', '2021-07-12 08:12:14', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201706003', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201706004', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201805002', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201807001', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201810001', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 1, 1, 'ABCDE1', '201904002', '1900-01-01 00:00:00', '9999-12-31 00:00:00', '1', '2020-01-01 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1001', '2020-01-01 00:00:00', '9999-12-31 00:00:00', '2', '2020-06-23 13:50:17', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1002', '2020-01-01 00:00:00', '2020-12-31 00:00:00', '2', '2020-06-24 20:35:59', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1003', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1004', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1005', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1006', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1007', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1008', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1009', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1010', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1011', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1012', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1013', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1014', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1015', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1016', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1017', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1018', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1019', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1020', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1021', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1022', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1023', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1024', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1025', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1026', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 2, 2, 'ABCDE2', '1027', '2020-01-01 14:34:54', '2020-12-31 23:55:54', '2', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (1, 3, 3, '3F8D04', 'A001', '2020-01-01 00:00:00', '2020-12-31 00:00:00', '2', '2020-07-10 17:27:37', 1, NULL);
INSERT INTO `z_tp_person` VALUES (2, 9, 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (2, 9, 1, 'ABCDE1', '2016090006', '2020-12-07 13:59:27', '9999-12-31 00:00:00', '', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `z_tp_person` VALUES (2, 9, 1, 'ABCDE1', '201609006', '2020-12-06 00:00:00', '9999-12-31 00:00:00', '2', '2020-12-07 14:00:45', 1, NULL);

-- ----------------------------
-- Table structure for z_unit
-- ----------------------------
DROP TABLE IF EXISTS `z_unit`;
CREATE TABLE `z_unit`  (
  `unitId` bigint(20) NOT NULL AUTO_INCREMENT,
  `unitCode` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `unitName` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `unitAlias` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `parentUnitId` bigint(20) NULL DEFAULT NULL,
  `defPositionId` int(11) NULL DEFAULT NULL,
  `siteId` int(11) NULL DEFAULT 1,
  `active` int(11) NULL DEFAULT 1,
  `unitCodeDsm` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `COMPID` int(11) NULL DEFAULT NULL,
  `costcenter_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`unitId`) USING BTREE,
  UNIQUE INDEX `idx_unitid`(`unitId`) USING BTREE,
  INDEX `idx_parentunitid`(`parentUnitId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of z_unit
-- ----------------------------
INSERT INTO `z_unit` VALUES (1, '10000001', 'Departemen Produksi', '10000001', NULL, 1, 1, 1, NULL, 1, 'E007020005');
INSERT INTO `z_unit` VALUES (2, '10000002', 'Departemen Marketing', '10000002', 1, 1, 1, 1, NULL, 1, 'E007020005');
INSERT INTO `z_unit` VALUES (3, '10000003', 'Departemen Admintrasi', '10000003', 1, 1, 1, 1, NULL, 1, 'E007020005');
INSERT INTO `z_unit` VALUES (4, '1000', 'Dept. Penjualan', '1000', NULL, 1, 1, 1, NULL, 2, NULL);
INSERT INTO `z_unit` VALUES (5, '1001', 'Bag. Digital Marketing', '1001', 4, 1, 1, 1, NULL, 2, NULL);
INSERT INTO `z_unit` VALUES (6, '2000', 'Bag. HRD', '2000', NULL, NULL, 1, 1, NULL, 2, NULL);
INSERT INTO `z_unit` VALUES (7, '10000', 'Nama Divisi Perusahaan', '10000', NULL, NULL, 1, 1, NULL, 3, NULL);

-- ----------------------------
-- Table structure for z_unit_acting_as
-- ----------------------------
DROP TABLE IF EXISTS `z_unit_acting_as`;
CREATE TABLE `z_unit_acting_as`  (
  `actingAsId` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date NULL DEFAULT NULL,
  `endDate` date NULL DEFAULT NULL,
  `unitId` bigint(20) NULL DEFAULT NULL,
  `positionId` int(11) NULL DEFAULT NULL,
  `actingUserId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`actingAsId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- View structure for pre_v_sec_user
-- ----------------------------
DROP VIEW IF EXISTS `pre_v_sec_user`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `pre_v_sec_user` AS SELECT
	`pre_sec_user`.`id` AS `id`,
	`pre_sec_user`.`empId` AS `empId`,
	`pre_sec_user`.`compId` AS `compId`,
	`pre_sec_user`.`username` AS `username`,
	`pre_sec_user`.`full_name` AS `full_name`,
	ifnull(
		`z_v_unit_acting_as`.`full_name`,
		`pre_sec_user`.`full_name`
	) AS `userFullName`,
	ifnull(
		`z_v_unit_acting_as`.`email`,
		`pre_sec_user`.`email`
	) AS `email`,
	`pre_sec_user`.`password` AS `password`,
	`pre_sec_user`.`created_date` AS `created_date`,
	`pre_sec_user`.`last_login` AS `last_login`,
	`pre_sec_user`.`ip_address` AS `ip_address`,
	`pre_sec_user`.`current_login` AS `current_login`,
	`pre_sec_user`.`salt` AS `salt`,
	`pre_sec_user`.`activation_code` AS `activation_code`,
	`pre_sec_user`.`forgotten_password_code` AS `forgotten_password_code`,
	`pre_sec_user`.`forgotten_password_time` AS `forgotten_password_time`,
	`pre_sec_user`.`remember_code` AS `remember_code`,
	`pre_sec_user`.`unitId` AS `unitId`,
	`z_v_unit`.`unitCode` AS `unitCode`,
	`z_v_unit`.`unitName` AS `unitName`,
	`z_v_unit`.`unitAlias` AS `unitAlias`,
	`z_v_unit`.`parentUnitCode` AS `parentUnitCode`,
	`z_v_unit`.`parentUnitName` AS `parentUnitName`,
	`z_v_unit`.`parentUnitAlias` AS `parentUnitAlias`,
	`z_v_unit`.`siteId` AS `siteId`,
	`pre_site`.`siteCode` AS `siteCode`,
	`pre_site`.`siteName` AS `siteName`,
	`z_v_unit`.`parentUnitId` AS `parentUnitId`,
	`z_compcode`.`COMP_CODE` AS `compCode`,
	`z_compcode`.`COMP_NAME` AS `compName`,
	`pre_sec_user`.`positionId` AS `positionId`,
	`z_position`.`positionName` AS `positionName`,
	`pre_sec_user`.`photo` AS `photo`,
	`pre_sec_user`.`phone` AS `phone`,
	`pre_sec_user`.`nik` AS `nik`,
	`pre_sec_user`.`represent` AS `represent`,
	`pre_sec_user`.`representUnitId` AS `representUnitId`,
	`z_v_unit_1`.`unitCode` AS `representUnitCode`,
	`z_v_unit_1`.`unitName` AS `representUnitName`,
	`pre_sec_user`.`representPositionId` AS `representPositionId`,
	`z_position_1`.`positionName` AS `representPositionName`,
	`pre_sec_user`.`active` AS `active`,
	`z_position`.`positionType` AS `positionType`,
	`z_position`.`positionLevel` AS `positionLevel`,
	ifnull(
		`z_v_unit_acting_as`.`prefix`,
		`pre_sec_user`.`prefix`
	) AS `prefix`,
	concat_ws(
		' - ',
		`z_v_unit`.`unitCode`,
		`z_v_unit`.`unitName`
	) AS `positionUnit`,
	`pre_sec_user`.`dt_superadmin` AS `dt_superadmin`,
	`pre_sec_user`.`dt_admin` AS `dt_admin`,
	`pre_sec_user`.`dt_user` AS `dt_user`,
	`z_position_employee`.`position_desc` AS `positionDesc`,
	`z_karyawan`.`position_code` AS `positionCode`,
	ifnull(
		`z_v_unit_acting_as`.`actingAsId`,
		0
	) AS `actingAsId`,
	ifnull(
		`z_v_unit_acting_as`.`actingUserId`,
		0
	) AS `actingUserId`,
	`pre_sec_user`.`lastNoSuratReg` AS `lastNoSuratReg`
FROM
	(
		(
			(
				(
					(
						(
							(
								(
									(
										`pre_sec_user`
										LEFT JOIN `z_v_unit` ON (
											(
												`z_v_unit`.`unitId` = `pre_sec_user`.`unitId`
											)
										)
									)
									LEFT JOIN `z_position` ON (
										(
											`z_position`.`positionId` = `pre_sec_user`.`positionId`
										)
									)
								)
								LEFT JOIN `z_v_unit` `z_v_unit_1` ON (
									(
										`z_v_unit_1`.`unitId` = `pre_sec_user`.`representUnitId`
									)
								)
							)
							LEFT JOIN `z_position` `z_position_1` ON (
								(
									`z_position_1`.`positionId` = `pre_sec_user`.`representPositionId`
								)
							)
						)
						LEFT JOIN `pre_site` ON (
							(
								`z_v_unit`.`siteId` = `pre_site`.`siteId`
							)
						)
					)
					LEFT JOIN `z_compcode` ON (
						(
							`pre_sec_user`.`compId` = `z_compcode`.`compId`
						)
					)
				)
				LEFT JOIN `z_v_unit_acting_as` ON (
					(
						(
							`pre_sec_user`.`unitId` = `z_v_unit_acting_as`.`unitId`
						)
						AND (
							`pre_sec_user`.`positionId` = `z_v_unit_acting_as`.`positionId`
						)
						AND (
							curdate() BETWEEN `z_v_unit_acting_as`.`startDate`
							AND `z_v_unit_acting_as`.`endDate`
						)
					)
				)
			)
			LEFT JOIN `z_karyawan` ON (
				(
					`pre_sec_user`.`nik` = `z_karyawan`.`nik`
				)
			)
		)
		LEFT JOIN `z_position_employee` ON (
			(
				`z_karyawan`.`position_code` = `z_position_employee`.`position_code`
			)
		)
	) ;

-- ----------------------------
-- View structure for v_sec_role_priv
-- ----------------------------
DROP VIEW IF EXISTS `v_sec_role_priv`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_sec_role_priv` AS SELECT
	a.`role_id` AS `role_id`,
	a.`module_id` AS `module_id`,
	a.`allow_view` AS `allow_view`,
	a.`allow_new` AS `allow_new`,
	a.`allow_edit` AS `allow_edit`,
	a.`allow_delete` AS `allow_delete`,
	a.`allow_print` AS `allow_print`,
	b.`module_name` AS `module_name`,
	b.`module_alias` AS `module_alias`,
	b.`module_url` AS `module_url`,
	b.`module_pid` AS `module_pid`,
	b.`mod_icon_cls` AS `mod_icon_cls`,
	b.`mod_seq` AS `mod_seq`,
	b.`publish` AS `publish`,
	b.`mod_group` AS `mod_group`,
	a.`allow_approve` AS `allow_approve`
FROM
	(
		`sec_role_priv` a
		LEFT JOIN `sec_modul` b ON (
			(
				a.`module_id` = b.`module_id`
			)
		)
	) ;

-- ----------------------------
-- View structure for z_view_pengajuan
-- ----------------------------
DROP VIEW IF EXISTS `z_view_pengajuan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `z_view_pengajuan` AS SELECT
A.ID_AJU, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_PENGAJUAN, 
A.NIK, C.NAMA AS NAMA_KARYAWAN, A.STS_AJU, 
CASE A.STS_AJU 
				WHEN 0 THEN 'DIAJUKAN' 
				WHEN 1 THEN 'DISETUJUI' 
				WHEN 2 THEN 'DITOLAK' 
END AS STAT_PENGAJUAN,
CASE A.JNS_AJU 
				WHEN 'IZ' THEN 2
				WHEN 'CT' THEN 3 
				WHEN 'PO' THEN 4
				WHEN 'LS' THEN 4
				WHEN 'FR' THEN 4
				WHEN 'PB' THEN 5
				WHEN 'PD' THEN 6
				WHEN 'TR' THEN 7
				WHEN 'AB' THEN 1 
END AS MENU_ID, 

CASE A.JNS_AJU 
				WHEN 'IZ' THEN DATE_FORMAT(E.TGL_AWAL_IZIN, '%d-%m-%Y')  
				WHEN 'CT' THEN DATE_FORMAT(F.TGL_AWAL_CUTI, '%d-%m-%Y') 
				WHEN 'PO' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'LS' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'FR' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'PB' THEN DATE_FORMAT(G.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'PD' THEN DATE_FORMAT(H.TGL_BRKT, '%d-%m-%Y')
				WHEN 'TR' THEN DATE_FORMAT(J.TGL_START_TR, '%d-%m-%Y')
				WHEN 'AB' THEN DATE_FORMAT(K.TGL_ABS, '%d-%m-%Y') 
END AS TGL_AJU,


CASE A.JNS_AJU 
				WHEN 'IZ' THEN E.TGL_AWAL_IZIN
				WHEN 'CT' THEN F.TGL_AWAL_CUTI
				WHEN 'PO' THEN I.TGL_KUITANSI
				WHEN 'LS' THEN I.TGL_KUITANSI
				WHEN 'FR' THEN I.TGL_KUITANSI
				WHEN 'PB' THEN G.TGL_KUITANSI
				WHEN 'PD' THEN H.TGL_BRKT
				WHEN 'TR' THEN J.TGL_START_TR
				WHEN 'AB' THEN K.TGL_ABS
END AS TGL_AJU_PARAMS,

A.HEAD_TEXT1, A.HEAD_TEXT2,
A.JNS_AJU, B.DESC_AJU, D.NIK_ATASAN, D.NIK_HC, A.COMP_CODE
FROM z_head_aju A
JOIN z_jns_aju B ON A.JNS_AJU=B.JNS_AJU
JOIN z_karyawan C ON A.NIK=C.NIK AND A.COMP_CODE = C.COMP_CODE
JOIN z_personalize D ON A.NIK=D.NIK_STAFF AND A.COMP_CODE = D.COMP_CODE
LEFT JOIN z_r_izin E ON A.ID_AJU=E.ID_AJU
LEFT JOIN z_r_cuti F ON A.ID_AJU=F.ID_AJU
LEFT JOIN z_r_gantib G ON A.ID_AJU=G.ID_AJU
LEFT JOIN z_r_jalandinas H ON A.ID_AJU=H.ID_AJU
LEFT JOIN z_r_obat I ON A.ID_AJU=I.ID_AJU
LEFT JOIN z_r_training J ON A.ID_AJU=J.ID_AJU
LEFT JOIN z_r_absensi K ON A.ID_AJU=K.ID_AJU
WHERE A.STS_AJU =0  AND A.ACTIVE = 1 

UNION 

SELECT 
A.ID_AJU, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_PENGAJUAN, 
A.NIK, C.NAMA AS NAMA_KARYAWAN, A.STS_AJU, 
CASE A.STS_AJU 
				WHEN 0 THEN 'DIAJUKAN' 
				WHEN 1 THEN 'DISETUJUI' 
				WHEN 2 THEN 'DITOLAK' 
END AS STAT_PENGAJUAN,
14 AS MENU_ID, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU,
A.TGL_AJU AS TGL_AJU_PARAMS,
A.HEAD_TEXT1, A.HEAD_TEXT2,
A.JNS_AJU, B.DESC_AJU, D.NIK_ATASAN, F.NIK_HO AS NIK_HC, A.COMP_CODE
FROM z_head_lembur A
JOIN z_jns_aju B ON A.JNS_AJU=B.JNS_AJU
JOIN z_karyawan C ON A.NIK=C.NIK AND A.COMP_CODE = C.COMP_CODE
JOIN z_personalize D ON A.NIK=D.NIK_STAFF AND A.COMP_CODE = D.COMP_CODE
JOIN z_compcode F ON C.COMP_CODE = F.COMP_CODE
WHERE A.STS_AJU = 0 AND A.STS_AJU_HO = 0 AND A.ACTIVE = 1 ;

-- ----------------------------
-- View structure for z_view_pengajuan_copy1
-- ----------------------------
DROP VIEW IF EXISTS `z_view_pengajuan_copy1`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `z_view_pengajuan_copy1` AS SELECT
A.ID_AJU, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_PENGAJUAN, 
A.NIK, C.NAMA AS NAMA_KARYAWAN, A.STS_AJU, 
CASE A.STS_AJU 
				WHEN 0 THEN 'DIAJUKAN' 
				WHEN 1 THEN 'DISETUJUI' 
				WHEN 2 THEN 'DITOLAK' 
END AS STAT_PENGAJUAN,
CASE A.JNS_AJU 
				WHEN 'IZ' THEN 2
				WHEN 'CT' THEN 3 
				WHEN 'PO' THEN 4
				WHEN 'LS' THEN 4
				WHEN 'FR' THEN 4
				WHEN 'PB' THEN 5
				WHEN 'PD' THEN 6
				WHEN 'TR' THEN 7
				WHEN 'AB' THEN 1 
END AS MENU_ID, 

CASE A.JNS_AJU 
				WHEN 'IZ' THEN DATE_FORMAT(E.TGL_AWAL_IZIN, '%d-%m-%Y')  
				WHEN 'CT' THEN DATE_FORMAT(F.TGL_AWAL_CUTI, '%d-%m-%Y') 
				WHEN 'PO' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'LS' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'FR' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'PB' THEN DATE_FORMAT(G.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'PD' THEN DATE_FORMAT(H.TGL_BRKT, '%d-%m-%Y')
				WHEN 'TR' THEN DATE_FORMAT(J.TGL_START_TR, '%d-%m-%Y')
				WHEN 'AB' THEN DATE_FORMAT(K.TGL_ABS, '%d-%m-%Y') 
END AS TGL_AJU,


CASE A.JNS_AJU 
				WHEN 'IZ' THEN E.TGL_AWAL_IZIN
				WHEN 'CT' THEN F.TGL_AWAL_CUTI
				WHEN 'PO' THEN I.TGL_KUITANSI
				WHEN 'LS' THEN I.TGL_KUITANSI
				WHEN 'FR' THEN I.TGL_KUITANSI
				WHEN 'PB' THEN G.TGL_KUITANSI
				WHEN 'PD' THEN H.TGL_BRKT
				WHEN 'TR' THEN J.TGL_START_TR
				WHEN 'AB' THEN K.TGL_ABS
END AS TGL_AJU_PARAMS,

A.HEAD_TEXT1, A.HEAD_TEXT2,
A.JNS_AJU, B.DESC_AJU, D.NIK_ATASAN, D.NIK_HC, A.COMP_CODE
FROM z_head_aju A
JOIN z_jns_aju B ON A.JNS_AJU=B.JNS_AJU
JOIN z_karyawan C ON A.NIK=C.NIK AND A.COMP_CODE = C.COMP_CODE
JOIN z_personalize D ON A.NIK=D.NIK_STAFF AND A.COMP_CODE = D.COMP_CODE
LEFT JOIN z_r_izin E ON A.ID_AJU=E.ID_AJU
LEFT JOIN z_r_cuti F ON A.ID_AJU=F.ID_AJU
LEFT JOIN z_r_gantib G ON A.ID_AJU=G.ID_AJU
LEFT JOIN z_r_jalandinas H ON A.ID_AJU=H.ID_AJU
LEFT JOIN z_r_obat I ON A.ID_AJU=I.ID_AJU
LEFT JOIN z_r_training J ON A.ID_AJU=J.ID_AJU
LEFT JOIN z_r_absensi K ON A.ID_AJU=K.ID_AJU
WHERE A.STS_AJU =0  AND A.ACTIVE = 1 ;

-- ----------------------------
-- View structure for z_view_pengajuan_his
-- ----------------------------
DROP VIEW IF EXISTS `z_view_pengajuan_his`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `z_view_pengajuan_his` AS SELECT
A.ID_AJU, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_PENGAJUAN, 
A.NIK, 
C.NAMA AS NAMA_KARYAWAN, 
C.JABATAN,
A.STS_AJU, 
CASE A.STS_AJU 
				WHEN 0 THEN 'DIAJUKAN' 
				WHEN 1 THEN 'DISETUJUI' 
				WHEN 2 THEN 'DITOLAK' 
END AS STAT_PENGAJUAN,
CASE A.JNS_AJU 
				WHEN 'IZ' THEN 2
				WHEN 'CT' THEN 3 
				WHEN 'PO' THEN 4
				WHEN 'LS' THEN 4
				WHEN 'FR' THEN 4
				WHEN 'PB' THEN 5
				WHEN 'PD' THEN 6
				WHEN 'TR' THEN 7
				WHEN 'AB' THEN 1 
END AS MENU_ID, 

CASE A.JNS_AJU 
				WHEN 'IZ' THEN DATE_FORMAT(E.TGL_AWAL_IZIN, '%d-%m-%Y')  
				WHEN 'CT' THEN DATE_FORMAT(F.TGL_AWAL_CUTI, '%d-%m-%Y') 
				WHEN 'PO' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'LS' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'FR' THEN DATE_FORMAT(I.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'PB' THEN DATE_FORMAT(G.TGL_KUITANSI, '%d-%m-%Y')
				WHEN 'PD' THEN DATE_FORMAT(H.TGL_BRKT, '%d-%m-%Y')
				WHEN 'TR' THEN DATE_FORMAT(J.TGL_START_TR, '%d-%m-%Y')
				WHEN 'AB' THEN DATE_FORMAT(K.TGL_ABS, '%d-%m-%Y') 
END AS TGL_AJU,

CASE A.JNS_AJU 
		WHEN 'IZ' THEN (SELECT x.DESC_IZIN FROM z_jns_izin x WHERE x.JNS_IZIN=A.HEAD_TEXT1 )
		WHEN 'CT' THEN (SELECT x.CUTI_DESC FROM z_cuti_m x WHERE x.CUTI_ID=A.HEAD_TEXT1 )
		WHEN 'PO' THEN ' '
		WHEN 'LS' THEN ' '
		WHEN 'FR' THEN ' '
		WHEN 'PB' THEN (SELECT x.DESC_GANTIB FROM z_jns_gantib x WHERE x.JNS_GANTIB=A.HEAD_TEXT1 )
		WHEN 'PD' THEN ' '
		WHEN 'TR' THEN ' '
		WHEN 'AB' THEN ' ' 
END AS TIPE_PENGAJUAN,


CASE A.JNS_AJU 
				WHEN 'IZ' THEN E.TGL_AWAL_IZIN
				WHEN 'CT' THEN F.TGL_AWAL_CUTI
				WHEN 'PO' THEN I.TGL_KUITANSI
				WHEN 'LS' THEN I.TGL_KUITANSI
				WHEN 'FR' THEN I.TGL_KUITANSI
				WHEN 'PB' THEN G.TGL_KUITANSI
				WHEN 'PD' THEN H.TGL_BRKT
				WHEN 'TR' THEN J.TGL_START_TR
				WHEN 'AB' THEN K.TGL_ABS
END AS TGL_AJU_PARAMS,

CASE A.JNS_AJU 
				WHEN 'IZ' THEN E.TGL_AKHIR_IZIN
				WHEN 'CT' THEN F.TGL_AKHIR_CUTI
				WHEN 'PO' THEN I.TGL_KUITANSI
				WHEN 'LS' THEN I.TGL_KUITANSI
				WHEN 'FR' THEN I.TGL_KUITANSI
				WHEN 'PB' THEN G.TGL_KUITANSI
				WHEN 'PD' THEN H.TGL_PLNG
				WHEN 'TR' THEN J.TGL_END_TR
				WHEN 'AB' THEN K.TGL_ABS
END AS TGL_AJU_PARAMS_END,

A.HEAD_TEXT1, A.HEAD_TEXT2,
A.JNS_AJU, B.DESC_AJU, 
D.NIK_ATASAN, 
D.NIK_HC, 
D.NIK_OBAT,
D.NOTIF_ATASAN, 
D.NOTIF_HC,  
D.NOTIF_STAFF, 
D.NOTIF_OBAT, 
D.STAT_ABSEN_MOBILE,
A.COMP_CODE
FROM z_head_aju A
JOIN z_jns_aju B ON A.JNS_AJU=B.JNS_AJU
JOIN z_karyawan C ON A.NIK=C.NIK AND A.COMP_CODE = C.COMP_CODE
JOIN z_personalize D ON A.NIK=D.NIK_STAFF AND A.COMP_CODE = D.COMP_CODE
LEFT JOIN z_r_izin E ON A.ID_AJU=E.ID_AJU
LEFT JOIN z_r_cuti F ON A.ID_AJU=F.ID_AJU
LEFT JOIN z_r_gantib G ON A.ID_AJU=G.ID_AJU
LEFT JOIN z_r_jalandinas H ON A.ID_AJU=H.ID_AJU
LEFT JOIN z_r_obat I ON A.ID_AJU=I.ID_AJU
LEFT JOIN z_r_training J ON A.ID_AJU=J.ID_AJU
LEFT JOIN z_r_absensi K ON A.ID_AJU=K.ID_AJU 
WHERE A.ACTIVE = 1 

UNION

SELECT 
A.ID_AJU, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_PENGAJUAN, 
A.NIK, 
C.NAMA AS NAMA_KARYAWAN, 
C.JABATAN,
A.STS_AJU, 
CASE A.STS_AJU 
				WHEN 0 THEN 'DIAJUKAN' 
				WHEN 1 THEN 'DISETUJUI' 
				WHEN 2 THEN 'DITOLAK' 
END AS STAT_PENGAJUAN,
14 AS MENU_ID, 
DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y')  AS TGL_AJU,
'OT' AS TIPE_PENGAJUAN,
A.TGL_AJU AS TGL_AJU_PARAMS,
A.TGL_AJU AS TGL_AJU_PARAMS_END,
A.HEAD_TEXT1, A.HEAD_TEXT2,
A.JNS_AJU, B.DESC_AJU, 
D.NIK_ATASAN, 
D.NIK_HC, 
D.NIK_OBAT,
D.NOTIF_ATASAN, 
D.NOTIF_HC,  
D.NOTIF_STAFF, 
D.NOTIF_OBAT, 
D.STAT_ABSEN_MOBILE,
A.COMP_CODE
FROM z_head_lembur A
JOIN z_jns_aju B ON A.JNS_AJU=B.JNS_AJU
JOIN z_karyawan C ON A.NIK=C.NIK AND A.COMP_CODE = C.COMP_CODE
JOIN z_personalize D ON A.NIK=D.NIK_STAFF AND A.COMP_CODE = D.COMP_CODE
JOIN z_compcode E ON C.COMP_CODE = E.COMP_CODE
WHERE A.ACTIVE = 1 ;

-- ----------------------------
-- View structure for z_v_unit
-- ----------------------------
DROP VIEW IF EXISTS `z_v_unit`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `z_v_unit` AS SELECT
  z_compcode.compid  AS compid,
	z_compcode.comp_name AS comp_name,
	z_unit.unitId AS unitId,
	z_unit.unitCode AS unitCode,
	z_unit.unitName AS unitName,
	z_unit.unitAlias AS unitAlias,
	z_unit.parentUnitId AS parentUnitId,
	z_unit_1.unitCode AS parentUnitCode,
	z_unit_1.unitName AS parentUnitName,
	z_unit_1.unitAlias AS parentUnitAlias,
	z_unit.siteId AS siteId,
	z_unit.active AS active,
	z_unit.defPositionId AS defPositionId,
	z_position.positionName AS defPositionName
FROM z_unit 
INNER JOIN z_compcode ON z_compcode.compid = z_unit.compid
LEFT JOIN z_unit z_unit_1 ON z_unit.parentUnitId = z_unit_1.unitId
LEFT JOIN z_position ON z_unit.defPositionId = z_position.positionId ;

-- ----------------------------
-- View structure for z_v_unit_acting_as
-- ----------------------------
DROP VIEW IF EXISTS `z_v_unit_acting_as`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `z_v_unit_acting_as` AS SELECT
	`z_unit_acting_as`.`actingAsId` AS `actingAsId`,
	`z_unit_acting_as`.`startDate` AS `startDate`,
	`z_unit_acting_as`.`endDate` AS `endDate`,
	`z_unit_acting_as`.`unitId` AS `unitId`,
	`z_unit_acting_as`.`positionId` AS `positionId`,
	`z_unit_acting_as`.`actingUserId` AS `actingUserId`,
	`pre_sec_user`.`full_name` AS `full_name`,
	`pre_sec_user`.`prefix` AS `prefix`,
	`pre_sec_user`.`email` AS `email`
FROM
	(
		`z_unit_acting_as`
		JOIN `pre_sec_user` ON (
			(
				`z_unit_acting_as`.`actingUserId` = `pre_sec_user`.`id`
			)
		)
	) ;

-- ----------------------------
-- Function structure for f_nomor_order
-- ----------------------------
DROP FUNCTION IF EXISTS `f_nomor_order`;
delimiter ;;
CREATE FUNCTION `f_nomor_order`(`v_params` VARCHAR(50))
 RETURNS varchar(50) CHARSET latin1
BEGIN
		DECLARE vkode VARCHAR(100);
		DECLARE vkdTipe VARCHAR(20);
		DECLARE vkdY VARCHAR(4);
		DECLARE vkdM VARCHAR(2);
		DECLARE vnoUrut INT;
		DECLARE vkdUrut VARCHAR(6);
	
		SET vkdTipe = 'PRK';
	
		SET vkdY = DATE_FORMAT(now(),'%Y');
		SET vkdM = DATE_FORMAT(now(),'%m');
		
		SET vnoUrut = COALESCE(
										(
										 SELECT CAST( LEFT(MAX(no_order),6) AS UNSIGNED) + 1 
										 FROM t_order
										 WHERE RIGHT(no_order,4)=vkdY AND SUBSTRING(no_order,12,2) = vkdM),1
										);
		
		SET vkdUrut = RIGHT(CONCAT('000000', CAST(vnoUrut as char(6)) ), 6);

		
		SET vkode = CONCAT ( vkdUrut, '.',  vkdTipe, '.', vkdM, '.', vkdY);
		
		RETURN vkode;
END
;;
delimiter ;

-- ----------------------------
-- Function structure for SPLIT_STRING
-- ----------------------------
DROP FUNCTION IF EXISTS `SPLIT_STRING`;
delimiter ;;
CREATE FUNCTION `SPLIT_STRING`(`str` VARCHAR(255), `delim` VARCHAR(12), `pos` INT)
 RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(str, delim, pos),
       LENGTH(SUBSTRING_INDEX(str, delim, pos-1)) + 1),
       delim, '')
;;
delimiter ;

-- ----------------------------
-- Function structure for Z_F_CEK_ABSEN
-- ----------------------------
DROP FUNCTION IF EXISTS `Z_F_CEK_ABSEN`;
delimiter ;;
CREATE FUNCTION `Z_F_CEK_ABSEN`(`v_nik` VARCHAR(50), `v_comp_code` VARCHAR(6), `v_date` VARCHAR(30), `v_type` INT)
 RETURNS varchar(4000) CHARSET latin1
BEGIN

DECLARE v_sisa_cuti INT;
DECLARE v_id_tp INT;
DECLARE v_cek_libur  INT  DEFAULT 0;
DECLARE v_cek_jadwal INT  DEFAULT 0;
DECLARE v_cek_pengajuan INT  DEFAULT 0;
DECLARE v_stat_tl INT  DEFAULT 0;
DECLARE v_stat_psw INT  DEFAULT 0;
DECLARE v_hari VARCHAR(20)  DEFAULT '';
DECLARE v_hari_ke INT  DEFAULT 0;
DECLARE v_jam_masuk VARCHAR(30)  DEFAULT '';
DECLARE v_jam_pulang VARCHAR(30)  DEFAULT '';
DECLARE v_stat_hari INT  DEFAULT 0;
DECLARE v_status_terlambat INT  DEFAULT 0;
DECLARE v_return VARCHAR(100);
DECLARE v_compid INT;
DECLARE v_type_jadwal INT;
 
	
  -- CEK ID_TP TERAKHIR PADA Z_TP_PERSON (ID JADWAL)

  SELECT compid INTO v_compid FROM z_compcode a WHERE a.comp_code=v_comp_code; 

	SELECT tb.id_tp, tx.type_hari INTO v_id_tp, v_type_jadwal FROM 
	( 
		SELECT tp_seq AS rn,  tp_seq, id_tp, tp_start_date, tp_end_date, created_by, created_date, DATE_FORMAT(tp_start_date, '%Y-%m-%d'), DATE_FORMAT(tp_end_date, '%Y-%m-%d')
		FROM z_tp_person WHERE nik=v_nik AND compid=v_compid AND 
		DATE_FORMAT(SYSDATE(), '%Y-%m-%d') BETWEEN DATE_FORMAT(tp_start_date, '%Y-%m-%d') AND DATE_FORMAT(tp_end_date, '%Y-%m-%d')  
		ORDER BY tp_seq DESC LIMIT 1
	) AS tb JOIN z_time_profile tx ON tb.id_tp = tx.id_tp;
	-- END CEK ID_TP TERAKHIR PADA Z_TP_PERSON (ID JADWAL)

	-- CEK PENGAJUAN

	SET v_cek_libur = 0;
  -- CEK HARI LIBUR
	SELECT COALESCE(COUNT(tanggal),0) INTO v_cek_libur FROM z_factory_cal WHERE tanggal = STR_TO_DATE(SUBSTR(v_date,0,10),'%Y-%m-%d');
	-- END CEK HARI LIBUR


	-- CEK TIME PROFILE
	SELECT TRIM(DATE_FORMAT(NOW(), '%W'))  AS str_day INTO v_hari FROM DUAL;
	SET v_hari_ke =0;
	SET v_jam_masuk = '';
  SET v_jam_pulang ='';

	IF v_hari = 'monday' THEN
		SET v_hari_ke = 1;
		SELECT hari_1, DATE_FORMAT(hari_1_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_1_jam_out, '%H:%i:%s')
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp; 
	ELSEIF v_hari = 'tuesday' THEN
		SET v_hari_ke = 2;
		SELECT hari_2, DATE_FORMAT(hari_2_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_2_jam_out, '%H:%i:%s') 
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'wednesday' THEN
		SET v_hari_ke = 3;
		SELECT hari_3, DATE_FORMAT(hari_3_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_3_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'thursday' THEN
		SET v_hari_ke = 4;
		SELECT hari_4, DATE_FORMAT(hari_4_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_4_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'friday' THEN
		SET v_hari_ke = 5;
		SELECT hari_5, DATE_FORMAT(hari_5_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_5_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'saturday' THEN
		SET v_hari_ke = 6;
		SELECT hari_6, DATE_FORMAT(hari_6_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_6_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'sunday' THEN
		SET v_hari_ke = 7;
		SELECT hari_7, DATE_FORMAT(hari_7_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_7_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	END IF;
  -- END CEK TIME PROFILE

  -- CEK STATUS KETERLAMBATAN
	IF v_stat_hari = 1 AND  v_type = 1 THEN
		SELECT CASE WHEN STR_TO_DATE(SUBSTR(v_date,12,8),'%H:%i:%s') > STR_TO_DATE(v_jam_masuk,'%H:%i:%s') THEN 2 ELSE 1 END AS stat_terlambat  
		INTO v_status_terlambat FROM DUAL;

		IF v_status_terlambat IS NULL THEN 
			SET v_status_terlambat = 0;
		END IF;

	END IF;
	-- Return Dokumentasi
	-- 1. Status Jadwal : 1=true, 0=false, 
  -- 2. Status Libur  : 1=true, 0=false,
  -- 3. Jam Masuk
  -- 4. Jam Pulang
  -- 5. Status Terlambat : 1=Tidak Terlambat, 2=Terlambat
	-- 6. Id Time Person
	-- 7. Type Jadwal
	
		SET v_return = (CONCAT(IFNULL(TRIM(v_stat_hari), '') , 
										';' , IFNULL(v_cek_libur, '') , 
										';' , IFNULL(TRIM(v_jam_masuk), '') , 
										';' , IFNULL(TRIM(v_jam_pulang), '') , 
										';' , IFNULL(TRIM(v_status_terlambat), ''),
										';' , IFNULL(TRIM(v_id_tp), ''), 
										';' , IFNULL(TRIM(v_type_jadwal), '')));
    RETURN v_return;


END
;;
delimiter ;

-- ----------------------------
-- Function structure for Z_F_GET_JADWAL
-- ----------------------------
DROP FUNCTION IF EXISTS `Z_F_GET_JADWAL`;
delimiter ;;
CREATE FUNCTION `Z_F_GET_JADWAL`(`v_nik` VARCHAR(50), `v_comp_code` VARCHAR(6), `v_date` VARCHAR(30))
 RETURNS varchar(4000) CHARSET latin1
BEGIN

DECLARE v_id_tp INT;
DECLARE v_hari VARCHAR(20)  DEFAULT '';
DECLARE v_hari_ke INT  DEFAULT 0;
DECLARE v_jam_masuk VARCHAR(30)  DEFAULT '';
DECLARE v_jam_pulang VARCHAR(30)  DEFAULT '';
DECLARE v_stat_hari INT  DEFAULT 0;
DECLARE v_return VARCHAR(100);
DECLARE v_compid INT;
DECLARE v_type_jadwal INT;
 
	
  -- CEK ID_TP TERAKHIR PADA Z_TP_PERSON (ID JADWAL)

	SELECT compid INTO v_compid FROM z_compcode a WHERE a.comp_code=v_comp_code; 
	SELECT tb.id_tp, tx.type_hari INTO v_id_tp, v_type_jadwal FROM 
	( 
	SELECT tp_seq AS rn,  tp_seq, id_tp, tp_start_date, tp_end_date, created_by, created_date, DATE_FORMAT(tp_start_date, '%m-%d'), DATE_FORMAT(tp_end_date, '%m-%d')
	FROM z_tp_person WHERE nik=v_nik AND compid=v_compid AND 
	DATE_FORMAT(SYSDATE(), '%m-%d') BETWEEN DATE_FORMAT(tp_start_date, '%m-%d') AND DATE_FORMAT(tp_end_date, '%m-%d')  
	ORDER BY tp_seq DESC LIMIT 1
	) AS tb
	JOIN z_time_profile tx ON tb.id_tp = tx.id_tp;
	-- END CEK ID_TP TERAKHIR PADA Z_TP_PERSON (ID JADWAL)


	-- CEK TIME PROFILE
	
	SELECT TRIM(DATE_FORMAT(v_date , '%W'))  AS str_day INTO v_hari FROM DUAL;
	SET v_hari_ke =0;
	SET v_jam_masuk = '';
  SET v_jam_pulang ='';
	

	IF v_hari = 'monday' THEN
		SET v_hari_ke = 1;
		SELECT hari_1, DATE_FORMAT(hari_1_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_1_jam_out, '%H:%i:%s')
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp; 
	ELSEIF v_hari = 'tuesday' THEN
		SET v_hari_ke = 2;
		SELECT hari_2, DATE_FORMAT(hari_2_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_2_jam_out, '%H:%i:%s') 
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'wednesday' THEN
		SET v_hari_ke = 3;
		SELECT hari_3, DATE_FORMAT(hari_3_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_3_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'thursday' THEN
		SET v_hari_ke = 4;
		SELECT hari_4, DATE_FORMAT(hari_4_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_4_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'friday' THEN
		SET v_hari_ke = 5;
		SELECT hari_5, DATE_FORMAT(hari_5_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_5_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'saturday' THEN
		SET v_hari_ke = 6;
		SELECT hari_6, DATE_FORMAT(hari_6_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_6_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSEIF v_hari = 'sunday' THEN
		SET v_hari_ke = 7;
		SELECT hari_7, DATE_FORMAT(hari_7_jam_in, '%H:%i:%s'), DATE_FORMAT(hari_7_jam_out, '%H:%i:%s')  
		INTO v_stat_hari, v_jam_masuk, v_jam_pulang FROM z_time_profile WHERE id_tp=v_id_tp;
	ELSE	
			SET v_id_tp = 0; SET v_jam_masuk = ''; SET v_jam_pulang = '';
	END IF;

  -- END CEK TIME PROFILE
	
	-- Return Dokumentasi
	-- 1. Status Jadwal : 1=true, 0=false, 
  -- 2. Status Libur  : 1=true, 0=false,
  -- 3. Jam Masuk
  -- 4. Jam Pulangs
  -- 5. Status Terlambat : 1=Tidak Terlambat, 2=Terlambat

		SET v_return = CONCAT(v_id_tp , ';' ,IFNULL(TRIM(v_jam_masuk), '') , ';' , IFNULL(TRIM(v_jam_pulang), ''), ';' , IFNULL(TRIM(v_type_jadwal), '')) ; -- CONCAT(v_id_tp,';',(IFNULL(TRIM(v_jam_masuk), '') , IFNULL(TRIM(';'), '') , IFNULL(TRIM(v_jam_pulang), '')));
    RETURN v_return;


END
;;
delimiter ;

-- ----------------------------
-- Function structure for Z_F_GET_JML_HADIR
-- ----------------------------
DROP FUNCTION IF EXISTS `Z_F_GET_JML_HADIR`;
delimiter ;;
CREATE FUNCTION `Z_F_GET_JML_HADIR`(`v_nik` VARCHAR(20), `v_comp_code` VARCHAR(6), `v_start_date` VARCHAR(30), `v_end_date` VARCHAR(30), `v_bulan` INT)
 RETURNS int(11)
BEGIN

		DECLARE v_return INT;
		
		SET v_return = (SELECT COUNT(tb.jml) AS jml FROM (
            SELECT
                DISTINCT(tgl_abs) AS jml
            FROM
                z_absensi a
            JOIN z_absen_type b ON a.id_abs_type = b.id_abs_type
            WHERE
                a.nik = v_nik
            AND a.comp_code = v_comp_code  
            AND DATE_FORMAT (a.tgl_abs, '%Y-%m-%d') >= v_start_date
            AND DATE_FORMAT (a.tgl_abs, '%Y-%m-%d') <= v_end_date
            AND a.id_abs_type IN (1, 2) ) AS tb);
 
	

    RETURN v_return;
END
;;
delimiter ;

-- ----------------------------
-- Function structure for Z_F_NOMOR_LAPORAN
-- ----------------------------
DROP FUNCTION IF EXISTS `Z_F_NOMOR_LAPORAN`;
delimiter ;;
CREATE FUNCTION `Z_F_NOMOR_LAPORAN`(`v_comp_code` VARCHAR(6), `v_jns_aju` VARCHAR(5))
 RETURNS varchar(50) CHARSET latin1
BEGIN
		DECLARE vkode VARCHAR(100);
		DECLARE vkdTipe VARCHAR(20);
		DECLARE vkdY VARCHAR(4);
		DECLARE vkdM VARCHAR(2);
		DECLARE vnoUrut INT;
		DECLARE vkdUrut VARCHAR(6);
		DECLARE vkdComp VARCHAR(6);
	
		SET vkdComp = v_comp_code;
		SET vkdTipe = v_jns_aju ;
		SET vkdY = DATE_FORMAT(now(),'%Y');
		SET vkdM = DATE_FORMAT(now(),'%m');
		
		
		SET vnoUrut = COALESCE(
										(
										 SELECT CAST( RIGHT(MAX(id_aju),6) AS UNSIGNED) + 1 
										 FROM z_head_laporan
										 WHERE LEFT(id_aju,6) = vkdComp AND
													 SUBSTRING(id_aju,8,2) 	= vkdTipe AND
													 SUBSTRING(id_aju,11,2) = vkdM  AND
													 SUBSTRING(id_aju,14,4) = vkdY
													 ),1
										);
		
		SET vkdUrut = RIGHT(CONCAT('000000', CAST(vnoUrut as char(6)) ), 6);
		-- 000001.ABCDE1.CT.01.20
		-- ABCDE1.CT.01.2020.000001
		-- SELECT f_nomor_order('ABCDE1','CT');
		
		SET vkode = CONCAT (vkdComp , '.' ,vkdTipe, '.', vkdM, '.', vkdY, '.', vkdUrut);
		
		RETURN vkode;
END
;;
delimiter ;

-- ----------------------------
-- Function structure for Z_F_NOMOR_PENGAJUAN
-- ----------------------------
DROP FUNCTION IF EXISTS `Z_F_NOMOR_PENGAJUAN`;
delimiter ;;
CREATE FUNCTION `Z_F_NOMOR_PENGAJUAN`(`v_comp_code` VARCHAR(6), `v_jns_aju` VARCHAR(5))
 RETURNS varchar(50) CHARSET latin1
BEGIN
		DECLARE vkode VARCHAR(100);
		DECLARE vkdTipe VARCHAR(20);
		DECLARE vkdY VARCHAR(4);
		DECLARE vkdM VARCHAR(2);
		DECLARE vnoUrut INT;
		DECLARE vkdUrut VARCHAR(6);
		DECLARE vkdComp VARCHAR(6);
	
		SET vkdComp = v_comp_code;
		SET vkdTipe = v_jns_aju ;
		SET vkdY = DATE_FORMAT(now(),'%Y');
		SET vkdM = DATE_FORMAT(now(),'%m');
		
		
		SET vnoUrut = COALESCE(
										(
										 SELECT CAST( RIGHT(MAX(id_aju),6) AS UNSIGNED) + 1 
										 FROM z_head_aju
										 WHERE LEFT(id_aju,6) = vkdComp AND
													 SUBSTRING(id_aju,8,2) 	= vkdTipe AND
													 SUBSTRING(id_aju,11,2) = vkdM  AND
													 SUBSTRING(id_aju,14,4) = vkdY
													 ),1
										);
		
		SET vkdUrut = RIGHT(CONCAT('000000', CAST(vnoUrut as char(6)) ), 6);
		-- 000001.ABCDE1.CT.01.20
		-- ABCDE1.CT.01.2020.000001
		-- SELECT f_nomor_order('ABCDE1','CT');
		
		SET vkode = CONCAT (vkdComp , '.' ,vkdTipe, '.', vkdM, '.', vkdY, '.', vkdUrut);
		
		RETURN vkode;
END
;;
delimiter ;

-- ----------------------------
-- Function structure for Z_F_SISA_CUTI
-- ----------------------------
DROP FUNCTION IF EXISTS `Z_F_SISA_CUTI`;
delimiter ;;
CREATE FUNCTION `Z_F_SISA_CUTI`(`v_nik` VARCHAR(30), `v_comp_code` VARCHAR(6), `v_periode` VARCHAR(4))
 RETURNS int(11)
BEGIN
DECLARE v_sisa_cuti INT;
DECLARE v_cuti_digunakan INT;
DECLARE v_ret INT;
 
	
	SELECT COALESCE((A.JML_CUTI + (SELECT X.JML_CUTI FROM z_cuti_adj X WHERE X.NIK=v_nik AND X.PERIODE=v_periode AND X.COMP_CODE=v_comp_code LIMIT 1)),0) INTO v_sisa_cuti
	FROM z_cuti A WHERE A.COMP_CODE=v_comp_code;

	SELECT COALESCE(SUM(JML_CUTI),0) AS JML INTO v_cuti_digunakan FROM z_cuti_h WHERE NIK=v_nik AND COMP_CODE=v_comp_code AND STATUS=1 AND CUTI_ID=1 AND PERIODE=v_periode;

	SET v_ret= COALESCE(v_sisa_cuti,0)- COALESCE(v_cuti_digunakan,0);
	RETURN v_ret;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_APPROVE_LEMBUR
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_APPROVE_LEMBUR`;
delimiter ;;
CREATE PROCEDURE `Z_P_APPROVE_LEMBUR`(IN `v_pengajuan_id` VARCHAR(36), IN `approval_id` VARCHAR(30), IN `v_comp_code_` VARCHAR(6), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_menu_id` INT, IN `v_status_id` INT, IN `v_status_act_id` INT, IN `v_keterangan` VARCHAR(1500))
BEGIN

DECLARE v_cnt INT;
DECLARE v_result VARCHAR(150); 
DECLARE v_sts_aju INT;
DECLARE v_date_ DATETIME;
DECLARE v_nik VARCHAR(30);
DECLARE v_emp_id INT;
DECLARE v_comp_code VARCHAR(6);
DECLARE v_jml INT;
DECLARE v_compid INT;


DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
				ROLLBACK;
				RESIGNAL;
		END;

START TRANSACTION;



		SELECT STS_AJU, NIK INTO v_sts_aju, v_nik FROM z_head_lembur WHERE ID_AJU=v_pengajuan_id;
    
		IF v_pengajuan_id <>'0' THEN 
			
			SET v_result = '';

			-- JIKA STATUS PENGAJUAN PENDING
			IF v_sts_aju NOT IN (1,2) THEN
						
					-- UPDATE STATUS & APPROVAL
					-- UPDATE STATUS APPROVAL KE TABLE z_head_aju
					UPDATE z_head_lembur SET STS_AJU=v_status_act_id, APP_NIK=approval_id, APP_KET=v_keterangan
					WHERE ID_AJU=v_pengajuan_id;
										
			END IF;

		END IF;



		SET v_result = v_pengajuan_id;
 		SELECT v_result;
		-- SELECT CONCAT(v_result,'--',v_id_tp,';',v_jam_masuk,';',v_jam_pulang);	

COMMIT;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_APPROVE_LEMBUR_HO
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_APPROVE_LEMBUR_HO`;
delimiter ;;
CREATE PROCEDURE `Z_P_APPROVE_LEMBUR_HO`(IN `v_pengajuan_id` VARCHAR(36), IN `approval_id` VARCHAR(30), IN `v_comp_code_` VARCHAR(6), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_menu_id` INT, IN `v_status_id` INT, IN `v_status_act_id` INT, IN `v_keterangan` VARCHAR(1500))
BEGIN

DECLARE v_cnt INT;
DECLARE v_result VARCHAR(150); 
DECLARE v_sts_aju INT;
DECLARE v_date_ DATETIME;
DECLARE v_nik VARCHAR(30);
DECLARE v_emp_id INT;
DECLARE v_comp_code VARCHAR(6);
DECLARE v_jml INT;
DECLARE v_compid INT;


DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
				ROLLBACK;
				RESIGNAL;
		END;

START TRANSACTION;



		SELECT STS_AJU_HO, NIK INTO v_sts_aju, v_nik FROM z_head_lembur WHERE ID_AJU=v_pengajuan_id;
    
		IF v_pengajuan_id <>'0' THEN 
			
			SET v_result = '';

			-- JIKA STATUS PENGAJUAN PENDING
			IF v_sts_aju NOT IN (1,2) THEN
						
					-- UPDATE STATUS & APPROVAL
					-- UPDATE STATUS APPROVAL KE TABLE z_head_aju
					UPDATE z_head_lembur SET STS_AJU_HO=v_status_act_id, APP_NIK_HO=approval_id, APP_KET_HO=v_keterangan
					WHERE ID_AJU=v_pengajuan_id;
										
			END IF;

		END IF;



		SET v_result = v_pengajuan_id;
 		SELECT v_result;
		-- SELECT CONCAT(v_result,'--',v_id_tp,';',v_jam_masuk,';',v_jam_pulang);	

COMMIT;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_APPROVE_PENGAJUAN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_APPROVE_PENGAJUAN`;
delimiter ;;
CREATE PROCEDURE `Z_P_APPROVE_PENGAJUAN`(IN `v_pengajuan_id` VARCHAR(30), IN `approval_id` VARCHAR(30), IN `v_comp_code_` VARCHAR(6), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_menu_id` INT, IN `v_status_id` INT, IN `v_status_act_id` INT, IN `v_keterangan` VARCHAR(1500))
BEGIN

DECLARE v_cnt INT;
DECLARE v_result VARCHAR(150); 
DECLARE v_sts_aju INT;
DECLARE v_start_date VARCHAR(30);
DECLARE v_end_date VARCHAR(30);
DECLARE v_date_ DATETIME;
DECLARE v_id_abs_type DOUBLE;
DECLARE v_nik VARCHAR(30);
DECLARE v_nik_dinas VARCHAR(30);
DECLARE v_emp_id INT;
DECLARE v_comp_code VARCHAR(6);
DECLARE v_jml INT;
DECLARE v_jml_cuti INT;
DECLARE v_id_tp INT;
DECLARE v_jam_masuk , v_jam_pulang VARCHAR(20);
DECLARE v_jam_awal , v_jam_akhir VARCHAR(20);
DECLARE v_jam_awal_ , v_jam_akhir_ VARCHAR(20);
DECLARE v_ret_jadwal VARCHAR(100);
DECLARE v_cnt_peserta INT;
DECLARE v_cuti_id INT;
DECLARE v_alasan_cuti VARCHAR(150);
DECLARE v_cek_nik_hc INT;
DECLARE v_nik_hc VARCHAR(22);
DECLARE v_stat_success_cuti INT;
DECLARE v_cek_absen INT;
DECLARE v_cuti_desc VARCHAR(100);
DECLARE v_compid INT;
DECLARE v_unitid INT;
DECLARE v_periode INT;
 
		
		SELECT STS_AJU, NIK INTO v_sts_aju, v_nik FROM z_head_aju WHERE ID_AJU=v_pengajuan_id;
    
		IF v_pengajuan_id <>'0' THEN 
			
			SET v_result = '';

			-- JIKA STATUS PENGAJUAN PENDING
			IF v_sts_aju NOT IN (1,2) THEN
						
					-- JIKA STATUS DISETUJUI 	
					IF v_status_act_id IN (1) THEN

								-- ABSENSI
								IF v_menu_id = 1  THEN
								
										SET v_result = '';
										
										/*
										INSERT INTO z_absensi 
										(NIK,COMP_CODE,TGL_ABS,JAM_IN,JAM_OUT,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO,URL_FOTO_PULANG,DEVICE) 
										SELECT 
										NIK,COMP_CODE,TGL_ABS,JAM_IN,JAM_OUT,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO,URL_FOTO_PULANG,DEVICE 
										FROM z_r_absensi
										WHERE ID_AJU=v_pengajuan_id;

										SELECT NIK INTO v_nik FROM z_r_absensi
										WHERE ID_AJU=v_pengajuan_id;
										*/

								-- IZIN
								ELSEIF v_menu_id = 2  THEN

										SELECT B.NIK, C.COMP_CODE, C.COMPID, C.UNITID, A.JNS_IZIN, 
										DATE_FORMAT(A.TGL_AWAL_IZIN,'%Y-%m-%d') AS TGL_AWAL, 
										DATE_FORMAT(A.TGL_AKHIR_IZIN,'%Y-%m-%d') AS TGL_AKHIR, 
										DATEDIFF(A.TGL_AKHIR_IZIN, A.TGL_AWAL_IZIN) + 1 AS JML, C.EMP_ID
										INTO v_nik, v_comp_code, v_compid, v_unitid, v_id_abs_type, v_start_date, v_end_date, v_jml, v_emp_id
										FROM z_r_izin A 
										JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
										JOIN z_karyawan C ON B.NIK=C.NIK
										WHERE A.ID_AJU=v_pengajuan_id;
										-- INSERT KE TABLE z_absensi
										SET v_cnt=1;
										SET v_cek_absen = 0;
										SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d');
										
										WHILE (v_cnt <= v_jml)
										DO
										
											/* CEK DUPLICATE */
											SELECT 
											CASE WHEN EXISTS(SELECT 1 FROM z_lap_absensi_log  WHERE emp_id=v_emp_id AND tgl_abs=v_date_ 
											) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
										

											SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
											SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
											SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
											SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
											
											SET v_jam_awal_  = CONCAT(LEFT(v_date_,10),' ',v_jam_masuk);
											SET v_jam_akhir_ = CONCAT(LEFT(v_date_,10),' ',v_jam_pulang);
											
											-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
											IF v_cek_absen = 0 THEN 
										
												
												-- ADJUST JAM KERJA 
												-- 4	Izin Terlambat
												IF v_id_abs_type = 4 THEN 
																																										
														INSERT INTO z_lap_absensi_log (nik,comp_code, compid, unitid, tgl_abs, jam_in, id_abs_type, emp_id, id_tp, jadwal_masuk,jadwal_pulang,remark) 
														SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_jam_masuk, v_id_abs_type, v_emp_id, v_id_tp,
														v_jam_masuk, 
														v_jam_pulang,
														'Izin Terlambat'
														FROM DUAL
														ON DUPLICATE KEY UPDATE 
														id_abs_type = v_id_abs_type,
														remark = 'Izin Terlambat',
														jam_in = v_jam_masuk,
														jadwal_masuk = v_jam_masuk,
														jadwal_pulang = v_jam_pulang;
														
												
												-- 5	Izin Pulang Cepat
												ELSEIF v_id_abs_type = 5 THEN
												
														INSERT INTO z_lap_absensi_log (nik,comp_code,compid, unitid, tgl_abs, jam_out, id_abs_type, emp_id, id_tp, jadwal_masuk,jadwal_pulang,remark) 
														SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_jam_pulang, v_id_abs_type, v_emp_id, v_id_tp,
														v_jam_masuk, 
														v_jam_pulang,
														'Izin Pulang Cepat'
														FROM DUAL
														ON DUPLICATE KEY UPDATE 
														id_abs_type = v_id_abs_type,
														remark = 'Izin Pulang Cepat',
														jam_out = v_jam_pulang,
														jadwal_masuk = v_jam_masuk,
														jadwal_pulang = v_jam_pulang;
												-- 		
												
											  -- 13	Lupa Absen
												ELSEIF v_id_abs_type = 13 THEN
												
														INSERT INTO z_lap_absensi_log (nik,comp_code,compid, unitid, tgl_abs, jam_in, jam_out, id_abs_type, emp_id, id_tp, jadwal_masuk,jadwal_pulang,remark) 
														SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_jam_masuk, v_jam_pulang, v_id_abs_type, v_emp_id, v_id_tp,
														v_jam_masuk, 
														v_jam_pulang,
														'Lupa Absen'
														FROM DUAL
														ON DUPLICATE KEY UPDATE 
														id_abs_type = v_id_abs_type,
														remark = 'Lupa Absen',
														jam_in = v_jam_masuk,
														jam_out = v_jam_pulang,
														jadwal_masuk = v_jam_masuk,
														jadwal_pulang = v_jam_pulang;
												ELSE
															INSERT INTO z_lap_absensi_log (nik,comp_code, compid, unitid, tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang) 
															SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM DUAL
															ON DUPLICATE KEY UPDATE 
															id_abs_type = v_id_abs_type,
															remark = 'Izin',
															jam_in = v_jam_masuk,
															jam_out = v_jam_pulang,
															jadwal_masuk = v_jam_masuk,
															jadwal_pulang = v_jam_pulang;
														
												END IF;
												
												
											
											-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
											ELSE 
											
													-- 4	Izin Terlambat
													IF v_id_abs_type = 4 THEN
													
															UPDATE z_lap_absensi_log SET 
															jam_in = v_jam_masuk,
															remark = 'Izin Terlambat'
															WHERE emp_id=v_emp_id AND tgl_abs=v_date_;
												
													-- 5	Izin Pulang Cepat
													ELSEIF v_id_abs_type = 5 THEN
												
															UPDATE z_lap_absensi_log SET 
															jam_out = v_jam_pulang,
															remark = 'Izin Pulang Cepat'
															WHERE emp_id=v_emp_id AND tgl_abs=v_date_;
															
													-- IZIN
													ELSE
															
															UPDATE z_lap_absensi_log SET 
															id_abs_type = v_id_abs_type, 
															id_tp = v_id_tp, 
															jadwal_masuk = v_jam_masuk, 
															jadwal_pulang = v_jam_pulang
															WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
															
													END IF;
												
											END IF;
											
											
											SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
											SET v_cnt = v_cnt + 1;

										END WHILE;

								-- CUTI
								ELSEIF v_menu_id = 3   THEN
					
										SELECT 
										b.nik, 
										c.comp_code, 
										c.compid,
										c.unitid,
										7, 
										DATE_FORMAT(a.tgl_akhir_cuti, a.tgl_awal_cuti,'%Y-%m-%d') AS tgl_awal, 
										DATE_FORMAT(a.tgl_akhir_cuti,'%Y-%m-%d') AS tgl_akhir, 
										DATEDIFF(a.tgl_akhir_cuti, a.tgl_awal_cuti) + 1 AS diffdayy,
										a.cuti_id, a.alasan_cuti, c.emp_id, d.cuti_desc
										INTO v_nik, v_comp_code, v_compid, v_unitid,  v_id_abs_type, 
										v_start_date, v_end_date, v_jml, v_cuti_id, v_alasan_cuti, v_emp_id, v_cuti_desc
										FROM z_r_cuti a 
										JOIN z_head_aju b ON a.id_aju=b.id_aju
										JOIN z_karyawan c ON b.nik=c.nik
										JOIN z_cuti_m d ON a.cuti_id = d.cuti_id
										WHERE a.id_aju=v_pengajuan_id;
										-- INSERT KE TABLE z_absensi
										SET v_cnt=1;
										SET v_cek_absen = 0;
										SET v_jml_cuti = 0;
										SET v_stat_success_cuti = 0;
										SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d');

										WHILE (v_cnt <= v_jml)
										DO
											
											SELECT 
											CASE WHEN EXISTS(SELECT 1 FROM z_lap_absensi_log  WHERE emp_id=v_emp_id AND tgl_abs=v_date_ 
											) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
											
											SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
											SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
											SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
											SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
											
											-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
											IF v_cek_absen = 0 THEN 
									
												SET v_jml_cuti = v_jml_cuti + 1;
												SET v_stat_success_cuti = 1;
												INSERT INTO z_lap_absensi_log  (nik,comp_code, compid, unitid,  tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang, remark) 
												SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang, v_cuti_desc FROM DUAL
												ON DUPLICATE KEY UPDATE 
												id_abs_type = v_id_abs_type,
												remark = v_cuti_desc,
												jadwal_masuk = v_jam_masuk,
												jadwal_pulang = v_jam_pulang;
												
											-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
											ELSE
												
												SET v_jml_cuti = v_jml_cuti + 1;
												SET v_stat_success_cuti = 1;
												UPDATE z_lap_absensi_log SET 
												id_abs_type = v_id_abs_type, 
												id_tp = v_id_tp, 
												remark = v_cuti_desc,
												jadwal_masuk = v_jam_masuk, 
												jadwal_pulang = v_jam_pulang
												WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
												
											END IF;

											
											SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
											SET v_cnt = v_cnt + 1;
											
										END WHILE;

										-- INSERT KE TABLE z_cuti_h
										IF v_stat_success_cuti = 1 THEN
												SET v_periode = STR_TO_DATE(v_start_date, '%Y');
												INSERT INTO z_cuti_h 
												(id_aju, nik, comp_code, cuti_id, jml_cuti, start_cuti, end_cuti, periode, remark_cuti, status)
												SELECT v_pengajuan_id, v_nik, v_comp_code, v_cuti_id , v_jml, 
												STR_TO_DATE(v_start_date, '%Y-%m-%d'),
												STR_TO_DATE(v_end_date, '%Y-%m-%d'), 
												left(v_periode,4),  
												v_alasan_cuti, 1 
												FROM DUAL
												ON DUPLICATE KEY UPDATE 
												remark_cuti = v_alasan_cuti,
												start_cuti = STR_TO_DATE(v_start_date, '%Y-%m-%d'),
												end_cuti = STR_TO_DATE(v_end_date, '%Y-%m-%d');
										END IF;
							
								-- PENGOBATAN
								ELSEIF v_menu_id = 4  THEN
					
										SELECT B.NIK
										INTO v_nik
										FROM z_r_obat A 
										JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
										WHERE A.ID_AJU=v_pengajuan_id;

								-- REIMBURSE/PENGGANTIAN BIAYA
								ELSEIF v_menu_id = 5  THEN
					
										SELECT B.NIK
										INTO v_nik
										FROM z_r_gantib A 
										JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
										WHERE A.ID_AJU=v_pengajuan_id;
												
								-- DINAS
								ELSEIF v_menu_id = 6 THEN
					
										SELECT B.NIK, C.COMP_CODE, C.COMPID, C.UNITID, 9,
										DATE_FORMAT(A.TGL_BRKT,'%Y-%m-%d') AS TGL_AWAL, 
										DATE_FORMAT(A.TGL_PLNG,'%Y-%m-%d') AS TGL_AKHIR, 
										DATEDIFF(A.TGL_PLNG, A.TGL_BRKT) + 1 AS DIFFDAY,
										C.EMP_ID
										INTO v_nik, v_comp_code, v_compid, v_unitid, v_id_abs_type, v_start_date, v_end_date, v_jml, v_emp_id
										FROM z_r_jalandinas A 
										JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
										JOIN z_karyawan C ON B.NIK=C.NIK
										WHERE A.ID_AJU=v_pengajuan_id;

										SELECT COALESCE(COUNT(NIK),0) INTO v_cnt_peserta FROM z_r_jalandinas_peserta WHERE ID_AJU=v_pengajuan_id;

										-- INSERT KE TABLE z_absensi
										SET v_cnt =1;
										SET v_cek_absen = 0;
										SET v_date_ = STR_TO_DATE(v_start_date, '%Y-%m-%d');

										WHILE (v_cnt <= v_jml)
										DO
											
											
											SELECT 
											CASE WHEN EXISTS(SELECT 1 FROM z_lap_absensi_log  WHERE emp_id=v_emp_id AND tgl_abs=v_date_ 
											) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
											
											SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
											SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
											SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
											SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
										
											
											-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
											IF v_cek_absen = 0 THEN 
									
												INSERT INTO z_lap_absensi_log  (nik,comp_code, compid, unitid, tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang) 
												SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM DUAL
												ON DUPLICATE KEY UPDATE 
												id_abs_type = v_id_abs_type, 
												remark = 'Dinas',
												jadwal_masuk = v_jam_masuk,
												jadwal_pulang = v_jam_pulang;
												
											-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
											ELSE

												UPDATE z_lap_absensi_log SET 
												id_abs_type = v_id_abs_type, 
												id_tp = v_id_tp, 
												remark = 'Dinas',
												jadwal_masuk = v_jam_masuk, 
												jadwal_pulang = v_jam_pulang
												WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
												
											END IF;

					
											-- MEMASUKAN PESERTA KE TABLE z_absensi & STATUS NYA DINAS 
											IF v_cnt_peserta > 0  THEN
													
													SET v_cek_absen = 0;
													SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
													SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
													SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
													SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));

													INSERT INTO z_lap_absensi_log (nik,comp_code,compid,unitid,tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang ) 
													SELECT nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM z_r_jalandinas_peserta 
													WHERE id_aju=v_pengajuan_id AND LENGTH(nik) > 0
													ON DUPLICATE KEY UPDATE 
													id_abs_type = v_id_abs_type, 
													remark = 'Dinas',
													jadwal_masuk = v_jam_masuk,
													jadwal_pulang = v_jam_pulang;
													
											END IF;

											SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
											SET v_cnt = v_cnt + 1;
										END WHILE;

								-- TRAINING/PELATIHAN
								ELSEIF v_menu_id = 7  THEN
					
										SELECT B.NIK, C.COMP_CODE, C.COMPID, C.UNITID, 10, 
										DATE_FORMAT(A.TGL_START_TR,'%Y-%m-%d') AS TGL_AWAL, 
										DATE_FORMAT(A.TGL_END_TR,'%Y-%m-%d') AS TGL_AKHIR, 
										DATEDIFF(A.TGL_END_TR, A.TGL_START_TR) + 1 AS DIFFDAY
										INTO v_nik, v_comp_code, v_compid, v_unitid, v_id_abs_type, v_start_date, v_end_date, v_jml 
										FROM z_r_training A 
										JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
										JOIN z_karyawan C ON B.NIK=C.NIK
										WHERE A.ID_AJU=v_pengajuan_id;
										-- INSERT KE TABLE z_absensi
										SET v_cek_absen = 0;
										SET v_cnt = 1;
										SET v_cek_absen = 0;
										SET v_date_ = STR_TO_DATE(v_start_date, '%Y-%m-%d');

										WHILE (v_cnt <= v_jml)
										DO
											
											SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
											SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
											SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
											SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
			
											-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
											IF v_cek_absen = 0 THEN 
									
												INSERT INTO z_lap_absensi_log  (nik,comp_code, compid, unitid, tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang) 
												SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM DUAL
												ON DUPLICATE KEY UPDATE 
												id_abs_type = v_id_abs_type, 
												remark = 'Pelatihan',
												jadwal_masuk = v_jam_masuk,
												jadwal_pulang = v_jam_pulang;
												
											-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
											ELSE

												UPDATE z_lap_absensi_log SET 
												id_abs_type = v_id_abs_type, 
												id_tp = v_id_tp, 
												remark = 'Pelatihan',
												jadwal_masuk = v_jam_masuk, 
												jadwal_pulang = v_jam_pulang
												WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
												
											END IF;

											
											
											
											SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
											SET v_cnt = v_cnt + 1;
										END WHILE;

							END IF;
			
					END IF;



					-- UPDATE STATUS & APPROVAL
					-- UPDATE STATUS APPROVAL KE TABLE z_head_aju
					UPDATE z_head_aju SET STS_AJU=v_status_act_id, APP_NIK=approval_id, APP_KET=v_keterangan
					WHERE ID_AJU=v_pengajuan_id;

					-- INSERT KE TABLE NOTIFIKASI KE PENGAJU
					INSERT INTO z_notifikasi (id_aju, tgl, sts_aju, is_read, nik)
					SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), v_status_act_id, 0, v_nik FROM DUAL
					ON DUPLICATE KEY UPDATE 
					is_read = 0;

					-- INSERT KE TABLE NOTIFIKASI KE HC
					SET v_cek_nik_hc = 0;
					SELECT COUNT(NIK_HC) INTO v_cek_nik_hc FROM z_personalize WHERE NIK_STAFF=v_nik AND NIK_HC <> '0';

					IF v_cek_nik_hc = 1 THEN
			
							SELECT  NIK_HC INTO v_nik_hc  FROM z_personalize WHERE NIK_STAFF=v_nik LIMIT 1;
				
							INSERT INTO z_notifikasi (id_aju, tgl, sts_aju, is_read, nik)
							SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), v_status_act_id, 0, v_nik_hc FROM DUAL
							ON DUPLICATE KEY UPDATE 
							is_read = 0;

					END IF;
					-- END UPDATE STATUS & APPROVAL*/
										
			END IF;

		END IF;

	  COMMIT;

		SET v_result = v_pengajuan_id;
 		SELECT v_result;
		-- SELECT CONCAT(v_result,'--',v_id_tp,';',v_jam_masuk,';',v_jam_pulang);	

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_APPROVE_PENGAJUAN_AUTOGENERATE
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_APPROVE_PENGAJUAN_AUTOGENERATE`;
delimiter ;;
CREATE PROCEDURE `Z_P_APPROVE_PENGAJUAN_AUTOGENERATE`(IN `v_pengajuan_id` VARCHAR(36), IN `v_nik` VARCHAR(36), IN v_comp_code VARCHAR(6), IN `v_menu_id` INT)
BEGIN

DECLARE v_cnt INT;
DECLARE v_result VARCHAR(150); 
DECLARE v_sts_aju INT;
DECLARE v_start_date VARCHAR(30);
DECLARE v_end_date VARCHAR(30);
DECLARE v_date_ DATETIME;
DECLARE v_id_abs_type DOUBLE;
DECLARE v_nik VARCHAR(30);
DECLARE v_emp_id INT;
DECLARE v_comp_code_ VARCHAR(6);
DECLARE v_jml INT;
DECLARE v_jml_cuti INT;
DECLARE v_id_tp INT;
DECLARE v_jam_masuk , v_jam_pulang VARCHAR(20);
DECLARE v_jam_awal , v_jam_akhir VARCHAR(20);
DECLARE v_jam_awal_ , v_jam_akhir_ VARCHAR(20);
DECLARE v_ret_jadwal VARCHAR(100);
DECLARE v_cnt_peserta INT;
DECLARE v_cuti_id INT;
DECLARE v_alasan_cuti VARCHAR(150);
DECLARE v_cek_nik_hc INT;
DECLARE v_nik_hc VARCHAR(22);
DECLARE v_stat_success_cuti INT;
DECLARE v_cek_absen INT;
DECLARE v_cuti_desc VARCHAR(100);
DECLARE v_compid INT;
DECLARE v_unitid INT;
DECLARE v_periode INT;
 
		
		SELECT STS_AJU, NIK INTO v_sts_aju, v_nik FROM z_head_aju WHERE ID_AJU=v_pengajuan_id;
		SET v_comp_code_ = v_comp_code;
    
		IF v_pengajuan_id <>'0' THEN 
			
			SET v_result = '';
					
					-- IZIN
					IF v_menu_id = 2  THEN

						SELECT B.NIK, C.COMP_CODE, C.COMPID, C.UNITID, A.JNS_IZIN, 
						DATE_FORMAT(A.TGL_AWAL_IZIN,'%Y-%m-%d') AS TGL_AWAL, 
						DATE_FORMAT(A.TGL_AKHIR_IZIN,'%Y-%m-%d') AS TGL_AKHIR, 
						DATEDIFF(A.TGL_AKHIR_IZIN, A.TGL_AWAL_IZIN) + 1 AS JML, C.EMP_ID
						INTO v_nik, v_comp_code, v_compid, v_unitid, v_id_abs_type, v_start_date, v_end_date, v_jml, v_emp_id
						FROM z_r_izin A 
						JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
						JOIN z_karyawan C ON B.NIK=C.NIK
						WHERE A.ID_AJU=v_pengajuan_id;
						-- INSERT KE TABLE z_absensi
						SET v_cnt=1;
						SET v_cek_absen = 0;
						SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d');
						
						WHILE (v_cnt <= v_jml)
						DO
						
							/* CEK DUPLICATE */
							SELECT 
							CASE WHEN EXISTS(SELECT 1 FROM z_lap_absensi_log  WHERE emp_id=v_emp_id AND tgl_abs=v_date_ 
							) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
						

							SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
							SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
							SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
							SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
							
							SET v_jam_awal_  = CONCAT(LEFT(v_date_,10),' ',v_jam_masuk);
							SET v_jam_akhir_ = CONCAT(LEFT(v_date_,10),' ',v_jam_pulang);
							
							-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
							IF v_cek_absen = 0 THEN 
						
								
								-- ADJUST JAM KERJA 
								-- 4	Izin Terlambat
								IF v_id_abs_type = 4 THEN 
											
										
										INSERT INTO z_lap_absensi_log (nik,comp_code, compid, unitid, tgl_abs, jam_in, id_abs_type, emp_id, id_tp, jadwal_masuk,jadwal_pulang,remark) 
										SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_jam_masuk, 1, v_emp_id, v_id_tp,
										v_jam_masuk, 
										v_jam_pulang,
										'Izin Terlambat'
										FROM DUAL
										ON DUPLICATE KEY UPDATE 
										id_abs_type = 1,
										remark = 'Izin Terlambat',
										jam_in = v_jam_masuk,
										jadwal_masuk = v_jam_masuk,
										jadwal_pulang = v_jam_pulang;		
										
							
								-- 5	Izin Pulang Cepat
								ELSEIF v_id_abs_type = 5 THEN
								
										INSERT INTO z_lap_absensi_log (nik,comp_code,compid, unitid, tgl_abs, jam_out, id_abs_type, emp_id, id_tp, jadwal_masuk,jadwal_pulang,remark) 
										SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_jam_pulang, 1, v_emp_id, v_id_tp,
										v_jam_masuk, 
										v_jam_pulang,
										'Izin Pulang Cepat'
										FROM DUAL
										ON DUPLICATE KEY UPDATE 
										id_abs_type = 1,
										remark = 'Izin Pulang Cepat',
										jam_out = v_jam_pulang,
										jadwal_masuk = v_jam_masuk,
										jadwal_pulang = v_jam_pulang;
								-- 		
								
								-- 13	Lupa Absen
								ELSEIF v_id_abs_type = 13 THEN
								
										INSERT INTO z_lap_absensi_log (nik,comp_code,compid, unitid, tgl_abs, jam_in, jam_out, id_abs_type, emp_id, id_tp, jadwal_masuk,jadwal_pulang,remark) 
										SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_jam_masuk, v_jam_pulang, 1, v_emp_id, v_id_tp,
										v_jam_masuk, 
										v_jam_pulang,
										'Lupa Absen'
										FROM DUAL
										ON DUPLICATE KEY UPDATE 
										id_abs_type = 1,
										remark = 'Lupa Absen',
										jam_in = v_jam_masuk,
										jam_out = v_jam_pulang,
										jadwal_masuk = v_jam_masuk,
										jadwal_pulang = v_jam_pulang;
								ELSE
											INSERT INTO z_lap_absensi_log (nik,comp_code, compid, unitid, tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang) 
											SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM DUAL
											ON DUPLICATE KEY UPDATE 
											id_abs_type = v_id_abs_type,
											remark = 'Izin',
											jam_in = v_jam_masuk,
											jam_out = v_jam_pulang,
											jadwal_masuk = v_jam_masuk,
											jadwal_pulang = v_jam_pulang;
										
								END IF;
								
								
							
							-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
							ELSE 
							
									-- 4	Izin Terlambat
									IF v_id_abs_type = 4 THEN
									
											UPDATE z_lap_absensi_log  SET 
											jam_in = v_jam_masuk,
											remark = 'Izin Terlambat'
											WHERE emp_id=v_emp_id AND tgl_abs=v_date_;
								
									-- 5	Izin Pulang Cepat
									ELSEIF v_id_abs_type = 5 THEN
								
											UPDATE z_lap_absensi_log  SET 
											jam_out = v_jam_pulang,
											remark = 'Izin Pulang Cepat'
											WHERE emp_id=v_emp_id AND tgl_abs=v_date_;
											
									-- IZIN
									ELSE
											
											UPDATE z_lap_absensi_log SET 
											id_abs_type = v_id_abs_type, 
											id_tp = v_id_tp, 
											jadwal_masuk = v_jam_masuk, 
											jadwal_pulang = v_jam_pulang
											WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
											
									END IF;
								
							END IF;
							
							
							SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
							SET v_cnt = v_cnt + 1;

						END WHILE;

				-- CUTI
				ELSEIF v_menu_id = 3   THEN
	
						SELECT 
						b.nik, 
						c.comp_code, 
						c.compid,
						c.unitid,
						7, 
						DATE_FORMAT(a.tgl_akhir_cuti, a.tgl_awal_cuti,'%Y-%m-%d') AS tgl_awal, 
						DATE_FORMAT(a.tgl_akhir_cuti,'%Y-%m-%d') AS tgl_akhir, 
						DATEDIFF(a.tgl_akhir_cuti, a.tgl_awal_cuti) + 1 AS diffdayy,
						a.cuti_id, a.alasan_cuti, c.emp_id, d.cuti_desc
						INTO v_nik, v_comp_code, v_compid, v_unitid,  v_id_abs_type, 
						v_start_date, v_end_date, v_jml, v_cuti_id, v_alasan_cuti, v_emp_id, v_cuti_desc
						FROM z_r_cuti a 
						JOIN z_head_aju b ON a.id_aju=b.id_aju
						JOIN z_karyawan c ON b.nik=c.nik
						JOIN z_cuti_m d ON a.cuti_id = d.cuti_id
						WHERE a.id_aju=v_pengajuan_id;
						-- INSERT KE TABLE z_absensi
						SET v_cnt=1;
						SET v_cek_absen = 0;
						SET v_jml_cuti = 0;
						SET v_stat_success_cuti = 0;
						SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d');

						WHILE (v_cnt <= v_jml)
						DO
							
							SELECT 
							CASE WHEN EXISTS(SELECT 1 FROM z_lap_absensi_log  WHERE emp_id=v_emp_id AND tgl_abs=v_date_ 
							) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
							
							SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
							SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
							SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
							SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
							
							-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
							IF v_cek_absen = 0 THEN 
					
								SET v_jml_cuti = v_jml_cuti + 1;
								SET v_stat_success_cuti = 1;
								INSERT INTO z_lap_absensi_log  (nik,comp_code, compid, unitid,  tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang, remark) 
								SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang, v_cuti_desc FROM DUAL
								ON DUPLICATE KEY UPDATE 
								id_abs_type = v_id_abs_type,
								remark = v_cuti_desc,
								jadwal_masuk = v_jam_masuk,
								jadwal_pulang = v_jam_pulang;
								
							-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
							ELSE
								
								SET v_jml_cuti = v_jml_cuti + 1;
								SET v_stat_success_cuti = 1;
								UPDATE z_lap_absensi_log SET 
								id_abs_type = v_id_abs_type, 
								id_tp = v_id_tp, 
								remark = v_cuti_desc,
								jadwal_masuk = v_jam_masuk, 
								jadwal_pulang = v_jam_pulang
								WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
								
							END IF;

							
							SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
							SET v_cnt = v_cnt + 1;
							
						END WHILE;

						-- INSERT KE TABLE z_cuti_h
						IF v_stat_success_cuti = 1 THEN
								SET v_periode = STR_TO_DATE(v_start_date, '%Y');
								INSERT INTO z_cuti_h 
								(id_aju, nik, comp_code, cuti_id, jml_cuti, start_cuti, end_cuti, periode, remark_cuti, status)
								SELECT v_pengajuan_id, v_nik, v_comp_code, v_cuti_id , v_jml, 
								STR_TO_DATE(v_start_date, '%Y-%m-%d'),
								STR_TO_DATE(v_end_date, '%Y-%m-%d'), 
								left(v_periode,4),    
								v_alasan_cuti, 1 
								FROM DUAL
								ON DUPLICATE KEY UPDATE 
								remark_cuti = v_alasan_cuti,
								start_cuti = STR_TO_DATE(v_start_date, '%Y-%m-%d'),
								end_cuti = STR_TO_DATE(v_end_date, '%Y-%m-%d');
						END IF;
			
				-- PENGOBATAN
				ELSEIF v_menu_id = 4  THEN
	
						SELECT B.NIK
						INTO v_nik
						FROM z_r_obat A 
						JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
						WHERE A.ID_AJU=v_pengajuan_id;

				-- REIMBURSE/PENGGANTIAN BIAYA
				ELSEIF v_menu_id = 5  THEN
	
						SELECT B.NIK
						INTO v_nik
						FROM z_r_gantib A 
						JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
						WHERE A.ID_AJU=v_pengajuan_id;
								
				-- DINAS
				ELSEIF v_menu_id = 6 THEN
	
						SELECT B.NIK, C.COMP_CODE, C.COMPID, C.UNITID, 9,
						DATE_FORMAT(A.TGL_BRKT,'%Y-%m-%d') AS TGL_AWAL, 
						DATE_FORMAT(A.TGL_PLNG,'%Y-%m-%d') AS TGL_AKHIR, 
						DATEDIFF(A.TGL_PLNG, A.TGL_BRKT) + 1 AS DIFFDAY,
						C.EMP_ID
						INTO v_nik, v_comp_code, v_compid, v_unitid, v_id_abs_type, v_start_date, v_end_date, v_jml, v_emp_id
						FROM z_r_jalandinas A 
						JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
						JOIN z_karyawan C ON B.NIK=C.NIK
						WHERE A.ID_AJU=v_pengajuan_id;

						SELECT COALESCE(COUNT(NIK),0) INTO v_cnt_peserta FROM z_r_jalandinas_peserta WHERE ID_AJU=v_pengajuan_id;

						-- INSERT KE TABLE z_absensi
						SET v_cnt =1;
						SET v_cek_absen = 0;
						SET v_date_ = STR_TO_DATE(v_start_date, '%Y-%m-%d');

						WHILE (v_cnt <= v_jml)
						DO
							
							
							SELECT 
							CASE WHEN EXISTS(SELECT 1 FROM z_lap_absensi_log  WHERE emp_id=v_emp_id AND tgl_abs=v_date_ 
							) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
							
							SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
							SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
							SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
							SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));
						
							
							-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
							IF v_cek_absen = 0 THEN 
					
								INSERT INTO z_lap_absensi_log  (nik,comp_code, compid, unitid, tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang) 
								SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM DUAL
								ON DUPLICATE KEY UPDATE 
								id_abs_type = v_id_abs_type,
								remark = 'Dinas',
								jadwal_masuk = v_jam_masuk,
								jadwal_pulang = v_jam_pulang;
								
							-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
							ELSE

								UPDATE z_lap_absensi_log SET 
								id_abs_type = v_id_abs_type, 
								id_tp = v_id_tp, 
								remark = 'Dinas',
								jadwal_masuk = v_jam_masuk, 
								jadwal_pulang = v_jam_pulang
								WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
								
							END IF;

	
							-- MEMASUKAN PESERTA KE TABLE z_absensi & STATUS NYA DINAS 
							IF v_cnt_peserta > 0  THEN
									
									SET v_cek_absen = 0;
									SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
									SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
									SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
									SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));

									INSERT INTO z_lap_absensi_log (nik,comp_code,compid,unitid,tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang ) 
									SELECT nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM z_r_jalandinas_peserta 
									WHERE id_aju=v_pengajuan_id AND LENGTH(nik) > 0
									ON DUPLICATE KEY UPDATE 
									id_abs_type = v_id_abs_type,
									remark = 'Dinas',
									jadwal_masuk = v_jam_masuk,
									jadwal_pulang = v_jam_pulang;
									
							END IF;

							SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
							SET v_cnt = v_cnt + 1;
						END WHILE;

				-- TRAINING/PELATIHAN
				ELSEIF v_menu_id = 7  THEN
	
						SELECT B.NIK, C.COMP_CODE, C.COMPID, C.UNITID, 10, 
						DATE_FORMAT(A.TGL_START_TR,'%Y-%m-%d') AS TGL_AWAL, 
						DATE_FORMAT(A.TGL_END_TR,'%Y-%m-%d') AS TGL_AKHIR, 
						DATEDIFF(A.TGL_END_TR, A.TGL_START_TR) + 1 AS DIFFDAY
						INTO v_nik, v_comp_code, v_compid, v_unitid, v_id_abs_type, v_start_date, v_end_date, v_jml 
						FROM z_r_training A 
						JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
						JOIN z_karyawan C ON B.NIK=C.NIK
						WHERE A.ID_AJU=v_pengajuan_id;
						-- INSERT KE TABLE z_absensi
						SET v_cek_absen = 0;
						SET v_cnt = 1;
						SET v_cek_absen = 0;
						SET v_date_ = STR_TO_DATE(v_start_date, '%Y-%m-%d');

						WHILE (v_cnt <= v_jml)
						DO
							
							SET v_ret_jadwal = (SELECT Z_F_GET_JADWAL(v_nik, v_comp_code_,v_date_));
							SET v_id_tp 		 = (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 1), ';', -1));
							SET v_jam_masuk  = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 2), ';', -1)));
							SET v_jam_pulang = CONCAT(LEFT(v_date_,10),' ',(SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(v_ret_jadwal, ';', 3), ';', -1)));

							-- CEK BELUM ADA DI LOG KEHADIRAN / BELUM
							IF v_cek_absen = 0 THEN 
					
								INSERT INTO z_lap_absensi_log  (nik,comp_code, compid, unitid, tgl_abs,id_abs_type,emp_id,id_tp,jadwal_masuk,jadwal_pulang) 
								SELECT v_nik, v_comp_code, v_compid, v_unitid, v_date_, v_id_abs_type, v_emp_id, v_id_tp, v_jam_masuk, v_jam_pulang FROM DUAL
								ON DUPLICATE KEY UPDATE 
								id_abs_type = v_id_abs_type,
								remark = 'Pelatihan',
								jadwal_masuk = v_jam_masuk,
								jadwal_pulang = v_jam_pulang;
								
							-- CEK SUDAH ADA DI LOG KEHADIRAN / BELUM
							ELSE

								UPDATE z_lap_absensi_log SET 
								id_abs_type = v_id_abs_type, 
								id_tp = v_id_tp, 
								remark = 'Pelatihan',
								jadwal_masuk = v_jam_masuk, 
								jadwal_pulang = v_jam_pulang
								WHERE tgl_abs=v_date_ AND emp_id=v_emp_id;
								
							END IF;

							
							
							
							SET v_date_= STR_TO_DATE(v_start_date, '%Y-%m-%d') + INTERVAL v_cnt DAY;
							SET v_cnt = v_cnt + 1;
						END WHILE;

			END IF;
			

		END IF;

	  COMMIT;

		-- SELECT CONCAT(v_id_abs_type,';',v_jam_masuk,';',v_jml);
		-- SET v_result = v_pengajuan_id;
 		-- SELECT v_result;
		-- SELECT CONCAT(v_result,'--',v_id_tp,';',v_jam_masuk,';',v_jam_pulang);	

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_AUTO_GENERATE_ALL
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_AUTO_GENERATE_ALL`;
delimiter ;;
CREATE PROCEDURE `Z_P_AUTO_GENERATE_ALL`(v_tahun INT, v_bulan INT)
BEGIN
		
	DECLARE v_start_month VARCHAR(2);
	DECLARE v_end_month VARCHAR(2);
	DECLARE v_month_start VARCHAR(2);
  DECLARE v_month_end VARCHAR(2);
	DECLARE var_start_date_loop DATE; 
	DECLARE var_start_date DATE; 
	DECLARE var_end_date DATE; 
	DECLARE v_x INT;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
				ROLLBACK;
				RESIGNAL;
		END;

		START TRANSACTION;
			
			SET v_end_month = v_bulan;
			IF LENGTH(v_bulan) = 1 THEN
				SET v_end_month = CONCAT('0',v_bulan);
			END IF;

			SET var_start_date = CONCAT(v_tahun,'-',v_end_month,'-','01');
			SET var_start_date_loop = CONCAT(v_tahun,'-',v_end_month,'-','01');
			SET var_end_date = LAST_DAY(var_start_date_loop);
			
			-- INSERT ALL LOG ABSENSI
			INSERT INTO z_lap_absensi_log
			(
				nik, compid, unitid, tgl_abs, jam_in, jam_out, id_abs_type, id_tp, emp_id, jadwal_masuk, jadwal_pulang, device
			) 
			SELECT 
				a.nik, a.compid, b.unitid, a.tgl_abs, a.jam_in, a.jam_out, a.id_abs_type, a.id_tp, b.emp_id, a.jadwal_masuk, a.jadwal_pulang, a.device
			FROM z_absensi a join z_karyawan b on a.emp_id = b.emp_id
			WHERE  
			b.active=1 AND
			a.tgl_abs >= var_start_date AND a.tgl_abs <= var_end_date
			ON DUPLICATE KEY UPDATE 
			remark = '1',
			jam_in = a.jam_in,
			jam_out = a.jam_out,
			device = a.device;
			

			SET v_x = 1;
			WHILE v_x <= 1 
			DO
					CALL Z_P_LAP_GENERATE_ORI(v_x, 0, v_tahun, v_bulan, 1);	
					SET v_x = v_x + 1;
			END WHILE;
	
	COMMIT;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_LAP_GENERATE_ABSENSI_BULANAN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_LAP_GENERATE_ABSENSI_BULANAN`;
delimiter ;;
CREATE PROCEDURE `Z_P_LAP_GENERATE_ABSENSI_BULANAN`(`v_compid` BIGINT, `v_emp_id` INT, `v_year` VARCHAR(4), `v_month` VARCHAR(2))
BEGIN 

	DECLARE v_result VARCHAR(50);

  -- DECLARE CALENDAR
	DECLARE v_start_date INT;
	DECLARE v_end_date INT;
	DECLARE v_last_year INT;
	DECLARE v_start_month VARCHAR(2);
	DECLARE v_end_month VARCHAR(2);
	DECLARE v_month_start VARCHAR(2);
  DECLARE v_month_end VARCHAR(2);
	DECLARE var_start_date_loop DATE; 
	DECLARE var_start_date DATE; 
	DECLARE var_end_date DATE; 
	DECLARE v_stat_libur INT;
	DECLARE v_ket_libur VARCHAR(100);
	DECLARE v_comp_code VARCHAR(6);
	DECLARE v_ret_pengajuan VARCHAR(100);
	
	-- DECLARE EMPLOYEE
	DECLARE v_cnt_emp INT;
	DECLARE v_inp_emp_id INT;
	DECLARE v_unitid INT;
	DECLARE v_inp_nik VARCHAR(22);
	DECLARE v_x INT;

  -- DECLARE PERHITUNGAN

  DECLARE v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang, v_total_jam_kerja DECIMAL(10,2);
	
	
	-- DECLARE PENGAJUAN APP
	DECLARE v_x_pengajuan INT;
  DECLARE	v_cnt_pengajuan INT;
	DECLARE	v_inp_menu_id INT; 
	DECLARE v_inp_nik_pengajuan VARCHAR(36);
	DECLARE	v_inp_id_aju VARCHAR(36);

  -- SETUP CALENDAR
	DROP TEMPORARY TABLE IF EXISTS tmp_calendar;
	CREATE TEMPORARY TABLE tmp_calendar
	(cDate datetime, cDay int, cDayOfWeek int, cDayName varchar(20), cMonth int, cStatLibur int, cKeterangan varchar(100) );
	

	/*SETUP KARYAWAN*/
	DROP TEMPORARY TABLE IF EXISTS tmp_karyawan;
	CREATE TEMPORARY TABLE tmp_karyawan (
			id INT NOT NULL AUTO_INCREMENT,
			emp_id INT,
			nik VARCHAR(33),
			unitid INT,
			PRIMARY KEY (id)
	);
	/*END SETUP KARYAWAN*/
	
	
	/*SETUP KARYAWAN*/
	DROP TEMPORARY TABLE IF EXISTS tmp_pengajuan;
	CREATE TEMPORARY TABLE tmp_pengajuan (
			id INT NOT NULL AUTO_INCREMENT,
			id_aju VARCHAR(36),
			nik VARCHAR(36),
			menu_id INT,
			PRIMARY KEY (id)
	);
	/*END SETUP KARYAWAN*/
		
  -- Period penggajian
	SELECT tgl_awal, tgl_akhir, comp_code INTO v_start_date, v_end_date, v_comp_code FROM z_periode_gaji WHERE compid = v_compid;

	SET v_end_month = v_month;
	IF LENGTH(v_month) = 1 THEN
		SET v_end_month = CONCAT('0',v_month);
	END IF;

	SET var_end_date = CONCAT(v_year,v_end_month,v_end_date);
	
	SET v_month_start = (MONTH(var_end_date - INTERVAL 1 MONTH));

	IF v_month_start < 10 THEN 
		SET v_month_start = CONCAT('0',v_month_start);
	END IF;
	
  IF v_month  = '1' THEN 
		SET v_last_year = v_year - 1;
		SET var_start_date = CONCAT(v_last_year,v_month_start,v_start_date);
	ELSE 
		SET var_start_date = CONCAT(v_year,v_month_start,v_start_date);
	END IF;
	
	SET var_start_date_loop = var_start_date;
	WHILE var_start_date_loop <= var_end_date
	DO
			-- SET v_ket_libur = '';
			-- SELECT COUNT(tanggal), keterangan INTO v_stat_libur, v_ket_libur FROM z_factory_cal  WHERE tanggal = var_start_date_loop AND compid=v_compid;

			INSERT INTO tmp_calendar 
			(cDate, cDay, cDayOfWeek, cDayName, cMonth) -- , cStatLibur, cKeterangan)
			SELECT var_start_date_loop, 
						 DAY(var_start_date_loop), 
						 DAYOFWEEK(var_start_date_loop), 
						 DAYOFMONTH(var_start_date_loop),
						 MONTH (var_start_date_loop)
						
						 /*CASE 
								WHEN v_stat_libur > 0  THEN 1
								WHEN DAYOFWEEK(var_start_date) =  1 THEN 1
								WHEN DAYOFWEEK(var_start_date) =  7 THEN 1
							  ELSE 0 
						 END AS stat,
						 v_ket_libur*/
							;
 
			SET var_start_date_loop = TIMESTAMPADD(day, 1, var_start_date_loop);
	END WHILE;
	
  -- update libur weekend
	UPDATE tmp_calendar SET
	cStatLibur = 1, 
	cKeterangan = 'Hari Libur' 
	WHERE DAYOFWEEK(cDate) IN(1,7) ;

  -- UPDATE hari libur kalender
	UPDATE tmp_calendar
	INNER JOIN z_factory_cal ON tmp_calendar.cDate = z_factory_cal.tanggal
	SET 
	tmp_calendar.cStatLibur = 1, 
	tmp_calendar.cKeterangan = z_factory_cal.keterangan
	WHERE z_factory_cal.compid = v_compid;

	-- END SETUP CALENDAR


		-- REKAP DETAIL ABSEN
		INSERT INTO tmp_karyawan (emp_id, nik, unitid)
		SELECT emp_id, nik, unitid FROM z_karyawan WHERE compid = v_compid AND active=1 AND 
		(CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
		
		
		-- INSERT KE TABLE LOG ABSENSI REPORT
	
		DELETE FROM z_lap_absensi_log 
		WHERE compid=v_compid AND tgl_abs >= var_start_date AND tgl_abs <= var_end_date 
		AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
		
		
		INSERT INTO z_lap_absensi_log
		(
			nik, comp_code, compid, unitid, tgl_abs, jam_in, jam_out, id_abs_type, id_tp, emp_id, jadwal_masuk, jadwal_pulang
		)
		SELECT 
			a.nik, a.comp_code, a.compid, b.unitid, a.tgl_abs, a.jam_in, a.jam_out, a.id_abs_type, a.id_tp, b.emp_id, a.jadwal_masuk, a.jadwal_pulang
		FROM z_absensi a join z_karyawan b on a.emp_id = b.emp_id
		WHERE b.compid=v_compid AND  a.tgl_abs >= var_start_date AND a.tgl_abs <= var_end_date 
		-- AND (CASE WHEN v_is_pns <> 0 THEN b.is_pns = v_is_pns ELSE b.is_pns = v_is_pns  END )
		AND (CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END )
		ORDER BY a.tgl_abs, a.emp_id
		ON DUPLICATE KEY UPDATE 
		jam_in = a.jam_in,
		jam_out = a.jam_out,
		remark = '1';
					
	

				 -- ================================== AUTO GENERATE APPROVE ==============================================
		
		INSERT INTO tmp_pengajuan (id_aju,nik,menu_id)
		 
		SELECT tb.id_aju, tb.nik, tb.menu_id FROM (
		
					-- IZIN
					SELECT 
					a.id_aju, a.jns_aju, b.jns_izin, a.nik, c.emp_name, c.unitid, 
					b.tgl_awal_izin, b.tgl_akhir_izin , 'IZIN' AS jenis_app, 2 AS menu_id
					FROM z_head_aju a
					JOIN z_r_izin b on a.id_aju =  b.id_aju
					JOIN z_karyawan c on a.nik = c.nik
					WHERE 
					a.active = 1 AND
					c.compid = v_compid AND c.active=1 AND 
					(CASE WHEN v_emp_id <> 0 THEN c.emp_id = v_emp_id ELSE c.emp_id > 0 END ) AND 
					b.tgl_awal_izin BETWEEN var_start_date AND var_end_date AND a.sts_aju=1
					
					UNION ALL
					
					-- DINAS
					SELECT 
					a.id_aju, a.jns_aju, a.jns_aju, a.nik, c.emp_name, c.unitid, 
					b.tgl_brkt, b.tgl_plng , 'DINAS' AS jenis_app, 6 AS menu_id
					FROM z_head_aju a
					JOIN z_r_jalandinas b on a.id_aju =  b.id_aju
					JOIN z_karyawan c on a.nik = c.nik
					WHERE 
					a.active = 1 AND
					c.compid = v_compid AND c.active=1 AND 
					(CASE WHEN v_emp_id <> 0 THEN c.emp_id = v_emp_id ELSE c.emp_id > 0 END ) AND 
					b.tgl_brkt BETWEEN var_start_date AND var_end_date AND a.sts_aju=1

					UNION ALL
					
					-- CUTI
					SELECT 
					a.id_aju, a.jns_aju, b.cuti_id, a.nik, c.emp_name, c.unitid, 
					b.tgl_awal_cuti, b.tgl_akhir_cuti, 'CUTI' AS jenis_app, 3 AS menu_id
					FROM z_head_aju a
					JOIN z_r_cuti b on a.id_aju =  b.id_aju
					JOIN z_karyawan c on a.nik = c.nik
					WHERE 
					a.active = 1 AND
					c.compid = v_compid AND c.active=1 AND 
					(CASE WHEN v_emp_id <> 0 THEN c.emp_id = v_emp_id ELSE c.emp_id > 0 END ) AND 
					b.tgl_awal_cuti BETWEEN var_start_date AND var_end_date AND a.sts_aju=1

		
		) AS tb;
		
		
		SET v_x_pengajuan = 1;
		SET v_cnt_pengajuan = (SELECT COUNT(id) FROM tmp_pengajuan);
		IF v_cnt_pengajuan > 0 THEN 
				WHILE v_x_pengajuan <= v_cnt_pengajuan
				DO
				
						SELECT id_aju, nik, menu_id INTO v_inp_id_aju, v_inp_nik_pengajuan, v_inp_menu_id  FROM tmp_pengajuan	WHERE id=v_x_pengajuan;
						CALL Z_P_APPROVE_PENGAJUAN_AUTOGENERATE (v_inp_id_aju, v_inp_nik_pengajuan, v_comp_code,  v_inp_menu_id);
						
						SET v_x_pengajuan = v_x_pengajuan + 1;
						
				END WHILE;
		END IF;





		-- INSERT KE TABLE REKAP DETAIL
		DELETE FROM z_lap_rekap_details 
		WHERE compid=v_compid AND tahun=v_year AND bulan=v_month
		AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
		
	
		-- INSERT DARI TANGGAL CALENDAR
		SET v_x = 1;
		SET v_cnt_emp = (SELECT COUNT(id) FROM tmp_karyawan);
		WHILE v_x <= v_cnt_emp
		DO
					SET v_inp_emp_id = 0;
					SELECT emp_id, nik, unitid INTO v_inp_emp_id, v_inp_nik, v_unitid FROM tmp_karyawan	WHERE id=v_x;
					INSERT INTO z_lap_rekap_details (compid, tahun, bulan, emp_id, nik, tanggal, id_abs_type, ket_libur, unitid)
					SELECT v_compid, v_year, v_month, v_inp_emp_id, v_inp_nik, a.cDate, 0 , a.Cketerangan AS keterangan, v_unitid 
					FROM tmp_calendar a 
					ON DUPLICATE KEY UPDATE 
					remark = '1',
					ket_libur = a.Cketerangan;
						
			SET v_x = v_x + 1;

		END WHILE;
	
	
	
			-- INSERT DARI TANGGAL ABSENSI ASLI / EXISTING
		
		INSERT INTO z_lap_rekap_details (tanggal, compid, unitid, tahun, bulan, emp_id, nik, jam_masuk, jam_pulang, id_abs_type)
		SELECT a.tgl_abs, v_compid, b.unitid, v_year, v_month, a.emp_id, b.nik, COALESCE(a.jam_in,'0000-00-00 00:00:00'), COALESCE(a.jam_out,'0000-00-00 00:00:00'), a.id_abs_type
		FROM z_lap_absensi_log a
		JOIN z_karyawan b ON a.emp_id = b.emp_id
		JOIN z_absen_type c ON a.id_abs_type = c.id_abs_type
		WHERE b.compid=v_compid AND  a.tgl_abs >= var_start_date AND a.tgl_abs <= var_end_date 
		-- AND (CASE WHEN v_is_pns <> 0 THEN b.is_pns = v_is_pns ELSE b.is_pns = v_is_pns  END )
		AND (CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END )
		ORDER BY a.tgl_abs, a.emp_id
		ON DUPLICATE KEY UPDATE
		jam_masuk = COALESCE(a.jam_in,'0000-00-00 00:00:00'),
		jam_pulang = COALESCE(a.jam_out,'0000-00-00 00:00:00'),
		remark = '1',
		id_abs_type = a.id_abs_type;
		
		
		-- UPDATE DARI TANGGAL ABSENSI ASLI / EXISTING
	 
		UPDATE z_lap_rekap_details  a  
		JOIN z_lap_absensi_log b ON a.tanggal = b.tgl_abs AND 
														  a.emp_id = b.emp_id
		JOIN z_absen_type c ON a.id_abs_type = c.id_abs_type
		SET 
		a.jam_masuk = b.jam_in,
		a.jam_pulang = b.jam_out,
		a.id_abs_type = b.id_abs_type,
		a.keterangan = c.abs_type_desc,
		a.id_tp = b.id_tp,
		a.jdwl_masuk = b.jadwal_masuk,
		a.jdwl_pulang = b.jadwal_pulang
	
		WHERE 
		b.compid=v_compid AND  a.tanggal >= var_start_date AND a.tanggal <= var_end_date AND
		(CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END );
	
	
	
	
	
	 -- UPDATE DARI TANGGAL ABSENSI ASLI / EXISTING
	/*
	UPDATE z_lap_rekap_details, z_lap_absensi_log, z_absen_type 
	SET 
	z_lap_rekap_details.jam_masuk = z_lap_absensi_log.jam_in,
	z_lap_rekap_details.jam_pulang = z_lap_absensi_log.jam_out,
	z_lap_rekap_details.id_abs_type = z_absen_type.id_abs_type,
	z_lap_rekap_details.keterangan = z_absen_type.abs_type_desc,
	z_lap_rekap_details.id_tp = z_lap_absensi_log.id_tp,
	z_lap_rekap_details.jdwl_masuk = z_lap_absensi_log.jadwal_masuk,
	z_lap_rekap_details.jdwl_pulang = z_lap_absensi_log.jadwal_pulang	
	WHERE 
	z_lap_rekap_details.tanggal = z_lap_absensi_log.tgl_abs AND 
	z_lap_rekap_details.emp_id = z_lap_absensi_log.emp_id AND
	-- z_lap_absensi_log.id_abs_type = z_absen_type.id_abs_type AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );
 */
	
	 
	-- UPDATE HARI LIBUR 
	UPDATE z_lap_rekap_details, tmp_calendar
	SET 
  z_lap_rekap_details.id_abs_type = 12,
	z_lap_rekap_details.stat_libur = tmp_calendar.cStatLibur, 
	z_lap_rekap_details.keterangan = tmp_calendar.cKeterangan
	WHERE
  z_lap_rekap_details.tanggal = tmp_calendar.Cdate AND
  tmp_calendar.cStatLibur = 1 AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );

	-- UPDATE HARI ALFA 
	UPDATE z_lap_rekap_details 
	SET 
	z_lap_rekap_details.id_abs_type = 8,
	z_lap_rekap_details.keterangan = 'Alpha'
	WHERE 
	z_lap_rekap_details.id_abs_type = 0 AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );

	-- UPDATE JAM KERJA
	
	SELECT jml_jam_istirahat * 60, batas_jam_masuk * 60, batas_jam_pulang * 60
	INTO v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang FROM z_compcode WHERE compid=v_compid;
	
-- 	SELECT jml_jam_istirahat, batas_jam_masuk, batas_jam_pulang, toleransi_telat
-- 	INTO v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang,  v_toleransi_telat FROM z_time_profile 
-- 	WHERE compid=1 AND active=1 LIMIT 1;
	
	SET v_total_jam_kerja = (v_jml_batas_masuk + v_jml_batas_pulang);

	UPDATE z_lap_rekap_details a
	SET 
	a.jml_jam_kerja = 
			-- JIKA MASUK
			CASE 
			WHEN a.id_abs_type IN(1,2) THEN  		
				 CASE 
							-- JIKA ADA JAM MASUK DAN PULANG		
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
									  CASE WHEN (TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - v_jml_jam_istirahat ) <= 0 THEN 
												0
										ELSE 
												TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - v_jml_jam_istirahat
										END
							-- JIKA ADA JAM MASUK DAN TIDAK ADA JAM PULANG				
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN 
										v_jml_batas_masuk 
							WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN 
										v_jml_batas_pulang
					END
			WHEN a.id_abs_type IN(9,10) THEN	
					v_total_jam_kerja
      END,

		a.jml_jam_kurang = 
			-- JIKA MASUK
			CASE 
			WHEN a.id_abs_type IN(1,2) THEN  		
				 CASE 
							-- JIKA ADA JAM MASUK DAN PULANG		
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
									CASE WHEN (TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat) ) < 0 THEN 
											CASE WHEN ((TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat)  ) * -1 ) > v_total_jam_kerja THEN 
													0
											ELSE 
													(TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat) ) * -1
											END
									ELSE  
											0
									END
							-- JIKA ADA JAM MASUK DAN TIDAK ADA JAM PULANG				
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN 
										v_jml_batas_pulang
							WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN 
										v_jml_batas_masuk
					END

			WHEN a.id_abs_type IN(8) THEN  
					v_total_jam_kerja 
			WHEN a.id_abs_type IN(9,10) THEN	
					0
      END,


			a.jml_terlambat = 
				CASE 
				WHEN a.id_abs_type IN(1,2) THEN
						CASE 
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jam_masuk,jdwl_masuk) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN
										1
								WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jam_masuk,jdwl_masuk) < 0 THEN 1 ELSE 0 END
						ELSE 0 
						END
				ELSE 
						0
				END,


		a.jml_psw = 
				CASE 
				WHEN a.id_abs_type IN(1,2) THEN
						CASE 
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jdwl_pulang,jam_pulang) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jdwl_pulang,jam_pulang) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										1
						ELSE 0 
						END
				ELSE 
						0
				END
	WHERE
	a.compid = v_compid AND
	a.bulan = v_month AND
	a.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END );

	
	-- END REKAP DETAIL ABSEN
	
	-- SUMMARY
	DELETE FROM z_lap_rekap_summary
	WHERE compid=v_compid AND tahun=v_year AND bulan=v_month
	AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
	INSERT INTO z_lap_rekap_summary 
	(
		emp_id,compid,bulan,tahun,
		jml_hadir,jml_terlambat,jml_alpha,
		jml_cuti,jml_dinas,jml_izin,jml_sakit,jml_reimburse,
		jml_jam_kurang,jml_jam_kerja
	)
	SELECT 
	a.emp_id, v_compid, v_month, v_year, 
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (1,2)),0) AS jml_hadir,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_terlambat = 1),0) AS jml_terlambat,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (8)),0) AS jml_alpha,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (7)),0) AS jml_cuti,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (9)),0) AS jml_dinas,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (3,4,5)),0) AS jml_izin,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (6)),0) AS jml_sakit,
	COALESCE((SELECT SUM(x.head_text2) FROM z_head_aju x  WHERE x.nik = a.nik  AND YEAR(x.tgl_aju) = v_year  AND  MONTH(x.tgl_aju) = v_month AND x.sts_aju IN (1)),0) AS jml_reimburse,
	COALESCE((SELECT SUM(x.jml_jam_kurang) / 60 FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_jam_kurang > 0),0) AS jml_jam_kurang,
	COALESCE((SELECT SUM(x.jml_jam_kerja) / 60 FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_jam_kerja > 0),0) AS jml_jam_kerja
	FROM tmp_karyawan a;
	-- END SUMMARY
	-- SELECT * FROM z_lap_rekap_summary ORDER BY emp_id;
	-- SELECT * FROM z_lap_rekap_details ORDER BY emp_id, tanggal;


	
	SET v_result = '1';
	SELECT v_result;
	 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_LAP_GENERATE_ABSENSI_BULANAN_
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_LAP_GENERATE_ABSENSI_BULANAN_`;
delimiter ;;
CREATE PROCEDURE `Z_P_LAP_GENERATE_ABSENSI_BULANAN_`(`v_compid` BIGINT, `v_emp_id` INT, `v_year` VARCHAR(4), `v_month` VARCHAR(2))
BEGIN 

	DECLARE v_result VARCHAR(50);

  -- DECLARE CALENDAR
	DECLARE v_start_date INT;
	DECLARE v_end_date INT;
	DECLARE v_last_year INT;
	DECLARE v_start_month VARCHAR(2);
	DECLARE v_end_month VARCHAR(2);
	DECLARE v_month_start VARCHAR(2);
  DECLARE v_month_end VARCHAR(2);
	DECLARE var_start_date_loop DATE; 
	DECLARE var_start_date DATE; 
	DECLARE var_end_date DATE; 
	DECLARE v_stat_libur INT;
	DECLARE v_ket_libur VARCHAR(100);

	
	-- DECLARE EMPLOYEE
	DECLARE v_cnt_emp INT;
	DECLARE v_inp_emp_id INT;
	DECLARE v_inp_nik VARCHAR(22);
	DECLARE v_x INT;

  -- DECLARE PERHITUNGAN

  DECLARE v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang, v_total_jam_kerja DECIMAL(10,2);


  -- SETUP CALENDAR
	DROP TEMPORARY TABLE IF EXISTS tmp_calendar;
	CREATE TEMPORARY TABLE tmp_calendar
	(cDate datetime, cDay int, cDayOfWeek int, cDayName varchar(20), cMonth int, cStatLibur int, cKeterangan varchar(100) );
	

	/*SETUP KARYAWAN*/
	DROP TEMPORARY TABLE IF EXISTS tmp_karyawan;
	CREATE TEMPORARY TABLE tmp_karyawan (
			id INT NOT NULL AUTO_INCREMENT,
			emp_id INT,
			nik VARCHAR(22),
			PRIMARY KEY (id)
	);
	/*END SETUP KARYAWAN*/
		
  -- Period penggajian
	SELECT tgl_awal, tgl_akhir INTO v_start_date, v_end_date FROM z_periode_gaji WHERE compid = v_compid;

	SET v_end_month = v_month;
	IF LENGTH(v_month) = 1 THEN
		SET v_end_month = CONCAT('0',v_month);
	END IF;

	SET var_end_date = CONCAT(v_year,v_end_month,v_end_date);
	
	SET v_month_start = (MONTH(var_end_date - INTERVAL 1 MONTH));

	IF v_month_start < 10 THEN 
		SET v_month_start = CONCAT('0',v_month_start);
	END IF;
	
  IF v_month  = '1' THEN 
		SET v_last_year = v_year - 1;
		SET var_start_date = CONCAT(v_last_year,v_month_start,v_start_date);
	ELSE 
		SET var_start_date = CONCAT(v_year,v_month_start,v_start_date);
	END IF;
	
	SET var_start_date_loop = var_start_date;
	WHILE var_start_date_loop <= var_end_date
	DO
			-- SET v_ket_libur = '';
			-- SELECT COUNT(tanggal), keterangan INTO v_stat_libur, v_ket_libur FROM z_factory_cal  WHERE tanggal = var_start_date_loop AND compid=v_compid;

			INSERT INTO tmp_calendar 
			(cDate, cDay, cDayOfWeek, cDayName, cMonth) -- , cStatLibur, cKeterangan)
			SELECT var_start_date_loop, 
						 DAY(var_start_date_loop), 
						 DAYOFWEEK(var_start_date_loop), 
						 DAYOFMONTH(var_start_date_loop),
						 MONTH (var_start_date_loop)
						
						 /*CASE 
								WHEN v_stat_libur > 0  THEN 1
								WHEN DAYOFWEEK(var_start_date) =  1 THEN 1
								WHEN DAYOFWEEK(var_start_date) =  7 THEN 1
							  ELSE 0 
						 END AS stat,
						 v_ket_libur*/
							;
 
			SET var_start_date_loop = TIMESTAMPADD(day, 1, var_start_date_loop);
	END WHILE;
	
  -- update libur weekend
	UPDATE tmp_calendar SET
	cStatLibur = 1, 
	cKeterangan = 'Hari Libur' 
	WHERE DAYOFWEEK(cDate) IN(1,7) ;

  -- UPDATE hari libur kalender
	UPDATE tmp_calendar
	INNER JOIN z_factory_cal ON tmp_calendar.cDate = z_factory_cal.tanggal
	SET 
	tmp_calendar.cStatLibur = 1, 
	tmp_calendar.cKeterangan = z_factory_cal.keterangan
	WHERE z_factory_cal.compid = v_compid;

	-- END SETUP CALENDAR


	-- REKAP DETAIL ABSEN
	INSERT INTO tmp_karyawan (emp_id, nik)
	SELECT emp_id, nik FROM z_karyawan WHERE compid = v_compid AND active=1 AND 
	(CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );


	DELETE FROM z_lap_rekap_details 
	WHERE compid=v_compid AND tahun=v_year AND bulan=v_month
	AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
	-- INSERT DARI TANGGAL ABSENSI ASLI / EXISTING
	INSERT INTO z_lap_rekap_details (tanggal, compid, tahun, bulan, emp_id)
	SELECT DISTINCT a.tgl_abs, v_compid, v_year, v_month, a.emp_id
	FROM z_absensi a
	JOIN z_karyawan b ON a.emp_id = b.emp_id
	JOIN z_absen_type c ON a.id_abs_type = c.id_abs_type
	WHERE b.compid=v_compid AND  a.tgl_abs >= var_start_date AND a.tgl_abs <= var_end_date
	AND (CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END )
	ORDER BY a.tgl_abs, a.emp_id;


  -- UPDATE DARI TANGGAL ABSENSI ASLI / EXISTING
	
	UPDATE z_lap_rekap_details, z_absensi, z_absen_type 
	SET 

	z_lap_rekap_details.jam_masuk = z_absensi.jam_in,
	z_lap_rekap_details.jam_pulang = z_absensi.jam_out,
	z_lap_rekap_details.id_abs_type = z_absen_type.id_abs_type,
	z_lap_rekap_details.keterangan = z_absen_type.abs_type_desc,
	z_lap_rekap_details.id_tp = z_absensi.id_tp,
	z_lap_rekap_details.jdwl_masuk = z_absensi.jadwal_masuk,
	z_lap_rekap_details.jdwl_pulang = z_absensi.jadwal_pulang
	
	WHERE 
	z_lap_rekap_details.tanggal = z_absensi.tgl_abs AND 
	z_lap_rekap_details.emp_id = z_absensi.emp_id AND
  z_absensi.id_abs_type = z_absen_type.id_abs_type AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );
	
		
	-- INSERT DARI TANGGAL CALENDAR
	SET v_x = 1;
	SET v_cnt_emp = (SELECT COUNT(id) FROM tmp_karyawan);
	WHILE v_x <= v_cnt_emp
	DO
	 
		SELECT emp_id , nik INTO v_inp_emp_id, v_inp_nik  FROM tmp_karyawan	WHERE id=v_x;
		INSERT INTO z_lap_rekap_details (compid, tahun, bulan, emp_id, tanggal, id_abs_type, ket_libur)
	  SELECT v_compid, v_year, v_month, v_inp_emp_id, a.cDate, 0 , a.Cketerangan AS keterangan 
	  FROM tmp_calendar a WHERE a.cDate NOT IN 
		(SELECT x.tanggal FROM z_lap_rekap_details x 
					WHERE x.emp_id=v_inp_emp_id AND x.compid=v_compid AND x.tahun = v_year  AND x.bulan = v_month );
		SET v_x = v_x + 1;

	END WHILE;
 
  -- UPDATE HARI LIBUR 
	UPDATE z_lap_rekap_details, tmp_calendar
	SET 
  z_lap_rekap_details.id_abs_type = 12,
	z_lap_rekap_details.stat_libur = tmp_calendar.cStatLibur, 
	z_lap_rekap_details.keterangan = tmp_calendar.cKeterangan
	WHERE
  z_lap_rekap_details.tanggal = tmp_calendar.Cdate AND
  tmp_calendar.cStatLibur = 1 AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );

	-- UPDATE HARI ALFA 
	UPDATE z_lap_rekap_details 
	SET 
	z_lap_rekap_details.id_abs_type = 8,
	z_lap_rekap_details.keterangan = 'Alpha'
	WHERE 
	z_lap_rekap_details.id_abs_type = 0 AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );

	-- UPDATE JAM KERJA
	
	SELECT jml_jam_istirahat * 60, batas_jam_masuk * 60, batas_jam_pulang * 60
	INTO v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang FROM z_compcode WHERE compid=v_compid;
	
	SET v_total_jam_kerja = (v_jml_batas_masuk + v_jml_batas_pulang);

	UPDATE z_lap_rekap_details a
	SET 
	a.jml_jam_kerja = 
			-- JIKA MASUK
			CASE 
			WHEN a.id_abs_type IN(1,2) THEN  		
				 CASE 
							-- JIKA ADA JAM MASUK DAN PULANG		
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
									  CASE WHEN (TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - v_jml_jam_istirahat ) <= 0 THEN 
												0
										ELSE 
												TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - v_jml_jam_istirahat
										END
							-- JIKA ADA JAM MASUK DAN TIDAK ADA JAM PULANG				
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN 
										v_jml_batas_masuk 
							WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN 
										v_jml_batas_pulang
					END
			WHEN a.id_abs_type IN(9,10) THEN	
					v_total_jam_kerja
      END,

		a.jml_jam_kurang = 
			-- JIKA MASUK
			CASE 
			WHEN a.id_abs_type IN(1,2) THEN  		
				 CASE 
							-- JIKA ADA JAM MASUK DAN PULANG		
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
									CASE WHEN (TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat) ) < 0 THEN 
											CASE WHEN ((TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat)  ) * -1 ) > v_total_jam_kerja THEN 
													0
											ELSE 
													(TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat) ) * -1
											END
									ELSE  
											0
									END
							-- JIKA ADA JAM MASUK DAN TIDAK ADA JAM PULANG				
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN 
										v_jml_batas_pulang
							WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN 
										v_jml_batas_masuk
					END
			WHEN a.id_abs_type IN(8) THEN  
					v_total_jam_kerja 
			WHEN a.id_abs_type IN(9,10) THEN	
					0
      END,


			a.jml_terlambat = 
				CASE 
				WHEN a.id_abs_type IN(1,2) THEN
						CASE 
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jam_masuk,jdwl_masuk) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN
										1
								WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jam_masuk,jdwl_masuk) < 0 THEN 1 ELSE 0 END
						ELSE 0 
						END
				ELSE 
						0
				END,


		a.jml_psw = 
				CASE 
				WHEN a.id_abs_type IN(1,2) THEN
						CASE 
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jdwl_pulang,jam_pulang) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jdwl_pulang,jam_pulang) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										1
						ELSE 0 
						END
				ELSE 
						0
				END
	WHERE
	a.compid = v_compid AND
	a.bulan = v_month AND
	a.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END );

	
	-- END REKAP DETAIL ABSEN
	
	-- SUMMARY
	DELETE FROM z_lap_rekap_summary
	WHERE compid=v_compid AND tahun=v_year AND bulan=v_month
	AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
	INSERT INTO z_lap_rekap_summary 
	(
		emp_id,compid,bulan,tahun,
		jml_hadir,jml_terlambat,jml_alpha,
		jml_cuti,jml_dinas,jml_izin,jml_sakit,jml_reimburse,
		jml_jam_kurang,jml_jam_kerja
	)
	SELECT 
	a.emp_id, v_compid, v_month, v_year, 
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (1,2)),0) AS jml_hadir,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_terlambat = 1),0) AS jml_terlambat,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (8)),0) AS jml_alpha,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (7)),0) AS jml_cuti,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (9)),0) AS jml_dinas,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (3,4,5)),0) AS jml_izin,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (6)),0) AS jml_sakit,
	COALESCE((SELECT SUM(x.head_text2) FROM z_head_aju x  WHERE x.nik = a.nik  AND YEAR(x.tgl_aju) = v_year  AND  MONTH(x.tgl_aju) = v_month AND x.sts_aju IN (1)),0) AS jml_reimburse,
	COALESCE((SELECT SUM(x.jml_jam_kurang) / 60 FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_jam_kurang > 0),0) AS jml_jam_kurang,
	COALESCE((SELECT SUM(x.jml_jam_kerja) / 60 FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_jam_kerja > 0),0) AS jml_jam_kerja
	FROM tmp_karyawan a;
	-- END SUMMARY
	-- SELECT * FROM z_lap_rekap_summary ORDER BY emp_id;
	-- SELECT * FROM z_lap_rekap_details ORDER BY emp_id, tanggal;

	SET v_result = '1';
	SELECT v_result;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_LAP_GENERATE_ORI
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_LAP_GENERATE_ORI`;
delimiter ;;
CREATE PROCEDURE `Z_P_LAP_GENERATE_ORI`(`v_compid` BIGINT, `v_emp_id` INT, `v_year` VARCHAR(4), `v_month` VARCHAR(2))
BEGIN 

	DECLARE v_result VARCHAR(50);

  -- DECLARE CALENDAR
	DECLARE v_start_date INT;
	DECLARE v_end_date INT;
	DECLARE v_last_year INT;
	DECLARE v_start_month VARCHAR(2);
	DECLARE v_end_month VARCHAR(2);
	DECLARE v_month_start VARCHAR(2);
  DECLARE v_month_end VARCHAR(2);
	DECLARE var_start_date_loop DATE; 
	DECLARE var_start_date DATE; 
	DECLARE var_end_date DATE; 
	DECLARE v_stat_libur INT;
	DECLARE v_ket_libur VARCHAR(100);
	DECLARE v_comp_code VARCHAR(6);
	
	-- DECLARE EMPLOYEE
	DECLARE v_cnt_emp INT;
	DECLARE v_inp_emp_id INT;
	DECLARE v_unitid INT;
	DECLARE v_inp_nik VARCHAR(22);
	DECLARE v_x INT;

  -- DECLARE PERHITUNGAN

  DECLARE v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang, v_total_jam_kerja DECIMAL(10,2);
	
	
	-- DECLARE PENGAJUAN APP
	DECLARE v_x_pengajuan INT;
  DECLARE	v_cnt_pengajuan INT;
	DECLARE	v_inp_menu_id INT; 
	DECLARE v_inp_nik_pengajuan VARCHAR(36);
	DECLARE	v_inp_id_aju VARCHAR(36);

  -- SETUP CALENDAR
	DROP TEMPORARY TABLE IF EXISTS tmp_calendar;
	CREATE TEMPORARY TABLE tmp_calendar
	(cDate datetime, cDay int, cDayOfWeek int, cDayName varchar(20), cMonth int, cStatLibur int, cKeterangan varchar(100) );
	

	/*SETUP KARYAWAN*/
	DROP TEMPORARY TABLE IF EXISTS tmp_karyawan;
	CREATE TEMPORARY TABLE tmp_karyawan (
			id INT NOT NULL AUTO_INCREMENT,
			emp_id INT,
			nik VARCHAR(33),
			unitid INT,
			PRIMARY KEY (id)
	);
	/*END SETUP KARYAWAN*/
	
	
	/*SETUP KARYAWAN*/
	DROP TEMPORARY TABLE IF EXISTS tmp_pengajuan;
	CREATE TEMPORARY TABLE tmp_pengajuan (
			id INT NOT NULL AUTO_INCREMENT,
			id_aju VARCHAR(36),
			nik VARCHAR(36),
			menu_id INT,
			PRIMARY KEY (id)
	);
	/*END SETUP KARYAWAN*/
		
  -- Period penggajian
	SELECT tgl_awal, tgl_akhir, comp_code INTO v_start_date, v_end_date, v_comp_code FROM z_periode_gaji WHERE compid = v_compid;

	SET v_end_month = v_month;
	IF LENGTH(v_month) = 1 THEN
		SET v_end_month = CONCAT('0',v_month);
	END IF;

	SET var_end_date = CONCAT(v_year,v_end_month,v_end_date);
	
	SET v_month_start = (MONTH(var_end_date - INTERVAL 1 MONTH));

	IF v_month_start < 10 THEN 
		SET v_month_start = CONCAT('0',v_month_start);
	END IF;
	
  IF v_month  = '1' THEN 
		SET v_last_year = v_year - 1;
		SET var_start_date = CONCAT(v_last_year,v_month_start,v_start_date);
	ELSE 
		SET var_start_date = CONCAT(v_year,v_month_start,v_start_date);
	END IF;
	
	SET var_start_date_loop = var_start_date;
	WHILE var_start_date_loop <= var_end_date
	DO
			-- SET v_ket_libur = '';
			-- SELECT COUNT(tanggal), keterangan INTO v_stat_libur, v_ket_libur FROM z_factory_cal  WHERE tanggal = var_start_date_loop AND compid=v_compid;

			INSERT INTO tmp_calendar 
			(cDate, cDay, cDayOfWeek, cDayName, cMonth) -- , cStatLibur, cKeterangan)
			SELECT var_start_date_loop, 
						 DAY(var_start_date_loop), 
						 DAYOFWEEK(var_start_date_loop), 
						 DAYOFMONTH(var_start_date_loop),
						 MONTH (var_start_date_loop)
						
						 /*CASE 
								WHEN v_stat_libur > 0  THEN 1
								WHEN DAYOFWEEK(var_start_date) =  1 THEN 1
								WHEN DAYOFWEEK(var_start_date) =  7 THEN 1
							  ELSE 0 
						 END AS stat,
						 v_ket_libur*/
							;
 
			SET var_start_date_loop = TIMESTAMPADD(day, 1, var_start_date_loop);
	END WHILE;
	
  -- update libur weekend
	UPDATE tmp_calendar SET
	cStatLibur = 1, 
	cKeterangan = 'Hari Libur' 
	WHERE DAYOFWEEK(cDate) IN(1,7) ;

  -- UPDATE hari libur kalender
	UPDATE tmp_calendar
	INNER JOIN z_factory_cal ON tmp_calendar.cDate = z_factory_cal.tanggal
	SET 
	tmp_calendar.cStatLibur = 1, 
	tmp_calendar.cKeterangan = z_factory_cal.keterangan
	WHERE z_factory_cal.compid = v_compid;

	-- END SETUP CALENDAR


	-- REKAP DETAIL ABSEN
	INSERT INTO tmp_karyawan (emp_id, nik, unitid)
	SELECT emp_id, nik, unitid FROM z_karyawan WHERE compid = v_compid AND active=1 AND 
	(CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
		
		
		-- INSERT KE TABLE LOG ABSENSI REPORT
	
	DELETE FROM z_lap_absensi_log 
	WHERE compid=v_compid AND tgl_abs >= var_start_date AND tgl_abs <= var_end_date 
	AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
	
	
	INSERT INTO z_lap_absensi_log
	(
		nik, compid, unitid, tgl_abs, jam_in, jam_out, id_abs_type, id_tp, emp_id, jadwal_masuk, jadwal_pulang
	)
  SELECT 
		a.nik, a.compid, b.unitid, a.tgl_abs, a.jam_in, a.jam_out, a.id_abs_type, a.id_tp, b.emp_id, a.jadwal_masuk, a.jadwal_pulang
	FROM z_absensi a join z_karyawan b on a.emp_id = b.emp_id
	WHERE b.compid=v_compid AND  a.tgl_abs >= var_start_date AND a.tgl_abs <= var_end_date 
	-- AND (CASE WHEN v_is_pns <> 0 THEN b.is_pns = v_is_pns ELSE b.is_pns = v_is_pns  END )
	AND (CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END )
	ORDER BY a.tgl_abs, a.emp_id
	ON DUPLICATE KEY UPDATE remark = '1';
	
	
		 -- ================================== AUTO GENERATE APPROVE ==============================================
		
		INSERT INTO tmp_pengajuan (id_aju,nik,menu_id)
		 
		SELECT tb.id_aju, tb.nik, tb.menu_id FROM (
		
					-- IZIN
					SELECT 
					a.id_aju, a.jns_aju, b.jns_izin, a.nik, c.emp_name, c.unitid, 
					b.tgl_awal_izin, b.tgl_akhir_izin , 'IZIN' AS jenis_app, 2 AS menu_id
					FROM z_head_aju a
					JOIN z_r_izin b on a.id_aju =  b.id_aju
					JOIN z_karyawan c on a.nik = c.nik
					WHERE 
					a.active = 1 AND
					c.compid = v_compid AND c.active=1 AND 
					(CASE WHEN v_emp_id <> 0 THEN c.emp_id = v_emp_id ELSE c.emp_id > 0 END ) AND 
					b.tgl_awal_izin BETWEEN var_start_date AND var_end_date AND a.sts_aju=1
					
					UNION ALL
					
					-- DINAS
					SELECT 
					a.id_aju, a.jns_aju, a.jns_aju, a.nik, c.emp_name, c.unitid, 
					b.tgl_brkt, b.tgl_plng , 'DINAS' AS jenis_app, 6 AS menu_id
					FROM z_head_aju a
					JOIN z_r_jalandinas b on a.id_aju =  b.id_aju
					JOIN z_karyawan c on a.nik = c.nik
					WHERE 
					a.active = 1 AND
					c.compid = v_compid AND c.active=1 AND 
					(CASE WHEN v_emp_id <> 0 THEN c.emp_id = v_emp_id ELSE c.emp_id > 0 END ) AND 
					b.tgl_brkt BETWEEN var_start_date AND var_end_date AND a.sts_aju=1

					UNION ALL
					
					-- CUTI
					SELECT 
					a.id_aju, a.jns_aju, b.cuti_id, a.nik, c.emp_name, c.unitid, 
					b.tgl_awal_cuti, b.tgl_akhir_cuti, 'CUTI' AS jenis_app, 3 AS menu_id
					FROM z_head_aju a
					JOIN z_r_cuti b on a.id_aju =  b.id_aju
					JOIN z_karyawan c on a.nik = c.nik
					WHERE 
					a.active = 1 AND
					c.compid = v_compid AND c.active=1 AND 
					(CASE WHEN v_emp_id <> 0 THEN c.emp_id = v_emp_id ELSE c.emp_id > 0 END ) AND 
					b.tgl_awal_cuti BETWEEN var_start_date AND var_end_date AND a.sts_aju=1
										
					
		
		) AS tb;
		
		
		SET v_x_pengajuan = 1;
		SET v_cnt_pengajuan = (SELECT COUNT(id) FROM tmp_pengajuan);
		IF v_cnt_pengajuan > 0 THEN 
				WHILE v_x_pengajuan <= v_cnt_pengajuan
				DO
				
						SELECT id_aju, nik, menu_id INTO v_inp_id_aju, v_inp_nik_pengajuan, v_inp_menu_id  FROM tmp_pengajuan	WHERE id=v_x_pengajuan;
						CALL Z_P_APPROVE_PENGAJUAN_AUTOGENERATE (v_inp_id_aju, v_inp_nik_pengajuan, v_comp_code,  v_inp_menu_id);
						
						SET v_x_pengajuan = v_x_pengajuan + 1;
						
				END WHILE;
		END IF;
	
	
	/*
	DELETE FROM z_lap_rekap_details 
	WHERE compid=v_compid AND tahun=v_year AND bulan=v_month
	AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
	-- INSERT DARI TANGGAL ABSENSI ASLI / EXISTING
	INSERT INTO z_lap_rekap_details (tanggal, compid, tahun, bulan, emp_id)
	SELECT DISTINCT a.tgl_abs, v_compid, v_year, v_month, a.emp_id
	FROM z_lap_absensi_log a
	JOIN z_karyawan b ON a.emp_id = b.emp_id
	JOIN z_absen_type c ON a.id_abs_type = c.id_abs_type
	WHERE b.compid=v_compid AND  a.tgl_abs >= var_start_date AND a.tgl_abs <= var_end_date
	AND (CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END )
	ORDER BY a.tgl_abs, a.emp_id;
	*/

  -- UPDATE DARI TANGGAL ABSENSI ASLI / EXISTING
	
	UPDATE z_lap_rekap_details, z_lap_absensi_log, z_absen_type 
	SET 
	z_lap_rekap_details.jam_masuk = z_lap_absensi_log.jam_in,
	z_lap_rekap_details.jam_pulang = z_lap_absensi_log.jam_out,
	z_lap_rekap_details.id_abs_type = z_absen_type.id_abs_type,
	z_lap_rekap_details.keterangan = z_absen_type.abs_type_desc,
	z_lap_rekap_details.id_tp = z_lap_absensi_log.id_tp,
	z_lap_rekap_details.jdwl_masuk = z_lap_absensi_log.jadwal_masuk,
	z_lap_rekap_details.jdwl_pulang = z_lap_absensi_log.jadwal_pulang	
	WHERE 
	z_lap_rekap_details.tanggal = z_lap_absensi_log.tgl_abs AND 
	z_lap_rekap_details.emp_id = z_lap_absensi_log.emp_id AND
	z_lap_absensi_log.id_abs_type = z_absen_type.id_abs_type AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );
	
		
	-- INSERT DARI TANGGAL CALENDAR
	SET v_x = 1;
	SET v_cnt_emp = (SELECT COUNT(id) FROM tmp_karyawan);
	WHILE v_x <= v_cnt_emp
	DO
	 
				SELECT emp_id, nik, unitid INTO v_inp_emp_id, v_inp_nik, v_unitid FROM tmp_karyawan	WHERE id=v_x;
				INSERT INTO z_lap_rekap_details (compid, tahun, bulan, emp_id, nik, tanggal, id_abs_type, ket_libur, unitid)
				SELECT v_compid, v_year, v_month, v_inp_emp_id, v_inp_nik, a.cDate, 0 , a.Cketerangan AS keterangan, v_unitid 
				FROM tmp_calendar a 
				ON DUPLICATE KEY UPDATE 
				remark = '1',
				ket_libur = a.Cketerangan;
					
		SET v_x = v_x + 1;

	END WHILE;
 
  -- UPDATE HARI LIBUR 
	UPDATE z_lap_rekap_details, tmp_calendar
	SET 
  z_lap_rekap_details.id_abs_type = 12,
	z_lap_rekap_details.stat_libur = tmp_calendar.cStatLibur, 
	z_lap_rekap_details.keterangan = tmp_calendar.cKeterangan
	WHERE
  z_lap_rekap_details.tanggal = tmp_calendar.Cdate AND
  tmp_calendar.cStatLibur = 1 AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );

	-- UPDATE HARI ALFA 
	UPDATE z_lap_rekap_details 
	SET 
	z_lap_rekap_details.id_abs_type = 8,
	z_lap_rekap_details.keterangan = 'Alpha'
	WHERE 
	z_lap_rekap_details.id_abs_type = 0 AND
	z_lap_rekap_details.compid = v_compid AND
	z_lap_rekap_details.bulan = v_month AND
	z_lap_rekap_details.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN z_lap_rekap_details.emp_id = v_emp_id ELSE z_lap_rekap_details.emp_id > 0 END );

	-- UPDATE JAM KERJA
	
	SELECT jml_jam_istirahat * 60, batas_jam_masuk * 60, batas_jam_pulang * 60
	INTO v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang FROM z_compcode WHERE compid=v_compid;
	
-- 	SELECT jml_jam_istirahat, batas_jam_masuk, batas_jam_pulang, toleransi_telat
-- 	INTO v_jml_jam_istirahat, v_jml_batas_masuk, v_jml_batas_pulang,  v_toleransi_telat FROM z_time_profile 
-- 	WHERE compid=1 AND active=1 LIMIT 1;
	
	SET v_total_jam_kerja = (v_jml_batas_masuk + v_jml_batas_pulang);

	UPDATE z_lap_rekap_details a
	SET 
	a.jml_jam_kerja = 
			-- JIKA MASUK
			CASE 
			WHEN a.id_abs_type IN(1,2) THEN  		
				 CASE 
							-- JIKA ADA JAM MASUK DAN PULANG		
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
									  CASE WHEN (TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - v_jml_jam_istirahat ) <= 0 THEN 
												0
										ELSE 
												TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - v_jml_jam_istirahat
										END
							-- JIKA ADA JAM MASUK DAN TIDAK ADA JAM PULANG				
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN 
										v_jml_batas_masuk 
							WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN 
										v_jml_batas_pulang
					END
			WHEN a.id_abs_type IN(9,10) THEN	
					v_total_jam_kerja
      END,

		a.jml_jam_kurang = 
			-- JIKA MASUK
			CASE 
			WHEN a.id_abs_type IN(1,2) THEN  		
				 CASE 
							-- JIKA ADA JAM MASUK DAN PULANG		
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
									CASE WHEN (TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat) ) < 0 THEN 
											CASE WHEN ((TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat)  ) * -1 ) > v_total_jam_kerja THEN 
													0
											ELSE 
													(TIMESTAMPDIFF(MINUTE,jam_masuk,jam_pulang) - (v_total_jam_kerja + v_jml_jam_istirahat) ) * -1
											END
									ELSE  
											0
									END
							-- JIKA ADA JAM MASUK DAN TIDAK ADA JAM PULANG				
							WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN 
										v_jml_batas_pulang
							WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN 
										v_jml_batas_masuk
					END
			WHEN a.id_abs_type IN(8) THEN  
					v_total_jam_kerja 
			WHEN a.id_abs_type IN(9,10) THEN	
					0
      END,


			a.jml_terlambat = 
				CASE 
				WHEN a.id_abs_type IN(1,2) THEN
						CASE 
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jam_masuk,jdwl_masuk) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN
										1
								WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jam_masuk,jdwl_masuk) < 0 THEN 1 ELSE 0 END
						ELSE 0 
						END
				ELSE 
						0
				END,


		a.jml_psw = 
				CASE 
				WHEN a.id_abs_type IN(1,2) THEN
						CASE 
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jdwl_pulang,jam_pulang) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk <> '0000-00-00 00:00:00' AND jam_pulang = '0000-00-00 00:00:00' THEN
										CASE WHEN TIMESTAMPDIFF(MINUTE,jdwl_pulang,jam_pulang) < 0 THEN 1 ELSE 0 END
								WHEN jam_masuk = '0000-00-00 00:00:00' AND jam_pulang <> '0000-00-00 00:00:00' THEN
										1
						ELSE 0 
						END
				ELSE 
						0
				END
	WHERE
	a.compid = v_compid AND
	a.bulan = v_month AND
	a.tahun = v_year AND	
	(CASE WHEN v_emp_id <> 0 THEN a.emp_id = v_emp_id ELSE a.emp_id > 0 END );

	
	-- END REKAP DETAIL ABSEN
	
	-- SUMMARY
	DELETE FROM z_lap_rekap_summary
	WHERE compid=v_compid AND tahun=v_year AND bulan=v_month
	AND (CASE WHEN v_emp_id <> 0 THEN emp_id = v_emp_id ELSE emp_id > 0 END );
	INSERT INTO z_lap_rekap_summary 
	(
		emp_id,compid,bulan,tahun,
		jml_hadir,jml_terlambat,jml_alpha,
		jml_cuti,jml_dinas,jml_izin,jml_sakit,jml_reimburse,
		jml_jam_kurang,jml_jam_kerja
	)
	SELECT 
	a.emp_id, v_compid, v_month, v_year, 
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (1,2)),0) AS jml_hadir,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_terlambat = 1),0) AS jml_terlambat,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (8)),0) AS jml_alpha,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (7)),0) AS jml_cuti,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (9)),0) AS jml_dinas,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (3,4,5)),0) AS jml_izin,
	COALESCE((SELECT COUNT(x.id_abs_type) FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND x.id_abs_type IN (6)),0) AS jml_sakit,
	COALESCE((SELECT SUM(x.head_text2) FROM z_head_aju x  WHERE x.nik = a.nik  AND YEAR(x.tgl_aju) = v_year  AND  MONTH(x.tgl_aju) = v_month AND x.sts_aju IN (1)),0) AS jml_reimburse,
	COALESCE((SELECT SUM(x.jml_jam_kurang) / 60 FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_jam_kurang > 0),0) AS jml_jam_kurang,
	COALESCE((SELECT SUM(x.jml_jam_kerja) / 60 FROM z_lap_rekap_details x WHERE x.emp_id = a.emp_id  AND x.tahun = v_year  AND x.bulan = v_month AND jml_jam_kerja > 0),0) AS jml_jam_kerja
	FROM tmp_karyawan a;
	-- END SUMMARY
	-- SELECT * FROM z_lap_rekap_summary ORDER BY emp_id;
	-- SELECT * FROM z_lap_rekap_details ORDER BY emp_id, tanggal;

	SET v_result = '1';
	SELECT v_result;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_ABSEN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_ABSEN`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_ABSEN`(`v_type` INT, `v_nik` VARCHAR(30), `v_comp_code` VARCHAR(6), `v_year` VARCHAR(4), `v_tgl_abs` VARCHAR(30), `v_jam` VARCHAR(30), `v_id_abs_type` INT, `v_longitude` VARCHAR(50), `v_latitude` VARCHAR(50), `v_lokasi` VARCHAR(255), `v_url_foto` VARCHAR(255), `v_device` INT, `v_status_pengajuan` INT, `v_id_tp` INT, `v_jadwal_masuk` VARCHAR(30), `v_jadwal_pulang` VARCHAR(30))
BEGIN

DECLARE v_sisa_cuti INT;
DECLARE v_cek_absen INT;
DECLARE v_ret INT;
DECLARE v_pengajuan_id VARCHAR(20);
DECLARE v_nik_atasan VARCHAR(20);
DECLARE v_status_sales INT;
DECLARE v_emp_id BIGINT;
DECLARE v_comp_id INT;
DECLARE v_unit_id INT;


DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
				ROLLBACK;
				RESIGNAL;
		END;

START TRANSACTION;

	SET v_status_sales = 0;
	SELECT A.STAT_SALES, B.EMP_ID, B.COMPID, B.UNITID INTO v_status_sales, v_emp_id, v_comp_id, v_unit_id FROM z_personalize A 
	JOIN z_karyawan B ON A.NIK_STAFF = B.NIK AND A.COMP_CODE = B.COMP_CODE
	WHERE A.NIK_STAFF=v_nik AND A.COMP_CODE=v_comp_code LIMIT 1;


	-- JIKA BUKAN PENGAJUAN (JIKA JADWAL NORMAL)
	IF v_status_pengajuan=0 THEN

		/*
		SELECT COUNT(NIK) INTO v_cek_absen FROM z_absensi 
		WHERE EMP_ID=v_emp_id AND COMP_CODE=v_comp_code 
		AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND ID_ABS_TYPE IN(1,2);
		*/
		
		SELECT 
		CASE WHEN EXISTS(SELECT 1 FROM z_absensi WHERE emp_id=v_emp_id AND tgl_abs=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') 
		AND id_abs_type IN(1,2)) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
				
		-- Jika belum ada 
		IF v_cek_absen = 0 THEN
			
			IF v_type = 1 THEN -- Jika absen masuk

				 INSERT INTO z_absensi (emp_id, nik, comp_code, compid, unitid, tgl_abs,jam_in,id_abs_type,longitude,latitude,lokasi,url_foto,device, id_tp, jadwal_masuk, jadwal_pulang) 
				 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, v_unit_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								v_id_abs_type, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device, v_id_tp,
							  STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
			
				 INSERT INTO z_absensi (emp_id, nik, comp_code, compid, unitid, tgl_abs,jam_out,id_abs_type,longitude,latitude,lokasi,url_foto_pulang,device, id_tp, jadwal_masuk, jadwal_pulang) 
				 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, v_unit_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								v_id_abs_type, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device, v_id_tp,
								STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
			END IF;

			SET v_ret = 1;
		
		-- Jika sudah ada 
		ELSEIF v_cek_absen = 1 THEN

			IF v_type = 1 THEN -- Jika absen masuk

				 /*UPDATE z_absensi SET 
						JAM_IN=TO_DATE(v_jam, 'YYYY-mm-dd hh24:mi:ss'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=TO_DATE(v_tgl_abs, 'YYYY-mm-dd');*/
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang

				 UPDATE z_absensi SET 
						JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO_PULANG=v_url_foto,
						DEVICE=v_device,
						ID_TP=v_id_tp
				 WHERE 
				 EMP_ID=v_emp_id AND NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');

			END IF;
		
		END IF;
	

	-- JIKA PENGAJUAN (JIKA JADWAL TIDAK ADA & MASUK DI HARI LIBUR MAKA STATUS DIAJUKAN)
	ELSEIF v_status_pengajuan = 1 THEN
			
		-- INSERT INTO Z_HEAD_AJU (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 

		-- SELECT COUNT(NIK) INTO v_cek_absen FROM  z_r_absensi WHERE NIK=v_nik AND COMP_CODE=v_comp_code AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND  ID_ABS_TYPE IN(1,2);
				
		-- Jika belum ada 
		IF v_cek_absen = 0 THEN
			SET v_status_pengajuan = 1;
      -- Insert ke table pengajuan
			-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,'AB')) INTO v_pengajuan_id FROM DUAL;

			-- INSERT INTO Z_HEAD_AJU (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
			-- SELECT v_pengajuan_id, STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 'AB', 0, v_nik, '1','-' FROM DUAL;
			
			/*
			IF v_type = 1 THEN -- Jika absen masuk
				 INSERT INTO z_r_absensi (ID_AJU,NIK,COMP_CODE,TGL_ABS,JAM_IN,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO,DEVICE) 
				 SELECT v_pengajuan_id, v_nik, v_comp_code, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								1, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device FROM DUAL;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				 INSERT INTO z_r_absensi (ID_AJU,NIK,COMP_CODE,TGL_ABS,JAM_OUT,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO_PULANG,DEVICE) 
				 SELECT v_pengajuan_id, v_nik, v_comp_code, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								1, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device FROM DUAL;
			END IF;
			*/

			-- NOTIFIKASI --
			-- SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik LIMIT 1;
			-- INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
			-- SELECT v_pengajuan_id, STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;
			
		
		-- Jika sudah ada 
		ELSEIF v_cek_absen = 1 THEN

			/*IF v_type = 1 THEN -- Jika absen masuk
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				 UPDATE z_r_absensi SET 
						JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO_PULANG=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');
			END IF;*/



			IF v_type = 1 THEN -- Jika absen masuk
				 
					IF v_status_sales = 1 THEN
						 INSERT INTO z_absensi (emp_id,nik,comp_code,compid,unitid,tgl_abs,jam_in,id_abs_type,longitude,latitude,lokasi,url_foto,device, id_tp, jadwal_masuk, jadwal_pulang) 
						 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, v_unit_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
										v_id_abs_type, v_longitude, v_latitude, 
										v_lokasi, v_url_foto, v_device,
										v_id_tp, STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
					END IF;
				 /*UPDATE Z_ABSENSI SET 
						JAM_IN=TO_DATE(v_jam, 'YYYY-mm-dd hh24:mi:ss'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=TO_DATE(v_tgl_abs, 'YYYY-mm-dd');*/
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				  
					IF v_status_sales = 0 THEN
							UPDATE z_absensi SET 
								JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
								LONGITUDE=v_longitude, 
								LATITUDE=v_latitude,
								LOKASI=v_lokasi,
								URL_FOTO_PULANG=v_url_foto,
								DEVICE=v_device,
							  ID_TP=v_id_tp
							WHERE EMP_ID = v_emp_id AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');
					ELSE
							UPDATE z_absensi SET 
								JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
								LONGITUDE=v_longitude, 
								LATITUDE=v_latitude,
								LOKASI=v_lokasi,
								URL_FOTO_PULANG=v_url_foto,
								DEVICE=v_device,
								ID_TP=v_id_tp
							WHERE EMP_ID = v_emp_id  AND NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND
							JAM_IN = (SELECT MAX(JAM_IN) FROM z_absensi WHERE EMP_ID = v_emp_id AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'));
					END IF;


			END IF;



		END IF;
			
	END IF;


COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_ABSEN_
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_ABSEN_`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_ABSEN_`(`v_type` INT, `v_nik` VARCHAR(30), `v_comp_code` VARCHAR(6), `v_year` VARCHAR(4), `v_tgl_abs` VARCHAR(30), `v_jam` VARCHAR(30), `v_id_abs_type` INT, `v_longitude` VARCHAR(50), `v_latitude` VARCHAR(50), `v_lokasi` VARCHAR(255), `v_url_foto` VARCHAR(255), `v_device` INT, `v_status_pengajuan` INT, `v_id_tp` INT, `v_jadwal_masuk` VARCHAR(30), `v_jadwal_pulang` VARCHAR(30))
BEGIN

DECLARE v_sisa_cuti INT;
DECLARE v_cek_absen INT;
DECLARE v_ret INT;
DECLARE v_pengajuan_id VARCHAR(20);
DECLARE v_nik_atasan VARCHAR(20);
DECLARE v_status_sales INT;
DECLARE v_emp_id BIGINT;
DECLARE v_comp_id INT;


DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
				ROLLBACK;
				RESIGNAL;
		END;

START TRANSACTION;

	SET v_status_sales = 0;
	SELECT A.STAT_SALES, B.EMP_ID, B.COMPID INTO v_status_sales, v_emp_id, v_comp_id FROM z_personalize A 
	JOIN z_karyawan B ON A.NIK_STAFF = B.NIK AND A.COMP_CODE = B.COMP_CODE
	WHERE A.NIK_STAFF=v_nik AND A.COMP_CODE=v_comp_code LIMIT 1;


	-- JIKA BUKAN PENGAJUAN (JIKA JADWAL NORMAL)
	IF v_status_pengajuan=0 THEN

		/*
		SELECT COUNT(NIK) INTO v_cek_absen FROM z_absensi 
		WHERE EMP_ID=v_emp_id AND COMP_CODE=v_comp_code 
		AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND ID_ABS_TYPE IN(1,2);
		*/
		
		SELECT 
		CASE WHEN EXISTS(SELECT 1 FROM z_absensi WHERE emp_id=v_emp_id AND tgl_abs=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') 
		AND id_abs_type IN(1,2)) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
				
		-- Jika belum ada 
		IF v_cek_absen = 0 THEN
			
			IF v_type = 1 THEN -- Jika absen masuk

				 INSERT INTO z_absensi (emp_id, nik, comp_code, compid,tgl_abs,jam_in,id_abs_type,longitude,latitude,lokasi,url_foto,device, id_tp, jadwal_masuk, jadwal_pulang) 
				 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								v_id_abs_type, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device, v_id_tp,
							  STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
			
				 INSERT INTO z_absensi (emp_id, nik, comp_code, compid, tgl_abs,jam_out,id_abs_type,longitude,latitude,lokasi,url_foto_pulang,device, id_tp, jadwal_masuk, jadwal_pulang) 
				 SELECT v_emp_id, v_nik, v_comp_code, compid, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								v_id_abs_type, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device, v_id_tp,
								STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
			END IF;

			SET v_ret = 1;
		
		-- Jika sudah ada 
		ELSEIF v_cek_absen = 1 THEN

			IF v_type = 1 THEN -- Jika absen masuk

				 /*UPDATE z_absensi SET 
						JAM_IN=TO_DATE(v_jam, 'YYYY-mm-dd hh24:mi:ss'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=TO_DATE(v_tgl_abs, 'YYYY-mm-dd');*/
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang

				 UPDATE z_absensi SET 
						JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO_PULANG=v_url_foto,
						DEVICE=v_device,
						ID_TP=v_id_tp
				 WHERE 
				 EMP_ID=v_emp_id AND NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');

			END IF;
		
		END IF;
	

	-- JIKA PENGAJUAN (JIKA JADWAL TIDAK ADA & MASUK DI HARI LIBUR MAKA STATUS DIAJUKAN)
	ELSEIF v_status_pengajuan = 1 THEN
			
		-- INSERT INTO Z_HEAD_AJU (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 

		SELECT COUNT(NIK) INTO v_cek_absen FROM  z_r_absensi WHERE NIK=v_nik AND COMP_CODE=v_comp_code AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND  ID_ABS_TYPE IN(1,2);
				
		-- Jika belum ada 
		IF v_cek_absen = 0 THEN
			SET v_status_pengajuan = 1;
      -- Insert ke table pengajuan
			-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,'AB')) INTO v_pengajuan_id FROM DUAL;

			-- INSERT INTO Z_HEAD_AJU (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
			-- SELECT v_pengajuan_id, STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 'AB', 0, v_nik, '1','-' FROM DUAL;
			
			/*
			IF v_type = 1 THEN -- Jika absen masuk
				 INSERT INTO z_r_absensi (ID_AJU,NIK,COMP_CODE,TGL_ABS,JAM_IN,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO,DEVICE) 
				 SELECT v_pengajuan_id, v_nik, v_comp_code, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								1, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device FROM DUAL;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				 INSERT INTO z_r_absensi (ID_AJU,NIK,COMP_CODE,TGL_ABS,JAM_OUT,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO_PULANG,DEVICE) 
				 SELECT v_pengajuan_id, v_nik, v_comp_code, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								1, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device FROM DUAL;
			END IF;
			*/

			-- NOTIFIKASI --
			-- SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik LIMIT 1;
			-- INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
			-- SELECT v_pengajuan_id, STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;
			
		
		-- Jika sudah ada 
		ELSEIF v_cek_absen = 1 THEN

			/*IF v_type = 1 THEN -- Jika absen masuk
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				 UPDATE z_r_absensi SET 
						JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO_PULANG=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');
			END IF;*/



			IF v_type = 1 THEN -- Jika absen masuk
				 
					IF v_status_sales = 1 THEN
						 INSERT INTO z_absensi (EMP_ID,NIK,COMP_CODE,TGL_ABS,JAM_IN,ID_ABS_TYPE,LONGITUDE,LATITUDE,LOKASI,URL_FOTO,DEVICE, ID_TP, JADWAL_MASUK, JADWAL_PULANG) 
						 SELECT v_emp_id, v_nik, v_comp_code, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
										v_id_abs_type, v_longitude, v_latitude, 
										v_lokasi, v_url_foto, v_device,
										v_id_tp, STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
					END IF;
				 /*UPDATE Z_ABSENSI SET 
						JAM_IN=TO_DATE(v_jam, 'YYYY-mm-dd hh24:mi:ss'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=TO_DATE(v_tgl_abs, 'YYYY-mm-dd');*/
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				  
					IF v_status_sales = 0 THEN
							UPDATE z_absensi SET 
								JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
								LONGITUDE=v_longitude, 
								LATITUDE=v_latitude,
								LOKASI=v_lokasi,
								URL_FOTO_PULANG=v_url_foto,
								DEVICE=v_device,
							  ID_TP=v_id_tp
							WHERE EMP_ID = v_emp_id AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');
					ELSE
							UPDATE z_absensi SET 
								JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
								LONGITUDE=v_longitude, 
								LATITUDE=v_latitude,
								LOKASI=v_lokasi,
								URL_FOTO_PULANG=v_url_foto,
								DEVICE=v_device,
								ID_TP=v_id_tp
							WHERE EMP_ID = v_emp_id  AND NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND
							JAM_IN = (SELECT MAX(JAM_IN) FROM z_absensi WHERE EMP_ID = v_emp_id AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'));
					END IF;


			END IF;






			



		END IF;
			
	END IF;


COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_ABSEN_LEWATHARI
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_ABSEN_LEWATHARI`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_ABSEN_LEWATHARI`(`v_type` INT, `v_nik` VARCHAR(30), `v_comp_code` VARCHAR(6), `v_year` VARCHAR(4), `v_tgl_abs` VARCHAR(30), `v_jam` VARCHAR(30), `v_id_abs_type` INT, `v_longitude` VARCHAR(50), `v_latitude` VARCHAR(50), `v_lokasi` VARCHAR(255), `v_url_foto` VARCHAR(255), `v_device` INT, `v_status_pengajuan` INT, `v_id_tp` INT, `v_jadwal_masuk` VARCHAR(30), `v_jadwal_pulang` VARCHAR(30))
BEGIN

DECLARE v_sisa_cuti INT;
DECLARE v_cek_absen INT;
DECLARE v_ret INT;
DECLARE v_pengajuan_id VARCHAR(20);
DECLARE v_nik_atasan VARCHAR(20);
DECLARE v_status_sales INT;
DECLARE v_emp_id BIGINT;
DECLARE v_comp_id INT;
DECLARE v_unit_id INT;
DECLARE v_tgl_absen_real DATETIME;


DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
				ROLLBACK;
				RESIGNAL;
		END;

START TRANSACTION;

	SET v_status_sales = 0;
	SELECT A.STAT_SALES, B.EMP_ID , B.COMPID, B.UNITID INTO v_status_sales, v_emp_id, v_comp_id, v_unit_id FROM z_personalize A 
	JOIN z_karyawan B ON A.NIK_STAFF = B.NIK AND A.COMP_CODE = B.COMP_CODE
	WHERE A.NIK_STAFF=v_nik AND A.COMP_CODE=v_comp_code LIMIT 1;
	
	

	-- JIKA BUKAN PENGAJUAN (JIKA JADWAL NORMAL)
	IF v_status_pengajuan=0 THEN

		-- SELECT COUNT(NIK) INTO v_cek_absen FROM z_absensi WHERE EMP_ID=v_emp_id AND COMP_CODE=v_comp_code AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND ID_ABS_TYPE IN(1,2);
		SELECT 
		CASE WHEN EXISTS(SELECT 1 FROM z_absensi WHERE emp_id=v_emp_id AND tgl_abs=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') 
		AND id_abs_type IN(1,2)) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;		
				
		-- Jika belum ada 
		IF v_cek_absen = 0 THEN
			
			IF v_type = 1 THEN -- Jika absen masuk

				 INSERT INTO z_absensi (emp_id,nik,comp_code,compid,unitid,tgl_abs,jam_in,id_abs_type,longitude,latitude,lokasi,url_foto,device, id_tp, jadwal_masuk, jadwal_pulang) 
				 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, v_unit_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								v_id_abs_type, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device, v_id_tp,
							  STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				 INSERT INTO z_absensi (emp_id, nik,comp_code,compid,unitid,tgl_abs,jam_out,id_abs_type,longitude,latitude,lokasi,url_foto_pulang,device, id_tp, jadwal_masuk, jadwal_pulang) 
				 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, v_unit_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
								v_id_abs_type, v_longitude, v_latitude, 
								v_lokasi, v_url_foto, v_device, v_id_tp,
								STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
			END IF;

			SET v_ret = 1;
		
		-- Jika sudah ada 
		ELSEIF v_cek_absen = 1 THEN

			IF v_type = 1 THEN -- Jika absen masuk

				 /*UPDATE z_absensi SET 
						JAM_IN=TO_DATE(v_jam, 'YYYY-mm-dd hh24:mi:ss'),  
						LONGITUDE=v_longitude, 
						LATITUDE=v_latitude,
						LOKASI=v_lokasi,
						URL_FOTO=v_url_foto,
						DEVICE=v_device	
				 WHERE NIK=v_nik AND TGL_ABS=TO_DATE(v_tgl_abs, 'YYYY-mm-dd');*/
				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
			
			
				 SELECT MAX(TGL_ABS) INTO v_tgl_absen_real FROM z_absensi WHERE nik = v_nik AND jam_out IS NULL;
			
				 -- SELECT COUNT(NIK) INTO v_cek_absen FROM z_absensi WHERE EMP_ID=v_emp_id AND COMP_CODE=v_comp_code AND TGL_ABS=STR_TO_DATE(v_tgl_absen_real, '%Y-%m-%d') AND ID_ABS_TYPE IN(1,2);
				 
				 SELECT 
				 CASE WHEN EXISTS(SELECT 1 FROM z_absensi WHERE emp_id=v_emp_id AND tgl_abs=STR_TO_DATE(v_tgl_absen_real, '%Y-%m-%d') 
				 AND id_abs_type IN(1,2)) THEN 1 ELSE 0 END AS jml INTO v_cek_absen;
			
				 IF v_cek_absen = 1 THEN 
					 UPDATE z_absensi SET 
							JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
							LONGITUDE=v_longitude, 
							LATITUDE=v_latitude,
							LOKASI=v_lokasi,
							URL_FOTO_PULANG=v_url_foto,
							DEVICE=v_device,
							JADWAL_PULANG=date_add(JADWAL_PULANG, interval 1 day)
							-- ID_TP=v_id_tp
					 WHERE 
					 EMP_ID=v_emp_id AND NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_absen_real, '%Y-%m-%d');
					 

				 END IF;

			END IF;
		
		END IF;
	

	-- JIKA PENGAJUAN (JIKA JADWAL TIDAK ADA & MASUK DI HARI LIBUR MAKA STATUS DIAJUKAN)
	ELSEIF v_status_pengajuan = 1 THEN
			
		-- INSERT INTO Z_HEAD_AJU (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 

		-- SELECT COUNT(NIK) INTO v_cek_absen FROM  z_r_absensi WHERE NIK=v_nik AND COMP_CODE=v_comp_code AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND  ID_ABS_TYPE IN(1,2);
				
		-- Jika belum ada 
		IF v_cek_absen = 0 THEN
			
      -- Insert ke table pengajuan
		-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,'AB')) INTO v_pengajuan_id FROM DUAL;		
		SET v_cek_absen = 0;
		
		-- Jika sudah ada 
		ELSEIF v_cek_absen = 1 THEN


			IF v_type = 1 THEN -- Jika absen masuk
				 
					IF v_status_sales = 1 THEN
						 INSERT INTO z_absensi (emp_id,nik,comp_code,compid,tgl_abs,jam_in,id_abs_type,longitude,latitude,lokasi,url_foto,device, id_tp, jadwal_masuk, jadwal_pulang) 
						 SELECT v_emp_id, v_nik, v_comp_code, v_comp_id, STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'), STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'), 
										v_id_abs_type, v_longitude, v_latitude, 
										v_lokasi, v_url_foto, v_device,
										v_id_tp, STR_TO_DATE(v_jadwal_masuk, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_jadwal_pulang, '%Y-%m-%d %H:%i:%s') FROM DUAL;
					END IF;

				 SET v_ret = 1;
			ELSEIF v_type = 2 THEN -- Jika absen pulang
				  SET v_ret = 1;
					
					IF v_status_sales = 0 THEN
							UPDATE z_absensi SET 
								JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
								LONGITUDE=v_longitude, 
								LATITUDE=v_latitude,
								LOKASI=v_lokasi,
								URL_FOTO_PULANG=v_url_foto,
								DEVICE=v_device,
							  ID_TP=v_id_tp
							WHERE EMP_ID = v_emp_id AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d');
					ELSE
							UPDATE z_absensi SET 
								JAM_OUT=STR_TO_DATE(v_jam, '%Y-%m-%d %H:%i:%s'),  
								LONGITUDE=v_longitude, 
								LATITUDE=v_latitude,
								LOKASI=v_lokasi,
								URL_FOTO_PULANG=v_url_foto,
								DEVICE=v_device,
								ID_TP=v_id_tp
							WHERE EMP_ID = v_emp_id  AND NIK=v_nik AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d') AND
							JAM_IN = (SELECT MAX(JAM_IN) FROM z_absensi WHERE EMP_ID = v_emp_id AND TGL_ABS=STR_TO_DATE(v_tgl_abs, '%Y-%m-%d'));
					END IF;
					
			END IF;

		END IF;
			
	END IF;


COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_CUTI
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_CUTI`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_CUTI`(IN `v_pengajuan_id_` VARCHAR(36), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_cuti_id` INT, IN `v_remark` VARCHAR(255), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_start_date` VARCHAR(30), IN `v_end_date` VARCHAR(30), IN `v_jml` INT, `v_cnt_file` INT, `v_params_image` VARCHAR(1500))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_cuti INT;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_result VARCHAR(255); 
DECLARE v_nik_atasan VARCHAR(20);
 
		
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

				-- CEK TGL PENGAJUAN TIDAK DUPLIKASI
				SELECT COUNT(A.ID_AJU) INTO v_cek_cuti FROM z_r_cuti A JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
				WHERE STR_TO_DATE(v_start_date,'%Y-%m-%d %H:%i:%s') BETWEEN A.TGL_AWAL_CUTI AND A.TGL_AKHIR_CUTI
				AND B.NIK=v_nik AND B.COMP_CODE=v_comp_code AND B.STS_AJU=1;
				IF v_cek_cuti = 0 THEN

						-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code, 'CT')) INTO v_pengajuan_id FROM DUAL;
						SELECT UUID() INTO v_pengajuan_id FROM DUAL;
						-- INSERT INTO (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
						INSERT INTO z_head_aju (ID_AJU, COMP_CODE, TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
						SELECT v_pengajuan_id, v_comp_code, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 'CT', 0, v_nik, v_cuti_id,'-' FROM DUAL;
			

						INSERT INTO z_r_cuti (ID_AJU, CUTI_ID, ALASAN_CUTI, TGL_AWAL_CUTI, TGL_AKHIR_CUTI)
						SELECT v_pengajuan_id, v_cuti_id, v_remark, STR_TO_DATE(v_start_date, '%Y-%m-%d'), STR_TO_DATE(v_end_date, '%Y-%m-%d') FROM DUAL;
						
						-- INSERT FILE ATTACHMENT
						IF v_cnt_file>0 THEN
								SET x=1;
								DELETE FROM z_r_cuti_url WHERE ID_AJU=v_pengajuan_id;
								WHILE x<=v_cnt_file DO
										INSERT INTO z_r_cuti_url (ID_AJU, SEQ_ATC, URL_ATC_CUTI)
										SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
								SET x=x+1;
								END WHILE;
						END IF;


						-- INSERT KE NOTIFIKASI
						SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik AND COMP_CODE=v_comp_code LIMIT 1;
						INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
						SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;

				END IF;

		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_aju 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU='CT', 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_cuti_id,
						HEAD_TEXT2='-'
				WHERE ID_AJU=v_pengajuan_id;
				
				UPDATE z_r_cuti SET 
						CUTI_ID=v_cuti_id, ALASAN_CUTI=v_remark, 
						TGL_AWAL_CUTI=STR_TO_DATE(v_start_date, '%Y-%m-%d'), 
						TGL_AKHIR_CUTI=STR_TO_DATE(v_end_date, '%Y-%m-%d') 
				WHERE ID_AJU=v_pengajuan_id;

						-- INSERT FILE ATTACHMENT
						IF v_cnt_file>0 THEN
								SET x=1;
								DELETE FROM z_r_cuti_url WHERE ID_AJU=v_pengajuan_id;
								WHILE x<=v_cnt_file DO
										INSERT INTO z_r_cuti_url (ID_AJU, SEQ_ATC, URL_ATC_CUTI)
										SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
								SET x=x+1;
								END WHILE;
						ELSEIF v_cnt_file=0 THEN
								DELETE FROM z_r_cuti_url WHERE ID_AJU=v_pengajuan_id;
						END IF;


		END IF;

    /*-- INSERT KE TABLE z_absensi
		v_cnt:=1;
		v_date_:= TO_DATE(v_start_date, 'YYYY-mm-dd');
		while (v_cnt <= v_jml)
		loop
			INSERT INTO z_absensi (NIK,COMP_CODE,TGL_ABS,ID_ABS_TYPE) 
			SELECT v_nik, v_comp_code, v_date_, v_id_abs_type FROM DUAL;
			v_date_:= TO_DATE(v_start_date, 'YYYY-mm-dd') + 1;
			v_cnt := v_cnt + 1;
		end loop;*/
	
	  COMMIT;

	
		
		SET v_result = v_cek_cuti;
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
			-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_DINAS
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_DINAS`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_DINAS`(IN `v_pengajuan_id_` VARCHAR(30), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_periode` VARCHAR(4), IN `v_date` VARCHAR(30), `v_nm_pejabat` VARCHAR(150), `v_jabatan` VARCHAR(150), `v_tujuan` VARCHAR(150), `v_keperluan` VARCHAR(255), `v_tgl_brkt` VARCHAR(30), `v_tgl_plng` VARCHAR(30), `v_all_bdgjkt` INT, `v_all_lr_kota` INT, `v_all_lr_negeri` INT, `v_tr_k_prbadi` INT, `v_tr_k_dinas` INT, `v_tr_ka` INT, `v_tr_pesawat` INT, `v_tr_travel` INT, `v_tr_bus` INT, `v_ak_hotel` INT, `v_ak_hotel_nom` INT, `v_ak_hotel_ket` VARCHAR(255), `v_ak_tr_loc` INT, `v_ak_tr_loc_nom` INT, `v_ak_tr_loc_ket` VARCHAR(255), `v_ak_susp` INT, `v_ak_susp_nom` INT, `v_ak_susp_ket` VARCHAR(255), `v_cnt_file` INT, `v_params_image` VARCHAR(1500), `v_cnt_peserta` INT, `v_params_peserta` VARCHAR(255))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_result VARCHAR(255); 
DECLARE v_nik_atasan VARCHAR(20);
 
		
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

				-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,'PD')) INTO v_pengajuan_id FROM DUAL;
				SELECT UUID() INTO v_pengajuan_id FROM DUAL;

				INSERT INTO z_head_aju (ID_AJU, COMP_CODE, TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				SELECT v_pengajuan_id, v_comp_code, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 'PD', 0, v_nik, v_keperluan, '-' FROM DUAL;
	
				INSERT INTO z_r_jalandinas 
				(	
					ID_AJU, NM_PEJABAT, JABATAN,TUJUAN, KEPERLUAN, 
					TGL_BRKT, TGL_PLNG, 
					ALL_BDGJKT, ALL_LR_KOTA, ALL_LR_NEGERI, TR_K_PRIBADI, TR_K_DINAS,
					TR_KA, TR_PESAWAT, TR_TRAVEL, TR_BUS ,
					AK_HOTEL, AK_HOTEL_NOM, AK_HOTEL_KET, 
					AK_TR_LOC, AK_TR_LOC_NOM, AK_TR_LOC_KET, 
					AK_SUSP, AK_SUSP_NOM, AK_SUSP_KET
				)
				SELECT v_pengajuan_id, v_nm_pejabat, v_jabatan, v_tujuan, v_keperluan, 
							 STR_TO_DATE(v_tgl_brkt, '%Y-%m-%d %H:%i:%s'), STR_TO_DATE(v_tgl_plng, '%Y-%m-%d %H:%i:%s'),
							 v_all_bdgjkt, v_all_lr_kota, v_all_lr_negeri, v_tr_k_prbadi, v_tr_k_dinas,
							 v_tr_ka, v_tr_pesawat, v_tr_travel, v_tr_bus, 
							 v_ak_hotel, v_ak_hotel_nom, v_ak_hotel_ket, 
							 v_ak_tr_loc, v_ak_tr_loc_nom, v_ak_tr_loc_ket,
							 v_ak_susp, v_ak_susp_nom, v_ak_susp_ket
				FROM DUAL;

				-- INSERT PESERTA
				IF v_cnt_peserta>0 THEN
						SET x=1;
						DELETE FROM z_r_jalandinas_peserta WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_peserta DO
								INSERT INTO z_r_jalandinas_peserta (ID_AJU, NIK, SEQ, COMP_CODE) 
								SELECT v_pengajuan_id, SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_peserta, ';', x), ';', -1), x, v_comp_code;
						SET x=x+1;
						END WHILE;
				END IF;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_jalandinas_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_jalandinas_url (ID_AJU, SEQ_ATC, URL_ATC_JALANDINAS) 
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;


				-- INSERT KE NOTIFIKASI
				SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik AND COMP_CODE=v_comp_code LIMIT 1;
				INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
				SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;

		
		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_aju 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU='PD', 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_keperluan,
						HEAD_TEXT2='-'
				WHERE ID_AJU=v_pengajuan_id;
				
				UPDATE z_r_jalandinas SET 
						NM_PEJABAT=v_nm_pejabat, 
						JABATAN=v_jabatan,
						TUJUAN=v_tujuan, 
						KEPERLUAN=v_keperluan, 
						TGL_BRKT=STR_TO_DATE(v_tgl_brkt, '%Y-%m-%d %H:%i:%s'), 
						TGL_PLNG=STR_TO_DATE(v_tgl_plng, '%Y-%m-%d %H:%i:%s'), 
						ALL_BDGJKT=v_all_bdgjkt, 
						ALL_LR_KOTA=v_all_lr_kota, 
						ALL_LR_NEGERI=v_all_lr_negeri, 
						TR_K_PRIBADI=v_tr_k_prbadi, 
						TR_K_DINAS=v_tr_k_dinas,
						TR_KA=v_tr_ka, 
						TR_PESAWAT=v_tr_pesawat, 
						TR_TRAVEL=v_tr_pesawat, 
						TR_BUS=v_tr_bus,
						AK_HOTEL=v_ak_hotel, 
						AK_HOTEL_NOM=v_ak_hotel_nom, 
						AK_HOTEL_KET=v_ak_hotel_ket, 
						AK_TR_LOC=v_ak_tr_loc, 
						AK_TR_LOC_NOM=v_ak_tr_loc_nom, 
						AK_TR_LOC_KET=v_ak_tr_loc_ket, 
						AK_SUSP=v_ak_susp, 
						AK_SUSP_NOM=v_ak_susp_nom, 
						AK_SUSP_KET=v_ak_susp_ket
				WHERE ID_AJU=v_pengajuan_id;

				-- INSERT PESERTA
				IF v_cnt_peserta>0 THEN
						SET x=1;
						DELETE FROM z_r_jalandinas_peserta WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_peserta DO
								INSERT INTO z_r_jalandinas_peserta (ID_AJU, NIK, SEQ, COMP_CODE) 
								SELECT v_pengajuan_id, SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_peserta, ';', x), ';', -1), x, v_comp_code;
						SET x=x+1;
						END WHILE;
				END IF;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_jalandinas_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_jalandinas_url (ID_AJU, SEQ_ATC, URL_ATC_JALANDINAS) 
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;

		END IF;
			
	  COMMIT;


		SET v_result = v_pengajuan_id;
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
		-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_GANTIB
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_GANTIB`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_GANTIB`(IN `v_pengajuan_id_` VARCHAR(30), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_periode` VARCHAR(4), IN `v_date` VARCHAR(30), IN `v_jenis_reimburse_id` INT, IN `v_nominal` FLOAT, IN `v_keterangan` VARCHAR(255), `v_cnt_file` INT, `v_params_image` VARCHAR(1500))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_cuti INT;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_result VARCHAR(255); 
DECLARE v_nik_atasan VARCHAR(30);
 
		
    -- INSERT KE TABLE Z_HEAD_AJU
		IF v_pengajuan_id_ ='0' THEN 

				-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code, 'PB')) INTO v_pengajuan_id FROM DUAL;
				SELECT UUID() INTO v_pengajuan_id FROM DUAL;
				
				-- INSERT INTO (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				INSERT INTO z_head_aju (ID_AJU,COMP_CODE,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				SELECT v_pengajuan_id, v_comp_code, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 'PB', 0, v_nik, v_jenis_reimburse_id, v_nominal FROM DUAL;
	
				INSERT INTO z_r_gantib (ID_AJU, TGL_KUITANSI, JNS_GANTIB, NOM_KUITANSI, KET_GANTIB)
				SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), v_jenis_reimburse_id, v_nominal, v_keterangan FROM DUAL;
	

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_gantib_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_gantib_url (ID_AJU, SEQ_ATC, URL_ATC_GANTIB) 
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;


				-- INSERT KE NOTIFIKASI
				SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik AND COMP_CODE=v_comp_code LIMIT 1;
				INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
				SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;
				

		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_aju 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_jenis_reimburse_id,
						HEAD_TEXT2=v_nominal
				WHERE ID_AJU=v_pengajuan_id;
				
				UPDATE z_r_gantib SET 
						TGL_KUITANSI=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'),
						JNS_GANTIB=v_jenis_reimburse_id, 
						NOM_KUITANSI=v_nominal,
						KET_GANTIB=v_keterangan
				WHERE ID_AJU=v_pengajuan_id;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_gantib_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_gantib_url (ID_AJU, SEQ_ATC, URL_ATC_GANTIB) 
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;

		END IF;
			
	  COMMIT;

	
		
		SET v_result = v_pengajuan_id;
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
			-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_IZIN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_IZIN`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_IZIN`(IN `v_pengajuan_id_` VARCHAR(30), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_id_abs_type` VARCHAR(10), IN `v_remark` VARCHAR(255), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_start_date` VARCHAR(30), IN `v_end_date` VARCHAR(30), IN `v_jml` INT, `v_cnt_file` INT, `v_params_image` VARCHAR(5000))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_izin INT;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_id_abs_type_ INT;
DECLARE v_result VARCHAR(255); 
DECLARE v_nik_atasan VARCHAR(25);
 

		/*
		MS	IZIN MASUK SIANG
		PC	IZIN PULANG CEPAT
		JK	IZIN DALAM JAM KERJA
		SK	IZIN SAKIT
		*/			
		/*
		1	HADIR
		2	TERLAMBAT
		3	IZIN
		4	IZIN MASUK SIANG
		5	IZIN PULANG CEPAT
		6	SAKIT
		7	CUTI
		8	MANGKIR
		9	DINAS LUAR
		10	TRAINING
		11	KETERANGAN LAIN*/
		
		
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

				-- CEK TGL PENGAJUAN TIDAK DUPLIKASI
				SELECT COUNT(A.ID_AJU) INTO v_cek_izin FROM z_r_izin A JOIN z_head_aju B ON A.ID_AJU=B.ID_AJU
				WHERE STR_TO_DATE(v_start_date,'%Y-%m-%d %H:%i:%s') BETWEEN A.TGL_AWAL_IZIN AND A.TGL_AKHIR_IZIN
				AND B.NIK=v_nik AND B.STS_AJU=1;
				IF v_cek_izin = 0 THEN

						-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,'IZ')) INTO v_pengajuan_id FROM DUAL;
						SELECT UUID() INTO v_pengajuan_id FROM DUAL;
						
						-- INSERT INTO (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
						INSERT INTO z_head_aju (ID_AJU,COMP_CODE,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
						SELECT v_pengajuan_id, v_comp_code , STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 'IZ', 0, v_nik, v_id_abs_type,'-' FROM DUAL;
				
						IF v_id_abs_type = 'MS' THEN
								SET v_id_abs_type_ = 4;
						ELSEIF  v_id_abs_type = 'PC' THEN
								SET v_id_abs_type_ = 5;
						ELSEIF  v_id_abs_type = 'JK' THEN
								SET v_id_abs_type_ = 3;
						ELSEIF  v_id_abs_type = 'SK' THEN
								SET v_id_abs_type_ = 6;
						ELSEIF  v_id_abs_type = 'LP' THEN
								SET v_id_abs_type_ = 13;
						END IF;

						INSERT INTO z_r_izin (ID_AJU, JNS_IZIN, ALASAN_IZIN, TGL_AWAL_IZIN, TGL_AKHIR_IZIN)
						SELECT v_pengajuan_id, v_id_abs_type_, v_remark, STR_TO_DATE(v_start_date, '%Y-%m-%d'), STR_TO_DATE(v_end_date, '%Y-%m-%d') FROM DUAL;
						
						-- INSERT FILE ATTACHMENT
						IF v_cnt_file>0 THEN
								SET x=1;
								DELETE FROM z_r_izin_url WHERE ID_AJU=v_pengajuan_id;
								WHILE x<=v_cnt_file DO
										INSERT INTO z_r_izin_url (ID_AJU, SEQ_ATC, URL_ATC_IZIN)
										SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
								SET x=x+1;
								END WHILE;
						END IF;

						-- INSERT KE NOTIFIKASI
						SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik AND COMP_CODE=v_comp_code LIMIT 1;
						INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
						SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;
				
				END IF;

		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_aju 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU='IZ', 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_id_abs_type,
						HEAD_TEXT2='-'
				WHERE ID_AJU=v_pengajuan_id;

				IF v_id_abs_type = 'MS' THEN
						SET v_id_abs_type_ = 4;
				ELSEIF  v_id_abs_type = 'PC' THEN
						SET v_id_abs_type_ = 5;
				ELSEIF  v_id_abs_type = 'JK' THEN
						SET v_id_abs_type_ = 3;
				ELSEIF  v_id_abs_type = 'SK' THEN
						SET v_id_abs_type_ = 6;
				END IF;
				
				UPDATE z_r_izin SET 
						JNS_IZIN=v_id_abs_type_, ALASAN_IZIN=v_remark, 
						TGL_AWAL_IZIN=STR_TO_DATE(v_start_date, '%Y-%m-%d'), 
						TGL_AKHIR_IZIN=STR_TO_DATE(v_end_date, '%Y-%m-%d') 
				WHERE ID_AJU=v_pengajuan_id;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_izin_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_izin_url (ID_AJU, SEQ_ATC, URL_ATC_IZIN)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				ELSEIF v_cnt_file=0 THEN
						DELETE FROM z_r_izin_url WHERE ID_AJU=v_pengajuan_id;
				END IF;

		END IF;

	
	  COMMIT;

	
		
		SET v_result = '1';
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
			-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_LAPORAN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_LAPORAN`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_LAPORAN`(IN `v_pengajuan_id_` VARCHAR(30), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_id_abs_type` VARCHAR(10), IN `v_remark` VARCHAR(255), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_start_date` VARCHAR(30), IN `v_end_date` VARCHAR(30), IN `v_jml` INT, `v_cnt_file` INT, `v_params_image` VARCHAR(5000))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_izin INT;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_id_abs_type_ INT;
DECLARE v_result VARCHAR(255); 
DECLARE v_nik_atasan VARCHAR(25);

		/*
		MS	IZIN MASUK SIANG
		PC	IZIN PULANG CEPAT
		JK	IZIN DALAM JAM KERJA
		SK	IZIN SAKIT
		*/			
		
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

					-- SELECT TRIM(Z_F_NOMOR_LAPORAN(v_comp_code,'LP')) INTO v_pengajuan_id FROM DUAL;
					SELECT UUID() INTO v_pengajuan_id FROM DUAL;

					INSERT INTO z_head_laporan (ID_AJU,COMP_CODE,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2,REMARK) 
					SELECT v_pengajuan_id, v_comp_code , STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 'LP', 0, v_nik, v_id_abs_type,'-', v_remark FROM DUAL;
			
					IF v_id_abs_type = 'PR' THEN
							SET v_id_abs_type_ = 1;
					ELSEIF  v_id_abs_type = 'DN' THEN
							SET v_id_abs_type_ = 2;
					ELSEIF  v_id_abs_type = 'PN' THEN
							SET v_id_abs_type_ = 3;
					ELSEIF  v_id_abs_type = 'CN' THEN
							SET v_id_abs_type_ = 4;
					END IF;

					-- INSERT FILE ATTACHMENT
					IF v_cnt_file>0 THEN
							SET x=1;
							DELETE FROM z_r_laporan_url WHERE id_aju=v_pengajuan_id;
							WHILE x<=v_cnt_file DO
									INSERT INTO z_r_laporan_url (ID_AJU, SEQ_ATC, URL_ATC_IZIN)
									SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
							SET x=x+1;
							END WHILE;
					END IF;

					-- INSERT KE NOTIFIKASI
					/*
					SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik AND COMP_CODE=v_comp_code LIMIT 1;
					INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
					SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;
					*/
				
		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_laporan 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU='LP', 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_id_abs_type,
						HEAD_TEXT2='-',
						REMARK = v_remark 
				WHERE ID_AJU=v_pengajuan_id;

				IF v_id_abs_type = 'PR' THEN
						SET v_id_abs_type_ = 1;
				ELSEIF  v_id_abs_type = 'DN' THEN
						SET v_id_abs_type_ = 2;
				ELSEIF  v_id_abs_type = 'PN' THEN
						SET v_id_abs_type_ = 3;
				ELSEIF  v_id_abs_type = 'CN' THEN
						SET v_id_abs_type_ = 4;
				END IF;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_laporan_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_laporan_url (ID_AJU, SEQ_ATC, URL_ATC_IZIN)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				ELSEIF v_cnt_file=0 THEN
						DELETE FROM z_r_laporan_url WHERE ID_AJU=v_pengajuan_id;
				END IF;

		END IF;

	
	  COMMIT;

	
		
		SET v_result = '1';
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
			-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_LEMBUR
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_LEMBUR`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_LEMBUR`(IN `v_pengajuan_id_` VARCHAR(36), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_id_abs_type` VARCHAR(10), IN `v_remark` VARCHAR(255), IN `v_periode` INT, IN `v_date` VARCHAR(30), IN `v_start_date` VARCHAR(30), IN `v_end_date` VARCHAR(30), IN `v_start_time` VARCHAR(8), IN `v_end_time` VARCHAR(8), IN `v_pj` VARCHAR(100), `v_jml` INT, `v_cnt_file` INT, `v_params_image` VARCHAR(5000))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_izin INT;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(36);
DECLARE v_result VARCHAR(255); 
DECLARE v_nik_atasan VARCHAR(25);

		/*
		MS	IZIN MASUK SIANG
		PC	IZIN PULANG CEPAT
		JK	IZIN DALAM JAM KERJA
		SK	IZIN SAKIT
		*/			
		
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

					-- SELECT TRIM(Z_F_NOMOR_LAPORAN(v_comp_code,'LP')) INTO v_pengajuan_id FROM DUAL;
					SELECT UUID() INTO v_pengajuan_id FROM DUAL;

					INSERT INTO z_head_lembur (ID_AJU,COMP_CODE,TGL_AJU,WKT_AWAL,WKT_AKHIR,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2,REMARK,PJ) 
					SELECT v_pengajuan_id, v_comp_code , STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), v_start_time, v_end_time, 'OT', 0, v_nik, v_id_abs_type,'-', v_remark, v_pj FROM DUAL;
			
					-- INSERT FILE ATTACHMENT
					IF v_cnt_file>0 THEN
							SET x=1;
							DELETE FROM z_r_lembur_url WHERE id_aju=v_pengajuan_id;
							WHILE x<=v_cnt_file DO
									INSERT INTO z_r_lembur_url (ID_AJU, SEQ_ATC, URL_ATC_LEMBUR)
									SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
							SET x=x+1;
							END WHILE;
					END IF;
				
		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_lembur 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU='OT', 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_id_abs_type,
						HEAD_TEXT2='-',
						WKT_AWAL = v_start_time,
						WKT_AKHIR = v_end_time,
						REMARK = v_remark,
					  PJ = v_pj
				WHERE ID_AJU=v_pengajuan_id;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_lembur_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_lembur_url (ID_AJU, SEQ_ATC, URL_ATC_LEMBUR)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				ELSEIF v_cnt_file=0 THEN
						DELETE FROM z_r_lembur_url WHERE ID_AJU=v_pengajuan_id;
				END IF;

		END IF;

	
	  COMMIT;

	
		
		SET v_result = '1';
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
			-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_PELATIHAN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_PELATIHAN`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_PELATIHAN`(IN `v_pengajuan_id_` VARCHAR(30), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_periode` VARCHAR(4), IN `v_date` VARCHAR(30), IN `v_nm_lembaga` VARCHAR(150), IN `v_nm_training` VARCHAR(150), IN `v_tempat_tr` VARCHAR(250), IN `v_tgl_start_tr` VARCHAR(30), IN `v_tgl_end_tr` VARCHAR(30), IN `v_catatan` VARCHAR(150), `v_cnt_file` INT, `v_params_image` VARCHAR(1500))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_cuti DOUBLE;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_result VARCHAR(150); 
DECLARE v_nik_atasan VARCHAR(30);
 
		
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

				-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,'TR')) INTO v_pengajuan_id FROM DUAL;
				SELECT UUID() INTO v_pengajuan_id FROM DUAL;
				
				-- INSERT INTO (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				INSERT INTO z_head_aju (ID_AJU,COMP_CODE,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				SELECT v_pengajuan_id, v_comp_code, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 'TR', 0, v_nik, v_nm_training, '-' FROM DUAL;
	
				INSERT INTO z_r_training (ID_AJU, NM_LEMBAGA, NM_TRAINING, TEMPAT_TR, TGL_START_TR, TGL_END_TR, CATATAN)
				SELECT v_pengajuan_id, 
							 v_nm_lembaga,
							 v_nm_training,
							 v_tempat_tr,
							 STR_TO_DATE(v_tgl_start_tr, '%Y-%m-%d %H:%i:%s'), 
							 STR_TO_DATE(v_tgl_end_tr, '%Y-%m-%d %H:%i:%s'),
							 v_catatan 
							 v_catatan 
				FROM DUAL;


				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_training_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_training_url (ID_AJU, SEQ_ATC, URL_ATC_TRAINING)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;


				-- INSERT KE NOTIFIKASI
				SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik AND COMP_CODE=v_comp_code LIMIT 1;
				INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
				SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;
		
		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_aju 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU='TR', 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_nm_training,
						HEAD_TEXT2='-'
				WHERE ID_AJU=v_pengajuan_id;
				
				UPDATE z_r_training SET 
						NM_LEMBAGA = v_nm_lembaga,
						NM_TRAINING = v_nm_training,
						TEMPAT_TR = v_tempat_tr,
						TGL_START_TR=STR_TO_DATE(v_tgl_start_tr, '%Y-%m-%d %H:%i:%s'),
						TGL_END_TR=STR_TO_DATE(v_tgl_end_tr, '%Y-%m-%d %H:%i:%s'),
						CATATAN = v_catatan
				WHERE ID_AJU=v_pengajuan_id;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_training_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_training_url (ID_AJU, SEQ_ATC, URL_ATC_TRAINING)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;

		END IF;
			
	  COMMIT;

	
		
		SET v_result = v_pengajuan_id;
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
		-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for Z_P_SIMPAN_PENGOBATAN
-- ----------------------------
DROP PROCEDURE IF EXISTS `Z_P_SIMPAN_PENGOBATAN`;
delimiter ;;
CREATE PROCEDURE `Z_P_SIMPAN_PENGOBATAN`(IN `v_pengajuan_id_` VARCHAR(30), IN `v_nik` VARCHAR(30), IN `v_comp_code` VARCHAR(6), IN `v_periode` VARCHAR(4), IN `v_date` VARCHAR(30), IN `v_pengobatan_id` VARCHAR(30), IN `v_nama` VARCHAR(150), IN `v_diagnosa` VARCHAR(150), IN `v_nominal` DOUBLE, IN `v_nilai_diganti` DOUBLE, `v_cnt_file` INT, `v_params_image` VARCHAR(1500))
BEGIN
DECLARE v_cnt INT;
DECLARE x INT;
DECLARE v_file_name VARCHAR(1500);
DECLARE v_cek_cuti INT;
DECLARE v_date_ DATETIME;
DECLARE v_pengajuan_id VARCHAR(30);
DECLARE v_result VARCHAR(150); 
DECLARE v_nik_atasan VARCHAR(30);
DECLARE v_potongan DOUBLE;
DECLARE v_potongan_pribadi FLOAT;
DECLARE v_potongan_keluarga FLOAT;
DECLARE v_nilai_diganti_fix DOUBLE;
DECLARE v_pot DOUBLE;
DECLARE v_pot_fix DOUBLE;
 
		
		-- CEK SIAPA YANG MENGAJUKAN

		SET v_potongan_pribadi = 0;
		SET v_potongan_keluarga = 0;
		SET v_potongan =0;
		SET v_nilai_diganti_fix = 0;
		-- CEK POTONGAN JIKA PRIBADI YANG MENGAJUKAN
		
		
		SELECT COALESCE(A.GANTI_OBAT,0) INTO v_potongan_pribadi FROM z_personalize A
		JOIN z_karyawan B ON A.NIK_STAFF=B.NIK WHERE A.NIK_STAFF=v_nik AND B.NAMA=v_nama AND A.COMP_CODE=v_comp_code;

		SELECT COALESCE(GANTI_OBAT,0) INTO v_potongan_keluarga FROM z_keluarga 
		WHERE NIK=v_nik AND NAMA_KEL=v_nama AND COMP_CODE=v_comp_code;
		
		
		-- CEK POTONGAN JIKA KELUARGA YANG MENGAJUKAN
		IF v_potongan_pribadi IS NULL OR v_potongan_pribadi = 0 THEN 
				SET v_potongan_pribadi = 0; 
		END IF;
	
		IF v_potongan_keluarga IS NULL OR v_potongan_keluarga = 0 THEN
			SET v_potongan_keluarga = 0; 
		END IF;

		IF v_potongan_pribadi >= v_potongan_keluarga THEN
				SET v_potongan = v_potongan_pribadi;
		ELSEIF v_potongan_keluarga >= v_potongan_pribadi THEN
				SET v_potongan = v_potongan_keluarga;
		ELSE 
				SET v_potongan = 0;
		END IF;

		IF v_potongan = 100 THEN 
				SET v_nilai_diganti_fix = v_nominal;
		ELSEIF v_potongan > 0 THEN
				SET v_pot = v_potongan/100;
				SET v_pot_fix = v_nominal * v_pot;
				SET v_nilai_diganti_fix = v_nominal - (v_nominal - v_pot_fix);
		ELSEIF v_potongan = 0 THEN
				SET v_nilai_diganti_fix = 0;
		END IF;
	
		
		-- END CEK SIAPA YANG MENGAJUKAN

	
    -- INSERT KE TABLE z_head_aju
		IF v_pengajuan_id_ ='0' THEN 

				-- SELECT TRIM(Z_F_NOMOR_PENGAJUAN(v_comp_code,v_pengobatan_id)) INTO v_pengajuan_id FROM DUAL;
				SELECT UUID() INTO v_pengajuan_id FROM DUAL;
				-- INSERT INTO (ID_AJU,TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				INSERT INTO z_head_aju (ID_AJU,COMP_CODE, TGL_AJU,JNS_AJU,STS_AJU,NIK,HEAD_TEXT1,HEAD_TEXT2) 
				SELECT v_pengajuan_id, v_comp_code, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), v_pengobatan_id, 0, v_nik, v_nama, v_nilai_diganti_fix FROM DUAL;
	
				INSERT INTO z_r_obat (ID_AJU, TGL_KUITANSI, NAMA_KUITANSI, DIAGNOSA, NOM_KUITANSI, NILAI_DIGANTI)
				SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), v_nama, v_diagnosa, v_nominal, v_nilai_diganti_fix FROM DUAL;
		
				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_obat_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_obat_url (ID_AJU, SEQ_ATC, URL_ATC_OBAT)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				END IF;

				-- INSERT KE NOTIFIKASI
				SELECT NIK_ATASAN INTO v_nik_atasan FROM z_personalize WHERE  NIK_STAFF=v_nik LIMIT 1;
				INSERT INTO z_notifikasi (ID_AJU, TGL, STS_AJU, IS_READ, NIK)
				SELECT v_pengajuan_id, STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 0, 0, v_nik_atasan FROM DUAL;

		ELSEIF v_pengajuan_id_ <>'0' THEN
				SET v_pengajuan_id = v_pengajuan_id_;
				UPDATE z_head_aju 
				SET 
						TGL_AJU=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'), 
						JNS_AJU=v_pengobatan_id, 
						STS_AJU=0, 
						NIK=v_nik, 
						HEAD_TEXT1=v_nama,
						HEAD_TEXT2=v_nilai_diganti_fix
				WHERE ID_AJU=v_pengajuan_id;
				
				UPDATE z_r_obat SET 
						TGL_KUITANSI=STR_TO_DATE(v_date, '%Y-%m-%d %H:%i:%s'),
						NAMA_KUITANSI=v_nama, 
						DIAGNOSA=v_diagnosa, 
						NOM_KUITANSI=v_nominal,
						NILAI_DIGANTI=v_nilai_diganti_fix
				WHERE ID_AJU=v_pengajuan_id;

				-- INSERT FILE ATTACHMENT
				IF v_cnt_file>0 THEN
						SET x=1;
						DELETE FROM z_r_obat_url WHERE ID_AJU=v_pengajuan_id;
						WHILE x<=v_cnt_file DO
								INSERT INTO z_r_obat_url (ID_AJU, SEQ_ATC, URL_ATC_OBAT)
								SELECT v_pengajuan_id, x , SUBSTRING_INDEX(SUBSTRING_INDEX(v_params_image, ';', x), ';', -1);
						SET x=x+1;
						END WHILE;
				ELSEIF v_cnt_file=0 THEN
						DELETE FROM z_r_obat_url WHERE ID_AJU=v_pengajuan_id;
				END IF;

		END IF;
			
	  COMMIT;

	
		SET v_result = v_pengajuan_id;
		SELECT v_result;
		-- dbms_output.put_line(v_pengajuan_id_);
			
			-- SELECT TRIM(TO_CHAR(1)||';'||TO_CHAR(v_cek_izin)) INTO v_result_str  FROM DUAL;
			

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
