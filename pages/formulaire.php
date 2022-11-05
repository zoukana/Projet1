<?php
include '../connexion/connect.php';
/*  var_dump($_POST["nom"],$_POST['prenom'],$_POST['email'],$_POST['roles'],$_POST['photo'],$_POST['passwords']);die;
 */ if (isset($_POST["nom"], $_POST['prenom'], $_POST['email'], $_POST['roles'], $_POST['photo'], $_POST['passwords'])) {
  # code...
  $nom = htmlspecialchars($_POST["nom"]);
  $prenom = htmlspecialchars($_POST['prenom']);
  $email = htmlspecialchars($_POST['email']);
  $roles = htmlspecialchars($_POST['roles']);
  $photo = htmlspecialchars($_POST['photo']);
  $passwords = htmlspecialchars($_POST['passwords']);
  
 $rese = $bdd->query("SELECT email from user where email='$email'");
 if ($rese->rowCount() > 0) {
   $erreur="<div class='alert alert-danger' role='alert'>
<p class='text-center'> Email existant</p>
 </div>";
   } else{
  $mat;

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

   $cost = ['cost' => 12];
  $passwords = password_hash($passwords, PASSWORD_DEFAULT); 

  $stmtAjoutuser = $bdd->prepare("INSERT INTO user(nom,prenom,email,roles,photo,passwords,matricule) 
        VALUES ('$nom','$prenom','$email','$roles','$photo','$passwords','$mat')");
  $stmtAjoutuser->execute();

  if ($stmtAjoutuser) {
    $success = "<div class='alert alert-success' role='alert' style='width=25%'>
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

    <form action="formulaire.php" method="post" class="row g-3" style="background-color:#D9D9D9" id="loginform">
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
        <input type="file" class="form-control" id="photo" name="photo" placeholder="PHOTO">
      </div>
      <br>
      <div class="col-6">
        <input type="submit" id="submit" name="submit"  class="btn btn-primary" style="background-color:#05006B">
      </div>
      <script src="../connexion/java.js"></script>
    </form>
</body>

</html>