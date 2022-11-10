<?php
/* ini_set("display_errors", "-1");
error_reporting(E_ALL); */
session_start();
include '../connexion/connect.php';
/*  var_dump($_GET["nom"],$_GET['prenom'],$_GET['email'],$_GET['roles'],$_GET['photo'],$_GET['passwords']);die;
 */ if (isset($_POST["nom"], $_POST['prenom'], $_POST['email'], $_POST['roles'], $_POST['passwords'])) {
  # code...
  $nom = htmlspecialchars($_POST["nom"]);
  $prenom = htmlspecialchars($_POST['prenom']);
  $email = htmlspecialchars($_POST['email']);
  $roles = htmlspecialchars($_POST['roles']);
  $passwords = htmlspecialchars($_POST['passwords']);
  @$photo=file_get_contents($_FILES['photo']['tmp_name']) ;



  $rese = $bdd->query("SELECT email from user where email='$email'");
  if ($rese->rowCount() > 0) {
    $erreur="<div class='alert alert-danger' role='alert'>
 <p class='text-center'> Email existant</p>
  </div>";
    } 
 
  $res = $bdd->query("SELECT matricule from user");
  if ($res->rowCount() > 0) {
    $matricules = $res->fetchAll();
    $matricule = $matricules[count($matricules)- 1]['matricule'];
    $increment = (int) explode("/", $matricule)[1]+1;
    $incr = (int) explode("/", $matricule)[1];
    $increment = $incr + 1;
    $mat = "KANA_2022/$increment";
  }else{
    $mat = "KANA_2022/1";
  }

    $rese = $bdd->prepare('SELECT email from user where email = ? ');
    $rese->execute(array($email));
    $req= $rese->fetch();
    $res = $rese->rowCount();
    if ($res == 0) {
      $cost = ['cost' => 12];
      $passwords = password_hash($passwords, PASSWORD_DEFAULT);  

      $stmtAjoutuser = $bdd->prepare("INSERT INTO user(nom,prenom,email,roles,passwords,matricule) 
    VALUES (?,?,?,?,?,?)");
    $stmtAjoutuser->bindParam(1,$nom);
    $stmtAjoutuser->bindParam(2,$prenom);
    $stmtAjoutuser->bindParam(3,$email);
    $stmtAjoutuser->bindParam(4,$roles);
/*     $stmtAjoutuser->bindParam(5,$photo);
 */    $stmtAjoutuser->bindParam(5,$passwords);
    $stmtAjoutuser->bindParam(6,$mat);
   $stmtAjoutuser->execute();

   $id=(int)$bdd->lastInsertId();
   $req=$bdd->prepare("INSERT INTO images (photo,user) VALUES(?,?)");
   $req->bindParam(1,$photo);
   $req->bindParam(2,$id);
   $req->execute();

   if ($stmtAjoutuser) {
    $success = "<div class='alert alert-success' role='alert' style='width=15%';>
    <p class='text-center'> inscription reussi</p>
    <br>
    <p class='text-center'>voulez vous restez  sur cette page?</p>

    <br>
   <div style='display-flex ;justify-content:cente;r'> 
   <button type='button' class='btn btn-success' ><a href='../pages/formulaire.php'>oui</a> </button>
    <button type='button' class='btn btn-danger'><a href='../connexion/connexion.php'>non</a></button>
     </div>
    <div>";
  } else {
    die('Erreur : ' . $e->getMessage());
  }

    }



}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Formulaire</title>

</head>

<body>

  <div class="container my-5">

    <form action="" method="POST" class="row g-3" style="background-color:#D9D9D9" id="loginform" enctype="multipart/form-data">
      <div>
        <h2 class="text-center">FORMULAIRE D'INSCRIPTION</h2>
      </div>
      <div>
<div><p><?= $success ?? null  ?> </p> </div>
<div><p><?= $erreur ?? null  ?> </p> </div>
      </div>
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Prenom (*)</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="PRENOM">
        <p id="erreurprenom"></p>

      </div>

      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Nom (*)</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="NOM">
        <p id="erreurNom"></p>

      </div>
      <div class="col-6">
        <label for="inputAddress" class="form-label">Email (*)</label>
        <input type="text" autocomplete="off" class="form-control" id="email" placeholder="Email" name="email">
        <p id="erreuremail"></p>

      </div>
      <div class="col-md-6">
        <label for="inputState" class="form-label">role (*)</label>
        <select id="role" name="roles" class="form-select">
          <option value="" selected></option>
          <option value="admin" name="roles">administrateur</option>
          <option value="user" name="roles">user_simple</option>
        </select>
        <p id="erreurrole"></p>
      </div>
      <div class="col-6">
        <label for="inputAddress2" class="form-label">mot_de_passe*</label>
        <input type="password" name="passwords" class="form-control" id="pwd" placeholder="mot_de_passe">
        <p id="erreurpwd"></p>
      </div>
      <div class="col-6">
        <label for="inputAddress2" class="form-label">saisir a nouveau le mot de passe* </label>
        <input type="password" class="form-control" name="password1" id="pwd1" placeholder="mot_de_passe">
        <p id="erreurpwd1"></p>

      </div>
      <div class="col-auto">
        <input type="file" class="form-control" id="photo" name="photo" placeholder="PHOTO" accept=".jpeg, .png, .jpj"> 
      </div>
      <br>
      <div class="col-6">
        <input type="submit" id="submit" name="submit"  class="btn btn-primary" style="background-color:#05006B">
      </div>
      <script src="../connexion/java.js"></script>
    </form>
</body>

</html>