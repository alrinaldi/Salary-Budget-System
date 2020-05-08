-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2020 at 11:25 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_bonus`
--

CREATE TABLE `asumsi_bonus` (
  `id_bonus` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `rupiah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_bonus`
--

INSERT INTO `asumsi_bonus` (`id_bonus`, `gol`, `tahun`, `rupiah`) VALUES
(6, 0, 2019, 8225121),
(7, 1, 2019, 31481740),
(8, 2, 2019, 34701440),
(9, 3, 2019, 37419032),
(10, 4, 2019, 84422598),
(11, 0, 2020, 8910180),
(12, 1, 2020, 34837300),
(13, 2, 2020, 38400180),
(14, 3, 2020, 41374080),
(15, 4, 2020, 90481860),
(16, 0, 2021, 10068000),
(17, 1, 2021, 12310000),
(18, 2, 2021, 14066000),
(19, 3, 2021, 15672000),
(20, 4, 2021, 19908000);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol0`
--

CREATE TABLE `asumsi_gol0` (
  `id_asumsi_gol1` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_gol0`
--

INSERT INTO `asumsi_gol0` (`id_asumsi_gol1`, `a`, `b`, `c`, `d`, `e`, `tanggal`) VALUES
(1, 0, 0, 0, 0, 4600000, '2020-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol1`
--

CREATE TABLE `asumsi_gol1` (
  `id_asumsi_gol1` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol2`
--

CREATE TABLE `asumsi_gol2` (
  `id_asumsi_gol2` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `f` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol3`
--

CREATE TABLE `asumsi_gol3` (
  `id_asumsi_gol3` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol4`
--

CREATE TABLE `asumsi_gol4` (
  `id_asumsi_gol4` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol5`
--

CREATE TABLE `asumsi_gol5` (
  `id_asumsi_gol5` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gol6`
--

CREATE TABLE `asumsi_gol6` (
  `id_asumsi_gol6` int(12) NOT NULL,
  `a` int(12) NOT NULL,
  `b` int(12) NOT NULL,
  `c` int(12) NOT NULL,
  `d` int(12) NOT NULL,
  `e` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gp`
--

CREATE TABLE `asumsi_gp` (
  `id_asumsi` int(11) NOT NULL,
  `id_asumsi_gol0` int(11) NOT NULL,
  `id_asumsi_gol1` int(11) NOT NULL,
  `id_asumsi_gol2` int(11) NOT NULL,
  `id_asumsi_gol3` int(11) NOT NULL,
  `id_asumsi_gol4` int(11) NOT NULL,
  `id_asumsi_gol5` int(11) NOT NULL,
  `id_asumsi_gol6` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_gp_avg`
--

CREATE TABLE `asumsi_gp_avg` (
  `id_asumsi` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `rupiah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_gp_avg`
--

INSERT INTO `asumsi_gp_avg` (`id_asumsi`, `gol`, `tahun`, `rupiah`) VALUES
(1, 0, 2020, 5034000),
(2, 1, 2020, 6155000),
(3, 2, 2020, 7033000),
(4, 3, 2020, 7836000),
(5, 4, 2020, 9954000),
(6, 0, 2019, 4000000),
(7, 1, 2019, 4500000),
(8, 2, 2019, 5000000),
(9, 3, 2019, 5500000),
(10, 4, 2019, 6000000),
(12, 0, 2021, 5034000),
(13, 1, 2021, 6155000),
(14, 2, 2021, 7033000),
(15, 3, 2021, 7836000),
(16, 4, 2021, 9954000),
(17, 0, 2022, 5134680),
(18, 1, 2022, 6278100),
(19, 2, 2022, 7173660),
(20, 3, 2022, 7992720),
(21, 4, 2022, 10153080);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_holiday_allowance`
--

CREATE TABLE `asumsi_holiday_allowance` (
  `id_holiday_allowance` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_incentive`
--

CREATE TABLE `asumsi_incentive` (
  `id_incentive` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_manpowerinsurance`
--

CREATE TABLE `asumsi_manpowerinsurance` (
  `id_a_manpower` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_manpowerinsurance`
--

INSERT INTO `asumsi_manpowerinsurance` (`id_a_manpower`, `gol`, `rupiah`, `tahun`) VALUES
(1, 0, 265292, 2020),
(2, 1, 324369, 2020),
(3, 2, 370639, 2020),
(4, 3, 412957, 2020),
(5, 4, 524576, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_medical_expense_bpjs`
--

CREATE TABLE `asumsi_medical_expense_bpjs` (
  `id_asumsi` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_medical_expense_obat`
--

CREATE TABLE `asumsi_medical_expense_obat` (
  `id_mex_o` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `rupiah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_medical_expense_obat`
--

INSERT INTO `asumsi_medical_expense_obat` (`id_mex_o`, `gol`, `tahun`, `rupiah`) VALUES
(1, 0, 2019, 63200),
(2, 1, 2019, 285200),
(3, 2, 2019, 285200),
(4, 3, 2019, 285200),
(5, 4, 2019, 529728),
(6, 0, 2020, 68256),
(7, 1, 2020, 308016),
(8, 2, 2020, 308016),
(9, 3, 2020, 308016),
(10, 4, 2020, 572106);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_overtime`
--

CREATE TABLE `asumsi_overtime` (
  `id_asumsi_overtime` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `rupiah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_overtime`
--

INSERT INTO `asumsi_overtime` (`id_asumsi_overtime`, `gol`, `tahun`, `rupiah`) VALUES
(1, 0, '2020', 72652),
(2, 1, '2020', 86506),
(3, 2, '2020', 97001),
(4, 3, '2020', 106810),
(5, 4, '2020', 132747),
(12, 0, '2019', 69193),
(13, 1, '2019', 82387),
(14, 2, '2019', 92382),
(15, 3, '2019', 101724),
(16, 4, '2019', 126426),
(17, 0, '2021', 74105),
(18, 1, '2021', 88236),
(19, 2, '2021', 98941),
(20, 3, '2021', 108946),
(21, 4, '2021', 135402);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_pensiondpa`
--

CREATE TABLE `asumsi_pensiondpa` (
  `id_pensiondpa` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_pensiondpa`
--

INSERT INTO `asumsi_pensiondpa` (`id_pensiondpa`, `gol`, `rupiah`, `tahun`) VALUES
(1, 0, 322176, 2020),
(2, 1, 393920, 2020),
(3, 2, 450112, 2020),
(4, 3, 501504, 2020),
(5, 4, 637056, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_percentage`
--

CREATE TABLE `asumsi_percentage` (
  `id_percentage` int(11) NOT NULL,
  `inflasi` int(11) NOT NULL,
  `gp0` int(11) NOT NULL,
  `gp1` int(11) NOT NULL,
  `gp2` int(11) NOT NULL,
  `gp3` int(11) NOT NULL,
  `gp4` int(11) NOT NULL,
  `gp5` int(11) NOT NULL,
  `gp6` int(11) NOT NULL,
  `medical_expense(obat)` int(11) NOT NULL,
  `medical_expense(bpjs)` int(11) NOT NULL,
  `hospitalization` int(11) NOT NULL,
  `man_power_insurance` int(11) NOT NULL,
  `donation_to_employe` int(11) NOT NULL,
  `housing_allowance` int(11) NOT NULL,
  `employee_income_tax_allowance` int(11) NOT NULL,
  `pension_allowance(DPA)` int(11) NOT NULL,
  `pension_allowance(bpjs)` int(11) NOT NULL,
  `telecomunication` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_thr`
--

CREATE TABLE `asumsi_thr` (
  `id_thr` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `rupiah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_tnj_hadir`
--

CREATE TABLE `asumsi_tnj_hadir` (
  `id_tnj_hadir` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asumsi_tnj_hadir`
--

INSERT INTO `asumsi_tnj_hadir` (`id_tnj_hadir`, `gol`, `rupiah`, `tahun`) VALUES
(1, 0, 0, 2019),
(2, 1, 175000, 2019),
(3, 2, 205000, 2019),
(4, 3, 235000, 2019),
(5, 4, 0, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `asumsi_transportasi`
--

CREATE TABLE `asumsi_transportasi` (
  `id_transportasi` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bonus_asumsi`
--

CREATE TABLE `bonus_asumsi` (
  `id_bonus` int(11) NOT NULL,
  `gp1` int(11) NOT NULL,
  `gp2` int(11) NOT NULL,
  `gp3` int(11) NOT NULL,
  `gp4` int(11) NOT NULL,
  `gp5` int(11) NOT NULL,
  `gp6` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `costcenter`
--

CREATE TABLE `costcenter` (
  `costcenter` varchar(50) NOT NULL,
  `lineSeksi` varchar(50) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `costAllocation` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `costcenter`
--

INSERT INTO `costcenter` (`costcenter`, `lineSeksi`, `divisi`, `costAllocation`, `dept`) VALUES
('0', 'Board of Director', '-', 'OPEX', ''),
('10', 'Division, Manager & Gol 4', '-', 'OPEX', ''),
('100', 'QEHS COMMITTEE', '-', 'OPEX', 'QEHS'),
('101', 'QEHS - EHS System Development', '-', 'OPEX', 'QEHS'),
('102', 'QEHS - EHS Operation Control', '-', 'OPEX', 'QEHS'),
('103', 'QEHS - Innovation Center', '-', 'OPEX', 'QEHS'),
('1100', 'HRD DEPT', 'HR, GA  DIVISION', 'OPEX', ''),
('1101', 'Recruitment & Training', 'HR, GA  DIVISION', 'OPEX', ''),
('1102', 'Remuneration & Pers Admin', 'HR, GA  DIVISION', 'OPEX', ''),
('1103', 'IR & Welfare', 'HR, GA  DIVISION', 'OPEX', ''),
('1104', 'People Development', 'HR, GA  DIVISION', 'OPEX', ''),
('1200', 'GENERAL AFFAIR DEPT', 'HR, GA  DIVISION', 'OPEX', ''),
('1201', 'General Services 1', 'HR, GA  DIVISION', 'OPEX', ''),
('1202', 'General Services 2', 'HR, GA  DIVISION', 'OPEX', ''),
('1203', 'General Services 3', 'HR, GA  DIVISION', 'OPEX', ''),
('1204', 'Legal & CSR', 'HR, GA  DIVISION', 'OPEX', ''),
('1205', 'Security', 'HR, GA  DIVISION', 'OPEX', ''),
('1300', 'INFORMATION TECHNOLOGY DEPT', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('1301', 'Infrastructure', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('1302', 'Application System', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('1303', 'Bussiness Process & Data Management', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('20', 'Advisors', '-', 'OPEX', ''),
('200', 'INTERNAL CONTROL & RISK MANAGEMENT', '-', 'OPEX', ''),
('201', 'ICRM - IT Control', '-', 'OPEX', ''),
('202', 'IARM - Internal Audit General', '-', 'OPEX', ''),
('203', 'IARM - General Risk Management', '-', 'OPEX', ''),
('2100', 'MARKETING DEPT', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2101', 'Marketing Administration & Compliance', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2102', 'Marketing', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2103', 'New Model Development', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2200', 'PURCHASING DEPT', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2201', 'Procurement P1', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2202', 'Procurement P2', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2203', 'Procurement New Model', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2204', 'Purchasing', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('2205', 'Import Export', 'MARKETING & PURCHASING DIVISION', 'OPEX', ''),
('3100', 'FINANCE DEPT', 'FINANCE ACCOUNTING DIVISION', 'OPEX', ''),
('3101', 'Administration', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3102', 'Treasury', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3200', 'ACCOUNTING & TAX DEPT', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3201', 'General Accounting', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3202', 'Assets & Tax', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3203', 'Cost Inventory', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3300', 'FINANCIAL PLANNING & ANALYSIS', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('3301', 'Budget', 'FINANCE ACCOUNTING & IT DIVISION', 'OPEX', ''),
('4100', 'PPIC DEPT', 'PPIC & PRODUCTION DIVISION', 'OPEX', ''),
('4101', 'Prod Plan & Control 1', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4102', 'Prod Plan & Control 2', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4103', 'Prod Plan & Control 3', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4104', 'Material Plan & Inventory Control', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4105', 'Delivery Control', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4106', 'Finished Goods WH1', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4107', 'Internal WH1', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4108', 'Finished Goods WH2', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4109', 'Internal WH2', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4200', 'PRODUCTION MF 2W PLANT 1', 'PPIC & PRODUCTION DIVISION', 'OPEX', ''),
('4210', 'Support Welding', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4211', 'Welding 1', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4212', 'Welding 2', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4213', 'Welding 3', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4214', 'Welding 4', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4215', 'Welding 5', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4216', 'Welding 6', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4217', 'Bender Line', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4220', 'Support STA', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4221', 'Blasting', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4222', 'Painting', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4223', 'Final Assy', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4300', 'PRODUCTION MF 2W PLANT 2', 'PPIC & PRODUCTION DIVISION', 'OPEX', ''),
('4310', 'Support Welding', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4311', 'Welding 1', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4312', 'Welding 2', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4313', 'Welding 3', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4314', 'Welding 4', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4315', 'Welding 5', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4316', 'Welding 6', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4317', 'Bender Line', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4318', 'Welding 8', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4319', 'WELDING 9', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4320', 'Support STA', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4321', 'Treatment', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4322', 'Blasting', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4323', 'Outer Painting', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4324', 'Final Assy (Cub / Matic)', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4325', 'Final Assy (Sport)', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4400', 'PRODUCTION MF 4W', 'PPIC & PRODUCTION DIVISION', 'OPEX', ''),
('4410', 'Support Welding Cold', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4411', 'Welding 1', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4412', 'Welding 2', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4413', 'Welding 3', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4414', 'Welding 4', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4420', 'Support Welding Hot', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4421', 'Welding 5', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4422', 'Welding 6', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4423', 'Seamer', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4424', 'Subline (Roll Tig)', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4425', 'Subline Bender', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4426', 'Subline Canning', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4427', 'Sub Comp Direct', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4428', 'Touch Up (Cover Conventer 2TQ, 2MG, 2SJ)', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4429', 'Sub Comp Underfloor', 'PPIC & PRODUCTION DIVISION', 'MUFFLER', ''),
('4500', 'PRODUCTION DB', 'PPIC & PRODUCTION DIVISION', 'OPEX', ''),
('4510', 'Support Disk Brake 1', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('4511', 'Pressing', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4512', 'HFPQ', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4513', 'Machining', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4518', 'Finishing', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4520', 'Support Disk Brake 2', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4521', 'Electropolishing', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4522', 'Blasting Disk Brake', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4523', 'Painting', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('4524', 'Grinding', 'PPIC & PRODUCTION DIVISION', 'DISC', ''),
('5100', 'ENGINEERING DEPT', 'ENGINEERING & PLANT SERVICE DIVISION', 'OPEX', ''),
('5101', 'Product Development Engineering', 'ENGINEERING & PLANT SERVICE DIVISION', 'MUFFLER', ''),
('5102', 'Process Eng MF 2W - 1', 'ENGINEERING & PLANT SERVICE DIVISION', 'OPEX', ''),
('5103', 'Process Eng MF 2W - 2', 'ENGINEERING & PLANT SERVICE DIVISION', 'OPEX', ''),
('5104', 'Process Eng MF 4W', 'ENGINEERING & PLANT SERVICE DIVISION', 'MUFFLER', ''),
('5105', 'Process Eng DB', 'ENGINEERING & PLANT SERVICE DIVISION', 'OPEX', ''),
('5106', 'Technology Development & Standarization', 'ENGINEERING & PLANT SERVICE DIVISION', 'ALL', ''),
('5200', 'PLANT SERVICE DEPT', 'ENGINEERING & PLANT SERVICE DIVISION', 'OPEX', ''),
('5201', 'Facility Provider 1', 'ENGINEERING & PLANT SERVICE DIVISION', 'ALL', ''),
('5202', 'Machinery Maintenance 1', 'ENGINEERING & PLANT SERVICE DIVISION', 'DISC', ''),
('5203', 'DJTF Maintenance 1', 'ENGINEERING & PLANT SERVICE DIVISION', 'ALL', ''),
('5204', 'Facility Provider 2', 'ENGINEERING & PLANT SERVICE DIVISION', 'ALL', ''),
('5205', 'Machinery Maintenance 2', 'ENGINEERING & PLANT SERVICE DIVISION', 'MUFFLER', ''),
('5206', 'DJTF Maintenance 2', 'ENGINEERING & PLANT SERVICE DIVISION', 'MUFFLER', ''),
('5207', 'WWT', 'ENGINEERING & PLANT SERVICE DIVISION', 'ALL', ''),
('6100', 'QUALITY CONTROL DEPT', 'QUALITY ASSURANCE DIVISION', 'OPEX', ''),
('6101', 'QC 2W - 1', 'QUALITY ASSURANCE DIVISION', 'DISC', ''),
('6102', 'QC 2W - 2', 'QUALITY ASSURANCE DIVISION', 'ALL', ''),
('6103', 'QC 4W', 'QUALITY ASSURANCE DIVISION', 'MUFFLER', ''),
('6104', 'QC Supplier', 'QUALITY ASSURANCE DIVISION', 'DISC', ''),
('6105', 'FQC', 'QUALITY ASSURANCE DIVISION', 'MUFFLER', ''),
('6106', 'CQA', 'QUALITY ASSURANCE DIVISION', 'DISC', ''),
('6200', 'QUALITY SYSTEM & FACILITIES DEPT', 'QUALITY ASSURANCE DIVISION', 'OPEX', ''),
('6201', '2WQS', 'QUALITY ASSURANCE DIVISION', 'MUFFLER', ''),
('6202', '4WQS', 'QUALITY ASSURANCE DIVISION', 'MUFFLER', ''),
('6203', 'QF', 'QUALITY ASSURANCE DIVISION', 'MUFFLER', ''),
('6204', 'SQS', 'QUALITY ASSURANCE DIVISION', 'MUFFLER', ''),
('YMI1', 'PABRIK1', 'PPIC & PRODUCTION DIVISION', 'ALL', ''),
('YMI2', 'PABRIK2', 'PPIC & PRODUCTION DIVISION', 'ALL', '');

-- --------------------------------------------------------

--
-- Table structure for table `group_gol`
--

CREATE TABLE `group_gol` (
  `id_gol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_gol`
--

INSERT INTO `group_gol` (`id_gol`) VALUES
(0),
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `incentive_asumsi`
--

CREATE TABLE `incentive_asumsi` (
  `id_incentive` int(11) NOT NULL DEFAULT 0,
  `gp1` int(11) NOT NULL,
  `gp2` int(11) NOT NULL,
  `gp3` int(11) NOT NULL,
  `gp4` int(11) NOT NULL,
  `gp5` int(11) NOT NULL,
  `gp6` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nrp` int(7) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `dept` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nrp`, `nama`, `password`, `level`, `dept`) VALUES
(866, '0866', '0866', 2, ''),
(877, 'RO', '0877', 1, ''),
(888, 'LI', '0888', 1, 'PURCHASING');

-- --------------------------------------------------------

--
-- Table structure for table `master_mpp`
--

CREATE TABLE `master_mpp` (
  `id_master_mpp` int(11) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `kontrak` int(11) NOT NULL,
  `gol1` int(11) NOT NULL,
  `gol2` int(11) NOT NULL,
  `gol3` int(11) NOT NULL,
  `gol4` int(11) NOT NULL,
  `gol5` int(11) NOT NULL,
  `gol6` int(11) NOT NULL,
  `bulan` date NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_mpp`
--

INSERT INTO `master_mpp` (`id_master_mpp`, `workcenter`, `seksi`, `dept`, `kontrak`, `gol1`, `gol2`, `gol3`, `gol4`, `gol5`, `gol6`, `bulan`, `tahun`) VALUES
(1, '2200', 'Purchasing Dept', 'Purchasing', 0, 0, 0, 0, 9, 0, 0, '2020-01-01', 2020),
(2, '2201', 'Procurement P1', 'Purchasing', 0, 0, 1, 2, 0, 0, 0, '2020-01-01', 2020),
(3, '2202', 'Procurement P2', 'Purchasing', 1, 3, 1, 1, 0, 0, 0, '2020-01-01', 2020),
(4, '2203', 'Procurement New Model', 'Purchasing', 1, 0, 0, 1, 0, 0, 0, '2020-01-01', 2020),
(5, '2204', 'Purchasing', 'Purchasing', 1, 0, 4, 2, 0, 0, 0, '2020-01-01', 2020),
(6, '2205', 'Import Export', 'Purchasing', 0, 0, 1, 1, 0, 0, 0, '2020-01-01', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `id_meal` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `gol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`id_meal`, `rupiah`, `tahun`, `gol`) VALUES
(1, 8225121, 2019, 0),
(2, 31487740, 2019, 1),
(3, 34701440, 2019, 2),
(4, 37419032, 2019, 3),
(5, 84422598, 2019, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mpp`
--

CREATE TABLE `mpp` (
  `id_mpp` int(11) NOT NULL,
  `workcenter` varchar(30) NOT NULL,
  `gol` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_agustus`
--

CREATE TABLE `mpp_agustus` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_april`
--

CREATE TABLE `mpp_april` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_desember`
--

CREATE TABLE `mpp_desember` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_februaari`
--

CREATE TABLE `mpp_februaari` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol0`
--

CREATE TABLE `mpp_gol0` (
  `id_mpp0` int(11) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `jmlh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mpp_gol0`
--

INSERT INTO `mpp_gol0` (`id_mpp0`, `workcenter`, `dept`, `tahun`, `bulan`, `seksi`, `jmlh`) VALUES
(1, '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol1`
--

CREATE TABLE `mpp_gol1` (
  `id_mpp1` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol2`
--

CREATE TABLE `mpp_gol2` (
  `id_mpp2` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol3`
--

CREATE TABLE `mpp_gol3` (
  `id_mpp3` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol4`
--

CREATE TABLE `mpp_gol4` (
  `id_mpp1` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol5`
--

CREATE TABLE `mpp_gol5` (
  `id_mpp5` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_gol6`
--

CREATE TABLE `mpp_gol6` (
  `id_mpp1` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_januari`
--

CREATE TABLE `mpp_januari` (
  `id_mpp_jan` int(11) NOT NULL,
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `kontrak` int(11) NOT NULL,
  `gol1` int(11) NOT NULL,
  `gol2` int(11) NOT NULL,
  `gol3` int(11) NOT NULL,
  `gol4` int(11) NOT NULL,
  `gol5` int(11) NOT NULL,
  `gol6` int(11) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mpp_januari`
--

INSERT INTO `mpp_januari` (`id_mpp_jan`, `workcenter`, `seksi`, `kontrak`, `gol1`, `gol2`, `gol3`, `gol4`, `gol5`, `gol6`, `dept`, `tahun`) VALUES
(1, '2200', 'Purchasing Dept', 0, 0, 0, 0, 9, 0, 0, 'PURCHASING', 2020),
(2, '2201', 'Procurement P1', 0, 0, 1, 2, 0, 0, 0, 'PURCHASING', 2020),
(3, '2202', 'Procurement P2', 1, 3, 1, 1, 0, 0, 0, 'PURCHASING', 2020),
(4, '2203', 'Procurement New Model', 1, 0, 0, 1, 0, 0, 0, 'PURCHASING', 2020),
(5, '2204', 'Purchasing', 1, 0, 4, 2, 0, 0, 0, '', 2020),
(6, '2205', 'Import Export', 0, 0, 1, 1, 0, 0, 0, 'PURCHASING', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `mpp_juli`
--

CREATE TABLE `mpp_juli` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_juni`
--

CREATE TABLE `mpp_juni` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_karyawan`
--

CREATE TABLE `mpp_karyawan` (
  `nrp` varchar(6) NOT NULL,
  `costcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) DEFAULT NULL,
  `departemen` text DEFAULT NULL,
  `golongan` varchar(5) NOT NULL,
  `pangkat` varchar(10) NOT NULL,
  `statuskaryawan` varchar(20) NOT NULL,
  `tglMsk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mpp_karyawan`
--

INSERT INTO `mpp_karyawan` (`nrp`, `costcenter`, `seksi`, `departemen`, `golongan`, `pangkat`, `statuskaryawan`, `tglMsk`) VALUES
('103', '1205', 'SECURITY', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'B         ', '1999-09-01'),
('107', '6100', 'QUALITY CONTROL 3 - 4W PLANT 2', 'QUALITY CONTROL', '4', 'TETAP     ', 'D         ', '2000-04-01'),
('108', '10', 'QUALITY ASSURANCE', 'QUALITY ASSURANCE', '5', 'TETAP     ', 'C         ', '2000-05-01'),
('109', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('11', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'E         ', '1996-10-21'),
('111', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('112', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('113', '4320', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '2000-07-03'),
('115', '4109', 'DELIVERY CONTROL & WAHO', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('116', '4210', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('118', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('12', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '1996-10-21'),
('120', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('121', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('122', '5104', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2000-07-03'),
('123', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2000-07-03'),
('124', '3101', 'AR & AP', 'FINANCE', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('125', '4316', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('126', '1200', 'GENERAL SERVICES 2', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'A         ', '2000-07-03'),
('127', '4211', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('128', '6102', 'QC2 - MF2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'C         ', '2000-07-03'),
('129', '6204', '4W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'C         ', '2000-07-03'),
('130', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2000-07-03'),
('132', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('133', '6106', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('134', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-03'),
('136', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'C         ', '2000-07-10'),
('137', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('14', '2203', 'PROCUREMENT P2', 'PURCHASING', '3', 'TETAP     ', 'C         ', '1996-10-21'),
('140', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('143', '102', 'EHS OPERATION CONTROL', 'QEHS', '3', 'TETAP     ', 'C         ', '2000-07-10'),
('145', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2000-07-10'),
('146', '4520', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'C         ', '2000-07-10'),
('151', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('152', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('153', '3201', 'GENERAL ACCOUNTING', 'ACCOUNTING & TAX', '3', 'TETAP     ', 'C         ', '2000-07-10'),
('155', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-11'),
('156', '6106', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '3', 'TETAP     ', 'C         ', '2000-07-10'),
('157', '4313', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('16', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '1996-11-25'),
('160', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('164', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('165', '4220', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '2000-07-10'),
('166', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-10'),
('167', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2000-07-17'),
('168', '4324', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-17'),
('169', '2101', 'SALES 4W & OTHERS', 'MARKETING', '3', 'TETAP     ', 'D         ', '2000-07-17'),
('170', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '3', 'TETAP     ', 'B         ', '2000-07-17'),
('172', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('174', '4210', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2000-07-24'),
('175', '5101', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('176', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('177', '6102', 'QC2 - MF2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('178', '2204', 'GENERAL PURCHASING', 'PURCHASING', '3', 'TETAP     ', 'C         ', '2000-07-24'),
('179', '6103', 'QUALITY CONTROL 3 - 4W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'C         ', '2000-07-24'),
('18', '4400', 'WELDING 3', 'PRODUCTION MF4W', '4', 'TETAP     ', 'A         ', '1996-11-25'),
('181', '4315', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('182', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2000-07-24'),
('183', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('185', '6102', 'QUALITY CONTROL 2 - 2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('186', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('187', '4520', 'DISK BRAKE 2', 'PRODUCTION DB', '3', 'TETAP     ', 'D         ', '2000-07-24'),
('19', '4500', 'DISK BRAKE 1', 'PRODUCTION DB', '4', 'TETAP     ', 'B         ', '1996-11-25'),
('190', '4210', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('191', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('192', '6101', 'QUALITY CONTROL 1 - 2W PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-07-24'),
('196', '4317', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-08-07'),
('197', '4410', 'WELDING 4', 'PRODUCTION MF4W', '3', 'TETAP     ', 'B         ', '2000-08-07'),
('198', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-08-07'),
('20', '10', 'PRODUCTION MF4W', 'PRODUCTION MF4W', '5', 'TETAP     ', 'A         ', '1996-11-25'),
('200', '4300', 'WELDING 2', 'PRODUCTION MF2W', '4', 'TETAP     ', 'B         ', '2000-08-07'),
('201', '4317', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-08-07'),
('202', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'C         ', '2000-08-07'),
('204', '4520', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'C         ', '2000-08-07'),
('205', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'E         ', '2000-08-07'),
('207', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-08-14'),
('209', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2000-08-14'),
('21', '100', 'EHS SYSTEM DEVELOPMENT', 'QEHS', '4', 'TETAP     ', 'B         ', '1996-11-25'),
('210', '4316', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-08-14'),
('215', '1202', 'GENERAL SERVICES PLANT 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2000-08-14'),
('217', '4106', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-08-21'),
('218', '4109', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-09-01'),
('219', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-08-21'),
('221', '1203', 'GENERAL SERVICES 3', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2000-09-01'),
('222', '1202', 'GENERAL SERVICES 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2000-09-01'),
('224', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-08-21'),
('228', '5105', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '3', 'TETAP     ', 'F         ', '2000-09-12'),
('229', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '3', 'TETAP     ', 'A         ', '2000-09-18'),
('230', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-09-18'),
('232', '4105', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '3', 'TETAP     ', 'A         ', '2000-10-02'),
('233', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '3', 'TETAP     ', 'C         ', '2000-10-02'),
('235', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2000-10-02'),
('236', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2000-10-02'),
('237', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('239', '4210', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('24', '4310', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '1996-12-02'),
('240', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'D         ', '2000-10-02'),
('241', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('242', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('243', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '3', 'TETAP     ', 'C         ', '2000-10-02'),
('244', '6200', 'DISC BRAKE QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '4', 'TETAP     ', 'A         ', '2000-10-02'),
('245', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('246', '4420', 'WELDING 4', 'PRODUCTION MF4W', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('247', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-10-02'),
('248', '4216', 'WELDING 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'C         ', '2000-10-02'),
('250', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '3', 'TETAP     ', 'C         ', '2000-10-16'),
('251', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2000-10-16'),
('252', '4104', 'MATERIAL PLANNING ', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-10-16'),
('253', '6103', 'QC3 - MF4W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-10-16'),
('254', '6100', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '4', 'TETAP     ', 'B         ', '2000-10-16'),
('255', '3101', 'AR & AP', 'FINANCE', '3', 'TETAP     ', 'B         ', '2000-10-16'),
('256', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2000-10-16'),
('258', '10', 'PPIC & PRODUCTION', '\'', '5', 'TETAP     ', 'C         ', '2000-10-17'),
('259', '100', 'EHS OPERATION CONTROL', 'QEHS', '4', 'TETAP     ', 'E         ', '2000-10-17'),
('260', '10', 'PRODUCTION DB', 'PRODUCTION DB', '5', 'TETAP     ', 'B         ', '2000-11-01'),
('262', '6103', 'QC3 - MF4W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-11-13'),
('264', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-11-13'),
('265', '4310', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-11-13'),
('266', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2000-11-13'),
('267', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2000-11-01'),
('269', '1201', 'GENERAL SERVICES PLANT 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'E         ', '2000-11-20'),
('27', '100', 'INNOVATION CENTER', 'QEHS', '4', 'TETAP     ', 'A         ', '1996-12-02'),
('271', '4313', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2000-11-21'),
('272', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '3', 'TETAP     ', 'B         ', '2000-11-21'),
('273', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2001-01-08'),
('274', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-01-08'),
('275', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2001-01-08'),
('276', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2001-01-08'),
('277', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-01-08'),
('278', '6201', '2W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'C         ', '2001-01-08'),
('279', '6200', '4W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '4', 'TETAP     ', 'A         ', '2001-01-08'),
('28', '1203', 'GENERAL SERVICES 3', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'B         ', '1996-12-05'),
('280', '10', 'GENERAL AFFAIRS', 'GENERAL AFFAIRS', '5', 'TETAP     ', 'A         ', '2001-01-15'),
('289', '10', 'INTERNAL AUDIT & RISK MANAGEMENT', 'INTERNAL AUDIT & RISK MANAGEMENT', '5', 'TETAP     ', 'C         ', '2001-06-25'),
('296', '5200', '-', 'PLANT SERVICE', '4', 'TETAP     ', 'F         ', '2002-01-02'),
('30', '1202', 'GENERAL SERVICES 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'C         ', '1997-01-01'),
('301', '5100', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '4', 'TETAP     ', 'E         ', '2002-01-02'),
('302', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-02-01'),
('303', '3102', 'FUND MANAGEMENT', 'FINANCE', '3', 'TETAP     ', 'B         ', '2001-01-15'),
('306', '4300', 'SPV SHIFT', 'SPV NIGHT SHIFT', '4', 'TETAP     ', 'E         ', '1992-09-01'),
('308', '4211', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('309', '4109', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '3', 'TETAP     ', 'C         ', '2001-03-01'),
('31', '1205', 'SECURITY', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'C         ', '1997-01-01'),
('310', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('311', '1101', 'RECRUITMENT & TRAINING', 'HR', '3', 'TETAP     ', 'B         ', '2001-03-01'),
('312', '4412', 'WELDING 4', 'PRODUCTION MF4W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('313', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('314', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('315', '6106', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2001-03-01'),
('316', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('317', '2201', 'PROCUREMENT P1', 'PURCHASING', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('319', '4314', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('320', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('321', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('323', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-03-01'),
('325', '5203', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2001-03-15'),
('326', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2001-04-02'),
('328', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2001-05-01'),
('329', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-05-01'),
('330', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '3', 'TETAP     ', 'A         ', '2001-05-01'),
('331', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2001-05-01'),
('332', '4200', 'WELDING 1 ', 'PRODUCTION MF2W', '4', 'TETAP     ', 'E         ', '2002-05-01'),
('334', '10', '-', 'Q-EHS COMMITTEE ', '5', 'TETAP     ', 'D         ', '2002-05-01'),
('336', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-06-01'),
('337', '1203', 'GENERAL SERVICES 3', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2001-07-11'),
('338', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '3', 'TETAP     ', 'A         ', '2001-08-01'),
('339', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-08-01'),
('340', '4210', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-09-03'),
('341', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-09-03'),
('342', '6203', 'QC3 - MF4W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-09-03'),
('343', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-09-03'),
('344', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-09-03'),
('345', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-09-03'),
('346', '3203', 'COST INVENTORY', 'ACCOUNTING & TAX', '3', 'TETAP     ', 'C         ', '2001-09-03'),
('347', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('348', '4318', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('349', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('35', '10', 'ACCOUNTING & TAX', 'ACCOUNTING & TAX', '5', 'TETAP     ', 'B         ', '1992-02-01'),
('350', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('351', '6201', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('352', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('353', '4420', 'WELDING 4', 'PRODUCTION MF4W', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('354', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2001-09-05'),
('355', '4216', 'WELDING 1 ', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-09-05'),
('356', '4100', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '4', 'TETAP     ', 'D         ', '2002-09-02'),
('358', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('359', '6203', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'B         ', '2001-10-01'),
('360', '6102', 'QUALITY CONTROL 2 - 2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('361', '4210', 'WELDING 1 ', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '2001-10-01'),
('362', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('365', '6102', 'QC2 - MF2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2001-10-01'),
('366', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('367', '4107', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '3', 'TETAP     ', 'C         ', '2001-10-01'),
('368', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '3', 'TETAP     ', 'D         ', '2001-10-01'),
('369', '4300', 'SPV SHIFT', 'SPV NIGHT SHIFT', '4', 'TETAP     ', 'A         ', '2001-10-01'),
('370', '4420', 'WELDING 3', 'PRODUCTION MF4W', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('371', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2001-10-01'),
('372', '4222', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('374', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'B         ', '2001-10-01'),
('375', '5105', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '3', 'TETAP     ', 'B         ', '2001-10-01'),
('376', '4213', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-10-01'),
('381', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-10-10'),
('383', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2001-10-10'),
('384', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-10-10'),
('385', '1202', 'GENERAL SERVICES PLANT 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2001-10-24'),
('386', '1203', 'GENERAL SERVICES 3', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2001-11-07'),
('387', '4105', 'DELIVERY CONTROL & WAHO', 'PPIC', '3', 'TETAP     ', 'E         ', '2001-11-12'),
('388', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-11-12'),
('389', '6103', 'QC3 - MF4W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2001-11-12'),
('39', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '3', 'TETAP     ', 'D         ', '1997-04-01'),
('390', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('391', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('392', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-11-12'),
('393', '1205', 'SECURITY', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'B         ', '2001-11-12'),
('394', '4320', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '2001-11-12'),
('395', '4210', 'WELDING 1 ', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('397', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('398', '5101', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2001-11-12'),
('399', '4420', 'WELDING 3', 'PRODUCTION MF4W', '3', 'TETAP     ', 'C         ', '2001-11-12'),
('400', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('401', '3101', 'AR & AP', 'FINANCE', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('402', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '2001-11-12'),
('403', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('404', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('405', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2001-11-12'),
('406', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '3', 'TETAP     ', 'D         ', '2002-01-02'),
('407', '4410', 'WELDING 4', 'PRODUCTION MF4W', '3', 'TETAP     ', 'A         ', '2002-01-02'),
('408', '10', 'PPIC', 'PPIC', '5', 'TETAP     ', 'A         ', '2003-01-06'),
('409', '1103', 'IR & WELFARE', 'HR', '4', 'TETAP     ', 'A         ', '2002-02-01'),
('41', '4107', 'DELIVERY CONTROL & WAHO', 'PPIC', '3', 'TETAP     ', 'C         ', '1997-04-01'),
('410', '2200', 'PROCUREMENT P1', 'PURCHASING', '4', 'TETAP     ', 'E         ', '2003-05-01'),
('412', '10', 'ENGINEERING', 'ENGINEERING', '5', 'TETAP     ', 'A         ', '2003-05-01'),
('413', '4200', 'SPV SHIFT', 'SPV NIGHT SHIFT', '4', 'TETAP     ', 'E         ', '2003-06-02'),
('414', '5100', 'ENGINEERING', 'ENGINEERING', '4', 'TETAP     ', 'E         ', '2003-06-02'),
('415', '10', 'PLANT SERVICE', 'PLANT SERVICE', '5', 'TETAP     ', 'B         ', '2003-07-01'),
('418', '10', 'MARKETING & PURCHASING', 'MARKETING PURCHASING', '5', 'TETAP     ', 'C         ', '2003-09-01'),
('419', '10', 'HR', 'HRD', '5', 'TETAP     ', 'A         ', '2003-09-01'),
('421', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2002-02-01'),
('422', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-02-01'),
('423', '4310', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-02-01'),
('424', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2002-02-01'),
('425', '4320', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-03-22'),
('426', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-03-22'),
('427', '6102', 'QUALITY CONTROL 2 - 2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-03-22'),
('428', '4521', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'A         ', '2002-04-08'),
('429', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2002-04-08'),
('431', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-04-08'),
('432', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-04-08'),
('433', '4210', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '2002-04-12'),
('434', '4312', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-04-12'),
('435', '6102', 'QC2 - MF2W PLANT 2', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-04-12'),
('436', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2002-04-12'),
('438', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '2', 'TETAP     ', 'E         ', '2002-04-29'),
('44', '2200', 'OFFICE SUPPORT PURCHASING', 'PURCHASING', '4', 'TETAP     ', 'A         ', '1997-04-07'),
('440', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-05-01'),
('443', '10', 'PRODUCTION MF2W', 'PRODUCTION MF2W', '5', 'TETAP     ', 'B         ', '2004-05-04'),
('445', '4518', 'DISK BRAKE 2', 'PRODUCTION DB', '3', 'TETAP     ', 'A         ', '2002-06-01'),
('447', '4315', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-06-01'),
('449', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-06-01'),
('45', '4200', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '4', 'TETAP     ', 'A         ', '1997-04-07'),
('450', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-07-01'),
('452', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'A         ', '2002-07-01'),
('453', '2201', 'PROCUREMENT P1', 'PURCHASING', '3', 'TETAP     ', 'A         ', '2002-07-01'),
('455', '4211', 'WELDING 1', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-07-01'),
('456', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '2002-07-01'),
('457', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2002-08-01'),
('458', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '2', 'TETAP     ', 'F         ', '2002-08-01'),
('459', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'F         ', '2002-08-01'),
('461', '4410', 'WELDING 4', 'PRODUCTION MF4W', '2', 'TETAP     ', 'F         ', '2002-08-19'),
('462', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'A         ', '2002-08-19'),
('463', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2002-08-19'),
('464', '2102', 'SALES 4W & OTHERS', 'MARKETING', '3', 'TETAP     ', 'B         ', '2002-08-19'),
('465', '6102', 'QC2 - MF2W PLANT 2', 'QUALITY CONTROL', '2', 'TETAP     ', 'F         ', '2002-08-19'),
('466', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '2', 'TETAP     ', 'F         ', '2002-09-02'),
('467', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'F         ', '2002-09-02'),
('468', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'F         ', '2002-09-02'),
('469', '1203', 'GENERAL SERVICES PLANT 1', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2002-09-03'),
('470', '3201', 'GENERAL ACCOUNTING', 'ACCOUNTING & TAX', '2', 'TETAP     ', 'D         ', '2002-09-03'),
('471', '4420', 'WELDING 4', 'PRODUCTION MF4W', '2', 'TETAP     ', 'F         ', '2002-09-16'),
('472', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '2', 'TETAP     ', 'F         ', '2002-09-16'),
('473', '4310', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2002-09-16'),
('474', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2002-09-16'),
('475', '4410', 'WELDING 4', 'PRODUCTION MF4W', '2', 'TETAP     ', 'F         ', '2002-10-01'),
('478', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2002-11-01'),
('479', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2002-11-01'),
('48', '102', 'EHS OPERATION CONTROL', 'QEHS', '3', 'TETAP     ', 'E         ', '1997-05-01'),
('480', '4310', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2002-11-01'),
('481', '4320', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'A         ', '2002-11-01'),
('482', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '2', 'TETAP     ', 'F         ', '2002-11-01'),
('483', '6102', 'QC2 - MF2W PLANT 2', 'QUALITY CONTROL', '2', 'TETAP     ', 'F         ', '2003-01-06'),
('484', '10', 'WELDING 4', 'PRODUCTION MF4W', '4', 'TETAP     ', 'E         ', '2005-01-01'),
('485', '6106', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '2', 'TETAP     ', 'F         ', '2003-01-13'),
('486', '4316', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2003-03-04'),
('487', '1203', 'GENERAL SERVICES PLANT 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2003-03-10'),
('488', '10', 'ENGINEERING & PLANT SERVICE', 'ENGINEERING PLANT SERVICE', '5', 'TETAP     ', 'C         ', '2005-04-01'),
('49', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '3', 'TETAP     ', 'A         ', '1997-05-01'),
('492', '10', 'QUALITY CONTROL', 'QUALITY CONTROL', '5', 'TETAP     ', 'A         ', '2005-05-01'),
('495', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '2', 'TETAP     ', 'F         ', '2003-07-01'),
('496', '3102', 'FUND', 'FINANCE DEPARTMENT', '2', 'TETAP     ', 'F         ', '2003-07-01'),
('497', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '2', 'TETAP     ', 'F         ', '2003-07-01'),
('498', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2003-07-01'),
('499', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'F         ', '2003-07-01'),
('50', '6100', 'QUALITY CONTROL 1 - 2W PLANT 1', 'QUALITY CONTROL', '4', 'TETAP     ', 'A         ', '1997-06-01'),
('501', '4410', 'WELDING 3', 'PRODUCTION MF4W', '3', 'TETAP     ', 'A         ', '2003-07-01'),
('502', '10', 'QUALITY SYSTEM & FACILITIES', 'QUALITY SYSTEM & FACILITIES', '5', 'TETAP     ', 'A         ', '2005-09-01'),
('503', '200', 'RISK MANAGEMENT', 'INTERNAL AUDIT & RISK MANAGEMENT', '4', 'TETAP     ', 'E         ', '2005-10-01'),
('510', '4103', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '2', 'TETAP     ', 'D         ', '2004-06-01'),
('514', '10', '\"HR', ' GA', '\"', '\"HR', ' GA\"', '0000-00-00'),
('519', '4500', 'DISK BRAKE 2', 'PRODUCTION DB', '4', 'TETAP     ', 'E         ', '2007-02-15'),
('52', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '3', 'TETAP     ', 'A         ', '1997-07-01'),
('520', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '2', 'TETAP     ', 'C         ', '2005-03-01'),
('523', '5101', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '3', 'TETAP     ', 'F         ', '2005-10-01'),
('524', '2200', 'PROCUREMENT NEW MODEL', 'PURCHASING', '4', 'TETAP     ', 'A         ', '2006-10-01'),
('534', '103', 'INNOVATION CENTER', 'QEHS', '2', 'TETAP     ', 'F         ', '2007-02-01'),
('537', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'C         ', '2005-09-01'),
('538', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '2', 'TETAP     ', 'D         ', '2005-09-01'),
('539', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '2', 'TETAP     ', 'C         ', '2006-10-01'),
('540', '4318', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'B         ', '2006-10-01'),
('541', '6102', 'QUALITY CONTROL 2 - 2W PLANT 2', 'QUALITY CONTROL', '2', 'TETAP     ', 'C         ', '2006-10-01'),
('542', '4420', 'WELDING 4', 'PRODUCTION MF4W', '2', 'TETAP     ', 'D         ', '2006-10-01'),
('544', '5101', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '4', 'TETAP     ', 'A         ', '2007-10-01'),
('548', '3200', 'COST INVENTORY', 'ACCOUNTING & TAX', '4', 'TETAP     ', 'B         ', '2007-12-01'),
('55', '1100', 'REMUNERATION & PERSONNEL ADMIN', 'HRD', '4', 'TETAP     ', 'B         ', '1997-07-07'),
('551', '5200', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '4', 'TETAP     ', 'D         ', '2008-03-24'),
('552', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'C         ', '2006-04-01'),
('553', '1204', 'LEGAL & CSR', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'D         ', '2007-04-01'),
('554', '2204', 'GENERAL PURCHASING', 'PURCHASING', '2', 'TETAP     ', 'D         ', '2006-03-08'),
('557', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'C         ', '2006-05-01'),
('558', '1200', 'SECRETARY BOD & EXPAT', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'E         ', '2008-06-01'),
('559', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '2', 'TETAP     ', 'E         ', '2006-07-01'),
('562', '2200', 'PURCHASING', 'PURCHASING', '4', 'TETAP     ', 'F         ', '2008-08-11'),
('563', '4210', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'B         ', '2006-09-01'),
('564', '4109', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '2', 'TETAP     ', 'C         ', '2007-09-01'),
('566', '3100', 'FUND', 'FINANCE DEPARTMENT', '4', 'TETAP     ', 'D         ', '2008-10-13'),
('567', '5200', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '4', 'TETAP     ', 'A         ', '2008-10-13'),
('568', '5200', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '4', 'TETAP     ', 'B         ', '2008-10-13'),
('569', '2100', 'SALES 4W & OTHERS', 'MARKETING', '4', 'TETAP     ', 'D         ', '2008-11-05'),
('57', '4520', 'DISK BRAKE 2', 'PRODUCTION DB', '3', 'TETAP     ', 'C         ', '1997-08-01'),
('572', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '2', 'TETAP     ', 'C         ', '2007-06-01'),
('573', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'B         ', '2007-06-01'),
('574', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '2', 'TETAP     ', 'B         ', '2008-10-09'),
('576', '5100', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '4', 'TETAP     ', 'D         ', '2009-12-01'),
('579', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '2', 'TETAP     ', 'B         ', '2008-04-01'),
('58', '6100', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '4', 'TETAP     ', 'A         ', '1997-08-01'),
('582', '4311', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'B         ', '2009-06-01'),
('583', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'B         ', '2009-08-01'),
('585', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '3', 'TETAP     ', 'D         ', '2010-08-01'),
('586', '2100', 'SALES 2W', 'MARKETING', '4', 'TETAP     ', 'C         ', '2010-08-16'),
('587', '5105', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '2', 'TETAP     ', 'B         ', '2009-06-01'),
('589', '2102', 'SALES 4W & OTHERS', 'MARKETING', '2', 'TETAP     ', 'B         ', '2008-10-09'),
('59', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '3', 'TETAP     ', 'C         ', '1997-08-01'),
('590', '5104', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2010-11-01'),
('591', '2204', 'PRODUCTION SUPPORT PURCHASING', 'PURCHASING', '2', 'TETAP     ', 'B         ', '2009-12-01'),
('594', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '4', 'TETAP     ', 'C         ', '2011-02-01'),
('595', '2205', 'IMPORT EXPORT', 'PURCHASING', '2', 'TETAP     ', 'A         ', '2009-03-01'),
('596', '4105', 'DELIVERY CONTROL & WAHO', 'PPIC', '2', 'TETAP     ', 'B         ', '2009-04-01'),
('597', '4102', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '2', 'TETAP     ', 'B         ', '2009-07-01'),
('598', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'B         ', '2009-07-01'),
('601', '6203', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '2', 'TETAP     ', 'B         ', '2009-05-01'),
('602', '5100', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '4', 'TETAP     ', 'D         ', '2011-05-01'),
('603', '2200', 'PRODUCTION SUPPORT PURCHASING', 'PURCHASING', '4', 'TETAP     ', 'C         ', '2011-05-09'),
('604', '5100', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '4', 'TETAP     ', 'C         ', '2011-05-09'),
('605', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2009-07-01'),
('607', '1203', 'GENERAL SERVICES 3', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'B         ', '2009-08-01'),
('608', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2009-08-01'),
('609', '1300', 'APPLICATION SYSTEM', 'INFORMATION TECHNOLOGY', '4', 'TETAP     ', 'C         ', '2011-08-01'),
('61', '4410', 'WELDING 4', 'PRODUCTION MF4W', '3', 'TETAP     ', 'C         ', '1997-08-01'),
('610', '4410', 'WELDING 4', 'PRODUCTION MF4W', '2', 'TETAP     ', 'A         ', '2010-03-01'),
('611', '6106', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '2', 'TETAP     ', 'B         ', '2009-09-01'),
('612', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2009-10-01'),
('615', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2011-10-01'),
('616', '4314', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'C         ', '2009-11-01'),
('617', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'D         ', '2011-10-11'),
('619', '5105', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2011-10-11'),
('621', '6200', 'SUPPLIER QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '4', 'TETAP     ', 'C         ', '2011-11-01'),
('625', '4222', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-03-01'),
('627', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-03-01'),
('628', '4521', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-04-01'),
('629', '4104', 'MATERIAL PLANNING ', 'PPIC', '4', 'TETAP     ', 'C         ', '2012-04-16'),
('63', '6203', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'C         ', '1997-08-01'),
('631', '4521', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-05-01'),
('635', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2010-06-01'),
('636', '4410', 'WELDING 3', 'PRODUCTION MF4W', '2', 'TETAP     ', 'B         ', '2010-10-01'),
('637', '1202', 'GENERAL SERVICES 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2010-07-01'),
('638', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2010-07-01'),
('639', '4316', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'B         ', '2010-10-01'),
('640', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-10-01'),
('641', '4410', 'WELDING 3', 'PRODUCTION MF4W', '2', 'TETAP     ', 'B         ', '2010-10-01'),
('642', '4420', 'WELDING 3', 'PRODUCTION MF4W', '2', 'TETAP     ', 'B         ', '2011-07-01'),
('643', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-07-01'),
('644', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2010-08-01'),
('645', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2011-08-01'),
('646', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2010-08-01'),
('647', '3202', 'ASSETS & TAX', 'ACCOUNTING & TAX', '2', 'TETAP     ', 'A         ', '2011-08-01'),
('648', '4318', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-08-16'),
('649', '4317', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-08-16'),
('650', '4310', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-08-16'),
('651', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-09-01'),
('652', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-09-01'),
('655', '3300', 'BUDGET', 'FINANCIAL PLANNING', '4', 'TETAP     ', 'A         ', '2012-09-01'),
('656', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2012-09-01'),
('657', '6203', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '2', 'TETAP     ', 'B         ', '2010-10-01'),
('658', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-10-01'),
('659', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2010-10-01'),
('66', '4210', 'WELDING 1 ', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '1997-08-12'),
('660', '6103', 'QUALITY CONTROL 3 - 4W PLANT 2', 'QUALITY CONTROL', '2', 'TETAP     ', 'B         ', '2010-10-01'),
('661', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '2', 'TETAP     ', 'A         ', '2010-10-01'),
('662', '4310', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-10-01'),
('663', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '2012-10-08'),
('664', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'D         ', '2012-10-08'),
('665', '6204', '2W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'D         ', '2012-10-16'),
('667', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-11-01'),
('668', '4325', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-11-01'),
('669', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '2', 'TETAP     ', 'A         ', '2010-11-01'),
('67', '1200', 'GENERAL SERVICES 3', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'B         ', '1997-08-12'),
('670', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-11-01'),
('671', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2011-11-01'),
('672', '1100', 'PEOPLE DEVELOPMENT ', 'HR', '4', 'TETAP     ', 'C         ', '2012-11-02'),
('674', '1201', 'GENERAL SERVICES 1', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('675', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('676', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('677', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('678', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('679', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('68', '6201', '2W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'D         ', '1997-08-12'),
('680', '2204', 'GENERAL PURCHASING', 'PURCHASING', '2', 'TETAP     ', 'A         ', '2010-12-01'),
('681', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2011-01-01'),
('682', '4410', 'WELDING 4', 'PRODUCTION MF4W', '2', 'TETAP     ', 'A         ', '2011-01-01'),
('683', '4211', 'WELDING 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2011-01-01'),
('684', '4211', 'WELDING 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2011-01-01'),
('685', '6103', 'QC3 - MF4W PLANT 2', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2011-02-01'),
('686', '4318', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2012-02-15'),
('687', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2012-02-15'),
('689', '4316', 'WELDING 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2011-03-01'),
('69', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '4', 'TETAP     ', 'B         ', '1997-08-12'),
('690', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2011-03-01'),
('693', '2200', 'PROCUREMENT NEW MODEL', 'PURCHASING', '4', 'TETAP     ', 'C         ', '2013-03-01'),
('695', '4100', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '4', 'TETAP     ', 'B         ', '2013-03-01'),
('696', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '2', 'TETAP     ', 'A         ', '2011-04-01'),
('697', '2101', 'SALES 2W', 'MARKETING', '2', 'TETAP     ', 'A         ', '2011-04-01'),
('698', '4220', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '2', 'TETAP     ', 'A         ', '2012-04-01'),
('699', '5100', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '4', 'TETAP     ', 'D         ', '2009-07-06'),
('7', '2204', 'PRODUCTION SUPPORT PURCHASING', 'PURCHASING', '3', 'TETAP     ', 'D         ', '1996-09-23'),
('70', '4320', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'D         ', '1997-08-12'),
('701', '1301', 'IT', 'INFORMATION TECHNOLOGY', '3', 'TETAP     ', 'E         ', '2013-04-01'),
('702', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('703', '5104', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('704', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('705', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('706', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('708', '5102', 'PROCESS ENGINEERING 1 - MF2W 1', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('710', '5104', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2013-04-01'),
('712', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '2', 'TETAP     ', 'A         ', '2011-05-01'),
('713', '5105', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '2', 'TETAP     ', 'A         ', '2011-05-01'),
('714', '1202', 'GENERAL SERVICES PLANT 2', 'GENERAL AFFAIRS', '2', 'TETAP     ', 'A         ', '2011-05-01'),
('716', '0', 'BOARD OF DIRECTOR', 'BOARD OF DIRECTOR', '6', 'TETAP     ', 'A         ', '1987-07-01'),
('717', '1301', 'IT', 'INFORMATION TECHNOLOGY', '2', 'TETAP     ', 'A         ', '2011-06-01'),
('718', '2202', 'PROCUREMENT P2', 'PURCHASING', '2', 'TETAP     ', 'A         ', '2011-06-01'),
('720', '2204', 'GENERAL PURCHASING', 'PURCHASING', '2', 'TETAP     ', 'A         ', '2011-06-01'),
('724', '4521', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'TETAP     ', 'F         ', '2011-09-01'),
('725', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'TETAP     ', 'F         ', '2011-09-01'),
('728', '6203', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'C         ', '2013-10-07'),
('729', '5104', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2013-10-07'),
('73', '4520', 'DISK BRAKE 2', 'PRODUCTION DB', '3', 'TETAP     ', 'D         ', '1997-08-12'),
('731', '6100', 'QUALITY CONTROL 2 - 2W PLANT 2', 'QUALITY CONTROL', '4', 'TETAP     ', 'B         ', '2013-11-07'),
('732', '4300', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '4', 'TETAP     ', 'B         ', '2013-12-02'),
('733', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'C         ', '2013-12-01'),
('735', '3300', 'BUDGET', 'FINANCIAL PLANNING', '3', 'TETAP     ', 'C         ', '2013-12-02'),
('736', '2200', 'PROCUREMENT P2', 'PURCHASING', '4', 'TETAP     ', 'B         ', '2013-12-02'),
('737', '4100', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '4', 'TETAP     ', 'B         ', '2013-12-02'),
('738', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'TETAP     ', 'F         ', '2013-04-01'),
('739', '6102', 'QUALITY CONTROL 2 - 2W PLANT 2', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2013-04-01'),
('74', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'E         ', '1997-08-12'),
('740', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'TETAP     ', 'F         ', '2013-04-01'),
('742', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '2', 'TETAP     ', 'A         ', '2012-02-01'),
('743', '4323', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'TETAP     ', 'F         ', '2012-02-01'),
('747', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2012-03-12'),
('748', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2012-04-16'),
('749', '102', 'EHS OPERATION CONTROL', 'QEHS', '3', 'TETAP     ', 'C         ', '2014-03-12'),
('750', '5101', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2014-04-01'),
('751', '6200', 'QUALITY ASSURANCE', 'QUALITY ASSURANCE', '4', 'TETAP     ', 'C         ', '2014-04-15'),
('752', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2012-04-16'),
('755', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2012-06-01'),
('756', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2012-06-01'),
('757', '6203', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '3', 'TETAP     ', 'C         ', '2014-06-02');
INSERT INTO `mpp_karyawan` (`nrp`, `costcenter`, `seksi`, `departemen`, `golongan`, `pangkat`, `statuskaryawan`, `tglMsk`) VALUES
('759', '200', 'INTERNAL AUDIT', 'INTERNAL AUDIT & RISK MANAGEMENT', '4', 'TETAP     ', 'B         ', '2014-07-01'),
('76', '5202', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '3', 'TETAP     ', 'E         ', '1997-08-12'),
('763', '2200', 'GENERAL PURCHASING', 'PURCHASING', '4', 'TETAP     ', 'B         ', '2014-09-04'),
('764', '101', 'EHS SYSTEM DEVELOPMENT', 'QEHS', '4', 'TETAP     ', 'B         ', '2014-09-04'),
('767', '4410', 'WELDING 4', 'PRODUCTION MF4W', '1', 'TETAP     ', 'F         ', '2012-09-14'),
('768', '5104', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2014-10-01'),
('769', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '3', 'TETAP     ', 'C         ', '2014-10-01'),
('770', '2101', 'SALES 2W', 'MARKETING', '4', 'TETAP     ', 'B         ', '2014-10-01'),
('771', '5103', 'PROCESS ENGINEERING 2 - MF2W 2', 'ENGINEERING', '4', 'TETAP     ', 'B         ', '2014-10-01'),
('772', '5100', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '4', 'TETAP     ', 'B         ', '2014-10-01'),
('774', '4106', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'TETAP     ', 'F         ', '2012-11-01'),
('776', '4420', 'WELDING 3', 'PRODUCTION MF4W', '1', 'TETAP     ', 'F         ', '2012-12-01'),
('777', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'TETAP     ', 'F         ', '2012-12-01'),
('778', '2202', 'PROCUREMENT P2', 'PURCHASING', '1', 'TETAP     ', 'F         ', '2012-12-01'),
('779', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'TETAP     ', 'F         ', '2012-12-01'),
('780', '4410', 'WELDING 4', 'PRODUCTION MF4W', '1', 'TETAP     ', 'F         ', '2013-03-06'),
('781', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'TETAP     ', 'F         ', '2013-01-01'),
('782', '4109', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'TETAP     ', 'F         ', '2013-01-14'),
('783', '4104', 'MATERIAL PLANNING ', 'PPIC', '1', 'TETAP     ', 'F         ', '2013-01-14'),
('784', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2012-12-10'),
('786', '6100', 'QUALITY ASSURANCE', 'QUALITY ASSURANCE', '4', 'TETAP     ', 'A         ', '2015-01-05'),
('787', '2201', 'PROCUREMENT P1', 'PURCHASING', '1', 'TETAP     ', 'F         ', '2013-02-01'),
('788', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'TETAP     ', 'F         ', '2013-02-01'),
('789', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'TETAP     ', 'F         ', '2013-03-01'),
('790', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '1', 'TETAP     ', 'F         ', '2013-03-01'),
('791', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'TETAP     ', 'F         ', '2013-03-06'),
('792', '1200', 'LEGAL & CSR', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'C         ', '2015-03-09'),
('794', '1102', 'REMUNERATION & PERSONNEL ADMIN', 'HRD', '1', 'TETAP     ', 'F         ', '2013-10-01'),
('796', '6105', 'FINAL QUALITY CONTROL', 'QUALITY CONTROL', '1', 'TETAP     ', 'F         ', '2013-10-01'),
('797', '101', 'EHS SYSTEM DEVELOPMENT', 'QEHS', '1', 'TETAP     ', 'F         ', '2014-02-01'),
('799', '5100', 'PROCESS ENGINEERING 4 - MF4W', 'ENGINEERING', '4', 'TETAP     ', 'A         ', '2015-09-01'),
('8', '1103', 'IR & WELFARE', 'HR', '4', 'TETAP     ', 'B         ', '1996-10-01'),
('80', '6101', 'QC1 - PLANT 1', 'QUALITY CONTROL', '3', 'TETAP     ', 'D         ', '1997-08-12'),
('800', '6200', '2W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '4', 'TETAP     ', 'B         ', '2015-09-07'),
('803', '1200', 'SECRETARY BOD & EXPAT', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'A         ', '2015-10-01'),
('804', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '1', 'TETAP     ', 'E         ', '2013-11-01'),
('805', '2100', 'SALES 2W', 'MARKETING', '4', 'TETAP     ', 'B         ', '2015-11-02'),
('806', '202', 'INTERNAL CONTROL', 'INTERNAL CONTROL & RISK MANAGEMENT', '3', 'TETAP     ', 'C         ', '2015-11-09'),
('807', '20', '\"ADVISOR', ' DIVISION HEAD & MANAGER\"', '\"ADVI', ' DIVISION ', '5', '0000-00-00'),
('808', '2202', 'PROCUREMENT P2', 'PURCHASING', '1', 'TETAP     ', 'E         ', '2013-12-01'),
('809', '4109', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'TETAP     ', 'F         ', '2014-01-01'),
('810', '4100', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '4', 'TETAP     ', 'B         ', '2015-12-10'),
('811', '5100', 'PROTOTYPE & PRODUCT ENGINEERING', 'ENGINEERING', '4', 'TETAP     ', 'A         ', '2015-12-10'),
('812', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'TETAP     ', 'F         ', '2014-02-01'),
('815', '4426', 'WELDING 3', 'PRODUCTION MF4W', '1', 'TETAP     ', 'F         ', '2014-06-01'),
('818', '3200', 'GENERAL ACCOUNTING', 'ACCOUNTING & TAX', '4', 'TETAP     ', 'B         ', '2016-04-12'),
('819', '6200', 'QUALITY FACILITIES', 'QUALITY SYSTEM & FACILITIES', '4', 'TETAP     ', 'B         ', '2016-04-12'),
('82', '6100', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '4', 'TETAP     ', 'A         ', '1997-08-12'),
('820', '4109', 'MATERIAL PLANNING ', 'PPIC', '1', 'TETAP     ', 'F         ', '2014-06-12'),
('821', '0', 'BOARD OF DIRECTOR', 'BOARD OF DIRECTOR', '6', 'TETAP     ', 'A         ', '1990-03-01'),
('822', '4410', 'WELDING 4', 'PRODUCTION MF4W', '1', 'TETAP     ', 'F         ', '2014-06-01'),
('823', '5100', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '4', 'TETAP     ', 'A         ', '2016-06-02'),
('824', '2202', 'IMPORT EXPORT', 'PURCHASING', '3', 'TETAP     ', 'B         ', '2016-06-17'),
('826', '1204', 'LEGAL & CSR', 'GENERAL AFFAIRS', '1', 'TETAP     ', 'E         ', '2014-07-01'),
('827', '20', '\"ADVISOR', ' DIVISION HEAD & MANAGER\"', '\"ADVI', ' DIVISION ', '5', '0000-00-00'),
('8278', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-03-01'),
('828', '4107', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'TETAP     ', 'E         ', '2014-11-01'),
('8280', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-03-01'),
('8282', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-03-01'),
('8284', '1103', 'IR & WELFARE', 'HRD', '1', 'KONTRAK2  ', 'E         ', '2018-03-01'),
('8285', '4413', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-03-01'),
('8288', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-03-01'),
('829', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'TETAP     ', 'E         ', '2014-11-01'),
('8294', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-03-26'),
('83', '4317', 'WELDING 2', 'PRODUCTION MF2W', '3', 'TETAP     ', 'C         ', '1997-08-12'),
('830', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'TETAP     ', 'E         ', '2014-11-01'),
('8302', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-03-26'),
('8304', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-03-26'),
('8306', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-03-26'),
('8307', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-03-26'),
('8309', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-04-02'),
('831', '3100', 'AR & AP', 'FINANCE', '4', 'TETAP     ', 'B         ', '2016-11-04'),
('8311', '3101', 'AR & AP', 'FINANCE', '1', 'KONTRAK2  ', 'E         ', '2018-04-02'),
('8312', '2203', 'PROCUREMENT NEW MODEL', 'PURCHASING', '1', 'KONTRAK2  ', 'E         ', '2018-04-02'),
('8314', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-04-02'),
('8315', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-04-02'),
('8316', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-04-02'),
('8321', '4410', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-04-16'),
('8324', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-04-16'),
('8328', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-04-16'),
('8330', '4513', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-04-16'),
('8332', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-04-16'),
('8333', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-04-16'),
('8335', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8337', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8338', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8339', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('834', '2200', 'PROCUREMENT NEW MODEL', 'PURCHASING', '4', 'TETAP     ', 'A         ', '2016-11-14'),
('8341', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8342', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8344', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8345', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8349', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('835', '6200', '4W QUALITY SYSTEM', 'QUALITY SYSTEM & FACILITIES', '4', 'TETAP     ', 'A         ', '2016-11-14'),
('8350', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8351', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8353', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8354', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8355', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8356', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8357', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8358', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8359', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('836', '1205', 'SECURITY', 'GENERAL AFFAIRS', '1', 'TETAP     ', 'E         ', '2015-01-05'),
('8361', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8362', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8363', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8364', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-03'),
('8368', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-07'),
('8369', '3101', 'AR & AP', 'FINANCE', '3', 'KONTRAK2  ', 'B         ', '2018-05-11'),
('8370', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8371', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8372', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8374', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8375', '4522', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8376', '4422', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8377', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8379', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8380', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8381', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8383', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8386', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8387', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8388', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8389', '4513', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('839', '2100', 'SALES 4W & OTHERS', 'MARKETING', '4', 'TETAP     ', 'A         ', '2017-03-01'),
('8390', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8393', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8395', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-16'),
('8396', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-21'),
('8398', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-21'),
('84', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '3', 'TETAP     ', 'B         ', '1997-08-12'),
('8400', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-05-21'),
('8401', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-21'),
('8402', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-05-21'),
('8403', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8405', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8406', '5201', 'FACILITY PROVIDER 1', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8407', '4107', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8408', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8410', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8411', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8412', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-06-04'),
('8414', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-06-22'),
('8416', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-06-22'),
('8417', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-06-22'),
('8418', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-06-22'),
('842', '2202', 'PROCUREMENT P2', 'PURCHASING', '1', 'TETAP     ', 'E         ', '2015-04-06'),
('8420', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-06-22'),
('8423', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8424', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8425', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8427', '4107', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8428', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8429', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8430', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8431', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8432', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8433', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8434', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8435', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8436', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8437', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8439', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8440', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8441', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8442', '5203', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8443', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8444', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8445', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8446', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8447', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8448', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('845', '2205', 'IMPORT EXPORT', 'PURCHASING', '3', 'TETAP     ', 'B         ', '2017-10-02'),
('8451', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8452', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8453', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8454', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8455', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8456', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8457', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('846', '1100', 'RECRUITMENT & TRAINING', 'HR', '4', 'TETAP     ', 'A         ', '2017-10-02'),
('8460', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8461', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8462', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8463', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-02'),
('8464', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8465', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8466', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8467', '4216', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8468', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8469', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('847', '20', 'PRODUCTION MF4W', '\"ADVISOR', ' DIVI', '5', 'TETAP               ', '0000-00-00'),
('8471', '4521', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8472', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8473', '1202', 'GENERAL SERVICES 2', 'GENERAL AFFAIRS', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8474', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8475', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8476', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8477', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2018-07-16'),
('8478', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8479', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('848', '3200', 'ASSETS & TAX', 'ACCOUNTING & TAX', '4', 'TETAP     ', 'B         ', '2014-01-01'),
('8480', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8481', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8482', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8484', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8486', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8487', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8488', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8489', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8490', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8491', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8492', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8493', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8494', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8495', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8496', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8497', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8498', '4524', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8499', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('850', '4103', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'TETAP     ', 'E         ', '2015-12-01'),
('8500', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-07-16'),
('8501', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8502', '4109', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8503', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8504', '4520', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8505', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8506', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8507', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8508', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('851', '6104', 'CUSTOMER QUALITY AFFAIR', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '2018-01-04'),
('8510', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8511', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8512', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8513', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8514', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8515', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8516', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-08-01'),
('8517', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8518', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8519', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('852', '0', 'NULL', 'BOARD OF DIRECTOR', '6', 'TETAP     ', 'A         ', '2018-04-16'),
('8520', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8521', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8522', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8523', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8524', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8525', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8526', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8527', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8529', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8530', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8531', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8532', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-06'),
('8533', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8534', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8535', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8539', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('854', '1103', 'IR & WELFARE', 'HR', '4', 'TETAP     ', 'A         ', '2018-07-16'),
('8540', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8541', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8543', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8544', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8545', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8546', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8547', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8548', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8549', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('855', '20', 'PRODUCTION MF4W', 'PRODUCTION MF4W', '5', 'TETAP     ', 'A         ', '2018-10-17'),
('8550', '4422', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8552', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8554', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8556', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8558', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8559', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8560', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8561', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8562', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-08-16'),
('8563', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8564', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8565', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8566', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8567', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8568', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8569', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('857', '20', 'ENGINEERING', 'ENGINEERING', '5', 'TETAP     ', 'A         ', '2019-05-02'),
('8570', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-09-03'),
('8573', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-09-10'),
('8575', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-10'),
('8576', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8577', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8578', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8579', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('858', '20', 'ENGINEERING', 'ENGINEERING', '5', 'TETAP     ', 'A         ', '2019-04-14'),
('8581', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8582', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8583', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8587', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8588', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8589', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('859', '20', 'ENGINEERING', 'ENGINEERING', '5', 'TETAP     ', 'A         ', '2019-04-14'),
('8590', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8591', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8592', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8593', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8594', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8595', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8596', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('8599', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-17'),
('860', '3202', 'ASSETS & TAX', 'ACCOUNTING & TAX', '3', 'TETAP     ', 'B         ', '2019-04-04'),
('8600', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-09-19'),
('8601', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-09-19'),
('8602', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-09-19'),
('8603', '4212', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-19'),
('8604', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-19'),
('8606', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-09-19'),
('8607', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-01'),
('8608', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-01'),
('8610', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8612', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8613', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8614', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8615', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8616', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8618', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8619', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8622', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8623', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8625', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8626', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8627', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8628', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8629', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('863', '1200', '-', 'GENERAL AFFAIRS', '4', 'MANAGEMENT', 'A         ', '2019-09-02'),
('8630', '4101', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8631', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8632', '4108', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8633', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8634', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8635', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8637', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8638', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8639', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('864', '1200', '-', 'GENERAL AFFAIRS', '4', 'MANAGEMENT', 'A         ', '2019-10-01'),
('8640', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-16'),
('8641', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-22'),
('8642', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-22'),
('8644', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-22'),
('8645', '4222', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-22'),
('8646', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-22'),
('8647', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-10-22'),
('8648', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-01'),
('8649', '1202', 'GENERAL SERVICES 2', 'GENERAL AFFAIRS', '1', 'KONTRAK2  ', 'E         ', '2018-11-01'),
('865', '3202', 'ASSETS & TAX', 'ACCOUNTING & TAX', '1', 'TETAP     ', 'E         ', '2017-11-01'),
('8652', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8653', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8654', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8655', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8657', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8658', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8659', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('866', '1300', 'APPLICATION SYSTEM', 'INFORMATION TECHNOLOGY', '4', 'MANAGEMENT', 'A         ', '2019-12-02'),
('8660', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8661', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8662', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8663', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8664', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8665', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8667', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8668', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8669', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('867', '1301', 'INFRASTRUCTURE', 'INFORMATION TECHNOLOGY', '3', 'MANAGEMENT', 'B         ', '2019-12-02'),
('8670', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8671', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8672', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8673', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8674', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8675', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8676', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8677', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8678', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8679', '4523', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('868', '10', '\"FINANCE', ' ACCOUNTING & IT\"', 'FINAN', '5', 'TETAP               ', '0000-00-00'),
('8680', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2018-11-16'),
('8681', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-12-03'),
('8682', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-03'),
('8683', '4222', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-03'),
('8684', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '1', 'KONTRAK2  ', 'E         ', '2018-12-03'),
('8685', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-03'),
('8686', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8688', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8689', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8690', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8691', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8692', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8693', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8694', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8696', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8697', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8698', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8699', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8700', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8701', '4521', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK2  ', 'E         ', '2018-12-17'),
('8703', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2019-01-14'),
('8705', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2019-01-14'),
('8707', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8708', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8709', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8710', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8711', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8712', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8713', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8714', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8718', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8722', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8725', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8727', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8728', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8729', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK2  ', 'E         ', '2019-01-16'),
('8731', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-01'),
('8732', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-01'),
('8733', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8734', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8735', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8736', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8737', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8738', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8739', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8741', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8742', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8744', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8745', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8746', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8747', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8748', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8749', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8751', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8752', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8753', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8754', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8756', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK2  ', 'E         ', '2019-02-18'),
('8758', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8759', '4422', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8761', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8762', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8764', '4412', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8765', '4412', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8766', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-02-18'),
('8768', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-03-01'),
('8769', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8770', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8772', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8773', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8774', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8775', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8777', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8778', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8779', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8780', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8781', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8782', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8783', '4427', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8784', '4424', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8787', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8788', '4410', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2019-03-18'),
('8789', '4412', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8790', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8791', '4412', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8792', '4412', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8793', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8796', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK2  ', 'E         ', '2019-03-18'),
('8797', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8798', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8799', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('88', '5105', 'PROCESS ENGINEERING 3 - DB', 'ENGINEERING', '3', 'TETAP     ', 'D         ', '1997-08-12'),
('8800', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8801', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8802', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8803', '4429', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-03-18'),
('8804', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8805', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8806', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8807', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8808', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8809', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8810', '4521', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8811', '4521', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8812', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8813', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8814', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8815', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8816', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8817', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8818', '4429', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-04-01'),
('8819', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8821', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16');
INSERT INTO `mpp_karyawan` (`nrp`, `costcenter`, `seksi`, `departemen`, `golongan`, `pangkat`, `statuskaryawan`, `tglMsk`) VALUES
('8823', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8824', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8825', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8826', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8827', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8828', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8829', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8830', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8831', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8833', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8834', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8836', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8837', '4109', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8838', '4313', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8839', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8840', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8841', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8842', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8843', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8844', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8845', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8846', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8847', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8848', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8849', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8851', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8852', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8853', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-04-16'),
('8854', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-18'),
('8855', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-04-18'),
('8856', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8857', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8858', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8859', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8860', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8861', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8862', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8863', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8865', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8867', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8868', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8869', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8870', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8871', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8872', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8873', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8874', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8875', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8876', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8877', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8878', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8879', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8880', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-02'),
('8881', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8882', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8883', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8884', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8885', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8886', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8887', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8888', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8889', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8890', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8891', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8892', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8893', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8894', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8895', '4426', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8896', '4422', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8897', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8898', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8899', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('89', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '3', 'TETAP     ', 'A         ', '1997-09-01'),
('8900', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8901', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8902', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8903', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8904', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8905', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8906', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8907', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8908', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8909', '4426', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-16'),
('8910', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8912', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8913', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8914', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8915', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8916', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8917', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8918', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8919', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-05-20'),
('8920', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8921', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8922', '4428', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8923', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8924', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8925', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8926', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8927', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8928', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8929', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8930', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8931', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8932', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8933', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8934', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8935', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8936', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8937', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8938', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8939', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8940', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8941', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8942', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8943', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8944', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8945', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8946', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8947', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8948', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8949', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8950', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8951', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8952', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8953', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8954', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8955', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8956', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8957', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8958', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8959', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8960', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8961', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8962', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8963', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8964', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8965', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-13'),
('8966', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8967', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8968', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8969', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8970', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8971', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8972', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8973', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8974', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8975', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8976', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8977', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8978', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8979', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8980', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8981', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8982', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8983', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8984', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8985', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8986', '4314', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8987', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8988', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8989', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8990', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8991', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8992', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8993', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8994', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8996', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8997', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8998', '4104', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('8999', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9000', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9001', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9002', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9003', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9004', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9005', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9006', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9007', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9008', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9010', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9011', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9012', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9013', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9014', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9015', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9016', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9017', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9018', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9019', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9020', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9021', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9022', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9023', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9024', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9025', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9026', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9027', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9028', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9029', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9030', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9031', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9032', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9033', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9034', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9035', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9036', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9037', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9038', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9039', '4429', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9040', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9041', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9042', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9043', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9044', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9045', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9046', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9047', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9048', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9049', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9050', '4211', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9051', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9052', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9053', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9054', '4315', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9055', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-06-17'),
('9056', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9057', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9058', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9059', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9060', '4524', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9061', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9062', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-07-01'),
('9063', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9064', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9065', '4311', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9066', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9067', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9068', '4522', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9069', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9070', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9071', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9072', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9073', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9074', '4427', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9075', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9076', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9077', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9078', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9079', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9080', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9081', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9082', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9083', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9084', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9085', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9086', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9087', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9088', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9089', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9090', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9091', '2204', 'PRODUCTION SUPPORT PURCHASING', 'PURCHASING', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9092', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9093', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9094', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9095', '4216', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9096', '4424', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9097', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-16'),
('9098', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-07-18'),
('9099', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('91', '5207', 'WASTE TREATMENT', 'PLANT SERVICE', '3', 'TETAP     ', 'B         ', '1997-10-01'),
('9100', '4101', 'PRODUCTION PLANNING & CONTROL 1', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9101', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9102', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9103', '4213', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9104', '4324', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9105', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9106', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-08-01'),
('9107', '4429', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9108', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9110', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9111', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9112', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9113', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9114', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9115', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9116', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9118', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9119', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9120', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9121', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9122', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-08-16'),
('9123', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-09-02'),
('9124', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-09-02'),
('9125', '2202', 'PROCUREMENT P2', 'PURCHASING', '1', 'KONTRAK1  ', 'E         ', '2019-09-02'),
('9126', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-09-02'),
('9127', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-09-16'),
('9128', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-09-16'),
('9129', '4429', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-09-16'),
('9130', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9131', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9132', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9133', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9134', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9135', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9136', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9137', '4422', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9138', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9139', '4107', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9140', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9141', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9142', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9143', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9144', '4513', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9145', '4523', 'DISK BRAKE 2', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9146', '4413', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9147', '4108', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9149', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9150', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9151', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9152', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-10-16'),
('9154', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9155', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9156', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9157', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9158', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9159', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9160', '4311', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9161', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9162', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9163', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9164', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9165', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9166', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9167', '4413', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9168', '4109', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9169', '4512', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9170', '4221', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9171', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9172', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9173', '4318', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9174', '4215', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9175', '4223', 'SURFACE TREATMENT & ASSY 1', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9176', '4102', 'PRODUCTION PLANNING & CONTROL 2', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9177', '4323', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9178', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9179', '4325', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9180', '4105', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9181', '4511', 'DISK BRAKE 1', 'PRODUCTION DB', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9182', '4215', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9183', '4322', 'SURFACE TREATMENT & ASSY 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2019-11-18'),
('9184', '5202', 'MACHINES & DJTF MAINTENANCE 1', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-12-02'),
('9185', '5205', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2019-12-02'),
('9186', '4414', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-12-16'),
('9187', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-12-16'),
('9188', '4411', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-12-16'),
('9190', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2019-12-16'),
('9191', '5206', 'MACHINES & DJTF MAINTENANCE 2', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2020-01-06'),
('9192', '4425', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-06'),
('9193', '4429', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9194', '4422', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9195', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9196', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9197', '4312', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9198', '4421', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9199', '4423', 'WELDING 3', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('92', '1200', 'GENERAL SERVICES PLANT 1', 'GENERAL AFFAIRS', '4', 'TETAP     ', 'C         ', '1997-10-01'),
('9200', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9201', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9202', '4109', 'DELIVERY CONTROL & FINISH GOOD WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9203', '4316', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9204', '4103', 'PRODUCTION PLANNING & CONTROL 3', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9205', '4107', 'INVENTORY CONTROL & EXTERNAL WAREHOUSE', 'PPIC', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9206', '4317', 'WELDING 2', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9207', '4211', 'WELDING 1 ', 'PRODUCTION MF2W', '1', 'KONTRAK1  ', 'E         ', '2020-01-16'),
('9208', '4423', 'WELDING 4', 'PRODUCTION MF4W', '1', 'KONTRAK1  ', 'E         ', '2020-01-20'),
('9209', '5204', 'FACILITY PROVIDER 2', 'PLANT SERVICE', '1', 'KONTRAK1  ', 'E         ', '2020-02-03'),
('97', '6104', 'SUPPLIER QUALITY CONTROL', 'QUALITY CONTROL', '3', 'TETAP     ', 'B         ', '1997-10-07'),
('nrp', 'costcenter', 'seksi', 'departemen', 'golon', 'statuskary', 'pangkat', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `mpp_maret`
--

CREATE TABLE `mpp_maret` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_mei`
--

CREATE TABLE `mpp_mei` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_november`
--

CREATE TABLE `mpp_november` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_oktober`
--

CREATE TABLE `mpp_oktober` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mpp_september`
--

CREATE TABLE `mpp_september` (
  `workcenter` varchar(12) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `gol1` varchar(50) NOT NULL,
  `gol2` varchar(50) NOT NULL,
  `gol3` varchar(50) NOT NULL,
  `gol4` varchar(50) NOT NULL,
  `gol5` varchar(50) NOT NULL,
  `gol6` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id_overtime` int(11) NOT NULL,
  `jam` int(11) NOT NULL,
  `workcenter` varchar(50) NOT NULL,
  `gol` varchar(50) NOT NULL,
  `bulan` date NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `seksi` varchar(50) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id_overtime`, `jam`, `workcenter`, `gol`, `bulan`, `tahun`, `dept`, `seksi`, `budget`) VALUES
(4, 14, '2202', '0', '2020-01-01', '2020', 'PURCHASING', 'Procurement P2', 1017128),
(5, 25, '2202', '3', '2020-01-01', '2020', 'PURCHASING', 'Procurement P2', 2670250),
(6, 13, '2203', '0', '2020-01-01', '2020', 'PURCHASING', 'Procurement New Model', 944476),
(7, 23, '2203', '3', '2020-01-01', '2020', 'PURCHASING', 'Procurement New Model', 2456630),
(8, 17, '2204', '0', '2020-01-01', '2020', 'PURCHASING', 'Purchasing', 1235084),
(9, 99, '2204', '2', '2020-01-01', '2020', 'PURCHASING', 'Purchasing', 9603099),
(10, 66, '2204', '3', '2020-01-01', '2020', 'PURCHASING', 'Purchasing', 7049460),
(11, 20, '2205', '2', '2020-01-01', '2020', 'PURCHASING', 'Import Export', 1940020),
(12, 20, '2205', '3', '2020-01-01', '2020', 'PURCHASING', 'Import Export', 2136200),
(79, 33, '2200', '4', '2020-01-01', '2020', 'PURCHASING', 'Purchasing Dept', 4380651),
(616, 27, '2201', '2', '2020-01-01', '2020', 'PURCHASING', 'Procurement P1', 2619027),
(617, 19, '2201', '3', '2020-01-01', '2020', 'PURCHASING', 'Procurement P1', 2029390),
(968, 14, '2202', '1', '2020-01-01', '2020', 'PURCHASING', 'Procurement P2', 1211084),
(969, 42, '2202', '2', '2020-01-01', '2020', 'PURCHASING', 'Procurement P2', 4074042),
(977, 0, '2201', '1', '2020-01-01', '2020', 'PURCHASING', 'Procurement P1', 0),
(978, 0, '2201', '0', '2020-01-01', '2020', 'PURCHASING', 'Procurement P1', 0),
(979, 0, '2203', '1', '2020-01-01', '2020', 'PURCHASING', 'Procurement New Model', 0),
(980, 0, '2203', '2', '2020-01-01', '2020', 'PURCHASING', 'Procurement New Model', 0),
(981, 0, '2204', '1', '2020-01-01', '2020', 'PURCHASING', 'Purchasing', 0),
(982, 0, '2205', '1', '2020-01-01', '2020', 'PURCHASING', 'Import Export', 0),
(983, 0, '2205', '0', '2020-01-01', '2020', 'PURCHASING', 'Import Export', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thr_asumsi`
--

CREATE TABLE `thr_asumsi` (
  `id_thr` int(11) NOT NULL DEFAULT 0,
  `gp1` int(11) NOT NULL,
  `gp2` int(11) NOT NULL,
  `gp3` int(11) NOT NULL,
  `gp4` int(11) NOT NULL,
  `gp5` int(11) NOT NULL,
  `gp6` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `id_transport` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `tahun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tunj_kehadiran`
--

CREATE TABLE `tunj_kehadiran` (
  `id_tunj_kehadiran` int(11) NOT NULL,
  `gol1` int(11) NOT NULL,
  `gol2` int(11) NOT NULL,
  `gol3` int(11) NOT NULL,
  `gol0` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `workcenter`
--

CREATE TABLE `workcenter` (
  `id_workcenter` varchar(50) NOT NULL,
  `Seksi` varchar(50) NOT NULL,
  `Dept` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workcenter`
--

INSERT INTO `workcenter` (`id_workcenter`, `Seksi`, `Dept`) VALUES
('2200', 'Purchasing Dept', 'PURCHASING'),
('2201', 'Procurement P1', 'PURCHASING'),
('2202', 'Procurement P2', 'PURCHASING'),
('2203', 'Procurement New Model', 'PURCHASING'),
('2204', 'Purchasing', 'PURCHASING'),
('2205', 'Import Export', 'PURCHASING');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asumsi_bonus`
--
ALTER TABLE `asumsi_bonus`
  ADD PRIMARY KEY (`id_bonus`);

--
-- Indexes for table `asumsi_gol0`
--
ALTER TABLE `asumsi_gol0`
  ADD PRIMARY KEY (`id_asumsi_gol1`);

--
-- Indexes for table `asumsi_gol1`
--
ALTER TABLE `asumsi_gol1`
  ADD PRIMARY KEY (`id_asumsi_gol1`);

--
-- Indexes for table `asumsi_gol2`
--
ALTER TABLE `asumsi_gol2`
  ADD PRIMARY KEY (`id_asumsi_gol2`);

--
-- Indexes for table `asumsi_gol3`
--
ALTER TABLE `asumsi_gol3`
  ADD PRIMARY KEY (`id_asumsi_gol3`);

--
-- Indexes for table `asumsi_gol4`
--
ALTER TABLE `asumsi_gol4`
  ADD PRIMARY KEY (`id_asumsi_gol4`);

--
-- Indexes for table `asumsi_gol5`
--
ALTER TABLE `asumsi_gol5`
  ADD PRIMARY KEY (`id_asumsi_gol5`);

--
-- Indexes for table `asumsi_gol6`
--
ALTER TABLE `asumsi_gol6`
  ADD PRIMARY KEY (`id_asumsi_gol6`);

--
-- Indexes for table `asumsi_gp`
--
ALTER TABLE `asumsi_gp`
  ADD PRIMARY KEY (`id_asumsi`),
  ADD KEY `id_asumsi_gol1` (`id_asumsi_gol1`),
  ADD KEY `id_asumsi_gol2` (`id_asumsi_gol2`),
  ADD KEY `id_asumsi_gol3` (`id_asumsi_gol3`),
  ADD KEY `id_asumsi_gol4` (`id_asumsi_gol4`),
  ADD KEY `id_asumsi_gol0` (`id_asumsi_gol0`),
  ADD KEY `id_asumsi_gol5` (`id_asumsi_gol5`),
  ADD KEY `id_asumsi_gol6` (`id_asumsi_gol6`);

--
-- Indexes for table `asumsi_gp_avg`
--
ALTER TABLE `asumsi_gp_avg`
  ADD PRIMARY KEY (`id_asumsi`),
  ADD KEY `gol` (`gol`);

--
-- Indexes for table `asumsi_holiday_allowance`
--
ALTER TABLE `asumsi_holiday_allowance`
  ADD PRIMARY KEY (`id_holiday_allowance`);

--
-- Indexes for table `asumsi_incentive`
--
ALTER TABLE `asumsi_incentive`
  ADD PRIMARY KEY (`id_incentive`);

--
-- Indexes for table `asumsi_manpowerinsurance`
--
ALTER TABLE `asumsi_manpowerinsurance`
  ADD PRIMARY KEY (`id_a_manpower`);

--
-- Indexes for table `asumsi_medical_expense_bpjs`
--
ALTER TABLE `asumsi_medical_expense_bpjs`
  ADD PRIMARY KEY (`id_asumsi`);

--
-- Indexes for table `asumsi_medical_expense_obat`
--
ALTER TABLE `asumsi_medical_expense_obat`
  ADD PRIMARY KEY (`id_mex_o`);

--
-- Indexes for table `asumsi_overtime`
--
ALTER TABLE `asumsi_overtime`
  ADD PRIMARY KEY (`id_asumsi_overtime`),
  ADD KEY `gol` (`gol`);

--
-- Indexes for table `asumsi_pensiondpa`
--
ALTER TABLE `asumsi_pensiondpa`
  ADD PRIMARY KEY (`id_pensiondpa`);

--
-- Indexes for table `asumsi_thr`
--
ALTER TABLE `asumsi_thr`
  ADD PRIMARY KEY (`id_thr`);

--
-- Indexes for table `asumsi_tnj_hadir`
--
ALTER TABLE `asumsi_tnj_hadir`
  ADD PRIMARY KEY (`id_tnj_hadir`);

--
-- Indexes for table `asumsi_transportasi`
--
ALTER TABLE `asumsi_transportasi`
  ADD PRIMARY KEY (`id_transportasi`);

--
-- Indexes for table `bonus_asumsi`
--
ALTER TABLE `bonus_asumsi`
  ADD PRIMARY KEY (`id_bonus`);

--
-- Indexes for table `costcenter`
--
ALTER TABLE `costcenter`
  ADD PRIMARY KEY (`costcenter`);

--
-- Indexes for table `group_gol`
--
ALTER TABLE `group_gol`
  ADD PRIMARY KEY (`id_gol`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nrp`);

--
-- Indexes for table `master_mpp`
--
ALTER TABLE `master_mpp`
  ADD PRIMARY KEY (`id_master_mpp`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id_meal`);

--
-- Indexes for table `mpp`
--
ALTER TABLE `mpp`
  ADD PRIMARY KEY (`id_mpp`);

--
-- Indexes for table `mpp_gol0`
--
ALTER TABLE `mpp_gol0`
  ADD PRIMARY KEY (`id_mpp0`);

--
-- Indexes for table `mpp_gol1`
--
ALTER TABLE `mpp_gol1`
  ADD PRIMARY KEY (`id_mpp1`);

--
-- Indexes for table `mpp_gol2`
--
ALTER TABLE `mpp_gol2`
  ADD PRIMARY KEY (`id_mpp2`);

--
-- Indexes for table `mpp_gol3`
--
ALTER TABLE `mpp_gol3`
  ADD PRIMARY KEY (`id_mpp3`);

--
-- Indexes for table `mpp_gol4`
--
ALTER TABLE `mpp_gol4`
  ADD PRIMARY KEY (`id_mpp1`);

--
-- Indexes for table `mpp_gol5`
--
ALTER TABLE `mpp_gol5`
  ADD PRIMARY KEY (`id_mpp5`);

--
-- Indexes for table `mpp_gol6`
--
ALTER TABLE `mpp_gol6`
  ADD PRIMARY KEY (`id_mpp1`);

--
-- Indexes for table `mpp_januari`
--
ALTER TABLE `mpp_januari`
  ADD PRIMARY KEY (`id_mpp_jan`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `mpp_karyawan`
--
ALTER TABLE `mpp_karyawan`
  ADD PRIMARY KEY (`nrp`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id_overtime`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id_transport`);

--
-- Indexes for table `tunj_kehadiran`
--
ALTER TABLE `tunj_kehadiran`
  ADD PRIMARY KEY (`id_tunj_kehadiran`);

--
-- Indexes for table `workcenter`
--
ALTER TABLE `workcenter`
  ADD PRIMARY KEY (`id_workcenter`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asumsi_bonus`
--
ALTER TABLE `asumsi_bonus`
  MODIFY `id_bonus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `asumsi_gol0`
--
ALTER TABLE `asumsi_gol0`
  MODIFY `id_asumsi_gol1` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gol1`
--
ALTER TABLE `asumsi_gol1`
  MODIFY `id_asumsi_gol1` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gol2`
--
ALTER TABLE `asumsi_gol2`
  MODIFY `id_asumsi_gol2` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gol3`
--
ALTER TABLE `asumsi_gol3`
  MODIFY `id_asumsi_gol3` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gol4`
--
ALTER TABLE `asumsi_gol4`
  MODIFY `id_asumsi_gol4` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gol5`
--
ALTER TABLE `asumsi_gol5`
  MODIFY `id_asumsi_gol5` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gol6`
--
ALTER TABLE `asumsi_gol6`
  MODIFY `id_asumsi_gol6` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gp`
--
ALTER TABLE `asumsi_gp`
  MODIFY `id_asumsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asumsi_gp_avg`
--
ALTER TABLE `asumsi_gp_avg`
  MODIFY `id_asumsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `asumsi_holiday_allowance`
--
ALTER TABLE `asumsi_holiday_allowance`
  MODIFY `id_holiday_allowance` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asumsi_incentive`
--
ALTER TABLE `asumsi_incentive`
  MODIFY `id_incentive` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asumsi_manpowerinsurance`
--
ALTER TABLE `asumsi_manpowerinsurance`
  MODIFY `id_a_manpower` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asumsi_medical_expense_bpjs`
--
ALTER TABLE `asumsi_medical_expense_bpjs`
  MODIFY `id_asumsi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asumsi_medical_expense_obat`
--
ALTER TABLE `asumsi_medical_expense_obat`
  MODIFY `id_mex_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `asumsi_overtime`
--
ALTER TABLE `asumsi_overtime`
  MODIFY `id_asumsi_overtime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `asumsi_pensiondpa`
--
ALTER TABLE `asumsi_pensiondpa`
  MODIFY `id_pensiondpa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asumsi_thr`
--
ALTER TABLE `asumsi_thr`
  MODIFY `id_thr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asumsi_tnj_hadir`
--
ALTER TABLE `asumsi_tnj_hadir`
  MODIFY `id_tnj_hadir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asumsi_transportasi`
--
ALTER TABLE `asumsi_transportasi`
  MODIFY `id_transportasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonus_asumsi`
--
ALTER TABLE `bonus_asumsi`
  MODIFY `id_bonus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_mpp`
--
ALTER TABLE `master_mpp`
  MODIFY `id_master_mpp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `id_meal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mpp`
--
ALTER TABLE `mpp`
  MODIFY `id_mpp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_gol0`
--
ALTER TABLE `mpp_gol0`
  MODIFY `id_mpp0` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mpp_gol1`
--
ALTER TABLE `mpp_gol1`
  MODIFY `id_mpp1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_gol2`
--
ALTER TABLE `mpp_gol2`
  MODIFY `id_mpp2` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_gol3`
--
ALTER TABLE `mpp_gol3`
  MODIFY `id_mpp3` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_gol4`
--
ALTER TABLE `mpp_gol4`
  MODIFY `id_mpp1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_gol5`
--
ALTER TABLE `mpp_gol5`
  MODIFY `id_mpp5` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_gol6`
--
ALTER TABLE `mpp_gol6`
  MODIFY `id_mpp1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpp_januari`
--
ALTER TABLE `mpp_januari`
  MODIFY `id_mpp_jan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id_overtime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=984;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id_transport` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tunj_kehadiran`
--
ALTER TABLE `tunj_kehadiran`
  MODIFY `id_tunj_kehadiran` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asumsi_gp`
--
ALTER TABLE `asumsi_gp`
  ADD CONSTRAINT `asumsi_gp_ibfk_1` FOREIGN KEY (`id_asumsi_gol1`) REFERENCES `asumsi_gol1` (`id_asumsi_gol1`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asumsi_gp_ibfk_2` FOREIGN KEY (`id_asumsi_gol2`) REFERENCES `asumsi_gol2` (`id_asumsi_gol2`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asumsi_gp_ibfk_3` FOREIGN KEY (`id_asumsi_gol3`) REFERENCES `asumsi_gol3` (`id_asumsi_gol3`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asumsi_gp_ibfk_4` FOREIGN KEY (`id_asumsi_gol4`) REFERENCES `asumsi_gol4` (`id_asumsi_gol4`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asumsi_gp_avg`
--
ALTER TABLE `asumsi_gp_avg`
  ADD CONSTRAINT `asumsi_gp_avg_ibfk_1` FOREIGN KEY (`gol`) REFERENCES `group_gol` (`id_gol`);

--
-- Constraints for table `asumsi_overtime`
--
ALTER TABLE `asumsi_overtime`
  ADD CONSTRAINT `asumsi_overtime_ibfk_1` FOREIGN KEY (`gol`) REFERENCES `group_gol` (`id_gol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
