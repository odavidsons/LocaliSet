-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jan-2025 às 23:44
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sad_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `escritorio`
--

CREATE TABLE `escritorio` (
  `ID` int(11) NOT NULL,
  `IDIncubadora` int(11) NOT NULL,
  `Tamanho` float NOT NULL,
  `Preco` float NOT NULL,
  `Disponibilidade` tinyint(1) NOT NULL DEFAULT 1,
  `Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `escritorio`
--

INSERT INTO `escritorio` (`ID`, `IDIncubadora`, `Tamanho`, `Preco`, `Disponibilidade`, `Numero`) VALUES
(1, 1, 100, 750, 1, 94),
(2, 2, 98, 700, 1, 66),
(3, 1, 78, 600, 1, 99),
(4, 2, 69, 510, 1, 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacionamentos`
--

CREATE TABLE `estacionamentos` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `Lugares` int(11) NOT NULL,
  `Pago` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estacionamentos`
--

INSERT INTO `estacionamentos` (`ID`, `Nome`, `Latitude`, `Longitude`, `Lugares`, `Pago`) VALUES
(1, 'Parque de Estacionamento Candal Park', 41.1378631, -8.6308224, 105, 1),
(2, 'Estacionamento Hiper Centro', 41.178619, -8.587121, 40, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `ID` int(11) NOT NULL,
  `IDEscritorio` int(11) NOT NULL,
  `IDUtilizador` int(11) NOT NULL,
  `Calculos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `favoritos`
--

INSERT INTO `favoritos` (`ID`, `IDEscritorio`, `IDUtilizador`, `Calculos`) VALUES
(20, 1, 5, 'Período de renda de 12 meses Custo estimado: 9000€ Taxa aplicada: 23% Valor total: 11070');

-- --------------------------------------------------------

--
-- Estrutura da tabela `incubadora`
--

CREATE TABLE `incubadora` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `Contacto` int(9) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `NumEscritorios` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `incubadora`
--

INSERT INTO `incubadora` (`ID`, `Nome`, `Latitude`, `Longitude`, `Contacto`, `Email`, `NumEscritorios`) VALUES
(1, 'Candal Park', 41.137149, -8.630878, 220915800, 'empresa@candalpark.pt', '240'),
(2, 'Hiper Centro', 41.1789225, -8.5881973, 225480352, 'hipercentro@hipercentro.pt', '102');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(150) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Contactotelef` int(9) NOT NULL,
  `Administrador` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`ID`, `Nome`, `Email`, `Password`, `Contactotelef`, `Administrador`) VALUES
(5, 'David Santos', 'ds280702@gmail.com', '$2y$10$MKqk.VBBNeZakWePOYiY8O7AUrazfwgXrSt4NGYEMj/jeA8qqS.IC', 935494079, 0),
(6, 'Admin', 'admin@gmail.com', '$2y$10$HgVfYu53VoEmRWW12FATzuz1Aq6xBfOuebaSvezxTKZzQ0wgZ4c8y', 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `escritorio`
--
ALTER TABLE `escritorio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `incubadora_fk` (`IDIncubadora`);

--
-- Índices para tabela `estacionamentos`
--
ALTER TABLE `estacionamentos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `escritorio_fk` (`IDEscritorio`),
  ADD KEY `utilizador_fk` (`IDUtilizador`);

--
-- Índices para tabela `incubadora`
--
ALTER TABLE `incubadora`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `escritorio`
--
ALTER TABLE `escritorio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estacionamentos`
--
ALTER TABLE `estacionamentos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `incubadora`
--
ALTER TABLE `incubadora`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `escritorio`
--
ALTER TABLE `escritorio`
  ADD CONSTRAINT `incubadora_fk` FOREIGN KEY (`IDIncubadora`) REFERENCES `incubadora` (`ID`);

--
-- Limitadores para a tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `escritorio_fk` FOREIGN KEY (`IDEscritorio`) REFERENCES `escritorio` (`ID`),
  ADD CONSTRAINT `utilizador_fk` FOREIGN KEY (`IDUtilizador`) REFERENCES `utilizadores` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
