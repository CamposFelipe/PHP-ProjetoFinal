-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Nov-2017 às 03:56
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lojainfo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` bigint(20) NOT NULL,
  `nomeCompleto` varchar(200) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `dataNasc` varchar(100) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `endereco` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nomeCompleto`, `sexo`, `dataNasc`, `telefone`, `endereco`) VALUES
(18, 'Jose Silva', 'Masculino', '1992-10-21', 9980807506, 'Av.rio Grande Do Sul N.1528'),
(19, 'Rosa Flores', 'Feminino', '1985-06-12', 985924585, 'Rua Almirante n.10'),
(20, 'Pedro Bittencourt', 'Masculino', '2000-05-10', 991408658, 'Rua Porto Alegre n.726'),
(21, 'Adriana Prado', 'Feminino', '1995-07-07', 984561548, 'Rua Coronel Camisao n.528');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` bigint(20) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `vendas` int(11) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `salario` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `cargo`, `vendas`, `telefone`, `salario`) VALUES
(8, 'Thiago Fortes', 'Dono', 999, '51983119167', 4000),
(9, 'Felipe Campos', 'Dono', 999, '985926408', 4000),
(10, 'Andrã© Lisboa', 'Atendente', 35, '998070656', 1500),
(11, 'Andriele Nunes', 'Atendente', 127, '985694702', 1500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProd` bigint(20) NOT NULL,
  `nomeProd` varchar(200) NOT NULL,
  `valorProd` float NOT NULL,
  `marcaProd` varchar(200) NOT NULL,
  `classeProd` varchar(200) NOT NULL,
  `quantEstoque` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProd`, `nomeProd`, `valorProd`, `marcaProd`, `classeProd`, `quantEstoque`) VALUES
(4, 'Processador Core I5 Lga 1151', 778.81, 'Inter', 'Hardware', 500),
(5, 'Geforce Gtx 1080 Ti', 4595, 'Gigabyte', 'Hardware', 199),
(6, 'Memoria Kingston Hyperx Fury 8gb 2400mhz Ddr4', 500, 'Hyperx', 'Hardware', 999),
(7, 'Fonte Corsair 750w 80 Plus Bronze Cx750', 399, 'Corsair', 'Hardware', 699),
(8, 'Placa-mae Msi P/ Intel, Lga 1151 Atx Z270 Sli Plus Ddr4', 859.95, 'Msi', 'Hardware', 300),
(9, 'Teclado Ck104', 250, 'Motospeed', 'Periferico', 800),
(10, 'Mouse Gamer Razer Deathadder Essential Ã“ptico 5 Botoes 4g 6400dpi', 340, 'Razer', 'Periferico', 500),
(11, 'Headset Gamer Hyperx Revolver S 7.1 Dolby Digital Hx-hscrs-gm/la', 799.99, 'Hyperx', 'Periferico', 300);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` bigint(20) NOT NULL,
  `login` varchar(200) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `tipo`) VALUES
(1, 'Loja', 'e3a84d2e844bf7862a2549e8904ffde3', 'Adm'),
(12, 'Teste', '96cf70c73fa8c64dbf29b2b3c42d2c63', 'Usuario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProd`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProd` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
