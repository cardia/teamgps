-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 15-06-22 01:09 
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
  `time_lecture` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lecture_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- 테이블의 덤프 데이터 `lecture`
--

INSERT INTO `lecture` (`lecture_number`, `title`, `time_lecture`) VALUES
(102, '경영과학', 2),
(103, '생산관리', 2),
(104, '컴퓨터시뮬레이션', 2),
(105, '창의적공학설계', 1),
(106, 'CAD', 1),
(107, '통계적품질관리', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_check`
--

CREATE TABLE IF NOT EXISTS `lecture_check` (
  `user_number` int(11) NOT NULL,
  `lecture_number` int(3) NOT NULL,
  `date` date NOT NULL,
  `check1` int(1) NOT NULL DEFAULT '0',
  `check2` int(1) NOT NULL DEFAULT '0',
  `check3` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lecture_check`
--

INSERT INTO `lecture_check` (`user_number`, `lecture_number`, `date`, `check1`, `check2`, `check3`) VALUES
(111111111, 102, '2015-05-04', 0, 0, 0),
(111111111, 102, '2015-05-06', 0, 0, 1),
(111111111, 102, '2015-05-11', 0, 1, 0),
(111111111, 102, '2015-05-13', 0, 1, 1),
(111111111, 102, '2015-05-18', 1, 0, 0),
(111111111, 102, '2015-05-20', 1, 0, 1),
(111111111, 102, '2015-05-25', 1, 1, 0),
(111111111, 102, '2015-05-27', 1, 1, 1),
(111111111, 103, '2015-05-04', 1, 0, 0),
(111111111, 103, '2015-05-06', 1, 0, 1),
(111111111, 103, '2015-05-11', 1, 1, 0),
(111111111, 103, '2015-05-13', 1, 1, 1),
(111111111, 103, '2015-05-18', 1, 0, 0),
(111111111, 103, '2015-05-20', 1, 0, 1),
(111111111, 103, '2015-05-25', 1, 1, 0),
(111111111, 103, '2015-05-27', 1, 1, 1),
(111111111, 104, '2015-05-04', 1, 1, 0),
(111111111, 104, '2015-05-06', 1, 1, 1),
(111111111, 104, '2015-05-11', 1, 1, 0),
(111111111, 104, '2015-05-13', 1, 1, 1),
(111111111, 104, '2015-05-18', 1, 1, 0),
(111111111, 104, '2015-05-20', 1, 1, 1),
(111111111, 104, '2015-05-25', 1, 1, 0),
(111111111, 104, '2015-05-27', 1, 1, 1),
(111111111, 107, '2015-05-04', 1, 1, 1),
(111111111, 107, '2015-05-06', 1, 1, 1),
(111111111, 107, '2015-05-11', 1, 1, 1),
(111111111, 107, '2015-05-13', 1, 1, 1),
(111111111, 107, '2015-05-18', 1, 1, 1),
(111111111, 107, '2015-05-20', 1, 1, 1),
(111111111, 107, '2015-05-25', 1, 1, 1),
(111111111, 107, '2015-05-27', 1, 1, 1),
(111111111, 106, '2015-05-07', 1, 0, 1),
(111111111, 106, '2015-05-12', 1, 0, 1),
(111111111, 106, '2015-05-14', 1, 0, 1),
(111111111, 106, '2015-05-19', 1, 0, 1),
(111111111, 106, '2015-05-21', 1, 0, 1),
(111111111, 106, '2015-05-26', 1, 0, 1),
(111111111, 106, '2015-05-28', 1, 0, 1),
(111111111, 106, '2015-06-02', 1, 0, 1),
(111111111, 105, '2015-05-12', 0, 0, 0),
(111111111, 105, '2015-05-19', 0, 0, 0),
(111111111, 105, '2015-05-26', 0, 0, 0),
(111111111, 105, '2015-06-02', 0, 0, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_day`
--

CREATE TABLE IF NOT EXISTS `lecture_day` (
  `lecture_number` int(11) NOT NULL,
  `day1` date NOT NULL,
  `day2` date NOT NULL,
  `day3` date NOT NULL,
  `day4` date NOT NULL,
  `day5` date NOT NULL,
  `day6` date NOT NULL,
  `day7` date NOT NULL,
  `day8` date NOT NULL,
  `day9` date NOT NULL,
  `day10` date NOT NULL,
  `day11` date NOT NULL,
  `day12` date NOT NULL,
  `day13` date NOT NULL,
  `day14` date NOT NULL,
  `day15` date NOT NULL
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
(105, '2015-05-12', '2015-05-19', '2015-05-26', '2015-06-02', '2015-06-09', '2015-06-16', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_time`
--

CREATE TABLE IF NOT EXISTS `lecture_time` (
  `lecture` varchar(15) NOT NULL,
  `day` enum('Sun','Mon','Tue','Wed','Thu','Fri','Sat') NOT NULL,
  `start_time` int(11) NOT NULL,
  `took_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lecture_time`
--

INSERT INTO `lecture_time` (`lecture`, `day`, `start_time`, `took_time`) VALUES
('경영과학', 'Mon', 9, 2),
('통계적품질관리', 'Mon', 11, 2),
('생산관리', 'Mon', 16, 2),
('컴퓨터시뮬레이션', 'Mon', 18, 2),
('창의적공학설계', 'Tue', 16, 2),
('CAD', 'Tue', 18, 2),
('경영과학', 'Wed', 9, 2),
('통계적품질관리', 'Wed', 11, 2),
('생산관리', 'Wed', 16, 2),
('컴퓨터시뮬레이션', 'Wed', 18, 2),
('CAD', 'Thu', 16, 2),
('일반물리학1', 'Fri', 9, 2),
('미분적분학1', 'Fri', 11, 2);

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
(111111111, 105),
(111111111, 103),
(111111111, 102),
(111111111, 104),
(111111111, 106),
(111111111, 107);

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
(111111111, 'test', '*89C6B530AA78695E257E55D63C00A6EC9AD3E977', '00-30-67-b3-e6-2c', 0, '컴퓨터공학과'),
(0, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'ee-ee-ee-ee-ee-ee', 1, 'CSE'),
(111111112, '테스트2', 'test', '00-00-00-00-00-00', 0, '컴퓨터공학과');
