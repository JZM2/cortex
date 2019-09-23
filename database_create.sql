-- Vytvoøeno: Pon 23. záø 2019, 17:23
-- Verze serveru: 5.7.27-log
-- Verze PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Databáze: `cortex`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `typ` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `card`
--

INSERT INTO `card` (`id`, `typ`) VALUES
(123, 'základní'),
(321, 'základní'),
(456, 'základní'),
(654, 'základní'),
(789, 'základní');

-- --------------------------------------------------------

--
-- Struktura tabulky `card_customer`
--

CREATE TABLE `card_customer` (
  `card_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `good`
--

CREATE TABLE `good` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `card_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Zástupná struktura pro pohled `reporttopcustomers`
-- (See below for the actual view)
--
CREATE TABLE `reporttopcustomers` (
`id` int(11)
,`name` varchar(100)
,`surname` varchar(100)
,`adress` varchar(255)
,`email` varchar(255)
,`telephone` varchar(255)
,`registration` datetime
,`sumCustom` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Struktura pro pohled `reporttopcustomers`
--
DROP TABLE IF EXISTS `reporttopcustomers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jzm`@`localhost` SQL SECURITY DEFINER VIEW `reporttopcustomers`  AS  select `cu`.`id` AS `id`,`cu`.`name` AS `name`,`cu`.`surname` AS `surname`,`cu`.`adress` AS `adress`,`cu`.`email` AS `email`,`cu`.`telephone` AS `telephone`,`cu`.`registration` AS `registration`,`sumCustom`(`cu`.`id`) AS `sumCustom` from `customer` `cu` order by `sumCustom` desc limit 10 ;

--
-- Klíèe pro exportované tabulky
--

--
-- Klíèe pro tabulku `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Klíèe pro tabulku `card_customer`
--
ALTER TABLE `card_customer`
  ADD PRIMARY KEY (`card_id`,`customer_id`),
  ADD KEY `IDX_3808408A4ACC9A20` (`card_id`),
  ADD KEY `IDX_3808408A9395C3F3` (`customer_id`);

--
-- Klíèe pro tabulku `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Klíèe pro tabulku `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6C844E92558FBEB9` (`purchase_id`);

--
-- Klíèe pro tabulku `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6117D13B4ACC9A20` (`card_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=790;

--
-- AUTO_INCREMENT pro tabulku `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `good`
--
ALTER TABLE `good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `card_customer`
--
ALTER TABLE `card_customer`
  ADD CONSTRAINT `FK_3808408A4ACC9A20` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`),
  ADD CONSTRAINT `FK_3808408A9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Omezení pro tabulku `good`
--
ALTER TABLE `good`
  ADD CONSTRAINT `FK_6C844E92558FBEB9` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`);

--
-- Omezení pro tabulku `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `FK_6117D13B4ACC9A20` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`);
COMMIT;
