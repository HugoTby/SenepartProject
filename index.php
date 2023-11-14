<?php
////////////////////////////////////////////
//           Page de connexion            //
////////////////////////////////////////////

// Début de session et déclaration des fichiers requis au fonctionnement de l'application web
session_start();
include("class/User.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <?php

    //connexion a la bdd
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.65.252;dbname=Lawrence', 'root', 'root');

    //création de l'objet user
    $User = new User(null, null, null, null);
    $errorMessage = ""; // Variable pour stocker le message d'erreur
    echo $_SESSION['Connexion'];

    //on vérifie si le bouton connexion est cliqué
    //on connecté le User, si il y a une erreur on affiche mess d'erreur
    if (isset($_POST["envoi"])) {

        // Vérification du format d'email 
        /*    if (!filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Format d'email incorrect.";
    } else {
 */
        if ($User->seConnecter($_POST["login"], $_POST["password"])) {
            header("Location: mainPage.php");
        } else {
            $errorMessage = "Email ou mot de passe incorrect.";
        }
    }
    //}
    ?>

    <!-- Vous pouvez ensuite afficher $errorMessage où vous le souhaitez dans votre code HTML -->



    <!-- <div>
        <div>
            <label for="login">Nom d'utilisateur : </label>
            <input name="login" type="text">
        </div>
        <div>
            <label for="password">Mot de passe : </label>
            <input name="password" type="password">
        </div>
        <div>
            <input name="envoi" value="Connecter" type="submit">
        </div>

    </div> -->

    <form action="" method="post">

        <div class="limiter">
            <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
                <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                    <form class="login100-form validate-form">
                        <span class="login100-form-title p-b-49">
                            Login
                        </span>

                        <div class="wrap-input100 validate-input m-b-23" data-validate="Email requis">
                            <span class="label-input100">Email :</span>
                            <input class="input100" type="text" name="login" placeholder="Entrez votre email">
                            <span class="focus-input100" data-symbol="&#xf206;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Mot de passe requis">
                            <span class="label-input100">Mot de passe : </span>
                            <input class="input100" type="password" name="password" placeholder="Entrez votre mot de passe">
                            <span class="focus-input100" data-symbol="&#xf190;"></span>
                        </div>

                        <div class="text-right p-t-8 p-b-31">
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button name="envoi" type="submit" class="login100-form-btn">
                                    Connexion
                                </button>
                            </div>
                            <div class="container-login100-form-btn m-t-20">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <a href="inscription.php" class="login100-form-btn">
                                        Inscription
                                    </a>

                                </div>
                                <?php if (!empty($errorMessage)) : ?>
                                    <div class="error">
                                        <?php echo $errorMessage; ?>
                                    </div>
                                <?php endif; ?>
                            </div>


                        </div>
                </div>


    </form>
    </div>
    </div>
    </div>
    </form>




    <div id="dropDownSelect1"></div>


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>