SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

create database `agenda`;
use `agenda`;

CREATE TABLE `tb_contatos` (
  `id_contatos` int NOT NULL,
  `nome_contatos` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `fone_contatos` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email_contatos` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_contatos` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `foto_user` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `nome_user` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_user` varchar(150) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `tb_contatos`
  ADD PRIMARY KEY (`id_contatos`);

ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

ALTER TABLE `tb_contatos`
  MODIFY `id_contatos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
