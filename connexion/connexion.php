<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="laReussite.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/431fa92df2.js" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>
<body>
 
    <div class="login-form">
        <?php 
            if(isset($_GET['login_err']))
            {
                $err = htmlspecialchars($_GET['login_err']);

                switch($err)
                {
                    case 'passwords':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong>  email ou mot de passe incorrect
                            </div>
                        <?php
                    break;
                    case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                    break;
               
                     case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                    break; 

                    case 'mdr':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte archivé
                            </div>
                        <?php
                    break;
                    
                }
            }
        ?> 
            
        <form action="../connexion/traitementConnexion.php" method="post" style=" background-color:#F5F5F5" id="loginform">
            <h2 class="text-center">Connexion</h2>       
            <div class="form-group">
                <label for="email">Adresse mail</label><br>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email"  autocomplete="on">  
                <p id="errormail"></p>
            </div>
            <div class="form-group">
                <label for="passwords">Mot de passe</label><br>
                <input type="password" name="pwd" class="form-control" id="pwd"  placeholder="Mot de passe" required="required" autocomplete="off">
                <p id="errorpwd"></p>
            </div>
            <div class="form-group col-6" >
                    <button type="submit" class="btn btn-primary btn-block" style=" background-color:#05006B" id="submit" name="submit">Connexion</button>
                </div>  
                <div class="form-group ">
                    <a href="../pages/formulaire.php">inscription?</a>
                </div> 
        </form>
      
    </div>
        
<script src="../connexion/connect.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     