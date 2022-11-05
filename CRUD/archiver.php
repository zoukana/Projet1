

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>

    <title>liste  archivés</title>
</head>
<header>
<button type="button" class="btn btn-primary"><a href="../pages/pageadmin.php" style="color:white">Retour</a></button>

</header>
<body  style="background-color:#F5F5F5;">

<div id="header" style="background-color:#F5F5F5; height:100px;">
 
<div class="text-center">
    <h2>Liste des archivés</h2>
  </div>
  <div style="color:yellow; height:30px; "><?= $_GET['restaurer'] ?? null ?></div>

    <table  class="table w-75 container h-100" style="background-color:#FFFFFF">
  <thead>
    <tr style="background-color:#05006B"> 
      <th scope="col" style="color:#ffffff">Matricule</th>
      <th scope="col" style="color:#ffffff">Nom</th>
      <th scope="col" style="color:#ffffff">Prenom</th>
      <th scope="col" style="color:#ffffff">email</th>
      <th scope="col" style="color:#ffffff">role</th>
      <th scope="col"style="color:#ffffff">date_d'archivage</th>
      <th scope="col" style="color:#ffffff">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include '../connexion/connect.php';
    $stmt=$bdd->prepare('SELECT * FROM user WHERE etat= 1 ');
    $stmt->execute();
    
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
   
      $id=$row['id'];
      $mat=$row['matricule'];
      $nom=$row['nom'];
      $prenom=$row['prenom'];
      $email=$row['email'];
      $etat=$row['etat'];
      $roles=$row['roles'];
      $date_archiver=$row['dateArchiver'];
      
        echo '<tr>
        <td>'.$mat.'</td>
        <td>'.$nom.'</td>
        <td>'.$prenom.'</td>
        <td>'.$email.'</td>
        <td>'.$roles.'</td>
        <td>'.$date_archiver.'</td>
        <td>

                <button type="button" class="btn btn-primary"><a href="../CRUD/restaurer.php?restaurerid='.$id.'" style="color:white;"><i class="bi bi-arrow-clockwise"></i></a></button>
    
        </td>
        </tr>';
  
    }
    
    ?>
  </tbody>
</table>


</body>
</html>