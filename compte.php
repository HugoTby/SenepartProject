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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Compte</title>


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

    <p class="mt-4" style="margin: 20px;">Nom :

        <span id="nomUtilisateur" contenteditable="false"><?php echo $nomUtilisateur; ?></span>
        <i class="fa fa-pencil" id="modifierNom"></i>
    </p>


    <p class="mt-4" style="margin: 20px;">Mail :

        <span id="emailUtilisateur" contenteditable="false"><?php echo $emailUtilisateur; ?></span>
        <i class="fa fa-pencil" id="modifierEmail"></i>
    </p>

    <span style="margin:20px">
        <button type="button" class="btn btn-secondary" onclick="window.location.href = 'changePass.php'">Modifier le mot de passe</button>
    </span>





    <script>
        const nomUtilisateurSpan = document.getElementById('nomUtilisateur');
        const modifierNomIcon = document.getElementById('modifierNom');

        modifierNomIcon.addEventListener('click', () => {
            if (nomUtilisateurSpan.contentEditable === 'false') {
                // Activer l'édition
                nomUtilisateurSpan.contentEditable = 'true';
                nomUtilisateurSpan.focus();
                // Changer l'icône en icône de validation
                modifierNomIcon.classList.remove('fa-pencil');
                modifierNomIcon.classList.add('fa-check');
            } else {
                // Désactiver l'édition
                nomUtilisateurSpan.contentEditable = 'false';
                // Changer l'icône en icône de modification
                modifierNomIcon.classList.remove('fa-check');
                modifierNomIcon.classList.add('fa-pencil');

                // Récupérer le nouveau nom d'utilisateur
                const nouveauNom = nomUtilisateurSpan.textContent;


                // Envoyer une requête Fetch pour mettre à jour le nom d'utilisateur
                fetch('update_user.php', {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/x-www-form-urlencoded',
                        },
                        body: 'nouveauNom=' + encodeURIComponent(nouveauNom),
                    })
                    .then(response => {
                        if (response.status === 200) {
                            return response.text();
                        } else {
                            throw new Error('Erreur lors de la mise à jour du nom d\'utilisateur');
                        }
                    })
                    .then(data => {
                        // La mise à jour a été effectuée avec succès
                        console.log('Nom d\'utilisateur mis à jour : ' + nouveauNom);
                    })
                    .catch(error => {
                        console.error('Erreur : ' + error.message);
                    });

            }
        });

        // ... (Gestion de la sauvegarde lors de la perte de focus et de la touche Entrée)
    </script>

    <script>
        const emailUtilisateurSpan = document.getElementById('emailUtilisateur');
        const modifierEmailIcon = document.getElementById('modifierEmail');

        modifierEmailIcon.addEventListener('click', () => {
            if (emailUtilisateurSpan.contentEditable === 'false') {
                // Activer l'édition
                emailUtilisateurSpan.contentEditable = 'true';
                emailUtilisateurSpan.focus();
                // Changer l'icône en icône de validation
                modifierEmailIcon.classList.remove('fa-pencil');
                modifierEmailIcon.classList.add('fa-check');
            } else {
                // Désactiver l'édition
                emailUtilisateurSpan.contentEditable = 'false';
                // Changer l'icône en icône de modification
                modifierEmailIcon.classList.remove('fa-check');
                modifierEmailIcon.classList.add('fa-pencil');

                // Récupérer le nouveau nom d'utilisateur
                const nouveauEmail = emailUtilisateurSpan.textContent;


                // Envoyer une requête Fetch pour mettre à jour le nom d'utilisateur
                fetch('update_user.php', {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/x-www-form-urlencoded',
                        },
                        body: 'nouveauEmail=' + encodeURIComponent(nouveauEmail),
                    })
                    .then(response => {
                        if (response.status === 200) {
                            return response.text();
                        } else {
                            throw new Error('Erreur lors de la mise à jour du nom d\'utilisateur');
                        }
                    })
                    .then(data => {
                        // La mise à jour a été effectuée avec succès
                        console.log('Nom d\'utilisateur mis à jour : ' + nouveauEmail);
                    })
                    .catch(error => {
                        console.error('Erreur : ' + error.message);
                    });

            }
        });
    </script>





</body>

</html>