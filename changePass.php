<?php

session_start();

include("class/User.php");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Changer mot de passe</title>


</head>

<body>



    <?php
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.64.213;dbname=Lawrence', 'root', 'root');
    $User = new User(null, null, null);

    if (!$User->isConnect()) {
        header("Location: index.php");
    }

    $sql = "SELECT * FROM user WHERE id = '" . $User->getId() . "'"; // Remplacez 'id' par la colonne appropriée utilisée pour identifier l'utilisateur
    $resultServ = $GLOBALS["pdo"]->query($sql);
    $userData = $resultServ->fetch();
    $nomUtilisateur = $userData['nom'];
    $emailUtilisateur = $userData['email'];
    $passUtilisateur = $userData['password'];



    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-info p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DBook Inc</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-2 active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Company
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Blog</a></li>
                            <li><a class="dropdown-item" href="#">About Us</a></li>
                            <li><a class="dropdown-item" href="#">Contact us</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-none d-lg-inline-flex">
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-google-plus-square"></i></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark h5" href="" target="blank"><i class="fab fa-facebook-square"></i></a>
                    </li>
                </ul>


                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="compte.php">Compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="logout.php">Déconnexion</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <div class="container">
        <h2>Changer le mot de passe</h2>
        <form method="POST">
            <div class="form-group">
                <label for="old_password">Ancien mot de passe :</label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le nouveau mot de passe :</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="envoi" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    

    <?php
    if (isset($_POST["envoi"])) {
        // Récupérer les valeurs du formulaire
        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        // Vérifier si le nouveau mot de passe et la confirmation sont identiques
        if ($newPassword !== $confirmPassword) {
            // echo "<br><span style='display: block; text-align: center; background-color: #ff0000; color: #ffffff; padding: 5px;width: 300px;border-radius:5px;margin-left:50%;'>Les mots de passe ne correspondent pas.</span>";
            echo "       
            <div style='width:520px;margin-top:10px;' class='alert alert-dismissible alert-danger'> 
                <strong>Oh non!</strong> Les mots de passe ne correspondent pas.
            </div>  
            ";
        } else {
            // Vérifier si l'ancien mot de passe est correct
            if ($oldPassword == $passUtilisateur) {
                // Mettre à jour le mot de passe dans la base de données
                $User->setPassword($newPassword); // Vous devrez implémenter cette méthode dans votre classe User
                // echo "<br><span style='display: block; text-align: center; background-color: #ff0000; color: #ffffff; padding: 5px;width: 300px;border-radius:5px;margin-left:50%;'>Le mot de passe a été changé avec succès.</span>";
                echo "
                <div style='width:520px;margin-top:10px;' class='alert alert-dismissible alert-success'>
                    <strong>C'est fait!</strong> Le mot de passe a été changé avec succès.</a>.
                </div>
                ";
            } else {
                //echo "<br><span style='display: block; text-align: center; background-color: #0cff00; color: #ffffff; padding: 5px;width: 300px;border-radius:5px;margin-left:50%;'>L'ancien mot de passe est incorrect.</span>";
                echo "       
                <div style='width:520px;margin-top:10px;' class='alert alert-dismissible alert-danger'> 
                    <strong>Oh non!</strong> L'ancien mot de passe est incorrect.
                </div>  
                ";
            }
        }
    }
    ?>
</div>

</body>

</html>