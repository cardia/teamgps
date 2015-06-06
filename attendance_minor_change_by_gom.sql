-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 15-06-06 23:25 
-- 서버 버전: 5.1.41
-- PHP 버전: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `attendance`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture`
--

CREATE TABLE IF NOT EXISTS `lecture` (
  `lecture_number` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `s_time` time NOT NULL,
  `take_time` int(11) NOT NULL,
  PRIMARY KEY (`lecture_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- 테이블의 덤프 데이터 `lecture`
--

INSERT INTO `lecture` (`lecture_number`, `title`, `s_time`, `take_time`) VALUES
(102, '경영과학', '00:00:00', 0),
(103, '생산관리', '00:00:00', 0),
(104, '컴퓨터시뮬레이션', '00:00:00', 0),
(105, '창의적공학설계', '00:00:00', 0),
(106, 'CAD', '00:00:00', 0),
(107, '통계적품질관리', '00:00:00', 0),
(111, '테스트', '09:00:00', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_check`
--

CREATE TABLE IF NOT EXISTS `lecture_check` (
  `user_number` int(11) NOT NULL,
  `lecture_number` int(3) NOT NULL,
  `date` date NOT NULL,
  `check1` int(1) DEFAULT '0',
  `check2` int(1) DEFAULT '0',
  `check3` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lecture_check`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_day`
--

CREATE TABLE IF NOT EXISTS `lecture_day` (
  `lecture_number` int(11) NOT NULL,
  `day1` date DEFAULT NULL,
  `day2` date DEFAULT NULL,
  `day3` date DEFAULT NULL,
  `day4` date DEFAULT NULL,
  `day5` date DEFAULT NULL,
  `day6` date DEFAULT NULL,
  `day7` date DEFAULT NULL,
  `day8` date DEFAULT NULL,
  `day9` date DEFAULT NULL,
  `day10` date DEFAULT NULL,
  `day11` date DEFAULT NULL,
  `day12` date DEFAULT NULL,
  `day13` date DEFAULT NULL,
  `day14` date DEFAULT NULL,
  `day15` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lecture_day`
--

INSERT INTO `lecture_day` (`lecture_number`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `day8`, `day9`, `day10`, `day11`, `day12`, `day13`, `day14`, `day15`) VALUES
(102, '2015-05-04', '2015-05-06', '2015-05-11', '2015-05-13', '2015-05-18', '2015-05-20', '2015-05-25', '2015-05-27', '2015-06-01', '2015-06-03', '2015-06-08', '2015-06-10', '2015-06-15', '2015-06-17', '0000-00-00'),
(103, '2015-05-04', '2015-05-06', '2015-05-11', '2015-05-13', '2015-05-18', '2015-05-20', '2015-05-25', '2015-05-27', '2015-06-01', '2015-06-03', '2015-06-08', '2015-06-10', '2015-06-15', '2015-06-17', '0000-00-00'),
(104, '2015-05-04', '2015-05-06', '2015-05-11', '2015-05-13', '2015-05-18', '2015-05-20', '2015-05-25', '2015-05-27', '2015-06-01', '2015-06-03', '2015-06-08', '2015-06-10', '2015-06-15', '2015-06-17', '0000-00-00'),
(107, '2015-05-04', '2015-05-06', '2015-05-11', '2015-05-13', '2015-05-18', '2015-05-20', '2015-05-25', '2015-05-27', '2015-06-01', '2015-06-03', '2015-06-08', '2015-06-10', '2015-06-15', '2015-06-17', '0000-00-00'),
(106, '2015-05-07', '2015-05-12', '2015-05-14', '2015-05-19', '2015-05-21', '2015-05-26', '2015-05-28', '2015-06-02', '2015-06-04', '2015-06-09', '2015-06-11', '2015-06-16', '0000-00-00', '0000-00-00', '0000-00-00'),
(105, '2015-05-12', '2015-05-19', '2015-05-26', '2015-06-02', '2015-06-09', '2015-06-16', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(111, '2015-06-02', '2015-06-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_user`
--

CREATE TABLE IF NOT EXISTS `lecture_user` (
  `user_number` int(11) NOT NULL,
  `lecture_number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lecture_user`
--

INSERT INTO `lecture_user` (`user_number`, `lecture_number`) VALUES
(111111112, 105),
(111111112, 104),
(111111111, 103),
(111111111, 102);

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_number` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `mac_address` varchar(30) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `major` varchar(20) NOT NULL,
  PRIMARY KEY (`user_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`user_number`, `user_name`, `password`, `mac_address`, `isadmin`, `major`) VALUES
(111111112, '12학번', '*5F78DD8A3AA1587DB6396AF44754088CFD2FE71E', '', 0, ''),
(111111111, '테승트', '*89C6B530AA78695E257E55D63C00A6EC9AD3E977', '00-00-00-00-00-00', 0, '1111'),
(0, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', '', 1, '');
