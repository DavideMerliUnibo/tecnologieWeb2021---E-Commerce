<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password,$dbname);
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
}
