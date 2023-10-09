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

**Lawrence**

**Table : user**

| Champ     | Type           | Spécificité          |
|-----------|----------------|----------------------|
| idUser    | int            | Clé primaire         |
| nom       | varchar(30)    |                      |
| email     | varchar(300)   |                      |
| password  | varchar(30)    |                      |
| isAdmin   | tinyint(1)     |                      |


## 📁 Structure du Code

Les fichiers et répertoires sont organisés comme suit:

- **./class**
  - `User.php` : Code de la classe utilisateur.

- **./css**
  - `main.css` : Styles principaux pour les typographies, les éléments de formulaire, les boutons, les alertes de validation, et les éléments spécifiques à la connexion. Inclut également des styles pour différentes tailles d'écran (responsive).
  - `util.css` : Styles de base pour le responsive design et des utilitaires généraux.

- **./fonts**
  - `font-awesome-4.7.0/` : Dossier contenant les polices et les fichiers associés pour Font Awesome version 4.7.0, une   
 collection d'icônes utilisée pour la conception web.
  - `iconic/` : Dossier contenant les polices et fichiers associés pour Iconic, une autre collection d'icônes pour la 
 conception web.
  - `poppins/` : Dossier contenant les variations de la police Poppins, une police de caractères sans-serif.
  - `._font-awesome-4.7.0` : Fichier caché associé à Font Awesome. Peut-être lié à la configuration ou à des métadonnées s 
 pécifiques au système.
  - `._iconic` : Fichier caché associé à Iconic.
  - `._poppins` : Fichier caché associé à la police Poppins.

  
- **./addons**
  - `readme.md` : Documentation du code.
  - `lawrence.sql` : Export de la base de données pour importation dans PhpMyAdmin.

- **./bootstrap**
  - Contient les fichiers relatifs à Bootstrap.



- **./images**
  - `bg.jpg` : Image d'arrière-plan pour les pages de connexion et d'inscription.

- **./js**
  - `bootstrap.js` : JavaScript pour les templates Bootstrap.
  - `jquery.min.js` : Bibliothèque JavaScript jQuery.
  - `main.js` : Scripts généraux du site.
  - `website.js` : Scripts pour la navbar et gestion de pop-ups.



### Fichiers Principaux :

- `mainPage.php` : Page d'accueil.
- `compte.php` : Gestion des informations de compte utilisateur.
- `index.php` : Page de connexion.
- `inscription.php` : Page d'inscription.
- `readme.md` : Documentation du code (ce fichier).

> **Conseil** : Pour une meilleure compréhension du projet, n'hésitez pas à parcourir chaque fichier et répertoire.
