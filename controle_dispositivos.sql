-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/02/2025 às 13:49
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle_dispositivos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `tipo` enum('Servidor','Roteador','Switch','Outro') NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dispositivos`
--

INSERT INTO `dispositivos` (`id`, `hostname`, `ip`, `tipo`, `fabricante`, `modelo`, `ativo`, `data_cadastro`) VALUES
(1, 'Servidor01', '192.168.1.10', 'Servidor', 'Dell', 'PowerEdge R740', 1, '2025-02-05 11:32:58'),
(2, 'Roteador01', '192.168.1.1', 'Roteador', 'Cisco', 'RV340', 1, '2025-02-05 11:32:58'),
(3, 'Switch01 ab', '192.168.1.20', 'Switch', 'HP', 'Aruba 2930F', 1, '2025-02-05 11:32:58'),
(4, 'Modem Huawei', '192.168.18.1', 'Roteador', 'Huawei', 'HUB2424', 1, '2025-02-08 15:28:46'),
(5, 'hub01', '127.0.0.1', 'Roteador', 'Apple', 'Test3 0123', 1, '2025-02-10 15:57:11'),
(8, 'Switch01 ab', '127.0.0.2', 'Servidor', 'Teste', 'HUB2424', 1, '2025-02-10 16:44:41');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
