<?php

$host="localhost";
$dbname='restdb';
$username="root";
$password="";

    
$conn=mysqli_connect($host,$username,$password,$dbname);

if(!$conn){
    die("connexion echec:". mysqli_connect_error());
}


?>