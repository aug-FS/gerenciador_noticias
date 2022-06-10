-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jun-2022 às 02:02
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `noticia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `Id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `corpo` text NOT NULL,
  `foto` varchar(40) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`Id`, `titulo`, `corpo`, `foto`, `data`) VALUES
(1, 'O brasil é hexa ae', 'O brasil é hexa campeão ao derrotar a França na fina da copa do mundo de 2022 ae', '3d7159eed943cbe26f4fbaf1e1e3aebf.jpg', '2022-06-08 09:59:59'),
(2, 'Dragon ball retornara para a tv finalmente!!!', 'Após anos de hiato, finalmente Dragon bal super continuara sua história em 2022, com goku e vegeta.', '0e1e93ed75e3d5315e7f5016dd078e77.jpg', '2022-08-06 09:59:59'),
(4, 'Copa do Brasil: clássicos dominam as oitavas; veja todos os confrontos', 'Vale lembrar que os confrontos das quartas de final também serão sorteados e estão programados para 27/07, 28/07, 17/08 e 18/08. Na sequência da competição, as semifinais devem ocorrer em 24/08 e 14/09. Já a final está marcada para os dias 12 e 19 de outubro.Confira abaixo todos os duelos das oitavas de final:Corinthians x SantosSão Paulo x PalmeirasAthletico-PR x BahiaGoiás x Atlético-GOFortaleza x CearáFluminense x CruzeiroAmérica-MG x BotafogoFlamengo x Atlético-MG', '', '2022-08-06 09:59:59'),
(8, 'diagrama de classes feito', 'finalmente foi terminado o diagrama de classes para a matéria da faculdade.', '54631d049460a1406d4c4c81188180b0.png', '2022-06-08 11:17:44'),
(9, 'Athletico-PR é campeão da Sul-Americana 2021', 'Athletico-PR é campeão da Sul-Americana 2021. Em jogo realizado no Uruguai, o “Furacão” foi superior ao RB Bragantino e conseguiu levar para casa o troféu e o prêmio de R$ 36 milhões.  O time campeão do Athletico-PR, comandado por Alberto Valentin, foi para campo com Santos (Goleiro); Thiago Heleno (Zagueiro), Hernández (Zagueiro), Pedro Henrique (Zagueiro), Marcinho (Lateral); Leo Cittadino (Volante), Erick (Meia), Abner (Meia); Nikao (Meia), Renato Kayzer (Atacante), David Terans (Atacante).', 'e0328bdff43056a9540f9b582e6c5e77.jpg', '2022-06-08 12:27:52');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
