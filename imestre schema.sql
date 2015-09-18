-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Set-2015 às 21:32
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
CREATE DATABASE IF NOT EXISTS `imestre` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `imestre`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) DEFAULT NULL,
  `nomeAluno` varchar(255) DEFAULT NULL,
  `emailAluno` varchar(255) DEFAULT NULL,
  `parecer` text,
  PRIMARY KEY (`idAluno`),
  UNIQUE KEY `idProfessor` (`idProfessor`,`emailAluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunoturma`
--

CREATE TABLE IF NOT EXISTS `alunoturma` (
  `idAlunoTurma` int(11) NOT NULL AUTO_INCREMENT,
  `idAluno` int(11) DEFAULT NULL,
  `idTurma` int(11) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idAlunoTurma`),
  UNIQUE KEY `idAluno` (`idAluno`,`idTurma`,`ano`),
  KEY `idTurmaAluno` (`idTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `areamaior`
--

CREATE TABLE IF NOT EXISTS `areamaior` (
  `idAreaMaior` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArea` varchar(100) NOT NULL,
  PRIMARY KEY (`idAreaMaior`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `areamenor`
--

CREATE TABLE IF NOT EXISTS `areamenor` (
  `idAreaMenor` int(11) NOT NULL AUTO_INCREMENT,
  `idAreaMaior` int(11) NOT NULL,
  `nomeArea` text NOT NULL,
  PRIMARY KEY (`idAreaMenor`),
  KEY `idAreaMaior` (`idAreaMaior`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

CREATE TABLE IF NOT EXISTS `assunto` (
  `idAssunto` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) NOT NULL,
  `nomeAssunto` varchar(255) NOT NULL,
  PRIMARY KEY (`idAssunto`),
  UNIQUE KEY `idDisciplina` (`idDisciplina`,`nomeAssunto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `idTurma` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idAvaliacao`),
  UNIQUE KEY `idTurma` (`idTurma`,`data`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE IF NOT EXISTS `chamado` (
  `idChamado` int(11) NOT NULL AUTO_INCREMENT,
  `dataChamado` date NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `resposta` text NOT NULL,
  `status` enum('A','E','R','F') NOT NULL,
  PRIMARY KEY (`idChamado`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `idAreaMenor` int(11) DEFAULT NULL,
  `idProfessor` int(11) DEFAULT NULL,
  `nomeDisciplina` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idDisciplina`),
  UNIQUE KEY `idProfessor` (`idProfessor`,`nomeDisciplina`),
  KEY `idAreaMenor` (`idAreaMenor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ementa`
--

CREATE TABLE IF NOT EXISTS `ementa` (
  `idEmenta` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idEmenta`),
  UNIQUE KEY `idDisciplina` (`idDisciplina`,`ano`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE IF NOT EXISTS `frequencia` (
  `idFrequencia` int(11) NOT NULL AUTO_INCREMENT,
  `idAluno` int(11) DEFAULT NULL,
  `idPlanejamento` int(11) DEFAULT NULL,
  `presenca` enum('P','A') DEFAULT NULL,
  PRIMARY KEY (`idFrequencia`),
  UNIQUE KEY `idAluno` (`idAluno`,`idPlanejamento`),
  KEY `idFrequenciaAluno_idx` (`idAluno`),
  KEY `idPlanejamentoAluno_idx` (`idPlanejamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionalidades`
--

CREATE TABLE IF NOT EXISTS `funcionalidades` (
  `idFuncionalidades` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) NOT NULL,
  `disco` enum('S','N') NOT NULL DEFAULT 'N',
  `blog` enum('S','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`idFuncionalidades`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `idInstituicao` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) DEFAULT NULL,
  `nomeInstituicao` varchar(255) DEFAULT NULL,
  `funcionamento` text NOT NULL,
  `dias` varchar(7) NOT NULL DEFAULT '0111111',
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `telContato` varchar(11) DEFAULT NULL,
  `media` double DEFAULT NULL,
  PRIMARY KEY (`idInstituicao`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemavaliacao`
--

CREATE TABLE IF NOT EXISTS `itemavaliacao` (
  `idAvaliacao` int(11) NOT NULL DEFAULT '0',
  `idQuestao` int(11) NOT NULL DEFAULT '0',
  `indice` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAvaliacao`,`idQuestao`),
  UNIQUE KEY `idAvaliacao` (`idAvaliacao`,`indice`),
  KEY `idAvaliacaoQuestao` (`idQuestao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  KEY `idProfessorCurriculo` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemementa`
--

CREATE TABLE IF NOT EXISTS `itemementa` (
  `idItemEmenta` int(11) NOT NULL AUTO_INCREMENT,
  `idEmenta` int(11) DEFAULT NULL,
  `indice` int(11) DEFAULT NULL,
  `conteudo` text,
  PRIMARY KEY (`idItemEmenta`),
  UNIQUE KEY `idEmenta` (`idEmenta`,`indice`),
  UNIQUE KEY `idEmenta_2` (`idEmenta`,`indice`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lembrete`
--

CREATE TABLE IF NOT EXISTS `lembrete` (
  `idLembrete` int(11) NOT NULL AUTO_INCREMENT,
  `dataLembrete` date NOT NULL,
  `conteudo` varchar(300) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  PRIMARY KEY (`idLembrete`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `idMensagem` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) DEFAULT NULL,
  `dataHoraEnvio` datetime DEFAULT NULL,
  `destinatarios` text,
  `conteudo` text,
  PRIMARY KEY (`idMensagem`),
  KEY `idMensagemProfessor` (`idProfessor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `planejaementa`
--

CREATE TABLE IF NOT EXISTS `planejaementa` (
  `idPlanejaEmenta` int(11) NOT NULL AUTO_INCREMENT,
  `idTurma` int(11) DEFAULT '0',
  `idItemEmenta` int(11) DEFAULT '0',
  `previsto` date DEFAULT NULL,
  `realizado` date DEFAULT NULL,
  `cargaHoraria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPlanejaEmenta`),
  KEY `idItemPlanejamento` (`idItemEmenta`),
  KEY `idTurmaPlanejamento` (`idTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `lattes` text NOT NULL,
  `validador` varchar(20) NOT NULL,
  `nomeProfessor` varchar(100) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `tituloMax` int(11) DEFAULT NULL,
  `areaAtuacao` varchar(50) DEFAULT NULL,
  `nivelAtuacao` int(11) DEFAULT NULL,
  `horarios` text NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE IF NOT EXISTS `questao` (
  `idQuestao` int(11) NOT NULL AUTO_INCREMENT,
  `idAssunto` int(11) DEFAULT NULL,
  `privacidade` int(1) NOT NULL DEFAULT '0',
  `enunciado` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `resposta` text,
  `alternativas` text,
  PRIMARY KEY (`idQuestao`),
  KEY `idQuestaoDisciplina` (`idAssunto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responde`
--

CREATE TABLE IF NOT EXISTS `responde` (
  `idAluno` int(11) NOT NULL DEFAULT '0',
  `idAvaliacao` int(11) NOT NULL DEFAULT '0',
  `conceito` double DEFAULT NULL,
  PRIMARY KEY (`idAluno`,`idAvaliacao`),
  KEY `idAvaliacaoResponde` (`idAvaliacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalha`
--

CREATE TABLE IF NOT EXISTS `trabalha` (
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  `idInstituicao` int(11) NOT NULL DEFAULT '0',
  `ano` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`idProfessor`,`idInstituicao`),
  KEY `idTrabalhaInstituicao` (`idInstituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  UNIQUE KEY `nomeTurma` (`nomeTurma`),
  KEY `idTurmaInstituicao` (`idInstituicao`),
  KEY `idTurmaDisciplina` (`idDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `alunoturma`
--
ALTER TABLE `alunoturma`
  ADD CONSTRAINT `idAlunoTurma` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTurmaAluno` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `areamenor`
--
ALTER TABLE `areamenor`
  ADD CONSTRAINT `areamenor_ibfk_1` FOREIGN KEY (`idAreaMaior`) REFERENCES `areamaior` (`idAreaMaior`);

--
-- Limitadores para a tabela `assunto`
--
ALTER TABLE `assunto`
  ADD CONSTRAINT `assunto_ibfk_1` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `idTurmaAvaliacao` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `chamado`
--
ALTER TABLE `chamado`
  ADD CONSTRAINT `chamado_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`idAreaMenor`) REFERENCES `areamenor` (`idAreaMenor`),
  ADD CONSTRAINT `disciplina_ibfk_2` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `ementa`
--
ALTER TABLE `ementa`
  ADD CONSTRAINT `idDisciplinaEmenta` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `idFrequenciaAluno` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idPlanejamentoAluno` FOREIGN KEY (`idPlanejamento`) REFERENCES `planejaementa` (`idPlanejaEmenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionalidades`
--
ALTER TABLE `funcionalidades`
  ADD CONSTRAINT `funcionalidades_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD CONSTRAINT `instituicao_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `itemavaliacao`
--
ALTER TABLE `itemavaliacao`
  ADD CONSTRAINT `idAvaliacao` FOREIGN KEY (`idAvaliacao`) REFERENCES `avaliacao` (`idAvaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idAvaliacaoQuestao` FOREIGN KEY (`idQuestao`) REFERENCES `questao` (`idQuestao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemcurriculo`
--
ALTER TABLE `itemcurriculo`
  ADD CONSTRAINT `idProfessorCurriculo` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemementa`
--
ALTER TABLE `itemementa`
  ADD CONSTRAINT `idItemEmenta` FOREIGN KEY (`idEmenta`) REFERENCES `ementa` (`idEmenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `lembrete`
--
ALTER TABLE `lembrete`
  ADD CONSTRAINT `lembrete_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`);

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `idMensagemProfessor` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `planejaementa`
--
ALTER TABLE `planejaementa`
  ADD CONSTRAINT `idItemPlanejamento` FOREIGN KEY (`idItemEmenta`) REFERENCES `itemementa` (`idItemEmenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTurmaPlanejamento` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `questao`
--
ALTER TABLE `questao`
  ADD CONSTRAINT `idQuestaoDisciplina` FOREIGN KEY (`idAssunto`) REFERENCES `assunto` (`idAssunto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `responde`
--
ALTER TABLE `responde`
  ADD CONSTRAINT `idAlunoAvaliacao` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idAvaliacaoResponde` FOREIGN KEY (`idAvaliacao`) REFERENCES `avaliacao` (`idAvaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `trabalha`
--
ALTER TABLE `trabalha`
  ADD CONSTRAINT `idTrabalhaInstituicao` FOREIGN KEY (`idInstituicao`) REFERENCES `instituicao` (`idInstituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTrabalhaProfessor` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `idTurmaDisciplina` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTurmaInstituicao` FOREIGN KEY (`idInstituicao`) REFERENCES `instituicao` (`idInstituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
