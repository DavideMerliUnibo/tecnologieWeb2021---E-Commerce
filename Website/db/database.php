<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname, 3306);
        if( $this->db->connect_error){
            die("Connection failed ". $this->db->connect_error);
        }
    }
    
    public function registerUser($nome,$cognome,$email,$password,$username,$indirizzo,$dataNascita){
        $query = "insert into utente(nome,cognome,email,password,username,indirizzo,`data nascita`) values (?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss',$nome,$cognome,$email,$password,$username,$indirizzo,$dataNascita);
        return $stmt->execute();
    }

    public function checkUser($email,$password){
        $query = "select * from utente where email = ? and password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss",$email,$password);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProducts(){
        $query = "SELECT p.*, i.nome as img, u.username
                  FROM prodotto p, immagineprodotto i, utente u
                  WHERE p.codice = i.codProdotto
                  AND p.offerente = u.email
                  GROUP BY p.codice";
        $stmt = $this -> db -> prepare($query);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProductById($id){
        $query = "SELECT p.*, u.username
                  FROM prodotto p, utente u
                  WHERE p.offerente = u.email
                  AND codice = ?";
        $stmt = $this -> db -> prepare($query);
        $stmt -> bind_param('i', $id);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProductImages($id){
        $query = "SELECT nome FROM  immagineprodotto WHERE codProdotto = ?";
        $stmt = $this -> db -> prepare($query);
        $stmt -> bind_param('i', $id);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getProductReviews($id){
        $query = "SELECT r.titolo, r.data, r.contenuto, r.valutazione, u.username
                  FROM recensione r, utente u
                  WHERE r.utente = u.email
                  AND codProdotto = ?";
        $stmt = $this -> db -> prepare($query);
        $stmt -> bind_param('i', $id);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
