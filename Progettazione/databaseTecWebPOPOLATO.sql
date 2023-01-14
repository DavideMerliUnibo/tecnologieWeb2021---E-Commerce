-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3340
-- Creato il: Gen 14, 2023 alle 16:53
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasefunghi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto`
--
CREATE DATABASE databasefunghi;
USE databasefunghi;

CREATE TABLE `acquisto` (
  `codice` int(11) NOT NULL,
  `data` date NOT NULL,
  `totale` decimal(5,2) NOT NULL,
  `acquirente` varchar(30) NOT NULL,
  `idCarta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `acquisto`
--

INSERT INTO `acquisto` (`codice`, `data`, `totale`, `acquirente`, `idCarta`) VALUES
(17, '2022-12-29', '15.00', 'LuxMasayuki@gmail.com', 14),
(18, '2023-01-13', '15.00', 'davide.merli5@studio.unibo.it', 15),
(19, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(20, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(21, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(22, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(23, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(24, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(25, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(26, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(27, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(28, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(29, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(30, '2023-01-13', '48.54', 'davide.merli5@studio.unibo.it', 15),
(31, '2023-01-13', '485.40', 'davide.merli5@studio.unibo.it', 15),
(32, '2023-01-13', '700.00', 'LuxMasayuki@gmail.com', 5),
(33, '2023-01-13', '700.00', 'LuxMasayuki@gmail.com', 5),
(34, '2023-01-14', '194.16', 'davide.merli5@studio.unibo.it', 5),
(37, '2023-01-14', '14.91', 'testuser@gmail.com', 15),
(38, '2023-01-14', '14.91', 'testuser@gmail.com', 20),
(39, '2023-01-14', '999.99', 'davide.merli5@studio.unibo.it', 15),
(40, '2023-01-14', '41.25', 'ev.giangusto@yahoo.it', 21),
(41, '2023-01-14', '124.00', 'ryan.perrina@studio.unibo.it', 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto_prodotto`
--

CREATE TABLE `acquisto_prodotto` (
  `codProdotto` int(11) NOT NULL,
  `codAcquisto` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `acquisto_prodotto`
--

INSERT INTO `acquisto_prodotto` (`codProdotto`, `codAcquisto`, `quantità`) VALUES
(2, 17, 1),
(2, 18, 1),
(6, 19, 1),
(6, 20, 1),
(6, 21, 1),
(6, 22, 1),
(6, 23, 1),
(6, 24, 1),
(6, 25, 1),
(6, 26, 1),
(6, 27, 1),
(6, 28, 1),
(6, 29, 1),
(6, 30, 1),
(6, 31, 10),
(15, 32, 20),
(15, 33, 20),
(6, 34, 4),
(1, 37, 1),
(1, 38, 1),
(6, 39, 25),
(4, 40, 3),
(8, 41, 5),
(15, 41, 1),
(19, 41, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `cod` int(11) NOT NULL,
  `utente` varchar(30) NOT NULL,
  `totaleCarrello` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`cod`, `utente`, `totaleCarrello`) VALUES
(1, 'ryan.perrina@studio.unibo.it', '0.00'),
(2, 'manuel.luzietti@studio.unibo.i', '0.00'),
(3, 'LuxMasayuki@gmail.com', '0.00'),
(4, 'davide.merli5@studio.unibo.it', '0.00'),
(5, 'testuser@gmail.com', '0.00'),
(9, 'ev.giangusto@yahoo.it', '0.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `cartadicredito`
--

CREATE TABLE `cartadicredito` (
  `ID` int(11) NOT NULL,
  `codiceCarta` varchar(16) NOT NULL,
  `titolare` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cartadicredito`
--

INSERT INTO `cartadicredito` (`ID`, `codiceCarta`, `titolare`) VALUES
(5, '555', 'LuxMasayuki@gmail.com'),
(8, '7', 'LuxMasayuki@gmail.com'),
(14, '111', 'LuxMasayuki@gmail.com'),
(15, '999', 'davide.merli5@studio.unibo.it'),
(20, '789', 'testuser@gmail.com'),
(21, '446', 'ev.giangusto@yahoo.it'),
(22, '222', 'ryan.perrina@studio.unibo.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `codice` int(11) NOT NULL,
  `contenuto` varchar(280) NOT NULL,
  `data` date NOT NULL,
  `ricetta` varchar(30) NOT NULL,
  `autore` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`codice`, `contenuto`, `data`, `ricetta`, `autore`) VALUES
(1, 'Sempre un buon piatto, gustoso e facile da preparare.', '0000-00-00', 'Risotto ai porcini', 'ryan.perrina@studio.unibo.it'),
(2, 'Molto buono, ci ho fatto delle bruschette ai funghi.', '0000-00-00', 'Funghi trifolati', 'davide.merli5@studio.unibo.it'),
(3, 'A me non piacciono i funghi.', '0000-00-00', 'Funghi trifolati', 'ryan.perrina@studio.unibo.it'),
(5, 'aaaa', '2022-12-28', 'Funghi trifolati', 'LuxMasayuki@gmail.com'),
(9, 'Una vera delizia :)', '2023-01-14', 'Conchiglie funghi besciamella', 'testuser@gmail.com'),
(10, 'I conchiglioni ripieni di funghi sono sempre squisiti. Io conoscevo un\'altra variante con la ricotta ma anche questa niente male', '2023-01-14', 'Conchiglie funghi besciamella', 'LuxMasayuki@gmail.com'),
(12, 'Non sono un grande fan dei fagioli, per me il piatto funziona bene anche senza', '2023-01-14', 'Pasta con funghi e fagioli', 'davide.merli5@studio.unibo.it'),
(13, 'Ricetta sì documentata e deliziosa, una vera sfiziosità!', '2023-01-14', 'Lasagna di zucca con funghi', 'ev.giangusto@yahoo.it'),
(14, 'Cavolo che buone. Complimenti davvero!', '2023-01-14', 'Lasagna di zucca con funghi', 'manuel.luzietti@studio.unibo.i');

-- --------------------------------------------------------

--
-- Struttura della tabella `fungo_ricetta`
--

CREATE TABLE `fungo_ricetta` (
  `titoloRicetta` varchar(30) NOT NULL,
  `nomeFungo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagineprodotto`
--

CREATE TABLE `immagineprodotto` (
  `codProdotto` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `immagineprodotto`
--

INSERT INTO `immagineprodotto` (`codProdotto`, `nome`) VALUES
(1, 'b-edulis-1.jpg'),
(1, 'b-edulis-2.jpg'),
(2, 'amanita-1.jpg'),
(2, 'amanita-2.jpg'),
(3, 'gyromitra-esc-1.jpg'),
(3, 'gyromitra-esc-2.jpg'),
(4, 'finferlo-1.jpg'),
(4, 'finferlo-2.jpg'),
(5, 'ram-pallida-1.jpg'),
(5, 'ram-pallida-2.jpg'),
(6, 'b-edulis-4.jpeg'),
(8, 'morchella-1.jpg'),
(8, 'morchella-2.jpg'),
(15, 'mycena-chlorophos01.jpg'),
(15, 'mycena-chlorophos02.jpg'),
(18, 'champignon-1.jpg'),
(18, 'champignon-2.jpg'),
(19, 'shittake-1.jpg'),
(19, 'shittake-2.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `immaginericetta`
--

CREATE TABLE `immaginericetta` (
  `titoloRicetta` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `immaginericetta`
--

INSERT INTO `immaginericetta` (`titoloRicetta`, `nome`) VALUES
('Conchiglie funghi besciamella', 'conc-basciamella-1.jpg'),
('Conchiglie funghi besciamella', 'conc-basciamella-2.jpg'),
('Funghi trifolati', 'trifolati-1.jpg'),
('Funghi trifolati', 'trifolati-2.jpg'),
('Lasagna di zucca con funghi', 'lasagne-1.jpg'),
('Lasagna di zucca con funghi', 'lasagne-2.jpg'),
('Pasta con funghi e fagioli', 'pasta-funghi-fagioli-1.jpeg'),
('Pasta con funghi e fagioli', 'pasta-funghi-fagioli-2.jpeg'),
('Risotto ai porcini', 'risotto-porcini-1.jpg'),
('Risotto ai porcini', 'risotto-porcini-2.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `titoloRicetta` varchar(30) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `quantità` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`titoloRicetta`, `nome`, `quantità`) VALUES
('Conchiglie funghi besciamella', 'Aglio', '2 spicchi'),
('Conchiglie funghi besciamella', 'Conchiglioni', '300 g'),
('Conchiglie funghi besciamella', 'Funghi champignon', '500 g'),
('Conchiglie funghi besciamella', 'Grana Padano', '100 g'),
('Conchiglie funghi besciamella', 'Olio', '1/2 bicchiere'),
('Conchiglie funghi besciamella', 'Pecorino', '50 g'),
('Conchiglie funghi besciamella', 'Prezzemolo', '2 cucchiai'),
('Conchiglie funghi besciamella', 'Prosciutto cotto', '125 g'),
('Conchiglie funghi besciamella', 'Sale fino', 'q. b.'),
('Conchiglie funghi besciamella', 'Zucchine', '2'),
('Funghi trifolati', 'Aglio', '1 spicchio'),
('Funghi trifolati', 'Burro', '30 g'),
('Funghi trifolati', 'Funghi mis', '800 g'),
('Funghi trifolati', 'Olio', '40 g'),
('Funghi trifolati', 'Prezzemolo', 'q. b.'),
('Lasagna di zucca con funghi', 'Funghi champignon', '350 g'),
('Lasagna di zucca con funghi', 'Olio', '30 g'),
('Lasagna di zucca con funghi', 'Panna fresca', '150 g'),
('Lasagna di zucca con funghi', 'Parmigiano Reggiano', '60 g'),
('Lasagna di zucca con funghi', 'Pepe nero', 'q. b.'),
('Lasagna di zucca con funghi', 'Rosmarino', '5 rametti'),
('Lasagna di zucca con funghi', 'Sale fino', 'q. b.'),
('Lasagna di zucca con funghi', 'Scamorza', '400 g'),
('Lasagna di zucca con funghi', 'Timo', '5 rametti'),
('Lasagna di zucca con funghi', 'Zucca', '500 g'),
('Pasta con funghi e fagioli', 'Acqua', '20 g'),
('Pasta con funghi e fagioli', 'Cipollotto fresco', '50 g'),
('Pasta con funghi e fagioli', 'Fagioli precotti', '370 g'),
('Pasta con funghi e fagioli', 'Funghi champignon', '300 g'),
('Pasta con funghi e fagioli', 'Fusilli integrali', '320 g'),
('Pasta con funghi e fagioli', 'Olio', 'q. b.'),
('Pasta con funghi e fagioli', 'Pancetta a dadini', '180 g'),
('Pasta con funghi e fagioli', 'Pepe nero', 'q. b.'),
('Pasta con funghi e fagioli', 'Rosmarino', 'q. b.'),
('Pasta con funghi e fagioli', 'Sale fino', 'q. b.'),
('Risotto ai porcini', 'Aglio', '1 spicchio'),
('Risotto ai porcini', 'Brodo', '1 l'),
('Risotto ai porcini', 'Burro', '30 g'),
('Risotto ai porcini', 'Cipolle', '1 piccola'),
('Risotto ai porcini', 'Olio', '2 cucchiai'),
('Risotto ai porcini', 'Pepe nero', 'q. b.'),
('Risotto ai porcini', 'Porcini', '400 g'),
('Risotto ai porcini', 'Riso', '320 g'),
('Risotto ai porcini', 'Sale fino', 'q. b.');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `codice` int(11) NOT NULL,
  `messaggio` varchar(280) NOT NULL,
  `data` date NOT NULL,
  `utente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`codice`, `messaggio`, `data`, `utente`) VALUES
(1, 'Acquisto avvenuto con successo!', '2022-12-28', 'LuxMasayuki@gmail.com'),
(2, 'Acquisto completato!', '2022-12-28', 'LuxMasayuki@gmail.com'),
(3, 'Acquisto avvenuto con successo!', '2022-12-28', 'LuxMasayuki@gmail.com'),
(4, 'Acquisto completato!', '2022-12-28', 'LuxMasayuki@gmail.com'),
(5, 'Acquisto avvenuto con successo!', '2022-12-29', 'LuxMasayuki@gmail.com'),
(6, 'Acquisto completato!', '2022-12-29', 'LuxMasayuki@gmail.com'),
(7, 'Acquisto avvenuto con successo!', '2022-12-29', 'LuxMasayuki@gmail.com'),
(8, 'Acquisto completato!', '2022-12-29', 'LuxMasayuki@gmail.com'),
(9, 'Acquisto avvenuto con successo!', '2022-12-29', 'LuxMasayuki@gmail.com'),
(10, 'Acquisto completato!', '2022-12-29', 'LuxMasayuki@gmail.com'),
(11, 'Prodotto inserito!', '2023-01-10', 'davide.merli5@studio.unibo.it'),
(12, 'Immagine aggiunta!', '2023-01-10', 'davide.merli5@studio.unibo.it'),
(13, 'Immagine aggiunta!', '2023-01-10', 'davide.merli5@studio.unibo.it'),
(14, 'Info utente aggiornate!', '2023-01-10', 'davide.merli5@studio.unibo.it'),
(15, 'Info utente aggiornate!', '2023-01-11', 'davide.merli5@studio.unibo.it'),
(21, 'Acquisto completato!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(33, 'E\' stato acquistato un Boletus edulis.', '2023-01-13', 'LuxMasayuki@gmail.com'),
(35, 'Sono stati acquistati 10 Boletus edulis.', '2023-01-13', 'LuxMasayuki@gmail.com'),
(36, 'Acquisto completato!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(38, 'Acquisto completato!', '2023-01-13', 'LuxMasayuki@gmail.com'),
(39, 'Sono stati acquistati 20 Mycena chlorophos.', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(40, 'Il prodotto Mycena chlorophos è esaurito.', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(41, 'Acquisto completato!', '2023-01-13', 'LuxMasayuki@gmail.com'),
(42, 'Prodotto modificato!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(43, 'Prodotto inserito!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(44, 'Prodotto eliminato!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(45, 'Prodotto inserito!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(46, 'Prodotto eliminato!', '2023-01-13', 'davide.merli5@studio.unibo.it'),
(50, 'E\' stato acquistato un Amanita muscaria.', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(53, 'Acquisto completato!', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(54, 'Registrazione avvenuta con successo!\n            Benvenuto su tuttofungo.it. Qui puoi mettere in vendita i tuoi prodotti e condividere ricette con altri amanti dei funghi!', '2023-01-14', 'testuser@gmail.com'),
(55, 'E\' stato acquistato un Boletus edulis.', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(56, 'Acquisto completato!', '2023-01-14', 'testuser@gmail.com'),
(57, 'E\' stato acquistato un Boletus edulis.', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(59, 'Sono stati acquistati 25 Boletus edulis.', '2023-01-14', 'LuxMasayuki@gmail.com'),
(60, 'Il prodotto Boletus edulis è esaurito.', '2023-01-14', 'LuxMasayuki@gmail.com'),
(61, 'Acquisto completato!', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(62, 'Errore nell\'acquisto!', '2023-01-14', 'testuser@gmail.com'),
(63, 'Prodotto modificato!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(64, 'Prodotto eliminato!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(65, 'Prodotto eliminato!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(66, 'Prodotto eliminato!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(67, 'Immagine eliminata!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(68, 'Immagine aggiunta!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(69, 'Prodotto inserito!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(70, 'Immagine aggiunta!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(71, 'Immagine aggiunta!', '2023-01-14', 'LuxMasayuki@gmail.com'),
(72, 'Prodotto inserito!', '2023-01-14', 'testuser@gmail.com'),
(73, 'Prodotto inserito!', '2023-01-14', 'testuser@gmail.com'),
(74, 'Prodotto modificato!', '2023-01-14', 'testuser@gmail.com'),
(75, 'Prodotto modificato!', '2023-01-14', 'testuser@gmail.com'),
(76, 'Immagine aggiunta!', '2023-01-14', 'testuser@gmail.com'),
(77, 'Immagine aggiunta!', '2023-01-14', 'testuser@gmail.com'),
(78, 'Prodotto inserito!', '2023-01-14', 'manuel.luzietti@studio.unibo.i'),
(79, 'Prodotto inserito!', '2023-01-14', 'manuel.luzietti@studio.unibo.i'),
(80, 'Immagine aggiunta!', '2023-01-14', 'manuel.luzietti@studio.unibo.i'),
(81, 'Immagine aggiunta!', '2023-01-14', 'manuel.luzietti@studio.unibo.i'),
(82, 'Immagine aggiunta!', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(83, 'Immagine aggiunta!', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(84, 'Immagine aggiunta!', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(85, 'Immagine aggiunta!', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(86, 'Registrazione avvenuta con successo!\n            Benvenuto su tuttofungo.it. Qui puoi mettere in vendita i tuoi prodotti e condividere ricette con altri amanti dei funghi!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(87, 'Immagine aggiunta!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(88, 'Immagine aggiunta!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(89, 'Sono stati acquistati 3 Cantharellus cibarius.', '2023-01-14', 'manuel.luzietti@studio.unibo.i'),
(90, 'Acquisto completato!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(91, 'Sono stati acquistati 5 Morchella .', '2023-01-14', 'ev.giangusto@yahoo.it'),
(92, 'E\' stato acquistato un Mycena chlorophos.', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(93, 'Sono stati acquistati 2 Lentinula edodes.', '2023-01-14', 'testuser@gmail.com'),
(94, 'Acquisto completato!', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(95, 'Immagine aggiunta!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(96, 'Immagine aggiunta!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(97, 'Ricetta modificata!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(98, 'Immagine aggiunta!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(99, 'Immagine aggiunta!', '2023-01-14', 'ev.giangusto@yahoo.it'),
(100, 'Ricetta inserita!', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(101, 'Immagine aggiunta!', '2023-01-14', 'davide.merli5@studio.unibo.it'),
(102, 'Immagine aggiunta!', '2023-01-14', 'davide.merli5@studio.unibo.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `codice` int(11) NOT NULL,
  `prezzoPerUnità` float NOT NULL,
  `quantità` int(11) NOT NULL,
  `informazioni` varchar(500) NOT NULL,
  `mediaValutazione` float NOT NULL,
  `nomeFungo` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `offerente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`codice`, `prezzoPerUnità`, `quantità`, `informazioni`, `mediaValutazione`, `nomeFungo`, `data`, `offerente`) VALUES
(1, 14.91, 6, 'Raccolto in val di Fiemme. Ideale per molte ricette. Non velenoso. Ottimo per molte ricette a base di porcini.', 4.25, 'Boletus edulis', '2022-12-27', 'davide.merli5@studio.unibo.it'),
(2, 15, 1, 'Conosciuta fin dai tempi antichi come fungo in grado di provocare allucinazioni. E\' tra i funghi più conosciuti, specie a causa del suo aspetto appariscente.Non mangiare (a meno di non essere masochisti o sciamani).', 2, 'Amanita muscaria', '2022-11-01', 'ryan.perrina@studio.unibo.it'),
(3, 42.5, 7, 'Conosciuto anche come \"Spugnola falsa\" o \"Marugola\", è un fungo che porta alla sindrome giromitrica, e quindi disturbi gastrointestinali, cefalee e disidratazioni, e in alcuni casi anche alla morte. Ben riconoscibile per via di un gambo chiaro, corto e irregolare e un cappello camoscio scuro, con costolature sinuose che lo rendono simile a un acino di uva passa avvizzita, nasce in primavere nei boschi di conifere.', 0, 'Gyromitra Esculenta', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(4, 13.75, 12, 'Indubbiamente uno dei funghi più apprezzati, in alcune nazioni sono preferiti addirittura ai porcini. Si presta bene alla conservazione sott\'olio oppure sott\'aceto o anche essiccato. In quest\'ultimo modo viene utilizzato per condire varie pietanze o altri funghi. Se consumato fresco è consigliabile la scottatura prima, altrimenti diventa leggermente amarognolo.', 0, 'Cantharellus cibarius', '2023-01-14', 'manuel.luzietti@studio.unibo.i'),
(5, 10, 60, 'Conosciuto anche come Manina Pallida, la Ramaria Pallida è simile alla Ramaria Formosa ma si distingue dalla sorella per via di un colore chiaro, tendente all’avorio con sfumature lilla all’apice dei rami. Larga 20 cm e alta 15 cm, è simile a un corallo o a un cavolfiore, e dal tronco partono rami venosi a forma di V. Cresce in estate e autunno in boschi di latifoglie e aghifoglie.', 0, 'Ramaria Pallida', '2023-01-14', 'ryan.perrina@studio.unibo.it'),
(6, 48.54, 25, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a nunc at mi venenatis vestibulum ut sit amet nisi. Cras consequat, tellus vitae pulvinar sagittis, nisi sem pulvinar felis, eu sollicitudin massa urna a magna. Mauris vehicula, mauris sit amet fringilla commodo, lacus lectus vestibulum lectus, sit amet eleifend urna lacus vel turpis. Curabitur sodales sagittis arcu quis mattis. Pellentesque placerat risus ac dignissim imperdiet. Aliquam nec vehicula metus, viverra auctor velit. Don', 2, 'Boletus edulis', '2022-12-21', 'LuxMasayuki@gmail.com'),
(8, 5, 8, 'Nota anche come spugnola, questo fungo primaverile si distingue per un cappello alveolato che ricorda appunto una spugna. Ne esistono più varietà per forma e colore e serve esperienza nella raccolta, perché possono confondersi con specie non commestibili. Le morchelle crude sono velenose, richiedono quindi molta attenzione al fine di eliminare in cottura le tossine contenute. In cucina sono utilizzate comunemente come contorno a piatti di carne e risotti. Sono vendute essiccate.', 0, 'Morchella ', '2023-01-13', 'ev.giangusto@yahoo.it'),
(15, 35, 19, 'Mycena chlorophos è una specie di fungo agarico della famiglia delle Mycenaceae. I corpi fruttiferi di Mycena chlorophos si trovano nelle foreste, dove crescono in gruppi su detriti legnosi come ramoscelli caduti, rami e corteccia.  La fruttificazione avviene solo nelle stagioni piovose di giugno/luglio e settembre/ottobre, quando l\'umidità relativa è di circa l\'88%. La luminescenza massima si verifica a 27 °C.', 0, 'Mycena chlorophos', '2023-01-10', 'davide.merli5@studio.unibo.it'),
(18, 19.99, 30, 'L\'Agaricus bisporus, è un fungo basidiomicete della famiglia delle Agaricaceae, molto apprezzato in cucina. È largamente coltivato e poi commercializzato in tutto il mondo; in questo caso è noto anche con il nome in francese di champignon.', 0, 'Agaricus bisporus', '2023-01-14', 'LuxMasayuki@gmail.com'),
(19, 32, 48, 'Il suo nome comune \"Shiitake\" deriva dalla parola Giapponese \"shii\" usata per indicare una varietà di albero di castagno e dalla parola \"take\" che significa fungo.È attualmente il secondo fungo commestibile più consumato al mondo, dopo lo champignon.', 0, 'Lentinula edodes', '2023-01-14', 'testuser@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_carrello`
--

CREATE TABLE `prodotto_carrello` (
  `codCarrello` int(11) NOT NULL,
  `codProdotto` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto_carrello`
--

INSERT INTO `prodotto_carrello` (`codCarrello`, `codProdotto`, `quantità`) VALUES
(5, 6, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

CREATE TABLE `recensione` (
  `codice` int(11) NOT NULL,
  `titolo` varchar(20) NOT NULL,
  `contenuto` varchar(500) NOT NULL,
  `valutazione` float NOT NULL,
  `data` date NOT NULL,
  `utente` varchar(30) NOT NULL,
  `codProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`codice`, `titolo`, `contenuto`, `valutazione`, `data`, `utente`, `codProdotto`) VALUES
(1, 'Bene ma non benissim', 'L\'ho usato per un bel risotto, molto buono, ma la scatola in cui è arrivato non era in ottime condizioni.', 3.5, '0000-00-00', 'ryan.perrina@studio.unibo.it', 1),
(2, 'Fungo di qualità', 'Miglior porcino mai mangiato in vita mia. Si sente che è freschissimo. Arrivato in tempi brevi, tra l\'altro.', 5, '0000-00-00', 'manuel.luzietti@studio.unibo.i', 1),
(3, 'Non ci siamo', 'La confezione era scadente, ed è arrivato dopo un mese da quando l\'ho ordinato. Molto male.', 1, '0000-00-00', 'davide.merli5@studio.unibo.it', 2),
(44, 'aaa', 'dffff', 5, '2023-01-05', 'LuxMasayuki@gmail.com', 2),
(46, 'Buono', 'Bello', 2, '2023-01-14', 'davide.merli5@studio.unibo.it', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `ricetta`
--

CREATE TABLE `ricetta` (
  `titolo` varchar(30) NOT NULL,
  `tabellaNutrizionale` int(11) NOT NULL,
  `difficoltà` float NOT NULL,
  `descrizione` varchar(500) NOT NULL,
  `procedimento` varchar(5000) NOT NULL,
  `consigli` varchar(2000) DEFAULT NULL,
  `data` date NOT NULL,
  `autore` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ricetta`
--

INSERT INTO `ricetta` (`titolo`, `tabellaNutrizionale`, `difficoltà`, `descrizione`, `procedimento`, `consigli`, `data`, `autore`) VALUES
('Conchiglie funghi besciamella', 4, 0, 'I conchiglioni ripieni di funghi, prosciutto e besciamella sono un primo piatto davvero stuzzicante che potremmo definire il classico piatto delle feste, da preparare anche la sera prima e infornare pochi minuti prima di pranzare. I conchiglioni rigati, proprio per la particolare forma cava, sono un classico formato di pasta da arricchire con i più svariati ripieni, come ricotta e carne macinata! In questa ricetta invece abbiamo scelto quello funghi champignon, zucchine, prosciutto cotto, bescia', 'Per prima cosa mondate i funghi e sminuzzateli (a cubetti di 1 cm di lato) utilizzando un coltello, fate la stessa cosa con le zucchine . In un tegame ampio tritare finemente gli spicchi d’aglio e farlo soffriggere senza farlo bruciare in 8 cucchiai d’olio, aggiungere gli champignons puliti e tagliati  e fateli cuocere a fuoco vivo. Al termine della cottura aggiungete il prezzemolo tritato e salate. Nel frattempo preparate la besciamella. In un altro tegame fate saltare i cubetti di prosciutto con le zucchine tagliate a pezzettini e due cucchiai di olio, fino a che le zucchine non si saranno intenerite. In un frullatore mettete i funghi (tranne 3-4 cucchiai che terrete da parte), le zucchine, il prosciutto, metà besciamella, 50 g di Grana Padano e 50 g di pecorino grattugiati; frullate alla minima velocità per pochissimi istanti, in modo da ottenere un composto dove i pezzi di funghi o zucchine rimangano visibili ma non eccessivamente grossi (tipo ragù). Nel frattempo lessate i conchiglioni, scolateli quando saranno molto al dente e metteteli sotto un getto di acqua fredda per fermare la cottura, poi versatevi sopra un filo di olio e mescolateli per far si che non si attacchino fra loro. Riempite i conchiglioni con il composto ottenuto, aiutandovi con un cucchiaio, e adagiateli uno vicino all’altro in una teglia oliata; riempite con i conchiglioni ripieni tutta la teglia, poi unite i funghi tenuti da parte alla besciamella rimasta (se fosse diventata troppo compatta aggiungete qualche cucchiaio di latte per renderla più liquida) e con la crema di besciamella e funghi ottenuta, ricoprite i conchiglioni, poi spolverizzateli con il restante Grana Padano grattugiato e poneteli in forno sotto il grill qualche minuto, giusto il tempo di ottenere una bella crosticina dorata (10 minuti circa). Servite i conchiglioni ripieni immediatamente.', 'Volendo potreste preparare la teglia di conchiglioni ripieni la sera prima, e conservarla nel frigorifero coprendola con della pellicola trasparente. Tiratela fuori dal frigorifero mezz’ora prima di infornarla, in modo da farla rinvenire a temperatura ambiente. Per preparare i conchiglioni ripieni, al posto degli champignon, potete scegliere di adoperare altri tipi di funghi a vostro piacimento, persino i più pregiati porcini.', '2022-12-05', 'ev.giangusto@yahoo.it'),
('Funghi trifolati', 2, 2, 'I funghi trifolati sono perfetti per accompagnare a robusti piatti di carne, ottimi con la polenta oppure sul pane per deliziose bruschette.', 'Per prima cosa pulire i diversi tipi di funghi. Noi abbiamo usato porcini, champignon, pleurotus e finferli. Eliminate la parte terrosa con un pennellino, potete utilizzare anche un panno asciutto e tagliate via la parte terrosa del gambo con un coltellino. Se dovessero risultare molto sporchi potete passarli molto rapidamente sotto l\'acqua corrente, ma fate attenzione perchè i funghi assorbono molta acqua. Tagliate a fette sottili tutti i funghi scelti. Fate scaldare in una padella antiaderente il burro con l\'olio e lo spicchio di aglio tagliato a metà. Fate insaporire e versate nella padella prima i funghi porcini più sodi, fate saltare a fuoco vivace per un paio di minuti e poi unite gli altri funghi. Cuocete ancora per paio di minuti a fuoco vivace, mescolando sempre molto delicatamente. Aggiustate di sale e pepe e unite il prezzemolo finemente tritato. Togliete dal fuoco e servite i funghi trifolati caldi o freddi a seconda dell’uso che ne dovete fare.', 'Contrariamente a quanto si possa pensare, i funghi hanno bisogno di una cottura veloce, altrimenti rischiano di diventare una specie di poltiglia: se vogliamo mantenere la forma, quindi, ricordatevi di utilizzare una fiamma vivace. Se volete conservare i funghi trifolati per altre preparazioni, lasciate la cottura a metà, senza aggiungere prezzemolo e sale: la completerete quando sarà il momento. Se utilizzate i chiodini, ricordatevi di pulirli e sbollentarli per 15 minuti per eliminare le tossine.', '0000-00-00', 'manuel.luzietti@studio.unibo.i'),
('Lasagna di zucca con funghi', 58, 2, 'Le lasagne sono uno dei piatti più classici sempre molto apprezzati da grandi e piccini: ogni volta che fanno la loro comparsa sulla nostra tavola vanno sempre a ruba! In questa ricetta, al posto della tradizonale sfoglia all\'uovo, abbiamo riunito gustosi ingredienti di stagione che si alternano in un invitante mix di sapori: una morbida zucca, aromatizzata dal timo e dal rosmarino, avvolta da una deliziosa crema di funghi champignon e fettine di scamorza dolce. In un solo piatto assaporerete tu', 'Per preparare le lasagne di zucca con crema di funghi e scamorza sbucciate la zucca, tagliatela in 4 parti e pulite i filamenti e i semi interni. Tagliatela 10 g a cubetti e il resto a fette dello spessore di 1 cm con una mandolina. Foderate una leccarda con un foglio di carta da forno e distribuite le fette e i cubetti di zucca, versando un filo di olio . Condite con il rosmarino e il timo, conservando 2 rametto di entrambi (vi serviranno successivamente), e regolate di sale e pepe a vostro piacimento; fate cuocere in forno ventilato a 190° per 12 minuti (o a 210° per circa 20 minuti se in forno statico). Quando le fette di zucca saranno ben dorate, sfornate e lasciate intiepidire. Procedete quindi con la pulizia dei funghi: con un coltellino affilato dalla lama liscia cominciate a eliminare la parte terrosa sul gambo, raschiandolo con delicatezza fino ad eliminare qualsiasi traccia di terra. Se i funghi sono abbastanza puliti, eliminate i pochi residui di terra con un pennello oppure con un panno di cotone (se invece sono ancora molto sporchi, passateli velocemente sotto un getto di acqua corrente fredda). Terminata la pulizia, tagliate i funghi interi nel senso della lunghezza . In una padella antiaderente fate rosolare l’aglio in camicia con un filo d’olio e un rametto di rosmarino, il tempo necessario per insaporire l’olio. Togliete il rosmarino con una pinza da cucina  e versate i funghi affettati, regolando di sale e pepe. Aggiungete anche qualche fogliolina di timo che avete tenuto da parte per aromatizzare. Eliminate l’aglio e da ultimo versate la panna, facendo cuocere a fuoco vivace per 5 minuti e mescolando di tanto in tanto con un cucchiaio di legno o con una spatola. Quando i funghi saranno pronti, trasferite il tutto in una ciotola e con un frullatore ad immersione frullate fino ad ottenere una crema densa ed omogenea. Ora potete comporre le vostre lasagne: prendete una pirofila di 26x20 cm e distribuite sul fondo le fettine di zucca (private dei rametti di rosmarino e timo). Tagliate 20 g di scamorza a cubetti e il resto a fettine. Coprite con le fettine di scamorza e la crema di funghi, poi spolverizzate con il formaggio grattugiato. Proseguite con la stessa farcitura fino a creare 3 strati e terminate con uno strato di zucca a cubetti e con la scamorza a dadini. Infine aggiungete il Parmigiano grattugiato, qualche fogliolina di timo e un filo di olio. Cuocete in forno statico preriscaldato a 180° per 12 minuti (o a 160° per 8-10 minuti se in forno ventilato), poi passate sotto il grill per 4 minuti. A cottura ultimata sformate le lasagne di zucca con crema di funghi e scamorza e lasciatele intiepidire prima di servirle.', 'Volete dare un tocco più deciso e saporito alle vostre deliziose lasagne? Semplice! Vi basterà utilizzare la scamorza affumicata al posto di quella dolce oppure utilizzare dei funghi porcini al posto degli champignon!', '2023-01-14', 'davide.merli5@studio.unibo.it'),
('Pasta con funghi e fagioli', 3, 1, 'Quando l’aria si fa frizzante e la terra inumidita dalle piogge di stagione ha quel profumo muschiato inconfondibile, è segno che l’autunno è arrivato ed è ora di andare a funghi! Funghi fritti, funghi trifolati, risotto ai funghi e scaloppine ai funghi, questi sono gli immancabili piatti che arricchiscono le nostre tavole con i loro colori caldi e i sapori avvolgenti. Mentre nella bella stagione ci siamo concessi una deliziosa pasta e fagioli estiva, per variare i menu autunnali abbiamo pensato', 'Per realizzare la pasta con funghi e fagioli per prima cosa ponete sul fuoco un tegame colmo di acqua salate e portate al bollore, servirà per la cottura della pasta. Nel frattempo occupatevi del condimento: affettate sottilmente la parte chiara del cipollotto dopo aver eliminato le foglie più esterne. Ora occupatevi della pulizia dei funghi: eliminate la base del gambo e con un panno leggermente inumidito tamponateli per eliminare eventuali residui di terra, quindi affettateli sottilmente. Versate un filo di olio di oliva in un tegame, aggiungete il cipollotto. e lasciate rosolare a fuoco dolce per 2-3 minuti, poi aromatizzate con il rosmarino sfogliato. A questo punto aggiungete anche la pancetta e i funghi cuocete 5-6 minuti poi versate anche i fagioli precotti e aggiungete 20 g di acqua. Proseguite la cottura per altri 5 minuti e nel frattempo cuocete la pasta al dente e poi scolatela direttamente nel condimento. Allungate con un mestolo di acqua di cottura e saltate la pasta qualche istante per amalgamare i sapori. Servite subito la vostra pasta con funghi e fagioli.', 'Provate a sostituire i cannellini con i ceci e aggiungete semi di finocchietto per rendere ancora più aromatico il piatto!', '2023-01-14', 'ev.giangusto@yahoo.it'),
('Risotto ai porcini', 1, 3, 'Un buon risotto è sempre quello che ci vuole! Qualunque sia l’occasione, il risotto ai funghi porcini è una ricetta ricca di gusto e suggestioni… più che un piatto, una favola d’autunno!', 'Per prima cosa preparate il brodo vegetale. Ora occupatevi della pulizia dei porcini: eliminate la base con un coltello, raschiate il gambo per rimuovere tutti i residui di terra e, infine, strofinate delicatamente con un panno umido. Se il fungo dovesse essere molto terroso potete passarlo brevemente sotto un getto di acqua corrente, ma assicuratevi di asciugarlo immediatamente per evitare che assorba l’acqua. Una volta puliti, tagliate i funghi a fette dello spessore di circa 7-8 mm, mantenendo integra l’intera sezione quando possibile. Nel frattempo mondate e tritate finemente la cipolla. Sciogliete il burro in una casseruola, aggiungete la cipolla e lasciatela cuocere dolcemente per 10-15 minuti, aiutandovi con un mestolo di brodo se necessario. Quando la cipolla si sarà sciolta, unite il riso e fatelo tostare per un paio di minuti. Quando il riso sarà diventato quasi trasparente, portatelo a cottura aggiungendo un mestolo di brodo alla volta e mescolando spesso; assicuratevi che le bollicine di ebollizione rimangano costanti e che la fiamma non sia troppo aggressiva. Quando il riso sarà molto al dente, pochi minuti prima che sia pronto, unite i funghi porcini e finite la cottura, regolando di sale e pepe se necessario. Una volta cotto, mantecate il risotto a fuoco spento aggiungendo il burro e il parmigiano grattugiato.', 'In mancanza di funghi freschi di buona qualità, potete utilizzare anche i funghi secchi: il rapporto è di 1:10, quindi a 10 g di funghi secchi corrispondono 100 g di funghi freschi. In questo caso i funghi secchi andranno ammollati o sbollentati prima della cottura e potete utilizzare l’acqua di ammollo per arricchire il brodo vegetale con cui portare il riso a cottura. Se invece avete la fortuna di trovare i porcini freschi, scegliete preferibilmente quelli giovani con il cappello chiuso e tondeggiante; potete controllare che siano di buona qualità assicurandovi che il fungo non abbia una consistenza flaccida o appiccicosa e che la parte spugnosa non sia verdognola. Per un aroma ancora più intenso, provate a sostituire il prezzemolo con la nepitella, detta anche mentuccia!', '0000-00-00', 'davide.merli5@studio.unibo.it');

--
-- Trigger `ricetta`
--
DELIMITER $$
CREATE TRIGGER `t1` AFTER DELETE ON `ricetta` FOR EACH ROW delete from tabellanutrizionale 
where codice = old.tabellaNutrizionale
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `tabellanutrizionale`
--

CREATE TABLE `tabellanutrizionale` (
  `codice` int(11) NOT NULL,
  `valoreEnergetico` int(11) NOT NULL,
  `proteine` decimal(3,1) NOT NULL,
  `grassi` decimal(3,1) NOT NULL,
  `carboidrati` decimal(3,1) NOT NULL,
  `fibre` decimal(3,1) NOT NULL,
  `sodio` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tabellanutrizionale`
--

INSERT INTO `tabellanutrizionale` (`codice`, `valoreEnergetico`, `proteine`, `grassi`, `carboidrati`, `fibre`, `sodio`) VALUES
(1, 540, '14.0', '21.5', '72.3', '4.0', '0.7'),
(2, 196, '7.1', '17.5', '2.6', '4.7', '0.1'),
(3, 714, '21.5', '42.4', '61.7', '17.8', '1.0'),
(4, 854, '34.8', '43.7', '80.5', '9.5', '0.8'),
(58, 393, '23.5', '30.5', '6.3', '4.6', '0.6');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologiafungo`
--

CREATE TABLE `tipologiafungo` (
  `nomeScientifico` varchar(30) NOT NULL,
  `indiceRarità` float NOT NULL,
  `indiceQualità` float NOT NULL,
  `indiceVelenosità` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tipologiafungo`
--

INSERT INTO `tipologiafungo` (`nomeScientifico`, `indiceRarità`, `indiceQualità`, `indiceVelenosità`) VALUES
('Agaricus bisporus', 2, 8, 0),
('Amanita muscaria', 2, 5, 9),
('Boletus edulis', 1, 7, 0),
('Cantharellus cibarius', 4, 6, 2),
('Gyromitra Esculenta', 4, 2, 9),
('Lentinula edodes', 1, 10, 0),
('Morchella ', 2, 8, 0),
('Mycena chlorophos', 2, 10, 0),
('Ramaria Pallida', 5, 5, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `nome` varchar(15) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `indirizzo` varchar(25) NOT NULL,
  `data nascita` date NOT NULL,
  `funghiVendutiKg` int(11) DEFAULT 0,
  `offerteInserite` int(11) DEFAULT 0,
  `mediaValutazioni` float DEFAULT 0,
  `info_venditore` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`nome`, `cognome`, `email`, `password`, `username`, `indirizzo`, `data nascita`, `funghiVendutiKg`, `offerteInserite`, `mediaValutazioni`, `info_venditore`) VALUES
('Davide', 'Merli', 'davide.merli5@studio.unibo.it', 'password', 'davide.mer', 'via Saffi 52', '2000-07-12', 43, 3, 3.625, 'Sono un esperto venditore di funghi, fidatevi.'),
('Everaldo', 'Giangusto', 'ev.giangusto@yahoo.it', 'Password0?', 'everaldo.g', 'via Giovinotto 45', '1970-05-26', 5, 0, 0, 'Intenditore di funghi certificato. '),
('Lux', 'Masayuki', 'LuxMasayuki@gmail.com', 'password', 'adminn', 'Viale Cesena  5', '1996-04-26', 53, 2, 0.5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dolor enim, faucibus ultrices tortor eget, ornare iaculis mauris. Fusce ullamcorper commodo purus, eget cursus urna bibendum eu. In vitae commodo diam. Mauris dignissim sem diam, id maximus enim iaculis eu. Pellentesque at lectus consectetur erat hendrerit maximus. Nulla bibendum non enim sit amet placerat. Donec at sapien sit amet libero bibendum hendrerit. Etiam elementum elit lacus, non volutpat metus ullamcorper quis. Sed sit amet laoreet tortor. Nunc a molestie neque.\r\n\r\nDonec pharetra ante urna. Aliquam sit amet cursus augue, tincidunt semper sem. Aliquam fermentum magna sed justo luctus, tempor finibus sapien venenatis. Praesent semper quam et tellus vulputate malesuada ut in metus. Quisque efficitur orci nec ex eleifend convallis. Duis mollis elit consectetur sem vehicula tempor. Aenean vehicula accumsan dui, sed vehicula nunc ultrices in. Vestibulum maximus risus et nunc porta, non tempor nisi scelerisque. Duis'),
('Manuel', 'Luzietti', 'manuel.luzietti@studio.unibo.i', 'password', 'manuel.luz', 'via Inventata 15', '0000-00-00', 3, 0, 0, NULL),
('Ryan', 'Perrina', 'ryan.perrina@studio.unibo.it', 'password', 'ryan.perri', 'via Del Poggio 10', '0000-00-00', 8, 0, 2, NULL),
('test', 'tester', 'testuser@gmail.com', 'Test123!', 'test', 'test', '2023-01-01', 2, 1, 0, 'test');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acquisto`
--
ALTER TABLE `acquisto`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `FKacq_Ute` (`acquirente`),
  ADD KEY `FKcar_Acq` (`idCarta`);

--
-- Indici per le tabelle `acquisto_prodotto`
--
ALTER TABLE `acquisto_prodotto`
  ADD PRIMARY KEY (`codAcquisto`,`codProdotto`),
  ADD KEY `FKacq_Pro_1` (`codProdotto`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`cod`),
  ADD UNIQUE KEY `FKute_Car_ID` (`utente`);

--
-- Indici per le tabelle `cartadicredito`
--
ALTER TABLE `cartadicredito`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `IDCartaDiCredito` (`codiceCarta`),
  ADD KEY `FKpossedimentoCarta` (`titolare`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`codice`),
  ADD UNIQUE KEY `ricetta` (`ricetta`,`autore`),
  ADD KEY `FKcom_Ric` (`ricetta`),
  ADD KEY `FKcom_Ute` (`autore`);

--
-- Indici per le tabelle `fungo_ricetta`
--
ALTER TABLE `fungo_ricetta`
  ADD PRIMARY KEY (`nomeFungo`,`titoloRicetta`),
  ADD KEY `FKrif_Ric` (`titoloRicetta`);

--
-- Indici per le tabelle `immagineprodotto`
--
ALTER TABLE `immagineprodotto`
  ADD PRIMARY KEY (`codProdotto`,`nome`);

--
-- Indici per le tabelle `immaginericetta`
--
ALTER TABLE `immaginericetta`
  ADD PRIMARY KEY (`titoloRicetta`,`nome`);

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`titoloRicetta`,`nome`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `FKnot_Ute` (`utente`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`codice`),
  ADD KEY `FKdi` (`nomeFungo`),
  ADD KEY `FKfornitura` (`offerente`);

--
-- Indici per le tabelle `prodotto_carrello`
--
ALTER TABLE `prodotto_carrello`
  ADD PRIMARY KEY (`codProdotto`,`codCarrello`),
  ADD KEY `FKcar_Car` (`codCarrello`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`codice`),
  ADD UNIQUE KEY `utente` (`utente`,`codProdotto`),
  ADD KEY `FKrec_Prod` (`codProdotto`),
  ADD KEY `FKute_Rec` (`utente`);

--
-- Indici per le tabelle `ricetta`
--
ALTER TABLE `ricetta`
  ADD PRIMARY KEY (`titolo`),
  ADD UNIQUE KEY `FKric_Tab_ID` (`tabellaNutrizionale`),
  ADD UNIQUE KEY `tabellaNutrizionale` (`tabellaNutrizionale`),
  ADD KEY `FKautoreRicetta` (`autore`);

--
-- Indici per le tabelle `tabellanutrizionale`
--
ALTER TABLE `tabellanutrizionale`
  ADD PRIMARY KEY (`codice`);

--
-- Indici per le tabelle `tipologiafungo`
--
ALTER TABLE `tipologiafungo`
  ADD PRIMARY KEY (`nomeScientifico`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `acquisto`
--
ALTER TABLE `acquisto`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `cartadicredito`
--
ALTER TABLE `cartadicredito`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT per la tabella `tabellanutrizionale`
--
ALTER TABLE `tabellanutrizionale`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisto`
--
ALTER TABLE `acquisto`
  ADD CONSTRAINT `FKacq_Ute` FOREIGN KEY (`acquirente`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKcar_Acq` FOREIGN KEY (`idCarta`) REFERENCES `cartadicredito` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `acquisto_prodotto`
--
ALTER TABLE `acquisto_prodotto`
  ADD CONSTRAINT `FKacq_Pro_1` FOREIGN KEY (`codProdotto`) REFERENCES `prodotto` (`codice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FKacq_acq` FOREIGN KEY (`codAcquisto`) REFERENCES `acquisto` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FKute_Car_FK` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `cartadicredito`
--
ALTER TABLE `cartadicredito`
  ADD CONSTRAINT `FKpossedimentoCarta` FOREIGN KEY (`titolare`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `FKcom_Ric` FOREIGN KEY (`ricetta`) REFERENCES `ricetta` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKcom_Ute` FOREIGN KEY (`autore`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `fungo_ricetta`
--
ALTER TABLE `fungo_ricetta`
  ADD CONSTRAINT `FKrif_Ric` FOREIGN KEY (`titoloRicetta`) REFERENCES `ricetta` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKrif_Tip` FOREIGN KEY (`nomeFungo`) REFERENCES `tipologiafungo` (`nomeScientifico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `immagineprodotto`
--
ALTER TABLE `immagineprodotto`
  ADD CONSTRAINT `FKPro_imm` FOREIGN KEY (`codProdotto`) REFERENCES `prodotto` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `immaginericetta`
--
ALTER TABLE `immaginericetta`
  ADD CONSTRAINT `FKRic_imm` FOREIGN KEY (`titoloRicetta`) REFERENCES `ricetta` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `FKRic_ing` FOREIGN KEY (`titoloRicetta`) REFERENCES `ricetta` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `FKnot_Ute` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `FKdi` FOREIGN KEY (`nomeFungo`) REFERENCES `tipologiafungo` (`nomeScientifico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKfornitura` FOREIGN KEY (`offerente`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `prodotto_carrello`
--
ALTER TABLE `prodotto_carrello`
  ADD CONSTRAINT `FKcar_Car` FOREIGN KEY (`codCarrello`) REFERENCES `carrello` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKcar_Pro_1` FOREIGN KEY (`codProdotto`) REFERENCES `prodotto` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `FKrec_Prod` FOREIGN KEY (`codProdotto`) REFERENCES `prodotto` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKute_Rec` FOREIGN KEY (`utente`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ricetta`
--
ALTER TABLE `ricetta`
  ADD CONSTRAINT `FKautoreRicetta` FOREIGN KEY (`autore`) REFERENCES `utente` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKric_Tab_FK` FOREIGN KEY (`tabellaNutrizionale`) REFERENCES `tabellanutrizionale` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
