-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2017 at 01:42 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pick2get`
--

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `S/NO` int(100) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `AGE` int(3) NOT NULL,
  `ROLE` varchar(20) NOT NULL,
  `TIME REGISTERED` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`S/NO`, `NAME`, `AGE`, `ROLE`, `TIME REGISTERED`) VALUES
(1, 'charles', 28, 'programmer', '0000-00-00 00:00:00.000000'),
(1, 'Charles', 28, 'programmer', '2017-05-22 02:31:24.298225'),
(0, 'tonny', 14, 'cadet', '2017-05-21 21:41:48.491986'),
(0, 'Albert njau', 28, 'Telecom', '2017-05-21 21:44:47.153046'),
(0, 'Ernest njau', 78, 'Phycisist', '2017-05-21 22:19:47.797367'),
(0, 'Ernest njau', 78, 'Phycisist', '2017-05-21 22:19:56.910447'),
(0, 'e', 34, 'sdf', '2017-05-21 22:20:46.100742'),
(0, 'alala', 23, 'dsd', '2017-05-21 22:22:00.634298'),
(0, 'ds', 3, '343trtrt', '2017-05-21 22:27:28.867614'),
(0, '', 0, '', '2017-05-28 11:32:15.257990'),
(0, 'ibrahim warsame', 42, 'programmer', '2017-06-03 03:27:50.573000'),
(0, 'Talex', 12, 'programmer', '2017-06-03 03:31:05.209713'),
(0, 'Shaka', 23, 'programmer', '2017-06-03 03:32:48.658235'),
(0, 'ASDF', 12, 'programmer', '2017-06-03 03:33:53.967538'),
(0, 'kernel', 23, 'programmer', '2017-06-03 03:35:10.832637'),
(0, 'kernel', 23, 'programmer', '2017-06-03 03:35:12.685176'),
(0, 'manba', 12, 'programmer', '2017-06-03 03:35:41.133405'),
(0, 'ruyter', 12, 'programmer', '2017-06-03 03:38:02.211050'),
(0, 'sadfa', 14, 'programmer', '2017-06-03 03:38:40.807026'),
(0, 'qwer', 23, 'programmer', '2017-06-03 03:38:58.620370'),
(0, 'Alfa kumare', 11, 'programmer', '2017-06-03 03:42:26.361832'),
(0, 'Said lkilemdu', 56, 'Telecom', '2017-06-03 03:52:58.746310'),
(0, 'Tomas lkilemdu', 56, 'Telecom', '2017-06-03 04:12:04.158793'),
(0, 'Jacob lkilemdu', 56, 'Programmer', '2017-06-03 04:30:57.236845'),
(0, 'Jacob lkilemdu', 56, 'Programmer', '2017-06-03 04:30:59.242712'),
(0, 'Jacob', 12, 'Programmer', '2017-06-03 04:31:19.706683'),
(0, 'wiliam ', 21, 'Programmer', '2017-06-03 04:33:09.307062'),
(0, 'wergfdsdfsdb', 2147483647, 'Telecom', '2017-06-03 04:34:31.451009'),
(0, '', 0, '', '2017-06-03 04:55:13.254962'),
(0, 'saf', 23, 'Programmer', '2017-06-03 04:55:35.126329'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 04:58:07.356967'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 04:59:11.195622'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:00:07.080365'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:00:09.171156'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:00:12.249274'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:00:28.303169'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:03:06.843787'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:03:16.385865'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:03:18.165253'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:03:20.036398'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:03:41.972486'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:04:35.739083'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:05:36.459543'),
(0, 'Admin', 12, 'Programmer', '2017-06-03 05:06:27.205584'),
(0, '', 0, '', '2017-06-03 05:08:00.341072'),
(0, 'juma issa', 12, 'Telecom', '2017-06-03 05:08:20.754213'),
(0, ' issa Bakari', 12, 'Progammer', '2017-06-03 05:08:49.525796'),
(0, 'mahamudu', 14, 'programmer', '2017-06-03 05:11:11.549286'),
(0, 'Dolson', 23, 'Programmer', '2017-06-03 05:12:59.150391'),
(0, 'Dolson', 23, 'Telecom', '2017-06-03 05:13:21.920208'),
(0, 'w', 1, 'Telecom', '2017-06-03 05:13:56.338877'),
(0, 'f', 3, 'Programmer', '2017-06-03 05:14:19.830640');

-- --------------------------------------------------------

--
-- Table structure for table `useregistration`
--

CREATE TABLE `useregistration` (
  `ID` int(11) NOT NULL,
  `COMPANY_NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(245) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `REGISTERD_AS` varchar(11) NOT NULL,
  `REGISTRATION DATE` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `useregistration`
--

INSERT INTO `useregistration` (`ID`, `COMPANY_NAME`, `EMAIL`, `PASSWORD`, `REGISTERD_AS`, `REGISTRATION DATE`, `ACTIVATION STATUS`) VALUES
(51, '', 'Array', '$2y$10$DZzz1wFsUe4OhkBCuOSHYOzHNG2MRXgFjFXQ4owKaCF4tsI5hhUau', '', '2017-05-21 14:29:19.148755', 0),
(52, '', 'Array', '$2y$10$hobUsytB8OdH8Nj02i0boOtoR0AIZ2/5EqqYKoklVpb7fezNJpJnG', '', '2017-05-21 14:34:05.337367', 0),
(53, 'sopo', 'hgdytdt@hgiug.com', '$2y$10$CSkGTmFI3ZYh50FRmMZ7U.X66akBhe7VyE3gCEKTLBAKaj7JdZ.Xy', 'Supplier', '2017-05-21 14:34:05.385997', 0),
(54, '', 'Array', '$2y$10$O6aLSXITDKtNR43SCw5Dguo.fAKYqzrxe57LkopdJCN/8ZE3i6Um6', '', '2017-05-21 14:35:54.276942', 0),
(55, 'golden tulip', 'Tuliphotel@golden.com', '$2y$10$7NDxYMuzRIHeXDUAGp.p5OfYy3z82cT1I3tOjvZWMgLK/xc.9WMlG', 'Hotel', '2017-05-21 14:35:54.333084', 0),
(56, '', 'Array', '$2y$10$mybqA6TCuL3bfFYSLZ0elecUrWpn0Xe5vYVwdSiyFPa2e1aZ39iFq', '', '2017-05-21 14:39:54.144052', 0),
(57, 'orbg[oewb', '98y988@wefr.com', '$2y$10$CbqZXqPqfki/F.QC33u/4OnyOSvsp5da73PnC1e6bLnlGFoe1CnSq', 'Hotel', '2017-05-21 14:43:01.661306', 0),
(58, '', 'Array', '$2y$10$wBtKlucDvZAyOWAf50JWuewHYQk5OFdMnd1hFhNO.g9184iz/cVze', '', '2017-05-21 20:15:03.543856', 0),
(59, 'Hyatt', 'Hyatt@hq.com', '$2y$10$LoarR1ln5ldGdrET5kcj3eOe0sSHPsmQhhnrl8TkMMBo/h/2CnRfO', 'Hotel', '2017-05-21 21:48:23.751352', 0),
(60, 'Hyatt', 'Hyatt@hq.com', '$2y$10$ajle4S0Kd36jR6aMcGGode7Kg/aiDoUX5DcIQwEIe4KnB3/FVVxw.', 'Hotel', '2017-05-21 21:48:23.824046', 0),
(61, 'Hyatt Tanzania', 'HyattTz@eaHq.com', '$2y$10$FNYceZ7hzfI2rFF6kj874OawwOnqw7szHZsADPt8bKPbbfR02Pouu', 'Hotel', '2017-05-21 21:50:18.574918', 0),
(62, 'qrf', 'qre@wfr.com', '$2y$10$gIqRHbkwULCLovT3gNRuKe0ZXGzEl6nPMIHgBI7nKcFBBVxu46xEu', 'Supplier', '2017-05-21 22:13:45.930110', 0),
(63, 'qrf', 'qre@wfr.com', '$2y$10$iPPSi8415t7xmSmMls3fwuy21DkWo.k.Y9Qve8vZW.WGMihLcaBlK', 'Supplier', '2017-05-21 22:14:57.918545', 0),
(64, 'kitwana LTD', 'kitwana@gmail.com', '$2y$10$iAj6SmRfD7Z1gP83Iuv30O17Qp5vQv007V8qosnwnA6DcR9Sb.A2K', 'Supplier', '2017-05-21 22:32:02.273114', 0),
(65, '', '', '$2y$10$lt70xPMlLs9.x8FWwiHvj.28fKA3kkk7gaXj74ICXVOSMZMP00SPO', '', '2017-05-21 22:32:46.463173', 0),
(66, '', '', '$2y$10$HHihKd35DI6Djca5RnwWwO38TdedCncnLWf7.CPi5kWu3e0o/UET6', '', '2017-05-28 12:25:46.020444', 0),
(67, '', '', '$2y$10$BYI20tyOlIBTyO9xGPA26.EgSlxWg714GS/DNxPPUker02zdjmbai', '', '2017-05-28 12:30:24.308312', 0),
(68, '', '', '$2y$10$CA8MnQwEvyWMJsteFK2YZOk74ujGmLD3eV/TAzAlMwfOhTHt9i4wu', '', '2017-05-28 14:34:41.218610', 0),
(69, '', '', '$2y$10$gTgmraCdNdNXAM06rR8dSeRsC9vyb9njrpDl0j6NQQBI5agAz.bxy', '', '2017-05-28 14:35:46.615577', 0),
(70, '4765', 'q3434r3', '$2y$10$h6MLPVrS1khKLa/bI5TEPOw1Cex0kvCTk2nKJKroMHICVqnQAB8JW', 'Supplier', '2017-05-28 14:36:03.238176', 0),
(71, '4765', 'q3434r3', '$2y$10$y/k7esqoSkMeiJrMEiZN3.acEf8aXHKI9nB4njlFFokYxf8HDdxfy', 'Supplier', '2017-05-28 14:36:04.459360', 0),
(72, '4765', 'q3434r3', '$2y$10$I0Upmq0s1JYMKpKD4ArSyeVa9bBgLHc/uZrVdfUiJ4mnz1D6s8gwy', 'Supplier', '2017-05-28 14:36:06.538522', 0),
(73, 'reagerg', 'argrg', '$2y$10$wV4/BUcXe6vhTK9olYlaU.PdzH2dmKIQGDWBxxKy0rdQvBQlgZyP2', 'Supplier', '2017-05-28 14:36:42.965284', 0),
(74, 'jaja', 'jas@adjk.com', '$2y$10$hltuS.LzFTpC8f0DanqkueRIf1gtzoFP7bgTCiwue9DavJK12TsNG', 'Hotel', '2017-05-28 15:14:04.362648', 0),
(75, 'gelfa', 'Sheraloty@gmail.com', '$2y$10$vQxKx9LL4gJ4yWgwzg6L4uJ4QBMKamv3v458xfv5mDHWiforZIQr6', 'Supplier', '2017-05-28 17:55:03.493910', 0),
(76, 'Moven Group LTD', 'MovenPick@Hq.com', '$2y$10$WDocaDmvVDPW8rx5vfg.y.D9.RUC8tOZ17krJb0DM9XweJsgty7bC', 'Hotel', '2017-05-29 10:35:35.826009', 0),
(77, 'laven TLD', 'laven@gmail.com', '$2y$10$8PIiFJrm7UahQhFNlkfJ9OCH0nGJ8ARheIZB3rl3H0UoBlBflLChW', 'Supplier', '2017-05-31 14:37:37.588514', 0),
(78, 'admin', 'Admin@gmail.com', '$2y$10$m3vlO/0cwmlYz0yd7m8SmuM.k5XraKrqk.3Vr1.K24XC/bxoEsU8i', 'Admin', '2017-06-03 08:09:02.424305', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `SESSION_ID` varchar(255) NOT NULL,
  `LOGIN_TIME` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `user_log_records`
--

CREATE TABLE `user_log_records` (
  `ID` int(11) NOT NULL COMMENT 'This for auto incrementing various log records',
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `SESSION_ID` int(200) NOT NULL,
  `LOGIN_TIME` varchar(200) NOT NULL,
  `LOGOUT_TIME` varchar(200) NOT NULL,
  `USER_ROLE` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log_records`
--

INSERT INTO `user_log_records` (`ID`, `EMAIL`, `PASSWORD`, `SESSION_ID`, `LOGIN_TIME`, `LOGOUT_TIME`, `USER_ROLE`) VALUES
(8, 'Admin@gmail.com', '$2y$10$m3vlO/0cwmlYz0yd7m8SmuM.k5XraKrqk.3Vr1.K24XC/bxoEsU8i', 78, '2017-06-03 14:24:32.220178', '2017-06-03 14:24:32.000000', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_log_records`
--
ALTER TABLE `user_log_records`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `useregistration`
--
ALTER TABLE `useregistration`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_log_records`
--
ALTER TABLE `user_log_records`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This for auto incrementing various log records', AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
