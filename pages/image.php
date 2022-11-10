<?php
session_start();
include '../connexion/connect.php';
if (isset($_POST['submit'])){
/*   var_dump($_FILES);die;
 */  
//ici on verifie si la session de l'utilisateur qui s'est connecté existe
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $role = $_SESSION['roles'];
  }
  //ici on verifie si le champ de l'image est vide ou pas 
  if(!empty($_FILES["image"]["name"])) { 
    // Get file info 
    $fileName = basename($_FILES["image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 

        // Insert image content into database 
        // $db = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
        $getImage = $bdd->query("SELECT photo FROM images WHERE user=$id"); 
        if ($getImage) {
            $bdd->query("DELETE FROM images WHERE user=$id");
        }
        $insert = $bdd->query("INSERT into images (photo,user) VALUES ('$imgContent',$id)"); 


        if($insert){ 
          // var_dump($role);die;
          $role == "admin" ? header('location:pageadmin.php? mes=image inserer avec succes!'):  header('location:pageusersimple.php? mes=image inserer avec succes!');
/*         header('location:pageadmin.php? mes=image inserer avec succes!');
 */
          // }elseif($_session['roles']==='user'){
          //   header('location:pageusersimple.php? mes=image inserer avec succes!');
          //  } 
        }
            $status = 'success'; 

            $statusMsg = "File uploaded successfully."; 
            // header('location:editProfile.php');
        }else{ 
            $statusMsg = "File upload failed, please try again."; 
        }
    }else{ 
        $statusMsg = 'Désolé, seule les fichiers JPG, JPEG, PNG, & GIF sont autorisés.'; 
    } 
}else{ 
    $statusMsg = 'Veuillez selectionner une image'; 
}
  // }

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
  <title>Formulaire</title>

</head>
<header>
<button type="button" class="btn btn-primary"><a href="../pages/paramétrage.php" style="color:white">Retour</a></button>

</header>

<body>

  <div class="container my-5">

    <!-- <form action="paramétrage.php" method="post" class="row g-3" style="background-color:#D9D9D9" id="loginform">

      <div class="col-auto">
        <input type="file" class="form-control" id="photo" name="image" placeholder="PHOTO" required>
      </div>
      <div class="col-6">
        <input type="submit" id="submit" name="submit" class="btn btn-primary" style="background-color:#05006B">
      </div>
      <script src=""></script>
    </form> -->
    <form action=""  novalidate  method="post" enctype="multipart/form-data">



                <input type="file"  id="inputGroupFile02" class="form-control w-50 m-3" name="image" required>
                    <br>
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Choisir une photo</div>
                    &nbsp;
                <button type="submit" id="photo" name="submit" class="btn btn-outline-primary col-md-1.5" title="changer">envoyer</button>
               
            </form>



</body>

</html>