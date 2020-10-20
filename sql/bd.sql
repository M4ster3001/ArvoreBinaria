-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Out-2020 às 08:14
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_arvorebinaria`
--

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `proc_i_indicacao`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_i_indicacao` (IN `p_cod_usuario_primario` INT, IN `p_cod_usuario_secundario` INT)  BEGIN
	set @flg_esquerdo := (SELECT count(cod_indicacao) FROM tb_indicacoes WHERE cod_usuario_primario = p_cod_usuario_primario AND flg_esquerdo IS NOT NULL);

    INSERT INTO tb_indicacoes
		(cod_usuario_primario, cod_usuario_secundario, flg_direito, flg_esquerdo) 
    VALUE (
		p_cod_usuario_primario, p_cod_usuario_secundario,
        (
			CASE WHEN 
			@flg_esquerdo > 0
				THEN 1
                ELSE 0
			END 
        ),
        (
			CASE WHEN 
			@flg_esquerdo = 0
				THEN 1
                ELSE 0
			END 
        )
	);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_indicacoes`
--

DROP TABLE IF EXISTS `tb_indicacoes`;
CREATE TABLE `tb_indicacoes` (
  `cod_indicacao` int(11) NOT NULL,
  `cod_usuario_primario` int(11) NOT NULL,
  `cod_usuario_secundario` int(11) NOT NULL,
  `flg_direito` int(11) DEFAULT 0,
  `flg_esquerdo` int(11) DEFAULT 0,
  `dat_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dat_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pontos`
--

DROP TABLE IF EXISTS `tb_pontos`;
CREATE TABLE `tb_pontos` (
  `cod_ponto` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `vlr_pontos` double(5,2) NOT NULL DEFAULT 0.00,
  `dat_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dat_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE `tb_usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `des_nome` varchar(128) COLLATE utf8_bin NOT NULL,
  `des_email` varchar(64) COLLATE utf8_bin NOT NULL,
  `pwd_senha` varchar(255) COLLATE utf8_bin NOT NULL,
  `dat_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dat_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `tb_vw_usuarios_indica`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `tb_vw_usuarios_indica`;
CREATE TABLE `tb_vw_usuarios_indica` (
`cod_usuario` int(11)
,`des_nome` varchar(128)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `tb_vw_usuarios_indica`
--
DROP TABLE IF EXISTS `tb_vw_usuarios_indica`;

DROP VIEW IF EXISTS `tb_vw_usuarios_indica`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_vw_usuarios_indica`  AS SELECT `us`.`cod_usuario` AS `cod_usuario`, `us`.`des_nome` AS `des_nome` FROM (`tb_usuarios` `us` left join `tb_indicacoes` `ind` on(`us`.`cod_usuario` = `ind`.`cod_usuario_primario`)) WHERE `ind`.`flg_direito` is null AND `ind`.`flg_esquerdo` is null ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_indicacoes`
--
ALTER TABLE `tb_indicacoes`
  ADD PRIMARY KEY (`cod_indicacao`);

--
-- Índices para tabela `tb_pontos`
--
ALTER TABLE `tb_pontos`
  ADD PRIMARY KEY (`cod_ponto`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_indicacoes`
--
ALTER TABLE `tb_indicacoes`
  MODIFY `cod_indicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_pontos`
--
ALTER TABLE `tb_pontos`
  MODIFY `cod_ponto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
