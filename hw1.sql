-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 29, 2023 alle 09:00
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Articoli`
--

CREATE TABLE `Articoli` (
  `id_articolo` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `contenuto` text NOT NULL,
  `autore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Articoli`
--

INSERT INTO `Articoli` (`id_articolo`, `titolo`, `contenuto`, `autore`) VALUES
(3, 'After, ne vale veramente la pena?', 'Una notorietà forse improvvisa e sorprendente, i libri di After hanno spopolato prima sul web, poi nelle librerie delle nostre città fino ad arrivare ai cinema. La storia lascia molto a desiderare, una trama poco commuovente accompagna due protagonisti alquanto insoddisfacenti. Sicuramente non un modello da seguire per un\'audience ancora troppo giovane per riconoscere comportamenti scorretti e poco costruttivi.', 11),
(11, 'Piccole donne, se non lo hai ancora letto...', 'I libri possono diventare degli amici.\r\nSono degli amici sicuramente un po\' particolari, non puoi parlarci e loro non hanno una voce, eppure è come se comunicassero con noi in modi in cui neanche le persone, a volte, sono capaci. Ci accompagnano in svariati momenti della nostra vita, sin da bambini le fiabe e i racconti erano la nostra buonanotte, crescendo questa abitudine si perde, ma i libri rimangono con noi, magari ammassati in uno scaffale a guardarci silenziosi.\r\nPiccole donne merita quel posto nello scaffale, probabilmente sta sotto tutti gli altri libri ed è il più straccio e ingiallito, questo perché è uno di quei volumi che vanno letti e assaporati ancora prima dell\'adolescenza. Le parole dell\'autrice sono fluide, leggere e mai ingarbugliate.\r\n', 11),
(12, 'La verità sul caso Harry Quebert, corri in libreria!', 'Marcus e Harry, Harry e Nola, Nola e il brivido dell\'incertezza. \r\nCoppie perfette ma esplosive allo stesso tempo. I protagonisti sono coinvolgenti, la storia fluida e coerente, la fine davvero inaspettata.\r\n', 11),
(13, 'I tre moschettieri', 'Tutti per uno, uno per tutti. \r\nQuesta frase non puoi non averla sentita. Uno dei motti più celebri degli ultimi tempi è proprio contenuta in questo avvincente libro.', 13),
(14, 'After, spazzatura o capolavoro?', 'After, una saga un po\' discutibile, ma molto popolare. Ci sono solamente due opzioni quando si parla di questi libri: li ami o li odi.', 13),
(15, 'Colpa delle stelle, prepara i fazzoletti!', 'Ci sono quei libri che ti devono inevitabilmente far piangere, a prescindere che quello sia o meno l\'obiettivo principale, non puoi scappare dal loro destino. È impossibile non pensare a questo libro senza un velo di tristezza, di amarezza per quello che a volte ci riserva la vita.', 13),
(16, 'Cenerentola, una storia da sogno', 'Chi non conosce Cenerentola, non ha veramente conosciuto le fiabe.\r\nIl castello, l\'abito perfetto, il ballo e le luci, la carrozza, tanti animaletti come amici: praticamente il sogno di ogni bamabina.', 15),
(17, 'Il conte di Montecristo, tra intrighi e passioni... la rivincita di un uomo', 'Scritto da Alexandre Dumas (padre), il Conte di Montecristo è un romanzo storico considerato tra i più grandi capolavori della letteratura d\'avventura. \r\nUn racconto che si legge tutto d\'un fiato, rimanendo incollati alle pagine per capire se il protagonista Edmond riuscirà ad avere vendetta e giustizia per i dolori patiti, e misericordia verso coloro che lo hanno aiutato nei momenti più bui.', 17),
(20, 'Prova 1', 'Questa è la prima prova di scrittura di una recensione', 18),
(23, 'Harry Potter, una saga da leggere almeno una volta nella vita', 'I film di Harry Potter sono stati visti da migliaia e migliaia di persone sparse in tutto il mondo, ma i libri? I libri sono diversi, più avvincenti, più emozionanti e non possono essere sostituiti da qualche scena in TV.', 19),
(24, 'Harry Potter, da leggere', 'Una saga coinvolgente, accompagna bambini e ragazzi da qualche generazione e non ci si stanca mai di leggere questi libri.', 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `Libri`
--

CREATE TABLE `Libri` (
  `id_libro` varchar(30) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `autore` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Libri`
--

INSERT INTO `Libri` (`id_libro`, `titolo`, `autore`) VALUES
('0C5LEAAAQBAJ', 'Il fantasma del castello', 'Geronimo Stilton'),
('0u-ZEAAAQBAJ', 'La verità sul caso Harry Quebert', 'Joël Dicker'),
('1-PqAAAAMAAJ', 'Daniele Ranzoni', 'Annie-Paule Quinsac'),
('1_4nDwAAQBAJ', 'Arrivederci piccole donne', 'Marcela Serrano'),
('83b3DwAAQBAJ', 'Evelina The Omega', 'David Gomadza'),
('aPA_DwAAQBAJ', 'Una dolcissima storia d\'amore', 'Adelia Marino'),
('ByZYnwEACAAJ', 'Gatto nero, gatta bianca', 'Silvia Borando'),
('c5vJsgEACAAJ', 'Cat therapy. Colouring book anti-stress', 'Autore non trovato'),
('eh3-DwAAQBAJ', 'Destinazione top secret', 'Tea Stilton'),
('G3PeBgAAQBAJ', 'Wild Cat', 'Christine Feehan'),
('i8svEAAAQBAJ', 'Cat\'s Cradle', 'Bianca D\'Arc'),
('IxBBzgEACAAJ', 'Uno, nessuno e centomila. Ediz. integrale', 'Luigi Pirandello'),
('lRkIT17ymDkC', 'Love\'s Bright Torch', 'Dorothea J. Snow'),
('MDFjEAAAQBAJ', 'Symbols of love and adolescence in James Joyce’s “Araby“', 'Christian Schwambach'),
('ndnKDAAAQBAJ', 'Lo strano caso dei giochi olimpici', 'Geronimo Stilton'),
('nPl-jwEACAAJ', 'Inseguimento a New York', 'Geronimo Stilton'),
('o1RvCQAAQBAJ', 'After', 'Anna Todd'),
('Rlt3MwEACAAJ', 'Novelle cliniche appartenenti alla medicina legale', 'Johann Ludwig Casper'),
('RpUsEAAAQBAJ', 'Uno, nessuno e centomila', 'Luigi Pirandello'),
('SPNLAgAAQBAJ', 'Il conte di Montecristo (Mondadori)', 'Alexandre (padre) Dumas'),
('tRTpU61zaJEC', 'Love is Blind', 'Lynsay Sands'),
('UagqDwAAQBAJ', 'Il giardino dei segreti', 'Tea Stilton'),
('V5a2ugAACAAJ', 'Piccole donne', 'Louisa May Alcott'),
('xCt4EAAAQBAJ', 'Dog Tales', 'Lamar Underwood'),
('y-jiu5XWeLIC', 'Pagine scelte di Luigi Pirandello', 'Andrea Camilleri'),
('YAb7ehY9-4AC', '\"il conte di montecristo,,', 'Alexandre Dumas (père.)'),
('ZS2bAAAAQBAJ', 'Suo marito - Giustino Roncella nato a Boggiòlo', 'Luigi Pirandello');

-- --------------------------------------------------------

--
-- Struttura della tabella `LibriSalvati`
--

CREATE TABLE `LibriSalvati` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_libro` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `LibriSalvati`
--

INSERT INTO `LibriSalvati` (`id`, `id_utente`, `id_libro`) VALUES
(32, 13, 'tRTpU61zaJEC'),
(37, 11, 'ZS2bAAAAQBAJ'),
(41, 15, '1-PqAAAAMAAJ'),
(42, 15, 'G3PeBgAAQBAJ'),
(43, 15, 'ndnKDAAAQBAJ'),
(44, 15, '0C5LEAAAQBAJ'),
(45, 15, 'Rlt3MwEACAAJ'),
(46, 17, 'SPNLAgAAQBAJ'),
(47, 17, 'YAb7ehY9-4AC'),
(48, 11, 'ndnKDAAAQBAJ'),
(49, 11, 'nPl-jwEACAAJ'),
(50, 18, 'i8svEAAAQBAJ'),
(51, 18, '1-PqAAAAMAAJ'),
(52, 18, 'c5vJsgEACAAJ'),
(53, 19, 'MDFjEAAAQBAJ'),
(55, 19, 'aPA_DwAAQBAJ'),
(56, 19, '83b3DwAAQBAJ');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_u` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`id_utente`, `nome`, `cognome`, `email`, `username`, `password_u`) VALUES
(11, 'Barbara', 'Verdi', 'testbarbara@gmail.com', 'barbaraverdi', '$2y$10$vGFnjuKpTaVbBNQbk1ICsuSFyYXlDvfXHMo/p3rnNee/RMohJRKGS'),
(13, 'Adrian', 'Bianchi', 'testadrian@gmail.com', 'adrianbianchi', '$2y$10$XNPax0Z81.bq1si/P92dXuGE055TT3VncMec/UmHi8wLWJyFRPD7C'),
(15, 'Lorena', 'Rossi', 'testlorena@gmail.com', 'lorenarossi', '$2y$10$TLUYb60XdKCJ9j8NPu1P5ufrRijG54iCTM.msbBLug0JuoFG/LDfu'),
(16, 'Fabio', 'Viola', 'testfabio@gmail.com', 'fabioviola', '$2y$10$IlAraxaSiYqgmrXwY4NQOuVBTWjsLMeo6n6HxzcX8TwLZOdHbc6jm'),
(17, 'Adrian', 'Ghinghin', 'adrian.ghinghin@gmail.com', 'adghin00', '$2y$10$kXL5bzsx9lcxDye85hfgweSCRq9A/XCzEFu2dKWIUF3tP6Uc8B0Ka'),
(18, 'Gaia', 'Gialli', 'testgaia@gmail.com', 'gaiagialli', '$2y$10$YmxjdzMQrL1PaKhwyhiOC.p1iijUuSr2iIKBPIOgKrPhvP08k9Fm2'),
(19, 'Adrian', 'Ghinea', 'testadrian1@gmail.com', 'adrianghinea', '$2y$10$lL4xUYMuPtE4Chv5oGhVWuTetoG66fLGu9sb2xowQr4vBgGVItZ5W');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Articoli`
--
ALTER TABLE `Articoli`
  ADD PRIMARY KEY (`id_articolo`),
  ADD KEY `autore` (`autore`);

--
-- Indici per le tabelle `Libri`
--
ALTER TABLE `Libri`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indici per le tabelle `LibriSalvati`
--
ALTER TABLE `LibriSalvati`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_u` (`id_utente`),
  ADD KEY `id_l` (`id_libro`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Articoli`
--
ALTER TABLE `Articoli`
  MODIFY `id_articolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `LibriSalvati`
--
ALTER TABLE `LibriSalvati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT per la tabella `Utenti`
--
ALTER TABLE `Utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Articoli`
--
ALTER TABLE `Articoli`
  ADD CONSTRAINT `articoli_ibfk_1` FOREIGN KEY (`autore`) REFERENCES `Utenti` (`id_utente`);

--
-- Limiti per la tabella `LibriSalvati`
--
ALTER TABLE `LibriSalvati`
  ADD CONSTRAINT `librisalvati_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `Utenti` (`id_utente`),
  ADD CONSTRAINT `librisalvati_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `Libri` (`id_libro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
