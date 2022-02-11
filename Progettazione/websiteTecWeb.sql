-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 11, 2022 alle 18:08
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
-- Database: `websitetecweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto`
--

CREATE TABLE `acquisto` (
  `codice` int(11) NOT NULL,
  `data` date NOT NULL,
  `totale` decimal(5,2) NOT NULL,
  `acquirente` varchar(30) NOT NULL,
  `idCarta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto_prodotto`
--

CREATE TABLE `acquisto_prodotto` (
  `codProdotto` int(11) NOT NULL,
  `codAcquisto` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `cod` int(11) NOT NULL,
  `utente` varchar(30) NOT NULL,
  `totaleCarrello` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `cartadicredito`
--

CREATE TABLE `cartadicredito` (
  `ID` int(11) NOT NULL,
  `codiceCarta` varchar(16) NOT NULL,
  `titolare` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `immaginericetta`
--

CREATE TABLE `immaginericetta` (
  `titoloRicetta` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `titoloRicetta` varchar(30) NOT NULL,
  `nome` varchar(10) NOT NULL,
  `quantità` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_carrello`
--

CREATE TABLE `prodotto_carrello` (
  `codCarrello` int(11) NOT NULL,
  `codProdotto` int(11) NOT NULL,
  `quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('9', 36, 0, '79', '79', '79', '2022-02-10', 'LuxMasayuki@gmail.com'),
('bho', 45, 0, '7', '7', '7', '2022-02-11', 'LuxMasayuki@gmail.com'),
('iho', 49, 0, 'uio', '0iphhip', 'ohip', '2022-02-11', 'LuxMasayuki@gmail.com');

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
(36, 9, '9.0', '9.0', '9.0', '9.0', '9.0'),
(45, 7, '7.0', '7.0', '7.0', '7.0', '7.0'),
(49, 0, '0.0', '0.0', '0.0', '0.0', '0.0');

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
  `offerteVendute` int(11) DEFAULT 0,
  `offerteInserite` int(11) DEFAULT 0,
  `mediaValutazioni` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`nome`, `cognome`, `email`, `password`, `username`, `indirizzo`, `data nascita`, `offerteVendute`, `offerteInserite`, `mediaValutazioni`) VALUES
('Lux', 'Masayuki', 'LuxMasayuki@gmail.com', 'password', 'admin', 'Viale Cesena  5', '1996-04-26', 0, 0, 0);

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
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cartadicredito`
--
ALTER TABLE `cartadicredito`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tabellanutrizionale`
--
ALTER TABLE `tabellanutrizionale`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
