# Le Projet Senepart

Le projet Senepart est une collaboration entre **Faustin**, **Hugo** et **Mathias**, ayant pour but d'offrir une expérience utilisateur optimale dans le domaine de la géolocalisation.

## 🌐 Adresses IP des Machines Virtuelles 

Les machines virtuelles dédiées au projet sont accessibles via les adresses IP suivantes:
- **Site Web** : `192.168.64.84`
- **Base de Données** : `192.168.64.213`

## 🗃 Base de Données : Lawrence 

Pour accéder à cette base de données, voici les identifiants:
- **Identifiant** : `root`
- **Mot de passe** : `root`

### Structure de la base de données

Lawrence
│
 user :
     -idUser : int (clé primaire)
     -nom : varchar(30)
     -email : varchar(300)
     -password : varchar(30)
     -isAdmin : tinyint(1)


## 📁 Structure du Code

Les fichiers et répertoires sont organisés comme suit:

- **./addons**
  - `readme.md` : Documentation du code.
  - `lawrence.sql` : Export de la base de données pour importation dans PhpMyAdmin.

- **./bootstrap**
  - Contient les fichiers relatifs à Bootstrap.

- **./css**
  - `bootstrap.css` : Styles pour les templates Bootstrap.
  - `font-awesome.min.css` : Styles pour les polices du site.
  - `login.css` : Styles de la page de connexion.
  - `responsive.css` : Styles pour le responsive design.
  - `style.css` : Styles généraux du site.
  - `style.css.map` : Styles pour l'affichage cartographique.
  - `style.scss` : Fichier SCSS (description à compléter).
  - `website.css` : Styles (description à compléter).

- **./images**
  - `bg.jpg` : Image d'arrière-plan pour les pages de connexion et d'inscription.

- **./js**
  - `bootstrap.js` : JavaScript pour les templates Bootstrap.
  - `jquery.min.js` : Bibliothèque JavaScript jQuery.
  - `main.js` : Scripts généraux du site.
  - `website.js` : Scripts pour la navbar et gestion de pop-ups.

- **./utils**
  - `User.php` : Code de la classe utilisateur.

### Fichiers Principaux :

- `mainPage.php` : Page d'accueil.
- `compte.php` : Gestion des informations de compte utilisateur.
- `index.php` : Page de connexion.
- `inscription.php` : Page d'inscription.
- `readme.md` : Documentation du code (ce fichier).

> **Conseil** : Pour une meilleure compréhension du projet, n'hésitez pas à parcourir chaque fichier et répertoire.
