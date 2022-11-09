<!-- code PHP -->
<?php
include '../connexion/connect.php';
if(isset($_GET['updateid'])){
  // var_dump($_GET['updateid']);
  //  exit;   
    $id =$_GET['updateid'];
    $stmt=$bdd->prepare("SELECT * FROM user where id=$id");

    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $check=$stmt->fetchAll()[0];
    }
     
if(isset($_POST['nom'],$_POST['prenom'],$_POST['email'])){


	$nom=$_POST['nom'];	
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];			
  
    $id=$_GET['updateid'];	
    $datemodif=date('y-m-d h:i:s');

    $rese = $bdd->query("SELECT email from user where email='$email'");
    if ($rese->rowCount() > 0) {
      $erreur="<div class='alert alert-danger' role='alert'>
   <p class='text-center'> Email existant</p>
    </div>";
      } 
 
    $stmtAjoutPersonne=$bdd->prepare("UPDATE user SET nom='$nom',prenom='$prenom',email='$email', date_modif='$datemodif' WHERE id=$id");
    $stmtAjoutPersonne->execute();
    if($stmtAjoutPersonne){
        header('location:../pages/pageadmin.php? modif=modification effectué!');
    }else { die('Erreur : '.$e->getMessage());}
   
}

}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="laReussite.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <title>modification</title>
  </head>
  <header>
  <div><p><?= $erreur ?? null  ?> </p> </div>
  </header>
  <body>

 <div class="container my-5 w-50 bg-light">
 <form action="" method="post" class="row g-3" style="background-color:#D9D9D9" id="loginform">
      <div>
        <h2 class="text-center">FORMULAIRE D'INSCRIPTION</h2>
      </div>
      <div>
<div><p><?= $success ?? null  ?> </p> </div>
<div><p><?= $erreur ?? null  ?> </p> </div>
      </div>
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Prenom (*)</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $check["prenom"] ?? null  ?>" placeholder="PRENOM">
        <p id="erreurprenom"></p>

      </div>

      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Nom (*)</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $check["nom"] ?? null  ?>" placeholder="NOM">
        <p id="erreurNom"></p>

      </div>
      <div class="col-6">
        <label for="inputAddress" class="form-label">Email (*)</label>
        <input type="text" autocomplete="off" class="form-control" id="email" value="<?= $check["email"] ?? null  ?>" placeholder="Email" name="email">
        <p id="erreuremail"></p>

      </div>
      <br>
   <!--    <div class="col-6">
        <input type="submit" id="submit" name="submit"  class="btn btn-primary" style="background-color:#05006B">
      </div> -->
      <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Modifier</button>
            </div> 
      <script src="../connexion/controleupdate.js"></script>
    </form>
    </div>


 
  </body>
</html>