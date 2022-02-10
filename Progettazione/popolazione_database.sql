-- Utenti
INSERT INTO utente
VALUES ('Ryan', 'Perrina', 'ryan.perrina@studio.unibo.it', 'password', 'ryan.perrina', 'via Del Poggio 10', 2000-09-17, 0, 0, 0);

INSERT INTO utente
VALUES ('Manuel', 'Luzietti', 'manuel.luzietti@studio.unibo.it', 'password', 'manuel.luzietti', 'via Inventata 15', 1996-04-26, 0, 0, 0);

INSERT INTO utente
VALUES ('Davide', 'Merli', 'davide.merli5@studio.unibo.it', 'password', 'davide.merli', 'via Saffi 52', 2000-07-12, 0, 0, 0);

-- Tipologia fungo
INSERT INTO tipologiafungo
VALUES ('Boletus edulis', 1, 7, 0);

INSERT INTO tipologiafungo
VALUES ('Amanita muscaria', 2, 5, 9);

-- Prodotti
INSERT INTO prodotto
VALUES (1, 14.91, 3, 'Raccolto in val di Fiemme. Ideale per molte ricette. Non velenoso. Ottimo per molte ricette a base di porcini.', 4, 'Boletus Edulis', 2022-02-09, 'davide.merli5@studio.unibo.it');

INSERT INTO prodotto
VALUES (2, 15.00, 10, "Conosciuta fin dai tempi antichi come fungo in grado di provocare allucinazioni. E' tra i funghi più conosciuti, specie a causa del suo aspetto appariscente.Non mangiare (a meno di non essere masochisti o sciamani).", 5, 'Amanita Muscaria', 2022-02-10, 'ryan.perrina@studio.unibo.it');

INSERT INTO prodotto
VALUES (3, 2.98, 20, 'I funghi champignon, nome scientifico Agaricus bisporus, appartengono alla famiglia delle Agaricaceae. Sono uno dei funghi maggiormente apprezzati e commercializzati al mondo. Hanno effetti benefici sulla salute grazie ai loro composti antiossidanti e bioattivi. Il loro consumo secondo gli studi potenzia anche il sistema immunitario.', 2022-02-10, 'davide.merli5@studio.unibo.it');

-- Tabelle nutrizionali
INSERT INTO tabellanutrizionale
VALUES (1, 540, 14, 21.5, 72.3, 4.0, 0.7);

INSERT INTO tabellanutrizionale
VALUES (2, 196, 7.1, 17.5, 2.6, 4.7, 0.1);

-- Ricette
INSERT INTO ricetta
VALUES ('Risotto ai porcini', 1, 3, 'Un buon risotto è sempre quello che ci vuole! Qualunque sia l’occasione, il risotto ai funghi porcini è una ricetta ricca di gusto e suggestioni… più che un piatto, una favola d’autunno!', 'Per prima cosa preparate il brodo vegetale. Ora occupatevi della pulizia dei porcini: eliminate la base con un coltello, raschiate il gambo per rimuovere tutti i residui di terra e, infine, strofinate delicatamente con un panno umido. Se il fungo dovesse essere molto terroso potete passarlo brevemente sotto un getto di acqua corrente, ma assicuratevi di asciugarlo immediatamente per evitare che assorba l’acqua. Una volta puliti, tagliate i funghi a fette dello spessore di circa 7-8 mm, mantenendo integra l’intera sezione quando possibile. Nel frattempo mondate e tritate finemente la cipolla. Sciogliete il burro in una casseruola, aggiungete la cipolla e lasciatela cuocere dolcemente per 10-15 minuti, aiutandovi con un mestolo di brodo se necessario. Quando la cipolla si sarà sciolta, unite il riso e fatelo tostare per un paio di minuti. Quando il riso sarà diventato quasi trasparente, portatelo a cottura aggiungendo un mestolo di brodo alla volta e mescolando spesso; assicuratevi che le bollicine di ebollizione rimangano costanti e che la fiamma non sia troppo aggressiva. Quando il riso sarà molto al dente, pochi minuti prima che sia pronto, unite i funghi porcini e finite la cottura, regolando di sale e pepe se necessario. Una volta cotto, mantecate il risotto a fuoco spento aggiungendo il burro e il parmigiano grattugiato.', 'In mancanza di funghi freschi di buona qualità, potete utilizzare anche i funghi secchi: il rapporto è di 1:10, quindi a 10 g di funghi secchi corrispondono 100 g di funghi freschi. In questo caso i funghi secchi andranno ammollati o sbollentati prima della cottura e potete utilizzare l’acqua di ammollo per arricchire il brodo vegetale con cui portare il riso a cottura. Se invece avete la fortuna di trovare i porcini freschi, scegliete preferibilmente quelli giovani con il cappello chiuso e tondeggiante; potete controllare che siano di buona qualità assicurandovi che il fungo non abbia una consistenza flaccida o appiccicosa e che la parte spugnosa non sia verdognola. Per un aroma ancora più intenso, provate a sostituire il prezzemolo con la nepitella, detta anche mentuccia!', 2022-02-10, 'davide.merli5@studio.unibo.it');

INSERT INTO ricetta
VALUES ('Funghi trifolati', 2, 2, "I funghi trifolati sono perfetti per accompagnare a robusti piatti di carne, ottimi con la polenta oppure sul pane per deliziose bruschette.', 'per prima cosa pulire i diversi tipi di funghi. Noi abbiamo usato porcini, champignon, pleurotus e finferli. Eliminate la parte terrosa con un pennellino, potete utilizzare anche un panno asciutto e tagliate via la parte terrosa del gambo con un coltellino. Se dovessero risultare molto sporchi potete passarli molto rapidamente sotto l'acqua corrente, ma fate attenzione perchè i funghi assorbono molta acqua. Tagliate a fette sottili tutti i funghi scelti. Fate scaldare in una padella antiaderente il burro con l'olio e lo spicchio di aglio tagliato a metà. Fate insaporire e versate nella padella prima i funghi porcini più sodi, fate saltare a fuoco vivace per un paio di minuti e poi unite gli altri funghi. Cuocete ancora per paio di minuti a fuoco vivace, mescolando sempre molto delicatamente. Aggiustate di sale e pepe e unite il prezzemolo finemente tritato. Togliete dal fuoco e servite i funghi trifolati caldi o freddi a seconda dell’uso che ne dovete fare.", 'Contrariamente a quanto si possa pensare, i funghi hanno bisogno di una cottura veloce, altrimenti rischiano di diventare una specie di poltiglia: se vogliamo mantenere la forma, quindi, ricordatevi di utilizzare una fiamma vivace. Se volete conservare i funghi trifolati per altre preparazioni, lasciate la cottura a metà, senza aggiungere prezzemolo e sale: la completerete quando sarà il momento. Se utilizzate i chiodini, ricordatevi di pulirli e sbollentarli per 15 minuti per eliminare le tossine.', 2022-02-10, 'manuel.luzietti@studio.unibo.it');

-- Immagini ricetta
INSERT INTO immaginericetta
VALUES ('Risotto ai porcini', 'risotto-porcini-1.jpg');

INSERT INTO immaginericetta
VALUES ('Risotto ai porcini', 'risotto-porcini-2.jpg');

INSERT INTO immaginericetta
VALUES ('Funghi trifolati', 'trifolati-1.jpg');

INSERT INTO immaginericetta
VALUES ('Funghi trifolati', 'trifolati-2.jpg');

-- Immagini prodotto
INSERT INTO immagineprodotto
VALUES (1, 'b-edulis-1.jpg');

INSERT INTO immagineprodotto
VALUES (1, 'b-edulis-2.jpg');

INSERT INTO immagineprodotto
VALUES (2, 'amanita-1.jpg');

INSERT INTO immagineprodotto
VALUES (2, 'amanita-2.jpg');

-- Ingredienti
INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Aglio', '1 spicchio');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Brodo', '1 l');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Burro', '30 g');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Cipolle', '1 piccola');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Olio', '2 cucchiai');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Pepe nero', 'q. b.');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Porcini', '400 g');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Riso', '320 g');

INSERT INTO ingrediente
VALUES ('Risotto ai porcini', 'Sale fino', 'q. b.');

INSERT INTO ingrediente
VALUES ('Funghi trifolati', 'Funghi misti', '800 g');

INSERT INTO ingrediente
VALUES ('Funghi trifolati', 'Prezzemolo', 'q. b.');

INSERT INTO ingrediente
VALUES ('Funghi trifolati', 'Olio', '40 g');

INSERT INTO ingrediente
VALUES ('Funghi trifolati', 'Aglio', '1 spicchio');

INSERT INTO ingrediente
VALUES ('Funghi trifolati', 'Burro', '30 g');

-- Recensioni
INSERT INTO recensione
VALUES (1, 'Bene ma non benissimo', "L'ho usato per un bel risotto, molto buono, ma la scatola in cui è arrivato non era in ottime condizioni.", 3.5, 2022-02-10, 'ryan.perrina@studio.unibo.it', 1);

INSERT INTO recensione
VALUES (2, 'Fungo di qualità', "Miglior porcino mai mangiato in vita mia. Si sente che è freschissimo. Arrivato in tempi brevi, tra l'altro.", 5, 'manuel.luzietti@studio.unibo.it', 2022-02-10, 1);

INSERT INTO recensione
VALUES (3, 'Non ci siamo', "La confezione era scadente, ed è arrivato dopo un mese da quando l'ho ordinato. Molto male.", 1, 2022-02-10, 'davide.merli@studio.unibo.it', 2);

INSERT INTO recensione
VALUES (4, 'Da sballo', "L'ho comprato per fare serata con i miei amici e non mi ha deluso, questa roba sppacca, meglio della droga.", 1, 2022-02-10, 'manuel.luzietti@studio.unibo.it', 2);

-- Commenti
INSERT INTO commento
VALUES (1, "Sempre un buon piatto, gustoso e facile da preparare.", 2022-02-10, 'Risotto ai porcini', 'ryan.perrina@studio.unibo.it');

INSERT INTO commento
VALUES (2, "Molto buono, ci ho fatto delle bruschette ai funghi.", 2022-02-10, 'Funghi trifolati', 'davide.merli5@studio.unibo.it');

INSERT INTO commento
VALUES (3, "A me non piacciono i funghi.", 2022-02-10, 'Funghi trifolati', 'ryan.perrina@studio.unibo.it');