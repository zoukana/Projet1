<?php
include('../connexion/connect.php');
if (isset($_GET['switchid'])) {
    $id=$_GET['switchid'];
    $list=$bdd->prepare("SELECT * FROM user where id=$id");
    $list->execute();
     if ($list->rowCount() > 0) { 
    $check=$list->fetch();
/*     var_dump($check['roles']);die;
 */
    if ($check['roles'] =='admin'){
        $list=$bdd->prepare("UPDATE user SET  roles='user' WHERE id=$id");//code pour archiver en changeant la valeur 0 par 1
        $list->execute();
    } else {
        $list=$bdd->prepare("UPDATE user SET  roles='admin' WHERE id=$id");//code pour archiver en changeant la valeur 0 par 1
        $list->execute();
    }

    
    if($list){
        header('location:../pages/pageadmin.php');
    
    }

    }
}
?>