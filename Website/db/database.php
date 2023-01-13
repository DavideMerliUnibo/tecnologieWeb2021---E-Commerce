<?php
class DatabaseHelper
{
    public $db;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed " . $this->db->connect_error);
        }
    }

    public function getCurrentUser()
    {
        if (!isUserLoggedIn()) {
            die("not logged in");
        }
        $query = " select * from utente where email=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function registerUser($nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita, $infoUtente)
    {
        $query = "insert into utente(nome,cognome,email,password,username,indirizzo,`data nascita`,`info_venditore`) values (?,?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssssss', $nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita, $infoUtente);
        return $stmt->execute();
    }

    public function updateUser($nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita, $infoUtente)
    {
        if (!isUserLoggedIn()) {
            die("not logged in");
        }
        $query = "update utente set nome=?,cognome=?,email=?,password=?,username=?,indirizzo=?,`data nascita`=?,`info_venditore`=? where email =?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssssss', $nome, $cognome, $email, $password, $username, $indirizzo, $dataNascita, $infoUtente, $_SESSION['email']);
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
    public function getCurrentDate()
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

    public function insertProdotto($nomeFungo, $prezzoUnità, $quantità, $informazioni)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $date = $this->db->query("select CURRENT_DATE() as date")->fetch_assoc()["date"];
        $query = "INSERT INTO `prodotto` ( `prezzoPerUnità`, `quantità`, `informazioni`, `mediaValutazione`, `nomeFungo`, `data`, `offerente`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $media = 0;
        $stmt->bind_param("disdsss", $prezzoUnità, $quantità, $informazioni, $media, $nomeFungo, $date, $_SESSION["email"]);
        if (!$stmt->execute()) {
            return false;
        }
        return $this->incrementaOfferteInserite();
    }

    public function incrementaOfferteInserite()
    {
        if (!isUserLoggedIn()) {
            die('utente non loggato');
        }
        $stmt = $this->db->prepare("update utente set offerteInserite = offerteInserite + 1 where email = ?;");
        $stmt->bind_param("s", $_SESSION['email']);
        return $stmt->execute();
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


    public function updateProdotto($nomeFungo, $descrizione, $quantità, $prezzoUnità, $idProdotto)
    {
        if (!isset($_SESSION["email"])) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare('update prodotto set nomeFungo=? ,informazioni=?, quantità=?, prezzoPerUnità=? where codice=? and offerente=?');
        $stmt->bind_param("ssidis", $nomeFungo, $descrizione, $quantità, $prezzoUnità, $idProdotto, $_SESSION["email"]);
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

    public function addProductReview($titolo, $contenuto, $voto, $utente, $prodotto)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        if (!$this->checkOfferenteProdotto($prodotto)) {
            return "Recensione non consentita su proprio prodotto";
        }
        if (!$this->checkAcquistoProdotto($prodotto)) {
            return "Recensione non consentita su prodotto mai acquistato";
        }
        if (!$this->checkProdottoNotReviewed($prodotto, $utente)) {
            return "Recensione utente già presente";
        }
        $data = date("Y/m/d");
        $query = "INSERT INTO recensione(titolo, contenuto, valutazione, data, utente, codProdotto)
                  VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssdssi', $titolo, $contenuto, $voto, $data, $utente, $prodotto);
        if ($stmt->execute()) {
            return $this->updateMediaValutazioneProdotto($prodotto);
        }
        return false;
    }

    public function checkAcquistoProdotto($codProd)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare("select * from acquisto_prodotto ap 
            join acquisto a on (a.codice = ap.codAcquisto) 
            where ap.codProdotto = ? 
            and a.acquirente = ?");
        $stmt->bind_param("is", $codProd, $_SESSION["email"]);
        if ($stmt->execute()) {
            return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) != 0;
        }
        return false;
    }
    public function checkOfferenteProdotto($codProd)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare("select offerente from prodotto where codice = ?");
        $stmt->bind_param("i", $codProd);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($res) > 0) {
            return $res[0]["offerente"] !== $_SESSION['email'];
        }
        return false;
    }

    public function checkProdottoNotReviewed($codProd, $utente)
    {
        $stmt = $this->db->prepare("select * from recensione where codProdotto = ? and utente = ?;");
        $stmt->bind_param("is", $codProd, $utente);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($res) == 0;
    }
    public function checkRicettaNotReviewed($ricetta, $autore)
    {
        $stmt = $this->db->prepare("select * from commento where ricetta = ? and autore = ?;");
        $stmt->bind_param("ss", $ricetta, $autore);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return count($res) == 0;
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


    public function getProdottiUtente()
    {
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

    public function getProdottiUtenteByUsername($username)
    {

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

    public function deleteProdotto($codice)
    {
        if (!isUserLoggedIn()) {
            die("Utente non loggato");
        }
        $query = "delete from prodotto where codice=? and offerente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $codice, $_SESSION['email']);
        $stmt->execute();
    }

    public function getNomiScientificiFunghi()
    {
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

    public function addRecipeComment($contenuto, $autore, $ricetta)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        if (!$this->checkAutoreRicetta($ricetta)) {
            return "Commento non consentito su propria ricetta";
        }
        if (!$this->checkRicettaNotReviewed($ricetta, $autore)) {
            return "Commento utente già presente";
        }
        $data = date("Y/m/d");
        $query = "INSERT INTO commento(contenuto, data, autore, ricetta)
                  VALUES (?, ?, ?, ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $contenuto, $data, $autore, $ricetta);
        $stmt->execute();
    }

    public function checkAutoreRicetta($ricetta)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare("select autore from ricetta where titolo = ?");
        $stmt->bind_param("s", $ricetta);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($res) > 0) {
            return $res[0]["autore"] !== $_SESSION['email'];
        }
        return false;
    }

    public function getProductsInCart($email)
    {
        $query = 'SELECT prod.nomeFungo, pc.quantità, prod.prezzoPerUnità, prod.codice, prod.offerente
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

    public function updateQtyProductCart($codprod, $quantità)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
            return "utente non loggato";
        }
        if ($quantità <= 0) {
            return "quantità non consentita";
        }
        $email = $_SESSION["email"];
        $codCarr = $this->getCartID($email);
        if ($this->checkDisponibilitàProdotto($codprod, $quantità)) {
            $stmt = $this->db->prepare("update prodotto_carrello set quantità=? 
                where codCarrello = ? 
                and codProdotto = ?;");
            $stmt->bind_param('iii', $quantità, $codCarr, $codprod);
            if($stmt->execute()){
                return "success";
            }
        } else {
            return "max num raggiunto";
        }
        return "failure";
    }
    public function addProductToCart($codprod, $quantità)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }

        $email = $_SESSION["email"];
        $codCarr = $this->getCartID($email);
        $stmt = $this->db->prepare("select quantità from prodotto_carrello pc 
            where codCarrello = ?
            and codProdotto = ?;");
        $stmt->bind_param('ii', $codCarr, $codprod);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($res) != 0) {
            $qty = $res[0]["quantità"];
            $nuovaQty = $qty + $quantità;
            if ($this->checkDisponibilitàProdotto($codprod, $nuovaQty)) {
                $stmt = $this->db->prepare("update prodotto_carrello set quantità=? 
                    where codCarrello = ? 
                    and codProdotto = ?;");
                $stmt->bind_param('iii', $nuovaQty, $codCarr, $codprod);
                $stmt->execute();
            } else {
                return "max num raggiunto";
            }
        }
        $query = 'INSERT INTO prodotto_carrello
                   VALUES (?,?,?)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $codCarr, $codprod, $quantità);
        if ($stmt->execute()) {
            return "success";
        }
        return "failure";
    }
    public function checkDisponibilitàProdotto($codProd, $qty)
    {
        if ($qty > 0) {
            $qtyProd = $this->getProductById($codProd)[0]["quantità"];
            if ($qty > $qtyProd) {
                return false;
            }
            return true;
        }
        return false;
    }
    public function removeProductfromCart($codprod, $email)
    {
        $codCarr = $this->getCartID($email);
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
        $stmt->bind_param('s', $email);
        $stmt->execute();
    }

    public function getLatestProducts($n)
    {
        $query = "SELECT p.nomeFungo, p.prezzoPerUnità, p.quantità, p.codice, i.nome as img, u.username
                  FROM prodotto p, immagineprodotto i, utente u
                  WHERE p.codice = i.codProdotto
                  AND p.offerente = u.email
                  AND p.quantità > 0 
                  GROUP BY p.nomeFungo
                  ORDER BY p.data DESC
                  LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getLatestRecipes($n)
    {
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

    public function deleteReviewById($id)
    {
        $stmt = $this->db->prepare("select codProdotto from recensione where codice =? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $codProd = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["codProdotto"];

        $query = "DELETE FROM recensione
                  WHERE codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            return $this->updateMediaValutazioneProdotto($codProd);
        }
        return false;
    }

    public function deleteCommentById($id)
    {
        $query = "DELETE FROM commento
                  WHERE codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function getAcquisti()
    {
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query = "SELECT codice, data, totale
                  FROM acquisto
                  WHERE acquirente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getProdottiInAcquisto($codice)
    {
        $query = "SELECT ap.quantità, p.nomeFungo, p.offerente, p.codice
                  FROM acquisto_prodotto ap, prodotto p
                  WHERE ap.codProdotto = p.codice
                  AND ap.codAcquisto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codice);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProdottiVenduti()
    {
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


    public function getUtente($username)
    {
        $stmt = $this->db->prepare("select nome,cognome,email,indirizzo,`data nascita`,username,funghiVendutiKg,offerteInserite,mediaValutazioni,info_venditore from utente where username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function insertAcquisto($metodoPagamento, $nomeCarta, $numeroCarta, $scadenzaCarta, $ccvCarta)
    {

        if (!isUserLoggedIn()) {
            return "notLogged";
        }
        if (!$this->checkDisponibilitàProdottiCarrello()) {
            return "some products aren't available";
        }
        if (!$this->insertCard($numeroCarta)) {
            return "problem with card";
        };

        $idCard = $this->getIdCard($numeroCarta);
        if ($idCard == false) {
            return "problem with id card";
        }
        $stmt = $this->db->prepare("insert into acquisto(data,totale,acquirente,idCarta) value (CURRENT_DATE(),?,?,?);");
        $tot = $this->calculateTotalCart();
        $stmt->bind_param("dsi", $tot, $_SESSION["email"], $idCard);
        if (!$stmt->execute()) {
            return "error with insert of the acquisto";
        }
        $idAcquisto = $stmt->insert_id;

        if (!$this->insertAcquistoProdotti($idAcquisto)) {
            return "error with insert of acquisto prodotti";
        }
        
        return "success";
    }

    public function insertCard($numeroCarta)
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        if (!$this->checkCard($numeroCarta)) {
            return true;
        }
        $stmt = $this->db->prepare("insert into cartadicredito (codiceCarta,titolare) values (?,?);");
        $stmt->bind_param("ss", $numeroCarta, $_SESSION["email"]);
        return $stmt->execute();
    }

    public function checkCard($numeroCarta)
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        $stmt = $this->db->prepare("select * from cartadicredito where codiceCarta = ?");
        $stmt->bind_param("s", $numeroCarta);
        $stmt->execute();
        return !(count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) == 1);
    }

    public function getIdCard($numeroCarta)
    {
        $stmt = $this->db->prepare("select ID from cartadicredito where codiceCarta = ?;");
        $stmt->bind_param("s", $numeroCarta);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($res) == 1) {
            return $res[0]["ID"];
        }
        return false;
    }

    public function calculateTotalCart()
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        $stmt = $this->db->prepare("select SUM(p.prezzoPerUnità * pc.quantità) as total  from prodotto_carrello pc 
            join carrello c on (pc.codCarrello = c.cod)
            join prodotto p on (p.codice = pc.codProdotto)
            where c.utente = ?");
        $stmt->bind_param("s", $_SESSION["email"]);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["total"];
    }

    public function insertAcquistoProdotti($codAcquisto)
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        $prodotti = $this->getProductsInCart($_SESSION["email"]);
        foreach ($prodotti as $prod) {
            $stmt = $this->db->prepare("insert into acquisto_prodotto(codProdotto,codAcquisto,quantità) values (?,?,?);");
            $stmt->bind_param("iii", $prod["codice"], $codAcquisto, $prod["quantità"]);
            $ok = $stmt->execute();
            if (!$ok) {
                return false;
            }
            if (!$this->incrementaFunghiVendutiKg($prod["quantità"], $prod["offerente"])) {
                return false;
            }
        }
        return $this->subtractProducts();
    }

    public function incrementaFunghiVendutiKg($kg, $emailVenditore)
    {
        $stmt = $this->db->prepare("update utente set funghiVendutiKg = funghiVendutiKg + ? where email = ?;");
        $stmt->bind_param("is", $kg, $emailVenditore);
        return $stmt->execute();
    }

    public function svuotaCarrello()
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        $cart = $this->getCartID($_SESSION["email"]);
        $stmt = $this->db->prepare("delete from prodotto_carrello where codCarrello = ?");
        $stmt->bind_param("i", $cart);
        return $stmt->execute();
    }

    public function checkDisponibilitàProdottiCarrello()
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        $prodInCart = $this->getProductsInCart($_SESSION["email"]);
        foreach ($prodInCart as $prod) {
            $qtyCart = $prod["quantità"];
            $qtyProd = $this->getProductById($prod["codice"])[0]["quantità"];
            if ($qtyCart > $qtyProd) {
                return false;
            }
        }
        return true;
    }

    public function getProductInCart($email, $codProd)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $query = 'SELECT prod.nomeFungo, pc.quantità, prod.prezzoPerUnità, prod.codice, prod.offerente
                  FROM utente u JOIN carrello c ON (u.email = c.utente)
                  JOIN prodotto_carrello pc ON(pc.codCarrello = c.cod)
                  JOIN prodotto prod ON (prod.codice = pc.codProdotto)
                  WHERE u.email = ? 
                  AND prod.codice = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $email, $codProd);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function checkDisponibilitàProdottoCarrello($codProd)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $prod = $this->getProductInCart($_SESSION["email"], $codProd);
        if (count($prod) > 0) {
            $qtyCart = $prod[0]["quantità"];
            $qtyProd = $this->getProductById($prod[0]["codice"])[0]["quantità"];
            if ($qtyCart > $qtyProd) {
                return false;
            }
            return true;
        }
        return false;
    }


    public function subtractProducts()
    {
        if (!isUserLoggedIn()) {
            return false;
        }
        $prodInCart = $this->getProductsInCart($_SESSION["email"]);
        foreach ($prodInCart as $prod) {
            $qtyCart = $prod["quantità"];
            $qtyProd = $this->getProductById($prod["codice"])[0]["quantità"];
            $finalQty = $qtyProd - $qtyCart;
            if ($qtyCart <= $qtyProd) {
                $stmt = $this->db->prepare("update prodotto set quantità = ? where codice=?;");
                $stmt->bind_param("ii", $finalQty, $prod["codice"]);
                if (!$stmt->execute()) {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }


    public function updateMediaValutazioneProdotto($codProd)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare("update prodotto set mediaValutazione = (select avg(r.valutazione) from recensione r where r.codProdotto=? group by codProdotto) where codice = ?;");
        $stmt->bind_param("ii", $codProd, $codProd);
        if ($stmt->execute()) {
            $offerente = $this->getProductById($codProd)[0]["offerente"];
            return $this->updateMediaValutazioniUtente($offerente);
        }
        return false;
    }

    public function updateMediaValutazioniUtente($email)
    {
        if (!isUserLoggedIn()) {
            die("utente non loggato");
        }
        $stmt = $this->db->prepare("update utente set mediaValutazioni = (select avg(mediaValutazione) from prodotto where offerente = ?) where email = ?");
        $stmt->bind_param("ss", $email, $email);
        return $stmt->execute();
    }

    public function getNotifiche()
    {
        if (!isUserLoggedIn()) {
            die("Error: utente non loggato");
        }
        $query = "SELECT codice, data, messaggio
                  FROM notifica
                  WHERE utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function deleteNotifica($codice)
    {
        $query = "DELETE FROM  notifica
                  WHERE codice = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $codice);
        $stmt->execute();
    }

    public function insertNotifica($msg, $user)
    {
        $data = date("Y/m/d");
        $query = "INSERT INTO  notifica(messaggio, data, utente)
                  VALUES(?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $msg, $data, $user);
        $stmt->execute();
    }

    public function getLatestAcquisto() {
        $query = "SELECT MAX(codice) as codice FROM acquisto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getTipologieFunghi() {
        $query = "SELECT nomeScientifico FROM tipologiafungo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
