-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Sat Feb  5 23:56:19 2022 
-- * LUN file: C:\xampp\htdocs\project\Progettazione\websiteTecWeb.lun 
-- * Schema: traduzioneLogica/1-1-3 
-- ********************************************* 


-- Database Section
-- ________________ 
drop schema if exists websitetecweb;
create database websitetecweb;
use websitetecweb;


-- Tables Section
-- _____________ 

create table acquisto (
     codice int not null,
     data date not null,
     /totale decimal(5,2) not null,
     acquirente varchar(20) not null,
     idCarta int not null,
     constraint IDacquisto primary key (codice));

create table Acquisto_Prodotto (
     codProdotto int not null,
     codAcquisto int not null,
     quantità int not null,
     constraint IDAcquistoProdotto primary key (codAcquisto, codProdotto));

create table Carrello (
     cod int not null,
     utente varchar(20) not null,
     /totaleCarrello decimal(5,2) not null,
     constraint IDCarrello primary key (cod),
     constraint FKute_Car_ID unique (utente));

create table CartaDiCredito (
     ID int not null,
     codiceCarta varchar(16) not null,
     titolare varchar(20) not null,
     constraint IDCartaDiCredito_1 primary key (ID),
     constraint IDCartaDiCredito unique (codiceCarta));

create table Commento (
     codice int not null,
     contenuto varchar(280) not null,
     data date not null,
     ricetta varchar(20) not null,
     autore varchar(20) not null,
     constraint IDCommento primary key (codice));

create table Fungo_Ricetta (
     titoloRicetta varchar(20) not null,
     nomeFungo varchar(15) not null,
     constraint IDFungo-Ricetta primary key (nomeFungo, titoloRicetta));

create table immagineProdotto (
     codProdotto int not null,
     nome varchar(15) not null,
     constraint IDimmagineProdotto primary key (codProdotto, nome));

create table immagineRicetta (
     titoloRicetta varchar(20) not null,
     nome varchar(10) not null,
     constraint IDimmagineRicetta primary key (titoloRicetta, nome));

create table ingrediente (
     titoloRicetta varchar(20) not null,
     nome varchar(10) not null,
     quantità varchar(10) not null,
     constraint IDingrediente primary key (titoloRicetta, nome));

create table Notifica (
     codice int not null,
     messaggio varchar(280) not null,
     data date not null,
     utente varchar(20) not null,
     constraint IDNotifica primary key (codice));

create table Prodotto (
     codice int not null,
     prezzoPerUnità float(6) not null,
     quantità int not null,
     informazioni varchar(500) not null,
     /mediaValutazione float(2) not null,
     nomeFungo varchar(15) not null,
     data date not null,
     offerente varchar(20) not null,
     constraint IDProdotto primary key (codice));

create table Prodotto_Carrello (
     codCarrello int not null,
     codProdotto int not null,
     quantità int not null,
     constraint IDProdotto-Carrello primary key (codProdotto, codCarrello));

create table Recensione (
     codice int not null,
     titolo varchar(20) not null,
     contenuto varchar(500) not null,
     valutazione float(2) not null,
     data date not null,
     utente varchar(20) not null,
     codProdotto int not null,
     constraint IDRecensione primary key (codice));

create table Ricetta (
     titolo varchar(20) not null,
     tabellaNutrizionale int not null,
     difficoltà float(2) not null,
     descrizione varchar(500) not null,
     procedimento varchar(5000) not null,
     consigli varchar(2000),
     data char(1) not null,
     autore varchar(20) not null,
     constraint IDRicetta primary key (titolo),
     constraint FKric_Tab_ID unique (tabellaNutrizionale));

create table TabellaNutrizionale (
     codice int not null,
     valoreEnergetico int not null,
     proteine int not null,
     grassi decimal(3,1) not null,
     carboidrati decimal(3,1) not null,
     fibre decimal(3,1) not null,
     sodio decimal(3,1) not null,
     constraint IDTabellaNutrizionale_ID primary key (codice));

create table TipologiaFungo (
     nomeScientifico varchar(15) not null,
     indiceRarità float(2) not null,
     indiceQualità float(2) not null,
     indiceVelenosità float(2) not null,
     constraint IDTipologia primary key (nomeScientifico));

create table Utente (
     nome varchar(15) not null,
     cognome varchar(15) not null,
     email varchar(20) not null,
     password varchar(20) not null,
     username varchar(10) not null,
     indirizzo varchar(25) not null,
     data nascita date not null,
     /offerteVendute int not null,
     /offerteInserite int not null,
     /mediaValutazioni float(2) not null,
     constraint IDUtente_ID primary key (email));


-- Constraints Section
-- ___________________ 

alter table acquisto add constraint FKacq_Ute
     foreign key (acquirente)
     references Utente (email);

alter table acquisto add constraint FKcar_Acq
     foreign key (idCarta)
     references CartaDiCredito (ID);

alter table Acquisto_Prodotto add constraint FKacq_acq
     foreign key (codAcquisto)
     references acquisto (codice);

alter table Acquisto_Prodotto add constraint FKacq_Pro_1
     foreign key (codProdotto)
     references Prodotto (codice);

alter table Carrello add constraint FKute_Car_FK
     foreign key (utente)
     references Utente (email);

alter table CartaDiCredito add constraint FKpossedimentoCarta
     foreign key (titolare)
     references Utente (email);

alter table Commento add constraint FKcom_Ric
     foreign key (ricetta)
     references Ricetta (titolo);

alter table Commento add constraint FKcom_Ute
     foreign key (autore)
     references Utente (email);

alter table Fungo_Ricetta add constraint FKrif_Tip
     foreign key (nomeFungo)
     references TipologiaFungo (nomeScientifico);

alter table Fungo_Ricetta add constraint FKrif_Ric
     foreign key (titoloRicetta)
     references Ricetta (titolo);

alter table immagineProdotto add constraint FKPro_imm
     foreign key (codProdotto)
     references Prodotto (codice);

alter table immagineRicetta add constraint FKRic_imm
     foreign key (titoloRicetta)
     references Ricetta (titolo);

alter table ingrediente add constraint FKRic_ing
     foreign key (titoloRicetta)
     references Ricetta (titolo);

alter table Notifica add constraint FKnot_Ute
     foreign key (utente)
     references Utente (email);

alter table Prodotto add constraint FKdi
     foreign key (nomeFungo)
     references TipologiaFungo (nomeScientifico);

alter table Prodotto add constraint FKfornitura
     foreign key (offerente)
     references Utente (email);

alter table Prodotto_Carrello add constraint FKcar_Pro_1
     foreign key (codProdotto)
     references Prodotto (codice);

alter table Prodotto_Carrello add constraint FKcar_Car
     foreign key (codCarrello)
     references Carrello (cod);

alter table Recensione add constraint FKute_Rec
     foreign key (utente)
     references Utente (email);

alter table Recensione add constraint FKrec_Prod
     foreign key (codProdotto)
     references Prodotto (codice);

alter table Ricetta add constraint FKric_Tab_FK
     foreign key (tabellaNutrizionale)
     references TabellaNutrizionale (codice);

alter table Ricetta add constraint FKautoreRicetta
     foreign key (autore)
     references Utente (email);

-- Not implemented
-- alter table TabellaNutrizionale add constraint IDTabellaNutrizionale_CHK
--     check(exists(select * from Ricetta
--                  where Ricetta.tabellaNutrizionale = codice)); 

-- Not implemented
-- alter table Utente add constraint IDUtente_CHK
--     check(exists(select * from Carrello
--                  where Carrello.utente = email)); 


-- Index Section
-- _____________ 

