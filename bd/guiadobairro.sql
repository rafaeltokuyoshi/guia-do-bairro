-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/12/2024 às 23:54
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `guiadobairro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoriaemp`
--

DROP TABLE IF EXISTS `categoriaemp`;
CREATE TABLE IF NOT EXISTS `categoriaemp` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoriaemp`
--

INSERT INTO `categoriaemp` (`id_categoria`, `nomeCategoria`) VALUES
(1, 'Perfumaria'),
(5, 'Lavanderia'),
(3, 'mercado'),
(4, 'Posto de Gasolina'),
(6, 'Dentista'),
(7, 'Hospital '),
(8, 'Lanchonete');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id_empresas` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tel_numero` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wpp_numero` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `destaque` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_empresas`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id_empresas`, `nome`, `tel_numero`, `wpp_numero`, `instagram`, `facebook`, `categoria`, `destaque`) VALUES
(5, 'Dentista Isabel', '15984145555', '', '', NULL, 'Dentista', 'Destacado'),
(4, 'Santa Casa', '15981145554', '', '', NULL, 'Hospital ', 'Comum'),
(3, 'Seu João', '15981145554', '1598198191', 'matheushs_s', '', 'Lanchonete', 'Comum'),
(6, 'Tonhão Supermercados', '15985545554', '', '', NULL, 'mercado', 'Destacado'),
(7, 'Auto Posto Shell', '15981645224', '', '', NULL, 'Posto de Gasolina', 'Destacado'),
(8, 'VIP Perfumaria', '15966145354', '', '', NULL, 'Perfumaria', 'Destacado'),
(9, 'Easy Lavanderia', '159651645554', '', '', NULL, 'Lavanderia', 'Comum');

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` int NOT NULL AUTO_INCREMENT,
  `rua` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `complemento` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `id_empresas` int DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `id_empresas` (`id_empresas`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `rua`, `bairro`, `cidade`, `estado`, `numero`, `complemento`, `cep`, `id_empresas`) VALUES
(5, 'Oliveira', 'Jaguariu', 'Sorocaba', 'SP', '168', '', '18530000', 5),
(4, 'Osvaldo', 'Salve', 'Sorocaba', 'SP', '123', '', '18530000', 4),
(3, 'teste', 'Caixa d&#39;água', 'Porto Feliz', 'SP', '123', '', '18530-000', 3),
(6, 'Pereira', 'Jovante', 'Sorocaba', 'SP', '89', '', '18530000', 6),
(7, '25 de Março', 'Centro', 'Sorocaba', 'SP', '5898', '', '18530-000', 7),
(8, 'Valdivio Hoteleiro', 'Centro', 'Sorocaba', 'SP', '981', '', '18530000', 8),
(9, 'Prefeito Elias de Moura', 'Caixa d\'água', 'Sorocaba', 'SP', '1', '', '18530-000', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos_empresas`
--

DROP TABLE IF EXISTS `fotos_empresas`;
CREATE TABLE IF NOT EXISTS `fotos_empresas` (
  `id_foto` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data_upload` date NOT NULL,
  `id_empresas` int DEFAULT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `id_empresas` (`id_empresas`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fotos_empresas`
--

INSERT INTO `fotos_empresas` (`id_foto`, `nome`, `path`, `data_upload`, `id_empresas`) VALUES
(5, 'dentistaisabel.png', 'imgEmp/674f97e982c4bdentistaisabel.png.png', '2024-12-03', 5),
(3, '674f972b88cf4_seujoao.jpg', 'imgEmp/674f972b88cf4_seujoao.jpg', '2024-12-03', 3),
(4, 'santacasa.jpg', 'imgEmp/674f97c456f9esantacasa.jpg.jpg', '2024-12-03', 4),
(6, 'tonhaosupermercados.png', 'imgEmp/674f981190acdtonhaosupermercados.png.png', '2024-12-03', 6),
(7, 'shell.jpg', 'imgEmp/674f984095392shell.jpg.jpg', '2024-12-03', 7),
(8, 'vipperfumaria.png', 'imgEmp/674f986b7d11dvipperfumaria.png.png', '2024-12-03', 8),
(9, 'easylavanderia.png', 'imgEmp/674f988ca0dcaeasylavanderia.png.png', '2024-12-03', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos_site`
--

DROP TABLE IF EXISTS `fotos_site`;
CREATE TABLE IF NOT EXISTS `fotos_site` (
  `id_foto` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lugar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_upload` date NOT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fotos_site`
--

INSERT INTO `fotos_site` (`id_foto`, `nome`, `path`, `lugar`, `data_upload`) VALUES
(11, 'banner1.png', 'img/671311fdc0cde.png', 'banner', '2024-10-18'),
(12, 'banner2.png', 'img/67131200b2e27.png', 'banner', '2024-10-18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sobrenome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `tipoac` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `senha`, `email`, `tipoac`) VALUES
(1, 'Admin', 'Tester', '$2y$10$HDJBfUIk7P3E1AK.JjQ1t./4AaibfnVT4WjRGKzs9WfOsS2T6rlB6', 'teste@teste.com', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
