<?php
// Se connecter à la base de données
/*  session_start();
 */ try{

    $bdd = new PDO("mysql:host=localhost;dbname=school;charset=utf8","root","");

}catch(PDOException $e){

    die('Erreur : '.$e->getMessage());
    
}


?>