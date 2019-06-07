-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jun-2019 às 01:31
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alocacao`
--

CREATE TABLE `alocacao` (
  `id` int(11) NOT NULL,
  `fk_material` varchar(50) NOT NULL,
  `fk_localizacao` varchar(30) NOT NULL,
  `quantidade` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alocacao`
--

INSERT INTO `alocacao` (`id`, `fk_material`, `fk_localizacao`, `quantidade`) VALUES
(24, 'Gabinete', 'Bau B ', 89),
(25, 'Gabinete', 'Gaveta A.6 ', 56),
(26, 'Material teste ', 'Gaveta A.5 ', 99),
(27, 'Material teste ', 'Bau C ', 146),
(28, 'Dispositivo movel', 'Gaveta A.2 ', 33),
(29, 'Dispositivo movel ', 'Bau B ', 40),
(30, 'Dispositivo movel ', 'Bau C ', 169),
(32, 'Gabinete', 'Gaveta B.2', 34),
(33, 'Gabinete', 'Bau C', 46),
(34, 'Mouse', 'Gaveta A.1', 11),
(35, 'Mouse', 'Gaveta A.5', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL,
  `nome_modelo` varchar(20) NOT NULL,
  `fk_codigo` varchar(12) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `nome_modelo`, `fk_codigo`, `usuario`, `email`, `data_inicio`, `data_fim`) VALUES
(2, '', '232323', 'joao', 'joao@gmail.com', '2019-02-08', '2019-03-08'),
(3, 'Dell', '2323232', 'Luciano Araujo Menes', 'luciano@gmail.com', '2019-05-23', '2019-05-25'),
(4, 'SAMSUNG 8987', '12345', 'Luciano Araujo Meneses', 'luciano@gmail.com', '2019-05-09', '2019-05-10'),
(5, 'SAMSUNG 8987', '2323232', 'Luciano', 'admin@admin.com', '2019-05-24', '2019-05-25'),
(6, 'dell', '090909090909', 'Luciano', 'admin@admin.com', '2019-05-03', '2019-05-04'),
(7, 'Dell', '2323232', 'Luciano', 'luciano@gmail.com', '2019-05-24', '2019-05-28'),
(8, 'Dell', '300000', 'Luciano', 'admin@admin.com', '2019-05-25', '2019-05-27'),
(9, 'Dell', '300000', 'Luciano', 'luciano@gmail.com', '2019-05-25', '2019-05-31'),
(10, 'Galaxy', '12345', 'Luciano Meneses', 'lucianomeneses621@gmail.com', '2019-05-24', '2019-05-29'),
(11, 'Samsung', '892546', 'Luciano Araujo Meneses', 'luciano@gmail.com', '2019-05-31', '2019-06-01'),
(12, 'Samsung', '892546', 'Luciano Araujo Meneses', 'luciano@gmail.com', '2019-05-31', '2019-06-01'),
(13, 'Samsung', '892546', 'Luciano', 'luciano@gmail.com', '2019-05-23', '2019-05-24'),
(14, 'Samsung', '892546', 'Luciano', 'luciano@gmail.com', '2019-05-23', '2019-05-24'),
(15, 'Teste', '333445566778', 'Luciano', 'luciano@gmail.com', '2019-05-25', '2019-05-27'),
(16, 'Teste', '333445566778', 'Luciano', 'luciano@gmail.com', '2019-05-25', '2019-05-27'),
(17, 'SAMSUNG 8987', '99845627', 'Luciano', 'luciano@gmail.com', '2019-05-26', '2019-05-27'),
(18, 'Samsung', '11111111111', 'Luciano', 'luciano@gmail.com', '2019-05-27', '2019-05-28'),
(19, 'Samsung', '11111111111', 'Luciano Araujo Meneses', 'luciano@gmail.com', '2019-05-08', '2019-05-15'),
(20, 'Samsung', '222222222222', 'Luciano', 'luciano@gmail.com', '2019-05-27', '2019-05-28'),
(21, 'Samsung', '222222222222', 'Luciano', 'admin@admin.com', '2019-05-27', '2019-05-28'),
(22, 'Samsung', '222222222222', 'Luciano', 'admin@admin.com', '2019-05-27', '2019-05-28'),
(23, 'Samsung', '111111111111', 'Luciano Meneses', 'admin@admin.com', '2019-05-27', '2019-05-28'),
(24, 'Samsung', '4444444444', 'Luciano', 'luciano@gmail.com', '2019-05-27', '2019-05-28'),
(25, 'srererer', 'rererer', 'Luciano Araujo Meneses', 'luciano@gmail.com', '2019-05-28', '2019-05-29'),
(26, 'srererer', 'rererer', 'Luciano Araujo Meneses', 'luciano@gmail.com', '2019-05-28', '2019-05-29'),
(27, 'Samsung', '333333333333', 'Luciano', 'luciano@gmail.com', '2019-05-27', '2019-05-28'),
(28, 'Samsung', '444444444', 'Luciano', 'luciano@gmail.com', '2019-05-27', '2019-05-29'),
(29, 'Lenovo', '345532', 'Luciano', 'luciano@gmail.com', '2019-05-28', '2019-05-29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome_modelo` varchar(20) NOT NULL,
  `codigo` varchar(12) NOT NULL,
  `situacao` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome_modelo`, `codigo`, `situacao`) VALUES
(1, 'dell', ' 09090909', 'Indisponivel'),
(2, '90909090909', '090909090909', 'Disponivel'),
(22, 'Samsung', '11111111111', 'Indisponivel'),
(25, 'Samsung', '111111111111', 'Indisponivel'),
(3, 'Galaxy', '12345', 'Indisponivel'),
(23, 'Samsung', '222222222222', 'Indisponivel'),
(4, 'Material', '232323', 'Disponivel'),
(5, 'novo not ', '2323232', 'Disponivel'),
(6, 'Dell', '300000', 'Indisponivel'),
(26, 'Samsung', '333333333333', 'Indisponivel'),
(7, 'Teste', '333445566778', 'Indisponivel'),
(8, 'novo', '3434343', 'Disponivel'),
(9, 'SAMSUNG 8987', '3446565', 'Indisponivel'),
(28, 'Lenovo', '345532', 'Indisponivel'),
(10, 'kakakakkakakakakka', '363663636363', 'Disponivel'),
(29, 'Novo  equipamento', '4353737', 'Disponivel'),
(24, 'Samsung', '444444444', 'Indisponivel'),
(27, 'Samsung', '4444444444', 'Indisponivel'),
(11, 'dfdfd', '4545454', 'Disponivel'),
(12, 'hgh', '454545t', 'Disponivel'),
(13, 'Galaxy', '54321', 'Indisponivel'),
(30, 'Samsung', '888888888', 'Disponivel'),
(14, 'Samsung', '892546', 'Indisponivel'),
(15, 'Notbook ', '899876', 'Disponivel'),
(16, 'SAMSUNG 8987', '99845627', 'Indisponivel'),
(17, '9999999999', '999999999999', 'Disponivel'),
(18, 'cdcdcd', 'cdcd', 'Disponivel'),
(19, 'cdcdc', 'cdcdc', 'Disponivel'),
(20, 'uiuiyiu', 'jjgjhg', 'Disponivel'),
(21, 'srererer', 'rererer', 'Indisponivel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

CREATE TABLE `localizacao` (
  `localizacao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`localizacao`) VALUES
('Bau A'),
('Bau B'),
('Bau C'),
('Gaveta A.1'),
('Gaveta A.2'),
('Gaveta A.3'),
('Gaveta A.4'),
('Gaveta A.5'),
('Gaveta A.6'),
('Gaveta B.1'),
('Gaveta B.2'),
('Gaveta B.3'),
('Gaveta B.4'),
('Gaveta B.5'),
('Gaveta B.6'),
('Gaveta C.1'),
('Gaveta C.2'),
('Gaveta C.3'),
('Gaveta C.4'),
('Gaveta C.5'),
('Gaveta C.6'),
('Prateleira A.1'),
('Prateleira A.2'),
('Prateleira A.3'),
('Prateleira A.4'),
('Prateleira B.1'),
('Prateleira B.2'),
('Prateleira B.3'),
('Prateleira B.4'),
('Prateleira C.1'),
('Prateleira C.2'),
('Prateleira C.3'),
('Prateleira C.4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `nome_modelo` varchar(50) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `fk_tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `material`
--

INSERT INTO `material` (`id`, `nome_modelo`, `descricao`, `fk_tipo`) VALUES
(107, 'Dispositivo movel', 'usado', 'Telefonia'),
(112, 'Estabilizador', '', 'Hardware '),
(105, 'Gabinete', 'Teste concluido', 'Hardware'),
(113, 'Material 123', 'DescriÃ§Ã£o', 'Hardware'),
(106, 'Material teste', 'desc', 'Telefonia '),
(111, 'Motorola', 'Celular para teste', 'Telefonia'),
(114, 'Mouse', 'descricao', 'Impressao ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_material`
--

CREATE TABLE `tipo_material` (
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_material`
--

INSERT INTO `tipo_material` (`tipo`) VALUES
('Hardware'),
('Impressao'),
('Telefonia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `matricula` varchar(15) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`matricula`, `nome`, `email`, `usuario`, `senha`) VALUES
('123456', 'admin', 'admin@admin.com', 'admin', '123456'),
('404711', 'Luciano Meneses', 'luciano@gmail.com', 'Luciano', '123456'),
('654321', 'joao', 'joao@gmail.com', 'joao', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alocacao`
--
ALTER TABLE `alocacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_material` (`fk_material`),
  ADD KEY `fk_localizacao` (`fk_localizacao`);

--
-- Indexes for table `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service_tag` (`fk_codigo`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `localizacao`
--
ALTER TABLE `localizacao`
  ADD PRIMARY KEY (`localizacao`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`nome_modelo`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`tipo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matricula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alocacao`
--
ALTER TABLE `alocacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alocacao`
--
ALTER TABLE `alocacao`
  ADD CONSTRAINT `fk_localizacao` FOREIGN KEY (`fk_localizacao`) REFERENCES `localizacao` (`localizacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_material` FOREIGN KEY (`fk_material`) REFERENCES `material` (`nome_modelo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`fk_codigo`) REFERENCES `equipamento` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
