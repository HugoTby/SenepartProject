#Le Projet Senepart
Le projet Senepart est une collaboration entre Faustin, Hugo et Mathias visant à offrir une expérience utilisateur optimale dans le domaine de la géolocalisation.

1. Adresses IP des Machines Virtuelles
Voici les adresses IP des machines virtuelles dédiées à différentes parties du projet :

Site Web : 192.168.64.84
Base de Données : 192.168.64.213
2. Base de Données : Lawrence
Pour accéder à la base de données, utilisez les informations suivantes :

Identifiant : root
Mot de passe : root
La structure de la base de données est présentée ci-dessous :

Lawrence
│
└── user  
    ├── idUser : int (clé primaire)
    ├── nom : varchar(30)
    ├── email : varchar(300)
    ├── password : varchar(30)
    └── isAdmin : tinyint(1)
3. Structure du Code
Découvrez ci-dessous l'organisation des fichiers et répertoires :

./addons

readme.md : Documentation du code.
lawrence.sql : Export de la base de données pour importation dans PhpMyAdmin.
./bootstrap

Contient les fichiers relatifs à Bootstrap.
./css

bootstrap.css : Styles pour les templates Bootstrap.
font-awesome.min.css : Styles pour les polices du site.
login.css : Styles de la page de connexion.
responsive.css : Styles pour le responsive design.
style.css : Styles généraux du site.
style.css.map : Styles pour l'affichage cartographique.
style.scss : Fichier SCSS (à compléter avec sa description).
website.css : Styles (à compléter avec sa description).
./images

bg.jpg : Image d'arrière-plan pour les pages de connexion et d'inscription.
./js

bootstrap.js : JavaScript pour les templates Bootstrap.
jquery.min.js : Bibliothèque JavaScript jQuery.
main.js : Scripts généraux du site.
website.js : Scripts pour la navbar et gestion de pop-ups.
./utils

User.php : Code de la classe utilisateur.
Fichiers Principaux :

mainPage.php : Page d'accueil.
compte.php : Gestion des informations de compte utilisateur.
index.php : Page de connexion.
inscription.php : Page d'inscription.
readme.md : Documentation du code (ce fichier).
Pour une meilleure compréhension du projet, n'hésitez pas à parcourir chaque fichier et répertoire.
