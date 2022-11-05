<?php
include('../connexion/connect.php');
session_start();
include('../connexion/connect.php');

$req = $bdd->prepare("SELECT * FROM user where matricule=?");
$req->execute(array($_SESSION['matricule']));
$data = $req->fetch();


$res = $bdd->prepare("SELECT photo FROM images WHERE user=?");
$res->execute([$_SESSION['id']]);
$photo = $res->fetch();
// var_dump($photo);die;

?>

<!DOCTYPE html>
<html lang="fr">

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
  <!-- JavaScript Bundle with Popper -->

  <title>Page Admin</title>
</head>


  <header>
    <div id="header" style="background-color:#F5F5F5; height:100px;" >  
        <div class="col-md-6">
          <label for="inputState" class="form-label"><img style="width:100px; height:100px; border-radius:50px;/1500px;" src="data:image/png; charset=utf8;base64,<?php echo base64_encode($photo['photo']) ?>" alt="" srcset="">
          <h6><?php echo $data['matricule']; ?> </h6>
          <button class="btn  btn-secondary my-1" ><a href="../pages/paramétrage.php" class="text-light"><i class="bi bi-gear"> Paramétres</i></a></button>
        </div>
        <div class="moi">
          <h4 class="ass"><?php echo $data['prenom']; ?> <?php echo $data['nom']; ?></h4>
          <p class="role"> <?php echo $data['roles']; ?> </p>
         <!--  <button class="btn btn-outline-danger my-1 role"><a href="../connexion/connexion.php?deleteid='.$id.'">
                <i class="bi bi-arrow-bar-left"></i></a>
              </button>  -->
     <div style="margin-left: 80px;">                 
 <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            <i class="bi bi-arrow-bar-left"></i>
        </button>
        
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Archiver</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p> Voulez vous vraiment vous déconnecté?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><a href="../connexion/connexion.php" style="color:white;">Oui</a></button>
                <button type="button" class="btn btn-danger"><a href="pageadmin.php" style="color:white;">Non</a></button>
              </div>
            </div>
          </div>
        </div>  


            <div>
           
            </div>
      </div>
  </header>


  <body style="background-color:#F5F5F5; ">
  <br>
  <br>
  <div id="message">
  <div style="color:green; height:30px; background-color:#F5F5F5;"><?= $_GET['msg'] ?? null ?></div>
  <div style="color:green; height:30px; background-color:#F5F5F5;"><?= $_GET['msg1'] ?? null ?></div>
    <div style="color:green; height:30px; background-color:#F5F5F5;"><?= $_GET['modif'] ?? null ?></div>
    <div style="color:blue; height:30px; background-color:#F5F5F5;"><?= $_GET['delete'] ?? null ?></div>
    <div style="color:black; height:30px; background-color:#F5F5F5;"><?= $_GET['restaurer'] ?? null ?></div>
    </div>

  <br>
  <br>
  <br>
  <div class="container" style="display:flex; justify-content: space-between; ">
    <nav class="navbar">
      <div class="container-fluid">

      <form action="" method="post" class="d-flex" role="search" >
    <input type="text" name="classe" placeholder="search" class="form-control me-2"  aria-label="Search">
    <input type="submit" name="verif" value="SEARCH" class="btn btn-outline-primary">
</form>

</div>

<div><a href=" ../CRUD/archiver.php" style="margin-left:800px;">Liste des archivés?</a></div>  

    </nav>
 
    
  </div>

  <table class="table w-75 container h-100" style="background-color:#FFFFFF">
    <thead style="background-color:#05006B">
      <tr style="color:white">
        <th scope="col">Matricule</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">roles</th>
        <th scope="col">Email</th>
        <th scope="col">Actions</th>
        <!--      <th scope="col">Date Inscription</th>
       <th scope="col">Date Modif</th> -->

      </tr>
    </thead>
    <tbody>
      <?php

    
    include("../connexion/connect.php");
if(isset($_GET['page']) && !empty($_GET['page'])){
  $pageactuelle=(int) strip_tags($_GET['page']);
}else{
  $pageactuelle=1;
}
$list=$bdd->prepare("SELECT count(*) AS nbre_user FROM user WHERE etat=0");
$list->execute();
$resultat=$list->fetch();
$nbresuser=(int)$resultat['nbre_user'];
$mapage=5;
$pages=ceil($nbresuser/$mapage);
$first=($pageactuelle*$mapage)-$mapage;
$id=$data['id'];
   $list=$bdd->prepare("SELECT * FROM user WHERE etat=0  AND id!=$id ORDER BY id desc LIMIT $first,$mapage");
   $list->execute();

/*    $list = $bdd->prepare("SELECT * FROM user");
   $list->execute();  */
   if(isset($_POST["verif"])){
     if(isset($_POST["classe"])){
         $prenom = $_POST["classe"];
         if(!empty($prenom)){                   
 include("../connexion/connect.php");
 $id=$data['id'];
 $list = "SELECT * FROM user WHERE id!=$id AND prenom LIKE '%$prenom%' or nom LIKE '%$prenom%'  ";
 $list= $bdd->query($list);}}} 

      while ($row = $list->fetch(PDO::FETCH_ASSOC)) {
        // var_dump($row);
        // exit;
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $matricule = $row['matricule'];
        $roles = $row['roles'];
        $date_ins = $row['date inscription'];
        $date_modif = $row['date_modif'];
        $id = $row['id'];
        $etat=$row['etat'];
if($etat==0){

  echo '<tr>
  <th >' . $matricule . '</th>
  <td>' . $nom . '</td>
  <td>' . $prenom . '</td>
  <td>' . $roles . '</td>
  <td>' . $email . '</td>

  <td>
  <button class="btn btn-outline-primary my-1" "><a href="../CRUD/update.php?updateid=' . $id . '" ><i class="bi bi-pencil-fill"></i></a></button>
  <button type="button" class="btn btn-danger my-1" onclick = "return confirm(\'voulez vous vraiment archiver\')"><a href="../CRUD/delete.php?deleteid=' . $id . '" style="color:white;"><i class="bi bi-archive"></i></a></button>


  <button class="btn  btn-secondary my-1" ><a href="../CRUD/switch.php?switchid=' . $id . '" class="text-light"><i class="bi bi-arrow-down-up"></i></a></button>

  </td>

</tr>';
}
      }
      ?>

    </tbody>
  </table>

  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?=($pageactuelle==1)? "disabled" : "" ?>">
      <a class="page-link" href="?page=<?= $pageactuelle - 1?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php
    for($page=1; $page <= $pages; $page++) : ?>
    <li class="page-item <?=($pageactuelle==$page)? "active" : "" ?> ">
      <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
    </li>
    <?php endfor ?>
    <li class="page-item  <?=($pageactuelle==$pages)? "disabled" : "" ?> ">
      <a class="page-link" href="?page=<?=$pageactuelle+1?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>



</div>

</html>
<style>
  #header{
    display: flex;
    flex-wrap: wrap;
  }
  .moi{
margin-left: 450px;
  }
  .role{
    margin-left: 70px;
  }
  .ass{
    font-size: 30px;
  }
  #message{
  display: flex;
  justify-content: center;
  }

</style>