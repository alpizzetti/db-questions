-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2019 at 08:35 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzet31_git`
--

-- --------------------------------------------------------

--
-- Table structure for table `aprovacoes`
--

CREATE TABLE `aprovacoes` (
  `id` int(11) NOT NULL,
  `questao` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data_aprovacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `capacidades`
--

CREATE TABLE `capacidades` (
  `id` int(11) NOT NULL,
  `unidade_curricular` int(11) NOT NULL,
  `numero` varchar(3) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capacidades`
--

INSERT INTO `capacidades` (`id`, `unidade_curricular`, `numero`, `descricao`, `status`, `data_criacao`, `data_alteracao`) VALUES
(7, 3, 'C01', 'Elaborar modelo conceitual de banco de dados', 1, '2019-11-27 21:28:56', '2019-11-27 21:31:38'),
(8, 3, 'C02', 'Diferenciar formas de modelagem de banco de dados', 1, '2019-11-27 21:31:14', NULL),
(9, 3, 'C03', 'Elaborar modelo físico de banco de dados', 1, '2019-11-27 21:32:04', NULL),
(10, 3, 'C04', 'Elaborar modelo lógico de banco de dados', 1, '2019-11-27 21:32:17', NULL),
(11, 6, 'C01', 'Planejar sistemas computacionais de informação', 1, '2019-11-27 21:33:03', NULL),
(12, 6, 'C02', 'Implantar sistemas computacionais de informação', 1, '2019-11-27 21:33:16', NULL),
(13, 6, 'C03', 'Desenvolver sistemas computacionais de informação', 1, '2019-11-27 21:33:31', NULL),
(14, 5, 'C01', 'Validar artefatos de análise', 1, '2019-11-27 21:35:02', '2019-11-27 22:09:43'),
(15, 5, 'C02', 'Identificar, classificar e priorizar os requisitos', 1, '2019-11-27 21:35:18', NULL),
(16, 5, 'C03', 'Especificar casos de uso', 1, '2019-11-27 21:35:31', NULL),
(17, 5, 'C04', 'Elaborar protótipo de sistemas', 1, '2019-11-27 21:35:47', NULL),
(18, 5, 'C05', 'Elaborar documentação da análise', 1, '2019-11-27 21:36:30', NULL),
(19, 5, 'C06', ' Definir escopo de sistemas', 1, '2019-11-27 21:38:01', NULL),
(20, 5, 'C07', 'Criar artefatos de análise', 1, '2019-11-27 21:38:34', NULL),
(21, 5, 'C08', 'Aplicar técnicas de levantamento de requisitos', 1, '2019-11-27 21:38:45', NULL),
(22, 8, 'C01', 'Aplicar princípios de comunicação e motivação', 1, '2019-11-27 21:39:27', NULL),
(23, 8, 'C02', 'Estimular o desenvolvimento da capacidade criativa', 1, '2019-11-27 21:39:42', '2019-11-27 21:41:15'),
(24, 8, 'C03', ' Desenvolver habilidades de trabalho em equipe', 1, '2019-11-27 21:39:59', NULL),
(25, 8, 'C04', 'Aplicar os conceitos de liderança situacional nas organizações', 1, '2019-11-27 21:40:11', NULL),
(26, 7, 'C01', ' Identificar riscos de segurança', 1, '2019-11-27 21:41:32', NULL),
(27, 7, 'C02', ' Compatibilizar atividades com o plano de contingência', 1, '2019-11-27 21:41:43', NULL),
(28, 7, 'C03', ' Aplicar políticas de segurança', 1, '2019-11-27 21:41:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `unidade` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(6) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `unidade`, `nome`, `tipo`, `status`, `data_criacao`, `data_alteracao`) VALUES
(2, 2, 'Técnico em Informática', 'tec', 1, '2019-11-11 09:36:15', '2019-12-03 16:20:06'),
(3, 1, 'Análise e Desenvolvimento de Sistemas', 'sup', 1, '2019-11-11 09:37:15', '2019-11-12 16:34:32'),
(5, 3, 'Gastronomia', 'sup', 1, '2019-12-03 20:46:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `funcionalidades`
--

CREATE TABLE `funcionalidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funcionalidades`
--

INSERT INTO `funcionalidades` (`id`, `nome`) VALUES
(1, 'Configurações de Usuários'),
(2, 'Configurações de Unidades'),
(3, 'Configurações Controle de Acesso'),
(4, 'Cadastro de Questões'),
(5, 'Moderador de Questões'),
(6, 'Configurações de Cursos'),
(7, 'Configurações de Unidades Curriculares'),
(8, 'Relatórios'),
(9, 'Configurações de Capacidades');

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `herda` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  `professor` tinyint(1) NOT NULL,
  `moderador` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`id`, `herda`, `nome`, `administrador`, `professor`, `moderador`, `status`, `data_criacao`, `data_alteracao`) VALUES
(1, NULL, 'Administrador', 1, 0, 0, 1, '2019-11-11 10:11:13', NULL),
(2, NULL, 'Professor Nível 1', 0, 1, 0, 1, '2019-11-11 10:11:13', NULL),
(3, 2, 'Professor Nível 2', 0, 1, 1, 1, '2019-11-11 10:11:13', '2019-11-11 10:49:23'),
(4, NULL, 'Cadastro Docente', 1, 0, 0, 1, '2019-11-11 10:11:13', '2019-11-28 14:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `privilegios`
--

CREATE TABLE `privilegios` (
  `id` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `funcionalidade` int(11) NOT NULL,
  `ler` tinyint(1) NOT NULL,
  `escrever` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilegios`
--

INSERT INTO `privilegios` (`id`, `grupo`, `funcionalidade`, `ler`, `escrever`) VALUES
(2, 2, 4, 1, 1),
(4, 3, 5, 1, 1),
(5, 4, 3, 1, 1),
(6, 4, 2, 1, 1),
(7, 4, 1, 1, 1),
(8, 4, 7, 1, 1),
(10, 4, 6, 1, 1),
(12, 4, 9, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questoes`
--

CREATE TABLE `questoes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `unidade_curricular` int(11) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `dificuldade` varchar(10) NOT NULL,
  `enunciado` text NOT NULL,
  `suporte` text,
  `comando` text,
  `item_a` text NOT NULL,
  `item_b` text NOT NULL,
  `item_c` text NOT NULL,
  `item_d` text NOT NULL,
  `item_e` text NOT NULL,
  `gabarito` varchar(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questoes`
--

INSERT INTO `questoes` (`id`, `usuario`, `unidade_curricular`, `capacidade`, `dificuldade`, `enunciado`, `suporte`, `comando`, `item_a`, `item_b`, `item_c`, `item_d`, `item_e`, `gabarito`, `status`, `data_criacao`, `data_alteracao`) VALUES
(13, 1, 7, 27, 'med', 'No cenário de uma economia globalizada, cresce o interesse pelo empreendedorismo e pela busca de meios que levem a uma maior produtividade, competitividade e inovação. Os avanços das tecnologias da informação e comunicação (TIC) auxiliam esse crescimento. Atualmente, uma parcela significativa dos negócios tem uma dependência forte das TIC. ', 'Desse modo, manter a disponibilidade da informação e comunicação e manter os negócios operando, sem qualquer paralisação, é indispensável. Porém, pe preciso analisar o que pode ser afetado, qual o impacto financeiro e quais os impactos na imagem e na reputação da empresa, se cada um dos processos de negócio sofresse uma paralisação por conta da TIC. ', 'A fim de mitigar possíveis riscos, é recomendável documentar um plano para eliminar ou reduzir a possibilidade de ocorrer cenários de indisponibilidade da TIC. Nessa situação, é preciso elaborar um:', 'Plano de negócio', 'Documento de visão', ' Plano de contingência. ', 'Plano de gerência de risco', 'Plano de gerenciamento de projetos', 'C', 1, '2019-11-28 15:08:09', '2019-11-28 17:14:18'),
(14, 1, 6, 11, 'fac', 'Documentos Normativos Básicos ISO 27001: SGSI (Sistemas de Gestão da Seginfo) ISO 27002: (Boas práticas de Gestão da Segurança da Informação) ISO 27005: (Gestão de Risco em SegInfo). A lei n.°12.965, de 23 de abril de 2014, originalmente denominada Marco Civil da internet, estabelece princípios, garantias, direitos e deveres para o uso da internet no Brasil, Contribuindo principalmente nas relações de consumo e segurança da informação pessoal para com os prestadores de serviço de acesso à internet.', 'Suponha que o clima de determinado provedor de acesso à internet contrata um serviço com velocidade de conexão de 5 Megabits/s (Mbps), mas tem continuamente enfrentado problemas de perda de conexão e, adicionalmente, não obtém a velocidade contratada, apesar de o cliente realizar todos os pagamentos em dia. Nessa situação, avalia as seguintes asserções e a relação proposta entre elas:\r\n\r\nI. A manutenção de qualidade contratada e a conexão à internet é uma obrigação prevista no Marco Civil da internet.\r\nII. Não pode haver suspensão da conexão à internet, salvo por débito diretamente decorrente de sua utilização.', 'A respeito dessas asserções, assinale a opção correta. ', 'As asserções I e II são proposições verdadeiras, e a II é uma justificativa correta da I ', 'As asserções I e II são proposições verdadeiras, mais a II não e uma justificativa correta da I', 'A asserção I pé uma proposição verdadeira, e a II é uma proposição falsa ', 'A asserção I é uma proposição falsa, e a II é uma proposição verdadeira', 'As asserções I e II são proposições falsas', 'B', 1, '2019-11-28 15:12:28', '2019-12-03 20:49:10'),
(15, 1, 6, 12, 'mui_fac', 'Considere o arranjo computacional apresentado a seguir. ', '', 'A característica fundamental esperada para tais sistemas de modo a ter o menor impacto sobre a experiência do usuário final é ', 'A transparência entre as entidades do sistema', ' A linguagem de programação orientada a eventos', 'O hardware com elevada taxa de processamento de dados', ' A base de dados deve estar localizada no mesmo espaço físico ', 'A independência quando a disponibilidade de conexão à rede de comunicação de dados', 'A', 1, '2019-11-28 15:14:03', '2019-11-28 15:15:33'),
(16, 7, 3, 9, 'dif', 'Teste', 'Teste 1', 'Oi', '1', '2', '3', '34', '5', 'B', 0, '2019-12-03 20:50:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questoes_imagens`
--

CREATE TABLE `questoes_imagens` (
  `id` int(11) NOT NULL,
  `questao` int(11) NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  `item` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questoes_imagens`
--

INSERT INTO `questoes_imagens` (`id`, `questao`, `arquivo`, `item`, `status`, `data_criacao`, `data_alteracao`) VALUES
(17, 15, '15-ho0dyfpkq3.jpg', 'suporte', 1, '2019-11-28 15:14:21', NULL),
(18, 16, '16-xbdo7va9l7.jpg', 'enunciado', 1, '2019-12-03 20:50:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unidades`
--

INSERT INTO `unidades` (`id`, `nome`, `email`, `telefone`, `status`, `data_criacao`, `data_alteracao`) VALUES
(1, 'SENAI - Florianópolis (CTAI)', 'ctai@senai.br', '(48) 3239-5800', 1, '2019-09-12 20:15:13', NULL),
(2, 'SENAI - São José', 'saojose@senai.br', '(48) 3232-3232', 1, '2019-10-29 11:48:12', NULL),
(3, 'SENAI - Palhoça', 'palhoca@senai.br', '(48) 4052-3324', 1, '2019-10-29 11:49:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unidades_curriculares`
--

CREATE TABLE `unidades_curriculares` (
  `id` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unidades_curriculares`
--

INSERT INTO `unidades_curriculares` (`id`, `curso`, `nome`, `status`, `data_criacao`, `data_alteracao`) VALUES
(2, 2, 'Serviços Básicos de Rede', 1, '2019-11-12 09:01:14', NULL),
(3, 3, 'Projeto de Banco de Dados', 1, '2019-11-12 09:01:14', NULL),
(5, 3, 'Análise de Sistemas', 1, '2019-11-27 21:24:42', NULL),
(6, 3, 'Arquitetura de Redes', 1, '2019-11-27 21:24:55', NULL),
(7, 3, 'Segurança da Informação', 1, '2019-11-27 21:25:09', NULL),
(8, 3, 'Relações Humanas no Trabalho', 1, '2019-11-27 21:25:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `unidade` int(11) NOT NULL,
  `matricula` int(20) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `token_web` varchar(100) DEFAULT NULL,
  `token_trocar_senha` varchar(100) DEFAULT NULL,
  `token_google` varchar(16) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `grupo`, `unidade`, `matricula`, `nome`, `email`, `sexo`, `senha`, `salt`, `token_web`, `token_trocar_senha`, `token_google`, `status`, `data_criacao`, `data_alteracao`) VALUES
(1, 1, 1, 123456, 'André Luís Pizzetti', 'admin@senai.br', 'M', 'Ivh7rkTQ', 'jNgSdV8gZFw=', '', NULL, '', 1, '2019-10-16 08:45:14', '2019-11-27 20:32:05'),
(5, 4, 1, 64654, 'Teste Cadastro Docente', 'docente@pizzetti.net', 'M', 'YQXCwA==', 'afZHKtA2+nA=', NULL, NULL, NULL, 1, '2019-10-29 11:29:09', '2019-11-28 14:40:17'),
(6, 2, 3, 12311, 'Teste Professor Nível 1', 'n1@senai.br', 'M', 'cIGw9Q==', 'WNIhSLyFo8c=', NULL, NULL, NULL, 1, '2019-10-29 12:05:34', '2019-11-28 14:49:38'),
(7, 3, 2, 9874165, 'Teste Professor Nível 2', 'n2@senai.br', 'M', 'OEqahg==', 'ZgkpAjjubn4=', NULL, NULL, NULL, 1, '2019-10-29 12:06:04', '2019-11-27 10:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_acessos`
--

CREATE TABLE `usuarios_acessos` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios_acessos`
--

INSERT INTO `usuarios_acessos` (`id`, `usuario`, `data`) VALUES
(3, 1, '2019-10-29 11:21:50'),
(4, 1, '2019-10-29 11:21:56'),
(6, 1, '2019-10-29 11:22:21'),
(8, 1, '2019-10-29 12:01:12'),
(12, 1, '2019-10-29 19:29:33'),
(13, 1, '2019-10-29 19:49:52'),
(16, 1, '2019-10-31 19:26:55'),
(19, 1, '2019-10-31 21:01:20'),
(20, 1, '2019-10-31 21:39:25'),
(23, 1, '2019-11-06 22:50:47'),
(26, 1, '2019-11-06 22:56:07'),
(29, 1, '2019-11-07 13:10:31'),
(30, 1, '2019-11-07 13:21:35'),
(31, 1, '2019-11-11 08:38:08'),
(35, 1, '2019-11-11 11:40:47'),
(36, 1, '2019-11-11 16:54:50'),
(37, 1, '2019-11-11 16:54:58'),
(38, 1, '2019-11-11 16:55:20'),
(39, 1, '2019-11-11 16:55:29'),
(40, 1, '2019-11-11 16:57:42'),
(42, 1, '2019-11-11 20:24:01'),
(44, 1, '2019-11-12 10:04:55'),
(47, 1, '2019-11-12 23:24:15'),
(48, 1, '2019-11-12 20:26:27'),
(56, 1, '2019-11-20 17:20:11'),
(57, 1, '2019-11-20 21:48:28'),
(58, 1, '2019-11-21 00:28:14'),
(61, 1, '2019-11-21 12:38:32'),
(62, 1, '2019-11-21 14:41:21'),
(65, 1, '2019-11-22 13:23:28'),
(67, 1, '2019-11-26 13:49:25'),
(70, 1, '2019-11-26 20:29:11'),
(72, 1, '2019-11-27 01:45:19'),
(91, 1, '2019-11-27 12:18:42'),
(92, 1, '2019-11-27 12:19:18'),
(93, 1, '2019-11-27 12:22:54'),
(94, 1, '2019-11-27 12:24:18'),
(101, 1, '2019-11-27 12:38:39'),
(102, 1, '2019-11-27 12:38:55'),
(103, 1, '2019-11-27 12:39:19'),
(104, 1, '2019-11-27 12:39:28'),
(111, 1, '2019-11-27 13:07:12'),
(112, 1, '2019-11-27 13:07:35'),
(113, 1, '2019-11-27 13:07:51'),
(114, 1, '2019-11-27 13:26:53'),
(115, 1, '2019-11-27 16:03:26'),
(116, 1, '2019-11-27 20:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_vinculado`
--

CREATE TABLE `usuario_vinculado` (
  `unidade_curricular` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aprovacoes`
--
ALTER TABLE `aprovacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aprovacoes_questoes1_idx` (`questao`),
  ADD KEY `fk_aprovacoes_usuarios1_idx` (`usuario`);

--
-- Indexes for table `capacidades`
--
ALTER TABLE `capacidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_capacidades_disciplina1_idx` (`unidade_curricular`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`,`unidade`),
  ADD KEY `fk_cursos_unidades_idx` (`unidade`);

--
-- Indexes for table `funcionalidades`
--
ALTER TABLE `funcionalidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GRUPOS_herda` (`herda`);

--
-- Indexes for table `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PRIVILEGIOS_grupo` (`grupo`),
  ADD KEY `FK_PRIVILEGIOS_funcionalidade` (`funcionalidade`);

--
-- Indexes for table `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_questoes_disciplina1_idx` (`unidade_curricular`),
  ADD KEY `fk_questoes_usuarios1_idx` (`usuario`),
  ADD KEY `fk_questoes_capacidades1_idx` (`capacidade`) USING BTREE;

--
-- Indexes for table `questoes_imagens`
--
ALTER TABLE `questoes_imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_QUESTOES_IMAGENS_questao` (`questao`);

--
-- Indexes for table `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unidades_curriculares`
--
ALTER TABLE `unidades_curriculares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_unidadeCurricular_cursos1_idx` (`curso`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USUARIOS_grupo` (`grupo`),
  ADD KEY `FK_USUARIOS_unidade` (`unidade`);

--
-- Indexes for table `usuarios_acessos`
--
ALTER TABLE `usuarios_acessos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USUARIOS_ACESSOS_usuario` (`usuario`);

--
-- Indexes for table `usuario_vinculado`
--
ALTER TABLE `usuario_vinculado`
  ADD PRIMARY KEY (`unidade_curricular`,`usuario`),
  ADD KEY `fk_unidadeCurricular_has_usuarios_usuarios1_idx` (`usuario`),
  ADD KEY `fk_unidadeCurricular_has_usuarios_unidadeCurricular1_idx` (`unidade_curricular`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `capacidades`
--
ALTER TABLE `capacidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `funcionalidades`
--
ALTER TABLE `funcionalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questoes_imagens`
--
ALTER TABLE `questoes_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unidades_curriculares`
--
ALTER TABLE `unidades_curriculares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usuarios_acessos`
--
ALTER TABLE `usuarios_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aprovacoes`
--
ALTER TABLE `aprovacoes`
  ADD CONSTRAINT `fk_aprovacoes_questoes1` FOREIGN KEY (`questao`) REFERENCES `questoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aprovacoes_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `capacidades`
--
ALTER TABLE `capacidades`
  ADD CONSTRAINT `fk_capacidades_disciplina1` FOREIGN KEY (`unidade_curricular`) REFERENCES `unidades_curriculares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_unidades` FOREIGN KEY (`unidade`) REFERENCES `unidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `FK_GRUPOS_herda` FOREIGN KEY (`herda`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `privilegios`
--
ALTER TABLE `privilegios`
  ADD CONSTRAINT `FK_PRIVILEGIOS_funcionalidade` FOREIGN KEY (`funcionalidade`) REFERENCES `funcionalidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_PRIVILEGIOS_grupo` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questoes`
--
ALTER TABLE `questoes`
  ADD CONSTRAINT `fk_questoes_capacidades1` FOREIGN KEY (`capacidade`) REFERENCES `capacidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questoes_disciplina1` FOREIGN KEY (`unidade_curricular`) REFERENCES `unidades_curriculares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questoes_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questoes_imagens`
--
ALTER TABLE `questoes_imagens`
  ADD CONSTRAINT `FK_QUESTOES_IMAGENS_questao` FOREIGN KEY (`questao`) REFERENCES `questoes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unidades_curriculares`
--
ALTER TABLE `unidades_curriculares`
  ADD CONSTRAINT `fk_unidadeCurricular_cursos1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_USUARIOS_grupo` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `FK_USUARIOS_unidade` FOREIGN KEY (`unidade`) REFERENCES `unidades` (`id`);

--
-- Constraints for table `usuarios_acessos`
--
ALTER TABLE `usuarios_acessos`
  ADD CONSTRAINT `FK_USUARIOS_ACESSOS_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usuario_vinculado`
--
ALTER TABLE `usuario_vinculado`
  ADD CONSTRAINT `fk_unidadeCurricular_has_usuarios_unidadeCurricular1` FOREIGN KEY (`unidade_curricular`) REFERENCES `unidades_curriculares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_unidadeCurricular_has_usuarios_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
