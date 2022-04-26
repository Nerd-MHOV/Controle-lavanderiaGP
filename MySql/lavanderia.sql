-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Abr-2022 às 21:13
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lavanderia`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AtualizaEstoque` (IN `id_prod` INT, IN `input_amount` INT, IN `id_depart` INT)  BEGIN
    declare counter int(11);

    SELECT count(*) into counter FROM inventory WHERE id_product = id_prod;

    IF counter > 0 THEN
        UPDATE inventory SET amount=amount + input_amount
        WHERE id_product = id_prod;
    ELSE
        INSERT INTO inventory (id_product, amount, id_department) values (id_prod, input_amount, id_depart);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `collaborator`
--

CREATE TABLE `collaborator` (
  `id` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `collaborator` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `collaborator`
--

INSERT INTO `collaborator` (`id`, `id_department`, `collaborator`, `cpf`, id_type, `created_at`, `updated_at`) VALUES
(0, 0, 'SETOR', '000.000.000-00', 'SETOR', NULL, NULL),
(1, 1, 'Matheus Henrique de Oliveira Viana', '480.111.628-02', 'mesalista', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `department`
--

INSERT INTO `department` (`id`, `department`, `created_at`, updated_at) VALUES
(1, 'Monitoria', NULL, NULL),
(2, 'Cozinha', NULL, NULL),
(3, 'Jardim', NULL, NULL),
(4, 'Manutenção', NULL, NULL),
(5, 'Recepção', NULL, NULL),
(6, 'Portaria', NULL, NULL),
(11, 'Governança', NULL, NULL),
(12, 'Equipe Salão', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `department_head`
--

CREATE TABLE `department_head` (
  `id` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `input`
--

CREATE TABLE `input` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `input`
--

INSERT INTO `input` (`id`, `id_product`, `id_department`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, '2022-03-19 14:21:38', NULL),
(2, 2, 1, 100, '2022-03-19 14:21:38', NULL),
(3, 3, 1, 150, '2022-03-19 14:21:38', NULL);

--
-- Acionadores `input`
--
DELIMITER $$
CREATE TRIGGER `TRG_EntradaProduto_AD` AFTER DELETE ON `input` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoque (old.id_product, old.amount * -1, old.id_department);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TRG_EntradaProduto_AI` AFTER INSERT ON `input` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount, new.id_department);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TRG_EntradaProduto_AU` AFTER UPDATE ON `input` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount - old.amount, new.id_department);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `inventory`
--

INSERT INTO `inventory` (`id`, `id_product`, `id_department`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 123, NULL, NULL),
(2, 2, 1, 87, NULL, NULL),
(3, 3, 1, 129, NULL, NULL),
(4, 0, 0, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `output`
--

CREATE TABLE `output` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_collaborator` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `output`
--

INSERT INTO `output` (`id`, `id_product`, `id_department`, `id_collaborator`, `id_user`, `amount`, `status`, `obs`, `created_at`, `updated_at`) VALUES
(51, 1, 1, 0, 2, 5, 'bom', NULL, '2022-04-13 17:40:44', '2022-04-13 18:12:02'),
(52, 2, 1, 1, 2, 1, 'ruim', 'Toda Manchada', '2022-04-13 18:16:37', '2022-04-13 18:16:37');

--
-- Acionadores `output`
--
DELIMITER $$
CREATE TRIGGER `TRG_SaidaProduto_AD` AFTER DELETE ON `output` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoque (old.id_department, old.amount, old.id_department);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TRG_SaidaProduto_AI` AFTER INSERT ON `output` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount * -1, new.id_department);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TRG_SaidaProduto_AU` AFTER UPDATE ON `output` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoque (new.id_product, old.amount - new.amount, new.id_department);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `id_department` int(11) NOT NULL,
  `id_product_type` int(11) NOT NULL,
  `id_product_service` int(11) NOT NULL,
  `product` varchar(25) NOT NULL,
  `unitary_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`id`, `status`, `id_department`, `id_product_type`, `id_product_service`, `product`, `unitary_value`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, 1, 1, 'Luxo', 'R$ 10,00', NULL, NULL),
(2, 'A', 1, 1, 1, 'Padrão', 'R$ 20,00', NULL, NULL),
(3, 'A', 1, 2, 1, 'Pequena', 'R$ 2,00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_service`
--

CREATE TABLE `product_service` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `product_service`
--

INSERT INTO `product_service` (`id`, `service`, `created_at`, `updated_at`) VALUES
(1, 'Geral', NULL, NULL),
(2, 'Hotel Fazenda', NULL, NULL),
(3, 'Resort', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `product_type`
--

INSERT INTO `product_type` (`id`, `product_type`, `created_at`, `updated_at`) VALUES
(1, 'Toalha', NULL, NULL),
(2, 'Manta', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_collaborator` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `amountBad` int(11) DEFAULT NULL,
  `status_in` varchar(255) NOT NULL,
  `status_out` varchar(255) NOT NULL,
  `obs_in` varchar(255) DEFAULT NULL,
  `obs_out` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `returns`
--

INSERT INTO `returns` (`id`, `id_product`, `id_department`, `id_collaborator`, `id_user`, `amount`, `amountBad`, `status_in`, `status_out`, `obs_in`, `obs_out`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 2, 1, NULL, 'ruim', 'NULL', NULL, NULL, '2022-04-11 21:37:24', '2022-04-11 21:37:24'),
(2, 1, 0, 0, 2, 1, NULL, 'bom', 'NULL', NULL, NULL, '2022-04-11 21:37:57', '2022-04-11 21:37:57'),
(3, 1, 0, 0, 2, 1, NULL, 'bom', 'ruim', NULL, NULL, '2022-04-11 21:40:24', '2022-04-11 21:40:24'),
(4, 1, 0, 0, 2, 1, NULL, 'bom', 'ruim', NULL, 'NULL', '2022-04-11 21:41:06', '2022-04-11 21:41:06'),
(5, 1, 0, 0, 2, 1, NULL, 'bom', 'ruim', NULL, '', '2022-04-11 21:42:02', '2022-04-11 21:42:02'),
(6, 1, 0, 0, 2, 1, NULL, 'bom', 'ruim', NULL, 'teste DB', '2022-04-11 21:42:50', '2022-04-11 21:42:50'),
(7, 1, 1, 1, 2, 1, NULL, 'bom', 'ruim', NULL, 'Teste de DB\r\n', '2022-04-11 21:48:30', '2022-04-11 21:48:30'),
(8, 1, 1, 1, 2, 1, NULL, 'bom', 'bom', NULL, '', '2022-04-12 20:06:37', '2022-04-12 20:06:37'),
(9, 1, 1, 1, 2, 1, NULL, 'bom', 'bom', NULL, '', '2022-04-12 20:09:27', '2022-04-12 20:09:27'),
(10, 1, 1, 0, 2, 10, 0, 'bom', 'bom', NULL, '', '2022-04-13 18:04:01', '2022-04-13 18:04:01'),
(11, 1, 1, 0, 2, 10, 0, 'bom', 'bom', NULL, '', '2022-04-13 18:05:00', '2022-04-13 18:05:00'),
(12, 1, 1, 0, 2, 5, 3, 'bom', 'ruim', NULL, 'Danificado pelos hospedes', '2022-04-13 18:06:16', '2022-04-13 18:06:16'),
(13, 1, 1, 1, 2, 1, 0, 'bom', 'bom', NULL, '', '2022-04-13 18:06:40', '2022-04-13 18:06:40'),
(14, 1, 1, 0, 2, 1, 0, 'bom', 'bom', NULL, '', '2022-04-13 18:11:01', '2022-04-13 18:11:01'),
(15, 1, 1, 0, 2, 4, 0, 'bom', 'bom', NULL, '', '2022-04-13 18:12:03', '2022-04-13 18:12:03'),
(16, 1, 1, 1, 2, 1, 0, 'ruim', 'ruim', 'ta com defeito ai o', 'ta com defeito ai o', '2022-04-13 18:12:20', '2022-04-13 18:12:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `forget` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `user`, `passwd`, `photo`, `forget`, `created_at`, `updated_at`) VALUES
(2, 'Matheus', 'Henrique', 'matheus.henrique42452@gmail.com', 'admin', '$2y$10$pwGtIVIjdszCjYqZROgwqOmbNYDk4ZD1UjKH4d0.I9jfc0QkuXMIq', NULL, NULL, '2022-03-22 01:25:32', '2022-03-22 01:25:32');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `collaborator`
--
ALTER TABLE `collaborator`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `department_head`
--
ALTER TABLE `department_head`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `input`
--
ALTER TABLE `input`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `output`
--
ALTER TABLE `output`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product_service`
--
ALTER TABLE `product_service`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `collaborator`
--
ALTER TABLE `collaborator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `department_head`
--
ALTER TABLE `department_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `input`
--
ALTER TABLE `input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `output`
--
ALTER TABLE `output`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `product_service`
--
ALTER TABLE `product_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
