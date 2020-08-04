-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: bd_dev_tests.mysql.dbaas.com.br
-- Generation Time: 01-Ago-2020 às 08:44
-- Versão do servidor: 5.7.17-13-log
-- PHP Version: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_dev_tests`
--
CREATE DATABASE IF NOT EXISTS `bd_dev_tests` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `bd_dev_tests`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviso`
--

CREATE TABLE `aviso` (
  `Aviso` int(11) NOT NULL,
  `Titulo` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Texto` text COLLATE latin1_general_ci NOT NULL,
  `Resumo` text COLLATE latin1_general_ci NOT NULL,
  `Imagem` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Usuario` int(11) NOT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `aviso`
--

INSERT INTO `aviso` (`Aviso`, `Titulo`, `Texto`, `Resumo`, `Imagem`, `Usuario`, `Data`) VALUES
(8, 'A iste recusandae quo mollitia et amet veniam hic.', 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', '', '0546cfe948f11fd1c86ca095921b25a1.jpg', 3, '2020-06-28'),
(9, 'Enim omnis a mollitia', 'Animi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.\r\n', '', 'fba3958ea63c57b2a9a04e424c52d045.jpg', 3, '2020-06-28'),
(10, 'Id illum est doloribus in totam', 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n\r\nAnimi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.\r\n\r\nSimilique sit eos est aut. Aut consectetur iusto ut quod omnis eum commodi ullam quod. Doloribus architecto vel deserunt ea neque est.\r\n', '', '18076096b5413410d50ad7d38da36deb.jpg', 3, '2020-06-28'),
(11, 'A iste recusandae quo mollitia et amet veniam hic.', 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', '', '', 4, '2020-06-28'),
(12, 'Similique sit eos est aut', 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', '', 'de4dabe01f064c8ee0274be677ad0fd5.jpg', 4, '2020-06-28'),
(14, 'Similique sit eos est aut', 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n\r\nReiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n\r\nReiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', '', '', 4, '2020-06-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `Cargo` int(11) NOT NULL,
  `Titulo` varchar(220) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`Cargo`, `Titulo`) VALUES
(1, 'Trader'),
(2, 'Presidente'),
(3, 'Desenvolvedor JavaScript'),
(4, 'Desenvolvedor PHP'),
(5, 'Secretário Geral Financeiro'),
(6, 'Desenvolvedor Backend Node.JS'),
(7, 'Database Manager'),
(8, 'Tester '),
(9, 'Desenvolvedor Fronted');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `Empresa` int(11) NOT NULL,
  `Titulo` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Ramo` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Endereco` text COLLATE latin1_general_ci NOT NULL,
  `Contato` varchar(300) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`Empresa`, `Titulo`, `Ramo`, `Endereco`, `Contato`) VALUES
(1, 'Itaú Unibanco SA', '', '', ''),
(2, 'Itausa Investimentos SA', '', '', ''),
(3, 'Republica das bananas', '', '', ''),
(4, 'CocaCola', '', '', ''),
(5, 'Microsoft', '', '', ''),
(6, 'EthRX', '', '', ''),
(7, 'Nova Era', '', '', ''),
(8, 'Google', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `Tipo` int(11) NOT NULL,
  `Titulo` varchar(220) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `Usuario` int(11) NOT NULL,
  `Nome` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Imagem` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Celular` varchar(220) COLLATE latin1_general_ci NOT NULL,
  `Texto` text COLLATE latin1_general_ci NOT NULL,
  `Senha` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Curriculo` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`Usuario`, `Nome`, `Email`, `Imagem`, `Celular`, `Texto`, `Senha`, `Curriculo`, `Tipo`) VALUES
(1, 'Admin', 'anderson.rodz@gmail.com', '77990987f7b306bf9da7d54308447647.jpg', '', 'Apresentação ', '81dc9bdb52d04dc20036dbd8313ed055', '', 1),
(2, 'Anderson Isaac Rodrigues', 'anderson.87br@gmail.com', 'e468aadb4b6baad23b52180f68d823a2.jpeg', '(15) 11111-1111', 'Apresentação ', 'e10adc3949ba59abbe56e057f20f883e', '12b99f2fe8dc335a9fd598d6a1740cf3.jpg', 2),
(3, 'Aisha Fay', 'aisha_fay@fatec.sp.gov.br', '101dfb0183d7955865eba938f3066945.jpg', '', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim beatae nesciunt ab quisquam, totam minus, maiores quia voluptatibus itaque mollitia nobis ullam repellat ad vero non earum pariatur, tenetur tempore!', 'e10adc3949ba59abbe56e057f20f883e', '', 1),
(4, 'Issac Wehner', 'issac_wehner@fatec.sp.gov.br', '4da38d10c89e007f3b955d39854a6558.jpg', '', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim beatae nesciunt ab quisquam, totam minus, maiores quia voluptatibus itaque mollitia nobis ullam repellat ad vero non earum pariatur, tenetur tempore!', 'e10adc3949ba59abbe56e057f20f883e', '', 1),
(5, 'Pearline Haag', 'pearline_Haag@fatec.sp.gov.br', '', '', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim beatae nesciunt ab quisquam, totam minus, maiores quia voluptatibus itaque mollitia nobis ullam repellat ad vero non earum pariatur, tenetur tempore!', 'e10adc3949ba59abbe56e057f20f883e', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_aviso_favorito`
--

CREATE TABLE `usuario_aviso_favorito` (
  `Usuario_aviso_favorito` int(11) NOT NULL,
  `Usuario` int(11) NOT NULL,
  `Aviso` int(11) NOT NULL,
  `Favorito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `usuario_aviso_favorito`
--

INSERT INTO `usuario_aviso_favorito` (`Usuario_aviso_favorito`, `Usuario`, `Aviso`, `Favorito`) VALUES
(10, 2, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_vaga`
--

CREATE TABLE `usuario_vaga` (
  `Usuario_vaga` int(11) NOT NULL,
  `Usuario` int(11) NOT NULL,
  `Vaga` int(11) NOT NULL,
  `Favorito` int(11) NOT NULL,
  `Inscrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `usuario_vaga`
--

INSERT INTO `usuario_vaga` (`Usuario_vaga`, `Usuario`, `Vaga`, `Favorito`, `Inscrito`) VALUES
(53, 2, 31, 0, 1),
(54, 2, 32, 1, 1),
(55, 2, 33, 0, 1),
(56, 2, 34, 0, 1),
(57, 2, 35, 1, 0),
(58, 2, 36, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `Vaga` int(11) NOT NULL,
  `Descricao` text COLLATE latin1_general_ci NOT NULL,
  `Cargo` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Remuneracao` double NOT NULL,
  `Valor_da_bolsa` double NOT NULL,
  `Diferencial` text COLLATE latin1_general_ci NOT NULL,
  `Beneficios` text COLLATE latin1_general_ci NOT NULL,
  `Empresa` int(11) NOT NULL,
  `Email` varchar(220) COLLATE latin1_general_ci NOT NULL,
  `Whatsapp` varchar(220) COLLATE latin1_general_ci NOT NULL,
  `Situacao_da_vaga` int(11) NOT NULL,
  `Data_postagem` date NOT NULL,
  `Data_validade` date NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`Vaga`, `Descricao`, `Cargo`, `Tipo`, `Remuneracao`, `Valor_da_bolsa`, `Diferencial`, `Beneficios`, `Empresa`, `Email`, `Whatsapp`, `Situacao_da_vaga`, `Data_postagem`, `Data_validade`, `Usuario`) VALUES
(31, 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.', 4, 0, 0, 112000, 'Animi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.', 'Et reiciendis rerum eius similique voluptas necessitatibus. Velit inventore minus. Quaerat voluptatem deleniti numquam dolorem possimus dolores dolores voluptas. Voluptatum consequatur culpa quibusdam deserunt voluptate architecto quibusdam.', 1, 'rh@itau.com.br', '(15) 98985-6296', 1, '2020-06-27', '2020-07-21', 4),
(32, 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', 6, 0, 0, 90000, 'Animi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.\r\n', 'A iste recusandae quo mollitia et amet veniam hic.\r\n', 8, 'contato@google.com.br', '(15) 99999-9999', 1, '2020-06-28', '2020-07-15', 3),
(33, 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', 3, 1, 340000, 0, 'Animi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.\r\n', 'Animi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.\r\n', 1, 'rh@itau.com.br', '(15) 99999-9999', 1, '2020-06-28', '2020-08-21', 3),
(34, 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', 7, 1, 390000, 0, 'Animi voluptatem id. Et est harum eum veniam. Magnam molestiae placeat culpa adipisci at et. Et amet aut distinctio est eos dignissimos et ut. Error deleniti qui eveniet. Omnis ullam tempora assumenda doloribus doloribus error vitae ducimus.\r\n', 'A iste recusandae quo mollitia et amet veniam hic.\r\n', 5, 'rh@microsoft.com.br', '(15) 99999-9999', 1, '2020-06-28', '2020-07-01', 3),
(35, 'Similique sit eos est aut. Aut consectetur iusto ut quod omnis eum commodi ullam quod. Doloribus architecto vel deserunt ea neque est.\r\n', 1, 0, 0, 120000, 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', 'Similique sit eos est aut. Aut consectetur iusto ut quod omnis eum commodi ullam quod. Doloribus architecto vel deserunt ea neque est.', 7, 'rh@novaera.com.br', '(15) 99999-9999', 1, '2020-06-28', '2020-10-24', 4),
(36, 'Reiciendis rerum officia. Sint assumenda alias ut. Quis et autem est tempore qui iure atque occaecati. Aliquid qui vitae quis eius dolores. Earum voluptatem quo totam.\r\n', 8, 0, 0, 135000, 'Similique sit eos est aut. Aut consectetur iusto ut quod omnis eum commodi ullam quod. Doloribus architecto vel deserunt ea neque est.\r\n', 'A iste recusandae quo mollitia et amet veniam hic.', 4, 'rh@cocacola.com.br', '(15) 99999-9999', 1, '2020-06-28', '2020-07-15', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`Aviso`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`Cargo`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`Empresa`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`Tipo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Usuario`);

--
-- Indexes for table `usuario_aviso_favorito`
--
ALTER TABLE `usuario_aviso_favorito`
  ADD PRIMARY KEY (`Usuario_aviso_favorito`);

--
-- Indexes for table `usuario_vaga`
--
ALTER TABLE `usuario_vaga`
  ADD PRIMARY KEY (`Usuario_vaga`);

--
-- Indexes for table `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`Vaga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aviso`
--
ALTER TABLE `aviso`
  MODIFY `Aviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `Empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `Tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuario_aviso_favorito`
--
ALTER TABLE `usuario_aviso_favorito`
  MODIFY `Usuario_aviso_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuario_vaga`
--
ALTER TABLE `usuario_vaga`
  MODIFY `Usuario_vaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vaga`
--
ALTER TABLE `vaga`
  MODIFY `Vaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
