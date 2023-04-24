-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Abr-2023 às 02:32
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controledeestoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos_produtos`
--

CREATE TABLE `enderecos_produtos` (
  `idEndereco` int(11) NOT NULL,
  `endereco` varchar(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `enderecos_produtos`
--

INSERT INTO `enderecos_produtos` (`idEndereco`, `endereco`, `data`) VALUES
(1, 'RA_P1', '2023-04-22 22:10:33'),
(2, 'RC_P1', '2023-04-22 22:12:07'),
(3, 'RB_P1', '2023-04-22 22:11:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `idItem` int(11) NOT NULL,
  `idCodigoProduto` int(11) NOT NULL,
  `data` varchar(16) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `endereco` int(11) NOT NULL,
  `movimentacao` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`idItem`, `idCodigoProduto`, `data`, `quantidade`, `endereco`, `movimentacao`) VALUES
(9, 1, '23/04/23', 25, 1, 'entrada'),
(10, 2, '23/04/23', 10, 1, 'entrada'),
(15, 3, '22/04/23', 12, 2, 'saida');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `CodRefProduto` varchar(11) NOT NULL,
  `NomeProduto` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fornecedor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Valor` float DEFAULT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`CodRefProduto`, `NomeProduto`, `Fornecedor`, `Valor`, `idProduto`) VALUES
('ES001', 'Estojo para lápis', 'Faber-Castell', 12, 1),
('LA001', 'Lápis grafite H2 redondo', 'Faber-Castell', 2, 2),
('CA001', 'Caderno 12 matérias', 'Rasbro', 22, 3),
('CA002', 'Caneta esferográfica azul', 'BIC', 2, 7),
('AP001', 'Apagador de quadro', 'Madeireira madeira', 20, 9),
('QA001', 'Quadro de escrever', 'Madeireira madeira', 50, 11),
('BO001', 'Borracha para apagar grafite', 'Rasbro', 1, 12),
('KL001', 'Kit lápis de cor 24 cores', 'Faber-Castell', 54, 13),
('BA002', 'Banco', 'Madeireira madeira', 50, 14);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `enderecos_produtos`
--
ALTER TABLE `enderecos_produtos`
  ADD PRIMARY KEY (`idEndereco`),
  ADD UNIQUE KEY `endereco` (`endereco`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`idItem`),
  ADD UNIQUE KEY `idCodigoProduto` (`idCodigoProduto`),
  ADD KEY `fk_idEndereco` (`endereco`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`),
  ADD UNIQUE KEY `NomeProduto` (`NomeProduto`),
  ADD UNIQUE KEY `CodRefProduto` (`CodRefProduto`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `enderecos_produtos`
--
ALTER TABLE `enderecos_produtos`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `fk_idCodigoProduto` FOREIGN KEY (`idCodigoProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `fk_idEndereco` FOREIGN KEY (`endereco`) REFERENCES `enderecos_produtos` (`idEndereco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
