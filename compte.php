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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Compte</title>


</head>

<body id="body-pd">




    <?php
    //connexion a la bdd
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.65.252;dbname=Lawrence', 'root', 'root');

    //création de l'objet User
    $User = new User(null, null, null,  null);

    //redirection vers connexion si on est pas connecté
    if (!$User->isConnect()) {
        header("Location: index.php");
    }

    //on récupère le nom et mail du user afficher/modifier
    $sql = "SELECT * FROM user WHERE id = '" . $User->getId() . "'"; // Remplacez 'id' par la colonne appropriée utilisée pour identifier l'utilisateur
    $resultServ = $GLOBALS["pdo"]->query($sql);
    $userData = $resultServ->fetch();
    $nomUtilisateur = $userData['nom'];
    $emailUtilisateur = $userData['email'];


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

    <p class="mt-4" style="padding-top: 50px;margin: 20px;">Nom :

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