
<?php
include('../connexion/connect.php');
session_start();
include('../connexion/connect.php');

$req=$bdd->prepare("SELECT * FROM user where matricule=?" );
   $req->execute(array($_SESSION['matricule']));
   $data=$req->fetch();


   $res=$bdd->prepare("SELECT photo FROM images WHERE user=?" );
   $res->execute([$_SESSION['id']]);
   $photo=$res->fetch();  
    // var_dump($photo);die;
 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="laReussite.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Page employes</title>
</head>

<body  style="background-color:#F5F5F5; ">
<header>
    <div id="header" style="background-color:#F5F5F5; height:100px;" >  
        <div class="col-md-6">
          <label for="inputState" class="form-label"><img style="width:100px; height:100px; border-radius:50px;/1500px;" src="data:image/png; charset=utf8;base64,<?php echo base64_encode($photo['photo']) ?>" alt="" srcset="">
          <h6><?php echo $data['matricule']; ?> </h6>
          <button class="btn  btn-secondary my-1" ><a href="../pages/paramétrage.php" class="text-light"><i class="bi bi-gear"></i></a></button>
        </div>
        <div class="moi">
          <h4 class="ass"><?php echo $data['prenom']; ?> <?php echo $data['nom']; ?></h4>
          <p class="role"> <?php echo $data['roles']; ?> </p>
        <!--   <button class="btn btn-outline-danger my-1 role"><a href="../connexion/connexion.php?deleteid='.$id.'">
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
        </div>

            <div>
           
            </div>
      </div>
  </header>

</div>
<br>
<br>
<br>
<div class="container" style="display:flex; justify-content: space-between; ">
<nav class="navbar bg-light">
  <div class="container-fluid">

  <form action="" method="post" class="d-flex" role="search" >
    <input type="text" name="classe" placeholder="search" class="form-control me-2"  aria-label="Search">
    <input type="submit" name="verif" value="SEARCH" class="btn btn-outline-primary">
</form>

  </div>
  
</nav>
        <a href="../CRUD/archiver.php" >Liste des employes archiver?</a>
    </div>
    <table class="table w-75 container h-100" style="background-color:#FFFFFF">
  <thead style="background-color:#05006B">
    <tr style="color:white"> 
      <th scope="col">Matricule</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">roles</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $stmt=$bdd->prepare("SELECT * FROM user where etat=0 ");
    $stmt->execute();
    if(isset($_POST["verif"])){
      if(isset($_POST["classe"])){
          $prenom = $_POST["classe"];
          if(!empty($prenom)){                   
  include("../connexion/connect.php");
  $list = "SELECT * FROM user WHERE  roles='user' and prenom LIKE '%$prenom%' or nom LIKE '%$prenom%' ";
  $stmt = $bdd->query($list);}}}
    
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
      $nom=$row['nom'];
      $prenom=$row['prenom'];
      $email=$row['email'];
      $matricule=$row['matricule'];
      $roles=$row['roles'];
      $date_ins=$row['date inscription'];
      $id=$row['id'];


      if($roles=='user'){

        echo '<tr>
        <th >' . $matricule . '</th>
        <td>' . $nom . '</td>
        <td>' . $prenom . '</td>
        <td>' . $roles . '</td>
        <td>' . $email . '</td>
      
      </tr>';
      }
       
            }
      
            ?>
      
          </tbody>
        </table>
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
      </body>
      
      <div id="footer" style=" height:30px; display:flex; justify-content:center;">
        <button><i class="bi bi-arrow-left"></i></button>
        <button><i class="bi bi-arrow-right"></i></button>
      
      </div>

  </tbody>
</table>


</body>
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

</style>
</html>