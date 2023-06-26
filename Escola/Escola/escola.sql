-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Jun-2023 às 22:14
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escola`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `aprovacao` (`nota1` FLOAT, `nota2` FLOAT, `nota3` FLOAT) RETURNS TEXT CHARSET latin1 BEGIN
	DECLARE soma FLOAT;
    SET soma = nota1 + nota2 + nota3;
    SET soma = soma / 3;
    IF soma >= 6.0 THEN
    	RETURN "Aprovado";
    ELSE
    	RETURN "Reprovado";
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `desconto` (`preco` DECIMAL, `desconto` DECIMAL) RETURNS DECIMAL(10,0) BEGIN	
	DECLARE resul DECIMAL;
    SET resul = preco - desconto;
    RETURN resul;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `imposto` (`salario` DECIMAL(10,2)) RETURNS DECIMAL(10,2) BEGIN
	DECLARE imposto DECIMAL(10,2);
    IF salario < 2000 THEN
    	SET imposto = salario * 0.1;
    ELSE
    	SET imposto = salario * 0.2;
    END IF;
    RETURN imposto;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `maior` (`n1` INT, `n2` INT, `n3` INT) RETURNS INT(11) BEGIN
	DECLARE maior INT;
    SET maior = GREATEST(n1, n2, n3);
    RETURN maior;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `nascimento` (`data_nascimento` VARCHAR(10)) RETURNS INT(11) BEGIN
	DECLARE idade INT;
    SET idade = TIMESTAMPDIFF(YEAR, STR_TO_DATE(data_nascimento, '%d/%m/%Y'), CURDATE());
    RETURN idade;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `soma` (`n1` INT, `n2` INT) RETURNS INT(11) BEGIN
	DECLARE resultado INT;
    SET resultado = n1 + n2;
    RETURN resultado;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `registro` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dataNascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`registro`, `nome`, `dataNascimento`) VALUES
(222, 'Luisinho', '1937-02-01'),
(223, 'Gustavo', '2005-07-04'),
(224, 'Lucas', '2006-08-31'),
(225, 'Bob', '1998-03-11'),
(226, 'Roberta', '2000-12-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(3) NOT NULL,
  `nome` varchar(125) NOT NULL,
  `cargaHoraria` int(4) DEFAULT NULL,
  `livro` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `nome`, `cargaHoraria`, `livro`) VALUES
(1, 'invenpatolis', 80, 'Quadrinhos Disney'),
(2, 'Banco de Dados', 80, 'Banco de dados'),
(3, 'POO', 80, 'Java'),
(4, 'Estrutura de Dados', 120, 'algoritmos'),
(5, 'Desenvolvimento Web', 60, 'html,css e js');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `id` int(5) NOT NULL,
  `turma` int(3) DEFAULT NULL,
  `aluno` int(5) DEFAULT NULL,
  `ano` date DEFAULT NULL,
  `nota` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`id`, `turma`, `aluno`, `ano`, `nota`) VALUES
(1, 1, 222, '1950-02-05', NULL),
(2, 1, 223, '2023-07-28', NULL),
(3, 2, 224, '2023-07-28', NULL),
(4, 2, 224, '2023-07-28', NULL),
(5, 6, 226, '2023-07-28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(125) DEFAULT NULL,
  `titulacao` enum('grad','espc','msc','dr') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`codigo`, `nome`, `email`, `titulacao`) VALUES
(90, 'Pardal', 'pardal@disney.com', 'dr'),
(91, 'Davi', 'Davi@ifsc.com', 'dr'),
(92, 'Frank', 'frank@ifsc.com', 'dr'),
(93, 'Alexandre', 'alexandre@ifsc.com', 'dr'),
(94, 'Bruno', 'bruno@ifsc.com', 'dr');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `codigo` int(3) NOT NULL,
  `disciplina` int(5) DEFAULT NULL,
  `sigla` varchar(125) DEFAULT 'CTDS2023-1',
  `nAlunos` int(2) DEFAULT NULL,
  `sala` int(3) DEFAULT NULL,
  `professor` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`codigo`, `disciplina`, `sigla`, `nAlunos`, `sala`, `professor`) VALUES
(1, 1, 'CTDS2023-1', 20, 101, 90),
(2, 1, 'Banco-1', 20, 101, 90),
(3, 1, 'BD2023-1', 20, 101, 90),
(4, 2, 'POO2023-1', 20, 302, 91),
(5, 3, 'Estruc2023-1', 20, 302, 92),
(6, 4, 'Teste2023-1', 20, 302, 92);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`registro`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turma` (`turma`),
  ADD KEY `aluno` (`aluno`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `sigla` (`sigla`),
  ADD KEY `disciplina` (`disciplina`),
  ADD KEY `professor` (`professor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`turma`) REFERENCES `turma` (`codigo`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`aluno`) REFERENCES `aluno` (`registro`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`disciplina`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`professor`) REFERENCES `professor` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
