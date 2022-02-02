-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 nov. 2021 à 23:59
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT /;
/!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS /;
/!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION /;
/!40101 SET NAMES utf8mb4 */;

--
-- Base de données : roddit
--

-- --------------------------------------------------------

--
-- Structure de la table like
--

CREATE TABLE `like` (
                      idUser int(11) NOT NULL,
                      idPost int(11) NOT NULL,
                      statut BOOLEAN NOT NULL,
                      dateLike DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `like`
    ADD FOREIGN KEY (idUser) REFERENCES Users(id),
  ADD FOREIGN KEY (idPost) REFERENCES Posts(id);