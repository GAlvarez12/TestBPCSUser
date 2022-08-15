<?php

function openCon(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "controlbpcs";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die ("Conexión fallida %s\n". $conn -> error);

    return $conn;
}

function closeCon($conn){
    $conn -> close();

}

?>