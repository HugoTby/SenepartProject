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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Page Principale</title>


</head>

<body>



    <?php
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.64.213;dbname=Lawrence', 'root', 'root');
    $User = new User(null, null, null);

    if (!$User->isConnect()) {
        header("Location: index.php");
    }

    $sql = "SELECT nom FROM user WHERE id = '" . $User->getId() . "'"; // Remplacez 'id' par la colonne appropriée utilisée pour identifier l'utilisateur
    $resultServ = $GLOBALS["pdo"]->query($sql);
    $userData = $resultServ->fetch();

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

    <p class="mt-4" style="margin: 20px;">Nom : <?php echo "nom"; ?></p>


    <!-- Adding the Proviflix button -->

</body>

</html>