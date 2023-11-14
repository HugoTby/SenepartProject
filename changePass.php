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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <title>Changer Infos</title>


</head>

<body id="body-pd">


    <?php
    //connexion a la bdd
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.65.252;dbname=Lawrence', 'root', 'root');

    //creation de l'objet user
    $User = new User(null, null, null,  null);

    //redirection vers connexion si on est pas connecté
    if (!$User->isConnect()) {
        header("Location: index.php");
    }

    //on récupère le password du user
    $sql = "SELECT * FROM user WHERE id = '" . $User->getId() . "'"; // Remplacez 'id' par la colonne appropriée utilisée pour identifier l'utilisateur
    $resultServ = $GLOBALS["pdo"]->query($sql);
    $userData = $resultServ->fetch();
    $password = $userData['password'];







    ?>
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="mainPage.php" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Appli GPS</span> </a>
                <div class="nav_list">
                    <a href="mainPage.php" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Home</span>
                    </a>
                    <a href="compte.php" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Compte</span>
                    </a>
                </div>
                <?php
                if ($User->isAdmin()) {
                    echo '<a href="panelAdmin.php" class="nav_link">
        <i class="bx bx-cog nav_icon"></i>
        <span class="nav_name">Panel Admin</span>
    </a>';
                }
                ?>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <div style="padding-top: 150px" class="container">
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
        //on vérifie si le bouton envoie est cliqué
        //on vérifie si les 2 nouveaux pass correspondent
        //on vérifie que l'anvien pass correspond avec celui en bdd
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
                if ($oldPassword == $password) {
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

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>

    <script>
        // JavaScript
        document.addEventListener("DOMContentLoaded", function(event) {
            const navBar = document.getElementById('nav-bar');
            const headerToggle = document.getElementById('header-toggle');
            let menuOpen = false;

            // Gérez l'événement de survol de la souris
            navBar.addEventListener('mouseenter', function() {
                // Vérifiez si le menu est actuellement replié
                if (!menuOpen) {
                    // Activez le basculement du menu en cliquant sur l'icône de bascule
                    headerToggle.click();
                    // Marquez le menu comme déplié
                    menuOpen = true;
                }
            });

            // Gérez l'événement de quitter la zone du menu
            navBar.addEventListener('mouseleave', function() {
                // Vérifiez si le menu est actuellement déplié
                if (menuOpen) {
                    // Activez à nouveau le basculement du menu en cliquant sur l'icône de bascule
                    headerToggle.click();
                    // Marquez le menu comme replié
                    menuOpen = false;
                }
            });

            // Gérez l'événement du clic sur l'icône de bascule
            headerToggle.addEventListener('click', function() {
                // Inversez l'état du menu (déplié ou replié)
                menuOpen = !menuOpen;
            });
        });
    </script>




</body>

</html>