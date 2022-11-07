<?php 
error_reporting(E_ALL);
    session_start(); // Démarrage de la session
    require_once '../connexion/connect.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['pwd'])) // Si il existe les champs email, password et qu'il sont pas vident
    {

        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['pwd']);
        
        $email = strtolower($email); // email transformé en minuscule
        // On regarde si l'utilisateur est inscrit dans la table personnes
        
        $check = $bdd->prepare('SELECT id,matricule,nom,prenom,email, passwords, roles, etat FROM user WHERE email =:email');
        
        $check->bindParam(":email", $email);//bimparam permet d'eliminer les espaces
        $check->execute();
       $row = $check->rowCount();
      
        
        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            $data = $check->fetch();
          
          
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
              if(password_verify($password, $data["passwords"]))
              
 {
                    // On créer des session et on redirige 

                    $_SESSION['matricule'] = $data['matricule'];
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['prenom'] = $data['prenom'];
                    $_SESSION['nom'] = $data['nom'];
                    $_SESSION['email'] = $data['email'];

             
                    // $_SESSION['matricule'] = $res['matricule'];
                
                    if($data['roles'] =='admin' && $data['etat'] == 0){
                        header('Location:../pages/pageadmin.php');
                        die();
                    }elseif($data['roles'] =='user' && $data['etat'] == 0){
                        header('Location: ../pages/pageusersimple.php');
                        die();
                    }
                  
                 }else{ header('Location: ../connexion/connexion.php?login_err=passwords'); die(); }
            }else{ header('Location: ../connexion/connexion.php?login_err=email'); die(); }
        }else{ header('Location:  ../connexion/connexion.php?login_err=already'); die(); }
    }else{ header('Location:  ../connexion/connexion.php'); die();} // si le formulaire est envoyé sans aucune données


    ?>


