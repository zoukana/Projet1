
<?php
session_start();
include('../connexion/connect.php');
// var_dump($_post);die;

if(isset($_POST['submit'])){

$email=$_POST['email'];
$ancien=$_POST['opwd'];
$nouveau= password_hash($_POST['pwd'],PASSWORD_DEFAULT);
$confirme=$_POST['pwd1'];
$query= $bdd->prepare("SELECT email, passwords FROM user WHERE email=:email");
// $num = mysqli_fetch_array($query);
$query->execute([
  'email' =>$email, 
  // 'passwords' => $ancien
]);

$passwordUser = $query->fetch();
$check = password_verify($ancien,$passwordUser['passwords']);
/* var_dump($check );die;
 */if($check){
    $req=$bdd->prepare("UPDATE user SET passwords=:passwords WHERE email=:email");
    $req->execute(['passwords' => $nouveau, 'email'=> $email]);
 header('location:pageadmin.php?msg=mot_de_passe modifié avec succes!');
/*     $_session["msg"]="mot_de_passe modifié avec succes!";
 */}else{
/*     $_session["msg1"]="erreur!";
 */    header('location:pageadmin.php?msg1=erreur!');


}
}
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

<body>
<form action="" name="changepwd" method="POST"  class="row g-3"  onsubmit="return valid();">
<div class="col-md-6">
        <label for="inputAddress" class="form-label">Email (*)</label>
        <input type="text" autocomplete="off" class="form-control" id="email" placeholder="Email" name="email">
        <p id="erreuremail"></p>

      </div>
<div class="col-6">
        <label for="inputAddress2" class="form-label">ancien mot_de_passe* </label>
        <input type="password" class="form-control" name="opwd" id="opwd" placeholder="mot_de_passe">
        <p id="erreurpwd1"></p>

      </div>
        <label for="inputAddress2" class="form-label">nouveau mot_de_passe*</label>
        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="mot_de_passe">
        <p id="erreurpwd"></p>
      </div>
      <div class="col-6">
        <label for="inputAddress2" class="form-label">confirme mot_de_passe* </label>
        <input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="mot_de_passe">
        <p id="erreurpwd1"></p>
        <div class="col-6">
        <input type="submit" id="submit" name="submit" value="change password"  class="btn btn-primary" style="background-color:#05006B">
</div>

      </div>



</form>
</body>
</html>

