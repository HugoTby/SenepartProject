<?php

session_start();

include("class/User.php");
include("class/GPS.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <title>Page Principale</title>


</head>


<body id="body-pd">




    <?php
    //connexion a la bdd
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.65.252;dbname=Lawrence', 'root', 'root');

    //création de l'objet User
    $User = new User(null, null, null, null);

    //redirection vers connexion si on est pas connecté
    if (!$User->isConnect()) {
        header("Location: index.php");
    }
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
    <!--Container Main end-->

    <div id="map" style="height: 80vh; margin: 50px"></div>

<?php

    $GPS = new GPS(NULL,NULL,NULL,NULL,NULL,NULL,NULL);
    $data = $GPS->SelectAllInDatabase();

    //$GPS->AfficheInDatabase($data);

    $previousItem = null;  // Initialiser la variable pour stocker l'élément précédent
    $nextItem = null;  // Initialiser la variable pour stocker l'élément suivant
    $index = 0;
    $dataCount = count($data);

    foreach ($data as $item) 
    {
        $nextItem = ($index < $dataCount - 1) ? $data[$index + 1] : null;
            // Plage de dates
        $start_date = new DateTime('2023-01-01');
        $end_date = new DateTime('2023-12-31');

        // Créer un intervalle entre les deux dates
        $interval = $start_date->diff($end_date);

        // Nombre total de jours dans l'intervalle
        $total_days = $interval->days;

        // Générer une date aléatoire dans l'intervalle
        $random_day = rand(0, $total_days);
        
        // Cloner la date de début et ajouter le nombre de jours aléatoire
        $random_date = clone $start_date;
        $random_date->add(new DateInterval('P' . $random_day . 'D'));

        // Formater la date au format YYYY-MM-DD
        $formatted_date = $random_date->format('Y-m-d');

    


                // Générer une heure aléatoire au format HH:MM:SS TOUT EST BON LA DEDANS
        $random_hour = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT); // Deux chiffres, ajout de zéros à gauche si nécessaire
        
        $random_minute = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
        
        $random_second = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
        
        // Concaténer pour obtenir l'heure complète
        $random_time = $random_hour . ':' . $random_minute . ':' . $random_second;

        

        //$item['IdBateau'] = floatval($item['IdBateau']);
        //$item['latitude'] = floatval($item['latitude']);
        //$item['longitude'] = floatval($item['longitude']);
        $item['date'] = $formatted_date;
        $GPS->SetDateInDatabase($item['IdBateau'],$item['date']);
        $item['heure'] = $random_time;
        $GPS->SetHeureInDatabase($item['IdBateau'],$item['heure']);
        
        // Vérifier si l'ID du bateau est supérieur à 0
        if ($index > 0) 
        {
            
            // Vérifier si l'élément précédent est disponible
            if ($previousItem !== null) 
            {
                // Utiliser les valeurs de l'élément actuel et de l'élément précédent pour calculer la vitesse
                $speed = $GPS->calculateSpeed($previousItem['IdBateau'], $previousItem['vitesse'], $previousItem['heure'], $item['IdBateau'], $item['vitesse'], $item['heure']);
                $speed = abs($speed);
                $GPS->SetSpeedInDatabase($item['IdBateau'], $speed);
            }
            else if ($nextItem !== null) 
            {
                // Utiliser les valeurs de l'élément actuel et de l'élément précédent pour calculer la vitesse
                $speed = $GPS->calculateSpeed($nextItem['IdBateau'], $nextItem['vitesse'], $nextItem['heure'], $item['IdBateau'], $item['vitesse'], $item['heure']);
                $speed = abs($speed);
                //echo gettype($speed);
                $GPS->SetSpeedInDatabase($item['IdBateau'], $speed);
            } 
            else 
            {
                // Gérer le cas où l'élément actuel est le premier élément du tableau
                echo "Erreur : L'emplacement précédent pour le bateau avec l'ID {$item['IdBateau']} n'est pas disponible.";
            }
        }
        //echo "vitesse ",$item['vitesse']," fin ";
        $item['vitesseMoyenne'] = $GPS->calculateAverageSpeed($item['IdBateau']);
        //echo " ",$item['vitesseMoyenne']," \n\n";
        $GPS->SetAverageSpeedInDatabase($item['IdBateau'], $item['vitesseMoyenne']);

        // Mettre à jour l'élément précédent pour l'itération suivante
        $previousItem = $item;
        $index++;
    }


    $GPS2 = new GPS(NULL,NULL,NULL,NULL,NULL,NULL,NULL);
    $data2 = $GPS2->SelectInDatabase();
    //$GPS2->AfficheInDatabase($data2);
?>

<script>
    /* 
    function toRadians(degrees)
    {
        return degrees * (Math.PI / 180);
    }

    function calculateSpeed(lat1, lon1, time1, lat2, lon2, time2) 
    {
        // Convertir les coordonnées en radians
        const radLat1 = toRadians(lat1);
        const radLon1 = toRadians(lon1);
        const radLat2 = toRadians(lat2);
        const radLon2 = toRadians(lon2);

        // Calculer la distance entre les deux points en kilomètres
        const distance = calculateDistance(radLat1, radLon1, radLat2, radLon2);

        // Convertir le temps en secondes
        const timeDiff = (new Date(time2) - new Date(time1)) / 1000;

        // Calculer la vitesse en kilomètres par heure
        const speed = distance / timeDiff * 3600;

        return speed;
    }

    function calculateDistance(radLat1, radLon1, radLat2, radLon2) 
    {
        const earthRadius = 6371; // Rayon de la Terre en kilomètres

        // Formule de la distance entre deux points sur la surface d'une sphère
        const dLat = radLat2 - radLat1;
        const dLon = radLon2 - radLon1;
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(radLat1) * Math.cos(radLat2) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = earthRadius * c;

        return distance;
    }

    function calculateAverageSpeed(data, currentIndex) 
    {
        const lastIndex = currentIndex - 1;
        const startIndex = Math.max(0, lastIndex - 9);

        let sumSpeeds = 0;
        let count = 0;

        for (let i = lastIndex; i >= startIndex; i--) {
            if (i > 0) {
                sumSpeeds += data[i].vitesse;
                count++;
            }
        }

        return count > 0 ? sumSpeeds / count : 0;
    }

    */
   
    var map = L.map('map').setView([49.8951, 2.3022], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
   
    // BIEN QUE LES COORDONEES SUR LA MAP SEMBLENT INCORECTES DE PAR LEUR AFFICHAGE, ILS SONT CORRECTES.

    var data = <?php echo json_encode($data2); ?>;
    var line;

    data.forEach(function (item, index) {
        // Vérifiez si les coordonnées sont des nombres valides
        /*
        if (index > 0) 
        {
            var prevItem = data[index - 1];

            if (prevItem && prevItem.latitude !== undefined && prevItem.longitude !== undefined && prevItem.date !== undefined) {
                var speed = calculateSpeed(prevItem.latitude, prevItem.longitude, prevItem.date, item.latitude, item.longitude, item.date);
                // Faites quelque chose avec la vitesse...
            } else {
                console.error("Données manquantes pour calculer la vitesse.");
            }
        }

        item.vitesse = speed;

        var averageSpeed = calculateAverageSpeed(data, index);
        item.vitesseMoyenne = averageSpeed;
        
        */
        
        if (typeof item.latitude === 'string' && typeof item.longitude === 'string') {
            // Créez un marqueur pour chaque point
            var marker = L.marker([item.latitude, item.longitude])
                .addTo(map)
                .bindPopup(
                    "Id: " + item.IdBateau +
                    "<br>Date: " + item.date +
                    "<br>Heure: " + item.heure +
                    "<br>Latitude: " + item.latitude +
                    "<br>Longitude: " + item.longitude +
                    "<br>Vitesse: " + item.vitesse +
                    "<br>Vitesse Moyenne: " + item.vitesseMoyenne
                );

            // Si ce n'est pas le premier point, tracez une ligne entre le point précédent et celui-ci
            if (index > 0) {
                var prevItem = data[index - 1];
                var polylinePoints = [
                    [prevItem.latitude, prevItem.longitude],
                    [item.latitude, item.longitude]
                ];
                var polyline = L.polyline(polylinePoints, {color: 'blue'}).addTo(map);
            }

            // Si c'est le dernier point, changez la couleur du marqueur
            if (index === 0/*data.length - 1*/) {
                marker.setIcon(L.divIcon({className: 'last-marker', html: '<div>' + item.id + '</div>'}));
            }
        } else {
            console.error("Coordonnées invalides : ", item);
        }
    });
</script>

<style>
    /* Ajoutez une règle de style pour le dernier marqueur */
    .last-marker {
        background-color: red;
        color: white;
        border-radius: 50%;
        text-align: center;
        padding: 5px;
        font-weight: bold;
    }
</style>

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