-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 �?05 �?16 �?16:44
-- 服务器版本: 5.5.25
-- PHP 版本: 5.5.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `excel`
--

-- --------------------------------------------------------

--
-- 表的结构 `sz_member`
--

CREATE TABLE IF NOT EXISTS `sz_member` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `truename` varchar(50) NOT NULL,
  `sex` int(1) DEFAULT '0',
  `password` char(32) NOT NULL,
  `res_id` int(11) DEFAULT NULL COMMENT '院系 id',
  `sp_id` int(11) DEFAULT NULL COMMENT '专业id',
  `class` varchar(15) NOT NULL COMMENT '班别',
  `year` varchar(15) DEFAULT NULL,
  `company` varchar(25) DEFAULT NULL COMMENT '公司',
  `zhicheng` varchar(10) DEFAULT NULL,
  `zhiwu` varchar(10) DEFAULT NULL,
  `jibie` char(5) DEFAULT NULL,
  `honor` text,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  `tel` int(15) DEFAULT NULL,
  `qq` int(15) DEFAULT NULL,
  `province` char(10) DEFAULT NULL,
  `city` char(12) DEFAULT NULL,
  `county` char(6) DEFAULT NULL,
  `join` int(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `role_id` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- 转存表中的数据 `sz_member`
--

INSERT INTO `sz_member` (`id`, `account`, `truename`, `sex`, `password`, `res_id`, `sp_id`, `class`, `year`, `company`, `zhicheng`, `zhiwu`, `jibie`, `honor`, `last_login_time`, `last_login_ip`, `login_count`, `email`, `tel`, `qq`, `province`, `city`, `county`, `join`, `remark`, `create_time`, `update_time`, `status`, `role_id`) VALUES
(85, '韦小宝', '韦小宝', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, '11', '计科本083', '钦州市', '广西钦州市树正网络科', '工程师', '经理', '副处', 0, '127.0.0.1', 0, '774294449@qq.com', 5987765, 774294448, NULL, '2008', NULL, 0, '顶替', 127, 0, 0, 0);
