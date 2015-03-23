-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Mar-2015 às 21:28
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imestre`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL,
  `nomeAluno` varchar(255) DEFAULT NULL,
  `emailAluno` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAluno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `idAvaliacao` int(11) NOT NULL,
  `idTurma` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idAvaliacao`),
  KEY `idTurma` (`idTurma`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `nomeDisciplina` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idDisciplina`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ementa`
--

CREATE TABLE IF NOT EXISTS `ementa` (
  `idEmenta` int(11) NOT NULL,
  `idDisciplina` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEmenta`),
  KEY `idDisciplina` (`idDisciplina`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `idInstituicao` int(11) NOT NULL AUTO_INCREMENT,
  `nomeInstituicao` varchar(255) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `telContato` varchar(11) DEFAULT NULL,
  `media` double DEFAULT NULL,
  PRIMARY KEY (`idInstituicao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemavaliacao`
--

CREATE TABLE IF NOT EXISTS `itemavaliacao` (
  `idAvaliacao` int(11) NOT NULL DEFAULT '0',
  `idQuestao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAvaliacao`,`idQuestao`),
  KEY `idQuestao` (`idQuestao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemcurriculo`
--

CREATE TABLE IF NOT EXISTS `itemcurriculo` (
  `idItemCurriculo` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text,
  `ano` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`idItemCurriculo`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemementa`
--

CREATE TABLE IF NOT EXISTS `itemementa` (
  `idItemEmenta` int(11) NOT NULL,
  `idEmenta` int(11) DEFAULT NULL,
  `indice` int(11) DEFAULT NULL,
  `conteudo` text,
  PRIMARY KEY (`idItemEmenta`),
  KEY `idEmenta` (`idEmenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `planejaementa`
--

CREATE TABLE IF NOT EXISTS `planejaementa` (
  `idTurma` int(11) NOT NULL DEFAULT '0',
  `idItemEmenta` int(11) NOT NULL DEFAULT '0',
  `previsto` date DEFAULT NULL,
  `realizado` date DEFAULT NULL,
  PRIMARY KEY (`idTurma`,`idItemEmenta`),
  KEY `idItemEmenta` (`idItemEmenta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProfessor` varchar(100) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `tituloMax` int(11) DEFAULT NULL,
  `areaAtuacao` varchar(50) DEFAULT NULL,
  `nivelAtuacao` int(11) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telCel` varchar(11) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`idProfessor`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE IF NOT EXISTS `questao` (
  `idQuestao` int(11) NOT NULL,
  `idDisciplina` int(11) DEFAULT NULL,
  `enunciado` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `resposta` text,
  `alternativas` text,
  PRIMARY KEY (`idQuestao`),
  KEY `idDisciplina` (`idDisciplina`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responde`
--

CREATE TABLE IF NOT EXISTS `responde` (
  `idAluno` int(11) NOT NULL DEFAULT '0',
  `idAvaliacao` int(11) NOT NULL DEFAULT '0',
  `conceito` double DEFAULT NULL,
  PRIMARY KEY (`idAluno`,`idAvaliacao`),
  KEY `idAvaliacao` (`idAvaliacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalha`
--

CREATE TABLE IF NOT EXISTS `trabalha` (
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  `idInstituicao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProfessor`,`idInstituicao`),
  KEY `idInstituicao` (`idInstituicao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `idTurma` int(11) NOT NULL AUTO_INCREMENT,
  `idInstituicao` int(11) DEFAULT NULL,
  `idDisciplina` int(11) DEFAULT NULL,
  `nomeTurma` varchar(20) DEFAULT NULL,
  `cargaHoraria` int(11) DEFAULT NULL,
  `periodo` int(11) DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTurma`),
  KEY `idInstituicao` (`idInstituicao`),
  KEY `idDisciplina` (`idDisciplina`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
