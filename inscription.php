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
    <title>Inscription</title>
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
$GLOBALS["pdo"] = new PDO('mysql:host=192.168.65.252;dbname=Lawrence', 'root', 'root');

$User = new User(null, null, null, null);
$errorMsg = '';

if (isset($_POST["envoi"])) {
    $email = $_POST["login"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $nom = $_POST["nom"];

    // Vérification de la validité de l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Adresse e-mail invalide!";
    } 
    // Vérification si les deux mots de passe sont identiques
    elseif ($password !== $confirmPassword) {
        $errorMsg = "Les mots de passe ne correspondent pas!";
    }
    // Vérification si l'email est déjà inscrit
    else {
        $stmt = $GLOBALS["pdo"]->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errorMsg = "Adresse e-mail déjà utilisée!";
        }
        else {
            $User->CreateNewUser($email, $password, $nom);
        }
    }
    
    if ($User->isConnect()) {
        header("Location: mainPage.php");
    }
}

?>

    <form action="" method="post">

        <div class="limiter">
            <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
                <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                    <form class="login100-form validate-form">
                        <span class="login100-form-title p-b-49">
                            Inscription
                        </span>

                        <div class="wrap-input100 validate-input m-b-23" data-validate="Email requis">
    <span class="label-input100">Saisissez votre email :</span>
    <input class="input100" type="text" name="login" placeholder="Entrez votre email" value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>">
    <span class="focus-input100" data-symbol="&#xf206;"></span>
</div>
<div class="wrap-input100 validate-input m-b-23" data-validate="Nom requis">
    <span class="label-input100">Saisissez votre nom :</span>
    <input class="input100" type="text" name="nom" placeholder="Entrez votre nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
    <span class="focus-input100" data-symbol="&#xf206;"></span>
</div>

<div class="wrap-input100 validate-input" data-validate="Mot de passe requis">
    <span class="label-input100">Créez votre mot de passe : </span>
    <input class="input100" type="password" name="password" placeholder="Entrez votre mot de passe">
    <span class="focus-input100" data-symbol="&#xf190;"></span>
</div>

<div class="wrap-input100 validate-input" data-validate="Mot de passe requis">
    <span class="label-input100">Confirmer votre mot de passe : </span>
    <input class="input100" type="password" name="confirmPassword" placeholder="Entrez votre mot de passe">
    <span class="focus-input100" data-symbol="&#xf190;"></span>
</div>


                        <div class="text-right p-t-8 p-b-31">
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button name="envoi" type="submit" class="login100-form-btn">
                                    S'inscrire
                                </button></div>
                                <div class="container-login100-form-btn m-t-20">
    <div class="wrap-login100-form-btn">
        <div class="login100-form-bgbtn"></div>
        <a href="index.php" class="login100-form-btn">
            Déjà Inscrit ? Connectez-vous !
        </a>
        
    </div>
         
        
    </div>
                        </div>


                    </form>
                    <?php
// Afficher les erreurs
if($errorMsg) {
    echo "<p style='color:red;'>$errorMsg</p>";
}
?>

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