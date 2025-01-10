-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/01/2025 às 14:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_mvc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_empresa`
--

CREATE TABLE `tbl_empresa` (
  `id_empresa` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_empresa`
--

INSERT INTO `tbl_empresa` (`id_empresa`, `nome`) VALUES
(1, 'Vinicius'),
(2, 'Vinicius LTDA'),
(3, 'Latam LTDA'),
(4, 'Vinicius Braz'),
(5, 'Stephanie');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_funcionario`
--

CREATE TABLE `tbl_funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `data_cadastro` date NOT NULL,
  `salario` double(10,2) NOT NULL,
  `bonificacao` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_funcionario`
--

INSERT INTO `tbl_funcionario` (`id_funcionario`, `nome`, `cpf`, `rg`, `email`, `id_empresa`, `data_cadastro`, `salario`, `bonificacao`) VALUES
(21, 'Bia Locchi treee', '07433565037', '717085888', 'vini_ferreiram@hotmail.com', 4, '2023-01-09', 2350.77, 0.00),
(22, 'Vinicius Braz', '12345678978', '123456789', 'vini_ferreiram77@hotmail.com', 2, '2019-01-10', 2350.90, 0.00),
(23, 'Stephanie', '12345678977', '78012184879', 'vini_ferreiram78@hotmail.com', 3, '2025-01-10', 2350.90, 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `login_email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `login_email`, `senha`) VALUES
(5, 'teste@gmail.com.br', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices de tabela `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
