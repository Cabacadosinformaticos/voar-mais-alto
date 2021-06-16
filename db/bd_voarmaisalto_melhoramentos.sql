-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Jun-2021 às 00:49
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
-- Banco de dados: `bd_voarmaisalto_melhoramentos`
--

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
  `email` varchar(60) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `telefone` int(9) NOT NULL,
  `password` varchar(10) NOT NULL,
  `tipo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `utilizador`, `email`, `morada`, `telefone`, `password`, `tipo`) VALUES
(1, 'Admin', 'admin@voarmaisalto.pt', '', 0, 'admin', 'admin'),
(14, 'Ana Ferreira', 'ana.ferreira@example.com', 'Rua Exemplo, 1, Mafra', 910000000, 'teste123', 'user'),
(15, 'Bruno Costa', 'bruno.costa@example.com', 'Rua Exemplo, 2, Mafra', 910000000, 'teste123', 'user'),
(16, 'Carla Sousa', 'carla.sousa@example.com', 'Rua Exemplo, 3, Mafra', 910000000, 'teste123', 'user'),
(17, 'Diogo Martins', 'diogo.martins@example.com', 'Rua Exemplo, 4, Mafra', 910000000, 'teste123', 'user'),
(20, 'Eduarda Lopes', 'eduarda.lopes@example.com', 'Rua Exemplo, 5, Mafra', 910000000, 'teste123', 'user'),
(21, 'Filipe Nunes', 'filipe.nunes@example.com', 'Rua Exemplo, 6, Mafra', 910000000, 'teste123', 'user'),
(22, 'Gabriela Rocha', 'gabriela.rocha@example.com', 'Rua Exemplo, 7, Mafra', 910000000, 'teste123', 'user'),
(23, 'Hugo Almeida', 'hugo.almeida@example.com', 'Rua Exemplo, 8, Mafra', 910000000, 'teste123', 'user'),
(24, 'Inês Moreira', 'ines.moreira@example.com', 'Rua Exemplo, 9, Mafra', 910000000, 'teste123', 'user'),
(25, 'Joana Pinto', 'joana.pinto@example.com', 'Rua Exemplo, 10, Mafra', 910000000, 'teste123', 'user'),
(26, 'Luís Carvalho', 'luis.carvalho@example.com', 'Rua Exemplo, 11, Mafra', 910000000, 'teste123', 'user');

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
  `descricao` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produtoID`, `produtoNome`, `preco`, `stock`, `imagem`, `categoriaID`, `descricao`) VALUES
(24, 'Viagem à Itália', 2570, 5, 'img_produtos/Viagem a Itália 2.jpg', 25, 'Conhecida como a \"Cidade Eterna\", Roma é um autêntico museu ao ar livre que combina a beleza da época antiga com as atrações da Roma renascentista, barroca e moderna. Percorra o seu centro histórico, declarada Património da Humanidade pela UNESCO, e descubra alguns dos mais impactantes monumentos da antiguidade.'),
(25, 'Viagem ao México', 1700, 2, 'img_produtos/Viagem ao México.jpg', 11, 'Cancun, destino turístico por excelência de sol e praia. Localizado na esquina nordeste da península de Yucatán, no estado de Quintana Roo, Cancún forma parte do território da antiga civilização maia e é considerada a entrada para o Mundo Maia. Para finalizar desfrute a Riviera Maya, uma zona turística por excelência das Caraíbas com praias espectaculares.'),
(27, 'Viagem à Tailândia', 3700, 8, 'img_produtos/Viagem à Tailânda.jpg', 10, '“Terra dos sorrisos”, a Tailândia é porventura, de um ponto de vista puramente turístico, o mais atrativo país do Sudeste Asiático. A capital Bangkok, a cidade de Chiang Mai, as minorias étnicas em Mai Hong Son, ilhas paradisíacas como as Phi Phi ou Koh Tao, a histórica Kanchanaburi, a cultura e arquitetura de Ayuthaya ou Sukhothai, e praias, muitas praias e resorts de luxo, como em Phuket, fazem das viagens à Tailândia a imagem do perfeito bilhete-postal tropical.  '),
(28, 'Viagem à Turquia', 2300, 6, 'img_produtos/Viagem à Turquia.jpg', 12, 'Extenso país de múltiplos contrastes, a Turquia é um destino de viagem verdadeiramente interessante. Da riquíssima cidade de Istambul à lunática Capadócia, da subida ao monte Ararat à imensa Anatólia, passando pelos azulejos de Iznik, pelo Mar Negro, pelas praias e ilhas turcas do Mediterrâneo. Quaisquer que sejam as razões de uma viagem à Turquia (arquitetónicas, culturais, simples férias de verão, ou outras), a deslocação ao antigo Império Otomano vale bem a pena.'),
(29, 'Viagem ao Egito', 3000, 12, 'img_produtos/Viagem ao Egito.jpg', 14, 'Com a paisagem dominada pelos desertos e pela presença do Rio Nilo, nele floresceu a primeira grande civilização da humanidade. Nos dias de hoje, o Egito merece cada vez mais a atenção do viajante.  Do caos das ruas do Cairo a Abu Simbel, do Templo de Karnak, em Luxor, ao inóspito oásis de Siwa, do bíblico Monte Sinai aos resorts do litoral do Mar Vermelho (como Sharm-el-Sheikh, Hurghada ou mesmo Dahab), da Biblioteca de Alexandria às incontornáveis Pirâmides de Gizé, passando pelo magnífico Delta do Nilo, o Egito continua a ser um dos mais fascinantes destinos para visitar no Norte de Áfric'),
(30, 'Viagem à India', 2400, 3, 'img_produtos/Viagem à India.jpg', 16, 'Costuma-se dizer que cada Estado da Índia é um país, tal a diversidade cultural e paisagística de toda a Índia. Do incontornável Taj Mahal, em Agra, à mágica cidade de Udaipur e todo o Rajastão, das montanhas de Darjeeling ao deserto de Jaisalmer, dos Himalaias, em Leh, aos canais e lagoas de Keralan ou às praias da portuguesa Goa, passando pelas caóticas metrópoles de Nova Deli e Bombaim, uma viagem à Índia marca para toda a vida. Sem contemplações.'),
(31, 'Viagem às Bahamas', 2000, 1, 'img_produtos/Viagem às Bahamas.jpg', 24, 'As Bahamas, com praias quase desertas e enseadas escondidas, garantem a tranquilidade dos visitantes em um paraíso de mais de 700 ilhas e ilhotas. As águas cristalinas têm diferentes tonalidades, desde o turquesa claro ao rosa. Estamos definitivamente no Caribe.'),
(32, 'Viagem à Argentina', 2100, 7, 'img_produtos/Viagem à Argentina.jpg', 19, 'Terra da vastidão das pampas e da cosmopolita Buenos Aires, do tango e das milongas, dos glaciares da Patagónia (a Terra do Fogo) e do vinho de Mendoza, das Cataratas de Iguazú e de um sem fim de atrativos, naturais e culturais, para quem anda em viagem, a Argentina é um dos destinos mais diversificados da América do Sul.'),
(33, 'Viagem à Tunísia', 2684, 9, 'img_produtos/Viagem à Tunísia.jpg', 15, 'Considerado um dos países mais fáceis de África para viajar, a Tunísia oferece de tudo um pouco. São disso exemplo a arquitetura deslumbrante de Sidi Bou Said, a labiríntica Medina de Tunes, os resorts de Hammamet e Tabarka, a ilha de Djerba, o coliseu de El-Jem, as planícies salgadas de Chott el-Jerid, Douz e o deserto do Sahara, e Sidi Ali el-Mekki, considerada por alguns a mais bonita praia da Tunísia. Atrações que ajudam a tornar as viagens à Tunísia experiências singulares.'),
(34, 'Viagem ao Brasil', 1654, 8, 'img_produtos/Viagem ao Brasil.jpg', 22, 'O Brasil é um país imenso, sensual, extraordinário, diversificado. Propício a viagens sem pressas, no Brasil pode conhecer as raízes africanas da Bahia, a paisagem incomparável de lagoas e dunas nos Lençóis Maranhenses, os encantos naturais do Pantanal e da mata atlântica, o santuário ecológico de Fernando de Noronha, os povos indígenas da Amazónia (esse grande pulmão do planeta, maior floresta tropical do mundo que ocupa mais de metade do território do Brasil), as gentes simples do sertão, as praias de areia fina do nordeste e as festas de rua como o carnaval do Rio de Janeiro.');

--
-- Índices para tabelas despejadas
--

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
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produtoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoriaID`) REFERENCES `categoria` (`CategoriaID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
