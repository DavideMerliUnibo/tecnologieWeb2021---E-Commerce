<?php 
session_start();
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "databasefunghi");
define("UPLOAD_DIR", "upload/");
require_once("utils/functions.php");
