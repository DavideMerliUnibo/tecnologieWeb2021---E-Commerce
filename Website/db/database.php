<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, 3340);
        if ($this->db->connect_error) {
            die("Connection failed " . $this->db->connect_error);
        }
    }

    public function registerUser($nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita)
    {
        $query = "insert into utente(nome,cognome,email,password,username,indirizzo,`data nascita`) values (?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita);
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

    public function getProducts()
    {
        $query = "SELECT p.nomeFungo, p.prezzoPerUnità, p.quantità, p.codice, i.nome as img, u.username
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
        $query = "SELECT r.titolo, r.data, r.contenuto, r.valutazione, u.username
                  FROM recensione r, utente u
                  WHERE r.utente = u.email
                  AND codProdotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRicetteUtente()
    {
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query =    "select r.*,t.*
                    from ricetta r join utente u on (r.autore = u.email) 
                    join tabellanutrizionale t on ( r.tabellaNutrizionale = t.codice) 
                    where u.email = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteRicetta($titolo){
        if(!isUserLoggedIn()){
            die("Utente non loggato");
        }
        $query = "delete from ricetta where titolo=? and autore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss",$titolo,$_SESSION['email']);
        $stmt->execute();
    }
    //?
    public function getRecipes(){
        $query = "SELECT r.titolo, r.data, r.descrizione, u.username as autore, i.nome as immagine
                  FROM ricetta r, utente u, immaginericetta i
                  WHERE r.autore = u.email
                  AND i.titoloRicetta = r.titolo
                  GROUP BY r.titolo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRecipeByTitle($titolo){
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

    public function getNutritionalTable($titolo){
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

    public function getIngredientsForRecipe($titolo){
        $query = "SELECT nome, quantità
                  FROM ingrediente
                  WHERE titoloRicetta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRecipeImages($titolo){
        $query = "SELECT nome
                  FROM immaginericetta
                  WHERE titoloRicetta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getRecipeComments($titolo){
        $query = "SELECT c.contenuto, c.data, u.username
                  FROM commento c, utente u
                  WHERE c.autore = u.email
                  AND c.ricetta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $titolo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getProductInCart($email){
        $query = 'SELECT * 
                  FROM utente u JOIN carrello c ON (u.email = c.utente)
                  JOIN prodotto_carrello pc ON(pc.codCarrello = c.cod)
                  JOIN prodotto prod ON (prod.codice = pc.codProdotto)
                  WHERE u.email = ? ';
        $stmt = $this -> db -> prepare($query);
        $stmt -> bind_param('s', $email);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
