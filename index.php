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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>

    <?php
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.64.213;dbname=Lawrence', 'root', 'root');
    $User = new User(null, null, null);

    if (isset($_POST["envoi"])) {
        $User->seConnecter($_POST["login"], $_POST["password"]);
        if ($User->seConnecter($_POST["login"], $_POST["password"])) {


            echo "bien joué beau gosse";
        } else {
            echo "gay";
        }
    }

    ?>
    <div>
        <form action="" method="post">
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
        </form>

    </div>
</body>

</html>