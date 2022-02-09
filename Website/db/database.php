<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname, 3340);
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
        $query = "SELECT * FROM prodotto";
        $stmt = $this -> db -> prepare($query);
        $stmt -> execute();
        $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
