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
}
