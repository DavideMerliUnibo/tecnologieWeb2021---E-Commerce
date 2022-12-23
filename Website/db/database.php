<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed " . $this->db->connect_error);
        }
    }

    public function getCurrentUser(){
        if(!isUserLoggedIn()){
            die("not logged in");
        }
        $query = " select * from utente where email=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s",$_SESSION["email"]);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function registerUser($nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita,$infoUtente)
    {
        $query = "insert into utente(nome,cognome,email,password,username,indirizzo,`data nascita`,`info_venditore`) values (?,?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssssss', $nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita,$infoUtente);
        return $stmt->execute();
    }

    public function updateUser($nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita,$infoUtente){
        if(!isUserLoggedIn()){
            die("not logged in");
        }
        $query = "update utente set nome=?,cognome=?,email=?,password=?,username=?,indirizzo=?,`data nascita`=?,`info_venditore`=? where email =?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssssss', $nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita,$infoUtente,$_SESSION['email']);
        return $stmt->execute();
    }

    public function checkUser($email, $password)
    {
        $query = "select * from utente where email = ? and password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function insertTabellaNutrizionale($valEnergetico, $proteine, $grassi, $carboidrati, $fibre, $sodio)
    {
        $query = "INSERT INTO `tabellanutrizionale` ( `valoreEnergetico`, `proteine`, `grassi`, `carboidrati`, `fibre`, `sodio`) VALUES (?,?,?,?,?,?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("dddddd", $valEnergetico, $proteine, $grassi, $carboidrati, $fibre, $sodio);
        $success = $stmt->execute();
        if (!$success) {
            die("Error " . $this->db->connect_error);
        }
        return $stmt->insert_id;
    }
    public function try()
    {
        return $this->db->query("select CURRENT_DATE() as date");
    }
    public function insertRicetta($titolo, $difficolta, $descrizione, $procedimento, $consigli, $valEnergetico, $proteine, $grassi, $carboidrati, $fibre, $sodio)
    {
        $date = $this->db->query("select CURRENT_DATE() as date")->fetch_assoc()["date"];
        //inserire controllo su date
        if (!isset($_SESSION["email"])) {
            die("Error: sessione non iniziata");
        }
        $idTabellaNutrizionale = $this->insertTabellaNutrizionale($valEnergetico, $proteine, $grassi, $carboidrati, $fibre, $sodio);
        if ($idTabellaNutrizionale == null) {
            die("Error: errore inserimento tabella nutrizionale");
        }
        $autore = $_SESSION["email"];
        $query = "INSERT INTO `ricetta` (`titolo`, `tabellaNutrizionale`, `difficoltà`, `descrizione`, `procedimento`, `consigli`, `data`, `autore`) VALUES (?,?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sidsssss", $titolo, $idTabellaNutrizionale, $difficolta, $descrizione, $procedimento, $consigli, $date, $autore);
        return $stmt->execute();
    }

    public function insertProdotto($nomeFungo,$prezzoUnità,$quantità,$informazioni){
        if(!isUserLoggedIn()){
            die("utente non loggato");
        }
        $date = $this->db->query("select CURRENT_DATE() as date")->fetch_assoc()["date"];
        $query = "INSERT INTO `prodotto` ( `prezzoPerUnità`, `quantità`, `informazioni`, `mediaValutazione`, `nomeFungo`, `data`, `offerente`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $media = 0;
        $stmt->bind_param("disdsss", $prezzoUnità, $quantità, $informazioni, $media, $nomeFungo, $date,$_SESSION["email"]);
        return  $stmt->execute();
    }

    public function updateRicetta($titolo, $difficolta, $descrizione, $procedimento, $consigli, $valEnergetico, $proteine, $grassi, $carboidrati, $fibre, $sodio, $chiave)
    {
        if (!isset($_SESSION["email"])) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare('select tabellaNutrizionale from ricetta where titolo = ? and autore = ?');
        $stmt->bind_param("ss", $chiave, $_SESSION['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $val = $result->fetch_all(MYSQLI_ASSOC)['0']['tabellaNutrizionale'];
        $query = 'UPDATE `ricetta` SET `titolo` = ?, `difficoltà`= ?,  `descrizione` = ?, `procedimento` = ?, `consigli` = ? WHERE `ricetta`.`titolo` = ? and autore = ?;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sdsssss', $titolo, $difficolta, $descrizione, $procedimento, $consigli, $chiave, $_SESSION['email']);
        $stmt->execute();
        $query = 'UPDATE `tabellanutrizionale` SET `valoreEnergetico` = ?, `proteine` = ?, `grassi` = ?, `carboidrati` = ?, `fibre` = ?, `sodio` = ? WHERE `tabellanutrizionale`.`codice` = ? ;';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ddddddd', $valEnergetico, $proteine, $grassi, $carboidrati, $fibre, $sodio, $val);
        return $stmt->execute();
    }


    public function updateProdotto($nomeFungo,$descrizione,$quantità,$prezzoUnità,$idProdotto){
        if (!isset($_SESSION["email"])) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare('update prodotto set nomeFungo=? ,informazioni=?, quantità=?, prezzoPerUnità=? where codice=? and offerente=?');
        $stmt->bind_param("ssidis", $nomeFungo, $descrizione,$quantità,$prezzoUnità,$idProdotto,$_SESSION["email"]);
        $stmt->execute();
    }

    public function imagesRecipe($titolo)
    {
        $stmt = $this->db->prepare("select nome from immaginericetta  where titoloRicetta = ?;");
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function imagesProduct($codice)
    {
        $stmt = $this->db->prepare("select nome from immagineprodotto where codProdotto = ?;");
        $stmt->bind_param('i', $codice);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function removeImageFromRecipe($nome, $titolo)
    {
        if (!isUserLoggedIn()) {
            die('utente non loggato');
        }
        $stmt = $this->db->prepare("delete from immaginericetta where nome = ? and titoloRicetta = ?;");
        $stmt->bind_param('ss', $nome, $titolo);
        $result = $stmt->execute();
        return $result;
    }
    
    public function removeImageFromProduct($nome, $codice)
    {
        if (!isUserLoggedIn()) {
            die('utente non loggato');
        }
        $stmt = $this->db->prepare("delete from immagineprodotto where nome = ? and codProdotto = ?;");
        $stmt->bind_param('si', $nome, $codice);
        $result = $stmt->execute();
        return $result;
    }
    public function insertImageToRecipe($nome, $titolo)
    {
        if (!isUserLoggedIn()) {
            die('utente non loggato');
        }
        $stmt = $this->db->prepare("insert into immaginericetta(`titoloRicetta`,`nome`) values (?,?)");
        $stmt->bind_param('ss', $titolo, $nome);
        $result = $stmt->execute();
        return $result;
    }

    
    public function insertImgToProduct($nome, $codice)
    {
        if (!isUserLoggedIn()) {
            die('utente non loggato');
        }
        $stmt = $this->db->prepare("insert into immagineprodotto(`codProdotto`,`nome`) values (?,?)");
        $stmt->bind_param('is', $codice, $nome);
        $result = $stmt->execute();
        return $result;
    }
    public function getProducts()
    {
        //restituisce prodotti con immagine associata ma solo una tra le immagini
        $query = "SELECT p.nomeFungo, p.prezzoPerUnità, p.quantità, p.codice, p.data, i.nome as img, u.username
                  FROM prodotto p, immagineprodotto i, utente u
                  WHERE p.codice = i.codProdotto
                  AND p.offerente = u.email
                  GROUP BY p.codice";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProductById($id)
    {
        $query = "SELECT p.*, u.username
                  FROM prodotto p, utente u
                  WHERE p.offerente = u.email
                  AND codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProductImages($id)
    {
        $query = "SELECT nome FROM  immagineprodotto WHERE codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProductReviews($id)
    {
        $query = "SELECT r.codice, r.titolo, r.data, r.contenuto, r.valutazione, u.username
                  FROM recensione r, utente u
                  WHERE r.utente = u.email
                  AND codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function addProductReview($titolo, $contenuto, $voto, $utente, $prodotto){
        $data = date("Y/m/d");
        $query = "INSERT INTO recensione(titolo, contenuto, valutazione, data, utente, codProdotto)
                  VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssdssi', $titolo, $contenuto, $voto, $data, $utente, $prodotto);
        $stmt->execute();
    }

    public function getRicetteUtente()
    {
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query = "SELECT r.*,t.*
                  FROM ricetta r JOIN utente u ON (r.autore = u.email) 
                  JOIN tabellanutrizionale t ON ( r.tabellaNutrizionale = t.codice) 
                  WHERE u.email = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getRicetteUtenteByUsername($username)
    {
        $query = "SELECT r.*,im.nome as img
                  FROM ricetta r JOIN utente u ON (r.autore = u.email) 
                  join immaginericetta im on ( im.titoloRicetta = r.titolo)
                  WHERE u.username = ?
                  group by r.titolo;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function getProdottiUtente(){
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query = "SELECT p.*
                  FROM prodotto p JOIN utente u ON (p.offerente = u.email)  
                  WHERE u.email = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProdottiUtenteByUsername($username){
        
        $query = "SELECT p.*,ip.nome as img ,u.username
                  FROM prodotto p JOIN utente u ON (p.offerente = u.email)  
                  join immagineprodotto ip on (p.codice = ip.codProdotto)
                  WHERE u.username = ?
                  group by p.codice ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteRicetta($titolo)
    {
        if (!isUserLoggedIn()) {
            die("Utente non loggato");
        }
        $query = "delete from ricetta where titolo=? and autore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $titolo, $_SESSION['email']);
        $stmt->execute();
    }

    public function deleteProdotto($codice){
        if (!isUserLoggedIn()) {
            die("Utente non loggato");
        }
        $query = "delete from prodotto where codice=? and offerente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $codice, $_SESSION['email']);
        $stmt->execute();
    }

    public function getNomiScientificiFunghi(){
        $query = "select nomeScientifico from tipologiafungo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    //?
    public function getRecipes()
    {
        $query = "SELECT r.titolo, r.data, r.descrizione, u.username as autore, i.nome as img
                  FROM ricetta r, utente u, immaginericetta i
                  WHERE r.autore = u.email
                  AND i.titoloRicetta = r.titolo
                  GROUP BY r.titolo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRecipeByTitle($titolo)
    {
        $query = "SELECT r.*, u.username
                  FROM ricetta r, utente u
                  WHERE r.autore = u.email
                  AND r.titolo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getNutritionalTable($titolo)
    {
        $query = "SELECT t.*
                  FROM ricetta r, tabellanutrizionale t
                  WHERE r.tabellaNutrizionale = t.codice
                  AND r.titolo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getIngredientsForRecipe($titolo)
    {
        $query = "SELECT nome, quantità
                  FROM ingrediente
                  WHERE titoloRicetta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRecipeImages($titolo)
    {
        $query = "SELECT nome
                  FROM immaginericetta
                  WHERE titoloRicetta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRecipeComments($titolo)
    {
        $query = "SELECT c.codice, c.contenuto, c.data, u.username
                  FROM commento c, utente u
                  WHERE c.autore = u.email
                  AND c.ricetta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function addRecipeComment($contenuto, $autore, $ricetta){
        $data = date("Y/m/d");
        $query = "INSERT INTO commento(contenuto, data, autore, ricetta)
                  VALUES (?, ?, ?, ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $contenuto, $data, $autore, $ricetta);
        $stmt->execute();
    }

    public function getProductInCart($email)
    {
        $query = 'SELECT prod.nomeFungo, pc.quantità, prod.prezzoPerUnità, prod.codice
                  FROM utente u JOIN carrello c ON (u.email = c.utente)
                  JOIN prodotto_carrello pc ON(pc.codCarrello = c.cod)
                  JOIN prodotto prod ON (prod.codice = pc.codProdotto)
                  WHERE u.email = ? ';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getCartID($email)
    {
        $query = 'SELECT c.cod
                    FROM carrello c , utente u
                    WHERE c.utente = u.email
                    AND u.email =  ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result[0]["cod"];
    }
    public function addProductToCart($codprod,$quantità,$email)
    {
        $codCarr=$this->getCartID($email);
        $query = 'INSERT INTO prodotto_carrello
                   VALUES (?,?,?)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $codCarr,$codprod,$quantità);
        $stmt->execute();
    }
    public function removeProductfromCart($codprod, $email)
    {
        $codCarr=$this->getCartID($email);
        $query = 'DELETE FROM prodotto_carrello
                  WHERE codProdotto = ?
                  AND codCarrello = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $codprod, $codCarr);
        $stmt->execute();
    }

    public function createCart($email)
    {   
        $query = 'INSERT INTO carrello(utente,totaleCarrello)
                   VALUES (?,0)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
    }

    public function getLatestProducts($n){
        $query = "SELECT p.nomeFungo, p.prezzoPerUnità, p.quantità, p.codice, i.nome as img, u.username
                  FROM prodotto p, immagineprodotto i, utente u
                  WHERE p.codice = i.codProdotto
                  AND p.offerente = u.email
                  GROUP BY p.codice
                  ORDER BY p.data DESC
                  LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getLatestRecipes($n){
        $query = "SELECT r.titolo, r.data, r.descrizione, u.username as autore, i.nome as immagine
                  FROM ricetta r, utente u, immaginericetta i
                  WHERE r.autore = u.email
                  AND i.titoloRicetta = r.titolo
                  GROUP BY r.titolo
                  ORDER BY r.data
                  LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function deleteReviewById($id){
        $query = "DELETE FROM recensione
                  WHERE codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function deleteCommentById($id){
        $query = "DELETE FROM commento
                  WHERE codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function getAcquisti(){
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query = "SELECT a.data, a.totale, ap.quantità, p.nomeFungo
                  FROM acquisto a, acquisto_prodotto ap, prodotto p
                  WHERE a.codice = ap.codAcquisto
                  AND ap.codProdotto = p.codice
                  AND a.acquirente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProdottiVenduti(){
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query = "SELECT a.codice, a.data, a.totale, ap.quantità, p.nomeFungo, u.username
                  FROM utente u, acquisto a, acquisto_prodotto ap, prodotto p
                  WHERE u.email = a.acquirente
                  AND a.codice = ap.codAcquisto
                  AND ap.codProdotto = p.codice
                  AND p.offerente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }


    public function getUtente($username){
        $stmt = $this->db->prepare("select nome,cognome,email,indirizzo,'data nascita',username,offerteVendute,offerteInserite,mediaValutazioni,info_venditore from utente where username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
