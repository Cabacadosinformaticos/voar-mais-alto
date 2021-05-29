-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jun-2021 às 00:41
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_voarmaisalto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrimho`
--

CREATE TABLE `carrimho` (
  `id` int(11) NOT NULL,
  `idutilizador` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `CategoriaID` int(11) NOT NULL,
  `CategoriaNome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`CategoriaID`, `CategoriaNome`) VALUES
(10, 'Tailândia'),
(11, 'México'),
(12, 'Turquia'),
(13, 'Albânia'),
(14, 'Egito'),
(15, 'Tunísia'),
(16, 'Índia'),
(17, 'Geórgia'),
(18, 'Cuba'),
(19, 'Argentina'),
(20, 'França'),
(21, 'Espanha'),
(22, 'Brasil'),
(23, 'Maldivas'),
(24, 'Bahamas'),
(25, 'Itália');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `utilizador` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tipo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `utilizador`, `password`, `email`, `tipo`) VALUES
(1, 'Admin', 'admin', 'admin@voarmaisalto.pt', 'admin'),
(14, 'Tiago Cabaça', '0505', 'utilizador101@example.com', 'admin'),
(15, 'Paulo Gonçalves', '864926', 'utilizador102@example.com', 'user'),
(16, 'Francisco Diniz', 'patau', 'utilizador103@example.com', 'user'),
(17, 'Ana Sofia', 'flores123', 'utilizador104@example.com', 'user');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `produtoID` int(11) NOT NULL,
  `produtoNome` varchar(50) NOT NULL,
  `preco` double NOT NULL,
  `stock` int(11) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `categoriaID` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produtoID`, `produtoNome`, `preco`, `stock`, `imagem`, `categoriaID`, `descricao`) VALUES
(24, 'Viagem á Itália', 2570, 5, 'img_produtosViagem a Itália.jpg', 25, 'Conhecida como a \"Cidade Eterna\", Roma é um autêntico museu ao ar livre que combina a beleza da época antiga com as atrações da Roma renascentista, barroca e moderna. Percorra o seu centro histórico, declarada Património da Humanidade pela UNESCO, e descubra alguns dos mais impactantes monumentos da antiguidade.'),
(25, 'Viagem ao México', 1700, 2, 'img_produtos/Viagem ao México.jpg', 11, 'Cancun, destino turístico por excelência de sol e praia. Localizado na esquina nordeste da península de Yucatán, no estado de Quintana Roo, Cancún forma parte do território da antiga civilização maia e é considerada a entrada para o Mundo Maia. Para finalizar desfrute a Riviera Maya, uma zona turística por excelência das Caraíbas com praias espectaculares.');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrimho`
--
ALTER TABLE `carrimho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idutilizador` (`idutilizador`),
  ADD KEY `idproduto` (`idproduto`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CategoriaID`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produtoID`),
  ADD KEY `categoriaID` (`categoriaID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrimho`
--
ALTER TABLE `carrimho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produtoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrimho`
--
ALTER TABLE `carrimho`
  ADD CONSTRAINT `carrimho_ibfk_1` FOREIGN KEY (`idutilizador`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrimho_ibfk_2` FOREIGN KEY (`idproduto`) REFERENCES `produto` (`produtoID`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`CategoriaID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
