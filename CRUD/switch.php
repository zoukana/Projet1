<?php
include('../connexion/connect.php');
if (isset($_GET['switchid'])) {
    $id=$_GET['switchid'];
    $stmt=$bdd->prepare("SELECT * FROM user where id=$id");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    $check=$stmt->fetchAll()[0];
   /*  var_dump($check['roles']);
    exit; */
    if ($check["roles"] === "admin"){
        $req=$bdd->prepare("UPDATE user SET `status`=0, roles='user',  WHERE id=$id");//code pour archiver en changeant la valeur 0 par 1
        $req->execute();
    } else {
        $req=$bdd->prepare("UPDATE user SET `status`=1,roles='admin',  WHERE id=$id");//code pour archiver en changeant la valeur 0 par 1
        $req->execute();
    }
  
    
    if($req){
       header('location:../pages/pageadmin.php?');
    }
    }
}