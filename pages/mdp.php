<?php
session_start();
include('../connexion/connect.php');
// var_dump($_post);die;

if (isset($_POST['submit'])) {

  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $passwords = $_SESSION['passwords'];
    $role = $_SESSION['roles'];
  }
  $ancien = $_POST['opwd'];
  $nouveau = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
  /* $confirme=$_POST['pwd1'];
 */
  $query = $bdd->prepare("SELECT id, passwords FROM user WHERE id=$id");
  $query->execute();


  $date_modif = date("Y-m-d H:i:s");
$newPassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
if (isset($_SESSION['passwords'], $_SESSION['id'])) {
  $verifyPassword = password_verify($ancien, $_SESSION['passwords']);
  $id = $_SESSION['id'];
}

if ($verifyPassword) {
  $sql = $bdd->prepare("UPDATE user SET passwords='$newPassword' WHERE id='$id'");
  $sql->execute();
  echo "Password modifié";
}
}


?>

<?php

/* public function updatePassword($oldPassword,$newPassword){ */

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="laReussite.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<header>
  <button type="button" class="btn btn-primary"><a href="../pages/paramétrage.php" style="color:white">Retour</a></button>
</header>

<body>
  <div style="width:70%; display:flex; justify-content:center">

    <form action="" name="changepwd" method="POST" class="row g-3" id="loginform" onsubmit="return valid();" style="margin-top: 20px; margin-left:350px; background-color:#F5F5F5">

      <div id="message" style="height: 50px; width:40%;margin-left: 250px;">
        <div style="color:red; height:30px; background-color:#F5F5F5;"><?= $_GET['msg1'] ?? null ?></div>
      </div>

      <div class="col-6">
        <label for="inputAddress2" class="form-label">ancien mot_de_passe* </label>
        <input type="password" class="form-control" name="opwd" id="opwd" placeholder="mot_de_passe">
        <p id="erreurancien"></p>

      </div>
      <div class="col-6">
        <label for="inputAddress2" class="form-label">nouveau mot_de_passe*</label>
        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="mot_de_passe">
        <p id="erreurpwd"></p>
      </div>
      <div class="col-6">
        <label for="inputAddress2" class="form-label">confirme mot_de_passe* </label>
        <input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="mot_de_passe">
        <p id="erreurpwd1"></p>
      </div>
      <div class="col-6">
        <input type="submit" id="submit" name="submit" value="change password" class="btn btn-primary" style="background-color:#05006B">
      </div>
      <script src="../connexion/controlemdp.js"></script>

    </form>
  </div>
</body>

</html>