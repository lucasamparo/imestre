-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jun-2015 às 19:29
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
  `nomeAluno` varchar(255) DEFAULT NULL,
  `emailAluno` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `nomeAluno`, `emailAluno`) VALUES
(1, 'Fulano de Tal Silveira', 'fulaninho_1993@hotmail.com'),
(2, 'Lucas Amparo Barbosa', 'lucasamparo.ti@gmail.com');

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
  KEY `idAlunoTurma` (`idAluno`),
  KEY `idTurmaAluno` (`idTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `alunoturma`
--

INSERT INTO `alunoturma` (`idAlunoTurma`, `idAluno`, `idTurma`, `ano`) VALUES
(1, 1, 1, '2015'),
(4, 2, 1, '2015');

-- --------------------------------------------------------

--
-- Estrutura da tabela `areamaior`
--

CREATE TABLE IF NOT EXISTS `areamaior` (
  `idAreaMaior` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArea` varchar(100) NOT NULL,
  PRIMARY KEY (`idAreaMaior`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `areamaior`
--

INSERT INTO `areamaior` (`idAreaMaior`, `nomeArea`) VALUES
(1, 'Ciências Exatas e da Terra'),
(2, 'Ciências Biológicas'),
(3, 'Engenharias'),
(4, 'Ciências da Saúde'),
(5, 'Ciências Agrárias'),
(6, 'Ciências Sociais Aplicadas'),
(7, 'Ciências Humanas'),
(8, 'Linguística, Letras e Artes'),
(9, 'Outros');

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

--
-- Extraindo dados da tabela `areamenor`
--

INSERT INTO `areamenor` (`idAreaMenor`, `idAreaMaior`, `nomeArea`) VALUES
(1, 1, 'Matemática'),
(2, 2, 'Biologia Geral'),
(3, 3, 'Engenharia Civil'),
(4, 4, 'Medicina'),
(5, 5, 'Agronomia'),
(6, 6, 'Direito'),
(7, 7, 'Filosofia'),
(8, 8, 'Lingüística'),
(9, 9, 'Bioética'),
(10, 1, 'Probabilidade e Estatística'),
(11, 1, 'Ciência da Computação'),
(12, 1, 'Astronomia'),
(13, 1, 'Física'),
(14, 1, 'Química'),
(15, 1, 'Geociências'),
(16, 1, 'Oceanografia'),
(17, 2, 'Genética'),
(18, 2, 'Botânica'),
(19, 2, 'Zoologia'),
(20, 2, 'Ecologia'),
(21, 2, 'Morfologia'),
(22, 2, 'Fisiologia'),
(23, 2, 'Bioquímica'),
(24, 2, 'Biofísica'),
(25, 2, 'Farmacologia'),
(26, 2, 'Imunologia'),
(27, 2, 'Microbiologia'),
(28, 2, 'Parasitologia'),
(29, 3, 'Engenharia de Minas'),
(30, 3, 'Engenharia de Materiais e Metalúrgica'),
(31, 3, 'Engenharia Elétrica'),
(32, 3, 'Engenharia Mecânica'),
(33, 3, 'Engenharia Química'),
(34, 3, 'Engenharia Sanitária'),
(35, 3, 'Engenharia de Produção'),
(36, 3, 'Engenharia Nuclear'),
(37, 3, 'Engenharia de Transportes'),
(38, 3, 'Engenharia Naval e Oceânica'),
(39, 3, 'Engenharia Aeroespacial'),
(40, 3, 'Engenharia Biomédica'),
(41, 4, 'Odontologia'),
(42, 4, 'Farmácia'),
(43, 4, 'Enfermagem'),
(44, 4, 'Nutrição'),
(45, 4, 'Saúde Coletiva'),
(46, 4, 'Fonoaudiologia'),
(47, 4, 'Fisioterapia e Terapia Ocupacional'),
(48, 4, 'Educação Física'),
(49, 5, 'Recursos Florestais e Engenharia Florestal'),
(50, 5, 'Engenharia Agrícola'),
(51, 5, 'Zootecnia'),
(52, 5, 'Medicina Veterinária'),
(53, 5, 'Recursos Pesqueiros e Engenharia de Pesca'),
(54, 5, 'Ciência e Tecnologia de Alimentos'),
(55, 6, 'Administração'),
(56, 6, 'Economia'),
(57, 6, 'Arquitetura e Urbanismo'),
(58, 6, 'Planejamento Urbano e Regional'),
(59, 6, 'Demografia'),
(60, 6, 'Ciência da Informação'),
(61, 6, 'Museologia'),
(62, 6, 'Comunicação'),
(63, 6, 'Serviço Social'),
(64, 6, 'Economia Doméstica'),
(65, 6, 'Desenho Industrial'),
(66, 6, 'Turismo'),
(67, 7, 'Sociologia'),
(68, 7, 'Antropologia'),
(69, 7, 'Arqueologia'),
(70, 7, 'História'),
(71, 7, 'Geografia'),
(72, 7, 'Psicologia'),
(73, 7, 'Educação'),
(74, 7, 'Ciência Política'),
(75, 7, 'Teologia'),
(76, 8, 'Letras'),
(77, 8, 'Artes'),
(78, 9, 'Ciências Ambientais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

CREATE TABLE IF NOT EXISTS `assunto` (
  `idAssunto` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) NOT NULL,
  `nomeAssunto` varchar(255) NOT NULL,
  PRIMARY KEY (`idAssunto`),
  KEY `idDisciplina` (`idDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`idAssunto`, `idDisciplina`, `nomeAssunto`) VALUES
(2, 3, 'Diagramas UML'),
(3, 1, 'Acentuação'),
(4, 1, 'Concordância Nominal');

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
  KEY `idTurmaAvaliacao` (`idTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`idAvaliacao`, `idTurma`, `peso`, `data`) VALUES
(3, 1, 10, '2015-06-20');

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
  KEY `idAreaMenor` (`idAreaMenor`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `idAreaMenor`, `idProfessor`, `nomeDisciplina`) VALUES
(1, 8, 1, 'Português Instrumental'),
(2, 1, 1, 'Matemática Financeira'),
(3, 11, 1, 'Engenharia de Software'),
(6, 2, 1, 'Ciências'),
(7, 11, 1, 'Lógica de Programação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ementa`
--

CREATE TABLE IF NOT EXISTS `ementa` (
  `idEmenta` int(11) NOT NULL AUTO_INCREMENT,
  `idDisciplina` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEmenta`),
  KEY `idDisciplinaEmenta` (`idDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `ementa`
--

INSERT INTO `ementa` (`idEmenta`, `idDisciplina`, `ano`) VALUES
(1, 1, 2015),
(22, 1, 2014),
(23, 1, 2013);

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
  KEY `idFrequenciaAluno_idx` (`idAluno`),
  KEY `idPlanejamentoAluno_idx` (`idPlanejamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `frequencia`
--

INSERT INTO `frequencia` (`idFrequencia`, `idAluno`, `idPlanejamento`, `presenca`) VALUES
(1, 1, 1, 'P'),
(2, 1, 2, 'A'),
(3, 2, 1, 'A'),
(4, 2, 2, 'P');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `idInstituicao` int(11) NOT NULL AUTO_INCREMENT,
  `idProfessor` int(11) DEFAULT NULL,
  `nomeInstituicao` varchar(255) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `telContato` varchar(11) DEFAULT NULL,
  `media` double DEFAULT NULL,
  PRIMARY KEY (`idInstituicao`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`idInstituicao`, `idProfessor`, `nomeInstituicao`, `logradouro`, `numero`, `bairro`, `cidade`, `telContato`, `media`) VALUES
(1, 1, 'Instituto Federal de Educação, Ciência e Tecnologia da Bahia', 'av. amazonas', 's/n', 'zabele', 'Vitória da Conquista', '7788046634', 7),
(2, 1, 'Anísio Teixeira', 'Av. da Integração', 's/n', 'Centro', 'Vitória da Conquista', '7734261144', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemavaliacao`
--

CREATE TABLE IF NOT EXISTS `itemavaliacao` (
  `idAvaliacao` int(11) NOT NULL DEFAULT '0',
  `idQuestao` int(11) NOT NULL DEFAULT '0',
  `indice` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAvaliacao`,`idQuestao`),
  KEY `idAvaliacaoQuestao` (`idQuestao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemavaliacao`
--

INSERT INTO `itemavaliacao` (`idAvaliacao`, `idQuestao`, `indice`) VALUES
(3, 6, 3),
(3, 8, 1),
(3, 9, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `itemcurriculo`
--

INSERT INTO `itemcurriculo` (`idItemCurriculo`, `idProfessor`, `titulo`, `conteudo`, `ano`) VALUES
(1, 1, 'Cadastro Teste', 'este é um cadastro de teste, para verificar a leitura do Doctrine.', '2015'),
(2, 1, 'Cadastro Teste via GUI', 'Esse é um cadastro de teste feito pela GUI.', '2015');

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
  KEY `idItemEmenta` (`idEmenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `itemementa`
--

INSERT INTO `itemementa` (`idItemEmenta`, `idEmenta`, `indice`, `conteudo`) VALUES
(1, 1, 1, 'Teste de Lançamento'),
(12, 22, 1, 'teste de conteudo'),
(13, 22, 2, 'segundo teste de conteudo'),
(17, 23, 1, 'Teste de cadastro'),
(18, 23, 2, 'teste de cadastro'),
(19, 23, 3, 'Novo Item de Cadastro');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `planejaementa`
--

INSERT INTO `planejaementa` (`idPlanejaEmenta`, `idTurma`, `idItemEmenta`, `previsto`, `realizado`, `cargaHoraria`) VALUES
(1, 1, 17, '2015-05-02', NULL, NULL),
(2, 1, 18, '2015-05-03', NULL, NULL),
(3, 1, 19, '2015-06-05', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nomeProfessor`, `nascimento`, `tituloMax`, `areaAtuacao`, `nivelAtuacao`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `email`, `telCel`, `login`, `senha`) VALUES
(1, 'Professor Pardal', '1960-01-01', 2, 'Engenharia Mecânica', 4, 'Rua 23 de Julho', '20', 'Ibirapuera', 'Vitória da Conquista', 'BA', 'Brasil', '45075420', 'pardal@gmail.com', '7788046634', 'pardal', 'd9febbbc5ba9dc18d580774804c437b9');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`idQuestao`, `idAssunto`, `privacidade`, `enunciado`, `tipo`, `resposta`, `alternativas`) VALUES
(6, 3, 0, 'Qual a função do ~ (til)?', 0, 'Aplicar som nasal em palavras que não o possuem.', NULL),
(7, 2, 1, 'Qual diagrama apresenta os casos típicos que o sistema irá implementar?', 1, 'Caso de uso', 'Caso de uso; Sequência; Atividade; Implementação; Classes'),
(8, 3, 0, 'Associe as colunas:', 2, NULL, '{"C1":"Til;\nAcento Agudo;\nAcento Circunflexo;\nCrase;","C2":"Aplicar som nasal;\nSílaba tônica aberta;\nSílaba tônica fechada;\nJunção de duas vogais idênticas;"}'),
(9, 3, 0, 'Qual palavra o acento agudo está aplicado de forma ERRADA?', 1, 'publíca', 'publíca; pública; múltipla; está; mórbida');

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
  KEY `idTurmaInstituicao` (`idInstituicao`),
  KEY `idTurmaDisciplina` (`idDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `idInstituicao`, `idDisciplina`, `nomeTurma`, `cargaHoraria`, `periodo`, `turno`) VALUES
(1, 2, 1, 'PI1Sem', 60, 0, 1);

--
-- Constraints for dumped tables
--

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
