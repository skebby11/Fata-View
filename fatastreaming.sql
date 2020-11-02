-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2020 alle 14:09
-- Versione del server: 5.6.33-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_fatastreaming2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `episodi`
--

CREATE TABLE IF NOT EXISTS `episodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stagione` int(11) NOT NULL,
  `episodio` int(11) NOT NULL,
  `serie` int(11) NOT NULL,
  `titolo` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `linksv` varchar(150) NOT NULL,
  `linkmd` varchar(50) NOT NULL,
  `linkgu` varchar(50) NOT NULL,
  `fataplayer` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=558 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `epseen`
--

CREATE TABLE IF NOT EXISTS `epseen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `serie` int(11) NOT NULL,
  `epid` int(11) NOT NULL,
  `date` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=500 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `fataplayer`
--

CREATE TABLE IF NOT EXISTS `fataplayer` (
  `id` varchar(10) NOT NULL,
  `fpmp4` varchar(100) NOT NULL,
  `fpposter` varchar(100) NOT NULL,
  `fpwebm` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) NOT NULL,
  `descr` varchar(1500) NOT NULL,
  `poster` varchar(150) NOT NULL,
  `link` varchar(30) NOT NULL,
  `linksv` varchar(30) NOT NULL,
  `linkverys` varchar(50) NOT NULL,
  `linkmd` varchar(30) NOT NULL,
  `linkgu` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `serie`
--

CREATE TABLE IF NOT EXISTS `serie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `descr` varchar(1500) NOT NULL,
  `poster` varchar(150) NOT NULL,
  `stagioni` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2364 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
