-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 10, 2023 alle 13:40
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.11

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
(17, '2022-12-29', '15.00', 'LuxMasayuki@gmail.com', 14);

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
(2, 17, 1);

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
(1, 'ziobello@gmail.com', '0.00'),
(2, 'diobono@gmail.com', '0.00'),
(3, 'LuxMasayuki@gmail.com', '0.00');

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
(6, '888', 'LuxMasayuki@gmail.com'),
(7, '55', 'LuxMasayuki@gmail.com'),
(8, '7', 'LuxMasayuki@gmail.com'),
(9, '11', 'LuxMasayuki@gmail.com'),
(10, '44', 'LuxMasayuki@gmail.com'),
(11, '99', 'LuxMasayuki@gmail.com'),
(12, '1111', 'LuxMasayuki@gmail.com'),
(13, '222', 'LuxMasayuki@gmail.com'),
(14, '111', 'LuxMasayuki@gmail.com'),
(15, '999', 'LuxMasayuki@gmail.com');

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
(5, 'aaaa', '2022-12-28', 'Funghi trifolati', 'LuxMasayuki@gmail.com');

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
(6, 'cat4.jpeg'),
(12, 'cato3.jpeg'),
(13, 'DiscreteGaussian.JPG'),
(14, 'ascii_table.png');

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
('Funghi alla Chopenauer', 'cato2.jpeg'),
('Funghi trifolati', 'trifolati-1.jpg'),
('Funghi trifolati', 'trifolati-2.jpg'),
('Risotto ai porcini', 'risotto-porcini-1.jpg'),
('Risotto ai porcini', 'risotto-porcini-2.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `titoloRicetta` varchar(30) NOT NULL,
  `nome` varchar(10) NOT NULL,
  `quantità` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`titoloRicetta`, `nome`, `quantità`) VALUES
('Funghi trifolati', 'Aglio', '1 spicchio'),
('Funghi trifolati', 'Burro', '30 g'),
('Funghi trifolati', 'Funghi mis', '800 g'),
('Funghi trifolati', 'Olio', '40 g'),
('Funghi trifolati', 'Prezzemolo', 'q. b.'),
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
(10, 'Acquisto completato!', '2022-12-29', 'LuxMasayuki@gmail.com');

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
(1, 14.91, 0, 'Raccolto in val di Fiemme. Ideale per molte ricette. Non velenoso. Ottimo per molte ricette a base di porcini.', 4.25, 'Boletus edulis', '0000-00-00', 'davide.merli5@studio.unibo.it'),
(2, 15, 3, 'Conosciuta fin dai tempi antichi come fungo in grado di provocare allucinazioni. E\' tra i funghi più conosciuti, specie a causa del suo aspetto appariscente.Non mangiare (a meno di non essere masochisti o sciamani).', 2, 'Amanita muscaria', '0000-00-00', 'ryan.perrina@studio.unibo.it'),
(3, 2.98, 20, 'I funghi champignon, nome scientifico Agaricus bisporus, appartengono alla famiglia delle Agaricaceae. Sono uno dei funghi maggiormente apprezzati e commercializzati al mondo. Hanno effetti benefici sulla salute grazie ai loro composti antiossidanti e bioattivi. Il loro consumo secondo gli studi potenzia anche il sistema immunitario.', 3, 'Champignon', '0000-00-00', 'davide.merli5@studio.unibo.it'),
(6, 48.54, 52, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a nunc at mi venenatis vestibulum ut sit amet nisi. Cras consequat, tellus vitae pulvinar sagittis, nisi sem pulvinar felis, eu sollicitudin massa urna a magna. Mauris vehicula, mauris sit amet fringilla commodo, lacus lectus vestibulum lectus, sit amet eleifend urna lacus vel turpis. Curabitur sodales sagittis arcu quis mattis. Pellentesque placerat risus ac dignissim imperdiet. Aliquam nec vehicula metus, viverra auctor velit. Don', 0, 'Boletus edulis', '2022-12-21', 'LuxMasayuki@gmail.com'),
(12, 6.57, 83, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a nunc at mi venenatis vestibulum ut sit amet nisi. Cras consequat, tellus vitae pulvinar sagittis, nisi sem pulvinar felis, eu sollicitudin massa urna a magna. Mauris vehicula, mauris sit amet fringilla commodo, lacus lectus vestibulum lectus, sit amet eleifend urna lacus vel turpis. Curabitur sodales sagittis arcu quis mattis. Pellentesque placerat risus ac dignissim imperdiet. Aliquam nec vehicula metus, viverra auctor velit. Don', 0, 'Champignon', '2022-12-20', 'LuxMasayuki@gmail.com'),
(13, 13.29, 5, 'Dioboni se è bono questo fidatevi ', 0, 'Champignon', '2022-12-27', 'LuxMasayuki@gmail.com'),
(14, 1, 0, 'fungo di prova', 0, 'Champignon', '2022-12-21', 'LuxMasayuki@gmail.com');

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
(1, 1, 1),
(1, 2, 1),
(3, 2, 1);

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
(44, 'aaa', 'dffff', 5, '2023-01-05', 'LuxMasayuki@gmail.com', 2);

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
('Funghi alla Chopenauer', 56, 0, 'Etiam accumsan augue eu arcu aliquam, et viverra odio pellentesque. Sed id velit scelerisque, lacinia tellus eget, auctor ex. Donec dolor erat, interdum in aliquam id, dictum ut urna. Donec sed condimentum ante. In consectetur nisi vitae aliquam maximus. Pellentesque semper viverra nunc laoreet malesuada. Morbi blandit sollicitudin porttitor. Ut varius mattis dui at mattis. Aenean a massa et ante euismod tempor. Nam ultricies sodales est, non consectetur magna. Nam sit amet congue massa, a sempe', '9', '9', '2022-02-12', 'LuxMasayuki@gmail.com'),
('Funghi trifolati', 2, 2, 'I funghi trifolati sono perfetti per accompagnare a robusti piatti di carne, ottimi con la polenta oppure sul pane per deliziose bruschette.', 'Per prima cosa pulire i diversi tipi di funghi. Noi abbiamo usato porcini, champignon, pleurotus e finferli. Eliminate la parte terrosa con un pennellino, potete utilizzare anche un panno asciutto e tagliate via la parte terrosa del gambo con un coltellino. Se dovessero risultare molto sporchi potete passarli molto rapidamente sotto l\'acqua corrente, ma fate attenzione perchè i funghi assorbono molta acqua. Tagliate a fette sottili tutti i funghi scelti. Fate scaldare in una padella antiaderente il burro con l\'olio e lo spicchio di aglio tagliato a metà. Fate insaporire e versate nella padella prima i funghi porcini più sodi, fate saltare a fuoco vivace per un paio di minuti e poi unite gli altri funghi. Cuocete ancora per paio di minuti a fuoco vivace, mescolando sempre molto delicatamente. Aggiustate di sale e pepe e unite il prezzemolo finemente tritato. Togliete dal fuoco e servite i funghi trifolati caldi o freddi a seconda dell’uso che ne dovete fare.', 'Contrariamente a quanto si possa pensare, i funghi hanno bisogno di una cottura veloce, altrimenti rischiano di diventare una specie di poltiglia: se vogliamo mantenere la forma, quindi, ricordatevi di utilizzare una fiamma vivace. Se volete conservare i funghi trifolati per altre preparazioni, lasciate la cottura a metà, senza aggiungere prezzemolo e sale: la completerete quando sarà il momento. Se utilizzate i chiodini, ricordatevi di pulirli e sbollentarli per 15 minuti per eliminare le tossine.', '0000-00-00', 'manuel.luzietti@studio.unibo.i'),
('Risotto ai porcini', 1, 3, 'Un buon risotto è sempre quello che ci vuole! Qualunque sia l’occasione, il risotto ai funghi porcini è una ricetta ricca di gusto e suggestioni… più che un piatto, una favola d’autunno!', 'Per prima cosa preparate il brodo vegetale. Ora occupatevi della pulizia dei porcini: eliminate la base con un coltello, raschiate il gambo per rimuovere tutti i residui di terra e, infine, strofinate delicatamente con un panno umido. Se il fungo dovesse essere molto terroso potete passarlo brevemente sotto un getto di acqua corrente, ma assicuratevi di asciugarlo immediatamente per evitare che assorba l’acqua. Una volta puliti, tagliate i funghi a fette dello spessore di circa 7-8 mm, mantenendo integra l’intera sezione quando possibile. Nel frattempo mondate e tritate finemente la cipolla. Sciogliete il burro in una casseruola, aggiungete la cipolla e lasciatela cuocere dolcemente per 10-15 minuti, aiutandovi con un mestolo di brodo se necessario. Quando la cipolla si sarà sciolta, unite il riso e fatelo tostare per un paio di minuti. Quando il riso sarà diventato quasi trasparente, portatelo a cottura aggiungendo un mestolo di brodo alla volta e mescolando spesso; assicuratevi che le bollicine di ebollizione rimangano costanti e che la fiamma non sia troppo aggressiva. Quando il riso sarà molto al dente, pochi minuti prima che sia pronto, unite i funghi porcini e finite la cottura, regolando di sale e pepe se necessario. Una volta cotto, mantecate il risotto a fuoco spento aggiungendo il burro e il parmigiano grattugiato.', 'In mancanza di funghi freschi di buona qualità, potete utilizzare anche i funghi secchi: il rapporto è di 1:10, quindi a 10 g di funghi secchi corrispondono 100 g di funghi freschi. In questo caso i funghi secchi andranno ammollati o sbollentati prima della cottura e potete utilizzare l’acqua di ammollo per arricchire il brodo vegetale con cui portare il riso a cottura. Se invece avete la fortuna di trovare i porcini freschi, scegliete preferibilmente quelli giovani con il cappello chiuso e tondeggiante; potete controllare che siano di buona qualità assicurandovi che il fungo non abbia una consistenza flaccida o appiccicosa e che la parte spugnosa non sia verdognola. Per un aroma ancora più intenso, provate a sostituire il prezzemolo con la nepitella, detta anche mentuccia!', '0000-00-00', 'davide.merli5@studio.unibo.it'),
('rocket', 45, 0, '1', '1', '1', '2022-02-11', 'LuxMasayuki@gmail.com');

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
(45, 7, '7.0', '7.0', '7.0', '7.0', '7.0'),
(56, 9, '9.0', '9.0', '9.0', '9.0', '9.0');

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
('Amanita muscaria', 2, 5, 9),
('Boletus edulis', 1, 7, 0),
('Champignon', 3, 2, 7);

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
('Davide', 'Merli', 'davide.merli5@studio.unibo.it', 'password', 'davide.mer', 'via Saffi 52', '0000-00-00', 0, 0, 3.625, NULL),
('bho', 'bho', 'diobono@gmail.com', 'password', 'Lillop', 'Viale Cesena  5', '2022-12-08', 0, 0, 0, 'Annamo bene'),
('Lux', 'Masayuki', 'LuxMasayuki@gmail.com', 'password', 'adminn', 'Viale Cesena  5', '1996-04-26', 1, 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dolor enim, faucibus ultrices tortor eget, ornare iaculis mauris. Fusce ullamcorper commodo purus, eget cursus urna bibendum eu. In vitae commodo diam. Mauris dignissim sem diam, id maximus enim iaculis eu. Pellentesque at lectus consectetur erat hendrerit maximus. Nulla bibendum non enim sit amet placerat. Donec at sapien sit amet libero bibendum hendrerit. Etiam elementum elit lacus, non volutpat metus ullamcorper quis. Sed sit amet laoreet tortor. Nunc a molestie neque.\r\n\r\nDonec pharetra ante urna. Aliquam sit amet cursus augue, tincidunt semper sem. Aliquam fermentum magna sed justo luctus, tempor finibus sapien venenatis. Praesent semper quam et tellus vulputate malesuada ut in metus. Quisque efficitur orci nec ex eleifend convallis. Duis mollis elit consectetur sem vehicula tempor. Aenean vehicula accumsan dui, sed vehicula nunc ultrices in. Vestibulum maximus risus et nunc porta, non tempor nisi scelerisque. Duis'),
('Manuel', 'Luzietti', 'manuel.luzietti@studio.unibo.i', 'password', 'manuel.luz', 'via Inventata 15', '0000-00-00', 0, 0, 0, NULL),
('Ryan', 'Perrina', 'ryan.perrina@studio.unibo.it', 'password', 'ryan.perri', 'via Del Poggio 10', '0000-00-00', 6, 0, 2, NULL),
('zio', 'bello', 'ziobello@gmail.com', '26041996', 'ziobello', 'viale cesena ', '2022-12-09', 0, 0, 0, NULL);

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
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `cartadicredito`
--
ALTER TABLE `cartadicredito`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT per la tabella `tabellanutrizionale`
--
ALTER TABLE `tabellanutrizionale`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
