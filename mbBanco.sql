-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Nov-2023 às 04:42
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `mb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `doacao`
--

CREATE TABLE `doacao` (
  `id` bigint(20) NOT NULL,
  `idUsuario` bigint(20) NOT NULL COMMENT 'Id do usuario',
  `EstadoRoupa` varchar(64) NOT NULL COMMENT 'Estado da Roupa',
  `cpfUsuario` bigint(13) NOT NULL,
  `tipoRoupa` varchar(28) NOT NULL,
  `quantidade` bigint(20) NOT NULL COMMENT 'Quantidade Doada',
  `pontoEntrega` varchar(64) NOT NULL COMMENT 'Ponto de Entrega'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `doacao`
--

INSERT INTO `doacao` (`id`, `idUsuario`, `EstadoRoupa`, `cpfUsuario`, `tipoRoupa`, `quantidade`, `pontoEntrega`) VALUES
(91, 71, 'Bom', 56082677889, 'Camisetas', 10, 'Etec Barueri'),
(92, 71, 'Bom', 56082677889, 'Camisetas', 1, 'Etec Barueri'),
(93, 71, 'Bom', 56082677889, 'Camisetas', 2, 'Etec Barueri'),
(94, 71, 'Bom', 56082677889, 'Camisetas', 3, 'Etec Barueri'),
(95, 71, 'Bom', 56082677889, 'Camisetas', 1, 'Etec Barueri'),
(96, 71, 'Bom', 56082677889, 'Camisetas', 3, 'Etec Barueri'),
(97, 71, 'Bom', 56082677889, 'Camisetas', 2, 'Etec Barueri'),
(98, 71, 'Bom', 56082677889, 'Camisetas', 2, 'Etec Barueri'),
(99, 71, 'Bom', 56082677889, 'Camisetas', 3, 'Etec Barueri'),
(100, 71, 'Bom', 56082677889, 'Camisetas', 3, 'Etec Barueri'),
(101, 71, 'Bom', 56082677889, 'Camisetas', 2, 'Etec Barueri');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontuacao`
--

CREATE TABLE `pontuacao` (
  `id` bigint(20) NOT NULL,
  `valor` int(11) DEFAULT NULL COMMENT 'Valor da Pontuação a receber pela doação'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(32) NOT NULL COMMENT 'Nome',
  `cpf` bigint(13) NOT NULL COMMENT 'cpf do usuario',
  `senha` varchar(64) NOT NULL COMMENT 'Senha do usuário',
  `email` varchar(32) NOT NULL COMMENT 'email',
  `pontos` int(11) DEFAULT NULL,
  `imgUsuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `cpf`, `senha`, `email`, `pontos`, `imgUsuario`) VALUES
(69, 'fabricio', 1308143154, '$2y$10$GROi3X0JdaQETEh/HFRaNu/gMIW0GNe6zNMQdqXzkJjmTCAq04y/i', 'lemos@adminmodadobem', NULL, ''),
(70, 'bruno', 53806524840, '$2y$10$E2wY9R.AxLWLFWWb6J9E/uwX87ImRwIVQ1GqNOOCG8kJCsszLJde2', 'bruno@adminmodadobem', NULL, ''),
(71, 'fabricio', 56082677889, '$2y$10$3XeM8CbwMuk7PeoQ74SkjOfx01zzJsKRYxh33..k9Hz5EmmUqxlpG', 'lemos1570@gmail.com', 170, 'Captura de tela 2023-08-08 094248.png'),
(72, 'fabricio', 58035427504, '$2y$10$oj7TcNCxGD4zetYeUy9ljuJ.uNuAEh/BJyKPrZG0LEmn62U2tm1S2', 'fabricio@gmail.com', NULL, ''),
(73, 'fabricio', 54162555222, '$2y$10$96Ay/QPNANepqob60UWGZe/8dWTZNv9ZXlUwEVIMQAB128mdTFaR.', 'lemos245@gmail.com', NULL, ''),
(74, 'nhdbnexw', 5984524811, '$2y$10$6cSCZsgJ61C.wxOTssdf9uaUNeXEOdD1TGe.5Jd7JmHzbSEVSuo8.', 'lemo415@gmail.com', NULL, ''),
(75, 'nrcygcybnx', 48544856456, '$2y$10$NCJCafnAgH46yLNfPiCxK.QH5OVWJnCbTdFGIse.j4GrKj60s9wbW', 'lemo4850@gmail.com', NULL, ''),
(79, 'fabricio', 51715544123, '$2y$10$3CkaAhPdP9eHwyA78iYEdOrb.93K.nb1ppgOoU4oCBBcWUhNW7p2K', 'lem54564@gmail.com', NULL, ''),
(80, 'fabricio', 41, '$2y$10$DSxSkSS2mNZ4T1GqWbbFBuewrAmPEK.GYBVG14OWl4wtvku3YRjaq', 'lem59740@gmail.com', NULL, ''),
(81, 'fabricio10', 15485123215, '$2y$10$GPD1gg32TFDVrWSlVhNQJ.RpbibOqo2vB3OvXqtg/XwzqeQbH16ia', 'lemo5122170@gmail.com', NULL, ''),
(82, 'camilla', 26842141561, '$2y$10$9kL2xWfK774eHVyq5MI5yuhSxgrFItUguJrEqu.yIwi6lHKuTEYmm', 'lemos1511570@gmail.com', NULL, ''),
(86, 'fabricio', 15962565286, '$2y$10$unKXhCFsLIbNXbHPEP.be.z26yMXW7fgCOxEBZAObK06.Xu/9jFh6', '4212651@gmail.com', NULL, ''),
(91, '461226', 55263026321, '$2y$10$yB4qKvTvetRlmXzhL8NhGuXMAP6yq8PpdXFJhjsD/kSaIEJ2xqmse', '5126223@gmail.com', NULL, ''),
(92, 'camilla', 51563215256, '$2y$10$V0nDDDYbiukGUgqVFLnHqOogOyzP6Hgd6w8JG3Cfcwsg.3f1wqmJm', 'lemo3255@gmail.com', NULL, ''),
(94, 'fabricio', 54452656565, '$2y$10$vM9XNC5N.GrcMzMV1TOqO.NgdRTa57oX/DK/fF/JT9wC/ArUuZ6pC', 'lem855s@adminmodadobem', NULL, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `doacao`
--
ALTER TABLE `doacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pontuacao`
--
ALTER TABLE `pontuacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `doacao`
--
ALTER TABLE `doacao`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de tabela `pontuacao`
--
ALTER TABLE `pontuacao`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
